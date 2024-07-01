<?php
    session_start();
    
    if((!isset($_POST['email'])) || (!isset($_POST['password'])) || (!isset($_POST['user_name'])) ) {
        header('Location: ../logowanie');
        exit();
    }

    if(!isset($_POST['accept'])) {
        $_SESSION['error_register'] = '<span class="error">Regulamin nie został zaakceptowany.</span>';
        header('Location: ../rejestracja');
        exit();
    }

    require_once "connect.php";

    $table = "users";

    $email = $_POST['email'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];
    $user_name = $_POST['user_name'];

    if( (strlen($email) == 0)
        OR ((filter_var($email, FILTER_SANITIZE_EMAIL) != $email)
        AND (filter_var($email, FILTER_VALIDATE_EMAIL) == false)) ) {
        $_SESSION['error_register'] = '<span class="error">Nieprawidłowy email.</span>';
        header('Location: ../rejestracja');
        exit();
    }

    if( (strlen($password) == 0) OR ($password != $password2) ) {
        $_SESSION['error_register'] = '<span class="error">Hasła nie są identyczne.</span>';
        header('Location: ../rejestracja');
        exit();
    }

    if( (strlen($password) < 8) OR (strlen($password) > 20) ) {
        $_SESSION['error_register'] = '<span class="error">Hasło jest zbyt długie lub krótkie (8-20 znaków).</span>';
        header('Location: ../rejestracja');
        exit();
    }

    if( (strlen($user_name) < 8) OR (strlen($user_name) > 20)) {
        $_SESSION['error_register'] = '<span class="error">Twoja nazwa użytkownika jest zbyt długa lub krótka (8-20 znaków).</span>';
        header('Location: ../rejestracja');
        exit();
    }

    $email = htmlentities($email, ENT_QUOTES, "UTF-8");
    $password = password_hash($password, PASSWORD_DEFAULT);
    $user_name = htmlentities($user_name, ENT_QUOTES, "UTF-8");

    mysqli_report(MYSQLI_REPORT_STRICT);
    try{
        $connection = new mysqli($host,$db_user,$db_password,$db_name);

        if($result = $connection->query(
            sprintf("SELECT * FROM $table WHERE email='%s' OR user_name='%s'",
            mysqli_real_escape_string($connection,$email),
            mysqli_real_escape_string($connection,$user_name))
        ) AND $result->num_rows == 0) {
            $connection->query("INSERT INTO users (email, password, user_name) VALUES ('$email', '$password', '$user_name');");
            if($result = $connection->query(
                sprintf("SELECT * FROM $table WHERE email='%s' OR user_name='%s'",
                mysqli_real_escape_string($connection,$email),
                mysqli_real_escape_string($connection,$user_name)))) {
                    $user_id = $result->fetch_assoc()['id'];
                    $result->free_result();
                }
            $connection->query("INSERT INTO resources (wood, iron, clay, wheat, money,id_user) VALUES (10,10,10,20,100,'$user_id');");
            $connection->query("INSERT INTO buildings (barracksLvl, hideoutLvl, warehouseLvl, defensiveWallsLvl, palaceLvl, TownHallLvl, marketLvl, stableLvl, id_user) VALUES (0,0,0,1,0,1,0,0,'$user_id')");
            unset($_SESSION['error_register']);
            $_SESSION['error_login'] = '<span class="error">Twoje konto zostało pomyslnie założone.</span>';
            header('Location: ../logowanie');
        } else {
            $_SESSION['error_register'] = '<span class="error">Ten email lub nazwa użytkownika jest już zajęta.</span>';
            header('Location: ../rejestracja');
        }
        $connection->close();
    }
    catch(Exception $e)
    {
        echo '<span style="color:red"> Błąd servera. Proszę spróbować później.</span>';
    }