<?php
    session_start();
    if((!isset($_SESSION['logged_in'])) || ($_SESSION['logged_in'] == false) ){
        header('Location: ../logowanie');
        exit();
    }
    unset($_SESSION['logged_in']);
    session_unset();
    session_destroy();
    header('Location: ../logowanie');