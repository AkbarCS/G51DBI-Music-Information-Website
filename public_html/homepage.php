<html><body> 
<?php 
include 'layout.html';
include 'db.php';
?>
	<hr>
	<p>Welcome to the musical production database.  Here you can view, add, edit and delete information concerning artists, albums and tracks.</p>
	
	<p id="demo"> <script> 
	var currentTime = new Date()
	var hours = currentTime.getHours()
	var minutes = currentTime.getMinutes()

	if (minutes < 10)
	minutes = "0" + minutes

	document.write("As of time <b>" + hours + ":" + minutes + "</b>, the database has the following properties:")
	</script>
	</p>
	
	<?php
		$result1 = mysql_query('SELECT COUNT(*) AS artistCount FROM Artists');
		$row1 = mysql_fetch_assoc($result1);
		
		$result2 = mysql_query('SELECT COUNT(*) AS albumCount FROM Albums');
		$row2 = mysql_fetch_assoc($result2);
		
		$result3 = mysql_query('SELECT COUNT(*) AS trackCount FROM Tracks');
		$row3= mysql_fetch_assoc($result3);
		
		echo "Number of Artists: " . $row1['artistCount'] . "<br>";	
		echo "Number of Albums: " . $row2['albumCount'] . "<br>";
		echo "Number of Tracks: " . $row3['trackCount'] . "<br>";
	?> 
	<hr>
</body></html>