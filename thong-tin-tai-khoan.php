<?php
include('include/header.php');
?>

<!-- NỘI DUNG -->

<?php
$email = $_SESSION['Email'];
$query = "SELECT * from khachhang where Email = '$email'";
$result = mysqli_query($connection, $query);
$rowTK = mysqli_fetch_array($result);

$MaKH = $rowTK["MaKH"];
?>

<style>
    .container-orders .left-user-tab .card {
        background: #8178d1;
        margin-bottom: 0;
        border-bottom: none;
        margin-bottom: 0;
        border-bottom-left-radius: 0;
        border-bottom-right-radius: 0;
        border: none;
    }


    .container-orders .left-user-tab .card-body {
        color: #fff;
    }

    .left-user-tab .card-body p {
        margin: 0;
        font-size: 14px;
        margin: 10px 0;
        color: #eee;
    }

    .left-user-tab .card-body .user-name {
        font-size: 17px;
        text-align: center;
        font-weight: bold;
    }

    .btn-edit-user {
        background: #ebc654;
        color: #fff;
        padding: 10px 30px;
        border-radius: 25px;
        font-weight: 600;
        font-size: 15px;
    }

    .status-done {
        background: #34eb86;
        font-size: 14px;
        color: #fff;
        padding: 3px;
        border-radius: 25px;
        text-align: center;
        width: fit-content;
        float: right;
    }

    .status-payment {
        background: #8178d1;
        font-size: 14px;
        color: #fff;
        padding: 3px;
        border-radius: 25px;
        text-align: center;
        width: fit-content;
        float: right;
    }

    .status-unpayment {
        background: #721c24;
        font-size: 14px;
        color: #fff;
        padding: 3px;
        border-radius: 25px;
        text-align: center;
        width: fit-content;
        float: right;
    }


    .status-cancel {
        background: #dc3545;
        font-size: 14px;
        color: #fff;
        padding: 3px;
        border-radius: 25px;
        text-align: center;
        width: fit-content;
        float: right;
    }

    .status-process {
        background: #ebc654;
        font-size: 14px;
        color: #fff;
        padding: 3px;
        border-radius: 25px;
        text-align: center;
        width: fit-content;
        float: right;
    }

    .container-orders .left-user-tab .sub-card {
        background: #fff !important;
        border-top-left-radius: 0 !important;
        border-top-right-radius: 0 !important;

    }

    .container-orders .left-user-tab .sub-card .card-body {
        border: none !important;
        padding: 10px 5px !important;
    }

    .container-orders .active {
        background: #eee;
    }

    .container-orders .sub-card p {
        margin: 10px 0;
        padding: 10px;
        color: rgb(74, 74, 74);
    }

    .container-orders .sub-card i {
        margin-right: 10px;
    }
</style>
<script>
    function EditUser() {
        $("#HoTen").removeAttr("disabled");
        $("#DiaChi").removeAttr("disabled");
        $("#NgaySinh").removeAttr("disabled");
        $("#GioiTinh").removeAttr("disabled");
        $("#SDT").removeAttr("disabled");
    }
</script>
<title> <?php echo $rowTK["TenKH"]; ?> | Thông Tin Tài Khoản</title>
<section class="container container-orders">
    <div class="row">
        <div class="col-md-4">
            <div class="left-user-tab">
                <div class="card">
                    <div class="card-body">

                        <div class="text-center"><img src="img/user.png" alt="" width="55px" height="55px"></div>
                        <p class="user-name"><?php echo $rowTK["TenKH"]; ?></p>
                        <p class="date-user"><i class="fas fa-calendar-alt"></i> Ngày sinh:
                            <?php $ngaysinh = date_create($rowTK["NgaySinh"]);
                            echo date_format($ngaysinh, 'd/m/Y'); ?>
                        </p>
                        <p class="gender-user"><i class="fas fa-transgender"></i> Giới tính: <?php echo $rowTK["GioiTinh"]; ?></p>
                        <p class="phone-user"><i class="fas fa-mobile"></i> Điện thoại: <?php echo $rowTK["SDT"]; ?></p>
                        <p class="email-user"><i class="fas fa-envelope"></i> Email: <?php echo $rowTK["Email"]; ?></p>
                        <p class="address-user"><i class="fas fa-map-marker-alt"></i> Địa chỉ: <?php echo $rowTK["DiaChi"]; ?></p>
                        <div class="text-center"><button class="btn btn-edit-user" onclick="EditUser()" id="edit-user">Chỉnh Sửa <i class="fas fa-pen"></i></button></div>
                    </div>
                </div>
                <div class="card sub-card">
                    <div class="card-body">
                        <p class="active"><i class="fas fa-user"></i> Thông Tin Tài Khoản</p>
                        <p><i class="fas fa-shopping-cart"></i> <a href="hoa-don-dat-tour.php">Lịch Sử Đặt Tour</a></p>
                        <p><i class="fas fa-heart"></i> <a href="#">Tour Yêu Thích</a></p>
                        <p><i class="fas fa-eye"></i> <a href="#">Tour Đã Xem</a></p>
                        <p><i class="fas fa-question-circle"></i> <a href="#">Hỏi Đáp</a></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="text-center">Thông Tin Tài Khoản</h5>
                    <?php
                    if (isset($_POST['btnUpdateUser'])) {
                        $hoten = $_POST["HoTen"];
                        $ngaysinh = $_POST["NgaySinh"];
                        $diachi = $_POST["DiaChi"];
                        $gioitinh = $_POST["GioiTinh"];
                        $sdt = $_POST["SDT"];
                        $email = $_POST["Email"];
                        $matkhaucu = $_GET["MatKhauCu"];
                        $matkhaumoi = $_GET["MatKhauMoi"];
                        $confirm = $_GET["NhapLai"];

                        if (isset($_POST['check']) && $_POST['check'] == "true") {
                            $sql_pass = "SELECT * FROM khachhang WHERE Email = '$email'";
                            $q_pass = mysqli_query($connection, $sql_pass);
                            $rw_pass = mysqli_fetch_array($q_pass);
                            $pass = $rw_pass["MatKhau"];

                            if ($matkhaucu == $pass) {
                                if ($matkhaumoi == $confirm) {
                                    $sql = "UPDATE khachhang SET TenKH = '$hoten', NgaySinh = '$ngaysinh', DiaChi = '$diachi', GioiTinh = '$gioitinh', SDT = '$sdt', MatKhau = '$matkhaumoi' WHERE Email = '$email'";
                                    $query = mysqli_query($connection, $sql);

                                    if ($query) {
                                        echo '<div class="alert alert-success text-center">Cập Nhật Thành Công!</div>';
                                        header('location: thong-tin-tai-khoan.php');
                                    } else {
                                        echo '<div class="alert alert-danger text-center">Cập Nhật Thất Bại</div>';
                                    }
                                } else {
                                    echo '<div class="alert alert-danger text-center">Mật Khẩu Mới Không Trùng Nhau!</div>';
                                }
                            } else {
                                echo '<div class="alert alert-danger text-center">Mật Khẩu Cũ Không Đúng!<div>';
                            }
                        } else {
                            $sql = "UPDATE khachhang SET TenKH = '$hoten', NgaySinh = '$ngaysinh', DiaChi = '$diachi', GioiTinh = '$gioitinh', SDT = '$sdt' WHERE Email = '$email'";
                            $query = mysqli_query($connection, $sql);

                            if ($query) {
                                echo '<div class="alert alert-success text-center">Cập Nhật Thành Công!</div>';
                            } else {
                                echo '<div class="alert alert-danger text-center">Cập Nhật Thất Bại!</div>';
                            }
                        }
                    }
                    ?>
                    <form id="info-u" class="info-u">
                        <div class="form-group">
                            <label for="formGroupExampleInput">Họ Tên</label>
                            <input type="text" class="form-control" id="HoTen" name="HoTen" placeholder="<?php echo $rowTK["TenKH"] ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput2">Ngày Sinh</label>
                            <input type="text" class="form-control" id="NgaySinh" name="NgaySinh" onfocus="(this.type='date')" placeholder="<?php echo $rowTK["NgaySinh"] ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput2">Địa Chỉ</label>
                            <input type="text" class="form-control" id="DiaChi" name="DiaChi" placeholder="<?php echo $rowTK["DiaChi"] ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput2">Giới Tính</label>
                            <input type="text" class="form-control" id="GioiTinh" name="GioiTinh" placeholder="<?php echo $rowTK["GioiTinh"] ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput2">Số Điện Thoại</label>
                            <input type="number" class="form-control" id="SDT" name="SDT" placeholder="<?php echo $rowTK["SDT"] ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput2">Email</label>
                            <input type="email" class="form-control" name="Email" placeholder="<?php echo $rowTK["Email"] ?>" disabled>
                        </div>
                        <script>
                            function Check() {
                                if ($('input#checkbox').is(':checked')) {
                                    $('#change-pass').removeAttr("hidden");
                                } else {
                                    $('#change-pass').attr("hidden", true);
                                }
                            }
                        </script>
                        <div class="form-group">
                            <input type="checkbox" name="check" class="check" id="checkbox" onclick="Check()" value="true">
                            <label for="check">Thay Đổi Mật Khẩu</label>
                        </div>
                        <div id="change-pass" hidden>
                            <div class="form-group pass">
                                <label for="formGroupExampleInput2">Mật Khẩu Cũ</label>
                                <input type="password" class="form-control" name="MatKhauCu" placeholder="Nhập mật khẩu cũ">
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput2">Mật Khẩu Mới</label>
                                <input type="password" class="form-control" name="MatKhauMoi" placeholder="Mật khẩu từ 6 đến 8 ký tự">
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput2">Nhập Lại</label>
                                <input type="password" class="form-control" name="NhapLai" placeholder="Nhập lại mật khẩu mới">
                            </div>
                        </div>
                        <hr>
                        <div style="text-align:right"><button type="submit" class="btn btn-success" name="btnUpdateUser">Lưu Lại <i class="fas fa-save"></i></button></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>


<?php
include('include/footer.php');
?>