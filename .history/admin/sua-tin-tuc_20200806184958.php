<?php
    include('security.php');
    include('includes/header.php');
    include('includes/navbar.php');
?>

<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Sửa Tin Tức
    <a href="danh-sach-tin-tuc.php">
              <button type="button" class="btn btn-success">Danh Sách Tin Tức</button>
            </a>
    </h6>
  </div>
    
  <div class="card-body">
    <?php
        if(isset($_POST['edit_btn']))
        {
            $matt = $_POST['sua_matt'];
            $query = "SELECT * FROM tintuc WHERE MaTinTuc ='$matt'";
            $query_run = mysqli_query($connection, $query);
            foreach($query_run as $row)
            {
    ?>
                <form action="code.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label> Mã Tin Tức </label>
                        <input type="text" name="sua_matt"  value="<?php echo $row['MaTinTuc'] ?>" class="form-control" placeholder="Enter MaTinTuc" readonly>
                    </div>
                    <div class="form-group">
                        <label> Tên Loại Tin</label>
                        <select class="form-control"  name="sua_matheloai">
                        <?php
                        $q_theloai = "SELECT * FROM theloai";
                        $rs_theloai = mysqli_query($connection, $q_theloai);
                        while ($TL = @mysqli_fetch_array($rs_theloai)) {
                        ?>
                            <option value="<?php echo $TL["MaTheLoai"] ?>"><?php echo $TL["TenTheLoai"] ?></option>
                        <?php
                        }
                        ?>
                    </select>
                    </div>
                    <div class="form-group">
                        <label> Nhân Viên</label>
                        <select class="form-control"  name="sua_mannv">
                        <?php
                        $q_nv = "SELECT * FROM nhanvien";
                        $rs_nv= mysqli_query($connection, $q_nv);
                        while ($NV = @mysqli_fetch_array($rs_nv)) {
                        ?>
                            <option value="<?php echo $NV["MaNV"] ?>"><?php echo $NV["TenNV"] ?></option>
                        <?php
                        }
                        ?>
                    </select>
                    </div>
                    <div class="form-group">
                        <label> Tên Tin Tức </label>
                        <input type="text" name="sua_tentt"  value="<?php echo $row['TenTinTuc'] ?>" class="form-control" placeholder="Enter TenTinTuc">
                    </div>
                    <div class="form-group">
                        <label> Mô Tả </label>
                        <textarea name="sua_mota" rows="3" class="form-control"><?php echo $row['MoTa'] ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Chi Tiết </label>
                        <textarea name="sua_chitiet" rows="10" class="form-control"><?php echo $row['ChiTiet'] ?></textarea>
                    </div>
                    <div class="form-group">
                    <label>Ảnh </label><br>
                        <img id="previewImg" src="img/tin-tuc/<?php echo $row['HinhAnh']; ?>">
                    </div>
                    <div class="form-group">

                        <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" name="HinhAnh" accept="image/*" onchange="previewImage()" id="file" class="custom-file-input" aria-describedby="inputGroupFileAddon01">
                            <label class="custom-file-label" for="inputGroupFile01">Chọn file</label>
                        </div>   
                    </div>
                    
                    </div>
                    <div class="form-group">
                        <label>Tác Giả </label>
                        <input type="text" name="sua_tacgia" value="<?php echo $row['TaoBoi'] ?>" class="form-control" placeholder="Enter TaoBoi">
                    </div>
                    <div class="form-group">
                        <label>Ngày </label>
                        <input type="date" name="sua_ngay" value="<?php echo $row['Ngay'] ?>" class="form-control" placeholder="Enter Ngày">
                    </div>
                    <a href="danh-sach-tin-tuc.php" class="btn btn-danger">Cancel</a>
                    <button type="submit" name="btn_capnhat_tt" class="btn btn-primary">Update</button>
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