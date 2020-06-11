
<!DOCTYPE html>
<html lang="en">
<head>
<title>About us</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="Travello template project">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="styles/bootstrap4/bootstrap.min.css">
<link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/animate.css">
<link rel="stylesheet" type="text/css" href="styles/about.css">
<link rel="stylesheet" type="text/css" href="styles/about_responsive.css">

</head>
<body>

<div class="super_container">
	
	<!-- Header -->

	<header class="header">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="header_content d-flex flex-row align-items-center justify-content-start">
						<div class="header_content_inner d-flex flex-row align-items-end justify-content-start">
							<div class="logo"><a href="index.html">Travello</a></div>
							<nav class="main_nav">
								<ul class="d-flex flex-row align-items-start justify-content-start">
									<li><a href="index.php">Trang Chủ</a></li>
									<li class="active"><a href="about.php">Giới Thiệu</a></li>
									<li><a href="#">Dịch Vụ</a></li>
									<li><a href="news.html">Tin Tức</a></li>
									<li><a href="contact.html">Liên Hệ</a></li>
								</ul>
							</nav>
							<div class="header_phone ml-auto">Call us: (+84) 32 6805 211</div>

							<!-- Hamburger -->

							<div class="hamburger ml-auto">
								<i class="fa fa-bars" aria-hidden="true"></i>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="header_social d-flex flex-row align-items-center justify-content-start">
			<ul class="d-flex flex-row align-items-start justify-content-start">
				<li><a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
				<li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
				<li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
				<li><a href="#"><i class="fa fa-dribbble" aria-hidden="true"></i></a></li>
				<li><a href="#"><i class="fa fa-behance" aria-hidden="true"></i></a></li>
				<li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
			</ul>
		</div>
	</header>

	<!-- Menu -->

	<?php
		include "include/nav_menu.php"
	?>
	
	<!-- Home -->

	<div class="home">
		<div class="background_image" style="background-image:url(images/about.jpg)"></div>
	</div>

	<!-- Search -->

	<?php
		include "include/search.php"
	?>

	<!-- About -->

	<div class="about">
		<div class="container">
			<div class="row">
				<div class="col text-center">
					<div class="section_subtitle">simply amazing places</div>
					<div class="section_title"><h2>Đôi lời về chúng tôi</h2></div>
				</div>
			</div>
			<div class="row about_row">
				<div class="col-lg-6">
					<div class="about_content">
						<div class="text_highlight">Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugit debitis officiis soluta, reiciendis labore non.</div>
						<div class="about_text">
							<p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Provident ut sunt, iusto quia eaque exercitationem totam. Cum laudantium ex cupiditate quam ipsum aperiam fuga dolores laboriosam beatae, omnis accusantium veritatis magni at quisquam quo nisi ea? Autem amet tenetur quae culpa! Officiis, saepe nostrum. Tempore magnam natus aliquam nam ullam dolorum, eveniet sapiente, aspernatur similique sint quaerat libero reiciendis obcaecati iusto asperiores labore inventore itaque assumenda repudiandae dolor accusantium magni eius minus suscipit! Expedita ex culpa ut repellat vero? Eligendi, molestias architecto. Sapiente labore rem at similique veritatis ea! Minima accusamus distinctio sapiente quas possimus mollitia corrupti molestias quis dignissimos?</p>
						</div>
						<div class="button about_button"><a href="#">read more</a></div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="about_image"><img src="images/about_1.jpg" alt=""></div>
				</div>
			</div>
		</div>
	</div>

	<!-- Milestones -->

	<div class="milestones">
		<div class="container">
			<div class="row">
				
				<!-- Milestone -->
				<div class="col-lg-3 milestone_col">
					<div class="milestone text-center">
						<div class="milestone_icon"><img src="images/mountain.svg" alt=""></div>
						<!-- <div class="milestone_counter" data-end-value="17">0</div>
						<div class="milestone_text">Online Courses</div> -->
					</div>
				</div>

				<!-- Milestone -->
				<div class="col-lg-3 milestone_col">
					<div class="milestone text-center">
						<div class="milestone_icon"><img src="images/island.svg" alt=""></div>
						<!-- <div class="milestone_counter" data-end-value="213">0</div>
						<div class="milestone_text">Students</div> -->
					</div>
				</div>

				<!-- Milestone -->
				<div class="col-lg-3 milestone_col">
					<div class="milestone text-center">
						<div class="milestone_icon"><img src="images/camera.svg" alt=""></div>
						<!-- <div class="milestone_counter" data-end-value="11923">0</div>
						<div class="milestone_text">Teachers</div> -->
					</div>
				</div>

				<!-- Milestone -->
				<div class="col-lg-3 milestone_col">
					<div class="milestone text-center">
						<div class="milestone_icon"><img src="images/boat.svg" alt=""></div>
						<!-- <div class="milestone_counter" data-end-value="15">0</div>
						<div class="milestone_text">Countries</div> -->
					</div>
				</div>

			</div>
		</div>
	</div>

	<!-- Why Choose Us -->

	<div class="why">
		<div class="parallax_background parallax-window" data-parallax="scroll" data-image-src="images/why.jpg" data-speed="0.8"></div>
		<div class="container">
			<div class="row">
				<div class="col text-center">
					<div class="section_subtitle">simply amazing places</div>
					<div class="section_title"><h2>Vì Sao Nên Chọn Chúng Tôi?</h2></div>
				</div>
			</div>
			<div class="row why_row">
				
				<!-- Why item -->
				<div class="col-lg-4 why_col">
					<div class="why_item">
						<div class="why_image">
							<img src="images/why_1.jpg" alt="">
							<div class="why_icon d-flex flex-column align-items-center justify-content-center">
								<img src="images/why_1.svg" alt="">
							</div>
						</div>
						<div class="why_content text-center">
							<div class="why_title">Dịch Vụ Nhanh</div>
							<div class="why_text">
								<p>Pellentesque sit amet elementum ccumsan sit amet mattis eget, tristique at leo.</p>
							</div>
						</div>
					</div>
				</div>

				<!-- Why item -->
				<div class="col-lg-4 why_col">
					<div class="why_item">
						<div class="why_image">
							<img src="images/why_2.jpg" alt="">
							<div class="why_icon d-flex flex-column align-items-center justify-content-center">
								<img src="images/why_2.svg" alt="">
							</div>
						</div>
						<div class="why_content text-center">
							<div class="why_title">Đội Ngũ Tuyệt Vời</div>
							<div class="why_text">
								<p>Pellentesque sit amet elementum ccumsan sit amet mattis eget, tristique at leo.</p>
							</div>
						</div>
					</div>
				</div>

				<!-- Why item -->
				<div class="col-lg-4 why_col">
					<div class="why_item">
						<div class="why_image">
							<img src="images/why_3.jpg" alt="">
							<div class="why_icon d-flex flex-column align-items-center justify-content-center">
								<img src="images/why_3.svg" alt="">
							</div>
						</div>
						<div class="why_content text-center">
							<div class="why_title">Giao Dịch Thuận Lợi</div>
							<div class="why_text">
								<p>Pellentesque sit amet elementum ccumsan sit amet mattis eget, tristique at leo.</p>
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>

	<!-- Team -->

	<div class="team">
		<div class="container">
			<div class="row">
				<div class="col text-center">
					<div class="section_subtitle">simply amazing places</div>
					<div class="section_title"><h2>Thành Viên</h2></div>
				</div>
			</div>
			<div class="row team_row">
				
				<!-- Team Item -->
				<div class="col-xl-6 col-md-3 team_col">
					<div class="team_item d-flex flex-column align-items-center justify-content-start text-center">
						<div class="team_image"><img src="images/DUyTrieu.jpg" alt=""></div>
						<div class="team_content">
							<div class="team_title"><a href="#">Cao Duy Triều</a></div>
							<div class="team_text">
								<p>Lớp: 07DHTH1</p>
								<p>MSSV: 2001160372</p>
							</div>
						</div>
					</div>
				</div>

				<!-- Team Item -->
				<div class="col-xl-6 col-md-3 team_col">
					<div class="team_item d-flex flex-column align-items-center justify-content-start text-center">
						<div class="team_image"><img src="images/DacHue.jpg" alt=""></div>
						<div class="team_content">
							<div class="team_title"><a href="#">Nguyễn Đắc Huề</a></div>
							<div class="team_text">
								<p>Lớp: 07DHTH1</p>
								<p>MSSV: 2001160372</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>>

<?php include "include/footer.php" ?>