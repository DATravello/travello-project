<?php
session_start();
require_once('database/db_config.php');

if (isset($_POST['DangNhap'])) {
    $error = '';
    $email = $_POST['txtEmail'];
    if (empty($_POST['txtEmail']) || empty($_POST['txtMatKhau'])) {
        $_SESSION['login-status'] = 'Không Được Để Trống!';
        header("location:index.php?Empty=cannot-be-empty-email-password");
    } else {
        $query = "SELECT * FROM khachhang WHERE Email = '" . $_POST['txtEmail'] . "' and MatKhau = '" . $_POST['txtMatKhau'] . "'";
        $result = mysqli_query($connection, $query);
        if (mysqli_fetch_assoc($result)) {
            $_SESSION['Email'] = $_POST['txtEmail'];
            $_SESSION['login-status'] = 'Đăng Nhập Thành Công';
            header("location:index.php");
        } else {
            $_SESSION['login-status'] = 'Sai Email Và Mật Khẩu';
            header("location:login.php?Invalid=invalid-email-and-password");
        }
    }
} else {
    $_SESSION['login-status'] = 'Lỗi Đăng Nhập';
}
