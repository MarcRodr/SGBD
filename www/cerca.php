<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>Cercador de grups/músics</title>
	<link rel="stylesheet" href="css/estilos.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/w3.css">
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
		
		//** Parsegem URL **//
		$url = $_SERVER['REQUEST_URI'];//Obtenim la url amb els perametres
		$query_str = parse_url($url,PHP_URL_QUERY);//Parsegem la url per obtenir un string amb els parametres
		parse_str($query_str,$query);//Parsejem l'string anterior per tal de obtenir un conjunt clau valor amb la query
		
		//** Includes **/
		require 'vendor/autoload.php'; // include Composer's autoloader
		include 'mostrar.php';//funcio per mostrar els resultats
		
		//** Conexio amb la bdd **//
		$client = new MongoDB\Client('mongodb+srv://sgdb:Hhtsod9xdj2JH6dK@sgbdcluster.wq7u4.mongodb.net/Music?retryWrites=true&w=majority');//conexio amb Mongo
		$db = $client->Music;//selecionem la base de dades del projecte
		
		//** Declarem algunes variables **//
		$instrument =intval($query['instrument']);//Guardem en vriables per fer el codi mes llegible mes endevant
		$estil = intval($query['OS']);//Guardem en vriables per fer el codi mes llegible mes endevant
		$filtre =[];//Declarem filtre buit
		
		//** Construim el filtre **//
		if($instrument!=0){//Si estem filtran per instrument, afagim l'instrument al llistat de restriccions.
			$filtre = array_merge($filtre,['instrument' => $instrument]);
		}
		if($estil!=0){//Idem amb estil de musica
			$filtre = array_merge($filtre,['style' => $estil]);
		}
		
		//** Busquem **//
		if(intval($query['grup_music'])==0 or intval($query['grup_music'])==2){//Si estem buscant musics o tot:
			$result=[];//declarem result
			$result = $db->Musician->find($filtre);//Aplicem find de filtre sobre la coleccio Musician
			foreach ($result as $entry) {
				mostrar($entry);
			}
		}
		
		if(intval($query['grup_music'])==0 or intval($query['grup_music'])==1){//Si estem buscant grupos o tot:

			$result=[];//declarem result
			$result = $db->Band->find($filtre);//Aplicem find de filtre sobre la coleccio Band
			foreach ($result as $entry) {
				mostrar($entry);
			}
		}
		
		?>
	<script src="js/jquery-3.1.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	</form>
</body>
</html>