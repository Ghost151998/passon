<!-- Item Description Page for Books!!!Remember to give the div this category.No images added as of yet. Buy button to be added later if required. Give classes for formatting. Add to cart button will redirect to cart while adding the product and updating the db.
	//An inStock check must be applied-->
<?php
	session_start();
	include ("dbconfig.php");//Connection to database

	$redirect_to_login = "user_login.php";

	//Check if user is logged in
	if(!$_SESSION["user_reg"]){//Login failed.Redirect to user_login.php
		header("Location: " .$redirect_to_login);
	}

	else{
?>

			<!DOCTYPE html>
			<html>
				<head>
					<title>Item Description</title>
					<h3>Item Description</h3>
				</head>
				<body>
<?php

	//if($_POST["category"] == "books"){ //CHANGE THE CONDITION TO VERIFY IF THIS PAGE IS FOR BOOKS...THEN OPEN THE BRACKETS @if_books
		
		$id = 1; //Insert the id received from the page click of the item on the books list

		//Set this information on all books,bikes,and misc description pages since this will help form submission to cart
		$_SESSION["category"] = "books";
		$_SESSION["item_id"] = $id;
		$results = mysqli_query($conn,"SELECT * FROM books WHERE id = '".$id."'");//Take the info of item from database
		//print_r($results);
		$row = mysqli_fetch_array($results); ?> <!-- take all entries from table and fill them in html -->

				Author and Edition:<?php echo $row['author_edition']; ?><br>
				Branch:<?php echo $row['branch']; ?><br>
				<?php if(!($row['sem'] == '-1')){ ?>
					Semester:<?php echo $row['sem']; ?><br>
				<?php } ?>
				Description:<br><?php echo $row['description']; ?><br>
				Quality:<br><?php echo $row['quality']; ?><br>
				<form action="cart_handle.php" method="post">
					<input type="submit" value="Add To Cart" name="add_to_cart">
					<!--name+= _book_'.<?phpecho $row->id ?>.' -->
				</form>
				</body>
			</html>
	<!-- <?php 
	//}@if_books close 
	?> -->
<?php } ?>