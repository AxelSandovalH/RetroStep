<?php
// include("scripts/routeProtection.php");
include("../connection.php");

if (!empty($_POST)) {
    //Verificar que todos los campos estén llenos
    if (empty($_POST['username']) || empty($_POST['password']) || empty($_POST['email'])) {
        $alert = '<p class="msg_error">All fields must be filled out</p>';
    } else {
        //Recibir datos
        $username = $_POST["username"];
        $password = $_POST["password"];
        $email = $_POST["email"];
        $rol = $_POST["rol"];

        //Verificar que no exista un usuario con el mismo Username o Email
        $query = mysqli_query($connection, "SELECT * FROM users WHERE username = '$username' OR email = '$email' ");
        $result = mysqli_fetch_array($query);

        if ($result > 0) {
            echo 'Username or email already exists';
        } else {
            //Insertar los datos 
            $query_insert = mysqli_query($connection, "INSERT INTO users (username, password, email, rol) VALUES ('$username', md5('$password'), '$email', '$rol')");

            if ($query_insert) {
                // Redirigir a usuarios.php después de agregar el usuario
                header('Location: users.php');
                exit(); // Asegúrate de usar exit() después de la redirección para detener la ejecución del script actual
            } else {
                echo "Error: " . mysqli_error($connection);
                echo "Affected rows: " . mysqli_affected_rows($connection);
            }
        }
    }
}
?>