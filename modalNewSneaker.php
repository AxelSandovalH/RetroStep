<?php
require_once("connection.php");
?>

<!-- Modal para Add Category -->
<div class="modal fade" id="addSneakerModal" tabindex="-1" role="dialog" aria-labelledby="addSneakerModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div id="messageSneaker" class="alert" style="display: none;"></div>

            <div class="modal-header">
                <h5 class="modal-title" id="addSneakerModalLabel">Add Sneaker</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Aquí coloca tu formulario para agregar una marca -->
                <form id="sneakerForm">
                    <div class="form-group">
                        <label for="sneakerName">Sneaker Name</label>
                        <input type="text" class="form-control" id="sneaker_name" name="sneaker_name" placeholder="Type the sneaker's name">
                    </div>
                    <div class="form-group">
                        <label for="brandName">Brand Name</label>
                        <select class="form-control" id="brand_name" name="brand_name" placeholder="Type the sneaker's brand">
                            <?php
                            $sql_brands = "SELECT brand_name FROM brand;";
                            $result_brands = mysqli_query($connection, $sql_brands);

                            if (mysqli_num_rows($result_brands) > 0) {
                                while ($row = mysqli_fetch_assoc($result_brands)) {
                                    $brand_option = $row['brand_name'];
                                    $selected = ($brand_option == $brand_name) ? "selected" : "";
                                    echo "<option value='$brand_option' $selected>$brand_option</option>";
                                }
                            } else {
                                echo "<option value=''>No brands available</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="sizeNumber">Size</label>
                        <select class="form-control" id="size_number" name="size_number[]" multiple>
                        <?php
                            $sql_sizes = "SELECT size_number FROM size;";
                            $result_sizes = mysqli_query($connection, $sql_sizes);

                            if (mysqli_num_rows($result_sizes) > 0) {
                                while ($row = mysqli_fetch_assoc($result_sizes)) {
                                    $size_option = $row['size_number'];
                                    $selected = (is_array($size_number) && in_array($size_option, $size_number)) ? "selected" : "";
                                    echo "<option value='$size_option' $selected>$size_option</option>";
                                }
                            } else {
                                echo "<option value=''>No hay tallas disponibles</option>";
                            }
                        ?>

                        </select>
                    </div>

                    <div class="form-group">
                        <label for="categoryName">Category</label>
                        <select type="text" id="category_name" name="category_name" class="form-control">
                            <?php
                            $sql_categories = "SELECT category_name FROM category";
                            $result_categories = mysqli_query($connection, $sql_categories);

                            if (mysqli_num_rows($result_categories) > 0) {
                                while ($row = mysqli_fetch_assoc($result_categories)) {
                                    $cat_option = $row['category_name'];
                                    $selected = ($cat_option == $category_name) ? "selected" : "";
                                    echo "<option value='$cat_option' $selected>$cat_option</option>";
                                }
                            } else {
                                echo "<option value=''>No hay categorías disponibles</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="text" class="form-control" id="price" name="price" placeholder="Type the sneaker's price">
                    </div>

                    <div class="form-group">
                        <label for="stock">Stock</label>
                        <input type="text" class="form-control" id="stock_quantity" name="stock_quantity" placeholder="Type the sneaker's stock">
                    </div>

                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" name="image" id="image" class="form-control">
                    </div>
                    <!-- Agrega más campos según tus necesidades -->
                </form>

                <!-- Lista de tallas seleccionadas -->
                <div class="form-group">
                    <label for="selectedSizes">Selected Sizes</label>
                    <ul id="selectedSizes" class="list-group">
                        <!-- Aquí se mostrarán las tallas seleccionadas -->
                    </ul>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btnSaveSneaker">Save</button>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<!-- JavaScript para el modal de categoría -->
<script src="scripts/ajaxMain.js"></script>
<script>
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
                error: function (error) {
                    console.error(error);
                }
            });
        }

        updateInventoryTable()

        // Captura el click en el botón Save del formulario
        $('#btnSaveSneaker').click(function () {
            // Obtén los datos del formulario
            var formData = new FormData($('#sneakerForm')[0]);

            // Envía los datos al servidor usando AJAX
            $.ajax({
                type: 'POST',
                url: 'scripts/newSneaker.php',
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    // Manejar la respuesta del servidor (puede ser un mensaje de éxito/error)
                    console.log(response)
                    $('#messageSneaker').html(response).fadeIn().delay(2000).fadeOut();
                    // Cierra el modal
                    updateInventoryTable()
                    $('#addSneakerModal').modal('hide');

                },
                error: function (error) {
                    console.error(error);
                }
            });
        });

        // Actualiza la lista de tallas seleccionadas al cambiar la selección
    $('#size_number').change(function () {
        updateSelectedSizesList();
    });

    // Función para actualizar la lista de tallas seleccionadas
    function updateSelectedSizesList() {
        var selectedSizes = $('#size_number').val();
        var selectedSizesList = $('#selectedSizes');

        // Borra la lista actual
        selectedSizesList.empty();

        // Agrega las nuevas tallas seleccionadas a la lista
        if (selectedSizes && selectedSizes.length > 0) {
            $.each(selectedSizes, function (index, size) {
                selectedSizesList.append('<li class="list-group-item">' + size + ' <button type="button" class="btn btn-danger btn-sm float-right" onclick="removeSize(\'' + size + '\')">Remove</button></li>');
            });
        } else {
            selectedSizesList.append('<li class="list-group-item">No sizes selected</li>');
        }
    }

    // Función para remover una talla de la lista
    window.removeSize = function (size) {
        var selectedSizes = $('#size_number').val();
        selectedSizes = $.grep(selectedSizes, function (value) {
            return value != size;
        });
        $('#size_number').val(selectedSizes);
        updateSelectedSizesList();
    };

});
</script>
