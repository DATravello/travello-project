<?php
    include('security.php');
    include('includes/header.php');
    include('includes/navbar.php');
?>

<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Sửa Thương Hiệu
    <a href="danh-sach-thuong-hieu-ks.php">
              <button type="button" class="btn btn-success">Danh Sách Thương Hiệu</button>
            </a>
    </h6>
  </div>
    
  <div class="card-body">
    <?php
        $connection = mysqli_connect("localhost","root","","travello_db");
        if(isset($_POST['edit_btn']))
        {
            $mathks = $_POST['sua_mathuonghieu'];
            $query = "SELECT * FROM thuonghieuks WHERE MaThuongHieuKS ='$mathks'";
            $query_run = mysqli_query($connection, $query);
            foreach($query_run as $row)
            {
    ?>
                <form action="code.php" method="POST" enctype="multipart/form-data">
                     <div class="form-group">
                        <label> Mã Thương Hiệu </label>
                        <input type="text" name="sua_mathks"  value="<?php echo $row['MaThuongHieuKS'] ?>" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label> Loại Khách Sạn</label>
                        <select class="form-control"  name="sua_maloaiks">
                        <?php
                        $q_lks = "SELECT * FROM loaikhachsan";
                        $rs_lks = mysqli_query($connection, $q_lks);
                        while ($TL = @mysqli_fetch_array($rs_lks)) {
                        ?>
                            <option value="<?php echo $TL["MaLoaiKS"] ?>"><?php echo $TL["TenLoaiKS"] ?></option>
                        <?php
                        }
                        ?>
                    </select>
                    </div>
                    <div class="form-group">
                        <label> Tên Thương Hiệu </label>
                        <input type="text" name="sua_tenthks"  value="<?php echo $row['TenThuongHieuKS'] ?>" class="form-control" placeholder="Enter Tên Thương Hiệu">
                    </div>
                    <div class="form-group">
                        <label> Mô Tả </label>
                        <input type="text" name="sua_mota"  value="<?php echo $row['MoTa'] ?>" class="form-control" placeholder="Enter Mô Tả">
                    </div>
                    <div class="form-group">
                        <label>Hình Ảnh </label>
                        <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" name="HinhAnh" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                            <label class="custom-file-label" for="inputGroupFile01">Chọn file</label>
                        </div>
                        </div>
                    </div>
                    <a href="danh-sach-thuong-hieu-ks.php" class="btn btn-danger">Huỷ Bỏ</a>
                    <button type="submit" name="btn_capnhat_thuonghieu" class="btn btn-primary">Lưu</button>
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