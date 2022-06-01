<?php
 require('including/db.inc.php');
    session_start();
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
    <title>Profile | Enrollment System </title>
    <link rel="icon" type="image/x-icon" href="logo-icon.png">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link rel="stylesheet" href="profile_changepass.css?<?php echo time();?>">
</head>

<body>

    <?php 
 if(isset($_SESSION['sent'])){ ?>
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <p class="popup"></p>
    <div class="success hide">
        <i class="fa fa-check-circle" aria-hidden="true"></i>
        <span class="msg"><?php echo $_SESSION['sent'];?></span>
        <div class="close-btn">
            <i class="fa fa-times" aria-hidden="true"></i>
        </div>
    </div>
    <script>
    $('.popup').show(function() {
        $('.success').addClass("show");
        $('.success').removeClass("hide");
        $('.success').addClass("showAlert");
        setTimeout(function() {
            $('.success').removeClass("show");
            $('.success').addClass("hide");
        }, 5000);
    });
    $('.close-btn').click(function() {
        $('.success').removeClass("show");
        $('.success').addClass("hide");
    });
    </script>
    <?php } ?>

    <?php 
 if(isset($_SESSION['success'])){ ?>
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <p class="popup"></p>
    <div class="success hide">
        <i class="fa fa-check-circle" aria-hidden="true"></i>
        <span class="msg"><?php echo $_SESSION['success'];?></span>
        <div class="close-btn">
            <i class="fa fa-times" aria-hidden="true"></i>
        </div>
    </div>
    <script>
    $('.popup').show(function() {
        $('.success').addClass("show");
        $('.success').removeClass("hide");
        $('.success').addClass("showAlert");
        setTimeout(function() {
            $('.success').removeClass("show");
            $('.success').addClass("hide");
        }, 5000);
    });
    $('.close-btn').click(function() {
        $('.success').removeClass("show");
        $('.success').addClass("hide");
    });
    </script>
    <?php } ?>


    <?php 
      if(isset($_SESSION['greater'])){ ?>
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <p class="popup"></p>
    <div class="failed hide">
        <i class="fa fa-times-circle" aria-hidden="true"></i>
        <span class="msg"><?php echo $_SESSION['greater'];?></span>
        <div id="close-btn">
            <i class="fa fa-times" aria-hidden="true"></i>
        </div>
    </div>
    <script>
    $('.failed').show(function() {
        $('.failed').addClass("show");
        $('.failed').removeClass("hide");
        $('.failed').addClass("showAlert");
        setTimeout(function() {
            $('.failed').removeClass("show");
            $('.failed').addClass("hide");
        }, 5000);
    });
    $('.close-btn').click(function() {
        $('.failed').removeClass("show");
        $('.failed').addClass("hide");
    });
    </script>
    <?php } ?>
    <?php 
      if(isset($_SESSION['not_match'])){ ?>
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <p class="popup"></p>
    <div class="failed hide">
        <i class="fa fa-times-circle" aria-hidden="true"></i>
        <span class="msg"><?php echo $_SESSION['not_match'];?></span>
        <div id="close-btn">
            <i class="fa fa-times" aria-hidden="true"></i>
        </div>
    </div>
    <script>
    $('.failed').show(function() {
        $('.failed').addClass("show");
        $('.failed').removeClass("hide");
        $('.failed').addClass("showAlert");
        setTimeout(function() {
            $('.failed').removeClass("show");
            $('.failed').addClass("hide");
        }, 5000);
    });
    $('.close-btn').click(function() {
        $('.failed').removeClass("show");
        $('.failed').addClass("hide");
    });
    </script>
    <?php } ?>
    <?php 
    if(!isset($_SESSION["code"])){
    ?>
    <!-- Modal start -->
    <div class="modal" id="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Password Reset Code</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Send password verification code to reset your password?</p>
                </div>
                <div class="modal-footer">
                    <form method="POST" action="including/profile_changepass.php">
                        <button type="submit" class="btn btn-primary" name="confirm">Send Verification</button>
                    </form>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal End -->
    <?php } ?>

    <section class="sub-header">
        <nav>
            <a href="index.html"><img src="img/logo-orange2.png"></a>
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

                    elseif(isset($_SESSION['enrolled']) && $_SESSION['position'] == 'REGULAR'){
                        echo '<li><a href="enroll.php#subject-container">Enroll</a></li>';
                    }

                    /*CHECK IF STUDENT = IS NOT ENROLLED*/

                    elseif(isset($_SESSION['studentnum']) && !isset($_SESSION['enrolled'])) {
                          echo '<li><a href="index.php">Enroll</a></li>';   
                    }?>

                    <li><a href="profile.php">Profile</a></li>
                    <li><a href="contactus.php">Contact</a></li>
                    <?php
                        if(isset($_SESSION['studentnum']) && !empty($_SESSION['studentnum'])){
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
    <!-- Modal -->

    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
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

    <div id="changetop" class="profile-container">
        <div class="profile-left">
            <div class="content-left">
                <div class="profile-image">
                    <img src="img/admin.png">
                    <div class="profile-top">
                    <?php 
                        $name = "SELECT * FROM tblstudentaccounts WHERE studentNumber = '$accountID'";
                        $nameres = mysqli_query($conn, $name);
                        while($row = mysqli_fetch_array($nameres)){
                         $fname = $row['firstname'];
                         $lname = $row['lastname'];
                        }
                        ?>
                        <span class="name"><?php echo $fname . ", " . $lname;?></span>
                        <?php 
                            $query = "SELECT statusID FROM tblstudents WHERE studentNumber = '$accountID'";
                            $results = mysqli_query($conn, $query);
                            if(mysqli_num_rows($results) > 0){
                                $row = mysqli_fetch_array($results);
                                $statusID = $row['statusID'];

                                if($statusID == 0){
                                    ?>
                                    <span class="pre">Pending</span>
                                    <?php
                                } else if ($statusID == 1){
                                    ?>
                                    <span class="pre">Enrolled</span>
                                    <?php
                                } else {
                                    ?>
                                    <span class="pre">Rejected</span>
                                    <form method="POST" action="enrollagain.php">
                                        <input type="hidden" name="studentNumber" value="<?php echo $accountID?>">
                                        <input type="submit" name="submit" value="Click to enroll again">    
                                    </form>
                                    <?php
                                    
                                }
                            }
                            else {
                                ?>
                                    <span class="pre">Not yet Enrolled</span>
                                <?php
                            }
                        ?>
                    </div>
                </div>
                <div class="dark"></div>
                <div class="choices">
                    <ul>
                        <span><a href="profile.php#profiletop">My Account</a></span>
                        <li><a href="profile.php#profiletop">Profile</a></li>
                        <li><a href="">Change Password</a></li>
                        <span><a href="">Enrollment</a></span>
                        <li><a href="profile_subject.php">Subjects</a></li>

                    </ul>
                </div>
            </div>
        </div>
        <div class="profile-right">
            <div class="content-right">
                <div class="top">
                    <span class="myprofile">Set Password</span>
                    <span>For your account's security, do not share your password with anyone else</span>
                </div>
                <div class="center">
                    <div class="password-container">
                        <form method="POST" action="including/profile_changepass.php">
                            <label for="name">New Password</label>
                            <input type="password" name="password" required>
                            <label for="name">Confirm Password</label>
                            <input type="password" name="confirm_password" required>
                            <label for="name">Verification Code</label>
                            <input type="text" name="verification" required>
                            <div class="button">
                                <button type="submit" name="submit">Confirm</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>



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
    $('#modal').modal('show');
    </script>
</body>

</html>
<?php
    unset($_SESSION['enrolled']);
    unset($_SESSION['position']);
    unset($_SESSION['sent']);
    unset($_SESSION['greater']);
    unset($_SESSION['not_match']);
    unset($_SESSION['success']);

?>