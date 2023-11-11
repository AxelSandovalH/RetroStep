<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>
<nav id="sidebar">
            <div class="sidebar-header">
                <h3><img src="img/logoRS.png" class="img-fluid"/><span>RetroStep</span></h3>
            </div>
            <ul class="list-unstyled components">
			<li  <?php if ($current_page == 'main.php') echo 'class="active"'; ?>>
                    <a href="main.php" class="dashboard"><i class="material-icons">dashboard</i><span>Dashboard</span></a>
                </li>
                
                <li <?php if ($current_page == 'sneakers.php') echo 'class="active"';   // Lógica para que cambie según la página en que te encuentras?>> 
                    <a href="sneakers.php">
					<i class="material-icons">apps</i><span>Nice view</span></a>
                    <!-- <ul class="collapse list-unstyled menu" id="pageSubmenu2">
                        <li>
                            <a href="#">Page 1</a>
                        </li>
                        <li>
                            <a href="#">Page 2</a>
                        </li>
                        <li>
                            <a href="#">Page 3</a>
                        </li>
                    </ul> -->
                </li>

           
        </nav>
