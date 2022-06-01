<?php
    require('dbconnection.php');
    session_start();
    $datenow = date('Y-m-d');
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <title>Activity Log | Enrollment System </title>
      <link rel="icon" type="image/x-icon" href="logo-icon.png">
      <link rel="stylesheet" href="activitylog.css?<?php echo time();?>">
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
      </nav><div class="container">


<div class="container">
  <h1> ACTIVITY LOG</h1>
  <div class="custom-select">
    <h4 id="filter"> FILTER BY : </h4>
    <h4>Date</h4>
    <input type="date" id="date">
    <h4>Start Time</h4>
    <input type="time" id="startTime" name="startTime" required>
    <h4>End Time</h4>
    <input type="time" id="endTime" name="endTime" required>
      <input type="button" name="filter" id="filterdata" value="Filter Data">
      <a href="activitylog.php"><input type="button" value="Reset"></a>
    </div>
  <div id="searchresult">
  </div>
<div id="activitylogtable" class="activitylogtable">
<table id="content-table" class="content-table">
  <thead>
    <tr>
    <th>Activity Number</th>
    <th>Activity Description</th>
    <th>Staff</th>
    <th>Date</th>
  </tr>
</thead>
  <?php 
    $query = "SELECT * FROM tblactivitylog ORDER BY date DESC";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result) > 0){
      while($row = mysqli_fetch_array($result)){
      ?>
        <tr>
          <td><?php echo $row['activityID']?></td>
          <td><?php echo $row['activity']?></td>
          <td><?php echo $row['incharge']?></td>
          <td><?php echo $row['date']?></td>
        </tr>
      <?php
      }
    }
  ?>
</table>
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
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                $("#filterdata").click(function(){
                    var date = $("#date").val();
                    var startTime = $("#startTime").val();
                    var endTime = $("#endTime").val();
                    alert(date + startTime + endTime);
                    $("#searchresult").show();
                    $("#activitylogtable").hide();
                    //$("#enrolledtable").hide();
                    $.ajax({
                        url: "activityloglivesearch.php",
                        method: "POST",
                        data: {date:date, startTime:startTime, endTime:endTime},

                        success:function(data){
                            $("#searchresult").html(data);
                        }
                    })
                });

            });
        </script>
   </body>
</html>