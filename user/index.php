<?php
    session_start();
?>
<!DOCTYPE html>
<head>
    <meta name="viewport" content="with=device-width, initial-scale=1.0">
    <title>Enrollment Management Website</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <section class="header">
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
        <div class="textbox">
            <h1>University of Caloocan City</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quas ut modi, deserunt possimus vero cupiditate saepe? Nisi officiis optio debitis, impedit, beatae dolor ipsam doloribus maxime culpa consectetur, repudiandae magnam!</p>
            <a href="" class="enroll-button">Enroll Now</a>
        </div>
    </section>
    <section class="course">
        <h1>Courses offered</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repellat, ratione aliquid. Veniam cum at voluptate voluptatum et. Itaque laboriosam pariatur, architecto corrupti voluptas exercitationem libero explicabo blanditiis perspiciatis sunt modi.</p>

        <div class="row">
            <div class="course-col">
                <h3>College of Education</h3>
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ratione modi molestiae distinctio aperiam facere, amet cupiditate quo nobis repudiandae incidunt cum! Non deleniti consequuntur, provident ullam dicta quidem nam quo.</p>
            </div>
            <div class="course-col">
                <h3>College of Business Administration</h3>
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ratione modi molestiae distinctio aperiam facere, amet cupiditate quo nobis repudiandae incidunt cum! Non deleniti consequuntur, provident ullam dicta quidem nam quo.</p>
            </div>
            <div class="course-col">
                <h3>College of Liberal Arts and Sciences</h3>
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ratione modi molestiae distinctio aperiam facere, amet cupiditate quo nobis repudiandae incidunt cum! Non deleniti consequuntur, provident ullam dicta quidem nam quo.</p>
            </div>
            <div class="course-col">
                <h3>College of Criminology</h3>
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ratione modi molestiae distinctio aperiam facere, amet cupiditate quo nobis repudiandae incidunt cum! Non deleniti consequuntur, provident ullam dicta quidem nam quo.</p>
            </div>
        </div>
    </section>
    <section class="enrollnow">
        <h1>Enroll to University of Caloocan City!</h1>
        <a href="" class="enroll-button">Enroll Now</a>
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