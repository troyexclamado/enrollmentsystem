<?php 
include("db.inc.php");
session_start();

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if(isset($_POST["submit"])){

    $studentnum = $_POST["studentnumber"];

    $sql = "SELECT * FROM tblstudentaccounts WHERE studentNumber = '$studentnum'";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) == 1){
        $row = mysqli_fetch_assoc($result);
        if($row['studentNumber'] == $studentnum){

        $_SESSION["studentnumber"] = $row['studentNumber'];
        $studentnum = $row['studentNumber'];
        $_SESSION["email"] = $row['email'];
        $email = $row['email'];
        $fname = $row['firstname'];
        $lname = $row['lastname'];
        $six_digit_random_number = random_int(100000, 999999);
        $_SESSION["security_code"] = $six_digit_random_number;

        if($email == ''){
            $_SESSION["nothing"] = "Sorry, email does not exist";
            header('location: ../forgotpass.php');
             die();
        }

        $mail = new PHPMailer();

        $mail->isSMTP();
        $mail->SMTPAuth = "true";                        
        $mail->Host = "smtp.gmail.com";      
        $mail->SMTPSecure = "tls";        
        $mail->Port = "587";   
        $mail->Username = "ucc.enrollment.management2022@gmail.com";   // Your Email
        $mail->Password = "sample0001";   // Your password
                      

        // Add a recipient
        $mail->addAddress($email);

        $mail->isHTML(true);

        // Mail subject
        $mail->Subject = "Verify account";

        // Mail body content
        $bodyContent = '<p>Hi '.$fname.', '.$lname.',</p>';
        $bodyContent .= '<p>We received a request to reset your UCC enrollment account password.
        <br>Enter the following password reset code:</p><br><h4>'.$six_digit_random_number.'</h4>';
        $mail->Body    = $bodyContent;

        }
    }
    else{
        $_SESSION["not_exist"] = "Student number does not exist";
        header('location: ../forgotpass.php');
        die();
    }
        // Send email 
    if(!$mail->send()) { 
        echo 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo;
    } else { 
        header('location: ../confirmemail.php');
        // echo 'Message has been sent.'; 
    } 
    $mail->smtpClose();
}
?>