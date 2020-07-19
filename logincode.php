<?php
include('security.php');

if (isset($_POST['DangNhap'])) {
    $email = $_POST['txtEmail'];
    $pwd = $_POST['txtMatKhau'];

    if (empty($_POST['txtEmail']) || empty($_POST['txtMatKhau'])) {
        $_SESSION['login-status'] = 'Không Được Để Trống!';
        header("location:index.php?Empty=cannot-be-empty-email-password");
    } else {
        $query = "SELECT * FROM khachhang WHERE Email = '$email'";
        $result = mysqli_query($connection, $query);
        if ($row = (mysqli_fetch_assoc($result))) {
            $pwd_data = $row["MatKhau"];

            if ($pwd == $pwd_data) {
                $_SESSION['Email'] = $_POST['txtEmail'];
                $_SESSION['login-status'] = 'Đăng Nhập Thành Công';
                header("location:index.php");
            } else {
                $_SESSION['login-status'] = 'Sai Mật Khẩu!';
                header("location:login.php");
            }
        } else {
            $_SESSION['login-status'] = 'Sai Email Đăng Nhập';
            header("location:login.php?Invalid=invalid-email-and-password");
        }
    }
}

?>