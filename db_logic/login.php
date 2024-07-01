<?php
    session_start();
    
    if((!isset($_POST['email'])) || !isset($_POST['password'])) {
        header('Location: ../logowanie');
        exit();
    }

    require_once "connect.php";

    $connection = @new mysqli($host,$db_user,$db_password,$db_name);
    if ($connection->connect_error) {
        die("Niestety nie udało się połączyć z bazą danych: ". $connection->connect_error);
    }

    $table = "users";

    $email = $_POST['email'];
    $password = $_POST['password'];

    $email = htmlentities($email, ENT_QUOTES, "UTF-8");
    $password = htmlentities($password, ENT_QUOTES, "UTF-8");

    if($result = @$connection->query(
        sprintf("SELECT * FROM '$table' WHERE email='%s' AND password='%s'",
        mysqli_real_escape_string($connection, $email),
        mysqli_real_escape_string($connection, $password))
    )) {
        if($result->num_rows > 0) {
            $user_data = $result->fetch_assoc();
            $_SESSION['user_name'] = $user_data['user_name'];
            $_SESSION['email'] = $user_data['email'];
            $_SESSION['id'] = $user_data['id'];
            $result->free_result();
            unset($_SESSION['error_login']);
            $_SESSION['logged_in'] = true;
            header('Location: ../game_logic/wioska');
            // header('Location: get_user_data.php');
        } else {
            unset($_SESSION['logged_in']);
            $_SESSION['error_login'] = '<span class="error">Nieprawidłowy login lub hasło.</span>';
            header('Location: ../logowanie');
        }
    }

    $connection->close();