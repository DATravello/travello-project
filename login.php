
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Đăng Nhập | Travello</title>
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/animate/animate.min.css">
    <link rel="stylesheet" href="css/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap-4.5.0-dist/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"> -->
</head>

<body>

<!-- Login Section -->
<div class="modal-dialog text-center">
    <div class="col-sm-9 main-section">
        <div class="modal-content">
            <div class="col-12 user-img">
                <img src="img/user.png" alt="user">
            </div>
            <div class="col-12 form-input">
                <form action="logincode.php" method="POST">
                    <div class="form-group">
                        <input type="email" name="txtEmail" id="" class="form-control" placeholder="Tên Đăng Nhập">
                    </div>
                    <div class="form-group">
                        <input type="password" name="txtMatKhau" id="" class="form-control" placeholder="Mật Khẩu">
                    </div>
                    <button type="submit" name="DangNhap" class="btn btn-success">Đăng Nhập</button>
                </form>
            </div>
            <div class="col-12 forgot">
                <a href="#">Quên mật khẩu?</a><br><a href="#">Đăng ký</a>
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

</html>