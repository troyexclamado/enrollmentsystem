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
            <p>Admin</p>
            
           </div>
         <ul>
            <li class="active"><a href="Admin.html">DASHBOARD <img src="dash.png" alt="" style="width: 20px;height:20px;"></i></i></a></li> 
            <li>
               <a href="#" class="feat-btn">STUDENTS  <img src="stud.png" alt="" style="width: 20px;height:20px;">
               <span class="fas fa-caret-down first"></span>
               </a>
               <ul class="feat-show">
                  <li><a href="Pre-Enrolled.php">PRE ENROLLED <img src="pending.png" alt="" style="width: 20px;height:20px;"></a></li>
                  <li><a href="Enrolled.php">ENROLLED  <img src="enrlld.png" alt="" style="width: 20px;height:20px;"></a></li>
               </ul>
            </li>
            
            <li><a href="Courses.html">COURSE <img src="crse.png" alt="" style="width: 20px;height:20px;"></a></a></li>
            <li><a href="Subjects.php">SUBJECTS <img src="sub.png" alt="" style="width: 20px;height:20px;"></a></li>
            <li><a href="#">SCHEDULE <img src="schedule.png" alt="" style="width: 20px;height:20px;"></a></li>
            <li><a href="Activity Log.html">ACTIVITY LOG <img src="actlog.png" alt="" style="width: 20px;height:20px;"></a></li>
         </ul>
</nav>
<h2>Subject here</h2>
<div class="container">
  <form method = "post" action="addsubject.php">
    <div class="row">
      <div class="col-25">
        <label for="fname">Subject Code</label>
      </div>
      <div class="col-75">
        <input type="text" id="subCodes" name="subjectCode" placeholder="Enter subject code" required>
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="fname">Subject Description</label>
      </div>
      <div class="col-75">
        <input type="text" id="subDes" name="subjectDescription" placeholder="Enter subject description" required>
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="lname">Subject Units</label>
      </div>
      <div class="col-75">
        <input type="text" id="subUnit" name="subjectUnits" placeholder="Enter subject units" required>
      </div>
    </div>
   <div class="row">
      <div class="col-25">
        <label for="lname">Course</label>
      </div>
      <div class="col-75">
        <!-- <input type="text" id="subCourse" name="course" placeholder="Enter course"> -->
        <select id="subCourse" name="course" required>
          <option>BACHELOR OF SCIENCE IN COMPUTER SCIENCE</option>
          <option>BACHELOR OF SCIENCE IN ENTERTAINMENT AND MULTIMEDIA COMPUTING</option>
          <option>BACHELOR OF SCIENCE IN INFORMATION SYSTEM</option>
          <option>BACHELOR OF SCIENCE IN INFORMATION TECHNOLOGY</option>
        </select>
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="country">Year</label>
      </div>
      <div class="col-75">
        <select id="subYear" name="year" required>
          <option value="1">1st</option>
          <option value="2">2nd</option>
          <option value="3">3rd</option>
          <option value="4">4th</option>
        </select>
      </div>
    </div>
      <div class="row">
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
    </div>
      
    <div class="row">
      <input type="submit" value="Add Subject">
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