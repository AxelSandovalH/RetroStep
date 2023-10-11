<?php
require_once "../conexion.php";
$sql = "SELECT * from sneakers";
$result = mysqli_query($connection, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Encabezado HTML y estilos -->
</head>
<body>
    <header class="header">
        <!-- Encabezado -->
    </header>
    <div class="side-menu" id="side-menu">
        <!-- Menú lateral -->
    </div>

    <div class="TablaContainerSneakers">
        <table class="TablaSneakers" id="sneakersTable">
            <tr class="Encabezado">
                <th colspan="7">Sneakers
                    <a href="./nuevoSneaker.html">
                        <button class="add">+</button>
                    </a>
                </th>
            </tr>
            <tr>
                <td>Modelo</td>
                <td>Marca</td>
                <td>Talla</td>
                <td>Precio</td>
                <td>Stock</td>
            </tr>
            <?php
            while ($column = mysqli_fetch_array($result)) {
                ?>
                <tr>
                    <td><?php echo $column['Modelo'] ?></td>
                    <td><?php echo $column['Marca'] ?></td>
                    <td><?php echo $column['Size'] ?></td>
                    <td><?php echo $column['Precio'] ?></td>
                    <td><?php echo $column['Stock'] ?></td>
                    <td>
                        <a class="link_editar" href="editSneaker.php?id=<?php echo $column['id'] ?>">
                            <button class="editar">Editar</button>
                        </a>
                    </td>
                    <td>
                        <a class="link_borrar" href="deleteSneaker.php?id=<?php echo $column['id']; ?>">
                            <button class="eliminar">Eliminar</button>
                        </a>
                    </td>
                </tr>
                <?php
            }
            ?>
        </table>
    </div>
    <!-- JavaScript y cierre del cuerpo y HTML -->
</body>
</html>
