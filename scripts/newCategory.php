<?php
// include("scripts/routeProtection.php");
include("connection.php");

if (!empty($_POST)) {
    $category_name = $_POST["category_name"];

    $category_name = mysqli_real_escape_string($connection, $category_name);
    
    $querySelect = mysqli_query($connection, "SELECT * FROM category WHERE (category_name = '$category_name');");

    $result = mysqli_fetch_array($querySelect);

    if ($result > 0) {
        echo 'That category already exists';
    } else {
        $queryInsert = mysqli_multi_query($connection, "INSERT INTO category (category_name) VALUES ('$category_name');");

        if ($queryInsert) {
            echo 'Category saved successfully.';
        } else {
            echo "Error: " . mysqli_error($connection);
            echo "Affected rows: " . mysqli_affected_rows($connection);
        }
    }
    // }
}
?>