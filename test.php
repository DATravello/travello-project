<form enctype="multipart/form-data" method="POST">
    <input multiple="multiple" name="file[]" size="141" type="file" />
    <input name="submit" type="submit" value="Upload" />
</form>


<?php
if (isset($_POST['submit'])) {
    $name = array();
    $tmp_name = array();
    $error = array();
    $ext = array();
    $size = array();
    foreach ($_FILES['file']['name'] as $file) {
        $name[] = $file;
    }
    foreach ($_FILES['file']['tmp_name'] as $file) {
        $tmp_name[] = $file;
    }
    foreach ($_FILES['file']['error'] as $file) {
        $error[] = $file;
    }
    foreach ($_FILES['file']['type'] as $file) {
        $ext[] = $file;
    }
    foreach ($_FILES['file']['size'] as $file) {
        $size[] = round($file / 1024, 2);
    }
    echo "Tổng số file được tải lên: " . count($name) . " file<br>";
    echo "<br><br>Tên file<br>Loại<br>Kích thước<br>Thư mục<br>";
    for ($i = 0; $i < count($name); $i++) {
        if ($error[$i] < 0) {
            echo "Lỗi: " . $error[$i];
        } else
if ($ext[$i] != 'application/save') {
            echo "File không được hổ trợ<br>" . $ext[$i];
        } else {
            $temp = preg_split('/[\/\\\\]+/', $name[$i]);
            $filename = $temp[count($temp) - 1];
            $upload_dir = "img/upload/";
            $upload_file = $upload_dir . $filename;
            if (file_exists($upload_file)) {
                echo 'File đã tồn tại<br>';
            } else {
                if (move_uploaded_file($tmp_name[$i], $upload_file)) {
                    echo "<br><p>" . $name[$i] . "</p><br>";
                    echo "<br><p>" . $ext[$i] . "</p><br>";
                    echo "<br><p>" . $size[$i] . " kB</p><br>";
                    echo "<br><p>" . $upload_file . "</p><br>";

                    $date = date("d-m-Y");
                    @mysqli_connect('localhost', 'root', '', 'travello_2');
                    @mysqli_query($conn, "INSERT INTO `testanh` VALUES (null,'{$name[$i]}'") or
                        die("Bi loi them du lieu" . mysqli_error($conn));
                    @mysqli_close($conn);
                } else
                    echo 'loi';
            }
        } //End khoi cau lenh up file va them vao CSDL;
    } //End vong lap for cho tat ca cac file;
    echo '</p>';
}
?>