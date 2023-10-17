<?php
    $host = 'localhost';
    $user = 'jl';
    $password = '123';
    // $db = 'retro_stepGod';
    $db = 'retrostepdb';
    $port = '3307';
    $connection = @mysqli_connect($host, $user, $password, $db, $port);
    if(!$connection){
        echo "Error en la conexión";
    }

?>