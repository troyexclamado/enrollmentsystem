<?php
    session_start();
    
    require('includes/db.inc.php');

    if(isset($_POST['submit'])){
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $middlename = $_POST['middlename'];
        $birthday = $_POST['birthday'];
        $birthplace = $_POST['birthplace'];
        $email = $_POST['email'];
        $contactnumber = $_POST['contactnumber'];
        $address = $_POST['address'];
        $lastschoolattended = $_POST['lastschoolattended'];
        $lastschoolyear = $_POST['lastschoolyear'];
        $lastschooladdress = $_POST['lastschooladdress'];
        $course = $_POST['course'];
        $year = $_POST['year'];
        $semester = $_POST['semester'];
        $accountID = $_SESSION['ID'];

        $preenrollment = "INSERT INTO preenrolledstudents(accountID, firstname, middlename, lastname, birthday, birthplace, emailAddress, contactNumber, address, lastSchoolAttended, lastSchoolYearAttended, lastSchoolAddress, course, year, semester, status) VALUES('$accountID','$firstname','$middlename','$lastname','$birthday','$birthplace','$email','$contactnumber','$address', '$lastschoolattended', '$lastschoolyear', '$lastschooladdress', '$course', '$year', '$semester', 'PRE-ENROLLED')";
        $sqlPreEnroll = mysqli_query($conn, $preenrollment);

        echo '<script>alert("Pre-Enrolled!")</script>';
        echo '<script>window.location.href="index.php"</script>';
    }
?>