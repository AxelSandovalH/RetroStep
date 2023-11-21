<?php 
	session_start();

	// PROTECCIÓN DE RUTAS

	if ($_SESSION['rol'] == 2) {
		header("Location: acceso_denegado.php");
		exit();
	}
?>

<?php include_once('contents/header.php');?>
		
		<!-------------------------sidebar------------>
<?php include_once('contents/sidebar.php');?>
		     <!-- Sidebar  -->
        
		
		<!--------page-content---------------->
		
		
		   
		   <!--top--navbar----design--------->
<?php include_once('contents/top-header.php');?>		   
		   
		   <!--------main-content------------->
<?php include_once('contents/users-content.php');?>		   
		   
			 
			 <!---footer---->
<?php include_once('contents/footer.php');?>		