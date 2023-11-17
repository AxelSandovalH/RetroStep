<?php
    include("connection.php");

    if (isset($_GET['id'])) {
        $userId = $_GET['id'];

        // Consulta para obtener los datos del usuario con el ID proporcionado
        $query = "SELECT * FROM users WHERE id = $userId";

        $result = mysqli_query($connection, $query);

        if ($result) {
            $userData = mysqli_fetch_assoc($result);
            // Aquí puedes mostrar el formulario con los datos del usuario
            // Formato del formulario, utilizando $userData para rellenar los campos
        } else {
            echo "Error al obtener los datos del usuario: " . mysqli_error($connection);
        }
    } else {
        echo "ID de usuario no proporcionado";
    }
?>
