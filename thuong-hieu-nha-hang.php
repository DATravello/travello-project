<?php
include('include/header.php')
?>
<title>Thương Hiệu Nhà Hàng | Travello</title>
<!-- NỘI DUNG -->
<section class="container destination">
	<?php
	$query = "SELECT * FROM loainhahang lnh, thuonghieunh th WHERE lnh.MaLoaiNH = th.MaLoaiNH AND th.MaLoaiNH = 1";
	$query_run = mysqli_query($connection, $query);
	?>
	<h3 style="text-align:center; margin: 50px">Nhà Hàng Trong Nước</h3>
	<div class="row">
		<?php
		while ($row = mysqli_fetch_assoc($query_run)) {
		?>
			<div class="col-md-4">
				<a href="nha-hang-theo-vi-tri.php?thuonghieu=<?php echo $row['MaThuongHieuNH']; ?>">
					<div class="card">
						<img class="img-destination" src="admin/img/thuong-hieu-nh/<?php echo $row['HinhAnh'] ?>" alt="Card image cap">
						<h5 class="title-destination"><?php echo $row['TenThuongHieuNH'] ?></h5>
						<p class="subtitle-destination">
							<?php //echo $rw_soks["Total"] 
							?> Nhà Hàng
						</p>
					</div>
				</a>
			</div>
		<?php
		}
		?>
	</div>

	<?php
	$query1 = "SELECT * FROM loainhahang lnh, thuonghieunh th WHERE lnh.MaLoaiNH = th.MaLoaiNH AND th.MaLoaiNH = 2";
	$query_run1 = mysqli_query($connection, $query1);
	?>
	<h3 style="text-align:center; margin: 50px">Nhà Hàng Quốc Tế</h3>
	<div class="row">
		<?php
		while ($row = mysqli_fetch_assoc($query_run1)) {
		?>
			<div class="col-md-4">
				<a href="nha-hang-theo-vi-tri.php?thuonghieu=<?php echo $row['MaThuongHieuNH']; ?>">
					<div class="card">
						<img class="img-destination" src="admin/img/thuong-hieu-nh/<?php echo $row['HinhAnh'] ?>" alt="Card image cap">
						<h5 class="title-destination"><?php echo $row['TenThuongHieuNH'] ?></h5>
						<p class="subtitle-destination">
							<?php //echo $rw_soks["Total"] 
							?> Nhà Hàng
						</p>
					</div>
				</a>
			</div>
		<?php
		}
		?>
	</div>
</section>
<?php include('include/footer.php'); ?>