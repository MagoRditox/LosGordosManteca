<?php
	session_start();
	if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: login.php");
		exit;
        }
	require_once ("config/db.php");
	require_once ("config/conexion.php");
	
	$active_estadisticas="active";
	$title="estadisticas";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
	<?php include("head.php");?>
  </head>
  <body>
 	<?php
	include("navbar.php");
	?> 
    <div class="container">
		<div class="panel panel-success">
		<div class="panel-heading">
			<h4><i class='glyphicon glyphicon-search'></i> Estadisticas</h4>
		</div>			
			<div class="panel-body">
			<?php

			?>
				<div id="resultados"></div>
				<div class='outer_div'></div>
						
			</div>
		</div>

	</div>
	<hr>
	<?php
	include("footer.php");
	?>
	<script type="text/javascript" src="js/usuarios.js"></script>
  </body>
</html>
<script>