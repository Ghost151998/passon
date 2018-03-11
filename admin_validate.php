<!-- Validates admin login credentials for authorizing to admin_page -->
<?php
	session_start();
	//include headers
	include ("dbconfig.php");//Connection to database

	$admin_numErr = $admin_pwdErr = "";
	$admin_num = $admin_pwd = "";

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if (empty($_POST["admin_num"]) || empty($_POST["admin_pwd"])) {//Never used since html takes care of required fields
			$admin_numErr = "Admin Number is required";
			$admin_pwdErr = "Password is required";
		} else {
			$admin_num =  mysqli_real_escape_string($conn, sanitize_input($_POST["admin_num"]));
			$admin_pwd =  mysqli_real_escape_string($conn, sanitize_input($_POST["admin_pwd"]));
			$result = mysqli_query($conn,"SELECT adminnum FROM admins WHERE adminnum = '".$admin_num."' AND adminpassword ='".$admin_pwd."'");
			//print_r($result);
			if(mysqli_num_rows($result) > 0){// Execute admin_page in this block,set $_SESSION["admin_login"] = true;
				$db_admin = mysqli_fetch_object($result);
				echo "<br>Welcome, ".$db_admin->adminnum;
			}
			else{//Die in this,or redirect to login
				echo "<br>Login Failed";
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