<?php
include '../db.php';

   if(isset($_GET['btnSubmit'])) 
		{ 
		$artName = (isset($_GET['artistName']) ? $_GET['artistName'] : null);
		$oldArtName = (isset($_GET['PreviousArtistName']) ? $_GET['PreviousArtistName'] : null);
		$artID = (isset($_GET['artistID']) ? $_GET['artistID'] : null);

		if (strcmp($oldArtName, $artName) == 0)
			{
			$sql = "UPDATE Artists SET artName=? WHERE artID=?";	

			$stmt = $conn->prepare($sql);

			$stmt->bind_param("si", $artName, $artID);
			$stmt->execute();

			if ($stmt->errno) {
				echo "failed to update record" .$stmt->error;
			}
			else header("Location: http://avon.cs.nott.ac.uk/~psyam12/artist/select_artist.php");

			$stmt->close(); 
			}
		else 
			{
			$result = mysql_query("SELECT * FROM Artists WHERE artName='".$artName."'");
			$num_rows = mysql_num_rows($result);

			if ($num_rows > 0) 
				{
				echo "Unable to update artist attributes.  Another artist has the same name.";
				echo "  Return back to view artists page: http://avon.cs.nott.ac.uk/~psyam12/artist/select_artist.php";
				}
			else 
				{
				$sql = "UPDATE Artists SET artName=? WHERE artID=?";	

				$stmt = $conn->prepare($sql);

				$stmt->bind_param("si", $artName, $artID);
				$stmt->execute();

				if ($stmt->errno) {
					echo "failed to update record" .$stmt->error;
				}
				else header("Location: http://avon.cs.nott.ac.uk/~psyam12/artist/select_artist.php");

				$stmt->close(); 
				}
			}
		}
   
	if(isset($_GET['btnDelete'])) 
		{ 
		$artID = (isset($_GET['artistID']) ? $_GET['artistID'] : null);

		$sql = "DELETE FROM Artists WHERE artID=?";

		$stmt = $conn->prepare($sql);

		$stmt->bind_param("i", $artID);
		$stmt->execute();

		if ($stmt->errno) {
			echo "failed to update record" .$stmt->error;
		}
		else header("Location: http://avon.cs.nott.ac.uk/~psyam12/artist/select_artist.php");

		$stmt->close(); 
		}
?>