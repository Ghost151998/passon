<!-- Item Description Page.Remember to give the div this category.No images added as of yet. Buy button to be added later if required. Give classes for formatting. Add to cart button will redirect to cart while adding the product and updating the db.-->

<?php
	session_start();
	include ("dbconfig.php");//Connection to database
	include ("test_variables.php");

	$redirect_to_user_login = "user_login.php";

	//Check if user is logged in
	if(!$_SESSION["user_reg"]){//Login failed.Redirect to user_login.php
		header("Location: " .$redirect_to_user_login);
	}

	else { ?>

			<!DOCTYPE html>
			<html>
				<head>
					<title>Item Description</title>
					<h3>Item Description</h3>
				</head>
				<body>
<?php

	if(1/*$_POST["category"] == "books"*/){//Remove this after task: sending request from books_list page
		
		$id = 1; //Insert the id received from the page click of the item on the books list

		//Set this information on all books,bikes,and misc description pages since this will help form submission to cart
		$_POST["category"] = "books";
		$_POST["item_id"] = $id;

		$results = mysqli_query($conn,"SELECT * FROM books WHERE id = '".$id."' AND is_sold = 0 ");//Take the info of item from database
		//print_r($results);
		echo "<br>";
		$row = mysqli_fetch_object($results); ?> <!-- take all entries from table and fill them in html -->

				Author:<?php echo $row->author; ?><br>
				Title:<?php echo $row->title; ?><br>
				Edition:<?php echo $row->edition; ?><br>
				<?php if($row->branch){ ?>
					Branch:<?php echo $row->branch; ?><br>
					Semester:<?php echo $row->sem; ?><br>
				<?php } ?>
				Description:<br><?php echo $row->description; ?><br>
				Quality:<br><?php echo $row->quality; ?><br>
				Price:<br><?php echo $row->price; ?><br>
				<form action="cart_handle.php" method="post">
					<input type="submit" value="Add To Cart" name="add_to_cart">
					<!--name+= _book_'.<?phpecho $row->id ?>.' -->
				</form>
				</body>
			</html>
	<?php 
	}//Books close
	?>
<?php
	if(0/*$_POST["category"] == "bikes"*/){//Remove this after task: sending request from bikes_list page
		
		$id = 1; //Insert the id received from the page click of the item on the books list

		//Set this information on all books,bikes,and misc description pages since this will help form submission to cart
		$_POST["category"] = "bikes";
		$_POST["item_id"] = $id;

		$results = mysqli_query($conn,"SELECT * FROM bikes WHERE id = '".$id."' AND is_sold = 0 ");//Take the info of item from database
		//print_r($results);
		echo "<br>";
		$row = mysqli_fetch_object($results); ?> <!-- take all entries from table and fill them in html -->

				Brand:<?php echo $row->brand; ?><br>
				Gear:<?php echo $row->gear; ?><br>
				Colour:<?php echo $row->colour; ?><br>
				Description:<br><?php echo $row->description; ?><br>
				Quality:<br><?php echo $row->quality; ?><br>
				Price:<br><?php echo $row->price; ?><br>
				<form action="cart_handle.php" method="post">
					<input type="submit" value="Add To Cart" name="add_to_cart">
					<!--name+= _book_'.<?phpecho $row->id ?>.' -->
				</form>
				</body>
			</html>
	<?php 
	}//Bikes
	?>
<?php
	if(0/*$_POST["category"] == "misc"*/){//Remove this after task: sending request from misc_list page
		
		$id = 1; //Insert the id received from the page click of the item on the books list

		//Set this information on all books,bikes,and misc description pages since this will help form submission to cart
		$_POST["category"] = "misc";
		$_POST["item_id"] = $id;
		
		$results = mysqli_query($conn,"SELECT * FROM misc WHERE id = '".$id."' AND is_sold = 0 ");//Take the info of item from database
		//print_r($results);
		echo "<br>";
		$row = mysqli_fetch_object($results); ?> <!-- take all entries from table and fill them in html -->

				Name:<?php echo $row->name; ?><br>
				Description:<br><?php echo $row->description; ?><br>
				Quality:<br><?php echo $row->quality; ?><br>
				Price:<br><?php echo $row->price; ?><br>
				<form action="cart_handle.php" method="post">
					<input type="submit" value="Add To Cart" name="add_to_cart">
					<!--name+= _book_'.<?phpecho $row->id ?>.' -->
				</form>
				</body>
			</html>
	<?php 
	}//Misc
	?>

<?php 
}
?>
<?php 
	include ("test_variables.php");
?>