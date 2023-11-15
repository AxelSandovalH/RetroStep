<?php
    require_once "../connection.php";
    $sql = "SELECT users.id, users.username, rol_name, users.email, users.created_at FROM retro_step.users
            INNER JOIN roles ON rol = idRol
            WHERE users.deleted_at IS NULL
            ORDER BY users.created_at DESC;";
    $result = mysqli_query($connection, $sql);

    while ($column = mysqli_fetch_array($result)) {
    ?>
    <tr data-user-id="<?php echo $column['id']; ?>">
        <td><?php echo $column['id']; ?></td>
        <td><?php echo $column['username']; ?></td>
        <td><?php echo $column['rol_name']; ?></td>
        <td><?php echo $column['email']; ?></td>
        <td><?php echo $column['created_at']; ?></td>
        <td><button id="editUserBtn" class="btn btn-outline-secondary" href="#?sneaker_id=<?php echo $column['sneaker_id']; ?>">Edit</button></td>
        <td><button id="deleteUserBtn" class="btn btn-outline-danger deleteUserBtn">Delete</button></td>
    </tr>
<?php } ?>

<script>
    function showUsersTable() {
        // AJAX para obtener la tabla sin refrescar
        $.ajax({
            type: "GET",
            url: "scripts/getUsers.php",
            success: function (response) {
                // Actualiza la tabla con la nueva información
                $('#UsersTable tbody').html(response);
            },
            error:function(error){
                console.error(error);
            }
        });
    }

    $(document).ready(function (){
        
        $("#UsersTable").off('click', '#deleteUserBtn').on('click', '#deleteUserBtn', function () {
            let id = $(this).closest("tr").data("user-id"); // O data("user-id") para usuarios
            let confirmation = confirm('Are you sure you want to delete this user?')
            if (!confirmation) {
                return
            }
            $.ajax({
                type: "POST",
                url: "scripts/deleteUser.php", // Ruta al script que maneja la eliminación
                data: { user_id: id },
                success: function (response) {
                    // Manejar la respuesta si es necesario
                    alert(response)
                    showUsersTable()
                },
                error:function(error) {
                    console.error(error)
                }
            });
        }); 

    }); 
</script>