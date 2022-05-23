<?php
require('includes/db.inc.php');
if(isset($_POST['submit'])){
    $studentNumber = $_POST['studentNumber'];

    $query = "DELETE FROM tblstudents WHERE studentNumber= $studentNumber";
    $result = mysqli_query($conn, $query);
    if($result){
        echo '<script>alert("success")</script>';
        if(isset($_SESSION['enrolled'])){
            unset($_SESSION['enrolled']);
        }
        if(isset($_SESSION['position'])){
            unset($_SESSION['position']);
        }
        echo '<script>window.location.href="/enrollmentsystem/user/index.php"</script>';
    }else {
        echo '<script>alert("failed")</script>';
    }
}
?>