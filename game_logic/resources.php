<?php
    session_start();
    if(!isset($_SESSION['logged_in'])){
        header('Location: ../logowanie');
        exit();
    }
    ?>
<!DOCTYPE HTML>
<html lang="pl">
<head>
    <meta chrser="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <link rel="stylesheet" type="text/css" href="../style.css" />
    <title>Jakaś gierka</title>
</head>
<body>
<div id="topBar">
        <div id="player">
            <?php
                echo "Hello ".$_SESSION['user_name']."! | ".$_SESSION['email']."! | ";
            ?>
        </div>
        <div id="resources">

        </div>
        <div id="links">

        </div>
        <div id="logOut">
            <a href="log_out.php">Wyloguj</a>
        </div>
        <div style="clear:both;"></div>
    </div>
</body>
</html>