<?php
require_once "../connection.php"; //Se elimina la necesidad de escribir las variables de conexión poniendo un "require"
// Establecer conexión a la base de datos

// Recibir datos del formulario
$sneaker_name = $_POST["sneaker_name"];
$sneaker_brand = $_POST["brand_name"];
$price = $_POST["price"];
$stock = $_POST["stock_quantity"];
$sneaker_size = $_POST["size_number"];

// Verificar si ya existe un registro con el mismo modelo y talla
$sql_verificar = "SELECT COUNT(*) AS count FROM sneaker WHERE sneaker_name = ? AND size_number = ?";

if ($stmt_verificar = $connection->prepare($sql_verificar)) {
    // Vincular los parámetros
    $stmt_verificar->bind_param("si", $sneaker_name, $sneaker_size);

    // Ejecutar la consulta de verificación
    $stmt_verificar->execute();
    
    // Obtener el resultado
    $stmt_verificar->bind_result($count);
    $stmt_verificar->fetch();

    // Cerrar la consulta de verificación
    $stmt_verificar->close();

    // Si count es mayor que 0, ya existe un registro con los mismos valores
    if ($count > 0) {
        echo "Ya existe un registro con el mismo modelo y talla.";
    } else {
        // Si no existe, proceder con la inserción
        $sql_insertar = "INSERT INTO sneaker (brand_name, sneaker_name, price, stock, size) VALUES (?, ?, ?, ?, ?)";

        if ($stmt_insertar = $connection->prepare($sql_insertar)) {
            // Vincular los parámetros
            $stmt_insertar->bind_param("ssdii", $sneaker_brand, $sneaker_name, $price, $stock, $sneaker_size);

            // Ejecutar la consulta de inserción
            if ($stmt_insertar->execute()) {
                echo "Los datos se han agregado correctamente.";
                header("Location: main.php");

            } else {
                echo "Error al agregar los datos: " . $stmt_insertar->error;
            }

            // Cerrar la consulta de inserción
            $stmt_insertar->close();
        } else {
            echo "Error en la preparación de la consulta de inserción: " . $connection->error;
        }
    }
} else {
    echo "Error en la preparación de la consulta de verificación: " . $connection->error;
}

// Cerrar la conexión a la base de datos
$connection->close();
?>
