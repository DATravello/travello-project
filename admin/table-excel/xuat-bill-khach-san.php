<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Xuất Hóa Đơn Khách Sạn</title>
    <link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/4.2.1/minty/bootstrap.min.css">
    <style>
        body {
            background-color: #fafafa;
        }

        .container {
            margin: 150px auto;
        }
    </style>
</head>

<body>
    <div class="container">
        <?php
        $conn = mysqli_connect("localhost", "root", "", "travello_db");
        if (isset($_POST['btn_xuat_bill_ks'])) {
            $mahdks = $_POST['xuat_bill'];
            $query = "SELECT * FROM hoadonks";
            $query_run = mysqli_query($conn, $query);
            $query1 = "SELECT * FROM hoadonks hdks, hoadon hd, khachhang kh, khachsan ks where hdks.MaKH = kh.MaKH 
        and hdks.MaKS=ks.MaKS ";
            $result1 = mysqli_query($conn, $query1);
        ?>
            <div class="container">
                <h1 style="text-align: center;">DS Hóa Đơn Khách Sạn</h1>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Mã Hóa Đơn Khách Sạn</th>
                            <th>Mã Hóa Đơn</th>
                            <th>Tên Khách Hàng</th>
                            <th>Tên Khách Sạn</th>
                            <th>Số Phòng Đặt</th>
                            <th>Ngày Đặt</th>
                            <th>Tổng Tiền</th>
                        </tr>
                    <tbody>
                        <?php
                        if (mysqli_num_rows($query_run) > 0 && mysqli_num_rows($result1) > 0) {
                            while (($row = mysqli_fetch_assoc($query_run)) && $rows1 = mysqli_fetch_assoc($result1)) {
                        ?>
                                <tr>
                                    <td><?php echo $row['MaHDKS']; ?></td>
                                    <td><?php echo $row['MaHD']; ?></td>
                                    <td><?php
                                        echo $rows1['TenKH'];
                                        ?></td>
                                    <td><?php
                                        echo $rows1['TenKS'];
                                        ?></td>
                                    <td> <?php echo $row['SoPhongDat']; ?> </td>
                                    <td> <?php echo $row['NgayDat']; ?> </td>
                                    <td> <?php echo $row['TongTien']; ?> </td>
                                </tr>

                    <?php
                            }
                        } else {
                            echo "không có bản ghi nào";
                        }
                    }
                    ?>
                    </tbody>
                </table>
                <button class="btn btn-danger" onclick="$('table').tblToExcel();">Xuất Excel</button>
            </div>
            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
            <script src="jquery.tableToExcel.js"></script>
</body>
<script type="text/javascript">
    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-36251023-1']);
    _gaq.push(['_setDomainName', 'jqueryscript.net']);
    _gaq.push(['_trackPageview']);

    (function() {
        var ga = document.createElement('script');
        ga.type = 'text/javascript';
        ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(ga, s);
    })();
</script>

</html>