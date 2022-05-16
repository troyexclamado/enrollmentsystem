<?php
$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "enrollmentmanagementsystem";

$conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);

if(!$conn){
	die("Connection Failed". mysqli_connect_error());
}
else
?>