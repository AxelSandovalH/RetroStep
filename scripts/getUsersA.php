<?php
    require_once "../connection.php";
    $sql = "SELECT id, username, rol_name, email, deleted_at FROM retro_step.users
            INNER JOIN roles
            ON rol = idRol
            WHERE deleted_at IS NOT NULL
            ORDER BY users.updated_at DESC;";
    $result = mysqli_query($connection, $sql);

    while ($column = mysqli_fetch_array($result)) {
    ?>
    <tr data-user-id="<?php echo $column['id']; ?>">
        <td><?php echo $column['id']; ?></td>
        <td><?php echo $column['username']; ?></td>
        <td><?php echo $column['rol_name']; ?></td>
        <td><?php echo $column['email']; ?></td>
        <td><?php echo $column['deleted_at']; ?></td>
        <td><button id="restoreUserBtn" class="btn btn-outline-secondary">Restore</button></td>
        <td><button id="deleteUserBtn" class="btn btn-outline-danger">Delete from database</button></td>
    </tr>
<?php } ?>

<script>
    function updateArchivedUsersTable() {
        // AJAX para obtener la tabla sin refrescar
        $.ajax({
            type: "GET",
            url: "scripts/getUsersA.php",
            success: function (response) {
                // Actualiza la tabla con la nueva información
                $('#aUsersTable tbody').html(response);
            },
            error:function(error){
                console.error(error);
            }
        });
    }

     $(document).ready(function () {
        $("#aUsersTable").on('click', '#restoreUserBtn', function () {
            let id = $(this).closest("tr").data("user-id"); // O data("user-id") para usuarios
            $.ajax({
                type: "POST",
                url: "scripts/restoreUser.php", // Ruta al script que maneja la restauración
                data: { user_id: id },
                success: function (response) {
                    // Manejar la respuesta si es necesario
                    alert(response);
                    updateArchivedUsersTable()
                }
            });
        });

        

        $("#aUsersTable").on('click', '#deleteUserBtn', function () {
            let id = $(this).closest("tr").data("user-id"); // O data("user-id") para usuarios
            let confirmation = confirm('Are you sure you want to delete this user from the database?')
            if (!confirmation) {
                return
            }
            $.ajax({
                type: "POST",
                url: "scripts/p-deleteUser.php", // Ruta al script que maneja la eliminación
                data: { user_id: id },
                success: function (response) {
                    // Manejar la respuesta si es necesario
                    alert(response)
                    updateArchivedUsersTable()
                }
            });
        });
    });
</script>