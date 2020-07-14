<?php
session_start();
include('database/db_config.php');
include('function.php');


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
</head>

<body>

    <!-- HEADER -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="index.php">TRAVELLO</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <style>
                .dropdown-menu {
                    width: 200px;
                    margin-top: 2rem;
                }

                .dropdown-menu a {
                    color: #000;
                    padding: 10px 15px;
                    font-weight: normal;
                    font-size: 13px;
                    text-transform: none;
                }
            </style>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="dropdown show">
                        <a class="nav-link" role="button" id="dropdown-travel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#">Du Lịch</a>
                        <div class="dropdown-menu" aria-labelledby="dropdown-travel">
                            <a class="dropdown-item" href="loai-tour.php?loai-tour=1">Du Lịch Trong Nước</a>
                            <a class="dropdown-item" href="loai-tour.php?loai-tour=2">Du Lịch Nước Ngoài</a>
                            <a class="dropdown-item" href="du-lich-tu-chon.php">Du Lịch Tự Chọn</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="thuong-hieu-khach-san.php">Khách Sạn</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="thuong-hieu-nha-hang.php">Nhà Hàng</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Vận Chuyển</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="tin-tuc.php">Tin Tức</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Liên Hệ</a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="dropdown show">
                        <?php
                        if (isset($_SESSION['Email']) && $_SESSION['Email']) {
                            $email = $_SESSION["Email"];

                            $sql = "SELECT * FROM khachhang WHERE Email = '$email'";
                            $result = mysqli_query($connection, $sql);
                            $rows = mysqli_fetch_array($result);
                            
                            echo '<a class="nav-link" role="button" id="dropdown-account" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#"><i class="fas fa-user"></i></a>
                            
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-account" style="width:fit-content">
                                <a class="dropdown-item disabled">' . $rows["TenKH"] . '</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="thong-tin-tai-khoan.php">Thông Tin Tài Khoản</a>
                                <a class="dropdown-item" href="dang-xuat.php">Đơn Hàng</a>
                                <a class="dropdown-item" href="logout.php">Đăng Xuất</a>
                            </div>';
                        } else {
                            echo '<a class="nav-link" href="login.php"><i class="fas fa-key"></i></a>';
                        }
                        ?>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- BANNER -->

    <section class="banner">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="img/Slider-1.jpg" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block animate__animated animate__fadeInUp" style="animation-delay: .3s;">
                        <h5>KHÁM PHÁ THẾ GIỚI</h5>
                        <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
                        <p><a href="#search">Tìm Kiếm Ngay</a></p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="img/Slider-2.jpg" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block animate__animated animate__fadeInUp" style="animation-delay: .3s;">
                        <h5>Trải Nghiệm Mới</h5>
                        <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
                        <p><a href="#">Thêm Thông Tin</a></p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="img/Slider-3.jpg" class="d-block w-100" alt="...">
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

    <!-- END BANNER -->

    <!-- END HEADER -->