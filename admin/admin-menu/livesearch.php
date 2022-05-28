<?php
    include("dbconnection.php");

    if(isset($_POST['input'])){
        $input = $_POST['input'];
        $query = "SELECT id,courseID,subjectCode,subjectDescription,subjectUnits FROM tblsubjects WHERE subjectDescription LIKE '{$input}%' UNION ALL SELECT id,courseID,subjectCode,subjectDescription,subjectUnits FROM tblsubjects WHERE subjectCode LIKE '{$input}%'";
        // $query = "SELECT * FROM tblsubjects WHERE subjectDescription LIKE '{$input}%' OR subjectCode LIKE '{$input}%'";
        $result = mysqli_query($conn, $query);

        if(mysqli_num_rows($result) > 0){?>
            <div class="subjectstable">
            <table id="myTable" class="content-table">
            <thead>
                <tr>
                    <th>SUBJECT CODE</th>
                    <th>SUBJECT DESCRIPTION</th>
                    <th>SUBJECT UNITS</th>
                    <th>COURSE, YEAR AND SECTION</th>
                    <th>ACTIONS</th>
                </tr>
            </thead>
                <?php
                    while($row = mysqli_fetch_array($result)){
                    $courseID = $row['courseID'];
                ?>
                <tr>
                    <input type="hidden" value ="<?php $row['id']?>">
                    <td><?php echo $row['subjectCode'];?></td>
                    <td><?php echo $row['subjectDescription'];?></td>
                    <td><?php echo $row['subjectUnits'];?></td>
                    <td>
                        <?php
                            $getCourseDetails = "SELECT * FROM tblcoursedetails WHERE courseID = $courseID";
                            $sqlGetCourseDetails = mysqli_query($conn, $getCourseDetails);
                            while($details = mysqli_fetch_array($sqlGetCourseDetails)){
                                echo $details['courseDescription']." ".$details['year'].$details['section'];
                            }        
                        ?>
                    </td>
                    <td>
                    <form method="POST" action="editsubject.php" onsubmit="return confirm('Do you want to edit this?')">
                        <input type="hidden" name="subjectID" value ="<?php echo $row['id']?>">
                        <button type="submit" class="accept" name="edit">EDIT</button>
                    </form>
                    <form method="POST" action="editsubject.php" onsubmit="return confirm('Do you want to delete this?')">
                        <input type="hidden" name="subjectID" value ="<?php echo $row['id']?>">
                        <button type="submit" class="reject" name="delete">DELETE</button>
                    </form>
                    </td>
                </tr>
                <?php } ?>
            </table>
            </div>
            <!-- <div class="paginationbar">
                <p>Pages</p>
                <?php
                    $page_query = "SELECT * FROM tblsubjects WHERE subjectDescription LIKE '{$input}%'";
                    $page_result = mysqli_query($conn, $page_query);
                    $total_records = mysqli_num_rows($page_result);
                    $total_pages = ceil($total_records/$record_per_page);
                    for($i = 1; $i <= $total_pages; $i++){
                        echo "<a style='color: black; padding-left: 10px;' href='Subjects.php?page=".$i."'>".$i.""."</a>";
                    }
                ?>
            </div> -->

        <?php
        } else {
            echo "<h2 style='margin-left: 20px'>NO DATA FOUND</h2>";
        }
    }
    if(isset($_POST['course']) || isset($_POST['year']) || isset($_POST['semester'])){
        $course = $_POST['course'];
        $year = $_POST['year'];
        $semester = $_POST['semester'];

        $query12 = "SELECT courseID FROM tblcoursedetails".(empty($course) ? (empty($year) ? (empty($semester) ? "" : " WHERE semester = $semester") : " WHERE year = '$year'") : " WHERE courseAbbr = '$course'". (empty($year) ? " AND semester = $semester" : " AND year = $year"). (empty($semester) ? "" : " AND semester = $semester"));
        $result12 = mysqli_query($conn, $query12);
        if(mysqli_num_rows($result12) > 0){
            ?>
            <div class="subjectstable">
            <table id="myTable" class="content-table">
            <thead>
                <tr>
                    <th>SUBJECT CODE</th>
                    <th>SUBJECT DESCRIPTION</th>
                    <th>SUBJECT UNITS</th>
                    <th>COURSE, YEAR AND SECTION</th>
                    <th>ACTIONS</th>
                </tr>
            </thead>
            <?php
            while($row12 = mysqli_fetch_array($result12)){
                //echo $row12['courseID']. " ";
                $courseID = $row12['courseID'];
                $query = "SELECT * FROM tblsubjects WHERE courseID = $courseID";
                $result = mysqli_query($conn, $query);
                if(mysqli_num_rows($result) > 0){
                    while($row = mysqli_fetch_array($result)){
                    ?>
                    <tr>
                    <input type="hidden" value ="<?php $row['id']?>">
                    <td><?php echo $row['subjectCode'];?></td>
                    <td><?php echo $row['subjectDescription'];?></td>
                    <td><?php echo $row['subjectUnits'];?></td>
                    <td>
                        <?php
                            $getCourseDetails = "SELECT * FROM tblcoursedetails WHERE courseID = $courseID";
                            $sqlGetCourseDetails = mysqli_query($conn, $getCourseDetails);
                            while($details = mysqli_fetch_array($sqlGetCourseDetails)){
                                echo $details['courseDescription']." ".$details['year'].$details['section'];
                            }        
                        ?>
                    </td>
                    <td>
                    <form method="POST" action="editsubject.php" onsubmit="return confirm('Do you want to edit this?')">
                        <input type="hidden" name="subjectID" value ="<?php echo $row['id']?>">
                        <button type="submit" class="accept" name="edit">EDIT</button>
                    </form>
                    <form method="POST" action="editsubject.php" onsubmit="return confirm('Do you want to delete this?')">
                        <input type="hidden" name="subjectID" value ="<?php echo $row['id']?>">
                        <button type="submit" class="reject" name="delete">DELETE</button>
                    </form>
                    </td>
                </tr>
                    <?php
                    }
                }
            }
        } else {
            echo "<h2 style='margin-left: 20px'>NO DATA FOUND</h2>";
        }
        //$query = "SELECT * FROM tblsubjects WHERE year = $year AND semester = $semester AND course LIKE '{$course}%'";
        // $query = "SELECT * FROM tblsubjects WHERE subjectDescription LIKE '{$input}%' OR subjectCode LIKE '{$input}%'";
        
    }
?>