<?php
    require('dbconnection.php');
    session_start();

    if(isset($_POST['import'])){
      $filename = $_FILES['file']['tmp_name'];
      if($_FILES['file']['size'] > 0){
        $file = fopen($filename, 'r');

        //fgetcsv($file);
        while(($getData = fgetcsv($file, 10000, ',')) !== FALSE){
          $checkstudnum = "SELECT * FROM tblstudentaccounts WHERE studentNumber = $getData[0]";
          $resultcheck = mysqli_query($conn, $checkstudnum);
          if(mysqli_num_rows($resultcheck) > 0){

          }else {
            $password = strtolower($getData[3]).$getData[0];
            $sql = "INSERT INTO tblstudentaccounts(studentNumber, firstname, middlename, lastname, password) VALUES($getData[0],'$getData[1]','$getData[2]','$getData[3]','$password')";
            $sqlresult = mysqli_query($conn, $sql);
          }
          
          // if(!empty($sqlresult)){
          //   echo '<script>alert("Successful")</script>';
          // } else {
          //   echo '<script>alert("Failed")</script>';
          // }
        }
        fclose($file);
      }
      
    }
    $query = "SELECT * FROM tblstudentaccounts";
    $result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <title>Student Accounts</title>
      <link rel="stylesheet" href="activitylog.css?<?php echo time();?>">
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
            <li><a href="activitylog.php">ACTIVITY LOG <img src="actlog.png" alt="" style="width: 20px;height:20px;"></a></li>
            <li><a href="logout.php">LOG OUT <img src="actlog.png" alt="" style="width: 20px;height:20px;"></a></li>
         </ul>
      </nav><div class="container">

      
<div class="container">

  <h1>STUDENT ACCOUNTS</h1>
  <div class="search">
    <div class="search-box">
      <input type="text" id = "search" autocomplete="off" placeholder="Type here...">
      <button for="check" class="icon">
        <i class="fas fa-search"></i>
        </button>
    </div>
  </div>
  
  <form class="import" method="POST" action="studentaccounts.php" enctype="multipart/form-data">
    <p style="float:left;margin-right: 20px">IMPORT NEW STUDENTS</p>
    <input type="file" name="file" class="importfile" accept=".csv" required>
    <input type="submit" class="importbutton" name="import">
  </form>

  <div id="searchresult">
  </div>
<div id="accountstable" class="accountstable">
<table id="myTable" class="content-table">
  <thead>
    <tr>
    <th>STUDENT NUMBER</th>
    <th>NAME</th>
    <th>PASSWORD</th>
  </tr>
</thead>
<?php 
  
  if(mysqli_num_rows($result) > 0){
    while($rows = mysqli_fetch_array($result)){  
?>
  <tr>
    <td><?php echo $rows['studentNumber']?></td>
    <td><?php echo $rows['lastname'].' '.$rows['firstname'].' '.$rows['middlename']?></td>
    <td><?php echo $rows['password']?></td>
  </tr>
<?php 
    }
  }
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                $("#search").keyup(function(){
                    var input = $(this).val();
                    //alert(input);
                    if(input != null){
                        $("#searchresult").show();
                        $("#accountstable").hide();
                        $.ajax({
                            url: "studentaccountslivesearch.php",
                            method: "POST",
                            data: {input:input},

                            success:function(data){
                                $("#searchresult").html(data);
                            }
                        })
                    } else {
                        //$("#searchresult").hide();
                        //$("#accountstable").show();
                    }
                });
            });
        </script>
   </body>
</html>