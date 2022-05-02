<?php
    session_start();
    include('dbconnection.php');
    

    if(!isset($_POST['submit'])){
        $subjectCode = $_POST['subject'];
        $professorID = $_SESSION['PROFESSOR_ID'];

        echo $subjectCode.$professorID;

        $addsubjectProfessor = "INSERT INTO tblprofessorsubjects(professorID, subjectCode, scheduleID) VALUES($professorID, '$subjectCode', 0)";
        $sqlAddSubjectProfessor = mysqli_query($conn, $addsubjectProfessor);

        echo '<script>alert("Subject Added!")</script>';
        echo '<script>window.location.href="/enrollmentsystem/admin/admin-menu/schedule.php"</script>';
    }
 ?>