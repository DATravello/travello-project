<?php
include('include/header.php');

if (isset($_GET['nha-hang'])) {
    $manh = $_GET['nha-hang'];
    require_once('database/db_config.php');

    $query = "SELECT * from nhahang where MaNH='$manh'";
    $result = mysqli_query($connection, $query);
    $rows = @mysqli_fetch_array($result);
}
?>

<!-- NỘI DUNG -->

<div class="container tour-container hotel-content">
    <div class="tour-title">
        <h2><?php echo $rows['TenNhaHang']; ?></h2>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="tour-content">
                <!-- <div class="tour-subtitle"><h5><?php echo $rows['TenNhaHang']; ?>  <?php echo $rows2['TenLoaiKS']; ?></h5></div> -->
                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active" style="height:400px">
                            <img class="d-block w-100" src="admin/img/nha-hang/<?php echo $rows['Anh']; ?>" width="100%" alt="Second slide">
                        </div>
                        <div class="carousel-item" style="height:400px">
                            <img class="d-block w-100" src="admin/img/nha-hang/<?php echo $rows['Anh']; ?>" width="100%" alt="Second slide">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
                <div class="tour-image-sub">
                    <?php echo $rows['TenNhaHang']; ?>
                </div>

                <div class="tour-description">
                    <div class="tab-hotel">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-button active" id="mota-tab" data-toggle="tab" href="#mota" role="tab" aria-controls="home" aria-selected="true">Giới Thiệu Nhà Hàng</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-button" id="mota-thucdon-tab" data-toggle="tab" href="#mota-thucdon" role="tab" aria-controls="profile" aria-selected="false">Thực Đơn Nhà Hàng</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="mota" role="tabpanel" aria-labelledby="home-tab">
                                <p><?php echo $rows['GioiThieuNH']; ?><p>
                            </div>
                            <div class="tab-pane fade" id="mota-thucdon" role="tabpanel" aria-labelledby="profile-tab">
                                <p><?php echo $rows['MoTaThucDon']; ?><p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="tour-widget">
                <h5 class="w-title">Thông tin</h5>
                <br>
                <p class="w-hotel-price"><i class="fas fa-dollar-sign"></i> <?php echo product_price($rows['GiaNguoiLon']); ?>/Người lớn</p>
                <p class="w-hotel-price"><i class="fas fa-dollar-sign"></i> <?php echo product_price($rows['GiaTreEm']); ?>/Trẻ em</p>
                <p class="w-hotel-address"><i class="fas fa-map-marker-alt"></i> <?php echo $rows['DiaChi']; ?></p>
                <p class="w-hotel-phone"><i class="fas fa-phone-square"></i> <?php echo $rows['SDT']; ?></p>
                <div class="form-group">
                    <a class="btn btn-book" href="#">Liên Hệ Đặt Bàn</a>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- END NỘI DUNG -->

<?php include('include/footer.php'); ?>