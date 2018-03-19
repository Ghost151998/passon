<!-- BOOKS LIST PAGE!!!Remember to place a div and format this category.No images added as of yet. Give classes for formatting.-->
<?php
	session_start();
	include ("dbconfig.php");
	include ("test_variables.php");

	//Test Variables
	//unset($_GET["book_branch"]);
	//$_GET["book_branch"] = "mechprod";
	//$_GET["category"] = "books";
	//$_GET["category"] = "bikes";
	//$_GET["category"] = "misc";
	
	$redirect_to_user_login = "user_login.php";

	//Check if user is logged in
	if(!$_SESSION["user_reg"]){//Login failed.Redirect to user_login.php
		header("Location: " .$redirect_to_user_login);
	}

	else{
		if(isset($_GET["category"])){ ?>
			<html>
				<head>
					<title><?php switch($_GET["category"]){
						case "books": {echo "Books";break;}
						case "bikes": {echo "Bikes";break;}
						case "misc" : {echo "Misc";break;}
					}?></title>
					<h3><?php switch($_GET["category"]){
						case "books": {echo "Books";break;}
						case "bikes": {echo "Bikes";break;}
						case "misc" : {echo "Misc";break;}
					}?></h3>
				</head>
				<body>
		<?php
		if($_GET["category"] == "books"){
			if(!isset($_GET["book_branch"])){
				echo "<h3>Miscellaneous Books</h3>";
				$results = mysqli_query($conn,"SELECT * FROM books WHERE is_sold = 0 AND sem IS NULL");//Find All non course book results
				//print_r(mysqli_fetch_assoc($results));
				if(mysqli_num_rows($results) > 0){
					while($row = mysqli_fetch_assoc($results)){ ?>
							<!-- take all entries from table and fill them in html -->
							<!-- Set this while loop in div and format it -->
							<!-- Set the onclick listener for this div to book_description -->
							Author :<?php echo $row['author']; ?><br>
							Title :<?php echo $row['title']; ?><br>
							Edition :<?php echo $row['edition']; ?><br>
							Price :<?php echo $row['price']; ?><br>
							<?php echo "<a href='item_description.php?category=".urlencode($_GET["category"])."&item_id=".urlencode($row["id"])."'>View</a>" ?>
					<?php 
					}
				}
			}
			else{
				switch($_GET["book_branch"]){
					case "cseit":{$branch_title = "Computer Science/Information Technology";break;}
					case "chem":{$branch_title = "Chemical";break;}
					case "mechprod":{$branch_title = "Mechanical/Production";break;}
					case "ece":{$branch_title = "Electronics and Communications";break;}
					case "ee":{$branch_title = "Electrical";break;}
					case "biot":{$branch_title = "Biotechnology";break;}
					case "civ":{$branch_title = "Civil";break;}
				}
				echo "<h3>Branch : ".$branch_title."</h3>";
				for($i = 1; $i<=8; $i++){
					$results = mysqli_query($conn,"SELECT * FROM books WHERE is_sold = 0 AND branch = '".$_GET["book_branch"]."' AND sem = '".$i."'");//Take the info of all books from database for a semester
					//print_r($results);
					if(mysqli_num_rows($results) > 0){
						echo "<div name=semester_".$i.">";//apply a div for each semester
						while($row = mysqli_fetch_assoc($results)){ ?>
							<!-- take all entries from table and fill them in html -->
							<!-- Set this while loop in div and format it -->
							<!-- Set the onclick listener for this div to book_description -->
							Author :<?php echo $row['author']; ?><br>
							Title :<?php echo $row['title']; ?><br>
							Edition :<?php echo $row['edition']; ?><br>
							Price :<?php echo $row['price']; ?><br>
							<?php echo "<a href='item_description.php?category=".urlencode($_GET["category"])."&item_id=".urlencode($row["id"])."'>View</a>" ?>
						<?php 
						} //all results of a semester
						echo "</div>";
						?>
					<?php } //if results for semester exist
				} //for all 8 semesters
				
			} //if books have branch
		} //if category = books


		if($_GET["category"] == "bikes"){
			$results = mysqli_query($conn,"SELECT * FROM bikes WHERE is_sold = 0");
			while($row = mysqli_fetch_assoc($results)){?>
				Brand :<?php echo $row['brand']?><br>
				Gear :<?php echo $row['gear']?><br>
				Colour :<?php echo $row['colour']?><br>
				Price :<?php echo $row['price']?><br>
				<?php echo "<a href='item_description.php?category=".urlencode($_GET["category"])."&item_id=".urlencode($row["id"])."'>View</a>" ?>
			<?php
			}
		}//if category is bikes

		if($_GET["category"] == "misc"){
			$results = mysqli_query($conn,"SELECT * FROM misc WHERE is_sold = 0");
			while($row = mysqli_fetch_assoc($results)){?>
				Name :<?php echo $row['name']?><br>
				Price :<?php echo $row['price']?><br>
				<?php echo "<a href='item_description.php?category=".urlencode($_GET["category"])."&item_id=".urlencode($row["id"])."'>View</a>" ?>
				<?php 
			}//if category is misc
			
		}
		?>
				</body>
			</html>
	<?php
	} //if category is set
		} ?>
<?php 
	include ("test_variables.php");
?>