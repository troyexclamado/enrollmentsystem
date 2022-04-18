<?php
    session_start();
    include("includes/db.inc.php");
?>
<!DOCTYPE html>
<head>
    <meta name="viewport" content="with=device-width, initial-scale=1.0">
    <title>Profile</title>
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
                    <!-- <li><a href="">Logout</a></li> -->
                </ul>
            </div>
            <i class="fa fa-bars" onclick="showMenu()"></i>
        </nav>
        <h1>Profile</h1>
    </section>
    <section class="profile">
        <div class="row">
            <div class="profile-col">
                <?php 
                    
                    $sessionID = $_SESSION['ID'];
                    $studentProfile = mysqli_query($conn,"SELECT * FROM preenrolledstudents AS tbl1 LEFT JOIN student_status AS tbl2 ON tbl1.status = tbl2.Code where accountID = $sessionID");
                    if(mysqli_num_rows($studentProfile) > 0){
                        $fetchdata = mysqli_fetch_assoc($studentProfile);
                        $givenname = $fetchdata['firstname'];
                        $middlename = $fetchdata['middlename'];
                        $lastname = $fetchdata['lastname'];
                        $fullname = $lastname .' '. $givenname . ' ' . $middlename;
                        $birthday = $fetchdata['birthday'];
                        $address = $fetchdata['birthplace'];
                        $contactnumber = $fetchdata['contactNumber'];
                        $lastschoolattended = $fetchdata['lastSchoolAttended'];
                        $lastschoolyear = $fetchdata['lastSchoolYearAttended'];
                        $lastschooladdress = $fetchdata['lastSchoolAddress'];
                        $course = $fetchdata['course'];
                        $year = $fetchdata['year'];
                        $sem = $fetchdata['semester'];
                        $status = $fetchdata['codeDescription'];

                         echo "<h2> Enrollment Status: $status</h2><br>";
                        echo "<h1> $fullname </h1>";
                        echo "<p>
                                Birthday : $birthday
                                <br>Address : $address
                                <br>Contact Number : $contactnumber
                                <br><br>LAST SCHOOL ATTENDED
                                <br>School : $lastschoolattended 
                                <br>Address : $lastschooladdress
                                <br>Year Graduated : $lastschoolyear
                                <br><br>Course : $course
                                <br>Year : $year
                                <br>Semester : $sem
                        </p>";



                    }else{
                        echo "Dont have Data!";
                    }
                    $conn->close();
                ?>


                <!-- <h1>DELA CRUZ JUAN</h1>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Provident nemo facilis vitae itaque odio suscipit ullam tempore delectus doloribus repellendus odit consequatur nostrum assumenda modi tempora, quasi consequuntur inventore rerum.</p>
                <a href="">See enrollment status</a> -->
            </div>
            <div class="profile-col-image">
                <img src="./img/person1.jpg">
            </div>
        </div>
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