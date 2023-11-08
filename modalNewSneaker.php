<?php 
require_once("connection.php")
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
        <form>
        <div class="form-group">
            <label for="sneakerName">Sneaker Name</label>
            <input type="text" class="form-control" id="sneaker_name" name="sneaker_name" placeholder="Type the sneaker's name">
        </div>
        <div class="form-group">
            <label for="categoryName">Sneaker brand</label>
            <select class="form-control" id="brand_name" name="brand_name" placeholder="Select brand" required>
                    <?php
                        $sql_categories = "SELECT brand_name FROM brand";
                        $result_categories = mysqli_query($connection, $sql_categories);
                        
                        if (mysqli_num_rows($result_categories) > 0) {
                            while ($row = mysqli_fetch_assoc($result_categories)) {
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
                <select name="category_name" class="form-control" id="category_name" required>
                    <?php
                        $sql_categories = "SELECT category_name FROM category";
                        $result_categories = mysqli_query($connection, $sql_categories);
                        
                        if (mysqli_num_rows($result_categories) > 0) {
                            while ($row = mysqli_fetch_assoc($result_categories)) {
                                $cat_option = $row['category_name'];
                                $selected = ($cat_option == $cat_name) ? "selected" : "";
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
            <label for="imagen">Image</label>
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
<script>
document.getElementById('btnSaveSneaker').addEventListener('click', function() {
    let sneakerName = document.getElementById('sneaker_name').value;
    let brandName = document.getElementById('brand_name').value;
    let sizeNumber = document.getElementById('size_number').value;
    let categoryName = document.getElementById('category_name').value;
    let price = document.getElementById('price').value;
    let stockQuantity = document.getElementById('stock_quantity').value;
    let image = document.getElementById('image').files[0];

    let formData = new FormData();
    formData.append('sneaker_name', sneakerName);
    formData.append('brand_name', brandName);
    formData.append('size_number', sizeNumber);
    formData.append('category_name', categoryName);
    formData.append('price', price);
    formData.append('stock_quantity', stockQuantity);
    formData.append('imagen', image);

    let xhr = new XMLHttpRequest();
    xhr.open('POST', 'scripts/newSneaker.php', true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                // Procesar la respuesta del servidor
                let response = xhr.responseText;
                let messageSneakerElement = document.getElementById('messageSneaker');
                messageSneakerElement.textContent = response;

                if (response.indexOf('saved successfully') !== -1) {
                    messageSneakerElement.className = 'alert alert-success';
                    document.getElementById('sneaker_name').value = ''; // Limpia el campo de entrada
                } else {
                    messageSneakerElement.className = 'alert alert-danger';
                }

                messageSneakerElement.style.display = 'block';
                // Cierra el modal después de mostrar el mensaje
                $('#addSneakerModal').modal('hide');
                // Limpia y oculta el mensaje después de un tiempo
                setTimeout(function() {
                    messageSneakerElement.style.display = 'none';
                }, 5000); // El mensaje se ocultará después de 5 segundos (5000 ms)
            } else {
                // Maneja errores si es necesario
            }
        }
    };
    xhr.send(formData);
});

</script>
