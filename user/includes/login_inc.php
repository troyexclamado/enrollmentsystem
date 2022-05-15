<?php
	include("db.inc.php");
	session_start();

	if(isset($_POST['submit'])){
		$studentnum = $_POST['studentnum'];
		$Pass = $_POST['pass'];

		//$Password = md5($Pass);

		$sql = "SELECT * FROM tblstudentaccounts WHERE studentNumber = '".$studentnum."' AND password = '".$Pass."'";
		$result = mysqli_query($conn, $sql);

		if(mysqli_num_rows($result) == 1){
			$row = mysqli_fetch_assoc($result);
			if($row['studentNumber'] === $studentnum && $row['password'] == $Pass){
				$_SESSION['studentnum'] = $row['studentNumber'];
				
				header('location: index.php');
            	die();
			}
		}
		else{
				$_SESSION['failed'] = "Wrong student number or password";
			}

		$sql1 = "SELECT * FROM tblstudentaccounts WHERE studentNumber = '".$studentnum."'";
		$success = mysqli_query($conn, $sql1);

		if(mysqli_num_rows($success) == 0){
			$_SESSION['student_notexist'] = "Student number does not exist";
			return;
		}
	}
?>