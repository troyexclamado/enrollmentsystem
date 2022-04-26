<?php
    require('includes/db.inc.php');
    session_start();

    if(isset($_SESSION['ID']) && !empty($_SESSION['ID'])){
        $accountID = $_SESSION['ID'];

        #titignan kung yung id ay nakapag pre-enroll na, pag nakapre-enroll na, di na magreredirect sa pre enroll page
        $checkID = "SELECT * FROM tblstudents WHERE accountID = '$accountID'";
        $sqlCheckID = mysqli_query($conn, $checkID);
        if($row = mysqli_fetch_array($sqlCheckID)){
            $_SESSION['exist'] = $row['accountID'];
            $_SESSION['position'] = $row['position'];
        }
        
    }
    else {
        echo "<script>window.open('login.php','self')</script>";
    }
?>
<!DOCTYPE html>
<head>
    <meta name="viewport" content="with=device-width, initial-scale=1.0">
    <title>Enroll</title>
    <link rel="stylesheet" href="irregular_enroll.css?<?php echo time();?>">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
    <link href="https://fonts.googleapis.com/css2?family=Anek+Odia:wght@600&display=swap" rel="stylesheet">
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
                    <!-- <li><a href="">Login</a></li> -->
                </ul>
            </div>
            <i class="fa fa-bars" onclick="showMenu()"></i>
        </nav>
        <h1>Pre-Enrollment</h1>
    </section>

    <?php 
    if(!isset($_SESSION['exist'])){

    ?>
    <section class="enrollment">
        <form method="POST" action="preenrollment.php" name="add_name" id="add_name">
            <div class="container">
                <div class="title">
                    <h2>Personal Information</h2>
                </div>
                <div class="intro">
                <p>Full Name * </p>
                    </div>
                <div class="row">
                    <div class="inputbox">
                         <label for="name">Lastname</label>
                        <input type="text" id="lastname" name="lastname" placeholder="Enter your Lastname" required>
                       
                    </div>
                    <div class="inputbox">
                        <label for="name">Firstname</label>
                        <input type="text" id="firstname" name = "firstname" placeholder="Enter your Firstname" required>
                        
                    </div>
                    <div class="inputbox">
                        <label for="name">Middlename</label>
                        <input type="text" id="middlename" name = "middlename" placeholder="Enter your Middlename" required>
                        
                    </div>
                </div>
                <div class="intro">
                <p>Birthday * </p>
                    </div>
                <div class="row">
                    <div class="inputbox">
                         <label for="name">Birthday</label>
                        <input type="text" id="birthday" name = "birthday" placeholder="Enter your Birthday" required>
                       
                    </div>
                    <div class="inputbox">
                        <label for="name">Birthplace</label>
                        <input type="text" id="birthplace" name = "birthplace" placeholder="Enter your Birthplace" required>
                        
                    </div>
                </div>
                 <div class="intro">
                <p>Contact * </p>
                    </div>
                <div class="row">
                    <div class="inputbox">
                          <label for="name">Email Address</label>
                        <input type="text" id="email" name = "email" placeholder="Enter your Address" required>
                      
                    </div>
                    <div class="inputbox">
                         <label for="name">Contact Number</label>
                        <input type="text" id="contactnumber" name = "contactnumber" placeholder="Enter your Contact Number" required>
                       
                    </div>
                </div>
                 <div class="intro">
                <p>Address * </p>
                    </div>
                <div class="row">
                    <div class="inputbox">
                        <label for="address"> Home Address </label>
                        <input type="text" id="address" name="address" placeholder="Enter your Home Address" required>
                        
                    </div>
                </div>
                <div class="title">
                    <h2>Educational Background</h1>
                </div>
                <div class="intro">
                <p>School Information * </p>
                    </div>
                <div class="row">
                    <div class="inputbox">
                         <label for="lastschoolattended">Last School Attended</label>
                        <input type="text" id="lastschoolattended" name = "lastschoolattended" placeholder="Enter your Last School Attended" required>
                       
                    </div>
                    <div class="inputbox">
                          <label for="lastschoolyear">Last School Year Attended</label>
                        <input type="text" id="lastschoolyear" name = "lastschoolyear" placeholder="Enter your Last School Year Attended" required>
                      
                    </div>
                </div>
                <div class="intro">
                <p></p>
                    </div>
                <div class="row">
                    <div class="inputbox">
                        <label for="lastschooladdress">Last School Attended Address</label>
                        <input type="text" id="lastschooladdress" name = "lastschooladdress" placeholder="Enter Address of your Last School Attended" required>
                        
                    </div>
                </div>
                <div class="title">
                    <h2>Desired Career</h2>
                </div>
                <div class="intro">
                <p>Career * </p>
                    </div>
                <div class="row">
                    <div class="inputbox">
                         <label for="course">Course</label>
                        <input type="text" id="course" name = "course" placeholder="Enter your course" required>
                       
                    </div>
                </div>
                <div class="intro">
                <p></p>
                    </div>
                <div class="row">
                    <div class="inputbox">
                        <label for="year">Year</label>
                        <input type="text" id="year" name = "year" placeholder="Enter year" required>
                        
                    </div>
                    
                    <div class="inputbox">
                         <label for="semester">Semester</label>
                        <input type="text" id="semester" name = "semester" placeholder="Enter Semester" required>
                       
                    </div>
                </div>
                <div class="intro">
                    <div class="intro-title">
                <p>Back Subjects * </p>
                <span>Insert Subject Code (for example "CS 101") </span>
                    </div>
                </div>
            </div>
            
            <!--- SUBJECT --->
            
            <div class="subject-container">
            <table class="table table-bordered" id="dynamic_field">  
                                    <tr>  
                                         <td><input type="text" name="name[]" placeholder="Enter Subject Code" class="form-control name_list" required /></td>  
                                         <td><button type="button" name="add" id="add" class="btn btn-success" >Add More</button></td>  
                                    </tr>  
                               </table> 
            </div>
            
            <div class="button-container">
            <button type="submit" name="submit-irregular">Submit</button>
            </div>
            <?php } ?>

            <?php
            if(isset($_SESSION['exist'])){
            ?>
             <div class="checked">
                <img src="img/complete.png">
                <p>Enrollment Application Submitted</p>
            </div>
            
            <div id="subject-container" class="subject-title">
                    <h2>Subjects</h2>
                </div>
            <div>
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

                $sql2 = "SELECT * FROM preenrolledstudents WHERE accountID = '$accountID'";
                $result = mysqli_query($conn, $sql2);
                while($row = mysqli_fetch_array($result)){
                    $course = $row['course'];
                    $year = $row['year'];
                    $semester = $row['semester'];
                }

                $sql3 = "SELECT * FROM back_subjects WHERE accountNumber = '$accountID' AND status = 'Save' ORDER BY subject_code ASC";
                $res = mysqli_query($conn, $sql3);

                while($row_subjects = mysqli_fetch_array($res)){

                    $subject_id =   $row_subjects['back_subjectID'];
                    $subject_code = $row_subjects['subject_code'];
                    $status = $row_subjects['status'];

                $sql = "SELECT * FROM subjects WHERE subjectCode = '$subject_code'";
                $success = mysqli_query($conn, $sql);

                while($row = mysqli_fetch_array($success)){
                    $subject_name = $row['subjectName'];

                ?>
                <tbody>
                <tr>
                    <td><?php echo $subject_code;?></td>
                    <td><?php echo $subject_name;?></td>
                    <td><a class="untake" href="preenrollment.php?action=<?php echo $subject_code;?>" >Take</a></td>
                    </tr>
                    <?php } ?>
                <?php } ?>
                    <?php
                 $sql = "SELECT subject_code FROM back_subjects WHERE accountNumber = '$accountID' AND status = 'Required'";
                $result = mysqli_query($conn, $sql);
                while($row = mysqli_fetch_array($result)){
                    $subjectCode = $row['subject_code'];
                

                $getsubject = "SELECT * FROM subjects WHERE subjectCode = '$subjectCode'";
                $res = mysqli_query($conn, $getsubject);
                while($subjectrow = mysqli_fetch_array($res)){
                    $subjectName = $subjectrow['subjectName'];
            
                    ?>
                    <tr>
                    <td><?php echo $subjectCode;?></td>
                    <td><?php echo $subjectName;?></td>
                    <td><p class="required">Required</p></td>
                    </tr>
                  <?php } ?>
                   <?php } ?>

                   <?php
                   $sql5 = "SELECT * FROM back_subjects WHERE accountNumber = '$accountID' AND status = 'Taken' ORDER BY subject_code ASC";
                   $res = mysqli_query($conn, $sql5);

                    while($row_subj = mysqli_fetch_array($res)){

                    $subj_id =   $row_subj['back_subjectID'];
                    $subj_code = $row_subj['subject_code'];
                    $status = $row_subj['status'];

                    $sql = "SELECT * FROM subjects WHERE subjectCode = '$subj_code'";
                    $success = mysqli_query($conn, $sql);

                    while($row = mysqli_fetch_array($success)){
                    $subject_name = $row['subjectName'];

                   ?>
                    <tr>
                    <td><?php echo $subj_code;?></td>
                    <td><?php echo $subject_name;?></td>
                    <td><p class="required">Taken</p></td>
                <?php } ?>
            <?php } ?>
                    </tr>
                </tbody>
                </table>
            </div>
                </div>
            <?php } ?>
        </form>
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
        
        $(document).ready(function(){  
      var i=1;  
      $('#add').click(function(){  
           i++;  
           $('#dynamic_field').append('<tr id="row'+i+'"><td><input type="text" name="name[]" placeholder="Enter Subject Code" class="form-control name_list" required/></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');  
      });  
      $(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();  
      });  
      $('#submit').click(function(){            
           $.ajax({  
                url:"preenrollment.php",  
                method:"POST",  
                data:$('#add_name').serialize(),  
                success:function(data)  
                {  
                     alert(data);  
                     $('#add_name')[0].reset();  
                }  
           });  
      });  
 });  
        
    </script>
</body>
</html>
<?php
    unset($_SESSION['exist']);
    unset($_SESSION['position']);
?>