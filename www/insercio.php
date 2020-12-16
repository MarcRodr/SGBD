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
		//$data = ["_id" => 300, "name" => "Tres Cientos","description" => "Gran pelicula","photo" => "http://300.png","contact" => "300@gmail.com","style" => 1,"instrumentSearched" => 1];
		$client = new MongoDB\Client('mongodb+srv://sgdb:Hhtsod9xdj2JH6dK@sgbdcluster.wq7u4.mongodb.net/Music?retryWrites=true&w=majority');//conexio amb Mongo
		$db = $client->Music;//selecionem la colecicio de musics
		if(intval($query['grup_music'])==2){
			$id = $db->Musician->count() + 1;
			$data = ["_id" => $id, "name" => $query['Nom'],"description" => $query['Descripcio'],"photo" => $query['URL'],"contact" => $query['Email'],"style" => intval($query['OS']),"instrument" => intval($query['instrument'])];
			$db->Musician->insertOne($data);
			$db->User->updateOne(array("_id" => 2),array('$push' => array("musicians" => $id)));
		}
		if(intval($query['grup_music'])==1){
			$id = $db->Band->count() + 1;
			$data = ["_id" => $id, "name" => $query['Nom'],"description" => $query['Descripcio'],"photo" => $query['URL'],"contact" => $query['Email'],"style" => intval($query['OS']),"instrument" => intval($query['instrument'])];
			$db->Band->insertOne($data);
			$db->User->updateOne(array("_id" => 2),array('$push' => array("bands" => $id)));
		}

		?>
	<script src="js/jquery-3.1.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>