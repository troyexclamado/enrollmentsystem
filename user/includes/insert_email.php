<?php 
include("db.inc.php");
session_start();

if(isset($_POST["submit"])){

    $accountID = $_SESSION['studentnum'];
    $email = $_POST['email'];
    $confirmEMail = $_POST['confirm-email'];

    $exist = "SELECT * FROM tblstudentaccounts WHERE email = '$email'";
    $success = mysqli_query($conn, $exist);

    if(mysqli_num_rows($success) > 0){
        $_SESSION["email_exist"] = "This email is already exist";
        return;
    }

    if($email != $confirmEMail){
        $_SESSION['not_match'] = "Email does not match";
        return;
    }
    if($email == $confirmEMail){
        $sql = "UPDATE tblstudentaccounts SET email= '".$confirmEMail."' WHERE studentNumber = $accountID";
        $success = mysqli_query($conn, $sql);

        if($success){
            $_SESSION["email"] = $confirmEMail;
            header('location: index.php');
            die();
        }
    }
}
?>