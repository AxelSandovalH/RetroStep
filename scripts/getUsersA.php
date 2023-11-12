<?php
    require_once "../connection.php";
    $sql = "SELECT username, rol, email, deleted_at from users
            WHERE deleted_at IS NOT NULL
            ORDER BY users.updated_at DESC;";
    $result = mysqli_query($connection, $sql);

    while ($column = mysqli_fetch_array($result)) {
    ?>
    <tr>
        <td><?php echo $column['username']; ?></td>
        <td><?php echo $column['rol']; ?></td>
        <td><?php echo $column['email']; ?></td>
        <td><?php echo $column['deleted_at']; ?></td>
        <td><button class="btn btn-outline-secondary">Restore</button></td>
        <td><button class="btn btn-outline-danger">Delete</button></td>
    </tr>
<?php } ?>