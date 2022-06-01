<?php 
    session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/confirm.css?<?php echo time();?>">
    <title>Confirm Email | Enrollment System </title>
    <link rel="icon" type="image/x-icon" href="logo-icon.png">
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
                <h2>Enter Security Number</h2>
                <p>Please check your email for a message with your code. Your code is 6 numbers long.</p>
                <form method="POST" action="includes/security_code.php">
                    <div class="form-content">
                        <input type="text" name="sec_code" placeholder="Enter Code" required>
                        <div class="text-content">
                            <h5>We sent your code to:</h5>
                            <span><?php echo $_SESSION["email"];?></span>
                        </div>
                    </div>
                    <?php 
                    if(isset($_SESSION["error"])){
                    ?>
                    <h3><?php echo $_SESSION["error"];?></h3>
                    <?php } 
                    else{
                        
                    }?>
                    <div class="button-submit">
                        <div class="code">
                            <a href="forgotpass.php">Didn't get a code?</a>
                        </div>
                        <div class="button">
                            <a href="">Cancel</a>
                            <button type="submit" name="submit">Submit</button>
                        </div>
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
unset($_SESSION["error"]);
?>