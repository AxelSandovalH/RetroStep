$(document).ready(function() {
    $('.filter-dropdown').change(function() {
        // Fetch selected filter values
        let brandFilter = $('#brand-filter').val();
        let sizeFilter = $('#size-filter').val();
        let modelFilter = $('#model-filter').val();
        let categoryFilter = $('#category-filter').val();

        $('.TablaContainerSneakers').hide();
        $("#not-found-msg").hide();

        // Make AJAX request to filterSneakers.php
        $.ajax({
            url: 'scripts/filterSneakers.php',
            type: 'GET',
            data: {
                brand_name: brandFilter,
                size_number: sizeFilter,
                sneaker_name: modelFilter,
                category_name: categoryFilter
            },
            success: function(response) {
                $('#filtered-sneaker-container').hide();
                let sneakers = JSON.parse(response);
                console.log(sneakers);
                let template = '';

                if(sneakers.length > 0) {
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
                                    `
                            });

                    // Update the container with filtered results
                    $('#filtered-sneaker-container').html(template);
                    $('#filtered-sneaker-container').show();
                } else {
                    $('#filtered-sneaker-container').hide();
                    $('#not-found-msg').show();
                }
            },
            error: function(error) {
                console.error(error);
            }
        });
    });
});
