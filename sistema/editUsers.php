<?php 
// Protección de rutas
session_start();

if(empty($_SESSION['active'])){
    header('location: ../');

}
?>

<?php

require_once "../conexion.php"; //Se elimina la necesidad de escribir las variables de conexión poniendo un "require"
// Establecer conexión a la base de datos


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
        echo '<p class ="msgError">Usuario o Email ya existen</p>';
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
            echo "<p>Usuario actualizado correctamente.</p>";
            header("location: users.php");
        }
        else{
            echo "<p>Error al modificar usuario.</p>";
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

<!DOCTYPE html>
<html lang="en">
<head>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../CSS/styleEditarSneaker.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
</head>
<body>
    <header class="header">
        
        <a href="#" id="menu" class="menu-icon">
            <i class="fas fa-bars"></i>
        </a>
        
        <div>
            <a href="../">
                <h1 class="Titulo">
                    RetroStep
                </h1>
            </a>
           
        </div>
    </header>

    <!-- <div class="side-menu" id="side-menu">
        <header >Sneakers
            <button id="x">
                x
            </button>
        </header>
        <hr>
        <ul>
            <li><a href="./adminusers.html">AdminUsers</a></li>
            <li><a href="#">Sport</a></li>
            <li><a href="#">caminata</a></li>
        </ul>
    </div> -->

    <div id="addSneaker">
        <header>Editar Usuario</header>
        
        <form action="" method="post">
            <input type="hidden" name="idUser" value="<?php echo $idUser; ?>" >
            <label for="username">Username</label>
            <input name="username" type="text" id="username" value="<?php echo $username; ?>" required >
            <label for="password">Password</label>
            <input name="password" type="password" id="password" value="<?php echo $password; ?>" required>
            <label for="email">Email</label>
            <input name="email" type="email" id="email" value="<?php echo $email; ?>" required>
            <label for="rol">Rol</label>
            <select name="rol" value="<?php echo $rol; ?>" required>
                <option value="1">Administrador</option>
                <option value="2">Vendedor</option>
            </select>
           
            <button type="" id="Cancelar"><a href="users.php">Cancelar</a></button>
            
            <button type="submit" id="Succes">Actualizar usuario</button>
        </form>
    </div>
    
    
    <script src="app.js"></script>
</body>
</html>
