$(document).ready(function () {
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

    updateArchivedInventoryTable()

    function updateArchivedUserTable() {
        $.ajax({
            type: "GET",
            url: "scripts/getUsersA.php",
            success: function (response) {
                $('#aUsersTable tbody').html(response);
            },
            error: function(error){
                console.error(error)
            }
        });
    }

    updateArchivedUserTable()

});