<?php include('include/header.php'); ?>

<title>Travello | Trang Chủ</title>

<!-- SEARCH -->
<!-- <div class="d-flex justify-content-center align-items-center "> -->
<div class="container">

    <form class="search" id="search" action="search.php" method="get">
        <h5>TÌM KIẾM TOUR</h5>
        <div class="form-row">
            <div class="col-xs-8 col-md-3 form-group">
                <input type="text" name="SearchTenTour" class="form-control" placeholder="Tên Tour">
            </div>
            <div class="col-xs-8 col-md-2 form-group">

                <select class="custom-select" name="SearchNoiDi" id="inlineFormCustomSelect">
                    <option selected>Nơi Đi</option>
                    <?php
                    //Query Nơi Khởi Hành
                    $sql_noidi = "SELECT * FROM vitri";
                    $rs_noidi = mysqli_query($connection, $sql_noidi);
                    while ($rows = @mysqli_fetch_array($rs_noidi)) { ?>
                        <option value="<?php echo $rows["MaViTri"] ?>"><?php echo $rows["TenViTri"] ?></option>
                    <?php
                    }
                    ?>

                </select>
            </div>
            <div class="col-xs-8 col-md-2 form-group">
                <select class="custom-select" name="SearchNoiDen" id="inlineFormCustomSelect">
                    <option selected>Nơi Đến</option>
                    <?php
                    //Query Nơi Đến
                    $sql_noidi = "SELECT * FROM vitri";
                    $rs_noidi = mysqli_query($connection, $sql_noidi);
                    while ($rows = @mysqli_fetch_array($rs_noidi)) { ?>
                        <option value="<?php echo $rows["MaViTri"] ?>"><?php echo $rows["TenViTri"] ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
            <div class="col-xs-8 col-md-3 form-group align-middle">
                <input type="date" name="SearchNgayDi" class="form-control" placeholder="Thời Gian">
            </div>
            <style>
                .search .btn-search {
                    border: none;
                    height: 30px;
                    line-height: 30px;
                    background: #000;
                    color: #fff;
                    border-radius: 20px;
                    padding: 0 40px;
                }

                .search .form-group {
                    margin: 0;
                }
            </style>
            <div class="col-md-2 text-center">
                <button class="btn-search" type="submit"><i class="fas fa-search"></i></button>
            </div>

        </div>
    </form>

</div>


<!-- TOUR TYPE -->

<?php
$query_loaitour = "SELECT * FROM loaitourdulich";
$result_loaitour = mysqli_query($connection, $query_loaitour);
// $rows_loaitour = mysqli_fetch_array($result_loaitour);
?>

<section class="container tour-type">
    <div class="card-group">
        <?php
        while ($rows_loaitour = mysqli_fetch_array($result_loaitour)) {
        ?>
            <div class="card">
                <img class="card-img-top" src="img/<?php echo $rows_loaitour["Anh"]; ?>" alt="Card image cap">
                <div class="dark-overlay">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $rows_loaitour["TenLoaiTour"] ?></h5>
                        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                        <a href="loai-tour.php?loai-tour=<?php echo $rows_loaitour["MaLoaiTour"]; ?>" class="btn btn-dark">Xem Ngay</a>
                    </div>
                </div>
            </div>

        <?php
        }
        ?>
    </div>
</section>

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

<!-- TOUR ĐẶT NHIỀU -->

<!-- TOUR TRONG NƯỚC -->
<section class="container tour-container">
    <?php
    $query = "SELECT * from loaitourdulich";
    $result = mysqli_query($connection, $query);
    $query2 = "SELECT * from tourdulich where MaLoaiTour='1'";
    $result2 = mysqli_query($connection, $query2);
    $query3 = "SELECT * from loaitourdulich where MaLoaiTour='1'";
    $result3 = mysqli_query($connection, $query3);
    $rows3 = mysqli_fetch_array($result3);
    ?>
    <h5 class="tour-title"><?php echo $rows3['TenLoaiTour'] ?></h5>
    <div class="row">
        <?php
        while ($rows = @mysqli_fetch_array($result2)) {
        ?>
            <!-- Card -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-img-top">
                        <img style="height: 200px;width: 100%" src="admin/img/tour-du-lich/<?php echo $rows['Anh'] ?>" alt="Card image cap">
                        <div class="feature">Đang Giảm Giá</div>
                        <div class="like"><i class="fas fa-heart"></i></div>
                    </div>
                    <div class="card-body">
                        <p class="card-location"><i class="fas fa-map-marker-alt"></i>
                            <?php
                            $vitri = $rows['MaViTri'];
                            $q_vitri = "SELECT * FROM vitri WHERE MaViTri= '$vitri'";
                            $rs_vitri = mysqli_query($connection, $q_vitri);
                            $rw_vitri = mysqli_fetch_array($rs_vitri);
                            ?>
                            <?php echo $rw_vitri['TenViTri']
                            ?></p>
                        <h5 class="card-title"><a href="chi-tiet-tour.php?tour=<?php echo $rows['MaTour']; ?>"><?php echo $rows['TenTour'] ?></a></h5>
                        <p class="card-text">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i> <span class="reviews">4 Reviews</span>
                        </p>
                    </div>
                    <div class="card-footer d-flex">
                        <div class="card-f-left"><i class="far fa-clock"></i> <?php echo $rows['SoNgay'] ?> Ngày</div>
                        <div class="ml-auto card-f-right"><i class="fas fa-dollar-sign"></i> <span class="price"><?php echo product_price($rows['GiaTien']) ?></span></div>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</section>




<!-- TOUR NƯỚC NGOÀI -->
<section class="container tour-container">
    <?php
    $query = "SELECT * from loaitourdulich";
    $result = mysqli_query($connection, $query);
    $query2 = "SELECT * from tourdulich where MaLoaiTour='2'";
    $result2 = mysqli_query($connection, $query2);
    $query3 = "SELECT * from loaitourdulich where MaLoaiTour='2'";
    $result3 = mysqli_query($connection, $query3);
    $rows3 = mysqli_fetch_array($result3);
    ?>
    <h5 class="tour-title"><?php echo $rows3['TenLoaiTour'] ?></h5>
    <div class="row">
        <?php
        while ($rows = @mysqli_fetch_array($result2)) {
        ?>
            <!-- Card -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-img-top">
                        <img style="height: 200px;width: 100%" src="admin/img/tour-du-lich/<?php echo $rows['Anh'] ?>" alt="Card image cap">
                        <div class="feature">Đang Giảm Giá</div>
                        <div class="like"><i class="fas fa-heart"></i></div>
                    </div>
                    <div class="card-body">
                        <p class="card-location"><i class="fas fa-map-marker-alt"></i>
                            <?php
                            $vitri = $rows['MaViTri'];
                            $q_vitri = "SELECT * FROM vitri WHERE MaViTri= '$vitri'";
                            $rs_vitri = mysqli_query($connection, $q_vitri);
                            $rw_vitri = mysqli_fetch_array($rs_vitri);
                            ?>
                            <?php echo $rw_vitri['TenViTri']
                            ?>
                        </p>
                        <h5 class="card-title"><a href="chi-tiet-tour.php?tour=<?php echo $rows['MaTour']; ?>"><?php echo $rows['TenTour'] ?></a></h5>
                        <p class="card-text">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i> <span class="reviews">4 Reviews</span>
                        </p>
                    </div>
                    <div class="card-footer d-flex">
                        <div class="card-f-left"><i class="far fa-clock"></i> <?php echo $rows['SoNgay'] ?> Ngày</div>
                        <div class="ml-auto card-f-right"><i class="fas fa-dollar-sign"></i> <span class="price"><?php echo product_price($rows['GiaTien']) ?></span></div>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</section>






<a href="#" class="to-top">
    <i class="fas fa-arrow-up"></i>
</a>


<!-- FOOTER -->


<div class="footer">
    <div class="row">
        <div class="col-md-4">
            <h3 style="color:#fff">Travello</h3>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                At quisquam deserunt error nesciunt earum, alias minima pariatur?<p>
        </div>
        <div class="col-md-2">
            <h5>Thành Viên</h5>
            <p>Cao Duy Triều</p>
            <p>Nguyễn Đắc Huề</p>
        </div>
        <div class="col-md-2">
            <h5>Hỗ Trợ</h5>
            <p>Lorem ipsum</p>
            <p>Lorem ipsum</p>
        </div>
        <div class="col-md-4">
            <h5>Liên Hệ</h5>
            <p>140 Lê Trọng Tấn, P.Tây Thạnh, Q.Tân Phú, TP.HCM</p>
            <p>(+84) 32 6805 211</p>
            <p>travello@gmail.com</p>
            <p>www.travello.co</p>
        </div>
    </div>

    <div class="footer-copyright">

        <i class="fab fa-twitter-square"></i> <i class="fab fa-facebook-square"></i> <i class="fab fa-google-plus-square"></i>
    </div>
</div>

<script>
    const toTop = document.querySelector(".to-top");

    window.addEventListener("scroll", () => {
        if (window.pageYOffset > 100) {
            toTop.classList.add("active");
        } else {
            toTop.classList.remove("active");
        }
    })
</script>


</body>
<script src="scripts/jquery-3.5.1.slim.min.js"></script>
<script src="scripts/popper.min.js"></script>
<script src="scripts/bootstrap.min.js"></script>
<script src="scripts/fontawesome-kit.js"></script>
<script src="scripts/scroll.js"></script>
<script src="plugins/parallax-js-master/parallax.min.js"></script>
<script src="scripts/cus.js"></script>

</html>