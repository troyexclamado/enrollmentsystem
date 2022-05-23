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
?>