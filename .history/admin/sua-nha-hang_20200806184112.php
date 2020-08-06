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
        if (isset($_POST['edit_btn'])) {
            $manh = $_POST['sua_mnh'];

            $query = "SELECT * FROM nhahang WHERE MaNH='$manh'";
            $query_run = mysqli_query($connection, $query);

            foreach ($query_run as $row) {
        ?>
                <form action="code.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label> Tên Thương Hiệu</label>
                        <select class="form-control" name="sua_mathnh">
                            <?php
                            $q_thuonghieunh = "SELECT * FROM thuonghieunh";
                            $rs_thuonghieunh = mysqli_query($connection, $q_thuonghieunh);
                            while ($TL = @mysqli_fetch_array($rs_thuonghieunh)) {
                            ?>
                                <option value="<?php echo $TL["MaThuongHieuNH"] ?>"><?php echo $TL["TenThuongHieuNH"] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Mã NH</label>
                        <input type="text" name="sua_mnh" value="<?php echo $row['MaNH'] ?>" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label> Tên Nhà Hàng </label>
                        <input type="text" name="sua_tennh" value="<?php echo $row['TenNhaHang'] ?>" class="form-control" placeholder="Nhập Tên Nhà Hàng">
                    </div>
                    <div class="form-group">
                        <label> Vị Trí</label>
                        <select class="form-control" name="sua_vitrinh">
                            <?php
                            $q_vitri = "SELECT * FROM vitri";
                            $rs_vitri = mysqli_query($connection, $q_vitri);
                            while ($TL = @mysqli_fetch_array($rs_vitri)) {
                            ?>
                                <option value="<?php echo $TL["MaViTri"] ?>"><?php echo $TL["TenViTri"] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label> Địa Chỉ </label>
                        <input type="text" name="sua_diachinh" value="<?php echo $row['DiaChi'] ?>" class="form-control" placeholder="Nhập Địa Chỉ">
                    </div>
                    <div class="form-group">
                    <label>Ảnh </label><br>
                        <img id="previewImg" src="img/nha-hang/<?php echo $row['Anh']; ?>">
                    </div>
                    <div class="form-group">

                        <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" name="Anh" accept="image/*" onchange="previewImage()" id="file" class="custom-file-input" aria-describedby="inputGroupFileAddon01">
                            <label class="custom-file-label" for="inputGroupFile01">Chọn file</label>
                        </div>   
                    </div>
                    
                    </div>
                    <div class="form-group">
                        <label> Số Điện Thoại </label>
                        <input type="number" name="sua_sdtnh" value="<?php echo $row['SDT'] ?>" class="form-control" placeholder="Nhập SDT">
                    </div>
                    <div class="form-group">
                        <label> Giới Thiệu </label>
                        <textarea rows="5" name="sua_gtnh" value="<?php echo $row['GioiThieuNH'] ?>" class="form-control" placeholder="Nhập Giới Thiệu"></textarea>
                    </div>
                    <div class="form-group">
                        <label> Giá Trẻ Em </label>
                        <input type="number" name="sua_giatreem" value="<?php echo $row['GiaTreEm'] ?>" class="form-control" placeholder="Nhập Giá">
                    </div>
                    <div class="form-group">
                        <label> Giá Người Lớn </label>
                        <input type="number" name="sua_gianguoilon" value="<?php echo $row['GiaNguoiLon'] ?>" class="form-control" placeholder="Nhập Giá">
                    </div>
                    <div class="form-group">
                        <label> Mô Tả Thực Đơn </label>
                        <input type="text" name="sua_thucdon" value="<?php echo $row['MoTaThucDon'] ?>" class="form-control" placeholder="Nhập Thực Đơn">
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