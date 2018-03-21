<?php 
	session_start();
	include ("../test_variables.php");

	//Test variables
	$category = "books";
	$id = "3";
	$extension = ".jpg";

	$file_name = $category.$id.$extension;
	$target_dir = "images/";
	$target_file = $target_dir.$file_name;
	//echo $target_file."<br>";
	$uploadOk = 0;

	$allowed = array("png","jpg","jpeg");
	//Check if image is not fake
	$imageFileType = strtolower(pathinfo($_FILES['item_image']['name'],PATHINFO_EXTENSION));
	echo $imageFileType."<br>";
	if(in_array($imageFileType,$allowed)){
		$check = getimagesize($_FILES['item_image']['tmp_name']);
		print_r($check);
		if($check !== false){
			//echo "File is an image - ".$check["mime"].".<br>";
			$uploadOk = 1;
		}
		else{
			//echo "File is not an image.<br>";
			$uploadOk = 0;
		}
		//Check if image is exceeding 1MB
		if ($_FILES["item_image"]["size"] > 1048576) {
			//echo "Sorry, your file is too large.<br>";
			$uploadOk = 0;
		}

		if ($uploadOk == 0) {
		//echo "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
		}

		else{
			if (move_uploaded_file($_FILES["item_image"]["tmp_name"], $target_file)) {
				rename('images/books3.jpg','images/salereq/books3.jpg');
				echo "<br>Image Path:";
				$img_path = "images/salereq/".$category.$id;
				echo $img_src = "images/salereq/".$category.$id.".*";
				echo "<br>Result of search:";
				$result = glob($img_src);
				print_r($result);
				echo "<br>Upload Extension:";
				echo $upload_ext = strtolower(pathinfo($_FILES['item_image']['name'],PATHINFO_EXTENSION));
				echo "<br>Output Extension:";
				echo $extension = strtolower(pathinfo($result[0],PATHINFO_EXTENSION));
				echo "<br>Final Image Path:";
				echo $img_path .= ".".$extension;
				echo "<br>";

				echo "File uploaded successfully<br>";
				//echo "The file ".basename($_FILES["item_image"]["name"])." has been uploaded.";
			} else {
				//echo "Sorry, there was an error uploading your file.";
			}
		}
		//echo "<br>Extension is Ok!<br>";
	}
?>

<html>
	<head>
		<title>
			Image Testing
		</title>
	</head>
	<body>
		<h3>Image Testing</h3>
		<image src="<?php echo $img_path; ?>" alt="Batman" height="200" width="320" >
	</body>
</html>

<?php 
	include ("../test_variables.php");
?>