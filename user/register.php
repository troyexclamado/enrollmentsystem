<?php
    require_once "includes/register.inc.php";
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/register.css?<?php echo time(); ?>">
    <title>Enrollment Management System</title>
</head>
<body>
   
  <div class="container">
    <div class="left">
        <div class ="left-content">
            <div class="logo">
       <a href=""> <img src="img/logo-orange-black.png"></a>
        <h2>Sign Up</h2>
            </div>
        <form method="post" action="register.php">
            <div class="info-container">
            <div class="info">
        <p>First Name</p>
        <?php
        if(isset($_POST['fname'])){
            echo '<input type="text" name="fname"  placeholder="First Name" value="'.$Firstname.'" required>';
        }
        else{
            echo ' <input type="text" name="fname" placeholder="First Name" required> ';
        }
        ?>
                 </div>
            <div class="info1">
         <p>Last Name</p>
         <?php
         if(isset($_POST['lname'])){
            echo '<input type="text" name="lname" placeholder="Last Name" value="'.$Lastname.'" required> ';
         }
            else{ echo '<input type="text" name="lname" placeholder="Last Name" required>'; 
         }
         ?>
            </div>
                </div>
               <div class="info-container">
            <div class="info">
        <p>Middle Name</p>
        <?php
        if(isset($_POST['mname'])){
            echo '<input type="text" name="mname"  placeholder="Middle Name" value="'.$Midname.'" required>';
        }
        else{
            echo ' <input type="text" name="mname" placeholder="Middle Name" required> ';
        }
        ?>
                 </div>
            <div class="info1">
         <p>Position</p>
        <select class="select1" name="position" required>
                    <option  value="" disabled selected>Position</option>
                    <option value="student">Student</option>
                    <option value="professor">Professor</option>     
                    <option value="administrator">Administrator</option>    
                    </select>
            </div>
                </div>   
        <p>Email</p>
        <?php
         if(isset($_POST['email'])){
            echo '<input type="email" name="email" placeholder="you@example.com" value="'.$Email.'" required>';
         }
            else
                { echo '<input type="email" name="email" placeholder="you@example.com" required>  '; 
         }
         ?>
        <?php
        if(isset($_SESSION['email_exist'])){
         ?>

            <div class="error">
                <p><?php echo $_SESSION['email_exist'];?></p>
            </div>
        <?php } 
        else{
        }?>

            <div class="forgot-pass">
                <p>Password</p>
                </div>
        <input type="password" name="pass" placeholder="Enter 6 character or more" required>
        <?php
        if(isset($_SESSION['pass_count'])){
        ?>
            <div class="error">
                <p><?php echo $_SESSION['pass_count'];?></p>
            </div>
        <?php } 
        else{

        }?>
            <p>Password</p>
            <input type="password" name="pass1" placeholder="Repeat your password" required>
            <?php
            if(isset($_SESSION['not_match'])){
            ?>
            <div class="error">
                <p><?php echo $_SESSION['not_match'];?></p>
            </div>
        <?php }
        else{
        } ?>
            <button class="button1" name="submit_info">SIGN UP</button>
        </form>
            <div class="bottom-content">
                <span>Already have an account?</span><a href="login.php">Sign In</a>
            </div>
            </div>
      </div>
      <div class="right">
          <div class="ucc-logo">
          <img src="img/ucc_logo.png">
          </div>
      </div>
    </div>
</body>
</html>
<?php
   unset($_SESSION['not_match']);
   unset($_SESSION['pass_count']);
   unset($_SESSION['email_exist']);
?>