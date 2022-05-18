<?php 
    include("dbconnection.php");

    if(isset($_POST['input'])){
        $search = $_POST['input'];
        $query = "SELECT * FROM tblstudentaccounts WHERE studentNumber LIKE '{$search}%' OR firstname LIKE '{$search}%' OR middlename LIKE '{$search}%' OR lastname LIKE '{$search}%'";
        $result = mysqli_query($conn, $query);
        if(mysqli_num_rows($result) > 0){
            ?>
            <div class="accountstable">
                
            <table id="myTable1" class="content-table">
                
            <thead>
                <tr>
                <th>STUDENT NUMBER</th>
                <th>NAME</th>
                <th>PASSWORD</th>
            </tr>
            </thead>
            <?php 
                while($rows = mysqli_fetch_array($result)){  
            ?>
            <tr>
                <td><?php echo $rows['studentNumber']?></td>
                <td><?php echo $rows['lastname'].' '.$rows['firstname'].' '.$rows['middlename']?></td>
                <td><?php echo $rows['password']?></td>
            </tr>
            <?php 
                }
            ?>
            </table>
            </div>
<?php
    }else {
        echo "<h2 style='margin-left: 20px'>NO DATA FOUND</h2>";
    }
    }
?>