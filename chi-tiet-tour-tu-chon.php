<?php
session_start();
include('database/db_config.php');
include('function.php');


if (isset($_GET['tour'])) {
    $matour = $_GET['tour'];
    require_once('database/db_config.php');

    //Query Tour
    $q_tour = "SELECT * FROM tourdulich WHERE MaTour='$matour'";
    $rs_tour = mysqli_query($connection, $q_tour);
    $rw_tour = mysqli_fetch_array($rs_tour);

    // Querry Điểm đến
    $mavt = $rw_tour['MaViTri'];
    $q_diemden = "SELECT * FROM vitri WHERE MaViTri='$mavt'";
    $rs_diemden = mysqli_query($connection, $q_diemden);
    $rw_dd = mysqli_fetch_array($rs_diemden);

    //Query Hướng Dẫn Viên
    $q_hdv = "SELECT * FROM huongdanvien";
    $rs_hdv = mysqli_query($connection, $q_hdv);

    //Query Loại Phòng
    $ks1 = "SELECT * FROM khachsan";
    $rs_ks1 = mysqli_query($connection, $ks1);
    $ks = mysqli_fetch_array($rs_ks1);
    $malp = $ks['MaLoaiPhong'];
    $q_lp = "SELECT * FROM loaiphong p WHERE p.MaLoaiPhong = '$malp'";
    $rs_lp = mysqli_query($connection, $q_lp);
    $rw_lp = mysqli_fetch_array($rs_lp);

    //Query Phương Tiện
    $q_pt = "SELECT * FROM phuongtien";
    $rs_pt = mysqli_query($connection, $q_pt);

    $q_soxe = "SELECT COUNT(*) AS total FROM phuongtien";
    $rs_soxe = mysqli_query($connection, $q_soxe);
    $soxe = mysqli_fetch_assoc($rs_soxe);

    //Query Nhà Hàng
    $q_nh = "SELECT * FROM nhahang WHERE MaViTri='$mavt'";
    $rs_nh = mysqli_query($connection, $q_nh);

    $q_sonh = "SELECT COUNT(*) AS total FROM nhahang";
    $rs_sonh = mysqli_query($connection, $q_sonh);
    $sonh = mysqli_fetch_assoc($rs_sonh);


    //Query Khách Hàng
    $email = $_SESSION['Email'];
    $kh = "SELECT * FROM khachhang WHERE Email = '$email'";
    $rs_kh = mysqli_query($connection, $kh);
    $r_kh = mysqli_fetch_array($rs_kh);
    $maKhachHang = $r_kh["MaKH"];

    //Query Thanh Toán
    $q_thanhtoan = "SELECT * FROM thanhtoan";
    $rs_thanhtoan = mysqli_query($connection, $q_thanhtoan);
}

//Đặt tour
if (isset($_POST['btn_DatTour'])) {
    $permitted_chars = '0123456789';
    $mahd = substr(str_shuffle($permitted_chars), 0, 8);

    $maks = $_POST["KhachSan"];
    $ngaynhan = $_POST["NgayNhan$maks"];
    $ngaytra = $_POST["NgayTra$maks"];
    $ngaydat = date("Y-m-d");
    $sophong = $_POST["SoPhongDat$maks"];
    $tongtienks = $_POST["TongTienKS$maks"];

    $sql_ks = "INSERT INTO hoadonks (`MaHD`, `MaKS`, `MaKH`, `SoPhongDat`, `NgayNhanPhong`, `NgayTraPhong`, `NgayDat`, `TongTien`)
    VALUES ('$mahd', '$maks', '$maKhachHang', '$sophong', '$ngaynhan', '$ngaytra', '$ngaydat', '$tongtienks')";
    $sql_ks_run = mysqli_query($connection, $sql_ks);
    if ($sql_ks_run) {
        $mapt = $_POST["PhuongTien"];
        $soluongxe = $_POST["SoLuongXe$mapt"];
        $songaydatxe = $_POST["SoNgayDatXe$mapt"];
        $tongtienpt = $_POST["TongTienXe$mapt"];

        $sql_pt = "INSERT INTO hoadonphuongtien (`MaHD`, `MaKH`, `MaPhuongTien`, `SoLuongXeDat`, `SoLuongNgayDat`, `NgayDat`, `TongTien`)
        VALUES ('$mahd', '$maKhachHang', '$mapt', '$soluongxe', '$songaydatxe', '$ngaydat', '$tongtienpt')";
        $sql_pt_run = mysqli_query($connection, $sql_pt);

        if ($sql_pt_run) {
            $manh = $_POST["NhaHang"];
            $songuoilon = $_POST["SoNguoiLon$manh"];
            $sotreem = $_POST["SoTreEm$manh"];
            $ngaydatban = $_POST["NgayDatBan$manh"];
            $tongtiennh = $_POST["TongTienNhaHang$manh"];

            $sql_nh = "INSERT INTO hoadonnh (`MaHD`, `MaKH`, `MaNH`, `SoNguoiLon`, `SoTreEm`, `NgayDatBan`, `NgayDat`, `TongTien`)
            VALUES ('$mahd', '$maKhachHang', '$manh', '$songuoilon', '$sotreem', '$ngaydatban', '$ngaydat', '$tongtiennh')";
            $sql_nh_run = mysqli_query($connection, $sql_nh);

            if ($sql_nh_run) {
                $chiphitour = $rw_tour["ChiPhiTour"];
                $mathanhtoan = $_POST["ThanhToan"];
                $tinhtrang = 'Chưa Xác Nhận';
                $TongTienTour = $tongtienks + $tongtiennh + $tongtienpt + $chiphitour;

                $sql_tour = "INSERT INTO hoadontourtutao (`MaHD`, `MaKH`, `MaTT`, `MaTour`, `NgayDat`, `TongTien`, `TinhTrang`)
                VALUES ('$mahd', '$maKhachHang', '$mathanhtoan', '$matour', '$ngaydat', '$TongTienTour', '$tinhtrang')";
                $sql_tour_run = mysqli_query($connection, $sql_tour);

                if ($sql_tour_run) {
                    $soTreEm = $_POST["SoTETour"];
                    $soNguoiLon = $_POST["SoNLTour"];
                    $sl = $soTreEm + $soNguoiLon;

                    for ($i = 1; $i <= $sl; $i++) {
                        $tenHK = $_POST["TenHK$i"];
                        $cmndHK = $_POST["CmndHK$i"];
                        $sdtHK = $_POST["SdtHK$i"];
                        $gioitinhHK = $_POST["GioiTinhHK$i"];
                        $ngaysinhHK = $_POST["ngaysinhHK$i"];

                        $q_thanhvientour = "INSERT INTO thanhvientour (`MaHD`, `TenTV`, `CMND`, `SDT`, `GioiTinh`, `NgaySinh`) 
                                    VALUES ('$mahd', '$tenHK', '$cmndHK', '$sdtHK', '$gioitinhHK', '$ngaysinhHK')";
                        $q_thanhvientour_run = mysqli_query($connection, $q_thanhvientour);
                    }
                    if ($q_thanhvientour_run) {
                        $message = "Đặt Tour Thành Công";
                        echo "<script type='text/javascript'>alert('$message');</script>";
                    } else {
                        $message = "Đặt Tour Thất Bại";
                        echo "<script type='text/javascript'>alert('$message');</script>";
                    }
                } else {
                    $message = "Đặt Tour Thất Bại";
                    echo "<script type='text/javascript'>alert('$message');</script>";
                }
            } else {
                $message = "Đặt Nhà Hàng Thất Bại";
                echo "<script type='text/javascript'>alert('$message');</script>";
            }
        } else {
            $message = "Đặt Phương Tiện Thất Bại";
            echo "<script type='text/javascript'>alert('$message');</script>";
        }
    } else {
        $message = "Đặt Phòng Thất Bại";
        echo "<script type='text/javascript'>alert('$message');</script>";
    }
}
?>

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
    <div class="modal fade" id="thankyouModal" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Thành Công!</h4>
                </div>
                <div class="modal-body">
                    <p>Đặt tour thành công!<br>
                        Vui lòng kiểm tra Email trong vòng 24h kể từ thời gian đặt tour. Chúng tôi sẽ liên lạc với bạn sớm nhất để xác nhận đặt tour.<br>
                        Cám ơn bạn đã sử dụng dịch vụ của chúng tôi!</p>
                </div>
            </div>
        </div>
    </div>

    <!-- NỘI DUNG -->

    <section class="container self-booking">
        <form method="post">
            <h5 class="title-booking"><?php echo $rw_tour["TenTour"]; ?></h5>
            <div class="self-location"><i class="fas fa-map-marker-alt"></i> <?php echo $rw_dd["TenViTri"] ?></div>
            <div class="row">
                <div class="col-3 nav-self">
                    <div class="list-group" id="list-tab" role="tablist">
                        <a class="list-group-item list-group-item-action active" id="list-lich-trinh-list" data-toggle="list" href="#list-lich-trinh" role="tab" aria-controls="lich-trinh">Lịch Trình Tour</a>
                        <a class="list-group-item list-group-item-action" id="list-home-list" data-toggle="list" href="#list-home" role="tab" aria-controls="home">Khách Sạn</a>
                        <a class="list-group-item list-group-item-action" id="list-profile-list" data-toggle="list" href="#list-profile" role="tab" aria-controls="profile">Hướng Dẫn Viên</a>
                        <a class="list-group-item list-group-item-action" id="list-messages-list" data-toggle="list" href="#list-messages" role="tab" aria-controls="messages">Vận Chuyển</a>
                        <a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="list" href="#list-settings" role="tab" aria-controls="settings">Nhà Hàng</a>
                        <a class="list-group-item list-group-item-action" id="list-thanh-vien-list" data-toggle="list" href="#list-thanh-vien" role="tab" aria-controls="home">Thông Tin Thành Viên</a>
                        <a class="list-group-item list-group-item-action" id="list-thanh-toan-list" data-toggle="list" href="#list-thanh-toan" role="tab" aria-controls="home">Hình Thức Thanh Toán</a>
                        <div class="list-group-item self-sum" style="background:#ffcd3c;color:#fff"><i class="fas fa-dollar-sign"></i> Tổng: <p id="tongTienTour" style="color:red;display:inline;font-weight:bold"><?php echo product_price($rw_tour["ChiPhiTour"]); ?></p>
                            <button type="submit" class="btn btn-primary" name="btn_DatTour">Đặt</button>
                        </div>
                        <script>
                            function tongTien() {
                                var tienKS = parseInt($("#tongtienks").val());
                                var tienXe = parseInt($('#tongtienxe').val());
                                var tienNH = parseInt($('#tongtiennh').val());
                                var tongTienTour = <?php echo $rw_tour["ChiPhiTour"] ?> + tienKS + tienXe;
                                $("#tongTienTour").text(tongTienTour.toLocaleString('it-IT', {
                                    style: 'currency',
                                    currency: 'VND'
                                }));
                            }
                        </script>
                    </div>
                </div>
                <div class="col-9 content-self">
                    <div class="tab-content" id="nav-tabContent">
                        <!-- LỊCH TRÌNH TOUR -->
                        <div class="tab-pane fade show active" id="list-lich-trinh" role="tabpanel" aria-labelledby="list-lich-trinh-list">
                            <div class="self-tour-img"><img src="admin/img/tour-du-lich/<?php echo $rw_tour['Anh'] ?>" alt="" width="100%"></div>
                            <div class="self-tour-des">
                                <div id="accordion">
                                    <div class="card">
                                        <div class="card-header" id="headingOne">
                                            <h5 class="mb-0">
                                                <a style="width:100%" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                    <h3>Lịch Trình Tour (Dự Kiến)</h3>
                                                </a>
                                            </h5>
                                        </div>

                                        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                            <div class="card-body">
                                                <p><?php echo $rw_tour["HanhTrinh"] ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- CHỌN KHÁCH SẠN -->
                        <div class="tab-pane fade" id="list-home" role="tabpanel" aria-labelledby="list-home-list">

                            <select class="form-control form-control-lg" onchange="Chonks()" name="KhachSan" id="ChonKhachSan" style="margin-bottom:20px;">
                                <option value="" selected disabled hidden>Chọn Khách Sạn</option>
                                <?php
                                $query_khachsan = "SELECT * FROM khachsan WHERE MaViTri = $mavt";
                                $result_khachsan = mysqli_query($connection, $query_khachsan);

                                while ($row = @mysqli_fetch_array($result_khachsan)) {
                                ?>
                                    <option value="<?php echo $row["MaKS"] ?>"><?php echo $row["TenKS"] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                            <script>
                                function Chonks() {
                                    $('.card-hotel').hide();
                                    x = document.getElementById("ChonKhachSan").value;
                                    $('#hotel' + x).show();
                                }
                            </script>
                            <style>
                                #chi-tiet .modal-body {
                                    font-size: 16px !important;
                                }

                                #chi-tiet .modal-header .modal-title {
                                    font-size: 20px !important;
                                }

                                #chi-tiet .modal-body .nav a {
                                    font-size: 16px !important;
                                }
                            </style>
                            <?php
                            $q_slks = "SELECT COUNT(*) AS total FROM khachsan WHERE MaViTri = $mavt";
                            $rs_slks = mysqli_query($connection, $q_slks);
                            $soks = mysqli_fetch_assoc($rs_slks);
                            ?>
                            <script>
                                function tienphongks() {
                                    var totalks = <?php echo $soks["total"] ?>;
                                    for (var i = 0; i < totalks; i++) {
                                        var soluong = $('#sophong' + i).val();
                                        var giaphong = $('#GiaPhong' + i).val();
                                        if (soluong == 0) {
                                            var tongtienphong = 0;
                                        } else {
                                            var tongtienphong = parseInt(soluong) * parseInt(giaphong);
                                        }

                                        $("#tongtienphong" + i).text(tongtienphong.toLocaleString('it-IT', {
                                            style: 'currency',
                                            currency: 'VND'
                                        }));
                                        $('#tongtienks' + i).val(tongtienphong);
                                    }
                                }
                            </script>


                            <?php
                            //Query khách sạn Theo Vị Trí
                            $mavt = $rw_tour['MaViTri'];
                            $q_ks = "SELECT * FROM khachsan WHERE MaViTri = $mavt";
                            $rs_ks = mysqli_query($connection, $q_ks);

                            $i = 0;
                            while ($rw_khachsan = @mysqli_fetch_array($rs_ks)) {
                            ?>



                                <div class="card card-hotel" id="hotel<?php echo $rw_khachsan['MaKS']; ?>" style="display:none">
                                    <div class="card-body">
                                        <h3><?php echo $rw_khachsan['TenKS']; ?></h3>

                                        <div class="row" style="border-bottom: 2px solid #f1f1f1;margin: 20px 0">
                                            <div class="col-md-6">
                                                <p style="font-size:17px">Số phòng trống: <span style="color:red;font-weight:bold"><?php echo $rw_khachsan["SoPhong"]; ?></span> phòng</p>
                                                <p style="font-size:17px">Giá chỉ từ: <span style="color:red;font-weight:bold"><?php echo product_price($rw_khachsan['Gia']) ?>
                                                        <input id="GiaPhong<?php echo $i ?>" name="GiaPhong<?php echo $rw_khachsan['MaKS']; ?>" value="<?php echo $rw_khachsan['Gia']; ?>" style="visibility:hidden"></p>
                                                </p>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-row">
                                                    <div class="form-group col-md-6"><label id="LBSdtHK1">Ngày Nhận Phòng</label><input type="date" name="NgayNhan<?php echo $rw_khachsan['MaKS']; ?>" class="form-control" id="NgayNhan<?php echo $rw_khachsan['MaKS']; ?>"></div>
                                                    <div class="form-group col-md-6"><label id="LBcmndHK1">Ngày Trả Phòng</label><input type="date" name="NgayTra<?php echo $rw_khachsan['MaKS']; ?>" class="form-control" id="NgayTra<?php echo $rw_khachsan['MaKS']; ?>"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <h5 style="margin: 20px 0;">Loại Phòng: <p class="room-name"><?php echo $rw_lp["TenLoaiPhong"]; ?></p>
                                        </h5>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <img src="admin/img/loai-phong/<?php echo $rw_khachsan["AnhLoaiPhong"]; ?>" alt="" style="width:100%;border-radius:5px">
                                            </div>
                                            <div class="col-md-3">
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#chi-tiet">
                                                    Xem Chi Tiết
                                                </button>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="" id="lable">Số Lượng</label>
                                                    <input type="number" class="form-control" onclick="tienphongks()" name="SoPhongDat<?php echo $rw_khachsan['MaKS']; ?>" id="sophong<?php echo $i; ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <p>Thành Tiền</p>
                                                <p style="color:red;font-weight:bold" id="tongtienphong<?php echo $i; ?>"></p>
                                                <input type="number" id="tongtienks<?php echo $i; ?>" name="TongTienKS<?php echo $rw_khachsan['MaKS']; ?>" style="visibility:hidden;height:0;width:0">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade bd-example-modal-lg" id="chi-tiet" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Thông Tin Chi Tiết</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="tab-hotel">
                                                    <ul class="nav nav-tabs" id="myTab" role="tablist" style="margin-bottom: 50px;border:none">
                                                        <li class="nav-item">
                                                            <a class="nav-button active" id="mota-tab" data-toggle="tab" href="#mota" role="tab" aria-controls="home" aria-selected="true">Giới Thiệu Khách Sạn</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-button" id="mota-phong-tab" data-toggle="tab" href="#mota-phong" role="tab" aria-controls="profile" aria-selected="false">Thông Tin Loại Phòng</a>
                                                        </li>
                                                    </ul>
                                                    <div class="tab-content" id="myTabContent">
                                                        <div class="tab-pane fade show active" id="mota" role="tabpanel" aria-labelledby="home-tab">
                                                            <div class="self-hotel-img"><img src="admin/img/khach-san/<?php echo $rw_khachsan["Anh"]; ?>" width="100%"></div>
                                                            <div class="self-hotel-des">
                                                                <p><i class="fas fa-map-marker-alt"></i> Địa chỉ: <?php echo $rw_khachsan["DiaChi"]; ?></p>
                                                                <p><i class="fas fa-mobile"></i> SĐT: <?php echo $rw_khachsan["DienThoai"]; ?></p>
                                                                <p><i class="fas fa-globe-americas"></i> Website: <?php echo $rw_khachsan["WebSite"]; ?></p>
                                                                <p><?php echo $rw_khachsan["MoTa"]; ?></p>
                                                            </div>
                                                        </div>
                                                        <div class="tab-pane fade" id="mota-phong" role="tabpanel" aria-labelledby="profile-tab">
                                                            <img src="admin/img/loai-phong/<?php echo $rw_khachsan["AnhLoaiPhong"]; ?>" alt="" style="width:100%;border-radius:5px">
                                                            <?php echo $rw_khachsan["MoTaLoaiPhong"]; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php
                                $i++;
                            }
                            ?>
                        </div>

                        <!-- CHỌN HƯỚNG DẪN VIÊN -->
                        <div class="tab-pane fade" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">
                            <section class="tour-guide">
                                <h5>ĐỘI NGŨ HƯỚNG DẪN VIÊN</h5>
                                <div class="row">
                                    <?php
                                    while ($rw_hdv = @mysqli_fetch_array($rs_hdv)) {
                                    ?>
                                        <div class="col-lg-3 col-md-6">
                                            <div class="card">
                                                <div class="card-body">
                                                    <img src="admin/img/huong-dan-vien/<?php echo $rw_hdv["Anh"] ?>" alt="" class="img-guide rounded-circle w-50 mb-3">
                                                    <h5 class="name-guide"><?php echo $rw_hdv["TenHDV"] ?></h5>
                                                    <p class="guide">(Hướng Dẫn Viên)</p>
                                                    <p class="date-guide">Ngày Sinh: <?php echo $rw_hdv["NgaySinh"] ?></p>
                                                    <p class="sex-guide">Giới Tính: <?php echo $rw_hdv["GioiTinh"] ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </section>
                        </div>

                        <!-- CHỌN PHƯƠNG TIỆN -->
                        <div class="tab-pane fade" id="list-messages" role="tabpanel" aria-labelledby="list-messages-list">

                            <section class="tour-vehicle">
                                <!-- Card vehicle -->

                                <select class="form-control form-control-lg" onchange="Chonxe()" name="PhuongTien" id="ChonPhuongTien" style="margin-bottom:20px;">
                                    <option value="" selected disabled hidden>Chọn Loại Xe</option>
                                    <?php

                                    $q_pt1 = "SELECT * FROM phuongtien";
                                    $rs_pt1 = mysqli_query($connection, $q_pt1);
                                    while ($row_pt = @mysqli_fetch_array($rs_pt1)) {
                                    ?>
                                        <option value="<?php echo $row_pt["MaPhuongTien"] ?>"><?php echo $row_pt["PhuongTien"] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                                <script>
                                    function Chonxe() {
                                        $('.card-car').hide();
                                        x = document.getElementById("ChonPhuongTien").value;
                                        $('#car' + x).show();
                                    }
                                </script>
                                <?php
                                $i = 0;
                                while ($rw_pt = mysqli_fetch_array($rs_pt)) {
                                ?>
                                    <script>
                                        function tienxetheosoluong() {
                                            var soxe = <?php echo $soxe['total'] ?>;
                                            var sumXe = 0;
                                            var sum = 0;

                                            for (var i = 0; i < soxe; i++) {
                                                var a = $('#soluongxe' + i).val();
                                                var b = $('#songay' + i).val();
                                                var dongia = $('#dongia' + i).text();

                                                if (a == 0 && b != 0) {
                                                    sum = parseInt(b) * parseInt(dongia);
                                                } else if (a != 0 && b == 0) {
                                                    sum = parseInt(a) * parseInt(dongia);
                                                } else if (a == 0 && b == 0) {
                                                    sum = 0;
                                                } else {
                                                    sum = parseInt(a) * parseInt(b) * parseInt(dongia);
                                                }
                                                $('#tongtienXe' + i).text(sum.toLocaleString('it-IT', {
                                                    style: 'currency',
                                                    currency: 'VND'
                                                }));

                                                $('#TongTienXe' + i).val(sum);
                                                if (a === '0') {
                                                    document.getElementById("ChonPhuongTien").disabled = true;
                                                } else {
                                                    document.getElementById("ChonPhuongTien").disabled = false;
                                                }
                                            }
                                        }
                                    </script>

                                    <div class="card card-car" id="car<?php echo $rw_pt["MaPhuongTien"] ?>" style="display:none;">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-2" style="padding-right:0;">
                                                    <img src="admin/img/phuong-tien/<?php echo $rw_pt["HinhAnh"] ?>" class="img-vehicle" alt="">
                                                </div>
                                                <div class="col-md-2" style="padding-right:0;">
                                                    <h5 class="name-vehicle"><?php echo $rw_pt["PhuongTien"] ?></h5>
                                                </div>
                                                <div class="col-md-2" style="padding-right:0;">
                                                    <div class="form-group">
                                                        <label for="label">Số Lượng Xe</label>
                                                        <input type="number" class="form-control" onclick="tienxetheosoluong(),tongTien()" name="SoLuongXe<?php echo $rw_pt["MaPhuongTien"] ?>" id="soluongxe<?php echo $i ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-2" style="padding-right:0;">
                                                    <div class="form-group">
                                                        <label for="label">Số Ngày</label>
                                                        <input type="number" class="form-control" onclick="tienxetheosoluong(),tongTien()" name="SoNgayDatXe<?php echo $rw_pt["MaPhuongTien"] ?>" id="songay<?php echo $i ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-2" style="padding-right:0;">
                                                    Đơn giá: <p style="color:red;font-weight:bold;width:100%;border:none;background:#fff;"><?php echo product_price($rw_pt["Gia"]) ?>/Ngày</p>
                                                    <p id="dongia<?php echo $i ?>" style="visibility:hidden;height:0;margin:0"><?php echo $rw_pt["Gia"] ?></p>
                                                    <input type="hidden" value="<?php echo $rw_pt["Gia"] ?>" id="giaxe<?php echo $rw_pt["MaPhuongTien"] ?>" name="giaxe<?php echo $rw_pt["MaPhuongTien"] ?>">
                                                </div>
                                                <div class="col-md-2" style="padding-right:0;">
                                                    Thành tiền: <p style="color:red;font-weight:bold;width:100%;border:none;background:#fff;" id="tongtienXe<?php echo $i ?>">0 đ</p>
                                                    <input type="number" id="TongTienXe<?php echo $i ?>" name="TongTienXe<?php echo $rw_pt["MaPhuongTien"] ?>" style="visibility:hidden;width:0;height:0">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                    $i++;
                                } ?>
                            </section>
                        </div>
                        <!-- CHỌN NHÀ HÀNG -->
                        <div class="tab-pane fade" id="list-settings" role="tabpanel" aria-labelledby="list-settings-list">
                            <!-- Card Nhà Hàng -->
                            <section class="tour-restaurant">
                                <select class="form-control form-control-lg" onchange="Chonnh()" name="NhaHang" id="ChonNhaHang" style="margin-bottom:20px;">
                                    <option value="" selected disabled hidden>Chọn Nhà Hàng</option>
                                    <?php
                                    $query_nhahang = "SELECT * FROM nhahang WHERE MaViTri = $mavt";
                                    $result_nhahang = mysqli_query($connection, $query_nhahang);
                                    while ($row = @mysqli_fetch_array($result_nhahang)) {
                                    ?>
                                        <option value="<?php echo $row["MaNH"] ?>"><?php echo $row["TenNhaHang"] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                                <script>
                                    function Chonnh() {
                                        $('.card').hide();
                                        x = document.getElementById("ChonNhaHang").value;
                                        $('#' + x).show();
                                    }
                                </script>
                                <?php
                                $i = 0;
                                while ($rw_nh = mysqli_fetch_array($rs_nh)) {
                                ?>

                                    <script>
                                        function TienNhaHang() {
                                            var soNH = <?php echo $sonh['total']; ?>;
                                            var sumNH = 0;
                                            for (var i = 0; i < soNH; i++) {
                                                var soNL = $("#songuoilon" + i).val();
                                                var soTE = $("#sotreem" + i).val();
                                                var giaNL = $('#gianguoilon' + i).text();
                                                var giaTE = $('#giatreem' + i).text();
                                                sumNH = (parseInt(soNL) * parseInt(giaNL)) + (parseInt(soTE) * parseInt(giaTE));
                                                $("#sumtiennhahang" + i).text(sumNH.toLocaleString('it-IT', {
                                                    style: 'currency',
                                                    currency: 'VND'
                                                }));
                                                $("#TongTienNhaHang" + i).val(sumNH);
                                            }
                                        }
                                    </script>
                                    <div class="card" id="<?php echo $rw_nh["MaNH"] ?>" style="display:none;">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <h4 class="name-vehicle"><?php echo $rw_nh['TenNhaHang']; ?></h4>
                                                    <!-- Button trigger modal -->
                                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#thuc-don-<?php echo $rw_nh["MaNH"] ?>">
                                                        Xem Thực Đơn
                                                    </button>
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="thuc-don-<?php echo $rw_nh["MaNH"] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Thực Đơn Nhà Hàng</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p><?php echo $rw_nh['MoTaThucDon']; ?></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Ngày Đặt Bàn</label>
                                                    <input type="date" class="form-control" id="NgayDatBan<?php echo $i ?>" name="NgayDatBan<?php echo $rw_nh["MaNH"] ?>">
                                                </div>
                                            </div>
                                            <div class="hr" style="margin: 20px 0"></div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <img src="admin/img/nha-hang/<?php echo $rw_nh['Anh']; ?>" class="img-restaurant" alt="">

                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="label">Số Lượng Người Lớn</label>
                                                        <input type="number" onclick="TienNhaHang(),tongTien()" value="0" class="form-control" name="SoNguoiLon<?php echo $rw_nh["MaNH"] ?>" id="songuoilon<?php echo $i ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="label">Số Lượng Trẻ Em</label>
                                                        <input type="number" onclick="TienNhaHang(),tongTien()" value="0" class="form-control" name="SoTreEm<?php echo $rw_nh["MaNH"] ?>" id="sotreem<?php echo $i ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    Đơn giá:
                                                    <p style="color:red;font-weight:bold;font-size:13px"><?php echo product_price($rw_nh['GiaNguoiLon']); ?>/Người Lớn</p>
                                                    <p id="gianguoilon<?php echo $i ?>" style="visibility:hidden;height:0;margin:0"><?php echo $rw_nh["GiaNguoiLon"] ?></p>
                                                    <p style="color:red;font-weight:bold;font-size:13px"><?php echo product_price($rw_nh['GiaTreEm']); ?>/Trẻ Em</p>
                                                    <p id="giatreem<?php echo $i ?>" style="visibility:hidden;height:0;margin:0"><?php echo $rw_nh["GiaTreEm"] ?></p>
                                                </div>
                                                <div class="col-md-3">
                                                    Tổng tiền:
                                                    <p id="sumtiennhahang<?php echo $i ?>" style="color:red;font-weight:bold;font-size:13px"></p>
                                                    <input type="hidden" id="TongTienNhaHang<?php echo $i ?>" name="TongTienNhaHang<?php echo $rw_nh["MaNH"] ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                    $i++;
                                } ?>
                            </section>
                        </div>
                        <div class="tab-pane fade" id="list-thanh-vien" role="tabpanel" aria-labelledby="list-thanh-vien-list">
                            <div class="modal fade" id="ErrorMember" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle" style="font-size:17px">Lỗi</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <b style="font-size: 15px;">Số Người Lớn Không Hợp Lệ!</b>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <script>
                                function NhapSLThanhVien() {
                                    var nl = $("#SNL").val();
                                    var te = $("#STE").val();
                                    if (parseInt(nl) == 0) {
                                        $('#ErrorMember').modal('show');
                                    } else {
                                        var x = parseInt(nl) + parseInt(te);
                                        for (var i = 1; i <= x; i++) {
                                            $("#holder").append('<h5>Thông tin hành khách #' + i + '</h5>' + '<div class="form-row">' +
                                                '<div class="form-group col-md-6"><label>Tên (*)</label><input type="text" name="TenHK' + i + '" class="form-control" id="TenHK' + i + '" placeholder="Nhập Tên Hành Khách"></div>' +
                                                '<div class="form-group col-md-6"><label>Đối Tượng</label><select onchange="DoiTuong()" class="form-control" name="dtHK' + i + '" id="dtHK' + i + '"><option value="1">Người Lớn</option><option value="2">Trẻ Em</option></select></div></div>' +
                                                '<div class="form-row">' +
                                                '<div class="form-group col-md-6"><label>Ngày Sinh</label><input type="date" name="ngaysinhHK' + i + '" class="form-control" id="ngaysinhHK' + i + '"placeholder=""></div>' +
                                                '<div class="form-group col-md-6"><label>Giới Tính</label><select class="form-control" name="GioiTinhHK' + i + '" id="GioiTinhHK' + i + '"><option value="Nam">Nam</option><option value="Nữ">Nữ</option><option value="Khác">Khác</option></select></div></div>' +
                                                '<div class="form-row">' +
                                                '<div class="form-group col-md-6"><label id="LabelSdtHK' + i + '">Số điện thoại (*)</label><input type="number" name="SdtHK' + i + '" class="form-control" id="SdtHK' + i + '" placeholder="Nhập Số Điện Thoại"></div>' +
                                                '<div class="form-group col-md-6"><label id="LabelcmndHK' + i + '">Chứng minh nhân dân</label><input type="number" name="CmndHK' + i + '" class="form-control" id="CmndHK' + i + '"placeholder="Nhập CMND"></div></div>');
                                        }
                                        $("#btnThanhVien").attr("disabled", true);
                                    }
                                }

                                function ResetThanhVien() {
                                    $("#btnThanhVien").removeAttr("disabled");
                                    $("#SNL").val(0);
                                    $("#STE").val(0);
                                    $("#holder").empty().append(html);
                                }

                                function DoiTuong() {
                                    var nl = $("#SNL").val();
                                    var te = $("#STE").val();
                                    x = parseInt(document.getElementById('SNL').value) + parseInt(document.getElementById('STE').value);
                                    for (var i = 1; i <= x; i++) {
                                        var dt = document.getElementById("dtHK" + i);
                                        if (dt.value == "2") {
                                            document.getElementById("LabelSdtHK" + i).style.visibility = "hidden";
                                            document.getElementById("LabelcmndHK" + i).style.visibility = "hidden";
                                            document.getElementById("SdtHK" + i).style.visibility = "hidden";
                                            document.getElementById("CmndHK" + i).style.visibility = "hidden";
                                        } else {
                                            document.getElementById("LabelSdtHK" + i).style.visibility = "visible";
                                            document.getElementById("LabelcmndHK" + i).style.visibility = "visible";
                                            document.getElementById("SdtHK" + i).style.visibility = "visible";
                                            document.getElementById("CmndHK" + i).style.visibility = "visible";
                                        }
                                    }
                                }
                            </script>
                            <section class="tour-member">
                                <div class="form-row">
                                    <div class="col">
                                        <label>Số Người Lớn</label>
                                        <input type="number" name="SoNLTour" id="SNL" class="form-control" placeholder="Nhập Số Người Lớn" value="0">
                                    </div>
                                    <div class="col">
                                        <label>Số Trẻ Em</label>
                                        <input type="number" name="SoTETour" id="STE" id="SoTE" class="form-control" placeholder="Nhập Số Trẻ Em" value="0">
                                    </div>
                                </div>
                                <button type="button" onclick="NhapSLThanhVien()" class="btn btn-primary" id="btnThanhVien" style="margin:20px 0">Tiếp Theo</button>
                                <button type="button" onclick="ResetThanhVien()" class="btn btn-primary" id="btnResetTV" style="margin:20px 0">Chọn Lại</button>
                                <div id="holder"></div>
                            </section>

                        </div>

                        <div class="tab-pane fade" id="list-thanh-toan" role="tabpanel" aria-labelledby="list-thanh-toan-list">
                            <section class="tour-payment">
                                <select class="form-control form-control-lg" onchange="Chontt()" name="ThanhToan" id="ChonHinhThuc" style="margin-bottom:20px;">
                                    <option value="" selected disabled hidden>Chọn Hình Thức Thanh Toán</option>
                                    <?php
                                    $query_thanhtoan = "SELECT * FROM thanhtoan";
                                    $result_thanhtoan = mysqli_query($connection, $query_thanhtoan);
                                    while ($row = @mysqli_fetch_array($result_thanhtoan)) {
                                    ?>
                                        <option value="<?php echo $row["MaTT"] ?>"><?php echo $row["TenThanhToan"] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                                <script>
                                    function Chontt() {
                                        $('.card').hide();
                                        x = document.getElementById("ChonHinhThuc").value;
                                        $('#TT' + x).show();
                                    }
                                </script>
                                <?php
                                $i = 0;
                                while ($rw_thanhtoan = mysqli_fetch_array($rs_thanhtoan)) {
                                ?>
                                    <div class="card" id="TT<?php echo $rw_thanhtoan["MaTT"] ?>" style="display:none">
                                        <div class="card-body">
                                            <p>Hình Thức: <b><?php echo $rw_thanhtoan["TenThanhToan"] ?></b></p>
                                            <div class="hr" style="margin:20px 0"></div>
                                            <p><?php echo $rw_thanhtoan["NoiDung"] ?></p>
                                        </div>
                                    </div>
                                <?php
                                    $i++;
                                }
                                ?>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>

    <!-- END -->


    <?php
    include('include/footer.php');
    ?>