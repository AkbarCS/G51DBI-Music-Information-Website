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
	<p><font size="6">Edit Artist</font></p>
	<p><font size="5">Artist name can be edited here.  In addition, the artist that has been selected can be deleted here.  With that said, deleting an artist will result in their albums and tracks being deleted. </font></p>
	<hr>
	<form action="update_artist_server.php">
		<input type="hidden" name="artistID" value="<?php echo $_GET['artID'] ?>"/>
	  <p>
		Artist Name:
		<input type="hidden" name="PreviousArtistName" value="<?php echo $_GET['artName'] ?>"/>		
		<input type="text" name="artistName" id="artistName" value="<?php echo $_GET['artName'] ?>" maxlength="255" required/>
		<script type="text/javascript">
		document.getElementById("artistName").addEventListener("keydown", controlBorderColor, false);
		document.getElementById("artistName").addEventListener("keyup", controlBorderColor, false);

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
				window.alert("Artist name length cannot be greater than 255 characters.");
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
		<input type="submit" id="btnDelete" name="btnDelete" onclick="window.onbeforeunload = null; return confirm('Warning: Deleting an artist from the database will remove any albums and tracks produced by the artist.  This change cannot be reversed.  Press OK to confirm or click cancel to cancel deletion.')" value="Delete" />
	  </p>
	</form>
	<a href="http://avon.cs.nott.ac.uk/~psyam12/artist/select_artist.php">Return Back to Previous Page</a></p>
	<hr>
</body></html>



