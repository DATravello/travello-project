<?php
include('include/header.php');

if (isset($_GET['tintuc'])) {
    $matt = $_GET['tintuc'];
    require_once('database/db_config.php');

    $query = "SELECT * from tintuc where MaTinTuc='$matt'";
    $result = mysqli_query($connection, $query);
    $rows = @mysqli_fetch_array($result);

    $query2 = "SELECT * from theloai where MaTheLoai='6'";
    $result2 = mysqli_query($connection, $query2);
    $rows2 = @mysqli_fetch_array($result2);

    //Loại KS
    $loaitt = "SELECT * FROM tintuc INNER JOIN theloai ON tintuc.MaTheLoai = theloai.MaTheLoai where MaTinTuc='$matt'";
    $result_loaitt = mysqli_query($connection, $loaitt);
    $rows_loaitt = @mysqli_fetch_array($result_loaitt);
}
?>

<!-- NỘI DUNG -->

<div class="container tour-container">
    <div class="tour-title">
        <h3 style="font-weight: bold; font-style: 30px;"><?php echo $rows['TenTinTuc']; ?></h3>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="tour-content">
                <div class="w-type" style="font-size: 15px; font-style: italic"><?php echo $rows['MoTa']; ?></div>
                <div class="tour-image">
                    <img src="admin/img/tin-tuc/<?php echo $rows['HinhAnh']; ?>"></div>
                <div class="tour-image-sub">
                    <?php echo $rows['TenTinTuc']; ?>
                </div>
                <?php echo $rows['ChiTiet']; ?>
                <div style="text-align:right;font-weight: bold;"> Nguồn: <?php echo $rows['TaoBoi']; ?></div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="tour-widget">
                <h5 class="w-title">Thông tin</h5>
                <div><?php echo $rows_loaitt['TenTheLoai'] ?></div>
                <div class="fas fa-facebook"></div>
            </div>
        </div>
    </div>
</div>

<!-- END NỘI DUNG -->


<?php include('include/footer.php'); ?>