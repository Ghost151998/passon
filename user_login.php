<!DOCTYPE html>
<!-- User Login Page -->
<html>
	<head>
		<title>User Login</title>
	</head>
	<body>
		<h3>User Login</h3><!-- Apply checks for username and password length and format -->
		<form action="user_login_validate.php" method="post">
			Registration Number:<br>
			<input type="text" name="user_reg" required>
			<br>Password:<br>
			<input type="password" name="user_pwd" required>
			<br>
			<input type="submit" value="Login" name="user_login_submitbtn">
			<input type="reset" value="Back" name="user_login_backbtn">
			<!-- Warn on this page if login fails once with the error message from user_validate.php -->
		</form>
	</body>
</html>