<?php
include('is_logged.php');
	if (empty($_POST['codigo'])) {
           $errors[] = "Código vacío";
        } else if (empty($_POST['nombre'])){
			$errors[] = "Nombre del producto vacío";
		} else if ($_POST['stock']==""){
			$errors[] = "Stock del producto vacío";
		} else if (empty($_POST['precio'])){
			$errors[] = "Precio de venta vacío";
		} else if (
			!empty($_POST['codigo']) &&
			!empty($_POST['nombre']) &&
			$_POST['stock']!="" &&
			!empty($_POST['precio'])
		){
		require_once ("../config/db.php");
		require_once ("../config/conexion.php");
		include("../funciones.php");
		$codigo=mysqli_real_escape_string($con,(strip_tags($_POST["codigo"],ENT_QUOTES)));
		$nombre=mysqli_real_escape_string($con,(strip_tags($_POST["nombre"],ENT_QUOTES)));
		$stock=intval($_POST['stock']);
		$id_categoria=intval($_POST['categoria']);
		$precio_venta=floatval($_POST['precio']);
		$date_added=date("Y-m-d H:i:s");
		
		$sql="INSERT INTO products (codigo_producto, nombre_producto, date_added, precio_producto, stock, id_categoria) VALUES ('$codigo','$nombre','$date_added','$precio_venta', '$stock','$id_categoria')";
		$query_new_insert = mysqli_query($con,$sql);
			if ($query_new_insert){
				$messages[] = "Producto ha sido ingresado satisfactoriamente.";
				$id_producto=get_row('products','id_producto', 'codigo_producto', $codigo);
				$user_id=$_SESSION['user_id'];
				$firstname=$_SESSION['firstname'];
				$nota="$firstname agregó $stock producto(s) al inventario";
				echo guardar_historial($id_producto,$user_id,$date_added,$nota,$codigo,$stock);
				guardar_ingreso($id_producto,$date_added,$stock,$precio_venta);	
			} else{
				$errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($con);
			}
		} else {
			$errors []= "Error desconocido.";
		}
		if (isset($errors)){
			?>
			<div class="alert alert-danger" role="alert">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Error!</strong> 
					<?php
						foreach ($errors as $error) {
								echo $error;
							}
						?>
			</div>
			<?php
			}
			if (isset($messages)){	
				?>
				<div class="alert alert-success" role="alert">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>¡Bien hecho!</strong>
						<?php
							foreach ($messages as $message) {
									echo $message;
								}
							?>
				</div>
				<?php
			}
?>