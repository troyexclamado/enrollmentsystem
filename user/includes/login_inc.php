<?php
	include("db.inc.php");
	session_start();

	if(isset($_POST['submit'])){
		$Email = $_POST['email'];
		$Pass = $_POST['pass'];
		$Password = md5($Pass);

		$sql = "SELECT * FROM accounts WHERE email = '".$Email."' AND password = '".$Password."'";
		$result = mysqli_query($conn, $sql);

		if(mysqli_num_rows($result) == 1){
			$row = mysqli_fetch_assoc($result);
			if($row['email'] === $Email && $row['password'] == $Password){
				$_SESSION['ID'] = $row['accountID'];
				$_SESSION['Email'] = $row['email'];
				$_SESSION['Password'] = $row['password'];
				
				header('location: index.php');
            	die();
			}
		}
		else{
				$_SESSION['failed'] = "Wrong password or email";
			}

		$sql1 = "SELECT * FROM accounts WHERE email = '".$Email."'";
		$success = mysqli_query($conn, $sql1);

		if(mysqli_num_rows($success) == 0){
			$_SESSION['email_notexist'] = "Email does not exist";
			return;
		}
	}
?>