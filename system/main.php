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

        <div class="add-sneaker">
            <a href="newSneaker.php">
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

        <header>Administrador</header>
        <hr>
        <ul>
            <li><a href="users.php">Usuarios</a></li>
        </ul>
    </div>

    <div class="TablaContainerSneakers">
    <?php
    require_once "../connection.php";
    $sql = "SELECT * from sneaker
            INNER JOIN stock
            ON sneaker.sneaker_id = stock.sneaker_id
            WHERE deleted_at IS NULL;";
    $result = mysqli_query($connection, $sql);

    while ($column = mysqli_fetch_array($result)) {
    ?>
        <div class="sneaker-card">
            <div class="sneaker-image">
                <img src="<?php echo $column['imagen_url']; ?>" alt="Imagen del sneaker">
            </div>
            <div class="sneaker-info">
                <h2>Modelo: <?php echo $column['sneaker_name']; ?></h2>
                <p>Marca: <?php echo $column['brand_name']; ?></p>
                <p>Talla: <?php echo $column['size_number']; ?></p>
                <p>Precio: <?php echo $column['price']; ?></p>
                <p>Stock: <?php echo $column['stock_quantity']; ?></p>
            </div>
            <div class="sneaker-actions">

                <a class="link_editar" href="updateSneaker.php?sneaker_id=<?php echo $column['sneaker_id']; ?>">
                    <button class="editar">Editar</button>
                </a>
                <a class="link_borrar" href="deleteSneaker.php?id=<?php echo $column['sneaker_id']; ?>" onclick="return confirm('¿Estás seguro de que deseas eliminar este registro?');">
                     <button class="eliminar">Eliminar</button>  <!-- Corregir posible error con lógica de confirm -->
                </a>


            </div>
        </div>
    <?php
    }
    ?>
    </div>


    <a href="newSneaker.php" class="add-sneaker-button">
        <i class="fas fa-plus"></i>
    </a>
    <script src="app.js"></script>
</body>
</html>
