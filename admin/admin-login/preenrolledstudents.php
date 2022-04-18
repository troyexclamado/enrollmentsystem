<?php
    require('database.php');
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <title>Dashboard</title>
      <link rel="stylesheet" href="dashboard.css">
      <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
   </head>
   <body>
      <div class="btn">
         <span class="fas fa-bars"></span>
      </div>
      <nav class="sidebar">
         <div class="text">
            Administrator
         </div>
         <ul>
            <li><a href="dashboard.html">Dashboard</a></li>
            <li>
               <a href="#" class="feat-btn">Students
               <span class="fas fa-caret-down first"></span>
               </a>
               <ul class="feat-show">
                  <li class="active"><a href="preenrolledstudents.php">Pre-enrolled</a></li>
                  <li><a href="enrolledstudents.php">Enrolled</a></li>
               </ul>
            </li>
            <li><a href="#">Subjects</a></li>
            <li><a href="#">Courses</a></li>
            <li><a href="#">Schedule</a></li>
         </ul>
      </nav>
      <div class="contentarea">
        <div class="preenrolledheading">
            Pre-Enrolled Students
        </div>    
        <div class="tables">
            <table class="ballot">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Lastname</th>
                        <th>Firstname</th>
                        <th>Middlename</th>
                        <th>Course</th>
                        <th>Year</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <?php
                        $getpreenrolled = "SELECT * from preenrolledstudents";
                        $sqlgetpreenrolled = mysqli_query($connection, $getpreenrolled);

                        while($preenrolledstudents = mysqli_fetch_array($sqlgetpreenrolled)){
                        ?>
                        <td><?php echo $preenrolledstudents['accountID']?></td>
                        <td><?php echo $preenrolledstudents['lastname']?></td>
                        <td><?php echo $preenrolledstudents['firstname']?></td>
                        <td><?php echo $preenrolledstudents['middlename']?></td>
                        <td><?php echo $preenrolledstudents['course']?></td>
                        <td><?php echo $preenrolledstudents['year']?></td>
                        <td>
                            <form>
                                <input type="hidden" name="ID">
                                <input class="actionbutton" type="submit" name="viewdetails" value="View Details">
                            </form>
                            <form>
                                <input type="hidden" name="ID">
                                <input class="actionbutton" type="submit" name="accept" value="Accept">
                            </form>
                        </td>
                    </tr>
                    <?php
                        }
                    ?>
                </tbody>
            </table>
        </div>
      </div>
      <script>
          $('nav ul .feat-show').toggleClass("show");
           $('.feat-btn').click(function(){
             $('nav ul .feat-show').toggleClass("show");
             $('nav ul .first').toggleClass("rotate");
           });
           $('.serv-btn').click(function(){
             $('nav ul .serv-show').toggleClass("show1");
             $('nav ul .second').toggleClass("rotate");
           });
           $('nav ul li').click(function(){
             $(this).addClass("active").siblings().removeClass("active");
           });
      </script>
   </body>
</html>