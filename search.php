<?php
include('include/header.php');

if (isset($_GET['SearchTenTour']) && $_GET["SearchTenTour"] != '') {
    $search = $_GET['SearchTenTour'];
    $query = "SELECT * FROM tourdulich WHERE (TenTour like '%$search%')";
    $sql = mysqli_query($connection, $query);
    //echo $sql;
    $num = mysqli_num_rows($sql);
?>

<title><?php echo $search?> | Kết Quả Tìm Kiếm | Travello</title>
    <style>
        .title-search {
            margin: 50px 0;
            text-align: center;
            font-size: 35px;
        }

        .title-search b {
            color: #007bff;
        }
    </style>
    <?php

    if ($num > 0) {
        echo "<section class='container tour-container'>
            <h5 class='title-search'>Có <b>" . $num . "</b> Kết Quả Trả Về Với Từ Khoá <b>" . $search. "</b></h5>";
    ?>
        <div class="row">
            <?php
            foreach ($sql as $rows) {
            ?>
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
        } else {
            echo "Không Tìm Thấy Kết Quả!";
        }
    }
    ?>

        </div>
        </section>
        <?php include('include/footer.php'); ?>