<?php
include('security.php');

if (isset($_POST['DangNhap'])) {
    $email = $_POST['EmailKH'];
    $pwd = $_POST['MatKhauKH'];

    if (empty($_POST['EmailKH']) || empty($_POST['MatKhauKH'])) {
        $_SESSION['login-status'] = 'Không Được Để Trống!';
    } else {
        $query = "SELECT * FROM khachhang WHERE Email = '$email' AND MatKhau = '$pwd'";
        $result = mysqli_query($connection, $query);
        $num_rows = mysqli_num_rows($result);
        if ($num_rows == 0) {
            $_SESSION['login-status'] = 'Sai Email hoặc Mật khẩu Đăng Nhập!';
        } else {
            $_SESSION['login-status'] = 'Đăng nhập thành công!';
            $_SESSION['Email'] = $email;
            header('location: index.php');
        }
    }
}

?>
