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
            <a href="../salir.php"><img src="../img/power.png" alt="salir"></a>
        </div>

        <div class="add-sneaker">
            <a href="nuevoSneaker.html">
                <i class="fas fa-plus"></i>
            </a>
        </div>
    </header>
    <div class="side-menu" id="side-menu">
        <header>Categorias
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
                    <button class="eliminar">Eliminar</button>
                </a>
            </div>
        </div>
    <?php
    }
    ?>
    </div>

    <script src="app.js"></script>
</body>
</html>
