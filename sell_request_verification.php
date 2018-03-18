<?php
/*Validates item details form from the seller page to queue for authentication from admins*/
	session_start();
	include ("dbconfig.php");//Connection to database
	include ("test_variables.php");

	$redirect_to_user_login = "user_login.php";

	//Check if user is logged in
	if(!$_SESSION["user_reg"]){//Login failed.Redirect to user_login.php
		header("Location: " .$redirect_to_user_login);
	}

	else{
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if (!empty($_POST["category"])) {//Category is chosen
				if($_POST["category"] == "books"){// If category is books
					$book_author =  mysqli_real_escape_string($conn, sanitize_input($_POST["book_author"]));
					$book_title =  mysqli_real_escape_string($conn, sanitize_input($_POST["book_title"]));
					$book_edition =  mysqli_real_escape_string($conn, sanitize_input($_POST["book_edition"]));
					$book_branch =  mysqli_real_escape_string($conn, sanitize_input($_POST["book_branch"]));
					$book_sem =  mysqli_real_escape_string($conn, sanitize_input($_POST["book_sem"]));
				}

				else if($_POST["category"] == "bikes"){//If category is bikes
					$bike_brand = mysqli_real_escape_string($conn, sanitize_input($_POST["bike_brand"]));
					$bike_gear = mysqli_real_escape_string($conn, sanitize_input($_POST["bike_gear"]));
					$bike_colour = mysqli_real_escape_string($conn, sanitize_input($_POST["bike_colour"]));
				}

				else if($_POST["category"] == "misc"){//If category is misc
					$misc_name = mysqli_real_escape_string($conn, sanitize_input($_POST["misc_name"]));
				}

				//These fields are common for all categories
				$description =  mysqli_real_escape_string($conn, sanitize_input($_POST["description"]));
				$quality =  mysqli_real_escape_string($conn, sanitize_input($_POST["quality"]));
				$price =  mysqli_real_escape_string($conn, sanitize_input($_POST["price"]));

				//Correct Info
				/*
				print_r($_SESSION["user_reg"]);
				print_r($_POST["category"]);
				print_r($book_author);
				print_r($book_title);
				print_r($book_edition);
				print_r($book_branch);
				print_r($book_sem);
				print_r($description);
				print_r($quality);
				print_r($price);
				print_r($bike_brand);
				print_r($bike_gear);
				print_r($bike_colour);
				print_r($misc_name);*/

				//QUERY FOR QUEUEING OF BOOKS
				if($_POST["category"] == "books"){
					$result = mysqli_query($conn,"INSERT INTO salerequest (seller,category,author,title,edition,branch,sem,description,quality,price) VALUES ('".$_SESSION["user_reg"]."','".$_POST["category"]."','".$book_author."','"$book_title."','".$book_edition."','".$book_branch."','".$book_sem."','".$description."','".$quality."','".$price."')");
				}

				//QUERY FOR QUEUEING OF BIKES
				if($_POST["category"] == "bikes"){
					$result = mysqli_query($conn,"INSERT INTO salerequest (seller,category,brand,gear,colour,description,quality,price) VALUES ('".$_SESSION["user_reg"]."','".$_POST["category"]."','".$bike_brand."','".$bike_gear."','".$bike_colour."','".$description."','".$quality."','".$price."')");
				}

				//QUERY FOR QUEUEING OF MISC
				if($_POST["category"] == "misc"){
					$result = mysqli_query($conn,"INSERT INTO salerequest (seller,category,name,description,quality,price) VALUES ('".$_SESSION["user_reg"]."','".$_POST["category"]."','".$misc_name."','".$description."','".$quality."','".$price."')");
				}
				echo "Entry submitted for admin verification.<br><br>Thank You!<br>";
				//print_r($result);
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
<?php 
	include ("test_variables.php");
?>