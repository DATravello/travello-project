<?php
    session_start();

    include('db_config.php');

    if($dbconfig)
    {   
        // echo "Database connected";
    }
    else
    {
        header("location: db_config.php");
    }

    if(!$_SESSION['TaiKhoan'])
    {
        header("location: login.php");
    }
?>