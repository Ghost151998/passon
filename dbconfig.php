<!-- Establishing connection to passon database -->
<?php
$host = "localhost";
$username = "root" ;
$password = "";
$dbnm = "passon";
$conn = mysqli_connect($host,$username,$password,$dbnm);
  if(mysqli_connect_errno())
  {
	die("Connection Failed...:" .mysqli_connect_error()); 
  }
?>