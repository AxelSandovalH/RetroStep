$(document).ready(function () {

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

    showUsersTable()

});