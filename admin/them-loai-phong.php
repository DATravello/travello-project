<?php
    include('security.php');
    include('includes/header.php');
    include('includes/navbar.php');
?>
<div class="container-fluid">

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Thêm Loại Phòng
            <a href="danh-sach-loai-phong.php">
              <button type="button" class="btn btn-success">Danh Sách Loại Phòng</button>
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
                <label> Tên Loại Phòng </label>
                <input type="text" name="TenLoaiPhong" class="form-control" placeholder="Nhập Tên Loại Phòng">
            </div>
            <div class="form-group">
                <label> Giá Loại Phòng </label>
                <input type="text" name="Gia" class="form-control" placeholder="Nhập Giá Loại Phòng">
            </div>
            <div class="form-group">
                <label> Số Lượng Phòng </label>
                <input type="text" name="SoLuongPhong" class="form-control" placeholder="Nhập Số Lượng Loại Phòng">
            </div>
            
        </div>

        <div class="modal-footer">
            <button type="reset" value="reset" class="btn btn-warning" data-dismiss="modal">Xoá Trường</button>
            <button type="submit" name="btn_them_loai_phong" class="btn btn-primary">Lưu</button>
        </div>

        </form>
    </div>

</div>
<?php
    include('includes/scripts.php');
    include('includes/footer.php');
?>