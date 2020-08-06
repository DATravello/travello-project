<?php
include('security.php');
include('includes/header.php');
include('includes/navbar.php');
?>

<div class="container-fluid">

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Danh Sách Hóa Đơn Tour Trọn Gói
      </h6>
      <div class="m-0">
        <form action="table-excel/xuat-bill-tour-tron-goi.php" method="post">
          <input type="hidden" name="xuat_bill" value="<?php echo $row['MaHD']; ?>">
          <button type="submit" name="btn_xuat_bill" class="btn btn-danger">Xuất Hóa Đơn</i></button>
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
        $query = "SELECT * FROM hoadon hd, thanhtoan tt, khachhang kh, tourdulich tour where hd.MaTT = tt.MaTT 
        and hd.MaKH=kh.MaKH and tour.MaTour=hd.MaTour and hd.TinhTrang = 'Chưa Xác Nhận'";
        $result = mysqli_query($connection, $query);
        ?>
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Mã Hóa Đơn</th>
              <th>Thanh Toán</th>
              <th>Tên Khách Hàng</th>
              <th>Tên Tour</th>
              <th>Số Người Lớn</th>
              <th>Số Trẻ Em</th>
              <th>Ngày Đặt</th>
              <th>Tổng Tiền</th>
              <th>Tình Trạng</th>
              <th>Edit</th>
            </tr>
          </thead>
          <tbody>

            <?php
              if (mysqli_num_rows($result) > 0) {
                while ($rows = mysqli_fetch_assoc($result)) {
            ?>
                <tr>
                  <td><?php echo $rows['MaHD']; ?></td>
                  <td><?php
                      echo $rows['TenThanhToan'];
                      ?></td>
                  <td><?php
                      echo $rows['TenKH'];
                      ?></td>
                  <td><?php
                      echo $rows['TenTour'];
                      ?></td>
                  <td> <?php echo $rows['SoNguoiLon']; ?> </td>
                  <td> <?php echo $rows['SoTreEm']; ?> </td>
                  <td> <?php echo $rows['NgayDat']; ?> </td>
                  <td> <?php echo $rows['TongTien']; ?> </td>
                  <td> <?php echo $rows['TinhTrang']; ?> </td>
                  <td>
                    <form action="sua-hoa-don-tour-tron-goi.php" method="post">
                      <input type="hidden" name="edit_MaHD" value="<?php echo $rows['MaHD']; ?>">
                      <button type="submit" name="edit_btn" class="btn btn-success"><i class="fas fa-pen-square"></i></button>
                    </form>
                  </td>
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