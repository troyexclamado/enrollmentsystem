<?php
    require('dbconnection.php');
    session_start();
    $datenow = date('Y-m-d');
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <title>Enrollment System </title>
      <link rel="stylesheet" href="admin.css">
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
            <li class="active"><a href="Admin.php">DASHBOARD <img src="dash.png" alt="" style="width: 20px;height:20px;"></i></a></li> 
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
            <li><a href="studentaccounts.php">STUDENT ACCOUNTS<img src="crse.png" alt="" style="width: 20px;height:20px;"></a></a></li>
            <li><a href="professoravailability.php">AVAILABILITY<img src="crse.png" alt="" style="width: 20px;height:20px;"></a></a></li>
            <li><a href="activitylog.php">ACTIVITY LOG <img src="actlog.png" alt="" style="width: 20px;height:20px;"></a></li>
            <?php 
                }
            if(!empty($_SESSION['POSITION']) && ($_SESSION['POSITION'] == "PROFESSOR")){ ?> 
            <li><a href="schedule.php">SCHEDULE <img src="schedule.png" alt="" style="width: 20px;height:20px;"></a></li>
            <?php }?>
            <li><a href="logout.php">LOG OUT <img src="actlog.png" alt="" style="width: 20px;height:20px;"></a></li>
         </ul>
      </nav><div class="container">
    
   <div class="content">
        <div class="cards">
            <div class="card">
                <div class="box">
                    <h1></h1>
                    <h3 style="font-size:25px;">Courses</h3>
                    <?php 
                        $countCourses = "SELECT COUNT(DISTINCT courseDescription) AS courses FROM tblcoursedetails";
                        $sqlCountCourses = mysqli_query($conn, $countCourses);
                        if(mysqli_num_rows($sqlCountCourses) > 0){
                            $coursesResult = mysqli_fetch_array($sqlCountCourses);
                    ?>
                    <h3><?php echo $coursesResult['courses']?></h3>
                    <?php 
                        } else {
                            echo '0';
                        }
                    ?>
                </div>
                <div class="icon-case">
                    <img src="course.png" alt=" "  style="width: 70px;height:70px;">
                </div>
            </div>
            
            <div class="card">
                <div class="box">
                    <h1></h1>
                    <h3 style="font-size:25px;" >Subjects</h3>
                    <?php 
                        $countSubjects = "SELECT COUNT(DISTINCT subjectCode) AS subjects FROM tblsubjects";
                        $sqlCountSubjects = mysqli_query($conn, $countSubjects);
                        if(mysqli_num_rows($sqlCountSubjects) > 0){
                            $subjectResult = mysqli_fetch_array($sqlCountSubjects);
                    ?>
                    <h3><?php echo $subjectResult['subjects']?></h3>
                    <?php 
                        } else {
                            echo '0';
                        }
                    ?>
                </div>
                <div class="icon-case">
                    <img src="course.png" alt=" "  style="width: 70px;height:70px;">
                </div>
            </div>

            
            <div class="card">
                <div class="box">
                    <h1></h1>
                    <h3 style="font-size:25px;">Pre-enrolled</h3>
                    <?php 
                        $countPreenrolled = "SELECT COUNT(statusID) AS preenrolled FROM tblstudents WHERE statusID=0";
                        $sqlCountPreenrolled = mysqli_query($conn, $countPreenrolled);
                        if(mysqli_num_rows($sqlCountPreenrolled) > 0){
                            $preenrolledResult = mysqli_fetch_array($sqlCountPreenrolled);
                    ?>
                    <h3><?php echo $preenrolledResult['preenrolled']?></h3>
                    <?php 
                        } else {
                            echo '0';
                        }
                    ?>
                </div>
                <div class="icon-case">
                    <img src="preenrolled.png" alt="" style="width: 70px;height:70px;">
                </div>
            </div>

            <div class="card">
                <div class="box">
                    <h1></h1>
                    <h3 style="font-size:25px;" >Enrolled</h3>
                    <?php 
                        $countEnrolled = "SELECT COUNT(statusID) AS enrolled FROM tblstudents WHERE statusID=1";
                        $sqlCountEnrolled = mysqli_query($conn, $countEnrolled);
                        if(mysqli_num_rows($sqlCountEnrolled) > 0){
                            $enrolledResult = mysqli_fetch_array($sqlCountEnrolled);
                    ?>
                    <h3><?php echo $enrolledResult['enrolled']?></h3>
                    <?php 
                        } else {
                            echo '0';
                        }
                    ?>
                </div>
                <div class="icon-case">
                    <img src="enrolled.png" alt="" style="width: 70px;height:70px;">
                </div>
            </div>

            <div class="card">
                <div class="box">
                    <h1></h1>
                    <h3  style="font-size:20px;">BSCS (TODAY)</h3>
                    <?php 
                        $bscsnumber = 0;
                        $bscsquery = "SELECT * FROM tblcoursedetails WHERE courseAbbr = 'BSCS'";
                        $resultbscs = mysqli_query($conn, $bscsquery);
                        if(mysqli_num_rows($resultbscs) > 0){
                            while($bscsrows = mysqli_fetch_array($resultbscs)){
                                $courseID = $bscsrows['courseID'];
                                $countBSCS = "SELECT * FROM tblstudents WHERE dateOfEnrollment = '$datenow' AND courseID = $courseID AND statusID = 1";
                                $sqlCountBSCS = mysqli_query($conn, $countBSCS);
                                if(mysqli_num_rows($sqlCountBSCS) > 0){
                                    while($BSCSresult = mysqli_fetch_array($sqlCountBSCS)){
                                        $bscsnumber = $bscsnumber + 1;
                                    }
                                }
                            }

                        }
                    ?>
                    <h3><?php echo $bscsnumber?></h3>
                </div>
                <div class="icon-case">
                    <img src="student.png" alt="" style="width: 70px;height:70px;">
                </div>
            </div>

            <div class="card">
                <div class="box">
                    <h1></h1>
                    <h3  style="font-size:20px;">BSEMC (TODAY)</h3>
                    <?php 
                        $bsemcnumber = 0;
                        $bsemcquery = "SELECT * FROM tblcoursedetails WHERE courseAbbr = 'BSEMC'";
                        $resultbsemc = mysqli_query($conn, $bsemcquery);
                        if(mysqli_num_rows($resultbsemc) > 0){
                            while($bsemcrows = mysqli_fetch_array($resultbsemc)){
                                $courseID = $bsemcrows['courseID'];
                                $countBSEMC = "SELECT * FROM tblstudents WHERE dateOfEnrollment = '$datenow' AND courseID = $courseID AND statusID = 1";
                                $sqlCountBSEMC = mysqli_query($conn, $countBSEMC);
                                if(mysqli_num_rows($sqlCountBSEMC) > 0){
                                    while($BSEMCresult = mysqli_fetch_array($sqlCountBSEMC)){
                                        $bsemcnumber = $bsemcnumber + 1;
                                    }
                                }
                            }

                        }
                    ?>
                    <h3><?php echo $bsemcnumber?></h3>
                </div>
                <div class="icon-case">
                    <img src="student.png" alt="" style="width: 70px;height:70px;">
                </div>
            </div>

            <div class="card">
                <div class="box">
                    <h1></h1>
                    <h3  style="font-size:20px;">BSIS (TODAY)</h3>
                    <?php 
                        $bsisnumber = 0;
                        $bsisquery = "SELECT * FROM tblcoursedetails WHERE courseAbbr = 'BSIS'";
                        $resultbsis = mysqli_query($conn, $bsisquery);
                        if(mysqli_num_rows($resultbsis) > 0){
                            while($bsisrows = mysqli_fetch_array($resultbsis)){
                                $courseID = $bsisrows['courseID'];
                                $countBSIS = "SELECT * FROM tblstudents WHERE dateOfEnrollment = '$datenow' AND courseID = $courseID AND statusID = 1";
                                $sqlCountBSIS = mysqli_query($conn, $countBSIS);
                                if(mysqli_num_rows($sqlCountBSIS) > 0){
                                    while($BSISresult = mysqli_fetch_array($sqlCountBSIS)){
                                        $bsisnumber = $bsisnumber + 1;
                                    }
                                }
                            }

                        }
                    ?>
                    <h3><?php echo $bsisnumber?></h3>
                </div>
                <div class="icon-case">
                    <img src="student.png" alt="" style="width: 70px;height:70px;">
                </div>
            </div>

            <div class="card">
                <div class="box">
                    <h1></h1>
                    <h3  style="font-size:20px;">BSIT (TODAY)</h3>
                    <?php 
                        $bsitnumber = 0;
                        $bsitquery = "SELECT * FROM tblcoursedetails WHERE courseAbbr = 'BSIT'";
                        $resultbsit = mysqli_query($conn, $bsitquery);
                        if(mysqli_num_rows($resultbsit) > 0){
                            while($bsitrows = mysqli_fetch_array($resultbsit)){
                                $courseID = $bsitrows['courseID'];
                                $countBSIT = "SELECT * FROM tblstudents WHERE dateOfEnrollment = '$datenow' AND courseID = $courseID AND statusID = 1";
                                $sqlCountBSIT = mysqli_query($conn, $countBSIT);
                                if(mysqli_num_rows($sqlCountBSIT) > 0){
                                    while($BSITresult = mysqli_fetch_array($sqlCountBSIT)){
                                        $bsitnumber = $bsitnumber + 1;
                                    }
                                }
                            }

                        }
                    ?>
                    <h3><?php echo $bsitnumber?></h3>
                </div>
                <div class="icon-case">
                    <img src="student.png" alt="" style="width: 70px;height:70px;">
                </div>
            </div>
        </div>
        <div>
            
        </div>
        <h2 style="margin-left: 10px; margin-top: 10px">ENROLLED STUDENTS</h2>  
        <div class="enrolled" id="enrolledtable">
        
            <table id="enrolled" class="content-table">
                <thead>
                    <tr>
                        <th>STUDENT NUMBER</th>
                        <th>NAME</th>
                        <th>COURSE, YEAR AND SECTION</th>
                        <th>DATE ENROLLED</th>
                        <th>VIEW INFORMATION</th>
                    </tr>
                </thead>
            <!-- PHP CODE TO FETCH DATA FROM ROWS-->
                <?php
                    $withstudentnum = "SELECT * FROM tblstudents WHERE statusID = '1' LIMIT 10";
                    $resultwithstudentnum = $conn->query($withstudentnum);
                    if ($resultwithstudentnum->num_rows > 0) 
                    {
                        while($row = $resultwithstudentnum->fetch_assoc()) 
                        {
                 ?>
                            <tr>
                                <!-- <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" > -->
                                    <td>
                                        <p><?=$row['studentNumber']?></p>
                                    </td>
                                    <td>
                                    <?php 
                                        //KUKUNIN YUNG FULLNAME SA TBLACCOUNTS
                                        $studentNumber = $row['studentNumber'];
                                        $getFullname = "SELECT * FROM tblstudentaccounts WHERE studentNumber = $studentNumber";
                                        $sqlGetName = mysqli_query($conn, $getFullname);

                                        while($name_result = mysqli_fetch_array($sqlGetName)) {
                                        ?>
                                        <p><?php echo $name_result['lastname'].", ".$name_result['firstname']." ".$name_result['middlename']?></p>
                                        <?php
                                        }
                                        ?>
                                    </td>
                                    <td><p><?php
                                        $courseID = $row['courseID'];
                                        $query = "SELECT * FROM tblcoursedetails WHERE courseID = $courseID";
                                        $results = mysqli_query($conn, $query);
                                        if(mysqli_num_rows($results) > 0){
                                            $rows = mysqli_fetch_array($results);
                                            echo $rows['courseAbbr'].' '.$rows['year'].$rows['section'];
                                        }

                                        ?>
                                    </p>
                                    </td>
                                    <td>
                                        <p><?=$row['dateOfEnrollment']?></p>
                                    </td>
                                    <td>
                                        <form method="POST" action="seedetailsenrolled.php">
                                        <button type="submit" name="viewDetails" value="<?=$row['studentNumber']?>" >View Details</button>
                                        </form>
                                    </td>
                                </form>
                            </tr>
            <?php
                        }
                     }
                $conn->close();
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
   </body>
</html>