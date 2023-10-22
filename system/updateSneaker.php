<?php 

    require_once "../connection.php";             // Establecer conexión a la base de datos
    //Se elimina la necesidad de escribir las variables de conexión poniendo un "require"


    // Protección de rutas
    session_start();

    if(empty($_SESSION['active'])){
        header('location: ../');
    }


    if(!empty($_POST))
    {
        $alert = '';
        if(empty($_POST['Modelo']) || empty($_POST['Marca']) || empty($_POST['Precio']) || empty($_POST['Stock']) || empty($_POST['Size'])){
            $alert = '<p class="msg_error">Todos los campos son obligatorios</p>';
        }else{
            $id_modelo = $_POST['id'];
            $modelo = $_POST['Modelo'];
            $marca = $_POST['Marca'];
            $precio = $_POST['Precio'];
            $stock = $_POST['Stock'];
            $size = $_POST['Size'];

            $query = mysqli_query($connection, " SELECT * FROM sneakers WHERE (Modelo = '$modelo' AND id != '$id_modelo') ");
            $result = mysqli_fetch_array($query);

            if($result > 0){
                
                $alert = '<p class="msg_error">El modelo ya existe.</p>';

            }else{

                $sql_update = mysqli_query($connection, "UPDATE sneakers
                                                            SET Modelo = '$modelo', Marca = '$marca', Precio = '$precio', Stock = '$stock', `Size` = '$size' 
                                                            WHERE id = $id_modelo ");

            }
            if($sql_update){
                $alert = '<p class="msg_save">Datos actualizados correctamente.</p>';
            }else{
                $alert = '<p class="msg_error">Error al actualizar los datos.</p>';
            }
        }
    }
    
    
    //Recopilar los datos a editar
    if(empty($_GET['id'])){
        header('location: ../');
    }
    $idSneaker = $_GET['id'];
    $sql = mysqli_query($connection, "SELECT s.id, s.Modelo, s.Marca, s.Size, s.Stock, s.Precio
                                        FROM sneakers s
                                        WHERE id = $idSneaker");
    $result_sql = mysqli_num_rows($sql);

    if($result_sql == 0){
        header('location: ../');
    }else{
        while($data = mysqli_fetch_array($sql)){
            $id_modelo = $data['id'];
            $modelo = $data['Modelo'];
            $marca = $data['Marca'];
            $precio = $data['Precio'];
            $stock = $data['Stock'];
            $size = $data['Size'];
        }
    }

?>




<!DOCTYPE html>
<html lang="en">
<head>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../CSS/styleNuevoSneaker.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Sneaker</title>
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
        <header>Update Sneaker</header>
        
        <form action="add_sneakers.php" method="post">
            <input type="hidden" name="idSneaker" value="<?php echo $id_modelo; ?>">
            <label for="Modelo">Modelo</label>
            <input name="Modelo" type="text" value="<?php echo $modelo; ?>" required>
            <label for="Marca">Marca</label>
            <input name="Marca" type="text" value="<?php echo $marca; ?>" required>
            <label for="Precio">Precio</label>
            <input name="Precio" type="number" value="<?php echo $precio; ?>" required>
            <label for="Stock">Stock</label>
            <input name="Stock" type="number" value="<?php echo $stock; ?>" required>
            <label for="Size">Size</label>
            <input type="number" name="Size"  value="<?php echo $size; ?>"required>
            <!-- <select name="Size" type="number">
                <option value="3">3</option>
                <option value="3.5">3.5</option>
                <option value="4">4</option>
                <option value="4.5">4.5</option>
                <option value="5">5</option>
                <option value="5.5">5.5</option>
                <option value="6">6</option>
                <option value="6.5">6.5</option>
                <option value="7">7</option>
                <option value="7.5">7.5</option>
                <option value="8">8</option>
                <option value="8.5">8.5</option>
                <option value="9">9</option>
                <option value="9.5">9.5</option>
                <option value="10">10</option>
                <option value="10.5">10.5</option>
                <option value="11">11</option>
                <option value="11.5">11.5</option>
                <option value="12">12</option>
                <option value="13">13</option>
                <option value="14">14</option>
            </select>
            
     -->
            
            <a href="./main.php" id="Cancelar">Cancelar</a>
            
            <button type="submit"  id="Succes">Actualizar</button>
        </form>
    </div>
    
    
    <script src="app.js"></script>
</body>
</html>