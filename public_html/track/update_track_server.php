<?php
include '../db.php';

   if(isset($_GET['btnSubmit'])) 
		{ 
		$trackID = (isset($_GET['InsertTrackID']) ? $_GET['InsertTrackID'] : null);
		$trackTitle = (isset($_GET['InsertTrackTitle']) ? $_GET['InsertTrackTitle'] : null);
		$oldTrackTitle = (isset($_GET['PreviousTrackTitle']) ? $_GET['PreviousTrackTitle'] : null);
		$albumID = (isset($_GET['InsertAlbumName']) ? $_GET['InsertAlbumName'] : null);
		$oldAlbumID = (isset($_GET['PreviousAlbumID']) ? $_GET['PreviousAlbumID'] : null);
		$trackRunningTime = (isset($_GET['InsertTrackRunningTime']) ? $_GET['InsertTrackRunningTime'] : null);
		
		if (strcmp($oldTrackTitle, $trackTitle) == 0)
			{
			if (strcmp($oldAlbumID, $albumID) != 0)			
				{
				$albumfull1 = mysql_query("SELECT COUNT(*) FROM Tracks WHERE albumID=" .$albumID);
				$albumfull2 = mysql_query("SELECT albumNumOfTracks FROM Albums WHERE albumID=" .$albumID);

				$albumfullvalue1 = implode(mysql_fetch_row($albumfull1));
				$albumfullvalue2 = implode(mysql_fetch_row($albumfull2));

				if ($albumfullvalue1 >= $albumfullvalue2)
					{
					echo "Cannot add more tracks to the album.  The album selected is full.  To edit the number of tracks present in a given album, use the edit feature on the album page.";
					}
				else
					{
					$sql = "UPDATE Tracks SET trackTitle=?, albumID=?, trackRunningTime=? WHERE trackID=?";	

					$stmt = $conn->prepare($sql);

					$stmt->bind_param('siii', $trackTitle, $albumID, $trackRunningTime, $trackID);
					$stmt->execute();

					if ($stmt->errno) {
						echo "failed to update record" .$stmt->error;
					}
					else header("Location: http://avon.cs.nott.ac.uk/~psyam12/track/select_track.php");

					$stmt->close(); 
					}
				}
			else
				{
				$sql = "UPDATE Tracks SET trackTitle=?, albumID=?, trackRunningTime=? WHERE trackID=?";	

				$stmt = $conn->prepare($sql);

				$stmt->bind_param('siii', $trackTitle, $albumID, $trackRunningTime, $trackID);
				$stmt->execute();

				if ($stmt->errno) {
					echo "failed to update record" .$stmt->error;
				}
				else header("Location: http://avon.cs.nott.ac.uk/~psyam12/track/select_track.php");

				$stmt->close(); 	
				}
			}
		else	
			{
			if (strcmp($oldAlbumID, $albumID) != 0)		
				{
				$albumfull1 = mysql_query("SELECT COUNT(*) FROM Tracks WHERE albumID=" .$albumID);
				$albumfull2 = mysql_query("SELECT albumNumOfTracks FROM Albums WHERE albumID=" .$albumID);

				$albumfullvalue1 = implode(mysql_fetch_row($albumfull1));
				$albumfullvalue2 = implode(mysql_fetch_row($albumfull2));

				if ($albumfullvalue1 >= $albumfullvalue2)
					{
					echo "Cannot add more tracks to the album.  The album selected is full.  To edit the number of tracks present in a given album, use the edit feature on the album page.";
					}
				else
					{
					$result = mysql_query("SELECT * FROM Tracks WHERE trackTitle='".$trackTitle."'");
					$num_rows = mysql_num_rows($result);
					
					if ($num_rows > 0) 
						{
						echo "Unable to update track attributes.  The name is used in another track.";
						echo "  Return back to view tracks page: http://avon.cs.nott.ac.uk/~psyam12/track/select_track.php";
						}
					else 
						{
						$sql = "UPDATE Tracks SET trackTitle=?, albumID=?, trackRunningTime=? WHERE trackID=?";	

						$stmt = $conn->prepare($sql);

						$stmt->bind_param('siii', $trackTitle, $albumID, $trackRunningTime, $trackID);
						$stmt->execute();

						if ($stmt->errno) {
							echo "failed to update record" .$stmt->error;
						}
						else header("Location: http://avon.cs.nott.ac.uk/~psyam12/track/select_track.php");

						$stmt->close(); 
						}
					}	
				}
			else			
				{
				$result = mysql_query("SELECT * FROM Tracks WHERE trackTitle='".$trackTitle."'");
				$num_rows = mysql_num_rows($result);
					
				if ($num_rows > 0) 
					{
					echo "Unable to update track attributes.  The name is used in another track.";
					echo "  Return back to view tracks page: http://avon.cs.nott.ac.uk/~psyam12/track/select_track.php";	
					}
				else 
					{
					$sql = "UPDATE Tracks SET trackTitle=?, albumID=?, trackRunningTime=? WHERE trackID=?";	

					$stmt = $conn->prepare($sql);

					$stmt->bind_param('siii', $trackTitle, $albumID, $trackRunningTime, $trackID);
					$stmt->execute();

					if ($stmt->errno) {
						echo "failed to update record" .$stmt->error;
					}
					else header("Location: http://avon.cs.nott.ac.uk/~psyam12/track/select_track.php");

					$stmt->close(); 
					}
				}
			}
		}
   
	if(isset($_GET['btnDelete'])) 
		{ 
		$trackID = (isset($_GET['InsertTrackID']) ? $_GET['InsertTrackID'] : null);

		$sql = "DELETE FROM Tracks WHERE trackID=?";

		$stmt = $conn->prepare($sql);

		$stmt->bind_param("i", $trackID);
		$stmt->execute();

		if ($stmt->errno) {
			echo "failed to update record" .$stmt->error;
		}
		else header("Location: http://avon.cs.nott.ac.uk/~psyam12/track/select_track.php");

		$stmt->close(); 
		}
?>