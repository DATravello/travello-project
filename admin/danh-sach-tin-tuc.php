<?php
include('security.php');
include('includes/header.php');
include('includes/navbar.php');
?>
<div class="container-fluid">
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Danh Sách Tin Tức
        <a href="them-tin-tuc.php">
          <button type="button" class="btn btn-primary">Thêm Tin Tức</button>
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
        $query = "SELECT * FROM tintuc, nhanvien, theloai where tintuc.MaNV = nhanvien.MaNV
         and theloai.MaTheLoai=tintuc.MaTheLoai";
        $query_run = mysqli_query($connection, $query);
        ?>
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Mã Tin Tức</th>
              <th>Tên Thể Loại</th>
              <th>Người Tạo</th>
              <th>Tên Tin Tức</th>
              <th>Hình Ảnh</th>
              <th>Mô Tả</th>
              <th>Chi Tiết</th>
              <th>Ngày</th>
              <th>Nguồn</th>
              <th>EDIT</th>
              <th>DELETE</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $i=0;
            if (mysqli_num_rows($query_run) > 0) {
              while ($row = mysqli_fetch_assoc($query_run)) {
            ?>
                <tr>
                  <td><?php echo $row['MaTinTuc']; ?></td>
                  <td><?php
                      echo $row['TenTheLoai'];
                      ?></td>
                  <td><?php
                      echo $row['TenNV'];
                      ?></td>
                  <td> <?php echo $row['TenTinTuc']; ?> </td>
                  <td> <img src="img/tin-tuc/<?php echo $row['HinhAnh']; ?>" style="width:150px;height:100px"> </td>
                  <td>
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#MoTa<?php echo $i?>">
                      Xem
                    </button>
                    <!-- Mô Tả -->
                    <div class="modal fade" id="MoTa<?php echo $i?>" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Hành Trình Tour</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <p style="color:#000"><?php echo $row['MoTa']; ?></p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </td>
                  <td>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ChiTiet<?php echo $i ?>">
                      Xem
                    </button>
                    <!-- Chi Tiết -->
                    <div class="modal fade" id="ChiTiet<?php echo $i ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Chi Tiết</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <p style="color:#000"><?php echo $row['ChiTiet']; ?></p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </td>
                  <td> <?php echo $row['Ngay']; ?> </td>
                  <td> <?php echo $row['TaoBoi']; ?> </td>
                  <td>
                    <form action="sua-tin-tuc.php" method="post">
                      <input type="hidden" name="sua_matt" value="<?php echo $row['MaTinTuc']; ?>">
                      <button type="submit" name="edit_btn" class="btn btn-success"><i class="fas fa-pen-square"></i></button>
                    </form>
                  </td>
                  <td>
                    <form action="code.php" method="post">
                      <input type="hidden" name="xoa_tintuc" value="<?php echo $row['MaTinTuc']; ?>">
                      <button type="submit" name="btn_xoa_tintuc" class="btn btn-danger"><i class="fas fa-ban"></i></button>
                    </form>
                  </td>
                </tr>
            <?php
            $i++;
              }
            } else {
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