<?php
/*Verifies Sign-in data and updates DB if no clashes.Takes to main page with set SESSION variables on success and to user_signup.php otherwise*/
	session_start();
	include ("dbconfig.php");//Connection to database
	$_SESSION  = array();//To clear session data
	$redirect_to_success = "";//Set this to the main page
	$redirect_to_failure = "user_signup.php";

	/*user_reg
	user_firstname
	user_lastname
	user_email
	user_phonenum
	user_address
	user_pwd
	*/

	//ALL FORMAT CHECKS ARE PERFORMED BEFORE SENDING THE DATA TO THE SERVER. ONLY CHECK FOR EXISTING DB VALUES HERE.
	if ($_SERVER["REQUEST_METHOD"] == "POST") {

		if (!empty($_POST["user_reg"]) && !empty($_POST["user_firstname"] && !empty($_POST["user_lastname"]) && !empty($_POST["user_email"]) && !empty($_POST["user_phonenum"]) && !empty($_POST["user_address"]) && !empty($_POST["user_pwd"]) )) {

			$user_reg =  mysqli_real_escape_string($conn, sanitize_input($_POST["user_reg"]));
			$user_firstname =  mysqli_real_escape_string($conn, sanitize_input($_POST["user_firstname"]));
			$user_lastname =  mysqli_real_escape_string($conn, sanitize_input($_POST["user_lastname"]));
			$user_email =  mysqli_real_escape_string($conn, sanitize_input($_POST["user_email"]));
			$user_phonenum =  mysqli_real_escape_string($conn, sanitize_input($_POST["user_phonenum"]));
			$user_address =  mysqli_real_escape_string($conn, sanitize_input($_POST["user_address"]));
			$user_pwd =  mysqli_real_escape_string($conn, sanitize_input($_POST["user_pwd"]));

			// QUERY TO CHECK FOR EXISTING VALUES IN DB 
			$result = mysqli_query($conn,"SELECT reg FROM users WHERE reg = '".$user_reg."' OR userpassword ='".$user_pwd."'");

			//print_r($result);
			if(mysqli_num_rows($result) == 0){ // No matches found.Safe to place these values in DB
				
				// QUERY TO UPDATE THE DATABASE WITH VALUES TAKEN FROM FORM
				$result = mysqli_query($conn,"INSERT INTO users (reg,firstname,lastname,email,phonenum,address,userpassword) VALUES ('".$user_reg"','".$user_firstname"','".$user_lastname"','".$user_email"','".$user_phonenum"','".$user_address"','".$user_pwd"')");

				$_SESSION["userreg"] = $db_user->reg;
				$_SESSION["username"] = $db_user->firstname;
				//echo "<br>Welcome, " . $_SESSION["username"];//Comment out this line,only for testing
				//header("Location: ".$redirect_to_success);
			}
			else{// Values already exist. 
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