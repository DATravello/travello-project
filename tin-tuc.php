<?php
include('include/header.php');
?>

<title>Tin Tức | Travello</title>
<!-- NỘI DUNG -->
<section class="container tin-tuc">

	<style>
		.tin-tuc .card {
			max-height: none;
		}

		.tin-tuc .card .card-body {
			padding: 1.25rem !important;
		}
	</style>
	<?php
	$query = "SELECT * FROM theloai tl, tintuc tt WHERE tl.MaTheLoai = tt.MaTheLoai AND tl.MaTheLoai = 1";
	$query_run = mysqli_query($connection, $query);
	?>
	<h3 style="text-align:center; margin: 50px">Ẩm Thực</h3>
	<div class="card-deck">
		<div class="row">
			<?php
			while ($row = mysqli_fetch_assoc($query_run)) {

			?>

				<div class="card col-6">
					<img class="card-img-top" src="admin/img/tin-tuc/<?php echo $row['HinhAnh'] ?>" alt="Card image cap">
					<div class="dark-overlay">
						<div class="card-body">
							<h5 class="card-title"><?php echo $row['TenTinTuc'] ?></h5>
							<p class="card-text"><?php echo $row['MoTa'] ?></p>
							<a href="chi-tiet-tin-tuc.php?tintuc=<?php echo $row['MaTinTuc']; ?>" class="btn btn-primary">Xem Tin</a>
						</div>
					</div>
				</div>

			<?php
			}
			?>
		</div>
	</div>

	<?php

$query1 = "SELECT * FROM theloai tl, tintuc tt WHERE tl.MaTheLoai = tt.MaTheLoai AND tl.MaTheLoai = 7";
$query_run1 = mysqli_query($connection, $query1);
?>
<h3 style="text-align:center; margin: 50px">Cẩm Nang Du Lịch</h3>
<div class="card-deck">
	<div class="row">
		<?php
		while ($row = mysqli_fetch_assoc($query_run1)) {

		?>

			<div class="card col-6">
				<img class="card-img-top" src="admin/img/tin-tuc/<?php echo $row['HinhAnh'] ?>" alt="Card image cap">
				<div class="dark-overlay">
					<div class="card-body">
						<h5 class="card-title"><?php echo $row['TenTinTuc'] ?></h5>
						<p class="card-text"><?php echo $row['MoTa'] ?></p>
						<a href="chi-tiet-tin-tuc.php?tintuc=<?php echo $row['MaTinTuc']; ?>" class="btn btn-primary">Xem Tin</a>
					</div>
				</div>
			</div>

		<?php
		}
		?>
	</div>
</div>

</section>


<?php include('include/footer.php'); ?>