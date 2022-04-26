<?php
    session_start();
    
    require('includes/db.inc.php');


    /* REGULAR STUDENT SUBMIT */

    if(isset($_POST['submit'])){
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $middlename = $_POST['middlename'];
        $birthday = $_POST['birthday'];
        $birthplace = $_POST['birthplace'];
        $email = $_POST['email'];
        $contactnumber = $_POST['contactnumber'];
        $address = $_POST['address'];
        $lastschoolattended = $_POST['lastschoolattended'];
        $lastschoolyear = $_POST['lastschoolyear'];
        $lastschooladdress = $_POST['lastschooladdress'];
        $course = $_POST['course'];
        $year = $_POST['year'];
        $semester = $_POST['semester'];
        $accountID = $_SESSION['ID'];


        //ichecheck yung mga ininput tas hahanapin sa tblcoursedetails, pag may nahanap na kaparehas kukunin yung value ng courseID
        $courseID = "";
        $sqlGetCourseDetails = "SELECT courseID FROM tblcoursedetails WHERE courseDescription = '$course' AND year = $year AND semester = $semester AND section = 'A'";
        $getCourseDetails = mysqli_query($conn, $sqlGetCourseDetails);
        while($coursedetails = mysqli_fetch_array($getCourseDetails)){
            $courseID = $coursedetails['courseID'];
        }

        $preenrollment = "INSERT INTO tblstudents(accountID, birthday, birthplace, email, contactNumber, address, lastSchoolAttended, lastSchoolYearAttended, lastSchoolAddress, courseID, statusID, scheme) VALUES('$accountID', '$birthday','$birthplace','$email','$contactnumber','$address', '$lastschoolattended', '$lastschoolyear', '$lastschooladdress', '$courseID','0', 1)";

        $sqlPreEnroll = mysqli_query($conn, $preenrollment);

        if($sqlPreEnroll)
        {

        echo "<script>window.open('enroll.php#subject-container','self')</script>";
        die();
        }
    }

    /* IRREGULAR STUDENT SUBMIT */
     if(isset($_POST['submit-irregular'])){

        $number = count($_POST["name"]); 

        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $middlename = $_POST['middlename'];
        $birthday = $_POST['birthday'];
        $birthplace = $_POST['birthplace'];
        $email = $_POST['email'];
        $contactnumber = $_POST['contactnumber'];
        $address = $_POST['address'];
        $lastschoolattended = $_POST['lastschoolattended'];
        $lastschoolyear = $_POST['lastschoolyear'];
        $lastschooladdress = $_POST['lastschooladdress'];
        $course = $_POST['course'];
        $year = $_POST['year'];
        $semester = $_POST['semester'];
        $accountID = $_SESSION['ID'];

        $upperaddress = strtoupper($address);
        $upperbirthplace = strtoupper($birthplace);

        $sql2 = "SELECT courseID FROM tblcoursedetails WHERE courseAbbr = '$course' AND semester = '$semester' AND year = '$year' LIMIT 1";

        $result = mysqli_query($conn, $sql2);

        while($row = mysqli_fetch_array($result)){
            $courseID = $row['courseID'];
        }

        $backsubject = "SELECT subjectCode FROM tblsubjects WHERE courseID = '$courseID'";
        $success = mysqli_query($conn, $backsubject);

        while($row_backsubject = mysqli_fetch_array($success)){
            $subjectCode = $row_backsubject['subjectCode'];

            $sql3 = "INSERT INTO tblbacksubjects(subjectCode, accountID, status) VALUES('".$subjectCode."','".$accountID."', 'SAVE')";
            $insert = mysqli_query($conn, $sql3);
        }

        if($number > 0)  
     {  
      for($i=0; $i<$number; $i++)  
      {  
           if(trim($_POST["name"][$i] != ''))  
           {  
            $uppersubject = strtoupper($_POST["name"][$i]);
                $sql = "INSERT INTO tblbacksubjects(accountID , subjectCode, status) VALUES('".$accountID."','".$uppersubject."','REQUIRED')";  
                $res = mysqli_query($conn, $sql);          
           }  
      }  
        if($number == $i){
                    $preenrollment = "INSERT INTO tblstudents(accountID, address, birthday, birthplace, email, contactNumber, courseID, enrollmentStatus, scheme, position) VALUES('$accountID', '$upperaddress', '$birthday','$upperbirthplace','$email','$contactnumber', '$courseID', 'PENDING', '1', 'IRREGULAR')";
        $sqlPreEnroll = mysqli_query($conn, $preenrollment);

        if($sqlPreEnroll)
        {
        echo "<script>window.open('irregular_enroll.php#subject-container', 'self')</script>";
        die();
    }
    }

         }  

        }

     if(isset($_GET['action'])){

        $accountID = $_SESSION['ID'];
        $subject_code = $_GET['action'];

        $sql = "UPDATE tblbacksubjects SET status = 'PENDING' WHERE accountID = '$accountID' AND subjectCode = '$subject_code' AND status = 'SAVE'";
        $res = mysqli_query($conn, $sql);
        if($res){
            echo "<script>window.open('irregular_enroll.php#subject-container', 'self')</script>";
        die();
        }


     }   
        
?>
