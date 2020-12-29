<html>
 <body>
<?php 
include '../layout.html';
include '../db.php';
?>
<p><font size="6">View Albums</font></p>
<p><font size="5">Here you can view the albums currently present in the database.  <br>Albums can be sorted in alphabetical order, by album ID number or by artist name, then alphabetically by album name.</br></font></p>
<hr>

<form align="center">
  <input type="text" id="searchAlbum" name="searchAlbum" placeholder="Insert Album Name">
  <input type="submit" id="btnSearchAlbum" name="btnSearchAlbum" value="Search">
</form>

<?php
	if(isset($_GET['btnSearchAlbum'])) 
		{
		$albumTitle = (isset($_GET['searchAlbum']) ? $_GET['searchAlbum'] : null);
		$albumTitleInput = mysql_real_escape_string($albumTitle);
		
		$result = mysql_query("SELECT * FROM Albums INNER JOIN Artists USING (artID) WHERE albumTitle LIKE '%" .$albumTitleInput. "%'");
		
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
		}
	else 
		{	
		if ($_GET['sort'] == 'aID')
			{
			$result = mysql_query("SELECT * FROM Albums INNER JOIN Artists USING (artID) ORDER BY albumID ASC");
			}
		else if ($_GET['sort'] == 'aArtist')
			{
			$result = mysql_query("SELECT * FROM Albums INNER JOIN Artists USING (artID) ORDER BY artName, albumTitle ASC");	
			}
		else if ($_GET['sort'] == 'aName')
			{
			$result = mysql_query("SELECT * FROM Albums INNER JOIN Artists USING (artID) ORDER BY albumTitle ASC");		
			}
		else 
			{
			$result = mysql_query("SELECT * FROM Albums INNER JOIN Artists USING (artID)");
			}
			
		echo "<div style='overflow-x:auto;'>
		<table border='1', table align='center', id='tableAttributes'>
		<tr>
		<th><a href='select_album.php?sort=aID'>Album ID</th>
		<th><a href='select_album.php?sort=aArtist'>Album Artist</th>
		<th><a href='select_album.php?sort=aName'>Album Name</th>
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
		}
?>
<p align = 'center'><a href="http://avon.cs.nott.ac.uk/~psyam12/album/insert_album.php">Add Album</a></p>
<hr>
 </body>
</html>