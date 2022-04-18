<?php
    require('database.php');

    if(isset($_POST['submit'])){
        $username = $_POST['username'];
        $password = $_POST['password'];

        $verifyAdmin = "SELECT * FROM accounts WHERE email = '$username' && password = '$password'";
        $sqlVerifyAdmin = mysqli_query($connection, $verifyAdmin);

        $results = mysqli_fetch_array($sqlVerifyAdmin);

        if($results['email'] == $username && $results['password'] == $password){
            echo '<script>alert("Welcome admin!")</script>';
            echo '<script>window.location.href="dashboard.html"</script>';
        } else {
            echo '<script>alert("Login failed!")</script>';
        }
    }
?>  