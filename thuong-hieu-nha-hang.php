<?php
include('include/header.php')
?>
<title>Thương Hiệu Nhà Hàng | Travello</title>
<!-- NỘI DUNG -->
<section class="container destination">
	<?php

	$query = "SELECT * FROM thuonghieunh";
	$query_run = mysqli_query($connection, $query);
	$query1 = "SELECT * FROM loainhahang lnh, thuonghieunh th WHERE lnh.MaLoaiNH = th.MaLoaiNH";
	$query_run1 = mysqli_query($connection, $query1);
	$temp = "";
	?>
	<div class="row">
		<?php
		while ($row = mysqli_fetch_assoc($query_run1)) {

		?>

			<?php
			if ($temp != $row['MaLoaiNH']) {
				echo '</div></div><h3 style="text-align:center; margin: 50px">' . $row['TenLoaiNH'] . '</h3>
			<div class="card-deck">
				<div class="row">';
				$temp = $row['MaLoaiNH'];
			}
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