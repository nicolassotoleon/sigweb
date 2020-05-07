<html lang="en">
<head>
	
    <meta charset="UTF-8">
	<title>INICIO ACTIVE PARKING</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="shortcut icon" type="image/x-icon" href="imagenes/icono.jpg">
	<link rel="stylesheet" href="css/estilos.css">

</head>
<header>
		<div id="cabecera">
		<FONT FACE="impact" SIZE=6 COLOR="white">ACTIVE PARKING</FONT>
		</div>
</header>

<body>
<div id="registro">
<?php
include 'conexion_bd.php'; 
$dbcon = conexion(); 
session_start();
echo '	<form method="post" action="ingreso_usuarios.php">
			<div id="registro">
			<label for="usuario">Ingrese su usuario:</label>
			<input type="text" placeholder="usuario" name="lusuario"><br><br>
			<label for="contraseña">Ingrese su contraseña:</label>
			<input type="text" placeholder="contraseña" name="lcontraseña"><br><br>
			<input name=login type="submit" value="Ingresar"><br><br>
			<a input href="registro_usuarios.php" class="button" >Registrate</a><br><br>
			<a input href="ingreso_operario.php" class="button" >Soy operario</a>			
			</div>
			</form>';
			
if(isset($_POST['login'])){ 
    $lusuario=$_POST['lusuario']; 
	$lcontraseña=($_POST['lcontraseña']); 
	$_SESSION['lusuario'] = $lusuario;
	if (!empty($lusuario) && !empty($lcontraseña)){ 
		$sql ="SELECT nombre_u, contraseña_u FROM usuario WHERE nombre_u='$lusuario'"; 
		$resultado = pg_query($dbcon, $sql); 
		if($row = pg_fetch_array($resultado)){ 
			if($row["contraseña_u"] == $lcontraseña){ 
				$_SESSION['nombre_u'] = $row['nombre_u']; 
				   echo '<script language="javascript">'; 
				   echo 'location.href = "index.php";'; 
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
</div>

 </body>
</html>
