<?php 
    session_start();
    include('dbconnection.php');
    
    if(isset($_POST['update'])){
        $subjectID = $_POST['subjectID'];
        $subjectCode = $_POST['subjectCode'];
        $subjectDescription = $_POST['subjectDescription'];
        $subjectUnits = $_POST['subjectUnits'];
        $course = $_POST['course'];
        $year = $_POST['year'];
        $semester = $_POST['semester'];
        $section = $_POST['section'];
        //ichecheck yung mga ininput tas hahanapin sa tblcoursedetails, pag may nahanap na kaparehas kukunin yung value ng courseID
        $courseID = "";
        $sqlGetCourseDetails = "SELECT courseID FROM tblcoursedetails WHERE courseDescription = '$course' AND year = $year AND semester = $semester AND section = '$section'";
        $getCourseDetails = mysqli_query($conn, $sqlGetCourseDetails);
        if(mysqli_num_rows($getCourseDetails) > 0){
            $coursedetails = mysqli_fetch_array($getCourseDetails);
            $courseID = $coursedetails['courseID'];

            $updateSubject = "UPDATE tblsubjects SET subjectCode = '$subjectCode', subjectDescription = '$subjectDescription', subjectUnits = $subjectUnits, courseID = $courseID WHERE id = $subjectID";
            $sqlUpdate = mysqli_query($conn, $updateSubject);

            //activity log
            $name = $_SESSION['NAME'];
            $activity = 'EDITED SUBJECT '.$subjectCode;
            $activityquery = "INSERT INTO tblactivitylog(activity, incharge) VALUES('$activity', '$name')";
            $activityresult = mysqli_query($conn, $activityquery);

            header("Location: ../admin-menu/Subjects.php", true, 301);
        } else {
            echo '<script>alert("Updating subject failed!");</script>';
            header("Location: ../admin-menu/Subjects.php", true, 301);
        }
    }
    if(isset($_POST['delete'])){
        $subjectID = $_POST['subjectID'];

        $query = "DELETE FROM tblsubjects WHERE id = $subjectID";
        $sql = mysqli_query($conn, $query);
        if($sql){
            //activity log
            $name = $_SESSION['NAME'];
            $activity = 'DELETED SUBJECT ID='.$subjectID;
            $activityquery = "INSERT INTO tblactivitylog(activity, incharge) VALUES('$activity', '$name')";
            $activityresult = mysqli_query($conn, $activityquery);

            header("Location: ../admin-menu/Subjects.php", true, 301);
        }
    }
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
            <li><a href="professoravailability.php">AVAILABILITY<img src="crse.png" alt="" style="width: 20px;height:20px;"></a></a></li>
            <li><a href="activitylog.php">ACTIVITY LOG <img src="actlog.png" alt="" style="width: 20px;height:20px;"></a></li>
            <li><a href="logout.php">LOG OUT <img src="actlog.png" alt="" style="width: 20px;height:20px;"></a></li>
         </ul>
</nav>
<br>
<h2>EDIT SUBJECT</h2>
<div class="container">
    <?php 
        if(isset($_POST['edit'])){
            $subjectID = $_POST['subjectID'];
            
            $subjectquery = "SELECT * FROM tblsubjects WHERE id = $subjectID";
            $results = mysqli_query($conn, $subjectquery);

        if(mysqli_num_rows($results) > 0){
            $row = mysqli_fetch_array($results);

            $courseID = $row['courseID'];
            $coursedetailsquery = "SELECT * FROM tblcoursedetails WHERE courseID = $courseID";
            $coursedetailsresult = mysqli_query($conn, $coursedetailsquery);

            if(mysqli_num_rows($coursedetailsresult) > 0){
                $coursedetailsrow = mysqli_fetch_array($coursedetailsresult);
    ?>
  <form method = "post" action="editsubject.php">
      <input type="hidden" value ="<?php echo $subjectID?>" name="subjectID">
    <div class="row">
      <div class="col-25">
        <label for="fname">Subject Code</label>
      </div>
      <div class="col-75">
        <input type="text" id="subCodes" name="subjectCode" value="<?php echo $row['subjectCode']?>" required>
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="fname">Subject Description</label>
      </div>
      <div class="col-75">
        <input type="text" id="subDes" name="subjectDescription" value="<?php echo $row['subjectDescription']?>" required>
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="lname">Subject Units</label>
      </div>
      <div class="col-75">
        <input type="text" id="subUnit" name="subjectUnits" value="<?php echo $row['subjectUnits']?>" required>
      </div>
    </div>
   <div class="row">
      <div class="col-25">
        <label for="lname">Course</label>
      </div>
      <div class="col-75">
        <!-- <input type="text" id="subCourse" name="course" placeholder="Enter course"> -->
        <select id="subCourse" name="course" required>
        <option selected hidden value="">Select course...</option>
        <?php 
            $getCourses = "SELECT DISTINCT courseDescription FROM tblcoursedetails";
            $sqlGetCourses = mysqli_query($conn, $getCourses);
            while($results = mysqli_fetch_array($sqlGetCourses)){
            ?>
            <option><?php echo $results['courseDescription']?></option>
        <?php } ?>
        </select>
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="country">Year</label>
      </div>
      <div class="col-75">
        <select id="subYear" name="year" required>
        <option selected hidden value="">Select year...</option>
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
            <option selected hidden value="">Select semester...</option>
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
        <option selected hidden value="">Select section...</option>
          <option>A</option>
          <option>B</option>
          <option>C</option>
          <option>D</option>
        </select>
      </div>
    </div>
      
    <div class="row">
      <input type="submit" name="update" value="Add Subject">
    </div>
  </form>
    <?php 
            }
        }
        }
    ?>
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