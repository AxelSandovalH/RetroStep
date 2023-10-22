<?php
require_once "../connection.php";

// Recibir datos del formulario
$modelo = $_POST["Modelo"];
$marca = $_POST["Marca"];
$precio = $_POST["Precio"];
$stock = $_POST["Stock"];
$size = $_POST["Size"];

// Verificar si ya existe un registro con el mismo modelo y talla
$sql_verificar = "SELECT COUNT(*) AS count FROM sneakers WHERE Modelo = ? AND Size = ?";

if ($stmt_verificar = $connection->prepare($sql_verificar)) {
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
        $sql_insertar = "INSERT INTO sneakers (Marca, Modelo, Precio, Stock, Size, Imagen) VALUES (?, ?, ?, ?, ?, ?)";

        if ($stmt_insertar = $connection->prepare($sql_insertar)) {
            // Vincular los parámetros, incluyendo la imagen
            $stmt_insertar->bind_param("ssdiis", $marca, $modelo, $precio, $stock, $size, $rutaDeImagen);

            // Manejar la subida de la imagen
            if (isset($_FILES['Imagen']) && $_FILES['Imagen']['error'] === 0) {
                $rutaDeImagen = 'ruta/donde/guardar/imagen.jpg'; // Ruta donde deseas guardar la imagen
                
                if (move_uploaded_file($_FILES['Imagen']['tmp_name'], $rutaDeImagen)) {
                    // Ejecutar la consulta de inserción
                    if ($stmt_insertar->execute()) {
                        echo "Los datos se han agregado correctamente.";
                        header("Location: main.php");
                    } else {
                        echo "Error al agregar los datos: " . $stmt_insertar->error;
                    }
                } else {
                    echo "Error al cargar la imagen.";
                }
            } else {
                echo "No se ha cargado ninguna imagen.";
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