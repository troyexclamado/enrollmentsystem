<?php 
    include("dbconnection.php");

    if(isset($_POST['input'])){
        $search = $_POST['input'];
        $withstudentnum = "SELECT * FROM tblstudents WHERE statusID = '1' AND studentNumber LIKE '{$search}%'";
        $resultwithstudentnum = mysqli_query($conn, $withstudentnum);
        if(mysqli_num_rows($resultwithstudentnum) > 0){
            ?>
            <div class="enrolled">
            <table class="content-table">
                <thead>
                    <tr>
                        <th>STUDENT NUMBER</th>
                        <th>NAME</th>
                        <th>DATE ENROLLED</th>
                        <th>VIEW INFORMATION</th>
                    </tr>
                </thead>
            <!-- PHP CODE TO FETCH DATA FROM ROWS-->
                <?php
                        while($row = $resultwithstudentnum->fetch_assoc()) 
                        {
                 ?>
                            <tr>
                                <!-- <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" > -->
                                    <td>
                                        <p><?=$row['studentNumber']?></p>
                                    </td>
                                    <td>
                                    <?php 
                                        //KUKUNIN YUNG FULLNAME SA TBLACCOUNTS
                                        $studentNumber = $row['studentNumber'];
                                        $getFullname = "SELECT * FROM tblstudentaccounts WHERE studentNumber = $studentNumber";
                                        $sqlGetName = mysqli_query($conn, $getFullname);

                                        while($name_result = mysqli_fetch_array($sqlGetName)) {
                                        ?>
                                        <p><?php echo $name_result['lastname'].", ".$name_result['firstname']." ".$name_result['middlename']?></p>
                                        <?php
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <p><?=$row['dateOfEnrollment']?></p>
                                    </td>
                                    <td>
                                        <form method="POST" action="seedetailsenrolled.php">
                                        <button type="submit" name="viewDetails" value="<?=$row['studentNumber']?>" >View Details</button>
                                        </form>
                                    </td>
                                </form>
                            </tr>
            <?php
                        }//end of while loop
            ?>
            </table>
                    </div>
<?php
    }else {
        echo "<h2 style='margin-left: 20px'>NO DATA FOUND</h2>";
    }
    }
    if(isset($_POST['course']) || isset($_POST['year']) || isset($_POST['semester'])){
        $course = $_POST['course'];
        $year = $_POST['year'];
        $date = $_POST['date'];

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
            <div class="enrolled">
            <table class="content-table">
                <thead>
                    <tr>
                        <th>STUDENT NUMBER</th>
                        <th>NAME</th>
                        <th>COURSE, YEAR AND SECTION</th>
                        <th>DATE ENROLLED</th>
                        <th>VIEW INFORMATION</th>
                    </tr>
                </thead>
                <?php
                while($row12 = mysqli_fetch_array($result12)){
                    $courseID = $row12['courseID'];
                        $query = "SELECT * from tblstudents WHERE statusID = 1 AND courseID = $courseID".(empty($date) ? "" : " AND dateOfEnrollment = '$date'");
                        $result = mysqli_query($conn, $query);
                        if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) 
                        {
                 ?>
                            <tr>
                                <!-- <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" > -->
                                    <td>
                                        <p><?=$row['studentNumber']?></p>
                                    </td>
                                    <td>
                                    <?php 
                                        //KUKUNIN YUNG FULLNAME SA TBLACCOUNTS
                                        $studentNumber = $row['studentNumber'];
                                        $getFullname = "SELECT * FROM tblstudentaccounts WHERE studentNumber = $studentNumber";
                                        $sqlGetName = mysqli_query($conn, $getFullname);

                                        while($name_result = mysqli_fetch_array($sqlGetName)) {
                                        ?>
                                        <p><?php echo $name_result['lastname'].", ".$name_result['firstname']." ".$name_result['middlename']?></p>
                                        <?php
                                        }
                                        ?>
                                    </td>
                                    <td><p><?php
                                        $courseID = $row['courseID'];
                                        $query = "SELECT * FROM tblcoursedetails WHERE courseID = $courseID";
                                        $results = mysqli_query($conn, $query);
                                        if(mysqli_num_rows($results) > 0){
                                            $rows = mysqli_fetch_array($results);
                                            echo $rows['courseAbbr'].' '.$rows['year'].$rows['section'];
                                        }

                                        ?>
                                    </p>
                                    </td>
                                    <td>
                                        <p><?=$row['dateOfEnrollment']?></p>
                                    </td>
                                    <td>
                                        <form method="POST" action="seedetailsenrolled.php">
                                        <button type="submit" name="viewDetails" value="<?=$row['studentNumber']?>" >View Details</button>
                                        </form>
                                    </td>
                                </form>
                            </tr>
                        <?php
                                    }
                                }
                            }//end of while loop
                        ?>
                        </table>
                    </div>
        <?php
        }
    }
?>