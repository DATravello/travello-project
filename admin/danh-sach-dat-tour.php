<?php
  include('security.php');
  include('includes/header.php'); 
  include('includes/navbar.php');
?>

<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Danh Sách Đặt Tour Du Lịch 
            <a href="them-dat-tour.php">
              <button type="button" class="btn btn-primary">Thêm Đặt Tour</button>
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
        $connection = mysqli_connect("localhost","root","","travello_db");
        $query = "SELECT * FROM dattour";
        $query_run = mysqli_query($connection, $query);
      ?>
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Mã Đặt Tour</th>
            <th>Họ Tên</th>
            <th>CMND</th>
            <th>Email</th>
            <th>Điện Thoại</th>
            <th>Địa Chỉ</th>
            <th>Số Người Lớn</th>
            <th>Số Trẻ Em</th>
            <th>Ngày Đặt</th>
            <th>Thông Tin Thanh Toán</th>
            <th>Tổng Tiền</th>
            <th>EDIT</th>
            <th>DELETE</th>
          </tr>
        </thead>
        <tbody>

          <?php
            if(mysqli_num_rows($query_run) > 0)
            {
              while($row = mysqli_fetch_assoc($query_run))
              {
          ?>
                <tr>
                  <td><?php echo $row['MaDatTour']; ?></td>
                  <td> <?php echo $row['HoTen']; ?>  </td>
                  <td> <?php echo $row['CMND']; ?>  </td>
                  <td> <?php echo $row['Email']; ?>  </td>
                  <td> <?php echo $row['DienThoai']; ?>  </td>
                  <td> <?php echo $row['DiaChi']; ?>  </td>
                  <td> <?php echo $row['SoNguoiLon']; ?>  </td>
                  <td> <?php echo $row['SoTreEm']; ?>  </td>
                  <td> <?php echo $row['NgayDat']; ?>  </td>
                  <td> <?php echo $row['ThongTinThanhToan']; ?>  </td>
                  <td> <?php echo $row['TongTien']; ?>  </td>
                  <td>
                    <form action="sua-dattour.php" method="post">
                      <input type="hidden" name="edit_MaDatTour" value="<?php echo $row['MaDatTour']; ?>">
                      <button type="submit" name="edit_btn" class="btn btn-success"><i class="fas fa-pen-square"></i></button> 
                    </form>
                  </td>
                  <td>
                    <form action="code.php" method="post">
                      <input type="hidden" name="delete_dattout" value="<?php echo $row['MaDatTour']; ?>">
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

