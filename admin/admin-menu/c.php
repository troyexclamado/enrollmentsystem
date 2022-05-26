<?php 
    include('dbconnection.php');

    // if(!isset($_POST['updatepick'])){
    //     $courseAbbr = $_POST['courseAbbr'];
    //     $courseDescription = $_POST['courseDescription'];
    //     $numberOfSections = $_POST['numberofsection'];
    //     $yearlevel = $_POST['yearlevel'];
    //     $totalstudents = $_POST['totalstudents'];

    //     for($i = 1; $i <= $yearlevel; $i++){
    //         for($j = 0; $j < $numberOfSections; $j++){
    //             $year = (int)$i;
    //             $sections = array("A", "B", "C", "D", "E");
    //             $addcourse = "INSERT INTO tblcoursedetails(courseDescription, courseAbbr, year, section, schoolYear, semester, totalstudents) VALUES('$courseDescription', '$courseAbbr', $year, '$sections[$j]', '$SCHOOLYEAR', $SEMESTER, $totalstudents)";
    //             $sqlAddCourse = mysqli_query($conn, $addcourse);
    //         }
    //     }
    //     header("Location: /enrollmentsystem/admin/admin-menu/Courses.php", true, 301);

    // }
    // else 

    if(isset($_POST['updatepick'])){
        $courseAbbr = $_POST['courseAbbr'];
        $courseDescription = $_POST['courseDescription'];
        $year = $_POST['year'];
        $section = $_POST['section'];
        $availableslots = $_POST['availableslots'];
        $semester = $_POST['semester'];

        if($courseAbbr == "" || $courseDescription == "" || $year == "" || $section == "" || $availableslots == "" || $semester == ""){
            echo("<script>location.href = 'b.php';</script>");
        }else{
            $updatecouresdtl = "update tblcoursedetails set courseAbbr='$courseAbbr',courseDescription='$courseDescription',year='$year',section='$section',availableslots='$availableslots',semester='$semester', pick='0' where pick='1' ";
            $resultupdatecouresdtl = $conn->query($updatecouresdtl);
            if($resultupdatecouresdtl){
                echo("<script>location.href = 'a.php';</script>");
            }
        }
    }
    if(isset($_POST['back'])){
        //echo("<script>location.href = 'a.php';</script>");
        $strupdatetblcourse = "update tblcoursedetails set pick='0' where pick='1' ";
            $updateresult = $conn->query($strupdatetblcourse);
            if($updateresult){
                echo("<script>location.href = 'a.php';</script>");
            }
    }

    // if(isset($_POST['btnyes'])){
    //     $pick = isset($_POST['btnyes']);
    //     echo("<script>alert($pick);</script>");
        
    // }

       // if(isset($_POST['btndel'])){
       //      $pick = $_POST['btndel'];
       //      $strupdatetblcourse = "update tblcoursedetails set del='1' where courseID = $pick ";
       //      $updateresult = $conn->query($strupdatetblcourse);
       //      if($updateresult){
       //         echo("<script>location.href = 'a.php';</script>");
       //      }
       //  }
 ?>