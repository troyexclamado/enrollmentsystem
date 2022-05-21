<?php 
  require('includes/db.inc.php');
  session_start();
  unset($_SESSION["security_code"]);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/changepass.css?<?php echo time();?>">
    <title>Document</title>
</head>

<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.php"><img class="image" src="img/logo-orange-black.png"></a></li>
                <li><a class="log" href="login.php">Log In</a></li>
            </ul>
        </nav>
    </header>
    <section>
        <div class="content-container">
            <div class="content">
                <h2>Choose a New Password</h2>
                <p>Create a new password that is at least 6 characters long.</p>
                <label for="studentnum">New Password</label>
                <form method="POST" action="includes/newpass.php">
                    <input type="text" name="newpass" placeholder="Enter your student number" required>
                    <?php 
                    if(isset($_SESSION["less"]))
                    {
                    ?>
                    <h3><?php echo $_SESSION["less"];?></h3>
                    <?php } 
                    else{}?>
                    <div class="newpass">
                    <label for="studentnum">Confirm Password</label>
                    <input type="text" name="confirmpass" placeholder="Enter your student number" required>
                    <?php 
                    if(isset($_SESSION["not_match"]))
                    {
                    ?>
                    <h3><?php echo $_SESSION["not_match"];?></h3>
                    <?php } 
                    else{}?>
                    </div>
                    <div class="button-submit">
                        <button type="submit" name="submit">Submit</button>
                </form>
            </div>

        </div>
        </div>

    </section>
    <div class="footer">
        <h4>About Us</h4>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.Aliquam explicabo ad possimus eveniet, minus
            nihil!<br>Id, harum odit maiores molestiae esse repudiandae, nesciunt modi obcaecati repellendus aut eveniet
            laboriosam autem!</p>
        <div class="icons">
            <i class="fa fa-facebook"></i>
            <i class="fa fa-twitter"></i>
            <i class="fa fa-globe"></i>
        </div>
    </div>
</body>

</html>
<?php 
    unset($_SESSION["not_exist"]);
    unset($_SESSION["not_match"]);
    unset($_SESSION["less"]);
?>