<<<<<<< Updated upstream
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
=======
<?php
include('include/header.php')
?>
<!-- NỘI DUNG -->
<section class="khach-san">
	<?php

	$conn = mysqli_connect("localhost", "root", "", "travello_db");
	$query = "SELECT * FROM khachsan";
	$query_run = mysqli_query($conn, $query);
	$query1 = "SELECT * FROM thuonghieuks , khachsan  WHERE thuonghieuks.MaThuongHieuKS = khachsan.MaThuongHieuKS and thuonghieuks.MaThuongHieuKS=".$_GET['thuonghieu'];
	$query_run1 = mysqli_query($conn, $query1);
	$temp = " ";
	?>

	<?php
	while ($row = mysqli_fetch_assoc($query_run1)) {

	?>

		<?php
		if ($temp != $row['MaThuongHieuKS']) {
			echo '</div></div><h3 style="text-align:center; margin: 10px">' . $row['TenThuongHieuKS'] . '</h3>
			<div class="row">';
				echo '</div></div><h5 style="text-align:center; margin-top: 2px; margin-bottom: 10px">' . $row['MoTa'] . '</h5>
			<div class="card-deck">
				<div class="row">';
			$temp = $row['MaThuongHieuKS'];
		}
		?>
		
		<div class="card col-6">
			<img class="card-img-top" src="admin/img/khach-san/<?php echo $row['Anh'] ?>?>" alt="Card image cap">
			<div class="dark-overlay">
				<div class="card-body">
					<h5 class="card-title"><?php echo $row['TenKS'] ?></h5>
					<p class="card-text">Từ <?php echo $row['HangSao'] ?> <i style="color:yellow;font-size:15px" class="fas fa-star"></i></p>
					<h8 class="card-title"><?php echo $row['ViTri'] ?></h8> <br />
					<a href="chi-tiet-khach-san.php?khachsan=<?php echo $row['MaKS']; ?>" class="btn btn-primary">Đặt Ngay</a>
				</div>
			</div>
		</div>

	<?php
	}
	echo '	</div>
>>>>>>> Stashed changes
	</div>
	</div>
	</div>'
	
	?>

</section>
<<<<<<< Updated upstream
=======
</body>
<script src="scripts/jquery-3.5.1.slim.min.js"></script>
<script src="scripts/popper.min.js"></script>
<script src="scripts/bootstrap.min.js"></script>
<script src="scripts/fontawesome-kit.js"></script>
<script src="scripts/scroll.js"></script>
>>>>>>> Stashed changes


<?php include('include/footer.php'); ?>