<?php 
session_start();

if(empty($_SESSION['active'])){
    header('location: ../');

}
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
<<<<<<< HEAD:system/users.php
<<<<<<<< HEAD:system/users.php
        
        <!-- <a href="#" id="menu" class="menu-icon">
========
        <a href="#" id="menu" class="menu-icon">
>>>>>>>> e1d9758a8457b32ed3fcd9a07a975f50300b5ef0:sistema/main.php
=======
        
        <!-- <a href="#" id="menu" class="menu-icon">
>>>>>>> e1d9758a8457b32ed3fcd9a07a975f50300b5ef0:sistema/users.php
            <i class="fas fa-bars"></i>
        </a> -->
        
        <div>
            <a href="../">
                <h1 class="Titulo">
                    RetroStep
                </h1>
            </a>
<<<<<<< HEAD:system/users.php
=======
           
>>>>>>> e1d9758a8457b32ed3fcd9a07a975f50300b5ef0:sistema/users.php
        </div>
        
        <div class="logo">
            <img src="./img/offwhite.gif" alt="">
        </div>
       
        <div class="exitBtn">
            <a href="../salir.php"><img src="../img/power.png" alt="salir"></a>
        </div>
<<<<<<< HEAD:system/users.php
<<<<<<<< HEAD:system/users.php
=======
>>>>>>> e1d9758a8457b32ed3fcd9a07a975f50300b5ef0:sistema/users.php
        
    </header>
    <!-- <div class="side-menu" id="side-menu">
        <header >Sneakers
<<<<<<< HEAD:system/users.php
========

        <div class="add-sneaker">
            <a href="nuevoSneaker.html">
                <i class="fas fa-plus"></i>
            </a>
        </div>
    </header>
    <div class="side-menu" id="side-menu">
        <header>Categorias
>>>>>>>> e1d9758a8457b32ed3fcd9a07a975f50300b5ef0:sistema/main.php
=======
>>>>>>> e1d9758a8457b32ed3fcd9a07a975f50300b5ef0:sistema/users.php
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
<<<<<<< HEAD:system/users.php
<<<<<<<< HEAD:system/users.php
=======
>>>>>>> e1d9758a8457b32ed3fcd9a07a975f50300b5ef0:sistema/users.php
    </div> -->

    <!----------------------------------------------------------->

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
            require_once "../conexion.php";
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
                <a class="link_borrar" href = "deleteUsers.php?id=<?php echo $column['id']; ?>">
<<<<<<< HEAD:system/users.php
========

        <header>Administrador</header>
        <hr>
        <ul>
            <li><a href="users.php">Usuarios</a></li>
        </ul>
    </div>

    <div class="TablaContainerSneakers">
    <?php
    require_once "../conexion.php";
    $sql = "SELECT * from sneakers";
    $result = mysqli_query($connection, $sql);

    while ($column = mysqli_fetch_array($result)) {
    ?>
        <div class="sneaker-card">
            <div class="sneaker-info">
                <h2>Modelo: <?php echo $column['Modelo']; ?></h2>
                <p>Marca: <?php echo $column['Marca']; ?></p>
                <p>Talla: <?php echo $column['Size']; ?></p>
                <p>Precio: <?php echo $column['Precio']; ?></p>
                <p>Stock: <?php echo $column['Stock']; ?></p>
            </div>
            <div class="sneaker-actions">
                <a class="link_editar" href="editSneaker.php?id=<?php echo $column['id']; ?>">
                    <button class="editar">Editar</button>
                </a>
                <a class="link_borrar" href="deleteSneaker.php?id=<?php echo $column['id']; ?>">
>>>>>>>> e1d9758a8457b32ed3fcd9a07a975f50300b5ef0:sistema/main.php
                    <button class="eliminar">Eliminar</button>
                </a>
            </div>
        </div>
    <?php
    }
    ?>
    </div>

=======
                    <button class="eliminar">Eliminar</button>
                </a>
            </td>
        </tr>


        <?php
        }
        ?>
    </table>
    
>>>>>>> e1d9758a8457b32ed3fcd9a07a975f50300b5ef0:sistema/users.php
    <script src="app.js"></script>
</body>
</html>
