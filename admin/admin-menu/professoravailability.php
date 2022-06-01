<?php 
    session_start();
    include('dbconnection.php');
    $datenow = date('Y-m-d');
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <title>Professor Availability | Enrollment System </title>
      <link rel="icon" type="image/x-icon" href="logo-icon.png">
      <link rel="stylesheet" href="Enrolled.css?<?php echo time();?>">
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
            <h1>PROFESSOR AVAILABILITY</h1>
            <div class="search">
                <div class="search-box">
                    <input type="text" id="search" placeholder="Type here...">
                    <button for="check" class="icon"><i class="fas fa-search"></i></button>
                </div>
            </div>
            
<div class="custom-select">
<h4 id="filter"> FILTER BY : </h4>
    <select id="day" name="day">
        <option selected hidden diabled value="">Day</option>
        <option value="MONDAY">MONDAY</option>
        <option value="TUESDAY">TUESDAY</option>
        <option value="WEDNESDAY">WEDNESDAY</option>
        <option value="THURSDAY">THURSDAY</option>
        <option value="FRIDAY">FRIDAY</option>
        <option value="SATURDAY">SATURDAY</option>
        <option value="SUNDAY">SUNDAY</option>
    </select>
    <select id="subject" name="subject">
  <option selected hidden diabled>Subject</option>
    <?php
        $query = "SELECT DISTINCT subjectCode, subjectDescription FROM tblsubjects";
        $results = mysqli_query($conn, $query);
        if(mysqli_num_rows($results) > 0){
            while($rows = mysqli_fetch_array($results)){
            ?>
                <option value="<?php echo $rows['subjectCode']?>"><?php echo $rows['subjectCode'].'-'.$rows['subjectDescription']?></option>
            <?php
            }
        }
    ?>
    </select>
    <h4>Start Time</h4>
    <input type="time" id="startTime" name="startTime">
    <h4>End Time</h4>
    <input type="time" id="endTime" name="endTime">
    <input type="button" name="filter" id="filterdata" value="Filter Data">
    <a href="professoravailability.php"><input type="button" value="Reset"></a>
</div>
<div id="searchresult"> </div>
    <div class="enrolled" id="enrolledtable">
        <table id="enrolled" class="content-table">
            <thead>
                <tr>
                    <th>ACCOUNT ID</th>
                    <th>NAME</th>
                    <th>DAY</th>
                    <th>SUBJECT</th>
                    <th>TIME</th>
                </tr>
            </thead>
            <?php
                $query = "SELECT * FROM tblprofessoravailability";
                $result = mysqli_query($conn, $query);
                if(mysqli_num_rows($result) > 0){
                    while($row = mysqli_fetch_array($result)){
                        ?>
                    <tr>
                        <td><?php echo $row['accountID']?></td>
                        <td><?php
                            $accountID = $row['accountID'];
                            $searchname = "SELECT * FROM tblaccounts WHERE accountID = $accountID";
                            $resultsname = mysqli_query($conn, $searchname);
                            if(mysqli_num_rows($resultsname) > 0){
                              $row1 = mysqli_fetch_array($resultsname);
                              echo $row1['lastname'].', '.$row1['firstname'].' '.$row1['middlename'];
                            }
                        ?></td>
                        <td><?php echo $row['day']?></td>
                        <td><?php echo $row['subject']?></td>
                        <td><?php echo date('h:i A', strtotime($row['startTime'])).'-'.date('h:i A', strtotime($row['endTime']))?></td>
                    </tr>
                        <?php
                    }
                }
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
                            url: "professoravailabilitylivesearch.php",
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
                    var day = $("#day").val();
                    var startTime = $("#startTime").val();
                    var endTime = $("#endTime").val();
                    var subject = $("#subject").val();
                    alert(day + startTime + endTime + subject);
                    $("#searchresult").show();
                    $("#enrolled").hide();
                    $("#enrolledtable").hide();
                    $.ajax({
                        url: "professoravailabilitylivesearch.php",
                        method: "POST",
                        data: {day:day, startTime:startTime, endTime:endTime, subject:subject},

                        success:function(data){
                            $("#searchresult").html(data);
                        }
                    })
                });

            });
        </script>
   </body>
</html>