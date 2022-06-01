<?php 
    session_start();
    include('dbconnection.php');
    $datenow = date('Y-m-d');
    $query = "SELECT * FROM tblsubjects ORDER BY courseID ASC";
    $result = mysqli_query($conn, $query);
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <title>Subjects | Enrollment System </title>
      <link rel="icon" type="image/x-icon" href="logo-icon.png">
      
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
      <link rel="stylesheet" href="Subjects.css?<?php echo time();?>">
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
    <h1>SUBJECTS</h1>
    <a href="addsub.php" class="sub">Add Subject</a>
    <div class="search">
        <div class="search-box">
          <input type="text" id = "search" autocomplete="off" placeholder="Type here...">
          <button for="check" class="icon">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    <div class="custom-select">
    <h4 id="filter"> FILTER BY : </h4>
      <select id="course-drop-down" name="course">
        <option value="">Course:</option>
        <option value="BSCS">BSCS</option>
        <option value="BSIT">BSIT</option>
        <option value="BSEMC">BSEMC</option>
        <option value="BSIS">BSIS</option>
      </select>
        <select id="year-drop-down" name="year">
        <option value="">Year:</option>
        <option value="1">1st</option>
        <option value="2">2nd</option>
        <option value="3">3rd</option>
        <option value="4">4th</option>
        
      </select>
        <select id="semester-drop-down" name="semester">
        <option value="">Semester:</option>
        <option value="1">1st</option>
        <option value="2">2nd</option>
      </select>
      <input type="button" name="filter" id="filterdata" value="Filter Data">
      <a href="Subjects.php"><input type="button" value="Reset"></a>
    </div>

    <div id="searchresult">
    </div>
<div id="subjectstable" class="subjectstable">
<table id="myTable" class="content-table">
    <thead>
        <tr>
            <th>SUBJECT CODE</th>
            <th>SUBJECT DESCRIPTION</th>
            <th>SUBJECT UNITS</th>
            <th>COURSE, YEAR AND SECTION</th>
            <th>ACTIONS</th>
        </tr>
    </thead>
        <?php
            while($subjects = mysqli_fetch_array($result)){
            $courseID = $subjects['courseID'];
        ?>
        <tr>
            <td><?php echo $subjects['subjectCode'];?></td>
            <td><?php echo $subjects['subjectDescription'];?></td>
            <td><?php echo $subjects['subjectUnits'];?></td>
            <td>
                <?php
                    $getCourseDetails = "SELECT * FROM tblcoursedetails WHERE courseID = $courseID";
                    $sqlGetCourseDetails = mysqli_query($conn, $getCourseDetails);
                    while($details = mysqli_fetch_array($sqlGetCourseDetails)){
                        echo $details['courseDescription']." ".$details['year'].$details['section'];
                    }        
                ?>
            </td>
            <td>
            <form method="POST" action="editsubject.php" onsubmit="return confirm('Do you want to edit this?')">
                <input type="hidden" name="subjectID" value ="<?php echo $subjects['id']?>">
                <button class="accept" type="submit" name="edit">EDIT</button>
            </form>
            <form method="POST" action="editsubject.php" onsubmit="return confirm('Are you sure you want to delete this?')">
                <input type="hidden" name="subjectID" value ="<?php echo $subjects['id']?>">
                <button class="reject" type="submit" name="delete" id="myBtn1">DELETE</button>
            </form>
            

                <!-- The Modal -->
                <div id="myModal" class="modal">
                    <!-- Modal content -->
                    <div class="modal-content">
                        <div class="modal-header">
                            <span class="close">&times;</span>
                            <h2>Button 1 Clicked</h2>
                        </div>
                        <div class="modal-body">
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusamus aspernatur perferendis ad sunt.
                            Eius, possimus? Quae at eum repudiandae obcaecati vitae accusantium, perferendis sapiente
                            temporibus, necessitatibus voluptatem iste cumque et?</p>
                        </div>
                        <div class="modal-footer">
                            <button class="popup_btn popup_cancel_btn">Cancel</button>
                            <button class="popup_btn popup_confirm_btn">Confirm</button>
                        </div>
                    </div>
                </div>
                <!-- The Modal -->
                <div id="myModal1" class="modal">
                    <!-- Modal content -->
                    <div class="modal-content">
                        <div class="modal-header">
                            <span class="close">&times;</span>
                            <h2>Button 2 Clicked</h2>
                        </div>
                        <div class="modal-body">
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolores voluptatum ipsa cum aliquid, expinventore, culpa obcaecati modi deleniti enim consequuntur tenetur. Earum numquam sit ratione eum sequi praesentium, unde maxime ullam iure rem mollitia perferendis eos possimus neque, nisi dicta. Obcaecati dignissimos, dolores labore rerum quisquam non explicabo repellat!</p>
                        </div>
                        <div class="modal-footer">
                            <button class="popup_btn popup_cancel_btn">Cancel</button>
                            <button class="popup_btn popup_confirm_btn">Confirm</button>
                        </div>
                    </div>
                </div>
                <!-- The Modal -->
                <div id="myModal2" class="modal">
                <!-- Modal content -->
                    <div class="modal-content">	
                        <div class="modal-header">
                            <span class="close">&times;</span>
                            <h2>Button 3 Clicked</h2>
                        </div>
                        <div class="modal-body">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto, earum voluptas! Omnis, amet? Inventore, aperiam distinctio. Nobis, ex expedita ratione eligendi mollitia, reprehenderit laborum asperiores tempora nihil nisi rerum culpa!</p>
                        </div>
                        <div class="modal-footer">
                            <button class="popup_btn popup_cancel_btn">Cancel</button>
                            <button class="popup_btn popup_confirm_btn">Confirm</button>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
        <?php } ?>
</table>
</div>
        <!-- <div id="pagination" class="paginationbar">
            <p>Pages</p>
            
        </div> -->
        <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
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
                $("#search").keypress(function(e){
                    if(e.which == 13){
                        var input = $(this).val();
                        //alert(input);
                        if(input != null){
                            $("#searchresult").show();
                            $("#subjectstable").hide();
                            //$("#pagination").hide();
                            $.ajax({
                                url: "livesearch.php",
                                method: "POST",
                                data: {input:input},

                                success:function(data){
                                    $("#searchresult").html(data);
                                }
                            })
                        } else {
                            $("#searchresult").hide();
                            $("#myTable").show();
                            //$("#pagination").show();
                        }
                    }
                    
                });
                $("#filterdata").click(function(){
                    var course = $("#course-drop-down").val();
                    var year = $("#year-drop-down").val();
                    var semester = $("#semester-drop-down").val();
                    alert(course + year + semester);
                    $("#searchresult").show();
                    $("#subjectstable").hide();
                    $.ajax({
                        url: "livesearch.php",
                        method: "POST",
                        data: {course:course, year:year, semester:semester},

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