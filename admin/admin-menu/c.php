<?php 
    include('dbconnection.php');

    if(isset($_POST['updatepick'])){
        $courseID = $_POST['courseID'];
        $courseAbbr = strtoupper($_POST['courseAbbr']);
        $courseDescription = strtoupper($_POST['courseDescription']);
        $year = $_POST['year'];
        $section = $_POST['section'];
        $availableslots = $_POST['availableslots'];
        $semester = $_POST['semester'];

        $updatecouresdtl = "update tblcoursedetails set courseAbbr='$courseAbbr',courseDescription='$courseDescription',year=$year,section='$section',availableslots=$availableslots,semester=$semester where courseID = $courseID ";
        $resultupdatecouresdtl = $conn->query($updatecouresdtl);
        if($resultupdatecouresdtl){
            echo('<script>alert("Successful!")</script>');
            echo("<script>location.href = 'Courses.php';</script>");
        }
    }
 ?>