<?php 
    session_start();
    include('dbconnection.php');
    $datenow = date('Y-m-d');

    if(isset($_POST['updateavailability'])){
        $id = $_POST['id'];
        $day = $_POST['day'];
        $startTime = $_POST['startTime'];
        $endTime = $_POST['endTime'];
        $subject = $_POST['subject'];

        $updatequery = "UPDATE tblprofessoravailability SET day = '$day', subject = '$subject', startTime = '$startTime', endTime = '$endTime' WHERE id = $id";
        $sql = mysqli_query($conn, $updatequery);

        if($sql){
            echo '<script>alert("Success")</script>';
            echo '<script>window.location.href="schedule.php"</script>';
        } else {
            echo '<script>alert("Failed")</script>';
            echo '<script>window.location.href="schedule.php"</script>';
        }

    }

    if(isset($_POST['edit'])){
      $id = $_POST['id'];
      $query = "SELECT * FROM tblprofessoravailability WHERE id = $id";
      $result = mysqli_query($conn, $query);
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <title>Edit Schedule | Enrollment System </title>
      <link rel="icon" type="image/x-icon" href="logo-icon.png">
      <link rel="stylesheet" href="addsub.css">
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
            <li><a href="schedule.php"><img src="schedule.png" alt="" style="width: 20px;height:20px;"> SCHEDULE </a></li>
            <li><a href="logout.php"><img src="actlog.png" alt="" style="width: 20px;height:20px;"> LOG OUT </a></li>
         </ul>
</nav>
<br>
<h2>UPDATE SCHEDULE DETAILS</h2>
<div class="container">
  <form method = "post" action="editschedule.php">

    <?php 
      if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_array($result);
      
    ?>
    <div class="row">
      <div class="col-25">
        <label for="fname">Day</label>
      </div>
      <div class="col-75">
        <select id="day" name="day">
            <option <?php if($row['day'] == 'MONDAY'){ echo 'selected';}?>>MONDAY</option>
            <option <?php if($row['day'] == 'TUESDAY'){ echo 'selected';}?>>TUESDAY</option>
            <option <?php if($row['day'] == 'WEDNESDAY'){ echo 'selected';}?>>WEDNESDAY</option>
            <option <?php if($row['day'] == 'THURSDAY'){ echo 'selected';}?>>THURSDAY</option>
            <option <?php if($row['day'] == 'FRIDAY'){ echo 'selected';}?>>FRIDAY</option>
            <option <?php if($row['day'] == 'SATURDAY'){ echo 'selected';}?>>SATURDAY</option>
            <option <?php if($row['day'] == 'SUNDAY'){ echo 'selected';}?>>SUNDAY</option>
      </select>
      </div>
    </div>

    <div class="row">
      <div class="col-25">
        <label for="fname">Subject</label>
      </div>
      <div class="col-75">
      <select id="subject" name="subject">
  <option selected hidden diabled>Subject</option>
    <?php
        $query = "SELECT DISTINCT subjectCode, subjectDescription FROM tblsubjects";
        $results = mysqli_query($conn, $query);
        if(mysqli_num_rows($results) > 0){
            while($rows = mysqli_fetch_array($results)){
            ?>
                <option <?php if($rows['subjectCode'] == $row['subject']){ echo 'selected';}?> value="<?php echo $rows['subjectCode']?>"><?php echo $rows['subjectCode'].'-'.$rows['subjectDescription']?></option>
            <?php
            }
        }
    ?>
    </select>
      </div>
    </div>

    <div class="row">
      <div class="col-25">
        <label for="fname">Start Time</label>
      </div>
      <div class="col-75">
        <input type="time" id="subDes" name="startTime" placeholder="" value="<?=$row['startTime']?>" required>
      </div>
    </div>

   <div class="row">
      <div class="col-25">
        <label for="fname">End Time</label>
      </div>
      <div class="col-75">
      <input type="time" id="subDes" name="endTime" placeholder="" value="<?=$row['endTime']?>" required>
      </div>
    </div>

    <!-- <div class="row">
      <div class="col-25">
        <label for="country">Available Slot</label>
      </div>
      <div class="col-75">
        <input type="text" id="subCourse" name="availableslots" placeholder="" value="<?=$row['availableslots']?>" onkeypress="return /[0-9]/i.test(event.key)" required>
      </div>
    </div>

     <div class="row">
      <div class="col-25">
        <label for="country">Semester</label>
      </div>
      <div class="col-75">
        <input type="text" id="subCourse" name="semester" placeholder="" value="<?=$row['semester']?>" onkeypress="return /[1-2]/i.test(event.key)" maxlength="1" required>
      </div>
    </div> -->

      <!-- <div class="row">
      <div class="col-25">
        <label for="country">Semester</label>
      </div>
      <div class="col-75">
        <select id="subSem" name="semester" required>
          <option value="1">1st</option>
          <option value="2">2nd</option>
        </select>
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="country">Section</label required>
      </div>
      <div class="col-75">
        <select id="subSection" name="section">
          <option>ALL SECTIONS</option>
          <option>A</option>
          <option>B</option>
          <option>C</option>
          <option>D</option>
        </select>
      </div>
    </div> -->
      
    <div class="row">
      <a href="schedule.php"><input type="button" name="back" value="Back"></a>
      <input type="hidden" name="id" value = <?php echo $id?>>
      <input type="submit" name="updateavailability" value="Update Availability">
      
    </div>

     <?php
      }
    }//end if while
    ?>
  </form>
</div>

</body>
</html>
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