<?php include('include/header.php'); ?>

<!-- NỘI DUNG -->
<section class="container khach-san">
	<?php
	$query = "SELECT * from khachsan";
	$result = mysqli_query($connection, $query);
	?>


	<div class="card-deck">
		<div class="row">
			<?php
			$temp = "";
			while ($rows = @mysqli_fetch_assoc($result)) {
				if ($temp == $rows['MaKS']) {
					$temp = $rows['MaKS'];

				}

			?>

				<div class="card col-md-6">
					<img class="card-img-top" src="admin/img/khach-san/<?php echo $rows['Anh'] ?>" alt="Card image cap">
					<div class="dark-overlay">
						<div class="card-body">
							<h5 class="card-title"><?php echo $rows['TenKS'] ?></h5>
							<p class="card-text">Từ <?php echo $rows['HangSao'] ?> <i style="color:yellow;font-size:15px" class="fas fa-star"></i></p>
							<a href="chi-tiet-khach-san.php?khachsan=<?php echo $rows['MaKS']; ?>" class="btn btn-primary">Đặt Ngay</a>
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