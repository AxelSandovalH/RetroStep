<?php 
    require_once("../connection.php");

    $user_id = $_POST["user_id"];

    $sql_select = "SELECT deleted_at FROM users WHERE id = $user_id";
    $result = mysqli_query($connection, $sql_select);

    if (mysqli_num_rows($result) > 0) {
        $sql_restore = "UPDATE users SET deleted_at = NULL WHERE id = $user_id";
        $result_restore = mysqli_query($connection, $sql_restore);
        echo "User restored successfully";

    } else {
        echo "Error: " . $sql_restore . "<br>" . mysqli_error($connection);
    }

?>