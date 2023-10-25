<?php
session_start();

if (empty($_SESSION['active'])) {
    header('location: ../');
}

require_once "../conexion.php";

if (!empty($_GET['id']) && isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
    if (isset($_GET['confirm']) && $_GET['confirm'] === "true") {
        // Si la confirmación es verdadera, elimina el registro
        $queryDelete = mysqli_query($connection, "DELETE FROM sneakers WHERE id = $id");

        if ($queryDelete) {
            header("location: main.php");
            exit; // Salir del script para evitar doble confirmación
        } else {
            echo "Error al eliminar";
        }
    } else {
        $queryDelete = mysqli_query($connection, "DELETE FROM sneakers WHERE id = $id");
        header("location: main.php");
    }
} else {
    header("location: main.php");
}
?>

