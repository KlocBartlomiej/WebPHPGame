<?php
    session_start();

    if((!isset($_SESSION['logged_in'])) || ($_SESSION['logged_in'] == false) ){
        header('Location: ../logowanie');
        exit();
    }

    require_once "connect.php";

    mysqli_report(MYSQLI_REPORT_STRICT);
    try{
        $connection = @new mysqli($host,$db_user,$db_password,$db_name);
        if ($connection->connect_error) {
            die("Niestety nie udało się połączyć z bazą danych: ". $connection->connect_error);
        }

        $table = "resources";
        $sql = "SELECT * FROM $table WHERE user_id='$_SESSION[id]'";
        if($result = @$connection->query($sql)) {
            $user_data = $result->fetch_assoc();
            $_SESSION['wood'] = $user_data['wood'];
            $_SESSION['iron'] = $user_data['iron'];
            $_SESSION['clay'] = $user_data['clay'];
            $_SESSION['wheat'] = $user_data['wheat'];
            $_SESSION['money'] = $user_data['money'];
            $result->free_result();
        }
        $table = "buildings";
        $sql = "SELECT * FROM $table WHERE user_id='$_SESSION[id]'";
        if($result = @$connection->query($sql)) {
            $user_data = $result->fetch_assoc();
            $_SESSION['barracksLvl'] = $user_data['barracksLvl'];
            $_SESSION['hideoutLvl'] = $user_data['hideoutLvl'];
            $_SESSION['warehouseLvl'] = $user_data['warehouseLvl'];
            $_SESSION['defensiveWallsLvl'] = $user_data['defensiveWallsLvl'];
            $_SESSION['palaceLvl'] = $user_data['palaceLvl'];
            $_SESSION['TownHallLvl'] = $user_data['TownHallLvl'];
            $_SESSION['marketLvl'] = $user_data['marketLvl'];
            $_SESSION['stableLvl'] = $user_data['stableLvl'];
            $result->free_result();
        }
        $connection->close();
    }
    catch(Exception $e)
    {
        echo '<span style="color:red"> Błąd servera. Proszę spróbować później.</span>';
    }
    header('Location: ../game_logic/wioska');