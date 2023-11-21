<?php
require_once "connection.php";

$sneaker_id = $_POST['sneaker_id'];
$size_number = $_POST['size_number'];

// Obtener la fecha y hora actual
$current_timestamp = date("Y-m-d H:i:s");

// Actualizar la columna deleted_at en la tabla sneaker
$queryDeleteSneaker = mysqli_query($connection, "UPDATE stock st INNER JOIN sneaker sn
                                                ON st.sneaker_id = sn.sneaker_id
                                                SET st.deleted_at = '$current_timestamp'
                                                WHERE st.sneaker_id = $sneaker_id AND st.size_number = $size_number");

if ($queryDeleteSneaker) {
    echo "Sneaker deleted successfully";
} else {
    echo "Error al eliminar";
}


?>
