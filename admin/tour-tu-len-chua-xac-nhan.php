<?php
include('security.php');
include('includes/header.php');
include('includes/navbar.php');
?>

<div class="container-fluid">

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Danh Sách Hóa Đơn Tour Tự Lên
      </h6>
      <div class="m-0">
        <form action="table-excel/xuat-bill-tour-tu-len.php" method="post">
          <input type="hidden" name="xuat_bill" value="<?php echo $row['MaHD']; ?>">
          <button type="submit" name="btn_xuat_bill_tu_len" class="btn btn-danger">Xuất Hóa Đơn</i></button>
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
        $query = "SELECT * FROM hoadontourtutao hdtt, thanhtoan tt, khachhang kh, tourdulich tour
         where hdtt.MaTT = tt.MaTT 
        and hdtt.MaKH=kh.MaKH and tour.MaTour=hdtt.MaTour and
        hdtt.TinhTrang = 'Chưa Xác Nhận'";
        $query_run = mysqli_query($connection, $query);
        ?>
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Mã Hóa Đơn</th>
              <th>Tên Khách Hàng</th>
              <th>Thanh Toán</th>
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
            if (mysqli_num_rows($query_run) > 0) {
              while ($row = mysqli_fetch_assoc($query_run)) {
            ?>
                <tr>
                  <td><?php echo $row['MaHD']; ?></td>
                  <td><?php
                      echo $row['TenKH'];
                      ?></td>
                  <td><?php
                      echo $row['TenThanhToan'];
                      ?></td>
                  <td><?php
                      echo $row['TenTour'];
                      ?></td>
                  <td> <?php echo $row['SoNguoiLon']; ?> </td>
                  <td> <?php echo $row['SoTreEm']; ?> </td>
                  <td> <?php echo $row['NgayDat']; ?> </td>
                  <td> <?php echo $row['TongTien']; ?> </td>
                  <td> <?php echo $row['TinhTrang']; ?> </td>
                  <td>
                    <form action="sua-hd-tour-tu-len.php" method="post">
                      <input type="hidden" name="edit_MaHD" value="<?php echo $row['MaHD']; ?>">
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

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>