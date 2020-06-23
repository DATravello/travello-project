<?php
include('include/header.php');

if (isset($_GET['tour'])) {
    $email = $_SESSION['Email'];
    $matour = $_GET['tour'];
    include('database/db_config.php');

    $query = "SELECT * from tourdulich where MaTour='$matour'";
    $result = mysqli_query($connection, $query);
    $rows = @mysqli_fetch_array($result);

    $kh = "SELECT * FROM khachhang WHERE Email = '$email'";
    $rs_kh = mysqli_query($connection, $kh);
    $r_kh = mysqli_fetch_array($rs_kh);

    $maKhachHang = $r_kh["MaKH"];


    $giaNguoiLon = $rows["GiaTien"];
    $giaTreEm = $rows["GiaTreEm"];
}

if (isset($_POST['btn_DatTour'])) {
    $permitted_chars = '0123456789';
    $maHD =  substr(str_shuffle($permitted_chars), 0, 8);
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

    // if (!$soTreEm || !$soNguoiLon) {
    //     header("Location: dat-tour.php?tour=" . $matour);
    // } else {
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
            header("Location: index.php");
        } else {
            header("Location: dat-tour.php?tour=" . $matour);
        }
    } else {
        header("Location: dat-tour.php?tour=" . $matour);
    }
    // }
}

?>

<!-- CONTENT  -->
<script type="text/javascript">
    function giaTreEm() {
        var sum = document.getElementById("child").value * <?php echo $rows["GiaTreEm"] ?>;
        return $("p#Child").html('<p style="display:inline"><i class="fas fa-baby"></i> Giá Trẻ Em:</p> <p id="SumChild" style="color:red;display:inline;font-weight:bold;border:none;width:80px">' + sum.toLocaleString('vi', {
            style: 'currency',
            currency: 'VND'
        }) + '</p>');
    }

    function giaNguoiLon() {
        var sum = document.getElementById("adult").value * <?php echo $rows["GiaTien"] ?>;
        return $("p#Adult").html('<p style="display:inline"><i class="fas fa-male"></i> Giá Người Lớn:</p> <p id="SumAdult" style="color:red;display:inline;font-weight:bold;border:none;width:80px">' + sum.toLocaleString('vi', {
            style: 'currency',
            currency: 'VND'
        }) + '</p>');
    }

    function tongTien() {
        var sum = (document.getElementById("child").value * <?php echo $rows["GiaTreEm"] ?>) + (document.getElementById("adult").value * <?php echo $rows["GiaTien"] ?>);
        return $("p#Sum").html('<p style="display:inline"><i class="fas fa-dollar-sign"></i> Tổng:</p> <p id="TongTien" name="TongTien" style="color:red;font-weight: bold;display:inline-block">' + sum.toLocaleString('vi', {
            style: 'currency',
            currency: 'VND'
        }) + '</p>');
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

<section class="container tour-book content">
    <div class="row">
        <!-- LEFT CONTENT -->
        <div class="col-md-8 tour-content">
            <div class="nav nav-tabs row" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active col-md-3" id="tab-1">1. Dịch Vụ</a>
                <a class="nav-item nav-link inactive col-md-3" id="tab-2">2. Thông Tin Hành Khách</a>
                <a class="nav-item nav-link inactive col-md-3" id="tab-3">3. Thanh Toán</a>
                <a class="nav-item nav-link inactive col-md-3" id="tab-4">4. Xác Nhận</a>

            </div>
            <form method="post">
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



</body>


<?php include('include/footer.php'); ?>