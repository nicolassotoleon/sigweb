<?php
include 'conexion_bd.php'; // Se incluye el archivo de conexión a la base de datos
$dbcon = conexion(); // se crea una variable con la función definida anteriormente

?>
	
    <meta charset="UTF-8">
	<title>ACTUALIZAR ACTIVE PARKING</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="shortcut icon" type="image/x-icon" href="imagenes/icono.jpg">
	<link rel="stylesheet" href="css/estilos.css">
	
	<header>
		<div id="cabecera">
		<FONT FACE="impact" SIZE=6 COLOR="white">ACTIVE PARKING</FONT>
		</div>

	</header>
	
	
		<form method="post" action="actualizar_datos.php">
		<div id="registro">
			<form>
			<span>Seleccione tipo vehiculo:</span><br><br>
			<select name="seleccione" id="seleccion">
				<option value="parqueaderos_motos">moto</option>
				<option value="parqueaderos_carros">carro</option>
				<option value="parqueaderos_camion1">camion1</option>
				<option value="parqueaderos_camion2">camion2</option>
			<input type="text" placeholder="numero de cupos" name="cupo"><br><br>
			<input type="text" placeholder="id del parqueadero" name="id_parq"><br><br>
			<input name="actualizar" type="submit" value="actualizar informacion" onclick= "document.location.href = 'proyecto.html'">
			</form>
		</div>
		</form>
	
<?php


if(isset($_POST['actualizar'])){ //De acuerdo con el formulario definido aquí se ejecuta cuando presionamos el botón registro 
    $seleccion=$_POST['seleccione'];
	$cupo=$_POST['cupo'];	// Se guarda en una variable cada entrada definida en el formulario
	$id_parq=$_POST['id_parq'];
	
	 // Se consulta que no exista ningún campo vacío
		$sql = "UPDATE $seleccion set disp = '$cupo' where id_pq = $id_parq ";;
		$resultado = pg_query($dbcon, $sql); // Se ejecuta la consulta en PostgreSQL con la conexión definida anteriormente

		if(pg_affected_rows($resultado)==1){ //Si el registro es exitoso, retorna el valor de 1
			echo '<p>¡Actualizacion exitosa!</p>'; // Mensaje de salida en HTML
			echo '<p><a href="actualizar_datos.php">actualizar mas datos</a></p>'; // Mensaje de salida en HTML
		}else{
			echo 'actualizacion Fallida, Usuario no disponible'; // Si el registro no es exitoso, retorna el mensaje en HTML
		}	
	
}

?>
		
		


