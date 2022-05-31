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
            <li><a href="professoravailability.php">AVAILABILITY<img src="crse.png" alt="" style="width: 20px;height:20px;"></a></a></li>
            <li><a href="activitylog.php">ACTIVITY LOG <img src="actlog.png" alt="" style="width: 20px;height:20px;"></a></li>
            <li><a href="logout.php">LOG OUT <img src="actlog.png" alt="" style="width: 20px;height:20px;"></a></li>
         </ul>
</nav>
<br>
<?php 
        if(isset($_POST['viewDetails']) || isset($_POST['remove'])){
            if(isset($_POST['remove'])){
                $studentNumber = $_POST['studentNumber'];
                $subjectCode = $_POST['subjectCode'];
                $courseID = $_POST['courseID'];
                $id = $_POST['id'];

                $updatesubject = "UPDATE tblbacksubjects SET status = 'Save' WHERE accountID = $studentNumber AND subjectCode = '$subjectCode'";
                $sqlupdatesubject = mysqli_query($conn, $updatesubject);

                $removequery = "DELETE FROM tblenrolledsubjects WHERE studentNumber = $studentNumber AND subjectCode = '$subjectCode' AND courseID = $courseID AND id = $id";
                $sqlremovequery = mysqli_query($conn, $removequery);

            }
            $studentNumber = (empty($_POST['viewDetails']) ? $_POST['studentNumber'] : $_POST['viewDetails']) ;
            $query = "SELECT * FROM tblstudents WHERE studentNumber = $studentNumber";
            $sql = mysqli_query($conn, $query);
            if(mysqli_num_rows($sql) > 0){
                $row = mysqli_fetch_array($sql);
        
    ?>
<h2 style="margin-left: 20px;">STUDENT DETAILS(<?php echo $studentNumber?>)</h2>
<div class="container">
    
  
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
                        <th>Action</th>
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

                    $sql = "SELECT id,subjectCode FROM tblenrolledsubjects WHERE courseID = $courseDetails AND studentNumber = $studentNumber";
                    $res = mysqli_query($conn, $sql);

                    while($row_course = mysqli_fetch_array($res)){
                        $subjectCode = $row_course['subjectCode'];
                        $subjectsquery = "SELECT * FROM tblsubjects WHERE subjectCode = '$subjectCode'";
                        $result = mysqli_query($conn, $subjectsquery);
                        if(mysqli_num_rows($result) > 0){
                            $row = mysqli_fetch_array($result);
                            $subject_code = $row['subjectCode'];
                            $subject_name = $row['subjectDescription'];
                            $subject_units = $row['subjectUnits'];
                        // $subject_id = $row_course['subj_id'];
                ?>
                <tbody>
                    <tr>
                        <td><?php echo $subject_code;?></td>
                        <td><?php echo $subject_name;?></td>
                        <td><?php echo $subject_units;?></td>
                        <form method="POST" action="seedetailspreenrolled.php" onsubmit="return confirm('Do you want to remove this subject?')" >
                        <input type="hidden" name="id" value="<?php echo $row_course['id']?>">
                        <input type="hidden" name="studentNumber" value="<?php echo $studentNumber?>">
                        <input type="hidden" name="subjectCode" value="<?php echo $subject_code?>">
                        <input type="hidden" name="courseID" value="<?php echo $courseDetails?>">
                        <td><button type="submit" name="remove" class="deletebutton">REMOVE</button></td>
                        </form>
                    </tr>
                <?php 
                        }
                    } ?>
                </tbody>
            </table>
        </div>
    <div class="row">
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