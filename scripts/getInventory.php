<?php
    require_once "../connection.php";
    $sql = "SELECT stock.*, sneaker.sneaker_name, sneaker.brand_name, sneaker.price
            FROM stock
            INNER JOIN sneaker ON stock.sneaker_id = sneaker.sneaker_id
            WHERE stock.deleted_at IS NULL
            ORDER BY stock.updated_at DESC
            LIMIT 7;";
    $result = mysqli_query($connection, $sql);

    while ($column = mysqli_fetch_array($result)) {
    ?>
    <tr>
        <td><?php echo $column['sneaker_name']; ?></td>
        <td><?php echo $column['brand_name']; ?></td>
        <td><?php echo $column['size_number']; ?></td>
        <td><?php echo $column['price']; ?></td>
        <td><?php echo $column['stock_quantity']; ?></td>
    </tr>
<?php } ?>
