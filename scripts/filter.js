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
                                        <a class="link_editar">
                                            <button id="editSneakerBtn" class="editar" data-toggle="modal" data-target="#editSneakerModal" data-sneaker-id="${sneaker.sneaker_id}" data-id-stock="${sneaker.id_stock}"><i class="fa-regular fa-pen-to-square"></i> Edit</button>
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

        // Editar Sneaker
        $("#filtered-sneaker-container").off('click', '#editSneakerBtn').on('click', '#editSneakerBtn', function () {
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

        $('#filtered-sneaker-container').off('click', '.editar').on('click', '.editar', function () {

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
                        location.reload(true);
    
                        $("#editSneakerModal").modal('hide');
                    },
                    error: function (error) {
                        console.error(error);
                    }
                });
            });
        });

    });

});


