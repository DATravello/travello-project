<?php
    include('security.php');
    include('includes/header.php');
    include('includes/navbar.php');
?>

<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Sửa Tour Du Lịch
    <a href="danh-sach-tour-du-lich.php">
              <button type="button" class="btn btn-success">Danh Sách Tour Du Lịch</button>
            </a>
    </h6>
  </div>
    
  <div class="card-body">
    <?php
        $connection = mysqli_connect("localhost","root","","travello_db");
        if(isset($_POST['edit_btn']))
        {
            $matour = $_POST['sua_matour'];
            $query = "SELECT * FROM tourdulich WHERE MaTour ='$matour'";
            $query_run = mysqli_query($connection, $query);
            foreach($query_run as $row)
            {
    ?>
                <form action="code.php" method="POST">
                <div class="form-group">
                        <label> Mã Tour </label>
                        <input type="text" name="sua_matour"  value="<?php echo $row['MaTour'] ?>" class="form-control" placeholder="Enter MaTour" readonly>
                    </div>
                    <div class="form-group">
                        <label> Tên Tour </label>
                        <input type="text" name="sua_tentour"  value="<?php echo $row['TenTour'] ?>" class="form-control" placeholder="Enter TenTour">
                    </div>
                    <div class="form-group">
                        <label> Nơi Khởi Hành </label>
                        <input type="text" name="sua_noikhoihanh"  value="<?php echo $row['NoiKhoiHanh'] ?>" class="form-control" placeholder="Enter NoiKhoiHanh">
                    </div>
                    <div class="form-group">
                        <label>Nơi Đến </label>
                        <input type="text" name="sua_noiden" value="<?php echo $row['NoiDen'] ?>" class="form-control" placeholder="Enter NoiDen">
                    </div>
                    <div class="form-group">
                        <label>Thời Gian </label>
                        <input type="date" name="sua_thoigian" value="<?php echo $row['ThoiGian'] ?>" class="form-control" placeholder="Enter ThoiGian">
                    </div>
                    <div class="form-group">
                        <label>Giá Tiền </label>
                        <input type="number" name="sua_giatien" value="<?php echo $row['GiaTien'] ?>" class="form-control" placeholder="Enter GiaTien">
                    </div>
                    <div class="form-group">
                        <label>Hành Trình </label>
                        <input type="text" name="sua_hanhtrinh" value="<?php echo $row['HanhTrinh'] ?>" class="form-control" placeholder="Enter HanhTrinh">
                    </div>
                    <div class="form-group">
                        <label>Số Ngày </label>
                        <input type="number" name="sua_songay" value="<?php echo $row['SoNgay'] ?>" class="form-control" placeholder="Enter SoNgay">
                    </div>
                    <div class="form-group">
                        <label>Ảnh </label>
                        <input type="text" name="sua_anh" value="<?php echo $row['Anh'] ?>" class="form-control" placeholder="Enter Anh">
                    </div>
                    <a href="danh-sach-tour-du-lich.php" class="btn btn-danger">Huỷ Bỏ</a>
                    <button type="submit" name="btn_capnhat_tour" class="btn btn-primary">Lưu</button>
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