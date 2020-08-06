<?php
include('security.php');
include('includes/header.php');
include('includes/navbar.php');
?>
<div class="container-fluid">

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Thêm Hướng Dẫn Viên
                <a href="danh-sach-huong-dan-vien.php">
                    <button type="button" class="btn btn-success">Danh Sách Hướng Dẫn Viên</button>
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
                    <label> Tên Hướng Dẫn Viên</label>
                    <input type="text" name="TenHDV" class="form-control" placeholder="Nhập Tên Hướng Dẫn Viên">
                </div>

                <div class="form-group">
                    <label> Ngày Sinh </label>
                    <input type="Date" name="NgaySinh" class="form-control" placeholder="Chọn Ngày Sinh">
                </div>

                <div class="form-group">
                    <label>Ảnh </label><br>
                        <img id="previewImg" src="img/phuong-tien/<?php echo $row['Anh']; ?>">
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
                
                <div class="form-group">
                    <label> Địa Chỉ </label>
                    <input type="text" name="DiaChi" class="form-control" placeholder="Nhập Địa Chỉ">
                </div>

                <div class="form-group">
                    <label> Giới Tính </label>
                    <input type="text" name="GioiTinh" class="form-control" placeholder="Nhập Giới Tính">
                </div>
                
                <div class="form-group">
                    <label> Số Điện Thoại </label>
                    <input type="number" name="SDT" class="form-control" placeholder="Nhập Số Điện Thoại">
                </div>
            </div>

            <div class="modal-footer">
                <button type="reset" value="reset" class="btn btn-warning" data-dismiss="modal">Xoá Trường</button>
                <button type="submit" name="btn_them_hdv" class="btn btn-primary">Lưu</button>
            </div>

        </form>
    </div>

</div>
<?php
include('includes/scripts.php');
include('includes/footer.php');
?>