<?php
include 'conexion_bd.php'; 
$dbcon = conexion(); 
session_start(); 
?>
	
    <meta charset="UTF-8">
	<title>OPERARIO ACTIVE PARKING</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="shortcut icon" type="image/x-icon" href="imagenes/icono.jpg">
	<link rel="stylesheet" href="css/estilos.css">

<header>
		<div id="cabecera">
		<FONT FACE="impact" SIZE=6 COLOR="white">ACTIVE PARKING</FONT>
		</div>
</header>

<?php

echo '	<form method="post" action="ingreso_operario.php">
			<div id="registro">
			<label for="usuario">Ingrese su usuario - operario:</label>
			<input type="text" placeholder="operario" name="loperario"><br><br>
			<label for="contraseña">Ingrese su contraseña - operario:</label>
			<input type="text" placeholder="contraseña" name="lcontraseña_o"><br><br>
			<input name=login type="submit" value="Ingresar"><br><br>
			</div>
			</form>';



if(isset($_POST['login'])){ 
    $loperario=$_POST['loperario']; 
	$lcontraseña_o=($_POST['lcontraseña_o']); 
	
	if (!empty($loperario) && !empty($lcontraseña_o)){ 
		$sql ="SELECT usuario, contraseña FROM operarios WHERE usuario ='$loperario'"; 
		$resultado = pg_query($dbcon, $sql); 
		if($row = pg_fetch_array($resultado)){ 
			if($row["contraseña"] == $lcontraseña_o){ 
				$_SESSION['usuario'] = $row['usuario']; 
				   echo '<script language="javascript">'; 
				   echo 'location.href = "actualizar_datos.php";'; 
				   echo '</script>';			   
			}else{
			   echo 'Contraseña Incorrecta'; // 
			}
		}else{
		  echo 'Usuario no existente en la base de datos'; 
		}
		
	}else{
		echo 'Inicio Sesión Fallido, Campos vacíos'; 
	}
}
?>