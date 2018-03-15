<!-- User's Cart Page-->
<!-- REMOVE ITEM TO BE ADDED FOR EACH ITEM,PRICES TO BE ADDED,BIKES AND MISC SHOULD BE HANDLED AND CHECKOUT TO BE HANDLED -->
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
					<title>Your Cart</title>
					<h5>Remember that you can add items in the cart,but we can't guarantee that they will not sell before you check out...Real life<br>Out of your added items,we only display the ones in stock.The rest are eradicated from existence,forever...</h1>
				</head>
				<body>
					<table>
						<thead>
							<h3>Your Cart</h3>
							<tr>
								<th>Item Name</th>
								<!-- <th>Price</th> -->
							</tr>
						</thead>
						<tbody>
							<?php
								$books = mysqli_query($conn,"SELECT books.id, books.author_edition FROM books LEFT JOIN cart ON books.id = cart.item_id WHERE cart.reg = '".$_SESSION['user_reg']."'");//Query for books added to the cart by this user . 'books.price' to be added later

								while($row = mysqli_fetch_array($books)) {//Start a while loop here to display fetch items in this division?>
									<tr>
										<td>
											<?php echo $row['author_edition'] ?>
										</td>
										<!-- <td>
											<?php ?>Price!
										</td> -->
									</tr>
								<?php 
								} 
								?>

							<!-- <?php
								$bikes = mysqli_query($conn,"SELECT bikes.id, bikes.brand, bikes.gear FROM bikes LEFT JOIN cart ON bikes.id = cart.item_id WHERE cart.reg = '".$_SESSION['user_reg']."'");//Query for bikes added to the cart by this user . 'bikes.price' to be added later
							
								while($row = mysqli_fetch_array($bikes)) {//Start a while loop here to display fetch items in this division?>
									<tr>
										<td>
											<?php 
											$name = $row['brand']." ".$row['gear'];
											echo $name ?>
										</td>
										<td>
											<?php ?>Price!
										</td>
									</tr>
								<?php 
								} 
								?> -->

							<!-- <?php
								$misc = mysqli_query($conn,"SELECT misc.id, misc.item_name FROM misc LEFT JOIN cart ON misc.id = cart.item_id WHERE cart.reg = '".$_SESSION['user_reg']."'");//Query for misc added to the cart by this user . 'misc.price' to be added later
							
								while($row = mysqli_fetch_array($misc)) {//Start a while loop here to display fetch items in this division?>
									<tr>
										<td>
											<?php echo $row['item_name'] ?>
										</td>
										<td>
											<?php ?>Price!
										</td>
									</tr>
								<?php 
								} 
								?> -->
						</tbody>
					</table>
				</body>
			</html>

	<?php
	}
	?>