<?php
    session_start();
    if((isset($_SESSION['logged_in'])) && ($_SESSION['logged_in'] == true) ){
        header('Location: ./game_logic/wioska');
        exit();
    }
    ?>
<!DOCTYPE HTML>
<html lang="pl">
<head>
    <meta chrser="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <link rel="stylesheet" type="text/css" href="style.css" />
    <title>Jakaś gierka</title>
</head>
<body>
    
    <form id="LoginForm" action="db_logic/login.php" method="post">
        <h2>Zaloguj się</h2>
        <b>Email:</b><br/>
        <input type="text" name="email" />
        <br/>
        <b>Hasło:</b><br/>
        <input type="password" name="password" />
        <?php
            if(isset($_SESSION['error_login'])) {
                echo "<br/>".$_SESSION["error_login"];
            }
        ?>
        <br/>
        <p> Jeśli nie posiadasz konta, możesz stworzyć je <a href="rejestracja">tutaj</a>.</p>
        <br/>
        <input type="submit" value="Zaloguj się" />
    </form>
    
</body>
</html>