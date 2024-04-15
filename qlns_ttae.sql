-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 11, 2024 at 01:31 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `qlns_ttae`
--

-- --------------------------------------------------------

--
-- Table structure for table `bangcap`
--

CREATE TABLE `bangcap` (
  `id` int(11) NOT NULL,
  `mabangcap` varchar(50) NOT NULL,
  `tenbangcap` varchar(255) NOT NULL,
  `ghichu` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `bangcap`
--

INSERT INTO `bangcap` (`id`, `mabangcap`, `tenbangcap`, `ghichu`) VALUES
(1, 'MBC001', 'Bằng cử nhân', ''),
(2, 'MBC002', 'Bằng thạc sĩ', ''),
(3, 'MBC003', 'Bằng tiến sĩ', '');

-- --------------------------------------------------------

--
-- Table structure for table `chitiet_nhom`
--

CREATE TABLE `chitiet_nhom` (
  `id` int(11) NOT NULL,
  `manhom` varchar(50) NOT NULL,
  `nhanvien_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chucvu`
--

CREATE TABLE `chucvu` (
  `id` int(11) NOT NULL,
  `machucvu` varchar(50) NOT NULL,
  `tenchucvu` varchar(255) NOT NULL,
  `luongngay` float NOT NULL,
  `ghichu` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `chucvu`
--

INSERT INTO `chucvu` (`id`, `machucvu`, `tenchucvu`, `luongngay`, `ghichu`) VALUES
(1, 'MCV001', 'Giám đốc', 1000000, ''),
(2, 'MCV002', 'Phó giám đốc', 800000, ''),
(3, 'MCV003', 'Quản lý', 400000, ''),
(4, 'MCV004', 'Marketing', 300000, ''),
(5, 'MCV005', 'Tiếp tân', 200000, ''),
(6, 'MCV006', 'Kỹ thuật', 250000, ''),
(7, 'MCV007', 'Giáo viên', 300000, ''),
(8, 'MCV008', 'Kế Toán', 250000, '');

-- --------------------------------------------------------

--
-- Table structure for table `chuyenmon`
--

CREATE TABLE `chuyenmon` (
  `id` int(11) NOT NULL,
  `machuyenmon` varchar(50) NOT NULL,
  `tenchuyenmon` varchar(255) NOT NULL,
  `ghichu` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `chuyenmon`
--

INSERT INTO `chuyenmon` (`id`, `machuyenmon`, `tenchuyenmon`, `ghichu`) VALUES
(1, 'MCM001', 'Không', ''),
(2, 'MCM002', 'Marketing', ''),
(3, 'MCM003', 'Công nghệ thông tin', ''),
(4, 'MCM004', 'Ngôn ngữ Anh', '');

-- --------------------------------------------------------

--
-- Table structure for table `congtac`
--

CREATE TABLE `congtac` (
  `id` int(11) NOT NULL,
  `macongtac` varchar(50) NOT NULL,
  `nhanvien_id` int(11) NOT NULL,
  `ngaybd` date NOT NULL,
  `ngaykt` date NOT NULL,
  `diadiem` varchar(255) NOT NULL,
  `nhiemvu_congtac` varchar(255) NOT NULL,
  `ghichu` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `congtac`
--

INSERT INTO `congtac` (`id`, `macongtac`, `nhanvien_id`, `ngaybd`, `ngaykt`, `diadiem`, `nhiemvu_congtac`, `ghichu`) VALUES
(1, 'MCT001', 15, '2024-04-10', '2024-04-10', 'Cần Thơ', '<p>Chuyển c&ocirc;ng việc l&agrave;m</p>\r\n', ''),
(3, 'MCT002', 8, '2024-04-09', '2024-04-10', 'Hồ Chí Minh', '<p>Tư vấn cho học sinh tiểu học&nbsp;</p>\r\n', '');

-- --------------------------------------------------------

--
-- Table structure for table `dantoc`
--

CREATE TABLE `dantoc` (
  `id` int(11) NOT NULL,
  `tendantoc` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `dantoc`
--

INSERT INTO `dantoc` (`id`, `tendantoc`) VALUES
(1, 'Không'),
(2, 'Kinh'),
(3, 'Khơ-me');

-- --------------------------------------------------------

--
-- Table structure for table `lichlamviec`
--

CREATE TABLE `lichlamviec` (
  `id` int(31) NOT NULL,
  `tieude` text NOT NULL,
  `mota` text NOT NULL,
  `nhanvien_id` int(11) NOT NULL,
  `ngaybatdau` datetime NOT NULL,
  `ngayketthuc` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `loai_nv`
--

CREATE TABLE `loai_nv` (
  `id` int(11) NOT NULL,
  `maloainv` varchar(50) NOT NULL,
  `tenloainv` varchar(255) NOT NULL,
  `ghichu` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `loai_nv`
--

INSERT INTO `loai_nv` (`id`, `maloainv`, `tenloainv`, `ghichu`) VALUES
(1, 'LNV001', 'Nhân viên chính thức', ''),
(2, 'LNV002', 'Nhân viên thời vụ', ''),
(3, 'LNV003', 'Thực tập sinh', '');

-- --------------------------------------------------------

--
-- Table structure for table `luong`
--

CREATE TABLE `luong` (
  `id` int(11) NOT NULL,
  `maluong` varchar(255) NOT NULL,
  `nhanvien_id` int(11) NOT NULL,
  `luongthang` double DEFAULT NULL,
  `ngaycong` int(11) NOT NULL,
  `phucap` double NOT NULL,
  `khoannop` double DEFAULT NULL,
  `tamung` double NOT NULL,
  `thuclanh` double DEFAULT NULL,
  `ngaychamcong` date NOT NULL,
  `ghichu` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `luong`
--

INSERT INTO `luong` (`id`, `maluong`, `nhanvien_id`, `luongthang`, `ngaycong`, `phucap`, `khoannop`, `tamung`, `thuclanh`, `ngaychamcong`, `ghichu`) VALUES
(1, 'MLAE001', 1, 30000000, 30, 0, 0, 0, 30000000, '2024-04-30', ''),
(2, 'MLAE002', 2, 24000000, 30, 0, 0, 0, 24000000, '2024-03-31', ''),
(3, 'MLAE003', 2, 24000000, 30, 0, 0, 4000000, 20000000, '2024-04-30', ''),
(5, 'MLAE010', 15, 24000000, 20, 0, 0, 0, 24000000, '2024-04-11', '');

-- --------------------------------------------------------

--
-- Table structure for table `nhanvien`
--

CREATE TABLE `nhanvien` (
  `id` int(11) NOT NULL,
  `manv` varchar(255) NOT NULL,
  `hotennv` varchar(255) NOT NULL,
  `hinhanh` varchar(255) NOT NULL,
  `sdt` varchar(50) NOT NULL,
  `gioitinh` tinyint(4) NOT NULL,
  `ngaysinh` date NOT NULL,
  `noisinh` varchar(255) NOT NULL,
  `cccd` varchar(50) NOT NULL,
  `noicap_cccd` varchar(255) NOT NULL,
  `ngaycap_cccd` date NOT NULL,
  `quequan` varchar(255) NOT NULL,
  `quoctich_id` int(11) NOT NULL,
  `tongiao_id` int(11) NOT NULL,
  `dantoc_id` int(11) NOT NULL,
  `tamtru` varchar(255) NOT NULL,
  `loai_nv_id` int(11) NOT NULL,
  `trinhdo_id` int(11) NOT NULL,
  `chuyenmon_id` int(11) NOT NULL,
  `bangcap_id` int(11) NOT NULL,
  `chucvu_id` int(11) NOT NULL,
  `trangthai` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `nhanvien`
--

INSERT INTO `nhanvien` (`id`, `manv`, `hotennv`, `hinhanh`, `sdt`, `gioitinh`, `ngaysinh`, `noisinh`, `cccd`, `noicap_cccd`, `ngaycap_cccd`, `quequan`, `quoctich_id`, `tongiao_id`, `dantoc_id`, `tamtru`, `loai_nv_id`, `trinhdo_id`, `chuyenmon_id`, `bangcap_id`, `chucvu_id`, `trangthai`) VALUES
(1, 'MNVAE001', 'Trần Nguyên Vũ', 'TranNguyenVu_AE.jpg', '0986427664', 1, '1987-07-17', 'An Giang ', '089486223423', 'Cục Cảnh Sát An Giang', '2020-07-16', 'Ấp Vĩnh Trung, xã Vĩnh Trạch, huyện Thoại Sơn, tỉnh An Giang', 1, 3, 2, 'Long Xuyên', 1, 4, 4, 2, 1, 1),
(2, 'MNVAE002', 'Cao Hồng Hoa', 'CaoHongHoa_AE.jpg', '0345021129', 0, '1991-08-23', 'An Giang ', '089487782231', 'Cục Cảnh Sát An Giang', '2022-07-14', 'Ấp Vĩnh Trung, xã Vĩnh Trạch, huyện Thoại Sơn, tỉnh An Giang.', 1, 1, 2, 'Long Xuyên', 1, 4, 4, 2, 2, 1),
(3, 'MNVAE003', 'Nguyễn Thị Bé Quyên', 'NguyenThiQuyen_AE.jpg', '0984027501', 0, '1997-07-11', 'Hồ Chí Minh', '089028561024', 'Cục Cảnh Sát An Giang', '2021-12-24', 'Phường 11, Quận 3, Thành phố Hồ Chí Minh', 1, 2, 2, 'Long Xuyên', 1, 2, 2, 1, 3, 1),
(4, 'MNVAE004', 'Nguyễn Anh Đào', 'NguyenAnhDao_AE.jpg', '0980924583', 0, '1999-07-10', 'An Giang ', '080465926481', 'Cục Cảnh Sát An Giang', '2021-08-14', 'Ấp Vĩnh Mỹ, xã Châu Đốc, tỉnh An Giang', 1, 3, 2, 'Long Xuyên', 1, 2, 4, 1, 3, 1),
(5, 'MNVAE005', 'Lê Quốc Toàn', 'LeQuocToan_AE.jpg', '984234125', 1, '2002-04-27', 'An Giang', '890874634', 'Cục Cảnh Sát An Giang', '2021-03-24', 'Xã Cần Đăng, huyện Châu Thành, tỉnh An Giang', 1, 1, 1, 'Long Xuyên', 3, 1, 1, 1, 6, 1),
(6, 'MNVAE007', 'Lê Minh Thông', 'LeMinhThong_AE.jpg', '894929442', 1, '2002-05-28', 'An Giang', '892674672', 'Cục Cảnh Sát An Giang', '2021-03-24', 'Xã Vĩnh Hanh, huyện Châu Thành, tỉnh An Giang', 1, 1, 1, 'Long Xuyên', 3, 1, 1, 1, 6, 1),
(7, 'MNVAE016', 'Cao Mỹ Trân', 'CaoMyTran_AE.jpg', '09641891542', 0, '2000-04-19', 'An Giang ', '089877798924', 'Cục Cảnh Sát An Giang', '2022-02-26', 'Xã Phú Mỹ, huyện Khánh Hòa, tỉnh An Giang', 1, 2, 2, 'Long Xuyên', 1, 2, 4, 1, 5, 1),
(8, 'MNVAE008', 'Nguyễn Thanh Tú', 'NguyenThanhTu_AE.jpg', '894924412', 1, '2002-11-09', 'Cần Thơ', '896462371', 'Cục Cảnh Sát Cần Thơ', '2022-12-14', 'Xã Phước Thới, huyện Ô Môn, tỉnh Cần Thơ ', 1, 1, 1, 'Long Xuyên', 3, 1, 4, 1, 6, 1),
(9, 'MNVAE009', 'Nguyễn Hoài Thanh', 'NguyenHoaiThanh_AE.jpg', '0987428240', 1, '2002-04-05', 'An Giang ', '089674420923', 'Cục Cảnh Sát An Giang', '2022-07-10', 'Xã Thuận An, huyện Thốt Nốt, tỉnh Cần Thơ', 1, 2, 2, 'Long Xuyên', 3, 2, 3, 1, 6, 1),
(10, 'MNVAE010', 'Nguyễn Leon', 'NguyenLeon_AE.jpg', '0994610591', 1, '1992-06-10', 'Mỹ', '089890140410', 'Cục Cảnh Sát Hồ Chí Minh', '2022-12-22', '2801 S TONGASS HWY KETCHIKAN AK 99901-9514 USA', 2, 1, 1, 'Long Xuyên', 1, 4, 4, 2, 7, 1),
(11, 'MNVAE011', 'Mary Gimo', 'Mary Gimo_AE.jpg', '0985546863', 0, '1964-03-12', 'Mỹ', '972-02-9475', 'Cục Cảnh Sát American', '2015-07-09', '98 Main Street, Anytown, USA', 2, 1, 1, 'Hồ Chí Minh', 2, 5, 4, 3, 7, 1),
(12, 'MNVAE012', ' Smith Aliane', 'Smith Aliane_AE.jpg', '098267142', 0, '2000-06-24', 'Mỹ', '987-65-4321', 'Cục Cảnh Sát American', '2011-06-17', '456 Oak Avenue, Springfield, USA', 2, 2, 1, 'Cân Thơ', 2, 2, 4, 1, 7, 1),
(13, 'MNVAE013', ' Simon Johnson', 'Simon Johnson_AE.jpg', '0846726424', 1, '1997-05-31', 'Canada', '555-12-3456', 'Cục Cảnh Sát Canada', '2016-06-25', '123 Maple Avenue, Toronto, Ontario, Canada', 3, 2, 1, 'Hồ Chí Minh', 2, 2, 4, 1, 7, 1),
(14, 'MNVAE014', 'Nguyễn Thị Bé Gái', 'NguyenThiBeGai_AE.jpg', '0983018419', 0, '2001-02-08', 'An Giang ', '089097492841', 'Cục Cảnh Sát An Giang', '2022-06-24', 'Xã Phú Mỹ, huyện Châu Thành, tỉnh An Giang', 1, 3, 2, 'Long Xuyên', 1, 2, 4, 1, 5, 1),
(15, 'MNVAE015', 'Trần Thị Duyên', 'TranThiDuyen_AE.jpg', '0986451244', 0, '1994-04-18', 'Cần Thơ', '0804608817281', 'Cục Cảnh Sát Cần Thơ', '2021-03-27', 'Xã An Hoà, huyện Ninh Kiều, tỉnh Cần Thơ', 1, 2, 2, 'Long Xuyên', 1, 4, 1, 2, 8, 1);

-- --------------------------------------------------------

--
-- Table structure for table `nhom`
--

CREATE TABLE `nhom` (
  `id` int(11) NOT NULL,
  `manhom` varchar(50) NOT NULL,
  `tennhom` varchar(255) NOT NULL,
  `mota` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quoctich`
--

CREATE TABLE `quoctich` (
  `id` int(11) NOT NULL,
  `tenquoctich` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `quoctich`
--

INSERT INTO `quoctich` (`id`, `tenquoctich`) VALUES
(1, 'Việt Nam'),
(2, 'Mỹ'),
(3, 'Canada'),
(4, 'Anh'),
(5, 'Đức<br><br>');

-- --------------------------------------------------------

--
-- Table structure for table `taikhoan`
--

CREATE TABLE `taikhoan` (
  `id` int(11) NOT NULL,
  `ho` varchar(50) NOT NULL,
  `ten` varchar(50) NOT NULL,
  `hinhanh` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `matkhau` varchar(50) NOT NULL,
  `sdt` varchar(50) NOT NULL,
  `quyen` tinyint(4) NOT NULL,
  `trangthai` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `taikhoan`
--

INSERT INTO `taikhoan` (`id`, `ho`, `ten`, `hinhanh`, `email`, `matkhau`, `sdt`, `quyen`, `trangthai`) VALUES
(1, 'Trung tâm ngoại ngữ ', 'American English', 'LogoAE1.jpg', 'ttnn@americanenglish.edu.vn', '25d55ad283aa400af464c76d713c07ad', '0587279742', 1, 1),
(2, 'Lê Quốc ', 'Toàn', 'LeQuocToan_AE.jpg', 'lqtoan_ae@americanenglish.edu.vn', '25d55ad283aa400af464c76d713c07ad', '0587279754', 3, 0),
(3, 'Lê Minh', 'Thông', 'LeMinhThong_AE.jpg', 'lmthong_ae@americanenglish.edu.vn', '25d55ad283aa400af464c76d713c07ad', '0874862738', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tongiao`
--

CREATE TABLE `tongiao` (
  `id` int(11) NOT NULL,
  `tentongiao` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `tongiao`
--

INSERT INTO `tongiao` (`id`, `tentongiao`) VALUES
(1, 'Không'),
(2, 'Thiên Chúa Giáo'),
(3, 'Phật Giáo');

-- --------------------------------------------------------

--
-- Table structure for table `trinhdo`
--

CREATE TABLE `trinhdo` (
  `id` int(11) NOT NULL,
  `matrinhdo` varchar(50) NOT NULL,
  `tentrinhdo` varchar(255) NOT NULL,
  `ghichu` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `trinhdo`
--

INSERT INTO `trinhdo` (`id`, `matrinhdo`, `tentrinhdo`, `ghichu`) VALUES
(1, 'MTD001', 'Không', ''),
(2, 'MTD002', 'Đại học', ''),
(3, 'MTD003', 'Cao Đẳng', ''),
(4, 'MTD004', 'Thạc sĩ', ''),
(5, 'MTD005', 'Tiến sĩ', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bangcap`
--
ALTER TABLE `bangcap`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chitiet_nhom`
--
ALTER TABLE `chitiet_nhom`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chucvu`
--
ALTER TABLE `chucvu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chuyenmon`
--
ALTER TABLE `chuyenmon`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `congtac`
--
ALTER TABLE `congtac`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nhanvien_id` (`nhanvien_id`);

--
-- Indexes for table `dantoc`
--
ALTER TABLE `dantoc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lichlamviec`
--
ALTER TABLE `lichlamviec`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nhanvien_id` (`nhanvien_id`);

--
-- Indexes for table `loai_nv`
--
ALTER TABLE `loai_nv`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `luong`
--
ALTER TABLE `luong`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nhanvien_id` (`nhanvien_id`);

--
-- Indexes for table `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quoctich_id` (`quoctich_id`),
  ADD KEY `tongiao_id` (`tongiao_id`),
  ADD KEY `dantoc_id` (`dantoc_id`),
  ADD KEY `loai_nv_id` (`loai_nv_id`),
  ADD KEY `trinhdo_id` (`trinhdo_id`),
  ADD KEY `chuyenmon_id` (`chuyenmon_id`),
  ADD KEY `bangcap_id` (`bangcap_id`),
  ADD KEY `chucvu_id` (`chucvu_id`);

--
-- Indexes for table `nhom`
--
ALTER TABLE `nhom`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quoctich`
--
ALTER TABLE `quoctich`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `taikhoan`
--
ALTER TABLE `taikhoan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tongiao`
--
ALTER TABLE `tongiao`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trinhdo`
--
ALTER TABLE `trinhdo`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bangcap`
--
ALTER TABLE `bangcap`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `chitiet_nhom`
--
ALTER TABLE `chitiet_nhom`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chucvu`
--
ALTER TABLE `chucvu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `chuyenmon`
--
ALTER TABLE `chuyenmon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `congtac`
--
ALTER TABLE `congtac`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `dantoc`
--
ALTER TABLE `dantoc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `lichlamviec`
--
ALTER TABLE `lichlamviec`
  MODIFY `id` int(31) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `loai_nv`
--
ALTER TABLE `loai_nv`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `luong`
--
ALTER TABLE `luong`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `nhanvien`
--
ALTER TABLE `nhanvien`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `nhom`
--
ALTER TABLE `nhom`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quoctich`
--
ALTER TABLE `quoctich`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `taikhoan`
--
ALTER TABLE `taikhoan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tongiao`
--
ALTER TABLE `tongiao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `trinhdo`
--
ALTER TABLE `trinhdo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `congtac`
--
ALTER TABLE `congtac`
  ADD CONSTRAINT `congtac_ibfk_1` FOREIGN KEY (`nhanvien_id`) REFERENCES `nhanvien` (`id`);

--
-- Constraints for table `lichlamviec`
--
ALTER TABLE `lichlamviec`
  ADD CONSTRAINT `lichlamviec_ibfk_1` FOREIGN KEY (`nhanvien_id`) REFERENCES `nhanvien` (`id`);

--
-- Constraints for table `luong`
--
ALTER TABLE `luong`
  ADD CONSTRAINT `luong_ibfk_1` FOREIGN KEY (`nhanvien_id`) REFERENCES `nhanvien` (`id`);

--
-- Constraints for table `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD CONSTRAINT `nhanvien_ibfk_1` FOREIGN KEY (`quoctich_id`) REFERENCES `quoctich` (`id`),
  ADD CONSTRAINT `nhanvien_ibfk_2` FOREIGN KEY (`tongiao_id`) REFERENCES `tongiao` (`id`),
  ADD CONSTRAINT `nhanvien_ibfk_3` FOREIGN KEY (`dantoc_id`) REFERENCES `dantoc` (`id`),
  ADD CONSTRAINT `nhanvien_ibfk_4` FOREIGN KEY (`loai_nv_id`) REFERENCES `loai_nv` (`id`),
  ADD CONSTRAINT `nhanvien_ibfk_5` FOREIGN KEY (`trinhdo_id`) REFERENCES `trinhdo` (`id`),
  ADD CONSTRAINT `nhanvien_ibfk_6` FOREIGN KEY (`chuyenmon_id`) REFERENCES `chuyenmon` (`id`),
  ADD CONSTRAINT `nhanvien_ibfk_7` FOREIGN KEY (`bangcap_id`) REFERENCES `bangcap` (`id`),
  ADD CONSTRAINT `nhanvien_ibfk_9` FOREIGN KEY (`chucvu_id`) REFERENCES `chucvu` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
