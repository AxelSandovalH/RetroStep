<?php 
require_once("../connection.php");

// Espera a que haya una acción tipo POST para realizar la verificación 
if(!empty($_POST)){
    // $sneaker_id = $_POST['sneaker_id'];
    $sneaker_name = $_POST["sneaker_name"];
    $brand_name = $_POST["brand_name"];
    $price = $_POST["price"];
    $stock_quantity = $_POST["stock_quantity"];
    $size_number = $_POST["size_number"];
    $category_name = $_POST["category_name"];
    $nombre_imagen = $_FILES['imagen']['name'];
    $temporal = $_FILES['imagen']['tmp_name'];
    $carpeta = "img";
    $ruta = $carpeta . '/' . $nombre_imagen;
    move_uploaded_file($temporal, $carpeta . '/' . $nombre_imagen);

    $querySelect = mysqli_query($connection, 
    "SELECT * FROM sneaker 
    WHERE (sneaker_name = '$sneaker_name')");

    $result = mysqli_fetch_array($querySelect);

    if($result > 0){
        echo 'That model already exists.';
    }
    else{

        $queryInsert = mysqli_multi_query($connection, 
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
    }
}
// $query = mysqli_query($connection, 

// "SELECT * from sneaker
// INNER JOIN stock
// ON sneaker.sneaker_id = stock.sneaker_id
// WHERE sneaker.sneaker_id = $sneaker_id AND stock.sneaker_id = $sneaker_id");

// $result = mysqli_num_rows($query);

// if($result > 0){
//     while($column = mysqli_fetch_array($query)){

//         $sneaker_name = $column["sneaker_name"];
//         $brand_name = $column["brand_name"];
//         $price = $column["price"];
//         $stock_quantity = $column["stock_quantity"];
//         $size_number = $column["size_number"];
//     }
// }
// else{
//     header("location: main.php");
// }

?>