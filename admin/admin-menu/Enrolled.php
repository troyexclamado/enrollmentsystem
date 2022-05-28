<?php 
    session_start();
    include('dbconnection.php');
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <title>Enrollment System </title>
      <link rel="stylesheet" href="ENROLLED.css?<?php echo time();?>">
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
            <?php if(!empty($_SESSION['POSITION']) && ($_SESSION['POSITION'] == "PROFESSOR")){ ?> 
            <li><a href="schedule.php">SCHEDULE <img src="schedule.png" alt="" style="width: 20px;height:20px;"></a></li>
            <?php }?>
            <li><a href="studentaccounts.php">STUDENT ACCOUNTS<img src="crse.png" alt="" style="width: 20px;height:20px;"></a></a></li>
            <li><a href="activitylog.php">ACTIVITY LOG <img src="actlog.png" alt="" style="width: 20px;height:20px;"></a></li>
            <li><a href="logout.php">LOG OUT <img src="actlog.png" alt="" style="width: 20px;height:20px;"></a></li>
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
                        $sql = "SELECT * FROM tblstudents WHERE statusID = '1'";
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
                                                        ?></p></td>
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
            <h1> ENROLLED STUDENTS</h1>
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
    <select id="date">
    <option value="">Date of Enrollment:</option>
    <option value="1">Ascending</option>
    <option value="2">Descending</option>
  </select>
    <input type="button" name="filter" id="filterdata" value="Filter Data">
    <a href="Enrolled.php"><input type="button" value="Reset"></a>
</div>
<div id="searchresult"> </div>
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
                    $withstudentnum = "SELECT * FROM tblstudents WHERE statusID = '1'";
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
                        }//end of while loop
                     }//if ($result->num_rows > 0) end bracket
                // $conn->close();
                
                // $preID ="";
                // $max = "";
                // if(isset($_POST['btncmdAccept'])){
                //     $preID  = $_POST['btncmdAccept'];
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
                //                 $maxyear = "SELECT LEFT(max(studentNumber) ,4) as myear, RIGHT(max(studentNumber) ,6) as maxnum FROM tblstudents";
                //                 $result = $conn->query($maxyear);
                //                 if(mysqli_num_rows($result) > 0){
                //                     while($row = $result->fetch_assoc()) {
                //                         if($yearNow == $row['myear']){
                //                             $max =  $row['maxnum'];
                //                             $yearNow = date("Y");
                //                             $maxinc = $max+1;
                //                             $format = str_pad($maxinc,6,"0",STR_PAD_LEFT);
                //                             $studentNum = $yearNow.$format;
                //                             //echo "<script>alert($studentNum)</script>";
                //                             // DO SQL INSERT   
                //                             insertSql($studentNum,$preID); 
                //                         }else{
                //                             $max =  $row['maxnum'];
                //                             $yearNow = date("Y");
                //                             $maxinc = $max+1;
                //                             $format = str_pad($maxinc,6,"0",STR_PAD_LEFT);
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
                // }


                // if(isset($_POST['btnreject'])){
                //     $preID  = $_POST['btnreject'];
                //     //echo $preID;
                //     $deleteinfo = "delete from tblstudentinfo where accountID = '$preID'";
                //     $resultdeleteinfo = $conn->query($deleteinfo);
                //     if($resultdeleteinfo){
                //         echo "deleted";
                //         echo "<script>window.location.href='Pre-Enrolled.php';</script>";
                //     }else{
                //         echo "invalid";
                //     }
                // }


                // function insertSql($studentNum,$preID){
                //     //echo $preID;
                //     include('dbconnection.php');
                //     $update = "update tblstudentinfo set statusID='1' where accountID = '$preID'";
                //     $resultupdate = $conn->query($update);
                //     if($resultupdate){
                //         $datenow = date('Y-m-d');
                //         //echo $datenow  ;
                //         $sqlinsert = "INSERT INTO tblstudents(studentNumber,dateOfEnrollment,accountID) VALUE('$studentNum','$datenow',(SELECT accountID   FROM tblaccounts WHERE accountID = '$preID'))";
                //         $resultsqlinsert = $conn->query($sqlinsert);
                //         if($sqlinsert){
                //             echo "<script>window.location.href='Pre-Enrolled.php';</script>";
                //         }else{
                //             echo "<script>alert('Failed to Insert Data')</script>";
                //             echo "<script>window.location.href='Pre-Enrolled.php';</script>";
                //         }
                //     }else{
                //         echo "<script>alert('UNABLE TO ACCEPT')</script>";
                //     }
                    
                // }
                $conn->close();
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
                $("#search").keyup(function(){
                    var input = $(this).val();
                    //alert(input);
                    if(input != null){
                        $("#searchresult").show();
                        $("#enrolled").hide();
                        $("#enrolledtable").hide();
                        $.ajax({
                            url: "enrolledlivesearch.php",
                            method: "POST",
                            data: {input:input},

                            success:function(data){
                                $("#searchresult").html(data);
                            }
                        })
                    } else {
                        $("#searchresult").hide();
                        $("#enrolled").show();
                        $("#enrolledtable").show();
                        //$("#accountstable").show();
                    }
                });
                $("#filterdata").click(function(){
                    var course = $("#course").val();
                    var year = $("#year").val();
                    var date = $("#date").val();
                    alert(course + year + date);
                    $("#searchresult").show();
                    $("#enrolled").hide();
                    $("#enrolledtable").hide();
                    $.ajax({
                        url: "enrolledlivesearch.php",
                        method: "POST",
                        data: {course:course, year:year, date:date},

                        success:function(data){
                            $("#searchresult").html(data);
                        }
                    })
                });

            });
        </script>
   </body>
</html>