<?php
include("db_config.php");

// * THÊM LOẠI NHÀ HÀNG *// (ĐƯỢC)
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

//*SỬA LOẠI NHÀ HÀNG*// (ĐƯỢC)
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

// XÓA LOẠI NHÀ HÀNG (ĐƯỢC)
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

// * THÊM THƯƠNG HIỆU NHÀ HÀNG *// (ĐƯỢC)
if (isset($_POST['btn_them_thuong_hieu'])) {
    $theloai = $_POST['LoaiNhaHang'];
    $tenthuonghieunh = $_POST['TenThuongHieuNH'];
    $mota= $_POST['MoTa'];
    $anh = $_FILES["HinhAnh"]['name'];

    $sql_tenthuonghieunh = "SELECT * FROM thuonghieunh WHERE TenThuongHieuNH = '$tenthuonghieunh'";
    $rstenthuonghieunh = mysqli_query($connection, $sql_tenthuonghieunh);
    if (file_exists("img/thuong-hieu-nh/" . $_FILES["HinhAnh"]["name"])) {
        $store = $_FILES["HinhAnh"]["name"];
        $_SESSION['status'] = "Hình đã tồn tại. '.$store.'";
        header('location: them-thuong-hieu-nh.php');
    }
    else
    {
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
                move_uploaded_file($_FILES["HinhAnh"]["tmp_name"], "img/thuong-hieu-nh/".$_FILES["HinhAnh"]["name"]);
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
//SỬA THƯƠNG HIỆU (ĐƯỢC)
if (isset($_POST['btn_capnhat_thuonghieu'])) {
    $mathnh = $_POST['sua_mathnh'];
    $theloainh = $_POST['sua_maloainh'];
    $tenthnh= $_POST['sua_tenthnh'];
    $mota = $_POST['sua_mota'];
    $anhthnh = $_FILES["Anh"]['name'];
    if (file_exists("img/thuong-hieu-nh/" . $_FILES["HinhAnh"]["name"])) {
        $store = $_FILES["HinhAnh"]["name"];
        $_SESSION['status'] = "Hình đã tồn tại. '.$store.'";
        header('location: them-thuong-hieu-nh.php');
    }
    else
    {
    $query = "UPDATE thuonghieunh SET MaLoaiNH='$theloainh', TenThuongHieuNH='$tenthnh', MoTa='$mota', HinhAnh='$anhthnh' WHERE MaThuongHieuNH='$mathnh'";
    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        move_uploaded_file($_FILES["HinhAnh"]["tmp_name"], "img/thuong-hieu-nh/".$_FILES["HinhAnh"]["name"]);
        $_SESSION['success'] = "Update Successed!";
        header('location: danh-sach-thuong-hieu-nh.php');
    } else {
        $_SESSION['status'] = "Update Failed!";
        header('location: sua-thuong-hieu-nh.php');
    }
    }
}

// XÓA THƯƠNG HIỆU (ĐƯỢC)
if (isset($_POST['btn_xoa_thuonghieu'])) {
    $mathnh = $_POST['xoa_thuonghieu'];

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


// * THÊM NHÀ HÀNG *//  (ĐƯỢC)
if (isset($_POST['btn_them_nh'])) {
    $thuonghieunh = $_POST['ThuongHieuNH'];
    $tennhahang = $_POST['TenNhaHang'];
    $vitri = $_POST['ViTri'];
    $diachi = $_POST['DiaChi'];
    $sdt = $_POST['SDT'];
    $anh = $_FILES["Anh"]['name'];
    $gioithieu = $_POST['GioiThieuNH'];
    $gianh = $_POST['GiaNH'];
    $ngayden = $_POST['NgayDen'];
    $ngaydi = $_POST['NgayDi'];

    $sql_tennh = "SELECT * FROM nhahang WHERE TenNhaHang = '$tennhahang'";
    $rstennh = mysqli_query($connection, $sql_tennh);

    if (file_exists("img/nha-hang/" . $_FILES["Anh"]["name"])) {
        $store = $_FILES["Anh"]["name"];
        $_SESSION['status'] = "Hình đã tồn tại. '.$store.'";
        header('location: them-nha-hang.php');
    } else {
        if (!$anh || !$tennhahang || !$diachi || !$sdt || !$gioithieu || !$gianh || !$ngayden || !$ngaydi) {
            echo "Không thành công!";
            $_SESSION['status'] = "Vui lòng không bỏ trống trường!";
            header('location: them-nha-hang.php');
        } else {

            if (mysqli_num_rows($rstennh) > 0) {
                echo "Không thành công";
                $_SESSION['status'] = "Nhà Hàng Đã Tồn Tại!";
                header('location: them-nha-hang.php');
            } else {
                $query = "INSERT INTO nhahang (`MaThuongHieuNH`,`TenNhaHang`,`ViTri`,`DiaChi`,`Anh`,`SDT`,`GioiThieuNH`,`GiaNH`,`NgayDen`,`NgayDi`)
                 VALUES ('$thuonghieunh','$tennhahang','$vitri','$diachi','$anh','$sdt','$gioithieu','$gianh','$ngayden','$ngaydi')";
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

//SỬA NHÀ HÀNG (ĐƯỢC)
if (isset($_POST['btn_capnhat_nh'])) {
    $thuonghieunh = $_POST['sua_mathnh'];
    $manh = $_POST['sua_mnh'];
    $tennh = $_POST['sua_tennh'];
    $vitri = $_POST['sua_vitri'];
    $diachi = $_POST['sua_diachinh'];
    $anh = $_FILES["Anh"]['name'];
    $sdt = $_POST['sua_sdtnh'];
    $gth = $_POST['sua_gtnh'];
    $gia = $_POST['sua_gianh'];
    $ngayden = $_POST['sua_ngayden'];
    $ngaydi = $_POST['sua_ngaydi'];
    if (file_exists("img/nha-hang/" . $_FILES["Anh"]["name"])) {
        $store = $_FILES["Anh"]["name"];
        $_SESSION['status'] = "Hình đã tồn tại. '.$store.'";
        header('location: them-nha-hang.php');
    } else {
        $query = "UPDATE nhahang SET TenNhaHang='$tennh', DiaChi='$diachi', Anh='$anh', SDT='$sdt', GioiThieuNH='$gth', GiaNH='$gia', NgayDen='$ngayden', NgayDi='$ngaydi' WHERE MaNH='$manh'";
        $query_run = mysqli_query($connection, $query);

        if ($query_run) {
            move_uploaded_file($_FILES["Anh"]["tmp_name"], "img/nha-hang/" . $_FILES["Anh"]["name"]);
            $_SESSION['success'] = "Cập Nhật Thành Công!";
            header('location: danh-sach-nha-hang.php');
        } else {
            $_SESSION['status'] = "Cập Nhật Thất Bại!";
            header('location: sua-nha-hang.php');
        }
    }
}

// XÓA NHÀ HÀNG (ĐƯỢC)
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
// * THÊM PHƯƠNG TIỆN *// (ĐƯỢC)
if (isset($_POST['btn_them_phuong_tien'])) {
    $tenphuongtien = $_POST['PhuongTien'];
    $noidi = $_POST['NoiDi'];
    $noiden = $_POST['NoiDen'];
    $gia = $_POST['Gia'];
    $sql_tenphuongtien = "SELECT * FROM phuongtien WHERE PhuongTien = '$tenphuongtien'";
    $rstenphuongtien = mysqli_query($connection, $sql_tenphuongtien);
    if (!$tenphuongtien || !$noidi || !$noiden || !$gia) {
        echo "Không thành công!";
        $_SESSION['status'] = "Vui lòng không bỏ trống trường!";
        header('location: them-phuong-tien.php');
    } else {
        if (mysqli_num_rows($rstendichvu) > 0) {
            echo "Không thành công";
            $_SESSION['status'] = "Dịch Vụ Đã Tồn Tại!";
            header('location: them-phuong-tien.php');
        } else {
            $query = "INSERT INTO phuongtien (`PhuongTien`, `NoiDi`,`NoiDen`, `Gia`) VALUES ('$tenphuongtien','$noidi','$noiden','$gia')";
            $query_run = mysqli_query($connection, $query);

            if ($query_run) {
                $_SESSION['success'] = "Thêm Thành Công!";
                header('location: danh-sach-phuong-tien.php');
            } else {
                $_SESSION['status'] = "Thêm Thất Bại!";
                header('location: them-phuong-tien.php');
            }
        }
    }
}
//SỬA PHƯƠNG TIỆN (ĐƯỢC)
if (isset($_POST['btn_capnhat_pt'])) {
    $mapt = $_POST['sua_MaPhuongTien'];
    $tenpt = $_POST['sua_tenphuongtien'];
    $noidi = $_POST['sua_noidi'];
    $noiden = $_POST['sua_noiden'];
    $gia = $_POST['sua_gia'];

    $query = "UPDATE phuongtien SET PhuongTien='$tenpt', NoiDi='$noidi', NoiDen='$noiden', Gia='$gia' WHERE MaPhuongTien='$mapt'";
    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        $_SESSION['success'] = "Sửa Thành Công!";
        header('location: danh-sach-phuong-tien.php');
    } else {
        $_SESSION['status'] = "Sửa Thất Bại!";
        header('location: sua-phuong-tien.php');
    }
}
// XÓA PHƯƠNG TIỆN (ĐƯỢC)
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



// * THÊM TOUR DU LỊCH *// (ĐƯỢC)
if (isset($_POST['btn_them_tour'])) {
    $loaitour = $_POST['loaitour'];
    $tentour = $_POST['TenTour'];
    $noikhoihanh = $_POST['NoiKhoiHanh'];
    $noiden = $_POST['NoiDen'];
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
    $anhtour = $_FILES["Anh"]['name'];

    $sql_tentour = "SELECT * FROM tourdulich WHERE TenTour = '$tentour'";
    $rstentour = mysqli_query($connection, $sql_tentour);
    if (file_exists("img/tour-du-lich/" . $_FILES["Anh"]["name"])) {
        $store = $_FILES["Anh"]["name"];
        $_SESSION['status'] = "Hình đã tồn tại. '.$store.'";
        header('location: them-tour-du-lich.php');
    } else {
        if (!$loaitour || !$tentour || !$noikhoihanh || !$noiden || !$thoigian || !$khachsan || !$nhahang || !$huongdv || !$phuongtien || !$dichvu || !$giatien || !$giatreem || !$hanhtrinh || !$songay || !$anhtour) {
            echo "Không thành công!";
            $_SESSION['status'] = "Vui lòng không bỏ trống trường!";
            header('location: them-tour-du-lich.php');
        } else {
            if (mysqli_num_rows($rstentour) > 0) {
                echo "Không thành công";
                $_SESSION['status'] = "Tour Đã Tồn Tại!";
                header('location: them-tour-du-lich.php');
            } else {
                $query = "INSERT INTO tourdulich (`MaLoaiTour`,`TenTour`,`NoiKhoiHanh`,`NoiDen`,`ThoiGian`,`MaKS`,`MaNH`,`MaHDV`,`MaPhuongTien`,`MaDV`,`GiaTien`,`GiaTreEm`,`HanhTrinh`,`SoNgay`,`Anh`)
             VALUES ('$loaitour','$tentour','$noikhoihanh','$noiden','$thoigian','$khachsan','$nhahang','$huongdv','$phuongtien','$dichvu','$giatien','$giatreem','$hanhtrinh', '$songay' ,'$anhtour')";
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


//* SỬA TOUR DU LỊCH *// (ĐƯỢC)
if (isset($_POST['btn_capnhat_tour'])) {
    $matour = $_POST['sua_matour'];
    $loaitour = $_POST['sua_loaitour'];
    $tentour = $_POST['sua_tentour'];
    $noikhoihanh = $_POST['sua_noikhoihanh'];
    $noiden = $_POST['sua_noiden'];
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
    $anhtour = $_FILES["Anh"]['name'];
    if (file_exists("img/tour-du-lich/" . $_FILES["Anh"]["name"])) {
        $store = $_FILES["Anh"]["name"];
        $_SESSION['status'] = "Hình đã tồn tại. '.$store.'";
        header('location: them-tour-du-lich.php');
    } else {
        $query = "UPDATE tourdulich SET MaLoaiTour='$loaitour', TenTour='$tentour', NoiKhoiHanh='$noikhoihanh', NoiDen='$noiden', ThoiGian='$thoigian', GiaTien='$giatien',MaKS='$khachsan',MaNH='$nhahang',MaHDV='$hdv',MaPhuongTien='$phuongtien',MaDV='$dichvu', GiaTreEm='$giatreem', HanhTrinh='$hanhtrinh', SoNgay='$songay', Anh='$anhtour' WHERE MaTour='$matour'";
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


// XÓA TOUR DU LỊCH (ĐƯỢC)
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


// * THÊM DỊCH VỤ ĐI KÈM *// (ĐƯỢC)
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



//SỬA DỊCH VỤ ĐI KÈM (ĐƯỢC)
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


// XÓA DỊCH VỤ ĐI KÈM (ĐƯỢC)
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


// * THÊM LOẠI KHÁCH SẠN *// (ĐƯỢC)
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


//*SỬA LOẠI KHÁCH SẠN*// (ĐƯỢC)
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

// XÓA LOẠI KHÁCH SẠN (ĐƯỢC)
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

// * THÊM LOẠI PHÒNG *// (ĐƯỢC)
if (isset($_POST['btn_them_loai_phong'])) {
    $tenloaiphong = $_POST['TenLoaiPhong'];
    $gia = $_POST['Gia'];
    $soluongphong = $_POST['SoLuongPhong'];

    $sql_tenloaiphong = "SELECT * FROM loaiphong WHERE TenLoaiPhong = '$tenloaiphong'";
    $rstenloaiphong = mysqli_query($connection, $sql_tenloaiphong);

    if (!$tenloaiphong || !$gia || !$soluongphong) {
        echo "Không thành công!";
        $_SESSION['status'] = "Vui lòng không bỏ trống trường!";
        header('location: them-loai-khach-san.php');
    } else {
        if (mysqli_num_rows($rstenloaiphong) > 0) {
            echo "Không thành công";
            $_SESSION['status'] = "Loại Phòng Đã Tồn Tại!";
            header('location: them-loai-khach-san.php');
        } else {
            $query = "INSERT INTO loaiphong (`TenLoaiPhong`, `Gia`, `SoLuongPhong`) VALUES ('$tenloaiphong','$gia','$soluongphong')";
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
//*SỬA LOẠI PHÒNG*// (ĐƯỢC)
if (isset($_POST['btn_update_loaiphong'])) {
    $maloai = $_POST['sua_maloai'];
    $tenloaiphong = $_POST['sua_tenloai'];
    $gia= $_POST['sua_gia'];
    $soluongphong= $_POST['sua_slp'];

    $query = "UPDATE loaiphong SET TenLoaiPhong='$tenloaiphong', Gia='$gia', SoLuongPhong='$soluongphong' WHERE MaLoaiPhong='$maloai'";
    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        $_SESSION['success'] = "Update Successed!";
        header('location: danh-sach-loai-phong.php');
    } else {
        $_SESSION['status'] = "Update Failed!";
        header('location: sua-loai-phong.php');
    }
}
 // XÓA LOẠI PHÒNG (ĐƯỢC)
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

// * THÊM THƯƠNG HIỆU KHÁCH SẠN *// (ĐƯỢC)
if (isset($_POST['btn_them_thuong_hieu'])) {
    $theloai = $_POST['LoaiKhachSan'];
    $tenthuonghieu = $_POST['TenThuongHieuKS'];
    $mota= $_POST['MoTa'];
    $anh = $_FILES["HinhAnh"]['name'];

    $sql_tenthuonghieu = "SELECT * FROM thuonghieuks WHERE TenThuongHieuKS = '$tenthuonghieu'";
    $rstenthuonghieu = mysqli_query($connection, $sql_tenthuonghieu);
    if (file_exists("img/thuong-hieu-ks/" . $_FILES["HinhAnh"]["name"])) {
        $store = $_FILES["HinhAnh"]["name"];
        $_SESSION['status'] = "Hình đã tồn tại. '.$store.'";
        header('location: them-thuong-hieu-ks.php');
    }
    else
    {
    if (!$theloai ||!$tenthuonghieu || !$mota || !$anh) {
        echo "Không thành công!";
        $_SESSION['status'] = "Vui lòng không bỏ trống trường!";
        header('location: them-thuong-hieu-ks.php');
    } else {
        if (mysqli_num_rows($rstenthuonghieu) > 0) {
            echo "Không thành công";
            $_SESSION['status'] = "Thương Hiệu Đã Tồn Tại!";
            header('location: them-thuong-hieu-ks.php');
        } else {
            $query = "INSERT INTO thuonghieuks (`MaLoaiKS`,`TenThuongHieuKS`,`MoTa`,`HinhAnh`)
             VALUES ('$theloai','$tenthuonghieu','$mota','$anh')";
            $query_run = mysqli_query($connection, $query);
            if ($query_run) {
                move_uploaded_file($_FILES["HinhAnh"]["tmp_name"], "img/thuong-hieu-ks/".$_FILES["HinhAnh"]["name"]);
                $_SESSION['success'] = "Thêm Thành Công!";
                header('location: danh-sach-thuong-hieu-ks.php');
            } else {
                $_SESSION['status'] = "Thêm Thất Bại!";
                header('location: them-thuong-hieu-ks.php');
            }
        }
    }
    }
}
//SỬA THƯƠNG HIỆU (ĐƯỢC)
if (isset($_POST['btn_capnhat_thuonghieu'])) {
    $loaiks = $_POST['sua_maloaiks'];
    $mathks = $_POST['sua_mathks'];
    $tenthks= $_POST['sua_tenthks'];
    $mota = $_POST['sua_mota'];
    $anhthks = $_FILES["Anh"]['name'];
    if (file_exists("img/thuong-hieu-ks/" . $_FILES["HinhAnh"]["name"])) {
        $store = $_FILES["HinhAnh"]["name"];
        $_SESSION['status'] = "Hình đã tồn tại. '.$store.'";
        header('location: them-thuong-hieu-ks.php');
    }
    else
    {
    $query = "UPDATE thuonghieuks SET MaLoaiKS='$loaiks', TenThuongHieuKS='$tenthks', MoTa='$mota', HinhAnh='$anhthks' WHERE MaThuongHieuKS='$mathks'";
    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        move_uploaded_file($_FILES["HinhAnh"]["tmp_name"], "img/thuong-hieu-ks/".$_FILES["HinhAnh"]["name"]);
        $_SESSION['success'] = "Update Successed!";
        header('location: danh-sach-thuong-hieu-ks.php');
    } else {
        $_SESSION['status'] = "Update Failed!";
        header('location: sua-thuong-hieu-ks.php');
    }
    }
}

// XÓA THƯƠNG HIỆU (ĐƯỢC)
if (isset($_POST['btn_xoa_thuonghieu'])) {
    $mathks = $_POST['xoa_thuonghieu'];

    $query = " DELETE FROM thuonghieuks WHERE MaThuongHieuKS ='$mathks' ";
    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        $_SESSION['success'] = "Delete Successed!";
        header('location: danh-sach-thuong-hieu-ks.php');
    } else {
        $_SESSION['status'] = "Delete Failed!";
        header('location: danh-sach-thuong-hieu-ks.php');
    }
}

// * THÊM KhÁCH SẠN *// (ĐƯỢC)
if (isset($_POST['btn_them_khach_san'])) {
    $thuonghieu = $_POST['ThuongHieu'];
    // $loaiks = $_POST['LoaiKS'];
    $tenkhachsan = $_POST['TenKS'];
    $hangsao = $_POST['HangSao'];
    $vitri = $_POST['ViTri'];
    $diachi = $_POST['DiaChi'];
    $dienthoai = $_POST['DienThoai'];
    $loaiphong= $_POST['LoaiPhong'];
    $sophong = $_POST['SoPhongDat'];
    $ngayden = $_POST['NgayDen'];
    $ngaydi = $_POST['NgayDi'];
    $website = $_POST['WebSite'];
    $anh = $_FILES["Anh"]['name'];

    $sql_tenkhachsan = "SELECT * FROM khachsan WHERE TenKS = '$tenkhachsan'";
    $rstenks = mysqli_query($connection, $sql_tenkhachsan);
    if (file_exists("img/khach-san/" . $_FILES["Anh"]["name"])) {
        $store = $_FILES["Anh"]["name"];
        $_SESSION['status'] = "Hình đã tồn tại. '.$store.'";
        header('location: them-khach-san.php');
    } else {
        if (!$tenkhachsan || !$hangsao || !$diachi || !$dienthoai || !$sophong || !$ngayden || !$ngaydi || !$website || !$anh) {
            echo "Không thành công!";
            $_SESSION['status'] = "Vui lòng không bỏ trống trường!";
            header('location: them-khach-san.php');
        } else {
            if (mysqli_num_rows($rstenks) > 0) {
                echo "Không thành công";
                $_SESSION['status'] = "Khách Sạn Đã Tồn Tại!";
                header('location: them-khach-san.php');
            } else {
                $query = "INSERT INTO khachsan (`TenKS`,`HangSao`,`DiaChi`,`DienThoai`,`SoPhong`,`NgayDen`,`NgayDi`,`WebSite`,`Anh`)
             VALUES ('$tenkhachsan','$hangsao','$diachi','$dienthoai','$sophong','$ngayden','$ngaydi','$website','$anh')";
                $query_run = mysqli_query($connection, $query);
                if ($query_run) {
                    move_uploaded_file($_FILES["Anh"]["tmp_name"], "img/khach-san/" . $_FILES["Anh"]["name"]);
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

//SỬA KHÁCH SẠN (ĐƯỢC)
if (isset($_POST['btn_capnhat_ks'])) {
    $maks = $_POST['sua_maks'];
    $thuonghieuks = $_POST['sua_mathks'];
    // $loaiks = $_POST['sua_loaiks'];
    $tenks = $_POST['sua_tenks'];
    $hangsao = $_POST['sua_hangsao'];
    $vitri = $_POST['sua_vitri'];
    $diachiks = $_POST['sua_diachiks'];
    $dtks = $_POST['sua_sdtks'];
    $loaiphong = $_POST['sua_loaiphong'];
    $sophong = $_POST['sua_sophong'];
    $ngayden = $_POST['sua_ngayden'];
    $ngaydi = $_POST['sua_ngaydi'];
    $website = $_POST['sua_web'];
    $anhks = $_FILES["Anh"]['name'];
    if (file_exists("img/tin-tuc/" . $_FILES["Anh"]["name"])) {
        $store = $_FILES["HinhAnh"]["name"];
        $_SESSION['status'] = "Hình đã tồn tại. '.$store.'";
        header('location: them-khach-san.php');
    }
    else
    {
    $query = "UPDATE khachsan SET  MaThuongHieuKS='$thuonghieuks', TenKS='$tenks', HangSao='$hangsao', ViTri='$vitri', DiaChi='$diachiks', DienThoai='$dtks', MaLoaiPhong='$loaiphong', SoPhongDat='$sophong', NgayDen='$ngayden', NgayDi='$ngaydi', WebSite='$website', Anh='$anhks' WHERE MaKS='$maks'";
    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        move_uploaded_file($_FILES["Anh"]["tmp_name"], "img/tin-tuc/".$_FILES["Anh"]["name"]);
        $_SESSION['success'] = "Update Successed!";
        header('location: danh-sach-khach-san.php');
    } else {
        $_SESSION['status'] = "Update Failed!";
        header('location: sua-khach-san.php');
    }
    }
}



// XÓA KHÁCH SẠN (ĐƯỢC)
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


// * THÊM TIN TỨC *// (ĐƯỢC)
if (isset($_POST['btn_them_tin_tuc'])) {
    $tentintuc = $_POST['TenTinTuc'];
    $theloai = $_POST['LoaiTin'];
    $mota = $_POST['MoTa'];
    $nhanvien = $_POST['NhanVien'];
    $chitiet = $_POST['ChiTiet'];
    $ngay = $_POST['Ngay'];
    $taoboi = $_POST['TaoBoi'];

    $sql_tentintuc = "SELECT * FROM tintuc WHERE TenTinTuc = '$tentintuc'";
    $rstentintuc = mysqli_query($connection, $sql_tentintuc);
    if (file_exists("img/tin-tuc/" . $_FILES["Anh"]['name'])) {
        $store = $_FILES["Anh"]['name'];
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
            $query = "INSERT INTO tintuc (`TenTinTuc`,`MaTheLoai`, `MoTa`,`MaNV`,`ChiTiet`,`HinhAnh`,`Ngay`,`TaoBoi`) 
            VALUES ('$tentintuc','$theloai','$mota', '$nhanvien' ,'$chitiet','$anh','$ngay','$taoboi')";
            $query_run = mysqli_query($connection, $query);
            if ($query_run) {
                move_uploaded_file($_FILES["Anh"]["tmp_name"], "img/tin-tuc/".$_FILES["Anh"]['name']);
                $_SESSION['success'] = "Thêm Thành Công!";
                header('location: danh-sach-tin-tuc.php');
            }
            else
            {
                $_SESSION['status'] = "Thêm Thất Bại!";
                header('location: them-tin-tuc.php');
            }
          }
        }
    }
}


//SỬA TIN TỨC (ĐƯỢC)
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
    if (file_exists("img/tin-tuc/" . $_FILES["HinhAnh"]["name"])) {
        $store = $_FILES["HinhAnh"]["name"];
        $_SESSION['status'] = "Hình đã tồn tại. '.$store.'";
        header('location: them-tin-tuc.php');
    } else {
        $query = "UPDATE tintuc SET MaTheLoai ='$matheloai',MaNV='$manhanvien',TenTinTuc ='$tentt', MoTa ='$mota', ChiTiet ='$chitiet', HinhAnh ='$hinhanhtt', Ngay='$ngay', TaoBoi='$taoboi' WHERE MaTinTuc='$matt'";
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
}


// XÓA TIN TỨC (ĐƯỢC)
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


// * THÊM THỂ LOẠI TIN TỨC *// (ĐƯỢC)
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




//SỬA THỂ LOẠI TIN TỨC (ĐƯỢC)
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

// XÓA THỂ LOẠI TIN TỨC (ĐƯỢC)
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


// * THÊM NHÂN VIÊN *// (ĐƯỢC)
if (isset($_POST['btn_them_nv'])) {
    $tennv = $_POST['TenNV'];
    $ngaysinh = $_POST['NgaySinh'];
    $diachi = $_POST['DiaChi'];
    $gioitinh = $_POST['GioiTinh'];
    $sdt = $_POST['SDT'];
    $anh = $_FILES["Anh"]['name'];
    $quyen = $_POST['Quyen'];

    $sql_tennv = "SELECT * FROM nhanvien WHERE TenNV = '$tennv'";
    $rs_tennv = mysqli_query($connection, $sql_tennv);
    if (file_exists("img/nhan-vien/" . $_FILES["Anh"]["name"])) {
        $store = $_FILES["Anh"]["name"];
        $_SESSION['status'] = "Hình đã tồn tại. '.$store.'";
        header('location: them-nhan-vien.php');
    } else {
        if (!$tennv || !$ngaysinh || !$diachi || !$gioitinh || !$sdt || !$anh || !$quyen) {
            echo "Không thành công";
            $_SESSION['status'] = "Vui lòng không bỏ trống trường!";
            header('location: them-nhan-vien.php');
        } else {

            if (mysqli_num_rows($rs_tennv) > 0) {
                echo "Không thành công";
                $_SESSION['status'] = "Nhân Viên Đã Tồn Tại!";
                header('location: them-nhan-vien.php');
            } else {
                $query = "INSERT INTO nhanvien (`TenNV`, `NgaySinh`, `DiaChi`, `GioiTinh`, `SDT`, `Anh`, `Quyen`)
                        VALUES ('$tennv', '$ngaysinh', '$diachi', '$gioitinh', '$sdt', '$anh', '$quyen')";
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

//SỬA NHÂN VIÊN (ĐƯỢC)
if (isset($_POST['btn_capnhat_nv'])) {
    $manv = $_POST['sua_manv'];
    $tennv = $_POST['sua_tennv'];
    $ngaysinh = $_POST['sua_ngaysinh'];
    $gioitinh = $_POST['sua_gioitinh'];
    $diachi = $_POST['sua_diachi'];
    $sdt = $_POST['sua_dienthoai'];
    $anh = $_FILES["Anh"]['name'];
    $quyen = $_POST['sua_quyen'];
    if (file_exists("admin/img/nhan-vien/" . $_FILES["Anh"]["name"])) {
        $store = $_FILES["Anh"]["name"];
        $_SESSION['status'] = "Hình đã tồn tại. '.$store.'";
        header('location: sua-nhan-vien.php');
    } else {
        $query = "UPDATE nhanvien SET TenNV='$tennv', NgaySinh='$ngaysinh', GioiTinh='$gioitinh', DiaChi='$diachi', SDT='$sdt', Anh='$anh', Quyen='$quyen' WHERE MaNV='$manv'";
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

// XÓA NHÂN VIÊN (ĐƯỢC)
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


// * THÊM HƯỚNG DẪN VIÊN *// (ĐƯỢC)
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

//SỬA HƯỚNG DẪN VIÊN (ĐƯỢC)
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

// XÓA HƯỚNG DẪN VIÊN (ĐƯỢC)
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

//SỬA KHÁCH HÀNG (ĐƯỢC)
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

// XÓA KHÁCH HÀNG (ĐƯỢC)
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
