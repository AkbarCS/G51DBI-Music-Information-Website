<html><body>
<?php include '../layout.html' ?>
	<p><font size="6">Add Album</font></p>
	<p><font size="5">Albums can be added to the database here.</font></p>
	<hr>
	  <form action="insert_album_server.php">
	  <p>
		Album Title:
		<input type="text" name="InsertAlbumTitle" id="InsertAlbumTitle" maxlength="255" required />
		<script type="text/javascript">
		document.getElementById("InsertAlbumTitle").addEventListener("keydown", controlBorderColor, false);
		document.getElementById("InsertAlbumTitle").addEventListener("keyup", controlBorderColor, false);

		function controlBorderColor() 
			{
			if (this.value.length == 0) 
				{ 
				this.style.borderColor = "red";
				document.getElementById("albumInsert").disabled = true;
				}
			else if (this.value.length >= 255) 
				{ 
				this.style.borderColor = "red";
				window.alert("Album name length cannot be greater than 255 characters.");
				document.getElementById("albumInsert").disabled = true;
				}
			else 
				{ 
				this.style.borderColor = "green"; 
				document.getElementById("albumInsert").disabled = false;
				}
			}
		</script>
	  </p>
	  <p>
		Artist:
		<?php
			include '../db.php'; 

			$sql = "SELECT artName, artID FROM Artists ORDER BY artName";
			$result = mysql_query($sql);

			echo '<select name="InsertArtistName" id="InsertArtistName">';
			
			while ($row = mysql_fetch_array($result)) 
				echo "<option value=$row[artID]>$row[artName]</option>"; 
		echo '</select>';
		?> 
	  </p>
	   <p>
		Album Genre:
		<input type="text" name="InsertAlbumGenre" id="InsertAlbumGenre" maxlength="63" required/>
		<script type="text/javascript">
		document.getElementById("InsertAlbumGenre").addEventListener("keydown", controlBorderColor, false);
		document.getElementById("InsertAlbumGenre").addEventListener("keyup", controlBorderColor, false);

		function controlBorderColor() 
			{
			if (this.value.length == 0) 
				{ 
				this.style.borderColor = "red";
				document.getElementById("albumInsert").disabled = true;
				}
			else if (this.value.length >= 63) 
				{ 
				this.style.borderColor = "red";
				window.alert("Album genre length cannot be greater than 63 characters.");
				document.getElementById("albumInsert").disabled = true;
				}
			else 
				{ 
				this.style.borderColor = "green"; 
				document.getElementById("albumInsert").disabled = false;
				}
			}
		</script>
	  </p>
	   <p>
		Number of Tracks in Album:
		<input type="number" name="InsertAlbumNumberofTracks" id="InsertAlbumNumberofTracks" min=1 max=300 step=1 required/>
		<script type="text/javascript">
		document.getElementById("InsertAlbumNumberofTracks").addEventListener("keydown", controlBorderColor, false);
		document.getElementById("InsertAlbumNumberofTracks").addEventListener("keyup", controlBorderColor, false);

		function controlBorderColor() 
			{
			if (this.value <= 0) 
				{ 
				this.style.borderColor = "red";
				document.getElementById("albumInsert").disabled = true;
				}
			else if (this.value % 1 != 0)
				{
				this.style.borderColor = "red";
				document.getElementById("albumInsert").disabled = true;	
				}
			else if (this.value > 300) 
				{ 
				this.style.borderColor = "red";
				document.getElementById("albumInsert").disabled = true;
				}
			else 
				{ 
				this.style.borderColor = "green"; 
				document.getElementById("albumInsert").disabled = false;
				}
			}
		</script>
	  </p>
	  <p>
		Album Price (in British Pounds):
		<input type="number" name="InsertAlbumPrice" id="InsertAlbumPrice" min=0.01 max=999.99 step=0.01 required/>
		<script type="text/javascript">
		document.getElementById("InsertAlbumPrice").addEventListener("keydown", controlBorderColor, false);
		document.getElementById("InsertAlbumPrice").addEventListener("keyup", controlBorderColor, false);

		function controlBorderColor() 
			{
			if (this.value <= 0) 
				{ 
				this.style.borderColor = "red";
				document.getElementById("albumInsert").disabled = true;
				}
			else if (this.value > 999.99) 
				{ 
				this.style.borderColor = "red";
				document.getElementById("albumInsert").disabled = true;
				}
			else 
				{ 
				this.style.borderColor = "green"; 
				document.getElementById("albumInsert").disabled = false;
				}
			}
		</script>
	  </p>
	  <p>
		<input type="submit" value="Insert" id="albumInsert"/>
	  </p>
	</form>
	<a href="http://avon.cs.nott.ac.uk/~psyam12/album/select_album.php">Return Back to Previous Page</a></p>
	<hr>
</body></html>