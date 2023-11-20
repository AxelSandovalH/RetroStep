<?php
require_once("../connection.php");

// Verifica si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera los datos del formulario
    $sneakerName = $_POST['sneaker_name'];
    $brandName = $_POST['brand_name'];
    $categoryName = $_POST['category_name'];
    $price = $_POST['price'];
    $stockQuantity = $_POST['stock_quantity'];

    // Puedes manejar la imagen de la forma que prefieras, aquí se muestra cómo obtener el nombre de la imagen
    // Rutas y carpetas
    $nombre_imagen = $_FILES['image']['name'];
    $ruta_completa = __DIR__ . "/../img/" . $nombre_imagen;

    // Ajusta la ruta relativa para mostrarla en la página
    $ruta = 'img/' . $nombre_imagen;
    // Mueve la imagen al directorio de destino
    move_uploaded_file($_FILES['image']['tmp_name'], $ruta_completa);

    // Puedes procesar la lista de tallas seleccionadas de la misma manera que en el formulario
    $selectedSizes = $_POST['size_number'];

    // Realiza la inserción en la tabla 'sneaker'
    $sqlInsertSneaker = "INSERT INTO sneaker (sneaker_name, brand_name, category_name, price, imagen_url, created_at, updated_at) 
                         VALUES ('$sneakerName', '$brandName', '$categoryName', $price, '$ruta', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)";

    if (mysqli_query($connection, $sqlInsertSneaker)) {
        // Obtiene el ID del sneaker recién insertado
        $sneakerId = mysqli_insert_id($connection);

        // Realiza la inserción en la tabla 'stock y sneaker_size' para cada talla seleccionada
        foreach ($selectedSizes as $size) {
            $sqlInsertStock = "INSERT INTO stock (sneaker_id, size_number, stock_quantity, created_at, updated_at) 
                               VALUES ($sneakerId, $size, $stockQuantity, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)";
            mysqli_query($connection, $sqlInsertStock);
            
            $sqlInsertSneakerSize = "INSERT INTO sneaker_size (sneaker_id, size_number) 
                                     VALUES ($sneakerId, $size);";

            mysqli_query($connection, $sqlInsertSneakerSize);
        }

        echo "Sneaker added successfully!";
    } else {
        echo "Error adding sneaker: " . mysqli_error($connection);
    }

} else {
    echo "Invalid request method";
}

?>
