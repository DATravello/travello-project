<?php
include('security.php');
include('includes/header.php');
include('includes/navbar.php');
?>
<div class="container-fluid">

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Thêm Nhà Hàng
                <a href="danh-sach-nha-hang.php">
                    <button type="button" class="btn btn-success">Danh Sách Nhà Hàng</button>
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
                    <label>Tên Thương Hiệu</label>
                    <select class="form-control" name="ThuongHieuNH">
                        <!-- <div class="form-group" name="LoaiTin"> -->
                        <?php
                        $q_thuonghieu = "SELECT * FROM thuonghieunh";
                        $rs_thuonghieu = mysqli_query($connection, $q_thuonghieu);
                        while ($TL = @mysqli_fetch_array($rs_thuonghieu)) {
                        ?>
                            <option value="<?php echo $TL["MaThuongHieuNH"] ?>"><?php echo $TL["TenThuongHieuNH"] ?></option>
                        <?php
                        }
                        ?>
                        <!-- </div> -->
                    </select>
                </div>

                <div class="form-group">
                    <label> Tên Nhà Hàng </label>
                    <input type="text" name="TenNhaHang" class="form-control" placeholder="Nhập Tên Nhà Hàng">
                </div>
                <div class="form-group">
                    <label>Vị Trí</label>
                    <select class="form-control" name="ViTriNH">
                        <!-- <div class="form-group" name="LoaiTin"> -->
                        <?php
                        $q_vitri = "SELECT * FROM vitri";
                        $rs_vitri = mysqli_query($connection, $q_vitri);
                        while ($TL = @mysqli_fetch_array($rs_vitri)) {
                        ?>
                            <option value="<?php echo $TL["MaViTri"] ?>"><?php echo $TL["TenViTri"] ?></option>
                        <?php
                        }
                        ?>
                        <!-- </div> -->
                    </select>
                </div>
                <div class="form-group">
                    <label> Địa Chỉ </label>
                    <input type="text" name="DiaChi" class="form-control" placeholder="Nhập Địa Chỉ">
                </div>

                <div class="form-group">
                    <label> Ảnh </label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" name="Anh" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                            <label class="custom-file-label" for="inputGroupFile01">Chọn file</label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label> SDT </label>
                    <input type="number" name="SDT" class="form-control" placeholder="Nhập SDT">
                </div>
                <div class="form-group">
                    <label> Giới Thiệu </label>
                    <textarea rows="5" name="GioiThieuNH" class="form-control" placeholder="Nhập Giới Thiệu"></textarea>
                </div>
                <div class="form-group">
                    <label> Giá Trẻ Em (VNĐ) </label>
                    <input type="number" name="GiaTreEm" class="form-control" placeholder="Nhập Giá Cho Trẻ Em">
                </div>
                <div class="form-group">
                    <label> Giá Người Lớn (VNĐ) </label>
                    <input type="number" name="GiaNguoiLon" class="form-control" placeholder="Nhập Giá Cho Người Lớn">
                </div>
                <div class="form-group">
                    <label> Mô Tả Thực Đơn </label>
                    <textarea rows="5" name="MoTaThucDon" class="form-control" placeholder="Nhập Mô Tả Thực Đơn"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="reset" value="reset" class="btn btn-warning" data-dismiss="modal">Xoá Trường</button>
                <button type="submit" name="btn_them_nh" class="btn btn-primary">Lưu</button>
            </div>

        </form>
    </div>

</div>
<script src="js/cus.js"></script>
<?php
include('includes/scripts.php');
include('includes/footer.php');
?>