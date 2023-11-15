<?php 
// Protección de rutas
session_start();

include("connection.php");

if(empty($_SESSION['active'])){
    header('location: /RetroStep/index.php');

}
?>