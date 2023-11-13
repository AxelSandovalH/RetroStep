<?php 
    require_once("../connection.php");

    $sneaker_id = $_POST["sneaker_id"];

    $sql_select = "SELECT deleted_at FROM sneaker WHERE sneaker_id = $sneaker_id";
    $result = mysqli_query($connection, $sql_select);

    if (mysqli_num_rows($result) > 0) {
        $sql_restore = "UPDATE sneaker SET deleted_at = NULL WHERE sneaker_id = $sneaker_id";
        $result_restore = mysqli_query($connection, $sql_restore);
        echo "Sneaker restored successfully";

    } else {
        echo "Error: " . $sql_restore . "<br>" . mysqli_error($connection);
    }

?>