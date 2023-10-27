<?php 
// Protección de rutas
session_start();

if(empty($_SESSION['active'])){
    header('location: ../');

}
?>

<?php
require_once "../../connection.php"; //Se elimina la necesidad de escribir las variables de conexión poniendo un "require"


// Espera a que haya una acción tipo POST para realizar la verificación 
if(!empty($_POST)){
    // $sneaker_id = $_POST['sneaker_id'];
    $brand_name = $_POST["brand_name"];

    $querySelect = mysqli_query($connection, 
    "SELECT * FROM brand 
    WHERE (brand_name = '$brand_name');");

    $result = mysqli_fetch_array($querySelect);

    if($result > 0){
        echo '<p class ="msgError">Esa marca ya existe</p>';
    }
    else{

        $queryInsert = mysqli_multi_query($connection, 
        "INSERT INTO brand (brand_name) VALUES ('$brand_name');");
            
            if($queryInsert){
                header("location: main.php");
            }
            else{
                echo "Error: " . mysqli_error($connection);
                echo "Filas afectadas: " . mysqli_affected_rows($connection);

            }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href=" ../../CSS/admin/styleNewBrand.css ">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar marca</title>
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
        <header>Agregar Marca</header>
        
        <form action="" method="post" onsubmit="return confirmBrandAdd();">
            <label for="Marca">Marca</label>
            <input name="brand_name" type="text" required>
           
            <button type="reset" id="Cancelar"><a href="main.php">Cancelar</a></button>
            
            <button type="submit" id="Succes">Agregar</button>
        </form>
    </div>
    
    <script>
    function confirmBrandAdd() {
        var brandName = document.getElementById("brand_name").value;

        if (brandName === "") {
            alert("Por favor, ingresa el nombre de la marca.");
            return false;
        }

        return confirm("¿Estás seguro de que deseas agregar la marca '" + brandName + "'?");
    }
    </script>

</body>
</html>