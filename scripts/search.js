$(document).ready(function(){
    // EJEMPLO EN EL QUE SE REFLEJA TODO LO QUE ESCRIBE EL USUARIO Y SE ACTUALIZA EN INPUT DE LA NAVBAR
    // A través del input con id = "search", en cada tecleo ("keyup") hará una función
    function loadFetchedSneakers(){
        $("#not-found-msg").hide();

        $('#search-input').keyup(function() {
                $("#not-found-msg").hide();
                $('.TablaContainerSneakers').hide();
                $("#filtered-sneaker-container").hide();
                // Se guarda el valor (val) del input en una variable para mostrarla en la consola 
                let search = $('#search-input').val()
                if(search){
                    $.ajax({
                        url: 'scripts/sneaker-search.php',
                        type: 'POST',
                        data: { search },
                        success: function(response) {
                            $('#fetched-sneaker-container').hide();

                            console.log(response)

                            let sneakers = JSON.parse(response);
                            if (sneakers.length > 0) {
                                let template = '';
                                console.log(sneakers);
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

                                        <div class="sneaker-actions">
                                            <a class="link_editar">
                                                <button id="editSneakerBtn" class="editar" data-toggle="modal" data-target="#editSneakerModal" data-sneaker-id="${sneaker.sneaker_id}" data-id-stock="${sneaker.id_stock}"><i class="fa-regular fa-pen-to-square"></i> Edit</button>
                                            </a>
                                            <a class="link_borrar">
                                               <button class="eliminar" data-sneaker-id="${sneaker.sneaker_id}" data-size-number="${sneaker.size_number}"><i class="fa-regular fa-circle-xmark"></i> Delete</button>
                                            </a>


                                        </div>
                                    </div>
                                `;})

                                $('#fetched-sneaker-container').show();
                                $('#fetched-sneaker-container').html(template);

                            } else {
                                // $('#fetched-sneaker-container').html('<h2> No se encontraron resultados </h2>');
                                $('#fetched-sneaker-container').hide();
                                $('#not-found-msg').show();
                            }
                        },
                        error: function(error) {
                            console.log(error);
                        }

                    })
                } else {
                    $('#fetched-sneaker-container').hide();
                    $(".TablaContainerSneakers").show();
                }
        })
    }

    loadFetchedSneakers()

     // Eliminar sneaker
    $('#fetched-sneaker-container').off('click', '.eliminar').on('click', '.eliminar', function () {
        // Obtener el ID del sneaker
        let sneakerId = $(this).data('sneaker-id');
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
                    location.reload(true);

                    // Actualizar la vista después de la eliminación
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

    $('#fetched-sneaker-container').off('click', '.editar').on('click', '.editar', function () {

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
                    console.log(response);
                    location.reload(true);

                    $("#editSneakerModal").modal('hide');
                },
                error: function (error) {
                    console.error(error);
                }
            });
        });
    });


})