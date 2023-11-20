<?php 
    require_once("../connection.php");

    $sneaker_id = $_POST["sneaker_id"];
    $id_stock = $_POST["id_stock"];

    // Verificar si el stock con el ID dado existe y si está relacionado con una sneaker
    $sql_select = "SELECT * FROM stock INNER JOIN sneaker
                    ON stock.sneaker_id = sneaker.sneaker_id
                    WHERE id_stock = $id_stock";
    $result = mysqli_query($connection, $sql_select);

    if (mysqli_num_rows($result) > 0) {
        // Restaurar el registro en la tabla stock
        $sql_restore_stock = "UPDATE stock SET deleted_at = NULL WHERE id_stock = $id_stock";
        $result_restore_stock = mysqli_query($connection, $sql_restore_stock);

        // Verificar si se restauró correctamente en la tabla stock
        if ($result_restore_stock) {
            // Restaurar el registro en la tabla sneaker
            $sql_restore_sneaker = "UPDATE sneaker SET deleted_at = NULL WHERE sneaker_id = $sneaker_id";
            $result_restore_sneaker = mysqli_query($connection, $sql_restore_sneaker);

            // Verificar si se restauró correctamente en la tabla sneaker
            if ($result_restore_sneaker) {
                echo "Sneaker restored successfully";
            } else {
                echo "Error restoring sneaker: " . mysqli_error($connection);
            }
        } else {
            echo "Error restoring stock: " . mysqli_error($connection);
        }
    } else {
        echo "Error: Stock not found or not associated with a sneaker.";
    }
?>
