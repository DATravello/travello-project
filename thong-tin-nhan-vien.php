<link rel="stylesheet" type="text/css" href="css/style.css">
<?php
session_start();
$u=$_SESSION['TaiKhoan'];
?>
<?php
include("database/db_config.php");
$sql="Select * from khachhang where MaKH='$u'";
$result=mysqli_query($connection,$sql);
$rows=@mysqli_fetch_array($result);
?>
Tên khách hàng: <?php echo $rows["TenKH"] ?><br/>
Ngày Sinh: <?php echo $rows["NgaySinh"] ?><br/>
Địa Chỉ: <?php echo $rows["DiaChi"] ?><br/>
Giới Tính: <?php echo $rows["GioiTinh"] ?><br/>
Điện Thoại: <?php echo $rows["SDT"] ?><br/>
Email: <?php echo $rows["Email"] ?><br/>
</form>