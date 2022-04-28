<?php
    session_start();
    
    unset($_SESSION['ID']);
    unset($_SESSION['Email']);
    unset($_SESSION['Password']);

    session_unset();
    echo '<script>window.location.href="index.php"</script>';
?>