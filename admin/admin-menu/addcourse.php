<?php 
    session_start();
    include('dbconnection.php');
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <title>Enrollment System </title>
      <link rel="stylesheet" href="addsub.css">
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
            <li class="active"><a href="Admin.php">DASHBOARD <img src="dash.png" alt="" style="width: 20px;height:20px;"></i></i></a></li> 
            <li>
               <a href="#" class="feat-btn">STUDENTS  <img src="stud.png" alt="" style="width: 20px;height:20px;">
               <span class="fas fa-caret-down first"></span>
               </a>
               <ul class="feat-show">
                  <li><a href="Pre-Enrolled.php">PRE ENROLLED <img src="pending.png" alt="" style="width: 20px;height:20px;"></a></li>
                  <li><a href="Enrolled.php">ENROLLED  <img src="enrlld.png" alt="" style="width: 20px;height:20px;"></a></li>
               </ul>
            </li>
            
            <li><a href="Courses.php">COURSE <img src="crse.png" alt="" style="width: 20px;height:20px;"></a></a></li>
            <li><a href="Subjects.php">SUBJECTS <img src="sub.png" alt="" style="width: 20px;height:20px;"></a></li>
            <?php if(!empty($_SESSION['POSITION']) && ($_SESSION['POSITION'] == "PROFESSOR")){ ?> 
            <li><a href="schedule.php">SCHEDULE <img src="schedule.png" alt="" style="width: 20px;height:20px;"></a></li>
            <?php }?>
            <li><a href="studentaccounts.php">STUDENT ACCOUNTS<img src="crse.png" alt="" style="width: 20px;height:20px;"></a></a></li>
            <li><a href="activitylog.php">ACTIVITY LOG <img src="actlog.png" alt="" style="width: 20px;height:20px;"></a></li>
            <li><a href="logout.php">LOG OUT <img src="actlog.png" alt="" style="width: 20px;height:20px;"></a></li>
         </ul>
</nav>
<br>
<h2>ADD COURSE</h2>
<div class="container">
  <form method = "post" action="addcoursedata.php">
    <div class="row">
      <div class="col-25">
        <label for="fname">Course Abbreviation</label>
      </div>
      <div class="col-75">
        <input type="text" id="subCodes" name="courseAbbr" placeholder="Enter course abbreviation (Ex. BSCS)" oninput="this.value = this.value.toUpperCase()" required>
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="fname">Course Description</label>
      </div>
      <div class="col-75">
        <input type="text" id="subDes" name="courseDescription" placeholder="Enter course description (Ex. BACHELOR OF SCIENCE IN COMPUTER SCIENCE)" oninput="this.value = this.value.toUpperCase()" required>
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="lname">Number of sections</label>
      </div>
      <div class="col-75">
      <select id="subCourse" name="numberofsection" required>
          <option>1</option>
          <option>2</option>
          <option selected>3</option>
          <option>4</option>
          <option>5</option>
        </select>
      </div>
    </div>
   <div class="row">
      <div class="col-25">
        <label for="lname">Number of year levels</label>
      </div>
      <div class="col-75">
        <!-- <input type="text" id="subCourse" name="course" placeholder="Enter course"> -->
        <select id="subCourse" name="yearlevel" required>
          <option>1</option>
          <option>2</option>
          <option>3</option>
          <option selected>4</option>
          <option>5</option>
          <option>6</option>
        </select>
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="country">Number of students per section</label>
      </div>
      <div class="col-75">
        <input type="text" id="subCourse" name="totalstudents" placeholder="Enter number of students per section" onkeypress="return /[0-9]/i.test(event.key)" required>
      </div>
    </div>
      <!-- <div class="row">
      <div class="col-25">
        <label for="country">Semester</label>
      </div>
      <div class="col-75">
        <select id="subSem" name="semester" required>
          <option value="1">1st</option>
          <option value="2">2nd</option>
        </select>
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="country">Section</label required>
      </div>
      <div class="col-75">
        <select id="subSection" name="section">
          <option>ALL SECTIONS</option>
          <option>A</option>
          <option>B</option>
          <option>C</option>
          <option>D</option>
        </select>
      </div>
    </div> -->
      
    <div class="row">
      <input type="submit" value="Add Course">
    </div>
  </form>
</div>

</body>
</html>
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