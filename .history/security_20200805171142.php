<?php

session_start();
include('database/db_config.php');

if($dbconfig)
{   
    // echo "Database connected";
}
else
{
    header("location: database/db_config.php");
}

if(!$_SESSION['Email'])
{
    header("location: login.php");
    $_SESSION['Email'] = "undefine";
}


?>

