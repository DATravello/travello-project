<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-sacle=1">
    <meta charset="utf-8">
    <title>Đăng Nhập | Travello Admin</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="css/login-admin.css">
</head>
<body>
    <div id="wrapper">
        <div class="form-container">

            <span class="form-heading">
                <form action="logincode.php" method="POST">

                    <div class="input-group">
                        <i class="fas fa-user"></i>
                        <input type="text" name="TaiKhoan" placeholder="Tài Khoản" required>
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