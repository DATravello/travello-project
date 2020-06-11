<?php
include("db_config.php");


// * THÊM NHÀ HÀNG *//  (ĐƯỢC)
if (isset($_POST['btn_them_nh'])) {
    $tennhahang = $_POST['TenNhaHang'];
    $diachi = $_POST['DiaChi'];
    $sdt = $_POST['SDT'];
    $anh = $_FILES["Anh"]['name'];
    $gioithieu = $_POST['GioiThieuNH'];
    $gianh = $_POST['GiaNH'];

    $sql_tennh = "SELECT * FROM nhahang WHERE TenNhaHang = '$tennhahang'";
    $rstennh = mysqli_query($connection, $sql_tennh);

    if (file_exists("img/nha-hang/" . $_FILES["Anh"]["name"])) {
        $store = $_FILES["Anh"]["name"];
        $_SESSION['status'] = "Hình đã tồn tại. '.$store.'";
        header('location: them-nha-hang.php');
    }
    else
    {
        if (!$anh || !$tennhahang || !$diachi || !$sdt || !$gioithieu || !$gianh) {
            echo "Không thành công!";
            $_SESSION['status'] = "Vui lòng không bỏ trống trường!";
            header('location: them-nha-hang.php');
        } else {

            if (mysqli_num_rows($rstennh) > 0) {
                echo "Không thành công";
                $_SESSION['status'] = "Nhà Hàng Đã Tồn Tại!";
                header('location: them-nha-hang.php');
            } else {
                $query = "INSERT INTO nhahang (`TenNhaHang`,`DiaChi`,`Anh`,`SDT`,`GioiThieuNH`,`GiaNH`) VALUES ('$tennhahang','$diachi','$anh','$sdt','$gioithieu','$gianh')";
                $query_run = mysqli_query($connection, $query);

                if ($query_run) {
                    move_uploaded_file($_FILES["Anh"]["tmp_name"], "img/nha-hang/".$_FILES["Anh"]["name"]);
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
    $manh = $_POST['sua_mnh'];
    $tennh = $_POST['sua_tennh'];
    $diachi = $_POST['sua_diachinh'];
    $anh = $_POST['sua_anhnh'];
    $sdt = $_POST['sua_sdtnh'];
    $gth = $_POST['sua_gtnh'];
    $gia = $_POST['sua_gianh'];

    $query = "UPDATE nhahang SET TenNhaHang='$tennh', DiaChi='$diachi', Anh='$anh', SDT='$sdt', GioiThieuNH='$gth', GiaNH='$gia' WHERE MaNH='$manh'";
    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        $_SESSION['success'] = "Cập Nhật Thành Công!";
        header('location: danh-sach-nha-hang.php');
    } else {
        $_SESSION['status'] = "Cập Nhật Thất Bại!";
        header('location: sua-nha-hang.php');
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




// * THÊM TOUR DU LỊCH *// (ĐƯỢC)
if (isset($_POST['btn_them_tour'])) {
    $tentour = $_POST['TenTour'];
    $noikhoihanh = $_POST['NoiKhoiHanh'];
    $noiden = $_POST['NoiDen'];
    $thoigian = $_POST['ThoiGian'];
    $giatien = $_POST['GiaTien'];
    $hanhtrinh = $_POST['HanhTrinh'];
    $songay = $_POST['SoNgay'];
    $anhtour = $_POST['Anh'];

    $sql_tentour = "SELECT * FROM tourdulich WHERE TenTour = '$tentour'";
    $rstentour = mysqli_query($connection, $sql_tentour);
    if (!$tentour || !$noikhoihanh || !$noiden || !$thoigian || !$giatien || !$hanhtrinh || !$songay || !$anhtour) {
        echo "Không thành công!";
        $_SESSION['status'] = "Vui lòng không bỏ trống trường!";
        header('location: them-tour-du-lich.php');
    } else {
        if (mysqli_num_rows($rstentour) > 0) {
            echo "Không thành công";
            $_SESSION['status'] = "Tour Đã Tồn Tại!";
            header('location: them-tour-du-lich.php');
        } else {
            $query = "INSERT INTO tourdulich (`TenTour`,`NoiKhoiHanh`,`NoiDen`,`ThoiGian`,`GiaTien`,`HanhTrinh`,`SoNgay`,`Anh`) VALUES ('$tentour','$noikhoihanh','$noiden','$thoigian','$giatien','$hanhtrinh', '$songay' ,'$anhtour')";
            $query_run = mysqli_query($connection, $query);
            if ($query_run) {
                $_SESSION['success'] = "Thêm Thành Công!";
                header('location: danh-sach-tour-du-lich.php');
            } else {
                $_SESSION['status'] = "Thêm Thất Bại!";
                header('location: them-tour-du-lich.php');
            }
        }
    }
}


//* SỬA TOUR DU LỊCH *// (ĐƯỢC)
if (isset($_POST['btn_capnhat_tour'])) {
    $matour = $_POST['sua_matour'];
    $tentour = $_POST['sua_tentour'];
    $noikhoihanh = $_POST['sua_noikhoihanh'];
    $noiden = $_POST['sua_noiden'];
    $thoigian = $_POST['sua_thoigian'];
    $giatien = $_POST['sua_giatien'];
    $hanhtrinh = $_POST['sua_hanhtrinh'];
    $songay = $_POST['sua_songay'];
    $anhtour = $_POST['sua_anh'];

    $query = "UPDATE tourdulich SET TenTour='$tentour', NoiKhoiHanh='$noikhoihanh', NoiDen='$noiden', ThoiGian='$thoigian', GiaTien='$giatien', HanhTrinh='$hanhtrinh', SoNgay='$songay', Anh='$anhtour' WHERE MaTour='$matour'";
    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        $_SESSION['success'] = "Update Successed!";
        header('location: danh-sach-tour-du-lich.php');
    } else {
        $_SESSION['status'] = "Update Failed!";
        header('location: sua-tour-du-lich.php');
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
    // $anh = $_FILES["images"]['Anh'];
    $tenloaiphong = $_POST['TenLoaiPhong'];
    $gialoaiphong = $_POST['Gia'];


    $sql_tenloaiphong = "SELECT * FROM loaiks WHERE TenLoaiPhong = '$tenloaiphong'";
    $rstenloaiphong = mysqli_query($connection, $sql_tenloaiphong);

    if (!$tenloaiphong || !$gialoaiphong) {
        echo "Không thành công!";
        $_SESSION['status'] = "Vui lòng không bỏ trống trường!";
        header('location: them-loai-khach-san.php');
    } else {
        if (mysqli_num_rows($rstenloaiphong) > 0) {
            echo "Không thành công";
            $_SESSION['status'] = "Loại Phòng Đã Tồn Tại!";
            header('location: them-loai-khach-san.php');
        } else {
            $query = "INSERT INTO loaiks (`TenLoaiPhong`,`Gia`) VALUES ('$tenloaiphong','$gialoaiphong')";
            $query_run = mysqli_query($connection, $query);

            if ($query_run) {
                // move_uploaded_file($_FILES["images"]["tmp_name"], "img/nha-hang/".$_FILES["images"]["Anh"]);
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
    $tenloaiphong = $_POST['sua_tenloai'];
    $gia = $_POST['sua_gia'];

    $query = "UPDATE loaiks SET TenLoaiPhong='$tenloaiphong', Gia='$gia' WHERE MaLoaiKS='$maloai'";
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

    $query = " DELETE FROM loaiks WHERE MaLoaiKS ='$malks' ";
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


// * THÊM KhÁCH SẠN *// (ĐƯỢC)
if (isset($_POST['btn_them_khach_san'])) {
    $tenkhachsan = $_POST['TenKS'];
    $hangsao = $_POST['HangSao'];
    $diachi = $_POST['DiaChi'];
    $dienthoai = $_POST['DienThoai'];
    $sophong = $_POST['SoPhong'];
    $website = $_POST['WebSite'];
    $anhks = $_POST['Anh'];

    $sql_tenkhachsan = "SELECT * FROM khachsan WHERE TenKS = '$tenkhachsan'";
    $rstenks = mysqli_query($connection, $sql_tenkhachsan);

    if (!$tenkhachsan || !$hangsao || !$diachi || !$dienthoai || !$sophong || !$website || !$anhks) {
        echo "Không thành công!";
        $_SESSION['status'] = "Vui lòng không bỏ trống trường!";
        header('location: them-khach-san.php');
    } else {
        if (mysqli_num_rows($rstenks) > 0) {
            echo "Không thành công";
            $_SESSION['status'] = "Khách Sạn Đã Tồn Tại!";
            header('location: them-khach-san.php');
        } else {
            $query = "INSERT INTO khachsan (`TenKS`,`HangSao`,`DiaChi`,`DienThoai`,`SoPhong`,`WebSite`,`Anh`) VALUES ('$tenkhachsan','$hangsao','$diachi','$dienthoai','$sophong','$website','$anhks')";
            $query_run = mysqli_query($connection, $query);
            if ($query_run) {
                $_SESSION['success'] = "Thêm Thành Công!";
                header('location: danh-sach-khach-san.php');
            } else {
                $_SESSION['status'] = "Thêm Thất Bại!";
                header('location: them-khach-san.php');
            }
        }
    }
}



//SỬA KHÁCH SẠN (ĐƯỢC)
if (isset($_POST['btn_capnhat_ks'])) {
    $maks = $_POST['sua_maks'];
    $tenks = $_POST['sua_tenks'];
    $hangsao = $_POST['sua_hangsao'];
    $diachiks = $_POST['sua_diachiks'];
    $dtks = $_POST['sua_sdtks'];
    $sophong = $_POST['sua_sophong'];
    $website = $_POST['sua_web'];
    $anhks = $_POST['sua_anhks'];

    $query = "UPDATE khachsan SET TenKS='$tenks', HangSao='$hangsao', DiaChi='$diachiks', DienThoai='$dtks', SoPhong='$sophong', WebSite='$website', Anh='$anhks' WHERE MaKS='$maks'";
    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        $_SESSION['success'] = "Update Successed!";
        header('location: danh-sach-khach-san.php');
    } else {
        $_SESSION['status'] = "Update Failed!";
        header('location: sua-khach-san.php');
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
    // $anh = $_FILES["images"]['Anh'];
    $tentintuc = $_POST['TenTinTuc'];
    $mota = $_POST['MoTa'];
    $chitiet = $_POST['ChiTiet'];
    $hinhanh = $_POST['HinhAnh'];
    $ngay = $_POST['Ngay'];
    $taoboi = $_POST['TaoBoi'];

    $sql_tentintuc = "SELECT * FROM tintuc WHERE TenTinTuc = '$tentintuc'";
    $rstentintuc = mysqli_query($connection, $sql_tentintuc);
    if (!$tentintuc || !$mota || !$chitiet || !$hinhanh || !$ngay || !$taoboi) {
        echo "Không thành công!";
        $_SESSION['status'] = "Vui lòng không bỏ trống trường!";
        header('location: them-tin-tuc.php');
    } else {
        if (mysqli_num_rows($rstentintuc) > 0) {
            echo "Không thành công";
            $_SESSION['status'] = "Khách Sạn Đã Tồn Tại!";
            header('location: them-tin-tuc.php');
        } else {
            $query = "INSERT INTO tintuc (`TenTinTuc`,`MoTa`,`ChiTiet`,`HinhAnh`,`Ngay`,`TaoBoi`) VALUES ('$tentintuc','$mota','$chitiet','$hinhanh','$ngay','$taoboi')";
            $query_run = mysqli_query($connection, $query);
            if ($query_run) {
                $_SESSION['success'] = "Thêm Thành Công!";
                header('location: danh-sach-tin-tuc.php');
            } else {
                $_SESSION['status'] = "Thêm Thất Bại!";
                header('location: them-tin-tuc.php');
            }
        }
    }
}


//SỬA TIN TỨC (ĐƯỢC)
if (isset($_POST['btn_capnhat_tt'])) {
    $matt = $_POST['sua_matt'];
    $tentt = $_POST['sua_tentt'];
    $mota = $_POST['sua_mota'];
    $chitiet = $_POST['sua_chitiet'];
    $hinhanhtt = $_POST['sua_hinhanh'];
    $ngay = $_POST['sua_ngay'];
    $taoboi = $_POST['sua_tacgia'];

    $query = "UPDATE tintuc SET TenTinTuc ='$tentt', MoTa ='$mota', ChiTiet ='$chitiet', HinhAnh ='$hinhanhtt', Ngay='$ngay', TaoBoi='$taoboi' WHERE MaTinTuc='$matt'";
    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        $_SESSION['success'] = "Update Successed!";
        header('location: danh-sach-tin-tuc.php');
    } else {
        $_SESSION['status'] = "Update Failed!";
        header('location: sua-tin-tuc.php');
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
    $anh = $_POST['Anh'];
    $quyen = $_POST['Quyen'];

    $sql_tennv = "SELECT * FROM nhanvien WHERE TenNV = '$tennv'";
    $rs_tennv = mysqli_query($connection, $sql_tennv);


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
                echo "Thành Công";
                $_SESSION['success'] = "Thêm Nhân Viên Thành Công!";
                header('location: danh-sach-nhan-vien.php');
            } else {
                echo "Không Thành Công";
                $_SESSION['status'] = "Thêm Nhân Viên Thất Bại!";
                header('location: them-nhan-vien.php');
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
    $anh = $_POST['sua_anh'];
    $quyen = $_POST['sua_quyen'];

    $query = "UPDATE nhanvien SET TenNV='$tennv', NgaySinh='$ngaysinh', GioiTinh='$gioitinh', DiaChi='$diachi', SDT='$sdt', Anh='$anh', Quyen='$quyen' WHERE MaNV='$manv'";
    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        $_SESSION['success'] = "Update Successed!";
        header('location: danh-sach-nhan-vien.php');
    } else {
        $_SESSION['status'] = "Update Failed!";
        header('location: sua-nhan-vien.php');
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
    $anh = $_POST['Anh'];
    $gioitinh = $_POST['GioiTinh'];
    $sdt = $_POST['SDT'];

    $sql_tenhdv = "SELECT * FROM huongdanvien WHERE TenHDV = '$tenhdv'";
    $rstenhdv = mysqli_query($connection, $sql_tenhdv);

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
                $_SESSION['success'] = "Thêm Thành Công!";
                header('location: danh-sach-huong-dan-vien.php');
            } else {
                $_SESSION['status'] = "Thêm Thất Bại!";
                header('location: them-huong-dan-vien.php');
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
    $anh = $_POST['sua_anh'];

    $query = "UPDATE huongdanvien SET TenHDV='$tenhdv', NgaySinh='$ngaysinh', DiaChi='$diachi', GioiTinh='$gioitinh', SDT='$sdt', Anh='$anh' WHERE MaHDV='$mahdv'";
    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        $_SESSION['success'] = "Update Successed!";
        header('location: danh-sach-huong-dan-vien.php');
    } else {
        $_SESSION['status'] = "Update Failed!";
        header('location: sua-huong-dan-vien.php');
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
