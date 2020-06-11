<?php
    include('security.php');
    include('includes/header.php');
    include('includes/navbar.php');
?>

<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Sửa Nhân Viên
    <a href="danh-sach-nhan-vien.php">
              <button type="button" class="btn btn-success">Danh Sách Nhân Viên</button>
            </a>
    </h6>
  </div>
    
  <div class="card-body">
    <?php
        if(isset($_POST['edit_btn']))
        {
            $manv = $_POST['edit_MaNV'];
            $query = "SELECT * FROM nhanvien WHERE MaNV ='$manv'";
            $query_run = mysqli_query($connection, $query);

            foreach($query_run as $row)
            {
    ?>
                <form action="code.php" method="POST">
                <div class="form-group">
                        <label> Mã Nhân Viên </label>
                        <input type="text" name="sua_manv" value="<?php echo $row['MaNV'] ?>" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label> Tên Nhân Viên </label>
                        <input type="text" name="sua_tennv" value="<?php echo $row['TenNV'] ?>" class="form-control" placeholder="Enter Tên Nhân Viên">
                    </div>
                    <div class="form-group">
                        <label> Ngày Sinh </label>
                        <input type="date" name="sua_ngaysinh" value="<?php echo $row['NgaySinh'] ?>" class="form-control" placeholder="Enter Ngày Sinh">
                    </div>
                    <div class="form-group">
                        <label>Giới Tính </label>
                        <input type="text" name="sua_gioitinh" value="<?php echo $row['GioiTinh'] ?>" class="form-control" placeholder="Enter Giới Tính">
                    </div>
                    <div class="form-group">
                        <label>Địa Chỉ </label>
                        <input type="text" name="sua_diachi" value="<?php echo $row['DiaChi'] ?>" class="form-control" placeholder="Enter Địa Chỉ">
                    </div>
                    <div class="form-group">
                        <label>Điện Thoại </label>
                        <input type="number" name="sua_dienthoai" value="<?php echo $row['SDT'] ?>" class="form-control" placeholder="Enter Điện Thoại">
                    </div>
                    <div class="form-group">
                        <label>Ảnh </label>
                        <input type="text" name="sua_anh" value="<?php echo $row['Anh'] ?>" class="form-control" placeholder="Enter Ảnh Nhân Viên">
                    </div>
                    <div class="form-group">
                        <label>Quyền </label>
                        <input type="text" name="sua_quyen" value="<?php echo $row['Quyen'] ?>" class="form-control" placeholder="Enter Quyền Nhân Viên">
                    </div>

                    <a href="danh-sach-nhan-vien.php" class="btn btn-danger">Cancel</a>
                    <button type="submit" name="btn_capnhat_nv" class="btn btn-primary">Cập Nhật</button>
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