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

	$query = "SELECT * FROM tintuc";
	$query_run = mysqli_query($connection, $query);
	$query1 = "SELECT * FROM theloai tl, tintuc tt WHERE tl.MaTheLoai = tt.MaTheLoai";
	$query_run1 = mysqli_query($connection, $query1);
	$temp = "";


	?>

	<?php
	while ($row = mysqli_fetch_assoc($query_run1)) {

	?>

		<?php
		if ($temp != $row['MaTheLoai']) {
			echo '</div></div><h3 style="text-align:center; margin: 50px">' . $row['TenTheLoai'] . '</h3>
			<div class="card-deck">
				<div class="row">';
			$temp = $row['MaTheLoai'];
		}
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
	echo '		</div>
	</div>'
	?>

</section>


<?php include('include/footer.php'); ?>