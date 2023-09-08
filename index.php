<?php 
    $alert = '';
    session_start();

    if(!empty($_SESSION['active'])){
        header('location: sistema/main.php');

    }
    else{

        if(!empty($_POST)){
            if(empty($_POST['usuario']) || empty($_POST['clave'])){
                $alert = 'Ingrese su usuario y clave';
            }
            else{
                require_once "conexion.php";
                $user = $_POST['usuario'];
                $pass = $_POST['clave'];

                $query = mysqli_query($connection, "SELECT * FROM users WHERE username = '$user' AND password = '$pass' ");
                $result = mysqli_num_rows($query);

                if($result > 0){
                    $data = mysqli_fetch_array($query);
                    print_r($data);
                    $_SESSION['active'] = true;
                    $_SESSION['idUser'] = $data['id']; //Los campos deben de llamarse igual que en la BD
                    // $_SESSION['nombre'] = $data['nombre'];
                    $_SESSION['email'] = $data['email'];
                    $_SESSION['user'] = $data['username'];

                    header('location: sistema/main.php');
                    
                }
                else{
                    $alert = "El usuario o la clave son incorrectos";
                    session_destroy();

                }
            }


        }

    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="CSS/styleIndex.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pruebas</title>
</head>
<body>
    <header class="header">
        
        <div>
            <a href="index.html">
                <h1 class="Titulo">
                    RetroStep
                </h1>
            </a>
           
        </div>
        
        <div class="logo">
            <img src="./img/" alt="">
        </div>
       
        
    </header>
    

    <div id="Login">
        <header>Login</header>
        
        <form action="" method="post">
            <label for="Usuario" >Usuario</label>
            <input type="text" name="usuario" >
            <label for="Password">Password</label>
            <div class="alert"><?php echo isset ($alert) ? $alert : '';  ?></div>
            <input type="password" name="clave" >
            <button type="reset" id="Cancelar">Cancelar</button>
            
            <button id = "Succes" type="submit" >Verificar</button>

        </form>
    </div>
    
    
    <script src="app.js"></script>
</body>
</html>