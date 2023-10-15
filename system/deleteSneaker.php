<?php 
// Protección de rutas
session_start();

if(empty($_SESSION['active'])){
    header('location: ../');

}
?>

<?php 

require_once "../connection.php"; //Se elimina la necesidad de escribir las variables de conexión poniendo un "require"
                                // Establecer conexión a la base de datos

//Espera
if(!empty($_POST)){
 $sneaker_id = $_POST['sneaker_id'];

 $queryDelete = mysqli_query($connection, 
 "UPDATE sneaker
  SET deleted_at = CURRENT_TIMESTAMP
  WHERE 
  sneaker_id = $sneaker_id");

    if($queryDelete){
        header("location: main.php");
    }
    else{
        echo("Error al eliminar");
    }
}

if(empty($_REQUEST['id'])){
    header("location: main.php");
}

else{

    $sneaker_id = $_REQUEST['id'];
    $query = mysqli_query($connection, 
    
    "SELECT * from sneaker
    INNER JOIN stock
    ON sneaker.sneaker_id = stock.sneaker_id
    WHERE sneaker.sneaker_id = $sneaker_id AND stock.sneaker_id = $sneaker_id");
    
    $result = mysqli_num_rows($query);

    if($result > 0){
        while($column = mysqli_fetch_array($query)){

            $sneaker_name = $column["sneaker_name"];
            $brand_name = $column["brand_name"];
            $price = $column["price"];
            $stock_quantity = $column["stock_quantity"];
            $size_number = $column["size_number"];
        }
    }
    else{
        header("location: main.php");
    }
    
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../CSS/styleDeleteSneaker.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Sneaker</title>
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
       
        
    </header>

    <section id="container">
        <div class="borrarDato">
            <h2>¿Estás seguro que quieres borrar el siguiente sneaker?</h2>
            <p><span>Modelo: <?php echo $sneaker_name; ?></span></p>
            <p><span>Marca: <?php echo $brand_name; ?></span></p>
            <p><span>Precio: <?php echo $price; ?></span></p>
            <p><span>Stock: <?php echo $stock_quantity; ?></span></p>

            <form method="post" action="">
                <input type="hidden" name ="sneaker_id" value = "<?php echo $sneaker_id?>">
                <a href="main.php" class = "btnCancelar">Cancelar</a>
                <input type="submit" value="Aceptar" class="btnAceptar">
            </form>
        </div>
    </section>


