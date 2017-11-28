	<?php
		if (isset($title))
		{
	?>
<nav class="navbar navbar-default ">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">INVOUT</a>
    </div>
  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">

            <li class="<?php if (isset($active_usuarios)){echo $active_usuarios;}?>"><a href="usuarios.php"><i  class='glyphicon glyphicon-user'></i> Usuarios</a></li>

            <li class="<?php if (isset($active_productos)){echo $active_productos;}?>"><a href="stock.php"><i class='glyphicon glyphicon-barcode'></i> Inventario</a></li>

		        <li class="<?php if (isset($active_categoria)){echo $active_categoria;}?>"><a href="categorias.php"><i class='glyphicon glyphicon-tags'></i> Categorías</a></li>

            <li class="<?php if (isset($active_estadisticas)){echo $active_estadisticas;}?>"><a href="estadisticas.php"><i class=' glyphicon glyphicon-usd'></i> Estadisticas</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li style="color: cyan; margin-top: 10px; font-size: 20px;">| Nombre Modelo |<?php echo'' ?> </li>
		    <li><a href="login.php?logout"><i class='glyphicon glyphicon-off'></i> Salir</a></li>
      </ul>
    </div>
  </div>
</nav>
	<?php
		}
	?>