<?php 
include("db.inc.php");
session_start();

if(isset($_POST["submit"])){

    $security_code = $_POST["sec_code"];
    $code = $_SESSION["security_code"];

    if($security_code != $code){
        $_SESSION["error"] = "Code invalid. Please try again.";
        header('location: ../confirmemail.php');
        die();
    }
    if($security_code == $code){
        header('location: ../changepass.php');
        die();
    }
}
?>