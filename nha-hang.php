<?php include('include/header.php');

if (isset($_GET['diem-den']) && isset($_GET['thuong-hieu'])) {
    $mavt = $_GET['diem-den'];
    $math = $_GET['thuong-hieu'];
    require_once('database/db_config.php');

    //QUERY Nhà Hàng, Vị Trí theo Mã thương hiệu
    $q_nh = "SELECT * FROM nhahang Where MaViTri='$mavt' AND MaThuongHieuNH='$math'";
    $rs_nh = mysqli_query($connection, $q_nh);
}
?>
<!-- NỘI DUNG -->
<title>Nhà Hàng | Travello</title>
<section class="container khach-san">

    <div class="row">
        <?php
        while ($rw_nh = mysqli_fetch_array($rs_nh)) {
        ?>

            <!-- Card -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-img-top">
                        <img style="height: 200px;width: 100%" src="admin/img/nha-hang/<?php echo $rw_nh['Anh'] ?>" alt="Card image cap">
                        <div class="feature">Feature</div>
                        <div class="like"><i class="fas fa-heart"></i></div>
                    </div>
                    <div class="card-body">
                        <p class="card-location"><i class="fas fa-map-marker-alt"></i>
                            <?php
                            $q_vitri = "SELECT * FROM vitri WHERE MaViTri= '$mavt'";
                            $rs_vitri = mysqli_query($connection, $q_vitri);
                            $rw_vitri = mysqli_fetch_array($rs_vitri);
                            ?>
                            <?php echo $rw_vitri['TenViTri']
                            ?>
                        </p>
                        <h5 class="card-title"><a href="chi-tiet-nha-hang.php?nha-hang=<?php echo $rw_nh['MaNH']; ?>"><?php echo $rw_nh['TenNhaHang'] ?></a></h5>
                        <p class="card-text">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i> <span class="reviews">4 Reviews</span>
                        </p>
                    </div>
                    <div class="card-footer d-flex">
                        <div class="card-f-left"><i class="fas fa-utensils" style="margin-right: 5px;"></i> Đặt Bàn</div>
                        <div class="ml-auto card-f-right"><i class="fas fa-dollar-sign"></i> <span class="price"><?php echo product_price($rw_nh['GiaNguoiLon']) ?>/Người</span></div>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </div>

</section>
<!-- END NỘI DUNG -->

<?php include('include/footer.php'); ?>