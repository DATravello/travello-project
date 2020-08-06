<?php
include('security.php');
include('includes/header.php');
include('includes/navbar.php');
?>

<div class="container-fluid">

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Danh Sách Hóa Đơn Nhà Hàng
      </h6>
      <div class="m-0">
        <form action="table-excel/xuat-bill-nha-hang.php" method="post">
          <input type="hidden" name="xuat_bill" value="<?php echo $row['MaHoaDonNH']; ?>">
          <button type="submit" name="btn_xuat_bill_nh" class="btn btn-danger">Xuất Hóa Đơn</button>
        </form>
      </div>

    </div>

    <div class="card-body">
      <?php
      if (isset($_SESSION['success']) && $_SESSION['success'] != '') {
        echo    '<div class="btn btn-success btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-check"></i>
                        </span>
                        <span class="text">
                        ' . $_SESSION['success'] . '
                        </span>
                        </div>';
        unset($_SESSION['success']);
      }

      if (isset($_SESSION['status']) && $_SESSION['status'] != '') {
        echo '<div class="btn btn-warning btn-icon-split">
                     <span class="icon text-white-50">
                        <i class="fas fa-exclamation-triangle"></i>
                     </span>
                     <span class="text">
                        ' . $_SESSION['status'] . '
                     </span>
                     </div>';
        unset($_SESSION['status']);
      }
      ?>

      <div class="table-responsive">
        <?php
        $query = "SELECT * FROM hoadonnh";
        $query_run = mysqli_query($connection, $query);
        $query1 = "SELECT * FROM hoadonnh hdnh, hoadon hd, khachhang kh, nhahang nh where hdnh.MaKH = kh.MaKH 
        and hdnh.MaNH=nh.MaNH ";
        $result1 = mysqli_query($connection, $query1);
        ?>
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Mã Hóa Đơn Nhà Hàng</th>
              <th>Mã Hóa Đơn</th>
              <th>Tên Khách Hàng</th>
              <th>Tên Nhà Hàng</th>
              <th>Số Người Lớn</th>
              <th>Số Trẻ Em</th>
              <th>Ngày Đặt</th>
              <th>Tổng Tiền</th>
            </tr>
            <!-- <tr>Xuất BILL</tr> -->
          </thead>
          <tbody>

            <?php
            if (mysqli_num_rows($query_run) > 0 && mysqli_num_rows($result1) > 0) {
              while (($row = mysqli_fetch_assoc($query_run)) && $rows1 = mysqli_fetch_assoc($result1)) {
            ?>
                <tr>
                  <td><?php echo $row['MaHoaDonNH']; ?></td>
                  <td><?php echo $row['MaHD']; ?></td>
                  <td><?php
                      echo $rows1['TenKH'];
                      ?></td>
                  <td><?php
                      echo $rows1['TenNhaHang'];
                      ?></td>
                  <td> <?php echo $row['SoNguoiLon']; ?> </td>
                  <td> <?php echo $row['SoTreEm']; ?> </td>
                  <td> <?php echo $row['NgayDat']; ?> </td>
                  <td> <?php echo $row['TongTien']; ?> </td>


                </tr>

            <?php
              }
            } else {
              echo "không có bản ghi nào";
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