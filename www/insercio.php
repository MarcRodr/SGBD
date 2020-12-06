<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>Insercio completada</title>
	<link rel="stylesheet" href="css/estilos.css">
</head>
<body background = "img/background.jpg">
	<form action="menu.html" class="menu">
		<label for="Nom">Inserció completada amb èxit!</label>
		<p class="text-center">
			<button class="btn btn-primary btn-block">Tornar al menú principal</button>
		</p>
		<?php
		
		$url = $_SERVER['REQUEST_URI'];//Obtenim la url amb els perametres
		$query_str = parse_url($url,PHP_URL_QUERY);//Parsegem la url per obtenir un string amb els parametres
		parse_str($query_str,$query);//Parsejem l'string anterior per tal de obtenir un conjunt clau valor amb la query
		require 'vendor/autoload.php'; // include Composer's autoloader
		
		?>
	<script src="js/jquery-3.1.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>