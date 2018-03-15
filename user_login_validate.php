<?php
/*Validates user login credentials for authorizing to main site*/
	session_start();
	include ("dbconfig.php");//Connection to database
	$_SESSION  = array();//To clear session data
	$redirect_to_success = "";//Set this to the page to redirect on verification
	$redirect_to_failure = "user_login.php";

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if (!empty($_POST["user_reg"]) && !empty($_POST["user_pwd"])) {
			$user_reg =  mysqli_real_escape_string($conn, sanitize_input($_POST["user_reg"]));
			$user_pwd =  mysqli_real_escape_string($conn, sanitize_input($_POST["user_pwd"]));
			$result = mysqli_query($conn,"SELECT firstname,reg FROM users WHERE reg = '".$user_reg."' AND userpassword ='".$user_pwd."'");
			//print_r($result);
			if(mysqli_num_rows($result) > 0){ // Refer to main page in this block
				$db_user = mysqli_fetch_object($result);
				$_SESSION["user_reg"] = $db_user->reg;
				$_SESSION["username"] = $db_user->firstname;
				echo "<br>Welcome, " . $_SESSION["username"];//Comment out this line,only for testing
				//header("Location: ".$redirect_to_success);
			}
			else{//Die in this,or redirect to login on failure
				//echo "<br>Login Failed";
				$_SESSION  = array();
				header("Location: ".$redirect_to_failure);//Redirect to Admin Login
			}
		}
	}

	function sanitize_input($data) {//sanitizing input
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

?>