<?php						
include '../db.php'; 
					
$trackTitle = (isset($_GET['InsertTrackTitle']) ? $_GET['InsertTrackTitle'] : null);
$albumID = (isset($_GET['InsertAlbumName']) ? $_GET['InsertAlbumName'] : null);
$trackRunningTime = (isset($_GET['InsertTrackRunningTime']) ? $_GET['InsertTrackRunningTime'] : null);

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
	$result = mysql_query("SELECT * FROM Tracks WHERE trackTitle='" .$trackTitle. "'");
	$num_rows = mysql_num_rows($result);

	if ($num_rows > 0) 
		{
		echo "Unable to insert track.  The name is used in another track.";
		echo "  Return back to view tracks page: http://avon.cs.nott.ac.uk/~psyam12/track/select_track.php";
		}
	else 
		{
		$sql = "INSERT INTO Tracks (trackTitle, albumID, trackRunningTime) VALUES (?, ?, ?)";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param('sii', $trackTitle, $albumID, $trackRunningTime);
		$result = $stmt->execute();
		if (!$result) echo "failed to insert record";							
		else header("Location: http://avon.cs.nott.ac.uk/~psyam12/track/select_track.php");
		}
	}
?>