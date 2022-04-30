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
                    <h3>123</h3>
                </div>
                <div class="icon-case">
                    <img src="course.png" alt=" "  style="width:110px;height:110px;">
                </div>
            </div>

            <div class="card">
                <div class="box">
                    <h1></h1>
                    <h3  style="font-size:25px;">Professors</h3>
                    <h3>123</h3>
                </div>
                <div class="icon-case">
                    <img src="student.png" alt="" style="width: 110px;height:110px;">
                </div>
            </div>

            <div class="card">
                <div class="box">
                    <h1></h1>
                    <h3 style="font-size:25px;">Pre-enrolled</h3>
                    <h3>123</h3>
                </div>
                <div class="icon-case">
                    <img src="preenrolled.png" alt="" style="width: 100px;height:100px;">
                </div>
            </div>

            <div class="card">
                <div class="box">
                    <h1></h1>
                    <h3 style="font-size:25px;" >Enrolled</h3>
                    <h3>123</h3>
                </div>
                <div class="icon-case">
                    <img src="enrolled.png" alt="" style="width: 110px;height:110px;">
                </div>
            </div>

            <div class="card">
                <div class="box">
                    <h1></h1>
                    <h3 style="font-size:25px;" >Subjects</h3>
                    <h3>123</h3>
                </div>
                <div class="icon-case">
                    <img src="course.png" alt=" "  style="width:110px;height:110px;">
                </div>
            </div>

            <div class="card">
                <div class="box">
                    <h1></h1>
                    <h3 style="font-size:25px;" >Accounts</h3>
                    <h3>123</h3>
                </div>
                <div class="icon-case">
                    <img src="student.png" alt="" style="width: 110px;height:110px;">
                </div>
            </div>
        </div>

          
          
        <div class="content-2">
            <div class="recent-payments">
                <div class="title">
                    <h2>Currently Enrolled</h2>
                  
                </div>
                <table>
                    <tr>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Course</th>
                        <th>Schedule</th>
                    </tr>
                    <tr>
                        <td>John Doe</td>
                        <td>Caloocan</td>
                        <td>BSCS</td>
                        <td>9:00pm-10:00pm</td>
                    </tr>
                </table>
            </div>
            <div class="new-students">
                <div class="title">
                    <h2>Pre-enrolled</h2>
                   
                </div>
                <table>
                    <tr>
                    <th>Name</th>
                    <th>Message</th>
                    </tr>
                    <tr>
                        
                        <td>John Steve Doe</td>
                        <td><img src="" alt=""></td>
                    </tr> 
                </table>
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