<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>
<nav id="sidebar">
            <div class="sidebar-header">
                <a href="main.php"><h3><img src="img/LogoRS.png" class="img-fluid"/><span>RetroStep</span></h3></a>
            </div>
            <ul class="list-unstyled components">

			<li  <?php if ($current_page == 'main.php') echo 'class="active"'; ?>>
                    <a href="main.php" class="dashboard"><i class="material-icons">dashboard</i><span>Main</span></a>
            </li>
                
            <li <?php if ($current_page == 'sneakers.php') echo 'class="active"';   // Lógica para que cambie según la página en que te encuentras?>> 
                <a href="sneakers.php">
                <i class="material-icons">apps</i><span>Inventory</span></a>
            </li>

            <li <?php if ($current_page == 'users.php') echo 'class="active"'; ?>>
                <a href="users.php">
                <i class="material-icons">people</i><span>Users</span></a>
            </li>

            <li <?php if ($current_page == 'archived.php') echo 'class="active"'; ?>>
                <a href="archived.php">
                <i class="material-icons">archive</i><span>Deleted</span></a>
            </li>
           
        </nav>
