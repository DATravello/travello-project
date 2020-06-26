<?php
include('include/header.php');


if (isset($_GET['diem-den'])) {
    $madiemdien = $_GET['diem-den'];
    require_once('database/db_config.php');

    // Querry Khách sạn
    $query = "SELECT * FROM khachsan WHERE MaViTri='$madiemdien'";
    $result = mysqli_query($connection, $query);

    // Querry Điểm đến
    $q_diemden = "SELECT * FROM vitri WHERE MaViTri='$madiemdien'";
    $rs_diemden = mysqli_query($connection, $q_diemden);
    $rw_dd = mysqli_fetch_array($rs_diemden);
}
?>

<!-- NỘI DUNG -->

<section class="container hotel-content">

    <h5 class="title-hotel">DANH SÁCH KHÁCH SẠN</h5>
    <div class="row">
        <?php
        while ($rows = mysqli_fetch_array($result)) {
        ?>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-img-top">
                        <img style="height: 200px;width: 100%" src="admin/img/khach-san/<?php echo $rows['Anh'] ?>" alt="Card image cap">
                        <div class="feature">Đang Giảm Giá</div>
                        <div class="like"><i class="fas fa-heart"></i></div>
                    </div>
                    <div class="card-body">
                        <p class="card-location"><i class="fas fa-map-marker-alt"></i> <?php echo $rw_dd['TenViTri'] ?></p>
                        <h5 class="card-title"><a href="dat-tour-tu-chon.php?khach-san=<?php echo $rows['MaKS']; ?>"><?php echo $rows['TenKS'] ?></a></h5>
                        <p class="card-text">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i> <span class="reviews">4 Reviews</span>
                        </p>
                    </div>
                    <div class="card-footer d-flex">
                        <div class="card-f-left"><i class="far fa-clock"></i> <?php echo $rows['SoPhong'] ?> Phòng</div>
                        <div class="ml-auto card-f-right"><i class="fas fa-dollar-sign"></i> <span class="price"><?php echo product_price($rows['Gia']) ?></span></div>
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