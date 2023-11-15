<?php
require_once "connection.php";

if (isset($_GET['sneaker_id'])) {
    $sneaker_id = $_GET['sneaker_id'];

    if (isset($_GET['confirmed']) && $_GET['confirmed'] === 'yes') {
        // Obtener la fecha y hora actual
        $current_timestamp = date("Y-m-d H:i:s");

        // Actualizar la columna deleted_at en la tabla sneaker
        $queryDeleteSneaker = mysqli_query($connection, "UPDATE sneaker SET deleted_at = '$current_timestamp' WHERE sneaker_id = $sneaker_id");

        if ($queryDeleteSneaker) {
            header("location: sneakers.php");
        } else {
            echo "Error al eliminar";
        }
    } else {
        echo "Eliminación cancelada. <a href='main.php'>Volver</a>";
    }
}
?>
