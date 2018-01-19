<?php
	$pdo = new PDO('sqlite:chinook.db');
	$sql = 'select * from genres ';
	$statement = $pdo->prepare($sql);
	$statement->execute();
	$genres = $statement->fetchAll(PDO::FETCH_OBJ);
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Genres</title>
	</head>
	<body>
		<?php foreach ($genres as $genre) : ?>
			<a href = <?php echo "tracks.php?genre=" . $genre->Name ?> > 
				<?php echo $genre->Name ?><br> 
			</a>
		<?php endforeach ?>
	</body>
</html>