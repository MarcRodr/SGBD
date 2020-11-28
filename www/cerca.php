<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>Cercador de grups/músics</title>
	<link rel="stylesheet" href="css/estilos.css">
</head>
<body background = "img/background.jpg">
	<form action="cerca.php" class="sidebar">
		<h3 class="text-center">Cercar grups o músics:</h3>
		<div class="form-group">
			<div class="form-group">
				<label for="grup_music">Grup/músic:</label>
			</div>
			<div class="form-group">
				<select name="grup_music">
				   <option selected value="0"> Mostrar tot </option>
				   <option value="1">Grup de música</option>
				   <option value="2">Músic</option>
				</select>
			</div>
		</div>
		<hr>
		<div class="form-group">
			<div class="form-group">
				<label for="instrument">Instrument:</label>
			</div>
			<div class="form-group">
				<select name="instrument">
				   <option selected value="0"> Mostrar tot </option>
				   <option value="1">Grups de música</option>
				   <option value="2">Músic/a</option>
				   <option value="3">Grups de música</option>
				   <option value="4">Músic/a</option>
				   <option value="5">Grups de música</option>
				   <option value="6">Músic/a</option>
				   <option value="7">Grups de música</option>
				   <option value="8">Músic/a</option>
				   <option value="9">Grups de música</option>
				   <option value="10">Músic/a</option>
				   <option value="11">Grups de música</option>
				   <option value="12">Músic/a</option>
				</select>
			</div>
		</div>
		<hr>
		<div class="form-group">
			<div class="form-group">
				<label for="estilmusica">Estil de música:</label>
			</div>
			<div class="form-group">
				<select name="OS">
				   <option selected value="0"> Mostrar tot </option>
				   <option value="1">Grups de música</option>
				   <option value="2">Músic/a</option>
				   <option value="3">Grups de música</option>
				   <option value="4">Músic/a</option>
				   <option value="5">Grups de música</option>
				   <option value="6">Músic/a</option>
				   <option value="7">Grups de música</option>
				   <option value="8">Músic/a</option>
				   <option value="9">Grups de música</option>
				   <option value="10">Músic/a</option>
				   <option value="11">Grups de música</option>
				   <option value="12">Músic/a</option>
				</select>
			</div>
		</div>
		<p class="text-center">
			<button class="btn btn-primary btn-block">Aplicar filtres</button>
		</p>
	<script src="js/jquery-3.1.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	</form>
	<form action="menu.html" class="menu">
		<?php
		
		$url = $_SERVER['REQUEST_URI'];//Obtenim la url amb els perametres
		$query_str = parse_url($url,PHP_URL_QUERY);//Parsegem la url per obtenir un string amb els parametres
		parse_str($query_str,$query);//Parsejem l'string anterior per tal de obtenir un conjunt clau valor amb la query
		require 'vendor/autoload.php'; // include Composer's autoloader
		include 'cercaMusic.php';
		include 'cercaGrup.php';

		if(intval($query['grup_music'])==0 or intval($query['grup_music'])==2){
			$Mresult = [];
			$Mresult = cercaMusic(intval($query['instrument']),intval($query['OS']));
			foreach ($Mresult as $entry) {
				echo $entry['contact'], "\n";
			}
		}
		
		if(intval($query['grup_music'])==0 or intval($query['grup_music'])==1){
			$Gresult = [];
			$Gresult = cercaGrup(intval($query['instrument']),intval($query['OS']));
			foreach ($Gresult as $entry) {
				echo $entry['contact'], "\n";
			}
		}
		?>
	<script src="js/jquery-3.1.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	</form>
</body>
</html>