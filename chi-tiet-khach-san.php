<?php
include('include/header.php');
if (isset($_GET['khachsan'])) {
    $maks = $_GET['khachsan'];
    require_once('database/db_config.php');

    $query = "SELECT * from khachsan where MaKS='$maks'";
    $result = mysqli_query($connection, $query);
    $rows = @mysqli_fetch_array($result);
}
?>

<!-- NỘI DUNG -->
<div class="container tour-container">
<div class="tour-title"><h2><?php echo $rows['TenKS'];?></h2></div>
    <div class="tour-title">
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="tour-content">
                <div class="tour-image"><img src="admin/img/khach-san/<?php echo $rows['Anh']; ?>"></div>
                <div class="tour-image-sub">
                    <?php echo $rows['TenKS']; ?>
                </div>
                <div class="tour-description">
                    <h3>Giới Thiệu </h3>
                    <div class="w-type">
                        <h5>Hạng Sao:
                            <?php echo $rows['HangSao']; ?> <i style="color:yellow;font-size:15px" class="fas fa-star"></i></h5>

                    </div>
                    <div>
                        <p>Địa Chỉ:
                            <?php echo $rows['DiaChi']; ?>
                        </p>
                    </div>
                    <?php echo $rows['DienThoai']; ?><br />
                    <?php echo $rows['WebSite']; ?><br />
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="tour-widget">
                <h5 class="w-title">Thông tin đặt khách sạn</h5>
                <?php
                $q_LPKS = "SELECT * FROM loaiphong";
                $r_LPKS = mysqli_query($connection, $q_LPKS);
                ?>
                <div class="form-group">
                    <label> Loại Phòng </label>
                    <select name="MaLoaiPhong" class="form-control">
                        <?php
                        while ($LKS = mysqli_fetch_array($r_LPKS)) {
                        ?>
                            <option value="<?php echo $LKS["MaLoaiPhong"] ?>"><?php echo $LKS["TenLoaiPhong"] ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label> Ngày Đến </label>
                    <input type="date" name="NgayDen" class="form-control" placeholder="Nhập Ngày Đến">
                </div>
                <div class="form-group">
                    <label> Ngày Đi </label>
                    <input type="date" name="NgayDi" class="form-control" placeholder="Nhập Ngày Đi">
                </div>
                <button class="btn btn-book"><a href="dat-khach-san.php?tour=<?php echo $rows['MaKS']; ?>">Đặt Khách Sạn</button>
            </div>

        </div>
    </div>
</div>

<!-- END NỘI DUNG -->

<?php include('include/footer.php'); ?>