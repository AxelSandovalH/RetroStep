<?php
require_once "../connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["user_id"])) {
    $user_id = $_POST["user_id"];
    $username = $_POST["username"];
    $rol = $_POST["selectEditRole"];
    $email = $_POST["email"];

    $query = "UPDATE users SET username = ?, rol = ?, email = ? WHERE id = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("sssi", $username, $rol, $email, $user_id);

    if ($stmt->execute()) {
        echo "User updated successfully";
    } else {
        echo "Error updating user: " . $stmt->error;
    }

    $stmt->close();
    $connection->close();
} else {
    echo "Invalid Request";
}
?>
