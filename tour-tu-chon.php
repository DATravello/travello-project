<?php
include('include/header.php');
if (isset($_GET['diem-den'])) {
    $mavt = $_GET['diem-den'];
    require_once('database/db_config.php');

    // Querry Khách sạn
    $query = "SELECT * FROM tourdulich WHERE MaViTri='$mavt'";
    $result = mysqli_query($connection, $query);

    //Querry Điểm đến
    $q_diemden = "SELECT * FROM vitri WHERE MaViTri='$mavt'";
    $rs_diemden = mysqli_query($connection, $q_diemden);
    $rw_dd = mysqli_fetch_array($rs_diemden);
    $tendiemden = $rw_dd["TenViTri"];
}
?>

<title><?php echo $tendiemden?> | Du Lịch Tự Chọn | Travello</title>
<!-- NỘI DUNG -->

<section class="container hotel-content">

    <h5 class="title-hotel">DANH SÁCH TOUR DU LỊCH</h5>
    <div class="row">
        <?php
        while ($rows = mysqli_fetch_array($result)) {
        ?>
            <!-- Card -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-img-top">
                        <img style="height: 200px;width: 100%" src="admin/img/tour-du-lich/<?php echo $rows['Anh'] ?>" alt="Card image cap">
                        <div class="feature">Đang Giảm Giá</div>
                        <div class="like"><i class="fas fa-heart"></i></div>
                    </div>
                    <div class="card-body">
                        <p class="card-location"><i class="fas fa-map-marker-alt"></i>
                            <?php
                            $vitri = $rows['MaViTri'];
                            $q_vitri = "SELECT * FROM vitri WHERE MaViTri= '$vitri'";
                            $rs_vitri = mysqli_query($connection, $q_vitri);
                            $rw_vitri = mysqli_fetch_array($rs_vitri);
                            ?>
                            <?php echo $rw_vitri['TenViTri'] 
                            ?>
                        </p>
                        <h5 class="card-title"><a href="chi-tiet-tour-tu-chon.php?tour=<?php echo $rows['MaTour']; ?>"><?php echo $rows['TenTour'] ?></a></h5>
                        <p class="card-text">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i> <span class="reviews">4 Reviews</span>
                        </p>
                    </div>
                    <div class="card-footer d-flex">
                        <div class="card-f-left"><i class="far fa-clock"></i> <?php echo $rows['SoNgay'] ?> Ngày</div>
                        <div class="ml-auto card-f-right"><i class="fas fa-dollar-sign"></i> <span class="price"><?php echo product_price($rows['GiaTien']) ?></span></div>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </div>

</section>



<?php
include('include/footer.php');
?>