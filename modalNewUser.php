<?php 
    // include("scripts/routeProtection.php");
    include("connection.php");
?>

<!-- Modal para Add Category -->
<div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
    <div id="messageUser" class="alert" style="display: none;"></div>

    <div class="modal-header">
        <h5 class="modal-title" id="addUserModalLabel">Add User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <!-- Aquí coloca tu formulario para agregar un usuario -->
        <form id="userForm">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email">
            </div>
            <div class="form-group">
                <label for="rol">Rol</label>
                <select id="rol" name="rol" value="<?php echo $rol; ?>" required>
                    <option value="1">Administrador</option>
                    <option value="2">Vendedor</option>
                </select>
            </div>
            <!-- Agrega más campos según tus necesidades -->
            <!-- ... -->
        </form>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="btnSaveUser">Save</button>
    </div>
    </div>
</div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<!-- JavaScript para el modal de usuario -->
<script>
    //    try {

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
                url: 'scripts/newUser.php',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    // Manejar la respuesta del servidor (puede ser un mensaje de éxito/error)
                    console.log(response);
                    $('#messageUser').html(response).fadeIn().delay(2000).fadeOut();
                    // Cierra el modal
                    updateUsersTable();
                    $('#addUserModal').modal('hide');
                },
                error: function(error) {
                    console.error(error);
                }
            });
        });
    });

</script>
