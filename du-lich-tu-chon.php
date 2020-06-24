<?php
include('include/header.php');

$query = "SELECT * FROM diemden";
$result = mysqli_query($connection, $query);
?>

<!-- NỘI DUNG -->

<section class="container destination-content">

    <h5>DANH SÁCH ĐIỂM ĐẾN</h5>
    <div class="row">
        <?php
        while ($rows = mysqli_fetch_array($result)) {
        ?>
            <div class="col-md-3">
                <div class="card">
                    <img class="card-img-top" src="admin/img/diem-den/<?php echo $rows["Anh"]; ?>" alt="Card image cap">
                    <h5 class="title"><?php echo $rows["TenDiemDen"]; ?></h5>
                </div>
            </div>
        <?php
        }
        ?>


</section>

<!-- END -->

<?php
include('include/footer.php')
?>