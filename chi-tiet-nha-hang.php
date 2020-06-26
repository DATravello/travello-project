<?php
include('include/header.php');

if (isset($_GET['nhahang'])) {
    $manh = $_GET['nhahang'];
    require_once('database/db_config.php');

    $query = "SELECT * from nhahang where MaNH='$manh'";
    $result = mysqli_query($connection, $query);
    $rows = @mysqli_fetch_array($result);
}
?>

<!-- NỘI DUNG -->

<div class="container tour-container">
    <div class="tour-title">
        <h2><?php echo $rows['TenNhaHang']; ?></h2>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="tour-content">
                <!-- <div class="tour-subtitle"><h5><?php echo $rows['TenNhaHang']; ?>  <?php echo $rows2['TenLoaiKS']; ?></h5></div> -->
                <div class="tour-image"><img src="admin/img/nha-hang/<?php echo $rows['Anh']; ?>"></div>
                <div class="tour-image-sub">
                    <?php echo $rows['TenNhaHang']; ?>
                </div>
                <div class="tour-description">
                    <h3>Giới Thiệu </h3>
                    <!-- <div class="w-type"><h5>Hạng Sao: </h5> <p><?php echo $rows['HangSao']; ?> * <p></div> -->
                    <?php echo $rows['GioiThieuNH']; ?><br />
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="tour-widget">
                <h5 class="w-title">Thông tin đặt nhà hàng</h5>
                <div class="w-price">
                    <h5>Giá: <h5>
                            <p><?php echo $rows['GiaNH']; ?> VNĐ <p>
                </div>
                <div class="w-time">
                    <h5>Địa Chỉ: </h5>
                    <p><?php echo $rows['DiaChi']; ?></p>
                </div>
                <div class="w-place">
                    <h5>Điện Thoại: </h5>
                    <p><?php echo $rows['SDT']; ?></p>
                </div>
                <div class="form-group">
                    <label> Ngày Đến </label>
                    <input type="date" name="NgayDen" class="form-control" placeholder="Nhập Ngày Đến">
                </div>
                <div class="form-group">
                    <label> Ngày Đi </label>
                    <input type="date" name="NgayDi" class="form-control" placeholder="Nhập Ngày Đi">
                </div>
                <button class="btn btn-book"><a href="dat-nha-hang.php?tour=<?php echo $rows['MaNH']; ?>">Đặt Nhà Hàng</button>
            </div>

        </div>
    </div>
</div>

<!-- END NỘI DUNG -->


<?php include('include/footer.php'); ?>