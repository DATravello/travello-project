<?php
include('security.php');
include('includes/header.php');
include('includes/navbar.php');
?>

<div class="container-fluid">

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Danh Sách Nhà Hàng
        <a href="them-nha-hang.php">
          <button type="button" class="btn btn-primary">Thêm Nhà Hàng</button>
        </a>
      </h6>
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
        $conn = mysqli_connect("localhost", "root", "", "travello_db");
        $query = "SELECT * FROM nhahang";
        $query_run = mysqli_query($conn, $query);
        $query1 = "SELECT * FROM nhahang, thuonghieunh, vitri where nhahang.MaThuongHieuNH = thuonghieunh.MaThuongHieuNH and vitri.MaViTri=nhahang.MaViTri";
        $result1 = mysqli_query($connection, $query1);
        ?>
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Mã NH</th>
              <th>Thương Hiệu</th>
              <th>Tên Nhà Hàng</th>
              <th>Vị Trí</th>
              <th>Địa Chỉ</th>
              <th>Ảnh</th>
              <th>SDT</th>
              <th>Giới Thiệu</th>
              <th>Giá Trẻ Em</th>
              <th>Giá Người Lớn</th>
              <th>Mô Tả Thực Đơn</th>
              <th>EDIT</th>
              <th>DELETE</th>
            </tr>
          </thead>
          <tbody>

            <?php
            $i = 0;
            if (mysqli_num_rows($query_run) > 0 && mysqli_num_rows($result1) > 0) {
              while (($row = mysqli_fetch_assoc($query_run)) && $rows1 = mysqli_fetch_assoc($result1)) {
            ?>
                <tr>
                  <td><?php echo $row['MaNH']; ?></td>
                  <td><?php
                      echo $rows1['TenThuongHieuNH'];
                      ?></td>
                  <td> <?php echo $row['TenNhaHang']; ?> </td>
                  <td><?php
                      echo $rows1['TenViTri'];
                      ?></td>
                  <td> <?php echo $row['DiaChi']; ?> </td>
                  <td><img src="img/nha-hang/<?php echo $row['Anh']; ?>" style="width:150px;height:100px"> </td>
                  <td> <?php echo $row['SDT']; ?> </td>
                  <td>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#GioiThieuNH<?php echo $i ?>">
                      Xem
                    </button>
                    <!-- Giới Thiệu Nhà Hàng-->
                    <div class="modal fade" id="GioiThieuNH<?php echo $i ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Giới Thiệu Nhà Hàng</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <p style="color:#000"><?php echo $row['GioiThieuNH']; ?></p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </td>
                  <td> <?php echo product_price($row['GiaTreEm']); ?> </td>
                  <td> <?php echo product_price($row['GiaNguoiLon']); ?> </td>
                  <td> <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ThucDon<?php echo $i ?>">
                      Xem
                    </button>
                    <!-- Mô Tả Thực Đơn -->
                    <div class="modal fade" id="ThucDon<?php echo $i ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Mô Tả Thực Đơn</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <p style="color:#000"><?php echo $row['MoTaThucDon']; ?></p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </td>
                  <td>
                    <form action="sua-nha-hang.php" method="post">
                      <input type="hidden" name="sua_mnh" value="<?php echo $row['MaNH']; ?>">
                      <button type="submit" name="edit_btn" class="btn btn-success"><i class="fas fa-pen-square"></i></button>
                    </form>
                  </td>
                  <td>
                    <form action="code.php" method="post">
                      <input type="hidden" name="xoa_nhahang" value="<?php echo $row['MaNH']; ?>">
                      <button type="submit" name="btn_xoa_nh" class="btn btn-danger"><i class="fas fa-ban"></i></button>
                    </form>
                  </td>
                </tr>
            <?php
                $i++;
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