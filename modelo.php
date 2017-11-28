<head>
  	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
  	<title>INVOUT</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="	sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
   	<link href="css/login.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
<body>
 <div class="container">
        <div class="card card-container">
            <p align="center" class="modelo-name" id="modelo-name" style="color: black; "><b>SELECCION UN MODELO</b></p>
            <form method="post" accept-charset="utf-8"  name="modeloform" autocomplete="off" role="form" class="form-signin">
 				<input type="radio" name="gender" value="fifo" checked> FIFO<br>
  				<input type="radio" name="gender" value="lifo"> LIFO<br>
  				<input type="radio" name="gender" value="promedio_ponderado"> PROMEDIO PONDERADO<br>
  				<br>
                <button type="submit" class="btn btn-lg btn-success btn-block btn-signin" name="modelo" id="modelo">Seleccionar modelo</button>
            </form>
        </div>
    </div>
  </body>
</html>