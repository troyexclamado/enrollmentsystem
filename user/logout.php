<?php
    session_start();
    
    unset($_SESSION['ID']);
    unset($_SESSION['Email']);
    unset($_SESSION['Password']);

    unset($_SESSION['enrolled']);
    unset($_SESSION['position']);
    unset($_SESSION['exist']);

    unset($_SESSION['studentnum']);
    unset($_SESSION['email']);

    // session_destroy();
    //  session_unset();

    echo '<script>window.location.href="index.php"</script>';
?>