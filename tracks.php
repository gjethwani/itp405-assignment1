<?php
	$genre = $_GET['genre'];
	$pdo = new PDO('sqlite:chinook.db');
	$sql = 'select tracks.Name as trackName, albums.Title as albumName, artists.Name as artist, tracks.UnitPrice as price
	from tracks 
	inner join albums
	on albums.AlbumId = tracks.AlbumId
	inner join artists
	on artists.ArtistId = albums.ArtistId
	where tracks.GenreId=(select genres.GenreId from genres where genres.Name= ? )';
	$statement = $pdo->prepare($sql);
	$statement->bindParam(1, $genre);
	$statement->execute();
	$tracks = $statement->fetchAll(PDO::FETCH_OBJ);
?>
<!DOCTYPE html>
<html>
	<?php echo '<script>console.log("' . $sql .'")</script>'?>
	<head>
		<title>Tracks</title>
	</head>
	<body>
		<table>
			<tr>
				<th>Track Name</th>
				<th>Album Title</th>
				<th>Artist Name</th>
				<th>Price</th>
			</tr>
			<?php foreach($tracks as $track) : ?>
				<tr>
					<td> <?php echo $track->trackName ?> </td>
					<td> <?php echo $track->albumName ?> </td>
					<td> <?php echo $track->artist ?> </td>
					<td> <?php echo $track->price ?> </td>
				</tr>
			<?php endforeach ?>
		</table>
	</body>
</html>