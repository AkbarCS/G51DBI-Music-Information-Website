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
	<p><font size="6">Edit Album</font></p>
	<p><font size="5">Album attributes can be edited here.  In addition, the album that has been selected can be deleted here.  With that said, deleting an album will result in its tracks being deleted. </font></p>
	<hr>
	<form id="updateAlbum" action="update_album_server.php">
		<input type="hidden" name="InsertAlbumID" value="<?php echo $_GET['albumID'] ?>"/>
	  <p>
		Album Title/Name:
		<input type="hidden" name="PreviousAlbumTitle" value="<?php echo $_GET['albumTitle'] ?>"/>		
		<input type="text" name="InsertAlbumTitle" id="InsertAlbumTitle" value="<?php echo $_GET['albumTitle'] ?>" maxlength="255" required/>
		<script type="text/javascript">
		document.getElementById("InsertAlbumTitle").addEventListener("keydown", controlBorderColor, false);
		document.getElementById("InsertAlbumTitle").addEventListener("keyup", controlBorderColor, false);

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
				window.alert("Album name length cannot be greater than 255 characters.");
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
		Artist:
		<?php
			include '../db.php'; 
			
			$sql = "SELECT artName, artID FROM Artists ORDER BY artName='".$_GET['artName']."'DESC";
			$result = mysql_query($sql);

			echo '<select name="InsertArtistName" id="InsertArtistName">';
	
			while ($row = mysql_fetch_array($result)) 
				echo "<option value=$row[artID]>$row[artName]</option>"; 
		echo '</select>';
		?> 
	  </p>
	   <p>
		Album Genre:
		<input type="text" name="InsertAlbumGenre" id="InsertAlbumGenre" value="<?php echo $_GET['albumGenre'] ?>" maxlength="63" required/>
		<script type="text/javascript">
		document.getElementById("InsertAlbumGenre").addEventListener("keydown", controlBorderColor, false);
		document.getElementById("InsertAlbumGenre").addEventListener("keyup", controlBorderColor, false);

		function controlBorderColor() 
			{
			if (this.value.length == 0) 
				{ 
				this.style.borderColor = "red";
				document.getElementById("btnSubmit").disabled = true;
				}
			else if (this.value.length >= 63) 
				{ 
				this.style.borderColor = "red";
				window.alert("Album genre length cannot be greater than 63 characters.");
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
		Number of Tracks in Album:
		<input type="number" name="InsertAlbumNumOfTracks" id="InsertAlbumNumberofTracks" min=1 max=300 step=1 value="<?php echo $_GET['albumNumOfTracks'] ?>" required/>
		<script type="text/javascript">
		document.getElementById("InsertAlbumNumberofTracks").addEventListener("keydown", controlBorderColor, false);
		document.getElementById("InsertAlbumNumberofTracks").addEventListener("keyup", controlBorderColor, false);

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
			else if (this.value > 300) 
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
		Album Price (in British Pounds):
		<input type="number" name="InsertAlbumPrice" id="InsertAlbumPrice" min=0.01 max=999.99 step=0.01 value="<?php echo $_GET['albumPrice'] ?>" required/>
		<script type="text/javascript">
		document.getElementById("InsertAlbumPrice").addEventListener("keydown", controlBorderColor, false);
		document.getElementById("InsertAlbumPrice").addEventListener("keyup", controlBorderColor, false);

		function controlBorderColor() 
			{
			if (this.value <= 0) 
				{ 
				this.style.borderColor = "red";
				document.getElementById("btnSubmit").disabled = true;
				}
			else if (this.value > 999.99) 
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
		<input type="submit" id="btnDelete" name="btnDelete" onclick="window.onbeforeunload = null; return confirm('Warning: Deleting an album from the database will also remove any tracks present in the album.  This change cannot be reversed.  Press OK to confirm or click cancel to cancel deletion.')" value="Delete" />
	  </p>
	</form>
	<a href="http://avon.cs.nott.ac.uk/~psyam12/album/select_album.php">Return Back to Previous Page</a></p>
	<hr>
</body></html>