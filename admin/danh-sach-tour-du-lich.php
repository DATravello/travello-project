<?php
  include('security.php');
  include('includes/header.php'); 
  include('includes/navbar.php');
?>

<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Danh Sách Tour Du Lịch
            <a href="them-tour-du-lich.php">
              <button type="button" class="btn btn-primary">Thêm Tour Du Lịch</button>
            </a>
    </h6>
  </div>

  <div class="card-body">
  <?php
            if(isset($_SESSION['success']) && $_SESSION['success'] !='')
            {
                echo    '<div class="btn btn-success btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-check"></i>
                        </span>
                        <span class="text">
                        '.$_SESSION['success'].'
                        </span>
                        </div>';
                unset($_SESSION['success']);
            }

            if(isset($_SESSION['status']) && $_SESSION['status'] !='')
            {
                echo '<div class="btn btn-warning btn-icon-split">
                     <span class="icon text-white-50">
                        <i class="fas fa-exclamation-triangle"></i>
                     </span>
                     <span class="text">
                        '.$_SESSION['status'].'
                     </span>
                     </div>';
                unset($_SESSION['status']);
            }
        ?>

    <div class="table-responsive">
      <?php
        // $connection = mysqli_connect("localhost","root","","travello_db");
        $query = "SELECT * FROM tourdulich";
        $query_run = mysqli_query($connection, $query);
        $query1="SELECT * FROM tourdulich, loaitourdulich, nhahang, khachsan, phuongtien, huongdanvien, dichvudikem
         where tourdulich.MaLoaiTour = loaitourdulich.MaLoaiTour and nhahang.MaNH=tourdulich.MaNH AND khachsan.MaKS = tourdulich.MaKS AND huongdanvien.MaHDV = tourdulich.MaHDV AND phuongtien.MaPhuongTien = tourdulich.MaPhuongTien AND dichvudikem.MaDV = tourdulich.MaDV";
        $result1 = mysqli_query($connection, $query1);
      ?>
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Mã Tour</th>
            <th>Tên Loại Tour</th>
            <th>Tên Tour</th>
            <th>Nơi Khởi Hành</th>
            <th>Nơi Đến</th>
            <th>Thời Gian</th>
            <th>Khách Sạn</th>
            <th>Nhà Hàng</th>
            <th>Hướng Dẫn Viên</th>
            <th>Phương Tiện</th>
            <th>Dịch Vụ Đi Kèm</th>
            <th>Giá Tiền</th>
            <th>Giá Trẻ Em</th>
            <th>Hành Trình</th>
            <th>Số Ngày</th>
            <th>Sức Chứa</th>
            <th>Ảnh</th>
            <th>EDIT</th>
            <th>DELETE</th>
          </tr>
        </thead>
        <tbody>

          <?php
            if(mysqli_num_rows($query_run) > 0 && mysqli_num_rows($result1) > 0)
            {
              while(($row = mysqli_fetch_assoc($query_run)) && $rows1 =mysqli_fetch_assoc($result1))
              {
          ?>
                <tr>
                  <td><?php echo $row['MaTour']; ?></td>
                  <td><?php
                  echo $rows1['TenLoaiTour']; 
                  ?></td>
                  <td> <?php echo $row['TenTour']; ?>  </td>
                  <td> <?php echo $row['NoiKhoiHanh']; ?>  </td>
                  <td> <?php echo $row['NoiDen']; ?>  </td>
                  <td> <?php echo $row['ThoiGian']; ?>  </td>
                  <td><?php
                  echo $rows1['TenKS']; 
                  ?></td>
                   <td><?php
                  echo $rows1['TenNhaHang']; 
                  ?></td>
                  <td><?php
                  echo $rows1['TenHDV']; 
                  ?></td>
                  <td><?php
                  echo $rows1['PhuongTien']; 
                  ?></td>
                  <td><?php
                  echo $rows1['TenDV']; 
                  ?></td>
                  <td> <?php echo $row['GiaTien']; ?>  </td>
                  <td> <?php echo $row['GiaTreEm']; ?>  </td>
                  <td> <?php echo $row['HanhTrinh']; ?>  </td>
                  <td> <?php echo $row['SoNgay']; ?>  </td>
                  <td> <?php echo $row['SucChua']; ?>  </td>
                  <td> <?php echo $row['Anh']; ?>  </td>
                  <td>
                    <form action="sua-tour-du-lich.php" method="post">
                      <input type="hidden" name="sua_matour" value="<?php echo $row['MaTour']; ?>">
                      <button type="submit" name="edit_btn" class="btn btn-success"><i class="fas fa-pen-square"></i></button> 
                    </form>
                  </td>
                  <td>
                    <form action="code.php" method="post">
                      <input type="hidden" name="xoa_tour" value="<?php echo $row['MaTour']; ?>">
                      <button type="submit" name="btn_xoa_tour" class="btn btn-danger"><i class="fas fa-ban"></i></button> 
                    </form>
                  </td>
                </tr>
          <?php
              }
            }
            else {
              echo "no record found";
            }
          ?>
        
        </tbody>
      </table>

    </div>
  </div>
</div>

</div>
<!-- /.container-fluid -->

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>

