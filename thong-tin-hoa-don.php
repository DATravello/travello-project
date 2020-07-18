<?php
include('include/header.php');

if (isset($_GET['ma-hoa-don'])) {
    $mahoadon = $_GET['ma-hoa-don'];
    require_once('database/db_config.php');

    //Query Hoá Đơn
    $sql_hd = "SELECT * FROM hoadon WHERE MaHD = $mahoadon";
    $rs_hd = mysqli_query($connection, $sql_hd);
    $rw_hd = mysqli_fetch_array($rs_hd);

    $matour = $rw_hd["MaTour"];
    $makh = $rw_hd["MaKH"];
    $matt = $rw_hd["MaTT"];

    //Query Tour
    $sql_tour = "SELECT * FROM tourdulich WHERE MaTour = $matour";
    $rs_tour = mysqli_query($connection, $sql_tour);
    $rw_tour = mysqli_fetch_array($rs_tour);

    //Query User
    $sql_u = "SELECT * FROM khachhang WHERE MaKH = $makh";
    $rs_u = mysqli_query($connection, $sql_u);
    $rw_u = mysqli_fetch_array($rs_u);

    //Query Thanh Toan
    $sql_tt = "SELECT * FROM thanhtoan WHERE MaTT = $matt";
    $rs_tt = mysqli_query($connection, $sql_tt);
    $rw_tt = mysqli_fetch_array($rs_tt);

    //Query Thanh Vien Tour
    $sql_tv = "SELECT * FROM thanhvientour WHERE MaHD = $mahoadon";
    $rs_tv = mysqli_query($connection, $sql_tv);
}
?>
<title>Chi Tiết Đơn Đặt Tour | Travello</title>
<style>
    .order-container .order-info .card-body {
        padding: 20px !important;
    }

    .order-info .card-body p {
        margin-bottom: 5px;
        font-size: 13px;
        color: rgba(0, 0, 0, 0.6);
    }

    .order-info-tour .card-body {
        padding: 20px !important;
    }

    .order-info .card-body {
        padding: 20px !important;
    }
</style>
<section class="container order-container">
    <?php
    if (isset($_POST['btnHuyTour'])) {
        $mahd = $_POST["MaHD"];
        $tinhtrang = $_POST["TinhTrang"];
        $lydohuytour = $_POST["LyDoHuy"];

        $sql = "UPDATE hoadon SET TinhTrang = 'Yêu Cầu Huỷ', TinhTrangCu = '$tinhtrang', LyDoHuyTour = '$lydohuytour' WHERE MaHD = $mahd";
        $qr = mysqli_query($connection, $sql);

        if ($qr) {
            echo '<div class="alert alert-success text-center"><h3>Huỷ Thành Công</h3></div>';
        } else {
            echo '<div class="alert alert-danger text-center"><h3>Huỷ Thất Bại</h3></div>';
        }
    }
    ?>
    <div class="row">
        <div class="col-md-6">
            <h5>Chi Tiết Hoá Đơn <span style="color:#007bff">#<?php echo $mahoadon ?></span> - <span style="font-weight:bold;"><?php echo $rw_hd["TinhTrang"] ?></span> </h5>
            <p>Ngày Đặt:
                <?php
                $ngaydat = date_create($rw_hd["NgayDat"]);
                echo date_format($ngaydat, 'd/m/Y');
                ?>
            </p>
            <p><b>Lý Do Huỷ:</b> <i><?php echo $rw_hd["LyDoHuyTour"]?></i></p>
            <p><b>Ghi Chú:</b> <i><?php echo $rw_hd["GhiChu"]?></i></p>
        </div>
        <div class="col-md-6" style="text-align: right;">
            <?php
            if ($rw_hd["TinhTrang"] == "Đã Hoàn Thành" || $rw_hd["TinhTrang"] == "Yêu Cầu Huỷ" || $rw_hd["TinhTrang"] == "Đã Huỷ") {
            } else {
                echo '<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#huytour">Huỷ Tour</button>';
            }
            ?>
        </div>

        

        <!-- Modal -->
        <div class="modal fade" id="huytour" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Xác Nhận Huỷ Tour</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post">
                            <p>Vui lòng đọc kỹ các điều khoản về quy trình huỷ tour và phí huỷ đặt tour theo <a href="quy-dinh-huy-tour.php" style="font-weight:bold;text-decoration:none">quy định huỷ tour</a> của công ty!<br>
                                Việc quý khách xác nhận huỷ tour đồng nghĩa với việc quý khách đã đọc và chấp nhận các điều khoản trên.
                            </p>
                            <div class="form-group">
                                <label>Lý Do Huỷ Tour</label>
                                <textarea name="LyDoHuy" class="form-control"></textarea>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Đóng</button>

                        <input type="hidden" name="MaHD" value="<?php echo $rw_hd['MaHD']; ?>">
                        <input type="hidden" name="TinhTrang" value="<?php echo $rw_hd['TinhTrang']; ?>">
                        <button type="submit" name="btnHuyTour" class="btn btn-danger">Xác Nhận</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="order-info">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <p style="color:#007bff;">Thông Tin Người Đặt</p>
                        <p style="font-weight:bold;font-size:16px;color:#000"><?php echo $rw_u["TenKH"] ?></p>
                        <p>Địa chỉ: <?php echo $rw_u["DiaChi"] ?></p>
                        <p>Điện thoại: <?php echo $rw_u["SDT"] ?></p>
                        <p>Email: <?php echo $rw_u["Email"] ?></p>
                    </div>
                    <div class="col-md-4">
                        <p style="color:#007bff">Số Lượng Người Đặt</p>
                        <p>Số Trẻ Em: <?php echo $rw_hd["SoTreEm"] ?></p>
                        <p>Số Người Lớn: <?php echo $rw_hd["SoNguoiLon"] ?></p>
                    </div>
                    <div class="col-md-4">
                        <p style="color:#007bff">Hình Thức Thanh Toán</p>
                        <p><?php echo $rw_tt["TenThanhToan"] ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="order-info-tour">
        <div class="card">
            <div class="card-body">
                <p>1. Tour</p>
                <div class="row">
                    <div class="col-md-3">
                        <p>Tên Tour</p>
                        <p style="color:#007bff;font-weight:bold">
                            <a href="chi-tiet-tour.php?tour=<?php echo $rw_tour["MaTour"] ?>">
                                <?php
                                echo $rw_tour["TenTour"]
                                ?>
                            </a>
                        </p>
                    </div>
                    <div class="col-md-3">
                        <p>Ngày Đi</p>
                        <p><?php
                            $ngaydi = date_create($rw_tour["ThoiGian"]);
                            echo date_format($ngaydi, 'd/m/Y');
                            ?>
                        </p>
                    </div>
                    <div class="col-md-3">
                        <p>Ngày Về</p>
                        <p>
                            <?php
                            $ngaydi = date_create($rw_tour["ThoiGian"]);
                            echo date_format($ngaydi, 'd/m/Y');
                            ?>
                        </p>
                    </div>
                    <div class="col-md-3" style="text-align: right;">
                        <p>Tạm tính</p>

                        </p>
                    </div>
                </div>
                <!-- <p>2. Khách Sạn</p>
                <div class="row">
                    <div class="col-md-3">
                        <p>Tên khách Sạn</p>
                    </div>
                    <div class="col-md-3">
                        <p>Ngày Đi</p>
                    </div>
                    <div class="col-md-3">
                        <p>Ngày Về</p>
                    </div>
                    <div class="col-md-3" style="text-align: right;">
                        <p>Tạm Tính</p>
                    </div>
                </div> -->
                <hr>
                <p class="price" style="text-align:right;font-size: 17px;margin-top:20px">
                    Tổng Cộng: <span style="color:red;font-weight:bold"> <?php
                                                                            echo product_price($rw_tour["GiaTien"])
                                                                            ?></span></p>
            </div>
        </div>
    </div>

    <div class="order-info-tour">
        <div class="card">
            <div class="card-body">
                <p>Thông Tin Hành Khách</p>
                <div class="row">
                    <div class="col-md-3">
                        <p>Họ Tên</p>
                    </div>
                    <div class="col-md-2">
                        <p>CMND</p>
                    </div>
                    <div class="col-md-2">
                        <p>SĐT</p>
                    </div>
                    <div class="col-md-2">
                        <p>Giới Tính</p>
                    </div>
                    <div class="col-md-3">
                        <p>Ngày Sinh</p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <?php
                    $i = 1;
                    while ($rw_tv = @mysqli_fetch_array($rs_tv)) {
                    ?>
                        <div class="col-md-3">
                            <p>#<?php echo $i ?> - <?php echo $rw_tv["TenTV"] ?></p>
                        </div>
                        <div class="col-md-2">
                            <p><?php echo $rw_tv["CMND"] ?></p>
                        </div>
                        <div class="col-md-2">
                            <p><?php echo $rw_tv["SDT"] ?></p>
                        </div>
                        <div class="col-md-2">
                            <p><?php echo $rw_tv["GioiTinh"] ?></p>
                        </div>
                        <div class="col-md-3">
                            <p><?php
                                $ngaysinh = date_create($rw_tv["NgaySinh"]);
                                echo date_format($ngaysinh, 'd/m/Y');
                                ?>
                            </p>
                        </div>
                        <hr>
                    <?php
                        $i++;
                    } ?>
                </div>

            </div>
        </div>
    </div>

</section>



<?php
include('include/footer.php');
?>