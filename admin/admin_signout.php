<?php
    session_start();
    session_destroy();
    header("Location: ../login-sginup/admin_login.php");
    die;
?>
