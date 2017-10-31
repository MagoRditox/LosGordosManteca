<?php
	session_start();
	if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: login.php");
		exit;
        }
	require_once ("config/db.php");
	require_once ("config/conexion.php");
	
	$active_estadisticas="active";
	$title="Estadisticas | Simple Invoice";
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
		    <div class="btn-group pull-right">
				<button type='button' class="btn btn-success" data-toggle="modal" data-target="#nuevoCliente"><span class="glyphicon glyphicon-plus" ></span> Nueva Categoría</button>
			</div>
			<h4><i class='glyphicon glyphicon-search'></i> Buscar Categorías</h4>
		</div>
		<div class="panel-body">
			<?php
				include("modal/registro_categorias.php");
				include("modal/editar_categorias.php");
			?>
			<form class="form-horizontal" role="form" id="datos_cotizacion">
				
						<div class="form-group row">
							<label for="q" class="col-md-2 control-label">Nombre</label>
							<div class="col-md-5">
								<input type="text" class="form-control" id="q" placeholder="Nombre de la categoría" onkeyup='load(1);'>
							</div>
							<div class="col-md-3">
								<button type="button" class="btn btn-default" onclick='load(1);'>
									<span class="glyphicon glyphicon-search" ></span> Buscar</button>
								<span id="loader"></span>
							</div>
							
						</div>
			</form>
			<?php

				$sql = "SELECT `codigo_producto` FROM `products`";
				$stmt = $con->prepare($sql);
       			$stmt->execute();
       			$stmt->bind_result($codig);
       			while($stmt->fetch()){
       				$codigos[] = $codig;
       			}
				$lenght = sizeof($codigos);

				for($i=0;$i<$lenght;$i++){
					$codigo = (string) $codigos[$i];

					$sql = "SELECT `products`.`precio_producto`, `historial`.`fecha` FROM `products`, `historial` WHERE `historial`.`referencia` = '$codigo' AND `products`.`codigo_producto` = '$codigo'";
					$stmt = $con->prepare($sql);
	       			$stmt->execute();
	       			$stmt->bind_result($precio, $fecha);


	       			echo "<table border=1>
			      	 	 	 <tr>
			      	 	 	 	<td> Fecha </td>
			      	 	 	 	<td> Concepto </td>
			      	 	 	 	<td COLSPAN = 3 > Entradas </td>
			      	 	 	 	<td COLSPAN = 3 > Salidas </td>
			      	 	 	 	<td> Saldo </td>
			      		 	</tr>
	       				";
			        while($stmt->fetch()){
			       	 	echo "
			      	 	 	 <tr>
			                   	<td>$fecha</td>
			                   	<td>$precio</td>
			                   	<td></td> <td></td> <td></td>
			                   	<td></td> <td></td> <td></td>
			                   	<td></td> 
			      		 	</tr>
			       			";
			       		}
				       		echo "<br>";
	       			}
			?>
  </div>
</div>
		 
	</div>
	<hr>
	<?php
	include("footer.php");
	?>
	<script type="text/javascript" src="js/categorias.js"></script>
  </body>
</html>
