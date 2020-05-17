<?php
    session_start();
    error_reporting(0);

    $varsesion = $_SESSION['p_correocuenta'];
    if($varsesion == null || $varsesion = ''){
        die();
        header("location: ../../Vista/Login.html");
    }
    session_destroy();
    header("location: ../../Vista/Login.html");
?>