<<<<<<< Updated upstream
<?php //include('include/header.php');
session_start();

include('database/db_config.php');
function product_price($priceFloat)
{
    $symbol = ' đ';
    $symbol_thousand = '.';
    $decimal_place = 0;
    $price = number_format($priceFloat, $decimal_place, '', $symbol_thousand);
    return $price . $symbol;
}
?>
=======
<!DOCTYPE html>
<html lang="en">
>>>>>>> Stashed changes

<link rel="stylesheet" href="css/bootstrap-4.5.0-dist/css/bootstrap.min.css">
<link rel="stylesheet" href="css/test.css">

<body>



    <!-- TEST -->

    <section class="container tour-type">
        <div class="card-group">
            <div class="card">
                <img class="card-img-top" src="img/travello.jpg" alt="Card image cap">
                <div class="dark-overlay">
                <div class="card-body">
                    <h5 class="card-title">TOUR ĐANG HOT</h5>
                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                    <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                    <a href="#" class="btn btn-dark">Xem Ngay</a>
                </div>
                </div>
            </div>
            <div class="card">
                <img class="card-img-top" src="img/travel-2.jpg" alt="Card image cap">
                <div class="dark-overlay">
                <div class="card-body">
                    <h5 class="card-title">TOUR TRONG NƯỚC</h5>
                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                    <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                    <a href="#" class="btn btn-dark">Xem Ngay</a>
                </div>
                </div>
            </div>
            <div class="card">
                <img class="card-img-top" src="img/travel-1.jpg" alt="Card image cap">
                <div class="dark-overlay">
                <div class="card-body">
                    <h5 class="card-title">TOUR NƯỚC NGOÀI</h5>
                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                    <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                    <a href="#" class="btn btn-dark">Xem Ngay</a>
                </div>
                </div>
            </div>
        </div>
    </section>


    <?php
    //include('include/footer.php');

<<<<<<< Updated upstream
    include('include/scripts.php')
    ?>
=======
</html>
>>>>>>> Stashed changes
