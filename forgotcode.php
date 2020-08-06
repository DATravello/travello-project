<?php
session_start();
require_once("database/db_config.php");
if (isset($_POST["TimMatKhau"])) {
    $email = $_POST["Email"];
    if ($email == "") {
        $_SESSION['forgot-status'] = "Không được bỏ trống!";
        header("Location: forgot-password.php");
    } else {
        $sql = "SELECT * FROM khachhang where Email = '$email'";
        $rs = mysqli_query($connection, $sql);


        if (mysqli_num_rows($rs) > 0) {
            $row = mysqli_fetch_array($rs);
            $pass = $row["MatKhau"];

            $_SESSION['forgot-status'] = "Vui lòng kiểm tra email để lấy lại mật khẩu!";
            header("Location: forgot-password.php");
            $ngayhientai = date("Y-m-d");
            require_once('admin/phpmailler/class.phpmailer.php');
            // and NgayDat='$ngayhientai'

            $mailday = "";
            require_once('admin/phpmailler/class.phpmailer.php');

            //Khởi tạo đối tượng
            $mail = new PHPMailer();
            $mail->IsSMTP(); // Gọi đến class xử lý SMTP
            $mail->Host       = "smtp.gmail.com"; // tên SMTP server
            $mail->SMTPAuth   = true;                  // Sử dụng đăng nhập vào account
            $mail->SMTPSecure = "ssl";
            $mail->Host       = "smtp.gmail.com";     // Thiết lập thông tin của SMPT
            $mail->Port       = 465;                     // Thiết lập cổng gửi email của máy
            $mail->Username   = "huy240298@gmail.com"; // SMTP account username
            $mail->Password   = "hue240298";            // SMTP account password
            //Thiet lap thong tin nguoi gui va email nguoi gui
            $mail->SetFrom('huy240298@gmail.com', 'Travello');
            //Thiết lập thông tin người nhận
            $mail->AddAddress($email, "Khách hàng");
            //Thiết lập email nhận email hồi đáp
            //nếu người nhận nhấn nút Reply
            $mail->AddReplyTo("huy240298@gmail.com", "Travello");
            $mail->Subject    = "Quên Mật Khẩu - $tentour";
            //Thiết lập định dạng font chữ
            $mail->CharSet = "utf-8";
            //Thiết lập nội dung chính của email
            $body = "Chào";
            $mail->isHTML(true);
            $mail->Body = '
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
            background-color: rgba(0,0,0,.075);
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
                <h3 style="text-align:center">QUÊN MẬT KHẨU</h3>
                <hr>

                <h5 style="color:red">Thông Tin Đăng Nhập</h5>

                <p>
                    Email: '.$email.'<br>
                    Mật Khẩu: '.$pass.'
                </p>
        
        
        
                <p>Cám ơn quý khách đã tin tưởng và chọn dịch vụ của chúng tôi!<br>
                </p>
        
        
                <div class="bg-primary">
                    <p><b>Công ty Du lịch và Lữ hành Travello</b><br></p>
                    <p>140 Lê Trọng Tấn, P. Tây Thạnh, Q. Tân Phú, TP. HCM<br></p>
                    <p>ĐT: (+84) 326 805 211 - Email: Travello@gmail.com</p>
                </div>
            </div>
        </body>
        
        </html>';
            // $mail->Body=$row['hoadon'];
            if ($mail->Send()) {}
            else {}
        } else {
            $_SESSION['forgot-status'] = "Email không tồn tại!";
            header("Location: forgot-password.php");
        }
    }
}
?>
