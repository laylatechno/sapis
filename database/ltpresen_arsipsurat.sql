-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 02 Jul 2024 pada 06.14
-- Versi server: 10.5.25-MariaDB-cll-lve
-- Versi PHP: 8.1.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ltpresen_arsipsurat`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `accountinfo`
--

CREATE TABLE `accountinfo` (
  `Username` varchar(30) NOT NULL,
  `WorkunitID` int(11) DEFAULT NULL,
  `FullName` varchar(50) DEFAULT NULL,
  `Address` longtext DEFAULT NULL,
  `Village` varchar(50) DEFAULT NULL,
  `SubDistrict` varchar(50) DEFAULT NULL,
  `District` varchar(50) DEFAULT NULL,
  `State` varchar(30) DEFAULT NULL,
  `ZIPCode` varchar(5) DEFAULT NULL,
  `POB` varchar(30) DEFAULT NULL,
  `DOB` date DEFAULT NULL,
  `Gender` enum('Laki-laki','Perempuan') DEFAULT NULL,
  `Religion` varchar(30) DEFAULT NULL,
  `Phone` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `accountinfo`
--

INSERT INTO `accountinfo` (`Username`, `WorkunitID`, `FullName`, `Address`, `Village`, `SubDistrict`, `District`, `State`, `ZIPCode`, `POB`, `DOB`, `Gender`, `Religion`, `Phone`) VALUES
('admin', 1, 'Ionix Eternal Admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `accountlogincounter`
--

CREATE TABLE `accountlogincounter` (
  `IndexID` int(11) NOT NULL,
  `Username` varchar(30) DEFAULT NULL,
  `CounterBrowser` varchar(30) DEFAULT NULL,
  `CounterOS` varchar(30) DEFAULT NULL,
  `CounterLog` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `accountlogincounter`
--

INSERT INTO `accountlogincounter` (`IndexID`, `Username`, `CounterBrowser`, `CounterOS`, `CounterLog`) VALUES
(1, 'admin', 'Chrome', 'Windows 10', '2023-09-19 20:05:11'),
(2, 'admin', 'Chrome', 'Windows 10', '2024-04-09 08:31:19');

-- --------------------------------------------------------

--
-- Struktur dari tabel `accountuser`
--

CREATE TABLE `accountuser` (
  `IndexID` int(11) NOT NULL,
  `Username` varchar(30) NOT NULL,
  `Password` longtext DEFAULT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `RoleID` int(11) DEFAULT NULL,
  `AccountStatus` enum('yes','no') DEFAULT NULL,
  `AccountProfile` longtext DEFAULT NULL,
  `AccountCover` longtext DEFAULT NULL,
  `Log` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `accountuser`
--

INSERT INTO `accountuser` (`IndexID`, `Username`, `Password`, `Email`, `RoleID`, `AccountStatus`, `AccountProfile`, `AccountCover`, `Log`) VALUES
(1, 'admin', '$2y$10$sbWkPBJ6raF1jwQu7OAF6eCxoyBfEBGPN3lUh.d536mio0xyUNvZ2', NULL, 4, 'yes', NULL, NULL, '2020-08-12 04:56:33');

-- --------------------------------------------------------

--
-- Struktur dari tabel `appsetting`
--

CREATE TABLE `appsetting` (
  `AppID` int(11) NOT NULL,
  `AppSmallLogoWhite` longtext DEFAULT NULL,
  `AppSmallLogoBlack` longtext DEFAULT NULL,
  `AppLargeLogoWhite` longtext DEFAULT NULL,
  `AppLargeLogoBlack` longtext DEFAULT NULL,
  `AppLoginHeader` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `appsetting`
--

INSERT INTO `appsetting` (`AppID`, `AppSmallLogoWhite`, `AppSmallLogoBlack`, `AppLargeLogoWhite`, `AppLargeLogoBlack`, `AppLoginHeader`) VALUES
(1, '6nk5moCD7BJy2xV13iwpUsZbTF8Xl9PNzfRYcSQ0jOWruGEqdI.png', 'hdeDw352EckjKSpxWbJCAVfaOYU0uB9XMrIGvzlQgZq1nLFTsR.jpg', 'v2Ladt10XiKEyuDcSO4QPAbkrgjw8fenH7N59hx3zCJMqWZYGm.png', 'R5fmNQnUwyCksSvBOZcKPTdEJIV7jA1LH4YMDWzro0x6lGh9bi.png', 'FRZ0lImLWCxGrJ3cP6Dfo2Uh8dtwnEv9j41qSzgb7piaOHKkTN.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `companysetting`
--

CREATE TABLE `companysetting` (
  `CompanyID` int(11) NOT NULL,
  `CompanyName` varchar(30) DEFAULT NULL,
  `CompanyType` varchar(20) DEFAULT NULL,
  `CompanyEmail` varchar(255) DEFAULT NULL,
  `CompanyAddress` longtext DEFAULT NULL,
  `CompanyVillage` varchar(255) DEFAULT NULL,
  `CompanySubDistrict` varchar(255) DEFAULT NULL,
  `CompanyDistrict` varchar(255) DEFAULT NULL,
  `CompanyState` varchar(255) DEFAULT NULL,
  `CompanyZIPCode` varchar(255) DEFAULT NULL,
  `CompanyPhone` varchar(13) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `companysetting`
--

INSERT INTO `companysetting` (`CompanyID`, `CompanyName`, `CompanyType`, `CompanyEmail`, `CompanyAddress`, `CompanyVillage`, `CompanySubDistrict`, `CompanyDistrict`, `CompanyState`, `CompanyZIPCode`, `CompanyPhone`) VALUES
(1, 'Asta Surat', 'IT Consultant', 'support@astacode.co.id', 'Jl. Tajur Indah No 121 Indihiang', 'Indihiang', 'Indihiang', 'Tasikmalaya', 'Jawa Barat', '41001', '085320555394');

-- --------------------------------------------------------

--
-- Struktur dari tabel `disposition`
--

CREATE TABLE `disposition` (
  `DispositionID` int(11) NOT NULL,
  `InMailID` int(11) DEFAULT NULL,
  `Username` varchar(30) DEFAULT '',
  `DispositionNote` longtext DEFAULT NULL,
  `DispositionDeadline` date DEFAULT NULL,
  `DispositionStatus` enum('read','unread') DEFAULT NULL,
  `DispositionLog` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Struktur dari tabel `dispoted`
--

CREATE TABLE `dispoted` (
  `DispositionID` int(11) NOT NULL,
  `Username` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Struktur dari tabel `indeks`
--

CREATE TABLE `indeks` (
  `IndeksID` int(11) NOT NULL,
  `IndeksCode` varchar(10) NOT NULL,
  `IndeksName` varchar(255) DEFAULT NULL,
  `IndeksDesc` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `indeks`
--

INSERT INTO `indeks` (`IndeksID`, `IndeksCode`, `IndeksName`, `IndeksDesc`) VALUES
(1, '000', 'Umum', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `inmail`
--

CREATE TABLE `inmail` (
  `InMailID` int(11) NOT NULL,
  `IndeksID` int(11) DEFAULT NULL,
  `WorkunitID` int(11) DEFAULT NULL,
  `Username` varchar(30) DEFAULT NULL,
  `InMailAgenda` varchar(30) DEFAULT NULL,
  `InMailNumber` varchar(30) DEFAULT NULL,
  `InMailOrigin` varchar(100) DEFAULT NULL,
  `InMailContent` longtext DEFAULT NULL,
  `InMailTrait` varchar(10) DEFAULT NULL,
  `InMailDate` date DEFAULT NULL,
  `InMailStatus` int(11) DEFAULT 0,
  `InMailLog` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Struktur dari tabel `inmailattachment`
--

CREATE TABLE `inmailattachment` (
  `AttachmentID` int(11) NOT NULL,
  `InMailID` int(11) DEFAULT NULL,
  `AttachmentName` varchar(30) DEFAULT NULL,
  `AttachmentFile` longtext DEFAULT NULL,
  `AttachmentLog` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Struktur dari tabel `inmailcommentar`
--

CREATE TABLE `inmailcommentar` (
  `CommentarID` int(11) NOT NULL,
  `InMailID` int(11) DEFAULT NULL,
  `Username` varchar(30) DEFAULT NULL,
  `CommentarDesc` longtext DEFAULT NULL,
  `CommentarLog` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Struktur dari tabel `menuaccess`
--

CREATE TABLE `menuaccess` (
  `IndexID` int(11) NOT NULL,
  `RoleID` int(11) DEFAULT NULL,
  `GroupID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `menuaccess`
--

INSERT INTO `menuaccess` (`IndexID`, `RoleID`, `GroupID`) VALUES
(1, 4, 1),
(2, 4, 2),
(6, 4, 6),
(7, 4, 7),
(8, 1, 1),
(9, 2, 1),
(11, 2, 3),
(12, 3, 1),
(13, 3, 4),
(14, 3, 5),
(15, 4, 3),
(16, 4, 4),
(17, 4, 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `menugroup`
--

CREATE TABLE `menugroup` (
  `GroupID` int(11) NOT NULL,
  `GroupTitle` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `menugroup`
--

INSERT INTO `menugroup` (`GroupID`, `GroupTitle`) VALUES
(1, 'Main Menu'),
(2, 'Master Data'),
(3, 'Registrasi'),
(4, 'Disposisi'),
(5, 'Laporan'),
(6, 'Manajemen'),
(7, 'Pengaturan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `menumaster`
--

CREATE TABLE `menumaster` (
  `MenuID` int(11) NOT NULL,
  `GroupID` int(11) DEFAULT NULL,
  `MenuTitle` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `MenuLink` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `MenuIcon` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `MenuType` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `menumaster`
--

INSERT INTO `menumaster` (`MenuID`, `GroupID`, `MenuTitle`, `MenuLink`, `MenuIcon`, `MenuType`) VALUES
(1, 1, 'Beranda', 'dashboard', 'mdi mdi-view-dashboard', 0),
(2, 1, 'Kotak Masuk', 'inbox', 'mdi mdi-email-multiple-outline', 0),
(3, 2, 'Indeks Surat', 'indeks', 'mdi mdi-format-list-bulleted-triangle', 0),
(4, 3, 'Surat Masuk', 'incoming_mail', 'mdi mdi-inbox-arrow-down', 0),
(5, 3, 'Surat Keluar', 'outgoing_mail', 'mdi mdi-inbox-arrow-up', 0),
(6, 4, 'Surat Masuk', 'disposition', 'mdi mdi-arrow-right-bold-box-outline', 0),
(7, 5, 'Surat Masuk', 'incoming_report', 'mdi mdi-file-import-outline', 0),
(8, 5, 'Surat Keluar', 'outgoing_report', 'mdi mdi-file-export-outline', 0),
(9, 6, 'Unit Kerja', 'workunit', 'mdi mdi-briefcase', 0),
(10, 6, 'Pengguna & Hak Akses', 'users', 'mdi mdi-account-multiple-outline', 0),
(11, 7, 'Instansi / Badan Usaha', 'company', 'mdi mdi-battlenet', 0),
(12, 7, 'Backup Database', 'mdatabase', 'mdi mdi-backup-restore', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `outmail`
--

CREATE TABLE `outmail` (
  `OutMailID` int(11) NOT NULL,
  `IndeksID` int(11) DEFAULT NULL,
  `WorkunitID` int(11) DEFAULT NULL,
  `Username` varchar(30) DEFAULT NULL,
  `OutMailAgenda` varchar(30) DEFAULT NULL,
  `OutMailNumber` varchar(50) DEFAULT NULL,
  `OutMailDestination` varchar(255) DEFAULT NULL,
  `OutMailContent` longtext DEFAULT NULL,
  `OutMailTrait` varchar(10) DEFAULT NULL,
  `OutMailDate` date DEFAULT NULL,
  `OutMailLog` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Struktur dari tabel `outmailattachment`
--

CREATE TABLE `outmailattachment` (
  `AttachmentID` int(11) NOT NULL,
  `OutMailID` int(11) DEFAULT NULL,
  `AttachmentName` varchar(255) DEFAULT NULL,
  `AttachmentFile` longtext DEFAULT NULL,
  `AttachmentLog` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Struktur dari tabel `rolemaster`
--

CREATE TABLE `rolemaster` (
  `RoleID` int(11) NOT NULL,
  `RoleName` varchar(30) DEFAULT NULL,
  `RoleColor` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `rolemaster`
--

INSERT INTO `rolemaster` (`RoleID`, `RoleName`, `RoleColor`) VALUES
(1, 'Pengguna', 'primary'),
(2, 'Operator', 'warning'),
(3, 'Pimpinan', 'success'),
(4, 'Administrator', 'danger');

-- --------------------------------------------------------

--
-- Struktur dari tabel `workunit`
--

CREATE TABLE `workunit` (
  `WorkunitID` int(11) NOT NULL,
  `WorkunitCode` varchar(10) NOT NULL,
  `WorkunitName` varchar(255) DEFAULT NULL,
  `WorkunitDesc` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `workunit`
--

INSERT INTO `workunit` (`WorkunitID`, `WorkunitCode`, `WorkunitName`, `WorkunitDesc`) VALUES
(1, 'ADM', 'Bag. Administrasi', NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `accountinfo`
--
ALTER TABLE `accountinfo`
  ADD PRIMARY KEY (`Username`) USING BTREE;

--
-- Indeks untuk tabel `accountlogincounter`
--
ALTER TABLE `accountlogincounter`
  ADD PRIMARY KEY (`IndexID`) USING BTREE;

--
-- Indeks untuk tabel `accountuser`
--
ALTER TABLE `accountuser`
  ADD PRIMARY KEY (`IndexID`,`Username`) USING BTREE;

--
-- Indeks untuk tabel `appsetting`
--
ALTER TABLE `appsetting`
  ADD PRIMARY KEY (`AppID`) USING BTREE;

--
-- Indeks untuk tabel `companysetting`
--
ALTER TABLE `companysetting`
  ADD PRIMARY KEY (`CompanyID`) USING BTREE;

--
-- Indeks untuk tabel `disposition`
--
ALTER TABLE `disposition`
  ADD PRIMARY KEY (`DispositionID`) USING BTREE;

--
-- Indeks untuk tabel `dispoted`
--
ALTER TABLE `dispoted`
  ADD PRIMARY KEY (`DispositionID`) USING BTREE;

--
-- Indeks untuk tabel `indeks`
--
ALTER TABLE `indeks`
  ADD PRIMARY KEY (`IndeksID`,`IndeksCode`) USING BTREE;

--
-- Indeks untuk tabel `inmail`
--
ALTER TABLE `inmail`
  ADD PRIMARY KEY (`InMailID`) USING BTREE;

--
-- Indeks untuk tabel `inmailattachment`
--
ALTER TABLE `inmailattachment`
  ADD PRIMARY KEY (`AttachmentID`) USING BTREE;

--
-- Indeks untuk tabel `inmailcommentar`
--
ALTER TABLE `inmailcommentar`
  ADD PRIMARY KEY (`CommentarID`) USING BTREE;

--
-- Indeks untuk tabel `menuaccess`
--
ALTER TABLE `menuaccess`
  ADD PRIMARY KEY (`IndexID`) USING BTREE;

--
-- Indeks untuk tabel `menugroup`
--
ALTER TABLE `menugroup`
  ADD PRIMARY KEY (`GroupID`) USING BTREE;

--
-- Indeks untuk tabel `menumaster`
--
ALTER TABLE `menumaster`
  ADD PRIMARY KEY (`MenuID`) USING BTREE;

--
-- Indeks untuk tabel `outmail`
--
ALTER TABLE `outmail`
  ADD PRIMARY KEY (`OutMailID`) USING BTREE;

--
-- Indeks untuk tabel `outmailattachment`
--
ALTER TABLE `outmailattachment`
  ADD PRIMARY KEY (`AttachmentID`) USING BTREE;

--
-- Indeks untuk tabel `rolemaster`
--
ALTER TABLE `rolemaster`
  ADD PRIMARY KEY (`RoleID`) USING BTREE;

--
-- Indeks untuk tabel `workunit`
--
ALTER TABLE `workunit`
  ADD PRIMARY KEY (`WorkunitID`,`WorkunitCode`) USING BTREE;

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `accountlogincounter`
--
ALTER TABLE `accountlogincounter`
  MODIFY `IndexID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `accountuser`
--
ALTER TABLE `accountuser`
  MODIFY `IndexID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `appsetting`
--
ALTER TABLE `appsetting`
  MODIFY `AppID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `companysetting`
--
ALTER TABLE `companysetting`
  MODIFY `CompanyID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `disposition`
--
ALTER TABLE `disposition`
  MODIFY `DispositionID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `indeks`
--
ALTER TABLE `indeks`
  MODIFY `IndeksID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `inmail`
--
ALTER TABLE `inmail`
  MODIFY `InMailID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `inmailattachment`
--
ALTER TABLE `inmailattachment`
  MODIFY `AttachmentID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `inmailcommentar`
--
ALTER TABLE `inmailcommentar`
  MODIFY `CommentarID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `menuaccess`
--
ALTER TABLE `menuaccess`
  MODIFY `IndexID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `menugroup`
--
ALTER TABLE `menugroup`
  MODIFY `GroupID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `menumaster`
--
ALTER TABLE `menumaster`
  MODIFY `MenuID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `outmail`
--
ALTER TABLE `outmail`
  MODIFY `OutMailID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `outmailattachment`
--
ALTER TABLE `outmailattachment`
  MODIFY `AttachmentID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `rolemaster`
--
ALTER TABLE `rolemaster`
  MODIFY `RoleID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `workunit`
--
ALTER TABLE `workunit`
  MODIFY `WorkunitID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
