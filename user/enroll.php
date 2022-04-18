<?php
    require('includes/db.inc.php');
    session_start();

    if(isset($_SESSION['ID']) && !empty($_SESSION['ID'])){
        $accountID = $_SESSION['ID'];

        #titignan kung yung id ay nakapag pre-enroll na, pag nakapre-enroll na, di na magreredirect sa pre enroll page
        $checkID = "SELECT accountID FROM preenrolledstudents WHERE accountID = '$accountID'";
        $sqlCheckID = mysqli_query($conn, $checkID);

        if (mysqli_fetch_array($sqlCheckID)){
            echo '<script>alert("You already pre-enrolled!")</script>';
            echo '<script>window.location.href="index.php"</script>';
        }
    }
    else {
        echo '<script>alert("Log in first!")</script>';
        echo '<script>window.location.href="index.php"</script>';
    }
?>
<!DOCTYPE html>
<head>
    <meta name="viewport" content="with=device-width, initial-scale=1.0">
    <title>Enroll</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <section class="sub-header">
        <nav>
            <a href="index.html"><img src="img/logo-orange2.png"></a>
            <div class="nav-links" id="navLinks">
                <i class="fa fa-times" onclick="hideMenu()"></i>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="enroll.php">Enroll</a></li>
                    <li><a href="profile.php">Profile</a></li>
                    <li><a href="contactus.php">Contact</a></li>
                    <?php
                        if(isset($_SESSION['ID']) && !empty($_SESSION['ID'])){
                       echo ' <li><a href="logout.php">Logout</a></li>';         
                    ?>
                <?php } 
                else{
                    echo ' <li><a href="login.php">Login</a></li>';
                }?>
                    <!-- <li><a href="">Login</a></li> -->
                </ul>
            </div>
            <i class="fa fa-bars" onclick="showMenu()"></i>
        </nav>
        <h1>Pre-Enrollment</h1>
    </section>
    <section class="enrollment">
        <form method="POST" action="preenrollment.php">
            <div class="container">
                <div class="title">
                    <h2>Personal Information</h1>
                </div>
                <div class="row">
                    <div class="inputbox">
                        <input type="text" id="lastname" name = "lastname" placeholder="Enter your Lastname" required>
                        <label for="name">Lastname</label>
                    </div>
                    <div class="inputbox">
                        <input type="text" id="firstname" name = "firstname" placeholder="Enter your Firstname" required>
                        <label for="name">Firstname</label>
                    </div>
                    <div class="inputbox">
                        <input type="text" id="middlename" name = "middlename" placeholder="Enter your Middlename" required>
                        <label for="name">Middlename</label>
                    </div>
                </div>
                <div class="row">
                    <div class="inputbox">
                        <input type="text" id="birthday" name = "birthday" placeholder="Enter your Birthday" required>
                        <label for="name">Birthday</label>
                    </div>
                    <div class="inputbox">
                        <input type="text" id="birthplace" name = "birthplace" placeholder="Enter your Birthplace" required>
                        <label for="name">Birthplace</label>
                    </div>
                </div>
                <div class="row">
                    <div class="inputbox">
                        <input type="text" id="email" name = "email" placeholder="Enter your Address" required>
                        <label for="name">Email Address</label>
                    </div>
                    <div class="inputbox">
                        <input type="text" id="contactnumber" name = "contactnumber" placeholder="Enter your Contact Number" required>
                        <label for="name">Contact Number</label>
                    </div>
                </div>
                <div class="row">
                    <div class="inputbox">
                        <input type="text" id="address" name="address" placeholder="Enter your Home Address" required>
                        <label for="address"> Home Address </label>
                    </div>
                </div>
                <div class="title">
                    <h2>Educational Background</h1>
                </div>
                <div class="row">
                    <div class="inputbox">
                        <input type="text" id="lastschoolattended" name = "lastschoolattended" placeholder="Enter your Last School Attended" required>
                        <label for="lastschoolattended">Last School Attended</label>
                    </div>
                    <div class="inputbox">
                        <input type="text" id="lastschoolyear" name = "lastschoolyear" placeholder="Enter your Last School Year Attended" required>
                        <label for="lastschoolyear">Last School Year Attended</label>
                    </div>
                </div>
                <div class="row">
                    <div class="inputbox">
                        <input type="text" id="lastschooladdress" name = "lastschooladdress" placeholder="Enter Address of your Last School Attended" required>
                        <label for="lastschooladdress">Last School Attended Address</label>
                    </div>
                </div>
                <div class="title">
                    <h2>Desired Career</h1>
                </div>
                <div class="row">
                    <div class="inputbox">
                        <input type="text" id="course" name = "course" placeholder="Enter your course" required>
                        <label for="course">Course</label>
                    </div>
                </div>
                <div class="row">
                    <div class="inputbox">
                        <input type="text" id="year" name = "year" placeholder="Enter year" required>
                        <label for="year">Year</label>
                    </div>
                    <div class="inputbox">
                        <input type="text" id="semester" name = "semester" placeholder="Enter Semester" required>
                        <label for="semester">Semester</label>
                    </div>
                </div>
                <div class="row">
                    <button type="submit" name="submit">Submit</button>
                </div>
            </div>
        </form>
    </section>

    <section class="footer">
        <h4>About Us</h4>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.Aliquam explicabo ad possimus eveniet, minus nihil!<br>Id, harum odit maiores molestiae esse repudiandae, nesciunt modi obcaecati repellendus aut eveniet laboriosam autem!</p>
        <div class="icons">
            <i class="fa fa-facebook"></i>
            <i class="fa fa-twitter"></i>
            <i class="fa fa-globe"></i>
        </div>
    </section>
    <script>
        var navLinks = document.getElementById("navLinks");
        function showMenu(){
            navLinks.style.right = "0";
        }
        function hideMenu(){
            navLinks.style.right = "-200px";
        }
    </script>
</body>
</html>