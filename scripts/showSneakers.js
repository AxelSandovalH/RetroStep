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

                                <div class="sneaker-actions">
                                    <a class="link_editar">
                                        <button class="editar" data-toggle="modal" data-target="#editSneakerModal"><i class="fa-regular fa-pen-to-square"></i> Edit</button>
                                    </a>
                                    <a class="link_borrar">
                                        <button class="eliminar" data-sneaker-id="${sneaker.sneaker_id}" data-size-number="${sneaker.size_number}"><i class="fa-regular fa-circle-xmark"></i> Delete</button>
                                    </a>


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

});