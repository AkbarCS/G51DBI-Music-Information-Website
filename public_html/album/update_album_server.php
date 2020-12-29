<?php
include '../db.php';

   if(isset($_GET['btnSubmit'])) 
		{ 
		$albumID = (isset($_GET['InsertAlbumID']) ? $_GET['InsertAlbumID'] : null);
		$albumTitle = (isset($_GET['InsertAlbumTitle']) ? $_GET['InsertAlbumTitle'] : null);
		$oldAlbumTitle = (isset($_GET['PreviousAlbumTitle']) ? $_GET['PreviousAlbumTitle'] : null);
		$artID = (isset($_GET['InsertArtistName']) ? $_GET['InsertArtistName'] : null);
		$albumGenre = (isset($_GET['InsertAlbumGenre']) ? $_GET['InsertAlbumGenre'] : null);
		$albumNumOfTracks = (isset($_GET['InsertAlbumNumOfTracks']) ? $_GET['InsertAlbumNumOfTracks'] : null);
		$albumPrice = (isset($_GET['InsertAlbumPrice']) ? $_GET['InsertAlbumPrice'] : null);

		if (strcmp($oldAlbumTitle, $albumTitle) == 0)
			{
			$sql = "UPDATE Albums SET albumTitle=?, artID=?, albumGenre=?, albumNumOfTracks=?, albumPrice=? WHERE albumID=?";	

			$stmt = $conn->prepare($sql);

			$stmt->bind_param('sisidi', $albumTitle, $artID, $albumGenre, $albumNumOfTracks, $albumPrice, $albumID);
			$stmt->execute();

			if ($stmt->errno) {
				echo "failed to update record" .$stmt->error;
			}
			else header("Location: http://avon.cs.nott.ac.uk/~psyam12/album/select_album.php");

			$stmt->close(); 
			}
		else 
			{
			$result = mysql_query("SELECT * FROM Albums WHERE albumTitle='".$albumTitle."'");
			$num_rows = mysql_num_rows($result);

			if ($num_rows > 0) 
				{
				echo "Unable to update album attributes.  Another album has the same name.";
				echo "  Return back to view albums page: http://avon.cs.nott.ac.uk/~psyam12/album/select_album.php";
				}
			else 
				{
				$sql = "UPDATE Albums SET albumTitle=?, artID=?, albumGenre=?, albumNumOfTracks=?, albumPrice=? WHERE albumID=?";	

				$stmt = $conn->prepare($sql);

				$stmt->bind_param('sisidi', $albumTitle, $artID, $albumGenre, $albumNumOfTracks, $albumPrice, $albumID);
				$stmt->execute();

				if ($stmt->errno) {
					echo "failed to update record" .$stmt->error;
				}
				else header("Location: http://avon.cs.nott.ac.uk/~psyam12/album/select_album.php");

				$stmt->close(); 
				}
			}
		}
   
	if(isset($_GET['btnDelete'])) 
		{ 
		$albumID = (isset($_GET['InsertAlbumID']) ? $_GET['InsertAlbumID'] : null);

		$sql = "DELETE FROM Albums WHERE albumID=?";

		$stmt = $conn->prepare($sql);

		$stmt->bind_param("i", $albumID);
		$stmt->execute();

		if ($stmt->errno) {
			echo "failed to update record" .$stmt->error;
		}
		else header("Location: http://avon.cs.nott.ac.uk/~psyam12/album/select_album.php");

		$stmt->close(); 
		}
?>