<?php include('include/header.php'); ?>

<!-- NỘI DUNG -->
<section class="container khach-san">
	<?php
	$conn = mysqli_connect("localhost", "root", "", "travello_db");
	$query = "SELECT * FROM khachsan";
	$query_run = mysqli_query($conn, $query);
	$query1 = "SELECT * FROM thuonghieuks th, khachsan ks WHERE th.MaThuongHieuKS = ks.MaThuongHieuKs and th.MaThuongHieuKS=" . $_GET['thuonghieu'];
	$query_run1 = mysqli_query($conn, $query1);
	$temp = "";
	?>
	<?php
	while ($row = mysqli_fetch_assoc($query_run1)) {

	?>
		<?php
		if ($temp != $row['MaThuongHieuKS']) {
			echo '</div></div><h3 style="text-align:center; margin: 20px">' . $row['TenThuongHieuKS'] . '</h3>
				<div class="row">';
				echo '</div></div><h5 style="text-align:center; margin: 10px">' . $row['MoTa'] . '</h5>
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
					<p class="card-text"> <?php echo $row['HangSao'] ?> <i style="color:yellow;font-size:15px" class="fas fa-star"></i></p>
					<a href="chi-tiet-khach-san.php?khachsan=<?php echo $row['MaKS']; ?>" class="btn btn-primary">Đặt Khách Sạn</a>
				</div>
			</div>
		</div>

	<?php
	}
	echo '	</div>
	</div>'
	?>

</section>

<?php include('include/footer.php'); ?>