<?php
    session_start();
    if($_SESSION["Email"]) {
        header("location: index.php");
    }
?>
