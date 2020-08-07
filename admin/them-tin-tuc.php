<?php
include 'security.php';
include 'includes/header.php';
include 'includes/navbar.php';
?>
<div class="container-fluid">

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Thêm Tin Tức
                <a href="danh-sach-tin-tuc.php">
                    <button type="button" class="btn btn-success">Danh Sách Tin Tức</button>
                </a>
            </h6>
        </div>
        <?php

if (isset($_SESSION['success']) && $_SESSION['success'] != '') {
    echo '<div class="btn btn-success btn-icon-split">
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
                    <label> Tên Tin Tức </label>
                    <input type="text" name="TenTinTuc" class="form-control" placeholder="Nhập Tên Tin Tức">
                </div>
                <div class="form-group">
                    <label> Mô Tả </label>
                    <textarea id="MoTa" name="MoTa" class="form-control" rows="3" placeholder="Nhập Mô Tả"></textarea>
                </div>
                <div class="form-group">
                    <label>Loại Tin Tức</label>
                    <select class="form-control" name="LoaiTin">
                        <?php
$q_theloai = "SELECT * FROM theloai";
$rs_theloai = mysqli_query($connection, $q_theloai);
while ($TL = @mysqli_fetch_array($rs_theloai)) {
    ?>
                            <option value="<?php echo $TL["MaTheLoai"] ?>"><?php echo $TL["TenTheLoai"] ?></option>
                        <?php
}
?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Nhân Viên</label>
                    <select class="form-control" name="NhanVien" disabled>
                            <option value="<?php echo $rw_nv["MaNV"] ?>"><?php echo $rw_nv["TenNV"] ?></option>
                    </select>
                </div>
                <div class="form-group">
                    <label> Chi Tiết </label>
                    <textarea id="ChiTiet" name="ChiTiet" class="form-control" rows="10" placeholder="Nhập Chi Tiết"></textarea>
                </div>
                <div class="form-group">
                    <label>Ảnh </label><br>
                        <img id="previewImg" src="img/default.png">
                    </div>
                    <div class="form-group">

                        <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" name="HinhAnh" accept="image/*" onchange="previewImage()" id="file" class="custom-file-input" aria-describedby="inputGroupFileAddon01">
                            <label class="custom-file-label" for="inputGroupFile01">Chọn file</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label> Tạo Bởi </label>
                    <input type="text" name="TaoBoi" class="form-control" placeholder="Nhập Tác Giả">
                </div>
                <div class="form-group">
                    <label> Ngày </label>
                    <input type="date" name="Ngay" class="form-control" placeholder="Nhập Ngày">
                </div>
            </div>

            <div class="modal-footer">
                <button type="reset" value="reset" class="btn btn-warning" data-dismiss="modal">Xoá Trường</button>
                <button type="submit" name="btn_them_tin_tuc" class="btn btn-primary">Lưu</button>
            </div>

        </form>
    </div>

</div>
<?php
include 'includes/scripts.php';
include 'includes/footer.php';
?>