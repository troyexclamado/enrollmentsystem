<?php
    include("dbconnection.php");

    if(isset($_POST['date']) || isset($_POST['startTime']) || isset($_POST['endTime'])){
        $date = $_POST['date'];
        $startTime = $_POST['startTime'];
        // $date = date("Y-m-d h:i:sa", $getdate);
        // echo $date;
        $endTime = $_POST['endTime'];
        
        // $query12 = "SELECT courseID FROM tblcoursedetails".(empty($course) ? (empty($year) ? : " WHERE year = $year") : " WHERE courseAbbr = '$course'"). (empty($year) ? "": " AND year = $year");

        $stringquery = "SELECT * FROM tblactivitylog";
        if(empty($date)){
            if(empty($startTime)){
                if(empty($endTime)){
                    $stringquery .= "";
                } else {
                    $stringquery .= " WHERE TIME(date) <= '$endTime'";
                }
            } else {
                $stringquery .= " WHERE TIME(date) >= '$startTime'";
                if(empty($endTime)){
                    $stringquery .= "";
                } else {
                    $stringquery .= " AND TIME(date) <= '$endTime'";
                }
            }
        } else {
            $stringquery .= " WHERE DATE(date) = '$date'";
            if(empty($startTime)){
                if(empty($endTime)){
                    $stringquery .= "";
                } else {
                    $stringquery .= " AND TIME(date) <= '$endTime'";
                }
            } else {
                $stringquery .= " AND TIME(date) >= '$startTime'";
                if(empty($endTime)){
                    $stringquery .= "";
                } else {
                    $stringquery .= " AND TIME(date) <= '$endTime'";
                }
            }
        }

        $result12 = mysqli_query($conn, $stringquery);
        if(mysqli_num_rows($result12) > 0){
        ?>
            <div id="activitylogtable" class="activitylogtable">
            <table id="content-table" class="content-table">
            <thead>
                <tr>
                <th>Activity Number</th>
                <th>Activity Description</th>
                <th>Staff</th>
                <th>Date</th>
            </tr>
            </thead>
            <?php 
                while($row = mysqli_fetch_array($result12)){
                ?>
                    <tr>
                    <td><?php echo $row['activityID']?></td>
                    <td><?php echo $row['activity']?></td>
                    <td><?php echo $row['incharge']?></td>
                    <td><?php echo $row['date']?></td>
                    </tr>
                <?php
                }
            ?>
            </table>
            </div>
        <?php
        }
        else {
            echo "<h2 style='margin-left: 20px'>NO DATA FOUND</h2>";
        }
    }
?>