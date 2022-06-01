<?php
    include("dbconnection.php");

    if(isset($_POST['course']) || isset($_POST['year']) || isset($_POST['section'])){
        $course = $_POST['course'];
        $year = $_POST['year'];
        $section = $_POST['section'];

        // $query12 = "SELECT courseID FROM tblcoursedetails".(empty($course) ? (empty($year) ? : " WHERE year = $year") : " WHERE courseAbbr = '$course'"). (empty($year) ? "": " AND year = $year");

        $stringquery = "SELECT * FROM tblcoursedetails";
        if(empty($course)){
            if(empty($year)){
                if(empty($section)){
                    $stringquery .= "";
                } else {
                    $stringquery .= " WHERE section = '$section'";
                }
            } else {
                $stringquery .= " WHERE year = $year";
                if(empty($section)){
                    $stringquery .= "";
                } else {
                    $stringquery .= " AND section = '$section'";
                }
            }
        } else {
            $stringquery .= " WHERE courseAbbr = '$course'";
            if(empty($year)){
                if(empty($section)){
                    $stringquery .= "";
                } else {
                    $stringquery .= " AND section = '$section'";
                }
            } else {
                $stringquery .= " AND year = $year";
                if(empty($section)){
                    $stringquery .= "";
                } else {
                    $stringquery .= " AND section = '$section'";
                }
            }
        }

        $result12 = mysqli_query($conn, $stringquery);
        if(mysqli_num_rows($result12) > 0){
        ?>
            <div id="coursestable" class="coursestable">
            <table id="content-table" class="content-table">
            <thead>
                <tr>
                        <th>COURSE ABBREVIATION</th>
                        <th>COURSE DESCRIPTION</th>
                        <th>YEAR</th>
                        <th>SECTION</th>
                        <th>AVAILABLE<br>SLOT</th>
                        <th>SEMESTER</th>
                        <th>ACTION</th>
            </tr>
            </thead>
            <tr>
                <?php
                    while($courses = mysqli_fetch_array($result12)){
                ?>
                <td><?php echo $courses['courseAbbr']?></td>
                <td><?php echo $courses['courseDescription']?></td>
                <td><?php echo $courses['year']?></td>
                <td><?php echo $courses['section']?></td>
                <td><?php echo $courses['availableslots']?></td>
                <td><?php echo $courses['semester']?></td>
                <td>
                <form action="editcoursedetails.php" method="POST" onsubmit="return confirm('Do you want to edit/delete this?')">
                    <input type="hidden" name="courseID" value="<?php echo $courses['courseID']?>">
                    <button name= "btnedit" id="myBtn1">EDIT</button>
                    <button name= "btndel" id="myBtn2">DELETE</button>
                </form>
                </td>
            </tr>
            <?php }?>
            </div>
            </table>
            </div>
        <?php
        }
    }
?>