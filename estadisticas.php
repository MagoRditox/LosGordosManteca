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
			</div>
			<h4><i class='glyphicon glyphicon-search'></i> Buscar Balance</h4>
		</div>
		<div class="panel-body">
			<?php
				include("modal/registro_categorias.php");
				include("modal/editar_categorias.php");
			?>
			<form class="form-horizontal" role="form" id="datos_cotizacion">
				
						<div class="form-group row">
							<label for="q" class="col-md-2 control-label">Codigo</label>
							<div class="col-md-5">
								<input type="text" class="form-control" id="q" placeholder="Codigo del Producto" onkeyup='load(1);'>
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
				$balance = 0;


				for($i=0;$i<$lenght;$i++){
					$codigo = (string) $codigos[$i];

					$suma = 0;
					$resta = 0;

					$sql = "SELECT `products`.`precio_producto`, `historial`.`fecha`, `historial`.`cantidad`, `historial`.`nota`, `products`.`stock` FROM `products`, `historial` WHERE `historial`.`referencia` = '$codigo' AND `products`.`codigo_producto` = '$codigo'";
					$stmt = $con->prepare($sql);
	       			$stmt->execute();
	       			$stmt->bind_result($precio, $fecha, $cantidad, $concepto, $stock);

	       			echo "<table border=3 HEIGHT='1000%'>
			      	 	 	 <tr>
			      	 	 	 	<td> $codigo </td>
			      	 	 	 	<td>  </td>
			      	 	 	 	<td COLSPAN = 3 > Entradas </td>
			      	 	 	 	<td COLSPAN = 3 > Salidas </td>
			      	 	 	 	<td COLSPAN = 3 > Saldo </td>
			      		 	</tr>
			      		 	<tr>
			      		 		<td> Fecha </td>
			      	 	 	 	<td> Concepto </td>
			      	 	 	 	<td> cantidad</td> <td>Venta Unidad</td><td>Venta Total</td>
			      	 	 	 	<td> cantidad</td> <td>Venta Unidad</td><td>Venta Total</td>
			      	 	 	 	<td> cantidad</td> <td>Venta Unidad</td><td>Venta Total</td>
			      		 	</tr>
	       				";
			        while($stmt->fetch()){

						$salida = $concepto;
						$elimino = 'eliminó';
						$coincidenciasalida = strpos($salida, $elimino);

						$entrada = $concepto;
						$agrego = 'agregó';
						$coincidenciaentrada = strpos($entrada, $agrego);
			       	 	echo "	
			      	 	 	 <tr>
			                   	<td>$fecha</td>
			                   	<td>"; if ($coincidenciasalida == true){echo "Venta";} if ($coincidenciaentrada == true){echo "Compra";} echo"</td>
			                   	<td>"; if ($coincidenciaentrada == true){ echo number_format($cantidad, 0, ",", ".") ;} echo"</td> <td>"; if ($coincidenciaentrada == true){ echo "$".number_format($precio, 2, ",", ".") ;} echo"</td> <td>"; if ($coincidenciaentrada == true){ echo "$".number_format(($cantidad*$precio), 2, ",", "."); $suma = ($cantidad*$precio) + $suma;} echo"</td>
			                   	<td>"; if ($coincidenciasalida == true){ echo number_format($cantidad, 0, ",", ".") ;} echo"</td> <td>"; if ($coincidenciasalida == true){ echo "$".number_format($precio, 2, ",", ".") ;} echo"</td> <td>"; if ($coincidenciasalida == true){ echo "$".number_format(($cantidad*$precio), 2, ",", "."); $resta = ($cantidad*$precio) + $resta;} echo"</td>
			                   	<td>$cantidad</td> <td>";echo "$".number_format($precio, 2, ",", "."); echo"</td> <td>";echo "$".number_format(($cantidad*$precio), 2, ",", ".") ; echo"</td>
			      		 	</tr>
			       			";
			       			
			       		}
			       			echo"
			       				<tr><td COLSPAN = 11 >"; $sumatoria = $suma - $resta; echo "Saldo total: $".number_format($sumatoria, 2, ",", "."); echo"</td></tr>
			       				<tr><td COLSPAN = 11 >";echo "Stock: ".number_format($stock, 0, ",", ".")." unidades."; echo"</td></tr>
			       				";
				       		echo "<br>";
				       		$balance = $sumatoria + $balance;
	       			}
	       		echo "Balance Total: $".number_format($balance, 2, ",", ".");
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
