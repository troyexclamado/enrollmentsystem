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
        $sqlRegister = mysqli_query($connection, $registerAccount);

        if($accountType == "PROFESSOR"){
            $getAccountID = "SELECT * FROM tblaccounts WHERE firstname= '$firstname' AND middlename = '$middlename' AND email = '$email' AND password = '$password1' AND position = '$accountType'";
            $sqlGetAccountID = mysqli_query($connection, $getAccountID);
            if($sqlGetAccountID){
                $result = mysqli_fetch_array($sqlGetAccountID);
                $accountID = $result['accountID'];
                $addProfessor = "INSERT INTO tblprofessors(accountID) VALUES($accountID)";
                $sqlAddProfessor = mysqli_query($connection, $addProfessor);    
            } 
        }
        echo '<script>alert("Account Added!")</script>';
        echo '<script>window.location.href="index.html"</script>';
    } else {
        echo '<script>alert("Password are not the same")</script>';
        echo '<script>window.location.href="registration.html"</script>';
    }

    
}
?>