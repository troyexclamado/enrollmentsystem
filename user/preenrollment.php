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
        $accountID = $_SESSION['studentnum'];
        $dateOfEnrollment = date("Y-m-d");

        //ichecheck yung mga ininput tas hahanapin sa tblcoursedetails, pag may nahanap na kaparehas kukunin yung value ng courseID
        $courseID = "";
        $sqlGetCourseDetails = "SELECT courseID FROM tblcoursedetails WHERE courseDescription = '$course' AND year = $year AND semester = $semester AND section = 'A'";
        $getCourseDetails = mysqli_query($conn, $sqlGetCourseDetails);
        while($coursedetails = mysqli_fetch_array($getCourseDetails)){
            $courseID = $coursedetails['courseID'];
        }

        $getSubjects = "SELECT * FROM tblsubjects WHERE courseID = $courseID";
        $sqlGetSubjects = mysqli_query($conn, $getSubjects);
        while($regularsubjects = mysqli_fetch_array($sqlGetSubjects)){
            $subjectCode = $regularsubjects['subjectCode'];

            $enrollsubject = "INSERT INTO tblenrolledsubjects(studentnumber, subjectCode, courseID) VALUES ($accountID, '$subjectCode', $courseID)";
            $enrollsubjectquery = mysqli_query($conn, $enrollsubject);
        }

        $preenrollment = "INSERT INTO tblstudents(studentNumber, birthday, birthplace, email, contactNumber, address, lastSchoolAttended, lastSchoolYearAttended, lastSchoolAddress, courseID, statusID, scheme, studentType, dateOfEnrollment) VALUES('$accountID', '$birthday','$birthplace','$email','$contactnumber','$address', '$lastschoolattended', '$lastschoolyear', '$lastschooladdress', '$courseID','0', 1, 'REGULAR', '$dateOfEnrollment')";
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
        $accountID = $_SESSION['studentnum'];
        $dateOfEnrollment = date("Y-m-d");

        $upperaddress = strtoupper($address);
        $upperbirthplace = strtoupper($birthplace);
        
        // $courseID = "";
        // $getIrregularCourseDetails = "SELECT courseID FROM tblcoursedetails WHERE courseDescription = '$course' AND year = '$year' AND semester = '$semester' AND section = 'A'";
        // $sqlGetCourseDetailsIrregular = mysqli_query($conn, $getIrregularCourseDetails);
        // while($data = mysqli_fetch_array($sqlGetCourseDetailsIrregular)){
        //     $courseID = $data['courseID'];
        // }

        //ichecheck yung mga ininput tas hahanapin sa tblcoursedetails, pag may nahanap na kaparehas kukunin yung value ng courseID
        $courseID = "";
        $sqlGetCourseDetails = "SELECT courseID FROM tblcoursedetails WHERE courseDescription = '$course' AND year = $year AND semester = $semester AND section = 'A'";
        $getCourseDetails = mysqli_query($conn, $sqlGetCourseDetails);
        while($coursedetails = mysqli_fetch_array($getCourseDetails)){
            $courseID = $coursedetails['courseID'];
        }

        $sql2 = "SELECT * FROM tblsubjects WHERE courseID = $courseID";
        $result = mysqli_query($conn, $sql2);
        while($row = mysqli_fetch_array($result)){
            $subjectCode = $row['subjectCode'];

            $sql3 = "INSERT INTO tblbacksubjects(subjectCode, accountID, status) VALUES('$subjectCode', $accountID, 'Save')";
            $insert = mysqli_query($conn, $sql3);

        }

        if($number > 0)  
     {  
      for($i=0; $i<$number; $i++)  
      {  
           if(trim($_POST["name"][$i] != ''))  
           {  
                $sql = "INSERT INTO tblbacksubjects(subjectCode , accountID, status) VALUES('".mysqli_real_escape_string($conn, $_POST["name"][$i])."','".$accountID."','Required')";  
                $res = mysqli_query($conn, $sql);
                
                $insertenrolled = "INSERT INTO tblenrolledsubjects(studentNumber, subjectCode, courseID) VALUES($accountID, '".mysqli_real_escape_string($conn, $_POST["name"][$i])."', $courseID)";
                $queryenrolled = mysqli_query($conn, $insertenrolled);
           }  
      }  
        if($number == $i){
            // $preenrollment = "INSERT INTO tblstudents(accountID, firstname, middlename, lastname, birthday, birthplace, emailAddress, contactNumber, address, lastSchoolAttended, lastSchoolYearAttended, lastSchoolAddress, course, year, semester, position, status) VALUES('$accountID','$firstname','$middlename','$lastname','$birthday','$birthplace','$email','$contactnumber','$address', '$lastschoolattended', '$lastschoolyear', '$lastschooladdress', '$course', '$year', '$semester', 'IRREGULAR', 'PRE-ENROLLED')";
            $preenrollment = "INSERT INTO tblstudents(studentNumber, birthday, birthplace, email, contactNumber, address, lastSchoolAttended, lastSchoolYearAttended, lastSchoolAddress, courseID, statusID, scheme, studentType, dateOfEnrollment) VALUES('$accountID', '$birthday','$birthplace','$email','$contactnumber','$address', '$lastschoolattended', '$lastschoolyear', '$lastschooladdress', '$courseID','0', 1, 'IRREGULAR', '$dateOfEnrollment')";
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

        $accountID = $_SESSION['studentnum'];
        $subject_code = $_GET['action'];
        $subject_code = str_replace("%20"," ","$subject_code");

        $sql = "UPDATE tblbacksubjects SET status = 'Taken' WHERE accountID = $accountID AND subjectCode = '$subject_code'";
        // $sql = "INSERT INTO tblbacksubjects(subjectCode, accountID, status) VALUES('$subject_code', $accountID, 'Save')";

        $courseID = "";
        $sqlGetCourseDetails = "SELECT courseID FROM tblstudents WHERE studentNumber = $accountID";
        $getCourseDetails = mysqli_query($conn, $sqlGetCourseDetails);
        while($coursedetails = mysqli_fetch_array($getCourseDetails)){
            $courseID = $coursedetails['courseID'];
        }
        $insertenrolled = "INSERT INTO tblenrolledsubjects(studentNumber, subjectCode, courseID) VALUES($accountID, '$subject_code', $courseID)";
        $queryenrolled = mysqli_query($conn, $insertenrolled);

        $res = mysqli_query($conn, $sql);
        if($res){
            echo "<script>window.open('irregular_enroll.php#subject-container', 'self')</script>";
        die();
        }


     }   
        
?>
