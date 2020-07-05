<!DOCTYPE html>
<html>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<body>

    <?php
    session_start();
    include('database/db_config.php');
    $q_pt = "SELECT * FROM phuongtien";
    $rs_pt = mysqli_query($connection, $q_pt);
    ?>


    <div class="container">
        <select class="form-control" name="PhuongTien">
            <?php
            while ($rw_pt = @mysqli_fetch_array($rs_pt)) {
            ?>
                <option value="<?php echo $rw_pt["MaPhuongTien"] ?>"><?php echo $rw_pt["PhuongTien"] ?></option>

            <?php
            }
            ?>
        </select>

        <?php
        if (isset($_POST['PhuongTien'])) {
            $initial = $_POST['PhuongTien'];
        } else {
            $initial = "empty";
        }

        $q = "SELECT * FROM phuongtien WHERE MaPhuongTien = $initial";
        $
        ?>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-2" style="padding-right:0;">
                        <img src="admin/img/phuong-tien/<?php echo $rw_pt["HinhAnh"] ?>" class="img-vehicle" alt="">
                    </div>
                    <div class="col-md-2" style="padding-right:0;">
                        <h5 class="name-vehicle"><?php echo $rw_pt["PhuongTien"] ?></h5>
                    </div>
                </div>
            </div>
        </div>

</body>

</html>