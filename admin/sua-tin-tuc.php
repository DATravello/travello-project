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
        $connection = mysqli_connect("localhost","root","","travello_db");
        if(isset($_POST['edit_btn']))
        {
            $matt = $_POST['sua_matt'];
            $query = "SELECT * FROM tintuc WHERE MaTinTuc ='$matt'";
            $query_run = mysqli_query($connection, $query);
            // $query1="SELECT * FROM theloai INNER JOIN tintuc ON theloai.MaTheLoai = tintuc.MaTheLoai";
            // $result1 = mysqli_query($connection, $query1);
            // $rows1=mysqli_fetch_array($result1);
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
                        <label> Tên Nhân Viên</label>
                        <select class="form-control"  name="sua_mannv">
                        <?php
                        $q_theloai = "SELECT * FROM nhanvien";
                        $rs_theloai = mysqli_query($connection, $q_theloai);
                        while ($TL = @mysqli_fetch_array($rs_theloai)) {
                        ?>
                            <option value="<?php echo $TL["MaNV"] ?>"><?php echo $TL["TenNV"] ?></option>
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
                        <input type="text" name="sua_mota"  value="<?php echo $row['MoTa'] ?>" class="form-control" placeholder="Enter MoTa">
                    </div>
                    <div class="form-group">
                        <label>Chi Tiết </label>
                        <input type="text" name="sua_chitiet" value="<?php echo $row['ChiTiet'] ?>" class="form-control" placeholder="Enter ChiTiet">
                    </div>
                    <div class="form-group">
                        <label>Hình Ảnh </label>
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
                    <div class="form-group">
                        <label>Ngày </label>
                        <input type="date" name="sua_ngay" value="<?php echo $row['Ngay'] ?>" class="form-control" placeholder="Enter Ngay">
                    </div>
                    <div class="form-group">
                        <label>Tác Giả </label>
                        <input type="text" name="sua_tacgia" value="<?php echo $row['TaoBoi'] ?>" class="form-control" placeholder="Enter TaoBoi">
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