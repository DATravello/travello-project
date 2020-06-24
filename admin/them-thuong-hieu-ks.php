<?php
include('security.php');
include('includes/header.php');
include('includes/navbar.php');
?>
<div class="container-fluid">

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Thêm Thương Hiệu
                <a href="danh-sach-thuong-hieu-ks.php">
                    <button type="button" class="btn btn-success">Danh Sách Thương Hiệu</button>
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
            <div class="form-group">
                <label>Loại Khách Sạn</label>
                <select class="form-control" name="LoaiKhachSan">
                    <!-- <div class="form-group" name="LoaiTin"> -->
                    <?php
                    $q_lks = "SELECT * FROM loaikhachsan";
                    $rs_lks = mysqli_query($connection, $q_lks);
                    while ($TL = @mysqli_fetch_array($rs_lks)) {
                    ?>
                        <option value="<?php echo $TL["MaLoaiKS"] ?>"><?php echo $TL["TenLoaiKS"] ?></option>
                    <?php
                    }
                    ?>
                    <!-- </div> -->
                </select>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label> Tên Thương Hiệu </label>
                    <input type="text" name="TenThuongHieuKS" class="form-control" placeholder="Nhập Tên Thương Hiệu">
                </div>
                <div class="form-group">
                    <label> Mô Tả </label>
                    <input type="text" name="MoTa" class="form-control" placeholder="Nhập Mô Tả">
                </div>
                <div class="form-group">
                    <label> Hình Ảnh </label>
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
                <button type="submit" name="btn_them_thuong_hieu" class="btn btn-primary">Lưu</button>
            </div>

        </form>
    </div>

</div>
<?php
include('includes/scripts.php');
include('includes/footer.php');
?>