<?php
    require_once "../connection.php";
    $sql = "SELECT * from sneaker
            INNER JOIN stock
            ON sneaker.sneaker_id = stock.sneaker_id
            WHERE deleted_at IS NOT NULL
            ORDER BY sneaker.deleted_at DESC;";
    $result = mysqli_query($connection, $sql);

    while ($column = mysqli_fetch_array($result)) {
    ?>
    <tr data-sneaker-id="<?php echo $column['sneaker_id']; ?>">
        <td><?php echo $column['sneaker_id']; ?></td>
        <td><?php echo $column['sneaker_name']; ?></td>
        <td><?php echo $column['brand_name']; ?></td>
        <td><?php echo $column['size_number']; ?></td>
        <td><?php echo $column['price']; ?></td>
        <td><?php echo $column['deleted_at']; ?></td>
        <td><button id="restoreSneakerBtn" class="btn btn-outline-secondary">Restore</button></td>
        <td><button id="deleteSneakerBtn" class="btn btn-outline-danger">Delete from database</button></td>
    </tr>
<?php } ?>
<script>
    function updateArchivedInventoryTable() {
        // AJAX para obtener la tabla sin refrescar
        $.ajax({
            type: "GET",
            url: "scripts/getInventoryA.php",
            success: function (response) {
                // Actualiza la tabla con la nueva información
                $('#aSneakerTable tbody').html(response);
            },
            error:function(error){
                console.error(error);
            }
        });
    }

     $(document).ready(function () {
        $("#aSneakerTable").off('click', '#restoreSneakerBtn').on('click', '#restoreSneakerBtn', function () {
            let id = $(this).closest("tr").data("sneaker-id"); // O data("user-id") para usuarios
            $.ajax({
                type: "POST",
                url: "scripts/restoreSneaker.php", // Ruta al script que maneja la restauración
                data: { sneaker_id: id },
                success: function (response) {
                    // Manejar la respuesta si es necesario
                    alert(response);
                    updateArchivedInventoryTable()
                }
            });
        });

        

        $("#aSneakerTable").off('click', '#deleteSneakerBtn').on('click', '#deleteSneakerBtn', function () {
            let id = $(this).closest("tr").data("sneaker-id"); // O data("user-id") para usuarios
            let confirmation = confirm('Are you sure you want to delete this sneaker from the database?')
            if (!confirmation) {
                return
            }
            $.ajax({
                type: "POST",
                url: "scripts/p-deleteSneaker.php", // Ruta al script que maneja la eliminación
                data: { sneaker_id: id },
                success: function (response) {
                    // Manejar la respuesta si es necesario
                    alert(response)
                    updateArchivedInventoryTable()
                }
            });
        });
    });
</script>