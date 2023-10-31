<?php 
define("BASE_URL", "/RetroStep/");
// Protección de rutas
include("../connection.php");

session_start();

if(empty($_SESSION['active'])){
    header('location: ' . BASE_URL .'index.php');

}
?>