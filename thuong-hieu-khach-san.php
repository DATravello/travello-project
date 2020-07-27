<?php
include('include/header.php');
?>
<title>Thương Hiệu Khách Sạn | Travello</title>

<!-- NỘI DUNG -->
<section class="container destination">
	<?php
	$query = "SELECT * FROM thuonghieuks th, loaikhachsan tl WHERE tl.MaLoaiKS = th.MaLoaiKS AND th.MaLoaiKS = 1";
	$query_run = mysqli_query($connection, $query);
	?>
	<h3 style="text-align:center; margin: 50px">Khách Sạn Trong Nước</h3>
	<div class="row">
		<?php
		while ($row = mysqli_fetch_assoc($query_run)) {
		?>

			<div class="col-md-4">
				<a href="khach-san-theo-vi-tri.php?thuonghieu=<?php echo $row['MaThuongHieuKS']; ?>">
					<div class="card">
						<img class="img-destination" src="admin/img/thuong-hieu-ks/<?php echo $row['HinhAnh'] ?>" alt="Card image cap">
						<h5 class="title-destination"><?php echo $row['TenThuongHieuKS'] ?></h5>
						<p class="subtitle-destination">
							<?php //echo $rw_soks["Total"] 
							?> Khách Sạn
						</p>
					</div>
				</a>
			</div>
		<?php
		}
		?>
	</div>

	<?php
	$query1 = "SELECT * FROM thuonghieuks th, loaikhachsan tl WHERE tl.MaLoaiKS = th.MaLoaiKS AND th.MaLoaiKS = 2";
	$query_run1 = mysqli_query($connection, $query1);

	?>
	<h3 style="text-align:center; margin: 50px">Khách Sạn Quốc Tế</h3>
	<div class="row">
		<?php
		while ($row = mysqli_fetch_assoc($query_run1)) {
		?>

			<div class="col-md-4">
				<a href="khach-san-theo-vi-tri.php?thuonghieu=<?php echo $row['MaThuongHieuKS']; ?>">
					<div class="card">
						<img class="img-destination" src="admin/img/thuong-hieu-ks/<?php echo $row['HinhAnh'] ?>" alt="Card image cap">
						<h5 class="title-destination"><?php echo $row['TenThuongHieuKS'] ?></h5>
						<p class="subtitle-destination">
							<?php //echo $rw_soks["Total"] 
							?> Khách Sạn
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