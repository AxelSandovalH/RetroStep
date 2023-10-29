<?php
    $host = 'localhost';
    $user = 'root';
    $password = '';
    $db = 'retro_step';
    $port = '3306';
    $connection = @mysqli_connect($host, $user, $password, $db, $port);
    if(!$connection){
        echo "Error en la conexión";
    }

?>