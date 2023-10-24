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

    //Espera
    if(!empty($_POST)){
        $id = $_POST['idUser'];

        $queryDelete = mysqli_query($connection, 
        "DELETE FROM users
        WHERE 
        id = $id");

        if($queryDelete){
        header("location: users.php");
        }else{
        echo("Error al eliminar");
        }
    }

    if(empty($_REQUEST['id'])){
        header("location: users.php");
    }else{
        $id = $_REQUEST['id'];
        $query = mysqli_query($connection, 

        "SELECT * from users WHERE 
        id = $id;");

        $result = mysqli_num_rows($query);

        if($result > 0){
            while($column = mysqli_fetch_array($query)){
                $username = $column["username"];
                $rol = $column["rol"];
                $password = $column["password"];
                $email = $column["email"];
            }
        }else{
        header("location: users.php");
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../CSS/styleDeleteSneaker.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Usuario</title>
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

    <section id="container">
        <div class="borrarDato">
            <h2>¿Estás seguro que quieres borrar el siguiente usuario?</h2>
            <p><span>Username: <?php echo $username; ?></span></p>
            <p><span>Rol: <?php echo $rol; ?></span></p>
            <p><span>Email: <?php echo $email; ?></span></p>

            <form method="post" action="">
                <input type="hidden" name ="idUser" value = "<?php echo $id?>">
                <a href="users.php" class = "btnCancelar">Cancelar</a>
                <input type="submit" value="Aceptar" class="btnAceptar">
            </form>
        </div>
    </section>
