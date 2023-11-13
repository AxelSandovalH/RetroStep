<?php 
    // include("scripts/routeProtection.php");
    include("connection.php");
?>

<!-- Modal para Add Category -->
<div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
    <div id="messageCategory" class="alert" style="display: none;"></div>

    <div class="modal-header">
        <h5 class="modal-title" id="addCategoryModalLabel">Add Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <!-- Aquí coloca tu formulario para agregar una marca -->
        <form>
        <div class="form-group">
            <label for="categoryName">Category</label>
            <input type="text" class="form-control" id="category_name" name="category_name" placeholder="Type the sneaker's category">
        </div>
        <!-- Agrega más campos según tus necesidades -->
        </form>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="btnSaveCategory">Save</button>
    </div>
    </div>
</div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<!-- JavaScript para el modal de categoría -->
<script>
    document.getElementById('btnSaveCategory').addEventListener('click', function() {
        let categoryName = document.getElementById('category_name').value;

        let xhr = new XMLHttpRequest();
        xhr.open('POST', 'scripts/newCategory.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    let response = xhr.responseText;
                    let messageCategoryElement = document.getElementById('messageCategory');
                    messageCategoryElement.textContent = response;

                    if (response.indexOf('saved successfully') !== -1) {
                        messageCategoryElement.className = 'alert alert-success';
                        document.getElementById('category_name').value = ''; // Limpia el campo de entrada
                    } else {
                        messageCategoryElement.className = 'alert alert-danger';
                    }

                    messageCategoryElement.style.display = 'block';
                    // Cierra el modal después de mostrar el mensaje
                    $('#addCategoryModal').modal('hide');
                    // Limpia y oculta el mensaje después de un tiempo
                    setTimeout(function() {
                        messageCategoryElement.style.display = 'none';
                    }, 5000); // El mensaje se ocultará después de 5 segundos (5000 ms)
                } else {
                    // Maneja errores si es necesario
                }
            }
        };
        xhr.send('category_name=' + categoryName);
    });
</script>
