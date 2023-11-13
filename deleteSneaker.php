<?php
// include("scripts/routeProtection.php");
include("connection.php");
 
if (isset($_GET['sneaker_id'])) {
    $sneaker_id = $_GET['sneaker_id'];

    if (isset($_GET['confirmed']) && $_GET['confirmed'] === 'yes') {
        $queryDelete = mysqli_query($connection, "UPDATE sneaker SET deleted_at = CURRENT_TIMESTAMP WHERE sneaker_id = $sneaker_id");

        if ($queryDelete) {
            header("location: sneakers.php");
        } else {
            echo "Error al eliminar";
        }
    } else {
        echo "Eliminación cancelada. <a href='main.php'>Volver</a>";
    }
}
?>