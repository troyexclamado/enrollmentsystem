<?php
include("db.inc.php");
session_start();

if(isset($_POST['submit_info'])){
    
	$Firstname = $_POST['fname'];
	$Midname = $_POST['mname'];
	$Lastname = $_POST['lname'];
    $studnum = $_POST['studnum'];
	$Email = $_POST['email'];
	$position = $_POST['position'];
	$pass = $_POST['pass'];
	$pass1 = $_POST['pass1'];
	$count = strlen($pass);

<<<<<<< HEAD
	$upperFname = strtoupper($Firstname);
	$upperMname = strtoupper($Midname);
	$upperLname = strtoupper($Lastname);
	$upperposition = strtoupper($position);

=======
>>>>>>> parent of 0a699e2 (Merge branch 'master' into added_features)
	$sql1 = "SELECT * FROM tblaccounts WHERE email ='".$Email."'";
	$result = mysqli_query($conn, $sql1);

	if(mysqli_num_rows($result) > 0){
		$_SESSION['email_exist'] = "Email already exist"; 
		return;

	}
	$sql2 = "SELECT * FROM tblaccounts WHERE studentNumber ='".$studnum."'";
	$result2 = mysqli_query($conn, $sql2);

	if(mysqli_num_rows($result2) > 0){
		$_SESSION['studnum_exist'] = "Student number already exist"; 
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

<<<<<<< HEAD
		$sql3 = "INSERT INTO tblaccounts(studentNumber, email, firstname, lastname, password, middlename, position) VALUES('".$studnum."','".$Email."','".$upperFname."','".$upperLname."','".$Password."','".$upperMname."', '".$upperposition."')";
=======
		$sql3 = "INSERT INTO tblaccounts(studentNumber, email, firstname, lastname, password, middlename, position) VALUES('".$studnum."','".$Email."','".$Firstname."','".$Lastname."','".$Password."','".$Midname."', '".$position."')";
>>>>>>> parent of 0a699e2 (Merge branch 'master' into added_features)
	$success = mysqli_query($conn, $sql3);
	if($success){
		$_SESSION['register'] = "Sign up complete";
		echo "<script>window.open('login.php','self')</script>";
	}
	}
	
	
}
?>