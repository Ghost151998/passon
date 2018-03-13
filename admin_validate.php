<?php
/*Validates admin login credentials for authorizing to admin_page*/
	session_start();
	include ("dbconfig.php");//Connection to database
	$_SESSION  = array();//To clear session data
	$redirect_to_success = "admin_main.php";//Set this to the page to redirect on verification
	$redirect_to_failure = "admin_login.php";

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if (!empty($_POST["admin_num"]) && !empty($_POST["admin_pwd"])) {
			$admin_num =  mysqli_real_escape_string($conn, sanitize_input($_POST["admin_num"]));
			$admin_pwd =  mysqli_real_escape_string($conn, sanitize_input($_POST["admin_pwd"]));
			$result = mysqli_query($conn,"SELECT adminnum FROM admins WHERE adminnum = '".$admin_num."' AND adminpassword ='".$admin_pwd."'");
			//print_r($result);
			if(mysqli_num_rows($result) > 0){// Execute admin_page in this block,set $_SESSION["admin_login"] = true;
				$db_admin = mysqli_fetch_object($result);
				$_SESSION["adminnum"] = $db_admin->adminnum;
				//echo "Welcome,<br>" . $admin_num;//Comment out this line,only for testing
				header("Location: ".$redirect_to_success);
			}
			else{//Die in this,or redirect to login
				//echo "<br>Login Failed";
				$_SESSION  = array();
				header("Location: ".$redirect_to_failure);//Redirect to Admin Login
			}
		}
	}

	function sanitize_input($data) {//sanitizing input
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

?>