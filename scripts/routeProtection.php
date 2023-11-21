<?php 
    include("connection.php");
    session_start();

    // Verifica si el usuario está autenticado y tiene un rol válido
    if (isset($_SESSION['id']) && isset($_SESSION['rol'])) {
        $user_role = $_SESSION['rol'];

        // Comprueba si el usuario tiene el rol adecuado para acceder a la página
        if ($user_role !== 1) {
            // Si el usuario no tiene el rol adecuado, redirige al main
            header("Location: main_rol2.php");
            exit();
        }
    } else {
        // Si el usuario no está autenticado, redirige al formulario de inicio de sesión
        header("Location: index.php");
        exit();
    }
?> 