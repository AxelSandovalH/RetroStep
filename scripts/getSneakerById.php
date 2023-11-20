<?php
require_once "../connection.php";

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["sneaker_id"])) {
    $sneaker_id = $_GET["sneaker_id"];
    $id_stock = $_GET["id_stock"];

    $query = "SELECT s.sneaker_id, s.sneaker_name, s.brand_name, s.category_name, st.size_number, s.price, s.imagen_url, st.stock_quantity, st.id_stock
                FROM sneaker s
                LEFT JOIN stock st ON s.sneaker_id = st.sneaker_id
                WHERE st.id_stock = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("i", $id_stock);

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $sneaker = $result->fetch_assoc();
        echo json_encode($sneaker);
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $connection->close();
} else {
    echo "Invalid Request";
}
?>
