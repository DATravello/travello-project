<?php
include('include/header.php');

if (isset($_GET['thuonghieu'])) {
	$math = $_GET['thuonghieu'];
	require_once('database/db_config.php');

	//QUERY Khách Sạn, Vị Trí theo Mã thương hiệu
	$q_ks = "SELECT * FROM vitri vt, khachsan ks Where vt.MaViTri = ks.MaViTri and MaThuongHieuKS = '$math'";
	$rs_ks = mysqli_query($connection, $q_ks);

	//Query Tên Thương Hiệu KS
	$q_th = "SELECT * FROM thuonghieuks WHERE MaThuongHieuKS = $math";
	$rs_th = mysqli_query($connection, $q_th);
	$rw_th = mysqli_fetch_array($rs_th);
	$thuonghieu = $rw_th["TenThuongHieuKS"];
}
?>

<title><?php echo $thuonghieu?> | Travello</title>

<!-- NỘI DUNG -->
<section class="container destination">
	<div class="row">
		<?php
		while ($rw_ks = mysqli_fetch_array($rs_ks)) {
			$mavt = $rw_ks["MaViTri"];
			//Query vị trí
			$q_vt = "SELECT * FROM vitri WHERE MaViTri = '$mavt'";
			$rs_vt = mysqli_query($connection, $q_vt);



			while ($rw_vt = mysqli_fetch_array($rs_vt)) {
				$soks = "SELECT COUNT(*) AS Total FROM khachsan WHERE MaThuongHieuKS = $math And MaViTri = $mavt";
				$rs_soks = mysqli_query($connection, $soks);
				$rw_soks = mysqli_fetch_array($rs_soks);
		?>

				<div class="col-md-4">
					<a href="khach-san.php?diem-den=<?php echo $rw_ks["MaViTri"] ?>&thuong-hieu=<?php echo $math ?>">
						<div class="card">
							<img class="img-destination" src="admin/img/diem-den/<?php echo $rw_vt["Anh"]; ?>" alt="Card image cap">
							<h5 class="title-destination"><?php echo $rw_ks["TenViTri"]; ?></h5>
							<p class="subtitle-destination">
								<?php echo $rw_soks["Total"] ?> Khách Sạn
							</p>
						</div>
					</a>

				</div>

		<?php
			}
		}
		?>
	</div>
</section>

<!-- END NỘI DUNG -->

<?php include('include/footer.php'); ?>