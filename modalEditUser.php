<?php 
    // include("scripts/routeProtection.php");
    include("connection.php");
?>

<!-- Modal para Add Category -->
<div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div id="messageUser" class="alert" style="display: none;"></div>

        <div class="modal-header">
            <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <!-- Aquí coloca tu formulario para ediar un usuario -->
            <form id="userForm">  
                <input type="hidden" id="idUser" name="idUser" value="<?php echo $idUser; ?>">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" value="<?= $username ?>" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" value="<?= $password ?>" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" id="email" name="email" value="<?= $email ?>" required>
                </div>
                <div class="form-group">
                    <label for="rol">Rol</label>
                    <select id="rol" name="rol" value="<?= $rol ?>" required>
                        <option value="1">Administrador</option>
                        <option value="2">Vendedor</option>
                    </select>
                </div>
                <!-- Agrega más campos según tus necesidades -->
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button id="btnSaveUser" type="button" class="btn btn-primary">Save</button>
        </div>
    </div>
</div>
</div>

<script src="js/jquery.js"></script>
<!-- JavaScript para el modal de usuario -->
<script>
    $(document).ready(function() {
        function updateUsersTable() {
            // AJAX para obtener la tabla sin refrescar
            $.ajax({
                type: "GET",
                url: "scripts/getUsers.php",
                success: function(response) {
                    // Actualiza la tabla con la nueva información
                    $('#UsersTable tbody').html(response);
                },
                error: function(error) {
                    console.error(error);
                }
            });
        }

        updateUsersTable();

        
        // Captura el click en el botón Save del formulario
        $('#btnSaveUser').click(function() {
            // Obtén los datos del formulario
            let formData = new FormData($('#userForm')[0]);

            // Envía los datos al servidor usando AJAX
            $.ajax({
                type: 'POST',
                url: 'scripts/editUser.php',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    // Manejar la respuesta del servidor (puede ser un mensaje de éxito/error)
                    console.log(response);
                    $('#messageUser').html(response).fadeIn().delay(2000).fadeOut();
                    // Cierra el modal
                    updateUsersTable();
                    $('#editUserModal').modal('hide');
                },
                error: function(error) {
                    console.error(error);
                }
            });
        });
    });
</script>
