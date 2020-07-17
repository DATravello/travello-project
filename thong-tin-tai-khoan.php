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
<title> <?php echo $rowTK["TenKH"]; ?> | Thông Tin Tài Khoản</title>
<section class="container users-container">
    <div class="row">
        <div class="col-4">
            <div class="list-group" id="list-tab" role="tablist">
                <a class="list-group-item list-group-item-action active" id="list-home-list" data-toggle="list" href="#list-home" role="tab" aria-controls="home">Thông Tin Tài Khoản</a>
                <a class="list-group-item list-group-item-action" id="list-profile-list" data-toggle="list" href="#list-profile" role="tab" aria-controls="profile">Quản Lý Đơn Hàng</a>
                <a class="list-group-item list-group-item-action" id="list-messages-list" data-toggle="list" href="#list-messages" role="tab" aria-controls="messages">Tour Yêu Thích</a>
                <a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="list" href="#list-settings" role="tab" aria-controls="settings">Tour Đã Xem</a>
            </div>
        </div>
        <div class="col-8">
            <div class="tab-content" id="nav-tabContent">
                <!-- Thông tin tài khoản -->
                <div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
                    <h5>Thông Tin Tài Khoản</h5>
                    <form class="info-u">

                        <div class="form-group">
                            <label for="formGroupExampleInput">Họ Tên</label>
                            <input type="text" class="form-control" id="formGroupExampleInput" placeholder="<?php echo $rowTK["TenKH"] ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput2">Ngày Sinh</label>
                            <input type="text" class="form-control" id="formGroupExampleInput" placeholder="<?php echo $rowTK["NgaySinh"] ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput2">Địa Chỉ</label>
                            <input type="text" class="form-control" id="formGroupExampleInput" placeholder="<?php echo $rowTK["DiaChi"] ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput2">Giới Tính</label>
                            <input type="text" class="form-control" id="formGroupExampleInput" placeholder="<?php echo $rowTK["GioiTinh"] ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput2">Số Điện Thoại</label>
                            <input type="text" class="form-control" id="formGroupExampleInput" placeholder="<?php echo $rowTK["SDT"] ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput2">Email</label>
                            <input type="text" class="form-control" id="formGroupExampleInput" placeholder="<?php echo $rowTK["Email"] ?>" readonly>
                        </div>
                    </form>
                </div>
                <style>
                    .status {
                        color: green;
                        font-weight: bold;
                    }

                    .orders .card-body {
                        padding: 20px !important;
                    }
                </style>
                <!--  Quản Lý Đơn Hàng -->
                <?php
                $q_hd = "SELECT * FROM hoadon WHERE MaKH = '$MaKH'";
                $r_hd = mysqli_query($connection, $q_hd);
                ?>
                <div class="tab-pane fade" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">
                    <div class="list-group">
                        <h5>Danh Sách Tour Đã Đặt</h5>
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
                                        <div class="col-md-4">
                                            <p>Tour <a href="thong-tin-hoa-don.php?ma-hoa-don=<?php echo $rowHD["MaHD"]?>" style="color:#007bff;font-weight:bold">#<?php echo $rowHD["MaHD"] ?></a></p>
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
                                        <div class="col-md-3" style="text-align:right">
                                            <p>Tình Trạng</p>
                                            <p class="status">(<?php echo $rowHD["TinhTrang"] ?>)</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>


                <div class="tab-pane fade" id="list-messages" role="tabpanel" aria-labelledby="list-messages-list">...</div>
                <div class="tab-pane fade" id="list-settings" role="tabpanel" aria-labelledby="list-settings-list">...</div>
            </div>
        </div>
    </div>
</section>

<?php
include('include/footer.php');
?>