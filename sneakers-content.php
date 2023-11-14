<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://kit.fontawesome.com/c7fad14ccd.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/styleSneakers.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sneakers</title>

</head>
<body>


    <div class="tab">
        <label class="tab-label" for="filterTab"><i class="fa-solid fa-chevron-down"></i></label>
        <input type="checkbox" id="filterTab" class="tab-checkbox">
        <div class="filter-container">
            <label for="brand-filter">Marca:</label>
            <select id="brand-filter">
                <option value="">Todas las marcas</option>
                <?php
                require_once "connection.php";
                $sql = "SELECT DISTINCT brand_name FROM sneaker WHERE sneaker.deleted_at IS NULL";
                $result = mysqli_query($connection, $sql);

                while ($row = mysqli_fetch_assoc($result)) {
                    $brandName = $row['brand_name'];
                    echo "<option value='$brandName'>$brandName</option>";
                }
                ?>
            </select>
            <label for="size-filter">Talla:</label>
            <select id="size-filter">
                <option value="">Todas las tallas</option>
                <?php
                require_once "connection.php";
                $sql = "SELECT DISTINCT size_number FROM size";
                $result = mysqli_query($connection, $sql);

                while ($row = mysqli_fetch_assoc($result)) {
                    $sizeNumber = $row['size_number'];
                    echo "<option value='$sizeNumber'>$sizeNumber</option>";
                }
                ?>
            </select>

            <label for="model-filter">Modelo:</label>
            <select id="model-filter">
                <option value="">Todos los modelos</option>
                <?php
                require_once "connection.php";
                $sql = "SELECT DISTINCT sneaker_name FROM sneaker WHERE deleted_at IS NULL";
                $result = mysqli_query($connection, $sql);

                while ($row = mysqli_fetch_assoc($result)) {
                    $sneakerName = $row['sneaker_name'];
                    echo "<option value='$sneakerName'>$sneakerName</option>";
                }   
                ?>
            </select>

            <label for="category-filter">Categoría:</label>
            <select id="category-filter">
                <option value="">Todas las categorías</option>
                <?php
                require_once "connection.php";
                $sql = "SELECT DISTINCT category_name FROM sneaker WHERE deleted_at IS NULL";
                $result = mysqli_query($connection, $sql);

                while ($row = mysqli_fetch_assoc($result)) {
                    $categoryName = $row['category_name'];
                    echo "<option value='$categoryName'>$categoryName</option>";
                }
                ?>
            </select>

            <label for="search-input">Búsqueda:</label>
            <input type="search" id="search-input" placeholder="Search sneaker">
            <button id="search-button">Buscar</button>
        </div>
    </div>


    <div id="sneaker-container" class="TablaContainerSneakers">
    </div>


    <div id="fetched-sneaker-container" class="fetched-sneaker-container">
    </div>

    <!-- <div class="container">
        <input type="checkbox" id="btn-mas">
        <div class="options">
            <a href="newSneaker.php" class="edit"><i class="fa-solid fa-file-circle-plus"></i></a>
            <a href="users.php" class="users"><i class="fa-solid fa-users"></i></a>
            <a href="#" class="add size"></a>
            <a href="#" class="add model"></a>
        </div>
        <div class="btn-mas">
            <label for="btn-mas" class="fa fa-plus"></label>
        </div>
    </div> -->

</body>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="scripts/showSneakers.js"></script>
<script src="scripts/search.js"></script>
</html>