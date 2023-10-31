<?php 
include("../scripts/routeProtection.php");


// Espera a que haya una acción tipo POST para realizar la verificación 
if(!empty($_POST)){
    // $sneaker_id = $_POST['sneaker_id'];
    $sneaker_name = $_POST["sneaker_name"];
    $brand_name = $_POST["brand_name"];
    $price = $_POST["price"];
    $stock_quantity = $_POST["stock_quantity"];
    $size_number = $_POST["size_number"];
    $category_name = $_POST["category_name"];
    $nombre_imagen = $_FILES['imagen']['name'];
    $temporal = $_FILES['imagen']['tmp_name'];
    $carpeta = "../img";
    $ruta = $carpeta . '/' . $nombre_imagen;
    move_uploaded_file($temporal, $carpeta . '/' . $nombre_imagen);

    $querySelect = mysqli_query($connection, 
    "SELECT * FROM sneaker 
    WHERE (sneaker_name = '$sneaker_name')");

    $result = mysqli_fetch_array($querySelect);

    if($result > 0){
        echo '<p class ="msgError">Ese modelo ya existe</p>';
    }
    else{

        $queryInsert = mysqli_multi_query($connection, 
        "INSERT INTO brand (brand_name) VALUES ('$brand_name')
        ON DUPLICATE KEY UPDATE brand_name = '$brand_name';
        
        INSERT INTO size (size_number) VALUES ($size_number)
        ON DUPLICATE KEY UPDATE size_number = $size_number;

        INSERT INTO category (category_name) VALUES ('$category_name')
        ON DUPLICATE KEY UPDATE category_name = '$category_name';
        
        INSERT INTO sneaker (brand_name, sneaker_name, price, size_number, category_name, imagen_url) VALUES ('$brand_name', '$sneaker_name', $price, $size_number, '$category_name', '$ruta');
        -- Obtener el 'sneaker_id' recién generado
        SET @sneaker_id = LAST_INSERT_ID();

        -- Insertar en la tabla 'stock' con 'sneaker_id' y 'stock_quantity'
        INSERT INTO stock (sneaker_id, stock_quantity, size_number) VALUES (@sneaker_id, $stock_quantity, $size_number);");
       

            
            if($queryInsert){
                header("location: main.php");
            }
            else{
                echo "Error: " . mysqli_error($connection);
                echo "Filas afectadas: " . mysqli_affected_rows($connection);

            }
    }
}
// $query = mysqli_query($connection, 

// "SELECT * from sneaker
// INNER JOIN stock
// ON sneaker.sneaker_id = stock.sneaker_id
// WHERE sneaker.sneaker_id = $sneaker_id AND stock.sneaker_id = $sneaker_id");

// $result = mysqli_num_rows($query);

// if($result > 0){
//     while($column = mysqli_fetch_array($query)){

//         $sneaker_name = $column["sneaker_name"];
//         $brand_name = $column["brand_name"];
//         $price = $column["price"];
//         $stock_quantity = $column["stock_quantity"];
//         $size_number = $column["size_number"];
//     }
// }
// else{
//     header("location: main.php");
// }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../CSS/styleNewSneaker.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Sneaker</title>
</head>
<body>
    <header class="header">
        
        <a href="#" id="menu" class="menu-icon">
            <i class="fas fa-bars"></i>
        </a>
        
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
       
        
    </header>
    <div class="side-menu" id="side-menu">
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
    </div>
    <div id="addSneaker">
    <header>Agregar sneaker</header>

    <form action="" method="post" enctype="multipart/form-data">
        <div class="column">
            <label for="Modelo">Modelo</label>
            <input name="sneaker_name" type="text" required>
            <label for="brand_name">Marca</label>
                <select name="brand_name" required>
                    <?php
                        $sql_categories = "SELECT brand_name FROM brand";
                        $result_categories = mysqli_query($connection, $sql_categories);
                        
                        if (mysqli_num_rows($result_categories) > 0) {
                            while ($row = mysqli_fetch_assoc($result_categories)) {
                                $brand_option = $row['brand_name'];
                                $selected = ($brand_option == $brand_name) ? "selected" : "";
                                echo "<option value='$brand_option' $selected>$brand_option</option>";
                            }
                        } else {
                            echo "<option value=''>No hay marcas disponibles</option>";
                        }
                    ?>
                </select>
            <label for="Precio">Precio</label>
            <input name="price" type="number" required>
            <label for="Stock">Stock</label>
            <input name="stock_quantity" type="number" required>
        </div>

        <div class="columnR">
          <label for="Size">Size</label>
                <select name="size_number" required>
                    <?php
                        $sql_sizes = "SELECT size_number FROM size";
                        $result_sizes = mysqli_query($connection, $sql_sizes);
                        
                        if (mysqli_num_rows($result_sizes) > 0) {
                            while ($row = mysqli_fetch_assoc($result_sizes)) {
                                $size_option = $row['size_number'];
                                $selected = ($size_option == $size_number) ? "selected" : "";
                                echo "<option value='$size_option' $selected>$size_option</option>";
                            }
                        } else {
                            echo "<option value=''>No hay tallas disponibles</option>";
                        }
                    ?>
                </select>
            <label for="Category">Category</label>
                <select name="category_name" required>
                    <?php
                        $sql_categories = "SELECT category_name FROM category";
                        $result_categories = mysqli_query($connection, $sql_categories);
                        
                        if (mysqli_num_rows($result_categories) > 0) {
                            while ($row = mysqli_fetch_assoc($result_categories)) {
                                $cat_option = $row['category_name'];
                                $selected = ($cat_option == $cat_name) ? "selected" : "";
                                echo "<option value='$cat_option' $selected>$cat_option</option>";
                            }
                        } else {
                            echo "<option value=''>No hay categorías disponibles</option>";
                        }
                    ?>
                </select>

            <label for="imagen">Imagen</label>
            <input type="file" name="imagen">
        </div>
    </form>
    <div class="buttons">
            <button type="reset" id="Cancelar" href="main.php">Cancelar</button>
            <button type="submit" id="Succes">Agregar</button>
    </div>
</div>

    
    
    <script src="app.js"></script>
</body>
</html>