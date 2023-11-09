<?php
    $host = 'localhost';
    $user = 'root';
<<<<<<< HEAD
    $password = '';
=======
    $password = 'psyduck56';
>>>>>>> db7000bcdcecc54f399fe4b727785da7c29b11d4
    $db = 'retro_step';
    $port = '3306';
    $connection = @mysqli_connect($host, $user, $password, $db, $port);
    if(!$connection){
        echo "Error en la conexión";
    }
?>