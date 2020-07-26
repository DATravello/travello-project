<?php
include('include/header.php');

if (isset($_GET['khach-san'])) {
    $maks = $_GET['khach-san'];
    require_once('database/db_config.php');

    // //Khách Sạn
    $query = "SELECT * from khachsan where MaKS='$maks'";
    $result = mysqli_query($connection, $query);
    $rows = @mysqli_fetch_array($result);

    $query2 = "SELECT * from loaiks where MaLoaiKS='1'";
    $result2 = mysqli_query($connection, $query2);
    $rows2 = @mysqli_fetch_array($result2);

    //Loại KS
    $loaiks = "SELECT * FROM khachsan INNER JOIN loaiks ON khachsan.MaLoaiKS = loaiks.MaLoaiKS where MaKS='$maks'";
    $result_loaks = mysqli_query($connection, $loaiks);
    $rows_loaiks = @mysqli_fetch_array($result_pt);
}
?>

<title><?php echo $rows['TenKS']; ?> | Travello</title>
<!-- NỘI DUNG -->

<div class="container tour-container hotel-content">
    <div class="tour-title">
        <h2><?php echo $rows['TenKS']; ?></h2>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="tour-content">
                <!-- <div class="tour-subtitle"><h5><?php echo $rows['TenKS']; ?>  <?php echo $rows2['TenLoaiKS']; ?></h5></div> -->
                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active" style="height:400px">
                            <img class="d-block w-100" src="admin/img/loai-phong/<?php echo $rows['AnhLoaiPhong']; ?>" width="100%" alt="First slide">
                        </div>
                        <div class="carousel-item" style="height:400px">
                            <img class="d-block w-100" src="admin/img/khach-san/<?php echo $rows['Anh']; ?>" width="100%" alt="Second slide">
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
                    <?php echo $rows['TenKS']; ?>
                </div>
                <div class="tour-description">
                    <div class="tab-hotel">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-button active" id="mota-tab" data-toggle="tab" href="#mota" role="tab" aria-controls="home" aria-selected="true">Giới Thiệu Khách Sạn</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-button" id="mota-phong-tab" data-toggle="tab" href="#mota-phong" role="tab" aria-controls="profile" aria-selected="false">Thông Tin Loại Phòng</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="mota" role="tabpanel" aria-labelledby="home-tab">
                                <p><?php echo $rows['MoTa']; ?><p>
                            </div>
                            <div class="tab-pane fade" id="mota-phong" role="tabpanel" aria-labelledby="profile-tab">
                                <p><?php echo $rows['MoTaLoaiPhong']; ?><p>
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
                <p class="w-hotel-star">
                    <?php
                    $hangsao = $rows["HangSao"];
                    for ($i = 1; $i < $hangsao; $i++) echo '<i class="fas fa-star" aria-hidden="true" style="color:#FFDC00"></i> '
                    ?>
                </p>
                <p class="w-hotel-price"><i class="fas fa-dollar-sign"></i> <?php echo product_price($rows['Gia']); ?></p>
                <p class="w-hotel-room"><i class="fas fa-history"></i> <?php echo $rows['SoPhong']; ?> phòng trống</p>
                <p class="w-hotel-address"><i class="fas fa-map-marker-alt"></i> <?php echo $rows['DiaChi']; ?></p>
                <p class="w-hotel-phone"><i class="fas fa-phone-square"></i> <?php echo $rows['DienThoai']; ?></p>
                <p class="w-hotel-web"><i class="fas fa-globe"></i> <?php echo $rows['WebSite']; ?></p>
                <div class="form-group">
                    <a class="btn btn-book" href="#">Liên Hệ Đặt Phòng</a>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- END NỘI DUNG -->


<?php include('include/footer.php'); ?>