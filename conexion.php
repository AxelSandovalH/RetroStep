<?php
    $host = 'localhost';
    $user = 'root';
    $password = '';
    $db = 'retrostep';

    $connection = @mysqli_connect($host, $user, $password, $db);
    if(!$connection){
        echo "Error en la conexión";
    }

?>