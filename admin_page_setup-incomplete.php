<?php
	include ("dbconfig.php");//Connection to database
	$redirect_to = "admin_login.php";

	if (!isset($_SESSION["username"])) {
		header("Location: ".$redirect_to);//Redirect to Admin Login
	}
	else{
		//SQL queries to fill in a table tag
	}
?>