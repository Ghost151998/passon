<?php
/*Submits verified salerequest data to server from admin_main*/
	session_start();
	include ("dbconfig.php");//Connection to database

	$redirect_to_success = "admin_main.php";//Set this to the page to redirect on verification
	$redirect_to_failure = "admin_login.php";

	if(!$_SESSION["adminnum"]){//Login failed. Redirect to admin_login.php
		header("Location: " .$redirect_to_failure);
	}

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if (!empty($_POST["seller_reg"]) && !empty($_POST["category"]) && !empty($_POST["description"]) && !empty($_POST["quality"])) {

			if($_POST["category"] == "books") {
				if(!empty($_POST["author_edition"]) && !empty($_POST["branch"]) && !empty($_POST["sem"])){
					$seller_reg =  mysqli_real_escape_string($conn, sanitize_input($_POST["seller_reg"]));
					$category =  mysqli_real_escape_string($conn, sanitize_input($_POST["category"]));
					$author_edition =  mysqli_real_escape_string($conn, sanitize_input($_POST["author_edition"]));
					$branch =  mysqli_real_escape_string($conn, sanitize_input($_POST["branch"]));
					$sem =  mysqli_real_escape_string($conn, sanitize_input($_POST["sem"]));
				}
			}

			/*if($_POST["category"] == "bikes"){
				if{!empty($_POST["author_edition"] && !empty($_POST["branch"] && !empty($_POST["sem"])}{
					$seller_reg =  mysqli_real_escape_string($conn, sanitize_input($_POST["seller_reg"]));
					$category =  mysqli_real_escape_string($conn, sanitize_input($_POST["category"]));
					$author_edition =  mysqli_real_escape_string($conn, sanitize_input($_POST["author_edition"]));
					$branch =  mysqli_real_escape_string($conn, sanitize_input($_POST["branch"]));
					$sem =  mysqli_real_escape_string($conn, sanitize_input($_POST["sem"]));
				}
			}

			if($_POST["category"] == "misc"){
				if{!empty($_POST["author_edition"] && !empty($_POST["branch"] && !empty($_POST["sem"])}{
					$seller_reg =  mysqli_real_escape_string($conn, sanitize_input($_POST["seller_reg"]));
					$category =  mysqli_real_escape_string($conn, sanitize_input($_POST["category"]));
					$author_edition =  mysqli_real_escape_string($conn, sanitize_input($_POST["author_edition"]));
					$branch =  mysqli_real_escape_string($conn, sanitize_input($_POST["branch"]));
					$sem =  mysqli_real_escape_string($conn, sanitize_input($_POST["sem"]));
				}
			}*/

			//Common inputs for all
			$description =  mysqli_real_escape_string($conn, sanitize_input($_POST["description"]));
			$quality =  mysqli_real_escape_string($conn, sanitize_input($_POST["quality"]));

			if($_POST["category"] == "books"){ //Update the books table with this value
				$result = mysqli_query($conn,"INSERT INTO books (author_edition,seller,branch,sem,description,quality) VALUES ('".$author_edition."','".$seller_reg."','".$branch."','".$sem."','".$description."','".$quality."')");

				$sale_id = mysqli_query($conn,"SELECT id FROM salerequest WHERE seller_reg = '".$seller_reg."' AND author_edition = '".$author_edition."' AND branch = '".$branch."' AND sem = '".$sem."'");//Fetch the id of the above entry
				$sale_id = mysqli_fetch_object($sale_id);
				print_r($sale_id);

				mysqli_query($conn,"UPDATE salerequest SET deleted = '1' WHERE id ='".$sale_id->id."'"); //Set deleted = true for the verified book in salerequest
			}

			////UPDATE QUERY FOR Bikes
			/*if($_POST["category"] == "books"){ //Update the books table with this value
				$result = mysqli_query($conn,"INSERT INTO books (author_edition,seller,branch,sem,description,quality) VALUES ('".$author_edition."','".$seller_reg."','".$branch."','".$sem."','".$description."','".$quality."')");

				$sale_id = mysqli_query($conn,"SELECT id FROM salerequest WHERE seller_reg = '".$seller_reg."' AND author_edition = '".$author_edition."' AND branch = '".$branch."' AND sem = '".$sem."'");//Fetch the id of the above entry
				$sale_id = mysqli_fetch_object($sale_id);
				print_r($sale_id);

				mysqli_query($conn,"UPDATE salerequest SET deleted = '1' WHERE id ='".$sale_id->id."'"); //Set deleted = true for the verified book in salerequest
			}

			//UPDATE QUERY FOR MISC
			if($_POST["category"] == "books"){ //Update the books table with this value
				$result = mysqli_query($conn,"INSERT INTO books (author_edition,seller,branch,sem,description,quality) VALUES ('".$author_edition."','".$seller_reg."','".$branch."','".$sem."','".$description."','".$quality."')");

				$sale_id = mysqli_query($conn,"SELECT id FROM salerequest WHERE seller_reg = '".$seller_reg."' AND author_edition = '".$author_edition."' AND branch = '".$branch."' AND sem = '".$sem."'");//Fetch the id of the above entry
				$sale_id = mysqli_fetch_object($sale_id);
				print_r($sale_id);

				mysqli_query($conn,"UPDATE salerequest SET deleted = '1' WHERE id ='".$sale_id->id."'"); //Set deleted = true for the verified book in salerequest
			}*/
			//print_r($result);
			
			header("Location: ".$redirect_to_success);//Send back to admin_main.php
		}
	}

	function sanitize_input($data) {//sanitizing input
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

?>