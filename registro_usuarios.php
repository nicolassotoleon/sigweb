<?php
include 'conexion_bd.php'; // Se incluye el archivo de conexión a la base de datos
$dbcon = conexion(); // se crea una variable con la función definida anteriormente
?>
	
    <meta charset="UTF-8">
	<title>REGISTRO ACTIVE PARKING</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="shortcut icon" type="image/x-icon" href="imagenes/icono.jpg">
	<link rel="stylesheet" href="css/estilos.css">
	
	<header>
		<div id="cabecera">
		<FONT FACE="impact" SIZE=6 COLOR="white">ACTIVE PARKING</FONT>
		</div>

	</header>
	
	
		<form method="post" action="registro_usuarios.php">
		<div id="registro">
			<form>
			<label for="usuario">Ingrese su usuario:</label><br>
			<input type="text" placeholder="usuario" name="R_usuario"><br><br>
			<label for="usuario">Ingrese su nombre completo:</label><br>
			<input type="text" placeholder="nombre" name="R_nombre"><br><br>			
			<label for="contraseña">Ingrese su contraseña:</label><br>
			<input type="text" placeholder="contraseña" name="R_contraseña"><br><br>
			<label for="correo">Ingrese su correo electronico:</label><br>
			<input type="text" placeholder="correo" name="R_correo"><br><br>
			<label for="telefono">Ingrese su numero telefonico:</label><br>
			<input type="text" placeholder="telefono" name="R_telefono"><br><br>
			<input name="registro" type="submit" value="Guardar informacion">
			</form>
		</div>
		</form>
	
<?php
if(isset($_POST['registro'])){ //De acuerdo con el formulario definido aquí se ejecuta cuando presionamos el botón registro 
    $R_usuario=$_POST['R_usuario'];
	$R_nombre=$_POST['R_nombre'];	// Se guarda en una variable cada entrada definida en el formulario
	$R_contraseña=$_POST['R_contraseña']; // Se guarda en una variable cada entrada definida en el formulario
	$R_correo=$_POST['R_correo']; // Se guarda en una variable cada entrada definida en el formulario
	$R_telefono=($_POST['R_telefono']); // Se guarda en una variable cada entrada definida en el formulario (codificamos la contraseña en MD5)
	
	if (!empty($R_usuario) && !empty($R_contraseña) && !empty($R_correo) && !empty($R_telefono)){ // Se consulta que no exista ningún campo vacío
		$sql ="INSERT INTO usuario( id_u, nombre_u, correo_u, contraseña_U , numero_telefono_u) VALUES('$R_usuario', '$R_nombre','$R_correo', '$R_contraseña','$R_telefono');"; // Ingreso de registro en SQL (parametros de usuario)
		$resultado = pg_query($dbcon, $sql); // Se ejecuta la consulta en PostgreSQL con la conexión definida anteriormente

		if(pg_affected_rows($resultado)==1){ //Si el registro es exitoso, retorna el valor de 1
			echo '<p>Registro exitoso</p>'; // Mensaje de salida en HTML
			echo '<p><a href="ingreso_usuarios.php">Inicio Sesion</a></p>'; // Mensaje de salida en HTML
		}else{
			echo 'Registro Fallido, Usuario no disponible'; // Si el registro no es exitoso, retorna el mensaje en HTML
		}	
	}else{
		echo 'Registro Fallido, Campos vacíos'; // Si existe algún campo vacío, retorna el mensaje en HTML
	}
}

?>
		
		