<?php include('include/header.php'); ?>

<!-- NỘI DUNG -->

	<section class="nha-hang">
		<?php
		$query = "SELECT * from nhahang";
		$result = mysqli_query($connection, $query);
		$rows = mysqli_fetch_array($result);
		?>
		<!-- <h5><?php echo $rows['TenNhaHang'] ?></h5> -->
		<div class="card-deck">
		<div class="row">

			<?php
			while ($rows = @mysqli_fetch_array($result)) {
			?>
				<div class="card col-6">
					<img class="card-img-top" src="admin/img/nha-hang/<?php echo $rows['Anh'] ?>" alt="Card image cap">
					<div class="dark-overlay">
						<div class="card-body">
							<h5 class="card-title"><?php echo $rows['TenNhaHang'] ?></h5>
							<p class="card-text">Giá: <?php echo $rows['GiaNH'] ?> VNĐ</p>
							<a href="chi-tiet-nha-hang.php?nhahang=<?php echo $rows['MaNH']; ?>" class="btn btn-primary">Đặt Ngay</a>
						</div>
					</div>
				</div>
			<?php
			}
			?>
		</div>
		</div>
		<?php
		?>
	</section>

<?php include('include/footer.php'); ?>

