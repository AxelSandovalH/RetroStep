<?php
require_once "../connection.php"; //Se elimina la necesidad de escribir las variables de conexión poniendo un "require"
// Establecer conexión a la base de datos

if(!empty($_POST))
{
    $alert = '';
    //Verificar que todos los campos estén llenos
    if(empty($_POST['username']) || empty($_POST['password']) || empty($_POST['email']))
    {
        $alert = '<p class="msg_error">Todos los campos son obligatorios</p>';
    }else{
        //Recibir datos
        $username = $_POST["username"];
        $password = $_POST["password"];
        $email = $_POST["email"];
        $rol = $_POST["rol"];

        //Verificar que no exista un usuario con el mismo Username o Email
        $query = mysqli_query($connection,"SELECT * FROM users WHERE username = '$username' OR email = '$email' ");
        $result = mysqli_fetch_array($query);

        if($result > 0){
            $alert = '<p class="msg_error">Ya existe un usuario con el mismo username o correo</p>';
        }else{
            //Insertar los datos 
            $query_insert = mysqli_query($connection,"INSERT INTO users(username, password, email, rol) VALUES ('$username', md5('$password'), '$email', '$rol')");
            
            if($query_insert){
                $alert = '<p class="msg_save">Usuario creado con éxito</p>';
                header("Location: users.php");
            }else{
                $alert = '<p class="msg_error">Error al crear usuario</p>';
            }
        }

    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../CSS/styleAddUsers.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Usuario</title>
</head>
<body>
    <header class="header">
        
        <!-- <a href="#" id="menu" class="menu-icon">
            <i class="fas fa-bars"></i>
        </a> -->
        
        <div>
            <a href="../">
                <h1 class="Titulo">
                    RetroStep
                </h1>
            </a>
           
        </div>
       
        <div class="exitBtn">
            <a href="../salir.php"><img src="../img/power.png" alt="salir"></a>
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

    <!----------------------------------------------------------->

    <div id="addUser">
        <header>Agregar Usuario</header>
        <div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>
        
        <form action="addUsers.php" method="post">
            <label for="username">Username</label>
            <input name="username" type="text" required>
            <label for="password">Contraseña</label>
            <input name="password" type="password" required>
            <label for="email">Email</label>
            <input name="email" type="text" required>
            <label for="rol">Rol</label>
            <select name="rol" id="Rol">
                <option value="1">Administrador</option>
                <option value="2">Vendedor</option>
            </select>
            
            
            
            <button type="reset" id="Cancelar"><a href="users.php">Cancelar</a></button>
            
            <button type="submit"  id="Succes">Agregar</button>
        </form>
    </div>
    
    
    <script src="app.js"></script>
</body>
</html>