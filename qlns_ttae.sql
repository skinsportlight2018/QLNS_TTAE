-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 04, 2024 at 09:54 AM
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
  `ghichu` varchar(255) NOT NULL,
  `nguoitao` varchar(255) NOT NULL,
  `ngaytao` int(11) NOT NULL,
  `nguoisua` varchar(255) NOT NULL,
  `ngaysua` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

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
  `luongngay` double NOT NULL,
  `ghichu` varchar(255) NOT NULL,
  `nguoitao` varchar(255) NOT NULL,
  `ngaytao` int(11) NOT NULL,
  `nguoisua` varchar(255) NOT NULL,
  `ngaysua` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chuyenmon`
--

CREATE TABLE `chuyenmon` (
  `id` int(11) NOT NULL,
  `machuyenmon` varchar(50) NOT NULL,
  `tenchuyenmon` varchar(255) NOT NULL,
  `ghichu` varchar(255) NOT NULL,
  `nguoitao` varchar(255) NOT NULL,
  `ngaytao` int(11) NOT NULL,
  `nguoisua` varchar(255) NOT NULL,
  `ngaysua` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

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
  `ghichu` varchar(255) NOT NULL,
  `nguoitao` varchar(255) NOT NULL,
  `ngaytao` date NOT NULL,
  `nguoisua` varchar(255) NOT NULL,
  `ngaysua` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dantoc`
--

CREATE TABLE `dantoc` (
  `id` int(11) NOT NULL,
  `tendantoc` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

-- --------------------------------------------------------

--
-- Table structure for table `loai_nv`
--

CREATE TABLE `loai_nv` (
  `id` int(11) NOT NULL,
  `maloainv` varchar(50) NOT NULL,
  `tenloainv` varchar(255) NOT NULL,
  `ghichu` varchar(255) NOT NULL,
  `nguoitao` varchar(255) NOT NULL,
  `ngaytao` int(11) NOT NULL,
  `nguoisua` varchar(255) NOT NULL,
  `ngaysua` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

-- --------------------------------------------------------

--
-- Table structure for table `luong`
--

CREATE TABLE `luong` (
  `id` int(11) NOT NULL,
  `maluong` varchar(255) NOT NULL,
  `nhanvien_id` int(11) NOT NULL,
  `luongthang` double NOT NULL,
  `ngaycong` date NOT NULL,
  `phucap` double NOT NULL,
  `khoannop` double NOT NULL,
  `tamung` double NOT NULL,
  `thuclanh` double NOT NULL,
  `ngaychamcong` date NOT NULL,
  `ghichu` varchar(255) NOT NULL,
  `nguoitao` varchar(255) NOT NULL,
  `ngaytao` date NOT NULL,
  `nguoisua` varchar(255) NOT NULL,
  `ngaysua` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nhanvien`
--

CREATE TABLE `nhanvien` (
  `id` int(11) NOT NULL,
  `manv` varchar(255) NOT NULL,
  `hotennv` varchar(255) NOT NULL,
  `hinhanh` varchar(255) NOT NULL,
  `sdt` int(11) NOT NULL,
  `gioitinh` tinyint(4) NOT NULL,
  `ngaysinh` date NOT NULL,
  `noisinh` varchar(255) NOT NULL,
  `cccd` int(11) NOT NULL,
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
  `phongban_id` int(11) NOT NULL,
  `trangthai` tinyint(4) NOT NULL,
  `nguoitao` varchar(255) NOT NULL,
  `ngaytao` date NOT NULL,
  `nguoisua` varchar(255) NOT NULL,
  `ngaysua` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nhom`
--

CREATE TABLE `nhom` (
  `id` int(11) NOT NULL,
  `manhom` varchar(50) NOT NULL,
  `tennhom` varchar(255) NOT NULL,
  `mota` text NOT NULL,
  `nguoitao` varchar(255) NOT NULL,
  `ngaytao` int(11) NOT NULL,
  `nguoisua` varchar(255) NOT NULL,
  `ngaysua` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

-- --------------------------------------------------------

--
-- Table structure for table `phongban`
--

CREATE TABLE `phongban` (
  `id` int(11) NOT NULL,
  `maphongban` varchar(5) NOT NULL,
  `tenphongban` varchar(255) NOT NULL,
  `ghichu` varchar(255) NOT NULL,
  `nguoitao` varchar(255) NOT NULL,
  `ngaytao` date NOT NULL,
  `nguoisua` varchar(255) NOT NULL,
  `ngaysua` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quoctich`
--

CREATE TABLE `quoctich` (
  `id` int(11) NOT NULL,
  `tenquoctich` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

-- --------------------------------------------------------

--
-- Table structure for table `taikhoan`
--

CREATE TABLE `taikhoan` (
  `id` int(11) NOT NULL,
  `ho` varchar(50) NOT NULL,
  `ten` varchar(50) NOT NULL,
  `anh` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `matkhau` varchar(50) NOT NULL,
  `sdt` varchar(50) NOT NULL,
  `quyen` tinyint(4) NOT NULL,
  `trangthai` tinyint(4) NOT NULL,
  `nguoitao` varchar(255) NOT NULL,
  `ngaytao` int(11) NOT NULL,
  `nguoisua` varchar(255) NOT NULL,
  `ngaysua` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tongiao`
--

CREATE TABLE `tongiao` (
  `id` int(11) NOT NULL,
  `tentongiao` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

-- --------------------------------------------------------

--
-- Table structure for table `trinhdo`
--

CREATE TABLE `trinhdo` (
  `id` int(11) NOT NULL,
  `matrinhdo` varchar(50) NOT NULL,
  `tentrinhdo` varchar(255) NOT NULL,
  `ghichu` varchar(255) NOT NULL,
  `nguoitao` varchar(255) NOT NULL,
  `ngaytao` int(11) NOT NULL,
  `nguoisua` varchar(255) NOT NULL,
  `ngaysua` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

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
  ADD KEY `phongban_id` (`phongban_id`),
  ADD KEY `chucvu_id` (`chucvu_id`);

--
-- Indexes for table `nhom`
--
ALTER TABLE `nhom`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `phongban`
--
ALTER TABLE `phongban`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chitiet_nhom`
--
ALTER TABLE `chitiet_nhom`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chucvu`
--
ALTER TABLE `chucvu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chuyenmon`
--
ALTER TABLE `chuyenmon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `congtac`
--
ALTER TABLE `congtac`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dantoc`
--
ALTER TABLE `dantoc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `loai_nv`
--
ALTER TABLE `loai_nv`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `luong`
--
ALTER TABLE `luong`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nhanvien`
--
ALTER TABLE `nhanvien`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nhom`
--
ALTER TABLE `nhom`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `phongban`
--
ALTER TABLE `phongban`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quoctich`
--
ALTER TABLE `quoctich`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `taikhoan`
--
ALTER TABLE `taikhoan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tongiao`
--
ALTER TABLE `tongiao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trinhdo`
--
ALTER TABLE `trinhdo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `congtac`
--
ALTER TABLE `congtac`
  ADD CONSTRAINT `congtac_ibfk_1` FOREIGN KEY (`nhanvien_id`) REFERENCES `nhanvien` (`id`);

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
  ADD CONSTRAINT `nhanvien_ibfk_8` FOREIGN KEY (`phongban_id`) REFERENCES `phongban` (`id`),
  ADD CONSTRAINT `nhanvien_ibfk_9` FOREIGN KEY (`chucvu_id`) REFERENCES `chucvu` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
