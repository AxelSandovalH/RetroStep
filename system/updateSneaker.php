<?php
include ("../scripts/routeProtection.php");

if (!empty($_POST)) {
    $alert = '';
    if (empty($_POST['sneaker_name']) || empty($_POST['brand_name']) || empty($_POST['price']) || empty($_POST['stock_quantity']) || empty($_POST['size_number'])) {
        $alert = '<p class="msg_error">Todos los campos son obligatorios</p>';
    } else {
        $sneaker_id = $_POST['sneaker_id'];
        $sneaker_name = $_POST['sneaker_name'];
        $brand_name = $_POST['brand_name'];
        $price = $_POST['price'];
        $stock_quantity = $_POST['stock_quantity'];
        $size_number = $_POST['size_number'];

        $query = mysqli_query($connection, "SELECT * from sneaker
        WHERE sneaker_name = '$sneaker_name' AND sneaker_id != $sneaker_id");
        $result = mysqli_fetch_array($query);

        if ($result > 0) {
            $alert = '<p class="msg_error">El modelo ya existe.</p>';
        } else {
            // Verificar si la nueva talla ($size_number) existe en la tabla "size"
            $sql_check_size = "SELECT size_number FROM size WHERE size_number = $size_number";
            $result_size = mysqli_query($connection, $sql_check_size);

            if (mysqli_num_rows($result_size) > 0) {
                // La talla existe, entonces podemos continuar con la actualización
                $sql_update_sneaker = "UPDATE sneaker 
                SET sneaker_name = '$sneaker_name', brand_name = '$brand_name', price = $price, size_number = $size_number
                WHERE sneaker_id = $sneaker_id";

                $sql_update_stock = "UPDATE stock 
                SET stock_quantity = $stock_quantity, size_number = $size_number 
                WHERE sneaker_id = $sneaker_id";

                // Iniciar una transacción para garantizar que ambas actualizaciones se realicen o ninguna
                mysqli_begin_transaction($connection);

                // Ejecutar las consultas de actualización
                if (mysqli_query($connection, $sql_update_sneaker) && mysqli_query($connection, $sql_update_stock)) {
                    mysqli_commit($connection);
                    $alert = '<p class="msg_save">Datos actualizados correctamente.</p>';
                } else {
                    mysqli_rollback($connection);
                    $alert = '<p class="msg_error">Error al actualizar los datos: ' . mysqli_error($connection) . '</p>';
                }
            } else {
                // La talla no existe en la tabla "size," mostrar un mensaje de error
                $alert = '<p class="msg_error">La talla especificada no existe en la tabla "size."</p>';
            }
        }
    }
}

// Recopilar los datos a editar
if (empty($_GET['sneaker_id'])) {
    header('location: ../');
}

$idSneaker = $_GET['sneaker_id'];
$sql = mysqli_query($connection, "SELECT * from sneaker
                                    INNER JOIN stock
                                    ON sneaker.sneaker_id = stock.sneaker_id
                                    WHERE sneaker.sneaker_id = $idSneaker;");
$result_sql = mysqli_num_rows($sql);

if ($result_sql == 0) {
    header('location: ../');
} else {
    while ($column = mysqli_fetch_array($sql)) {
        $sneaker_id = $column['sneaker_id'];
        $sneaker_name = $column['sneaker_name'];
        $brand_name = $column['brand_name'];
        $price = $column['price'];
        $stock_quantity = $column['stock_quantity'];
        $size_number = $column['size_number'];
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../CSS/styleEditSneaker.css">
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
        <div class="alert"><?php echo isset ($alert) ? $alert : '';  ?></div>

        <form action="" method="post">
            <div class="column">
                <input type="hidden" name="sneaker_id" value="<?php echo $sneaker_id; ?>">
                <label for="Modelo">Modelo</label>
                <input name="sneaker_name" type="text" value="<?php echo $sneaker_name; ?>" readonly>
                <label for="Marca">Marca</label>
                <select name="brand_name" required>
                    <?php
                        $sql_brands = "SELECT brand_name FROM brand";
                        $result_brands = mysqli_query($connection, $sql_brands);
                    
                        if (mysqli_num_rows($result_brands) > 0) {
                            while ($row = mysqli_fetch_assoc($result_brands)) {
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
                <input name="price" type="number" value="<?php echo $price; ?>" required>
            </div>
            
            <div class="columnR">
                <label for="Stock">Stock</label>
                <input name="stock_quantity" type="number" value="<?php echo $stock_quantity; ?>" required>
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

                <div class="buttons">
                    <button type="reset" id="Cancelar"><a href="main.php"><i class="fa-regular fa-circle-xmark"></i> Cancelar</a></button>
                    <button type="submit" id="Succes">Actualizar</button>
                </div>
            </div>    
        </form>
    </div>
    
    
    <script src="app.js"></script>
</body>
</html>