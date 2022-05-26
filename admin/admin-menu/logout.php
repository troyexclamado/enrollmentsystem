<?php
    require('dbconnection.php');
    session_start();
    //session_unset();
    
    //activity log
    $name = $_SESSION['NAME'];
    $activityquery = "INSERT INTO tblactivitylog(activity, incharge) VALUES('LOGGED OUT', '$name')";
    $activityresult = mysqli_query($conn, $activityquery);
    
    if($activityresult){
        unset($_SESSION['POSITION']);
        unset($_SESSION['PROFESSOR_ID']);
        unset($_SESSION['NAME']);
        echo '<script>window.location.href="/enrollmentsystem/admin/admin-login/index.html"</script>';
    }

    
?>