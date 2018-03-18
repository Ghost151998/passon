<?php
/*Verifies details of cart once logged in and clicked "add_to_cart" in book_description.No item description coming as of yet from books_list to book_description.*/
	session_start();
	include ("dbconfig.php");//Connection to database
	$redirect_to_success = "";//Set this to the main page
	$redirect_to_item_description = "item_description.php";
	$redirect_to_user_login = "user_login.php";

	//Check if user is logged in
	if(!$_SESSION["user_reg"]){//Login failed.Redirect to user_login.php
		header("Location: " .$redirect_to_user_login);
	}

	//SEND $_POST["category"] AND $_POST["item_id"] DATA TO DATABASE

	//ALL FORMAT CHECKS ARE PERFORMED BEFORE SENDING THE DATA TO THE SERVER. ONLY CHECK FOR EXISTING DB VALUES HERE.
	if ($_SERVER["REQUEST_METHOD"] == "POST") {

		if (isset($_POST["category"]) && isset($_POST["item_id"])) { //CHECK IF POST FIELDS ARE SET

			$result = mysqli_query($conn,"SELECT reg FROM cart WHERE reg = '".$user_reg."' AND item_id = '".$_POST["id"]."' AND item_category = '".$_POST["category"]."'");

			if(mysqli_num_rows($result) != 0){
				echo "Item already added to cart<br>";
				//redirect to item_description.php and display the above line there.
				//SUGGESTION: NOT TO REDIRECT TO THIS PAGE TO CHECK IF CART HAS THIS ITEM.INSTEAD,POP A DIALOG ON THE SAME PAGE...WILL HAVE TO CHECK HOW TO DO THAT
			}

			else{ // No matches found. Safe to place these values in DB
				
				// QUERY TO UPDATE THE DATABASE WITH VALUES TAKEN FROM FORM
				$result = mysqli_query($conn,"INSERT INTO cart (reg,item_id,category) VALUES ('".$_SESSION["user_reg"]."','".$_POST["item_id"]."','".$_POST["category"]"')");
				//redirect to user_home.php while displaying success message
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