<?php
include('security.php');
include('includes/header.php');
include('includes/navbar.php');
?>

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">SỬA YÊU CẦU HUỶ TOUR</h6>
        </div>

        <div class="card-body">
            <?php

            if (isset($_POST['accept_btn'])) {
                $id = $_POST['mahd'];

                $query = "SELECT * FROM hoadon WHERE MaHD = $id";
                $query_run = mysqli_query($connection, $query);

                foreach ($query_run as $row) {
                    $makh = $row["MaKH"];
                    $matour = $row["MaTour"];

                    //Query Tour
                    $sql_tour = "SELECT * FROM tourdulich WHERE MaTour = $matour";
                    $qr_tour = mysqli_query($connection, $sql_tour);
                    $rw_tour = mysqli_fetch_array($qr_tour);

                    //Query Khách Hàng
                    $sql_kh = "SELECT * FROM khachhang WHERE MaKH = $makh";
                    $qr_kh = mysqli_query($connection, $sql_kh);
                    $rw_kh = mysqli_fetch_array($qr_kh);
            ?>
                    <form action="code.php" method="POST">
                        <div class="form-group">
                            <label>Mã Tour</label>
                            <input type="text" name="sua_mahd" value="<?php echo $row['MaHD']; ?>" class="form-control" readonly>
                        </div>

                        <div class="form-group">
                            <label>Tên Tour</label>
                            <input type="text" name="sua_tentour" value="<?php echo $rw_tour['TenTour']; ?>" class="form-control" readonly>
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" name="sua_email" value="<?php echo $rw_kh['Email']; ?>" class="form-control" readonly>
                        </div>

                        <div class="form-group">
                            <label> Tổng Tiền </label>
                            <input type="text" value="<?php echo $row['TongTien']; ?>" class="form-control" readonly>
                        </div>

                        <div class="form-group">
                            <label> Tình Trạng Trước Khi Yêu Cầu Huỷ Tour </label>
                            <input type="text" value="<?php echo $row['TinhTrangCu']; ?>" class="form-control" readonly>
                        </div>

                        <div class="form-group">
                            <label> Lý Do Huỷ Tour </label>
                            <input type="text" value="<?php echo $row['LyDoHuyTour']; ?>" class="form-control" readonly>
                        </div>

                        <div class="form-group">
                            <label> Tình Trạng</label>
                            <select class="form-control" name="sua_tinhtrang">
                                <option value="Đã Huỷ">Đã Huỷ</option>
                                <option value="<?php echo $row['TinhTrangCu']; ?>"><?php echo $row['TinhTrangCu']; ?></option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label> Ghi Chú </label>
                            <input type="text" name="sua_ghichu" class="form-control" placeholder="Nhập Ghi Chú">
                        </div>

        </div>

        <div class="card-footer">
            <a href="danh-sach-yeu-cau-huy-tour.php" class="btn btn-danger">Huỷ</a>
            <button type="submit" name="btn-update-huy-tour" class="btn btn-primary">Cập Nhật</button>
            </form>
        </div>

<?php
                }
            }

?>
    </div>
</div>




<?php
include('includes/scripts.php');
include('includes/footer.php');
?>