<?php
 require('includes/db.inc.php');
    session_start();
    if(isset($_SESSION['studentnum'])){
          $accountID = $_SESSION['studentnum'];
            $sql1 = "SELECT * FROM tblstudents WHERE studentNumber = '$accountID'";
            $res = mysqli_query($conn, $sql1);
            if($row = mysqli_fetch_array($res)){
                $_SESSION['enrolled'] = $row['studentNumber'];
                 $_SESSION['position'] = $row['studentType'];
                 $position = $row['studentType'];
            }
    }
    

?>
<!DOCTYPE html>

<head>
    <meta name="viewport" content="with=device-width, initial-scale=1.0">
    <title>Profile</title>
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

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="profile_subject.css?<?php echo time();?>">
</head>

<body>
    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
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
    <!-- End Modal -->


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

    <div id="profiletop" class="profile-container">
        <div class="profile-left">
            <div class="content-left">
                <div class="profile-image">
                    <img src="img/admin.png">
                    <div class="profile-top">
                        <span class="name">Andrei Nowell G. Ong</span>
                        <span class="pre">Pre-Enrolled</span>
                    </div>
                </div>
                <div class="dark"></div>
                <div class="choices">
                    <ul>
                        <span><a href="">My Account</a></span>
                        <li><a href="">Profile</a></li>
                        <li><a href="profile_changepass.php#changetop">Change Password</a></li>
                        <span><a href="">Enrollment</a></span>
                        <li><a href="">Subject</a></li>

                    </ul>
                </div>
            </div>
        </div>
        <div class="profile-right">
            <div class="content-right">
                <div class="top">
                    <span id="prof" class="myprofile">Subjects</span>
                    <span></span>
                </div>

                <?php
            if(isset($_SESSION["enrolled"]) && $_SESSION['position'] == 'REGULAR')
            {
            ?>
                <div class="subject-container">
                    <div class="subject">
                        <table>
                            <thead>
                                <tr>
                                    <th>Subject Code</th>
                                    <th>Subject Name</th>
                                    <th>Subject Units</th>
                                </tr>
                            </thead>

                            <?php

                $sql1 = "SELECT * FROM tblstudents WHERE studentNumber = '$accountID'";
                $result = mysqli_query($conn, $sql1);
                while($row = mysqli_fetch_array($result)){
                    // $course = $row['course'];
                    // $year = $row['year'];
                    // $semester = $row['semester'];
                    $courseDetails = $row['courseID'];
                }

                $sql = "SELECT * FROM tblsubjects WHERE courseID = $courseDetails";
                $res = mysqli_query($conn, $sql);

                while($row_course = mysqli_fetch_array($res)){
                    // $subject_id = $row_course['subj_id'];
                    $subject_code = $row_course['subjectCode'];
                    $subject_name = $row_course['subjectDescription'];
                    $subject_units = $row_course['subjectUnits'];
            ?>

                            <tbody>
                                <tr>
                                    <td><?php echo $subject_code;?></td>
                                    <td><?php echo $subject_name;?></td>
                                    <td><?php echo $subject_units;?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                </form>
                <?php } ?>

                <!-- IF NOT SET -->
                <?php 
            if(!isset($_SESSION["position"])){
     
            ?>
                <div class="center">
                <p>You are not yet enrolled<p>
                </div>
                <?php } ?>

                <!-- IRREGULAR TABLE -->
                <?php
            if(isset($_SESSION["enrolled"]) && $_SESSION['position'] == 'IRREGULAR'){
            ?>
                <div class="subject-container" id="subject-container">
                    <div class="subject">
                        <table>
                            <thead>
                                <tr>
                                    <th>Subject Code</th>
                                    <th>Subject Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <?php

                $sql2 = "SELECT * FROM tblstudents WHERE studentNumber = '$accountID'";
                $result = mysqli_query($conn, $sql2);
                while($row = mysqli_fetch_array($result)){
                    // $course = $row['course'];
                    // $year = $row['year'];
                    // $semester = $row['semester'];
                    $courseDetails = $row['courseID'];
                }

                $sql3 = "SELECT * FROM tblbacksubjects WHERE studentNumber = $accountID AND status = 'Save'";
                $res = mysqli_query($conn, $sql3);
                while($row_subjects = mysqli_fetch_array($res)){
                    $subject_id =   $row_subjects['backsubjectID'];
                    $subject_code = $row_subjects['subjectCode'];
                    $status = $row_subjects['status'];

                    $sql = "SELECT * FROM tblsubjects WHERE subjectCode = '$subject_code' AND courseID = $courseDetails";
                    $success = mysqli_query($conn, $sql);

                    while($row = mysqli_fetch_array($success)){
                    $subject_name = $row['subjectDescription'];

                ?>
                            <tbody>
                                <tr>
                                    <td><?php echo $subject_code;?></td>
                                    <td><?php echo $subject_name;?></td>
                                    <td><a class="untake"
                                            href="preenrollment.php?act=<?php echo $subject_code;?>">Take</a></td>
                                </tr>
                                <?php } ?>
                                <?php } ?>
                                <?php
                 $sql = "SELECT subjectCode FROM tblbacksubjects WHERE studentNumber = '$accountID' AND status = 'Required'";
                $result = mysqli_query($conn, $sql);
                while($row = mysqli_fetch_array($result)){
                    $subjectCode = $row['subjectCode'];
                

                $getsubject = "SELECT * FROM tblsubjects WHERE subjectCode = '$subjectCode' limit 1";
                $res = mysqli_query($conn, $getsubject);
                while($subjectrow = mysqli_fetch_array($res)){
                    $subjectName = $subjectrow['subjectDescription'];
            
                    ?>
                                <tr>
                                    <td><?php echo $subjectCode;?></td>
                                    <td><?php echo $subjectName;?></td>
                                    <td>
                                        <p class="required">Required</p>
                                    </td>
                                </tr>
                                <?php } ?>
                                <?php } ?>
                                <?php
                   $sql5 = "SELECT * FROM tblbacksubjects WHERE studentNumber = '$accountID' AND status = 'Taken'";
                   $res = mysqli_query($conn, $sql5);
                
                   if($res == true){
                    while($row_subj = mysqli_fetch_array($res)){

                    $subj_id =   $row_subj['backsubjectID'];
                    $subj_code = $row_subj['subjectCode'];
                    $status = $row_subj['status'];
                    
                    $courseDetails = "";
                    $sql2 = "SELECT * FROM tblstudents WHERE studentNumber = '$accountID'";
                        $result = mysqli_query($conn, $sql2);
                        while($row = mysqli_fetch_array($result)){
                            // $course = $row['course'];
                            // $year = $row['year'];
                            // $semester = $row['semester'];
                            $courseDetails = $row['courseID'];
                        }
                    $sql = "SELECT * FROM tblsubjects WHERE subjectCode = '$subj_code' AND courseID = '$courseDetails'";
                    $success = mysqli_query($conn, $sql);

                    while($row = mysqli_fetch_array($success)){
                    $subject_name = $row['subjectDescription'];

                   ?>
                                <tr>
                                    <td><?php echo $subj_code;?></td>
                                    <td><?php echo $subject_name;?></td>
                                    <td>
                                        <p class="required">Taken</p>
                                    </td>
                                    <?php } ?>
                                    <?php }
                } ?>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            </form>
            <?php } ?>


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
    </script>
</body>

</html>
<?php
    unset($_SESSION['enrolled']);
    unset($_SESSION['position']);
?>