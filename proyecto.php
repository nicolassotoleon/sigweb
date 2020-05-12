<html>
	<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="shortcut icon" type="image/x-icon" href="imagenes/icono.jpg">
	
    <title>ACTIVE PARKING</title>
    <link rel="stylesheet" href="css/estilos.css">
	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css" />
   <!-- Make sure you put this AFTER Leaflet's CSS -->
	<script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js"></script>
   
   <!--MENU DE CAPAS-->
    <link rel="stylesheet" href="lib/leaflet-groupedlayercontrol/dist/leaflet.groupedlayercontrol.min.css" />
	<script src="lib/leaflet-groupedlayercontrol/dist/leaflet.groupedlayercontrol.min.js"></script>
   
   <!--botones-->
	<link rel="stylesheet" href="lib/leaflet-easybutton/easy-button.css" />
	<script src="lib/leaflet-easybutton/easy-button.js"></script>   

    <!-- Dependency to Leaflet Draw -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/0.3.2/leaflet.draw.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/0.3.2/leaflet.draw.js"></script>
	
    <!-- Files from current project -->
    <link rel="stylesheet" href="lib/leaflet.measurecontrol.css" />
    <script src="lib/leaflet.measurecontrol.js"></script>

	
	<style>
        html, body, #mapid {
            width: 100%;
            height: 90%;
            padding: 0;
            margin: 0;
		}
		
		.leaflet-control-draw-measure {
			background-image: url(images/measure-control.png);
		}
		
		
		
    </style>
	</head>
	<body>
<?php
		// Inicio y acceso al sistema, Controla estar logeado en la sesión
		session_start(); // se inicia una sesión
		$rol = $_SESSION['nombre_u'];		
		if($rol){

?>		
<div id="registro">
			 <!-- LETRERO DE ARRIBA DEL MAPA, DONDE SE DA UN SALUDO AL USUARIO QUE INICIA SESION -->
			<h3> ¡Bienvenido  a Active Parking, <?php echo $rol; ?>!</h3> 
			<body onload="loadLocation();">
</div>

			<div id="mapid"></div>

			<body>
			<form method="post" action="proyecto.html">
			<br>
			<!-- LETRERO DE ABAJO DONDE SE IMPRIME INFORMACION Y SE ANEXA BOTON PARA CERRAR LA SESION -->
			<div id="cerrar_seccion">
			<h3>LOS PARQUEADEROS UBICADOS EN EL CIRCULO ROJO
			ESTAN EN EL RANGO DE 1.5 KILOMETROS DESDE TU UBICACION</h3>
			</div>
			<div id="registro">
			<a href='cerrar_seccion.php'>Cerrar Sesion</a>
			</div>
			</form>
			<?php
		//FINAL DE CONDICION DE SESION, SI NO HAY ABIERTA IMPRIME LETRERO "INICIAR SESION"
					}
						
					else{ // Si no se ha creado el parámetro usuario retornará este mensaje en HTML
						echo '<p><a href="ingreso_usuarios.php">Iniciar Sesion</a></p>'; // Enlace de inicio de sesión en HTML
					}

?>
		
		<script> <!-- Se define JavaScript -->
	//VARIABLE DE CUADRO DEL MAPA Y MAPA BASE CON OPEN STREET MAPS"	
	var mymap = L.map('mapid').setView([3.40, -76.5], 11.4);
	var OpenStreetMap = L.tileLayer('http://a.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: 'Map tiles by <a href="http://stamen.com">Stamen Design</a>, <a href="http://creativecommons.org/licenses/by/3.0">CC BY 3.0</a> &mdash; Map data &copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
	}).addTo(mymap);
	
	//CONTROL PARA MEDIR SOBRE LA CARTOGRAFIA"
	L.Control.measureControl().addTo(mymap);		
	
	/*WMS PARQUEADEROS*/
	var wmsLayer1 = L.tileLayer.wms('http://www.appmap.gis-cdn.net/geoserver/proyecto_sig/wms?', {
	layers: 'proyecto_sig:parqueaderos_motos',
	attribution: 'parqueaderos_motos',
	format: 'image/png',
	transparent: true,
	});
	wmsLayer1.addTo(mymap);
	
	/*POPUP*/
	/*var source3 = L.WMS.source("http://www.appmap.gis-cdn.net/geoserver/proyecto_sig/wms?", {
   		opacity: 0.1,
	});
	source3.getLayer("parqueaderos_motos").addTo(mymap);*/

	var wmsLayer2 = L.tileLayer.wms('http://www.appmap.gis-cdn.net/geoserver/proyecto_sig/wms?', {
	layers: 'proyecto_sig:parqueaderos_carros',
	attribution: 'parqueaderos_carros',
	format: 'image/png',
	transparent: true,
	});
	wmsLayer2.addTo(mymap);
	
	/*POPUP*/
	/*var source1 = L.WMS.source("http://localhost:8080/geoserver/proyecto_sig/wms?", {
   		opacity: 0.1,
	});
	source1.getLayer("parqueaderos_carros").addTo(mymap);*/
	
	var wmsLayer3 = L.tileLayer.wms('http://www.appmap.gis-cdn.net/geoserver/proyecto_sig/wms?', {
	layers: 'proyecto_sig:parqueaderos_camion1',
	attribution: 'parqueaderos_camion1',
	format: 'image/png',
	transparent: true,
	});
	wmsLayer3.addTo(mymap);
	
	/*POPUP*/
	/*var source2 = L.WMS.source("http://localhost:8080/geoserver/proyecto_sig/wms?", {
		opacity: 0.1,
	});
	source2.getLayer("parqueaderos_camion1").addTo(mymap);*/
	
	var wmsLayer4 = L.tileLayer.wms('http://www.appmap.gis-cdn.net/geoserver/proyecto_sig/wms?', {
	layers: 'proyecto_sig:parqueaderos_camion2',
	attribution: 'parqueaderos_camion2',
	format: 'image/png',
	transparent: true,
	});
	wmsLayer4.addTo(mymap);


	/*CONTROL DE CAPAS*/
	var groupedOverlays = {
		"Motos": wmsLayer1,
		"carros": wmsLayer2,
		"camion1": wmsLayer3,
		"camion2": wmsLayer4
	};
	L.control.groupedLayers(groupedOverlays).addTo(mymap);

	/*UBICACION SIN PEDIRLA*/
	function loadLocation () {
		//inicializamos la funcion y definimos  el tiempo maximo ,las funciones de error y exito.
		navigator.geolocation.getCurrentPosition(viewMap,ViewError,{timeout:1000});
	}
	
	
	
	//HACE PARTE DE LA UBICACION, TAMBIEN SE ANEXA LA UBICACION DEL USUARIO CON UNA MARCA SOBRE LA CARTOGRAFIA MAS UN RADIO DE BUSQUEDA QUE ES UN CIRCULO
	function viewMap (position) { 
		var lon = position.coords.longitude;	//guardamos la longitud
		var lat = position.coords.latitude;		//guardamos la latitud
		/*UBICACION DE USUARIO*/
		var marker = L.marker([lat, lon]).addTo(mymap);
		marker.bindPopup("¡Aqui estas!");
		/*RADIO DE BUSQUEDA*/
		var elem = document.getElementById('rango')
		var circle = L.circle([lat, lon], {
				color: 'red',
				fillColor: 'blue',
				fillOpacity: 0.3,
				radius: 1500
			}).addTo(mymap);
		
		
		var link = "http://maps.google.com/?ll="+lat+","+lon+"&z=14";
		document.getElementById("long").innerHTML = "Longitud: "+lon;
		document.getElementById("latitud").innerHTML = "Latitud: "+lat;

		document.getElementById("link").href = link;
	}

	function ViewError (error) {
	alert(error.code);
	}

	
	//BOTON PARA ABRIR TUTORIAL
	L.easyButton('<img src="img/Un dedo Filled-50.png" width=25 >', function(btn, map)
	{
		window.location="https://www.youtube.com/watch?v=1w7OgIMMRc4"
	}).addTo( mymap );	
	


    </script>

	</body>

</html>