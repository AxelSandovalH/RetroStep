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
                        $sql_brands = "SELECT brand_name FROM brand";
                        $result_brands = mysqli_query($connection, $sql_brands);
                        
                        if (mysqli_num_rows($result_brands) > 0) {
                            while ($row = mysqli_fetch_assoc($result_brands)) {
                                $brand_option = $row['brand_name'];
                                $selected = ($brand_option == $brand_name) ? "" : "selected";
                                echo "<option value='$brand_option' $selected>$brand_option</option>";
                            }
                        } else {
                            echo "<option value=''>No brands available</option>";
                        }

                        // echo"<h1>'$brand_name dfdf'</h1>"
                    ?>
            </select>
        </div>

        <div class="form-group">
            <label for="sizeNumber">Size</label>
            <select class="form-control" id="size_number" name="size_number" placeholder="Type the sneaker's size">
                    <?php
                        $sql_sizes = "SELECT size_number FROM size";
                        $result_sizes = mysqli_query($connection, $sql_sizes);
                        
                        if (mysqli_num_rows($result_sizes) > 0) {
                            while ($row = mysqli_fetch_assoc($result_sizes)) {
                                $size_option = $row['size_number'];
                                $selected = ($size_option == $size_number) ? "selected" : "";
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
                        $sql_brands = "SELECT category_name FROM category";
                        $result_brands = mysqli_query($connection, $sql_brands);
                        
                        if (mysqli_num_rows($result_brands) > 0) {
                            while ($row = mysqli_fetch_assoc($result_brands)) {
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
// document.getElementById('btnSaveSneaker').addEventListener('click', function() {
//     let sneakerName = document.getElementById('sneaker_name').value;
//     let brandName = document.getElementById('brand_name').value;
//     console.log(brandName)
//     let sizeNumber = document.getElementById('size_number').value;
//     let categoryName = document.getElementById('category_name').value;
//     let price = document.getElementById('price').value;
//     let stockQuantity = document.getElementById('stock_quantity').value;
//     let image = document.getElementById('image').files[0];

    try {

    $(document).ready(function(){

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


        // Captura el click en el botón Save del formulario
        $('#btnSaveSneaker').click(function(){
            // Obtén los datos del formulario
            var formData = new FormData($('#sneakerForm')[0]);

            // Envía los datos al servidor usando AJAX
            $.ajax({
                type: 'POST',
                url: 'scripts/newSneaker.php', 
                data: formData,
                processData: false,
                contentType: false,
                success: function(response){
                    // Manejar la respuesta del servidor (puede ser un mensaje de éxito/error)
                    console.log(response)
                    $('#messageSneaker').html(response).fadeIn().delay(2000).fadeOut();
                    // Cierra el modal
                    updateInventoryTable()
                    $('#addSneakerModal').modal('hide');

                },
                error: function(error){
                    console.error(error);
                }
            });
        });
    });



    } catch (error) {
        console.error(error)
    }

</script>
