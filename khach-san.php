<?php include('include/header.php');

if (isset($_GET['diem-den']) && isset($_GET['thuong-hieu'])) {
    $mavt = $_GET['diem-den'];
    $math = $_GET['thuong-hieu'];
    require_once('database/db_config.php');

    //QUERY Khách Sạn, Vị Trí theo Mã thương hiệu
    $q_ks = "SELECT * FROM khachsan Where MaViTri ='$mavt' AND MaThuongHieuKS='$math'";
    $rs_ks = mysqli_query($connection, $q_ks);

    //Query Tên Thương Hiệu KS
	$q_th = "SELECT * FROM thuonghieuks WHERE MaThuongHieuKS = $math";
	$rs_th = mysqli_query($connection, $q_th);
	$rw_th = mysqli_fetch_array($rs_th);
    $thuonghieu = $rw_th["TenThuongHieuKS"];
    
    //Query Vị Trí
    $q_vt = "SELECT * FROM vitri WHERE MaViTri = $mavt";
	$rs_vt = mysqli_query($connection, $q_vt);
	$rw_vt = mysqli_fetch_array($rs_vt);
    $vitri = $rw_vt["TenViTri"];

}
?>

<title><?php echo $thuonghieu?> | <?php echo $vitri?>  | Travello</title>

<!-- NỘI DUNG -->

<section class="container khach-san">

    <div class="row">
        <?php
        while ($rw_ks = mysqli_fetch_array($rs_ks)) {
        ?>

            <!-- Card -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-img-top">
                        <img style="height: 200px;width: 100%" src="admin/img/khach-san/<?php echo $rw_ks['Anh'] ?>" alt="Card image cap">
                        <div class="feature">Best Seller</div>
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
                        <h5 class="card-title"><a href="chi-tiet-khach-san.php?khach-san=<?php echo $rw_ks['MaKS']; ?>"><?php echo $rw_ks['TenKS'] ?></a></h5>
                        <p class="card-text">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i> <span class="reviews">4 Reviews</span>
                        </p>
                    </div>
                    <div class="card-footer d-flex">
                        <div class="card-f-left"><i class="fas fa-door-closed"></i> <?php echo $rw_ks['SoPhong'] ?> Phòng Trống</div>
                        <div class="ml-auto card-f-right"><i class="fas fa-dollar-sign"></i> <span class="price"><?php echo product_price($rw_ks['Gia']) ?>/Đêm</span></div>
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