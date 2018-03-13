<!DOCTYPE html>
<!-- Seller Item Upload Page -->
<!-- Need to introduce bikes and misc,use js to hide/disable the following rows on the basis of category -->
<html>
	<head>
		<title>Want to sell through us?</title>
	</head>
	<body>
		<h3>Item Details</h3>
		<form action="sell_request_verification.php" method="post">
			
			Item Category:<br><br>
			<!-- 1-Books 2-Bikes 3-Misc -->
			<input type="radio" name="category" value="books" checked>Books<br>
			<input type="radio" name="category" value="bikes">Bikes<br>
			<input type="radio" name="category" value="misc">Misc<br>
			<br>
			
			Author and Edition:<br>
			<input type="text" name="book_author_edition" required>
			<br><br>

			Branch:<br>
			<select name="book_branch">
				<option value="cseit" selected>CSE/IT</option>
				<option value="ece">ECE</option>
				<option value="chem">Chemical</option>
				<option value="civ">Civil</option>
				<option value="biot">Biotechnology</option>
				<option value="mechprod">Mechanical/Production</option>
				<option value="ee">Electrical</option>
				<option value="none">No category</option>
			</select>
			<br><br>
			Semester:<br>
			<select name="book_sem">
				<option value="1" selected>1st</option>
				<option value="2">2nd</option>
				<option value="3">3rd</option>
				<option value="4">4th</option>
				<option value="5">5th</option>
				<option value="6">6th</option>
				<option value="7">7th</option>
				<option value="8">8th</option>
			</select>
			<br>

			Description:<br>
			<textarea name="description" rows="5" cols="100"></textarea>
			<br>
			Quality:<br>
			<select name="quality">
				<option value="new">New</option>
				<option value="good" selected>Good</option>
				<option value="ok">Okay</option>
				<option value="poor">Poor</option>
			</select>
			<br><br>

			<input type="submit" value="Submit for Verification" name="seller_submitbtn">
			<input type="reset" value="Back" name="seller_backbtn">

		</form>
	</body>
</html>