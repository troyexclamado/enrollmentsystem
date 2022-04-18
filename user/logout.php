<?php
    session_start();
    
    unset($_SESSION['ID']);
    unset($_SESSION['Email']);
    unset($_SESSION['Password']);

    echo '<script>window.location.href="index.php"</script>';
?>