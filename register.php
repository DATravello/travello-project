<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Đăng Ký | Travello</title>
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/animate/animate.min.css">
    <link rel="stylesheet" href="css/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap-4.5.0-dist/css/bootstrap.min.css">
</head>
<style>
    label {
        margin: 0 0 0 15px;
    }
</style>

<body>
    <style>
        .register-section {
            width: 100%;
            min-height: 100vh;
            padding: 15px;
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
            position: relative;
            z-index: 1;
        }

        .register-section::before {
            content: "";
            display: block;
            position: absolute;
            z-index: -1;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            background-color: rgba(0, 0, 0, 0.7);
        }
    </style>
    <!-- Login Section -->
    <div class="register-section" style="background-image: url('img/parallax-1.jpg');">
        <div class="modal-dialog">
            <div class="col-sm-9 main-section">
                <div class="modal-content">
                    <div class="col-12 user-img text-center">
                        <img src="img/user.png" alt="user">
                    </div>

                    <div class="col-12 form-input">
                        <form action="registercode.php" id="register-form" method="POST">
                            <?php
                            if (isset($_SESSION['register-status']) && $_SESSION['register-status'] != '') {
                                echo '<div class="alert alert-danger">' . $_SESSION['register-status'] . '</div>';
                                unset($_SESSION['register-status']);
                            }
                            ?>
                            <div class="form-group">
                                <input type="email" name="txtEmail" class="form-control" placeholder="Email" required>
                            </div>
                            <div class="form-group">
                                <input type="password" name="txtMatKhau" class="form-control" placeholder="Mật Khẩu" required>
                            </div>
                            <div class="form-group">
                                <input type="text" name="txtHoTen" class="form-control" placeholder="Họ Tên" required>
                            </div>
                            <div class="form-group">
                                <input type="number" name="txtSDT" class="form-control" placeholder="Số Điện Thoại" required>
                            </div>
                            <div class="form-group">
                                <input type="date" name="txtNgaySinh" class="form-control" placeholder="Ngày Sinh" required>
                            </div>
                            <div class="form-group">
                                <select class="form-control" name="txtGioiTinh" id="txtGioiTinh" required>
                                    <option value="Nam">Nam</option>
                                    <option value="Nữ">Nữ</option>
                                    <option value="Khác">Khác</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="text" name="txtDiaChi" class="form-control" placeholder="Địa Chỉ" required>
                            </div>
                            <div class="form-group text-center">
                                <button type="submit" name="BtnDangKy" class="btn btn-success">Đăng Ký</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-12 forgot text-center">
                        Đã có tài khoản? <a href="login.php">Đăng Nhập Ngay!</a>
                    </div>
                </div>
            </div>
        </div>

    </div>



</body>
<script src="scripts/jquery-3.5.1.slim.min.js"></script>
<script src="scripts/popper.min.js"></script>
<script src="scripts/bootstrap.min.js"></script>
<script src="scripts/fontawesome-kit.js"></script>
<script src="scripts/scroll.js"></script>
<script src="plugins/jquery-validation-1.19.2/dist/jquery.validate.min.js"></script>
<script src="scripts/validate-cus.js"></script>

</html>