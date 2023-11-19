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
        <td><button id="editUserBtn" class="btn btn-outline-secondary editUserBtn" data-toggle="modal" data-target="#editUserModal" data-user-id="<?php echo $column['id']; ?>">Edit</button></td>
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

        // Captura el clic en el botón "Editar"
        $('#editUserBtn').click(function() {
            var userId = $(this).data('id'); // Obtiene el ID del usuario 

            // Realiza una solicitud AJAX para obtener los datos del usuario
            $.ajax({
                type: 'GET',
                url: 'scripts/getUserData.php', // Ruta al script que obtiene los datos del usuario
                data: { id: userId }, // Envia el ID del usuario al script
                success: function(response) {
                    // Carga los datos del usuario en el modal
                    $('#userForm').html(response);
                },
                error: function(error) {
                    console.error(error);
                }
            });
        });


    }); 

    $("#UsersTable").off('click', '#editUserBtn').on('click', '#editUserBtn', function () {
        let id = $(this).data("user-id");
        // Use AJAX to fetch user data and populate the modal fields
        $.ajax({
            type: "GET",
            url: "scripts/getUserById.php", // Create a new script to get user details by ID
            data: { user_id: id },
            success: function (response) {
                console.log(response)
                // Populate the modal fields with the user data
                let userData = JSON.parse(response);
                $("#editUserId").val(userData.id);
                $("#editUsername").val(userData.username);
                $("#editEmail").val(userData.email);
                $("#selectEditRole").val(userData.rol);
                // Populate other fields as needed
            },
            error: function (error) {
                console.error(error);
            }
        });
    });

    // Save changes when the "Save" button in the edit modal is clicked
    $("#saveEditUserBtn").off('click').on('click', function () {
        // Use AJAX to update user data in the database
        $.ajax({
            type: "POST",
            url: "scripts/editUser.php", // Create a new script to handle user edits
            data: $("#editUserForm").serialize(),
            success: function (response) {
                console.log(response);
                // Handle the response if needed
                alert(response);
                // Close the modal and refresh the user table
                showUsersTable();

                $("#editUserModal").modal('hide');
            },
            error: function (error) {
                console.error(error);
            }
        });
    });
</script>
