<?php
    session_start();

    if((!isset($_SESSION['logged_in'])) || ($_SESSION['logged_in'] == false) ){
        header('Location: ../logowanie');
        exit();
    }

    require_once "connect.php";

    $connection = @new mysqli($host,$db_user,$db_password,$db_name);
    if ($connection->connect_error) {
        die("Niestety nie udało się połączyć z bazą danych: ". $connection->connect_error);
    }

    $table = "resources";

    $sql = "SELECT * FROM $table WHERE user_id='$_SESSION[id]'";
    if($result = @$connection->query($sql)) {
        if($result->num_rows > 0) {
            $user_data = $result->fetch_assoc();
            // TODO resourcecs to $_SESSION 
            $result->free_result();
            header('Location: ../game_logic/wioska');
        }
    }

    $connection->close();