<html>
 <body>
<?php
include '../layout.html';
include '../db.php';
?>
<p><font size="6">View Tracks</font></p>
<p><font size="5">Here you can view the tracks currently present in the database.  <br>Tracks can be sorted in alphabetical order, by track ID number or by artist name, then alphabetically by album and track name.</br></font></p>
<hr>

<form align="center">
  <input type="text" id="searchTrack" name="searchTrack" placeholder="Insert Track Name">
  <input type="submit" id="btnSearchTrack" name="btnSearchTrack" value="Search">
</form>

<?php
	if(isset($_GET['btnSearchTrack'])) 
		{		
		$trackTitle = (isset($_GET['searchTrack']) ? $_GET['searchTrack'] : null);
		$trackTitleInput = mysql_real_escape_string($trackTitle);
		
		$result = mysql_query("SELECT * FROM Tracks INNER JOIN Albums USING (albumID) INNER JOIN Artists USING (artID) WHERE trackTitle LIKE '%" .$trackTitleInput. "%'");
		
		echo "<div style='overflow-x:auto;'>
		<table border='1', table align='center', id='tableAttributes'>
		<tr>
		<th>Track ID</th>
		<th>Track Artist</th>
		<th>Track Album</th>
		<th>Track Name</th>
		<th>Track Running Time (in seconds)</th>
		<th></th>
		</tr>";

		while($row = mysql_fetch_array($result))
		  {
		  echo "<tr>";
		  echo "<td align='center'>" . $row['trackID'] . "</td>";
		  echo "<td align='center'>" . $row['artName'] . "</td>";
		  echo "<td align='center'>" . $row['albumTitle'] . "</td>";
		  echo "<td align='center'>" . $row['trackTitle'] . "</td>";
		  echo "<td align='center'>" . $row['trackRunningTime'] . "</td>";
		  echo "<td align='center'> <a href=\"update_track.php?trackID=" .$row['trackID']. "&albumID=" .$row['albumID']. "&albumTitle=" .$row['albumTitle']. "&trackTitle=" .$row['trackTitle']. "&trackRunningTime=" .$row['trackRunningTime']. "\">Edit</a> </td>";
		  echo "</tr>";
		  }
		echo "</table>";
		}
	else 
		{
		if ($_GET['sort'] == 'tID')
			{
			$result = mysql_query("SELECT * FROM Tracks INNER JOIN Albums USING (albumID) INNER JOIN Artists USING (artID) ORDER BY trackID ASC");
			}
		else if ($_GET['sort'] == 'tName')
			{
			$result = mysql_query("SELECT * FROM Tracks INNER JOIN Albums USING (albumID) INNER JOIN Artists USING (artID) ORDER BY trackTitle ASC");	
			}
		else if ($_GET['sort'] == 'tArtist')
			{
			$result = mysql_query("SELECT * FROM Tracks INNER JOIN Albums USING (albumID) INNER JOIN Artists USING (artID) ORDER BY artName, albumTitle, trackTitle ASC");	
			}
		else
			{
			$result = mysql_query("SELECT * FROM Tracks INNER JOIN Albums USING (albumID) INNER JOIN Artists USING (artID)");
			}
			
		echo "<div style='overflow-x:auto;'>
		<table border='1', table align='center', id='tableAttributes'>
		<tr>
		<th><a href='select_track.php?sort=tID'>Track ID</th>
		<th><a href='select_track.php?sort=tArtist'>Track Artist</th>
		<th>Track Album</th>
		<th><a href='select_track.php?sort=tName'>Track Name</th>
		<th>Track Running Time (in seconds)</th>
		<th></th>
		</tr>";

		while($row = mysql_fetch_array($result))
		  {
		  echo "<tr>";
		  echo "<td align='center'>" . $row['trackID'] . "</td>";
		  echo "<td align='center'>" . $row['artName'] . "</td>";
		  echo "<td align='center'>" . $row['albumTitle'] . "</td>";
		  echo "<td align='center'>" . $row['trackTitle'] . "</td>";
		  echo "<td align='center'>" . $row['trackRunningTime'] . "</td>";
		  echo "<td align='center'> <a href=\"update_track.php?trackID=" .$row['trackID']. "&albumID=" .$row['albumID']. "&albumTitle=" .$row['albumTitle']. "&trackTitle=" .$row['trackTitle']. "&trackRunningTime=" .$row['trackRunningTime']. "\">Edit</a> </td>";
		  echo "</tr>";
		  }
		echo "</table>";
		}
?>
<p align = 'center'><a href="http://avon.cs.nott.ac.uk/~psyam12/track/insert_track.php">Add Track</a></p>
<hr>
 </body>
</html>