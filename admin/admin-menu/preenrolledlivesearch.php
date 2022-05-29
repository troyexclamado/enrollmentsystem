<?php
    include("dbconnection.php");

    if(isset($_POST['input'])){
        $search = $_POST['input'];
        $sql = "SELECT * FROM tblstudents WHERE statusID = '0' AND studentNumber LIKE '{$search}%' ";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) > 0){
            ?>
        <div class="preenrolled">
        <table id="preenrolled" class="content-table">
                <thead>
                    <tr>
                        <th>STUDENT NUMBER</th>
                        <th>NAME</th>
                        <th>COURSE AND YEAR</th>
                        <th>DATE OF<br>APPLICATION</th>
                        <th>VIEW<br>INFORMATION</th>
                        <th>PAYMENT<br>INFORMATION</th>
                        <th>COMMAND</th>
                    </tr>
                </thead>
            <!-- PHP CODE TO FETCH DATA FROM ROWS-->
                <?php
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                 ?>
                            <tr>
                                <!-- <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" > -->
                                    <td>
                                        <p><?=$row['studentNumber']?></p>
                                    </td>
                                    <td>
                                        <p><?php 
                                            //KUKUNIN YUNG FULLNAME SA TBLACCOUNTS
                                            $studentNumber = $row['studentNumber'];
                                            $getFullname = "SELECT * FROM tblstudentaccounts WHERE studentNumber = $studentNumber";
                                            $sqlGetName = mysqli_query($conn, $getFullname);

                                            while($name_result = mysqli_fetch_array($sqlGetName)) {
                                            ?>
                                            <p><?php echo $name_result['lastname'].", ".$name_result['firstname']." ".$name_result['middlename']?></p>
                                            <?php
                                            }
                                            ?></p>
                                    </td>
                                    <td>
                                        <p><?php 
                                        $courseID = $row['courseID'];
                                        $query1 = "SELECT * FROM tblcoursedetails WHERE courseID = $courseID";
                                        $result1 = mysqli_query($conn, $query1);
                                        if(mysqli_num_rows($result1) > 0){
                                            $row1 = mysqli_fetch_array($result1);
                                            echo $row1['courseAbbr'].' '.$row1['year'];
                                        }
                                        ?></p>
                                    </td>
                                    <td>
                                        <p><?=$row['dateOfEnrollment']?></p>
                                    </td>
                                    <td>
                                        <form method="POST" action="seedetailspreenrolled.php">
                                        <button type="submit" name="viewDetails" value="<?=$row['studentNumber']?>" >View Details</button>
                                        </form>
                                    </td>
                                    </form>
                                    <td>
                                        <?php 
                                            $studentNumber = $row['studentNumber'];
                                            $query = "SELECT * FROM tblstudenttransactions WHERE studentNumber = $studentNumber";
                                            $sqlquery = mysqli_query($conn, $query);
                                            if(mysqli_num_rows($sqlquery) > 0){
                                                ?>
                                                <form method="POST" action="updatestudenttransaction.php">
                                                    <input type="hidden" name = "studentNumber" value="<?php echo $row['studentNumber']?>" >
                                                    <input type ="submit" name="view" value="Update/View Transaction" class="okay">
                                                </form>
                                                <?php
                                            } else {
                                                ?>
                                                <form method="POST" action="studenttransaction.php">
                                                <input type="hidden" name = "studentNumber" value="<?php echo $row['studentNumber']?>">
                                                <input type ="submit" name="add" value="Add Transaction" class="pending">
                                                </form>
                                                <?php
                                            }
                                        ?>
                                        
                                    </td>
                                    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?> " onsubmit="return confirm('Do you want to accept/reject this?')">
                                    <td>
                                        <button type="submit" name="btncmdAccept" id="btncmdAccept" value="<?=$row['studentNumber']?>" class="accept">Accept</button>
                                        <button type="submit" name="btnreject" id="btnreject" value="<?=$row['studentNumber']?>" class="reject">Reject</button>
                                    </td>
                                </form>
                            </tr>
            <?php
                        }//end of while loop
                     }//if ($result->num_rows > 0) end bracket
                // $conn->close();
                $preID ="";
                $max = "";
                if(isset($_POST['btncmdAccept'])){
                    $studentNumber = $_POST['btncmdAccept'];
                    $query = "SELECT * FROM tblstudenttransactions WHERE studentNumber = $studentNumber";
                    $sqlquery = mysqli_query($conn, $query);
                    if(mysqli_num_rows($sqlquery) > 0){
                        insertSql($studentNumber);
                    } else {
                        echo '<script>alert("Student does not have payment yet. Enrollment failed.")</script>';         
                    }
                }


                if(isset($_POST['btnreject'])){
                    $studentNumber  = $_POST['btnreject'];
                    //echo $preID;
                    //$deleteinfo = "delete from tblstudentinfo where accountID = '$preID'";
                    $rejectinfo = "update tblstudentinfo set statusID='3' where accountID = $studentNumber";
                    $resultrejectinfo = $conn->query($rejectinfo);
                    if($resultrejectinfo){
                        echo "deleted";
                        echo "<script>window.location.href='Pre-Enrolled.php';</script>";
                    }else{
                        echo "invalid";
                    }
                }


                function insertSql($studentNum){
                    //echo $preID;
                    include('dbconnection.php');
                        $datenow = date('Y-m-d');
                        $getCourseID = "SELECT * FROM tblstudents WHERE studentNumber = $studentNum";
                        $sqlGetCourseID = mysqli_query($conn, $getCourseID);
                        if(mysqli_num_rows($sqlGetCourseID) > 0){
                            $courseID = mysqli_fetch_array($sqlGetCourseID);
                            
                            $data_courseID = $courseID['courseID'];
                            $studentType = $courseID['studentType'];

                            $availablestudents = 0;
                            $tries = 3;
                            while(($availablestudents <= 0) AND ($tries > 0)){
                                $sectioning = "SELECT * FROM tblcoursedetails WHERE courseID = $data_courseID";
                                $sqlsectioning = mysqli_query($conn, $sectioning);
                                if(mysqli_num_rows($sqlsectioning) > 0){
                                    $rows = mysqli_fetch_array($sqlsectioning);
                                    $availableslots = $rows['availableslots'];
                                    if($availableslots > 0){
                                        $availablestudents = $availableslots;
                                    } else {
                                        $data_courseID = $data_courseID + 1;
                                        $tries = $tries - 1;
                                    }
                                }
                            }
                            if($tries <= 0){
                                echo "<script>alert('No available sections')</script>";
                            } else {
                                $updateavailableslots = "UPDATE tblcoursedetails SET availableslots = ($availablestudents-1) WHERE courseID = $data_courseID";
                                $sqlupdate1 = mysqli_query($conn, $updateavailableslots);
                                if($sqlupdate1){
                                    echo 'yey';
                                }
                                $updatecouseID = "UPDATE tblstudents SET courseID = $data_courseID WHERE studentNumber = $studentNum";
                                $sqlupdate = mysqli_query($conn, $updatecouseID);
                                if($sqlupdate){
                                    echo 'yey';
                                }

                                if($studentType == "REGULAR"){
                                    $getSubjects = "SELECT * FROM tblsubjects WHERE courseID = $data_courseID";
                                    $sqlGetSubjects = mysqli_query($conn, $getSubjects);
                                    if(mysqli_num_rows($sqlGetSubjects) > 0){
                                        while($subjects = mysqli_fetch_array($sqlGetSubjects)){
                                            $subjectCode = $subjects['subjectCode'];
                                            $enrollSubjects = "INSERT INTO tblenrolledsubjects(studentNumber, subjectCode) VALUES($studentNum, '$subjectCode')";
                                            $sqlEnrollSubjects = mysqli_query($conn, $enrollSubjects);
                                        }
                                    }
                                }else if ($studentType = "IRREGULAR"){
                                    $getSubjects = "SELECT * FROM tblbacksubjects WHERE studentNumber = $studentNum AND (status = 'Required' OR status = 'Taken')";
                                    $sqlGetSubjects = mysqli_query($conn, $getSubjects);
                                    if(mysqli_num_rows($sqlGetSubjects) > 0){
                                        while($subjects = mysqli_fetch_array($sqlGetSubjects)){
                                            $subjectCode = $subjects['subjectCode'];
                                            $enrollSubjects = "INSERT INTO tblenrolledsubjects(studentNumber, subjectCode) VALUES($studentNum, '$subjectCode')";
                                            $sqlEnrollSubjects = mysqli_query($conn, $enrollSubjects);
                                        }
                                    }
                
                                }

                                $sqlinsert = "UPDATE tblstudents SET dateOfEnrollment = '$datenow', statusID = 1 WHERE studentNumber = $studentNum";
                                $updatedate = mysqli_query($conn, $sqlinsert);
                                if($updatedate){
                                    echo "<script>window.location.href='Pre-Enrolled.php';</script>";
                                }else {
                                    echo "<script>alert('Failed to Insert Data')</script>";
                                    echo "<script>window.location.href='Pre-Enrolled.php';</script>";
                                }
                            }
                        }
                }
                // $conn->close();
            ?>
            </table>
            </div>
            
            <?php
        }else {
            echo "<h2 style='margin-left: 20px'>NO DATA FOUND</h2>";
        }
    }
    if(isset($_POST['course']) || isset($_POST['year']) || isset($_POST['date'])){
        $course = $_POST['course'];
        $year = $_POST['year'];
        $date = $_POST['date'];
        //echo '<script>alert('.$date.')</script>';
        // $query12 = "SELECT courseID FROM tblcoursedetails".(empty($course) ? (empty($year) ? : " WHERE year = $year") : " WHERE courseAbbr = '$course'"). (empty($year) ? "": " AND year = $year");
        $query12 = "SELECT courseID FROM tblcoursedetails";
        if(empty($course)){
            if(empty($year)){
                $query12 .= "";
            } else {
                $query12 .= " WHERE year = $year";
            }
        } else {
            $query12 .= " WHERE courseAbbr = '$course'";
            if(empty($year)){
                $query12 .= "";
            } else {
                $query12 .= " AND year = $year";
            }
        }
        $result12 = mysqli_query($conn, $query12);
        
        if(mysqli_num_rows($result12) > 0){
        ?>
            <div class="preenrolled">
            <table id="preenrolled" class="content-table">
                <thead>
                    <tr>
                        <th>STUDENT NUMBER</th>
                        <th>NAME</th>
                        <th>COURSE AND YEAR</th>
                        <th>DATE OF<br>APPLICATION</th>
                        <th>VIEW<br>INFORMATION</th>
                        <th>PAYMENT<br>INFORMATION</th>
                        <th>COMMAND</th>
                    </tr>
                </thead>
                <?php
                while($row12 = mysqli_fetch_array($result12)){
                $courseID = $row12['courseID'];
                    $query = "SELECT * from tblstudents WHERE statusID = 0 AND courseID = $courseID".(empty($date) ? "" : " AND dateOfEnrollment = '$date'");
                    $result = mysqli_query($conn, $query);
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                        ?>
                            <tr>
                                <!-- <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" > -->
                                    <td>
                                        <p><?=$row['studentNumber']?></p>
                                    </td>
                                    <td>
                                        <p><?php 
                                            //KUKUNIN YUNG FULLNAME SA TBLACCOUNTS
                                            $studentNumber = $row['studentNumber'];
                                            $getFullname = "SELECT * FROM tblstudentaccounts WHERE studentNumber = $studentNumber";
                                            $sqlGetName = mysqli_query($conn, $getFullname);

                                            while($name_result = mysqli_fetch_array($sqlGetName)) {
                                            ?>
                                            <p><?php echo $name_result['lastname'].", ".$name_result['firstname']." ".$name_result['middlename']?></p>
                                            <?php
                                            }
                                            ?></p>
                                    </td>
                                    <td>
                                        <p><?php 
                                        $courseID = $row['courseID'];
                                        $query1 = "SELECT * FROM tblcoursedetails WHERE courseID = $courseID";
                                        $result1 = mysqli_query($conn, $query1);
                                        if(mysqli_num_rows($result1) > 0){
                                            $row1 = mysqli_fetch_array($result1);
                                            echo $row1['courseAbbr'].' '.$row1['year'];
                                        }
                                        ?></p>
                                    </td>
                                    <td>
                                        <p><?=$row['dateOfEnrollment']?></p>
                                    </td>
                                    <td>
                                        <form method="POST" action="seedetailspreenrolled.php">
                                        <button type="submit" name="viewDetails" value="<?=$row['studentNumber']?>" >View Details</button>
                                        </form>
                                    </td>
                                    </form>
                                    <td>
                                        <?php 
                                            $studentNumber = $row['studentNumber'];
                                            $query = "SELECT * FROM tblstudenttransactions WHERE studentNumber = $studentNumber";
                                            $sqlquery = mysqli_query($conn, $query);
                                            if(mysqli_num_rows($sqlquery) > 0){
                                                ?>
                                                <form method="POST" action="updatestudenttransaction.php">
                                                    <input type="hidden" name = "studentNumber" value="<?php echo $row['studentNumber']?>" >
                                                    <input type ="submit" name="view" value="Update/View Transaction" class="okay">
                                                </form>
                                                <?php
                                            } else {
                                                ?>
                                                <form method="POST" action="studenttransaction.php">
                                                <input type="hidden" name = "studentNumber" value="<?php echo $row['studentNumber']?>">
                                                <input type ="submit" name="add" value="Add Transaction" class="pending">
                                                </form>
                                                <?php
                                            }
                                        ?>
                                        
                                    </td>
                                    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?> " onsubmit="return confirm('Do you want to accept/reject this?')">
                                    <td>
                                        <button type="submit" name="btncmdAccept" id="btncmdAccept" value="<?=$row['studentNumber']?>" class="accept">Accept</button>
                                        <button type="submit" name="btnreject" id="btnreject" value="<?=$row['studentNumber']?>" class="reject">Reject</button>
                                    </td>
                                </form>
                            </tr>
            <?php
                        }//end of while loop
                     }
                     
                 ?>
        <?php
            }
        } else {
            echo "<h2 style='margin-left: 20px'>NO DATA FOUND</h2>";
        }
    }
?>