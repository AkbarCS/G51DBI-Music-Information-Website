<?php						
include '../db.php'; 
					
$artName = (isset($_GET['artistName']) ? $_GET['artistName'] : null);

$result = mysql_query("SELECT * FROM Artists WHERE artName='" .$artName. "'");
$num_rows = mysql_num_rows($result);

if ($num_rows > 0) 
	{
	echo "Unable to insert artist.  Another artist has the same name.";
	echo "  Return back to view artists page: http://avon.cs.nott.ac.uk/~psyam12/artist/select_artist.php";
	}
else 
	{
	$sql = "INSERT INTO Artists (artName) VALUES (?)";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param('s', $artName);
	$result = $stmt->execute();
	if (!$result) echo "failed to insert record";
	else header("Location: http://avon.cs.nott.ac.uk/~psyam12/artist/select_artist.php");
	}
?>