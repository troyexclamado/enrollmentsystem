<?php 
    include('dbconnection.php');

    if(!isset($_POST['submit'])){
        $subjectCode = $_POST['subjectCode'];
        $subjectDescription = $_POST['subjectDescription'];
        $subjectUnits = $_POST['subjectUnits'];
        $course = $_POST['course'];
        $year = $_POST['year'];
        $semester = $_POST['semester'];
        $section = $_POST['section'];

        if($section == "ALL SECTIONS"){
            //ichecheck yung mga ininput tas hahanapin sa tblcoursedetails, pag may nahanap na kaparehas kukunin yung value ng courseID
            $courseID = "";
            $sqlGetCourseDetails = "SELECT courseID FROM tblcoursedetails WHERE courseDescription = '$course' AND year = $year AND semester = $semester";
            $getCourseDetails = mysqli_query($conn, $sqlGetCourseDetails);
            while($coursedetails = mysqli_fetch_array($getCourseDetails)){
                $courseID = $coursedetails['courseID'];

                $addSubject = "INSERT INTO tblsubjects(subjectCode, subjectDescription, subjectUnits, courseID) VALUES('$subjectCode', '$subjectDescription', $subjectUnits,$courseID)";
                $sqlAddSubject = mysqli_query($conn, $addSubject);
            }
            header("Location: /enrollmentsystem/admin/admin-menu/Subjects.php", true, 301);
            exit();
        } else {
            //ichecheck yung mga ininput tas hahanapin sa tblcoursedetails, pag may nahanap na kaparehas kukunin yung value ng courseID
            $courseID = "";
            $sqlGetCourseDetails = "SELECT courseID FROM tblcoursedetails WHERE courseDescription = '$course' AND year = $year AND semester = $semester AND section = $section";
            $getCourseDetails = mysqli_query($conn, $sqlGetCourseDetails);
            while($coursedetails = mysqli_fetch_array($getCourseDetails)){
                $courseID = $coursedetails['courseID'];
            }
            
            $addSubject = "INSERT INTO tblsubjects(subjectCode, subjectDescription, subjectUnits, courseID) VALUES('$subjectCode', '$subjectDescription', $subjectUnits, $courseID)";
            $sqlAddSubject = mysqli_query($conn, $addSubject);

            echo '<script>windows.location.href="/enrollmentsystem/admin/admin-menu/Subjects.php"</script>';
            echo 'why?';
        }
    }
 ?>