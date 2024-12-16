-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 15, 2024 at 09:16 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `online_shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `username` varchar(20) NOT NULL,
  `PASSWORD` text DEFAULT NULL,
  `hoten` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `PASSWORD`, `hoten`) VALUES
('NgThu', '1111', 'NgThiNgocThu'),
('TrHieu', '123123', 'DuongTrungHieu');

-- --------------------------------------------------------

--
-- Table structure for table `chitietgiohang`
--

CREATE TABLE `chitietgiohang` (
  `idchitietgio` int(11) NOT NULL,
  `soluongmua` int(11) DEFAULT NULL,
  `username` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `idgiohang` int(20) NOT NULL,
  `idsach` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `giohang`
--

CREATE TABLE `giohang` (
  `idgiohang` int(11) NOT NULL,
  `ngaytao` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `loaisach`
--

CREATE TABLE `loaisach` (
  `MaLoai` varchar(5) NOT NULL,
  `TenLoai` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `loaisach`
--

INSERT INTO `loaisach` (`MaLoai`, `TenLoai`) VALUES
('ML01', 'MaLoai1'),
('ML02', 'MaLoai2'),
('ML03', 'MaLoai3'),
('ML04', 'MaLoai4'),
('ML05', 'MaLoai5');

-- --------------------------------------------------------

--
-- Table structure for table `nguoi_dung`
--

CREATE TABLE `nguoi_dung` (
  `username` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(20) NOT NULL,
  `hoten` varchar(50) NOT NULL,
  `gioitinh` bit(2) NOT NULL,
  `quocgia` varchar(30) NOT NULL,
  `hinhdaidien` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nguoi_dung`
--

INSERT INTO `nguoi_dung` (`username`, `password`, `hoten`, `gioitinh`, `quocgia`, `hinhdaidien`) VALUES
('ngocthu', '1234', 'Nguyen Thi Ngoc Thu', b'01', 'VN', ''),
('quocninh', '111', 'Tran Quoc Ninh', b'00', 'Lao', ''),
('trunghieu', '123', 'DuongTrungHieu', b'00', 'VN', '');

-- --------------------------------------------------------

--
-- Table structure for table `sach`
--

CREATE TABLE `sach` (
  `IdSach` int(11) NOT NULL,
  `TenSach` varchar(100) DEFAULT NULL,
  `TacGia` varchar(100) DEFAULT NULL,
  `MoTa` text DEFAULT NULL,
  `HinhSach` text DEFAULT NULL,
  `SoTrang` int(11) DEFAULT NULL,
  `Gia` int(11) DEFAULT NULL,
  `SoLuong` int(11) DEFAULT NULL,
  `MaLoai` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sach`
--

INSERT INTO `sach` (`IdSach`, `TenSach`, `TacGia`, `MoTa`, `HinhSach`, `SoTrang`, `Gia`, `SoLuong`, `MaLoai`) VALUES
(1, 'Sach Ky Thuat So - Flip-flop Thanh ghi bo dem', 'HieuD', 'sach ve ky thuat so', 'hinhanh/hinhsach1.jpg', 100, 200000, 2, 'ML01'),
(2, 'Sach vong quanh Han Quoc', 'Thu2', 'sach ve du lich Han Quoc', 'hinhanh/hinhsach2.jpg', 50, 120000, 11, 'ML02'),
(3, 'du lich the gioi Chau A', 'Ninh3', 'sach ve du lich Chau A', 'hinhanh/hinhsach3.jpg', 300, 320000, 20, 'ML03'),
(4, 'Sach vong quanh Chau Au', 'HieuK', 'sach ve du lich Chau Au', 'hinhanh/hinhsach4.jpg', 150, 220000, 19, 'ML04'),
(5, 'Sach Thi cong xay dung', 'NinhZ', 'sach ve thi cong xay dung', 'hinhanh/hinhsach5.jpg', 30, 150000, 21, 'ML05'),
(6, 'Tu hoc javascript', 'HieuZ1K', 'Sach ve ngon ngu Javascript', 'hinhanh/hinhanh6.jpg', 120, 500000, 10, 'ML02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `chitietgiohang`
--
ALTER TABLE `chitietgiohang`
  ADD PRIMARY KEY (`idchitietgio`),
  ADD KEY `idsach` (`idsach`),
  ADD KEY `idgiohang` (`idgiohang`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `giohang`
--
ALTER TABLE `giohang`
  ADD PRIMARY KEY (`idgiohang`);

--
-- Indexes for table `loaisach`
--
ALTER TABLE `loaisach`
  ADD PRIMARY KEY (`MaLoai`);

--
-- Indexes for table `nguoi_dung`
--
ALTER TABLE `nguoi_dung`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `sach`
--
ALTER TABLE `sach`
  ADD PRIMARY KEY (`IdSach`),
  ADD KEY `MaLoai` (`MaLoai`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chitietgiohang`
--
ALTER TABLE `chitietgiohang`
  MODIFY `idchitietgio` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `giohang`
--
ALTER TABLE `giohang`
  MODIFY `idgiohang` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sach`
--
ALTER TABLE `sach`
  MODIFY `IdSach` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chitietgiohang`
--
ALTER TABLE `chitietgiohang`
  ADD CONSTRAINT `chitietgiohang_ibfk_1` FOREIGN KEY (`idsach`) REFERENCES `sach` (`IdSach`),
  ADD CONSTRAINT `chitietgiohang_ibfk_2` FOREIGN KEY (`idgiohang`) REFERENCES `giohang` (`idgiohang`),
  ADD CONSTRAINT `chitietgiohang_ibfk_3` FOREIGN KEY (`username`) REFERENCES `nguoi_dung` (`username`);

--
-- Constraints for table `sach`
--
ALTER TABLE `sach`
  ADD CONSTRAINT `sach_ibfk_1` FOREIGN KEY (`MaLoai`) REFERENCES `loaisach` (`MaLoai`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
