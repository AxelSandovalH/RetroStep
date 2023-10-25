<?php 
// Protección de rutas
session_start();

if(empty($_SESSION['active'])){
    header('location: ../');

}
?>

<?php
require_once "../connection.php"; //Se elimina la necesidad de escribir las variables de conexión poniendo un "require"


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
            <label for="Modelo">Modelo</label>
            <input name="sneaker_name" type="text" required>
            <label for="Marca">Marca</label>
            <input name="brand_name" type="text" required>
            <label for="Precio">Precio</label>
            <input name="price" type="number" required>
            <label for="Stock">Stock</label>
            <input name="stock_quantity" type="number" required>
            <label for="Size">Size</label>
            <select name="size_number" required>
                <option value="6.0">6.0</option>
                <option value="6.5">6.5</option>
                <option value="7.0">7.0</option>
                <option value="7.5">7.5</option>
                <option value="8.0">8.0</option>
                <option value="8.5">8.5</option>
                <option value="9.0">9.0</option>
                <option value="9.5">9.5</option>
                <option value="10.0">10.0</option>
                <option value="10.5">10.5</option>
                <option value="11.0">11.0</option>
                <option value="11.5">11.5</option>
                <option value="12.0">12.0</option>
                <option value="12.5">12.5</option>
                <option value="13.0">13.0</option>
            </select>
            <label for="Category">Category</label>
            <input type="text" name="category_name" required>
            <label for="imagen">Imagen</label>
            <input type="file" name="imagen">
            
            <button type="reset" id="Cancelar"><a href="main.php">Cancelar</a></button>
            
            <button type="submit" id="Succes">Agregar</button>
        </form>
    </div>
    
    
    <script src="app.js"></script>
</body>
</html>