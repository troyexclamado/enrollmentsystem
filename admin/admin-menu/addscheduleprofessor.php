<?php
    session_start();
    include('dbconnection.php');
    
    if(isset($_POST['addschedule'])){
        $course = $_POST['course'];
        $year = $_POST['year'];
        $section = $_POST['section'];
        $semester = $_POST['semester'];
        $day = $_POST['day'];
        $course = $_POST['course'];
        $startTime = $_POST['startTime'];
        $endTime = $_POST['endTime'];
        $subjectCode = $_POST['currentSubject'];
        $professorID = $_SESSION['PROFESSOR_ID'];
        $currentSemester = $SEMESTER;

        //ichecheck yung mga ininput tas hahanapin sa tblcoursedetails, pag may nahanap na kaparehas kukunin yung value ng courseID
        $courseID = "";
        $sqlGetCourseDetails = "SELECT courseID FROM tblcoursedetails WHERE courseAbbr = '$course' AND year = $year AND semester = $currentSemester AND section = '$section'";
        $getCourseDetails = mysqli_query($conn, $sqlGetCourseDetails);
        if(mysqli_num_rows($getCourseDetails) > 0){
            $coursedetails = mysqli_fetch_array($getCourseDetails);
            $courseID = $coursedetails['courseID'];

            echo $courseID;

            $addSubjectSchedule = "INSERT INTO tblsubjectschedules(subject, day, startTime, endTime, courseID, professorID) VALUES('$subjectCode', '$day', '$startTime', '$endTime', $courseID, $professorID)";
            $sqlAddSubjectSchedule = mysqli_query($conn, $addSubjectSchedule);
  
            echo '<script>alert("Schedule Added!")</script>';
            echo '<script>window.location.href="/enrollmentsystem/admin/admin-menu/schedule.php"</script>';
        } else {
            echo '<script>alert("Schedule Failed to add!")</script>';
            echo '<script>window.location.href="/enrollmentsystem/admin/admin-menu/schedule.php"</script>';
        }
        
        
    }
 ?>