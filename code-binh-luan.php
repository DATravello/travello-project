<?php
include('security.php');
if (isset($_POST["btnBinhLuan"])) {

    $matour = $_GET['tour'];

    $query = "SELECT * from tourdulich where MaTour='$matour'";
    $result = mysqli_query($connection, $query);
    $rows = @mysqli_fetch_array($result);
    $tentour = $rows["TenTour"];


    //query KH
    $email = $_SESSION["Email"];
    $q_khach = "SELECT * FROM khachhang WHERE Email = '$email'";
    $rs_khach = mysqli_query($connection, $q_khach);
    $rw_khach = @mysqli_fetch_array($rs_khach);

    $makh = $rw_khach["MaKH"];


    $noidung = $_POST["NoiDung"];
    //Querry Nhan Xet
    if ($makh == "" || $noidung == "" || $matour == "") {
        echo '<div class="alert alert-success">Không được để trống!</div>';
    } else {
        $qr_nx = "INSERT INTO nhanxet (`MaTour`, `MaKH`, `NoiDung`) VALUES('$matour', '$makh', '$noidung')";
        $rs_nx = mysqli_query($connection, $qr_nx);

        if ($rs_nx) {
            $_SESSION['BLSuccess'] = 'Thành Công!';
        } else {
            $_SESSION['BLSuccess'] = 'Thất Bại!';
        }
    }
}
?>