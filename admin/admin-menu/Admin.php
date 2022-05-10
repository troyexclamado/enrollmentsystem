<?php
    require('dbconnection.php');
    session_start();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <title>Enrollment System </title>
      <link rel="stylesheet" href="admin.css">
      <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
   </head>
   <body>
      <nav class="sidebar">
         <div class="text">
            <?php
                if($_SESSION['POSITION']== "PROFESSOR"){
                    ?> <p>PROFESSOR</p>
                    <?php
                } else {
                    ?> <p>Admin </p><?php
                }
            ?>
            
         </div>
         <ul>
            <li class="active"><a href="Admin.php">DASHBOARD <img src="dash.png" alt="" style="width: 20px;height:20px;"></i></a></li> 
            <li>
               <a href="#" class="feat-btn">STUDENTS  <img src="stud.png" alt="" style="width: 20px;height:20px;">
               <span class="fas fa-caret-down first"></span>
               </a>
               <ul class="feat-show">
                  <li><a href="Pre-Enrolled.php">PRE ENROLLED <img src="pending.png" alt="" style="width: 20px;height:20px;"></a></li>
                  <li><a href="Enrolled.php">ENROLLED  <img src="enrlld.png" alt="" style="width: 20px;height:20px;"></a></li>
               </ul>
            </li>
            
            <li><a href="Courses.php">COURSES<img src="crse.png" alt="" style="width: 20px;height:20px;"></a></a></li>
            <li><a href="Subjects.php">SUBJECTS <img src="sub.png" alt="" style="width: 20px;height:20px;"></a></li>
            <?php if(!empty($_SESSION['POSITION']) && ($_SESSION['POSITION'] == "PROFESSOR")){ ?> 
            <li><a href="schedule.php">SCHEDULE <img src="schedule.png" alt="" style="width: 20px;height:20px;"></a></li>
            <?php }?>
            <li><a href="activitylog.php">ACTIVITY LOG <img src="actlog.png" alt="" style="width: 20px;height:20px;"></a></li>
            <li><a href="/enrollmentsystem/admin/admin-login/index.html">LOG OUT <img src="actlog.png" alt="" style="width: 20px;height:20px;"></a></li>
         </ul>
      </nav><div class="container">
    
   <div class="content">
        <div class="cards">
            <div class="card">
                <div class="box">
                    <h1></h1>
                    <h3 style="font-size:25px;">Courses</h3>
                    <?php 
                        $countCourses = "SELECT COUNT(DISTINCT courseDescription) AS courses FROM tblcoursedetails";
                        $sqlCountCourses = mysqli_query($conn, $countCourses);
                        if(mysqli_num_rows($sqlCountCourses) > 0){
                            $coursesResult = mysqli_fetch_array($sqlCountCourses);
                    ?>
                    <h3><?php echo $coursesResult['courses']?></h3>
                    <?php 
                        } else {
                            echo '0';
                        }
                    ?>
                </div>
                <div class="icon-case">
                    <img src="course.png" alt=" "  style="width:110px;height:110px;">
                </div>
            </div>

            <div class="card">
                <div class="box">
                    <h1></h1>
                    <h3  style="font-size:25px;">Professors</h3>
                    <?php 
                        $countProfessor = "SELECT COUNT(DISTINCT professorID) AS professor FROM tblprofessors";
                        $sqlCountProfessor = mysqli_query($conn, $countProfessor);
                        if(mysqli_num_rows($sqlCountProfessor) > 0){
                            $professorResult = mysqli_fetch_array($sqlCountProfessor);
                    ?>
                    <h3><?php echo $professorResult['professor']?></h3>
                    <?php 
                        } else {
                            echo '0';
                        }
                    ?>
                </div>
                <div class="icon-case">
                    <img src="student.png" alt="" style="width: 110px;height:110px;">
                </div>
            </div>

            <div class="card">
                <div class="box">
                    <h1></h1>
                    <h3 style="font-size:25px;">Pre-enrolled</h3>
                    <?php 
                        $countPreenrolled = "SELECT COUNT(statusID) AS preenrolled FROM tblstudents WHERE statusID=0";
                        $sqlCountPreenrolled = mysqli_query($conn, $countPreenrolled);
                        if(mysqli_num_rows($sqlCountPreenrolled) > 0){
                            $preenrolledResult = mysqli_fetch_array($sqlCountPreenrolled);
                    ?>
                    <h3><?php echo $preenrolledResult['preenrolled']?></h3>
                    <?php 
                        } else {
                            echo '0';
                        }
                    ?>
                </div>
                <div class="icon-case">
                    <img src="preenrolled.png" alt="" style="width: 100px;height:100px;">
                </div>
            </div>

            <div class="card">
                <div class="box">
                    <h1></h1>
                    <h3 style="font-size:25px;" >Enrolled</h3>
                    <?php 
                        $countEnrolled = "SELECT COUNT(statusID) AS enrolled FROM tblstudents WHERE statusID=1";
                        $sqlCountEnrolled = mysqli_query($conn, $countEnrolled);
                        if(mysqli_num_rows($sqlCountEnrolled) > 0){
                            $enrolledResult = mysqli_fetch_array($sqlCountEnrolled);
                    ?>
                    <h3><?php echo $enrolledResult['enrolled']?></h3>
                    <?php 
                        } else {
                            echo '0';
                        }
                    ?>
                </div>
                <div class="icon-case">
                    <img src="enrolled.png" alt="" style="width: 110px;height:110px;">
                </div>
            </div>

            <div class="card">
                <div class="box">
                    <h1></h1>
                    <h3 style="font-size:25px;" >Subjects</h3>
                    <?php 
                        $countSubjects = "SELECT COUNT(DISTINCT subjectCode) AS subjects FROM tblsubjects";
                        $sqlCountSubjects = mysqli_query($conn, $countSubjects);
                        if(mysqli_num_rows($sqlCountSubjects) > 0){
                            $subjectResult = mysqli_fetch_array($sqlCountSubjects);
                    ?>
                    <h3><?php echo $subjectResult['subjects']?></h3>
                    <?php 
                        } else {
                            echo '0';
                        }
                    ?>
                </div>
                <div class="icon-case">
                    <img src="course.png" alt=" "  style="width:110px;height:110px;">
                </div>
            </div>

            <div class="card">
                <div class="box">
                    <h1></h1>
                    <h3 style="font-size:25px;" >Accounts</h3>
                    <?php 
                        $countAccounts = "SELECT COUNT(accountID) AS accounts FROM tblaccounts";
                        $sqlCountAccounts = mysqli_query($conn, $countAccounts);
                        if(mysqli_num_rows($sqlCountAccounts) > 0){
                            $accountsResult = mysqli_fetch_array($sqlCountAccounts);
                    ?>
                    <h3><?php echo $accountsResult['accounts']?></h3>
                    <?php 
                        } else {
                            echo '0';
                        }
                    ?>
                </div>
                <div class="icon-case">
                    <img src="student.png" alt="" style="width: 110px;height:110px;">
                </div>
            </div>
        </div>


      <script>
         $('.btn').click(function(){
           $(this).toggleClass("click");
           $('.sidebar').toggleClass("show");
         });
           $('.feat-btn').click(function(){
             $('nav ul .feat-show').toggleClass("show");
             $('nav ul .first').toggleClass("rotate");
           });
           $('nav ul li').click(function(){
             $(this).addClass("active").siblings().removeClass("active");
           });
      </script>
   </body>
</html>