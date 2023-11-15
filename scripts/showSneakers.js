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
                                    <a class="link_editar" href="updateSneaker.php?sneaker_id=${sneaker.sneaker_id}">
                                        <button class="editar"><i class="fa-regular fa-pen-to-square"></i> Edit</button>
                                    </a>
                                    <a class="link_borrar" href="deleteSneaker.php?sneaker_id=${sneaker.sneaker_id}&confirmed=yes" onclick="return confirm('¿Seguro que quieres borrar?')">
                                        <button class="eliminar"><i class="fa-regular fa-circle-xmark"></i> Delete</button>
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
});