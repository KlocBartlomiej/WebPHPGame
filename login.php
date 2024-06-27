<!DOCTYPE HTML>
<html lang="pl">
<head>
    <meta chrser="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <link rel="stylesheet" type="text/css" href="style.css" />
    <title>Jakaś gierka</title>
</head>
<body>

    <?php
        $login = $_POST['login'];
        $password = $_POST['password'];

        echo<<<END
            Cześć $login, Twoje hasło to $password
        END
    ?>
</body>
</html>