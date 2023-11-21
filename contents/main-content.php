<style>
    /* Desactivar mayúsculas automáticas */
    .no-uppercase {
        text-transform: none !important;
    }

    /* Estilos para los botones de las actividades */
    /* Estilos para los botones de las actividades */
    .custom-category {
        padding: 15px 25px;
        width: 100%;
        border: unset;
        border-radius: 15px;
        color: #212121;
        z-index: 1;
        background: #59ff98;
        position: relative;
        font-weight: 1000;
        font-size: 17px;
        -webkit-box-shadow: 4px 8px 19px -3px rgba(0, 0, 0, 0.27);
        box-shadow: 4px 8px 19px -3px rgba(0, 0, 0, 0.27);
        transition: all 250ms;
        overflow: hidden;
        margin: 25px;
    }

    .custom-category::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        width: 0;
        border-radius: 15px;
        background-color: #212121;
        z-index: -1;
        -webkit-box-shadow: 4px 8px 19px -3px rgba(0, 0, 0, 0.27);
        box-shadow: 4px 8px 19px -3px rgba(0, 0, 0, 0.27);
        transition: all 250ms;
    }

    .custom-category:hover {
        color: #e8e8e8;
    }

    .custom-category:hover::before {
        width: 100%;
    }

    .custom-brand {
        margin: 25px;
        width: 100%;
        padding: 15px 25px;
        border: unset;
        border-radius: 15px;
        color: #212121;
        z-index: 1;
        background: #48dcff;
        position: relative;
        font-weight: 1000;
        font-size: 17px;
        -webkit-box-shadow: 4px 8px 19px -3px rgba(0, 0, 0, 0.27);
        box-shadow: 4px 8px 19px -3px rgba(0, 0, 0, 0.27);
        transition: all 250ms;
        overflow: hidden;
    }

    .custom-brand::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        width: 0;
        border-radius: 15px;
        background-color: #212121;
        z-index: -1;
        -webkit-box-shadow: 4px 8px 19px -3px rgba(0, 0, 0, 0.27);
        box-shadow: 4px 8px 19px -3px rgba(0, 0, 0, 0.27);
        transition: all 250ms;
    }

    .custom-brand:hover {
        color: #e8e8e8;
    }

    .custom-brand:hover::before {
        width: 100%;
    }

    .custom-sneaker {
        margin: 25px;
        width: 100%;
        padding: 15px 25px;
        border: unset;
        border-radius: 15px;
        color: #212121;
        z-index: 1;
        background: #a787ff;
        position: relative;
        font-weight: 1000;
        font-size: 17px;
        -webkit-box-shadow: 4px 8px 19px -3px rgba(0, 0, 0, 0.27);
        box-shadow: 4px 8px 19px -3px rgba(0, 0, 0, 0.27);
        transition: all 250ms;
        overflow: hidden;
    }

    .custom-sneaker::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        width: 0;
        border-radius: 15px;
        background-color: #212121;
        z-index: -1;
        -webkit-box-shadow: 4px 8px 19px -3px rgba(0, 0, 0, 0.27);
        box-shadow: 4px 8px 19px -3px rgba(0, 0, 0, 0.27);
        transition: all 250ms;
    }

    .custom-sneaker:hover {
        color: #e8e8e8;
    }

    .custom-sneaker:hover::before {
        width: 100%;
    }


</style>



<?php
// Incluye el archivo de conexión
require_once "connection.php";

// Consulta SQL para obtener la cantidad de marcas no archivadas
$registeredBrandsQuery = "SELECT COUNT(*) AS registered_brands FROM brand";

// Consulta SQL para obtener la cantidad total de stock no archivado
$totalStockQuery = "SELECT SUM(stock.stock_quantity) AS total_stock FROM stock INNER JOIN sneaker
                    ON stock.sneaker_id = sneaker.sneaker_id
                    WHERE stock.deleted_at IS NULL";

// Consulta SQL para obtener la cantidad de categorías no archivadas
$registeredCategoriesQuery = "SELECT COUNT(*) AS registered_categories FROM category";


// Consulta SQL para obtener la cantidad de usuarios no archivados
$registeredUsersQuery = "SELECT COUNT(*) AS registered_users FROM users WHERE deleted_at IS NULL";




// Función para ejecutar la consulta preparada y obtener el resultado
function executeQuery($connection, $query) {
    $stmt = $connection->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    return $result;
}

// Ejecutar las consultas y obtener los resultados
$registeredBrandsResult = executeQuery($connection, $registeredBrandsQuery);
$totalStockResult = executeQuery($connection, $totalStockQuery);
$registeredCategoriesResult = executeQuery($connection, $registeredCategoriesQuery);
$registeredUsersResult = executeQuery($connection, $registeredUsersQuery);

// Obtener los resultados
$registeredBrands = $registeredBrandsResult->fetch_assoc()['registered_brands'];
$totalStock = $totalStockResult->fetch_assoc()['total_stock'];
$registeredCategories = $registeredCategoriesResult->fetch_assoc()['registered_categories'];
$registeredUsers = $registeredUsersResult->fetch_assoc()['registered_users'];

// Cerrar la conexión

?>


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
                    <h3 class="card-title"><?php echo $registeredBrands; ?></h3>
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
                    <h3 class="card-title"><?php echo $totalStock; ?></h3>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6" style="height: 185px;">
            <div class="card card-stats">
                <div class="card-header">
                    <div class="icon icon-success">
                        <span class="material-icons">category</span>
                    </div>
                </div>
                <div class="card-content">
                    <p class="category"><strong>Registered categories</strong></p>
                    <h3 class="card-title"><?php echo $registeredCategories; ?></h3>
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
                    <h3 class="card-title"><?php echo $registeredUsers; ?></h3>
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
            <div class="card">
                <div class="card-header card-header-text">
                    <h4 class="card-title">Activities</h4>
                </div>
                <div class="card-content">
                    <div class="activity-buttons">
                        <button class="custom-brand" role="button" data-toggle="modal" data-target="#addBrandModal">
                            Add Brand
                        </button>
                        <button role="button" class="custom-category" data-toggle="modal" data-target="#addCategoryModal">
                            Add Category
                        </button>
                        <button role="button" class="custom-sneaker" data-toggle="modal" data-target="#addSneakerModal">
                            Add Sneaker
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="scripts/ajaxMain.js"></script>

<?php include_once("modalNewBrand.php"); ?>

<?php include_once("modalNewCategory.php"); ?>

<?php include_once("modalNewSneaker.php"); ?>


			 
			 