<?php
    require('database.php');
    session_start();

    if(isset($_POST['submit'])){
        $email = $_POST['email'];
        $password = $_POST['password'];

        $verifyAdmin = "SELECT * FROM tblaccounts WHERE email = '$email' && password = '$password'";
        $sqlVerifyAdmin = mysqli_query($connection, $verifyAdmin);

        $results = mysqli_fetch_array($sqlVerifyAdmin);

        if($results['email'] == $email && $results['password'] == $password){
            $_SESSION['POSITION'] = $results['position'];
            if($results['position'] == "PROFESSOR"){
                $accountID = $results['accountID'];
                $getProfessorID = "SELECT * FROM tblprofessors WHERE accountID = $accountID";
                $sqlGetProfessorID = mysqli_query($connection, $getProfessorID);
                $resultsProfessorID = mysqli_fetch_array($sqlGetProfessorID);
                $_SESSION['PROFESSOR_ID'] = $resultsProfessorID['professorID'];
            }
            echo '<script>alert("Welcome to admin!")</script>';
            echo '<script>window.location.href="/enrollmentsystem/admin/admin-menu/Admin.php"</script>';
        } else {
            echo '<script>alert("Login failed!")</script>';
            echo '<script>window.location.href="/enrollmentsystem/admin/admin-login/index.html"</script>';
        }
    }
?>  