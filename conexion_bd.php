<?php
function conexion(){
$host = 'www.appmap.gis-cdn.net';
$port = '5432';
$base_datos = 'appmapgi_parking';
$usuario = 'appmapgi';
$pass = 'svY888O2bm';
$conexion = pg_connect("host=$host port=$port dbname=$base_datos user=$usuario password=$pass")
            or die("Error de Conexion".pg_last_error());
			
return($conexion);
}
?>