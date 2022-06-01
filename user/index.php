<?php
 require_once "includes/insert_email.php";
    /* CHECK IF ACCOUNTID IS ALREADY ENROLLED*/

    if(isset($_SESSION['studentnum'])){
          $accountID = $_SESSION['studentnum'];
            $sql1 = "SELECT * FROM tblstudents WHERE studentNumber = '$accountID'";
            $res = mysqli_query($conn, $sql1);
            if($row = mysqli_fetch_array($res)){
                $_SESSION['enrolled'] = $row['studentNumber'];
                $_SESSION['position'] = $row['studentType'];
            }
    }

?>
<!DOCTYPE html>

<head>
    <meta name="viewport" content="with=device-width, initial-scale=1.0">
    <title>Enrollment Management Website</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css?<?php echo time();?>">
</head>

<body>
    <section class="header">
        <nav>
            <a href="index.php"><img src="img/logo-orange2.png"></a>
            <div class="nav-links" id="navLinks">
                <i class="fa fa-times" onclick="hideMenu()"></i>
                <ul>
                    <li><a href="index.php">Home</a></li>

                    <!-- Button trigger modal & checking if ID and account ID exist -->
                    <?php
                      if(!isset($_SESSION['studentnum'])){
                      ?>
                    <li><a href="login.php">Enroll</a></li>
                    <?php }  ?>

                    <?php

                    /*CHECK IF POSITION = IRREGULAR*/

                        if(isset($_SESSION['enrolled']) && $_SESSION['position'] == 'IRREGULAR'){
                        ?>
                    <li><a href="irregular_enroll.php#subject-container">Enroll</a></li>
                    <?php }

                    /*CHECK IF POSITION = REGULAR*/

                    else if(isset($_SESSION['enrolled']) && $_SESSION['position'] == 'REGULAR'){
                        echo '<li><a href="enroll.php#subject-container">Enroll</a></li>';
                    }

                    /*CHECK IF STUDENT = IS NOT ENROLLED*/

                    else if(isset($_SESSION['studentnum']) && !isset($_SESSION['enrolled'])) {
                          echo '<li><a href="" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Enroll</a></li>';   
                    }?>
                    <?php
                    if(!isset($_SESSION['studentnum']))
                    {
                    ?>
                    <li><a href="login.php">Profile</a></li>
                    <?php }
                else {
                    echo '<li><a href="profile.php#profiletop">Profile</a></li>';                    
                } ?>
                    <li><a href="contactus.php">Contact</a></li>
                    <?php
                        if(isset($_SESSION['studentnum']) && !empty($_SESSION['studentnum'])){
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
            <h3>Computer Studies Department</h3>
            <p>To maintain and support an adequate system of tertiary education that will help promote the economic
                growth of the country, strengthen the character and well-being of its graduates as productive members of
                the community.</p>

            <?php 

            /*CHECK IF ACCOUNT IS ALREADY ENROLLED*/

            if(!isset($_SESSION['studentnum'])){
            ?>
            <a href="login.php" class="enroll-button">Enroll Now</a>
            <?php } ?>

            <?php
        if(isset($_SESSION['enrolled']) && $_SESSION['position'] == 'REGULAR'){
        ?>

            <a href="enroll.php#subject-container" class="enroll-button">Enroll Now</a>
            <?php }

         elseif(isset($_SESSION['enrolled']) && $_SESSION['position'] == 'IRREGULAR'){
        echo '<a href="irregular_enroll.php#subject-container" class="enroll-button">Enroll Now</a>';
        }

        elseif(isset($_SESSION['studentnum']) && !isset($_SESSION['enrolled'])) {
        echo '<a href="" class="enroll-button" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Enroll Now</a>';
        }?>
        </div>
    </section>

    <?php
        if(isset($_SESSION['email']) ? $_SESSION['email'] == '' && isset($_SESSION['studentnum']) : ""){
    ?>
    <!-- Modal Email -->
    <div class="modal fade" id="exampleModalCenter" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal1-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Enter your Email</h5>
                    </button>
                </div>
                <div class="modal1-body">
                    <form class="input-container" method="POST" action="index.php">
                        <div class="input1">

                            <label for="email">Email</label>
                            <?php 
                             if(isset($_POST['email'])){
                                echo '  <input type="email" name="email" value="'.$email.'" required> ';
                            }
                            else{
                                echo '<input type="email" name="email" placeholder="sample@sample@gmail.com" required> ';
                            }
                            ?>

                        </div>
                        <?php 
                            if(isset($_SESSION["email_exist"])){
                            ?>
                        <span class="email-exist"><?php echo $_SESSION["email_exist"]?></span>
                        <?php } 
                            else{

                            }?>
                        <div class="input2">
                            <label for="confirm-email">Confirm Email</label>
                            <input type="email" id="confirm-email" name="confirm-email" placeholder="Confirm your Email"
                                required>

                        </div>
                        <?php 
                                if(isset($_SESSION['not_match'])){ 
                                ?>
                        <p class="not-match"><?php echo $_SESSION['not_match']; ?></p>
                        <?php }
                                else{
                                
                                } ?>
                </div>
                <div class="modal1-footer">
                    <button type="submit" name="submit" class="btn btn-primary">Confirm</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php }
          else{
            } ?>

    <!-- Modal Enrollment -->

    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="left-content">
                        <div class="left-text">
                            <p>Regular Student</p>
                        </div>
                        <div class="left-image">
                            <img src="img/regg.png">
                        </div>
                        <div class="left">
                            <p>A regular student is a student who is enrolled or accepted for enrollment.</p>
                            <a href="enroll.php">Enroll Now</a>
                        </div>
                    </div>
                    <div class="right-content">
                        <div class="right-text">
                            <p>Irregular Student</p>
                        </div>
                        <div class="right-image">
                            <img src="img/ireg.png">
                        </div>
                        <div class="right">
                            <p>Student that unable to follow the subject sequence of the subjects outlined in the
                                program.</p>
                            <a href="irregular_enroll.php">Enroll Now</a>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>

    <section class="course">
        <h1>Courses offered</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repellat, ratione aliquid. Veniam cum at voluptate
            voluptatum et. Itaque laboriosam pariatur, architecto corrupti voluptas exercitationem libero explicabo
            blanditiis perspiciatis sunt modi.</p>

        <div class="row">
            <div class="course-col">
                <h3>Bachelor of Science in Computer Science</h3>
                <p>The Bachelor of Science in Computer Science combines a core of Computer Science subjects with
                    substantial depth in other required minor subjects. This will ensuresthat students have the required
                    tools to remain updated as technologies and trendschange. The program is design mainly to
                    maintaining the technical knowledge of the students starting from first year up to the last semester
                    of the year of their stay.The curriculum is packed with all the basic and advanced programming
                    skills and necessary supporting computing science fundamentals.</p>
            </div>
            <div class="course-col">
                <h3>Bachelor of Science in Information System</h3>
                <p>This 4-year program is a hybrid course combining the fundamentals of Computing Science with the
                    basics of business courses like management, accounting, finance and other officemanagement
                    essentials. Students are being honed to designing, developing systems and managing information
                    system setups like transaction processing system, automation system,and other enterprise-based
                    systems.</p>
            </div>
            <div class="course-col">
                <h3>Bachelor of Science in Information Technology</h3>
                <p>The Bachelor of Science in Information Technology (BS IT) is a four-year degree program that equips
                    students with the basic ability to conceptualize, design and implement software applications. It
                    prepares students to be IT professionals who are able to perform installation, operation,
                    development, maintenance, and administration of computer applications. The goal of the program is to
                    produce information technologists who can assist individuals and organizations in solving problems
                    using information technology techniques and processes.

                </p>
            </div>
            <div class="course-col">
                <h3>Bachelor of Science in Entertainment and Multimedia Computing</h3>
                <p>The Bachelor of Science in Entertainment and Multimedia Computing (BSEMC) program is the study and
                    use of concepts, principles, and techniques of computing in the design and development of multimedia
                    products and solutions. It includes various applications such as in science, entertainment,
                    education, simulations, games and advertising.</p>
            </div>
        </div>
    </section>
    <section class="enrollnow">
        <h1>Enroll to University of Caloocan City!</h1>
        <?php 

            /*CHECK IF ACCOUNT IS ALREADY ENROLLED*/

             if(!isset($_SESSION['studentnum'])){
                ?>
        <a href="login.php" class="enroll-button">Enroll Now</a>
        <?php } ?>

        <?php
            if(isset($_SESSION['enrolled']) && $_SESSION['position'] == 'REGULAR'){
            ?>

        <a href="enroll.php#subject-container" class="enroll-button">Enroll Now</a>
        <?php }

             elseif(isset($_SESSION['enrolled']) && $_SESSION['position'] == 'IRREGULAR'){
            echo '<a href="irregular_enroll.php#subject-container" class="enroll-button">Enroll Now</a>';
             }

             elseif(isset($_SESSION['studentnum']) && !isset($_SESSION['enrolled'])) {
            echo '<a href="" class="enroll-button" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Enroll Now</a>';
        }?>
    </section>
    <section class="footer">
        <h4>About Us</h4>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.Aliquam explicabo ad possimus eveniet, minus
            nihil!<br>Id, harum odit maiores molestiae esse repudiandae, nesciunt modi obcaecati repellendus aut eveniet
            laboriosam autem!</p>
        <div class="icons">
            <i class="fa fa-facebook"></i>
            <i class="fa fa-twitter"></i>
            <i class="fa fa-globe"></i>
        </div>

    </section>
    <script>
    var navLinks = document.getElementById("navLinks");

    function showMenu() {
        navLinks.style.right = "0";
    }

    function hideMenu() {
        navLinks.style.right = "-200px";
    }
    $('#exampleModalCenter').modal({
        backdrop: 'static',
        keyboard: false
    });
    $('#exampleModalCenter').modal('show');
    </script>
</body>

</html>
<?php
    unset($_SESSION['enrolled']);
    unset($_SESSION['position']);
    unset($_SESSION["email_exist"]);
?>