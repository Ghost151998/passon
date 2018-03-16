<?php
/*Verifies details of cart once logged in and clicked "add_to_cart" in book_description.No item description coming as of yet from books_list to book_description.*/
	session_start();
	include ("dbconfig.php");//Connection to database
	$redirect_to_success = "";//Set this to the main page
	$redirect_to_user_login = "user_login.php";

	//Check if user is logged in
	if(!$_SESSION["user_reg"]){//Login failed.Redirect to user_login.php
		header("Location: " .$redirect_to_user_login);
	}

	//ALL FORMAT CHECKS ARE PERFORMED BEFORE SENDING THE DATA TO THE SERVER. ONLY CHECK FOR EXISTING DB VALUES HERE.
	if ($_SERVER["REQUEST_METHOD"] == "POST") {

		if ($_SESSION["category"] == "books" && isset($_SESSION["item_id"])) {//CONTINUE FROM HERE
			//
			$result = mysqli_query($conn,"SELECT reg FROM users WHERE reg = '".$user_reg."'");

			//print_r($result);
			if(mysqli_num_rows($result) == 0){ // No matches found. Safe to place these values in DB
				
				// QUERY TO UPDATE THE DATABASE WITH VALUES TAKEN FROM FORM
				$result = mysqli_query($conn,"INSERT INTO users (reg,firstname,lastname,email,phonenum,address,userpassword) VALUES ('".$user_reg."','".$user_firstname."','".$user_lastname."','".$user_email."','".$user_phonenum."','".$user_address."','".$user_pwd."')");

				$_SESSION["user_reg"] = $user_reg;
				$_SESSION["username"] = $user_firstname;
				echo "<br>Successfully signed up, " . $_SESSION["username"];//Comment out this line,only for testing
				//header("Location: ".$redirect_to_success);//redirect to main page
			}
			/*else{// Values already exist. WHAT TO DO?session must close...what else???
				$_SESSION  = array();
				header("Location: ".$redirect_to_failure);//Redirect to Admin Login
			}*/
		}
	}

	function sanitize_input($data) {//sanitizing input
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

?>