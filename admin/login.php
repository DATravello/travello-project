<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-sacle=1">
    <meta charset="utf-8">
    <title>Đăng Nhập | Travello Admin</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="css/login-admin.css">
</head>
<style>
    .alert {
        top: 90px;
        font-size: 17px;
        font-weight: bold;
        background: #ffc107;
        padding: 10px 10px;
        color: #fff;
        border-radius: 5px;
        position: absolute;
        left: 50%;
        transform: translate(-50%);
    }

    .alert i {
        margin: 0 10px;
    }

    #wrapper {
        width: 100%!important;
        background-repeat: no-repeat!important;
        background-attachment: fixed!important;
        background-size: cover!important;
        background-position: top!important;
        background: url("img/bg-login.jpg") no-repeat;
    }
</style>

<body>
    <div id="wrapper">
        <?php
        if (isset($_SESSION['login-admin-status']) && $_SESSION['login-admin-status'] != '') {
            echo '<div class="alert alert-danger"><i class="fas fa-exclamation-triangle"></i>' . $_SESSION['login-admin-status'] . '</div>';
            unset($_SESSION['login-admin-status']);
        }
        ?>
        <div class="form-container">

            <span class="form-heading">

                <form action="logincode.php" method="POST">

                    <div class="input-group">
                        <i class="fas fa-user"></i>
                        <input type="text" name="TaiKhoan" id="TaiKhoan" placeholder="Tài Khoản" required>
                        <span class="bar"></span>
                    </div>
                    <div class="input-group">
                        <i class="fas fa-key"></i>
                        <input type="password" name="MatKhau" placeholder="Mật Khẩu" required>
                        <span class="bar"></span>
                    </div>
                    <div class="input-group">
                        <button name="Login">
                            <i class="fas fa-sign-in-alt"></i>
                        </button>
                    </div>
                </form>
            </span>
        </div>
    </div>
</body>

</html>