<?php 
    session_start();
    include('dbconnection.php');
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <title>Enrollment System </title>
      <link rel="stylesheet" href="PRE-ENROLLED.css">
      <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
   </head>
   <script type="text/javascript">
      //use to stop resubmitting of form when pag refresh therefore stopping modal showing
      if(window.history.replaceState){
        window.history.replaceState(null,null,window.location.href);
      }
  </script>
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
            <li class="active">
                <a href="Admin.php">DASHBOARD <img src="dash.png" alt="" style="width: 20px;height:20px;"></a>
            </li> 
            <li>
               <a href="#" class="feat-btn">STUDENTS  <img src="stud.png" alt="" style="width: 20px;height:20px;">
                    <span class="fas fa-caret-down first"></span></a>
               <ul class="feat-show">
                    <li>
                        <a href="Pre-Enrolled.php">PRE ENROLLED <img src="pending.png" alt="" style="width: 20px;height:20px;"></a>
                    </li>
                    <li>
                        <a href="Enrolled.php">ENROLLED  <img src="enrlld.png" alt="" style="width: 20px;height:20px;"></a>
                    </li>
               </ul>
            </li>
            
            <!-- <li>
                <a href="Courses.html">COURSE <img src="crse.png" alt="" style="width: 20px;height:20px;"></a></a>
            </li> -->
            <li>
                <a href="Courses.php">COURSES <img src="crse.png" alt="" style="width: 20px;height:20px;"></a>
            </li>
            <li>
                <a href="Subjects.php">SUBJECTS <img src="sub.png" alt="" style="width: 20px;height:20px;"></a>
            </li>
            <?php if(!empty($_SESSION['POSITION']) && ($_SESSION['POSITION'] == "PROFESSOR")){ ?> 
            <li><a href="schedule.php">SCHEDULE <img src="schedule.png" alt="" style="width: 20px;height:20px;"></a></li>
            <?php }?>
            <li>
                <a href="activitylog.php">ACTIVITY LOG <img src="actlog.png" alt="" style="width: 20px;height:20px;"></a>
            </li>
            <li><a href="/enrollmentsystem/admin/admin-login/index.html">LOG OUT <img src="actlog.png" alt="" style="width: 20px;height:20px;"></a></li>
         </ul>
      </nav>

        <div class="container">
            <!-- The Modal -->
            <?php
                $preID =""; // always insitializa variables
                if ($_SERVER["REQUEST_METHOD"] == "POST")
                {
                    if(isset($_POST['myBtn']))
                    {

                        $preID = $_POST['myBtn'];
                        $sql = "SELECT * FROM tblstudents WHERE statusID = '0' AND accountID = '$preID'";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) 
                        {
                            while($row = $result->fetch_assoc()) 
                            {
            ?> 
            <!-- Modal content -->
                                <div id="myModal" class="modal" style="display: block;"> <!--  included style="display: block;" in this modal if button is with in form tag else excluded it -->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <span class="close" >&times;</span>
                                            <h2><?php 
                                                    //KUKUNIN YUNG FULLNAME SA TBLACCOUNTS
                                                    $accountID = $row['accountID'];
                                                    $getFullname = "SELECT * FROM tblaccounts WHERE accountID = $accountID";
                                                    $sqlGetName = mysqli_query($conn, $getFullname);

                                                    while($name_result = mysqli_fetch_array($sqlGetName)) {
                                                    ?>
                                                    <p><?php echo $name_result['lastname'].", ".$name_result['firstname']." ".$name_result['middlename']?></p>
                                                    <?php
                                                    }
                                                    ?></h2> 
                                        </div>
                                        <div class="modal-body">
                                            <table>
                                                <tr>
                                                    <td style=" padding-right: 200px;"><p>Name:</p></td>
                                                    <td><?php 
                                                        //KUKUNIN YUNG FULLNAME SA TBLACCOUNTS
                                                        $accountID = $row['accountID'];
                                                        $getFullname = "SELECT * FROM tblaccounts WHERE accountID = $accountID";
                                                        $sqlGetName = mysqli_query($conn, $getFullname);

                                                        while($name_result = mysqli_fetch_array($sqlGetName)) {
                                                        ?>
                                                        <p><?php echo $name_result['lastname'].", ".$name_result['firstname']." ".$name_result['middlename']?></p>
                                                        <?php
                                                        }
                                                        ?></td>
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
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
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
                                            </table>

                                        </div>
                                        <div class="modal-footer">
                                             <!-- <button class="popup_btn popup_cancel_btn">Cancel</button>
                                            <button class="popup_btn popup_confirm_btn">Confirm</button> -->
                                        </div>
                                    </div>
                                </div>
        <?php
                            }//end of while loop
                        }//if ($result->num_rows > 0) end
                    }//if(isset($_POST['myBtn'])) end
                }//if ($_SERVER["REQUEST_METHOD"] == "POST"){ end
?>
        </div>

        <div class="container">
            <h1> PRE-ENROLLED STUDENTS</h1>
            <div class="search">
                <div class="search-box">
                    <input type="text" placeholder="Type here...">
                    <button for="check" class="icon"><i class="fas fa-search"></i></button>
                </div>
            </div>
            <h4 id="filter"> FILTER BY : </h4>
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
    <select>
    <option value="0">Year:</option>
    <option value="1">1st</option>
    <option value="2">2nd</option>
    <option value="3">3rd</option>
    <option value="4">4th</option>
    
  </select>
    <select>
    <option value="0">Date of Enrollment:</option>
    <option value="1">Ascending</option>
    <option value="2">Descending</option>
    
  </select>
</div>
    
            <table class="content-table">
                <thead>
                    <tr>
                        <th>NAME</th>
                        <th>EMAIL</th>
                        <th>DATE OF APPLICATION</th>
                        <th>VIEW INFORMATION</th>
                        <th>COMMAND</th>
                    </tr>
                </thead>
            <!-- PHP CODE TO FETCH DATA FROM ROWS-->
                <?php
                    $sql = "SELECT * FROM tblstudents WHERE statusID = '0'";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) 
                    {
                        while($row = $result->fetch_assoc()) 
                        {
                 ?>
                            <tr>
                                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
                                    <td>
                                        <p><?php 
                                            //KUKUNIN YUNG FULLNAME SA TBLACCOUNTS
                                            $accountID = $row['accountID'];
                                            $getFullname = "SELECT * FROM tblaccounts WHERE accountID = $accountID";
                                            $sqlGetName = mysqli_query($conn, $getFullname);

                                            while($name_result = mysqli_fetch_array($sqlGetName)) {
                                            ?>
                                            <p><?php echo $name_result['lastname'].", ".$name_result['firstname']." ".$name_result['middlename']?></p>
                                            <?php
                                            }
                                            ?></p>
                                    </td>
                                    <td>
                                        <p><?=$row['email']?></p>
                                    </td>
                                    <td>
                                        <p><?=$row['dateOfEnrollment']?></p>
                                    </td>
                                    <td>
                                        <button id="myBtn" class="myBtn" type="submit" name="myBtn" value="<?=$row['accountID']?>" >View Details</button> 
                                    </td>
                                    <td>
                                        <button type="submit" name="btncmdAccept" id="btncmdAccept" value="<?=$row['accountID']?>">Accept</button>
                                        <button type="submit" name="btnreject" id="btnreject" value="<?=$row['accountID']?>">Reject</button>
                                    </td>
                                </form>
                            </tr>
            <?php
                        }//end of while loop
                     }//if ($result->num_rows > 0) end bracket
                // $conn->close();
                $preID ="";
                $max = "";
                if(isset($_POST['btncmdAccept'])){
                    $preID  = $_POST['btncmdAccept'];
                    $isOldStudent = "SELECT * FROM tblaccounts WHERE accountID=$preID";
                    $sqlIsOldStudent = mysqli_query($conn, $isOldStudent);
                    $results = mysqli_fetch_array($sqlIsOldStudent);
                    if ($results['studentNumber'] != 0){
                        $studentNumber = $results['studentNumber'];
                        insertSql($studentNumber, $preID);
                    } else {
                    $yearNow = date("Y");
                   // echo $_POST['btncmdAccept'];
                    $maxStudentNum = "SELECT RIGHT(max(studentNumber) ,6) as mnum FROM tblstudents";
                    $result = $conn->query($maxStudentNum);
                    if(mysqli_num_rows($result) > 0){
                        while($row = $result->fetch_assoc()) {
                            if($row['mnum'] == NULL){
                                $max =  $row['mnum'];
                                $maxinc = $max+1;
                                $format = str_pad($maxinc,6,"0",STR_PAD_LEFT);
                                $studentNum = $yearNow.$format;
                                insertSql($studentNum,$preID);
                                //echo "<script>alert($studentNum)</script>";
                                // DO SQL INSERT
                            }else{
                                $maxyear = "SELECT LEFT(max(studentNumber) ,4) as myear, RIGHT(max(studentNumber) ,4) as maxnum FROM tblstudents";
                                $result = $conn->query($maxyear);
                                if(mysqli_num_rows($result) > 0){
                                    while($row = $result->fetch_assoc()) {
                                        if($yearNow == $row['myear']){
                                            $max =  $row['maxnum'];
                                            $yearNow = date("Y");
                                            $maxinc = $max+1;
                                            $format = str_pad($maxinc,4,"0",STR_PAD_LEFT);
                                            $studentNum = $yearNow.$format;
                                            //echo "<script>alert($studentNum)</script>";
                                            // DO SQL INSERT   
                                            insertSql($studentNum,$preID); 
                                        }else{
                                            $max =  $row['maxnum'];
                                            $yearNow = date("Y");
                                            $maxinc = $max+1;
                                            $format = str_pad($maxinc,4,"0",STR_PAD_LEFT);
                                            $studentNum = $yearNow.$format;
                                            //echo "<script>alert($studentNum)</script>";
                                            // DO SQL INSERT
                                            insertSql($studentNum,$preID);
                                        }
                                    }
                                }
                            }
                        }
                    }

                    }
                }


                if(isset($_POST['btnreject'])){
                    $preID  = $_POST['btnreject'];
                    //echo $preID;
                    //$deleteinfo = "delete from tblstudentinfo where accountID = '$preID'";
                    $rejectinfo = "update tblstudentinfo set statusID='3' where accountID = '$preID'";
                    $resultrejectinfo = $conn->query($rejectinfo);
                    if($resultrejectinfo){
                        echo "deleted";
                        echo "<script>window.location.href='Pre-Enrolled.php';</script>";
                    }else{
                        echo "invalid";
                    }
                }


                function insertSql($studentNum,$preID){
                    //echo $preID;
                    include('dbconnection.php');
                    $update = "update tblstudents set statusID='1' where accountID = '$preID'";
                    $resultupdate = $conn->query($update);
                    if($resultupdate){
                        $datenow = date('Y-m-d');
                        //echo $datenow  ;
                        // $sqlinsert = "INSERT INTO tblstudents(studentNumber,dateOfEnrollment,accountID) VALUE('$studentNum','$datenow',(SELECT accountID   FROM tblaccounts WHERE accountID = '$preID'))";
                        
                        //kukunin yung courseID para makuha yung mga subject at ienroll
                        
                        $getCourseID = "SELECT * FROM tblstudents WHERE accountID = $preID";
                        $sqlGetCourseID = $conn->query($getCourseID);
                        if($sqlGetCourseID){
                            if(mysqli_num_rows($sqlGetCourseID) > 0){
                                while($courseID = $sqlGetCourseID->fetch_assoc()) {
                                $data_courseID = $courseID['courseID'];
                                $studentType = $courseID['studentType'];
                                
                                if($studentType = "REGULAR"){
                                $getSubjects = "SELECT * FROM tblsubjects WHERE courseID = $data_courseID";
                                $sqlGetSubjects = mysqli_query($conn, $getSubjects);
                                while($subjects = mysqli_fetch_array($sqlGetSubjects)){
                                    $subjectCode = $subjects['subjectCode'];

                                    $enrollSubjects = "INSERT INTO tblenrolledsubjects(studentNumber, subjectCode) VALUES($studentNum, '$subjectCode')";
                                    $sqlEnrollSubjects = mysqli_query($conn, $enrollSubjects);
                                }
                                } else if ($studentType = "IRREGULAR"){
                                    $getSubjects = "SELECT * FROM tblbacksubjects WHERE accountID = $preID AND (status = 'Required' OR status = 'Taken')";
                                    $sqlGetSubjects = mysqli_query($conn, $getSubjects);
                                    while($subjects = mysqli_fetch_array($sqlGetSubjects)){
                                        $subjectCode = $subjects['subjectCode'];

                                        $enrollSubjects = "INSERT INTO tblenrolledsubjects(studentNumber, subjectCode) VALUES($studentNum, '$subjectCode')";
                                        $sqlEnrollSubjects = mysqli_query($conn, $enrollSubjects);
                                    }

                                }
                                }
                            } 
                        }


                        $sqlinsert = "UPDATE tblstudents SET dateOfEnrollment = '$datenow', studentNumber = $studentNum WHERE accountID = '$preID'";
                        $resultsqlinsert = $conn->query($sqlinsert);

                        if($sqlinsert){
                            echo "<script>window.location.href='Pre-Enrolled.php';</script>";
                        }else{
                            echo "<script>alert('Failed to Insert Data')</script>";
                            echo "<script>window.location.href='Pre-Enrolled.php';</script>";
                        }
                    }else{
                        echo "<script>alert('UNABLE TO ACCEPT')</script>";
                    }
                    
                }
                $conn->close();
            ?>
            </table>
        </div>


<script>
var datamap = new Map([
            [document.getElementsByClassName("myBtn"), document.getElementById("myModal")]       
  ]); //getElementsByClassName for multiple buttons with the same class name (looping)

        datamap.forEach((value, key) => {
            doModal(key, value);
        });

        function doModal(anchor, popupbox) {

            // Get the <span> element that closes the modal
            var span = popupbox.getElementsByClassName("close")[0];

    //loop thhrough each button with same classname and give them function only applicable if button is not in <form> tag if button not inside form tag then use this button functions

            // anchor.addEventListener("click", function (event) {
            //     popupbox.style.display = "block";
            // });

        
            // for (var i = 0; i < anchor.length; i++) {
            //     anchor[i].addEventListener("submit", function (event) {
            //         popupbox.style.display = "block";
            //     });
            // }

            span.addEventListener("click", function (event) {
                popupbox.style.display = "none";
            });

            window.addEventListener("click", function (event) {
                if (event.target == popupbox) {
                    popupbox.style.display = "none";
                }
            });
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
