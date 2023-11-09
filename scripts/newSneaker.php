<?php 
require_once("../connection.php");

// Espera a que haya una acción tipo POST para realizar la verificación 
if (!empty($_POST)) {
    $sneaker_name = $_POST["sneaker_name"];
    $brand_name = $_POST["brand_name"];
    $price = $_POST["price"];
    $stock_quantity = $_POST["stock_quantity"];
    $size_number = $_POST["size_number"];
    $category_name = $_POST["category_name"];
    
    // Rutas y carpetas
    $nombre_imagen = $_FILES['image']['name'];
    $temporal = $_FILES['image']['tmp_name'];
    $carpeta = __DIR__ . "/img";

    // Verifica si la carpeta existe, si no, créala
    if (!file_exists($carpeta)) {
        mkdir($carpeta, 0777, true);
    }

    $ruta = $carpeta . '/' . $nombre_imagen;
    move_uploaded_file($temporal, $ruta);

    $querySelect = mysqli_query($connection, 
        "SELECT * FROM sneaker WHERE sneaker_name = '$sneaker_name'");

    if (mysqli_num_rows($querySelect) > 0) {
        echo 'That model already exists.';
    } else {
        $queryInsert = mysqli_multi_query($connection, 
<<<<<<< HEAD
        "INSERT INTO sneaker (brand_name, sneaker_name, price, size_number, category_name, imagen_url) VALUES ('$brand_name', '$sneaker_name', $price, $size_number, '$category_name', '$ruta');
        -- Obtener el 'sneaker_id' recién generado
        SET @sneaker_id = LAST_INSERT_ID();

        -- Insertar en la tabla 'stock' con 'sneaker_id' y 'stock_quantity'
        INSERT INTO stock (sneaker_id, stock_quantity, size_number) VALUES (@sneaker_id, $stock_quantity, $size_number);");
       

            if($queryInsert){
                echo 'Sneaker saved succesfully';
            }
            else{
                echo "Error: " . mysqli_error($connection);
                echo "Filas afectadas: " . mysqli_affected_rows($connection);

            }
=======
            "INSERT INTO brand (brand_name) VALUES ('$brand_name') ON DUPLICATE KEY UPDATE brand_name = '$brand_name';
            INSERT INTO size (size_number) VALUES ($size_number) ON DUPLICATE KEY UPDATE size_number = $size_number;
            INSERT INTO category (category_name) VALUES ('$category_name') ON DUPLICATE KEY UPDATE category_name = '$category_name';
            INSERT INTO sneaker (brand_name, sneaker_name, price, size_number, category_name, imagen_url) VALUES ('$brand_name', '$sneaker_name', $price, $size_number, '$category_name', '$ruta');
            SET @sneaker_id = LAST_INSERT_ID();
            INSERT INTO stock (sneaker_id, stock_quantity, size_number) VALUES (@sneaker_id, $stock_quantity, $size_number);");

        if ($queryInsert) {
            echo 'Sneaker saved successfully';
        } else {
            // Manejo de errores más detallado
            echo "Error: " . mysqli_error($connection);
        }
>>>>>>> 3305327752e38d88477e4d1070462f7e8cfc4fbe
    }
}
?>
