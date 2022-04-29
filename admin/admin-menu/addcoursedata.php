<?php 
    include('dbconnection.php');

    if(!isset($_POST['submit'])){
        $courseAbbr = $_POST['courseAbbr'];
        $courseDescription = $_POST['courseDescription'];
        $numberOfSections = $_POST['numberofsections'];
        $yearlevel = $_POST['yearlevel'];
        $totalstudents = $_POST['totalstudents'];

        for($i = 1; $i <= $yearlevel; $i++){
            for($j = 0; $j < $numberOfSections; $j++){
                $sections = array("A", "B", "C", "D", "E");
                $addsubject = "INSERT INTO tblcoursedetails(courseDescription, courseAbbr, year, section, schoolYear, semester, totalsudents) VALUES('$courseDescription', '$courseAbbr', $i, '$sections[$j]', '$SCHOOLYEAR', '$SEMESTER', $totalstudents)";
                $sqlAddSubjects = mysqli_query($conn, $addSubject);
            }
        }
        
        header("Location: /enrollmentsystem/admin/admin-menu/Courses.php", true, 301);
    }
 ?>