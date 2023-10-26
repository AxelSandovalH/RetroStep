<?php 
// Protección de rutas
session_start();

if(empty($_SESSION['active'])){
    header('location: ../');

}
?>

<?php

require_once "../conexion.php"; //Se elimina la necesidad de escribir las variables de conexión poniendo un "require"
// Establecer conexión a la base de datos


// Valida la existencia de algún campo que ocasione conflicto
if(!empty($_POST)){

    $idS = $_POST["idSneaker"];
    $modelo = $_POST["Modelo"];
    $marca = $_POST["Marca"];
    $precio = $_POST["Precio"];
    $stock = $_POST["Stock"];
    $size = $_POST["Size"];

    $query = mysqli_query($connection, 
    "SELECT * FROM sneakers 
    WHERE (id != $idS AND  Modelo = '$modelo')");

    $result = mysqli_fetch_array($query);

    if($result > 0){
        echo '<p class="msgError">Ese modelo ya existe</p>';
    }

    // Si pasa la validación, procede a capturar los datos.
    else{

        $sql_update = mysqli_query($connection, 
        "UPDATE sneakers
        SET
        Modelo = '$modelo',
        Marca = '$marca',
        Precio = $precio,
        Stock = $stock,
        Size = $size
        
        WHERE id = $idS ");

        if($sql_update){
            echo "<p>Sneaker actualizado correctamente.</p>";
            header("location: main.php");
        }
        else{
            echo "<p>Error al modificar sneaker.</p>";

        }
    }

    
}

// Valida que el id en la url exista o tenga valor
if(empty($_GET['id'])){

    header("location: main.php");

}

$idSneaker = $_GET['id'];

$sql = mysqli_query($connection, 
"SELECT s.Modelo, s.Marca, s.Precio, s.Stock, s.Size 
FROM sneakers s
WHERE id = $idSneaker");

// Valida que existan columnas con información dentro de la BD

$result_sql = mysqli_num_rows($sql);

if($result_sql == 0){
    header("location: main.php");
}
else{

    while($column = mysqli_fetch_array($sql)){
        $modelo = $column["Modelo"];
        $marca = $column["Marca"];
        $precio = $column["Precio"];
        $stock = $column["Stock"];
        $size = $column["Size"];
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../CSS/styleEditarSneaker.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Sneaker</title>
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
        <header>Editar sneaker</header>
        
        <form action="" method="post">
            <input type="hidden" name="idSneaker" value="<?php echo $idSneaker; ?>" >
            <label for="Modelo">Modelo</label>
            <input name="Modelo" type="text" id="Modelo" value="<?php echo $modelo; ?>" required >
            <label for="Marca">Marca</label>
            <input name="Marca" type="text" id="Marca" value="<?php echo $marca; ?>" required>
            <label for="Precio">Precio</label>
            <input name="Precio" type="number" id="Precio" value="<?php echo $precio; ?>" required>
            <label for="Stock">Stock</label>
            <input name="Stock" type="number" id="Stock" value="<?php echo $stock; ?>" required>
            <label for="Size">Size</label>
            <select name="Size" value="<?php echo $size; ?>" required>
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
           
            
            <button type="" id="Cancelar"><a href="main.php">Cancelar</a></button>
            
            <button type="submit"  id="Succes">Actualizar sneaker</button>
        </form>
    </div>
    
    
    <script src="app.js"></script>
</body>
</html>
