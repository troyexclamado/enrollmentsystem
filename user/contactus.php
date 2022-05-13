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
            }
    }

?>
<!DOCTYPE html>
<head>
    <meta name="viewport" content="with=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css?<?php echo time();?>">
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

                     <?php
                    if(!isset($_SESSION['studentnum']))
                    {
                    ?>
                    <li><a href="login.php">Profile</a></li>
                <?php }
                else {
                    echo '<li><a href="profile.php">Profile</a></li>';                    
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
        <h1>Contact Us</h1>
    </section>

      <!-- Modal -->
    
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                   <p>Student that unable to follow the subject sequence of the subjects outlined in the program.</p>
                   <a href="irregular_enroll.php">Enroll Now</a>
                   </div>
               </div>
          </div>
          <div class="modal-footer">
          
          </div>
        </div>
      </div>
    </div>

    <section class="contact-us">
        <div class="row">
            <div class="contact-col">
                <div>
                    <i class="fa fa-home"></i>
                    <span>
                        <h5>Congressional Rd Ext, Barangay 171</h5>
                        <p>Caloocan City, Metro Manila</p>
                    </span>
                </div>
                <div>
                    <i class="fa fa-phone"></i>
                    <span>
                        <h5>+639 123456789</h5>
                        <p>Open from Monday to Sunday, 8am to 5pm</p>
                    </span>
                </div>
                <div>
                    <i class="fa fa-envelope-o"></i>
                    <span>
                        <h5>ucc-enrollment@ucc.com</h5>
                        <p>Send us email for further query</p>
                    </span>
                </div>
            </div>
            <div class="contact-col">
                <form action="contact-us-send-email.php" method="post">
                    <input type="text" name="name" placeholder="Enter your name" required>
                    <input type="email" name="email" placeholder="Enter email address" required>
                    <input type="text" name="subject" placeholder="Enter your subject" required>
                    <textarea rows="8" name="message" placeholder="Message" required></textarea>
                    <button type="submit" class="enroll-button red-btn">Send Message</button>
                </form>
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
<?php
    unset($_SESSION['enrolled']);
    unset($_SESSION['position']);
?>