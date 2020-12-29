<html>
 <body>
<?php include '../layout.html';?>
<p><font size="6">View Albums</font></p>
<p><font size="5">Here you can view the albums currently present in the database for a specific artist.  </font></p>
<hr>

<?php
	include '../db.php';
	
	$result = mysql_query("SELECT * FROM Albums INNER JOIN Artists USING (artID) WHERE artID=" .$_GET['artID']);
		
	echo "<div style='overflow-x:auto;'>
	<table border='1', table align='center', id='tableAttributes'>
	<tr>
	<th>Album ID</th>
	<th>Album Artist</th>
	<th>Album Name</th>
	<th>Album Genre</th>
	<th>Number of Tracks</th>
	<th>Album Price (in £)</th>
	<th></th>
	</tr>";

	while($row = mysql_fetch_array($result))
	  {
	  echo "<tr>";
	  echo "<td align='center'>" . $row['albumID'] . "</td>";
	  echo "<td align='center'>" . $row['artName'] . "</td>";
	  echo "<td align='center'>" . $row['albumTitle'] . "</td>";
	  echo "<td align='center'>" . $row['albumGenre'] . "</td>";
	  echo "<td align='center'>" . $row['albumNumOfTracks'] . "</td>";
	  echo "<td align='center'>" . $row['albumPrice'] . "</td>";
	  echo "<td align='center'> <a href=\"update_album.php?albumID=" .$row['albumID']. "&artName=" .$row['artName']. "&albumTitle=" .$row['albumTitle']. "&albumGenre=" .$row['albumGenre']. "&albumNumOfTracks=" .$row['albumNumOfTracks']. "&albumPrice=" .$row['albumPrice']. "\">Edit</a>·<a href=\"http://avon.cs.nott.ac.uk/~psyam12/track/select_albumTracks.php?albumID=" .$row['albumID']. "\">Tracks</a> </td>";
	  echo "</tr>";
	  }
	echo "</table>";
?>
<p align = 'center'><a href="http://avon.cs.nott.ac.uk/~psyam12/album/insert_album.php">Add Album</a></p>
<hr>
 </body>
</html>