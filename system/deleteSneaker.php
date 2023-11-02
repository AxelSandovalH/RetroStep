<?php 
// Protección de rutas
include ("../scripts/routeProtection.php");

require_once "../connection.php"; //Se elimina la necesidad de escribir las variables de conexión poniendo un "require"
                                // Establecer conexión a la base de datos

//Espera
if(!empty($_POST)){
 $sneaker_id = $_POST['sneaker_id'];

 $queryDelete = mysqli_query($connection, 
 "UPDATE sneaker
  SET deleted_at = CURRENT_TIMESTAMP
  WHERE 
  sneaker_id = $sneaker_id");

    if($queryDelete){
        header("location: main.php");
    }
    else{
        echo("Error al eliminar");
    }
}

if(empty($_REQUEST['sneaker_id'])){
    header("location: main.php");
}

else{

    $sneaker_id = $_REQUEST['sneaker_id'];
    $query = mysqli_query($connection, 
    
    "SELECT * from sneaker
    INNER JOIN stock
    ON sneaker.sneaker_id = stock.sneaker_id
    WHERE sneaker.sneaker_id = $sneaker_id AND stock.sneaker_id = $sneaker_id");
    
    $result = mysqli_num_rows($query);

    if($result > 0){
        while($column = mysqli_fetch_array($query)){

            $sneaker_name = $column["sneaker_name"];
            $brand_name = $column["brand_name"];
            $price = $column["price"];
            $stock_quantity = $column["stock_quantity"];
            $size_number = $column["size_number"];
        }
    }
    else{
        header("location: main.php");
    }
    
}

?>



