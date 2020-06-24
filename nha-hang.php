<?php include('include/header.php'); ?>

<!-- NỘI DUNG -->
<<<<<<< Updated upstream

	<section class="nha-hang">
		<?php
		$query = "SELECT * from nhahang";
		$result = mysqli_query($connection, $query);
		$rows = mysqli_fetch_array($result);
=======
<section class="nha-hang">
	<?php

	$conn = mysqli_connect("localhost", "root", "", "travello_db");
	$query = "SELECT * FROM nhahang";
	$query_run = mysqli_query($conn, $query);
	$query1 = "SELECT * FROM thuonghieunh , nhahang  WHERE thuonghieunh.MaThuongHieuNH = nhahang.MaThuongHieuNH and thuonghieunh.MaThuongHieuNH=".$_GET['thuonghieunh'];
	$query_run1 = mysqli_query($conn, $query1);
	$temp = " ";
	?>
	
	<?php
	while ($row = mysqli_fetch_assoc($query_run1)) {

	?>

		<?php
		if ($temp != $row['MaThuongHieuNH']) {
			echo '</div></div><h3 style="text-align:center; margin: 20px">' . $row['TenThuongHieuNH'] . '</h3>
			
				<div class="row">';
			echo '</div></div><h5 style="text-align:center; margin: 10px;">' . $row['MoTa'] . '</h5>
			<div class="card-deck">
				<div class="row">';
			$temp = $row['MaThuongHieuNH'];
		}
>>>>>>> Stashed changes
		?>

<<<<<<< Updated upstream
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
=======
		<div class="card col-6">
			<img class="card-img-top" src="admin/img/nha-hang/<?php echo $row['Anh'] ?>?>" alt="Card image cap">
			<div class="dark-overlay">
				<div class="card-body">
					<h5 class="card-title"><?php echo $row['TenNhaHang'] ?></h5>
					<p class="card-text">Từ <?php echo $row['GioiThieuNH'] ?> <i style="color:yellow;font-size:15px" class="fas fa-star"></i></p>
					<h8 class="card-title"><?php echo $row['ViTri'] ?></h8> <br />
					<a href="chi-tiet-nha-hang.php?nhahang=<?php echo $row['MaNH']; ?>" class="btn btn-primary">Đặt Ngay</a>
>>>>>>> Stashed changes
				</div>
			</div>
		</div>
<<<<<<< Updated upstream
		<?php
		?>
	</section>
=======

	<?php
	}
	echo '	</div>
	</div>
	</div>
	</div>'

	?>
</section>
</body>
<script src="scripts/jquery-3.5.1.slim.min.js"></script>
<script src="scripts/popper.min.js"></script>
<script src="scripts/bootstrap.min.js"></script>
<script src="scripts/fontawesome-kit.js"></script>
<script src="scripts/scroll.js"></script>
>>>>>>> Stashed changes

<?php include('include/footer.php'); ?>

