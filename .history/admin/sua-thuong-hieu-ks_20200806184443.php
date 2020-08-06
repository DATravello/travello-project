<?php
include('security.php');
include('includes/header.php');
include('includes/navbar.php');
?>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Sửa Thương Hiệu
            <a href="danh-sach-thuong-hieu-ks.php">
                <button type="button" class="btn btn-success">Danh Sách Thương Hiệu</button>
            </a>
        </h6>
    </div>

    <div class="card-body">
        <?php
        if (isset($_POST['edit_btn'])) {
            $mathks = $_POST["sua_mathuonghieu"];
            $query = "SELECT * FROM thuonghieuks WHERE MaThuongHieuKS='$mathks'";
            $query_run = mysqli_query($connection, $query);
            foreach ($query_run as $row) {
        ?>
                <form action="code.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label> Mã Thương Hiệu </label>
                        <input type="text" name="sua_mathks" value="<?php echo $row['MaThuongHieuKS']; ?>" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label> Loại Khách Sạn</label>
                        <select class="form-control" name="sua_maloaiks">
                            <?php
                            $q_lks = "SELECT * FROM loaikhachsan";
                            $rs_lks = mysqli_query($connection, $q_lks);
                            while ($TL = @mysqli_fetch_array($rs_lks)) {
                            ?>
                                <option value="<?php echo $TL["MaLoaiKS"] ?>"><?php echo $TL["TenLoaiKS"] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label> Tên Thương Hiệu </label>
                        <input type="text" name="sua_tenthks" value="<?php echo $row['TenThuongHieuKS'] ?>" class="form-control" placeholder="Nhập Tên Thương Hiệu">
                    </div>
                    <div class="form-group">
                        <label> Mô Tả </label>
                        <textarea rows="5" name="sua_mota" class="form-control" placeholder="Nhập Mô Tả"><?php echo $row['MoTa'] ?></textarea>
                    </div>
                    <div class="form-group">
                    <label>Ảnh </label><br>
                        <img id="previewImg" src="img/thuong-hieu-ks/<?php echo $row['HinhAnh']; ?>">
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
                    <a href="danh-sach-thuong-hieu-ks.php" class="btn btn-danger">Huỷ Bỏ</a>
                    <button type="submit" name="btn_update_thks" class="btn btn-primary">Lưu</button>
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