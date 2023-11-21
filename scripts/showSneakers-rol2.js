$(document).ready(function() {
    
    function loadSneakers() {
        $.ajax({
            url: 'scripts/sneaker-query.php',
            type: 'GET',
            success: function(response) {
                let sneakers = JSON.parse(response);
                let template = '';
                sneakers.forEach(sneaker => {
                    template += `
                            <div id="sneaker-card" class="sneaker-card">
                                <div class="sneaker-image">
                                    <img src="${sneaker.imagen_url}" alt="Imagen del sneaker">
                                </div>
                                <div class="sneaker-info">
                                    <h2>Name: ${sneaker.sneaker_name}</h2>
                                    <p>Brand: ${sneaker.brand_name}</p>
                                    <p>Size: ${sneaker.size_number}</p>
                                    <p>Price: ${sneaker.price}</p>
                                    <p>Stock: ${sneaker.stock_quantity}</p>
                                </div>

                                
                            </div>
                    `;
                });
                $('#sneaker-container').html(template);
            },
            error: function(error) {
                console.error(error);
                // Manejar el error
            }
        });
    }

    loadSneakers();

    // Eliminar sneaker

    $('#sneaker-container').off('click', '.eliminar').on('click', '.eliminar', function () {
        // Obtener el ID del sneaker
        let sneakerId = $(this).data('sneaker-id');
        // Obtener el tamaño del sneaker
        let sizeNumber = $(this).data('size-number');
        let confirmDelete = confirm('¿Seguro que quieres borrar este sneaker?');

        if (confirmDelete) {
        // Realizar la solicitud de eliminación mediante Ajax
            $.ajax({
                url: 'deleteSneaker.php', // Ajusta la URL según tu estructura
                type: 'POST',
                data: { sneaker_id: sneakerId, size_number: sizeNumber },
                success: function (response) {
                    // Manejar la respuesta después de la eliminación
                    console.log(response);

                    // Actualizar la vista después de la eliminación
                    loadSneakers();
                },
                error: function (error) {
                    console.error(error);
                    // Manejar el error
                }
            });
        } else {
            return false;
        }
    });


    // Editar Sneaker
    $("#sneaker-container").off('click', '#editSneakerBtn').on('click', '#editSneakerBtn', function () {
        let id = $(this).data('sneaker-id');
        let idStock = $(this).data('id-stock');

        // Use AJAX to fetch sneaker data and populate the modal fields
        $.ajax({
            type: "GET",
            url: 'scripts/getSneakerById.php', // Create a new script to get sneaker details by ID
            data: { sneaker_id: id, id_stock: idStock },
            success: function (response) {
                console.log("Respuesta getSneakerById:");
                console.log(response)
                // Populate the modal fields with the sneaker data
                let sneakerData = JSON.parse(response);
                console.log("JSON parse: ");
                console.log(sneakerData);
                $("#editSneakerName").val(sneakerData.sneaker_name);
                $("#editBrandName").val(sneakerData.brand_name);
                $("#editSizeNumber").val(sneakerData.size_number);
                $("#editCategoryName").val(sneakerData.category_name);
                $("#editPrice").val(sneakerData.price);
                $("#editStock").val(sneakerData.stock_quantity);
                $("#editIdStock").val(sneakerData.id_stock);
                $("#editImagenUrl").val(sneakerData.imagen_url);
                // Populate other fields as needed
            },
            error: function (error) {
                console.error(error);
            }
        });
    });


    // Save changes when the "Save" button in the edit modal is clicked
    $("#saveEditSneakerBtn").off('click').on('click', function () {
        let formData = new FormData($("#editSneakerForm")[0]);
        // Use AJAX to update sneaker data in the database
        $.ajax({
            type: "POST",
            url: "scripts/editSneaker.php", // Create a new script to handle sneaker edits
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                console.log(response);
                // Handle the response if needed
                alert(response);
                // Close the modal and refresh the sneaker table
                loadSneakers();

                $("#editSneakerModal").modal('hide');
            },
            error: function (error) {
                console.error(error);
            }
        });
    });

});