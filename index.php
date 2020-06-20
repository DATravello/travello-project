<?php
session_start();

include('database/db_config.php');
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
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
                            if (isset($_SESSION['Email']) && $_SESSION['Email']){
                                echo '<a class="nav-link" href="#"><i class="fas fa-user"></i></a>';
                            }
                            else{
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
                    <div class="carousel-caption d-none d-md-block animate__animated animate__fadeInUp"
                        style="animation-delay: .3s;">
                        <h5>KHÁM PHÁ THẾ GIỚI</h5>
                        <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
                        <p><a href="#search">Tìm Kiếm Ngay</a></p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="img/home_slider.jpg" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block animate__animated animate__fadeInUp"
                        style="animation-delay: .3s;">
                        <h5>Trải Nghiệm Mới</h5>
                        <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
                        <p><a href="#">Thêm Thông Tin</a></p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="img/home_slider.jpg" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block animate__animated animate__fadeInUp"
                        style="animation-delay: .3s;">
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


    <div class="d-flex justify-content-center align-items-center ">


        <form class="search" id="search">
            <h5>TÌM KIẾM TOUR</h5>
            <div class="form-row">
                <div class="col-xs-8 input-group-lg">
                    <select class="custom-select" id="inlineFormCustomSelect">
                        <option selected>Nơi Đi</option>
                        <option value="1">TP. Hồ Chí Minh</option>
                        <option value="2">Hà Nội</option>
                        <option value="3">Đà Nẵng</option>
                        <option value="3">Huế</option>
                    </select>
                </div>
                <div class="col-xs-8 input-group-lg">
                    <select class="custom-select" id="inlineFormCustomSelect">
                        <option selected>Nơi Đến</option>
                        <option value="1">TP. Hồ Chí Minh</option>
                        <option value="2">Hà Nội</option>
                        <option value="3">Đà Nẵng</option>
                        <option value="3">Huế</option>
                    </select>
                </div>
                <div class="col-xs-8 input-group-lg align-middle">
                    <input type="date" class="form-control" placeholder="Thời Gian">
                </div>
                <div class="col-xs-8">
                    <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
                </div>
            </div>
        </form>
    </div>



    <div class="card-group">
        <div class="card">
            <img class="card-img-top" src="img/travello.jpg" alt="Card image cap">
            <div class="dark-overlay">
                <div class="card-body">
                    <h5 class="card-title">Tour Đặt Nhiều</h5>
                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to
                        additional content. This content is a little bit longer.</p>
                    <a href="#" class="btn btn-primary">Đặt Ngay</a>
                </div>
            </div>
        </div>
        <div class="card">
            <img class="card-img-top" src="img/travel-2.jpg" alt="Card image cap">
            <div class="dark-overlay">
                <div class="card-body">
                    <h5 class="card-title">Tour Trong Nước</h5>
                    <p class="card-text">This card has supporting text below as a natural lead-in to additional content.
                    </p>
                    <a href="#" class="btn btn-primary">Đặt Ngay</a>
                </div>
            </div>
        </div>
        <div class="card">
            <img class="card-img-top" src="img/travel-1.jpg" alt="Card image cap">
            <div class="dark-overlay">
                <div class="card-body">
                    <h5 class="card-title">Tour Nước Ngoài</h5>
                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to
                        additional content. This card has even longer content than the first to show that equal height
                        action.</p>
                    <a href="#" class="btn btn-primary">Đặt Ngay</a>
                </div>
            </div>

        </div>
    </div>

    <div class="intro">
        <div class="row">
            <div class="col">
                <div class="intro_container">
                    <div class="row">
                        <div class="col-lg-4 intro-col">
                            <div class="intro-item d-flex flex-row align-items-end justify-content-start">
                                <div class="intro-icon"><img src="img/beach.svg"></div>
                                <div class="intro-content">
                                    <div class="intro-title">ĐIỂM ĐẾN HẤP DẪN</div>
                                    <div class="intro-subtitle">Lorem ipsum dolor sit amet consectetur adipisicing.</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="intro-item d-flex flex-row align-items-end justify-content-start">
                                <div class="intro-icon"><img src="img/wallet.svg"></div>
                                <div class="intro-content">
                                    <div class="intro-title">GIÁ CẢ TỐT NHẤT</div>
                                    <div class="intro-subtitle">Lorem ipsum dolor sit amet consectetur adipisicing.</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="intro-item d-flex flex-row align-items-end justify-content-start">
                                <div class="intro-icon"><img src="img/suitcase.svg"></div>
                                <div class="intro-content">
                                    <div class="intro-title">DỊCH VỤ TUYỆT VỜI</div>
                                    <div class="intro-subtitle">Lorem ipsum dolor sit amet consectetur adipisicing.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- <div class="card-group">
        <div class="card">
          <img class="card-img-top" src="/img/travello.jpg" alt="Card image cap">
          <div class="dark-overlay">
          <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
          </div>
          </div>
        </div>
        <div class="card">
          <img class="card-img-top" src="/img/travello.jpg" alt="Card image cap">
          <div class="dark-overlay">
          <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
          </div>
          </div>
        </div>
        <div class="card">
          <img class="card-img-top" src="/img/travello.jpg" alt="Card image cap">
          <div class="dark-overlay">
          <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>
          </div>
          
        </div> -->

    <!-- </div> -->


    <!-- TOUR ĐẶT NHIỀU -->
    <section class="tour-hot">
    <?php
        $query="SELECT * from loaitourdulich";
        $result = mysqli_query($connection, $query);
        $query2="SELECT * from tourdulich where MaLoaiTour='1'";
	    $result2=mysqli_query($connection, $query2);
        $query3="SELECT * from loaitourdulich where MaLoaiTour='1'";
		$result3=mysqli_query($connection, $query3);
		$rows3=mysqli_fetch_array($result3);
    ?>
        <h5><?php echo $rows3['TenLoaiTour'] ?></h5>
        <div class="card-deck">
            <div class="row">

            <?php
			    while($rows=@mysqli_fetch_array($result2))
			    {
			?>
            <div class="card col-6">
                <img class="card-img-top" src="admin/img/tour-du-lich/<?php echo $rows['Anh'] ?>" alt="Card image cap">
                <div class="dark-overlay">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $rows['TenTour'] ?></h5>
                        <p class="card-text">Từ <?php echo $rows['GiaTien'] ?></p>
                        <a href="chi-tiet-tour.php?tour=<?php echo $rows['MaTour'];?>" class="btn btn-primary">Đặt Ngay</a>
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

    <!-- TOUR TRONG NƯỚC -->
    <section class="tour-hot">
        <h5>TOUR TRONG NƯỚC</h5>
        <div class="card-deck">
            <div class="card col-6">
                <img class="card-img-top" src="img/travello.jpg" alt="Card image cap">
                <div class="dark-overlay">
                    <div class="card-body">
                        <h5 class="card-title">Hawai</h5>
                        <p class="card-text">Từ 5.000.000 VNĐ</p>
                        <a href="#" class="btn btn-primary">Đặt Ngay</a>
                    </div>
                </div>
            </div>
            <div class="card">
                <img class="card-img-top" src="img/travel-2.jpg" alt="Card image cap">
                <div class="dark-overlay">
                    <div class="card-body">
                        <h5 class="card-title">Hawai</h5>
                        <p class="card-text">Từ 5.000.000 VNĐ</p>
                        <a href="#" class="btn btn-primary">Đặt Ngay</a>
                    </div>
                </div>
            </div>
            <div class="card">
                <img class="card-img-top" src="img/travel-1.jpg" alt="Card image cap">
                <div class="dark-overlay">
                    <div class="card-body">
                        <h5 class="card-title">Hawai</h5>
                        <p class="card-text">Từ 5.000.000 VNĐ</p>
                        <a href="#" class="btn btn-primary">Đặt Ngay</a>
                    </div>
                </div>

            </div>

        </div>
        <div class="card-deck">
            <div class="card">
                <img class="card-img-top" src="img/travello.jpg" alt="Card image cap">
                <div class="dark-overlay">
                    <div class="card-body">
                        <h5 class="card-title">Hawai</h5>
                        <p class="card-text">Từ 5.000.000 VNĐ</p>
                        <a href="#" class="btn btn-primary">Đặt Ngay</a>
                    </div>
                </div>
            </div>
            <div class="card">
                <img class="card-img-top" src="img/travel-2.jpg" alt="Card image cap">
                <div class="dark-overlay">
                    <div class="card-body">
                        <h5 class="card-title">Hawai</h5>
                        <p class="card-text">Từ 5.000.000 VNĐ</p>
                        <a href="#" class="btn btn-primary">Đặt Ngay</a>
                    </div>
                </div>
            </div>
            <div class="card">
                <img class="card-img-top" src="img/travel-1.jpg" alt="Card image cap">
                <div class="dark-overlay">
                    <div class="card-body">
                        <h5 class="card-title">Hawai</h5>
                        <p class="card-text">Từ 5.000.000 VNĐ</p>
                        <a href="#" class="btn btn-primary">Đặt Ngay</a>
                    </div>
                </div>

            </div>

        </div>
        <!-- TOUR NƯỚC NGOÀI -->
    <section class="tour-hot">
        <h5>TOUR NƯỚC NGOÀI</h5>
        <div class="card-deck">
            <div class="card">
                <img class="card-img-top" src="img/travello.jpg" alt="Card image cap">
                <div class="dark-overlay">
                    <div class="card-body">
                        <h5 class="card-title">Hawai</h5>
                        <p class="card-text">Từ 5.000.000 VNĐ</p>
                        <a href="#" class="btn btn-primary">Đặt Ngay</a>
                    </div>
                </div>
            </div>
            <div class="card">
                <img class="card-img-top" src="img/travel-2.jpg" alt="Card image cap">
                <div class="dark-overlay">
                    <div class="card-body">
                        <h5 class="card-title">Hawai</h5>
                        <p class="card-text">Từ 5.000.000 VNĐ</p>
                        <a href="#" class="btn btn-primary">Đặt Ngay</a>
                    </div>
                </div>
            </div>
            <div class="card">
                <img class="card-img-top" src="img/travel-1.jpg" alt="Card image cap">
                <div class="dark-overlay">
                    <div class="card-body">
                        <h5 class="card-title">Hawai</h5>
                        <p class="card-text">Từ 5.000.000 VNĐ</p>
                        <a href="#" class="btn btn-primary">Đặt Ngay</a>
                    </div>
                </div>

            </div>

        </div>
        <div class="card-deck">
            <div class="card">
                <img class="card-img-top" src="img/travello.jpg" alt="Card image cap">
                <div class="dark-overlay">
                    <div class="card-body">
                        <h5 class="card-title">Hawai</h5>
                        <p class="card-text">Từ 5.000.000 VNĐ</p>
                        <a href="#" class="btn btn-primary">Đặt Ngay</a>
                    </div>
                </div>
            </div>
            <div class="card">
                <img class="card-img-top" src="img/travel-2.jpg" alt="Card image cap">
                <div class="dark-overlay">
                    <div class="card-body">
                        <h5 class="card-title">Hawai</h5>
                        <p class="card-text">Từ 5.000.000 VNĐ</p>
                        <a href="#" class="btn btn-primary">Đặt Ngay</a>
                    </div>
                </div>
            </div>
            <div class="card">
                <img class="card-img-top" src="img/travel-1.jpg" alt="Card image cap">
                <div class="dark-overlay">
                    <div class="card-body">
                        <h5 class="card-title">Hawai</h5>
                        <p class="card-text">Từ 5.000.000 VNĐ</p>
                        <a href="#" class="btn btn-primary">Đặt Ngay</a>
                    </div>
                </div>

            </div>

        </div>
    </section>


</body>
<script src="scripts/jquery-3.5.1.slim.min.js"></script>
<script src="scripts/popper.min.js"></script>
<script src="scripts/bootstrap.min.js"></script>
<script src="scripts/fontawesome-kit.js"></script>
<script src="scripts/scroll.js"></script>

</html>