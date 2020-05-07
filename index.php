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
   
	<style>
        html, body, #mapid {
            width: 100%;
            height: 90%;
            padding: 0;
            margin: 0;
		}
		
		
    </style>
	</head>
	<body>
<?php
		//  1-  Inicio y acceso al sistema, Controla estar logeado en la sesión
		session_start(); // se inicia una sesión

		$rol = $_SESSION['nombre_u'];
		
		if($rol){

?>		
<div id="registro">
			<p> ¡Bienvenido  a Active Parking, <?php echo $rol; ?>!</p> 
			<body onload="loadLocation();">
</div>

			<div id="mapid"></div>

			<body>
			<form method="post" action="proyecto.html">
			<br>

			<p>LOS PARQUEADEROS UBICADOS EN EL CIRCULO ROJO</p>
			<p>ESTAN EN EL RANGO DE 1.5 KILOMETROS DESDE TU UBICACION</p>
			<p><a href='cerrar_seccion.php'>Cerrar Sesion</a></p>
			</form>
			<?php
					}
						
					else{ // Si no se ha creado el parámetro usuario retornará este mensaje en HTML
						echo '<p><a href="ingreso_usuarios.php">Iniciar Sesion</a></p>'; // Enlace de inicio de sesión en HTML
					}

?>
		
		<script> <!-- Se define JavaScript -->
	var mymap = L.map('mapid').setView([3.40, -76.5], 11.4);
	var OpenStreetMap = L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
	}).addTo(mymap);
	
	/*WMS PARQUEADEROS*/
	var wmsLayer1 = L.tileLayer.wms('http://www.appmap.gis-cdn.net/geoserver/proyecto_sig/wms?', {
	layers: 'proyecto_sig:parqueaderos_motos',
	attribution: 'parqueaderos_motos',
	format: 'image/png',
	transparent: true,
	});
	wmsLayer1.addTo(mymap);
	
	/*POPUP*/
	/*var source3 = L.WMS.source("http://localhost:8080/geoserver/proyecto_sig/wms?", {
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
	
	
	
	//Funcion de exito
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
				radius: 200
			}).addTo(mymap);
		
		
		var link = "http://maps.google.com/?ll="+lat+","+lon+"&z=14";
		document.getElementById("long").innerHTML = "Longitud: "+lon;
		document.getElementById("latitud").innerHTML = "Latitud: "+lat;

		document.getElementById("link").href = link;
	}

	function ViewError (error) {
	alert(error.code);
	}
	



    </script>

	</body>

</html>