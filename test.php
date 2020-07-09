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

    if (isset($_POST['btn_DatTour'])) {
        $mapt = $_POST["PhuongTien"];
        $sl = $_POST["soluongxe$mapt"];
        $sn = $_POST["songay$mapt"];

        $inser_pt = "INSERT INTO hoadonphuongtien (`MaPhuongTien`,`SoLuongXeDat`,`SoLuongNgayDat`) VALUES ('$mapt','$sl','$sn')";

        $q_run = mysqli_query($connection, $inser_pt);
        if ($q_run) {
            $message = "Hoàn Tất";
            echo "<script type='text/javascript'>alert('$message');</script>";
        } else {
            $message = "Lỗi";
            echo "<script type='text/javascript'>alert('$message');</script>";
        }
    }
    ?>


    <div class="container">
        <form action="" method="post">
            <select class="form-control" name="PhuongTien" id="PhuongTien" onchange="Chonxe()">
                <?php
                while ($rw_pt = @mysqli_fetch_array($rs_pt)) {
                ?>
                    <option value="<?php echo $rw_pt["MaPhuongTien"] ?>"><?php echo $rw_pt["PhuongTien"] ?></option>
                <?php
                }
                ?>
            </select>
            <script>
                function Chonxe() {
                    $('.card').hide();
                    x = document.getElementById("PhuongTien").value;
                    $('#' + x).show();
                }
            </script>

            <?php
            $query = "SELECT * FROM phuongtien";
            $result = mysqli_query($connection, $query);

            $i = 1;
            while ($row = mysqli_fetch_array($result)) {
            ?>

                <div class="card" id="<?php echo $row["MaPhuongTien"] ?>" style="display:none;">
                    <div class="card-body">
                        <div class="row">
                            <input type="hidden" name="mapt" value="<?php echo $row["MaPhuongTien"] ?>">
                            <div class="col-md-2" style="padding-right:0;">
                                <img src="admin/img/phuong-tien/<?php echo $row["HinhAnh"] ?>" width="100%" class="img-vehicle" alt="">
                            </div>
                            <div class="col-md-2" style="padding-right:0;">
                                <h5 class="name-vehicle"><?php echo $row["PhuongTien"] ?></h5>
                            </div>
                            <div class="col-md-2" style="padding-right:0;">
                                <div class="form-group">
                                    <label for="label">Số Lượng Xe</label>
                                    <input type="number" class="form-control" onclick="tienxetheosoluong(),tongTien()" name="soluongxe<?php echo $row["MaPhuongTien"] ?>" id="soluongxe<?php echo $i ?>">
                                </div>
                            </div>
                            <div class="col-md-2" style="padding-right:0;">
                                <div class="form-group">
                                    <label for="label">Số Ngày</label>
                                    <input type="number" class="form-control" onclick="tienxetheosoluong(),tongTien()" name="songay<?php echo $row["MaPhuongTien"] ?>" id="songay<?php echo $i ?>">
                                </div>
                            </div>
                            <div class="col-md-2" style="padding-right:0;">
                                Đơn giá: <p style="color:red;font-weight:bold;width:100%;border:none;background:#fff;"><?php echo $row["Gia"] ?>/Ngày</p>
                                <p id="dongia<?php echo $i ?>" style="visibility:hidden;height:0;margin:0"><?php echo $row["Gia"] ?></p>
                            </div>
                            <div class="col-md-2" style="padding-right:0;">
                                Thành tiền: <p style="color:red;font-weight:bold;width:100%;border:none;background:#fff;" id="tongtienXe<?php echo $i ?>"><?php echo $row["Gia"] ?></p>
                                <p id="tienXe<?php echo $i ?>" style="visibility:hidden;height:0;margin:0"></p>
                                <input type="number" id="tongtienxe" style="visibility:hidden;height:0;margin:0" value="0">
                                <input type="number" name="TongTienXe" style="visibility:hidden;">
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-book" type="submit" name="btn_DatTour">Đặt Xe</button>
                </div>
            <?php
                $i++;
            }
            ?>
        </form>
    </div>


</body>

</html>