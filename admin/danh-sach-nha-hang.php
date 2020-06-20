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
        $conn = mysqli_connect("localhost","root","","travello_db");
        $query = "SELECT * FROM nhahang";
        $query_run = mysqli_query($conn, $query);
      ?>
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Mã NH</th>
            <th>Tên Nhà Hàng</th>
            <th>Địa Chỉ</th>
            <th>Ảnh</th>
            <th>SDT</th>
            <th>Giới Thiệu</th>
            <th>Giá Nhà Hàng</th>
            <th>Ngày Đến</th>
            <th>Ngày Đi</th>
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
                  <td><?php echo $row['MaNH']; ?></td>
                  <td> <?php echo $row['TenNhaHang']; ?>  </td>
                  <td> <?php echo $row['DiaChi']; ?>  </td>
                  <td> <?php echo $row['Anh']; ?>  </td>
                  <td> <?php echo $row['SDT']; ?>  </td>
                  <td> <?php echo $row['GioiThieuNH']; ?>  </td>
                  <td> <?php echo $row['GiaNH']; ?>  </td>
                  <td> <?php echo $row['NgayDen']; ?>  </td>
                  <td> <?php echo $row['NgayDi']; ?>  </td>
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
              }
            }
            else {
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

