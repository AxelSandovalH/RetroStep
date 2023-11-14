<?php 
    require_once("../connection.php");

    $user_id = $_POST["user_id"];

    $sql_select = "SELECT * FROM user WHERE id = $user_id";
    $result = mysqli_query($connection, $sql_select);

    if (mysqli_num_rows($result) > 0) {
        $sql_delete = "DELETE FROM users WHERE id = $user_id";
        $result_delete = mysqli_query($connection, $sql_delete);
        echo "User deleted successfully";

    } else {
        echo "Error: " . $sql_delete . "<br>" . mysqli_error($connection);
    }

?>