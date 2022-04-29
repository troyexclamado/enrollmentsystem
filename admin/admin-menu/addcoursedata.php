<?php 
    include('dbconnection.php');

    if(!isset($_POST['submit'])){
        $courseAbbr = $_POST['courseAbbr'];
        $courseDescription = $_POST['courseDescription'];
        $numberOfSections = $_POST['numberofsection'];
        $yearlevel = $_POST['yearlevel'];
        $totalstudents = $_POST['totalstudents'];

        for($i = 1; $i <= $yearlevel; $i++){
            for($j = 0; $j < $numberOfSections; $j++){
                $year = (int)$i;
                $sections = array("A", "B", "C", "D", "E");
                $addcourse = "INSERT INTO tblcoursedetails(courseDescription, courseAbbr, year, section, schoolYear, semester, totalstudents) VALUES('$courseDescription', '$courseAbbr', $year, '$sections[$j]', '$SCHOOLYEAR', $SEMESTER, $totalstudents)";
                $sqlAddCourse = mysqli_query($conn, $addcourse);
            }
        }
        header("Location: /enrollmentsystem/admin/admin-menu/Courses.php", true, 301);
    }
 ?>