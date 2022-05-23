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
    <h4 id="filter"> FILTER BY : </h4>
    <div class="custom-select" style="width:200px;">
      <select id="course-drop-down">
        <option value="">Course:</option>
        <option value="1">BSCS</option>
        <option value="2">BSIT</option>
        <option value="3">BSEMC</option>
        <option value="4">BSIS</option>
      </select>
        <select id="year-drop-down">
        <option value="">Year:</option>
        <option value="1">1st</option>
        <option value="2">2nd</option>
        <option value="3">3rd</option>
        <option value="4">4th</option>
        
      </select>
        <select id="unit-drop-down">
        <option value="">Units:</option>
        <option value="1">Ascending</option>
        <option value="2">Descending</option>
        
      </select>
        <select id="semester-drop-down">
        <option>Semester:</option>
        <option value="1">1st</option>
        <option value="2">2nd</option>
      </select>
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
                $("#search").keyup(function(){
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
                });
                $('#course-drop-down').change(function(){
                    var input2 = $("#course-drop-down option:selected").text();
                    //alert(input2);
                    if(input2 != null){
                        $("#searchresult").show();
                        $("#subjectstable").hide();
                        //$("#pagination").hide();
                        $.ajax({
                            url: "livesearch.php",
                            method: "POST",
                            data: {input2:input2},

                            success:function(data){
                                $("#searchresult").html(data);
                            }
                        })
                    } else {
                        $("#searchresult").hide();
                        $("#myTable").show();
                        //$("#pagination").show();
                    }
                });
                $('#year-drop-down').change(function(){
                    var input3 = $(this).val();
                    //alert(input2);
                    if(input3 != null){
                        $("#searchresult").show();
                        $("#subjectstable").hide();
                        //$("#pagination").hide();
                        $.ajax({
                            url: "livesearch.php",
                            method: "POST",
                            data: {input3:input3},

                            success:function(data){
                                $("#searchresult").html(data);
                            }
                        })
                    } else {
                        $("#searchresult").hide();
                        $("#myTable").show();
                        //$("#pagination").show();
                    }
                });
                $('#semester-drop-down').change(function(){
                    var input4 = $(this).val();
                    //alert(input2);
                    if(input4 != null && input4 != ""){
                        $("#searchresult").show();
                        $("#subjectstable").hide();
                        //$("#pagination").hide();
                        $.ajax({
                            url: "livesearch.php",
                            method: "POST",
                            data: {input4:input4},

                            success:function(data){
                                $("#searchresult").html(data);
                            }
                        })
                    } else {
                        $("#searchresult").hide();
                        $("#myTable").show();
                        //$("#pagination").show();
                    }
                });
            });
        </script>
   </body>
</html>