<?php
    include('security.php');
    include('includes/header.php');
    include('includes/navbar.php');
?>

<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Sửa Phương Tiện
    <a href="danh-sach-phuong-tien.php">
              <button type="button" class="btn btn-success">Danh Sách Phương Tiện</button>
            </a>
    </h6>
  </div>
    
  <div class="card-body">
    <?php
        $connection = mysqli_connect("localhost","root","","travello_db");
        if(isset($_POST['edit_btn']))
        {
            $mapt = $_POST['sua_MaPhuongTien'];
            $query = "SELECT * FROM phuongtien WHERE MaPhuongTien ='$mapt'";
            $query_run = mysqli_query($connection, $query);
            foreach($query_run as $row)
            {
    ?>
                <form action="code.php" method="POST">
                <div class="form-group">
                        <label> Mã Phương Tiện </label>
                        <input type="text" name="sua_MaPhuongTien"  value="<?php echo $row['MaPhuongTien'] ?>" class="form-control" placeholder="Enter Ma Phuong Tien" readonly>
                    </div>
                    <div class="form-group">
                        <label> Tên Phương Tiện </label>
                        <input type="text" name="sua_tenphuongtien"  value="<?php echo $row['PhuongTien'] ?>" class="form-control" placeholder="Enter Ten Phuong Tien">
                    </div>
                    <div class="form-group">
                        <label> Nơi Đi </label>
                        <input type="text" name="sua_noidi"  value="<?php echo $row['NoiDi'] ?>" class="form-control" placeholder="Enter Noi Di">
                    </div>
                    <div class="form-group">
                        <label> Nơi Đến </label>
                        <input type="text" name="sua_noiden"  value="<?php echo $row['NoiDen'] ?>" class="form-control" placeholder="Enter Noi Den">
                    </div>
                    <div class="form-group">
                        <label>Giá </label>
                        <input type="number" name="sua_gia" value="<?php echo $row['Gia'] ?>" class="form-control" placeholder="Enter Gia">
                    </div>
                    <a href="danh-sach-phuong-tien.php" class="btn btn-danger">Cancel</a>
                    <button type="submit" name="btn_capnhat_pt" class="btn btn-primary">Update</button>
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