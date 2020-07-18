<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <?php
  // $connection = mysqli_connect("localhost","root","","furnitureshop");    
  // $query = " SELECT * FROM user WHERE email='".$_SESSION['username']."' ";
  // $query_run = mysqli_query($connection, $query);

  // foreach($query_run as $row)
  // {
  ?>
  <?php
  $taikhoan = $_SESSION['TaiKhoan'];
  $q_tk = "SELECT * FROM taikhoan WHERE TenTK = '$taikhoan'";
  $rs_tk = mysqli_query($connection, $q_tk);
  $rw_tk = mysqli_fetch_array($rs_tk);

  $manv = $rw_tk["MaNV"];
  $q_nv = "SELECT * FROM nhanvien WHERE MaNV = $manv";
  $rs_nv = mysqli_query($connection, $q_nv);
  $rw_nv = mysqli_fetch_array($rs_nv);
  ?>
  <div class="sidebar-brand" style="height:10rem;">
    <div class="d-flex align-items-center justify-content-center">
      <div class="user">
        <div class="photo">
          <a href="index.php"><img src="img/nhan-vien/<?php echo $rw_nv["Anh"] ?>" width="80px" height="80px" alt="avatar" style="border: 2px solid #fff;border-radius: 50%;"></a>
        </div>


        <p><?php echo $rw_nv["TenNV"] ?></p>

        <p><?php // echo $row['usertype'] 
            ?>(Admin)</p>
      </div>
    </div>
  </div>


  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Dashboard -->
  <li class="nav-item active">
    <a class="nav-link" href="index.php">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span>
    </a>

  </li>
  <li class="nav-item">
    <?php
      $sql = "SELECT COUNT(*) AS total FROM hoadon WHERE TinhTrang = 'Yêu Cầu Huỷ'";
      $qr = mysqli_query($connection, $sql);
      $rs = mysqli_fetch_array($qr);
      $rs_cancel = $rs["total"];
    ?>
    <a class="nav-link" href="danh-sach-yeu-cau-huy-tour.php">
      <i class="fas fa-window-close"></i>
      <span>Yêu Cầu Huỷ Tour <span style="color:#ffcd3c">(<?php echo $rs_cancel?>)</span></span>
    </a>
    </a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Heading -->
  <div class="sidebar-heading">
    Quản Lý
  </div>

  <!-- Nav Item - Pages Collapse Menu -->
  <!-- <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
      <i class="fas fa-fw fa-cog"></i>
      <span>Pages</span>
    </a>
    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Pages Manage:</h6>
        <a class="collapse-item" href="../index.html">Home Page</a>
        <a class="collapse-item" href="admin-profile.php">Admin Profile</a>
        <a class="collapse-item" href="list-user.php">List User</a>

      </div>
  </li> -->




  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
      <i class="fas fa-directions"></i>
      <span>Quản lý Tour</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="danh-sach-tour-du-lich.php">Danh Sách Tour</a>
        <a class="collapse-item" href="danh-sach-dich-vu-di-kem.php">Danh Sách Dịch Vụ</a>
        <a class="collapse-item" href="danh-sach-vi-tri.php">Danh Sách Vị Trí</a>
        <a class="collapse-item" href="them-tour-du-lich.php">Thêm Tour</a>
        <a class="collapse-item" href="them-dich-vu-di-kem.php">Thêm Dịch Vụ Đi Kèm</a>
        <a class="collapse-item" href="them-vi-tri.php">Thêm Vị Trí</a>

      </div>
    </div>
  </li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
      <i class="fas fa-car"></i>
      <span>Quản Lý Phương Tiện</span>
    </a>
    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="danh-sach-phuong-tien.php">Danh Sách Phương Tiện</a>
        <a class="collapse-item" href="them-phuong-tien.php">Thêm Phương Tiện</a>
      </div>
    </div>
  </li>



  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
      <i class="fas fa-building"></i>
      <span>Quản Lý Khách Sạn</span>
    </a>
    <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="danh-sach-thuong-hieu-ks.php">Danh Sách Thương Hiệu</a>
        <a class="collapse-item" href="danh-sach-khach-san.php">Danh Sách Khách Sạn</a>
        <a class="collapse-item" href="danh-sach-loai-khach-san.php">Danh Sách Loại KS</a>
        <a class="collapse-item" href="danh-sach-loai-phong.php">Danh Sách Loại Phòng</a>
        <a class="collapse-item" href="them-thuong-hieu-ks.php">Thêm Thương Hiệu</a>
        <a class="collapse-item" href="them-loai-khach-san.php">Thêm Loại Khách Sạn</a>
        <a class="collapse-item" href="them-loai-phong.php">Thêm Loại Phòng</a>
        <a class="collapse-item" href="them-khach-san.php">Thêm Khách Sạn</a>
      </div>
    </div>
  </li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFive" aria-expanded="true" aria-controls="collapseUtilities">
      <i class="fas fa-utensils"></i>
      <span>Quản Lý Nhà Hàng</span>
    </a>
    <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="danh-sach-thuong-hieu-nh.php">Danh Sách Thương Hiệu NH</a>
        <a class="collapse-item" href="danh-sach-loai-nha-hang.php">Danh Sách Loại Nhà Hàng</a>
        <a class="collapse-item" href="danh-sach-nha-hang.php">Danh Sách Nhà Hàng</a>
        <a class="collapse-item" href="them-thuong-hieu-nh.php">Thêm Thương Hiệu</a>
        <a class="collapse-item" href="them-loai-nha-hang.php">Thêm Loại Nhà Hàng</a>
        <a class="collapse-item" href="them-nha-hang.php">Thêm Nhà Hàng</a>
      </div>
    </div>
  </li>
  <!-- Quản lý tin tức -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSix" aria-expanded="true" aria-controls="collapseFour">
      <i class="fas fa-newspaper"></i>
      <span>Quản Lý Tin Tức</span>
    </a>
    <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="danh-sach-tin-tuc.php">Danh Sách Tin Tức</a>
        <a class="collapse-item" href="danh-sach-the-loai.php">Danh Sách Loại Tin Tức</a>
        <a class="collapse-item" href="them-loai-tin-tuc.php">Thêm Loại Tin Tức</a>
        <a class="collapse-item" href="them-tin-tuc.php">Thêm Tin Tức</a>
      </div>
    </div>
  </li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="true" aria-controls="collapseUtilities">
      <i class="fas fa-user"></i>
      <span>Quản Lý Nhân Viên</span>
    </a>
    <div id="collapseSeven" class="collapse" aria-labelledby="headingSeven" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="danh-sach-nhan-vien.php">Danh Sách Nhân Viên</a>
        <a class="collapse-item" href="them-nhan-vien.php">Thêm Nhân Viên</a>
      </div>
    </div>
  </li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseEight" aria-expanded="true" aria-controls="collapseUtilities">
      <i class="fas fa-users"></i>
      <span>Quản Lý HDV</span>
    </a>
    <div id="collapseEight" class="collapse" aria-labelledby="headingEight" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="danh-sach-huong-dan-vien.php">Danh Sách HDV</a>
        <a class="collapse-item" href="them-huong-dan-vien.php">Thêm Hướng Dẫn Viên</a>
      </div>
    </div>
  </li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseNine" aria-expanded="true" aria-controls="collapseUtilities">
      <i class="fab fa-intercom"></i>
      <span>Quản Lý Khách Hàng</span>
    </a>
    <div id="collapseNine" class="collapse" aria-labelledby="headingNine" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="danh-sach-khach-hang.php">Danh Sách Khách Hàng</a>
      </div>
    </div>
  </li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTen" aria-expanded="true" aria-controls="collapseUtilities">
      <i class="fas fa-chart-bar"></i>
      <span>Quản Lý Hóa Đơn</span>
    </a>
    <div id="collapseTen" class="collapse" aria-labelledby="headingTen" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="danh-sach-hoa-don-tour-tron-goi.php">DS Hóa Đơn Tour Trọn Gói</a>
        <a class="collapse-item" href="danh-sach-hoa-don-khach-san.php">DS Hóa Đơn Khách Sạn</a>
        <a class="collapse-item" href="danh-sach-hoa-don-nha-hang.php">DS Hóa Đơn Nhà Hàng</a>
        <a class="collapse-item" href="danh-sach-hoa-don-phuong-tien.php">DS Hóa Đơn Phương Tiện</a>
        <a class="collapse-item" href="danh-sach-hoa-don-tour-tu-len.php">DS Hóa Đơn Tour Tự Lên</a>
      </div>
    </div>
  </li>

  <!-- Divider -->
  <!-- <hr class="sidebar-divider"> -->

  <!-- Heading -->
  <!-- <div class="sidebar-heading">
  Addons
</div> -->

  <!-- Nav Item - Pages Collapse Menu -->
  <!-- <li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
    <i class="fas fa-fw fa-folder"></i>
    <span>Pages</span>
  </a>
  <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <a class="collapse-item" href="news.php">News</a>
      <a class="collapse-item" href="blank.html">Blank Page</a>
    </div>
  </div> -->
  </li>

  <!-- Nav Item - Charts -->
  <!-- <li class="nav-item">
  <a class="nav-link" href="charts.html">
    <i class="fas fa-fw fa-chart-area"></i>
    <span>Charts</span></a>
</li> -->

  <!-- Nav Item - Tables -->
  <!-- <li class="nav-item">
  <a class="nav-link" href="tables.php">
    <i class="fas fa-fw fa-table"></i>
    <span>Tables</span></a>
</li> -->

  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">

  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>

</ul>
<!-- End of Sidebar -->

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

  <!-- Main Content -->
  <div id="content">

    <!-- Topbar -->
    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

      <!-- Sidebar Toggle (Topbar) -->
      <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
      </button>


      <ul class="navbar-nav ml-auto">



        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="mr-2 d-none d-lg-inline text-gray-600 small">
              <?php
              echo '<h7 style="text-transform: uppercase;color: #4E75E5;font-weight: bold">'
                . $_SESSION['TaiKhoan'] .
                '</h7>'
              ?>


            </span>
            <img class="img-profile rounded-circle" src="img/nhan-vien/<?php echo $rw_nv["Anh"] ?>" width="30px" height="30px">
          </a>
          <!-- Dropdown - User Information -->
          <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
            <a class="dropdown-item" href="admin-profile.php">
              <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
              Thông Tin
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
              <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
              Đăng Xuất
            </a>
          </div>
        </li>

      </ul>

    </nav>
    <!-- End of Topbar -->
    <?php
    // }

    ?>

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>


    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Đăng Xuất Tài Khoản?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Chọn nút "Đăng Xuất" bên dưới để kết thúc phiên đăng nhập.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Huỷ Bỏ</button>
            <form action="logout.php" method="GET">
              <button type="submit" name="logout" class="btn btn-primary">Đăng Xuất</button>
            </form>


          </div>
        </div>
      </div>
    </div>