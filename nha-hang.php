<?php include('include/header.php'); ?>

<!-- NỘI DUNG -->
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
		?>

		<?php
			//Query Vị Trí
			$vt = $row['MaViTri'];
			$q_vt = "SELECT * FROM vitri WHERE MaViTri = $vt";
			$rs_vt = mysqli_query($connection, $q_vt);
			$rw_vt = mysqli_fetch_array($rs_vt);
		?>

		<div class="card col-6">
			<img class="card-img-top" src="admin/img/nha-hang/<?php echo $row['Anh'] ?>?>" alt="Card image cap">
			<div class="dark-overlay">
				<div class="card-body">
					<h5 class="card-title"><?php echo $row['TenNhaHang'] ?></h5>
					<h8 class="card-title"><?php echo $rw_vt['TenViTri'] ?></h8> <br />
					<a href="chi-tiet-nha-hang.php?nhahang=<?php echo $row['MaNH']; ?>" class="btn btn-primary">Đặt Ngay</a>
				</div>
			</div>
		</div>

	<?php
	}
	echo '	</div>
	</div>
	</div>
	</div>'

	?>
</section>
<?php include('include/footer.php'); ?>