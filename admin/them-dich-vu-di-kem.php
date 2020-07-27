<?php
    include('security.php');
    include('includes/header.php');
    include('includes/navbar.php');
?>
<div class="container-fluid">

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Thêm Dịch Vụ
            <a href="danh-sach-dich-vu-di-kem.php">
              <button type="button" class="btn btn-success">Danh Sách Dịch Vụ</button>
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
                <label> Tên Dịch Vụ </label>
                <input type="text" name="TenDV" class="form-control" placeholder="Nhập Tên Dịch Vụ">
            </div>
            <div class="form-group">
                <label> Giá Dịch Vụ </label>
                <input type="number" name="GiaDichVu" class="form-control" placeholder="Nhập Giá">
            </div>
            <div class="form-group">
                <label> Ghi Chú </label>
                <input type="text" name="GhiChu" class="form-control" placeholder="Nhập Ghi Chú">
            </div>
        </div>

        <div class="modal-footer">
            <button type="reset" value="reset" class="btn btn-warning" data-dismiss="modal">Xoá Trường</button>
            <button type="submit" name="btn_them_dich_vu" class="btn btn-primary">Lưu</button>
        </div>

        </form>
    </div>

</div>
<?php
    include('includes/scripts.php');
    include('includes/footer.php');
?>