<?php
    session_start();
    require_once('database/db_config.php');

    if(isset($_POST['DangNhap']))
    {
        $email = $_POST['txtEmail'];
        if(empty($_POST['txtEmail']) || empty($_POST['txtMatKhau']))
        {
            header("location:index.php?Empty=Vui Lòng Không Bỏ Trống Trường");
        }
        else
        {
            $query = "Select * From khachhang where Email = '".$_POST['txtEmail']."' and MatKhau = '".$_POST['txtMatKhau']."'";
            $result = mysqli_query($connection, $query);
            if(mysqli_fetch_assoc($result))
            {
                $_SESSION['Email'] = $_POST['txtEmail'];
                header("location:index.php");
            }
            else
            {
                header("location:login.php?Invalid= Sai TK/MK");
            }
        }
    }
    else{

    }
?>