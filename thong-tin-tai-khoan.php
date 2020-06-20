<?php
session_start();

include('database/db_config.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Travello</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/user.css">
    <link rel="stylesheet" href="css/animate/animate.min.css">
    <link rel="stylesheet" href="css/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap-4.5.0-dist/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"> -->
</head>

<body>

    <!-- Wrapper -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">TRAVELLO</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
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
                    <img src="img/home_slider.jpg" class="d-block w-100" alt="...">
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

    <?php
    $email = $_SESSION['Email'];
    $query = "SELECT * from khachhang where Email = '$email'";
    $result = mysqli_query($connection, $query);
    $rowTK = mysqli_fetch_array($result);

    $MaKH = $rowTK["MaKH"];
    ?>

    <div class="container users">
        <div class="row">
            <div class="col-4">
                <div class="list-group" id="list-tab" role="tablist">
                    <a class="list-group-item list-group-item-action active" id="list-home-list" data-toggle="list" href="#list-home" role="tab" aria-controls="home">Thông Tin Tài Khoản</a>
                    <a class="list-group-item list-group-item-action" id="list-profile-list" data-toggle="list" href="#list-profile" role="tab" aria-controls="profile">Quản Lý Đơn Hàng</a>
                    <a class="list-group-item list-group-item-action" id="list-messages-list" data-toggle="list" href="#list-messages" role="tab" aria-controls="messages">Tour Yêu Thích</a>
                    <a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="list" href="#list-settings" role="tab" aria-controls="settings">Tour Đã Xem</a>
                </div>
            </div>
            <div class="col-8">
                <div class="tab-content" id="nav-tabContent">
                    <!-- Thông tin tài khoản -->
                    <div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
                        <h5>Thông Tin Tài Khoản</h5>
                        <form class="info-u">

                            <div class="form-group">
                                <label for="formGroupExampleInput">Họ Tên</label>
                                <input type="text" class="form-control" id="formGroupExampleInput" placeholder="<?php echo $rowTK["TenKH"] ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput2">Ngày Sinh</label>
                                <input type="text" class="form-control" id="formGroupExampleInput" placeholder="<?php echo $rowTK["NgaySinh"] ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput2">Địa Chỉ</label>
                                <input type="text" class="form-control" id="formGroupExampleInput" placeholder="<?php echo $rowTK["DiaChi"] ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput2">Giới Tính</label>
                                <input type="text" class="form-control" id="formGroupExampleInput" placeholder="<?php echo $rowTK["GioiTinh"] ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput2">Số Điện Thoại</label>
                                <input type="text" class="form-control" id="formGroupExampleInput" placeholder="<?php echo $rowTK["SDT"] ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput2">Email</label>
                                <input type="text" class="form-control" id="formGroupExampleInput" placeholder="<?php echo $rowTK["Email"] ?>" readonly>
                            </div>
                        </form>
                    </div>

                    <!--  Quản Lý Đơn Hàng -->
                    <?php
                    $q_hd = "SELECT * FROM hoadon WHERE MaKH = '$MaKH'";
                    $r_hd = mysqli_query($connection, $q_hd);
                    ?>
                    <div class="tab-pane fade" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">
                        <div class="list-group">
                            <h5>Danh Sách Tour Đã Đặt</h5>
                            <?php
                            while ($rowHD = @mysqli_fetch_array($r_hd)) {
                            ?>
                                <a href="#" class="list-group-item list-group-item-action disabled orders">Tour #<?php echo $rowHD["MaHD"] ?> <p class="status">(<?php echo $rowHD["TinhTrang"]?>)</p></a>
                            <?php
                            }
                            ?>
                        </div>
                    </div>


                    <div class="tab-pane fade" id="list-messages" role="tabpanel" aria-labelledby="list-messages-list">...</div>
                    <div class="tab-pane fade" id="list-settings" role="tabpanel" aria-labelledby="list-settings-list">...</div>
                </div>
            </div>
        </div>
    </div>

</body>
<script src="scripts/jquery-3.5.1.slim.min.js"></script>
<script src="scripts/popper.min.js"></script>
<script src="scripts/bootstrap.min.js"></script>
<script src="scripts/fontawesome-kit.js"></script>
<script src="scripts/scroll.js"></script>
<script src="js/cus.js"></script>

</html>