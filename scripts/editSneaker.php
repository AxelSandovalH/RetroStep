<?php
    require_once "../connection.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["sneaker_id"])) {
        $sneaker_id = $_POST["sneaker_id"];
        $sneakerName = $_POST["sneakerName"];
        $brand = $_POST["brandName"];
        $category = $_POST["categoryName"];
        $size = $_POST["sizeNumber"];
        $price = $_POST["price"];
        $stock = $_POST["stock_quantity"];
        $id_stock = $_POST["id_stock"];

       // Check if an image file was uploaded
        if (isset($_FILES['imageFile']) && $_FILES['imageFile']['error'] == UPLOAD_ERR_OK) {
            // Puedes manejar la imagen de la forma que prefieras, aquí se muestra cómo obtener el nombre de la imagen
            // Rutas y carpetas
            $nombre_imagen = $_FILES['imageFile']['name'];
            $ruta_completa = __DIR__ . "/../img/" . $nombre_imagen;

            // Ajusta la ruta relativa para mostrarla en la página
            $ruta = 'img/' . $nombre_imagen;
            // Mueve la imagen al directorio de destino
            move_uploaded_file($_FILES['imageFile']['tmp_name'], $ruta_completa);
            $img = $ruta;
        } else {
            // No new image file uploaded, use the existing image path
            $img = $_POST["imagen_url"];
        }

        $connection->autocommit(FALSE); // Deshabilitar la confirmación automática para transacciones

        // Actualizar tabla sneaker
        $querySneaker = "UPDATE sneaker 
                        INNER JOIN stock ON sneaker.sneaker_id = stock.sneaker_id
                        SET sneaker_name = ?, brand_name = ?, category_name = ?, stock.size_number = ?, price = ?, imagen_url = ? 
                        WHERE id_stock = ?";
        $stmtSneaker = $connection->prepare($querySneaker);
        $stmtSneaker->bind_param("ssssssi", $sneakerName, $brand, $category, $size, $price, $img, $id_stock);

        // Actualizar tabla stock
        $queryStock = "UPDATE stock 
                        SET stock_quantity = ? 
                        WHERE id_stock = ?";
        $stmtStock = $connection->prepare($queryStock);
        $stmtStock->bind_param("ii", $stock, $id_stock);

        $sneakerSuccess = $stmtSneaker->execute();
        $stockSuccess = $stmtStock->execute();
        
        if (!$sneakerSuccess || !$stockSuccess) {
            $connection->rollback();
            echo "Error updating sneaker. " . $stmtSneaker->error . " " . $stmtStock->error;
        }
        if ($sneakerSuccess && $stockSuccess) {
            $connection->commit(); // Confirmar los cambios en ambas tablas
            echo "Sneaker updated successfully";
        } else {
            $connection->rollback(); // Revertir cambios en caso de error en alguna de las consultas
            echo "Error updating sneaker";
        }

        $stmtSneaker->close();
        $stmtStock->close();
        $connection->autocommit(TRUE); // Restaurar la confirmación automática de transacciones
        $connection->close();
    } else {
        echo "Invalid Request";
    }
?>
