<?php
    require('database.php');

    if(isset($_POST['submit'])){
        $email = $_POST['email'];
        $password = $_POST['password'];

        $verifyAdmin = "SELECT * FROM tblaccounts WHERE email = '$email' && password = '$password'";
        $sqlVerifyAdmin = mysqli_query($connection, $verifyAdmin);

        $results = mysqli_fetch_array($sqlVerifyAdmin);

        if($results['email'] == $email && $results['password'] == $password){
            echo '<script>alert("Welcome admin!")</script>';
            echo '<script>window.location.href="/enrollmentsystem/admin/admin-menu/Admin.html"</script>';
        } else {
            echo '<script>alert("Login failed!")</script>';
        }
    }
?>  