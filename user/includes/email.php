<?php 
include("db.inc.php");
session_start();
       
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

if(isset($_POST["submit"])){

    $email = $_POST["email"];
    $confirmEMail = $_POST["confirm-email"];

    if($email != $confirmEMail){
        $_SESSION['not_match'] = "Email does not match";
        return;
    }
    else{

        $mail = new PHPMailer;

        $mail->isSMTP();                      // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';       // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;               // Enable SMTP authentication
        $mail->Username = 'andreinowellong@gmail.com';   // SMTP username
        $mail->Password = 'andreiong2';   // SMTP password
        $mail->SMTPSecure = 'tls';            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                    // TCP port to connect to
        
        // // Sender info
        // $mail->setFrom('andreinowell@gmail.com', 'andrei');
        // $mail->addReplyTo('andreinowellong@gmail.com', 'andrei');
        
        // Add a recipient
        $mail->addAddress('goodmanwha@gmail.com');
        
        //$mail->addCC('cc@example.com');
        //$mail->addBCC('bcc@example.com');
        
        // Set email format to HTML
        $mail->isHTML(true);
        
        // Mail subject
        $mail->Subject = 'Email from local host to test';
        
        // Mail body content
        $bodyContent = '<h1>Sample Email</h1>';
        $bodyContent .= '<p>This HTML email is sent from the localhost server using PHP by</p>';
        $mail->Body    = $bodyContent;
    }

  // Send email 
if(!$mail->send()) { 
    echo 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo; 
} else { 
    echo 'Message has been sent.'; 
} 
}
?>