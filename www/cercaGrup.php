<?php
//Pre:$instrument i $estil SON int, 0 es wildcard.
function cercaGrup($instrument,$estil){
$client = new MongoDB\Client('mongodb+srv://sgdb:Hhtsod9xdj2JH6dK@sgbdcluster.wq7u4.mongodb.net/Test1?retryWrites=true&w=majority');//conexio amb Mongo
$collection = $client->Music->Band;//selecionem la colecicio de musics
$filtre = [];//definim la veriable filtre

if($instrument!=0){//Si estem filtran per instrument, afagim l'instrument al llistat de restriccions.
	$filtre = array_merge($filtre,['instrumentSearched' => $instrument]);
}
if($estil!=0){//Idem amb estil de musica
	$filtre = array_merge($filtre,['style' => $estil]);
}
$result=[];//declarem result
$result = $collection->find($filtre);

return $result;
}