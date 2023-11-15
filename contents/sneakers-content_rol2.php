<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://kit.fontawesome.com/c7fad14ccd.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/styleSneakers.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sneakers</title>
</head>
<body>
    <div class="tab">
        <label class="tab-label" for="filterTab"><i class="fa-solid fa-chevron-down"></i></label>
        <input type="checkbox" id="filterTab" class="tab-checkbox">
        <div class="filter-container">
            <!-- Agrega tus etiquetas de filtro aquí -->
        </div>
    </div>

    <div class="TablaContainerSneakers">
        <?php
        require_once "connection.php";
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

                
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</body>
</html>
