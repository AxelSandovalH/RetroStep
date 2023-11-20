<?php
require_once "../connection.php";

// Recoger los valores de los filtros (puedes agregar más según sea necesario)
$brandFilter = $_GET['brand_name'];
$sizeFilter = $_GET['size_number'];
$modelFilter = $_GET['sneaker_name'];
$categoryFilter = $_GET['category_name'];

// Construir la consulta SQL con los filtros seleccionados
$sql = "SELECT * FROM stock 
        INNER JOIN sneaker ON stock.sneaker_id = sneaker.sneaker_id 
        WHERE stock.deleted_at IS NULL";

if (!empty($brandFilter)) {
    $sql .= " AND sneaker.brand_name = '$brandFilter'";
}

if (!empty($sizeFilter)) {
    $sql .= " AND stock.size_number = '$sizeFilter'";
}

if (!empty($modelFilter)) {
    $sql .= " AND sneaker.sneaker_name = '$modelFilter'";
}

if (!empty($categoryFilter)) {
    $sql .= " AND sneaker.category_name = '$categoryFilter'";
}
// Ejecutar la consulta
$result = mysqli_query($connection, $sql);

// Crear un array para almacenar los resultados
$json = array();

// Recorrer los resultados y agregarlos al array
while ($row = mysqli_fetch_assoc($result)) {
    $json[] = array(
        'imagen_url' => $row['imagen_url'],
        'sneaker_id' => $row["sneaker_id"],
        'sneaker_name' => $row['sneaker_name'],
        'brand_name' => $row['brand_name'],
        'size_number' => $row['size_number'],
        'price'=> $row['price'],
        'stock_quantity'=> $row['stock_quantity'],
        'id_stock'=> $row['id_stock']
    );
}

// Convertir el array a formato JSON y enviarlo como respuesta
$jsonstring = json_encode($json);
echo $jsonstring;
// Cerrar la conexión
mysqli_close($connection);
?>
