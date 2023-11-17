<?php
require_once "connection.php";

$sneaker_id = $_POST['sneaker_id'];

// Obtener la fecha y hora actual
$current_timestamp = date("Y-m-d H:i:s");

// Actualizar la columna deleted_at en la tabla sneaker
$queryDeleteSneaker = mysqli_query($connection, "UPDATE sneaker SET deleted_at = '$current_timestamp' WHERE sneaker_id = $sneaker_id");

if ($queryDeleteSneaker) {
    echo "Sneaker deleted successfully";
} else {
    echo "Error al eliminar";
}


?>
