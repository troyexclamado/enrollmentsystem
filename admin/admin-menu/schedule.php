<?php
    require('dbconnection.php');
    session_start();
    $datenow = date('Y-m-d');

    if(isset($_POST['addavailability'])){
      $accountID = $_SESSION['accountID'];
      $day = $_POST['day'];
      $startTime = $_POST['startTime'];
      $endTime = $_POST['endTime'];
      $subject = $_POST['subject'];

      $query = "INSERT INTO tblprofessoravailability(accountID, subject, day, startTime, endTime) VALUES($accountID, '$subject', '$day', '$startTime', '$endTime')";
      $result = mysqli_query($conn, $query);
      if($result){
        echo '<script>alert("Successfully Addded!")</script>';
        echo '<script>window.location.href="../admin-menu/schedule.php"</script>';
      } else {
        echo '<script>alert("Failed to Add!")</script>';
        echo '<script>window.location.href="../admin-menu/schedule.php"</script>';
      }
    }
    if(isset($_POST['remove'])){
      $id = $_POST['id'];
      $query = "DELETE FROM tblprofessoravailability WHERE id = $id";
      $result = mysqli_query($conn, $query);
      if($result){
        echo '<script>alert("Successfully Removed!")</script>';
        echo '<script>window.location.href="../admin-menu/schedule.php"</script>';
      } else {
        echo '<script>alert("Failed to Remove!")</script>';
        echo '<script>window.location.href="../admin-menu/schedule.php"</script>';
      }
    }
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <title>Availability | Enrollment System </title>
      <link rel="icon" type="image/x-icon" href="logo-icon.png">
      <link rel="stylesheet" href="schedule.css?<?php echo time();?>">
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
            <br>
            <p><?php echo $datenow?></p>
          </div>
          <br>
         <ul>
            <?php if(!empty($_SESSION['POSITION']) && ($_SESSION['POSITION'] == "PROFESSOR")){ ?> 
            <li><a href="schedule.php"><img src="schedule.png" alt="" style="width: 20px;height:20px;"> SCHEDULE </a></li>
            <?php }?>
            <li><a href="logout.php"><img src="actlog.png" alt="" style="width: 20px;height:20px;"> LOG OUT </a></li>
         </ul>
      </nav>

<div class="container">
<br>
<h2 style="margin-left: 20px; margin-top: 10px">PROFESSOR AVAILABILITY</h2> 
<br>
<form action="schedule.php" method="POST">
<div class="custom-select">
<h4 id="filter"> ADD AVAILABILITY : </h4>
  <select id="day" name="day" required>
    <option selected hidden diabled>Day</option>
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
    <input type="time" id="startTime" name="startTime" required>
    <h4>End Time</h4>
    <input type="time" id="endTime" name="endTime" required>
    <input type="submit" name="addavailability" id="filterdata" value="Add Availability">
</div>
</form>
<div id="searchresult"> </div>
        <div class="enrolled" id="enrolledtable">
            <table id="enrolled" class="content-table">
                <thead>
                    <tr>
                        <th>NAME</th>
                        <th>DAY</th>
                        <th>SUBJECT</th>
                        <th>AVAILABLE TIME</th>
                        <th>ACTIONS</th>
                    </tr>
                </thead>
                <?php 
                  $accountID = $_SESSION['accountID'];
                  $query = "SELECT * FROM tblprofessoravailability WHERE accountID = $accountID";
                  $result = mysqli_query($conn, $query);
                  if(mysqli_num_rows($result) > 0){
                    while($row = mysqli_fetch_array($result)){
                      ?>
                      <tr>
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
                        <td>
                          <form method="POST" action="editschedule.php" onsubmit="return confirm('Do you want to edit this?')">
                          <input type="hidden" name="id" value="<?php echo $row['id']?>">
                          <input type="submit" class="accept" name="edit" value = "Edit">
                          </form>
                          <form action="schedule.php" method="post" onsubmit="return confirm('Do you want to remove this?')">
                          <input type="hidden" name="id" value="<?php echo $row['id']?>">
                          <input type="submit" class="reject" name= "remove" value = "Remove">
                          </form>
                          
                        </td>
                        
                      </tr>
                      <?php
                    }
                  }
                ?>
            </table>
                </div>
        </div>

<script>
  // Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on the button, open the modal
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
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