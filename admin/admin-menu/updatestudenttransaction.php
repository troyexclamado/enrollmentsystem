<?php 
    session_start();
    include('dbconnection.php');
    $datenow = date('Y-m-d');

    if(isset($_POST['updatetransaction'])){
        $studentNumber = $_POST['studentNumber'];
        $OR_NUMBER = $_POST['OR_NUMBER'];
        $OR_DATE = $_POST['OR_DATE'];
        $TF_AMOUNT = $_POST['TF_AMOUNT'];
        $MF_AMOUNT = $_POST['MF_AMOUNT'];
        $totalAmount = $_POST['totalAmount'];
        $balance = $_POST['balance'];
        $penalty = $_POST['penalty'];
        $TNC = $_POST['TNC'];

        // $query = "INSERT INTO tblstudenttransactions(studentNumber, OR_NUMBER, OR_DATE, TF_AMOUNT, MF_AMOUNT, totalAmount, balance, penalty, TNC) VALUES($studentNumber, $OR_NUMBER, '$OR_DATE', $TF_AMOUNT, $MF_AMOUNT, $totalAmount, $balance, $penalty, $TNC)";
        // $sql = mysqli_query($conn, $query);

        $query = "UPDATE tblstudenttransactions SET OR_NUMBER = $OR_NUMBER, OR_DATE = '$OR_DATE', TF_AMOUNT = $TF_AMOUNT, MF_AMOUNT = $MF_AMOUNT, totalAmount = $totalAmount, balance = $balance, penalty = $penalty, TNC = $TNC WHERE studentNumber = $studentNumber";
        $sql = mysqli_query($conn, $query);

        if($sql){
           //activity log
           $name = $_SESSION['NAME'];
           $activity = 'UPDATED TRANSACTION OF STUDENT '.$studentNumber;
           $activityquery = "INSERT INTO tblactivitylog(activity, incharge) VALUES('$activity', '$name')";
           $activityresult = mysqli_query($conn, $activityquery);

            echo '<script>window.location.href="/enrollmentsystem/admin/admin-menu/Pre-Enrolled.php"</script>';
        }
    }
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <title>Update Student Transaction | Enrollment System </title>
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
<br>
<?php 
        if(isset($_POST['view'])){
            $studentNumber = $_POST['studentNumber'];
            $query = "SELECT * FROM tblstudenttransactions WHERE studentNumber = $studentNumber";
            $result = mysqli_query($conn, $query);
            if(mysqli_num_rows($result) > 0){
                $row = mysqli_fetch_array($result);
    ?>
<h2 style="margin-left: 20px;">STUDENT TRANSACTIONS(<?php echo $studentNumber?>)</h2>
<div class="container">
    
  <form method = "POST" action="updatestudenttransaction.php">
      <input type="hidden" name="studentNumber" value = "<?php echo $studentNumber ?>">
    <div class="row">
      <div class="col-25">
        <label for="fname">O.R. Number</label>
      </div>
      <div class="col-75">
        <input type="text" id="subCodes" name="OR_NUMBER" placeholder="Enter receipt number... Ex.: 11002135" onkeypress="return /[0-9]/i.test(event.key)" value = "<?php echo $row['OR_NUMBER']?>" required>
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="fname">O.R. Date</label>
      </div>
      <div class="col-75">
        <input type="date" id="subCodes" name="OR_DATE" value = "<?php echo $row['OR_DATE']?>" required>
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="fname">Tuition Fee Amount</label>
      </div>
      <div class="col-75">
        <input type="text" id="subCodes" name="TF_AMOUNT" placeholder="Enter tuition fee amount..." onkeypress="return /[0-9]/i.test(event.key)" value = "<?php echo $row['TF_AMOUNT']?>" required>
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="fname">Miscellaneous Fee Amount</label>
      </div>
      <div class="col-75">
        <input type="text" id="subCodes" name="MF_AMOUNT" placeholder="Enter miscellaneous fee amount..." onkeypress="return /[0-9]/i.test(event.key)" value = "<?php echo $row['MF_AMOUNT']?>" required>
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="fname">Total Amount</label>
      </div>
      <div class="col-75">
        <input type="text" id="subCodes" name="totalAmount" placeholder="Enter total amount..." onkeypress="return /[0-9]/i.test(event.key)" value = "<?php echo $row['totalAmount']?>" required>
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="fname">Balance</label>
      </div>
      <div class="col-75">
        <input type="text" id="subCodes" name="balance" placeholder="Enter balance..." onkeypress="return /[0-9]/i.test(event.key)" value = "<?php echo $row['balance']?>" required>
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="fname">Penalty</label>
      </div>
      <div class="col-75">
        <input type="text" id="subCodes" name="penalty" placeholder="Enter penalty..." onkeypress="return /[0-9]/i.test(event.key)" value = "<?php echo $row['penalty']?>" required>
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="fname">TNC</label>
      </div>
      <div class="col-75">
        <input type="text" id="subCodes" name="TNC" placeholder="Enter TNC amount..." onkeypress="return /[0-9]/i.test(event.key)" value = "<?php echo $row['TNC']?>" required>
      </div>
    </div>
      
    <div class="row">
      <input type="submit" name="updatetransaction" value="Update Transaction Details">
      <a href="Pre-Enrolled.php"><input type="button" name="addtransaction" value="Back"></a>
    </div>
  </form>
  <?php
            }
        }
  ?>
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