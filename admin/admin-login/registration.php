<?php
require('database.php');

if(isset($_POST['submit'])){
    $firstname = strtoupper($_POST['firstname']);
    $middlename = strtoupper($_POST['middlename']);
    $lastname = strtoupper($_POST['lastname']);
    $password1 = $_POST['password1'];
    $password2 = $_POST['password2'];
    $accountType = $_POST['accountType'];
    $email = $_POST['email'];

    if($password1 == $password2){
        $registerAccount = "INSERT INTO tblaccounts(firstname, middlename, lastname, email, password, position) VALUES('$firstname', '$middlename', '$lastname', '$email', '$password1', '$accountType')";
        $sqlRegister = mysqli_query($connection,$registerAccount);
    
        echo '<script>alert("Account Added!")</script>';
        echo '<script>window.location.href="index.html"</script>';
    } else {
        echo '<script>alert("Password are not the same")</script>';
        echo '<script>window.location.href="registration.html"</script>';
    }

    
}
?>