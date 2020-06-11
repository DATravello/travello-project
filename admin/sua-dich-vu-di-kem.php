<?php
    include('security.php');
    include('includes/header.php');
    include('includes/navbar.php');
?>

<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Sửa Dịch Vụ
    <a href="danh-sach-dich-vu-di-kem.php">
              <button type="button" class="btn btn-success">Danh Sách Dịch Vụ Đi Kèm</button>
            </a>
    </h6>
  </div>
    
  <div class="card-body">
    <?php
        $connection = mysqli_connect("localhost","root","","travello_db");
        if(isset($_POST['edit_btn']))
        {
            $madv = $_POST['sua_madv'];
            $query = "SELECT * FROM dichvudikem WHERE MaDV ='$madv'";
            $query_run = mysqli_query($connection, $query);
            foreach($query_run as $row)
            {
    ?>
                <form action="code.php" method="POST">
                <div class="form-group">
                        <label> Mã Dịch Vụ </label>
                        <input type="text" name="sua_madv"  value="<?php echo $row['MaDV'] ?>" class="form-control" placeholder="Enter MaDV" readonly>
                    </div>
                    <div class="form-group">
                        <label> Tên Dịch Vụ </label>
                        <input type="text" name="sua_tendv"  value="<?php echo $row['TenDV'] ?>" class="form-control" placeholder="Enter TenDV">
                    </div>
                    <div class="form-group">
                        <label> Giá Dịch Vụ </label>
                        <input type="number" name="sua_giadv"  value="<?php echo $row['GiaDichVu'] ?>" class="form-control" placeholder="Enter GiaDV">
                    </div>
                    <div class="form-group">
                        <label>Ghi Chú </label>
                        <input type="text" name="sua_ghichu" value="<?php echo $row['GhiChu'] ?>" class="form-control" placeholder="Enter GhiChu">
                    </div>
                    <a href="danh-sach-dich-vu-di-kem.php" class="btn btn-danger">Cancel</a>
                    <button type="submit" name="btn_capnhat_dv" class="btn btn-primary">Update</button>
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