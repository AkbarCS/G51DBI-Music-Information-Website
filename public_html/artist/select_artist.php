<html>
 <body>
<?php
include '../layout.html';
include '../db.php';
?>
<p><font size="6">View Artists</font></p>
<p><font size="5">Here you can view the artists currently present in the database.  <br>Artists can be sorted by alphabetical order or by artist ID number.</br></font></p>
<hr>

<form align="center">
  <input type="text" id="searchArtist" name="searchArtist" placeholder="Insert Artist Name">
  <input type="submit" id="btnSearchArtist" name="btnSearchArtist" value="Search">
</form>

<?php
	if(isset($_GET['btnSearchArtist'])) 
		{
		$artName = (isset($_GET['searchArtist']) ? $_GET['searchArtist'] : null);
		$artNameInput = mysql_real_escape_string($artName);
		
		$result = mysql_query("SELECT artID, artName FROM Artists WHERE artName LIKE '%" .$artNameInput. "%'");
		
		echo "<div style='overflow-x:auto;'>
		<table border='1', table align='center', id='tableAttributes'>
		<tr>
		<th>Artist ID</th>
		<th>Artist Name</th>
		<th></th>
		</tr>";

		while($row = mysql_fetch_array($result))
		  {
		  echo "<tr>";
		  echo "<td>" . $row['artID'] . "</td>";
		  echo "<td>" . $row['artName'] . "</td>";
		  echo "<td> <a href=\"update_artist.php?artID=" .$row['artID']. "&artName=" .$row['artName']. "\">Edit</a>·<a href=\"http://avon.cs.nott.ac.uk/~psyam12/album/select_artistAlbums.php?artID=" .$row['artID']. "\">Albums</a></td>";
		  echo "</tr>";
		  }
		echo "</table>";	
		}
	else 
		{
		if ($_GET['sort'] == 'aID')
			{
			$result = mysql_query("SELECT * FROM Artists ORDER BY artID ASC");
			}
		else if ($_GET['sort'] == 'aName')
			{
			$result = mysql_query("SELECT * FROM Artists ORDER BY artName ASC");
			}
		else 
			{
			$result = mysql_query("SELECT * FROM Artists");
			}

		echo "<div style='overflow-x:auto;'>
		<table border='1', table align='center', id='tableAttributes'>
		<tr>
		<th><a href='select_artist.php?sort=aID'>Artist ID</th>
		<th><a href='select_artist.php?sort=aName'>Artist Name</th>
		<th></th>
		</tr>";

		while($row = mysql_fetch_array($result))
		  {
		  echo "<tr>";
		  echo "<td align='center'>" . $row['artID'] . "</td>";
		  echo "<td align='center'>" . $row['artName'] . "</td>";
		  echo "<td align='center'> <a href=\"update_artist.php?artID=" .$row['artID']. "&artName=" .$row['artName']. "\">Edit</a>·<a href=\"http://avon.cs.nott.ac.uk/~psyam12/album/select_artistAlbums.php?artID=" .$row['artID']. "\">Albums</a></td>";
		  echo "</tr>";
		  }
		echo "</table>";
		}
?>
	<p align = 'center'><a href="http://avon.cs.nott.ac.uk/~psyam12/artist/insert_artist.php">Add Artist</a></p>
<hr>
 </body>
</html>