<?php
include 'security.php';
include 'includes/header.php';
include 'includes/navbar.php';
?>

<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Sửa Hướng Dẫn Viên
    <a href="danh-sach-huong-dan-vien.php">
              <button type="button" class="btn btn-success">Danh Sách Hướng Dẫn Viên</button>
            </a>
    </h6>
  </div>

  <div class="card-body">
    <?php

if (isset($_POST['edit_btn'])) {
    $mahdv = $_POST['edit_MaHDV'];
    $query = "SELECT * FROM huongdanvien WHERE MaHDV='$mahdv'";
    $query_run = mysqli_query($connection, $query);

    foreach ($query_run as $row) {
        ?>
                <form action="code.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Mã Hướng Dẫn Viên</label>
                        <input type="text" name="sua_mahdv" value="<?php echo $row['MaHDV'] ?>"  class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label> Tên Hướng Dẫn Viên </label>
                        <input type="text" name="sua_tenhdv"  value="<?php echo $row['TenHDV'] ?>" class="form-control" placeholder="Nhập Tên Hướng Dẫn Viên">
                    </div>
                    <div class="form-group">
                        <label> Ngày Sinh </label>
                        <input type="text" name="sua_ngaysinh"  value="<?php echo $row['NgaySinh'] ?>" class="form-control" placeholder="Nhập Ngày Sinh">
                    </div>
                    <div class="form-group">
                        <label> Địa Chỉ  </label>
                        <input type="text" name="sua_diachi"  value="<?php echo $row['DiaChi'] ?>" class="form-control" placeholder="Nhập Địa Chỉ">
                    </div>
                    <div class="form-group">
                        <label>Giới Tính</label>
                        <input type="text" name="sua_gioitinh" value="<?php echo $row['GioiTinh'] ?>" class="form-control" placeholder="Nhập Giới Tính">
                    </div>
                    <div class="form-group">
                        <label>Điện Thoại</label>
                        <input type="number" name="sua_sdt" value="<?php echo $row['SDT'] ?>" class="form-control" placeholder="Nhập SĐT">
                    </div>
                    <div class="form-group">
                    <label>Ảnh </label><br>
                        <img id="previewImg" src="img/huong-dan-vien/<?php echo $row['Anh']; ?>" style="width:100px;height:100px">
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

                    <a href="danh-sach-huong-dan-vien.php" class="btn btn-danger">Huỷ</a>
                    <button type="submit" name="btn_capnhat_hdv" class="btn btn-primary">Cập Nhật</button>
                </form>

                <?php
}
}

?>

  </div>
</div>


<?php
include 'includes/footer.php';
include 'includes/scripts.php';
?>