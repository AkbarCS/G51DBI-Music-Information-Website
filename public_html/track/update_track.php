<html><body>
	<?php include '../layout.html' ?>
	<?php
	echo '
	<script type = "text/javascript">
    window.onbeforeunload = function () 
		{
        return "Any unsaved changes will be lost upon exiting this page.";
		};
	</script>';
	?>
	<p><font size="6">Edit Track</font></p>
	<p><font size="5">Track details can be edited here.  In addition, the album that has been selected can be deleted here.</font></p>
	<hr>
	<form action="update_track_server.php">
		<input type="hidden" name="InsertTrackID" value="<?php echo $_GET['trackID'] ?>"/>
	  <p>
		Track Title:
		<input type="hidden" name="PreviousTrackTitle" value="<?php echo $_GET['trackTitle'] ?>"/>		
		<input type="text" name="InsertTrackTitle" id="InsertTrackTitle" value="<?php echo $_GET['trackTitle'] ?>" maxlength="255" required/>
		<script type="text/javascript">
		document.getElementById("InsertTrackTitle").addEventListener("keydown", controlBorderColor, false);
		document.getElementById("InsertTrackTitle").addEventListener("keyup", controlBorderColor, false);

		function controlBorderColor() 
			{
			if (this.value.length == 0) 
				{ 
				this.style.borderColor = "red";
				document.getElementById("btnSubmit").disabled = true;
				}
			else if (this.value.length >= 255) 
				{ 
				this.style.borderColor = "red";
				window.alert("Track name length cannot be greater than 255 characters.");
				document.getElementById("btnSubmit").disabled = true;
				}
			else 
				{ 
				this.style.borderColor = "green"; 
				document.getElementById("btnSubmit").disabled = false;
				}
			}
		</script>
	  </p>
	  <p>
		Album:
		<input type="hidden" name="PreviousAlbumID" value="<?php echo $_GET['albumID'] ?>"/>	
		<?php
			include '../db.php';

			$sql = "SELECT albumTitle, albumID FROM Albums ORDER BY albumTitle='".$_GET['albumTitle']."'DESC";
			$result = mysql_query($sql);

			echo '<select name="InsertAlbumName" id="InsertAlbumName">';
			
			while ($row = mysql_fetch_array($result)) 
				echo "<option value=$row[albumID]>$row[albumTitle]</option>"; 
		echo '</select>';
		?> 
	  </p>
	   <p>
		Track Running Time (in seconds):
		<input type="number" name="InsertTrackRunningTime" id="InsertTrackRunningTime" min=1 max=10000 step=1 value="<?php echo $_GET['trackRunningTime'] ?>" required/>
		<script type="text/javascript">
		document.getElementById("InsertTrackRunningTime").addEventListener("keydown", controlBorderColor, false);
		document.getElementById("InsertTrackRunningTime").addEventListener("keyup", controlBorderColor, false);

		function controlBorderColor() 
			{
			if (this.value <= 0) 
				{ 
				this.style.borderColor = "red";
				document.getElementById("btnSubmit").disabled = true;
				}
			else if (this.value % 1 != 0)
				{
				this.style.borderColor = "red";
				document.getElementById("btnSubmit").disabled = true;	
				}
			else if (this.value > 10000) 
				{ 
				this.style.borderColor = "red";
				document.getElementById("btnSubmit").disabled = true;
				}
			else 
				{ 
				this.style.borderColor = "green"; 
				document.getElementById("btnSubmit").disabled = false;
				}
			}
		</script>
	  </p>
	  <p>
		<input type="submit" id="btnSubmit" name="btnSubmit" value="Save" onclick="window.onbeforeunload = null" />
		<input type="submit" id="btnDelete" name="btnDelete" onclick="window.onbeforeunload = null; return confirm('Warning: Deleting a track from the database will permanently remove it from the database.  Press OK to confirm or click cancel to cancel deletion.')" value="Delete" />
	  </p>
	</form>
	<a href="http://avon.cs.nott.ac.uk/~psyam12/track/select_track.php">Return Back to Previous Page</a></p>
	<hr>
</body></html>