<?php 
    session_start();
    include('dbconnection.php');
    
    // $record_per_page = 15;

    // $page = '';

    // if(isset($_GET['page'])){
    //     $page = $_GET['page'];
    // } else {
    //     $page = 1;
    // }

    // $start_from = ($page - 1) * $record_per_page;

    // $query = "SELECT * FROM tblsubjects ORDER BY  courseID ASC LIMIT $start_from, $record_per_page";
    $query = "SELECT * FROM tblsubjects ORDER BY courseID ASC";
    $result = mysqli_query($conn, $query);
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <title>Enrollment System </title>
      
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
      <link rel="stylesheet" href="Subjects.css?<?php echo time();?>">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

   <!-- for refresh page -->
   <script type="text/javascript">
      //use to stop resubmitting of form when pag refresh therefore stopping modal showing
      if(window.history.replaceState){
        window.history.replaceState(null,null,window.location.href);
      }
  </script>

  </head>
   <body>
      <nav class="sidebar">
         <div class="text">
        <!--  <?php
                if($_SESSION['POSITION']== "PROFESSOR"){
                    ?> <p>PROFESSOR</p>
                    <?php
                } else {
                    ?> <p>Admin </p><?php
                }
            ?> -->
             <p>Admin </p>
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
      </nav><div class="container">
<div class="container">
    <h1>COURSES</h1>
    <a href="addcourse.php" class="sub">Add Courses</a>
    <!-- <div class="search">
        <div class="search-box">
          <input type="text" id = "search" autocomplete="off" placeholder="Type here...">
          <button for="check" class="icon">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    -->
    <!-- <div id="searchresult">
    </div> -->

    


<div style="margin-top:100px;" id="subjectstable" class="subjectstable">
<table  id="myTable" class="content-table">
    <thead>
        <tr>
            <th>Course Abbreviation</th>
            <th>Course Descrition</th>
            <th>Year</th>
            <th>Section</th>
            <th>Available Slot</th>
            <th>Semester</th>
            <th>Action</th>
        </tr>
    </thead>
  <?php 
        $strcourse = "select * from tblcoursedetails";
        $result = $conn->query($strcourse);
        if($result !== false && $result->num_rows > 0){
            while($row = $result->fetch_assoc()) 
            {
                ?>
        <tr>
            <td><?=$row['courseAbbr']?></td>
            <td><?=$row['courseDescription']?></td>
            <td><?=$row['year']?></td>
            <td><?=$row['section']?></td>
            <td><?=$row['availableslots']?></td>
            <td><?=$row['semester']?></td>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?> ">
                <td>
                    <button type="submit" value="<?=$row['courseID']?>" name="btnedit" id="btnedit">Edit</button>
                    <!-- <button type="button" value="<?=$row['courseID']?>" name="btndel" id="btndel" data-toggle="modal" data-target="#mymodal">Delete</button> -->
                    <button type="submit" value="<?=$row['courseID']?>" name="btndel" id="btndel">Delete</button>
                </td>
            </form>
        </tr>
     <?php       
            }//end while
        }//end if result
        if(isset($_POST['btnedit'])){
            $pick = $_POST['btnedit'];
            echo  $pick;
            $strupdatetblcourse = "update tblcoursedetails set pick='1' where courseID = $pick ";
            $updateresult = $conn->query($strupdatetblcourse);
            if($updateresult){
            echo("<script>location.href = 'b.php';</script>");
            }
        }

        else if(isset($_POST['btndel'])){
            $pick = $_POST['btndel'];
            //echo  $pick;
            $strupdatetblcourse = "update tblcoursedetails set del='1' where courseID = $pick ";
            $updateresult = $conn->query($strupdatetblcourse);
            if($updateresult){
                 echo("<script>location.href = 'a.php';</script>");
            }
        }


        $conn->close();
     ?>
</table>
</div>
<!-- UPDATE tblcoursedetails SET del='0' -->


<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
   </body>
</html>