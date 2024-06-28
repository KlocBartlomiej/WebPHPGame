<?php
    session_start();
    
    if((!isset($_POST['email'])) || (!isset($_POST['password'])) || (!isset($_POST['user_name'])) ) {
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
    $login = $_POST['user_name'];

    $sql = "SELECT * FROM $table WHERE email='$email'";
    if($result = @$connection->query($sql)) {
        if($result->num_rows > 0) {
            $_SESSION['error_register'] = '<span class="error">Ten email jest już zajęty.</span>';
            header('Location: ../rejestracja');
        } else {
            //TODO add user to the database
            unset($_SESSION['error_register']);
            header('Location: ../logowanie');
        }
    }