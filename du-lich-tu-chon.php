<?php
include('include/header.php');

$query = "SELECT * FROM vitri";
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
                <a href="khach-san-theo-diem-den.php?diem-den=<?php echo $rows["MaViTri"]; ?>">
                    <div class="card">
                        <img class="card-img-top" src="admin/img/diem-den/<?php echo $rows["Anh"]; ?>" alt="Card image cap">
                        <h5 class="title"><?php echo $rows["TenViTri"]; ?></h5>
                    </div>
                </a>

            </div>
        <?php
        }
        ?>


</section>

<!-- END -->

<?php
include('include/footer.php')
?>