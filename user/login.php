<?php
require_once"includes/login_inc.php";
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/login.css?<?php echo time();?>">
     <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Enrollment Management System</title>
</head>
<body>

 <!-- Confirmation Message -->
  <div class="container">
    <div class="left">
        <div class ="left-content">
            <div class="logo">
       <a href="index.php"> <img src="img/logo-orange-black.png"></a>
        <h2>Log In</h2>
            </div>
        <form method="post" action="login.php">
        <p>Email</p>
        <?php
        if(isset($_POST['email'])){
            echo '  <input type="email" name="email" placeholder="you@example.com" value="'.$Email.'" required> ';
        }
        else{
            echo '<input type="email" name="email" placeholder="you@example.com" required> ';
        }
        ?>
    
        <?php
        if(isset($_SESSION['email_notexist'])){
        ?>
        <div class="error">
            <p><?php echo $_SESSION['email_notexist'];?></p>
        </div>
    <?php }
    else{

    }?>
            <div class="forgot-pass">
                <p>Password</p>
                <a href="">Forgot password?</a>
                </div>
        <input type="password" name="pass" placeholder="Enter 6 character or more" required>
            <button class="button1" name="submit">LOG IN</button>
        </form>
            <div class="bottom-content">
                <span>Not a member yet?</span><a href="register.php">Sign Up</a>
            </div>
            </div>
      </div>
      <div class="right">
        <?php 
      if(isset($_SESSION['failed'])){ ?>

       <p class="failed"></p>
       <div class="failed hide">
          <i class="fa fa-times-circle" aria-hidden="true"></i>
         <span class="msg"><?php echo $_SESSION['failed'];?></span>
         <div id="close-btn">
            <i class="fa fa-times" aria-hidden="true"></i>
         </div>
         </div>
         <script>
             $('.failed').show(function(){
           $('.failed').addClass("show");
           $('.failed').removeClass("hide");
           $('.failed').addClass("showAlert");
           setTimeout(function(){
             $('.failed').removeClass("show");
             $('.failed').addClass("hide");
           },5000);
         });
         $('.close-btn').click(function(){
           $('.failed').removeClass("show");
           $('.failed').addClass("hide");
         });
         </script>
                <?php } ?>
                  <?php 
      if(isset($_SESSION['email_notexist'])){ ?>

       <p class="failed"></p>
       <div class="failed hide">
          <i class="fa fa-times-circle" aria-hidden="true"></i>
         <span class="msg"><?php echo $_SESSION['email_notexist'];?></span>
         <div id="close-btn">
            <i class="fa fa-times" aria-hidden="true"></i>
         </div>
         </div>
         <script>
             $('.failed').show(function(){
           $('.failed').addClass("show");
           $('.failed').removeClass("hide");
           $('.failed').addClass("showAlert");
           setTimeout(function(){
             $('.failed').removeClass("show");
             $('.failed').addClass("hide");
           },5000);
         });
         $('.close-btn').click(function(){
           $('.failed').removeClass("show");
           $('.failed').addClass("hide");
         });
         </script>
                <?php } ?>

                  <?php
    if(isset($_SESSION['register'])){ ?>
        <p class="popup"></p>
       <div class="success hide">
         <i class="fa fa-check-circle" aria-hidden="true"></i>
         <span class="msg"><?php echo $_SESSION['register'];?></span>
         <div class="close-btn">
             <i class="fa fa-times" aria-hidden="true"></i>
         </div>
         </div>
         <script>
             $('.popup').show(function(){
           $('.success').addClass("show");
           $('.success').removeClass("hide");
           $('.success').addClass("showAlert");
           setTimeout(function(){
             $('.success').removeClass("show");
             $('.success').addClass("hide");
           },5000);
         });
         $('.close-btn').click(function(){
           $('.success').removeClass("show");
           $('.success').addClass("hide");
         });
         </script>
    <?php } ?>
                <?php
                unset($_SESSION['failed']);
                unset($_SESSION['email_notexist']);
                 unset($_SESSION['register']);
                ?>
          <div class="ucc-logo">
          <img src="img/ucc_logo.png">
          </div>
      </div>
    </div>
</body>
</html>

