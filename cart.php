<!-- User's Cart Page-->
<!-- REMOVE ITEM TO BE ADDED FOR EACH ITEM. CHECKOUT TO BE HANDLED .Also to return to this page after removal of item. ALIGN PRICE TO RIGHT. -->
<!-- SUGGESTION : UPDATE AFTER 30 MINS -->
<?php
	session_start();
	include ("dbconfig.php");//Connection to database
	include ("test_variables.php");

	$redirect_to_user_login = "user_login.php";

	//Check if user is logged in
	if(!$_SESSION["user_reg"]){//Login failed.Redirect to user_login.php
		header("Location: " .$redirect_to_user_login);
	}

	else{
		//print_r($_SESSION);
		$cart_total = 0;
?>

			<html>
				<head>
					<title>Your Cart</title>
					<h5>Remember that you can add items in the cart,but we can't guarantee that they will not sell before you check out...Real life<br>Out of your added items,we only display the ones in stock.The rest are eradicated from existence,forever...</h1>
				</head>
				<body>
					<table>
						<thead>
							<h3>Your Cart</h3>
							<tr>
								<th>Item</th>
								<th>Price</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$books = mysqli_query($conn,"SELECT books.id, books.author, books.title, books.price FROM books INNER JOIN cart ON books.id = cart.item_id WHERE item_category = 'books' AND is_sold = 0 AND cart.reg = '".$_SESSION['user_reg']."'");//Query for books added to the cart by this user . 'books.price' to be added later

								while($row = mysqli_fetch_assoc($books)) {//Start a while loop here to display fetch items in this division?>
									<tr>
										<td>
											<?php echo $row['author']." ".$row['title'] ?>
										</td>
										<td>
											<?php echo $row['price'] ?>
										</td>
										<td><?php echo "<a href='cart_remove_item.php?category=books&item_id=".urlencode($row["id"])."'>Remove Item</a>" ?></td>
									</tr>
								<?php 
								$cart_total = $cart_total + $row['price'];
								} 
								
								$bikes = mysqli_query($conn,"SELECT bikes.id, bikes.brand, bikes.gear, bikes.price FROM bikes INNER JOIN cart ON bikes.id = cart.item_id WHERE item_category = 'bikes' AND is_sold = 0 AND cart.reg = '".$_SESSION['user_reg']."'");//Query for bikes added to the cart by this user . 'bikes.price' to be added later
							
								while($row = mysqli_fetch_assoc($bikes)) {//Start a while loop here to display fetch items in this division?>
									<tr>
										<td>
											<?php
											echo $row['brand']." ".$row['gear'] ?>
										</td>
										<td>
											<?php echo $row['price'] ?>
										</td>
										<td>
											<td><?php echo "<a href='cart_remove_item.php?category=bikes&item_id=".urlencode($row["id"])."'>Remove Item</a>" ?></td>
										</td>
									</tr>
								<?php 
								$cart_total = $cart_total + $row['price'];
								}

								$misc = mysqli_query($conn,"SELECT misc.id, misc.name, misc.price FROM misc INNER JOIN cart ON misc.id = cart.item_id WHERE item_category = 'misc' AND is_sold = 0 AND cart.reg = '".$_SESSION['user_reg']."'");//Query for misc added to the cart by this user . 'misc.price' to be added later
							
								while($row = mysqli_fetch_assoc($misc)) {//Start a while loop here to display fetch items in this division?>
									<tr>
										<td>
											<?php echo $row['name'] ?>
										</td>
										<td>
											<?php echo $row['price'] ?>
										</td>
										<td>
											<td><?php echo "<a href='cart_remove_item.php?category=misc&item_id=".urlencode($row["id"])."'>Remove Item</a>" ?></td>
										</td>
									</tr>
								<?php 
								$cart_total = $cart_total + $row['price'];
								}
								?>
						</tbody>
					</table>
					<hr>
					Cart Total :<?php echo $cart_total."<br>"; ?>
					<?php if($cart_total > 0){echo "<a href='checkout.php'>Checkout</a>";} ?>
				</body>
			</html>

	<?php
	}
	?>
<?php 
	include ("test_variables.php");
?>