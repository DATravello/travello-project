<?php
include('include/header.php');

if (isset($_GET['tintuc'])) {
    $matt = $_GET['tintuc'];
    require_once('database/db_config.php');

    $query = "SELECT * from tintuc where MaTinTuc='$matt'";
    $result = mysqli_query($connection, $query);
    $rows = @mysqli_fetch_array($result);
    $tl = $rows["MaTheLoai"];

    // $query2 = "SELECT * from theloai where MaTheLoai='6'";
    // $result2 = mysqli_query($connection, $query2);
    // $rows2 = @mysqli_fetch_array($result2);

    //Query Tin Tức Cùng Thể Loại
    $q_tt = "SELECT * FROM tintuc WHERE MaTheLoai = $tl";
    $rs_tt = mysqli_query($connection, $q_tt);

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
        <style>
            .container {
                max-width: 1200px !important;
            }

            .tour-widget i {
                color: #2196F3;
                font-size: 20px;
                margin-right: 10px;
            }

            .tour-widget i:first-child {
                margin-left: 10px;
            }

            .tour-widget .link-news {
                color: #000;
                text-decoration: none;
                font-weight: bold;
            }

            .tour-widget .link-news:hover {
                color: #2196F3;
            }
            .tour-widget .sub-link {
                font-size: 10px!important;
            }
        </style>
        <div class="col-md-4">
            <div class="tour-widget">
                <h5 class="w-title">Chuyên Mục</h5>
                <div style="color:#F8A449;font-weight:bold"><?php echo $rows_loaitt['TenTheLoai'] ?></div>
                Chia sẻ lên: <i class="fab fa-facebook"></i> <i class="fab fa-twitter"></i> <i class="fab fa-instagram"></i>
            </div>
            <div class="tour-widget" style="margin-top:20px;">
                <h5 class="w-title">Cùng Chuyên Mục</h5>
                <?php
                while ($rw_tt = @mysqli_fetch_array($rs_tt)) {
                ?>
                    <div class="row">
                        <div class="col-md-5"><img style="width: 100%;" src="admin/img/tin-tuc/<?php echo $rw_tt["HinhAnh"] ?>"></div>
                        <div class="col-md-7">
                            <a class="link-news" href="chi-tiet-tin-tuc.php?tintuc=<?php echo $rw_tt["MaTinTuc"] ?>"><?php echo $rw_tt["TenTinTuc"] ?></a>
                            <div class="sub-link"><i class="far fa-clock" style="color:#768092;font-size:14px;margin:0"></i> <p style="color:#2196F3;font-size:14px"><?php echo $rw_tt["Ngay"] ?></p></div>
                        </div>
                    </div>
                    <hr>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>

<!-- END NỘI DUNG -->


<?php include('include/footer.php'); ?>