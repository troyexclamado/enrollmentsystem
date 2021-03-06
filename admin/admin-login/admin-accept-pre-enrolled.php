<?php
    require('database.php');
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <title>Dashboard</title>
      <link rel="stylesheet" href="dashboard.css">
      <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
   </head>
   <body>
      <div class="btn">
         <span class="fas fa-bars"></span>
      </div>
      <nav class="sidebar">
         <div class="text">
            Administrator
         </div>
         <ul>
            <li><a href="dashboard.html">Dashboard</a></li>
            <li>
               <a href="#" class="feat-btn">Students
               <span class="fas fa-caret-down first"></span>
               </a>
               <ul class="feat-show">
                  <li><a href="preenrolledstudents.php">Pre-enrolled</a></li>
                  <li class="active"><a href="enrolledstudents.php">Enrolled</a></li>
               </ul>
            </li>
            <li><a href="#">Subjects</a></li>
            <li><a href="#">Courses</a></li>
            <li><a href="#">Schedule</a></li>
         </ul>
      </nav>
      <div class="contentarea">
        <div class="preenrolledheading">
            Enrolled Students
        </div>    
       
      </div>
      <script>
          $('nav ul .feat-show').toggleClass("show");
           $('.feat-btn').click(function(){
             $('nav ul .feat-show').toggleClass("show");
             $('nav ul .first').toggleClass("rotate");
           });
           $('.serv-btn').click(function(){
             $('nav ul .serv-show').toggleClass("show1");
             $('nav ul .second').toggleClass("rotate");
           });
           $('nav ul li').click(function(){
             $(this).addClass("active").siblings().removeClass("active");
           });
      </script>
   </body>
</html>