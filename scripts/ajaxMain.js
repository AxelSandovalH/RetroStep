$(document).ready(function () {
    function updateInventoryTable() {
        // AJAX para obtener la tabla sin refrescar
        $.ajax({
            type: "GET",
            url: "scripts/getInventory.php",
            success: function (response) {
                // Actualiza la tabla con la nueva información
                $('#sneakerTable tbody').html(response);
            },
            error:function(error){
                console.error(error);
            }
        });
    }

    updateInventoryTable()

});