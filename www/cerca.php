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

		$client = new MongoDB\Client('mongodb+srv://sgdb:Hhtsod9xdj2JH6dK@sgbdcluster.wq7u4.mongodb.net/Test1?retryWrites=true&w=majority');//conexio amb Mongo
		$collection = $client->Music->Musician;//selecionem la colecicio de musics
		
		$filtre = [];//definim la veriable filtre
		
		if(intval($query['instrument'])!=0){//Si estem filtran per instrument, afagim l'instrument al llistat de restriccions.
			$filtre = array_merge($filtre,['instrument' => intval($query['instrument'])]);
		}
		if(intval($query['OS'])!=0){//Idem amb estil de musica
			$filtre = array_merge($filtre,['style_searched' => intval($query['OS'])]);
		}
		$result=[];//declarem result
		if($filtre!=[]){//en cas de que el filtre estigui buit, deixem result en blanc
			$result = $collection->find($filtre);
		}
		foreach ($result as $entry) {
			echo $entry['contact'], "\n";
		}
		?>
	<script src="js/jquery-3.1.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	</form>
</body>
</html>