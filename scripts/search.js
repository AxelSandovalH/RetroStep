$(document).ready(function(){
    // EJEMPLO EN EL QUE SE REFLEJA TODO LO QUE ESCRIBE EL USUARIO Y SE ACTUALIZA EN INPUT DE LA NAVBAR
    // A través del input con id = "search", en cada tecleo ("keyup") hará una función
    function loadFetchedSneakers(){
        $("#not-found-msg").hide();

        $('#search-input').keyup(function() {
        
                $('.TablaContainerSneakers').hide();
                // Se guarda el valor (val) del input en una variable para mostrarla en la consola 
                let search = $('#search-input').val()
                if(search){
                    $.ajax({
                        url: 'scripts/sneaker-search.php',
                        type: 'POST',
                        data: { search },
                        success: function(response) {
                            console.log(response)

                            let sneakers = JSON.parse(response);
                            if (sneakers.length > 0) {
                                let template = '';
                                // console.log(sneakers);
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
                                            <a class="link_editar" href="updateSneaker.php?sneaker_id=${sneaker.sneaker_id}">
                                                <button class="editar"><i class="fa-regular fa-pen-to-square"></i> Edit</button>
                                            </a>
                                            <a class="link_borrar">
                                                <button class="eliminar" data-sneaker-id="${sneaker.sneaker_id}"><i class="fa-regular fa-circle-xmark"></i> Delete</button>
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
                    $("#not-found-msg").hide();
                    $('#fetched-sneaker-container').hide();
                    $(".TablaContainerSneakers").show();
                }
            
        })
    }

    loadFetchedSneakers()

     // Eliminar sneaker

    $('#fetched-sneaker-container').on('click', '.eliminar', function () {
        // Obtener el ID del sneaker
        let sneakerId = $(this).data('sneaker-id');
        let confirmDelete = confirm('¿Seguro que quieres borrar este sneaker?');

        if (confirmDelete) {
        // Realizar la solicitud de eliminación mediante Ajax
            $.ajax({
                url: 'deleteSneaker.php', // Ajusta la URL según tu estructura
                type: 'POST',
                data: { sneaker_id: sneakerId },
                success: function (response) {
                    // Manejar la respuesta después de la eliminación
                    console.log(response);
                    
                    loadFetchedSneakers()
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

    loadFetchedSneakers();

})