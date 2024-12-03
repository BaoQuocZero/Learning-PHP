-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2024 at 09:32 AM
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
  `USER_ADMIN` varchar(255) NOT NULL,
  `PASS_ADMIN` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `USERNAME` varchar(255) NOT NULL,
  `USER_ADMIN` varchar(255) NOT NULL,
  `ID_CHAT` int(11) NOT NULL,
  `NOI_DUNG_CHAT` text DEFAULT NULL,
  `THOI_GIAN_CHAT` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chi_tiet_gio_hang`
--

CREATE TABLE `chi_tiet_gio_hang` (
  `USERNAME` varchar(255) NOT NULL,
  `ID_SACH` int(11) NOT NULL,
  `ID_GIO_HANG` int(11) NOT NULL,
  `ID_CHI_TIET_GIO_HANG` int(11) NOT NULL,
  `SO_LUONG_MUA` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gio_hang`
--

CREATE TABLE `gio_hang` (
  `ID_GIO_HANG` int(11) NOT NULL,
  `USERNAME` varchar(255) NOT NULL,
  `THONG_TIN_GIO_HANG` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `loai_sanh`
--

CREATE TABLE `loai_sanh` (
  `MA_LOAI` varchar(5) NOT NULL,
  `TEN_LOAI` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `loai_sanh`
--

INSERT INTO `loai_sanh` (`MA_LOAI`, `TEN_LOAI`) VALUES
('LS001', 'Văn học'),
('LS002', 'Khoa học'),
('LS003', 'Lịch sử'),
('LS004', 'Toán học'),
('LS005', 'Kỹ năng sống');

-- --------------------------------------------------------

--
-- Table structure for table `nguoi_dung`
--

CREATE TABLE `nguoi_dung` (
  `USERNAME` varchar(255) NOT NULL,
  `PASSWORD` varchar(255) DEFAULT NULL,
  `hoten` varchar(50) NOT NULL,
  `quocgia` varchar(30) NOT NULL,
  `hinhdaidien` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sach`
--

CREATE TABLE `sach` (
  `ID_SACH` int(11) NOT NULL,
  `MA_LOAI` varchar(5) NOT NULL,
  `TEN_SACH` varchar(255) DEFAULT NULL,
  `TAC_GIA` varchar(255) DEFAULT NULL,
  `MO_TA` text DEFAULT NULL,
  `HINH_SACH` text DEFAULT NULL,
  `SO_TRANG` int(11) DEFAULT NULL,
  `GIA` int(11) DEFAULT NULL,
  `SO_LUONG` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sach`
--

INSERT INTO `sach` (`ID_SACH`, `MA_LOAI`, `TEN_SACH`, `TAC_GIA`, `MO_TA`, `HINH_SACH`, `SO_TRANG`, `GIA`, `SO_LUONG`) VALUES
(1, 'LS003', 'Chí Phèo', 'Nam Cao', 'Tác phẩm văn học nổi tiếng về số phận của người nông dân Việt Nam', 'chi_pheo.jpg', 176, 50000, 10),
(2, 'LS002', 'Vũ trụ trong vỏ hạt', 'Stephen Hawking', 'Cuốn sách khám phá những bí ẩn của vũ trụ', 'vu_tru_trong_vo_hat.jpg', 256, 120000, 15),
(3, 'LS003', 'Lịch sử Việt Nam', 'Phan Huy Lê', 'Cuốn sách khái quát lịch sử Việt Nam từ thời cổ đại', 'lich_su_viet_nam.jpg', 512, 150000, 8),
(4, 'LS004', 'Giải tích 1', 'Nguyễn Đình Trí', 'Sách giáo khoa toán đại học', 'giai_tich_1.jpg', 320, 90000, 20),
(5, 'LS005', 'Đắc nhân tâm', 'Dale Carnegie', 'Sách về kỹ năng sống và cách ứng xử để thành công', 'dac_nhan_tam.jpg', 284, 100000, 30),
(10, 'LS004', 'Sách của bao', 'Bảo', 'DDD', 'giai_tich_1.jpg', 1, 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`USER_ADMIN`);

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`USERNAME`,`USER_ADMIN`,`ID_CHAT`),
  ADD KEY `FK_CHAT2` (`USER_ADMIN`);

--
-- Indexes for table `chi_tiet_gio_hang`
--
ALTER TABLE `chi_tiet_gio_hang`
  ADD PRIMARY KEY (`USERNAME`,`ID_SACH`,`ID_GIO_HANG`,`ID_CHI_TIET_GIO_HANG`),
  ADD KEY `FK_CHI_TIET_GIO_HANG2` (`ID_SACH`),
  ADD KEY `FK_CHI_TIET_GIO_HANG3` (`ID_GIO_HANG`);

--
-- Indexes for table `gio_hang`
--
ALTER TABLE `gio_hang`
  ADD PRIMARY KEY (`ID_GIO_HANG`),
  ADD KEY `FK_DUYET` (`USERNAME`);

--
-- Indexes for table `loai_sanh`
--
ALTER TABLE `loai_sanh`
  ADD PRIMARY KEY (`MA_LOAI`);

--
-- Indexes for table `nguoi_dung`
--
ALTER TABLE `nguoi_dung`
  ADD PRIMARY KEY (`USERNAME`);

--
-- Indexes for table `sach`
--
ALTER TABLE `sach`
  ADD PRIMARY KEY (`ID_SACH`),
  ADD KEY `FK_THUOC` (`MA_LOAI`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gio_hang`
--
ALTER TABLE `gio_hang`
  MODIFY `ID_GIO_HANG` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sach`
--
ALTER TABLE `sach`
  MODIFY `ID_SACH` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chat`
--
ALTER TABLE `chat`
  ADD CONSTRAINT `FK_CHAT` FOREIGN KEY (`USERNAME`) REFERENCES `nguoi_dung` (`USERNAME`),
  ADD CONSTRAINT `FK_CHAT2` FOREIGN KEY (`USER_ADMIN`) REFERENCES `admin` (`USER_ADMIN`);

--
-- Constraints for table `chi_tiet_gio_hang`
--
ALTER TABLE `chi_tiet_gio_hang`
  ADD CONSTRAINT `FK_CHI_TIET_GIO_HANG` FOREIGN KEY (`USERNAME`) REFERENCES `nguoi_dung` (`USERNAME`),
  ADD CONSTRAINT `FK_CHI_TIET_GIO_HANG2` FOREIGN KEY (`ID_SACH`) REFERENCES `sach` (`ID_SACH`),
  ADD CONSTRAINT `FK_CHI_TIET_GIO_HANG3` FOREIGN KEY (`ID_GIO_HANG`) REFERENCES `gio_hang` (`ID_GIO_HANG`);

--
-- Constraints for table `gio_hang`
--
ALTER TABLE `gio_hang`
  ADD CONSTRAINT `FK_DUYET` FOREIGN KEY (`USERNAME`) REFERENCES `nguoi_dung` (`USERNAME`);

--
-- Constraints for table `sach`
--
ALTER TABLE `sach`
  ADD CONSTRAINT `FK_THUOC` FOREIGN KEY (`MA_LOAI`) REFERENCES `loai_sanh` (`MA_LOAI`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
