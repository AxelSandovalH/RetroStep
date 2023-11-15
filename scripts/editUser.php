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
            header("location: users.php");
        }
        else{
            echo 'Update: error';
        }
    }
}

// Valida que el id en la url exista o tenga valor
if(empty($_GET['id'])){

    header("location: users.php");

}

$idUser = $_GET['id'];

$sql = mysqli_query($connection, 
"SELECT u.username, u.rol, u.password, u.email
FROM users u
WHERE id = $idUser");

// Valida que existan columnas con información dentro de la BD
$result_sql = mysqli_num_rows($sql);

if($result_sql == 0){
    header("location: users.php");
}else{

    while($column = mysqli_fetch_array($sql)){
        $username = $column["username"];
        $rol = $column["rol"];
        $password = $column["password"];
        $email = $column["email"];
    }
}
?>

