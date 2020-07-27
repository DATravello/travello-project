<?php
include('security.php');
include('includes/header.php');
include('includes/navbar.php');
?>
<div class="container-fluid">

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Thêm Phương Tiện
                <a href="danh-sach-phuong-tien.php">
                    <button type="button" class="btn btn-success">Danh Sách Phương Tiện</button>
                </a>
            </h6>
        </div>
        <?php


        if (isset($_SESSION['success']) && $_SESSION['success'] != '') {
            echo    '<div class="btn btn-success btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-check"></i>
                        </span>
                        <span class="text">
                        ' . $_SESSION['success'] . '
                        </span>
                        </div>';
            unset($_SESSION['success']);
        }

        if (isset($_SESSION['status']) && $_SESSION['status'] != '') {
            echo '<div class="btn btn-warning btn-icon-split">
                     <span class="icon text-white-50">
                        <i class="fas fa-exclamation-triangle"></i>
                     </span>
                     <span class="text">
                        ' . $_SESSION['status'] . '
                     </span>
                     </div>';
            unset($_SESSION['status']);
        }
        ?>
        <form action="code.php" method="POST" enctype="multipart/form-data">
            <div class="modal-body">
                <div class="form-group">
                    <label> Loại Phương Tiện </label>
                    <select class="form-control" name="loaipt">
                        <?php
                        $q_loaipt = "SELECT * FROM theloaiphuongtien";
                        $rs_loaipt = mysqli_query($connection, $q_loaipt);
                        while ($TL = @mysqli_fetch_array($rs_loaipt)) {
                        ?>
                            <option value="<?php echo $TL["MaTLPhuongTien"] ?>"><?php echo $TL["TenTLPhuongTien"] ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label> Phương Tiện </label>
                    <input type="text" name="PhuongTien" class="form-control" placeholder="Nhập Tên Phương Tiện">
                </div>
                <div class="form-group">
                    <label> Nơi Khởi Hành </label>
                    <input type="text" name="NoiDi" class="form-control" placeholder="Nhập Nơi Khởi Hàng">
                </div>
                <div class="form-group">
                    <label> Nơi Đến </label>
                    <input type="text" name="NoiDen" class="form-control" placeholder="Nhập Nơi Đến">
                </div>
                <div class="form-group">
                    <label> Giá Tiền (VNĐ) </label>
                    <input type="number" name="Gia" class="form-control" placeholder="Nhập Giá Tiền">
                </div>
                <div class="form-group">
                    <label> Ảnh </label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" name="HinhAnh" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                            <label class="custom-file-label" for="inputGroupFile01">Chọn file</label>
                        </div>
                    </div>
                </div>
            </div>

    <div class="modal-footer">
        <button type="reset" value="reset" class="btn btn-warning" data-dismiss="modal">Xoá Trường</button>
        <button type="submit" name="btn_them_phuong_tien" class="btn btn-primary">Lưu</button>
    </div>

    </form>
</div>

</div>
<?php
include('includes/scripts.php');
include('includes/footer.php');
?>