<?php
require_once "../connection.php"; 

// Valida la existencia de algún campo que ocasione conflicto
if(!empty($_POST)){

    $idU = $_POST["idUser"];
    $username = $_POST["username"];
    $rol = $_POST["rol"];
    $password = $_POST["password"];
    $email = $_POST["email"];

    $query = mysqli_query($connection, 
    "SELECT * FROM users 
    WHERE (id != $idU AND  username = '$username' AND email = '$email')");

    $result = mysqli_fetch_array($query);

    if($result > 0){
        echo 'Username or Email already exists';
    }

    // Si pasa la validación, procede a capturar los datos.
    else{
        $sql_update = mysqli_query($connection, 
        "UPDATE users 
        SET
        username = '$username',
        rol = $rol,
        password = '$password',
        email = '$email'
        
        WHERE id = $idU ");

        if($sql_update){
            echo 'User successfully updated';
        }
        else{
            echo 'Update: error';
        }
    }
}


$idUser = $_GET['id'];

$sql = mysqli_query($connection,    
"SELECT u.username, u.rol, u.password, u.email
FROM users u
WHERE id = $idUser");
?>

