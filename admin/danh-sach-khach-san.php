<?php
include('security.php');
include('includes/header.php');
include('includes/navbar.php');
?>

<div class="container-fluid">

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Danh Sách Khách Sạn
        <a href="them-khach-san.php">
          <button type="button" class="btn btn-primary">Thêm Khách Sạn</button>
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
        $connection = mysqli_connect("localhost", "root", "", "travello_db");
        $query = "SELECT * FROM khachsan";
        $query_run = mysqli_query($connection, $query);
        $query1 = "SELECT * FROM khachsan, thuonghieuks,  loaiphong, vitri where khachsan.MaThuongHieuKS = thuonghieuks.MaThuongHieuKS and loaiphong.MaLoaiPhong=khachsan.MaLoaiPhong and vitri.MaViTri=khachsan.MaViTri";
        $result1 = mysqli_query($connection, $query1);
        ?>
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Tên Thương Hiệu</th>
              <th>Vị Trí</th>
              <th>Mã KS</th>
              <th>Hạng Sao</th>
              <th>Tên Khách Sạn</th>
              <th>Ảnh</th>
              <th>Địa Chỉ</th>
              <th>Điện Thoại</th>
              <th>Loại Phòng</th>
              <th>Số Phòng</th>
              <th>Website</th>
              <th>Mô Tả Khách Sạn</th>
              <th>Mô Tả Loại Phòng</th>
              <th>Ảnh Loại Phòng</th>
              <th>Giá</th>
              <th>EDIT</th>
              <th>DELETE</th>
            </tr>
          </thead>
          <tbody>

            <?php
            $i = 0;
            if (mysqli_num_rows($query_run) > 0 && mysqli_num_rows($result1) > 0) {
              while (($rows = mysqli_fetch_assoc($query_run)) && $rows1 = mysqli_fetch_assoc($result1)) {
            ?>
                <tr>
                  <td><?php
                      echo $rows1['TenThuongHieuKS'];
                      ?></td>
                  <td><?php
                      echo $rows1['TenViTri'];
                      ?></td>
                  <td><?php echo $rows['MaKS']; ?></td>
                  <td> <?php echo $rows['HangSao']; ?> </td>
                  <td> <?php echo $rows['TenKS']; ?> </td>
                  <td> <img src="img/khach-san/<?php echo $rows['Anh']; ?>" style="width:150px;height:100px"> </td>
                  <td> <?php echo $rows['DiaChi']; ?> </td>
                  <td> <?php echo $rows['DienThoai']; ?> </td>
                  <td> <?php echo $rows1['TenLoaiPhong']; ?> </td>
                  <td> <?php echo $rows['SoPhong']; ?> </td>
                  <td> <?php echo $rows['WebSite']; ?> </td>
                  <td>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#KhachSan<?php echo $i ?>">
                      Xem
                    </button>
                    <!-- Mô Tả Khách Sạn-->
                    <div class="modal fade" id="KhachSan<?php echo $i ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Mô Tả Khách Sạn</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <p style="color:#000"> <?php echo $rows['MoTa']; ?></p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </td>
                  <td>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#LoaiPhong<?php echo $i ?>">
                      Xem
                    </button>
                    <!-- Mô Tả Loại Phòng -->
                    <div class="modal fade" id="LoaiPhong<?php echo $i ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Mô Tả Loại Phòng</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <p style="color:#000"> <?php echo $rows['MoTaLoaiPhong']; ?></p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </td>
                  <td> <img src="img/loai-phong/<?php echo $rows['AnhLoaiPhong']; ?>" style="width:150px;height:100px"> </td>
                  <td> <?php echo product_price($rows['Gia']); ?> </td>
                  <td>
                    <form action="sua-khach-san.php" method="post">
                      <input type="hidden" name="sua_maks" value="<?php echo $rows['MaKS']; ?>">
                      <button type="submit" name="edit_btn" class="btn btn-success"><i class="fas fa-pen-square"></i></button>
                    </form>
                  </td>
                  <td>
                    <form action="code.php" method="post">
                      <input type="hidden" name="xoa_khachsan" value="<?php echo $rows['MaKS']; ?>">
                      <button type="submit" name="btn_xoa_ks" class="btn btn-danger"><i class="fas fa-ban"></i></button>
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