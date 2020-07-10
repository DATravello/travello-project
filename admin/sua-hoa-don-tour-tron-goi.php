<?php
include('security.php');
include('includes/header.php');
include('includes/navbar.php');
?>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Sửa HĐ Tour Trọn Gói
            <a href="danh-sach-hoa-don-tour-tron-goi.php">
                <button type="button" class="btn btn-success">Danh Sách HĐ Tour Trọn Gói</button>
            </a>
        </h6>
    </div>

    <div class="card-body">
        <?php
        $connection = mysqli_connect("localhost", "root", "", "travello_db");
        if (isset($_POST['edit_btn'])) {
            $mahd = $_POST['edit_MaHD'];
            $query = "SELECT * FROM hoadon WHERE MaHD ='$mahd'";
            $query_run = mysqli_query($connection, $query);
            foreach ($query_run as $row) {
        ?>
                <form action="code.php" method="POST">
                    <div class="form-group">
                        <label>Mã Hóa Đơn</label>
                        <input type="text" name="sua_mahd" value="<?php echo $row['MaHD'] ?>" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label> Thanh Toán</label>
                        <select class="form-control" name="sua_thanhtoan" readonly>
                            <?php
                            $q_thanhtoan = "SELECT * FROM thanhtoan";
                            $rs_thanhtoan = mysqli_query($connection, $q_thanhtoan);
                            $TT = @mysqli_fetch_array($rs_thanhtoan)
                            ?>
                             <option value="<?php echo $TT["MaTT"] ?>"><?php echo $TT["TenThanhToan"] ?></option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label> Tên Khách Hàng</label>
                        <select class="form-control" name="sua_khachhang" readonly>
                            <?php
                            $q_khachhang = "SELECT * FROM khachhang";
                            $rs_khachhang = mysqli_query($connection, $q_khachhang);
                            $TL = @mysqli_fetch_array($rs_khachhang)
                            ?>
                              <option value="<?php echo $TL["MaKH"] ?>"><?php echo $TL["TenKH"] ?></option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label> Tên Tour</label>
                        <select class="form-control" name="sua_tour" readonly>
                            <?php
                            $q_tourdl = "SELECT * FROM tourdulich";
                            $rs_tourdl = mysqli_query($connection, $q_tourdl);
                            $TDl = @mysqli_fetch_array($rs_tourdl);
                            ?>
                            <option value="<?php echo $TDl["MaTour"] ?>"><?php echo $TDl["TenTour"] ?></option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Số Người Lớn</label>
                        <input type="number" name="sua_songuoilon" value="<?php echo $row['SoNguoiLon'] ?>"  class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label>Số Trẻ Em</label>
                        <input type="number" name="sua_sotreem" value="<?php echo $row['SoTreEm'] ?>"  class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label>Ngày Đặt</label>
                        <input type="date" name="sua_ngaydat" value="<?php echo $row['NgayDat'] ?>"  class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label>Tổng Tiền</label>
                        <input type="number" name="sua_tongtien" value="<?php echo $row['TongTien'] ?>"  class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label> Tình Trạng </label>
                        <select class="form-control" name="sua_tinhtrang">
                            <option value="">Thay Đổi Tình Trạng</option>
                            <option <?php if (isset($pay) && $pay == 'Đã Thanh Toán') echo "selected=\"selected\"";  ?> value="Đã Thanh Toán">Đã Thanh Toán</option>
                            <option <?php if (isset($pay) && $pay == 'Chưa Xác Nhận') echo "selected=\"selected\"";  ?> value="Chưa Xác Nhận">Chưa Xác Nhận</option>
                            <option <?php if (isset($pay) && $pay == 'Chưa Thanh Toán') echo "selected=\"selected\"";  ?> value="Chưa Thanh Toán">Chưa Thanh Toán</option>
                            <option <?php if (isset($pay) && $pay == 'Đã Hoàn Thành') echo "selected=\"selected\"";  ?> value="Đã Hoàn Thành">Đã Hoàn Thành</option>
                        </select><br /><br />
                    </div>

                    <a href="danh-sach-hoa-don-tour-tron-goi.php" class="btn btn-danger">Cancel</a>
                    <button type="submit" name="btn_capnhat_hd_tron_goi" class="btn btn-primary">Update</button>
                </form>

        <?php
            }
        }

        ?>

    </div>
</div>


<?php
include('includes/footer.php');
include('includes/scripts.php');
?>