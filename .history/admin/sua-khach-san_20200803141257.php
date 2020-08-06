<?php
include('security.php');
include('includes/header.php');
include('includes/navbar.php');
?>

<div class="container-fluid">

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Sửa Khách Sạn
                <a href="danh-sach-khach-san.php">
                    <button type="button" class="btn btn-success">Danh Sách Khách Sạn</button>
                </a>
            </h6>
        </div>

        <div class="card-body">
            <?php
            if (isset($_POST['edit_btn'])) {
                $maks = $_POST['sua_maks'];
                $query = "SELECT * FROM khachsan WHERE MaKS ='$maks'";
                $query_run = mysqli_query($connection, $query);
                foreach ($query_run as $row) {
            ?>
                    <form action="code.php" method="POST" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="form-group">
                                <label> Mã Khách Sạn </label>
                                <input type="text" name="sua_maks" value="<?php echo $row['MaKS'] ?>" class="form-control" placeholder="Nhập Mã Khách Sạn" readonly>
                            </div>
                            <div class="form-group">
                                <label> Tên Thương Hiệu</label>
                                <select class="form-control" name="sua_mathks" value="<?php echo $TL["TenThuongHieuKS"] ?>">
                                    <?php
                                    $q_thuonghieuks = "SELECT * FROM thuonghieuks";
                                    $rs_thuonghieuks = mysqli_query($connection, $q_thuonghieuks);
                                    while ($TL = @mysqli_fetch_array($rs_thuonghieuks)) {
                                    ?>
                                        <option value="<?php echo $TL["MaThuongHieuKS"] ?>"><?php echo $TL["TenThuongHieuKS"] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label> Vị Trí</label>
                                <select class="form-control" name="sua_vitri">
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
                                <label> Tên Khách Sạn </label>
                                <input type="text" name="sua_tenks" value="<?php echo $row['TenKS'] ?>" class="form-control" placeholder="Nhập Tên Khách Sạn">
                            </div>
                            <div class="form-group">
                                <label> Hạng Sao </label>
                                <input type="number" name="sua_hangsao" value="<?php echo $row['HangSao'] ?>" class="form-control" placeholder="Nhập Hạng Sao">
                            </div>
                            <div class="form-group">
                                <label>Địa Chỉ Khách Sạn </label>
                                <input type="text" name="sua_diachiks" value="<?php echo $row['DiaChi'] ?>" class="form-control" placeholder="Nhập Địa Chỉ">
                            </div>
                            <div class="form-group">
                                <label>Số Điện Thoại </label>
                                <input type="number" name="sua_sdtks" value="<?php echo $row['DienThoai'] ?>" class="form-control" placeholder="Nhập Điện Thoại">
                            </div>
                            <div class="form-group">
                                <label> Loại Phòng</label>
                                <select class="form-control" name="sua_loaiphong">
                                    <?php
                                    $q_loaiphong = "SELECT * FROM loaiphong";
                                    $rs_loaiphong = mysqli_query($connection, $q_loaiphong);
                                    while ($TL = @mysqli_fetch_array($rs_loaiphong)) {
                                    ?>
                                        <option value="<?php echo $TL["MaLoaiPhong"] ?>"><?php echo $TL["TenLoaiPhong"] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Số Phòng</label>
                                <input type="number" name="sua_sophong" value="<?php echo $row['SoPhong'] ?>" class="form-control" placeholder="Nhập Số Phòng">
                            </div>
                            <div class="form-group">
                                <label>WebSite </label>
                                <input type="text" name="sua_web" value="<?php echo $row['WebSite'] ?>" class="form-control" placeholder="Nhập WebSite">
                            </div>
                            <div class="form-group">
                                <label>Mô Tả Khách Sạn </label>
                                <textarea name="sua_mota" rows="5" value="<?php echo $row['MoTa'] ?>" class="form-control" placeholder="Nhập Mô Tả"><?php echo $row['MoTa'] ?></textarea>
                            </div>
                            <div class="form-group">
                                <label>Mô Tả Loại Phòng </label>
                                <textarea name="sua_motalp" rows="5" value="<?php echo $row['MoTaLoaiPhong'] ?>" class="form-control" placeholder="Nhập Mô Tả Loại Phòng"><?php echo $row['MoTaLoaiPhong'] ?></textarea>
                            </div>
                            <div class="form-group">
                                <label>Hình Ảnh </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" value="<?php echo $row['Anh'] ?>" name="Anh" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                                        <label class="custom-file-label" for="inputGroupFile01">Chọn file</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Hình Ảnh Loại Phòng </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                                        </div>
                                        <div class="custom-file">
                                            <input type="file" value="<?php echo $row['AnhLoaiPhong'] ?>" name="AnhLoaiPhong" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                                            <label class="custom-file-label" for="inputGroupFile01">Chọn file</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Giá </label>
                                        <input type="number" name="sua_gia" value="<?php echo $row['Gia'] ?>" class="form-control" placeholder="Nhập Giá Phòng">
                                    </div>
                                </div>
                                <a href="danh-sach-khach-san.php" class="btn btn-danger">Huỷ Bỏ</a>
                                <button type="submit" name="btn_capnhat_ks" class="btn btn-primary">Lưu</button>
                            </div>
                        </div>
                    </form>

            <?php
                }
            }

            ?>

        </div>
    </div>
</div>


<?php
include('includes/footer.php');
include('includes/scripts.php');
?>