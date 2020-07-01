<?php
    include('security.php');
    include('includes/header.php');
    include('includes/navbar.php');
?>

<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">SỬA LOẠI KHÁCH SẠN</h6>
  </div>
    
  <div class="card-body">
    <?php

        if(isset($_POST['edit_btn_MaLoaiKS']))
        {
            $id = $_POST['edit_MaLoaiKS'];
        
            $query = "SELECT * FROM loaikhachsan WHERE MaLoaiKS='$id'";
            $query_run = mysqli_query($connection, $query);
        
            foreach($query_run as $row)
            {
    ?>
                <form action="code.php" method="POST">
                    <div class="form-group">
                        <label>Mã Loại</label>
                        <input type="text" name="sua_maloai" value="<?php echo $row['MaLoaiKS'] ?>"  class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label> Tên Loại Khách Sạn </label>
                        <input type="text" name="sua_tenloai"  value="<?php echo $row['TenLoaiKS'] ?>" class="form-control" placeholder="Nhập Tên Loại Khách Sạn">
                    </div>


                    <a href="danh-sach-loai-khach-san.php" class="btn btn-danger">Huỷ</a>
                    <button type="submit" name="btn_update_loaiks" class="btn btn-primary">Cập Nhật</button>
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