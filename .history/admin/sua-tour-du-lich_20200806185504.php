<?php
    include('security.php');
    include('includes/header.php');
    include('includes/navbar.php');
?>
<div class="container-fluid">
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
        if(isset($_POST['edit_btn']))
        {
            $matour = $_POST['sua_matour'];
            $query = "SELECT * FROM tourdulich WHERE MaTour ='$matour'";
            $query_run = mysqli_query($connection, $query);
            foreach($query_run as $row)
            {
    ?>
                <form action="code.php" method="POST" enctype="multipart/form-data">
                 <div class="form-group">
                        <label> Mã Tour </label>
                        <input type="text" name="sua_matour"  value="<?php echo $row['MaTour'] ?>" class="form-control" placeholder="Enter MaTour" readonly>
                    </div>
                    <div class="form-group">
                        <label> Tên Loại Tour</label>
                        <select class="form-control"  name="sua_loaitour">
                        <?php
                        $q_loaitour = "SELECT * FROM loaitourdulich";
                        $rs_loaitour = mysqli_query($connection, $q_loaitour);
                        while ($TL = @mysqli_fetch_array($rs_loaitour)) {
                        ?>
                            <option value="<?php echo $TL["MaLoaiTour"] ?>"><?php echo $TL["TenLoaiTour"] ?></option>
                        <?php
                        }
                        ?>
                    </select>
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
                        <label> Vị Trí</label>
                        <select class="form-control"  name="sua_vitri">
                        <?php
                        $q_vitri = "SELECT * FROM vitri";
                        $rs_vitri= mysqli_query($connection, $q_vitri);
                        while ($TL = @mysqli_fetch_array($rs_vitri)) {
                        ?>
                            <option value="<?php echo $TL["MaViTri"] ?>"><?php echo $TL["TenViTri"] ?></option>
                        <?php
                        }
                        ?>
                    </select>
                    </div>
                    <div class="form-group">
                        <label>Thời Gian </label>
                        <input type="date" name="sua_thoigian" value="<?php echo $row['ThoiGian'] ?>" class="form-control" placeholder="Enter ThoiGian">
                    </div>
                    <div class="form-group">
                        <label> Tên Khách Sạn</label>
                        <select class="form-control"  name="sua_khachsan">
                        <?php
                        $q_ks = "SELECT * FROM khachsan";
                        $rs_ks = mysqli_query($connection, $q_ks);
                        while ($TL = @mysqli_fetch_array($rs_ks)) {
                        ?>
                            <option value="<?php echo $TL["MaKS"] ?>"><?php echo $TL["TenKS"] ?></option>
                        <?php
                        }
                        ?>
                    </select>
                    </div>
                    <div class="form-group">
                        <label> Tên Nhà Hàng</label>
                        <select class="form-control"  name="sua_nhahang">
                        <?php
                        $q_nh = "SELECT * FROM nhahang";
                        $rs_nh = mysqli_query($connection, $q_nh);
                        while ($TL = @mysqli_fetch_array($rs_nh)) {
                        ?>
                            <option value="<?php echo $TL["MaNH"] ?>"><?php echo $TL["TenNhaHang"] ?></option>
                        <?php
                        }
                        ?>
                    </select>
                    </div>
                    <div class="form-group">
                        <label> Tên Hướng Dẫn Viên</label>
                        <select class="form-control"  name="sua_hdv">
                        <?php
                        $q_hdv = "SELECT * FROM huongdanvien";
                        $rs_hdv = mysqli_query($connection, $q_hdv);
                        while ($TL = @mysqli_fetch_array($rs_hdv)) {
                        ?>
                            <option value="<?php echo $TL["MaHDV"] ?>"><?php echo $TL["TenHDV"] ?></option>
                        <?php
                        }
                        ?>
                    </select>
                    </div>
                    <div class="form-group">
                        <label> Tên Phương Tiện</label>
                        <select class="form-control"  name="sua_phuongtien">
                        <?php
                        $q_pt = "SELECT * FROM phuongtien";
                        $rs_pt = mysqli_query($connection, $q_pt);
                        while ($TL = @mysqli_fetch_array($rs_pt)) {
                        ?>
                            <option value="<?php echo $TL["MaPhuongTien"] ?>"><?php echo $TL["PhuongTien"] ?></option>
                        <?php
                        }
                        ?>
                    </select>
                    </div>
                    <div class="form-group">
                        <label> Dịch Vụ Đi Kèm</label>
                        <select class="form-control"  name="sua_dichvu">
                        <?php
                        $q_dv = "SELECT * FROM dichvudikem";
                        $rs_dv = mysqli_query($connection, $q_dv);
                        while ($TL = @mysqli_fetch_array($rs_dv)) {
                        ?>
                            <option value="<?php echo $TL["MaDV"] ?>"><?php echo $TL["TenDV"] ?></option>
                        <?php
                        }
                        ?>
                    </select>
                    </div>
                    <div class="form-group">
                        <label>Giá Tiền </label>
                        <input type="number" name="sua_giatien" value="<?php echo $row['GiaTien'] ?>" class="form-control" placeholder="Enter GiaTien">
                    </div>
                    <div class="form-group">
                        <label>Giá Trẻ Em </label>
                        <input type="number" name="sua_giatreem" value="<?php echo $row['GiaTreEm'] ?>" class="form-control" placeholder="Enter Giá Trẻ Em">
                    </div>
                    <div class="form-group">
                        <label>Hành Trình </label>
                        <textarea rows="5" name="sua_hanhtrinh" class="form-control"><?php echo $row['HanhTrinh'] ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Số Ngày </label>
                        <input type="number" name="sua_songay" value="<?php echo $row['SoNgay'] ?>" class="form-control" placeholder="Enter SoNgay">
                    </div>
                    <div class="form-group">
                        <label>Sức Chứa </label>
                        <input type="number" name="sua_succhua" value="<?php echo $row['SoNgay'] ?>" class="form-control" placeholder="Enter SoNgay">
                    </div>
                    <div class="form-group">
                        <label>Chi Phí Tour </label>
                        <input type="number" name="sua_chiphi" value="<?php echo $row['ChiPhiTour'] ?>" class="form-control" placeholder="Enter SoNgay">
                    </div>
                    <div class="form-group">
                    <label>Ảnh </label><br>
                        <img id="previewImg" src="img/tour-du-lich/<?php echo $row['HinhAnh']; ?>">
                    </div>
                    <div class="form-group">

                        <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" name="Anh" accept="image/*" onchange="previewImage()" id="file" class="custom-file-input" aria-describedby="inputGroupFileAddon01">
                            <label class="custom-file-label" for="inputGroupFile01">Chọn file</label>
                        </div>   
                    </div>
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

</div>
<?php
    include('includes/footer.php');
    include('includes/scripts.php');
?>