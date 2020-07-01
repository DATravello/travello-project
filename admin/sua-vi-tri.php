<?php
    include('security.php');
    include('includes/header.php');
    include('includes/navbar.php');
?>

<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Sửa Vị Trí
    <a href="danh-sach-vi-tri.php">
              <button type="button" class="btn btn-success">Danh Sách Vị Trí</button>
            </a>
    </h6>
  </div>
    
  <div class="card-body">
    <?php
        if(isset($_POST['edit_btn']))
        {
            $mavitri = $_POST['sua_mavt'];
            $query = "SELECT * FROM vitri WHERE MaViTri ='$mavitri'";
            $query_run = mysqli_query($connection, $query);

            foreach($query_run as $row)
            {
    ?>
                <form action="code.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                        <label> Mã Vị Trí </label>
                        <input type="text" name="sua_mavt" value="<?php echo $row['MaViTri'] ?>" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label> Tên Vị Trí </label>
                        <input type="text" name="sua_tenvt" value="<?php echo $row['TenViTri'] ?>" class="form-control" placeholder="Enter Tên Nhân Viên">
                    </div>
                    <div class="form-group">
                        <label>Mô Tả </label>
                        <input type="text" name="sua_mota" value="<?php echo $row['MoTa'] ?>" class="form-control" placeholder="Enter Mô Tả">
                    </div>
                    <div class="form-group">
                        <label>Ảnh </label>
                        <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" name="Anh" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                            <label class="custom-file-label" for="inputGroupFile01">Chọn file</label>
                        </div>
                    </div>
                    </div>
                    <a href="danh-sach-vi-tri.php" class="btn btn-danger">Cancel</a>
                    <button type="submit" name="btn_capnhat_vitri" class="btn btn-primary">Cập Nhật</button>
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