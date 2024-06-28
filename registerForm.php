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

    <form action="db_logic/register.php" method="post">
        <h2>Zarejestruj się</h2>
        <b>Email:</b>
        <input type="text" name="email" />
        <br/>
        <b>Hasło:</b>
        <input type="password" name="password" />
        <br/>
        <b>Nazwa użytkownika:</b>
        <input type="text" name="user_name" />
        <br/><br/>
        <?php
            if(isset($_SESSION['error_register'])) {
                echo $_SESSION["error_register"]."<br/>";
            }
        ?>
        <br/><br/>
        <input type="submit" value="Zarejestruj się" />
    </form>
</body>
</html>