<?php
include('include/header.php');

if (!$_SESSION["Email"] == null) {
} else {
    $_SESSION["Email"] = null;
}


if (isset($_GET['tour'])) {

    $matour = $_GET['tour'];
    require_once('database/db_config.php');



    $query = "SELECT * from tourdulich where MaTour='$matour'";
    $result = mysqli_query($connection, $query);
    $rows = @mysqli_fetch_array($result);
    $tentour = $rows["TenTour"];

    //Loại Tour
    $query2 = "SELECT * FROM tourdulich INNER JOIN loaitourdulich ON tourdulich.MaLoaiTour = loaitourdulich.MaLoaiTour ";
    $result2 = mysqli_query($connection, $query2);
    $rows2 = @mysqli_fetch_array($result2);

    //Phương Tiện
    $phuongtien = "SELECT * FROM tourdulich INNER JOIN phuongtien ON tourdulich.MaPhuongTien = phuongtien.MaPhuongTien where MaTour='$matour'";
    $result_pt = mysqli_query($connection, $phuongtien);
    $rows_pt = @mysqli_fetch_array($result_pt);

    //Khách Sạn
    $khachsan = "SELECT * FROM tourdulich INNER JOIN khachsan ON tourdulich.MaKS = khachsan.MaKS where MaTour='$matour'";
    $result_ks = mysqli_query($connection, $khachsan);
    $rows_ks = @mysqli_fetch_array($result_ks);

    //Hướng dẫn viên
    $hdv = "SELECT * FROM tourdulich INNER JOIN huongdanvien ON tourdulich.MaHDV = huongdanvien.MaHDV where MaTour='$matour'";
    $result_hdv = mysqli_query($connection, $hdv);
    $rows_hdv = @mysqli_fetch_array($result_hdv);

    //Vị trí
    $vitri = $rows['MaViTri'];
    $q_vitri = "SELECT * FROM vitri WHERE MaViTri= '$vitri'";
    $rs_vitri = mysqli_query($connection, $q_vitri);
    $rw_vitri = mysqli_fetch_array($rs_vitri);
}
?>

<title><?php echo $rows['TenTour']; ?> | Travello</title>
<section class="container tour-container">
    <div class="tour-title">
        <h2><?php echo $rows['TenTour']; ?></h2>
    </div>

    <div class="card" style="padding: 0">
        <div class="card-body" style="padding: 0!important">
            <div class="row" style="margin:0!important">
                <div class="col-md-8" style="padding: 0!important">
                    <div class="tour-image"><img src="admin/img/tour-du-lich/<?php echo $rows['Anh']; ?>" width="100%" height="500px"></div>
                </div>
                <div class="col-md-4" style="padding: 0!important; background:#eee">
                    <div class="widget" style="padding: 20px">
                        <style>
                            .tour-widget p {
                                display: block !important;
                                font-weight: normal !important;
                            }
                        </style>
                        <div class="row">
                            <div class="col-md-6">Ngày khởi hành:</div>
                            <div class="col-md-6"><?php echo $rows['ThoiGian']; ?></div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">Thời gian:</div>
                            <div class="col-md-6"><?php echo $rows['SoNgay']; ?></div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">Nơi khởi hành:</div>
                            <div class="col-md-6"><?php echo $rows['NoiKhoiHanh']; ?></div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <p>Giá: <b style="color:red">
                                        <?php
                                        $giamgia = $rows["GiamGia"];
                                        if ($giamgia > 0) {
                                            echo product_price($rows['GiamGia']);
                                        } else {
                                            echo product_price($rows['GiaTien']);
                                        } ?>
                                    </b>
                                </p>
                                <p>Số chỗ còn nhận: <b style="color:red"><?php echo $rows['SucChua']; ?></b></p>
                            </div>
                            <div class="col-md-6" style="text-align: right;">
                                <?php
                                $succhua = $rows["SucChua"];
                                if ($succhua > 0) {
                                    echo '<a href="dat-tour.php?tour=' . $rows['MaTour'] . '"><button class="btn btn-book" style="margin-top:0!important">Đặt tour</button></a>';
                                } else {
                                    echo '<button class="btn-soldout" style="margin-top:0!important">Đã Hết Chỗ</button></a>';
                                }
                                ?>
                            </div>
                        </div>
                        <hr>
                        <p>Khách sạn: <b style="color:#2196F3"><?php echo $rows_ks['TenKS']; ?></b></p>
                        <p>Phương tiện: <b style="color:#2196F3"><?php echo $rows_pt['PhuongTien']; ?></b></p>
                        <p>Hướng dẫn viên: <b style="color:#2196F3"><?php echo $rows_hdv['TenHDV']; ?></b></p>
                        <hr>
                        <p>Bạn cần hỗ trợ?</p>
                        <style>
                            .phone {
                                background: #fff;
                                margin-bottom: 10px;
                                border-radius: 5px;
                                display: flex;
                            }

                            .phone-left {
                                padding: 5px;
                            }

                            .phone-right {
                                border-radius: 5px;
                                margin: auto 0;
                                padding: 0 10px;
                                line-height: 14px;
                                font-size: 14px;
                            }

                            .phone span {
                                background: #ffbc00;
                            }

                            .phone i {
                                background-color: rgba(255, 255, 255, 0.3);
                                padding: 10px;
                                color: #fff;
                            }

                            .title-tour {
                                background: #eee;
                                padding: 10px;
                            }
                        </style>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="phone">
                                    <div class="phone-left" style="background: #ffbc00;">
                                        <i class="fas fa-phone-alt rounded-circle" style="display: inline-block;"></i>
                                    </div>
                                    <div class="phone-right">
                                        <a href="tel:0326805211">Gọi hotline</a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="phone">
                                    <div class="phone-left" style="background: #ff002d;">
                                        <i class="fas fa-envelope-open-text rounded-circle" style="display: inline-block;"></i>
                                    </div>
                                    <div class="phone-right">
                                        <a href="mailto:travelloco.op@gmail.com?subject=<?php echo $rows["TenTour"]?>">
                                            Gửi Email</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h3 class="title-tour">Hành Trình Tour</h3>
            <?php echo $rows['HanhTrinh']; ?>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h5 class="title-tour"><i class="fas fa-comments"></i> Bình luận</h5>
            <?php
            $sql_nx = "SELECT * FROM nhanxet WHERE MaTour = $matour";
            $result_nx = mysqli_query($connection, $sql_nx);
            while ($rows = @mysqli_fetch_array($result_nx)) {
            ?>
                <div class="card">
                    <div class="card-body">
                        <?php
                        $nx_makh = $rows["MaKH"];
                        $q_kh = "SELECT * FROM khachhang WHERE MaKH = $nx_makh";
                        $rs_kh = mysqli_query($connection, $q_kh);
                        $rw_kh = mysqli_fetch_array($rs_kh);
                        ?>
                        <b style="color:#2196F3"><?php echo $rw_kh["TenKH"] ?></b>
                        <hr>
                        <?php echo $rows["NoiDung"]; ?>
                    </div>
                </div>
            <?php
            }
            ?>
            <hr>


            <?php
            if (isset($_SESSION['BLSuccess']) && $_SESSION['BLSuccess'] != '') {
                echo    '<div class="btn btn-success btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-check"></i>
                        </span>
                        <span class="text">
                        ' . $_SESSION['BLSuccess'] . '
                        </span>
                        </div>';
                unset($_SESSION['BLSuccess']);
            }
            ?>
            <?php
            if ($_SESSION["Email"] == null) {
                echo '<p>Vui lòng đăng nhập để bình luận!</p>';
            } else {
                echo
                    '<form action="" name="BinhLuan" method="POST">
                        <div class="form-group">
                        <label>Nội dung</label>
                        <textarea rows="8" name="NoiDung" class="form-control" placeholder="Nhập Nội Dung"></textarea>
                        </div>
                        <button class="btn btn-success" name="btnBinhLuan">Bình Luận</button>
                    </form>
                    ';
            }
            ?>
            <?php
            if (isset($_POST["btnBinhLuan"])) {
                //query KH
                $email = $_SESSION["Email"];
                $q_khach = "SELECT * FROM khachhang WHERE Email = '$email'";
                $rs_khach = mysqli_query($connection, $q_khach);
                $rw_khach = @mysqli_fetch_array($rs_khach);
                $makh = $rw_khach["MaKH"];
                
                $noidung = $_POST["NoiDung"];

                //Querry Nhan Xet
                if ($makh == "" || $noidung == "" || $matour == "") {
                    echo '<div class="alert alert-success">Không được để trống!</div>';
                } else {
                    $qr_nx = "INSERT INTO nhanxet (MaTour, MaKH, NoiDung) VALUES('$matour', '$makh', '$noidung')";
                    $rs_nx = mysqli_query($connection, $qr_nx);

                    if ($rs_nx) {
                        $_SESSION['BLSuccess'] = 'Thành Công!';
                        echo '<meta http-equiv="refresh" content="0.5">';
                    } else {
                        $_SESSION['BLSuccess'] = 'Thất Bại!';
                    }
                }
            }
            ?>
        </div>
    </div>
</section>



<?php include('include/footer.php'); ?>