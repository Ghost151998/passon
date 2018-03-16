<?php 
	include ("session_refresh.php");
?>

<!DOCTYPE html>
<!-- User Signup Page -->
<html>
	<head>
		<title>User Signup</title>
	</head>
	<body>
		<h3>User Signup</h3><!-- Apply checks for length,phonenum,password==confirm_password,text limit wrt DB and format,give ids to all for js checks -->
		<form action="user_signup_validate.php" method="post">
			Registration Number:<br>
			<input type="text" name="user_reg" required>
			<br>First Name:<br>
			<input type="text" name="user_first_name" required>
			<br>Last Name:<br>
			<input type="text" name="user_last_name" required>
			<br>Email:<br>
			<input type="email" name="user_email" required>
			<br>Contact Number:<br>
			<input type="tel" name="user_phone_number" required>
			<br>Address:<br>
			<input type="text" name="user_address" required>
			<br>Password:<br>
			<input type="password" name="user_password" required>
			<br>Confirm Password:<br>
			<input type="password" name="user_password_confirm" required>
			<br>
			<input type="submit" value="Login" name="user_signin_submitbtn">
			<input type="reset" value="Back" name="user_signin_backbtn">
		</form>
	</body>
</html>