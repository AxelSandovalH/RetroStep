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

//Espera
if(!empty($_POST)){
 $id = $_POST['idSneaker'];

 $queryDelete = mysqli_query($connection, 
 "DELETE FROM sneakers
  WHERE 
  id = $id");

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

    $id = $_REQUEST['id'];
    $query = mysqli_query($connection, 
    
    "SELECT * from sneakers WHERE 
    id = $id;");
    
    $result = mysqli_num_rows($query);

    if($result > 0){
        while($column = mysqli_fetch_array($query)){
            $modelo = $column["Modelo"];
            $marca = $column["Marca"];
            $precio = $column["Precio"];
            $stock = $column["Stock"];
            $size = $column["Size"];
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
            <h2><a href="../salir.php">Salir</a></h2>
        </div>
       
        
    </header>

    <section id="container">
        <div class="borrarDato">
            <h2>¿Estás seguro que quieres borrar el siguiente sneaker?</h2>
            <p><span>Modelo: <?php echo $modelo; ?></span></p>
            <p><span>Marca: <?php echo $marca; ?></span></p>
            <p><span>Precio: <?php echo $precio; ?></span></p>
            <p><span>Stock: <?php echo $stock; ?></span></p>

            <form method="post" action="">
                <input type="hidden" name ="idSneaker" value = "<?php echo $id?>">
                <a href="main.php" class = "btnCancelar">Cancelar</a>
                <input type="submit" value="Aceptar" class="btnAceptar">
            </form>
        </div>
    </section>


