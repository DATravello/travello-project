<?php
include('include/header.php')
?>
<!-- NỘI DUNG -->
	<section class="thuong-hieu">
	<?php

	$conn = mysqli_connect("localhost", "root", "", "travello_db");
	$query = "SELECT * FROM thuonghieuks";
	$query_run = mysqli_query($conn, $query);
	$query1 = "SELECT * FROM loaikhachsan lks, thuonghieuks th WHERE lks.MaLoaiKS = th.MaLoaiKS";
	$query_run1 = mysqli_query($conn, $query1);
	$temp = "";


	?>

	<?php
	while ($row = mysqli_fetch_assoc($query_run1)) {

	?>

		<?php
		if ($temp != $row['MaLoaiKS']) {
			echo '</div></div><h3 style="text-align:center; margin: 50px">' . $row['TenLoaiKS'] . '</h3>
			<div class="card-deck">
				<div class="row">';
			$temp = $row['MaLoaiKS'];
		}
		?>
		<div class="card col-6">
			<img class="card-img-top" src="admin/img/thuong-hieu-ks/<?php echo $row['HinhAnh'] ?>?>" alt="Card image cap">
			<div class="dark-overlay">
				<div class="card-body">
					<h5 class="card-title"><?php echo $row['TenThuongHieuKS'] ?></h5>
					<!-- <p class="card-text">Từ <?php echo $row['HangSao'] ?> <i style="color:yellow;font-size:15px" class="fas fa-star"></i></p>
					<h8 class="card-title"><?php echo $row['ViTri'] ?></h8> <br/> -->
					<a href="khach-san.php?thuonghieu=<?php echo $row['MaThuongHieuKS']; ?>" class="btn btn-primary">Danh Sách Khách Sạn</a>
				</div>
			</div>
		</div>

	<?php
	}
		echo '	</div>
	</div>'
	?>

</section>
</body>
<script src="scripts/jquery-3.5.1.slim.min.js"></script>
<script src="scripts/popper.min.js"></script>
<script src="scripts/bootstrap.min.js"></script>
<script src="scripts/fontawesome-kit.js"></script>
<script src="scripts/scroll.js"></script>

</html>