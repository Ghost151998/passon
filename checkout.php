<!-- Checkout while placing cart as order -->
<?php 
	session_start();
	include ("dbconfig.php");//Connection to database

	$redirect_to_cart = "cart.php";
	$redirect_to_user_login = "user_login.php";

	//Test variables
	$_SESSION["category"] = "bikes";
	$_SESSION["item_id"] = 1;

	//Check if user is logged in
	if(!$_SESSION["user_reg"]){//Login failed.Redirect to user_login.php
		header("Location: " .$redirect_to_user_login);
	}
	print_r($_SESSION);

	$results = mysqli_query($conn,"SELECT FROM cart WHERE item_category = '".$_SESSION["item_category"]."' AND item_id = '".$_SESSION["item_id"]."' AND cart.reg = '".$_SESSION["user_reg"]."' "); //fetch user cart

	$check = mysqli_query($conn,"SELECT * FROM sold_items INNER JOIN cart ON sold_items.reg = cart.reg AND sold.item_id = cart.item_id AND sold_items.item_category = cart.item_category ");//check if order is placed already

	if(mysqli_num_rows($check) == 0){//if order is not placed
		//SUGGESTION: ORDER SHOULD BE PLACED ONLY FOR ITEMS WHICH ARE NOT PLACED ALREADY...REST IGNORED
		while($row = mysqli_fetch_assoc($results)){
			mysql_query($conn,"INSERT INTO sold_items (reg, id, category) VALUES ('"$_SESSION["user_reg"]."','".$_SESSION["item_id"]."','".$_SESSION["item_category"]."') ");
		}
	}
	//SHOULD CHANGE CART is_deleted TO 1 INSTEAD OF DELETING 
	mysqli_query($conn,"DELETE FROM cart WHERE item_id = '".$_SESSION["item_id"]."' AND item_category = '".$_SESSION["category"]."'  AND cart.reg ='".$_SESSION["user_reg"]."'");
	header("Location: ".$redirect_to_cart);
?>