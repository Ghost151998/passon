<!-- BOOKS LIST PAGE!!!Remember to place a div and format this category.No images added as of yet. Give classes for formatting.-->
<?php
	session_start();
	include ("dbconfig.php");

	$redirect_to_login = "user_login.php";

	//Check if user is logged in
	if(!$_SESSION["user_reg"]){//Login failed.Redirect to user_login.php
		header("Location: " .$redirect_to_login);
	}

	else{
		//if($_POST["category"] == "books"){ //CHANGE THE CONDITION TO VERIFY IF THIS PAGE IS FOR BOOKS...THEN OPEN THE BRACKETS @if_books
?>

			<!DOCTYPE html>
			<html>
				<head>
					<title>Books</title>
					<h3>Books</h3>
				</head>
				<body>
<?php
		//Add a handler for misc as well
		for($i = 1; $i<=8; $i++){
			$results = mysqli_query($conn,"SELECT * FROM books WHERE sem = '".$i."'");//Take the info of all books from database for a semester
			//print_r($results);
			echo "Semester ".$i.":<br>";
		//If $results_num_rows > 0 condition to be inserted
		while($row = mysqli_fetch_array($results)){ ?> <!-- take all entries from table and fill them in html -->
		<!-- Set this while loop in div and format it -->
		<!-- Set the onclick listener for this div to book_description -->
				Author and Edition:<?php echo $row['author_edition']; ?><br>
				<!-- Price to be added -->
		<?php }
		}
		?>
				</body>
			</html>
	<!-- <?php
	//}@if_books close
	?> -->
<?php } ?>