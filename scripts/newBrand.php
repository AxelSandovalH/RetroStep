<?php
// include("scripts/routeProtection.php");
include("connection.php");

if (!empty($_POST)) {
    $brand_name = $_POST["brand_name"];
    // $confirm_brand_name = $_POST["confirm_brand_name"];

    // if ($brand_name !== $confirm_brand_name) {
    //     echo '<p class="msgError">Los nombres de marca no coinciden. Por favor, inténtelo de nuevo.</p>';
    // } else {

    $brand_name = mysqli_real_escape_string($connection, $brand_name);
    
    $querySelect = mysqli_query($connection, "SELECT * FROM brand WHERE (brand_name = '$brand_name');");

    $result = mysqli_fetch_array($querySelect);

    if ($result > 0) {
        echo 'That brand already exists';
    } else {
        $queryInsert = mysqli_multi_query($connection, "INSERT INTO brand (brand_name) VALUES ('$brand_name');");

        if ($queryInsert) {
            echo 'Brand saved successfully.';
        } else {
            echo "Error: " . mysqli_error($connection);
            echo "Affected rows: " . mysqli_affected_rows($connection);
        }
    }
    // }
}
?>