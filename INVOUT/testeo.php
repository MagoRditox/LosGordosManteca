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
					$sql = "SELECT `id_producto`, `fecha`, `cantidad`, `precio` FROM `historial` ";
					$stmt = $con->prepare($sql);
	       			$stmt->execute();
	       			$stmt->bind_result();

	       			echo "
	       					<LINK REL=StyleSheet HREF='estadisticasest.css' TYPE='text/css'>
	       					<table border=3>
			      	 	 	 <tr>
			      	 	 	 	<td> $codigo </td>
			      	 	 	 	<td>  </td>
			      	 	 	 	<td COLSPAN = 3 > <strong>Entradas </td>
			      	 	 	 	<td COLSPAN = 3 > <strong>Salidas </td>
			      	 	 	 	<td COLSPAN = 3 > <strong>Saldo </td>
			      		 	</tr>
			      		 	<tr>
			      		 		<td> <strong>Fecha </td>
			      	 	 	 	<td> <strong>Concepto </td>
			      	 	 	 	<td> <strong>cantidad</td> <td> <strong>Compra Unidad</td><td> <strong>Compra Total</td>
			      	 	 	 	<td> <strong>cantidad</td> <td> <strong>Venta Unidad</td><td> <strong>Venta Total</td>
			      	 	 	 	<td> <strong>cantidad</td> <td> <strong>Venta Unidad</td><td> <strong>Venta Total</td>
			      		 	</tr>
	       				";
			        while($stmt->fetch()){
			        	echo "<strong>Balance Total: </strong>$".number_format($balance, 2, ",", ".");
			       	 	echo "	

			      	 	 	 <tr>

			                   	<td>$fecha</td>

			                   	<td>"; if ($coincidenciasalida == true){echo "<strong>Venta";} if ($coincidenciaentrada == true){echo "<strong>Compra";} echo"</td>

			                   	<td>"; if ($coincidenciaentrada == true){ echo number_format($cantidad, 0, ",", ".") ;} echo"</td> <td>"; if ($coincidenciaentrada == true){ echo "$".number_format($precio, 2, ",", ".") ;} echo"</td> <td>"; if ($coincidenciaentrada == true){ echo "$".number_format(($cantidad*$precio), 2, ",", "."); $suma = ($cantidad*$precio) + $suma;} echo"</td>

			                   	<td>"; if ($coincidenciasalida == true){ echo number_format($cantidad, 0, ",", ".") ;} echo"</td> <td>"; if ($coincidenciasalida == true){ echo "$".number_format($precio, 2, ",", ".") ;} echo"</td> <td>"; if ($coincidenciasalida == true){ echo "$".number_format(($cantidad*$precio), 2, ",", "."); $resta = ($cantidad*$precio) + $resta;} echo"</td>

			                   	<td>$cantidad</td> <td>";echo "$".number_format($precio, 2, ",", "."); echo"</td> <td>";echo "$".number_format(($cantidad*$precio), 2, ",", ".") ; echo"</td>

			      		 	</tr>
			       			";
			       			
			       		}
			       			echo"
			       				<tr><td COLSPAN = 11 >"; $sumatoria = $suma - $resta; echo "<strong>Saldo total:</strong> $".number_format($sumatoria, 2, ",", "."); echo"</td></tr>

			       				<tr><td COLSPAN = 11 >";echo "<strong>Stock:</strong> ".number_format($stock, 0, ",", ".")." unidades."; echo"</td></tr>
			       				";
				       		echo "<br>";
				       		$balance = $sumatoria + $balance;
	       			}
	       		
			?>
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