<?php 
include("db.inc.php");
session_start();

if(isset($_POST["submit"])){

    $pass = $_POST["newpass"];
    $confirmpassword = $_POST["confirmpass"];
    $countpass = strlen($pass);
    $studnum = $_SESSION["studentnumber"];


    if($countpass < 6){
        $_SESSION["less"] = "Password must be 6 or more";
        header('location: ../changepass.php');
        die();
    }

    if($pass != $confirmpassword){
        $_SESSION["not_match"] = "Password does not match";
        header('location: ../changepass.php');
        die();
    }

    if($newpass == $confirmpass){

        $confirmpass = strtolower($confirmpassword);
        // $password = md5($confirmpass);
        $sql = "UPDATE tblstudentaccounts SET password = '".$confirmpass."' WHERE studentNumber = '$studnum'";
        $result = mysqli_query($conn, $sql);

        if($result){
        $_SESSION["passchanged"] = "Password has been changed";
        header('location: ../login.php');
        die();
        }
    }
}
?>