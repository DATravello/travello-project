<?php
include('security.php');
include('includes/header.php');
include('includes/navbar.php');
?>

<style>
    .report-container {
        padding: 30px;
    }

    .report-container .card {
        margin-bottom: 30px;
    }

    .report-container .card-body .numbers {
        text-align: right;
    }

    .report-container .card-title {
        font-size: 20px;
    }

    .report-container .icon-warning {
        background: #ff8d72;
        background-image: linear-gradient(to bottom left, #ff8d72, #ff6491, #ff8d72);
        background-size: 210% 210%;
        background-position: 100% 0;
    }

    .report-container .icon-primary {
        background: #e14eca;
        background-image: linear-gradient(to bottom left, #e14eca, #ba54f5, #e14eca);
        background-size: 210% 210%;
        background-position: 100% 0;
    }

    .info-icon.icon-primary {
        background: #e14eca;
        background-image: linear-gradient(to bottom left, #e14eca, #ba54f5, #e14eca);
        background-size: 210% 210%;
        background-position: 100% 0;
    }

    .report-container .icon-success {
        background: #00f2c3;
        background-image: linear-gradient(to bottom left, #00f2c3, #0098f0, #00f2c3);
        background-size: 210% 210%;
        background-position: 100% 0;
    }

    .report-container .info-icon.icon-danger {
        background: #fd5d93;
        background-image: linear-gradient(to bottom left, #fd5d93, #ec250d, #fd5d93);
        background-size: 210% 210%;
        background-position: 100% 0;
    }

    .report-container .info-icon {
        height: 50px;
        width: 50px;
        border-radius: 50%;
        background-size: 210% 210%;
        background-position: 100% 0;
    }

    .report-container .fas {
        display: inline-block;
        vertical-align: middle;
        text-transform: none;
    }

    .report-container .info-icon i {
        color: #fff;
        font-size: 1.2em;
        padding: 14px 13px;
    }

    .circle-1 {
        border-radius: 50px;
        background: #e14eca;

        color: #fff;
        width: 50px;
        height: 50px;
        line-height: 50px;
    }
    .circle-2 {
        border-radius: 50px;
        background: #00f2c3;

        color: #fff;
        width: 50px;
        height: 50px;
        line-height: 50px;
    }

    .stats .fas {
        font-size: 15px;
        padding-right: 5px;
    }
</style>


<?php

//Query Tổng Tiền Tour Tự Chọn
$sql_tientour_tu_tao = "SELECT Sum(TongTien) AS total FROM hoadontourtutao";
$rs_tientour_tu_tao = mysqli_query($connection, $sql_tientour_tu_tao);
$tientour_tt = mysqli_fetch_assoc($rs_tientour_tu_tao);

//Query Tổng Tiền Tour Tự Chọn
$sql_tientour = "SELECT Sum(TongTien) AS total FROM hoadon";
$rs_tientour = mysqli_query($connection, $sql_tientour);
$tientour = mysqli_fetch_assoc($rs_tientour);

//QUERY SL Tour
$sql_tour = "SELECT COUNT(*) AS total FROM tourdulich";
$rs_tour = mysqli_query($connection, $sql_tour);
$sltour = mysqli_fetch_assoc($rs_tour);

//Query sl Tour Tự Lên
$sql_tour_tl = "SELECT COUNT(*) AS total FROM hoadontourtutao";
$rs_tour_tl = mysqli_query($connection, $sql_tour_tl);
$sltour_tl = mysqli_fetch_assoc($rs_tour_tl);

//Query sl khách sạn
$sql_ks = "SELECT COUNT(*) AS total FROM khachsan";
$rs_ks = mysqli_query($connection, $sql_ks);
$slks = mysqli_fetch_assoc($rs_ks);

//Query sl nhà hàng
$sql_nh = "SELECT COUNT(*) AS total FROM nhahang";
$rs_nh = mysqli_query($connection, $sql_nh);
$slnh = mysqli_fetch_assoc($rs_nh);

?>
<script src="//code.jquery.com/jquery.min.js"></script>
<script src="../plugins/counterJquery/animationCounter.js"></script>


<div class="container">
    <div class="card show mb-4">
        <div class="report-container">
            <h5>THỐNG KÊ DOANH THU</h5>
            <div class="row">
                <div class="col-md-6 col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="circle-1 text-center"><i class="fas fa-dollar-sign"></i></div>
                                </div>
                                <div class="col-md-8">
                                    <div class="numbers">
                                        <p class="card-category" style="font-weight:bold">DOANH THU TOUR TỰ LÊN</p>
                                        <h3 class="card-title" style="color:red;font-weight:bold"><?php echo product_price($tientour_tt["total"]) ?></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="circle-2 text-center"><i class="fas fa-dollar-sign"></i></div>
                                </div>
                                <div class="col-md-8">
                                    <div class="numbers">
                                        <p class="card-category" style="font-weight:bold">DOANH THU TOUR TRỌN GÓI</p>
                                        <h3 class="card-title" style="color:red;font-weight:bold"><?php echo product_price($tientour["total"]) ?></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <h5>THỐNG KÊ DỊCH VỤ</h5>
            <div class="row">
                <div class="col-md-6 col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-5">
                                    <div class="info-icon text-center icon-warning"><i class="fas fa-plane-departure"></i></div>
                                </div>
                                <div class="col-7">
                                    <div class="numbers">
                                        <p class="card-category">Tour Trọn Gói</p>
                                        <h3 class="card-title tour"></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="stats"><i class="fas fa-redo-alt"></i> Cập Nhật 1 Phút Trước</div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-5">
                                    <div class="info-icon text-center icon-primary"><i class="fas fa-umbrella-beach"></i></div>
                                </div>
                                <div class="col-7">
                                    <div class="numbers">
                                        <p class="card-category">Tour Tự Chọn</p>
                                        <h3 class="card-title tour-tu-chon"></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="stats"><i class="fas fa-redo-alt"></i> Cập Nhật 1 Phút Trước</div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-5">
                                    <div class="info-icon text-center icon-success"><i class="fas fa-hotel"></i></div>
                                </div>
                                <div class="col-7">
                                    <div class="numbers">
                                        <p class="card-category">Khách Sạn</p>
                                        <h3 class="card-title khach-san"></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="stats"><i class="fas fa-redo-alt"></i> Cập Nhật 1 Phút Trước</div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-5">
                                    <div class="info-icon text-center icon-danger"><i class="fas fa-utensils"></i></div>
                                </div>
                                <div class="col-7">
                                    <div class="numbers">
                                        <p class="card-category">Nhà Hàng</p>
                                        <h3 class="card-title nha-hang"></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="stats"><i class="fas fa-redo-alt"></i> Cập nhật 1 phút trước</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('.tour').animationCounter({
        start: 0,
        end: <?php echo $sltour["total"] ?>,
        delay: 100,
    });

    $('.tour-tu-chon').animationCounter({
        start: 0,
        end: <?php echo $sltour_tl["total"] ?>,
        delay: 100,
    });
    $('.khach-san').animationCounter({
        start: 0,
        end: <?php echo $slks["total"] ?>,
        delay: 100,
    });
    $('.nha-hang').animationCounter({
        start: 0,
        end: <?php echo $slnh["total"] ?>,
        delay: 100,
    });
</script>


<?php
include('includes/footer.php');
include('includes/scripts.php');
?>