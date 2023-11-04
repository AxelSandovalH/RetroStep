<?php 
include ("../scripts/routeProtection.php");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../CSS/styleUsers.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>
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
        
        <div class="logo">
            <img src="./img/offwhite.gif" alt="">
        </div>
       
        <div class="exitBtn">
            <a href="../exit.php"><img src="../img/power.png" alt="salir"></a>
        </div>
        
    </header>


    <div class="TablaContainerUsers">
    <table class="TablaUsers" id="usersTable">
        <tr class="Encabezado">
            <th colspan="7">Usuarios
                <a href="addUsers.php">
                    <button class="add">
                        +
                    </button>
                </a>
            
        </th>
        </tr>
        <tr>
            <td><b>ID</b></td>
            <td><b>Username</b></td>
            <td><b>Email</b></td>
            <td><b>Rol</b></td>
            <!-- <td><b>Email</b></td>
            <td><b>Rol</b></td>
            <td><b>Creado</b></td> -->
        </tr>
        </tr>

        <?php
            require_once "../connection.php";
            $sql ="SELECT * FROM roles
            INNER JOIN users 
            ON roles.idRol = users.rol";

            $result=mysqli_query($connection,$sql);

            while($column=mysqli_fetch_array($result)){
        ?>
        <!-- ... (código HTML anterior) ... -->

        <tr>
            <td><?php echo $column['id']?></td>
            <td><?php echo $column['username']?></td>
            <td><?php echo $column['email']?></td>
            <td><?php echo $column['rol_name']?></td>
            <td>
                <a class="link_editar" href="editUsers.php?id=<?php echo $column['id']?>">
                    <button class="editar">Editar</button>
                </a>
            </td>
            <td>
                <!-- Se crea un href con el link del archivo php y el dato que se mandará (id) -->
                <a class="link_borrar" href="deleteUsers.php?idUser=<?php echo $column['id']; ?>&confirmed=yes" onclick="return confirm('¿Seguro que quieres borrar al usuario con ID: <?php echo $column['id']; ?>, Nombre de usuario: <?php echo $column['username']; ?>, Email: <?php echo $column['email']; ?>?')">
    <button class="eliminar">Eliminar</button>
</a>

            </td>
        </tr>


        <?php
        }
        ?>
    </table>
    
    <script src="app.js"></script>
</body>
</html>