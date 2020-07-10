<!-- DONE -->

<?php
session_start();
include('database/db_config.php');
include('function.php');

if (isset($_GET['tour'])) {
    $email = $_SESSION['Email'];
    $matour = $_GET['tour'];
    //Query Tour
    $query = "SELECT * from tourdulich where MaTour='$matour'";
    $result = mysqli_query($connection, $query);
    $rows = @mysqli_fetch_array($result);
    //Query Khach Hang
    $kh = "SELECT * FROM khachhang WHERE Email = '$email'";
    $rs_kh = mysqli_query($connection, $kh);
    $r_kh = mysqli_fetch_array($rs_kh);
    $maKhachHang = $r_kh["MaKH"];

    //Gan bien
    $giaNguoiLon = $rows["GiaTien"];
    $giaTreEm = $rows["GiaTreEm"];
}

if (isset($_POST['btn_DatTour'])) {
    $permitted_chars = '0123456789';
    $maHD = substr(str_shuffle($permitted_chars), 0, 8);
    $soTreEm = $_POST["SoTreEm"];
    $soNguoiLon = $_POST["SoNguoiLon"];
    $thanhToan = $_POST["ThanhToan"];
    $ngayDat = date("Y-m-d");
    $tinhTrang = "Chưa Xác Nhận";
    $giaNguoiLon = $rows["GiaTien"];
    $giaTreEm = $rows["GiaTreEm"];
    $TongTien = ($giaNguoiLon * $soNguoiLon) + ($giaTreEm * $soTreEm);
    $maKhachHang = $r_kh["MaKH"];
    $sl = $soTreEm + $soNguoiLon;

    $query = "INSERT INTO hoadon (`MaHD`, `MaTT`, `MaKH`,`MaTour`,`SoNguoiLon`, `SoTreEm`, `NgayDat`, `TongTien`, `TinhTrang`) 
                    VALUES ('$maHD','$thanhToan', '$maKhachHang', '$matour', '$soNguoiLon', '$soTreEm', '$ngayDat', '$TongTien', '$tinhTrang')";
    $query_run = mysqli_query($connection, $query);
    if ($query_run) {
        for ($i = 1; $i <= $sl; $i++) {
            $maHoaDon = $maHD;
            $tenHK = $_POST["TenHK$i"];
            $cmndHK = $_POST["CmndHK$i"];
            $sdtHK = $_POST["SdtHK$i"];
            $gioitinhHK = $_POST["GioiTinhHK$i"];
            $ngaysinhHK = $_POST["ngaysinhHK$i"];

            $query2 = "INSERT INTO thanhvientour (`MaHD`, `TenTV`, `CMND`, `SDT`, `GioiTinh`, `NgaySinh`) 
                        VALUES ('$maHD', '$tenHK', '$cmndHK', '$sdtHK', '$gioitinhHK', '$ngaysinhHK')";
            $query2_run = mysqli_query($connection, $query2);
        }
        if ($query2_run) {
            echo '<script>alert("Đặt tour thành công!<br>Vui lòng kiểm tra Email");</script>';
            header("Location: index.php");
        } else {
            echo '<script>alert("Đặt tour thất bại!");</script>';
            header("Location: dat-tour.php?tour=" . $matour);
        }
    } else {
        header("Location: dat-tour.php?tour=" . $matour);
    }

    $email = $_SESSION['Email'];
    $ngayhientai = date("Y-m-d");
    require_once('admin/phpmailler/class.phpmailer.php');
    // and NgayDat='$ngayhientai'

    $mailday = "";
    require_once('admin/phpmailler/class.phpmailer.php');

    //Khởi tạo đối tượng
    $mail = new PHPMailer();
    $mail->IsSMTP(); // Gọi đến class xử lý SMTP
    $mail->Host       = "smtp.gmail.com"; // tên SMTP server
    $mail->SMTPAuth   = true;                  // Sử dụng đăng nhập vào account
    $mail->SMTPSecure = "ssl";
    $mail->Host       = "smtp.gmail.com";     // Thiết lập thông tin của SMPT
    $mail->Port       = 465;                     // Thiết lập cổng gửi email của máy
    $mail->Username   = "huy240298@gmail.com"; // SMTP account username
    $mail->Password   = "hue240298";            // SMTP account password
    //Thiet lap thong tin nguoi gui va email nguoi gui
    $mail->SetFrom('huy240298@gmail.com', 'Travello');
    //Thiết lập thông tin người nhận
    $mail->AddAddress($email, "Khách hàng");
    //Thiết lập email nhận email hồi đáp
    //nếu người nhận nhấn nút Reply
    $mail->AddReplyTo("huy240298@gmail.com", "Travello");
    $mail->Subject    = "Travello";
    //Thiết lập định dạng font chữ
    $mail->CharSet = "utf-8";
    //Thiết lập nội dung chính của email
    $tenkh = $r_kh["TenKH"];
    $sdtkh = $r_kh["SDT"];
    $body = "Chào";
    $mail->isHTML(true);
    $mail->Body = '
    <html>

<head>
<style type="text/css">
section {
    display: -webkit-flex;
    display: flex;
    margin: 20px auto;
}

.left {
    -webkit-flex: 2;
    -ms-flex: 2;
    flex: 2;
}

.right {
    -webkit-flex: 2;
    -ms-flex: 2;
    flex: 2;
}

th {
    text-align: left;
    padding-left: 20px;
    background-color: rgba(0,0,0,.075);
}

td {
    border: 1px solid #eee;
}

.bg-primary {
    background: #007bff;
    color: #fff;
    padding: 20px 0;
    text-align: center;
}
.bg-primary p {
    margin: 5px 0;
}
h5 {
    font-size: 20px;
}
</style>
</head>


<body>
    <div class="container">
        <hr>
        <h3 style="text-align:center">PHIẾU XÁC NHẬN BOOKING</h3>
        <hr>
        <h5 style="color:red">A. Thông Tin Booking</h5>

        <section>
            <div class="left">
                <table style="width:100%">
                    <tr>
                        <th>Mã đơn hàng:</th>
                        <td>' . $maHD . '</td>
                    </tr>
                    <tr>
                        <th>Họ tên:</th>
                        <td>' . $tenkh . '</td>
                    </tr>
                    <tr>
                        <th>Số điện thoại:</th>
                        <td>' . $sdtkh . '</td>
                    </tr>
                    <tr>
                        <th>Tình trạng booking:</th>
                        <td>Chờ xác nhận</td>
                    </tr>
                </table>
            </div>
            <div class="right">
                <table style="width:100%">
                    <tr>
                        <th>Ngày tạo:</th>
                        <td>' . $ngayhientai . '</td>
                    </tr>
                    <tr>
                        <th>Email:</th>
                        <td>' . $email . '</td>
                    </tr>
                    <tr>
                        <th>Tình trạng thanh toán:</th>
                        <td>Chưa thanh toán</td>
                    </tr>
                    <tr>
                        <th>Tổng Tiền:</th>
                        <td>' .product_price($TongTien). '</td>
                    </tr>
                </table>
            </div>
        </section>


        <h5 style="color:red">B. Chi Tiết Booking</h5>

        <div class="group-amount">
            <table style="width:50%;">
                <tr>
                    <th>Số người lớn:</th>
                    <td>' .$soNguoiLon. '</td>
                </tr>
                <tr>
                    <th>Số trẻ em:</th>
                    <td>' .$soTreEm. '</td>
                </tr>
            </table>
        </div>

        <p>Cám ơn quý khách đã tin tưởng và chọn dịch vụ của chúng tôi!<br>
            Quý khách vui lòng kiểm tra lại toàn bộ thông tin đặt tour, bộ phận CSKH sẽ liên lạc với quý khách qua số điện thoại trên trong thời gian sớm nhất để xác định việc đặt tour.<br>
            Chúc quý khách 1 chuyến du lịch thật vui vẻ và bổ ích!
        </p>


        <div class="bg-primary">
            <p><b>Công ty Du lịch và Lữ hành Travello</b><br></p>
            <p>140 Lê Trọng Tấn, P. Tây Thạnh, Q. Tân Phú, TP. HCM<br></p>
            <p>ĐT: (+84) 326 805 211 - Email: Travello@gmail.com</p>
        </div>
    </div>
</body>

</html>';
    // $mail->Body=$row['hoadon'];
    if ($mail->Send()) {
        echo "<div class='alert alert-success'>Đặt hàng thành công.</div>";
    } else
        echo "<div class='alert alert-success'>Đặt hàng thất bại.</div>";
} ?>


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

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="du-lich-tu-chon.php">Du Lịch</a>
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
                        <a class="nav-link" href="tin-tuc.php">Tin Tức</a>
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
                            echo '<a class="nav-link" href="thong-tin-tai-khoan.php"><i class="fas fa-user"></i></a>';
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

    <!-- CONTENT  -->
    <script type="text/javascript">
        function giaTreEm() {
            var sum = document.getElementById("child").value * <?php echo $rows["GiaTreEm"] ?>;
            var a = $("#child").val();
            if (parseInt(a) == 0) {
                document.getElementById("Child").style.visibility = "hidden";
            } else {
                document.getElementById("Child").style.visibility = "visible";
                return $("p#Child").html('<p style="display:inline"><i class="fas fa-baby"></i> Giá Trẻ Em:</p> <p id="SumChild" style="color:red;display:inline;font-weight:bold;border:none;width:80px">' + sum.toLocaleString('vi', {
                    style: 'currency',
                    currency: 'VND'
                }) + '</p>');
            }
        }

        function giaNguoiLon() {
            var sum = document.getElementById("adult").value * <?php echo $rows["GiaTien"] ?>;
            var a = $("#adult").val();
            if (parseInt(a) == 0) {
                document.getElementById("Adult").style.visibility = "hidden";
            } else {
                document.getElementById("Adult").style.visibility = "visible";
                return $("p#Adult").html('<p style="display:inline"><i class="fas fa-male"></i> Giá Người Lớn:</p> <p id="SumAdult" style="color:red;display:inline;font-weight:bold;border:none;width:80px">' + sum.toLocaleString('vi', {
                    style: 'currency',
                    currency: 'VND'
                }) + '</p>');
            }
        }

        function tongTien() {
            var sum = (document.getElementById("child").value * <?php echo $rows["GiaTreEm"] ?>) + (document.getElementById("adult").value * <?php echo $rows["GiaTien"] ?>);
            var a = $("#adult").val();
            var b = $("#child").val()
            if (parseInt(a) == 0 && parseInt(b) == 0) {
                document.getElementById("Sum").style.visibility = "hidden";
            } else {
                document.getElementById("Sum").style.visibility = "visible";
                return $("p#Sum").html('<p style="display:inline"><i class="fas fa-dollar-sign"></i> Tổng:</p> <p id="TongTien" name="TongTien" style="color:red;font-weight: bold;display:inline-block">' + sum.toLocaleString('vi', {
                    style: 'currency',
                    currency: 'VND'
                }) + '</p>');
            }
        }

        function soHanhKhach() {
            if ($("#adult").val() == "0") {
                $('#myModal').modal('show');
            } else {
                if ($("#adult").val() == "" || $("#child").val() == "") {
                    $('#myModal2').modal('show');
                } else {
                    var x = parseInt(document.getElementById('adult').value) + parseInt(document.getElementById('child').value);

                    for (var i = 1; i <= x; i++) {
                        $("#holder").append('<h5>Thông tin hành khách #' + i + '</h5>' + '<div class="form-row">' +
                            '<div class="form-group col-md-6"><label>Tên (*)</label><input type="text" name="TenHK' + i + '" class="form-control" id="TenHK' + i + '" placeholder="Nhập Tên Hành Khách"></div>' +
                            '<div class="form-group col-md-6"><label>Đối Tượng</label><select onchange="DoiTuong()" class="form-control" name="dtHK' + i + '" id="dtHK' + i + '"><option value="Người Lớn">Người Lớn</option><option value="Trẻ Em">Trẻ Em</option></select></div></div>' +
                            '<div class="form-row">' +
                            '<div class="form-group col-md-6"><label>Ngày Sinh</label><input type="date" name="ngaysinhHK' + i + '" class="form-control" id="ngaysinhHK' + i + '"placeholder=""></div>' +
                            '<div class="form-group col-md-6"><label>Giới Tính</label><select class="form-control" name="GioiTinhHK' + i + '" id="GioiTinhHK' + i + '"><option value="Nam">Nam</option><option value="Nữ">Nữ</option><option value="Khác">Khác</option></select></div></div>' +
                            '<div class="form-row">' +
                            '<div class="form-group col-md-6"><label id="LBSdtHK' + i + '">Số điện thoại (*)</label><input type="number" name="SdtHK' + i + '" class="form-control" id="SdtHK' + i + '" placeholder="Nhập Số Điện Thoại"></div>' +
                            '<div class="form-group col-md-6"><label id="LBcmndHK' + i + '">Chứng minh nhân dân</label><input type="number" name="CmndHK' + i + '" class="form-control" id="CmndHK' + i + '"placeholder="Nhập CMND"></div></div>');
                    }
                    $('#btn_tab1-next').addEventListener("click", tab1Next());
                }

            }

        }

        function DoiTuong() {
            var x = parseInt(document.getElementById('adult').value) + parseInt(document.getElementById('child').value);
            for (var i = 1; i <= x; i++) {
                var dt = document.getElementById("dtHK" + i);
                if (dt.value == "Trẻ Em") {
                    document.getElementById("LBSdtHK" + i).style.visibility = "hidden";
                    document.getElementById("LBcmndHK" + i).style.visibility = "hidden";
                    document.getElementById("SdtHK" + i).style.visibility = "hidden";
                    document.getElementById("CmndHK" + i).style.visibility = "hidden";
                } else {
                    document.getElementById("LBSdtHK" + i).style.visibility = "visible";
                    document.getElementById("LBcmndHK" + i).style.visibility = "visible";
                    document.getElementById("SdtHK" + i).style.visibility = "visible";
                    document.getElementById("CmndHK" + i).style.visibility = "visible";
                }
            }
        }

        function alpha(e) {
            var k;
            document.all ? k = e.keyCode : k = e.which;
            return ((k > 64 && k < 91) || (k > 96 && k < 123) || k == 8 || k == 32 || (k >= 48 && k <= 57));

        }
    </script>

    <style>
        .nav-tabs .active {
            background: #2196F3 !important;
            color: #fff !important;
            /* font-weight: bold !important; */
        }

        .nav-tabs .nav-item {
            padding: 10px 10px !important;
            text-transform: uppercase;
            text-align: center !important;
        }

        .nav-tabs .inactive {
            cursor: not-allowed;
            background: #f5f5f5 !important;
            border: 1px solid #eee;
        }
    </style>

    <section class="container tour-book">
        <div class="row">
            <!-- LEFT CONTENT -->
            <div class="col-md-8 tour-content">
                <div class="nav nav-tabs row" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link active col-md-3" id="tab-1">1. Dịch Vụ</a>
                    <a class="nav-item nav-link inactive col-md-3" id="tab-2">2. Thông Tin Hành Khách</a>
                    <a class="nav-item nav-link inactive col-md-3" id="tab-3">3. Thanh Toán</a>
                    <a class="nav-item nav-link inactive col-md-3" id="tab-4">4. Xác Nhận</a>

                </div>
                <form id="form-dat-tour" method="post">
                    <div class="tab-content" id="nav-tabContent">

                        <div class="tab-pane fade show active" id="nav-tab-1" role="tabpanel" aria-labelledby="nav-home-tab">
                            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Lỗi</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Số Hành Khách Phải Lớn Hơn 0
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Lỗi</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Số Hành Khách Không Được Để Trống
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Đặt Tour Thành Công</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p style="text-align:center"><i style="color:green; font-size: 30px" class="fas fa-check-circle"></i>
                                                Đặt tour thành công! Vui lòng kiểm tra email và đợi xác nhận từ Cty Travello.
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <h4>Số Lượng Hành Khách</h4>
                            <div class="row">
                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Số Người Lớn</label>
                                        <input type="number" onkeypress="return alpha(event)" name="SoNguoiLon" class="form-control" id="adult" value="0" onchange="giaNguoiLon(),tongTien()" onclick="giaNguoiLon(),tongTien()" min="0" pattern="[0-9]{1,5}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="formGroupExampleInput2">Số Trẻ em</label>
                                        <input type="number" onkeypress="return alpha(event)" name="SoTreEm" class="form-control" id="child" value="0" onchange="giaTreEm(),tongTien()" onclick="giaTreEm(),tongTien()" min="0" pattern="[0-9]{1,5}" required>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-next" id="btn_tab1-next" name="btn_tab1-next" onclick="soHanhKhach()">Tiếp Theo</button>
                        </div>

                        <div class="tab-pane fade" id="nav-tab-2" role="tabpanel" aria-labelledby="nav-profile-tab">
                            <h4>Thông Tin Hành Khách</h4>
                            <div id="holder"></div>

                            <button type="button" class="btn btn-previous" id="btn_tab2-previous" onclick="tab2Pre()">Trở Về</button>
                            <button type="button" class="btn btn-next" id="btn_tab2-next" onclick="tab2Next()">Tiếp Theo</button>
                        </div>

                        <div class="tab-pane fade" id="nav-tab-3" role="tabpanel" aria-labelledby="nav-contact-tab">
                            <h4>Phương Thức Thanh Toán</h4>
                            <div class="form-group">
                                <select class="form-control" name="ThanhToan" id="exampleFormControlSelect1">
                                    <?php
                                    $q_ThanhToan = "SELECT * FROM thanhtoan";
                                    $kq_ThanhToan = mysqli_query($connection, $q_ThanhToan);
                                    while ($TT = @mysqli_fetch_array($kq_ThanhToan)) {
                                    ?>
                                        <option value="<?php echo $TT["MaTT"] ?>"><?php echo $TT["TenThanhToan"] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <button type="button" class="btn btn-previous" id="btn_tab3-previous" onclick="tab3Pre()">Trở Về</button>
                            <button type="button" class="btn btn-next" id="btn_tab3-next" onclick="tab3Next()">Tiếp Theo</button>
                        </div>
                        <div class="tab-pane fade" id="nav-tab-4" role="tabpanel" aria-labelledby="nav-contact-tab">
                            <p style="text-align:center"><i style="color:green; font-size: 30px" class="fas fa-check-circle"></i>
                                <p>
                                    <h3 style="text-align:center">XÁC NHẬN ĐẶT TOUR</h3>
                                    Vui lòng đọc kỹ điều khoản trước khi bấm nút xác nhận đặt tour!<br>
                                    Việc xác nhận đặt tour là sự thoả thuận đồng ý của quý khách khi sử dụng dịch vụ thanh toán trên trang web Travello của Công ty Dịch vụ Lữ hành Travello (Lữ hành Travello) và những trang web của bên thứ ba. Việc quý khách đánh dấu vào ô “Đồng ý” và nhấp chuột vào thanh “Chấp nhận” nghĩa là quý khách đồng ý tất cả các điều khoản thỏa thuận trong các trang web này.

                                </p>
                                <button type="button" class="btn btn-previous" id="btn_tab4-previous" onclick="tab4Pre()">Trở Về</button>
                                <button type="submit" class="btn btn-place" name="btn_DatTour" id="btn_tab4-next" data-toggle="modal" data-target="#myModal3">Xác Nhận<noscript></noscript></button>
                        </div>

                    </div>
                </form>
            </div>

            <!-- RIGHT CONTENT -->
            <div class="col-md-4 book-info">
                <button class="btn btn-info">Hỗ trợ giao dịch 0326805211</button>
                <div class="img-travello"><img src="img/travello-ds.jpg"></div>
                <div class="subtour-info">
                    <p><i class="fas fa-calendar-minus"></i> Ngày đi: <?php echo $rows["ThoiGian"]
                                                                        ?></p>
                    <p><i class="fas fa-calendar-plus"></i> Ngày về: </p>
                    <p><i class="fas fa-calendar-alt"></i> Thời gian: <?php echo $rows["SoNgay"]
                                                                        ?> ngày</p>
                    <p id="Adult" style="display:visible;"></p>
                    <p id="Child" style="display:visible;"></p>
                    <p id="Sum" style="display:visible;"></p>
                </div>
            </div>
        </div>
    </section>


    <script>
        function tab1Next() {
            $('#tab-1').removeClass('active');
            $('#tab-1').removeAttr('href data-toggle');
            $('#nav-tab-1').removeClass('show');
            $('#nav-tab-1').removeClass('active');
            $('#tab-1').addClass('inactive');
            $('#tab-2').removeClass('inactive');
            $('#tab-2').addClass('active');
            $('#tab-2').attr('href', '#nav-tab-2');
            $('#tab-2').attr('data-toggle', 'tab');
            $('#nav-tab-2').addClass('show');
            $('#nav-tab-2').addClass('active');
        };

        function tab2Pre() {
            $('#tab-2').removeClass("active");
            $('#tab-2').removeAttr('href data-toggle');
            $('#nav-tab-2').removeClass('show');
            $('#nav-tab-2').removeClass('active');
            $('#tab-2').addClass("inactive");
            $('#tab-1').removeClass('inactive');
            $('#tab-1').addClass('active');
            $('#tab-1').attr('href', '#nav-tab-1');
            $('#tab-1').attr('data-toggle', 'tab');
            $('#nav-tab-1').addClass('show');
            $('#nav-tab-1').addClass('active');
        };

        function tab2Next() {
            $('#tab-2').removeClass('active');
            $('#tab-2').removeAttr('href data-toggle');
            $('#nav-tab-2').removeClass('show');
            $('#nav-tab-2').removeClass('active');
            $('#tab-2').addClass('inactive');
            $('#tab-3').removeClass('inactive');
            $('#tab-3').addClass('active');
            $('#tab-3').attr('href', '#nav-tab-2');
            $('#tab-3').attr('data-toggle', 'tab');
            $('#nav-tab-3').addClass('show');
            $('#nav-tab-3').addClass('active');
        };

        function tab3Pre() {
            $('#tab-3').removeClass("active");
            $('#tab-3').removeAttr('href data-toggle');
            $('#nav-tab-3').removeClass('show');
            $('#nav-tab-3').removeClass('active');
            $('#tab-3').addClass("inactive");
            $('#tab-2').removeClass('inactive');
            $('#tab-2').addClass('active');
            $('#tab-2').attr('href', '#nav-tab-1');
            $('#tab-2').attr('data-toggle', 'tab');
            $('#nav-tab-2').addClass('show');
            $('#nav-tab-2').addClass('active');
        };

        function tab3Next() {
            $('#tab-3').removeClass('active');
            $('#tab-3').removeAttr('href data-toggle');
            $('#nav-tab-3').removeClass('show');
            $('#nav-tab-3').removeClass('active');
            $('#tab-3').addClass('inactive');
            $('#tab-4').removeClass('inactive');
            $('#tab-4').addClass('active');
            $('#tab-4').attr('href', '#nav-tab-2');
            $('#tab-4').attr('data-toggle', 'tab');
            $('#nav-tab-4').addClass('show');
            $('#nav-tab-4').addClass('active');
        };

        function tab4Pre() {
            $('#tab-4').removeClass("active");
            $('#tab-4').removeAttr('href data-toggle');
            $('#nav-tab-4').removeClass('show');
            $('#nav-tab-4').removeClass('active');
            $('#tab-4').addClass("inactive");
            $('#tab-3').removeClass('inactive');
            $('#tab-3').addClass('active');
            $('#tab-3').attr('href', '#nav-tab-1');
            $('#tab-3').attr('data-toggle', 'tab');
            $('#nav-tab-3').addClass('show');
            $('#nav-tab-3').addClass('active');
        };
    </script>


    <!-- <script>
$(document).ready(function() {
    $("#form-dat-tour").validate({
        rules: {
            TenHK1 : "required"
        },
        messages: {
            TenHK1 : "Vui lòng điền tên hành khách"
        }
    });
});
</script> -->


</body>
<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.min.js"></script>

<?php include('include/footer.php'); ?>