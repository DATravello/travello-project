<?php
    session_start();
    require_once('db_config.php');

    if(isset($_POST['Login']))
    {
        $taikhoan = $_POST['TaiKhoan'];
        if(empty($_POST['TaiKhoan']) || empty($_POST['MatKhau']))
        {
            header("location:index.php?Empty=Vui Lòng Không Bỏ Trống Trường");
        }
        else
        {
            $query = "Select * From taikhoan where TenTK = '".$_POST['TaiKhoan']."' and MatKhau = '".$_POST['MatKhau']."'";
            $result = mysqli_query($connection, $query);
            if(mysqli_fetch_assoc($result))
            {
                $_SESSION['TaiKhoan'] = $_POST['TaiKhoan'];
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