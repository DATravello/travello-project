<?php
session_start();

if(isset($_GET['tour']))
{
    $matour=$_GET['tour'];
    require_once('database/db_config.php');

    $query="SELECT * from tourdulich where MaTour='$matour'";
    $result=mysqli_query($connection, $query);
    $rows=@mysqli_fetch_array($result);

    //Loại Tour
    $query2="SELECT * FROM tourdulich INNER JOIN loaitourdulich ON tourdulich.MaLoaiTour = loaitourdulich.MaLoaiTour ";
    $result2=mysqli_query($connection, $query2);
    $rows2=@mysqli_fetch_array($result2);

    //Phương Tiện
    $phuongtien = "SELECT * FROM tourdulich INNER JOIN phuongtien ON tourdulich.MaPhuongTien = phuongtien.MaPhuongTien where MaTour='$matour'";
    $result_pt = mysqli_query($connection, $phuongtien);
    $rows_pt = @mysqli_fetch_array($result_pt);

    //Khách Sạn
    $khachsan = "SELECT * FROM tourdulich INNER JOIN khachsan ON tourdulich.MaKS = khachsan.MaKS where MaTour='$matour'";
    $result_ks = mysqli_query($connection, $khachsan);
    $rows_ks = @mysqli_fetch_array($result_ks);

    //Hướng dẫn viên
    $hdv = "SELECT * FROM tourdulich INNER JOIN huongdanvien ON tourdulich.MaHDV = huongdanvien.MaHDV where MaTour='$matour'";
    $result_hdv = mysqli_query($connection, $hdv);
    $rows_hdv = @mysqli_fetch_array($result_hdv);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Travello</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
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
                        <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Du Lịch</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Khách Sạn</a>
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
        <div class="tour-title"><h2><?php echo $rows['TenTour'];?></h2></div>
        <div class="row">
            <div class="col-md-8">
                <div class="tour-content">
                    <div class="tour-subtitle"><h5><?php echo $rows['TenTour'];?> - <?php echo $rows2['TenLoaiTour'];?></h5></div>
                    <div class="tour-image"><img src="admin/img/tour-du-lich/<?php echo $rows['Anh'];?>"></div>
                    <div class="tour-image-sub">
                        <?php echo $rows['TenTour'];?>
                    </div>
                    <div class="tour-description">
                        <h3>Hành Trình Tour</h3>
                        <?php echo $rows['HanhTrinh'];?>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="tour-widget">
                    <h5 class="w-title">Thông tin tour</h5>
                    <div class="w-price"><h5>Giá: <h5> <p><?php echo $rows['GiaTien'];?> VNĐ <p></div>
                    <div class="w-type"><h5>Loại tour: </h5> <p><?php echo $rows2['TenLoaiTour'];?> <p></div>
                    <div class="w-time"><h5>Thời gian: </h5> <p><?php echo $rows['ThoiGian'];?></p></div>
                    <div class="w-place"><h5>Nơi đến: </h5> <p><?php echo $rows['NoiDen'];?></p></div>
                    <div class="w-catch"><h5>Nơi đi: </h5> <p><?php echo $rows['NoiKhoiHanh'];?></p></div>
                    <div class="w-day"><h5>Số ngày: </h5> <p><?php echo $rows['SoNgay'];?></p></div>
                    <div class="w-vehicle"><h5>Phương tiện: </h5> <p><?php echo $rows_pt['PhuongTien'];?></p></div>
                    <div class="w-hotel"><h5>Khách sạn: </h5> <p><?php echo $rows_ks['TenKS'];?></p></div>
                    <div class="w-guide"><h5>Hướng dẫn viên: </h5> <p><?php echo $rows_hdv['TenHDV'];?></p></div>
                    <button class="btn btn-book"><a href="dat-tour.php?tour=<?php echo $rows['MaTour'];?>">Đặt tour</button>
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