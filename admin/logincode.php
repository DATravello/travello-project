<?php
    session_start();
    require_once('db_config.php');

    if(isset($_POST['Login']))
    {
        $taikhoan = $_POST['TaiKhoan'];
        if(empty($_POST['TaiKhoan']) || empty($_POST['MatKhau']))
        {
            $_SESSION['login-admin-status'] = 'Không Được Để Trống!';
            header("location:index.php?Empty=cannot-be-empty-id-password");
        }
        else
        {
            $query = "Select * From taikhoan where TenTK = '".$_POST['TaiKhoan']."' and MatKhau = '".$_POST['MatKhau']."'";
            $result = mysqli_query($connection, $query);
            if(mysqli_fetch_assoc($result))
            {
                $_SESSION['TaiKhoan'] = $_POST['TaiKhoan'];
                $_SESSION['login-admin-status'] = 'Đăng Nhập Thành Công';
                header("location:index.php");
            }
            else
            {
                $_SESSION['login-admin-status'] = 'Sai Tài Khoản Và Mật Khẩu';
                header("location:login.php?Invalid=invalid-email-and-password");
            }
        }
    }
    else{
        $_SESSION['login-admin-status'] = 'Lỗi Đăng Nhập';
    }
?>