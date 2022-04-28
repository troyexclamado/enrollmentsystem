<?php
 require('includes/db.inc.php');
    session_start();
    if(isset($_SESSION['ID'])){
          $accountID = $_SESSION['ID'];
            $sql1 = "SELECT * FROM tblstudents WHERE accountID = '$accountID'";
            $res = mysqli_query($conn, $sql1);
            if($row = mysqli_fetch_array($res)){
                $_SESSION['enrolled'] = $row['accountID'];
                $_SESSION['position'] = $row['studentType'];
            }
    }

?>
<!DOCTYPE html>
<head>
    <meta name="viewport" content="with=device-width, initial-scale=1.0">
    <title>Profile</title>
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
                      if(!isset($_SESSION['ID'])){
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

                    elseif(isset($_SESSION['ID']) && !isset($_SESSION['enrolled'])) {
                          echo '<li><a href="" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Enroll</a></li>';   
                    }?>

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

    <section class="profile">
        <div class="row">
            <div class="profile-col">
                <?php

                $ID = $_SESSION['ID'];
                $sql = "SELECT * FROM tblaccounts WHERE accountID = '$ID'";
                $res = mysqli_query($conn, $sql);
                if($row = mysqli_fetch_array($res)){
                    $lastname = $row['lastname'];
                    $firstname = $row['firstname'];
               
                ?>
                <h1><?php echo strtoupper($lastname). " " .strtoupper($firstname);?></h1>
            <?php } ?>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Provident nemo facilis vitae itaque odio suscipit ullam tempore delectus doloribus repellendus odit consequatur nostrum assumenda modi tempora, quasi consequuntur inventore rerum.</p>
                <a href="">See enrollment status</a>
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
<?php
    unset($_SESSION['enrolled']);
    unset($_SESSION['position']);
?>