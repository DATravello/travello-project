<?php
    include('security.php');
    include('includes/header.php');
    include('includes/navbar.php');
?>
<div class="container-fluid">

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Thêm Khách Sạn
            <a href="danh-sach-khach-san.php">
              <button type="button" class="btn btn-success">Danh Sách Khách Sạn</button>
            </a>
            </h6>
        </div>
        <?php
           

            if(isset($_SESSION['success']) && $_SESSION['success'] !='')
            {
                echo    '<div class="btn btn-success btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-check"></i>
                        </span>
                        <span class="text">
                        '.$_SESSION['success'].'
                        </span>
                        </div>';
                unset($_SESSION['success']);
            }

            if(isset($_SESSION['status']) && $_SESSION['status'] !='')
            {
                echo '<div class="btn btn-warning btn-icon-split">
                     <span class="icon text-white-50">
                        <i class="fas fa-exclamation-triangle"></i>
                     </span>
                     <span class="text">
                        '.$_SESSION['status'].'
                     </span>
                     </div>';
                unset($_SESSION['status']);
            }
        ?>
        <form action="code.php" method="POST" enctype="multipart/form-data">

        <div class="modal-body">

            <div class="form-group">
                <label>Tên Thương Hiệu</label>
                <select class="form-control" name="ThuongHieu">
                        <?php
                        $q_thuonghieu = "SELECT * FROM thuonghieuks";
                        $rs_thuonghieu = mysqli_query($connection, $q_thuonghieu);
                        while ($TL = @mysqli_fetch_array($rs_thuonghieu)) {
                        ?>
                            <option value="<?php echo $TL["MaThuongHieuKS"] ?>"><?php echo $TL["TenThuongHieuKS"] ?></option>
                        <?php
                        }
                        ?>
                </select>
            </div>
            <div class="form-group">
                <label> Tên Khách Sạn </label>
                <input type="text" name="TenKS" class="form-control" placeholder="Nhập Tên Khách Sạn">
            </div>
            <div class="form-group">
                <label> Hạng Sao </label>
                <input type="text" name="HangSao" class="form-control" placeholder="Nhập Hạng Sao">
            </div>
            <div class="form-group">
                <label>Vị Trí</label>
                <select class="form-control" name="ViTri">
                        <?php
                        $q_vitri = "SELECT * FROM vitri";
                        $rs_vitri = mysqli_query($connection, $q_vitri);
                        while ($VT = @mysqli_fetch_array($rs_vitri)) {
                        ?>
                            <option value="<?php echo $VT["MaViTri"] ?>"><?php echo $VT["TenViTri"] ?></option>
                        <?php
                        }
                        ?>
                        <!-- </div> -->
                </select>
            </div>
            <div class="form-group">
                <label> Địa Chỉ </label>
                <input type="text" name="DiaChi" class="form-control" placeholder="Địa Chỉ">
            </div>
            <div class="form-group">
                <label> Điện Thoại </label>
                <input type="number" name="DienThoai" class="form-control" placeholder="Nhập SDT">
            </div>
            <div class="form-group">
                <label>Loại Phòng</label>
                <select class="form-control"  name="LoaiPhong">
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
                <label> Số Phòng</label>
                <input type="number" name="SoPhong" class="form-control" placeholder="Nhập Số Phòng">
            </div>
            <div class="form-group">
                <label> WebSite </label>
                <input type="text" name="WebSite" class="form-control" placeholder="Nhập Link WebSite">
            </div>
            <div class="form-group">
                <label> Mô Tả </label>
                <textarea rows="5" name="MoTa" class="form-control" placeholder="Nhập Mô Tả Khách Sạn"></textarea>
            </div>
            <div class="form-group">
                <label> Mô Tả Loại Phòng </label>
                <textarea rows="5" name="MoTaLoaiPhong" class="form-control" placeholder="Nhập Mô Tả Loại Phòng"></textarea>
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
                            <input type="file" name="Anh" accept="image/*" onchange="previewImage()" id="file" class="custom-file-input" aria-describedby="inputGroupFileAddon01">
                            <label class="custom-file-label" for="inputGroupFile01">Chọn file</label>
                        </div>   
                    </div>
                    <div class="form-group">
                    <label>Ảnh Loai Phong</label><br>
                        <img id="previewImg" src="img/default.png">
                    </div>
                    <div class="form-group">

                        <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" name="AnhLoaiPhong" accept="image/*" onchange="previewImage()" id="file" class="custom-file-input" aria-describedby="inputGroupFileAddon01">
                            <label class="custom-file-label" for="inputGroupFile01">Chọn file</label>
                        </div>   
                    </div>
            <div class="form-group">
                <label> Giá </label>
                <input type="number" name="Gia" class="form-control" placeholder="Nhập Giá Phòng">
            </div>
        </div>

        <div class="modal-footer">
            <button type="reset" value="reset" class="btn btn-warning" data-dismiss="modal">Xoá Trường</button>
            <button type="submit" name="btn_them_khach_san" class="btn btn-primary">Lưu</button>
        </div>

        </form>
    </div>

</div>
<?php
    include('includes/scripts.php');
    include('includes/footer.php');
?>