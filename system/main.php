<?php 
include ("../scripts/routeProtection.php");
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
        <i class="fa-regular fa-user fa-shake" style="color: #ffffff;"></i>
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

    <div class="filter-container">
    <label for="brand-filter">Marca:</label>
    <select id="brand-filter">
        <option value="">Todas las marcas</option>
        <?php
        require_once "../connection.php";
        $sql = "SELECT DISTINCT brand_name FROM sneaker WHERE deleted_at IS NULL";
        $result = mysqli_query($connection, $sql);

        while ($row = mysqli_fetch_assoc($result)) {
            $brandName = $row['brand_name'];
            echo "<option value='$brandName'>$brandName</option>";
        }
        ?>
    </select>
    
    <label for="size-filter">Talla:</label>
    <select id="size-filter">
        <option value="">Todas las tallas</option>
        <?php
        require_once "../connection.php";
        $sql = "SELECT DISTINCT size_number FROM size";
        $result = mysqli_query($connection, $sql);

        while ($row = mysqli_fetch_assoc($result)) {
            $sizeNumber = $row['size_number'];
            echo "<option value='$sizeNumber'>$sizeNumber</option>";
        }
        ?>
    </select>

    <label for="model-filter">Modelo:</label>
    <select id="model-filter">
        <option value="">Todos los modelos</option>
        <?php
        require_once "../connection.php";
        $sql = "SELECT DISTINCT sneaker_name FROM sneaker WHERE deleted_at IS NULL";
        $result = mysqli_query($connection, $sql);

        while ($row = mysqli_fetch_assoc($result)) {
            $sneakerName = $row['sneaker_name'];
            echo "<option value='$sneakerName'>$sneakerName</option>";
        }
        ?>
    </select>

    <label for="category-filter">Categoría:</label>
    <select id="category-filter">
        <option value="">Todas las categorías</option>
        <?php
        require_once "../connection.php";
        $sql = "SELECT DISTINCT category_name FROM sneaker WHERE deleted_at IS NULL";
        $result = mysqli_query($connection, $sql);

        while ($row = mysqli_fetch_assoc($result)) {
            $categoryName = $row['category_name'];
            echo "<option value='$categoryName'>$categoryName</option>";
        }
        ?>
    </select>

    <label for="search-input">Búsqueda:</label>
    <input type="text" id="search-input" placeholder="Buscar...">
    <button id="search-button">Buscar</button>
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
                <a class="link_borrar" href="deleteSneaker.php?sneaker_id=<?php echo $column['sneaker_id']; ?>&confirmed=yes" onclick="return confirm('¿Seguro que quieres borrar la zapatilla con Modelo: <?php echo $column['sneaker_name']; ?>, Marca: <?php echo $column['brand_name']; ?>, Talla: <?php echo $column['size_number']; ?>?')">
    <button class="eliminar">Eliminar</button>
</a>


            </div>
        </div>
    <?php
    }
    ?>
    </div>


    <div class="container">
        <input type="checkbox" id="btn-mas">
        <div class="options">
            <a href="newSneaker.php" class="edit"></a>
            <a href="#" class="add brand"></a>
            <a href="#" class="add size"></a>
            <a href="#" class="add model"></a>
        </div>
        <div class="btn-mas">
            <label for="btn-mas" class="fa fa-plus"></label>
        </div>
    </div>
    <script src="app.js"></script>
</body>
</html>
