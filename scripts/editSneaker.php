<?php
    require_once "../connection.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["sneaker_id"])) {
        $sneaker_id = $_POST["sneaker_id"];
        $sneakerName = $_POST["sneakerName"];
        $brand = $_POST["brandName"];
        $category = $_POST["categoryName"];
        $size = $_POST["sizeNumber"];
        $price = $_POST["price"];
        $img = $_POST["imagen_url"];
        $stock = $_POST["stock_quantity"];

        $connection->autocommit(FALSE); // Deshabilitar la confirmación automática para transacciones

        // Actualizar tabla sneaker
        $querySneaker = "UPDATE sneaker 
                        SET sneaker_name = ?, brand_name = ?, category_name = ?, size_number = ?, price = ?, imagen_url = ? 
                        WHERE sneaker_id = ?";
        $stmtSneaker = $connection->prepare($querySneaker);
        $stmtSneaker->bind_param("sssssii", $sneakerName, $brand, $category, $size, $price, $img, $sneaker_id);

        // Actualizar tabla stock
        $queryStock = "UPDATE stock 
                        SET stock_quantity = ? 
                        WHERE sneaker_id = ?";
        $stmtStock = $connection->prepare($queryStock);
        $stmtStock->bind_param("ii", $stock, $sneaker_id);

        $sneakerSuccess = $stmtSneaker->execute();
        $stockSuccess = $stmtStock->execute();

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
