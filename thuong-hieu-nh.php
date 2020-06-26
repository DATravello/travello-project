<?php
include('include/header.php')
?>
<!-- NỘI DUNG -->
	<section class="thuong-hieu">
	<?php

	$conn = mysqli_connect("localhost", "root", "", "travello_db");
	$query = "SELECT * FROM thuonghieunh";
	$query_run = mysqli_query($conn, $query);
	$query1 = "SELECT * FROM loainhahang lnh, thuonghieunh th WHERE lnh.MaLoaiNH = th.MaLoaiNH";
	$query_run1 = mysqli_query($conn, $query1);
	$temp = "";


	?>

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
		<div class="card col-6">
			<img class="card-img-top" src="admin/img/thuong-hieu-nh/<?php echo $row['HinhAnh'] ?>?>" alt="Card image cap">
			<div class="dark-overlay">
				<div class="card-body">
					<h5 class="card-title"><?php echo $row['TenThuongHieuNH'] ?></h5>
					<!-- <p class="card-text">Từ <?php echo $row['HangSao'] ?> <i style="color:yellow;font-size:15px" class="fas fa-star"></i></p>
					<h8 class="card-title"><?php echo $row['ViTri'] ?></h8> <br/> -->
					<a href="nha-hang.php?thuonghieunh=<?php echo $row['MaThuongHieuNH']; ?>" class="btn btn-primary">Danh Sách Nhà Hàng</a>
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