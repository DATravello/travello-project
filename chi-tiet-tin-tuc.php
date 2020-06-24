<?php
session_start();

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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Travello</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/tour.css">
    <link rel="stylesheet" href="css/animate/animate.min.css">
    <link rel="stylesheet" href="css/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap-4.5.0-dist/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"> -->
</head>

<body>

    <!-- Wrapper -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="/index.php">TRAVELLO</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Du Lịch</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="tin-tuc.php">Tin Tức</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="khach-san.php">Khách Sạn</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="nha-hang.php">Nhà Hàng</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Vận Chuyển</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Liên Hệ</a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-shopping-cart"></i></a>
                    </li>
                    <li class="nav-item">
                        <?php
                        if (isset($_SESSION['Email']) && $_SESSION['Email']) {
                            echo '<a class="nav-link" href="#"><i class="fas fa-user"></i></a>';
                        } else {
                            echo '<a class="nav-link" href="login.php"><i class="fas fa-key"></i></a>';
                        }
                        // else
                        // {
                        //     echo '<a class="nav-link" href="login.php"><i class="fas fa-key"></i></a>';
                        // }
                        ?>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <section class="banner">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="img/bana-hill-slider.jpg" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block animate__animated animate__fadeInUp" style="animation-delay: .3s;">
                        <h5>KHÁM PHÁ THẾ GIỚI</h5>
                        <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
                        <p><a href="#search">Tìm Kiếm Ngay</a></p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="img/home_slider.jpg" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block animate__animated animate__fadeInUp" style="animation-delay: .3s;">
                        <h5>Trải Nghiệm Mới</h5>
                        <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
                        <p><a href="#">Thêm Thông Tin</a></p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="img/home_slider.jpg" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block animate__animated animate__fadeInUp" style="animation-delay: .3s;">
                        <h5>Tìm Chuyến Đi</h5>
                        <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
                        <p><a href="#">Tìm Kiếm</a></p>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </section>

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
                    <div><?php echo $rows_loaitt['TenTheLoai']?></div>
                    <div class="fas fa-facebook"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- END NỘI DUNG -->


</body>
<script src="scripts/jquery-3.5.1.slim.min.js"></script>
<script src="scripts/popper.min.js"></script>
<script src="scripts/bootstrap.min.js"></script>
<script src="scripts/fontawesome-kit.js"></script>
<script src="scripts/scroll.js"></script>

</html>