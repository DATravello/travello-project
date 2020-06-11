<?php
include('security.php');
include('includes/header.php');
include('includes/navbar.php');
?>



<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">SỬA NHÀ HÀNG</h6>
    </div>

    <div class="card-body">
        <?php
        // $connection = mysqli_connect("localhost", "root", "", "travello_db");
        if (isset($_POST['edit_btn'])) {
            $manh = $_POST['sua_mnh'];

            $query = "SELECT * FROM nhahang WHERE MaNH='$manh'";
            $query_run = mysqli_query($connection, $query);

            foreach ($query_run as $row) {
        ?>
                <form action="code.php" method="POST">
                    <div class="form-group">
                        <label>Mã NH</label>
                        <input type="text" name="sua_mnh" value="<?php echo $row['MaNH'] ?>" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label> Tên Nhà Hàng </label>
                        <input type="text" name="sua_tennh" value="<?php echo $row['TenNhaHang'] ?>" class="form-control" placeholder="Nhập Tên Nhà Hàng">
                    </div>
                    <div class="form-group">
                        <label> Địa Chỉ </label>
                        <input type="text" name="sua_diachinh" value="<?php echo $row['DiaChi'] ?>" class="form-control" placeholder="Nhập Địa Chỉ">
                    </div>
                    <div class="form-group">
                        <label> Ảnh </label>
                        <input type="text" name="sua_anhnh" value="<?php echo $row['Anh'] ?>" class="form-control" placeholder="Nhập Ảnh">
                    </div>
                    <div class="form-group">
                        <label> Số Điện Thoại </label>
                        <input type="number" name="sua_sdtnh" value="<?php echo $row['SDT'] ?>" class="form-control" placeholder="Nhập SDT">
                    </div>
                    <div class="form-group">
                        <label> Giới Thiệu </label>
                        <input type="text" name="sua_gtnh" value="<?php echo $row['GioiThieuNH'] ?>" class="form-control" placeholder="Nhập Giới Thiệu">
                    </div>
                    <div class="form-group">
                        <label> Giá </label>
                        <input type="number" name="sua_gianh" value="<?php echo $row['GiaNH'] ?>" class="form-control" placeholder="Nhập Giá">
                    </div>

                    <a href="danh-sach-nha-hang.php" class="btn btn-danger">Huỷ Bỏ</a>
                    <button type="submit" name="btn_capnhat_nh" class="btn btn-primary">Lưu</button>
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