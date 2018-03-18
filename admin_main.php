<!-- UNFINISHED,ONLY FOR BOOKS NOW AND DOES NOT UPDATE DB ON CHECK-->
<!-- Admin Main Page -->
<?php
	session_start();
	include ("dbconfig.php");
	print_r($_SESSION);

	$redirect_to_admin_login = "admin_login.php";

	if(!$_SESSION["admin_code"]){ //Admin not logged in.Redirect to login
		$_SESSION = array();
		header("Location: ".$redirect_to_admin_login);
	}
	else{ // Logged in. Display editable table
		?>

		<!DOCTYPE html>
		<html>
			<head>
				<title>Admin Main Page</title>
			</head>
			<body>
				<h3>Admin Main Page</h3>
				<?php echo "Welcome,".$_SESSION["admin_name"]."<br>"?>
					<!-- Use php code to query and populate a table with verification checkboxes and update DB accordingly on submit -->
				
				<!-- Table for undelivered items -->
				<h3>Queued items for verification</h3>
				<h5>Change the incorrect details</h5>
				<br>
				<table>
					<thead>
						<tr>
							<td>Verified Product?</td>
							<td>Seller</td>
							<td>Category</td>
							<td>Author</td>
							<td>Edition</td>
							<td>Branch</td>
							<td>Semester</td>
							<!-- <td>Brand</td>
							<td>Gear</td>
							<td>Colour</td>
							<td>Name</td> -->
							<td>Description</td>
							<td>Quality</td>
							<td>Price</td>

						</tr>
					</thead>
					<tbody>
						<?php
							//mysql_select_db("passon");
							$results = mysqli_query($conn,"SELECT * FROM salerequest WHERE deleted = 0");

							while($row = mysqli_fetch_array($results)){ ?>
								<form action="auth_salereq_admin_page.php" method="post">
									<tr>
										<td><input type="submit" name="confirm_check" value="Confirm"></td>
										<td><input type="text" name="seller" value="<?php echo $row['seller']?>" required></td>
										<td><input type="text" name="category" value="<?php echo $row['category']?>" required></td>
										<td><input type="text" name="author" value="<?php echo $row['author']?>" required></td>
										<td><input type="text" name="edition" value="<?php echo $row['edition']?>" required></td>
										<td><input type="text" name="branch" value="<?php echo $row['branch']?>" required></td>
										<td><input type="text" name="sem" value="<?php echo $row['sem']?>" required></td>
										<!-- If time permits,change these to datalist -->

										<!-- Remove required from these inputs on category == books,and disable them.Also,if one of these are selected,do the same with books -->
										<!-- <td><input type="text" name="brand" value="<?php echo $row['brand']?>" required></td>
										<td><input type="text" name="gear" value="<?php echo $row['gear']?>" required></td>
										<td><input type="text" name="colour" value="<?php echo $row['colour']?>" required></td>
										<td><input type="text" name="name" value="<?php echo $row['name']?>" required></td> -->


										<td><input type="text" name="description" value="<?php echo $row['description']?>" required></td>
										<td><input type="text" name="quality" value="<?php echo $row['quality']?>" required></td>
										<td><input type="text" name="price" value="<?php echo $row['price']?>" required></td>
										<!-- This is where a checkbox for validation and a checkbox for decline will go.Also,join the userinfo from users table into this table to contact and confirm. -->
									</tr>
								</form>
							<?php 
							}
						?>
					</tbody>
				</table>


				<h3>Queued Items for Delivery</h3>
				<br>
				<table>
					<thead>
						<tr>
							<td>Delivered Product?</td>
							<td>Price</td>
							<td>Customer</td>
							<td>Category</td>
							<td>Author</td>
							<td>Edition</td>
							<!-- <td>Brand</td>
							<td>Gear</td>
							<td>Colour</td>
							<td>Name</td> -->
							<!-- <td>Seller</td> -->
						</tr>
					</thead>
					<tbody>
						<?php
							$results = mysqli_query($conn,"SELECT * FROM sold_items WHERE is_delivered = 0");

							while($row = mysqli_fetch_array($results)){ ?>
								<form action="auth_sold_items_admin_page.php" method="post">
									<tr>
										<td><input type="submit" name="confirm_check" value="Delivered"></td>
										<td><input type="text" name="price" value="<?php echo $row['price']?>" required></td>
										<td><input type="text" name="customer" value="<?php echo $row['reg']?>" required></td>
										<td><input type="text" name="category" value="<?php echo $row['item_category']?>" required></td>
										<td><input type="text" name="author" value="<?php echo $row['author']?>" required></td>
										<td><input type="text" name="edition" value="<?php echo $row['edition']?>" required></td>
										<!-- If time permits,change these to datalist -->

										<!-- Remove required from these inputs on category == books,and disable them.Also,if one of these are selected,do the same with books -->
										<!-- <td><input type="text" name="brand" value="<?php echo $row['brand']?>" required></td>
										<td><input type="text" name="gear" value="<?php echo $row['gear']?>" required></td>
										<td><input type="text" name="colour" value="<?php echo $row['colour']?>" required></td>
										<td><input type="text" name="name" value="<?php echo $row['name']?>" required></td> -->


										<!-- <td><input type="text" name="seller_id" value="<?php echo $row['seller_id']?>" required></td> -->
										<!-- This is where a checkbox for validation and a checkbox for decline will go.Also,join the userinfo from users table into this table to contact and confirm. -->
									</tr>
								</form>
							<?php 
							}
						?>
					</tbody>
				</table>


			</body>
		</html>

		<?php
	}
?>
