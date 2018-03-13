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
				<form action="auth_salereq_admin_page.php" method="post">
					<!-- Use php code to query and populate a table with verification checkboxes and update DB accordingly on submit -->
					<h3>Queued items for verification</h3>
					<br>
					<table>
						<thead>
							<tr>
								<td>Uploaded By</td>
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
								$results = mysqli_query($conn,"SELECT * FROM salerequest");
								while($row = mysqli_fetch_array($results)){ ?>

									<tr>
										<td><?php echo $row['reg']?></td>
										<td><?php echo $row['category']?></td>
										<td><?php echo $row['author_edition']?></td>
										<td><?php echo $row['branch']?></td>
										<td><?php echo $row['sem']?></td>
										<td><?php echo $row['description']?></td>
										<td><?php echo $row['quality']?></td>
										<td><input type="checkbox" name="confirm" value="accept"></td>
										<!-- This is where a checkbox for validation and a checkbox for decline will go.Also,join the userinfo from users table into this table to contact and confirm. -->
									</tr>

									<?php 
									}
									?>
							?>
						</tbody>
					</table>

				</form>
			</body>
		</html>

		<?php
	}
?>
