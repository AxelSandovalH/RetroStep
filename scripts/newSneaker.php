<?php
require_once("../connection.php");

// Espera a que haya una acción tipo POST para realizar la verificación
if (!empty($_POST)) {
    // Recoge los datos del formulario
    $sneaker_name = $_POST["sneaker_name"];
    $brand_name = $_POST["brand_name"];
    $price = $_POST["price"];
    $stock_quantity = $_POST["stock_quantity"];
    $size_number = $_POST["size_number"];
    $category_name = $_POST["category_name"];

    // Rutas y carpetas
    $nombre_imagen = $_FILES['image']['name'];
    $ruta_completa = __DIR__ . "/../img/" . $nombre_imagen;

    // Ajusta la ruta relativa para mostrarla en la página
    $ruta = 'img/' . $nombre_imagen;

    // Mueve la imagen al directorio de destino
    move_uploaded_file($_FILES['image']['tmp_name'], $ruta_completa);

    // Verifica si la sneaker ya existe
    $querySelect = mysqli_query($connection, "SELECT * FROM sneaker WHERE sneaker_name = '$sneaker_name' and deleted_at is NULL");

    if (mysqli_num_rows($querySelect) > 0) {
        echo 'That model already exists.';
    } else {
        // Inserta la nueva sneaker en la base de datos
        $queryInsert = mysqli_multi_query($connection,
            "INSERT INTO sneaker (brand_name, sneaker_name, price, size_number, category_name, imagen_url)
             VALUES ('$brand_name', '$sneaker_name', $price, $size_number, '$category_name', '$ruta');
            SET @sneaker_id = LAST_INSERT_ID();
            INSERT INTO stock (sneaker_id, stock_quantity, size_number) VALUES (@sneaker_id, $stock_quantity, $size_number);");

        // Muestra el resultado
        if ($queryInsert) {
            echo 'Sneaker saved successfully';
           
        } else {
            echo "Error: " . mysqli_error($connection);
            echo "Filas afectadas: " . mysqli_affected_rows($connection);
        }
    }
}
?>
