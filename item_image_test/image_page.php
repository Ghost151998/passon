<?php 
	session_start();
	include ("../test_variables.php");
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Image Upload</title>
	</head>
	<body>
		<form action="image_upload.php" method="post" enctype="multipart/form-data">
			Image Upload:<br><br>
			<input type="file" name="item_image"><br><br>
			<input type="submit" value="Upload Image">
		</form>
	</body>
</html>
<?php 
	include ("../test_variables.php");
?>