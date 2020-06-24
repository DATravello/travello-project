<?php
include('include/header.php');

if (isset($_GET['tour'])) {
    $matour = $_GET['tour'];
    require_once('database/db_config.php');

    $query = "SELECT * from tourdulich where MaTour='$matour'";
    $result = mysqli_query($connection, $query);
    $rows = @mysqli_fetch_array($result);

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
}
?>
<!-- NỘI DUNG -->

<section class="container tour-container">
    <div class="tour-title">
        <h2><?php echo $rows['TenTour']; ?></h2>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="tour-content">
                <div class="tour-subtitle">
                    <h5><?php echo $rows['TenTour']; ?> - <?php echo $rows2['TenLoaiTour']; ?></h5>
                </div>
                <div class="tour-image"><img src="admin/img/tour-du-lich/<?php echo $rows['Anh']; ?>"></div>
                <div class="tour-image-sub">
                    <?php echo $rows['TenTour']; ?>
                </div>
                <div class="tour-description">
                    <h3>Hành Trình Tour</h3>
                    <?php echo $rows['HanhTrinh']; ?>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="tour-widget">
                <h5 class="w-title">Thông tin tour</h5>
                <div class="w-price">
                    <h5>Giá: <h5>
                            <p><?php echo $rows['GiaTien']; ?> VNĐ <p>
                </div>
                <div class="w-type">
                    <h5>Loại tour: </h5>
                    <p><?php echo $rows2['TenLoaiTour']; ?> <p>
                </div>
                <div class="w-time">
                    <h5>Thời gian: </h5>
                    <p><?php echo $rows['ThoiGian']; ?></p>
                </div>
                <div class="w-place">
                    <h5>Nơi đến: </h5>
                    <p><?php echo $rows['NoiDen']; ?></p>
                </div>
                <div class="w-catch">
                    <h5>Nơi đi: </h5>
                    <p><?php echo $rows['NoiKhoiHanh']; ?></p>
                </div>
                <div class="w-day">
                    <h5>Số ngày: </h5>
                    <p><?php echo $rows['SoNgay']; ?></p>
                </div>
                <div class="w-vehicle">
                    <h5>Phương tiện: </h5>
                    <p><?php echo $rows_pt['PhuongTien']; ?></p>
                </div>
                <div class="w-hotel">
                    <h5>Khách sạn: </h5>
                    <p><?php echo $rows_ks['TenKS']; ?></p>
                </div>
                <div class="w-guide">
                    <h5>Hướng dẫn viên: </h5>
                    <p><?php echo $rows_hdv['TenHDV']; ?></p>
                </div>
                <button class="btn btn-book"><a href="dat-tour.php?tour=<?php echo $rows['MaTour']; ?>">Đặt tour</a></button>
            </div>

        </div>
    </div>
</section>

<!-- END NỘI DUNG -->


<?php include('include/footer.php'); ?>