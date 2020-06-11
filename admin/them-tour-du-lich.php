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
        <form action="code.php" method="POST">

        <div class="modal-body">


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
                <label> Giá Tiền (VNĐ) </label>
                <input type="number" name="GiaTien" class="form-control" placeholder="Nhập Giá Tiền">
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
                <input type="text" name="Anh" class="form-control" placeholder="Chọn Hình Ảnh">
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