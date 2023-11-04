<?php 
    include ("../scripts/routeProtection.php");

    if(isset($_GET['idUser'])) {
        $idUser = $_GET['idUser'];
    
        if(isset($_GET['confirmed']) && $_GET['confirmed'] === 'yes') {
            $queryDelete = mysqli_query($connection, 
            "DELETE FROM users
            WHERE 
            id = $idUser");
    
            if ($queryDelete) {
                header("location: users.php");
            }
        } else {
            echo "Eliminación cancelada. <a href='users.php'>Volver</a>";
            header("location: users.php");
        }
    }

?>







