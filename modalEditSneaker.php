<div class="modal fade" id="editSneakerModal" tabindex="-1" role="dialog" aria-labelledby="editSneakerModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editSneakerModalLabel">Edit Sneaker</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form to edit sneaker details -->
                <form id="editSneakerForm" enctype="multipart/form-data">
                    <!-- Fields for sneaker details -->
                    <input type="hidden" id="editSneakerId" name="sneaker_id">
                    <input type="hidden" id="editIdStock" name="id_stock">
                    <input type="hidden" id="editImagenUrl" name="imagen_url">

                    <div class="form-group">
                        <label for="editSneakerName">Sneaker Name</label>
                        <input type="text" class="form-control" id="editSneakerName" name="sneakerName" required>
                    </div>

                    <div class="form-group">
                        <label for="editBrandName">Brand Name</label>
                        <select class="form-control" id="editBrandName" name="brandName">
                            <?php
                                $sql_brands = "SELECT brand_name FROM brand";
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
                        <label for="editSizeNumber">Size</label>
                        <select class="form-control" id="editSizeNumber" name="sizeNumber">
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
                        <label for="editCategoryName">Category</label>
                        <select type="text" id="editCategoryName" name="categoryName" class="form-control">
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
                        <label for="editPrice">Price</label>
                        <input type="text" class="form-control" id="editPrice" name="price">
                    </div>

                    <div class="form-group">
                        <label for="editStock">Stock</label>
                        <input type="text" class="form-control" id="editStock" name="stock_quantity">
                    </div>

                    <div class="form-group">
                        <label for="imageFile">Image</label>
                        <input type="file" name="imageFile" id="imageFile" class="form-control">
                    </div>

                    <!-- Add other fields as needed -->

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="saveEditSneakerBtn">Save changes</button>
                </form>
            </div>
        </div>
    </div>
</div>
