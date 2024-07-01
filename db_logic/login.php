<?php
    session_start();
    
    if((!isset($_POST['email'])) || !isset($_POST['password'])) {
        header('Location: ../logowanie');
        exit();
    }

    require_once "connect.php";

    $table = "users";
    $email = htmlentities($_POST['email'], ENT_QUOTES, "UTF-8");

    mysqli_report(MYSQLI_REPORT_STRICT);
    try{
        $connection = new mysqli($host,$db_user,$db_password,$db_name);
        if($result = $connection->query(
            sprintf("SELECT * FROM $table WHERE email='%s'",
            mysqli_real_escape_string($connection, $email))
        ) AND $result->num_rows == 1) {
            $user_data = $result->fetch_assoc();

            if( password_verify($_POST['password'], $user_data['password']) == false ) {
                unset($_SESSION['logged_in']);
                $_SESSION['error_login'] = '<span class="error">Nieprawidłowy login lub hasło.</span>';
                header('Location: ../logowanie');
                exit();
            }

            $_SESSION['user_name'] = $user_data['user_name'];
            $_SESSION['email'] = $user_data['email'];
            $_SESSION['id'] = $user_data['id'];
            $result->free_result();
            unset($_SESSION['error_login']);
            $_SESSION['logged_in'] = true;
            //header('Location: ../game_logic/wioska');
            header('Location: get_user_data.php');
        } else {
            unset($_SESSION['logged_in']);
            $_SESSION['error_login'] = '<span class="error">Nieprawidłowy login lub hasło.</span>';
            header('Location: ../logowanie');
        }
        $connection->close();
    }
    catch(Exception $e)
    {
        echo '<span style="color:red"> Błąd servera. Proszę spróbować później.</span>';
    }