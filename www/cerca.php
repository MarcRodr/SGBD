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
				   <option value="1">Electric Guitar</option>
				   <option value="2">Acoustic Guitar</option>
				   <option value="3">Bass</option>
				   <option value="4">Drums</option>
				   <option value="5">Piano/Keyboard</option>
				   <option value="6">Vocalist</option>
				   <option value="7">Violin</option>
				   <option value="8">Double Bass</option>
				   <option value="9">Trumpet</option>
				   <option value="10">Saxophone</option>
				   <option value="11">Trombone</option>
				   <option value="12">Accordion</option>
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
				   <option value="1">Rock</option>
				   <option value="2">Pop</option>
				   <option value="3">Ska</option>
				   <option value="4">Reggae</option>
				   <option value="5">Electronic</option>
				   <option value="6">Metal</option>
				   <option value="7">Reggaeton</option>
				   <option value="8">Folk</option>
				   <option value="9">Funk</option>
				   <option value="10">Hip Hop</option>
				   <option value="11">Jazz</option>
				   <option value="12">Indie</option>
				   <option value="13">Flamenco</option>
				   <option value="14">Classic</option>
				   <option value="15">Blues</option>
				   <option value="16">Rap</option>
				   <option value="17">Punk</option>
				   <option value="18">Psychedelic</option>
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