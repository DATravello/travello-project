<html>

<head>
    <style type="text/css">
        section {
            display: -webkit-flex;
            display: flex;
            margin: 20px auto;
        }

        .left {
            -webkit-flex: 2;
            -ms-flex: 2;
            flex: 2;
        }

        .right {
            -webkit-flex: 2;
            -ms-flex: 2;
            flex: 2;
        }

        th {
            text-align: left;
            padding-left: 20px;
            background-color: rgba(0, 0, 0, .075);
        }

        td {
            border: 1px solid #eee;
        }

        .bg-primary {
            background: #007bff;
            color: #fff;
            padding: 20px 0;
            text-align: center;
        }

        .bg-primary p {
            margin: 5px 0;
        }

        h5 {
            font-size: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <hr>
        <h3 style="text-align:center">YÊU CẦU HUỶ TOUR</h3>
        <hr>


        <b>Quý khách vừa yêu cầu huỷ tour #0123123123, vui lòng đợi từ 10p - 15p sau nhân viên bộ phận CSKH sẽ liên lạc với quý khách theo
            số điện thoại quý khách đã đăng ký tài khoản. Nếu không thấy phản hồi, vui lòng liên hệ lại với công ty theo Hotline: 0326805211.<br>
            Trong trường hợp công ty không thể liên lạc được với quý khách, yêu cầu huỷ tour của quý khách sẽ không được chấp thuận!<br>
            Cám ơn quý khách đã tin tưởng sử dụng dịch vụ của chúng tôi!
        </b>
        <h5 style="color:red">A. Thông Tin Booking</h5>
        <section>
            <div class="left">
                <table style="width:100%">
                    <tr>
                        <th>Mã đơn hàng:</th>
                        <td>#' . $maHD . '</td>
                    </tr>
                    <tr>
                        <th>Họ tên:</th>
                        <td>' . $tenkh . '</td>
                    </tr>
                    <tr>
                        <th>Số điện thoại:</th>
                        <td>' . $sdtkh . '</td>
                    </tr>
                    <tr>
                        <th>Tình trạng booking:</th>
                        <td>Chờ xác nhận</td>
                    </tr>
                </table>
            </div>

            <div class="right">
                <table style="width:100%">
                    <tr>
                        <th>Ngày tạo:</th>
                        <td>' . $ngayhientai . '</td>
                    </tr>
                    <tr>
                        <th>Email:</th>
                        <td>' . $email . '</td>
                    </tr>
                    <tr>
                        <th>Tình trạng thanh toán:</th>
                        <td>Chưa thanh toán</td>
                    </tr>
                    <tr>
                        <th>Tổng Tiền:</th>
                        <td>' . product_price($TongTien) . '</td>
                    </tr>
                </table>
            </div>
        </section>
        <h5 style="color:red">B. Chi Tiết Huỷ Tour</h5>

        <div class="group-amount">
            <p><b>Ngày Yêu Cầu: <i>20/3/2020</i></b></p>
            <p> <b>Lý Do: <i>Không thích đi nữa</i></b></p>
        </div>

        <div class="bg-primary">
            <p><b>Công ty Du lịch và Lữ hành Travello</b><br></p>
            <p>140 Lê Trọng Tấn, P. Tây Thạnh, Q. Tân Phú, TP. HCM<br></p>
            <p>ĐT: (+84) 326 805 211 - Email: Travello@gmail.com</p>
        </div>
    </div>
</body>

</html>