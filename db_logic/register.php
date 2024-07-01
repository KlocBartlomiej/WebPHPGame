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
    $password2 = $_POST['password2'];
    $login = $_POST['user_name'];

    $email = htmlentities($email, ENT_QUOTES, "UTF-8");
    $password = htmlentities($password, ENT_QUOTES, "UTF-8");
    $password2 = htmlentities($password2, ENT_QUOTES, "UTF-8");
    $login = htmlentities($login, ENT_QUOTES, "UTF-8");

    if($result = @$connection->query(
        sprintf("SELECT * FROM $table WHERE email='%s'",
        mysqli_real_escape_string($connection,$email))
        )) {
        if($result->num_rows > 0) {
            $_SESSION['error_register'] = '<span class="error">Ten email jest już zajęty.</span>';
            header('Location: ../rejestracja');
        } else {
            //TODO add user to the database
            unset($_SESSION['error_register']);
            header('Location: ../logowanie');
        }
    }