<?php
    include('security.php');
    include('includes/header.php');
    include('includes/navbar.php');
?>
<div class="container-fluid">

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Thêm Phương Tiện
            <a href="danh-sach-phuong-tien.php">
              <button type="button" class="btn btn-success">Danh Sách Phương Tiện</button>
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
                <label> Tên Phương Tiện </label>
                <input type="text" name="PhuongTien" class="form-control" placeholder="Nhập Tên Phương Tiện">
            </div>
            <div class="form-group">
                <label> Nơi Đi </label>
                <input type="text" name="NoiDi" class="form-control" placeholder="Nhập Nơi Đi">
            </div>
            <div class="form-group">
                <label> Nơi Đến </label>
                <input type="text" name="NoiDen" class="form-control" placeholder="Nhập Nơi Đến">
            </div>
            <div class="form-group">
                <label> Giá </label>
                <!-- <input type="file" name="images" id="images" class="form-control" onchange="document.getElementById('preview').src = window.URL.createObjectURL(this.files[0])"> -->
                <input type="number" name="Gia" class="form-control" placeholder="Nhập Giá Phương Tiện">
            </div>
        </div>

        <div class="modal-footer">
            <button type="reset" value="reset" class="btn btn-warning" data-dismiss="modal">Xoá Trường</button>
            <button type="submit" name="btn_them_phuong_tien" class="btn btn-primary">Lưu</button>
        </div>

        </form>
    </div>

</div>
<?php
    include('includes/scripts.php');
    include('includes/footer.php');
?>