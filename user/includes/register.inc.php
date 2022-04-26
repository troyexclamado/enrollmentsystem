<?php
include("db.inc.php");
session_start();

if(isset($_POST['submit_info'])){
    
	$Firstname = $_POST['fname'];
	$Midname = $_POST['mname'];
	$Lastname = $_POST['lname'];
	$Email = $_POST['email'];
	$position = $_POST['position'];
	$pass = $_POST['pass'];
	$pass1 = $_POST['pass1'];
	$count = strlen($pass);

	$sql1 = "SELECT * FROM tblaccounts WHERE email ='".$Email."'";
	$result = mysqli_query($conn, $sql1);

	if(mysqli_num_rows($result) > 0){
		$_SESSION['email_exist'] = "Email already exist"; 
		return;

	}
	if($count < 6){
		$_SESSION['pass_count'] = "Password must be 6 or more";
		return;
	}
	if($pass != $pass1){
		$_SESSION['not_match'] = "Password does not match";
		return;
	}
	if($pass == $pass1){
		$Password = md5($pass1);

		$sql2 = "INSERT INTO tblaccounts(email, firstname, lastname, password, middlename, position) VALUES('".$Email."','".$Firstname."','".$Lastname."','".$Password."','".$Midname."', '".$position."')";
	$success = mysqli_query($conn, $sql2);
	if($success){
		$_SESSION['register'] = "Sign up complete";
		echo "<script>window.open('login.php','self')</script>";
	}
	}
	
	
}
?>