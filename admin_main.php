<!-- UNFINISHED,ONLY FOR BOOKS NOW AND DOES NOT UPDATE DB ON CHECK-->
<!-- Admin Main Page -->
<?php
	session_start();
	include ("dbconfig.php");

	$redirect_to_admin_login = "admin_login.php";

	if(!$_SESSION["adminnum"]){ //Admin not logged in.Redirect to login
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
				<br>
				<table>
					<thead>
						<tr>
							<td>Seller</td>
							<td>Category</td>
							<td>Author Data</td>
							<td>Branch</td>
							<td>Semester</td>
							<td>Description</td>
							<td>Quality</td>
							<td>Verified Product?</td>
						</tr>
					</thead>
					<tbody>
						<?php
							//mysql_select_db("passon");
							$results = mysqli_query($conn,"SELECT * FROM salerequest WHERE deleted = 0");
							while($row = mysqli_fetch_array($results)){ ?>
								<form action="auth_salereq_admin_page.php" method="post">
									<tr>
										<td><input type="text" name="seller_reg" value="<?php echo $row['seller_reg']?>" required></td>
										<td><input type="text" name="category" value="<?php echo $row['category']?>" required></td>
										<td><input type="text" name="author_edition" value="<?php echo $row['author_edition']?>" required></td>
										<td><input type="text" name="branch" value="<?php echo $row['branch']?>" required></td>
										<td><input type="text" name="sem" value="<?php echo $row['sem']?>" required></td>
										<!-- If time permits,change these to datalist -->
										<td><input type="text" name="description" value="<?php echo $row['description']?>" required></td>
										<td><input type="text" name="quality" value="<?php echo $row['quality']?>" required></td>
										<td><input type="submit" name="confirm_check" value="Confirm"></td>
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
