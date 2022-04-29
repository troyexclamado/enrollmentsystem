<?php
	
	$server_name = "localhost";
	$server_username = "root";
	$server_password = "";
	$database_name = "enrollmentmanagementsystem";

	$conn = mysqli_connect($server_name, $server_username, $server_password,$database_name);

	if (!$conn) {
  		die("Connection failed: " . mysqli_connect_error());
	}

	$SEMESTER = "";
	$SCHOOLYEAR = "";
	$GETSEMESTER = "SELECT * FROM tblenrollmentstatus LIMIT 1";
	$sqlGETSEMESTER = mysqli_query($conn, $GETSEMESTER);
	$resultGETSEMESTER = mysqli_fetch_array($sqlGETSEMESTER);
	$SEMESTER = $resultGETSEMESTER['schoolsemester'];
	$SCHOOLYEAR = $resultGETSEMESTER['schoolyear'];

?>

