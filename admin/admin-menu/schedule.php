<?php
    require('dbconnection.php');
    session_start();


?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <title>Enrollment System </title>
      <link rel="stylesheet" href="schedule.css?<?php echo time();?>">
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
            <li><a href="activitylog.php">ACTIVITY LOG <img src="actlog.png" alt="" style="width: 20px;height:20px;"></a></li>
            <li><a href="/enrollmentsystem/admin/admin-login/index.html">LOG OUT <img src="actlog.png" alt="" style="width: 20px;height:20px;"></a></li>
         </ul>
      </nav>
<div class="container">
<div class="search">
    <div class="search-box">
      <input type="text" placeholder="Type here...">
      <button for="check" class="icon">
        <i class="fas fa-search"></i>
      </button>
    </div>
  </div>
<div class="col-2">
<h4> YOUR SUBJECTS </h4>
<select>
    <?php
        $professorID = $_SESSION['PROFESSOR_ID'];
        $getSubjects = "SELECT * FROM tblprofessorsubjects WHERE professorID = $professorID";
        $sqlGetSubject = mysqli_query($conn, $getSubjects);
        if(mysqli_num_rows($sqlGetSubject) > 0){
          while($subjects = mysqli_fetch_array($sqlGetSubject)){
            ?> <option><?php echo $subjects['subjectCode']?></option><?php
          }
        } else {
          ?> <option value="">NO SUBJECTS YET</option><?php
        }
    ?> 
</select>	
</div>
<div class="col-3">
<button class="col-4" id="myBtn">Add Subject</button>
</div>
<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close">&times;</span>
      <h2>Add subject</h2>
  </div>
  <form method="POST" action="addsubjectprofessor.php">
  <div class="modal-body">
    <p>Add subject</p>
    <select class="subject" name="subject" required>
      <option selected disabled hidden>Select a subject</option>
      <?php 
        $getSubjects = "SELECT DISTINCT subjectCode, subjectDescription FROM tblsubjects";
        $sqlGetSubjects = mysqli_query($conn, $getSubjects);
        if(mysqli_num_rows($sqlGetSubjects) > 0){
          while($subjectsResult = mysqli_fetch_array($sqlGetSubjects)){
      ?>
      <option value="<?php echo $subjectsResult['subjectCode']?>"><?php echo $subjectsResult['subjectCode']." - ".$subjectsResult['subjectDescription']?></option>
      <?php 
          }
        } else {
          ?> <option>NO SUBJECTS AVAILABLE</option> <?php
        }
    ?>
    </select>
  </div>
  <div class="modal-footer">
  <button type="submit" name="submit">Add Subject</button>
  </div>
  </form>
</div>

</div>

<div class="col-1">
<p style="float: left;"> VIEW SCHEDULE </p>
<select style="float: right; width: 150px">
    <option selected disabled hidden>SELECT SECTION</option>
    <?php
    $getCourses = "SELECT * FROM tblcoursedetails WHERE semester = $SEMESTER";
    $sqlGetCourses = mysqli_query($conn, $getCourses);
    while($results = mysqli_fetch_array($sqlGetCourses)){
    ?>
      <option><?php 
        echo $results['courseAbbr']." ".$results['year'].$results['section']?></option>
    <?php } ?>
  </select>	
</div>
<h4 id="filter"> ADD SCHEDULE: </h4>
<div class="custom-select" style="width:200px;">
  <select name="course">
    <option selected disabled hidden>SELECT COURSE</option>
  <?php
    $getCourses = "SELECT DISTINCT courseAbbr FROM tblcoursedetails";
    $sqlGetCourses = mysqli_query($conn, $getCourses);
    while($results = mysqli_fetch_array($sqlGetCourses)){
    ?>
      <option><?php echo $results['courseAbbr']?></option>
    <?php } ?>
  </select>
 <div class="space">
  </div>
    <select name="year">
    <option selected disabled hidden>SELECT YEAR</option>
    <option value="1">1st</option>
    <option value="2">2nd</option>
    <option value="3">3rd</option>
    <option value="4">4th</option>
  </select>
 <div class="space">
  </div>
    <select name="section">
    <option selected disabled hidden>SELECT SECTION</option>
    <option value="A">A</option>
    <option value="B">B</option>
    <option value="C">C</option>
    <option value="D">D</option>
    <option value="E">E</option>
  </select>
 <div class="space">
  </div>
    <select name ="semester">
    <option selected disabled hidden>SELECT SEMESTER</option>
    <option value=<?php echo $SEMESTER?>>2ND</option>
  </select>
<div class="space">
  </div>
<select name="day">
    <option selected disabled hidden>SELECT DAY</option>
    <option value="MON">MONDAY</option>
    <option value="TUE">TUESDAY</option>
    <option value="WED">WEDNESDAY</option>
    <option value="THU">THURSDAY</option>
    <option value="FRI">FRIDAY</option>
    <option value="SAT">SATURDAY</option>
    <option value="SUM">SUNDAY</option>
</select>
</div>
<div class="col-25">
<small>Start Time</small><input type="time" id="subUnit" size="16" name="startTime" required>
</div>
<div class="col-75">
<small>End Time</small><input type="time" id="subUnit" size="16" name="endTime" required>
</div>
<div class="col-18">
<button class="myCol">Add Schedule</button>
</div>

<table class="content-table">
  <thead>
    <tr>
    <th>Monday</th>
    <th>Tuesday</th>
    <th>Wednesday</th>
    <th>Thursday</th>
    <th>Friday</th>
    <th>Saturday</th>
    <th>Sunday</th>
  </tr>
</thead>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>

<tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>

  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>

  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
</div>

<script>
  // Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on the button, open the modal
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>

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