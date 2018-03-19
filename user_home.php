<!-- USER MAIN -->
<?php 
	session_start();
	include ("dbconfig.php");//Connection to database
	include ("test_variables.php");

	$redirect_to_user_login = "user_login.php";

	//Check if user is logged in
	if(!$_SESSION["user_reg"]){//Login failed.Redirect to user_login.php
		header("Location: " .$redirect_to_user_login);
	}
?>
<html>
	<head>
		<title>User Home</title>
		<h3>User Home</h3>
	</head>
	<body>
		<ul>

			<li><a href='items_list.php?category=books&book_branch=cseit'>Computer Science/Information Technology</a></li>
			<li><a href='items_list.php?category=books&book_branch=ece'>Electonics and Communications</a></li>
			<li><a href='items_list.php?category=books&book_branch=ee'>Electrical</a></li>
			<li><a href='items_list.php?category=books&book_branch=civ'>Civil</a></li>
			<li><a href='items_list.php?category=books&book_branch=mechprod'>Mechanical/Production</a></li>
			<li><a href='items_list.php?category=books&book_branch=chem'>Chemical</a></li>
			<li><a href='items_list.php?category=books&book_branch=biot'>Biotechnology</a></li>
			<li><a href='items_list.php?category=books'>Books for the beyond</a></li>
			<li><a href='items_list.php?category=bikes'>Bikes</a></li>
			<li><a href='items_list.php?category=misc'>Misc</a></li>
			<li><a href='cart.php'>Cart</a></li>
			<li><a href="#">About Us ----------!NOT LINKED!</a></li>
			<li><a href="seller_page.php">Want to Sell?</a></li>
			<li><a href="logout.php">Logout</a></li>
		</ul>
	</body>
</html>
<?php 
	include ("test_variables.php");
?>