<html><body>
	<?php include '../layout.html' ?>
	<p><font size="6">Add Artist</font></p>
	<p><font size="5">Artists can be added to the database here.</font></p>
	<hr>
	  <form action="insert_artist_server.php">
	  <p>
		Artist Name:
		<input type="text" name="artistName" id="artistName" maxlength="255" required/>
		<script type="text/javascript">
		document.getElementById("artistName").addEventListener("keydown", controlBorderColor, false);
		document.getElementById("artistName").addEventListener("keyup", controlBorderColor, false);

		function controlBorderColor() 
			{
			if (this.value.length == 0) 
				{ 
				this.style.borderColor = "red";
				document.getElementById("artistInsert").disabled = true;
				}
			else if (this.value.length >= 255) 
				{ 
				this.style.borderColor = "red";
				window.alert("Artist name length cannot be greater than 255 characters.");
				document.getElementById("artistInsert").disabled = true;
				}
			else 
				{ 
				this.style.borderColor = "green"; 
				document.getElementById("artistInsert").disabled = false;
				}
			}
		</script>
	  </p>
	  <p>
		<input type="submit" value="Insert" id="artistInsert"/>
	  </p>
	</form>
	<a href="http://avon.cs.nott.ac.uk/~psyam12/artist/select_artist.php">Return Back to Previous Page</a></p>
	<hr>
</body></html>