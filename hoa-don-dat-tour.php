<?php
include('include/header.php');

//Query Khách Hàng
$email = $_SESSION['Email'];
$query = "SELECT * from khachhang where Email = '$email'";
$result = mysqli_query($connection, $query);
$rowTK = mysqli_fetch_array($result);

$MaKH = $rowTK["MaKH"];
?>

<title>Hoá Đơn Đặt Tour | Travello</title>
<!-- NỘI DUNG -->
<?php
$q_hd = "SELECT * FROM hoadon WHERE MaKH = '$MaKH' ORDER BY NgayDat DESC";
$r_hd = mysqli_query($connection, $q_hd);
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
        border-top-left-radius: 0!important;
        border-top-right-radius: 0!important;
       
    }
    .container-orders .left-user-tab .sub-card .card-body {
        border: none!important;
        padding: 10px 5px!important;
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
                        <div class="text-center"><button class="btn btn-edit-user">Chỉnh Sửa <i class="fas fa-pen"></i></button></div>

                    </div>
                </div>
                <div class="card sub-card">
                    <div class="card-body">
                        <p><i class="fas fa-user"></i> <a href="thong-tin-tai-khoan.php">Thông Tin Tài Khoản</a></p>
                        <p class="active"><i class="fas fa-shopping-cart"></i> Lịch Sử Đặt Tour</p>
                        <p><i class="fas fa-heart"></i> <a href="#">Tour Yêu Thích</a></p>
                        <p><i class="fas fa-eye"></i> <a href="#">Tour Đã Xem</a></p>
                        <p><i class="fas fa-question-circle"></i> <a href="#">Hỏi Đáp</a></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <?php
            $now = date("Y-m-d");
            while ($rowHD = @mysqli_fetch_array($r_hd)) {
                $matour = $rowHD["MaTour"];
                $mahd = $rowHD["MaHD"];
                $sql = "SELECT * FROM tourdulich WHERE MaTour = $matour";
                $rs = mysqli_query($connection, $sql);
                $tour = mysqli_fetch_array($rs);
                $ngaydi = $tour["ThoiGian"];
                if ($ngaydi > $now) {
                    $sql_update = "UPDATE hoadon SET TinhTrang = 'Đã Hoàn Thành' WHERE MaHD = $mahd";
                    $rs_update = mysqli_query($connection, $sql_update);
                }
            ?>
                <div class="card orders">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <p>Tour <a href="thong-tin-hoa-don.php?ma-hoa-don=<?php echo $rowHD["MaHD"] ?>" style="color:#007bff;font-weight:bold">#<?php echo $rowHD["MaHD"] ?></a></p>
                                <p style="font-weight:bold;"><?php echo $tour["TenTour"]; ?></p>

                            </div>
                            <div class="col-md-3">
                                <p>Ngày Đặt</p>
                                <p><?php
                                    $ngaydat = date_create($rowHD["NgayDat"]);
                                    echo date_format($ngaydat, 'd/m/Y');
                                    ?>
                                </p>
                            </div>
                            <div class="col-md-2">
                                <p>Tổng Tiền</p>
                                <p style="color:red;font-weight:bold"><?php echo product_price($rowHD["TongTien"]) ?></p>
                            </div>
                            <div class="col-md-4" style="text-align:right">
                                <p>Tình Trạng</p>
                                <?php
                                if ($rowHD["TinhTrang"] == "Đã Hoàn Thành") {
                                    echo '<p class="status status-done">' . $rowHD["TinhTrang"] . '</p>';
                                } else if ($rowHD["TinhTrang"] == "Chưa Xác Nhận") {
                                    echo '<p class="status status-process">' . $rowHD["TinhTrang"] . '</p>';
                                } else if ($rowHD["TinhTrang"] == "Chưa Thanh Toán") {
                                    echo '<p class="status status-unpayment">' . $rowHD["TinhTrang"] . '</p>';
                                } else if ($rowHD["TinhTrang"] == "Đã Thanh Toán") {
                                    echo '<p class="status status-payment">' . $rowHD["TinhTrang"] . '</p>';
                                } else if ($rowHD["TinhTrang"] == "Đã Huỷ") {
                                    echo '<p class="status status-cancel">' . $rowHD["TinhTrang"] . '</p>';
                                }
                                ?>

                            </div>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</section>


<?php
include('include/footer.php');
?>