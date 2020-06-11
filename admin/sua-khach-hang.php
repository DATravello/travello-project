<?php
include('security.php');
    include('includes/header.php');
    include('includes/navbar.php');
?>

<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Sửa Khách Hàng
    <a href="danh-sach-khach-hang.php">
              <button type="button" class="btn btn-success">Danh Sách Khách Hàng</button>
            </a>
    </h6>
  </div>
    
  <div class="card-body">
    <?php

        if(isset($_POST['edit_btn']))
        {
            $makh = $_POST['edit_MaKH'];
            $query = "SELECT * FROM khachhang WHERE MaKH='$makh'";
            $query_run = mysqli_query($connection, $query);
        
            foreach($query_run as $row)
            {
    ?>
                <form action="code.php" method="POST">
                    <div class="form-group">
                        <label>Mã Khách Hàng</label>
                        <input type="text" name="sua_makh" value="<?php echo $row['MaKH'] ?>"  class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label> Tên Khách Hàng </label>
                        <input type="text" name="sua_tenkh"  value="<?php echo $row['TenKH'] ?>" class="form-control" placeholder="Nhập Tên Khách Hàng">
                    </div>
                    <div class="form-group">
                        <label> Địa Chỉ </label>
                        <input type="text" name="sua_diachi"  value="<?php echo $row['DiaChi'] ?>" class="form-control" placeholder="Nhập Địa Chỉ Khách Hàng">
                    </div>
                    <div class="form-group">
                        <label> Giới Tính </label>
                        <input type="text" name="sua_gioitinh"  value="<?php echo $row['GioiTinh'] ?>" class="form-control" placeholder="Nhập Giới Tính">
                    </div>
                    <div class="form-group">
                        <label>Điện Thoại</label>
                        <input type="number" name="sua_sdt" value="<?php echo $row['SDT'] ?>" class="form-control" placeholder="Nhập Điện Thoại">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="sua_email" value="<?php echo $row['Email'] ?>" class="form-control" placeholder="Nhập Email">
                    </div>

                    <a href="danh-sach-khach-hang.php" class="btn btn-danger">Huỷ</a>
                    <button type="submit" name="btn_capnhat_kh" class="btn btn-primary">Cập Nhật</button>
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