<?php 
include("db.inc.php");
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if(isset($_POST["confirm"])){

    require 'PHPMailer/Exception.php';
    require 'PHPMailer/PHPMailer.php';
    require 'PHPMailer/SMTP.php';

    $email = $_SESSION["email"];
    $six_digit_random_number = random_int(100000, 999999);
    $accountID = $_SESSION['studentnum'];

    $sql = "SELECT * FROM tblstudentaccounts WHERE studentNumber = '$accountID'";
    $res = mysqli_query($conn, $sql);
    if($row = mysqli_fetch_array($res)){
        $lname = $row["lastname"];
        $fname = $row["firstname"];
    }
    $mail = new PHPMailer;

        $mail->isSMTP();                      
        $mail->Host = 'smtp.gmail.com';      
        $mail->SMTPAuth = true;              
        $mail->Username = 'ucc.enrollment.management2022@gmail.com';   // Your Email
        $mail->Password = 'sample0001';   // Your password
        $mail->SMTPSecure = 'tls';        
        $mail->Port = 587;                 

        // Add a recipient
        $mail->addAddress($email);
        
        $mail->isHTML(true);
        
        // Mail subject
        $mail->Subject = 'Verify Your Account';
        
        // Mail body content
        $bodyContent = '<p>Hi '.$fname.', '.$lname.',</p>';
        $bodyContent .= '<p>We received a request to reset your Enrollment Management Website account password.
        <br>Enter the following password reset code:</p><br><h4>'.$six_digit_random_number.'</h4>';
        $mail->Body    = $bodyContent;

        
        // Send email 
    if(!$mail->send()) { 
        echo 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo; 
    } else { 
        $_SESSION["sent"] = "Verification code has been sent";
        $_SESSION["code"] = $six_digit_random_number;
        header('location: ../profile_changepass.php');
        die();
        // echo 'Message has been sent.'; 
  } 
        }

if(isset($_POST["submit"])){

    $accountID = $_SESSION['studentnum'];
    $pass = $_POST["password"];
    $confirmpass = $_POST["confirm_password"];
    $verification = $_POST["verification"];
    $code = $_SESSION["code"];
    
    $email = $_SESSION["email"];
    $password = strlen($pass);

    if($password < 6){
        $_SESSION["greater"] = "Password must be greater than 6";
        header('location: ../profile_changepass.php');
        die();
    }
    if($verification != $code){
        $_SESSION["not_match"] = "Verification code does not match";
        header('location: ../profile_changepass.php');
        die();
    }
    
    if($pass == $confirmpass){

        $sql = "SELECT * FROM tblstudentaccounts WHERE studentNumber = '$accountID'";
        $res = mysqli_query($conn, $sql);
        if($row = mysqli_fetch_array($res)){
            $lname = $row["lastname"];
            $fname = $row["firstname"];
        }

        $passwordd = strtolower($pass);
        $sql = "UPDATE tblstudentaccounts SET password = '$passwordd' WHERE studentNumber = '$accountID'";
        $res = mysqli_query($conn, $sql);

        require 'PHPMailer/Exception.php';
        require 'PHPMailer/PHPMailer.php';
        require 'PHPMailer/SMTP.php';
        
        date_default_timezone_set('Asia/Singapore');
        $date = date('d-m-y h:i A');
     
        $mail = new PHPMailer;
    
            $mail->isSMTP();                      
            $mail->Host = 'smtp.gmail.com';      
            $mail->SMTPAuth = true;              
            $mail->Username = 'ucc.enrollment.management2022@gmail.com';   // Your Email
            $mail->Password = 'sample0001';   // Your password
            $mail->SMTPSecure = 'tls';        
            $mail->Port = 587;                 
    
            // Add a recipient
            $mail->addAddress($email);
            
            $mail->isHTML(true);
            
            // Mail subject
            $mail->Subject = 'Enrollment Management Website password change';
            
            // Mail body content
            $bodyContent = '<p>Hi '.$fname.', '.$lname.',</p>';
            $bodyContent .= '<p>Your Enrollment Management Website password was changed on 
            <h4>'. $date.'</h4>';
            $mail->Body    = $bodyContent;
    
            
            // Send email 
        if(!$mail->send()) { 
            echo 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo; 
        } else { 
            $_SESSION["success"] = "Password has been changed";
            unset($_SESSION["code"]);
            header('location: ../profile_changepass.php');
            die();
            // echo 'Message has been sent.'; 
      } 


           
        
    }
}
?>