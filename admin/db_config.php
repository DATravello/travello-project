<?php
$sever_name = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "travello_db";

$connection = mysqli_connect($sever_name,$db_username,$db_password);
$dbconfig = mysqli_select_db($connection,$db_name);

if($dbconfig)
{
    // echo "Database connected";
}
else
{
    echo "Database connected failed";
}
?>