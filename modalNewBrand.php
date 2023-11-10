
<!-- Modal para Add Brand -->
<div class="modal fade" id="addBrandModal" tabindex="-1" role="dialog" aria-labelledby="addBrandModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
    <div id="message" class="alert" style="display: none;"></div>
    <div class="modal-header">
        <h5 class="modal-title" id="addBrandModalLabel">Add brand</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div id="message" class="alert alert-success" style="display: none;">
        Brand saved successfully.
    </div>
    <div class="modal-body">
        <!-- Aquí coloca tu formulario para agregar una marca -->
        <form id="addBrandForm">
        <div class="form-group">
            <label for="brandName">Brand name</label>
            <input type="text" class="form-control" id="brand_name" placeholder="Type the sneaker's brand" name="brand_name" required>
        
            <!-- <label for="brandName">Confirm brand name</label>
            <input type="text" class="form-control" id="brand_name" placeholder="Type the sneaker's brand" name="confirm_brand_name"> -->
        </div>
        <!-- Agrega más campos según tus necesidades -->
        </form>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" id="btnSave">Save</button>
    </div>
    </div>
</div>
</div>
<script src="js/jquery.js"></script>

<script>
    document.getElementById('btnSave').addEventListener('click', function() {
        let brandName = document.getElementById('brand_name').value;

        let xhr = new XMLHttpRequest();
        xhr.open('POST', 'scripts/newBrand.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    let response = xhr.responseText;
                    let messageElement = document.getElementById('message');
                    messageElement.textContent = response;
                    
                    if (response.indexOf('saved successfully.') !== -1) {
                        messageElement.className = 'alert alert-success';
                    } else {
                        messageElement.className = 'alert alert-danger';
                    }

                    messageElement.style.display = 'block';
                    // Cierra el modal después de mostrar el mensaje
                    $('#addBrandModal').modal('hide');
                    // Limpia y oculta el mensaje después de un tiempo
                    setTimeout(function() {
                        messageElement.style.display = 'none';
                    }, 5000); // El mensaje se ocultará después de 5 segundos (5000 ms)
                } else {
                    // Maneja errores si es necesario
                }
            }
        };
        xhr.send('brand_name=' + brandName);
    });
</script>
