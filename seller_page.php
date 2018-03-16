<?php 
	session_start();
	print_r($_SESSION);
	include ("dbconfig.php");
	$redirect_to_user_login = "user_login.php";

	if(!$_SESSION["user_reg"]){//Login failed.Redirect to user_login.php
		header("Location: " .$redirect_to_user_login);
	}
	else{ ?>
	<!-- Seller Item Upload Page -->
<!-- use js to hide/disable the following rows on the basis of category -->
<html>
	<head>
		<title>Want to sell through us?</title>
	</head>
	<body>
		<h3>Item Details</h3>
		<form action="sell_request_verification.php" method="post">
			
			Item Category:<br><br>
			<input type="radio" name="category" value="books" checked>Books<br>
			<input type="radio" name="category" value="bikes">Bikes<br>
			<input type="radio" name="category" value="misc">Misc<br>
			<br>
			<fieldset name="books">
				<legend>Book</legend>
				Author:<br>
				<input type="text" name="book_author" required>
				<br><br>

				Edition:<br>
				<input type="text" name="book_edition" required>
				<br><br>			

				Branch:<br>
				<select name="book_branch">
					<option value="null" selected>Branch</option>
					<option value="cseit">CSE/IT</option>
					<option value="ece">ECE</option>
					<option value="chem">Chemical</option>
					<option value="civ">Civil</option>
					<option value="biot">Biotechnology</option>
					<option value="mechprod">Mechanical/Production</option>
					<option value="ee">Electrical</option>
				</select>
				<br><br>

				Semester:<br>
				<select name="book_sem">
					<option value="null" selected>Sem</option>
					<option value="1">1st</option>
					<option value="2">2nd</option>
					<option value="3">3rd</option>
					<option value="4">4th</option>
					<option value="5">5th</option>
					<option value="6">6th</option>
					<option value="7">7th</option>
					<option value="8">8th</option>
				</select>
				<br>
			</fieldset>
			<br><br>

			<!-- BUG:THESE TWO FIELDSETS SHOULD BE DISABLED!!!NOT ONLY HIDDEN,THEY SHOULD BE OFF THE FORM ELSE THEIR REQUIRED ATTRIBUTE WON'T LET THE FORM SUBMIT -->
			<!-- <fieldset name="bikes">
				<legend>Bike</legend>
				Brand:<br>
				<input type="text" name="bike_brand"  required>
				<br><br>
				Gear Info:<br>
				<input type="text" name="bike_gear" required>
				<br><br>
				Colour:<br>
				<input type="text" name="bike_colour" required>
				<br><br>
			</fieldset>
			<br><br>
			
			<fieldset name="misc">
				<legend>Misc</legend>
				Item Name:<br>
				<input type="text" name="misc_name" required>
				<br><br>
			</fieldset>
			<br><br> -->

			Description:<br>
			<textarea name="description" rows="5" cols="100"></textarea>
			<br><br>
			Quality:<br>
			<select name="quality">
				<option value="new">New</option>
				<option value="good" selected>Good</option>
				<option value="ok">Okay</option>
				<option value="poor">Poor</option>
			</select>
			<br><br>

			Price:<br>
				<input type="text" name="price" required>
				<br><br>

			<input type="submit" value="Submit for Verification" name="seller_submitbtn">
			<input type="reset" value="Back" name="seller_backbtn">

		</form>
	</body>
</html>
	<?php } ?>