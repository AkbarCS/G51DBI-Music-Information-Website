<?php						
include '../db.php'; 
					
$albumTitle = (isset($_GET['InsertAlbumTitle']) ? $_GET['InsertAlbumTitle'] : null);
$artID = (isset($_GET['InsertArtistName']) ? $_GET['InsertArtistName'] : null);
$albumGenre = (isset($_GET['InsertAlbumGenre']) ? $_GET['InsertAlbumGenre'] : null);
$albumNumOfTracks = (isset($_GET['InsertAlbumNumberofTracks']) ? $_GET['InsertAlbumNumberofTracks'] : null);
$albumPrice = (isset($_GET['InsertAlbumPrice']) ? $_GET['InsertAlbumPrice'] : null);
		
$result = mysql_query("SELECT * FROM Albums WHERE albumTitle='" .$albumTitle. "'");
$num_rows = mysql_num_rows($result);

if ($num_rows > 0) 
	{
	echo "Unable to insert album.  Another album has the same name.";
	echo "  Return back to view albums page: http://avon.cs.nott.ac.uk/~psyam12/album/select_album.php";
	}
else 
	{	
	$sql = "INSERT INTO Albums (albumTitle, artID, albumGenre, albumNumOfTracks, albumPrice) VALUES (?, ?, ?, ?, ?)";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param('sisid', $albumTitle, $artID, $albumGenre, $albumNumOfTracks, $albumPrice);
	$result = $stmt->execute();
	if (!$result) echo "failed to insert record";							
	else header("Location: http://avon.cs.nott.ac.uk/~psyam12/album/select_album.php");
	}
?>