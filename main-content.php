<style>
    /* Desactivar mayúsculas automáticas */
    .no-uppercase {
      text-transform: none !important;
    }

</style>

<div class="main-content">
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header">
                    <div class="icon icon-warning">
                        <span class="material-icons">equalizer</span>
                    </div>
                </div>
                <div class="card-content">
                    <p class="category"><strong>Registered brands</strong></p>
                    <h3 class="card-title">70,340</h3>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header">
                    <div class="icon icon-rose">
                        <span class="material-icons">inventory</span>
                    </div>
                </div>
                <div class="card-content">
                    <p class="category"><strong>Total stock</strong></p>
                    <h3 class="card-title">102</h3>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header">
                    <div class="icon icon-success">
                        <span class="material-icons">attach_money</span>
                    </div>
                </div>
                <div class="card-content">
                    <p class="category"><strong>Stock value</strong></p>
                    <h3 class="card-title">$23,344</h3>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header">
                    <div class="icon icon-info">
                        <span class="material-icons">people</span>
                    </div>
                </div>
                <div class="card-content">
                    <p class="category"><strong>Registered users</strong></p>
                    <h3 class="card-title">5</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- row-second -->
    <div class="row">
        <div class="col-lg-7 col-md-12">
            <div class="card" style="min-height: 485px;">
                <div class="card-header card-header-text">
                    <h4 class="card-title">Inventory</h4>
                    <?php
                        // Incluye tu archivo de conexión a la base de datos
                        require_once "connection.php";

                        // Verifica la conexión
                        if ($connection->connect_error) {
                            die("Error de conexión a la base de datos: " . $connection->connect_error);
                        }

                        // Consulta para obtener la fecha del último sneaker
                        $sql = "SELECT MAX(created_at) AS fecha_ultimo_sneaker FROM sneaker";
                        $result = $connection->query($sql);

                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            if ($row["fecha_ultimo_sneaker"] !== null) {
                                $fecha_ultimo_sneaker = date("dS F, Y", strtotime($row["fecha_ultimo_sneaker"]));
                            } else {
                                $fecha_ultimo_sneaker = "No hay registros";
                            }
                        } else {
                            $fecha_ultimo_sneaker = "No hay registros";
                        }
                        ?>

                    <p class="no-uppercase">Last sneaker was added on: <?php echo $fecha_ultimo_sneaker; ?></p>
                </div>
                <div class="card-content table-responsive">
                    <table id="sneakerTable" class="table table-hover">
                        <thead class="text-primary">
                            <tr>
                                <th>Name</th>
                                <th>Brand</th>
                                <th>Size</th>
                                <th>Price</th>
                                <th>Stock</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- getInventory.php -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-5 col-md-12">
            <div class="card" style="min-height: 485px;">
                <div class="card-header card-header-text">
                    <h4 class="card-title">Activities</h4>
                </div>
                <div class="card-content">
                    <div class="activity-buttons">
                        <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#addBrandModal">
                            <i class="fas fa-plus"></i> Add Brand
                        </button>
                        <button class="btn btn-success btn-lg" data-toggle="modal" data-target="#addCategoryModal">
                            <i class="fas fa-plus"></i> Add Category
                        </button>
                        <button class="btn btn-info btn-lg" data-toggle="modal" data-target="#addSneakerModal">
                            <i class="fas fa-plus"></i> Add Sneaker
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

<script src="scripts/ajaxMain.js"></script>

<?php include_once("modalNewBrand.php"); ?>

<?php include_once("modalNewCategory.php"); ?>

<?php include_once("modalNewSneaker.php"); ?>



			 
			 