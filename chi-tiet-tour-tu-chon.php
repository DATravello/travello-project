<?php
include('include/header.php');


if (isset($_GET['tour'])) {
    $matour = $_GET['tour'];
    require_once('database/db_config.php');

    //Query Tour
    $q_tour = "SELECT * FROM tourdulich WHERE MaTour='$matour'";
    $rs_tour = mysqli_query($connection, $q_tour);
    $rw_tour = mysqli_fetch_array($rs_tour);

    // Querry Khách sạn
    $mks = $rw_tour['MaKS'];
    $q_ks = "SELECT * FROM khachsan WHERE MaKS='$mks'";
    $rs_ks = mysqli_query($connection, $q_ks);
    $rw_ks = mysqli_fetch_array($rs_ks);

    // Querry Điểm đến
    $mavt = $rw_tour['MaViTri'];
    $q_diemden = "SELECT * FROM vitri WHERE MaViTri='$mavt'";
    $rs_diemden = mysqli_query($connection, $q_diemden);
    $rw_dd = mysqli_fetch_array($rs_diemden);

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

    //Query Nhà Hàng

    $q_nh = "SELECT * FROM nhahang WHERE MaViTri='$mavt'";
    $rs_nh = mysqli_query($connection, $q_nh);

    $q_sonh = "SELECT COUNT(*) AS total FROM nhahang";
    $rs_sonh = mysqli_query($connection, $q_sonh);
    $sonh = mysqli_fetch_assoc($rs_sonh);
}
?>

<!-- NỘI DUNG -->

<section class="container self-booking">

    <h5 class="title-booking"><?php echo $rw_tour["TenTour"]; ?> - <?php echo $rw_ks["TenKS"]; ?></h5>
    <div class="self-star">
        <?php
        $s = $rw_ks["HangSao"];
        for ($i = 1; $i <= $s; $i++) {
            echo '<i class="fas fa-star"></i>';
        }
        ?>
    </div>
    <div class="self-location"><i class="fas fa-map-marker-alt"></i> <?php echo $rw_dd["TenViTri"] ?></div>
    <div class="row">
        <div class="col-3 nav-self">
            <div class="list-group" id="list-tab" role="tablist">
                <a class="list-group-item list-group-item-action active" id="list-lich-trinh-list" data-toggle="list" href="#list-lich-trinh" role="tab" aria-controls="lich-trinh">Lịch Trình Tour</a>
                <a class="list-group-item list-group-item-action" id="list-home-list" data-toggle="list" href="#list-home" role="tab" aria-controls="home">Khách Sạn</a>
                <a class="list-group-item list-group-item-action" id="list-profile-list" data-toggle="list" href="#list-profile" role="tab" aria-controls="profile">Hướng Dẫn Viên</a>
                <a class="list-group-item list-group-item-action" id="list-messages-list" data-toggle="list" href="#list-messages" role="tab" aria-controls="messages">Vận Chuyển</a>
                <a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="list" href="#list-settings" role="tab" aria-controls="settings">Nhà Hàng</a>
                <div class="list-group-item self-sum" style="background:#ffcd3c;color:#fff"><i class="fas fa-dollar-sign"></i> Tổng: <p id="tongTienTour" style="color:red;display:inline;font-weight:bold"><?php echo product_price($rw_tour["ChiPhiTour"]); ?></p>
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

        <script>
            $('#tongtienks').val(0);

            function tienphong() {
                var a = $('#sophong').val();
                var sumlp = 0;
                sumlp = parseInt(a) * <?php echo $rw_ks['Gia'] ?>;
                $('#tongtienphong').text(sumlp.toLocaleString('it-IT', {
                    style: 'currency',
                    currency: 'VND'
                }));
                $('#tongtienks').val(sumlp);
            }
        </script>
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
                                    <input type="number" class="form-control" onclick="tienphong(),tongTien()" name="" id="sophong">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <p>Thành Tiền</p>
                                <p style="color:red;font-weight:bold" id="tongtienphong"></p>
                                <input type="number" id="tongtienks" style="visibility:hidden;height:0;margin:0" value="0">
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
                                    var sumXe = 0;
                                    var sum = 0;

                                    for (var i = 0; i < soxe; i++) {
                                        var a = $('#soluongxe' + i).val();
                                        var b = $('#songay' + i).val();
                                        var dongia = $('#dongia' + i).text();
                                        sum = parseInt(a) * parseInt(b) * parseInt(dongia);
                                        $('#tongtienXe' + i).text(sum.toLocaleString('it-IT', {
                                            style: 'currency',
                                            currency: 'VND'
                                        }));
                                        $("#tienXe" + i).val(sum);
                                        sumXe = sumXe + parseInt($('#tienXe' + i).val());
                                        $('#tongtienxe').val(sumXe);
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
                                                <input type="number" class="form-control" onclick="tienxetheosoluong(),tongTien()" name="soluongxe" id="soluongxe<?php echo $i ?>" value="0">
                                            </div>
                                        </div>
                                        <div class="col-md-2" style="padding-right:0;">
                                            <div class="form-group">
                                                <label for="label">Số Ngày</label>
                                                <input type="number" class="form-control" onclick="tienxetheosoluong(),tongTien()" name="songay" id="songay<?php echo $i ?>" value="0">
                                            </div>
                                        </div>
                                        <div class="col-md-2" style="padding-right:0;">
                                            Đơn giá: <p style="color:red;font-weight:bold;width:100%;border:none;background:#fff;"><?php echo product_price($rw_pt["Gia"]) ?>/Ngày</p>
                                            <p id="dongia<?php echo $i ?>" style="visibility:hidden;height:0;margin:0"><?php echo $rw_pt["Gia"] ?></p>
                                        </div>
                                        <div class="col-md-2" style="padding-right:0;">
                                            Thành tiền: <p style="color:red;font-weight:bold;width:100%;border:none;background:#fff;" id="tongtienXe<?php echo $i ?>"><?php echo product_price($rw_pt["Gia"]) ?></p>
                                            <p id="tienXe<?php echo $i ?>" style="visibility:hidden;height:0;margin:0"></p>
                                            <input type="number" id="tongtienxe" style="visibility:hidden;height:0;margin:0" value="0">
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

                                    }
                                }
                            </script>
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3" style="padding: 0 10px 0 10px;">
                                            <img src="admin/img/nha-hang/<?php echo $rw_nh['Anh']; ?>" class="img-restaurant" alt="">

                                        </div>
                                        <div class="col-md-3" style="padding: 0 10px 0 0;">
                                            <h5 class="name-vehicle"><?php echo $rw_nh['TenNhaHang']; ?></h5>
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
                                                            <p><?php echo $rw_nh['MoTaThucDon']; ?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2" style="padding: 0 10px 0 0;">
                                            <div class="form-group">
                                                <label for="label">Số Lượng Người Lớn</label>
                                                <input type="number" onclick="TienNhaHang(),tongTien()" value="0" class="form-control" name="songuoilon<?php echo $i ?>" id="songuoilon<?php echo $i ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="label">Số Lượng Trẻ Em</label>
                                                <input type="number" onclick="TienNhaHang(),tongTien()" value="0" class="form-control" name="sotreem<?php echo $i ?>" id="sotreem<?php echo $i ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-2" style="padding: 0 10px 0 0;">
                                            Đơn giá:
                                            <p style="color:red;font-weight:bold;font-size:13px"><?php echo product_price($rw_nh['GiaNguoiLon']); ?>/Người Lớn</p>
                                            <p id="gianguoilon<?php echo $i ?>" style="visibility:hidden;height:0;margin:0"><?php echo $rw_nh["GiaNguoiLon"] ?></p>
                                            <p style="color:red;font-weight:bold;font-size:13px"><?php echo product_price($rw_nh['GiaTreEm']); ?>/Trẻ Em</p>
                                            <p id="giatreem<?php echo $i ?>" style="visibility:hidden;height:0;margin:0"><?php echo $rw_nh["GiaTreEm"] ?></p>
                                        </div>
                                        <div class="col-md-2" style="padding: 0 10px 0 0;">
                                            Tổng tiền:
                                            <p id="sumtiennhahang<?php echo $i ?>" style="color:red;font-weight:bold;font-size:13px"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                            $i++;
                        } ?>
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