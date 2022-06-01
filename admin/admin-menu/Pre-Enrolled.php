<?php 
    session_start();
    include('dbconnection.php');
    $datenow = date('Y-m-d');
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <title>Pre-Enrolled Students | Enrollment System </title>
      <link rel="icon" type="image/x-icon" href="logo-icon.png">
      <link rel="stylesheet" href="PRE-ENROLLED.css?<?php echo time();?>">
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
                    <input type="text" id="search" placeholder="Type here...">
                    <button for="check" class="icon"><i class="fas fa-search"></i></button>
                </div>
            </div>
            
<div class="custom-select">
<h4 id="filter"> FILTER BY : </h4>
  <select id="course">
    <option value="">Course:</option>
    <option value="BSCS">BSCS</option>
    <option value="BSIT">BSIT</option>
    <option value="BSEMC">BSEMC</option>
    <option value="BSIS">BSIS</option>
  </select>
    <select id="year">
    <option value="">Year:</option>
    <option value="1">1st</option>
    <option value="2">2nd</option>
    <option value="3">3rd</option>
    <option value="4">4th</option>
    
  </select>
    <input type="date" id="date">
    <input type="button" name="filter" id="filterdata" value="Filter Data">
    <a href="Pre-Enrolled.php"><input type="button" value="Reset"></a>
</div>
<div id="searchresult"></div>
    <div id="divpreenrolled"class="preenrolled">
            <table id="preenrolled" class="content-table">
                <thead>
                    <tr>
                        <th>STUDENT NUMBER</th>
                        <th>NAME</th>
                        <th>COURSE AND YEAR</th>
                        <th>DATE OF<br>APPLICATION</th>
                        <th>VIEW<br>INFORMATION</th>
                        <th>PAYMENT<br>INFORMATION</th>
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
                                
                                    <td>
                                        <p><?=$row['studentNumber']?></p>
                                    </td>
                                    <td>
                                        <p><?php 
                                            //KUKUNIN YUNG FULLNAME SA TBLACCOUNTS
                                            $studentNumber = $row['studentNumber'];
                                            $getFullname = "SELECT * FROM tblstudentaccounts WHERE studentNumber = $studentNumber";
                                            $sqlGetName = mysqli_query($conn, $getFullname);

                                            while($name_result = mysqli_fetch_array($sqlGetName)) {
                                            ?>
                                            <p><?php echo $name_result['lastname'].", ".$name_result['firstname']." ".$name_result['middlename']?></p>
                                            <?php
                                            }
                                            ?></p>
                                    </td>
                                    <td>
                                    <p><?php 
                                        $courseID = $row['courseID'];
                                        $query1 = "SELECT * FROM tblcoursedetails WHERE courseID = $courseID";
                                        $result1 = mysqli_query($conn, $query1);
                                        if(mysqli_num_rows($result1) > 0){
                                            $row1 = mysqli_fetch_array($result1);
                                            echo $row1['courseAbbr'].' '.$row1['year'];
                                        }
                                        ?></p>
                                    </td>
                                    <td>
                                        <p><?=$row['dateOfEnrollment']?></p>
                                    </td>
                                    <td>
                                    <form method="POST" action="seedetailspreenrolled.php">
                                        <button type="submit" name="viewDetails" value="<?=$row['studentNumber']?>" >View Details</button>
                                        </form>
                                    </td>
                                    </form>
                                    <!-- <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" > -->
                                    <td>
                                        <?php 
                                            $studentNumber = $row['studentNumber'];
                                            $query = "SELECT * FROM tblstudenttransactions WHERE studentNumber = $studentNumber";
                                            $sqlquery = mysqli_query($conn, $query);
                                            if(mysqli_num_rows($sqlquery) > 0){
                                                ?>
                                                <form method="POST" action="updatestudenttransaction.php">
                                                    <input type="hidden" name = "studentNumber" value="<?php echo $row['studentNumber']?>" >
                                                    <input type ="submit" name="view" value="Update/View Transaction" class="okay">
                                                </form>
                                                <?php
                                            } else {
                                                ?>
                                                <form method="POST" action="studenttransaction.php">
                                                <input type="hidden" name = "studentNumber" value="<?php echo $row['studentNumber']?>">
                                                <input type ="submit" name="add" value="Add Transaction" class="pending">
                                                </form>
                                                <?php
                                            }
                                        ?>
                                        
                                    </td>
                                    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?> " onsubmit="return confirm('Do you want to accept/reject this?')">
                                    <td>
                                        <button type="submit" name="btncmdAccept" id="btncmdAccept" value="<?=$row['studentNumber']?>" class="accept">Accept</button>
                                        <button type="submit" name="btnreject" id="btnreject" value="<?=$row['studentNumber']?>" class="reject">Reject</button>
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
                    $studentNumber = $_POST['btncmdAccept'];
                    $query = "SELECT * FROM tblstudenttransactions WHERE studentNumber = $studentNumber";
                    $sqlquery = mysqli_query($conn, $query);
                    if(mysqli_num_rows($sqlquery) > 0){
                        insertSql($studentNumber);

                    } else {
                        echo '<script>alert("Student does not have payment yet. Enrollment failed.")</script>';         
                    }
                    
                //     $preID  = $_POST['btncmdAccept'];
                //     $isOldStudent = "SELECT * FROM tblaccounts WHERE accountID=$preID";
                //     $sqlIsOldStudent = mysqli_query($conn, $isOldStudent);
                //     $results = mysqli_fetch_array($sqlIsOldStudent);
                //     if ($results['studentNumber'] != 0){
                //         $studentNumber = $results['studentNumber'];
                //         insertSql($studentNumber, $preID);
                //     } else {
                //     $yearNow = date("Y");
                //    // echo $_POST['btncmdAccept'];
                //     $maxStudentNum = "SELECT RIGHT(max(studentNumber) ,6) as mnum FROM tblstudents";
                //     $result = $conn->query($maxStudentNum);
                //     if(mysqli_num_rows($result) > 0){
                //         while($row = $result->fetch_assoc()) {
                //             if($row['mnum'] == NULL){
                //                 $max =  $row['mnum'];
                //                 $maxinc = $max+1;
                //                 $format = str_pad($maxinc,6,"0",STR_PAD_LEFT);
                //                 $studentNum = $yearNow.$format;
                //                 insertSql($studentNum,$preID);
                //                 //echo "<script>alert($studentNum)</script>";
                //                 // DO SQL INSERT
                //             }else{
                //                 $maxyear = "SELECT LEFT(max(studentNumber) ,4) as myear, RIGHT(max(studentNumber) ,4) as maxnum FROM tblstudents";
                //                 $result = $conn->query($maxyear);
                //                 if(mysqli_num_rows($result) > 0){
                //                     while($row = $result->fetch_assoc()) {
                //                         if($yearNow == $row['myear']){
                //                             $max =  $row['maxnum'];
                //                             $yearNow = date("Y");
                //                             $maxinc = $max+1;
                //                             $format = str_pad($maxinc,4,"0",STR_PAD_LEFT);
                //                             $studentNum = $yearNow.$format;
                //                             //echo "<script>alert($studentNum)</script>";
                //                             // DO SQL INSERT   
                //                             insertSql($studentNum,$preID); 
                //                         }else{
                //                             $max =  $row['maxnum'];
                //                             $yearNow = date("Y");
                //                             $maxinc = $max+1;
                //                             $format = str_pad($maxinc,4,"0",STR_PAD_LEFT);
                //                             $studentNum = $yearNow.$format;
                //                             //echo "<script>alert($studentNum)</script>";
                //                             // DO SQL INSERT
                //                             insertSql($studentNum,$preID);
                //                         }
                //                     }
                //                 }
                //             }
                //         }
                //     }

                //     }
                }


                if(isset($_POST['btnreject'])){
                    $studentNumber  = $_POST['btnreject'];
                    $courseDetails;
                    $sql1 = "SELECT * FROM tblstudents WHERE studentNumber = $studentNumber";
                    $result = mysqli_query($conn, $sql1);
                    while($row = mysqli_fetch_array($result)){
                        $courseDetails = $row['courseID'];
                    }
                    //echo $preID;
                    //$deleteinfo = "delete from tblstudentinfo where accountID = '$preID'";
                    $rejectinfo = "update tblstudents set statusID='3' where studentNumber = $studentNumber";
                    $resultrejectinfo = $conn->query($rejectinfo);
                    if($resultrejectinfo){
                        $querydeletesub = "DELETE FROM tblenrolledsubjects WHERE studentNumber = $studentNumber AND courseID = $courseDetails";
                        $resultdeletesub = mysqli_query($conn, $querydeletesub);

                         //activity log
                         $name = $_SESSION['NAME'];
                         $activity = 'REJECTED STUDENT '.$studentNumber;
                         $activityquery = "INSERT INTO tblactivitylog(activity, incharge) VALUES('$activity', '$name')";
                         $activityresult = mysqli_query($conn, $activityquery);

                        echo "<script>window.location.href='Pre-Enrolled.php';</script>";
                    }else{
                        echo "invalid";
                    }
                }


                function insertSql($studentNum){
                    //echo $preID;
                    include('dbconnection.php');
                        $datenow = date('Y-m-d');
                        $getCourseID = "SELECT * FROM tblstudents WHERE studentNumber = $studentNum";
                        $sqlGetCourseID = mysqli_query($conn, $getCourseID);
                        if(mysqli_num_rows($sqlGetCourseID) > 0){
                            $courseID = mysqli_fetch_array($sqlGetCourseID);
                            
                            $data_courseID = $courseID['courseID'];
                            $studentType = $courseID['studentType'];

                            $availablestudents = 0;
                            $tries = 3;
                            while(($availablestudents <= 0) AND ($tries > 0)){
                                $sectioning = "SELECT * FROM tblcoursedetails WHERE courseID = $data_courseID";
                                $sqlsectioning = mysqli_query($conn, $sectioning);
                                if(mysqli_num_rows($sqlsectioning) > 0){
                                    $rows = mysqli_fetch_array($sqlsectioning);
                                    $availableslots = $rows['availableslots'];
                                    if($availableslots > 0){
                                        $availablestudents = $availableslots;
                                    } else {
                                        $data_courseID = $data_courseID + 1;
                                        $tries = $tries - 1;
                                    }
                                }
                            }
                            if($tries <= 0){
                                echo "<script>alert('No available sections')</script>";
                            } else {
                                $updateavailableslots = "UPDATE tblcoursedetails SET availableslots = ($availablestudents-1) WHERE courseID = $data_courseID";
                                $sqlupdate1 = mysqli_query($conn, $updateavailableslots);
                                if($sqlupdate1){
                                    echo 'yey';
                                }
                                $updatecouseID = "UPDATE tblstudents SET courseID = $data_courseID WHERE studentNumber = $studentNum";
                                $sqlupdate = mysqli_query($conn, $updatecouseID);
                                if($sqlupdate){
                                    echo 'yey';
                                }

                                // if($studentType == "REGULAR"){
                                //     $getSubjects = "SELECT * FROM tblsubjects WHERE courseID = $data_courseID";
                                //     $sqlGetSubjects = mysqli_query($conn, $getSubjects);
                                //     if(mysqli_num_rows($sqlGetSubjects) > 0){
                                //         while($subjects = mysqli_fetch_array($sqlGetSubjects)){
                                //             $subjectCode = $subjects['subjectCode'];
                                //             $enrollSubjects = "INSERT INTO tblenrolledsubjects(studentNumber, subjectCode) VALUES($studentNum, '$subjectCode')";
                                //             $sqlEnrollSubjects = mysqli_query($conn, $enrollSubjects);
                                //         }
                                //     }
                                // }else
                                // if ($studentType = "IRREGULAR"){
                                //     $getSubjects = "SELECT * FROM tblbacksubjects WHERE studentNumber = $studentNum AND (status = 'Required' OR status = 'Taken')";
                                //     $sqlGetSubjects = mysqli_query($conn, $getSubjects);
                                //     if(mysqli_num_rows($sqlGetSubjects) > 0){
                                //         while($subjects = mysqli_fetch_array($sqlGetSubjects)){
                                //             $subjectCode = $subjects['subjectCode'];
                                //             $enrollSubjects = "INSERT INTO tblenrolledsubjects(studentNumber, subjectCode) VALUES($studentNum, '$subjectCode')";
                                //             $sqlEnrollSubjects = mysqli_query($conn, $enrollSubjects);
                                //         }
                                //     }
                
                                // }

                                $sqlinsert = "UPDATE tblstudents SET dateOfEnrollment = '$datenow', statusID = 1 WHERE studentNumber = $studentNum";
                                $updatedate = mysqli_query($conn, $sqlinsert);
                                if($updatedate){

                                    //activity log
                                    $name = $_SESSION['NAME'];
                                    $activity = 'ACCEPTED STUDENT '.$studentNum;
                                    $activityquery = "INSERT INTO tblactivitylog(activity, incharge) VALUES('$activity', '$name')";
                                    $activityresult = mysqli_query($conn, $activityquery);

                                    echo "<script>window.location.href='Pre-Enrolled.php';</script>";
                                }else {
                                    echo "<script>alert('Failed to Insert Data')</script>";
                                    echo "<script>window.location.href='Pre-Enrolled.php';</script>";
                                }
                            }
                        }
                    // $resultupdate = $conn->query($update);
                    // if($resultupdate){
                    //     $datenow = date('Y-m-d');
                    //     //echo $datenow  ;
                    //     // $sqlinsert = "INSERT INTO tblstudents(studentNumber,dateOfEnrollment,accountID) VALUE('$studentNum','$datenow',(SELECT accountID   FROM tblaccounts WHERE accountID = '$preID'))";
                        
                    //     //kukunin yung courseID para makuha yung mga subject at ienroll
                    //     $getCourseID = "SELECT * FROM tblstudents WHERE studentNumber = $studentNum";
                    //     $sqlGetCourseID = $conn->query($getCourseID);
                    //     if($sqlGetCourseID){
                    //         if(mysqli_num_rows($sqlGetCourseID) > 0){
                    //             while($courseID = $sqlGetCourseID->fetch_assoc()) {
                    //             $data_courseID = $courseID['courseID'];
                    //             $studentType = $courseID['studentType'];
                                
                    //             if($studentType = "REGULAR"){
                    //             $getSubjects = "SELECT * FROM tblsubjects WHERE courseID = $data_courseID";
                    //             $sqlGetSubjects = mysqli_query($conn, $getSubjects);
                    //             while($subjects = mysqli_fetch_array($sqlGetSubjects)){
                    //                 $subjectCode = $subjects['subjectCode'];

                    //                 $enrollSubjects = "INSERT INTO tblenrolledsubjects(studentNumber, subjectCode) VALUES($studentNum, '$subjectCode')";
                    //                 $sqlEnrollSubjects = mysqli_query($conn, $enrollSubjects);
                    //             }
                    //             } else if ($studentType = "IRREGULAR"){
                    //                 $getSubjects = "SELECT * FROM tblbacksubjects WHERE studentNumber = $studentNum AND (status = 'Required' OR status = 'Taken')";
                    //                 $sqlGetSubjects = mysqli_query($conn, $getSubjects);
                    //                 while($subjects = mysqli_fetch_array($sqlGetSubjects)){
                    //                     $subjectCode = $subjects['subjectCode'];

                    //                     $enrollSubjects = "INSERT INTO tblenrolledsubjects(studentNumber, subjectCode) VALUES($studentNum, '$subjectCode')";
                    //                     $sqlEnrollSubjects = mysqli_query($conn, $enrollSubjects);
                    //                 }

                    //             }
                    //             }
                    //         } 
                    //     }


                    //     $sqlinsert = "UPDATE tblstudents SET dateOfEnrollment = '$datenow' WHERE studentNumber = $studentNum";
                    //     $resultsqlinsert = $conn->query($sqlinsert);

                    //     if($sqlinsert){
                    //         //echo "<script>window.location.href='Pre-Enrolled.php';</script>";
                    //     }else{
                    //         echo "<script>alert('Failed to Insert Data')</script>";
                    //         //echo "<script>window.location.href='Pre-Enrolled.php';</script>";
                    //     }
                    // }else{
                    //     //echo "<script>alert('UNABLE TO ACCEPT')</script>";
                    // }
                    
                }
                // $conn->close();
            ?>
            </table>
            </div>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                //$("#search").keyup(function(){
                $("#search").keypress(function(e){
                    if(e.which == 13){
                        var input = $(this).val();
                        //alert(input);
                        if(input != null){
                            $("#searchresult").show();
                            $("#preenrolled").hide();
                            $("#divpreenrolled").hide();
                            $.ajax({
                                url: "preenrolledlivesearch.php",
                                method: "POST",
                                data: {input:input},

                                success:function(data){
                                    $("#searchresult").html(data);
                                }
                            })
                        } else {
                            $("#searchresult").hide();
                            $("#preenrolled").show();
                            //$("#accountstable").show();
                        }
                    }
                });
                $("#filterdata").click(function(){
                    var course = $("#course").val();
                    var year = $("#year").val();
                    var date = $("#date").val();
                    alert(course + year + date);
                    $("#searchresult").show();
                    $("#preenrolled").hide();
                    $("#divpreenrolled").hide();
                    $.ajax({
                        url: "preenrolledlivesearch.php",
                        method: "POST",
                        data: {course:course, year:year, date:date},

                        success:function(data){
                            $("#searchresult").html(data);
                        }
                    })
                    // var input = $(this).val();
                    // //alert(input);
                    // if(input != null){
                    //     $("#searchresult").show();
                    //     $("#subjectstable").hide();
                    //     //$("#pagination").hide();
                    //     $.ajax({
                    //         url: "livesearch.php",
                    //         method: "POST",
                    //         data: {input:input},

                    //         success:function(data){
                    //             $("#searchresult").html(data);
                    //         }
                    //     })
                    // } else {
                    //     $("#searchresult").hide();
                    //     $("#myTable").show();
                    //     //$("#pagination").show();
                    // }
                });
            });
        </script>
   </body>
</html>
