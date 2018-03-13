<?php
/*Validates item details form from the seller page to queue for authentication from admins*/
	session_start();
	include ("dbconfig.php");//Connection to database

	$redirect_to_login = "user_login.php";

	//Check if logged in
	if(!$_SESSION["userreg"]){//Login failed.Redirect to login
		header("Location: " .$redirect_to_login);
	}

	else{
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if (!empty($_POST["category"])) {//Category is chosen
				if($_POST["category"] == "books"){// If category is books
					$book_author_edition =  mysqli_real_escape_string($conn, sanitize_input($_POST["book_author_edition"]));
					$book_branch =  mysqli_real_escape_string($conn, sanitize_input($_POST["book_branch"]));
					$book_sem =  mysqli_real_escape_string($conn, sanitize_input($_POST["book_sem"]));
				}
				/*else if($_POST["category"] == "bikes"){//If category is bikes

				}*/
				//These fields are common for all categories
				$description =  mysqli_real_escape_string($conn, sanitize_input($_POST["description"]));
				$quality =  mysqli_real_escape_string($conn, sanitize_input($_POST["quality"]));

				//QUERY FOR QUEUEING OF BOOKS
				if($_POST["category"] == "books"){
					$result = mysqli_query($conn,"INSERT INTO salerequest (reg,category,author_edition,branch,sem,description,quality) VALUES ('".$_SESSION["userreg"]."','".$_POST["category"]."','".$book_author_edition."','".$book_branch."','".$book_sem."','".$description."','".$quality."')");
				}

				//QUERY FOR QUEUEING OF BIKES
				/*if($_POST["category"] == "books"){
					$result = mysqli_query($conn,"INSERT INTO salerequest (reg,firstname,lastname,email,phonenum,address,userpassword) VALUES ('".$user_reg."','".$user_firstname."','".$user_lastname."','".$user_email."','".$user_phonenum."','".$user_address."','".$user_pwd."')");
				}

				//QUERY FOR QUEUEING OF MISC
				if($_POST["category"] == "books"){
					$result = mysqli_query($conn,"INSERT INTO salerequest (reg,firstname,lastname,email,phonenum,address,userpassword) VALUES ('".$user_reg."','".$user_firstname."','".$user_lastname."','".$user_email."','".$user_phonenum."','".$user_address."','".$user_pwd."')");
				}*/

				echo "Entry Submitted for admin verification<br>Thank You!";
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


