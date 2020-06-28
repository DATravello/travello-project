<?php
include('include/header.php');


if (isset($_GET['tour'])) {
    $maks = $_GET['tour'];
    require_once('database/db_config.php');

    // Querry Khách sạn
    $query = "SELECT * FROM khachsan WHERE MaKS='$maks'";
    $result = mysqli_query($connection, $query);
    $rw_ks = mysqli_fetch_array($result);



    // // Querry Điểm đến
    // $q_diemden = "SELECT * FROM diemden WHERE MaDD='$madiemdien'";
    // $rs_diemden = mysqli_query($connection, $q_diemden);
    // $rw_dd = mysqli_fetch_array($rs_diemden);

    //Query Hướng Dẫn Viên
    $q_hdv = "SELECT * FROM huongdanvien";
    $rs_hdv = mysqli_query($connection, $q_hdv);
    //$rw_hdv = mysqli_fetch_array($rs_hdv);

    //Query Loại Phòng
    $malp = $rw_ks['MaLoaiPhong'];
    $q_lp = "SELECT * FROM loaiphong p WHERE p.MaLoaiPhong = '$malp'";
    $rs_lp = mysqli_query($connection, $q_lp);
    $rw_lp = mysqli_fetch_array($rs_lp);

    //Query Phương Tiện
    $q_pt = "SELECT * FROM phuongtien";
    $rs_pt = mysqli_query($connection, $q_pt);

    $q_soxe = "SELECT COUNT(*) AS total FROM phuongtien";
    $rs_soxe = mysqli_query($connection, $q_soxe);
    $soxe = mysqli_fetch_assoc($rs_soxe);
}
?>

<!-- NỘI DUNG -->

<section class="container self-booking">

    <h5 class="title-booking"><?php echo $rw_ks["TenKS"]; ?></h5>
    <div class="self-star">
        <?php
        $s = $rw_ks["HangSao"];
        for ($i = 1; $i <= $s; $i++) {
            echo '<i class="fas fa-star"></i>';
        }
        ?>
    </div>
    <div class="self-location"><i class="fas fa-map-marker-alt"></i> Sài Gòn<?php //echo $rw_ks["MaDD"] 
                                                                            ?></div>
    <div class="row">
        <div class="col-3 nav-self">
            <div class="list-group" id="list-tab" role="tablist">
                <a class="list-group-item list-group-item-action active" id="list-lich-trinh-list" data-toggle="list" href="#list-lich-trinh" role="tab" aria-controls="lich-trinh">Lịch Trình Tour</a>
                <a class="list-group-item list-group-item-action" id="list-home-list" data-toggle="list" href="#list-home" role="tab" aria-controls="home">Khách Sạn</a>
                <a class="list-group-item list-group-item-action" id="list-profile-list" data-toggle="list" href="#list-profile" role="tab" aria-controls="profile">Hướng Dẫn Viên</a>
                <a class="list-group-item list-group-item-action" id="list-messages-list" data-toggle="list" href="#list-messages" role="tab" aria-controls="messages">Vận Chuyển</a>
                <a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="list" href="#list-settings" role="tab" aria-controls="settings">Nhà Hàng</a>
                <div class="list-group-item self-sum"><i class="fas fa-dollar-sign"></i> Tổng: </div>
            </div>
        </div>

        <script>
            function tienphong() {
                var a = $('#sophong').val();
                var sumlp = parseInt(a) * <?php echo $rw_ks['Gia'] ?>;
                $('#tongtienphong').text(sumlp.toLocaleString('it-IT', {
                    style: 'currency',
                    currency: 'VND'
                }));
            }
        </script>
        <div class="col-9 content-self">
            <div class="tab-content" id="nav-tabContent">
                <!-- LỊCH TRÌNH TOUR -->
                <div class="tab-pane fade show active" id="list-lich-trinh" role="tabpanel" aria-labelledby="list-lich-trinh-list">

                </div>
                <!-- CHỌN KHÁCH SẠN -->
                <div class="tab-pane fade" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
                    <div class="self-hotel-img"><img src="admin/img/khach-san/<?php echo $rw_ks["Anh"]; ?>" width="100%"></div>
                    <div class="self-hotel-des">
                        <p><i class="fas fa-map-marker-alt"></i> Địa chỉ: <?php echo $rw_ks["DiaChi"]; ?></p>
                        <p><i class="fas fa-mobile"></i> SĐT: <?php echo $rw_ks["DienThoai"]; ?></p>
                        <p><i class="fas fa-globe-americas"></i> Website: <?php echo $rw_ks["WebSite"]; ?></p>
                        <p><?php echo $rw_ks["MoTa"]; ?></p>
                    </div>
                    <div class="hr"></div>
                    <div class="book">
                        <div class="row" style="border-bottom: 2px solid #f1f1f1;margin: 20px 0">
                            <div class="col-md-6">
                                <p style="font-size:17px">Số phòng trống: <span style="color:red;font-weight:bold"><?php echo $rw_ks["SoPhong"]; ?></span> phòng</p>
                                <p style="font-size:17px">Giá chỉ từ: <span style="color:red;font-weight:bold"><?php echo product_price($rw_ks['Gia']) ?></p>
                                </p>
                            </div>
                            <div class="col-md-6">
                                <div class="form-row">
                                    <div class="form-group col-md-6"><label id="LBSdtHK1">Ngày Nhận Phòng</label><input type="date" name="" class="form-control" id=""></div>
                                    <div class="form-group col-md-6"><label id="LBcmndHK1">Ngày Trả Phòng</label><input type="date" name="" class="form-control" id=""></div>
                                </div>
                            </div>
                        </div>

                        <h5 style="margin: 20px 0;">Loại Phòng: <p class="room-name"><?php echo $rw_lp["TenLoaiPhong"]; ?></p>
                        </h5>
                        <div class="row">
                            <div class="col-md-3">
                                <img src="admin/img/loai-phong/<?php echo $rw_ks["AnhLoaiPhong"]; ?>" alt="" style="width:100%;border-radius:5px">

                            </div>
                            <div class="col-md-5">
                                <?php echo $rw_ks["MoTaLoaiPhong"]; ?>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="" id="lable">Số Lượng</label>
                                    <input type="number" class="form-control" onclick="tienphong()" name="" id="sophong" value="1">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <p>Thành Tiền</p>
                                <p style="color:red;font-weight:bold" id="tongtienphong"><?php echo product_price($rw_ks['Gia']) ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="hr"></div>
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
                        <?php
                        $i = 0;
                        while ($rw_pt = mysqli_fetch_array($rs_pt)) {
                        ?>
                            <script>
                                function tienxetheosoluong() {
                                    var soxe = <?php echo $soxe['total'] ?>;
                                    for (var i = 0; i < soxe; i++) {
                                        var a = $('#soluongxe' + i).val();
                                        var b = $('#songay' + i).val();
                                        var dongia = $('#dongia' + i).text();
                                        var sum = parseInt(a) * parseInt(b) * parseInt(dongia);
                                        $('#tongtienxe' + i).text(sum.toLocaleString('it-IT', {
                                            style: 'currency',
                                            currency: 'VND'
                                        }));
                                    }

                                }
                            </script>
                            <div class="card">
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
                                                <input type="number" class="form-control" onclick="tienxetheosoluong()" name="soluongxe" id="soluongxe<?php echo $i ?>" value="1">
                                            </div>
                                        </div>
                                        <div class="col-md-2" style="padding-right:0;">
                                            <div class="form-group">
                                                <label for="label">Số Ngày</label>
                                                <input type="number" class="form-control" onclick="tienxetheosoluong()" name="songay" id="songay<?php echo $i ?>" value="1">
                                            </div>
                                        </div>
                                        <div class="col-md-2" style="padding-right:0;">
                                            Đơn giá: <p style="color:red;font-weight:bold;width:100%;border:none;background:#fff;"><?php echo product_price($rw_pt["Gia"]) ?>/Ngày</p>
                                            <p id="dongia<?php echo $i ?>" style="visibility: hidden;"><?php echo $rw_pt["Gia"] ?></p>
                                        </div>
                                        <div class="col-md-2" style="padding-right:0;">
                                            Thành tiền: <p style="color:red;font-weight:bold;width:100%;border:none;background:#fff;" id="tongtienxe<?php echo $i ?>"><?php echo product_price($rw_pt["Gia"]) ?></p>
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
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <img src="admin/img/nha-hang/nha-hang-2.jpg" class="img-restaurant" alt="">
                                    </div>
                                    <div class="col-md-4">
                                        <h5 class="name-vehicle">Nhà Hàng Khách Sạn Green Deluxe</h5>
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                            Xem Thực Đơn
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Thực Đơn Nhà Hàng</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h5 style="font-weight:600">Thực Đơn Người Lớn</h5>
                                                        <p>1/ Gỏi gà trộn bắp cải<br>
                                                            2/ Bò xào cải thìa<br>
                                                            3/ Tôm rim thịt<br>
                                                            4/ Canh cải thit bằm<br>
                                                            5/ Tráng miệng trái cây<br>
                                                            6/ Cơm trắng<br>
                                                            7/ Miễn phí trà đá.<br>
                                                        </p>
                                                        <h5 style="font-weight:600">Thực Đơn Trẻ Em</h5>
                                                        <p>
                                                            1/ Cơm trắng<br>
                                                            2/ Miễn phí trà đá.
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="lbsoluong4cho">Số Lượng Người Lớn</label>
                                            <input type="number" class="form-control" name="soluong4cho" id="soluong4cho">
                                        </div>
                                        <div class="form-group">
                                            <label for="lbsoluong4cho">Số Lượng Trẻ Em</label>
                                            <input type="number" class="form-control" name="soluong4cho" id="soluong4cho">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        Đơn giá:
                                        <p style="color:red;font-weight: bold">300.000đ/Người Lớn</p>
                                        <p style="color:red;font-weight: bold">100.000đ/Trẻ Em</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <img src="admin/img/nha-hang/green-deluxe.jpg" class="img-restaurant" alt="">
                                    </div>
                                    <div class="col-md-4">
                                        <h5 class="name-vehicle">Nhà Hàng Khách Sạn Green Deluxe</h5>
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                            Xem Thực Đơn
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Thực Đơn Nhà Hàng</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h5 style="font-weight:600">Thực Đơn Người Lớn</h5>
                                                        <p>1/ Gỏi gà trộn bắp cải<br>
                                                            2/ Bò xào cải thìa<br>
                                                            3/ Tôm rim thịt<br>
                                                            4/ Canh cải thit bằm<br>
                                                            5/ Tráng miệng trái cây<br>
                                                            6/ Cơm trắng<br>
                                                            7/ Miễn phí trà đá.<br>
                                                        </p>
                                                        <h5 style="font-weight:600">Thực Đơn Trẻ Em</h5>
                                                        <p>
                                                            1/ Cơm trắng<br>
                                                            2/ Miễn phí trà đá.
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="lbsoluong4cho">Số Lượng Người Lớn</label>
                                            <input type="number" class="form-control" name="soluong4cho" id="soluong4cho">
                                        </div>
                                        <div class="form-group">
                                            <label for="lbsoluong4cho">Số Lượng Trẻ Em</label>
                                            <input type="number" class="form-control" name="soluong4cho" id="soluong4cho">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        Đơn giá:
                                        <p style="color:red;font-weight: bold">300.000đ/Người Lớn</p>
                                        <p style="color:red;font-weight: bold">100.000đ/Trẻ Em</p>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </section>
                </div>


            </div>
        </div>
    </div>
</section>

<!-- END -->

<?php
include('include/footer.php');
?>