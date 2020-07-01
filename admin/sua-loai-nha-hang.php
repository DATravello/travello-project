<?php
    include('security.php');
    include('includes/header.php');
    include('includes/navbar.php');
?>

<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">SỬA LOẠI NHÀ HÀNG</h6>
  </div>
    
  <div class="card-body">
    <?php

        if(isset($_POST['edit_btn_MaLoaiNH']))
        {
            $id = $_POST['edit_MaLoaiNH'];
        
            $query = "SELECT * FROM loainhahang WHERE MaLoaiNH='$id'";
            $query_run = mysqli_query($connection, $query);
        
            foreach($query_run as $row)
            {
    ?>
                <form action="code.php" method="POST">
                    <div class="form-group">
                        <label>Mã Loại Nhà Hàng</label>
                        <input type="text" name="sua_maloai" value="<?php echo $row['MaLoaiNH'] ?>"  class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label> Tên Loại Nhà Hàng </label>
                        <input type="text" name="sua_tenloai"  value="<?php echo $row['TenLoaiNH'] ?>" class="form-control" placeholder="Nhập Tên Loại Nhà Hàng">
                    </div>


                    <a href="danh-sach-loai-knha-hang.php" class="btn btn-danger">Huỷ</a>
                    <button type="submit" name="btn_update_loainh" class="btn btn-primary">Cập Nhật</button>
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