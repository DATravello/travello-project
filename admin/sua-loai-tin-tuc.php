<?php
    include('security.php');
    include('includes/header.php');
    include('includes/navbar.php');
?>

<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Sửa Loại Tin Tức
    <a href="danh-sach-the-loai.php">
              <button type="button" class="btn btn-success">Danh Sách Thể Loại</button>
            </a>
    </h6>
  </div>
    
  <div class="card-body">
    <?php
        if(isset($_POST['edit_btn']))
        {
            $matl = $_POST['sua_matl'];
            $query = "SELECT * FROM theloai WHERE MaTheLoai ='$matl'";
            $query_run = mysqli_query($connection, $query);
            foreach($query_run as $row)
            {
    ?>
                <form action="code.php" method="POST">
                <div class="form-group">
                        <label> Mã Thể Loại </label>
                        <input type="text" name="sua_matl"  value="<?php echo $row['MaTheLoai'] ?>" class="form-control" placeholder="Enter MaTheLoai" readonly>
                    </div>
                    <div class="form-group">
                        <label> Tên Thể Loại </label>
                        <input type="text" name="sua_tentl"  value="<?php echo $row['TenTheLoai'] ?>" class="form-control" placeholder="Enter TenTheLoai">
                    </div>
                    <a href="danh-sach-the-loai.php" class="btn btn-danger">Cancel</a>
                    <button type="submit" name="btn_capnhat_tl" class="btn btn-primary">Update</button>
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