<?php
    $name = $_POST['name'];
    $visitor_email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    $email_from = 'ucc-enrollment-management-website@gmail.com';
    $email_to = 'exclamado.troy.bscs2019@gmail.com';
    $email_subject = 'User query from enrollment management website';
    $email_body = "User Name: $name.\n"."User Email: $visitor_email.\n"."Subject: $subject.\n"."Message: $message.\n";

    $headers = "From: $email_from \r\n";
    $headers .= "Reply-To: $visitor_email \r\n";
    mail($email_to, $email_subject, $email_body, $headers);

    header("Location: contactus.html");
?>