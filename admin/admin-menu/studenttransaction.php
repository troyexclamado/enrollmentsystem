<?php 
    session_start();
    include('dbconnection.php');

    if(isset($_POST['addtransaction'])){
        $studentNumber = $_POST['studentNumber'];
        $OR_NUMBER = $_POST['OR_NUMBER'];
        $OR_DATE = $_POST['OR_DATE'];
        $TF_AMOUNT = $_POST['TF_AMOUNT'];
        $MF_AMOUNT = $_POST['MF_AMOUNT'];
        $totalAmount = $_POST['totalAmount'];
        $balance = $_POST['balance'];
        $penalty = $_POST['penalty'];
        $TNC = $_POST['TNC'];

        $query = "INSERT INTO tblstudenttransactions(studentNumber, OR_NUMBER, OR_DATE, TF_AMOUNT, MF_AMOUNT, totalAmount, balance, penalty, TNC) VALUES($studentNumber, $OR_NUMBER, '$OR_DATE', $TF_AMOUNT, $MF_AMOUNT, $totalAmount, $balance, $penalty, $TNC)";
        $sql = mysqli_query($conn, $query);

        if($sql){
            echo 'yey';
        }
    }
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <title>Enrollment System </title>
      <link rel="stylesheet" href="addsub.css">
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
            <li><a href="activitylog.php">ACTIVITY LOG <img src="actlog.png" alt="" style="width: 20px;height:20px;"></a></li>
            <li><a href="/enrollmentsystem/admin/admin-login/index.html">LOG OUT <img src="actlog.png" alt="" style="width: 20px;height:20px;"></a></li>
         </ul>
</nav>
<br>
<?php 
        if(isset($_POST['add'])){
            $studentNumber = $_POST['studentNumber'];
        
    ?>
<h2 style="margin-left: 20px;">STUDENT TRANSACTIONS(<?php echo $studentNumber?>)</h2>
<div class="container">
    
  <form method = "post" action="#">
      <input type="hidden" name="studentNumber" value = "<?php echo $studentNumber ?>">
    <div class="row">
      <div class="col-25">
        <label for="fname">O.R. Number</label>
      </div>
      <div class="col-75">
        <input type="text" id="subCodes" name="OR_NUMBER" placeholder="Enter receipt number... Ex.: 11002135" onkeypress="return /[0-9]/i.test(event.key)" required>
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="fname">O.R. Date</label>
      </div>
      <div class="col-75">
        <input type="date" id="subCodes" name="OR_DATE" required>
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="fname">Tuition Fee Amount</label>
      </div>
      <div class="col-75">
        <input type="text" id="subCodes" name="TF_AMOUNT" placeholder="Enter tuition fee amount..." onkeypress="return /[0-9]/i.test(event.key)" required>
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="fname">Miscellaneous Fee Amount</label>
      </div>
      <div class="col-75">
        <input type="text" id="subCodes" name="MF_AMOUNT" placeholder="Enter miscellaneous fee amount..." onkeypress="return /[0-9]/i.test(event.key)" required>
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="fname">Total Amount</label>
      </div>
      <div class="col-75">
        <input type="text" id="subCodes" name="totalAmount" placeholder="Enter total amount..." onkeypress="return /[0-9]/i.test(event.key)" required>
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="fname">Balance</label>
      </div>
      <div class="col-75">
        <input type="text" id="subCodes" name="balance" placeholder="Enter balance..." onkeypress="return /[0-9]/i.test(event.key)" required>
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="fname">Penalty</label>
      </div>
      <div class="col-75">
        <input type="text" id="subCodes" name="penalty" placeholder="Enter penalty..." onkeypress="return /[0-9]/i.test(event.key)" required>
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="fname">TNC</label>
      </div>
      <div class="col-75">
        <input type="text" id="subCodes" name="TNC" placeholder="Enter TNC amount..." onkeypress="return /[0-9]/i.test(event.key)" required>
      </div>
    </div>
      
    <div class="row">
      <input type="submit" name="addtransaction" value="Enter Transaction Details">
    </div>
  </form>
  <?php
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