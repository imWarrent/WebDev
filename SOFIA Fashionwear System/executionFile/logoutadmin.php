<?php
    session_start();
    ob_start();
    session_destroy();
    echo $_SESSION['loggedin'];
    echo header('Location: ../adminlogin.php');
?>