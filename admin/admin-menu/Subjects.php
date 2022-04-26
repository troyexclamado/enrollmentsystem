<?php 
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
            <li><a href="Subjects.html">SUBJECTS <img src="sub.png" alt="" style="width: 20px;height:20px;"></a></li>
            <li><a href="#">SCHEDULE <img src="schedule.png" alt="" style="width: 20px;height:20px;"></a></li>
            <li><a href="Activity Log.html">ACTIVITY LOG <img src="actlog.png" alt="" style="width: 20px;height:20px;"></a></li>
         </ul>
      </nav><div class="container">
<div class="container">
  <h1>SUBJECTS</h1>
<div class="search">
    <div class="search-box">
      <input type="text" placeholder="Type here...">
      <button for="check" class="icon">
        <i class="fas fa-search"></i>
      </button>
    </div>
  </div>
<table class="content-table">
  <thead>
    <tr>
    <th>SUBJECT CODE</th>
    <th>SUBJECT DESCRIPTION</th>
    <th>SUBJECT UNITS</th>
    <th>ACTIONS</th>
  </tr>
</thead>
        <?php 

            $getSubjects = "SELECT * FROM tblsubjects";
            $sqlGetSubjects = mysqli_query($conn, $getSubjects);
              
            while($subjects_result = mysqli_fetch_array($sqlGetSubjects)) {
            ?>
  <tr>
    <td><?php echo $subjects_result['subjectCode']; ?></td>
    <td><?php echo $subjects_result['subjectDescription']; ?></td>
    <td><?php echo $subjects_result['subjectUnits']; ?></td>
    <td>
      <button id="myBtn">EDIT</button>
      <button id="myBtn1">REMOVE</button>
        <!-- The Modal -->
        <div id="myModal" class="modal">
        <!-- Modal content -->
            <div class="modal-content">
                <div class="modal-header">
                    <span class="close">&times;</span>
                    <h2>Edit Subject <?php echo $subjects_result['subjectDescription']; ?></h2>
                </div>
                <div class="modal-body">
                    <p><br>Are you sure you want to edit the subject <?php echo $subjects_result['subjectDescription']; ?> ?<br><br></p>
                </div>
                <div class="modal-footer">
                    <button class="popup_btn popup_confirm_btn">Confirm</button>
                    <button class="popup_btn popup_cancel_btn">Cancel</button>
                </div>
            </div>
        </div>

    <!-- The Modal -->
    <div id="myModal1" class="modal">

        <!-- Modal content -->
        <div class="modal-content">
            <div class="modal-header">
                <span class="close">&times;</span>
                <h2>Remove Subject</h2>
            </div>
            <div class="modal-body">
                <p><br>Are you sure you want to remove this subject?<br><br></p>
            </div>
            <div class="modal-footer">
                <button class="popup_btn popup_confirm_btn">Confirm</button>
                <button class="popup_btn popup_cancel_btn">Cancel</button>
            </div>
        </div>

    </div>
    </td>
  </tr>
  <?php  
        }
  ?>
  
  
</div>

<script>
var datamap = new Map([
            [document.getElementById("myBtn"), document.getElementById("myModal")],
            [document.getElementById("myBtn1"), document.getElementById("myModal1")],
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