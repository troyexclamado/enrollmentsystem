<?php
	
	$server_name = "localhost";
	$server_username = "root";
	$server_password = "";
	//$database_name = "enrollmentmanagementsystem";
	$database_name = "enrollementmgtsystem";

	$conn = mysqli_connect($server_name, $server_username, $server_password,$database_name);

	if (!$conn) {
  		die("Connection failed: " . mysqli_connect_error());
	}
?>

