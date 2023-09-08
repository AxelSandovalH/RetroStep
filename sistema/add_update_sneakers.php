<?php
$host = "localhost";
$usuario = "root";
$contraseña = "";
$base_de_datos = "retrostep";

// Establecer conexión a la base de datos
$conexion = new mysqli($host, $usuario, $contraseña, $base_de_datos);

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error de conexión a la base de datos: " . $conexion->connect_error);
}

// Recibir datos del formulario
$modelo = $_POST["Modelo"];
$marca = $_POST["Marca"];
$precio = $_POST["Precio"];
$stock = $_POST["Stock"];
$size = $_POST["Size"];

// Verificar si ya existe un registro con el mismo modelo y talla
$sql_verificar = "SELECT COUNT(*) AS count FROM sneakers WHERE Modelo = ? AND Size = ?";

if ($stmt_verificar = $conexion->prepare($sql_verificar)) {
    // Vincular los parámetros
    $stmt_verificar->bind_param("si", $modelo, $size);

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
        $sql_insertar = "INSERT INTO sneakers (Marca, Modelo, Precio, Stock, Size) VALUES (?, ?, ?, ?, ?)";

        if ($stmt_insertar = $conexion->prepare($sql_insertar)) {
            // Vincular los parámetros
            $stmt_insertar->bind_param("ssdii", $marca, $modelo, $precio, $stock, $size);

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
            echo "Error en la preparación de la consulta de inserción: " . $conexion->error;
        }
    }
} else {
    echo "Error en la preparación de la consulta de verificación: " . $conexion->error;
}

// Cerrar la conexión a la base de datos
$conexion->close();
?>
