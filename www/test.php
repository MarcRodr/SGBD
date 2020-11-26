 <!DOCTYPE html>
<html>
<body>
<?php
	require 'vendor/autoload.php'; // include Composer's autoloader

	$client = new MongoDB\Client('mongodb+srv://sgdb:Hhtsod9xdj2JH6dK@sgbdcluster.wq7u4.mongodb.net/Test1?retryWrites=true&w=majority');
	$collection = $client->Music->Musician;

	$result = $collection->find(
		[
			'name' => 'Reef Langley',
		]
	);
	foreach ($result as $entry) {
		echo $entry['contact'], "\n";
	}
	$url = $_SERVER['REQUEST_URI'];
	var_dump(parse_url($url));
?>

</body>
</html>