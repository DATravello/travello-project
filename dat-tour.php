<?php
session_start();

if (isset($_GET['tour'])) {
    $matour = $_GET['tour'];
    require_once('database/db_config.php');

    $query = "SELECT * from tourdulich where MaTour='$matour'";
    $result = mysqli_query($connection, $query);
    $rows = @mysqli_fetch_array($result);
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

<!-- CONTENT  -->

    <div class="container tour-book">
        <div class="row">
            <div class="col-md-3">
                <div class="progress active">1. Chọn dịch vụ</div>
            </div>
            <div class="col-md-3">
                <div class="progress">2. Thông tin hành khách</div>
            </div>
            <div class="col-md-3">
                <div class="progress">3. Thanh toán</div>
            </div>
            <div class="col-md-3">
                <div class="progress">4. Xác nhận</div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <h4>Số Lượng Hành Khách</h4>
                <div class="row">
                    <div class="col-md-6">
                        <form>
                            <div class="form-group">
                                <label for="formGroupExampleInput">Số Người Lớn</label>
                                <input type="number" name="GiaNguoiLon" class="form-control" id="adult" value="0" onchange="giaNguoiLon(),tongTien()" onclick="giaNguoiLon(),tongTien()" min="0" pattern="[0-9]{1,5}">
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput2">Số Trẻ em</label>
                                <input type="number" name="GiaTreEm" class="form-control" id="child" value="0" onchange="giaTreEm(),tongTien()" onclick="giaTreEm(),tongTien()" min="0" pattern="[0-9]{1,5}">
                            </div>
                        </form>
                    </div>
                </div>
                <h4>Phương Thức Thanh Toán</h4>
                <div id="accordion">
                    <p>
                        <a class="btn btn-primary" data-toggle="collapse" aria-expanded="true" href="#collapseOne1" role="button" aria-expanded="false" aria-controls="collapseExample">
                            Thanh Toán Bằng Tiền Mặt
                        </a>
                    </p>
                    <div class="collapse" id="collapseOne1" data-parent="#accordion">
                        <div class="card card-body">

                            <h5>Cty Du Lịch Lữ Lành Travello</h5>
                            <p>Địa chỉ: 140 Lê Trọng Tấn, Phường Tây Thạnh, Quận Tân Phú, TP. HCM<br>
                                Hotline: 0326805211</p>
                            Quy khách vui lòng đến văn phòng công ty để tiến hành thanh toán
                        </div>
                    </div>
                    <p>
                        <a class="btn btn-primary" data-toggle="collapse" aria-expanded="true" href="#collapseTwo2" role="button" aria-expanded="false" aria-controls="collapseExample">
                            Thanh Toán Bằng Hình Thức Chuyển Khoản
                        </a>
                    </p>
                    <div class="collapse" id="collapseTwo2" data-parent="#accordion">
                        <div class="card card-body">
                            <div class="row payment">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-4"><img src="img/agribank.png" style="width:100%"></div>
                                        <div class="col-md-8">
                                            <p>Ngân hàng Agribank</p>
                                            <p>Chi nhánh Tân Phú</p>
                                            <p>STK: 012312412</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-4"><img src="img/sacombank.png" style="width:100%"></div>
                                        <div class="col-md-8">
                                            <p>Ngân hàng Sacombank</p>
                                            <p>Chi nhánh Tân Phú</p>
                                            <p>STK: 012141231231</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>           
            </div>
            <script type="text/javascript">
                function giaTreEm() {
                    var sum = document.getElementById("child").value * <?php echo $rows["GiaTien"] ?>;
                    return $("p#Child").html('<i class="fas fa-baby"></i> Giá Trẻ Em: <input id="SumChild" style="color:red;display:inline;font-weight:bold;border:none;width:80px" value="' + sum + '" disabled> đ');
                }

                function giaNguoiLon() {
                    var sum = document.getElementById("adult").value * <?php echo $rows["GiaTien"] ?>;
                    return $("p#Adult").html('<i class="fas fa-male"></i> Giá Người Lớn: <input id="SumAdult" style="color:red;display:inline;font-weight:bold;border:none;width:80px" value="' + sum + '" disabled> đ');
                }

                function tongTien() {
                    var a, b = 0;
                    a = parseInt(document.getElementById("SumChild").value);
                    b = parseInt(document.getElementById("SumAdult").value);
                    var sum = a + b;
                    return $("p#Sum").html('<p><i class="fas fa-dollar-sign"></i> Tổng: <input id="Sum" style="color:#2196F3;display:inline;font-weight:bold;border:none;width:80px" value="' + sum + '" disabled> đ</p>');
                }
            </script>
            <div class="col-md-4">
                <button class="btn btn-info">Hỗ trợ giao dịch 0326805211</button>
                <div class="img-travello"><img src="img/travello-ds.jpg"></div>
                <div class="subtour-info">
                    <p><i class="fas fa-calendar-minus"></i> Ngày đi: <?php echo $rows["ThoiGian"] ?></p>
                    <p><i class="fas fa-calendar-plus"></i> Ngày về: </p>
                    <p><i class="fas fa-calendar-alt"></i> Thời gian: <?php echo $rows["SoNgay"] ?> ngày</p>
                    <p id="Adult" style="display:visible;"></p>
                    <p id="Child" style="display:visible;"></p>
                    <p id="Sum" style="display:visible;"></p>
                </div>
            </div>

        </div>
        <div class="row btn-progress">
            <div class="col-md-6"><button class="btn btn-success"><a href="chi-tiet-tour.php?tour=<?php echo $rows['MaTour']; ?>">Trở Về</button></div>
            <div class="col-md-6"> <button class="btn btn-success"><a href="hanh-khach-tour.php?tour=<?php echo $rows['MaTour']; ?>">Tiếp Theo</button></div>
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