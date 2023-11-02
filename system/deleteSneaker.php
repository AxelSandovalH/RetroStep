<?php 
// Protección de rutas
include ("../scripts/routeProtection.php");

require_once "../connection.php"; //Se elimina la necesidad de escribir las variables de conexión poniendo un "require"
                                // Establecer conexión a la base de datos

//Espera

 $sneaker_id = $_GET['sneaker_id'];

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

?>