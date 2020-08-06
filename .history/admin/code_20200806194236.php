<?php
include("db_config.php");

// * THÊM LOẠI NHÀ HÀNG *// 
if (isset($_POST['btn_them_loai_nh'])) {
    $tenloainhahang = $_POST['TenLoaiNH'];
    $sql_tenloainh = "SELECT * FROM loainhahang WHERE TenLoaiNH = '$tenloainhahang'";
    $rstenloainh = mysqli_query($connection, $sql_tenloainh);

    if (!$tenloainhahang) {
        echo "Không thành công!";
        $_SESSION['status'] = "Vui lòng không bỏ trống trường!";
        header('location: them-loai-nha-hang.php');
    } else {
        if (mysqli_num_rows($rstenloainh) > 0) {
            echo "Không thành công";
            $_SESSION['status'] = "Loại Phòng Đã Tồn Tại!";
            header('location: them-loai-nha-hang.php');
        } else {
            $query = "INSERT INTO loainhahang (`TenLoaiNH`) VALUES ('$tenloainhahang')";
            $query_run = mysqli_query($connection, $query);

            if ($query_run) {
                $_SESSION['success'] = "Thêm Thành Công!";
                header('location: danh-sach-loai-nha-hang.php');
            } else {
                $_SESSION['status'] = "Thêm Thất Bại!";
                header('location: them-loai-nha-hang.php');
            }
        }
    }
}

//*SỬA LOẠI NHÀ HÀNG*//
if (isset($_POST['btn_update_loainh'])) {
    $maloai = $_POST['sua_maloai'];
    $tenloainh = $_POST['sua_tenloai'];

    $query = "UPDATE loainhahang SET TenLoaiNH='$tenloainh' WHERE MaLoaiNH='$maloai'";
    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        $_SESSION['success'] = "Update Successed!";
        header('location: danh-sach-loai-nha-hang.php');
    } else {
        $_SESSION['status'] = "Update Failed!";
        header('location: sua-loai-nha-hang.php');
    }
}

// XÓA LOẠI NHÀ HÀNG
if (isset($_POST['btn_xoa_loainh'])) {
    $malnh = $_POST['xoa_loainhahang'];

    $query = " DELETE FROM loainhahang WHERE MaLoaiNH ='$malnh' ";
    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        $_SESSION['success'] = "Delete Successed!";
        $_SESSION['success'] = "Cập Nhật Thành Công!";
        header('location: danh-sach-loai-nha-hang.php');
    } else {
        $_SESSION['status'] = "Delete Failed!";
        header('location: danh-sach-loai-nha-hang.php');
    }
}

// * THÊM THƯƠNG HIỆU NHÀ HÀNG *// 
if (isset($_POST['btn_them_thuong_hieu_nh'])) {
    $theloai = $_POST['LoaiNhaHang'];
    $tenthuonghieunh = $_POST['TenThuongHieuNH'];
    $mota = $_POST['MoTa'];
    $anh = $_FILES["HinhAnh"]['name'];

    $sql_tenthuonghieunh = "SELECT * FROM thuonghieunh WHERE TenThuongHieuNH = '$tenthuonghieunh'";
    $rstenthuonghieunh = mysqli_query($connection, $sql_tenthuonghieunh);
    if (file_exists("img/thuong-hieu-nh/" . $_FILES["HinhAnh"]["name"])) {
        $store = $_FILES["HinhAnh"]["name"];
        $_SESSION['status'] = "Hình đã tồn tại. '.$store.'";
        header('location: them-thuong-hieu-nh.php');
    } else {
        if (!$theloai || !$tenthuonghieunh || !$mota || !$anh) {
            echo "Không thành công!";
            $_SESSION['status'] = "Vui lòng không bỏ trống trường!";
            header('location: them-thuong-hieu-nh.php');
        } else {
            if (mysqli_num_rows($rstenthuonghieunh) > 0) {
                echo "Không thành công";
                $_SESSION['status'] = "Thương Hiệu Đã Tồn Tại!";
                header('location: them-thuong-hieu-nh.php');
            } else {
                $query = "INSERT INTO thuonghieunh (`MaLoaiNH`,`TenThuongHieuNH`,`MoTa`,`HinhAnh`)
             VALUES ('$theloai','$tenthuonghieu','$mota','$anh')";
                $query_run = mysqli_query($connection, $query);
                if ($query_run) {
                    move_uploaded_file($_FILES["HinhAnh"]["tmp_name"], "img/thuong-hieu-nh/" . $_FILES["HinhAnh"]["name"]);
                    $_SESSION['success'] = "Thêm Thành Công!";
                    header('location: danh-sach-thuong-hieu-nh.php');
                } else {
                    $_SESSION['status'] = "Thêm Thất Bại!";
                    header('location: them-thuong-hieu-nh.php');
                }
            }
        }
    }
}


//SỬA THƯƠNG HIỆU NHÀ HÀNG 
if (isset($_POST['btn_capnhat_thuonghieu_nh'])) {
    $mathnh = $_POST['sua_mathnh'];
    $theloainh = $_POST['sua_maloainh'];
    $tenthnh = $_POST['sua_tenthnh'];
    $mota = $_POST['sua_mota'];
    $anhthnh = $_FILES["HinhAnh"]['name'];

    $img_query = "SELECT * FROM thuonghieunh WHERE id='$mathnh'";
    $img_run = mysqli_query($connection, $img_query);

    foreach($img_run as $row) {
        if($anhthnh == NULL) {
            $img_data = $row["HinhAnh"];

            $query = "UPDATE thuonghieunh SET MaLoaiNH='$theloainh', TenThuongHieuNH='$tenthnh', MoTa='$mota', HinhAnh='$img_data' WHERE MaThuongHieuNH='$mathnh'";
            $query_run = mysqli_query($connection, $query);

            if ($query_run) {
                $_SESSION['success'] = "Update Successed!";
                header('location: danh-sach-thuong-hieu-nh.php');
            } else {
                $_SESSION['status'] = "Update Failed!";
                header('location: sua-thuong-hieu-nh.php');
            }
        }

        else {
            $query = "UPDATE thuonghieunh SET MaLoaiNH='$theloainh', TenThuongHieuNH='$tenthnh', MoTa='$mota', HinhAnh='$anhthnh' WHERE MaThuongHieuNH='$mathnh'";
            $query_run = mysqli_query($connection, $query);

            if ($query_run) {
                move_uploaded_file($_FILES["HinhAnh"]["tmp_name"], "img/thuong-hieu-nh/" . $_FILES["HinhAnh"]["name"]);
                $_SESSION['success'] = "Update Successed!";
                header('location: danh-sach-thuong-hieu-nh.php');
            } else {
                $_SESSION['status'] = "Update Failed!";
                header('location: sua-thuong-hieu-nh.php');
            }
        }

    }

}

// XÓA THƯƠNG HIỆU
if (isset($_POST['btn_xoa_thuonghieu_nh'])) {
    $mathnh = $_POST['xoa_thuonghieu_nh'];

    $query = " DELETE FROM thuonghieunh WHERE MaThuongHieuNH ='$mathnh' ";
    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        $_SESSION['success'] = "Delete Successed!";
        header('location: danh-sach-thuong-hieu-nh.php');
    } else {
        $_SESSION['status'] = "Delete Failed!";
        header('location: danh-sach-thuong-hieu-nh.php');
    }
}


// * THÊM NHÀ HÀNG *//
if (isset($_POST['btn_them_nh'])) {
    $thuonghieunh = $_POST['ThuongHieuNH'];
    $tennhahang = $_POST['TenNhaHang'];
    $vitri = $_POST['ViTriNH'];
    $diachi = $_POST['DiaChi'];
    $sdt = $_POST['SDT'];
    $anh = $_FILES["Anh"]['name'];
    $gioithieu = $_POST['GioiThieuNH'];
    $giatreem = $_POST['GiaTreEm'];
    $gianguoilon = $_POST['GiaNguoiLon'];
    $thucdon = $_POST['MoTaThucDon'];

    $sql_tennh = "SELECT * FROM nhahang WHERE TenNhaHang = '$tennhahang'";
    $rstennh = mysqli_query($connection, $sql_tennh);

    if (file_exists("img/nha-hang/" . $_FILES["Anh"]["name"])) {
        $store = $_FILES["Anh"]["name"];
        $_SESSION['status'] = "Hình đã tồn tại. '.$store.'";
        header('location: them-nha-hang.php');
    } else {
        if (!$thuonghieunh || !$anh || !$tennhahang || !$vitri || !$diachi || !$sdt || !$gioithieu || !$giatreem || !$gianguoilon || !$thucdon) {
            echo "Không thành công!";
            $_SESSION['status'] = "Vui lòng không bỏ trống trường!";
            header('location: them-nha-hang.php');
        } else {

            if (mysqli_num_rows($rstennh) > 0) {
                echo "Không thành công";
                $_SESSION['status'] = "Nhà Hàng Đã Tồn Tại!";
                header('location: them-nha-hang.php');
            } else {
                $query = "INSERT INTO nhahang (`MaThuongHieuNH`,`TenNhaHang`,`MaViTri`,`DiaChi`,`Anh`,`SDT`,`GioiThieuNH`,`GiaTreEm`,`GiaNguoiLon`,`MoTaThucDon`)
                 VALUES ('$thuonghieunh','$tennhahang','$vitri','$diachi','$anh','$sdt','$gioithieu','$giatreem','$gianguoilon','$thucdon')";
                $query_run = mysqli_query($connection, $query);

                if ($query_run) {
                    move_uploaded_file($_FILES["Anh"]["tmp_name"], "img/nha-hang/" . $_FILES["Anh"]["name"]);
                    $_SESSION['success'] = "Thêm Thành Công!";
                    header('location: danh-sach-nha-hang.php');
                } else {
                    $_SESSION['status'] = "Thêm Thất Bại!";
                    header('location: them-nha-hang.php');
                }
            }
        }
    }
}

//SỬA NHÀ HÀNG
if (isset($_POST['btn_capnhat_nh'])) {
    $manh = $_POST['sua_mnh'];
    $thuonghieunh = $_POST['sua_mathnh'];
    $tennh = $_POST['sua_tennh'];
    $vitrinh = $_POST['sua_vitrinh'];
    $diachinh = $_POST['sua_diachinh'];
    $dtnh = $_POST['sua_sdtnh'];
    $gioithieu = $_POST['sua_gtnh'];
    $giatreem = $_POST['sua_giatreem'];
    $gianguoilon = $_POST['sua_gianguoilon'];
    $thucdon = $_POST['sua_thucdon'];
    $anhnh = $_FILES["Anh"]['name'];
    if (file_exists("img/nha-hang/" . $_FILES["Anh"]["name"])) {
        $store = $_FILES["Anh"]["name"];
        $_SESSION['status'] = "Hình đã tồn tại. '.$store.'";
        header('location: sua-nha-hang.php');
    } else {
        $query = "UPDATE nhahang 
        SET MaThuongHieuNH='$thuonghieunh', MaViTri='$vitrinh', TenNhaHang='$tennh', DiaChi='$diachinh', SDT='$dtnh', GioiThieuNH='$gioithieu', GiaTreEm='$giatreem', GiaNguoiLon='$gianguoilon', MoTaThucDon='$thucdon', Anh='$anhnh' WHERE MaNH='$manh'";
        $query_run = mysqli_query($connection, $query);

        if ($query_run) {
            move_uploaded_file($_FILES["Anh"]["tmp_name"], "img/nha-hang/" . $_FILES["Anh"]["name"]);
            $_SESSION['success'] = "Update Successed!";
            header('location: danh-sach-nha-hang.php');
        } else {
            $_SESSION['status'] = "Update Failed!";
            header('location: sua-nha-hang.php');
        }
    }
}

// XÓA NHÀ HÀNG
if (isset($_POST['btn_xoa_nh'])) {
    $manh = $_POST['xoa_nhahang'];

    $query = " DELETE FROM nhahang WHERE MaNH ='$manh' ";
    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        $_SESSION['success'] = "Delete Successed!";
        header('location: danh-sach-nha-hang.php');
    } else {
        $_SESSION['status'] = "Delete Failed!";
        header('location: danh-sach-nha-hang.php');
    }
}
// * THÊM PHƯƠNG TIỆN *// 
if (isset($_POST['btn_them_phuong_tien'])) {
    $loaipt = $_POST['loaipt'];
    $tenphuongtien = $_POST['PhuongTien'];
    $noikhoihanh = $_POST['NoiDi'];
    $noiden = $_POST['NoiDen'];
    $giatien = $_POST['Gia'];
    $anhpt = $_FILES["HinhAnh"]['name'];

    $sql_tenpt = "SELECT * FROM phuongtien WHERE PhuongTien = '$tenphuongtien'";
    $rstenpt = mysqli_query($connection, $sql_tenpt);
    if (file_exists("img/phuong-tien/" . $_FILES["HinhAnh"]["name"])) {
        $store = $_FILES["HinhAnh"]["name"];
        $_SESSION['status'] = "Hình đã tồn tại. '.$store.'";
        header('location: them-phuong-tien.php');
    } else {
        if (!$loaipt || !$tenphuongtien || !$noikhoihanh || !$noiden || !$giatien || !$anhpt) {
            echo "Không thành công!";
            $_SESSION['status'] = "Vui lòng không bỏ trống trường!";
            header('location: them-phuong-tien.php');
        } else {
            if (mysqli_num_rows($rstenpt) > 0) {
                echo "Không thành công";
                $_SESSION['status'] = "Phương Tiện Đã Tồn Tại!";
                header('location: them-phuong-tien.php');
            } else {
                $query = "INSERT INTO phuongtien (`MaTLPhuongTien`,`PhuongTien`,`NoiDi`,`NoiDen`,`Gia`,`HinhAnh`)
             VALUES ('$loaipt','$tenphuongtien','$noikhoihanh','$noiden','$giatien','$anhpt')";
                $query_run = mysqli_query($connection, $query);
                if ($query_run) {
                    move_uploaded_file($_FILES["HinhAnh"]["tmp_name"], "img/phuong-tien/" . $_FILES["HinhAnh"]["name"]);
                    $_SESSION['success'] = "Thêm Thành Công!";
                    header('location: danh-sach-phuong-tien.php');
                } else {
                    $_SESSION['status'] = "Thêm Thất Bại!";
                    header('location: them-phuong-tien.php');
                }
            }
        }
    }
}
//SỬA PHƯƠNG TIỆN
if (isset($_POST['btn_capnhat_pt'])) {
    $mapt = $_POST['sua_MaPhuongTien'];
    $loaipt = $_POST['sua_loaiphuongtien'];
    $tenpt = $_POST['sua_tenphuongtien'];
    $noidi = $_POST['sua_noidi'];
    $noiden = $_POST['sua_noiden'];
    $gia = $_POST['sua_gia'];
    $anhpt = $_FILES["HinhAnh"]['name'];

    if (file_exists("img/phuong-tien/" . $_FILES["HinhAnh"]["name"])) {
        $store = $_FILES["HinhAnh"]["name"];
        $_SESSION['status'] = "Hình đã tồn tại. '.$store.'";
        header('location: them-phuong-tien.php');
    } else {
        $query = "UPDATE phuongtien SET MaTLPhuongTien='$loaipt',PhuongTien='$tenpt', NoiDi='$noidi', NoiDen='$noiden', Gia='$gia', HinhAnh='$anhpt' WHERE MaPhuongTien='$mapt'";
        $query_run = mysqli_query($connection, $query);

        if ($query_run) {
            move_uploaded_file($_FILES["HinhAnh"]["tmp_name"], "img/phuong-tien/" . $_FILES["HinhAnh"]["name"]);
            $_SESSION['success'] = "Sửa Thành Công!";
            header('location: danh-sach-phuong-tien.php');
        } else {
            $_SESSION['status'] = "Sửa Thất Bại!";
            header('location: sua-phuong-tien.php');
        }
    }
}
// XÓA PHƯƠNG TIỆN
if (isset($_POST['btn_xoa_phuongtien'])) {
    $mapt = $_POST['xoa_phuongtien'];

    $query = "DELETE FROM phuongtien WHERE MaPhuongTien='$mapt'";
    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        $_SESSION['success'] = "Xóa Thành Công!";
        header('location: danh-sach-phuong-tien.php');
    } else {
        $_SESSION['status'] = "Xóa Thất Bại!";
        header('location: danh-sach-phuong-tien.php');
    }
}



// * THÊM TOUR DU LỊCH *//
if (isset($_POST['btn_them_tour'])) {
    $loaitour = $_POST['loaitour'];
    $tentour = $_POST['TenTour'];
    $noikhoihanh = $_POST['NoiKhoiHanh'];
    $vitri = $_POST['ViTri'];
    $thoigian = $_POST['ThoiGian'];
    $khachsan = $_POST['KhachSan'];
    $nhahang = $_POST['NhaHang'];
    $huongdv = $_POST['HuongDanVien'];
    $phuongtien = $_POST['PhuongTien'];
    $dichvu = $_POST['DichVu'];
    $giatien = $_POST['GiaTien'];
    $giatreem = $_POST['GiaTreEm'];
    $hanhtrinh = $_POST['HanhTrinh'];
    $songay = $_POST['SoNgay'];
    $succhua = $_POST['SucChua'];
    $chiphitour = $_POST['ChiPhiTour'];
    $anhtour = $_FILES["Anh"]['name'];

    $sql_tentour = "SELECT * FROM tourdulich WHERE TenTour = '$tentour'";
    $rstentour = mysqli_query($connection, $sql_tentour);
    if (file_exists("img/tour-du-lich/" . $_FILES["Anh"]["name"])) {
        $store = $_FILES["Anh"]["name"];
        $_SESSION['status'] = "Hình đã tồn tại. '.$store.'";
        header('location: them-tour-du-lich.php');
    } else {
        if (!$loaitour || !$tentour || !$noikhoihanh || !$vitri || !$thoigian || !$khachsan || !$nhahang || !$huongdv || !$phuongtien || !$dichvu || !$giatien || !$giatreem || !$hanhtrinh || !$songay || !$succhua || !$chiphitour || !$anhtour) {
            echo "Không thành công!";
            $_SESSION['status'] = "Vui lòng không bỏ trống trường!";
            header('location: them-tour-du-lich.php');
        } else {
            if (mysqli_num_rows($rstentour) > 0) {
                echo "Không thành công";
                $_SESSION['status'] = "Tour Đã Tồn Tại!";
                header('location: them-tour-du-lich.php');
            } else {
                $query = "INSERT INTO tourdulich (`MaLoaiTour`,`TenTour`,`NoiKhoiHanh`,`MaViTri`,`ThoiGian`,`MaKS`,`MaNH`,`MaHDV`,`MaPhuongTien`,`MaDV`,`GiaTien`,`GiaTreEm`,`HanhTrinh`,`SoNgay`,`SucChua`, `ChiPhiTour`,`Anh`)
             VALUES ('$loaitour','$tentour','$noikhoihanh','$vitri','$thoigian','$khachsan','$nhahang','$huongdv','$phuongtien','$dichvu','$giatien','$giatreem','$hanhtrinh', '$songay' ,'$succhua','$chiphitour','$anhtour')";
                $query_run = mysqli_query($connection, $query);
                if ($query_run) {
                    move_uploaded_file($_FILES["Anh"]["tmp_name"], "img/tour-du-lich/" . $_FILES["Anh"]["name"]);
                    $_SESSION['success'] = "Thêm Thành Công!";
                    $_SESSION['success'] = "Thêm Thành Công!";
                    header('location: danh-sach-tour-du-lich.php');
                } else {
                    $_SESSION['status'] = "Thêm Thất Bại!";
                    header('location: them-tour-du-lich.php');
                }
            }
        }
    }
}


//* SỬA TOUR DU LỊCH *//
if (isset($_POST['btn_capnhat_tour'])) {
    $matour = $_POST['sua_matour'];
    $loaitour = $_POST['sua_loaitour'];
    $tentour = $_POST['sua_tentour'];
    $noikhoihanh = $_POST['sua_noikhoihanh'];
    $vitri = $_POST['sua_vitri'];
    $thoigian = $_POST['sua_thoigian'];
    $khachsan = $_POST['sua_khachsan'];
    $nhahang = $_POST['sua_nhahang'];
    $hdv = $_POST['sua_hdv'];
    $phuongtien = $_POST['sua_phuongtien'];
    $dichvu = $_POST['sua_dichvu'];
    $giatien = $_POST['sua_giatien'];
    $giatreem = $_POST['sua_giatreem'];
    $hanhtrinh = $_POST['sua_hanhtrinh'];
    $songay = $_POST['sua_songay'];
    $succhua = $_POST['sua_succhua'];
    $chiphitour = $_POST['sua_chiphi'];
    $anhtour = $_FILES["Anh"]['name'];
    if (file_exists("img/tour-du-lich/" . $_FILES["Anh"]["name"])) {
        $store = $_FILES["Anh"]["name"];
        $_SESSION['status'] = "Hình đã tồn tại. '.$store.'";
        header('location: them-tour-du-lich.php');
    } else {
        $query = "UPDATE tourdulich SET MaLoaiTour='$loaitour', TenTour='$tentour', NoiKhoiHanh='$noikhoihanh', MaViTri='$vitri', ThoiGian='$thoigian', GiaTien='$giatien',MaKS='$khachsan',MaNH='$nhahang',MaHDV='$hdv',MaPhuongTien='$phuongtien',MaDV='$dichvu', GiaTreEm='$giatreem', HanhTrinh='$hanhtrinh', SoNgay='$songay', SucChua='$succhua', ChiPhiTour='$chiphitour', Anh='$anhtour' WHERE MaTour='$matour'";
        $query_run = mysqli_query($connection, $query);

        if ($query_run) {
            move_uploaded_file($_FILES["Anh"]["tmp_name"], "img/tour-du-lich/" . $_FILES["Anh"]["name"]);
            $_SESSION['success'] = "Update Successed!";
            header('location: danh-sach-tour-du-lich.php');
        } else {
            $_SESSION['status'] = "Update Failed!";
            header('location: sua-tour-du-lich.php');
        }
    }
}


// XÓA TOUR DU LỊCH 
if (isset($_POST['btn_xoa_tour'])) {
    $matour = $_POST['xoa_tour'];

    $query = " DELETE FROM tourdulich WHERE MaTour ='$matour' ";
    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        $_SESSION['success'] = "Delete Successed!";
        header('location: danh-sach-tour-du-lich.php');
    } else {
        $_SESSION['status'] = "Delete Failed!";
        header('location: danh-sach-tour-du-lich.php');
    }
}


// * THÊM DỊCH VỤ ĐI KÈM *// 
if (isset($_POST['btn_them_dich_vu'])) {
    $tendichvu = $_POST['TenDV'];
    $giadichvu = $_POST['GiaDichVu'];
    $ghichu = $_POST['GhiChu'];

    $sql_tendichvu = "SELECT * FROM dichvudikem WHERE TenDV = '$tendichvu'";
    $rstendichvu = mysqli_query($connection, $sql_tendichvu);
    if (!$tendichvu || !$giadichvu || !$ghichu) {
        echo "Không thành công!";
        $_SESSION['status'] = "Vui lòng không bỏ trống trường!";
        header('location: them-dich-vu-di-kem.php');
    } else {
        if (mysqli_num_rows($rstendichvu) > 0) {
            echo "Không thành công";
            $_SESSION['status'] = "Dịch Vụ Đã Tồn Tại!";
            header('location: them-dich-vu-di-kem.php');
        } else {
            $query = "INSERT INTO dichvudikem (`TenDV`, `GiaDichVu`,`GhiChu`) VALUES ('$tendichvu','$giadichvu','$ghichu')";
            $query_run = mysqli_query($connection, $query);

            if ($query_run) {
                $_SESSION['success'] = "Thêm Thành Công!";
                header('location: danh-sach-dich-vu-di-kem.php');
            } else {
                $_SESSION['status'] = "Thêm Thất Bại!";
                header('location: them-dich-vu-di-kem.php');
            }
        }
    }
}



//SỬA DỊCH VỤ ĐI KÈM 
if (isset($_POST['btn_capnhat_dv'])) {
    $madv = $_POST['sua_madv'];
    $tendv = $_POST['sua_tendv'];
    $giadv = $_POST['sua_giadv'];
    $ghichu = $_POST['sua_ghichu'];

    $query = "UPDATE dichvudikem SET TenDV='$tendv', GiaDichVu='$giadv', GhiChu='$ghichu' WHERE MaDV='$madv'";
    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        $_SESSION['success'] = "Update Successed!";
        header('location: danh-sach-dich-vu-di-kem.php');
    } else {
        $_SESSION['status'] = "Update Failed!";
        header('location: sua-dich-vu-di-kem.php');
    }
}


// XÓA DỊCH VỤ ĐI KÈM
if (isset($_POST['btn_xoa_dv'])) {
    $madv = $_POST['xoa_dv'];

    $query = "DELETE FROM dichvudikem WHERE MaDV='$madv'";
    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        $_SESSION['success'] = "Delete Successed!";
        header('location: danh-sach-dich-vu-di-kem.php');
    } else {
        $_SESSION['status'] = "Delete Failed!";
        header('location: danh-sach-dich-vu-di-kem.php');
    }
}
// * THÊM VỊ TRÍ *// 
if (isset($_POST['btn_them_vitri'])) {
    $tenvitri = $_POST['TenViTri'];
    $mota = $_POST['MoTa'];
    $anhvitri = $_FILES["Anh"]['name'];

    $sql_tenvitri = "SELECT * FROM vitri WHERE TenViTri = '$tenvitri'";
    $rstenvitri = mysqli_query($connection, $sql_tenvitri);
    if (file_exists("img/vi-tri/" . $_FILES["Anh"]["name"])) {
        $store = $_FILES["Anh"]["name"];
        $_SESSION['status'] = "Hình đã tồn tại. '.$store.'";
        header('location:them-vi-tri.php');
    } else {
        if (!$tenvitri || !$mota || !$anhvitri) {
            echo "Không thành công!";
            $_SESSION['status'] = "Vui lòng không bỏ trống trường!";
            header('location: them-vi-tri.php');
        } else {
            if (mysqli_num_rows($rstenvitri) > 0) {
                echo "Không thành công";
                $_SESSION['status'] = "Vị Trí Đã Tồn Tại!";
                header('location: them-vi-tri.php');
            } else {
                $query = "INSERT INTO vitri (`TenViTri`,`MoTa`,`Anh`)
             VALUES ('$tenvitri','$mota','$anhvitri')";
                $query_run = mysqli_query($connection, $query);
                if ($query_run) {
                    move_uploaded_file($_FILES["Anh"]["tmp_name"], "img/vi-tri/" . $_FILES["Anh"]["name"]);
                    $_SESSION['success'] = "Thêm Thành Công!";
                    header('location: danh-sach-vi-tri.php');
                } else {
                    $_SESSION['status'] = "Thêm Thất Bại!";
                    header('location: them-vi-tri.php');
                }
            }
        }
    }
}

//* SỬA VỊ TRÍ*// 
if (isset($_POST['btn_capnhat_vitri'])) {
    $mavitri = $_POST['sua_mavt'];
    $tenvitri = $_POST['sua_tenvt'];
    $mota = $_POST['sua_mota'];
    $anhvitri = $_FILES["Anh"]['name'];
    if (file_exists("img/vi-tri/" . $_FILES["Anh"]["name"])) {
        $store = $_FILES["Anh"]["name"];
        $_SESSION['status'] = "Hình đã tồn tại. '.$store.'";
        header('location: sua-vi-tri.php');
    } else {
        $query = "UPDATE vitri SET TenViTri='$tenvitri', MoTa='$mota', Anh='$anhvitri' WHERE MaViTri='$mavitri'";
        $query_run = mysqli_query($connection, $query);

        if ($query_run) {
            move_uploaded_file($_FILES["Anh"]["tmp_name"], "img/vi-tri/" . $_FILES["Anh"]["name"]);
            $_SESSION['success'] = "Update Successed!";
            header('location: danh-sach-vi-tri.php');
        } else {
            $_SESSION['status'] = "Update Failed!";
            header('location: sua-vi-tri.php');
        }
    }
}
// XÓA VỊ TRÍ 
if (isset($_POST['btn_xoa_vitri'])) {
    $mavitri = $_POST['xoa_vitri'];

    $query = "DELETE FROM vitri WHERE MaViTri='$mavitri'";
    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        $_SESSION['success'] = "Delete Successed!";
        header('location: danh-sach-vi-tri.php');
    } else {
        $_SESSION['status'] = "Delete Failed!";
        header('location: danh-sach-vi-tri.php');
    }
}

// * THÊM LOẠI KHÁCH SẠN *//
if (isset($_POST['btn_them_loai_ks'])) {
    $tenloaikhachsan = $_POST['TenLoaiKS'];


    $sql_tenloaiks = "SELECT * FROM loaikhachsan WHERE TenLoaiKS = '$tenloaikhachsan'";
    $rstenloaiks = mysqli_query($connection, $sql_tenloaiks);

    if (!$tenloaikhachsan) {
        echo "Không thành công!";
        $_SESSION['status'] = "Vui lòng không bỏ trống trường!";
        header('location: them-loai-khach-san.php');
    } else {
        if (mysqli_num_rows($rstenloaiks) > 0) {
            echo "Không thành công";
            $_SESSION['status'] = "Loại Phòng Đã Tồn Tại!";
            header('location: them-loai-khach-san.php');
        } else {
            $query = "INSERT INTO loaikhachsan (`TenLoaiKS`) VALUES ('$tenloaikhachsan')";
            $query_run = mysqli_query($connection, $query);

            if ($query_run) {
                $_SESSION['success'] = "Thêm Thành Công!";
                header('location: danh-sach-loai-khach-san.php');
            } else {
                $_SESSION['status'] = "Thêm Thất Bại!";
                header('location: them-loai-khach-san.php');
            }
        }
    }
}


//*SỬA LOẠI KHÁCH SẠN*//
if (isset($_POST['btn_update_loaiks'])) {
    $maloai = $_POST['sua_maloai'];
    $tenloaiks = $_POST['sua_tenloai'];

    $query = "UPDATE loaikhachsan SET TenLoaiKS='$tenloaiks' WHERE MaLoaiKS='$maloai'";
    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        $_SESSION['success'] = "Update Successed!";
        header('location: danh-sach-loai-khach-san.php');
    } else {
        $_SESSION['status'] = "Update Failed!";
        header('location: sua-loai-khach-san.php');
    }
}

// XÓA LOẠI KHÁCH SẠN 
if (isset($_POST['btn_xoa_loaiks'])) {
    $malks = $_POST['xoa_loaikhachsan'];

    $query = " DELETE FROM loaikhachsan WHERE MaLoaiKS ='$malks' ";
    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        $_SESSION['success'] = "Delete Successed!";
        $_SESSION['success'] = "Cập Nhật Thành Công!";
        header('location: danh-sach-loai-khach-san.php');
    } else {
        $_SESSION['status'] = "Delete Failed!";
        header('location: danh-sach-loai-khach-san.php');
    }
}

// * THÊM LOẠI PHÒNG *// 
if (isset($_POST['btn_them_loai_phong'])) {
    $tenloaiphong = $_POST['TenLoaiPhong'];
    $mota = $_POST['MoTa'];
    $sql_tenloaiphong = "SELECT * FROM loaiphong WHERE TenLoaiPhong = '$tenloaiphong'";
    $rstenloaiphong = mysqli_query($connection, $sql_tenloaiphong);

    if (!$tenloaiphong) {
        echo "Không thành công!";
        $_SESSION['status'] = "Vui lòng không bỏ trống trường!";
        header('location: them-loai-khach-san.php');
    } else {
        if (mysqli_num_rows($rstenloaiphong) > 0) {
            echo "Không thành công";
            $_SESSION['status'] = "Loại Phòng Đã Tồn Tại!";
            header('location: them-loai-khach-san.php');
        } else {
            $query = "INSERT INTO loaiphong (`TenLoaiPhong`,`MoTa`) VALUES ('$tenloaiphong','$mota')";
            $query_run = mysqli_query($connection, $query);

            if ($query_run) {
                $_SESSION['success'] = "Thêm Thành Công!";
                header('location: danh-sach-loai-phong.php');
            } else {
                $_SESSION['status'] = "Thêm Thất Bại!";
                header('location: them-loai-phong.php');
            }
        }
    }
}

//*SỬA LOẠI PHÒNG*//
if (isset($_POST['btn_update_loaiphong'])) {
    $maloai = $_POST['sua_maloai'];
    $tenloaiphong = $_POST['sua_tenloai'];
    $mota = $_POST['sua_mota'];
    $query = "UPDATE loaiphong SET TenLoaiPhong='$tenloaiphong', MoTa='$mota' WHERE MaLoaiPhong='$maloai'";
    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        $_SESSION['success'] = "Update Successed!";
        header('location: danh-sach-loai-phong.php');
    } else {
        $_SESSION['status'] = "Update Failed!";
        header('location: sua-loai-phong.php');
    }
}
// XÓA LOẠI PHÒNG 
if (isset($_POST['btn_xoa_loaiphong'])) {
    $maloaiphong = $_POST['xoa_loaiphong'];

    $query = " DELETE FROM loaiphong WHERE MaLoaiPhong ='$maloaiphong' ";
    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        $_SESSION['success'] = "Delete Successed!";
        $_SESSION['success'] = "Cập Nhật Thành Công!";
        header('location: danh-sach-loai-phong.php');
    } else {
        $_SESSION['status'] = "Delete Failed!";
        header('location: danh-sach-loai-phong.php');
    }
}

// * THÊM THƯƠNG HIỆU KHÁCH SẠN *//
if (isset($_POST['btn_them_thuong_hieu_ks'])) {
    $theloai = $_POST['LoaiKhachSan'];
    $tenthuonghieu = $_POST['TenThuongHieuKS'];
    $mota = $_POST['MoTa'];
    $anh = $_FILES["HinhAnh"]["name"];

    $sql_tenthuonghieu = "SELECT * FROM thuonghieuks WHERE TenThuongHieuKS = '$tenthuonghieu'";
    $rstenthuonghieu = mysqli_query($connection, $sql_tenthuonghieu);

    if (!$theloai || !$tenthuonghieu || !$mota || !$anh) {
        echo "Không thành công!";
        $_SESSION['status'] = "Vui lòng không bỏ trống trường!";
        header('location: them-thuong-hieu-ks.php');
    } else {
        if (mysqli_num_rows($rstenthuonghieu) > 0) {
            echo "Không thành công";
            $_SESSION['status'] = "Thương Hiệu Đã Tồn Tại!";
            header('location: them-thuong-hieu-ks.php');
        } else {
            $query = "INSERT INTO thuonghieuks (`MaLoaiKS`, `TenThuongHieuKS`, `MoTa`, `HinhAnh`) VALUES ('$theloai', '$tenthuonghieu', '$mota', '$anh')";
            $query_run = mysqli_query($connection, $query);
            if ($query_run) {
                move_uploaded_file($_FILES["HinhAnh"]["tmp_name"], "img/thuong-hieu-ks/" . $_FILES["HinhAnh"]["name"]);
                $_SESSION['success'] = "Thêm Thành Công!";
                header('location: danh-sach-thuong-hieu-ks.php');
            } else {
                $_SESSION['status'] = "Thêm Thất Bại!";
                header('location: them-thuong-hieu-ks.php');
            }
        }
    }
}
//SỬA THƯƠNG HIỆU KHÁCH SẠN
if (isset($_POST["btn_update_thks"])) {
    $loaiks = $_POST["sua_maloaiks"];
    $math = $_POST["sua_mathks"];
    $tenth = $_POST["sua_tenthks"];
    $mota = $_POST["sua_mota"];
    $anhth = $_FILES["HinhAnh"]["name"];

    $query = "UPDATE `thuonghieuks` SET `MaLoaiKS`='$loaiks', `TenThuongHieuKS`='$tenth', `MoTa`='$mota', `HinhAnh`='$anhth' WHERE `MaThuongHieuKS`='$math'";
    $query_run = mysqli_query($connection, $query);

    if($query_run) {
        move_uploaded_file($_FILES["HinhAnh"]["tmp_name"], "img/thuong-hieu-ks/".$anhth);
        $_SESSION['success'] = "Update Successed!";
        header('location: danh-sach-thuong-hieu-ks.php');
    }
    else {
        $_SESSION['status'] = "Update Failed!";
        header('location: sua-thuong-hieu-ks.php');
    }
}

// XÓA THƯƠNG HIỆU KHÁCH SẠN
if (isset($_POST['btn_xoa_thuonghieu_ks'])) {
    $mathks = $_POST['xoa_thuonghieu_ks'];

    $query = "DELETE FROM thuonghieuks WHERE MaThuongHieuKS ='$mathks'";
    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        $_SESSION['success'] = "Delete Successed!";
        header('location: danh-sach-thuong-hieu-ks.php');
    } else {
        $_SESSION['status'] = "Delete Failed!";
        header('location: danh-sach-thuong-hieu-ks.php');
    }
}

// * THÊM KhÁCH SẠN *// 
if (isset($_POST['btn_them_khach_san'])) {
    $thuonghieu = $_POST['ThuongHieu'];
    $tenkhachsan = $_POST['TenKS'];
    $hangsao = $_POST['HangSao'];
    $vitri = $_POST['ViTri'];
    $diachi = $_POST['DiaChi'];
    $dienthoai = $_POST['DienThoai'];
    $loaiphong = $_POST['LoaiPhong'];
    $sophong = $_POST['SoPhong'];
    $website = $_POST['WebSite'];
    $mota = $_POST['MoTa'];
    $motalp = $_POST['MoTaLoaiPhong'];
    $anh = $_FILES["Anh"]['name'];
    $anhlp = $_FILES["AnhLoaiPhong"]['name'];
    $gia = $_POST['Gia'];

    $sql_tenkhachsan = "SELECT * FROM khachsan WHERE TenKS = '$tenkhachsan'";
    $rstenks = mysqli_query($connection, $sql_tenkhachsan);
    if ((file_exists("img/khach-san/" . $_FILES["Anh"]["name"])) && file_exists("img/loai-phong/" . $_FILES["AnhLoaiPhong"]["name"])) {
        $store = $_FILES["Anh"]["name"] && $_FILES["AnhLoaiPhong"]["name"];
        $_SESSION['status'] = "Hình đã tồn tại. '.$store.'";
        header('location: them-khach-san.php');
    } else {
        if (!$thuonghieu || !$vitri || !$tenkhachsan || !$hangsao || !$diachi || !$dienthoai || !$loaiphong || !$sophong  || !$website || !$mota || !$motalp || !$anh || !$anhlp || !$gia) {
            echo "Không thành công!";
            $_SESSION['status'] = "Vui lòng không bỏ trống trường!";
            header('location: them-khach-san.php');
        } else {
            if (mysqli_num_rows($rstenks) > 0) {
                echo "Không thành công";
                $_SESSION['status'] = "Khách Sạn Đã Tồn Tại!";
                header('location: them-khach-san.php');
            } else {
                $query = "INSERT INTO khachsan (`MaThuongHieuKS`,`MaViTri`,`TenKS`,`HangSao`,`DiaChi`,`DienThoai`,`MaLoaiPhong`,`SoPhong`,`WebSite`,`MoTa`,`MoTaLoaiPhong`,`Anh`,`AnhLoaiPhong`,`Gia`)
             VALUES ('$thuonghieu','$vitri','$tenkhachsan','$hangsao','$diachi','$dienthoai','$loaiphong','$sophong','$website','$mota','$motalp','$anh','$anhlp','$gia')";
                $query_run = mysqli_query($connection, $query);
                if ($query_run) {
                    move_uploaded_file($_FILES["Anh"]["tmp_name"], "img/khach-san/" . $_FILES["Anh"]["name"]);
                    move_uploaded_file($_FILES["AnhLoaiPhong"]["tmp_name"], "img/loai-phong/" . $_FILES["AnhLoaiPhong"]["name"]);
                    $_SESSION['success'] = "Thêm Thành Công!";
                    header('location: danh-sach-khach-san.php');
                } else {
                    $_SESSION['status'] = "Thêm Thất Bại!";
                    header('location: them-khach-san.php');
                }
            }
        }
    }
}

//SỬA KHÁCH SẠN
if (isset($_POST['btn_capnhat_ks'])) {
    $maks = $_POST['sua_maks'];
    $thuonghieuks = $_POST['sua_mathks'];
    $tenks = $_POST['sua_tenks'];
    $hangsao = $_POST['sua_hangsao'];
    $vitri = $_POST['sua_vitri'];
    $diachiks = $_POST['sua_diachiks'];
    $dtks = $_POST['sua_sdtks'];
    $loaiphong = $_POST['sua_loaiphong'];
    $sophong = $_POST['sua_sophong'];
    $website = $_POST['sua_web'];
    $mota = $_POST['sua_mota'];
    $motalp = $_POST['sua_motalp'];
    $anhks = $_FILES["Anh"]['name'];
    $anhlp = $_FILES["AnhLoaiPhong"]['name'];
    $gia = $_POST['sua_gia'];
    $query = "UPDATE khachsan SET  MaThuongHieuKS='$thuonghieuks', MaViTri='$vitri', TenKS='$tenks', HangSao='$hangsao', DiaChi='$diachiks', DienThoai='$dtks', MaLoaiPhong='$loaiphong', SoPhong='$sophong', WebSite='$website',MoTa='$mota',MoTaLoaiPhong='$motalp', Anh='$anhks', AnhLoaiPhong='$anhlp', Gia='$gia' WHERE MaKS='$maks'";
    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        move_uploaded_file($_FILES["Anh"]["tmp_name"], "img/khach-san/" . $_FILES["Anh"]["name"]);
        move_uploaded_file($_FILES["AnhLoaiPhong"]["tmp_name"], "img/loai-phong/" . $_FILES["AnhLoaiPhong"]["name"]);
        $_SESSION['success'] = "Cập Nhật Thành Công!";
        header('location: danh-sach-khach-san.php');
    } else {
        $_SESSION['status'] = "Cập Nhật Thất Bại!";
        header('location: sua-khach-san.php');
    }
}



// XÓA KHÁCH SẠN 
if (isset($_POST['btn_xoa_ks'])) {
    $maks = $_POST['xoa_khachsan'];

    $query = " DELETE FROM khachsan WHERE MaKS ='$maks' ";
    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        $_SESSION['success'] = "Delete Successed!";
        header('location: danh-sach-khach-san.php');
    } else {
        $_SESSION['status'] = "Delete Failed!";
        header('location: danh-sach-khach-san.php');
    }
}

// * THÊM TIN TỨC *//
if (isset($_POST['btn_them_tin_tuc'])) {
    $tentintuc = $_POST['TenTinTuc'];
    $anh = $_FILES["HinhAnh"]['name'];
    $theloai = $_POST['LoaiTin'];
    $mota = $_POST['MoTa'];
    $nhanvien = $_POST['NhanVien'];
    $chitiet = $_POST['ChiTiet'];
    // $ngay = date("Y/m/d h:i:s");
    $ngay = $_POST['Ngay'];
    $taoboi = $_POST['TaoBoi'];

    $sql_tentintuc = "SELECT * FROM tintuc WHERE TenTinTuc = '$tentintuc'";
    $rstentintuc = mysqli_query($connection, $sql_tentintuc);
    if (file_exists("img/tin-tuc/" . $_FILES["HinhAnh"]['name'])) {
        $store = $_FILES["HinhAnh"]['name'];
        $_SESSION['status'] = "Hình đã tồn tại. '.$store.'";
        header('location: them-tin-tuc.php');
    } else {
        if (!$tentintuc || !$theloai || !$mota || !$nhanvien || !$chitiet || !$anh || !$ngay || !$taoboi) {
            echo "Không thành công!";
            $_SESSION['status'] = "Vui lòng không bỏ trống trường!";
            header('location: them-tin-tuc.php');
        } else {
            if (mysqli_num_rows($rstentintuc) > 0) {
                echo "Không thành công";
                $_SESSION['status'] = "Tin Tức Đã Tồn Tại!";
                header('location: them-tin-tuc.php');
            } else {
                $query = "INSERT INTO tintuc (`TenTinTuc`,`MaTheLoai`, `MoTa`,`MaNV`,`ChiTiet`,`HinhAnh`,`Ngay`,`TaoBoi`) 
                VALUES ('$tentintuc', '$theloai', '$mota', '$nhanvien', '$chitiet', '$anh', '$ngay', '$taoboi')";
                $query_run = mysqli_query($connection, $query);
                if ($query_run) {
                    move_uploaded_file($_FILES["HinhAnh"]["tmp_name"], "img/tin-tuc/" . $_FILES["HinhAnh"]['name']);
                    $_SESSION['success'] = "Thêm Thành Công!";
                    header('location: danh-sach-tin-tuc.php');
                } else {
                    $_SESSION['status'] = "Thêm Thất Bại!";
                    header('location: them-tin-tuc.php');
                }
            }
        }
    }
}

//SỬA TIN TỨC
if (isset($_POST['btn_capnhat_tt'])) {
    $matt = $_POST['sua_matt'];
    $matheloai = $_POST['sua_matheloai'];
    $manhanvien = $_POST['sua_mannv'];
    $tentt = $_POST['sua_tentt'];
    $mota = $_POST['sua_mota'];
    $chitiet = $_POST['sua_chitiet'];
    $hinhanh = $_FILES["HinhAnh"]['name'];
    $ngay = $_POST['sua_ngay'];
    $taoboi = $_POST['sua_tacgia'];

    $query = "UPDATE tintuc SET MaTheLoai ='$matheloai',MaNV='$manhanvien',TenTinTuc ='$tentt', MoTa ='$mota', ChiTiet ='$chitiet', HinhAnh ='$hinhanh', Ngay='$ngay', TaoBoi='$taoboi' WHERE MaTinTuc='$matt'";
    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        move_uploaded_file($_FILES["HinhAnh"]["tmp_name"], "img/tin-tuc/" . $_FILES["HinhAnh"]["name"]);
        $_SESSION['success'] = "Update Successed!";
        header('location: danh-sach-tin-tuc.php');
    } else {
        $_SESSION['status'] = "Update Failed!";
        header('location: sua-tin-tuc.php');
    }
}


// XÓA TIN TỨC 
if (isset($_POST['btn_xoa_tintuc'])) {
    $matintuc = $_POST['xoa_tintuc'];

    $query = " DELETE FROM tintuc WHERE MaTinTuc='$matintuc' ";
    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        $_SESSION['success'] = "Delete Successed!";
        header('location: danh-sach-tin-tuc.php');
    } else {
        $_SESSION['status'] = "Delete Failed!";
        header('location: danh-sach-tin-tuc.php');
    }
}


// * THÊM THỂ LOẠI TIN TỨC *//
if (isset($_POST['btn_them_loai_tin'])) {
    $tentheloai = $_POST['TenTheLoai'];

    $sql_tentheloai = "SELECT * FROM theloai WHERE TenTheLoai = '$tentheloai'";
    $rstentheloai = mysqli_query($connection, $sql_tentheloai);
    if (!$tentheloai) {
        echo "Không thành công!";
        $_SESSION['status'] = "Vui lòng không bỏ trống trường!";
        header('location: them-loai-tin-tuc.php');
    } else {
        if (mysqli_num_rows($rstentheloai) > 0) {
            echo "Không thành công";
            $_SESSION['status'] = "Thể Loại Tin Đã Tồn Tại!";
            header('location: them-loai-tin-tuc.php');
        } else {
            $query = "INSERT INTO theloai (`TenTheLoai`) VALUES ('$tentheloai')";
            $query_run = mysqli_query($connection, $query);

            if ($query_run) {
                $_SESSION['success'] = "Thêm Thành Công!";
                header('location: danh-sach-the-loai.php');
            } else {
                $_SESSION['status'] = "Thêm Thất Bại!";
                header('location: them-loai-tin-tuc.php');
            }
        }
    }
}




//SỬA THỂ LOẠI TIN TỨC
if (isset($_POST['btn_capnhat_tl'])) {
    $matl = $_POST['sua_matl'];
    $tentl = $_POST['sua_tentl'];

    $query = "UPDATE theloai SET TenTheLoai='$tentl' WHERE MaTheLoai='$matl'";
    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        $_SESSION['success'] = "Update Successed!";
        header('location: danh-sach-the-loai.php');
    } else {
        $_SESSION['status'] = "Update Failed!";
        header('location: sua-loai-tin-tuc.php');
    }
}

// XÓA THỂ LOẠI TIN TỨC
if (isset($_POST['btn_xoa_theloai'])) {
    $matheloai = $_POST['xoa_theloai'];

    $query = "DELETE FROM theloai WHERE MaTheLoai='$matheloai'  ";
    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        $_SESSION['success'] = "Delete Successed!";
        header('location: danh-sach-the-loai.php');
    } else {
        $_SESSION['status'] = "Delete Failed!";
        header('location: danh-sach-the-loai.php');
    }
}


// * THÊM NHÂN VIÊN *//
if (isset($_POST['btn_them_nv'])) {
    $tennv = $_POST['TenNV'];
    $ngaysinh = $_POST['NgaySinh'];
    $diachi = $_POST['DiaChi'];
    $gioitinh = $_POST['GioiTinh'];
    $sdt = $_POST['SDT'];
    $anh = $_FILES["Anh"]['name'];

    $sql_tennv = "SELECT * FROM nhanvien WHERE TenNV = '$tennv'";
    $rs_tennv = mysqli_query($connection, $sql_tennv);
    if (file_exists("img/nhan-vien/" . $_FILES["Anh"]["name"])) {
        $store = $_FILES["Anh"]["name"];
        $_SESSION['status'] = "Hình đã tồn tại. '.$store.'";
        header('location: them-nhan-vien.php');
    } else {
        if (!$tennv || !$ngaysinh || !$diachi || !$gioitinh || !$sdt || !$anh) {
            echo "Không thành công";
            $_SESSION['status'] = "Vui lòng không bỏ trống trường!";
            header('location: them-nhan-vien.php');
        } else {

            if (mysqli_num_rows($rs_tennv) > 0) {
                echo "Không thành công";
                $_SESSION['status'] = "Nhân Viên Đã Tồn Tại!";
                header('location: them-nhan-vien.php');
            } else {
                $query = "INSERT INTO nhanvien (`TenNV`, `NgaySinh`, `DiaChi`, `GioiTinh`, `SDT`, `Anh`)
                        VALUES ('$tennv', '$ngaysinh', '$diachi', '$gioitinh', '$sdt', '$anh')";
                $query_run = mysqli_query($connection, $query);

                if ($query_run) {
                    move_uploaded_file($_FILES["Anh"]["tmp_name"], "img/nhan-vien/" . $_FILES["Anh"]["name"]);
                    $_SESSION['success'] = "Thêm Nhân Viên Thành Công!";
                    header('location: danh-sach-nhan-vien.php');
                } else {
                    //echo "Không Thành Công";
                    $_SESSION['status'] = "Thêm Nhân Viên Thất Bại!";
                    header('location: them-nhan-vien.php');
                }
            }
        }
    }
}

//SỬA NHÂN VIÊN
if (isset($_POST['btn_capnhat_nv'])) {
    $manv = $_POST['sua_manv'];
    $tennv = $_POST['sua_tennv'];
    $ngaysinh = $_POST['sua_ngaysinh'];
    $gioitinh = $_POST['sua_gioitinh'];
    $diachi = $_POST['sua_diachi'];
    $sdt = $_POST['sua_dienthoai'];
    $anh = $_FILES["Anh"]['name'];
    if (file_exists("admin/img/nhan-vien/" . $_FILES["Anh"]["name"])) {
        $store = $_FILES["Anh"]["name"];
        $_SESSION['status'] = "Hình đã tồn tại. '.$store.'";
        header('location: sua-nhan-vien.php');
    } else {
        $query = "UPDATE nhanvien SET TenNV='$tennv', NgaySinh='$ngaysinh', GioiTinh='$gioitinh', DiaChi='$diachi', SDT='$sdt', Anh='$anh', WHERE MaNV='$manv'";
        $query_run = mysqli_query($connection, $query);

        if ($query_run) {
            move_uploaded_file($_FILES["Anh"]["tmp_name"], "img/nhan-vien/" . $_FILES["Anh"]["name"]);
            $_SESSION['success'] = "Update Successed!";
            header('location: danh-sach-nhan-vien.php');
        } else {
            $_SESSION['status'] = "Update Failed!";
            header('location: sua-nhan-vien.php');
        }
    }
}

// XÓA NHÂN VIÊN
if (isset($_POST['btn_xoa_nv'])) {
    $manv = $_POST['xoa_nhanvien'];

    $query = " DELETE FROM nhanvien WHERE MaNV ='$manv' ";
    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        $_SESSION['success'] = "Delete Successed!";
        header('location: danh-sach-nhan-vien.php');
    } else {
        $_SESSION['status'] = "Delete Failed!";
        header('location: danh-sach-nhan-vien.php');
    }
}


// * THÊM HƯỚNG DẪN VIÊN *//
if (isset($_POST['btn_them_hdv'])) {
    $tenhdv = $_POST['TenHDV'];
    $ngaysinh = $_POST['NgaySinh'];
    $diachi = $_POST['DiaChi'];
    $anh = $_FILES["Anh"]['name'];
    $gioitinh = $_POST['GioiTinh'];
    $sdt = $_POST['SDT'];

    $sql_tenhdv = "SELECT * FROM huongdanvien WHERE TenHDV = '$tenhdv'";
    $rstenhdv = mysqli_query($connection, $sql_tenhdv);
    if (file_exists("img/huong-dan-vien/" . $_FILES["Anh"]["name"])) {
        $store = $_FILES["Anh"]["name"];
        $_SESSION['status'] = "Hình đã tồn tại. '.$store.'";
        header('location: them-huong-dan-vien.php');
    } else {
        if (!$tenhdv || !$ngaysinh || !$diachi || !$gioitinh || !$sdt || !$anh) {
            echo "Không thành công!";
            $_SESSION['status'] = "Vui lòng không bỏ trống trường!";
            header('location: them-huong-dan-vien.php');
        } else {
            if (mysqli_num_rows($rstenhdv) > 0) {
                echo "Không thành công";
                $_SESSION['status'] = "Hướng Dẫn Viên Đã Tồn Tại!";
                header('location: them-huong-dan-vien.php');
            } else {
                $query = "INSERT INTO huongdanvien (`TenHDV`, `NgaySinh`, `DiaChi`, `GioiTinh`, `SDT`, `Anh`)
            VALUES ('$tenhdv', '$ngaysinh', '$diachi', '$gioitinh', '$sdt', '$anh')";
                $query_run = mysqli_query($connection, $query);

                if ($query_run) {
                    move_uploaded_file($_FILES["Anh"]["tmp_name"], "img/huong-dan-vien/" . $_FILES["Anh"]["name"]);
                    $_SESSION['success'] = "Thêm Thành Công!";
                    header('location: danh-sach-huong-dan-vien.php');
                } else {
                    $_SESSION['status'] = "Thêm Thất Bại!";
                    header('location: them-huong-dan-vien.php');
                }
            }
        }
    }
}

//SỬA HƯỚNG DẪN VIÊN
if (isset($_POST['btn_capnhat_hdv'])) {
    $mahdv = $_POST['sua_mahdv'];
    $tenhdv = $_POST['sua_tenhdv'];
    $ngaysinh = $_POST['sua_ngaysinh'];
    $diachi = $_POST['sua_diachi'];
    $gioitinh = $_POST['sua_gioitinh'];
    $sdt = $_POST['sua_sdt'];
    $anh = $_FILES["Anh"]['name'];

    $query = "UPDATE huongdanvien SET TenHDV='$tenhdv', NgaySinh='$ngaysinh', DiaChi='$diachi', GioiTinh='$gioitinh', SDT='$sdt', Anh='$anh' WHERE MaHDV='$mahdv'";
    $query_run = mysqli_query($connection, $query);
    if (file_exists("img/huong-dan-vien/" . $_FILES["Anh"]["name"])) {
        $store = $_FILES["Anh"]["name"];
        $_SESSION['status'] = "Hình đã tồn tại. '.$store.'";
        header('location: them-huong-dan-vien.php');
    } else {
        if ($query_run) {
            move_uploaded_file($_FILES["Anh"]["tmp_name"], "img/huong-dan-vien/" . $_FILES["Anh"]["name"]);
            $_SESSION['success'] = "Update Successed!";
            header('location: danh-sach-huong-dan-vien.php');
        } else {
            $_SESSION['status'] = "Update Failed!";
            header('location: sua-huong-dan-vien.php');
        }
    }
}

// XÓA HƯỚNG DẪN VIÊN
if (isset($_POST['btn_xoa_hdv'])) {
    $mahdv = $_POST['xoa_huongdanvien'];

    $query = " DELETE FROM huongdanvien WHERE MaHDV ='$mahdv' ";
    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        $_SESSION['success'] = "Delete Successed!";
        header('location: danh-sach-huong-dan-vien.php');
    } else {
        $_SESSION['status'] = "Delete Failed!";
        header('location: danh-sach-huong-dan-vien.php');
    }
}

//SỬA KHÁCH HÀNG
if (isset($_POST['btn_capnhat_kh'])) {
    $makh = $_POST['sua_makh'];
    $tenkh = $_POST['sua_tenkh'];
    $diachi = $_POST['sua_diachi'];
    $gioitinh = $_POST['sua_gioitinh'];
    $dienthoai = $_POST['sua_sdt'];
    $email = $_POST['sua_email'];
    $query = "UPDATE khachhang SET TenKH='$tenkh', DiaChi='$diachi', GioiTinh ='$gioitinh', SDT='$dienthoai', Email='$email' WHERE MaKH='$makh'";
    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        $_SESSION['success'] = "Update Successed!";
        header('location: danh-sach-khach-hang.php');
    } else {
        $_SESSION['status'] = "Update Failed!";
        header('location: sua-khach-hang.php');
    }
}

// XÓA KHÁCH HÀNG 
if (isset($_POST['btn_xoa_khachhang'])) {
    $makh = $_POST['xoa_khachhang'];

    $query = "DELETE FROM khachhang WHERE MaKH='$makh'";
    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        $_SESSION['success'] = "Delete Successed!";
        header('location: danh-sach-khach-hang.php');
    } else {
        $_SESSION['status'] = "Delete Failed!";
        header('location: danh-sach-khach-hang.php');
    }
}

//SỬA HÓA ĐƠN TOUR TRỌN GÓI
if (isset($_POST['btn_capnhat_hd_tron_goi'])) {
    $mahd = $_POST['sua_mahd'];
    $thanhtoan = $_POST['sua_thanhtoan'];
    $makh = $_POST['sua_khachhang'];
    $tour = $_POST['sua_tour'];
    $songuoilon = $_POST['sua_songuoilon'];
    $sotrem = $_POST['sua_sotreem'];
    $ngaydat = $_POST['sua_ngaydat'];
    $tongtien = $_POST['sua_tongtien'];
    $tinhtrang = $_POST['sua_tinhtrang'];
    $query = "UPDATE hoadon SET  TinhTrang='$tinhtrang' WHERE MaHD='$mahd'";
    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        $_SESSION['success'] = "Cập Nhật Thành Công!";
        header('location: danh-sach-hoa-don-tour-tron-goi.php');
    } else {
        $_SESSION['status'] = "Cập Nhật Thất Bại!";
        header('location: sua-hoa-don-tour-tron-goi.php');
    }
}

//SỬA YÊU CẦU HUỶ TOUR

if (isset($_POST["btn-update-huy-tour"])) {

    $mahd = $_POST["sua_mahd"];
    $tinhtrang = $_POST["sua_tinhtrang"];
    $ghichu = $_POST["sua_ghichu"];

    $query = "UPDATE hoadon SET TinhTrang='$tinhtrang', GhiChu='$ghichu' WHERE MaHD='$mahd'";
    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        $_SESSION['success'] = "Cập Nhật Thành Công!";
        header('location: danh-sach-yeu-cau-huy-tour.php');

        $email = $_POST["sua_email"];
        $ngayhientai = date("Y-m-d");
        $tentour = $_POST["sua_tentour"];
        require_once('phpmailler/class.phpmailer.php');

        $mailday = "";
        require_once('phpmailler/class.phpmailer.php');

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
        $mail->Subject    = "Xác Nhận Huỷ Tour - $tentour";
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

                    .section-body {
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
                    <h3 style="text-align:center">HUỶ TOUR THÀNH CÔNG</h3>
                    <hr>

                    <div class="section-body">
                    <b>
                    Yêu cầu huỷ tour <i style="color:#007bff">#' . $mahd . ',</i> của quý khách đã được chấp thuận. Vui lòng đợi từ 2-3 ngày tính ngày nghỉ và ngày lễ kể từ ngày yêu cầu huỷ tour của quý khách được xác nhận,
                    Công ty sẽ hoàn tất thủ tục và hoàn trả tiền cho quý khách theo chính sách huỷ tour của công ty.<br>
                    Cám ơn quý khách đã tin tưởng sử dụng dịch vụ của chúng tôi!
                    </b>
                    </div>
                    <div class="bg-primary">
                        <p><b>Công ty Du lịch và Lữ hành Travello</b><br></p>
                        <p>140 Lê Trọng Tấn, P. Tây Thạnh, Q. Tân Phú, TP. HCM<br></p>
                        <p>ĐT: (+84) 326 805 211 - Email: Travello@gmail.com</p>
                    </div>

                </div>
            </body>

            </html>';
        if ($mail->Send()) {
        } else {
        }
    } else {
        $_SESSION['status'] = "Cập Nhật Thất Bại!";
        header('location: cap-nhat-yeu-cau-huy-tour.php');
    }
}

//KHÔNG CHẤP NHẬN YÊU CẦU HUỶ
if (isset($_POST["ignore_cancel_btn"])) {

    $mahd = $_POST["mahd"];
    $tinhtrang = $_POST["tinhtrang"];
    $email = $_POST["email"];
    $tentour = $_POST["tentour"];

    $query = "UPDATE hoadon SET TinhTrang='$tinhtrang' WHERE MaHD='$mahd'";
    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        $_SESSION['success'] = "Cập Nhật Thành Công!";
        header('location: danh-sach-yeu-cau-huy-tour.php');

        $email = $_POST["email"];
        $tentour = $_POST["tentour"];
        require_once('phpmailler/class.phpmailer.php');

        $mailday = "";
        require_once('phpmailler/class.phpmailer.php');

        //Khởi tạo đối tượng
        $mail = new PHPMailer();
        $mail->IsSMTP(); // Gọi đến class xử lý SMTP
        $mail->Host       = "smtp.gmail.com"; // tên SMTP server
        $mail->SMTPAuth   = true;                  // Sử dụng đăng nhập vào account
        $mail->SMTPSecure = "ssl";
        $mail->Host       = "smtp.gmail.com";     // Thiết lập thông tin của SMPT
        $mail->Port       = 465;                     // Thiết lập cổng gửi email của máy
        $mail->Username   = "travelloco.op@gmail.com"; // SMTP account username
        $mail->Password   = "travello123";            // SMTP account password
        //Thiet lap thong tin nguoi gui va email nguoi gui
        $mail->SetFrom('travelloco.op@gmail.com', 'Travello');
        //Thiết lập thông tin người nhận
        $mail->AddAddress($email, "Khách hàng");
        //Thiết lập email nhận email hồi đáp
        //nếu người nhận nhấn nút Reply
        $mail->AddReplyTo("travelloco.op@gmail.com", "Travello");
        $mail->Subject    = "Huỷ Tour Thất Bại - $tentour";
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

                    .section-body {
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
                    <h3 style="text-align:center">HUỶ TOUR THÀNH CÔNG</h3>
                    <hr>

                    <div class="section-body">
                    <b>
                    Yêu cầu huỷ tour <i style="color:#007bff">#' . $mahd . ',</i> của quý khách không được chấp thuận.<br>
                    Mọi thắc mắc vui lòng liên hệ hotline: 0326805211<br>
                    Cám ơn quý khách đã tin tưởng sử dụng dịch vụ của chúng tôi!
                    </b>
                    </div>
                    <div class="bg-primary">
                        <p><b>Công ty Du lịch và Lữ hành Travello</b><br></p>
                        <p>140 Lê Trọng Tấn, P. Tây Thạnh, Q. Tân Phú, TP. HCM<br></p>
                        <p>ĐT: (+84) 326 805 211 - Email: TravelloCo.op@gmail.com</p>
                    </div>

                </div>
            </body>

            </html>';
        if ($mail->Send()) {
        } else {
        }
    } else {
        $_SESSION['status'] = "Cập Nhật Thất Bại!";
        header('location: cap-nhat-yeu-cau-huy-tour.php');
    }
}
