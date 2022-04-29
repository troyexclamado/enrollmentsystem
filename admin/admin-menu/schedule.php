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
            <p>Admin</p>
            
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
    <option value="0">CCS 001</option>
    <option value="1">CSS 002</option>
    <option value="2">CSS 003</option>
    <option value="3">CSS 004</option>
</select>	
</div>
<div class="col-3">
<button class="col-4">Add Subject</button>
</div>

<div class="col-1">
<select>
    <option value="">Section:</option>
    <option value="1">BSCS 3A</option>
    <option value="2">BSCS 3B</option>
    <option value="3">BSCS 3C</option>
  </select>	
</div>
<h4 id="filter"> ADD SCHEDULE: </h4>
<div class="custom-select" style="width:200px;">
  <select>
    <option value="0">Course:</option>
    <option value="1">BSCS</option>
    <option value="2">BSIT</option>
    <option value="3">BSEMC</option>
    <option value="4">BSIS</option>
    <option value="5">BSM</option>
    <option value="6">BSP</option>
    <option value="7">BPA</option>
    <option value="8">ABCOMM</option>
    <option value="9">ABPS</option>
    <option value="10">ABBS</option>
    <option value="11">BSAT</option>
    <option value="12">BSA</option>
  </select>
 <div class="space">
  </div>
    <select>
    <option value="0">Year:</option>
    <option value="1">1st</option>
    <option value="2">2nd</option>
    <option value="3">3rd</option>
    <option value="4">4th</option>
  </select>
 <div class="space">
  </div>
    <select>
    <option value="0">Units:</option>
    <option value="1">Ascending</option>
    <option value="2">Descending</option>
  </select>
 <div class="space">
  </div>
    <select>
    <option value="0">Semester:</option>
    <option value="1">1st</option>
    <option value="2">2nd</option>
  </select>
<div class="space">
  </div>
<select>
    <option value="0">Day:</option>
    <option value="1">Monday</option>
    <option value="2">Tuesday</option>
    <option value="3">Wednesday</option>
    <option value="4">Thursday</option>
    <option value="5">Friday</option>
    <option value="6">Saturday</option>
    <option value="7">Sunday</option>
</select>
</div>
<div class="col-25">
<input type="text" id="subUnit" size="16" name="unit" placeholder="Start..">
</div>
<div class="col-75">
<input type="text" id="subUnit" size="16" name="unit" placeholder="End..">
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