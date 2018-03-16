<?php 
	include ("session_refresh.php");
?>
<!DOCTYPE html>
<!-- Admin Login Page -->
<html>
	<head>
		<title>Admin Login</title>
	</head>
	<body>
		<h3>Admin Login</h3><!-- Apply checks for username and password length and format -->
		<form action="admin_validate.php" method="post">
			Admin Code:<br>
			<input type="text" name="admin_code" required>
			<br>Password:<br>
			<input type="password" name="admin_password" required>
			<br>
			<input type="submit" value="Login" name="admin_submitbtn">
			<input type="reset" value="Back" name="admin_backbtn">
			<!-- Warn on this page if login fails once with the error message from admin_validate.php -->
		</form>
	</body>
</html>