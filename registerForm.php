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

    <form id="RegistrationForm" action="db_logic/register.php" method="post">
        <h2>Zarejestruj się</h2>
        <b>Email:</b><br/>
        <input type="text" name="email" />
        <br/>
        <b>Hasło:</b><br/>
        <input type="password" name="password" />
        <br/>
        <b>Powtórz hasło:</b><br/>
        <input type="password" name="password2" />
        <br/>
        <b>Nazwa użytkownika:</b><br/>
        <input type="text" name="user_name" />
        <br/>
        <label>
            <input type="checkbox" name="accept" />
            <b>Akceptuję </b>
        </label>
        <a href="regulamin">regulamin</a>
        <br/><br/>
        <p> <a href="logowanie">Powrót do logowania.</a></p>
        <?php
            if(isset($_SESSION['error_register'])) {
                echo "<br/>".$_SESSION["error_register"]."<br/>";
            }
        ?>
        <br/><br/>
        <input type="submit" value="Zarejestruj się" />
    </form>
</body>
</html>