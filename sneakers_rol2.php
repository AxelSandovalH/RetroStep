<?php 

include_once('contents/header.php');?>
		
		<!-------------------------sidebar------------>


<!-- SIDE BAR -->
<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>
<nav id="sidebar">
            <div class="sidebar-header">
                <h3><img src="img/logoR.png" class="img-fluid"/><span>RetroStep</span></h3>
            </div>
            <ul class="list-unstyled components">
			<li  <?php if ($current_page == 'main_rol2.php') echo 'class="active"'; ?>>
                    <a href="main_rol2.php" class="dashboard"><i class="material-icons">dashboard</i><span>Dashboard</span></a>
                </li>
                
                <li <?php if ($current_page == 'sneakers_rol2.php') echo 'class="active"';   // Lógica para que cambie según la página en que te encuentras?>> 
                    <a href="sneakers_rol2.php">
					<i class="material-icons">apps</i><span>Inventory</span></a>
</nav>


<!--top--navbar----design--------->
<?php include_once('contents/top-header.php');?>		   
		   

<!--------main-content------------->
<?php include_once('contents/sneakers-content_rol2.php');?>		   


<?php include_once('contents/footer.php');?>		   
		   	 
