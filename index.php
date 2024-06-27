<?php
    session_start();
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
    
    <form action="db_logic/login.php" method="post">
        <h2>Zaloguj się</h2>
        <b>Email:</b>
        <input type="text" name="email" />
        <br/>
        <b>Hasło:</b>
        <input type="password" name="password" />
        <br/><br/>
        <?php
            if(isset($_SESSION['error'])) {
                echo $_SESSION["error"]."<br/>";
            }
        ?>
        Jeśli nie posiadasz konta, możesz stworzyć je <a href="registerForm.php">tutaj</a>.
        <br/><br/>
        <input type="submit" value="Zaloguj się" />
    </form>
    
</body>
</html>