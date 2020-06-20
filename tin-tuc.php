<?php
<<<<<<< HEAD
session_start();
include('database/db_config.php')
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Travello</title>
	<link rel="stylesheet" href="css/styles.css">
	<link rel="stylesheet" href="css/animate/animate.min.css">
	<link rel="stylesheet" href="css/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/bootstrap-4.5.0-dist/css/bootstrap.min.css">
	<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"> -->
</head>

<body>

	<!-- Wrapper -->
	<nav class="navbar navbar-expand-lg navbar-light fixed-top">
		<div class="container">
			<a class="navbar-brand" href="#">TRAVELLO</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav ml-auto">
					<li class="nav-item active">
						<a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#">Du Lịch</a>
					</li>
					<li class="nav-item">
                        <a class="nav-link" href="tin-tuc.php">Tin Tức</a>
                    </li>
					<li class="nav-item">
                        <a class="nav-link" href="khach-san.php">Khách Sạn</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="nha-hang.php">Nhà Hàng</a>
                    </li>
					<li class="nav-item">
						<a class="nav-link" href="#">Vận Chuyển</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#">Liên Hệ</a>
					</li>
				</ul>
				<ul class="navbar-nav ml-auto">
					<li class="nav-item">
						<a class="nav-link" href="#"><i class="fas fa-shopping-cart"></i></a>
					</li>
					<li class="nav-item">
						<?php
						if (isset($_SESSION['Email']) && $_SESSION['Email']) {
							echo '<a class="nav-link" href="#"><i class="fas fa-user"></i></a>';
						} else {
							echo '<a class="nav-link" href="login.php"><i class="fas fa-key"></i></a>';
						}
						// else
						// {
						//     echo '<a class="nav-link" href="login.php"><i class="fas fa-key"></i></a>';
						// }
						?>
					</li>
				</ul>
			</div>
		</div>
	</nav>

	<section class="banner">
		<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
			<ol class="carousel-indicators">
				<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
				<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
				<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
			</ol>
			<div class="carousel-inner">
				<div class="carousel-item active">
					<img src="img/home_slider.jpg" class="d-block w-100" alt="...">
					<div class="carousel-caption d-none d-md-block animate__animated animate__fadeInUp" style="animation-delay: .3s;">
						<h5>KHÁM PHÁ THẾ GIỚI</h5>
						<p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
						<p><a href="#search">Tìm Kiếm Ngay</a></p>
					</div>
				</div>
				<div class="carousel-item">
					<img src="img/home_slider.jpg" class="d-block w-100" alt="...">
					<div class="carousel-caption d-none d-md-block animate__animated animate__fadeInUp" style="animation-delay: .3s;">
						<h5>Trải Nghiệm Mới</h5>
						<p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
						<p><a href="#">Thêm Thông Tin</a></p>
					</div>
				</div>
				<div class="carousel-item">
					<img src="img/home_slider.jpg" class="d-block w-100" alt="...">
					<div class="carousel-caption d-none d-md-block animate__animated animate__fadeInUp" style="animation-delay: .3s;">
						<h5>Tìm Chuyến Đi</h5>
						<p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
						<p><a href="#">Tìm Kiếm</a></p>
					</div>
				</div>
			</div>
			<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
				<span class="carousel-control-prev-icon" aria-hidden="true"></span>
				<span class="sr-only">Previous</span>
			</a>
			<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
				<span class="carousel-control-next-icon" aria-hidden="true"></span>
				<span class="sr-only">Next</span>
			</a>
		</div>
	</section>
	<section class="tin-tuc">
    <?php
       // $query="SELECT * from theloai INNER JOIN tintuc On theloai.MaTheLoai = tintuc.MaTheLoai ORDER BY theloai";
       // $result = mysqli_query($connection, $query);
       // $query2="SELECT * from tintuc where MaTheLoai";
	  //  $result2=mysqli_query($connection, $query2);
        $query3="SELECT * from theloai";
		$result3=mysqli_query($connection, $query3);
		$rows3=mysqli_fetch_array($result3);
		//$rows3=$result3->fetchAll();
		$query_tintuc="SELECT * from tintuc"; 
		$result_tintuc=mysqli_query($connection, $query_tintuc);
		$rows_tintuc=mysqli_fetch_array($result_tintuc);
	
// Invalid argument supplied for foreach()

	?>

		
		<h5>Danh Sách Tin Tức</h5>
        <div class="card-deck">

			<?php
			  
			  $conn = mysqli_connect("localhost","root","","travello_db");
			  $query = "SELECT * FROM tintuc";
			  $query_run = mysqli_query($conn, $query);			 				
			  $query1 = "SELECT * FROM theloai tl, tintuc tt WHERE tl.MaTheLoai = tt.MaTheLoai";
			  $query_run1 = mysqli_query($conn, $query1);
				$temp = "";
				while($row=mysqli_fetch_assoc($query_run1)) 
				{					
					
						?><div> <?php
							if($temp != $row['MaTheLoai'])
							{
								echo $row['TenTheLoai'];
								$temp =$row['MaTheLoai'];				
							}
						 ?></div>				
						<?php					
									
					?>																	
								<div class="card">
									<img class="card-img-top" src="admin/img/tin-tuc/<?php echo $row['HinhAnh'] ?>" alt="Card image cap">
									<div class="dark-overlay">
									<div class="card-body">
									<h5 class="card-title"><?php echo $row['TenTinTuc'] ?></h5>
									<p class="card-text"><?php echo $row['MoTa'] ?></p>
									<a href="chi-tiet-tin-tuc.php?tintuc=<?php echo $row['MaTinTuc'];?>" class="btn btn-primary">Xem Tin</a>
									</div>
								</div>
							</div>
					<?php
					// 	}	
					// }				
				}
			// }
				?>         
        </div>
    </section>
=======
include('include/header.php')
?>
<!-- NỘI DUNG -->
<section class="tin-tuc">
	<?php

	$conn = mysqli_connect("localhost", "root", "", "travello_db");
	$query = "SELECT * FROM tintuc";
	$query_run = mysqli_query($conn, $query);
	$query1 = "SELECT * FROM theloai tl, tintuc tt WHERE tl.MaTheLoai = tt.MaTheLoai";
	$query_run1 = mysqli_query($conn, $query1);
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
>>>>>>> 4525edfa2c5407c549ecb006f17a89dbf96cc8c3
</body>
<script src="scripts/jquery-3.5.1.slim.min.js"></script>
<script src="scripts/popper.min.js"></script>
<script src="scripts/bootstrap.min.js"></script>
<script src="scripts/fontawesome-kit.js"></script>
<script src="scripts/scroll.js"></script>

</html>