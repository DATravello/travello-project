<?php
include('include/header.php');

if(isset($_GET['nhahang']))
{
    $manh=$_GET['nhahang'];
    require_once('database/db_config.php');

    $query="SELECT * from nhahang where MaNH='$manh'";
    $result=mysqli_query($connection, $query);
    $rows=@mysqli_fetch_array($result);

    // $query2="SELECT * from loaiks where MaLoaiKS='1'";
    // $result2=mysqli_query($connection, $query2);
    // $rows2=@mysqli_fetch_array($result2);

    //Loại KS
    // $loaiks = "SELECT * FROM khachsan INNER JOIN loaiks ON khachsan.MaLoaiKS = loaiks.MaLoaiKS where MaKS='$maks'";
    // $result_loaks = mysqli_query($connection, $loaiks);
    // $rows_loaiks = @mysqli_fetch_array($result_pt);

    // //Khách Sạn
    // $khachsan = "SELECT * FROM tourdulich INNER JOIN khachsan ON tourdulich.MaKS = khachsan.MaKS where MaTour='$matour'";
    // $result_ks = mysqli_query($connection, $khachsan);
    // $rows_ks = @mysqli_fetch_array($result_ks);

    // //Hướng dẫn viên
    // $hdv = "SELECT * FROM tourdulich INNER JOIN huongdanvien ON tourdulich.MaHDV = huongdanvien.MaHDV where MaTour='$matour'";
    // $result_hdv = mysqli_query($connection, $hdv);
    // $rows_hdv = @mysqli_fetch_array($result_hdv);
}
?>

    <!-- NỘI DUNG -->

    <div class="container tour-container">
        <div class="tour-title"><h2><?php echo $rows['TenNhaHang'];?></h2></div>
        <div class="row">
            <div class="col-md-8">
                <div class="tour-content">
                    <!-- <div class="tour-subtitle"><h5><?php echo $rows['TenNhaHang'];?>  <?php echo $rows2['TenLoaiKS'];?></h5></div> -->
                    <div class="tour-image"><img src="admin/img/nha-hang/<?php echo $rows['Anh'];?>"></div>
                    <div class="tour-image-sub">
                        <?php echo $rows['TenNhaHang'];?>
                    </div>
                <div class="tour-description">
                        <h3>Giới Thiệu </h3>
                        <!-- <div class="w-type"><h5>Hạng Sao: </h5> <p><?php echo $rows['HangSao'];?> * <p></div> -->
                        <?php echo $rows['GioiThieuNH'];?><br/>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="tour-widget">
                    <h5 class="w-title">Thông tin đặt nhà hàng</h5>
                    <div class="w-price"><h5>Giá: <h5> <p><?php echo $rows['GiaNH'];?> VNĐ <p></div>
                    <div class="w-time"><h5>Địa Chỉ: </h5> <p><?php echo $rows['DiaChi'];?></p></div>
                    <div class="w-place"><h5>Điện Thoại: </h5> <p><?php echo $rows['SDT'];?></p></div>
                    <!-- <div class="w-catch"><h5>Số Phòng: </h5> <p><?php echo $rows['SoPhong'];?></p></div>
                    <div class="w-day"><h5>Số ngày: </h5> <p><?php echo $rows['SoNgay'];?></p></div>
                    <div class="w-vehicle"><h5>Loại Phòng: </h5> <p><?php echo $rows_loaiks['TenLoaiKS'];?></p></div>
                    <div class="w-hotel"><h5>Loại Phòng: </h5> <p><?php echo $rows_loaiks['TenLoaiPhong'];?></p></div>
                    <div class="w-guide"><h5>Hướng dẫn viên: </h5> <p><?php echo $rows_hdv['TenHDV'];?></p></div> -->
                    <button class="btn btn-book"><a href="dat-nha-hang.php?tour=<?php echo $rows['MaNH'];?>">Đặt Nhà Hàng</button>
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