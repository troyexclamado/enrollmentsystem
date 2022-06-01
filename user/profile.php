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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="profile.css?<?php echo time();?>">
</head>

<body>
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
                          echo '<li><a href="" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Enroll</a></li>';   
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

    <div id="profiletop" class="profile-container">
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
                        <span><a href="">My Account</a></span>
                        <li><a href="profile.php">Profile</a></li>
                        <li><a href="profile_changepass.php#changetop">Change Password</a></li>
                        <span><a href="">Enrollment</a></span>
                        <li><a href="profile_subject.php">Subjects</a></li>

                    </ul>
                </div>
            </div>
        </div>
        <div class="profile-right">
            <div class="content-right">
                <div class="top">
                    <span id="prof" class="myprofile">My Profile</span>
                    <span>Manage and protect your account</span>
                </div>
                <div class="information">
                    <form action="">
                        <?php 
                     $sql = "SELECT * FROM tblstudentaccounts WHERE studentNumber = '$accountID'";
                     $result = mysqli_query($conn, $sql);
                     while($row = mysqli_fetch_array($result)){
                         $studentnum = $row['studentNumber'];
                         $fname = $row['firstname'];
                         $lname = $row['lastname'];
                         $email = $row['email'];
                     
                    ?>
                        <p>Name
                        <span><?php echo $fname . ", ". $lname;?></span>
                        </p>
                        <!-- <input disabled="disabled" type="text" value="<?php echo $fname . ", ". $lname;?>"> -->
                        <p>Student Number
                        <span><?php echo $studentnum;?></span>
                        </p>
                        <!-- <input disabled="disabled" type="text" value="<?php echo $studentnum;?>"> -->
                        <p>Email
                        <span><?php echo $email;?></span>
                        </p>
                        <!-- <input disabled="disabled" type="text" value="<?php echo $email;?>"> -->
                        <?php } ?>
                        <?php 
                    $sql1 = "SELECT * FROM tblstudents WHERE studentNumber = '$accountID'";
                    $res = mysqli_query($conn, $sql1);
                    while($row = mysqli_fetch_array($res)){
                       $contact = $row['contactNumber'];
                       $birthday = $row['birthday'];
                    ?>
                        <p>Mobile Number
                        <span><?php echo $contact;?></span>
                        </p>
                        <!-- <input disabled="disabled" type="text" value="<?php echo $contact;?>"> -->
                        <p>Date of Birth
                        <span><?php echo $birthday;?></span>
                        </p>
                        <!-- <input disabled="disabled" type="text" value="<?php echo $birthday;?>"> -->
                        <?php } ?>
                    </form>
                    
                </div>
            
    </div>
                <!-- $sql = "SELECT subjectCode FROM tblenrolledsubjects WHERE studentNumber='$accountID' AND courseID = $courseDetails";
                $res = mysqli_query($conn, $sql); -->

                        
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
    </script>
</body>

</html>
<?php
    unset($_SESSION['enrolled']);
    unset($_SESSION['position']);
?>