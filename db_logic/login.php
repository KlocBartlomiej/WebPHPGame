<?php
    session_start();
    require_once "connect.php";

    $connection = @new mysqli($host,$db_user,$db_password,$db_name);
    if ($connection->connect_error) {
        die("Niestety nie udało się połączyć z bazą danych: ". $connection->connect_error);
    }

    $table = "users";

    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM $table WHERE email='$email' AND password='$password'";
    if($result = @$connection->query($sql)) {
        if($result->num_rows > 0) {
            $user_data = $result->fetch_assoc();
            $_SESSION['user_name'] = $user_data['user_name'];
            $_SESSION['email'] = $user_data['email'];
            $_SESSION['id'] = $user_data['id'];
            $result->free_result();
            unset($_SESSION['error']);
            header('Location: ../game_logic/village.php');
        } else {
            $_SESSION['error'] = '<span class="error">Nieprawidłowy login lub hasło.</span>';
            header('Location: ../index.php');
        }
    }

    $connection->close();