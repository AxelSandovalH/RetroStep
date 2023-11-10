<?php
    require_once "../connection.php";
    $sql = "SELECT * from sneaker
            INNER JOIN stock
            ON sneaker.sneaker_id = stock.sneaker_id
            WHERE deleted_at IS NULL
            ORDER BY sneaker.updated_at DESC;";
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