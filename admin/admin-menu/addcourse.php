<?php 
    session_start();
    include('dbconnection.php');
    $datenow = date('Y-m-d');

 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <title>Add Course | Enrollment System </title>
      <link rel="icon" type="image/x-icon" href="logo-icon.png">
      <link rel="stylesheet" href="addsub.css?<?php echo time();?>">
      <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
   </head>
   <body>
      <nav class="sidebar">
      <div class="text">
            <p>
            <?php
                echo $_SESSION['NAME'];
            ?>
            </p>
            <p><?php echo $datenow?></p>
         </div>
         <ul>
         <?php 
                if(!empty($_SESSION['POSITION']) && ($_SESSION['POSITION'] == "PROFESSOR")){

                } else {
            ?>
            <li class="active"><a href="Admin.php"><img src="dash.png" alt="" style="width: 20px;height:20px;">  DASHBOARD </i></a></li> 
            <li>
               <a href="#" class="feat-btn"><img src="stud.png" alt="" style="width: 20px;height:20px;"> STUDENTS  
               <span class="fas fa-caret-down first"></span>
               </a>
               <ul class="feat-show">
                  <li><a href="Pre-Enrolled.php"><img src="pending.png" alt="" style="width: 20px;height:20px;"> PRE ENROLLED </a></li>
                  <li><a href="Enrolled.php"><img src="enrlld.png" alt="" style="width: 20px;height:20px;"> ENROLLED  </a></li>
               </ul>
            </li>
            
            <li><a href="Courses.php"><img src="crse.png" alt="" style="width: 20px;height:20px;"> COURSES</a></a></li>
            <li><a href="Subjects.php"><img src="sub.png" alt="" style="width: 20px;height:20px;"> SUBJECTS </a></li>
            <li><a href="studentaccounts.php"><img src="crse.png" alt="" style="width: 20px;height:20px;"> STUDENT ACCOUNTS</a></a></li>
            <li><a href="professoravailability.php"><img src="crse.png" alt="" style="width: 20px;height:20px;"> AVAILABILITY</a></a></li>
            <li><a href="activitylog.php"><img src="actlog.png" alt="" style="width: 20px;height:20px;"> ACTIVITY LOG </a></li>
            <?php 
                }
            if(!empty($_SESSION['POSITION']) && ($_SESSION['POSITION'] == "PROFESSOR")){ ?> 
            <li><a href="schedule.php"><img src="schedule.png" alt="" style="width: 20px;height:20px;"> SCHEDULE </a></li>
            <?php }?>
            <li><a href="logout.php"><img src="actlog.png" alt="" style="width: 20px;height:20px;"> LOG OUT </a></li>
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