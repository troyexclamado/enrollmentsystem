<?php
    session_start();
    
    unset($_SESSION['ID']);
    unset($_SESSION['Email']);
    unset($_SESSION['Password']);

    unset($_SESSION['enrolled']);
    unset($_SESSION['position']);
    unset($_SESSION['exist']);

    // session_unset();

    echo '<script>window.location.href="index.php"</script>';
?>