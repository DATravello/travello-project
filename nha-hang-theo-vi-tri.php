<?php include('include/header.php'); ?>

<!-- NỘI DUNG -->

<section class="container destination">
	<?php
	if (isset($_GET['thuonghieu'])) {
		$math = $_GET['thuonghieu'];
		require_once('database/db_config.php');

		//QUERY Nhà Hàng, Vị Trí theo Mã thương hiệu
		$q_nh = "SELECT * FROM vitri vt, nhahang nh Where vt.MaViTri = nh.MaViTri and MaThuongHieuNH = '$math'";
		$rs_nh = mysqli_query($connection, $q_nh);
	}
	?>
	<div class="row">
		<?php
		while ($rw_nh = mysqli_fetch_array($rs_nh)) {
			$mavt = $rw_nh["MaViTri"];
			//Query vị trí
			$q_vt = "SELECT * FROM vitri WHERE MaViTri = '$mavt'";
			$rs_vt = mysqli_query($connection, $q_vt);



			while ($rw_vt = mysqli_fetch_array($rs_vt)) {
				$sonh = "SELECT COUNT(*) AS Total FROM nhahang WHERE MaThuongHieuNH = $math And MaViTri = $mavt";
				$rs_sonh = mysqli_query($connection, $sonh);
				$rw_sonh = mysqli_fetch_array($rs_sonh);
		?>

				<div class="col-md-4">
					<a href="nha-hang.php?diem-den=<?php echo $rw_nh["MaViTri"] ?>&thuong-hieu=<?php echo $math?>">
						<div class="card">
							<img class="img-destination" src="admin/img/diem-den/<?php echo $rw_vt["Anh"];?>" alt="Card image cap">
							<h5 class="title-destination"><?php echo $rw_nh["TenViTri"]; ?></h5>
							<p class="subtitle-destination">
								<?php echo $rw_sonh["Total"] ?> Nhà Hàng
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