<?php 
    session_start();
    include('dbconnection.php');

    
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <title>Enrollment System </title>
      <link rel="stylesheet" href="Courses.css?<?php echo time();?>">
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
            <li class="active"><a href="Admin.php" >DASHBOARD <img src="dash.png" alt="" style="width: 20px;height:20px;"></i> </a></li>
            <li>
               <a href="#" class="feat-btn">STUDENTS<img src="stud.png" alt="" style="width: 20px;height:20px;">
               <span class="fas fa-caret-down first"></span>
               </a>
               <ul class="feat-show">
                  <li><a href="Pre-Enrolled.php">PRE ENROLLED <img src="dash.png" alt="" style="width: 20px;height:20px;"></i></a></li>
                  <li><a href="Enrolled.php">ENROLLED <img src="enrlld.png" alt="" style="width: 20px;height:20px;"></a></li>
               </ul>
            </li>
            
            <li><a href="Courses.php">COURSES <img src="crse.png" alt="" style="width: 20px;height:20px;"></a></li>
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


<div class="container">
  <h1> COURSES</h1>
  <a href="addcourse.php" class="sub">Add Course</a>
<!-- <div class="search">
    <div class="search-box">
      <input type="text" placeholder="Type here...">
      <button for="check" class="icon">
        <i class="fas fa-search"></i>
      </button>
    </div>
  </div> -->
  <div class="custom-select">
    <h4 id="filter"> FILTER BY : </h4>
      <select id="course-drop-down" name="course">
        <option value="">Course:</option>
        <option value="BSCS">BSCS</option>
        <option value="BSIT">BSIT</option>
        <option value="BSEMC">BSEMC</option>
        <option value="BSIS">BSIS</option>
      </select>
        <select id="year-drop-down" name="year">
        <option value="">Year:</option>
        <option value="1">1st</option>
        <option value="2">2nd</option>
        <option value="3">3rd</option>
        <option value="4">4th</option>
        
      </select>
        <select id="section-drop-down" name="section">
        <option value="">Section</option>
        <option value="A">A</option>
        <option value="B">B</option>
        <option value="C">C</option>
      </select>
      <input type="button" name="filter" id="filterdata" value="Filter Data">
      <a href="Courses.php"><input type="button" value="Reset"></a>
    </div>
    <div id="searchresult">
    </div>
<div id="coursestable" class="coursestable">
<table id="content-table" class="content-table">
  <thead>
    <tr>
            <th>COURSE ABBREVIATION</th>
            <th>COURSE DESCRIPTION</th>
            <th>YEAR</th>
            <th>SECTION</th>
            <th>AVAILABLE<br>SLOT</th>
            <th>SEMESTER</th>
            <th>ACTION</th>
  </tr>
</thead>
  <tr>
    <?php
        $getCourses = "SELECT * from tblcoursedetails WHERE del = 0";
        $sqlGetCourses = mysqli_query($conn, $getCourses);

        while($courses = mysqli_fetch_array($sqlGetCourses)){
    ?>
    <td><?php echo $courses['courseAbbr']?></td>
    <td><?php echo $courses['courseDescription']?></td>
    <td><?php echo $courses['year']?></td>
    <td><?php echo $courses['section']?></td>
    <td><?php echo $courses['availableslots']?></td>
    <td><?php echo $courses['semester']?></td>
    <td>
      <form action="editcoursedetails.php" method="POST" onsubmit="return confirm('Do you want to edit/delete this?')">
        <input type="hidden" name="courseID" value="<?php echo $courses['courseID']?>">
        <button name= "btnedit" id="myBtn1">EDIT</button>
        <button name= "btndel" id="myBtn2">DELETE</button>
      </form>
    </td>
  </tr>
  <?php }?>
</div>
</table>
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
           	var cancel_btn = document.querySelector(".cancel_btn");
	      </script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                $("#filterdata").click(function(){
                    var course = $("#course-drop-down").val();
                    var year = $("#year-drop-down").val();
                    var section = $("#section-drop-down").val();
                    alert(course + year + section);
                    $("#searchresult").show();
                    $("#coursestable").hide();
                    //$("#enrolledtable").hide();
                    $.ajax({
                        url: "courseslivesearch.php",
                        method: "POST",
                        data: {course:course, year:year, section:section},

                        success:function(data){
                            $("#searchresult").html(data);
                        }
                    })
                });

            });
        </script>
   </body>
</html>