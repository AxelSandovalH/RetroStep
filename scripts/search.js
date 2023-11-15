$(document).ready(function(){
    // EJEMPLO EN EL QUE SE REFLEJA TODO LO QUE ESCRIBE EL USUARIO Y SE ACTUALIZA EN INPUT DE LA NAVBAR
    // A través del input con id = "search", en cada tecleo ("keyup") hará una función
    function loadFetchedSneakers(){

        $('#search-input').keyup(function() {
        
                $("#fetched-sneaker-table").hide();
                $('.TablaContainerSneakers').hide();
                // Se guarda el valor (val) del input en una variable para mostrarla en la consola 
                let search = $('#search-input').val()
        
                if(search){
                    $.ajax({
                        url: 'scripts/sneaker-search.php',
                        type: 'POST',
                        data: { search },
                        success: function(response) {
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
                                            <a class="link_borrar" href="deleteSneaker.php?sneaker_id=${sneaker.sneaker_id}&confirmed=yes" onclick="return confirm('¿Seguro que quieres borrar?')">
                                                <button class="eliminar"><i class="fa-regular fa-circle-xmark"></i> Delete</button>
                                            </a>


                                        </div>
                                    </div>
                                `;})

                                $('#fetched-sneaker-container').show();
                                $('#fetched-sneaker-container').html(template);

                            } else {
                                $('#fetched-sneaker-container').html('<h2> No se encontraron resultados </h2>');
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
})