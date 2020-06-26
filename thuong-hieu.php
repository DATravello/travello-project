<?php
include('include/header.php')
?>


<!-- NỘI DUNG -->
<section class="container thuong-hieu">
	<?php

	$conn = mysqli_connect("localhost", "root", "", "travello_db");
	$query = "SELECT * FROM thuonghieuks";
	$query_run = mysqli_query($conn, $query);
	$query1 = "SELECT * FROM thuonghieuks th, loaikhachsan tl WHERE tl.MaLoaiKS = th.MaLoaiKS";
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
			<img class="card-img-top" src="admin/img/thuong-hieu-ks/<?php echo $row['HinhAnh'] ?>" alt="Card image cap">
			<div class="dark-overlay">
				<div class="card-body">
					<h5 class="card-title"><?php echo $row['TenThuongHieuKS'] ?></h5>
					<!-- <p class="card-text"><?php echo $row['MoTa'] ?></p> -->
					<a href="khach-san.php?thuonghieu=<?php echo $row['MaThuongHieuKS']; ?>" class="btn btn-primary">Danh Sách Khách Sạn</a>
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