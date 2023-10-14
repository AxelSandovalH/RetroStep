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
    <link rel="stylesheet" href="../CSS/styleMain.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <header class="header">
        
        <a href="#" id="menu" class="menu-icon">
            <i class="fas fa-bars"></i>
        </a>
        
        <div>
            <a href="../index.php">
                <h1 class="Titulo">
                    RetroStep
                </h1>
            </a>
           
        </div>
        
        <div class="exitBtn">
            <a href="../exit.php"><img src="../img/power.png" alt="exit"></a>
        </div>
       
        
    </header>
    <div class="side-menu" id="side-menu">
        <header >Categorias
            <button id="x">
                x
            </button>
        </header>
        <hr>
        <ul>
            <li><a href="#">Lujo</a></li>
            <li><a href="#">LifeStyle</a></li>
            <li><a href="#">Futbol</a></li>
            <li><a href="#">Basquetball</a></li>
            <li><a href="#">Running</a></li>
            <li><a href="#">Tenis</a></li>
        </ul>
    </div>
<!-- Aquí se agrega la tabla de los tenis -->
    
<div class="TablaContainerSneakers">
    <table class="TablaSneakers" id="sneakersTable">
        <tr class="Encabezado">
            <th colspan="7">Sneakers
                <a href="./nuevoSneaker.html">
                    <button class="add">
                        +
                    </button>
                </a>
            
        </th>
        </tr>
        <tr>
            <td>Modelo</td>
            <td>Marca</td>
            <td>Talla</td>
            <td>Precio</td>
            <td>Stock</td>
        </tr>

        <?php
            require_once "../connection.php";
            $sql ="SELECT * from sneakers";
            $result=mysqli_query($connection,$sql);

            while($column=mysqli_fetch_array($result)){
        ?>
        <!-- ... (código HTML anterior) ... -->

        <tr>
            <td><?php echo $column['Modelo']?></td>
            <td><?php echo $column['Marca']?></td>
            <td><?php echo $column['Size']?></td>
            <td><?php echo $column['Precio']?></td>
            <td><?php echo $column['Stock']?></td>
            <td>
                <a class="link_editar" href="editSneaker.php?id=<?php echo $column['id']?>">
                    <button class="editar">Editar</button>
                </a>
            </td>
            <td>
                <!-- Se crea un href con el link del archivo php y el dato que se mandará (id) -->
                <a class="link_borrar" href = "deleteSneaker.php?id=<?php echo $column['id']; ?>">
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