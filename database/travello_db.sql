-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 31, 2020 lúc 10:12 AM
-- Phiên bản máy phục vụ: 10.4.8-MariaDB
-- Phiên bản PHP: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `travello_db`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `dattour`
--

CREATE TABLE `dattour` (
  `MaDatTour` int(10) UNSIGNED NOT NULL,
  `HoTen` varchar(150) NOT NULL,
  `CMND` int(12) NOT NULL,
  `Email` varchar(150) DEFAULT NULL,
  `DienThoai` int(12) NOT NULL,
  `DIaChi` varchar(250) NOT NULL,
  `SoNguoiLon` int(2) NOT NULL,
  `SoTreEm` int(2) NOT NULL,
  `NgayDat` datetime NOT NULL,
  `ThongTinThanhToan` varchar(255) NOT NULL,
  `TongTien` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `dichvudikem`
--

CREATE TABLE `dichvudikem` (
  `MaDV` int(10) UNSIGNED NOT NULL,
  `TenDV` varchar(50) NOT NULL,
  `GiaDichVu` float NOT NULL,
  `GhiChu` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `gioithieu`
--

CREATE TABLE `gioithieu` (
  `MaGioiThieu` int(10) UNSIGNED NOT NULL,
  `Ten` varchar(250) NOT NULL,
  `MoTa` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `huongdanvien`
--

CREATE TABLE `huongdanvien` (
  `MaHDV` int(10) UNSIGNED NOT NULL,
  `TenHDV` varchar(50) NOT NULL,
  `NgaySinh` date NOT NULL,
  `DiaChi` varchar(250) NOT NULL,
  `GioiTinh` varchar(10) NOT NULL,
  `SDT` int(10) NOT NULL,
  `Anh` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khachhang`
--

CREATE TABLE `khachhang` (
  `MaKH` int(10) UNSIGNED NOT NULL,
  `TenKH` varchar(50) NOT NULL,
  `DiaChi` varchar(200) NOT NULL,
  `GioiTinh` varchar(10) NOT NULL,
  `SDT` int(12) NOT NULL,
  `Email` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khachsan`
--

CREATE TABLE `khachsan` (
  `MaKS` int(10) UNSIGNED NOT NULL,
  `HangSao` int(6) NOT NULL,
  `TenKS` varchar(150) NOT NULL,
  `DiaChi` varchar(250) NOT NULL,
  `DienThoai` int(12) NOT NULL,
  `SoPhong` int(100) NOT NULL,
  `WebSite` varchar(100) NOT NULL,
  `Anh` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loaiks`
--

CREATE TABLE `loaiks` (
  `MaLoaiKS` int(10) UNSIGNED NOT NULL,
  `TenLoaiPhong` varchar(50) NOT NULL,
  `Gia` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loaitourdulich`
--

CREATE TABLE `loaitourdulich` (
  `MaLoaiTour` int(10) UNSIGNED NOT NULL,
  `TenLoaiTour` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `manhinh`
--

CREATE TABLE `manhinh` (
  `MaMH` int(10) NOT NULL,
  `TenManHinh` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhahang`
--

CREATE TABLE `nhahang` (
  `MaNH` int(10) UNSIGNED NOT NULL,
  `TenNhaHang` varchar(150) NOT NULL,
  `DiaChi` varchar(250) NOT NULL,
  `Anh` varchar(150) NOT NULL,
  `SDT` int(10) NOT NULL,
  `GIoiThieuNH` text NOT NULL,
  `GiaNH` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhanvien`
--

CREATE TABLE `nhanvien` (
  `MaNV` int(10) UNSIGNED NOT NULL,
  `TenNV` varchar(50) NOT NULL,
  `NgaySinh` date NOT NULL,
  `DiaChi` varchar(150) NOT NULL,
  `SDT` int(12) NOT NULL,
  `Ảnh` varchar(200) NOT NULL,
  `Quyen` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhanxet`
--

CREATE TABLE `nhanxet` (
  `MaNX` int(10) UNSIGNED NOT NULL,
  `HoTen` varchar(50) NOT NULL,
  `Email` varchar(150) DEFAULT NULL,
  `SDT` int(12) NOT NULL,
  `NgaySinh` date NOT NULL,
  `NoiDung` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhomtk`
--

CREATE TABLE `nhomtk` (
  `MaNhom` int(10) UNSIGNED NOT NULL,
  `TenNhom` varchar(50) NOT NULL,
  `GhiChu` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phuongtien`
--

CREATE TABLE `phuongtien` (
  `MaPhuongTien` int(10) UNSIGNED NOT NULL,
  `PhuongTien` varchar(250) NOT NULL,
  `NoiDi` varchar(250) NOT NULL,
  `Gia` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `taikhoan`
--

CREATE TABLE `taikhoan` (
  `MaTK` int(10) UNSIGNED NOT NULL,
  `TenTK` varchar(50) NOT NULL,
  `MatKhau` varchar(60) NOT NULL,
  `CoQuyen` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tainguyendulich`
--

CREATE TABLE `tainguyendulich` (
  `MaTN` int(10) UNSIGNED NOT NULL,
  `TenTN` varchar(200) NOT NULL,
  `ChiTiet` text NOT NULL,
  `Anh` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thanhtoan`
--

CREATE TABLE `thanhtoan` (
  `MaTT` int(10) UNSIGNED NOT NULL,
  `TenThanhToan` varchar(150) NOT NULL,
  `NoiDung` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thanhvientour`
--

CREATE TABLE `thanhvientour` (
  `MaTV` int(10) UNSIGNED NOT NULL,
  `TenTV` varchar(150) NOT NULL,
  `DiaChi` varchar(250) NOT NULL,
  `CMND` int(12) NOT NULL,
  `SDT` int(12) NOT NULL,
  `GioiTinh` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `theloai`
--

CREATE TABLE `theloai` (
  `MaTheLoai` int(10) UNSIGNED NOT NULL,
  `TenTheLoai` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tintuc`
--

CREATE TABLE `tintuc` (
  `MaTinTuc` int(10) UNSIGNED NOT NULL,
  `TenTinTuc` varchar(150) NOT NULL,
  `MoTa` varchar(250) NOT NULL,
  `ChiTiet` text NOT NULL,
  `HinhAnh` varchar(150) NOT NULL,
  `Ngay` datetime NOT NULL,
  `TaoBoi` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tourdulich`
--

CREATE TABLE `tourdulich` (
  `MaTour` int(10) UNSIGNED NOT NULL,
  `TenTour` varchar(250) NOT NULL,
  `NoiKhoiHanh` varchar(250) NOT NULL,
  `NoiDen` varchar(250) NOT NULL,
  `ThoiGian` date NOT NULL,
  `GiaTien` float NOT NULL,
  `HanhTrinh` text NOT NULL,
  `SoNgay` int(3) NOT NULL,
  `Anh` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `dattour`
--
ALTER TABLE `dattour`
  ADD PRIMARY KEY (`MaDatTour`);

--
-- Chỉ mục cho bảng `dichvudikem`
--
ALTER TABLE `dichvudikem`
  ADD PRIMARY KEY (`MaDV`);

--
-- Chỉ mục cho bảng `gioithieu`
--
ALTER TABLE `gioithieu`
  ADD PRIMARY KEY (`MaGioiThieu`);

--
-- Chỉ mục cho bảng `huongdanvien`
--
ALTER TABLE `huongdanvien`
  ADD PRIMARY KEY (`MaHDV`);

--
-- Chỉ mục cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  ADD PRIMARY KEY (`MaKH`);

--
-- Chỉ mục cho bảng `khachsan`
--
ALTER TABLE `khachsan`
  ADD PRIMARY KEY (`MaKS`);

--
-- Chỉ mục cho bảng `loaiks`
--
ALTER TABLE `loaiks`
  ADD PRIMARY KEY (`MaLoaiKS`);

--
-- Chỉ mục cho bảng `loaitourdulich`
--
ALTER TABLE `loaitourdulich`
  ADD PRIMARY KEY (`MaLoaiTour`);

--
-- Chỉ mục cho bảng `nhahang`
--
ALTER TABLE `nhahang`
  ADD PRIMARY KEY (`MaNH`);

--
-- Chỉ mục cho bảng `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD PRIMARY KEY (`MaNV`);

--
-- Chỉ mục cho bảng `nhanxet`
--
ALTER TABLE `nhanxet`
  ADD PRIMARY KEY (`MaNX`);

--
-- Chỉ mục cho bảng `nhomtk`
--
ALTER TABLE `nhomtk`
  ADD PRIMARY KEY (`MaNhom`);

--
-- Chỉ mục cho bảng `phuongtien`
--
ALTER TABLE `phuongtien`
  ADD PRIMARY KEY (`MaPhuongTien`);

--
-- Chỉ mục cho bảng `taikhoan`
--
ALTER TABLE `taikhoan`
  ADD PRIMARY KEY (`MaTK`);

--
-- Chỉ mục cho bảng `tainguyendulich`
--
ALTER TABLE `tainguyendulich`
  ADD PRIMARY KEY (`MaTN`);

--
-- Chỉ mục cho bảng `thanhtoan`
--
ALTER TABLE `thanhtoan`
  ADD PRIMARY KEY (`MaTT`);

--
-- Chỉ mục cho bảng `thanhvientour`
--
ALTER TABLE `thanhvientour`
  ADD PRIMARY KEY (`MaTV`);

--
-- Chỉ mục cho bảng `theloai`
--
ALTER TABLE `theloai`
  ADD PRIMARY KEY (`MaTheLoai`);

--
-- Chỉ mục cho bảng `tintuc`
--
ALTER TABLE `tintuc`
  ADD PRIMARY KEY (`MaTinTuc`);

--
-- Chỉ mục cho bảng `tourdulich`
--
ALTER TABLE `tourdulich`
  ADD PRIMARY KEY (`MaTour`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `dattour`
--
ALTER TABLE `dattour`
  MODIFY `MaDatTour` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `dichvudikem`
--
ALTER TABLE `dichvudikem`
  MODIFY `MaDV` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `gioithieu`
--
ALTER TABLE `gioithieu`
  MODIFY `MaGioiThieu` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `huongdanvien`
--
ALTER TABLE `huongdanvien`
  MODIFY `MaHDV` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  MODIFY `MaKH` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `khachsan`
--
ALTER TABLE `khachsan`
  MODIFY `MaKS` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `loaiks`
--
ALTER TABLE `loaiks`
  MODIFY `MaLoaiKS` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `loaitourdulich`
--
ALTER TABLE `loaitourdulich`
  MODIFY `MaLoaiTour` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `nhahang`
--
ALTER TABLE `nhahang`
  MODIFY `MaNH` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `nhanvien`
--
ALTER TABLE `nhanvien`
  MODIFY `MaNV` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `nhanxet`
--
ALTER TABLE `nhanxet`
  MODIFY `MaNX` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `nhomtk`
--
ALTER TABLE `nhomtk`
  MODIFY `MaNhom` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `phuongtien`
--
ALTER TABLE `phuongtien`
  MODIFY `MaPhuongTien` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `taikhoan`
--
ALTER TABLE `taikhoan`
  MODIFY `MaTK` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tainguyendulich`
--
ALTER TABLE `tainguyendulich`
  MODIFY `MaTN` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `thanhtoan`
--
ALTER TABLE `thanhtoan`
  MODIFY `MaTT` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `thanhvientour`
--
ALTER TABLE `thanhvientour`
  MODIFY `MaTV` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `theloai`
--
ALTER TABLE `theloai`
  MODIFY `MaTheLoai` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tintuc`
--
ALTER TABLE `tintuc`
  MODIFY `MaTinTuc` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tourdulich`
--
ALTER TABLE `tourdulich`
  MODIFY `MaTour` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
