<?php
include('security.php');
include('includes/header.php');
include('includes/navbar.php');
?>
<div class="container-fluid">

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Thêm Tour Du Lịch
                <a href="danh-sach-tour-du-lich.php">
                    <button type="button" class="btn btn-success">Danh Sách Tour Du Lịch</button>
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
                    <label> Loại Tour Du Lịch </label>
                    <select class="form-control"  name="loaitour">
                        <!-- <div class="form-group" name="LoaiTin"> -->
                        <?php
                        $q_loaitour = "SELECT * FROM loaitourdulich";
                        $rs_loaitour = mysqli_query($connection, $q_loaitour);
                        while ($TL = @mysqli_fetch_array($rs_loaitour)) {
                        ?>
                            <option value="<?php echo $TL["MaLoaiTour"] ?>"><?php echo $TL["TenLoaiTour"] ?></option>
                        <?php
                        }
                        ?>
                        <!-- </div> -->
                    </select>
                </div>
                <div class="form-group">
                    <label> Tên Tour </label>
                    <input type="text" name="TenTour" class="form-control" placeholder="Nhập Tên Tour Du Lịch">
                </div>
                <div class="form-group">
                    <label> Nơi Khởi Hành </label>
                    <input type="text" name="NoiKhoiHanh" class="form-control" placeholder="Nhập Nơi Khởi Hàng">
                </div>
                <div class="form-group">
                    <label> Nơi Đến </label>
                    <input type="text" name="NoiDen" class="form-control" placeholder="Nhập Nơi Đến">
                </div>
                <div class="form-group">
                    <label> Ngày Đi </label>
                    <!-- <input type="file" name="images" id="images" class="form-control" onchange="document.getElementById('preview').src = window.URL.createObjectURL(this.files[0])"> -->
                    <input type="date" name="ThoiGian" class="form-control" placeholder="Chọn Ngày">
                </div>
                <div class="form-group">
                    <label> Hướng Dẫn Viên </label>
                    <select class="form-control"  name="HuongDanVien">
                        <!-- <div class="form-group" name="LoaiTin"> -->
                        <?php
                        $q_hdv = "SELECT * FROM huongdanvien";
                        $rs_hdv = mysqli_query($connection, $q_hdv);
                        while ($TL = @mysqli_fetch_array($rs_hdv)) {
                        ?>
                            <option value="<?php echo $TL["MaHDV"] ?>"><?php echo $TL["TenHDV"] ?></option>
                        <?php
                        }
                        ?>
                        <!-- </div> -->
                    </select>
                </div>
                <div class="form-group">
                    <label> Khách Sạn </label>
                    <select class="form-control"  name="KhachSan">
                        <!-- <div class="form-group" name="LoaiTin"> -->
                        <?php
                        $q_ks = "SELECT * FROM khachsan";
                        $rs_ks = mysqli_query($connection, $q_ks);
                        while ($TL = @mysqli_fetch_array($rs_ks)) {
                        ?>
                            <option value="<?php echo $TL["MaKS"] ?>"><?php echo $TL["TenKS"] ?></option>
                        <?php
                        }
                        ?>
                        <!-- </div> -->
                    </select>
                </div>
                <div class="form-group">
                    <label> Nhà Hàng </label>
                    <select class="form-control"  name="NhaHang">
                        <!-- <div class="form-group" name="LoaiTin"> -->
                        <?php
                        $q_nh = "SELECT * FROM nhahang";
                        $rs_nh = mysqli_query($connection, $q_nh);
                        while ($TL = @mysqli_fetch_array($rs_nh)) {
                        ?>
                            <option value="<?php echo $TL["MaNH"] ?>"><?php echo $TL["TenNhaHang"] ?></option>
                        <?php
                        }
                        ?>
                        <!-- </div> -->
                    </select>
                </div>
                <div class="form-group">
                    <label> Dịch Vụ Đi Kèm </label>
                    <select class="form-control"  name="DichVu">
                        <!-- <div class="form-group" name="LoaiTin"> -->
                        <?php
                        $q_dv = "SELECT * FROM dichvudikem";
                        $rs_dv = mysqli_query($connection, $q_dv);
                        while ($TL = @mysqli_fetch_array($rs_dv)) {
                        ?>
                            <option value="<?php echo $TL["MaDV"] ?>"><?php echo $TL["TenDV"] ?></option>
                        <?php
                        }
                        ?>
                        <!-- </div> -->
                    </select>
                </div>
                <div class="form-group">
                    <label> Phương Tiện </label>
                    <select class="form-control"  name="PhuongTien">
                        <!-- <div class="form-group" name="LoaiTin"> -->
                        <?php
                        $q_pt = "SELECT * FROM phuongtien";
                        $rs_pt = mysqli_query($connection, $q_pt);
                        while ($TL = @mysqli_fetch_array($rs_pt)) {
                        ?>
                            <option value="<?php echo $TL["MaPhuongTien"] ?>"><?php echo $TL["PhuongTien"] ?></option>
                        <?php
                        }
                        ?>
                        <!-- </div> -->
                    </select>
                </div>
                
                <div class="form-group">
                    <label> Giá Tiền (VNĐ) </label>
                    <input type="number" name="GiaTien" class="form-control" placeholder="Nhập Giá Tiền">
                </div>
                <div class="form-group">
                    <label> Giá Trẻ Em (VNĐ) </label>
                    <input type="number" name="GiaTreEm" class="form-control" placeholder="Nhập Giá Trẻ Em">
                </div>
                <div class="form-group">
                    <label> Hành Trình </label>
                    <input type="text" name="HanhTrinh" class="form-control" placeholder="Nhập Hành Trình">
                </div>
                <div class="form-group">
                    <label> Số Ngày </label>
                    <input type="number" name="SoNgay" class="form-control" placeholder="Nhập Số Ngày">
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
            </div>

            <div class="modal-footer">
                <button type="reset" value="reset" class="btn btn-warning" data-dismiss="modal">Xoá Trường</button>
                <button type="submit" name="btn_them_tour" class="btn btn-primary">Lưu</button>
            </div>

        </form>
    </div>

</div>
<?php
include('includes/scripts.php');
include('includes/footer.php');
?>