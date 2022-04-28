<?php 
    session_start();
    include('dbconnection.php');
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <title>Enrollment System </title>
      <link rel="stylesheet" href="Subjects.css">
      <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
   </head>
   <body>
      <nav class="sidebar">
         <div class="text">
            <p>Admin</p>
            
          </div>
         <ul>
            <li class="active"><a href="Admin.html">DASHBOARD <img src="dash.png" alt="" style="width: 20px;height:20px;"></i></i></a></li> 
            <li>
               <a href="#" class="feat-btn">STUDENTS  <img src="stud.png" alt="" style="width: 20px;height:20px;">
               <span class="fas fa-caret-down first"></span>
               </a>
               <ul class="feat-show">
                  <li><a href="Pre-Enrolled.php">PRE ENROLLED <img src="pending.png" alt="" style="width: 20px;height:20px;"></a></li>
                  <li><a href="Enrolled.php">ENROLLED  <img src="enrlld.png" alt="" style="width: 20px;height:20px;"></a></li>
               </ul>
            </li>
            
            <li><a href="Courses.html">COURSE <img src="crse.png" alt="" style="width: 20px;height:20px;"></a></a></li>
            <li><a href="Subjects.php">SUBJECTS <img src="sub.png" alt="" style="width: 20px;height:20px;"></a></li>
            <li><a href="#">SCHEDULE <img src="schedule.png" alt="" style="width: 20px;height:20px;"></a></li>
            <li><a href="Activity Log.html">ACTIVITY LOG <img src="actlog.png" alt="" style="width: 20px;height:20px;"></a></li>
         </ul>
      </nav><div class="container">
<div class="container">
    <h1>SUBJECTS</h1>
    <a href="addsub.php" class="sub">Add Subject</a>
    <div class="search">
        <div class="search-box">
          <input type="text" placeholder="Type here...">
          <button for="check" class="icon">
            <i class="fas fa-search"></i>
          </button>
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
        <option value="0">Units:</option>
        <option value="1">Ascending</option>
        <option value="2">Descending</option>
        
      </select>
        <select>
        <option value="0">Semester:</option>
        <option value="1">1st</option>
        <option value="2">2nd</option>
      </select>
    </div>
<table class="content-table">
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
        $getSubjects = "SELECT * FROM tblsubjects";
        $sqlGetSubjects = mysqli_query($conn, $getSubjects);

        while($subjects = mysqli_fetch_array($sqlGetSubjects)){
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
      <button id="myBtn">EDIT</button>
      <button id="myBtn1">DELETE</button>
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
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolores voluptatum ipsa cum aliquid, ex
                    inventore, culpa obcaecati modi deleniti enim consequuntur tenetur. Earum numquam sit ratione eum
                    sequi praesentium, unde maxime ullam iure rem mollitia perferendis eos possimus neque, nisi dicta.
                    Obcaecati dignissimos, dolores labore rerum quisquam non explicabo repellat!</p>
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
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Reprehenderit laudantium quia non laborum
                    ea, similique ex iusto minus obcaecati optio sapiente aut eveniet porro odio veniam excepturi
                    facilis iste fuga? Porro atque odio, fuga blanditiis voluptate ducimus veritatis id ea possimus?
                    Facilis tempore officiis quos assumenda dolorem placeat sed veniam dolor eveniet magnam. Iure ullam
                    odit qui, magni suscipit pariatur nesciunt temporibus aspernatur doloribus quis nobis quas esse
                    perspiciatis, asperiores eum quidem placeat minus alias veniam molestias sit. Ipsam numquam,
                    sapiente facere voluptatem eum, maiores blanditiis cupiditate corporis quos ratione, quia
                    praesentium dolore nihil voluptatum impedit quae consequatur sit pariatur.
                </p>
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
</div>
<script>
var datamap = new Map([
            [document.getElementById("myBtn"), document.getElementById("myModal")],
            [document.getElementById("myBtn1"), document.getElementById("myModal1")],
            [document.getElementById("myBtn2"), document.getElementById("myModal2")], 
            [document.getElementById("myBtn3"), document.getElementById("myModal3")], 
                   
  ]);

        datamap.forEach((value, key) => {
            doModal(key, value);
        });

        function doModal(anchor, popupbox) {

            // Get the <span> element that closes the modal
            var span = popupbox.getElementsByClassName("close")[0];

            anchor.addEventListener("click", function (event) {
                popupbox.style.display = "block";
            });

            span.addEventListener("click", function (event) {
                popupbox.style.display = "none";
            });

            window.addEventListener("click", function (event) {
                if (event.target == popupbox) {
                    popupbox.style.display = "none";
                }
            });
        }
var datamap = new Map([
            [document.getElementById("myBtn4"), document.getElementById("myModal4")],
            [document.getElementById("myBtn5"), document.getElementById("myModal5")],
            [document.getElementById("myBtn6"), document.getElementById("myModal6")], 
            [document.getElementById("myBtn7"), document.getElementById("myModal7")], 
  ]);

        datamap.forEach((value, key) => {
            doModal(key, value);
        });

        function doModal(anchor, popupbox) {

            // Get the <span> element that closes the modal
            var span = popupbox.getElementsByClassName("close")[0];

            anchor.addEventListener("click", function (event) {
                popupbox.style.display = "block";
            });

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