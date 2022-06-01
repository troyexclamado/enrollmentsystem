<?php 
    include("dbconnection.php");

    if(isset($_POST['input'])){
        $search = $_POST['input'];
        ?>
        <div class="enrolled" id="enrolledtable">
                <table id="enrolled" class="content-table">
                    <thead>
                        <tr>
                            <th>ACCOUNT ID</th>
                            <th>NAME</th>
                            <th>DAY</th>
                            <th>TIME</th>
                        </tr>
                    </thead>
                    <?php
                        $query = "SELECT * FROM tblprofessoravailability WHERE accountID LIKE '{$search}%'";
                        $result = mysqli_query($conn, $query);
                        if(mysqli_num_rows($result) > 0){
                            while($row = mysqli_fetch_array($result)){
                                ?>
                            <tr>
                                <td><?php echo $row['accountID']?></td>
                                <td><?php
                                    $accountID = $row['accountID'];
                                    $searchname = "SELECT * FROM tblaccounts WHERE accountID = $accountID";
                                    $resultsname = mysqli_query($conn, $searchname);
                                    if(mysqli_num_rows($resultsname) > 0){
                                    $row1 = mysqli_fetch_array($resultsname);
                                    echo $row1['lastname'].', '.$row1['firstname'].' '.$row1['middlename'];
                                    }
                                ?></td>
                                <td><?php echo $row['day']?></td>
                                <td><?php echo date('h:i A', strtotime($row['startTime'])).'-'.date('h:i A', strtotime($row['endTime']))?></td>
                            </tr>
                                <?php
                            }
                        }
                    ?>
                
                </table>
            </div>
        <?php
    }
    if(isset($_POST['day']) || isset($_POST['startTime']) || isset($_POST['endTime']) || isset($_POST['subject'])){
        $day = $_POST['day'];
        $startTime = $_POST['startTime'];
        $endTime = $_POST['endTime'];
        $subject = $_POST['subject'];

        $stringquery = "SELECT * FROM tblprofessoravailability";
        if(empty($day)){
            if(empty($subject)){
                if(empty($startTime)){
                    if(empty($endTime)){
                        $stringquery .= "";
                    } else {
                        $stringquery .= " WHERE endTime >= '$endTime'";
                    }
                } else {
                    $stringquery .= " WHERE startTime <= '$startTime'";
                    if(empty($endTime)){
                        $stringquery .= "";
                    } else {
                        $stringquery .= " AND endTime >= '$endTime'";
                    }
                }
            } else {
                $stringquery .= " WHERE subject = '$subject'";
                if(empty($startTime)){
                    if(empty($endTime)){
                        $stringquery .= "";
                    } else {
                        $stringquery .= " AND endTime >= '$endTime'";
                    }
                } else {
                    $stringquery .= " AND startTime <= '$startTime'";
                    if(empty($endTime)){
                        $stringquery .= "";
                    } else {
                        $stringquery .= " AND endTime >= '$endTime'";
                    }
                }
            }
        } else {
            $stringquery .= " WHERE day = '$day'";
            if(empty($subject)){
                if(empty($startTime)){
                    if(empty($endTime)){
                        $stringquery .= "";
                    } else {
                        $stringquery .= " AND endTime >= '$endTime'";
                    }
                } else {
                    $stringquery .= " AND startTime <= '$startTime'";
                    if(empty($endTime)){
                        $stringquery .= "";
                    } else {
                        $stringquery .= " AND endTime >= '$endTime'";
                    }
                }
            } else {
                $stringquery .= " AND subject = '$subject'";
                if(empty($startTime)){
                    if(empty($endTime)){
                        $stringquery .= "";
                    } else {
                        $stringquery .= " AND endTime >= '$endTime'";
                    }
                } else {
                    $stringquery .= " AND startTime <= '$startTime'";
                    if(empty($endTime)){
                        $stringquery .= "";
                    } else {
                        $stringquery .= " AND endTime >= '$endTime'";
                    }
                }
            }
        }

        // if(empty($day)){
        //     if(empty($startTime)){
        //         if(empty($endTime)){
        //             $stringquery .= "";
        //         } else {
        //             $stringquery .= " WHERE endTime >= '$endTime'";
        //         }
        //     } else {
        //         $stringquery .= " WHERE startTime <= '$startTime'";
        //         if(empty($endTime)){
        //             $stringquery .= "";
        //         } else {
        //             $stringquery .= " and endTime >= '$endTime'";
        //         }
        //     }
        // } else {
        //     $stringquery .= " WHERE day = '$day'";
        //     if(empty($startTime)){
        //         if(empty($endTime)){
        //             $stringquery .= "";
        //         } else {
        //             $stringquery .= " and endTime >= '$endTime'";
        //         }
        //     } else {
        //         $stringquery .= " and startTime <= '$startTime'";
        //         if(empty($endTime)){
        //             $stringquery .= "";
        //         } else {
        //             $stringquery .= " and endTime >= '$endTime'";
        //         }
        //     }
        // }
        ?>
            <div class="enrolled" id="enrolledtable">
                <table id="enrolled" class="content-table">
                    <thead>
                        <tr>
                            <th>ACCOUNT ID</th>
                            <th>NAME</th>
                            <th>DAY</th>
                            <th>SUBJECT</th>
                            <th>TIME</th>
                        </tr>
                    </thead>
                    <?php
                        $result = mysqli_query($conn, $stringquery);
                        if(mysqli_num_rows($result) > 0){
                            while($row = mysqli_fetch_array($result)){
                                ?>
                            <tr>
                                <td><?php echo $row['accountID']?></td>
                                <td><?php
                                    $accountID = $row['accountID'];
                                    $searchname = "SELECT * FROM tblaccounts WHERE accountID = $accountID";
                                    $resultsname = mysqli_query($conn, $searchname);
                                    if(mysqli_num_rows($resultsname) > 0){
                                    $row1 = mysqli_fetch_array($resultsname);
                                    echo $row1['lastname'].', '.$row1['firstname'].' '.$row1['middlename'];
                                    }
                                ?></td>
                                <td><?php echo $row['day']?></td>
                                <td><?php echo $row['subject']?></td>
                                <td><?php echo date('h:i A', strtotime($row['startTime'])).'-'.date('h:i A', strtotime($row['endTime']))?></td>
                            </tr>
                                <?php
                            }
                        }
                    ?>
                
                </table>
            </div>
        <?php
    }

?>