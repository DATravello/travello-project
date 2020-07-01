<?php
  include('security.php');
  include('includes/header.php'); 
  include('includes/navbar.php');
?>

<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Danh Sách Phương Tiện
    <a href="them-phuong-tien.php">
              <button type="button" class="btn btn-primary">Thêm Phương Tiện</button>
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
        $query = "SELECT * FROM phuongtien";
        $query_run = mysqli_query($connection, $query);
        $query1 = "SELECT * FROM phuongtien pt, theloaiphuongtien tl where pt.MaTLPhuongTien = tl.MaTLPhuongTien";
        $result1 = mysqli_query($connection, $query1);
      ?>
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Mã Phương Tiện</th>
            <th>Tên Thể Loại </th>
            <th>Tên Phương Tiện</th>
            <th>Ảnh</th>
            <th>Nơi Đi</th>
            <th>Nơi Đến</th>
            <th>Giá</th>
            <th>EDIT</th>
            <th>DELETE</th>
          </tr>
        </thead>
        <tbody>

          <?php
            if(mysqli_num_rows($query_run) > 0 && mysqli_num_rows($result1) > 0)
            {
              while(($row = mysqli_fetch_assoc($query_run)) && $rows1 = mysqli_fetch_assoc($result1))
              {
          ?>
                <tr>
                  <td><?php echo $row['MaPhuongTien']; ?></td>
                  <td><?php
                      echo $rows1['TenTLPhuongTien'];
                  ?></td>
                  <td> <?php echo $row['PhuongTien']; ?>  </td>
                  <td> <img src="img/phuong-tien/<?php echo $row['HinhAnh']; ?>" style="width:150px;height:100px">  </td>
                  <td> <?php echo $row['NoiDi']; ?>  </td>
                  <td> <?php echo $row['NoiDen']; ?>  </td>
                  <td> <?php echo product_price($row['Gia']); ?>  </td>
                  <td>
                    <form action="sua-phuong-tien.php" method="post">
                      <input type="hidden" name="sua_MaPhuongTien" value="<?php echo $row['MaPhuongTien']; ?>">
                      <button type="submit" name="edit_btn" class="btn btn-success"><i class="fas fa-pen-square"></i></button> 
                    </form>
                  </td>
                  <td>
                    <form action="code.php" method="post">
                      <input type="hidden" name="xoa_phuongtien" value="<?php echo $row['MaPhuongTien']; ?>">
                      <button type="submit" name="btn_xoa_phuongtien" class="btn btn-danger"><i class="fas fa-ban"></i></button> 
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