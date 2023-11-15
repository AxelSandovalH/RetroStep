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
        <form>
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
            <input type="text" class="form-control" id="email" name="email">
        </div>
        <div class="form-group">
            <label for="rol">Rol</label>
            <select id="rol" name="rol" value="<?php echo $rol; ?>" required>
                <option value="1">Administrador</option>
                <option value="2">Vendedor</option>
            </select>
        </div>
        <!-- Agrega más campos según tus necesidades -->
        </form>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="btnSaveUser">Save</button>
    </div>
    </div>
</div>
</div>

<script src="js/jquery.js"></script>
<!-- JavaScript para el modal de usuario -->
<script>
    document.getElementById('btnSaveUser').addEventListener('click', function() {
        let username = document.getElementById('username').value;
        let password = document.getElementById('password').value;
        let email = document.getElementById('email').value;
        let rol = document.getElementById('rol').value;

        let xhr = new XMLHttpRequest();
        xhr.open('POST', 'scripts/newUser.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    let response = xhr.responseText;
                    let messageUserElement = document.getElementById('messageUser');
                    messageUserElement.textContent = response;

                    if (response.indexOf('saved successfully') !== -1) {
                        messageUserElement.className = 'alert alert-success';
                        document.getElementById('username').value = ''; // Limpia el campo de entrada
                        document.getElementById('password').value = '';
                        document.getElementById('email').value = '';
                        document.getElementById('rol').value = '';
                    } else {
                        messageUserElement.className = 'alert alert-danger';
                    }

                    messageUserElement.style.display = 'block';
                    // Cierra el modal después de mostrar el mensaje
                    $('#addUserModal').modal('hide');
                    // Limpia y oculta el mensaje después de un tiempo
                    setTimeout(function() {
                        messageUserElement.style.display = 'none';
                    }, 5000); // El mensaje se ocultará después de 5 segundos (5000 ms)
                } else {
                    // Maneja errores si es necesario
                }
            }
        };
        xhr.send('username=' + username + '&password=' + password + '&email=' + email + '&rol=' + rol);
    });
</script>
