<?php 
    session_start();
    include('dbconnection.php');
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <title>Enrollment System </title>
      <link rel="stylesheet" href="addsub.css?<?php echo time();?>">
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
            
            <li><a href="Courses.php">COURSES<img src="crse.png" alt="" style="width: 20px;height:20px;"></a></a></li>
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
<?php 
        if(isset($_POST['viewDetails'])){
            $studentNumber = $_POST['viewDetails'];
            $query = "SELECT * FROM tblstudents WHERE studentNumber = $studentNumber";
            $sql = mysqli_query($conn, $query);
            if(mysqli_num_rows($sql) > 0){
                $row = mysqli_fetch_array($sql);
        
    ?>
<h2 style="margin-left: 20px;">STUDENT DETAILS(<?php echo $studentNumber?>)</h2>
<div class="container">
    
  <form method = "post" action="#">
      <input type="hidden" name="studentNumber" value = "<?php echo $studentNumber ?>">
      <div id="myModal" class="modal" style="display: block;">
            <div class="modal-content">
                <div class="modal-header">
                </div>
                <div class="modal-body">
                    <table>
                        <?php
                            $getName = "SELECT * FROM tblstudentaccounts WHERE studentNumber = $studentNumber";
                            $results = mysqli_query($conn, $getName);
                            if(mysqli_num_rows($results) > 0){
                                $name_row = mysqli_fetch_array($results);
                        ?>
                        <tr>
                            <td><p>Name:</p></td>
                            <td><p><?php echo $name_row['lastname'].", ".$name_row['firstname']." ".$name_row['middlename']?></p></td>
                        </tr>
                        <tr>
                            <td><p>Address:</p></td>
                            <td><p><?=$row['address']?></p></td>
                        </tr> 
                        <tr>
                            <td><p>Birthday:</p></td>
                            <td><p><?=$row['birthday']?></p></td>
                        </tr> 
                        <tr>
                            <td><p>Birthplace:</p></td>
                            <td><p><?=$row['birthplace']?></p></td>
                        </tr> 
                        <tr>
                            <td><p>Contact Number:</p></td>
                            <td><p><?=$row['contactNumber']?></p></td>
                        </tr> 
                        <tr>
                            <td><p>Last School Attended:</p></td>
                            <td><p><?=$row['lastSchoolAttended']?></p></td>
                        </tr>
                        <tr>
                            <td><p>Year Graduated:</p></td>
                            <td><p><?=$row['lastSchoolYearAttended']?></p></td>
                        </tr> 
                        <tr>
                            <td><p>School Addres:</p></td>
                            <td><p><?=$row['lastSchoolAddress']?></p></td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>  
                    </table>
                </div>
            </div>
        </div>
        <div class="subject-container">
            <div class="subject">
            <table>
                <thead>
                    <tr>
                        <th>Subject Code</th>
                        <th>Subject Name</th>
                        <th>Subject Units</th>
                    </tr>
                </thead>
                <?php
                    $courseDetails;
                    $sql1 = "SELECT * FROM tblstudents WHERE studentNumber = $studentNumber";
                    $result = mysqli_query($conn, $sql1);
                    while($row = mysqli_fetch_array($result)){
                        // $course = $row['course'];
                        // $year = $row['year'];
                        // $semester = $row['semester'];
                        $courseDetails = $row['courseID'];
                    }

                    $sql = "SELECT * FROM tblsubjects WHERE courseID = $courseDetails";
                    $res = mysqli_query($conn, $sql);

                    while($row_course = mysqli_fetch_array($res)){
                        // $subject_id = $row_course['subj_id'];
                        $subject_code = $row_course['subjectCode'];
                        $subject_name = $row_course['subjectDescription'];
                        $subject_units = $row_course['subjectUnits'];
                ?>

                <tbody>
                    <tr>
                        <td><?php echo $subject_code;?></td>
                        <td><?php echo $subject_name;?></td>
                        <td><?php echo $subject_units;?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    <div class="row">
      <input type="submit" name="addtransaction" value="Generate E-Registration Form">
      <a href="Pre-Enrolled.php"><input type="button" name="addtransaction" value="Back"></a>
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