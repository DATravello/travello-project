<?php
  include('security.php');
  include('includes/header.php'); 
  include('includes/navbar.php');
?>

<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Danh Sách Nhân Viên
            <a href="them-nhan-vien.php">
              <button type="button" class="btn btn-primary">Thêm Nhân Viên</button>
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
        $query = "SELECT * FROM nhanvien";
        $query_run = mysqli_query($connection, $query);
      ?>
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Mã NV</th>
            <th>Tên NV</th>
            <th>Ngày Sinh</th>
            <th>Giới Tính</th>
            <th>Địa Chỉ</th>
            <th>SDT</th>
            <th>Ảnh</th>
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
                  <td><?php echo $row['MaNV']; ?></td>
                  <td> <?php echo $row['TenNV']; ?>  </td>
                  <td> <?php echo $row['NgaySinh']; ?>  </td>
                  <td> <?php echo $row['GioiTinh']; ?>  </td>
                  <td> <?php echo $row['DiaChi']; ?>  </td>
                  <td> <?php echo $row['SDT']; ?>  </td>
                  <td> <img src="img/nhan-vien/<?php echo $row['Anh'];?>" width="50px" height="50px"></td>
                  <td>
                    <form action="sua-nhan-vien.php" method="post">
                      <input type="hidden" name="edit_MaNV" value="<?php echo $row['MaNV']; ?>">
                      <button type="submit" name="edit_btn" class="btn btn-success"><i class="fas fa-pen-square"></i></button> 
                    </form>
                  </td>
                  <td>
                    <form action="code.php" method="post">
                      <input type="hidden" name="xoa_nhanvien" value="<?php echo $row['MaNV']; ?>">
                      <button type="submit" name="btn_xoa_nv" class="btn btn-danger"><i class="fas fa-ban"></i></button> 
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

