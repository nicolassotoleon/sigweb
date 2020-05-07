<?php
include 'conexion_bd.php'; // Se incluye el archivo de conexión a la base de datos
$dbcon = conexion(); // se crea una variable con la función definida anteriormente

/*$sql ="INSERT INTO ubic (latitud, longitud)
    VALUES ('$lat', '$lon');";
	
	$resultado = pg_query($dbcon, $sql);*/
?>
	
    <meta charset="UTF-8">
	<title>FILTRO DE DATOS ACTIVE PARKING</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="shortcut icon" type="image/x-icon" href="imagenes/icono.jpg">
	<link rel="stylesheet" href="css/estilos.css">
	
	<header>
	
	<body onload="loadLocation();">
	<label id="long"></label> <br/>
	<label id="latitud"></label>
		<div id="cabecera">
		<FONT FACE="impact" SIZE=6 COLOR="white">ACTIVE PARKING</FONT>
		</div>

	</header>
	
		<form method="post" action="factores_usuarios.php">
		<div id="registro">
		<span>Seleccione tipo vehiculo:</span><br><br>
		<select name="seleccione" id="seleccion">
			<option value="parqueaderos_motos">moto</option>
			<option value="parqueaderos_carros">carro</option>
			<option value="parqueaderos_camion1">camion1</option>
			<option value="parqueaderos_camion2">camion2</option>
		<label for="rango">Ingrese radio de busqueda:</label>
		<input type="text" placeholder="radio en metros" name="rango" id="rango"><br><br>
		<a input href="proyecto.html" class="button" >BUSCAR PARQUEADEROS</a>
		</div>
		</form>
	
<?php



?>
	
<script>
	/*UBICACION SIN PEDIRLA*/
	function loadLocation () {
		//inicializamos la funcion y definimos  el tiempo maximo ,las funciones de error y exito.
		navigator.geolocation.getCurrentPosition(viewMap,ViewError,{timeout:1000});
	}
	
	//Funcion de exito
	function viewMap (position) {
	
		var lon = position.coords.longitude;	//guardamos la longitud
		var lat = position.coords.latitude;		//guardamos la latitud


		document.getElementById("long").innerHTML = "Longitud: "+lon;
		document.getElementById("latitud").innerHTML = "Latitud: "+lat;

	}

	function ViewError (error) {
	alert(error.code);
	}
	

</script>	
		