<?php
include('security.php');
include('includes/header.php');
include('includes/navbar.php');
?>

<?php
$connection = mysqli_connect("localhost", "root", "", "travello_db");

//Query Hoá Đơn
$query = "SELECT * FROM hoadon WHERE TinhTrang = 'Yêu Cầu Huỷ' ORDER BY NgayHuy ASC";
$query_run = mysqli_query($connection, $query);
?>

<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Danh Sách Yêu Cầu Huỷ Tour
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

                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Mã Hoá Đơn</th>
                            <th>Tên Tour</th>
                            <th>Ngày Huỷ</th>
                            <th>Tổng Tiền</th>
                            <th>Email</th>
                            <th>Điện Thoại</th>
                            <th>Lý Do Huỷ Tour</th>
                            <th>Tình Trạng Hoá Đơn</th>
                            <th>Xác Nhận</th>
                            <th>Huỷ Bỏ</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        if (mysqli_num_rows($query_run) > 0) {
                            while ($row = mysqli_fetch_assoc($query_run)) {
                                $makh = $row["MaKH"];
                                $matour = $row["MaTour"];

                                //Query Tour
                                $sql_tour = "SELECT * FROM tourdulich WHERE MaTour = $matour";
                                $qr_tour = mysqli_query($connection, $sql_tour );
                                $rw_tour = mysqli_fetch_array($qr_tour);

                                //Query Khách Hàng
                                $sql_kh = "SELECT * FROM khachhang WHERE MaKH = $makh";
                                $qr_kh = mysqli_query($connection, $sql_kh);
                                $rw_kh = mysqli_fetch_array($qr_kh);
                        ?>
                                <tr>
                                    <td><?php echo $row['MaHD']; ?></td>
                                    <td> <?php echo $rw_tour['TenTour']; ?> </td>
                                    <td> <?php echo $row['NgayHuy']; ?> </td>
                                    <td> <?php echo product_price($row['TongTien']); ?> </td>
                                    <td> <?php echo $rw_kh['Email']; ?> </td>
                                    <td> <?php echo $rw_kh['SDT']; ?> </td>
                                    <td> <?php echo $row['LyDoHuyTour']; ?> </td>
                                    <td> <?php echo $row['TinhTrangCu']; ?> </td>
                                    <td>
                                        <form action="cap-nhat-yeu-cau-huy-tour.php" method="post">
                                            <input type="hidden" name="mahd" value="<?php echo $row['MaHD']; ?>">
                                            <button type="submit" name="accept_btn" class="btn btn-success"><i class="fas fa-pen"></i></button>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="code.php" method="POST">
                                            <input type="hidden" name="mahd" value="<?php echo $row['MaHD']; ?>">
                                            <input type="hidden" name="tinhtrang" value="<?php echo $row['TinhTrangCu']; ?>">
                                            <input type="hidden" name="email" value="<?php echo $rw_kh['Email']; ?>">
                                            <input type="hidden" name="tentour" value="<?php echo $rw_tour['TenTour']; ?>">
                                            <button type="submit" name="ignore_cancel_btn" class="btn btn-danger"><i class="fas fa-pen"></i></button>
                                        </form>
                                    </td>
                                </tr>
                        <?php
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