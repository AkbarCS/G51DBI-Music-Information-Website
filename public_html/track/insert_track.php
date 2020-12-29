<html><body>
	<?php include '../layout.html' ?>
	<p><font size="6">Add Track</font></p>
	<p><font size="5">Tracks can be added to the database here.</font></p>
	<hr>
	  <form action="insert_track_server.php">
	  <p>
		Track Title:
		<input type="text" name="InsertTrackTitle" id="InsertTrackTitle" maxlength="255" required />
		<script type="text/javascript">
		document.getElementById("InsertTrackTitle").addEventListener("keydown", controlBorderColor, false);
		document.getElementById("InsertTrackTitle").addEventListener("keyup", controlBorderColor, false);

		function controlBorderColor() 
			{
			if (this.value.length == 0) 
				{ 
				this.style.borderColor = "red";
				document.getElementById("trackInsert").disabled = true;
				}
			else if (this.value.length >= 255) 
				{ 
				this.style.borderColor = "red";
				window.alert("Track name length cannot be greater than 255 characters.");
				document.getElementById("trackInsert").disabled = true;
				}
			else 
				{ 
				this.style.borderColor = "green"; 
				document.getElementById("trackInsert").disabled = false;
				}
			}
		</script>
	  </p>
	  <p>
		Album:
		<?php
			include '../db.php'; 

			$sql = "SELECT albumTitle, albumID FROM Albums ORDER BY albumTitle";
			$result = mysql_query($sql);

			echo '<select name="InsertAlbumName" id="InsertAlbumName">';
			
			while ($row = mysql_fetch_array($result)) 
				echo "<option value=$row[albumID]>$row[albumTitle]</option>"; 
		echo '</select>';
		?> 
	  </p>
	   <p>
		Track Running Time (in seconds):
		<input type="number" name="InsertTrackRunningTime" id="InsertTrackRunningTime" min=1 max=10000 step=1 required />
		<script type="text/javascript">
		document.getElementById("InsertTrackRunningTime").addEventListener("keydown", controlBorderColor, false);
		document.getElementById("InsertTrackRunningTime").addEventListener("keyup", controlBorderColor, false);

		function controlBorderColor() 
			{
			if (this.value <= 0) 
				{ 
				this.style.borderColor = "red";
				document.getElementById("trackInsert").disabled = true;
				}
			else if (this.value % 1 != 0)
				{
				this.style.borderColor = "red";
				document.getElementById("trackInsert").disabled = true;	
				}
			else if (this.value > 10000) 
				{ 
				this.style.borderColor = "red";
				document.getElementById("trackInsert").disabled = true;
				}
			else 
				{ 
				this.style.borderColor = "green"; 
				document.getElementById("trackInsert").disabled = false;
				}
			}
		</script>
	  </p>
	  <p>
		<input type="submit" value="Insert" id="trackInsert"/>
	  </p>
	</form>
	<a href="http://avon.cs.nott.ac.uk/~psyam12/track/select_track.php">Return Back to Previous Page</a></p>
	<hr>
</body></html>