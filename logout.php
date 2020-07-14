<?php
    session_start();
    session_destroy();
    unset($_SESSION['Email']);
    header("Location: index.php");
?>