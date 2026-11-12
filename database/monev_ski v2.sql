-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 09, 2026 at 02:10 AM
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
-- Database: `monev_ski`
--

-- --------------------------------------------------------

--
-- Table structure for table `audit_logs`
--

CREATE TABLE `audit_logs` (
  `id_log` varchar(36) NOT NULL,
  `id_user` varchar(36) NOT NULL,
  `role_saat_aksi` varchar(50) NOT NULL,
  `jenis_aksi` varchar(100) NOT NULL,
  `objek_target` varchar(200) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp_aktivitas` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `audit_logs`
--

INSERT INTO `audit_logs` (`id_log`, `id_user`, `role_saat_aksi`, `jenis_aksi`, `objek_target`, `ip_address`, `timestamp_aktivitas`) VALUES
('003d72e1-c2d0-4253-a601-0be967de2bf1', '54a42c4a-41e4-4d7d-bc0e-dc888a01d8a4', 'Admin', 'Login', 'Sistem Monev SKI', '::1', '2026-11-09 08:09:26'),
('017f54c8-21c0-4cd5-a87f-727d33db8a31', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-29 06:40:24'),
('03d854fe-ea93-4e28-b096-9c3f7921ab6c', 'usr-budi', 'PIC', 'Perbarui Profil Akun', 'Pengguna \'Budi Santoso\' (budi.keu) memperbarui profil akun mandiri (dengan pembaruan kata sandi)', '::1', '2026-10-29 07:52:16'),
('044f16e0-1e1e-4165-be12-b91ab97b10b6', 'usr-rina', 'Anggota SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-29 12:16:52'),
('0473661f-ae93-4c01-8cff-a4cdbdc64f32', '54a42c4a-41e4-4d7d-bc0e-dc888a01d8a4', 'Admin', 'Terbitkan Jadwal Pengawasan', 'Oktober 2026 (3 modul)', '::1', '2026-11-02 10:39:04'),
('061a68c1-0d22-4786-8ee2-4526963c69a7', 'usr-rina', 'Anggota SKI', 'Kirim hasil review SKI', '1 butir eviden dievaluasi', '::1', '2026-11-04 16:38:14'),
('067e01ff-d86e-408a-bd39-f94aa35928f3', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-27 12:10:57'),
('069b12e9-e139-4df4-9487-946f9b403333', 'usr-rina', 'Anggota SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-28 09:00:07'),
('06eea6f5-ffe4-4175-ae91-4b4a7d33a10d', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-29 12:21:20'),
('09ba561d-5cd6-4693-a8b3-04e420569927', 'usr-budi', 'PIC', 'Login', 'Sistem Monev SKI', '::1', '2026-10-28 08:58:40'),
('0a4017b0-658d-4f87-b918-011f0fa1dece', 'usr-dewi', 'PIC', 'Login', 'Sistem Monev SKI', '::1', '2026-10-29 07:00:59'),
('0ae6352b-f0fa-4e9c-bc2e-224bbba51a21', 'usr-pim', 'Pimpinan', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-29 12:15:28'),
('0afd53e8-1e47-4eee-9831-a99adb5526ce', 'usr-rina', 'Anggota SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-29 12:16:08'),
('0c38b35a-98c8-430b-b653-966fbd757c0e', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Tambah Indikator Modul', 'Modul: mod-c3f6991a - Test [Tipe: file]', '::1', '2026-10-27 12:09:53'),
('0c4b3ceb-7a75-4f92-adbd-ed2404c06b73', '54a42c4a-41e4-4d7d-bc0e-dc888a01d8a4', 'Admin', 'Kosongkan Isi Modul', 'Seluruh butir tagihan modul mod-test-ca61f0 dikosongkan.', '::1', '2026-10-27 11:48:31'),
('0c5bbdce-6c36-4e49-a959-fafbe408e323', 'usr-rina', 'Anggota SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-27 12:10:58'),
('0c876711-3561-442f-9f40-8221520db52d', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-29 12:56:32'),
('0dc18132-07c1-4da2-b668-dde318907dfc', 'usr-rina', 'Anggota SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-11-04 14:58:42'),
('0e43928b-873f-4807-a323-09c70a3293ce', 'usr-rina', 'Anggota SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-11-02 08:46:33'),
('10d657c7-ff39-413e-b9d0-b7a3d50a97e2', 'usr-dewi', 'PIC', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-28 08:58:05'),
('111bd728-012b-4d96-be70-ee2081356275', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-11-02 12:53:59'),
('11510b05-d6be-4bc3-a90b-3c9b8ac37300', 'usr-rina', 'Anggota SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-11-04 16:39:47'),
('1379cda3-a248-4b88-ae53-c3153647b08c', 'usr-rina', 'Anggota SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-28 09:00:54'),
('13cfcc4f-9a0e-451f-bbc3-76e9ca4e3da1', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-11-02 11:16:20'),
('13f9f13e-2c33-477c-8021-a52bc050910a', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-28 09:00:11'),
('154f9d86-2407-4857-8db8-ca75b522d6e9', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Terbitkan Jadwal Pengawasan', 'Oktober 2026 (3 modul aktif diterbitkan)', '::1', '2026-11-02 12:54:16'),
('1563f324-20ac-4661-a832-fa38cb09440c', 'usr-dewi', 'PIC', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-27 12:12:05'),
('1572a5d1-c852-4049-846b-0e4bee5c37cf', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-27 12:11:10'),
('17775887-783a-46c1-8517-ba8283f14bea', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-11-04 16:40:09'),
('1864e7ca-1b1d-4578-a49a-90ef9aa78895', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-28 09:00:50'),
('18e552d5-74e5-4ea3-bb5c-274c187d4123', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-27 12:08:50'),
('18ff6c15-b1f7-465d-92b2-2912c87a5c18', '54a42c4a-41e4-4d7d-bc0e-dc888a01d8a4', 'Admin', 'Login', 'Sistem Monev SKI', '::1', '2026-10-28 08:43:53'),
('1b4757ee-0032-4bef-9302-bddf4292617d', 'usr-dewi', 'PIC', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-29 12:17:45'),
('1c2f149f-8a66-4c18-9cc9-847544d4026a', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-28 09:01:15'),
('1de3c341-5b55-4b4d-9651-37228cb1976e', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-11-02 11:20:06'),
('20db2110-e2e2-4556-b623-e95c7b86aafe', 'usr-dewi', 'PIC', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-11-02 11:16:17'),
('2281186a-da2b-493c-89a9-38114b30afc5', 'usr-rina', 'Anggota SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-11-03 08:52:39'),
('22a6c966-a4be-49e3-ab58-54edb3772f98', 'usr-dewi', 'PIC', 'Login', 'Sistem Monev SKI', '::1', '2026-11-02 11:04:36'),
('236c8c4e-622c-41f1-8228-c7c27a0f2e21', 'usr-dewi', 'PIC', 'Login', 'Sistem Monev SKI', '::1', '2026-11-02 11:14:21'),
('2372d585-a09f-4fe8-b6f7-4e775e32b3c8', 'usr-rina', 'Anggota SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-29 12:16:46'),
('24fd38a1-7622-446c-96e0-181438cc0e6b', '54a42c4a-41e4-4d7d-bc0e-dc888a01d8a4', 'Admin', 'Login', 'Sistem Monev SKI', '::1', '2026-10-29 07:52:44'),
('250feaa8-22dd-4ffa-a95b-bb6f1c9b3492', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Ekspor Modul Akhir GForm Itjen', 'Modul: Test', '::1', '2026-10-29 13:29:50'),
('2575fe3b-8a5c-4d71-8def-c2d685ddcfac', 'usr-dewi', 'PIC', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-29 12:16:05'),
('25a220f8-5826-42b8-ad42-3649e97f1558', 'usr-pim', 'Pimpinan', 'Pimpinan menyetujui berkas eviden', '2024-07-16_-_Internship_Handbook_SY_24_25 -Indonesia Version.pdf (Test 2) - Versi 2', '::1', '2026-11-04 16:40:38'),
('2652552e-76ea-42bd-90be-f6ca1dfb96d4', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-29 11:45:59'),
('26e5a4b0-ec59-483c-8324-da8cf69b66f6', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-11-02 10:22:35'),
('27185edd-2d9d-4749-8eaa-d58099215e0d', 'usr-dewi', 'PIC', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-29 11:45:57'),
('28feb0df-74bf-49fb-92cb-8640b5c7e5a8', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Ekspor Modul Akhir GForm Itjen', 'Modul: Test', '::1', '2026-10-29 13:58:06'),
('2a3389ae-01ad-46d4-909c-194236850b5f', 'usr-dewi', 'PIC', 'Login', 'Sistem Monev SKI', '::1', '2026-10-29 12:15:35'),
('2b18ab24-858d-4ea8-b5a8-97a3c9ff44c4', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Approval berkas Ketua SKI', '1 berkas disetujui', '::1', '2026-11-04 16:40:05'),
('2b94807c-46ce-49a0-8623-fefc5ebd785b', '54a42c4a-41e4-4d7d-bc0e-dc888a01d8a4', 'Admin', 'Perbarui Akun Pegawai', 'PIC Kepegawaian (Kepegawaian) - Peran: PIC, Unit: Kepegawaian, Status: Aktif', '::1', '2026-10-29 12:43:41'),
('2c07397a-6473-4ee6-bf9d-23a87314845b', '54a42c4a-41e4-4d7d-bc0e-dc888a01d8a4', 'Admin', 'Perbarui Akun Pegawai', 'Keuangan (keuangan) - Peran: PIC, Unit: Keuangan, Status: Aktif', '::1', '2026-11-02 10:23:43'),
('2c80363f-9159-41e2-9a9a-0a541bb86d45', 'usr-itjen', 'Itjen', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-27 14:51:04'),
('2d48470f-3a6a-481f-97ac-0791f66fc636', 'usr-dewi', 'PIC', 'Login', 'Sistem Monev SKI', '::1', '2026-10-28 08:58:00'),
('30ca4beb-cd78-412c-9735-c3fb9cb12f74', 'usr-rina', 'Anggota SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-29 12:55:13'),
('3179aab8-f1ac-4e95-bb45-a725e5961e4a', 'usr-pim', 'Pimpinan', 'Login', 'Sistem Monev SKI', '::1', '2026-10-29 12:08:17'),
('32245b27-4153-481c-be79-10882f30b032', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Kembalikan berkas ke PIC', '1 berkas', '::1', '2026-10-28 09:01:29'),
('33538daf-2773-433a-a92c-2a0e8869cc09', 'usr-dewi', 'PIC', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-29 12:45:23'),
('339add7a-145a-4e89-8905-b6801404d7f4', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Ekspor Paket Eviden ZIP', 'Modul: Test', '::1', '2026-10-29 13:57:08'),
('3519c01c-07f8-4884-acc4-de3eabd30ad4', 'usr-dewi', 'PIC', 'Login', 'Sistem Monev SKI', '::1', '2026-10-29 06:17:41'),
('355eac73-37b3-4bde-9290-7eefc6f124b1', 'usr-rina', 'Anggota SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-29 12:07:35'),
('358fc14f-922e-4a93-a741-acd851adcadb', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Upload Template Modul', 'Test (SRS.pdf)', '::1', '2026-10-29 10:22:44'),
('36c98078-7eef-4c1f-b22c-c8b3d7e584c6', 'usr-dewi', 'PIC', 'Login', 'Sistem Monev SKI', '::1', '2026-10-28 09:01:43'),
('36dfcb9e-0049-48ce-9f54-36ee425fbaa3', 'usr-dewi', 'PIC', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-29 12:07:31'),
('3914b575-46b4-4687-bab6-7b244949e9e9', 'usr-dewi', 'PIC', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-28 09:02:02'),
('392ab4f0-525a-4bd3-a27d-6b0a1685d6ff', 'usr-dewi', 'PIC', 'Login', 'Sistem Monev SKI', '::1', '2026-10-29 06:40:33'),
('3b400d56-a064-485e-99c8-660229d5b050', 'usr-dewi', 'PIC', 'Login', 'Sistem Monev SKI', '::1', '2026-11-02 11:41:51'),
('3c155020-e29b-427e-bd7d-96540bd4518b', '54a42c4a-41e4-4d7d-bc0e-dc888a01d8a4', 'Admin', 'Perbarui Profil Akun', 'Pengguna \'Administrator Monev SKI BBPK\' (280505) memperbarui profil akun mandiri', '::1', '2026-10-29 07:52:15'),
('3c56c522-35c1-49f7-9d09-5a7845d2402a', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-28 08:44:51'),
('3cc3bb83-c60a-4600-963b-54a7a685a1fc', '54a42c4a-41e4-4d7d-bc0e-dc888a01d8a4', 'Admin', 'Perbarui Akun Pegawai', 'PIC Kepegawaian (Kepegawaian) - Peran: PIC, Unit: Kepegawaian, Status: Aktif', '::1', '2026-11-02 10:23:51'),
('3ce680b4-9b6f-4ffb-9cd8-aa32f9e25add', 'usr-dewi', 'PIC', 'Login', 'Sistem Monev SKI', '::1', '2026-10-29 11:56:43'),
('3d9807dc-34d8-42c7-a221-f32bc0f964fb', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-29 12:21:43'),
('3f296d1f-e573-4fe8-a6a4-bc814e6d3342', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-28 09:01:36'),
('3fa03763-2933-45b6-9f2a-12ad19724d3b', 'usr-dewi', 'PIC', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-11-02 11:14:10'),
('41994475-2266-46e0-9f8c-7b135ba54467', '54a42c4a-41e4-4d7d-bc0e-dc888a01d8a4', 'Admin', 'Login', 'Sistem Monev SKI', '::1', '2026-10-27 11:48:18'),
('43aa6f7b-18d2-4142-9667-262a9a4558f1', 'usr-pim', 'Pimpinan', 'Login', 'Sistem Monev SKI', '::1', '2026-10-29 12:55:59'),
('44f939e7-6851-49da-bfca-f2bf01fa5eef', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-29 12:55:56'),
('46e5387b-e2f9-4359-bc45-a463e6775134', 'usr-dewi', 'PIC', 'Login', 'Sistem Monev SKI', '::1', '2026-10-29 12:43:53'),
('4794eee0-fc3b-4965-b5af-7348803b3422', 'usr-dewi', 'PIC', 'Login', 'Sistem Monev SKI', '::1', '2026-10-29 12:28:08'),
('484c3a32-366f-4b62-af88-d7d3935205ce', 'usr-dewi', 'PIC', 'Login', 'Sistem Monev SKI', '::1', '2026-10-29 12:55:16'),
('4910a402-763c-4095-aa8a-41be719f2a6a', 'usr-dewi', 'PIC', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-29 10:02:04'),
('49bba248-7b12-44d2-8081-9cc315e306c5', 'usr-dewi', 'PIC', 'Login', 'Sistem Monev SKI', '::1', '2026-10-29 10:01:53'),
('4a81e469-c99d-49b5-8b78-7630b65413ca', 'usr-dewi', 'PIC', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-11-02 12:30:52'),
('4acf8d7e-b546-42b0-917a-f33229736ce9', 'usr-rina', 'Anggota SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-28 08:59:54'),
('4cf46804-34fc-43cb-83c5-c984cf39d4f7', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-29 07:59:50'),
('4db2d604-8a02-4e97-b305-b9471a72b793', 'usr-rina', 'Anggota SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-27 12:11:04'),
('5072c461-6a7e-4a75-bdde-5157e7d5a905', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua Tim SKI', 'Ekspor Modul Akhir GForm Itjen', 'Modul: Test UI', '127.0.0.1', '2026-10-29 13:27:28'),
('50e48ef8-3596-48b0-9092-e2b192a80c2f', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-11-04 16:39:51'),
('51091b96-29f8-4552-a10b-e6bec6736bc9', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-29 06:50:35'),
('5199ccaa-f761-4f99-a797-64453f1d36fd', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-11-04 14:59:13'),
('519b81bd-4170-49c1-b1bd-aee9c14447cb', 'usr-dewi', 'PIC', 'Login', 'Sistem Monev SKI', '::1', '2026-10-29 12:41:40'),
('51eb3e47-4849-410b-ba0d-3b127be741a8', 'usr-dewi', 'PIC', 'Hapus berkas eviden', 'SRS.pdf', '::1', '2026-10-29 11:58:52'),
('5213c551-c4ed-4310-b236-a982bec77425', 'usr-dewi', 'PIC', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-27 12:09:27'),
('523d108a-7f84-4fb6-8de1-a9afcdd206f5', 'usr-rina', 'Anggota SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-11-06 17:01:37'),
('52cf5e5b-eee1-45b1-a975-beddb42801bf', 'usr-rina', 'Anggota SKI', 'Kirim hasil review SKI', '1 butir eviden dievaluasi', '::1', '2026-11-04 16:39:45'),
('5426140b-618c-46a2-a52d-050426ed5415', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Tambah Indikator Modul', 'Modul: mod-73956774 - Test [Tipe: file]', '::1', '2026-10-27 12:10:52'),
('562a2a01-e83d-43a7-9f4a-b90ee2c21412', '54a42c4a-41e4-4d7d-bc0e-dc888a01d8a4', 'Admin', 'Perbarui Akun Pegawai', 'Jinji (6969) - Peran: Ketua SKI, Unit: Internal SKI / Pimpinan, Status: Aktif', '::1', '2026-10-28 08:50:02'),
('564912ec-8256-4eaf-97f9-1ddd0e0e01a5', 'usr-dewi', 'PIC', 'Upload perbaikan tautan eviden', 'Rama Kaki Patah (v4)', '::1', '2026-10-29 12:45:21'),
('5aaced8d-65c4-407b-9d73-04e33bdaa600', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Terbitkan Jadwal Pengawasan', 'Oktober 2026 (2 modul)', '::1', '2026-10-29 12:21:12'),
('5b51c46b-b3ca-47ae-b61b-33890c4e0da2', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Terbitkan Jadwal Pengawasan', 'Oktober 2026 (1 modul)', '::1', '2026-10-29 12:21:19'),
('5b7beca2-b60a-44d3-8710-db7c7b4fd53e', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Terbitkan Jadwal Pengawasan', 'Oktober 2026 (3 modul)', '::1', '2026-10-29 12:21:09'),
('5c6feee2-7e6f-4e46-a15f-6b8af3afae70', '54a42c4a-41e4-4d7d-bc0e-dc888a01d8a4', 'Admin', 'Login', 'Sistem Monev SKI', '::1', '2026-10-27 14:51:08'),
('5cbd35c8-56c3-4556-b01f-f68709bd8588', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua Tim SKI', 'Ekspor Modul Akhir GForm Itjen', 'Modul: Test UI (Format CSV)', '127.0.0.1', '2026-10-29 13:27:51'),
('5cbf7be2-730d-4353-bdea-d4ea8b2a1fd6', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-29 12:17:50'),
('5e913113-1d95-4018-b0b7-843918998e27', 'usr-dewi', 'PIC', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-28 08:59:48'),
('60702aaa-cd67-4b64-bc88-fa55bbc23723', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua Tim SKI', 'Ekspor Paket Eviden ZIP', 'Modul: Test UI', '127.0.0.1', '2026-10-29 13:42:01'),
('60740094-d4b9-4653-a944-92a049fa201c', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-27 12:12:13'),
('6116f4ac-429d-4fdf-8478-4ad5169d6ae7', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-11-04 16:39:12'),
('655a5749-df96-4fb3-8f2c-7d18c78d2eae', 'usr-budi', 'PIC', 'Perbarui Profil Akun', 'Pengguna \'Budi Santoso\' (budi.keu) memperbarui profil akun mandiri (dengan pembaruan kata sandi)', '::1', '2026-10-29 07:52:16'),
('66131298-59a4-44f4-904d-3722fb33fc41', 'usr-budi', 'PIC', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-11-02 11:04:33'),
('66d81547-5ebc-4626-a264-399455c3198e', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-28 08:58:35'),
('671b1b80-13c7-4956-a122-0fb14e9735f2', 'usr-rina', 'Anggota SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-11-09 08:09:05'),
('6828062f-b87d-4d26-b926-ba8666bd7579', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Ubah Modul Pengawasan', 'Test (Status: terbit)', '::1', '2026-10-27 12:09:01'),
('689e60d5-8d97-4b7c-a2d0-6564d34de0e5', 'usr-dewi', 'PIC', 'Upload perbaikan tautan eviden', 'Tautan Google Drive (v2)', '::1', '2026-10-29 12:17:26'),
('6ae5b693-e133-41cc-8c41-fbb9c5116603', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-11-04 14:59:55'),
('6caaa01f-d6e9-4ff6-b3c6-df0b62de5e2f', 'usr-rina', 'Anggota SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-11-04 16:39:27'),
('6e7ec76d-1d54-4005-bafc-925a1ab4f7d2', 'usr-dewi', 'PIC', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-29 12:43:07'),
('6ef4476e-cae2-4ed5-a1cb-50e36f8c5676', 'usr-rina', 'Anggota SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-11-02 08:55:14'),
('704be15c-a2cd-41ff-acbe-6664ed32645a', 'usr-budi', 'PIC', 'Login', 'Sistem Monev SKI', '::1', '2026-11-02 11:04:30'),
('705dbb1c-ca1e-44b7-b0ef-f9b2149144f3', 'usr-rina', 'Anggota SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-11-09 08:09:24'),
('709f4070-03eb-4d4a-854d-3d589f706022', 'usr-agus', 'PIC', 'Login', 'Sistem Monev SKI', '::1', '2026-11-02 11:14:12'),
('71ce1053-8c2b-42a8-9e24-ec370041abca', 'usr-dewi', 'PIC', 'Login', 'Sistem Monev SKI', '::1', '2026-10-29 12:16:55'),
('73aa20d8-d490-4320-9257-5047bcdcc5be', 'usr-dewi', 'PIC', 'Login', 'Sistem Monev SKI', '::1', '2026-10-27 12:09:16'),
('75ce8382-d5cd-4298-8a28-9a51897e39fc', '54a42c4a-41e4-4d7d-bc0e-dc888a01d8a4', 'Admin', 'Perbarui Akun Pegawai', 'Perencanaan (perencanaan) - Peran: PIC, Unit: Perencanaan, Status: Aktif', '::1', '2026-11-02 10:24:33'),
('76be9b16-30b5-42b0-ae42-48c61bd05d5e', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Perbarui Profil Akun', 'Pengguna \'Jinji,S Kom\' (6969) memperbarui profil akun mandiri', '::1', '2026-10-29 07:59:23'),
('76c077e3-d9f2-4ef3-a464-9658bc72e757', 'usr-pim', 'Pimpinan', 'Pimpinan menyetujui berkas eviden', 'Rama Kaki Patah (Test) - Versi 4', '::1', '2026-10-29 12:56:24'),
('789ec41e-e398-4a9f-b85a-6f33b01385cc', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Ubah Modul Pengawasan', 'Test UI (Status: terbit)', '::1', '2026-10-29 06:40:19'),
('7917546a-3650-4b4f-8c4b-f2e17fcaabe2', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Unduh Berkas Eviden', '2024-07-16_-_Internship_Handbook_SY_24_25 -Indonesia Version.pdf', '::1', '2026-11-04 16:41:02'),
('791a3de3-b5a6-4d57-9d8b-52ed98571035', 'usr-pim', 'Pimpinan', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-11-02 12:53:55'),
('79dce4aa-eb07-4c98-86e9-eb10e972b343', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Terbitkan Jadwal Pengawasan', 'Oktober 2026 (1 modul)', '::1', '2026-10-27 12:09:04'),
('79e9645b-9029-4779-91c0-6da99ffd7655', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-29 11:56:40'),
('7abdd9af-c0b2-4403-9a26-8f4fa0e8ab79', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-27 12:10:22'),
('7ec86bc7-46a6-4d36-8e38-3364efb6f262', 'usr-dewi', 'PIC', 'Login', 'Sistem Monev SKI', '::1', '2026-10-27 12:11:19'),
('7f1d1fb1-e48b-4ffe-b6bf-131eef91b46c', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Terbitkan Jadwal Pengawasan', 'Oktober 2026 (2 modul aktif diterbitkan)', '::1', '2026-11-02 12:54:07'),
('7f4a0d29-8272-4f00-948f-8d37c522cbe1', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Ekspor Modul Akhir GForm Itjen', 'Modul: Test', '::1', '2026-10-29 13:58:20'),
('80932ff5-be3e-4960-b409-55104bd0e613', 'usr-dewi', 'PIC', 'Upload tautan eviden baru', 'Tautan Google Drive', '::1', '2026-10-29 12:16:01'),
('81f6570e-b8e3-4e7c-84fe-9b3d5b916a7d', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Terbitkan Jadwal Pengawasan', 'Oktober 2026 (2 modul)', '::1', '2026-10-29 12:21:10'),
('83e5f898-8fd6-4073-a618-851d6cb48425', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-29 06:18:16'),
('84092526-5917-48bd-8418-fc41f9f4dabe', 'usr-rina', 'Anggota SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-11-02 10:22:57'),
('84a74d1d-fa4d-4f44-a91b-fffab4429563', 'usr-rina', 'Anggota SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-29 12:16:44'),
('853fbc1b-3a65-4995-a85a-bcca8de55b96', 'usr-dewi', 'PIC', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-29 12:55:32'),
('85504a80-04d7-4916-b599-e10c996a4a9f', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Ekspor Modul Akhir GForm Itjen', 'Modul: Test', '::1', '2026-10-29 13:29:36'),
('87af776e-bd04-4da3-9c2b-ab82cb75633c', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Tambah Modul Pengawasan', 'Test 2', '::1', '2026-10-27 12:10:34'),
('88773d4e-6d98-4136-b2ef-5e654118398f', 'usr-rina', 'Anggota SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-27 14:50:51'),
('89430f0a-d02b-43c8-a3e9-cccaf2003e5a', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-11-02 12:31:07'),
('8983f23a-1c8e-407f-b1d6-38b02d74a8f5', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Terbitkan Jadwal Pengawasan', 'Oktober 2026 (3 modul)', '::1', '2026-10-29 12:21:02'),
('8be4fc7b-a25a-4922-9655-b57b3a78004b', 'usr-pim', 'Pimpinan', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-11-02 10:22:39'),
('8bf528ba-3443-4661-9c25-43f439e6dc5d', 'usr-rina', 'Anggota SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-11-04 14:57:56'),
('8d6470b5-8003-42eb-8bea-598da7b35009', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Terbitkan Jadwal Pengawasan', 'Oktober 2026 (2 modul)', '::1', '2026-10-27 12:11:14'),
('8d8ca9bc-1dc6-42d0-8731-6a24ed6d9739', 'usr-dewi', 'PIC', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-29 12:20:43'),
('8dce41a5-cd56-4db4-b90a-6d0c9c53c02f', 'usr-rina', 'Anggota SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-11-04 14:58:02'),
('8dd11d8e-f237-462a-ad1d-d716bd071340', '54a42c4a-41e4-4d7d-bc0e-dc888a01d8a4', 'Admin', 'Perubahan RBAC Granular', 'Role: adm, Menu: dash, Aksi: u -> 1', '::1', '2026-11-02 10:25:02'),
('8e210b6a-57ec-4d10-a3c9-7cb2d0f948a1', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Terbitkan Jadwal Pengawasan', 'Oktober 2026 (1 modul aktif diterbitkan)', '::1', '2026-11-02 12:54:10'),
('8eb00b77-3678-41cb-be8f-70da80073e9a', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-29 07:02:44'),
('8ec2663f-4324-46e2-a9dd-bf9f8ffa329e', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Tambah Modul Pengawasan', 'Test', '::1', '2026-10-27 12:08:57'),
('8f674741-d6ed-4b1a-9949-88ace02d3397', 'usr-budi', 'PIC', 'Login', 'Sistem Monev SKI', '::1', '2026-10-29 07:52:16'),
('9602cf4d-e7e4-43b4-815b-3081684dd7c9', 'usr-dewi', 'PIC', 'Upload eviden baru', 'SRS (1) Newest 27 Okt.pdf', '::1', '2026-10-28 08:59:42'),
('96ae9700-3617-46cb-bfe1-18e1ff5231da', 'usr-budi', 'PIC', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-11-02 12:49:34'),
('995f70ab-0a92-49cb-b104-da1ab528ab10', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-11-04 16:36:18'),
('996655b1-84e3-4b2c-b700-90939a5a7b7d', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-29 10:27:26'),
('9a344940-a39c-4bf6-ba29-b4c067a0e1b4', 'usr-rina', 'Anggota SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-28 09:03:20'),
('9a74bc0b-7d0b-4ec7-ac20-5ce4bea03a4d', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-28 08:58:13'),
('9ac2b841-a745-4721-b037-12d207310e75', '54a42c4a-41e4-4d7d-bc0e-dc888a01d8a4', 'Admin', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-11-02 11:04:27'),
('9b29e57d-415b-47b6-abe3-c8ddd752d778', 'usr-dewi', 'PIC', 'Login', 'Sistem Monev SKI', '::1', '2026-11-02 11:20:09'),
('9ceee76a-5eba-438f-a10a-18db06c7cf21', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-27 11:47:40'),
('9d1bfb4c-8973-4c36-9056-1a6fa2227f20', 'usr-pim', 'Pimpinan', 'Login', 'Sistem Monev SKI', '::1', '2026-11-02 10:22:38'),
('9d3a273e-1a8c-4e3a-93a4-d13237c9ab56', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-28 08:50:29'),
('9d91c516-5526-4fa8-8703-6f737e7a8a94', '54a42c4a-41e4-4d7d-bc0e-dc888a01d8a4', 'Admin', 'Perubahan RBAC Granular', 'Role: adm, Menu: dash, Aksi: l -> 1', '::1', '2026-11-02 10:25:00'),
('9dabb316-a24c-4944-bcd1-1f2de781dcbf', '54a42c4a-41e4-4d7d-bc0e-dc888a01d8a4', 'Admin', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-28 08:44:46'),
('9e118247-fb63-4de8-853d-73dd3a508409', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-27 12:09:31'),
('9e1acb95-6ff7-4fad-a100-41b1f352084a', '54a42c4a-41e4-4d7d-bc0e-dc888a01d8a4', 'Admin', 'Perbarui Profil Akun', 'Pengguna \'sijempol\' (280505) memperbarui profil akun mandiri', '::1', '2026-10-29 07:52:15'),
('9ef28007-64fa-4e7d-a60c-bfd98b10d15c', '54a42c4a-41e4-4d7d-bc0e-dc888a01d8a4', 'Admin', 'Login', 'Sistem Monev SKI', '::1', '2026-10-29 07:59:53'),
('9fc206f2-95ff-4141-9dd3-681b3386ea7d', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-11-02 11:41:48'),
('9ff0ce94-ec2a-4fc1-9f4c-9b4435514884', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-29 07:00:55'),
('a09823b1-61c7-45fe-a342-e6ee7ed92dbf', 'usr-rina', 'Anggota SKI', 'Kirim hasil review SKI', '1 butir eviden dievaluasi', '::1', '2026-10-28 09:01:06'),
('a1eb3529-16d0-46af-a4dc-03a850458f3b', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-11-02 12:49:19'),
('a20a8706-0d7f-47d9-a333-d49530dbc792', '54a42c4a-41e4-4d7d-bc0e-dc888a01d8a4', 'Admin', 'Perubahan RBAC Granular', 'Role: adm, Menu: dash, Aksi: d -> 1', '::1', '2026-11-02 10:25:06'),
('a410cc66-5708-4296-8613-422689a5406d', 'usr-rina', 'Anggota SKI', 'Ubah Modul Pengawasan', 'Test 2 (Status: terbit)', '::1', '2026-10-27 12:11:02'),
('a633c864-fecf-4b99-a14e-b4d27f64768a', 'usr-budi', 'PIC', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-28 08:58:46'),
('a698e023-fef5-4f40-8c08-4e067eb62a0f', 'usr-budi', 'PIC', 'Login', 'Sistem Monev SKI', '::1', '2026-11-02 12:49:23'),
('a7110750-df19-4867-a04c-146a24f064a9', 'usr-dewi', 'PIC', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-29 07:02:40'),
('a718bf4e-a806-480b-bc96-2160321e9821', 'usr-rina', 'Anggota SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-11-04 14:57:53'),
('a7e4a1e3-d926-4e72-b94f-8fd5949b7f64', '54a42c4a-41e4-4d7d-bc0e-dc888a01d8a4', 'Admin', 'Perbarui Akun Pegawai', 'PIC Kepegawaian (kepegawaian) - Peran: PIC, Unit: Kepegawaian, Status: Aktif', '::1', '2026-11-02 10:23:59'),
('a8738b6f-91ef-4553-b775-00dea115c0a1', '54a42c4a-41e4-4d7d-bc0e-dc888a01d8a4', 'Admin', 'Login', 'Sistem Monev SKI', '::1', '2026-10-29 07:54:13'),
('a90b4918-a0b0-493d-876f-9486aa191f03', 'usr-rina', 'Anggota SKI', 'Kirim hasil review SKI', '1 butir eviden dievaluasi', '::1', '2026-10-29 12:55:12'),
('a9ab1147-a17b-45c2-9141-dbb7710fb00d', 'usr-dewi', 'PIC', 'Login', 'Sistem Monev SKI', '::1', '2026-10-29 11:45:38'),
('a9d1c3e1-7364-42bf-a7cd-e5a1f07c0aa0', '54a42c4a-41e4-4d7d-bc0e-dc888a01d8a4', 'Admin', 'Perbarui Profil Akun', 'Pengguna \'sijempol\' (admin.super) memperbarui profil akun mandiri', '::1', '2026-10-29 07:52:45'),
('a9fd567c-a8cc-4222-a5af-ca78e7dff9f7', '54a42c4a-41e4-4d7d-bc0e-dc888a01d8a4', 'Admin', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-29 08:43:00'),
('aa40c1ae-f214-45e0-9dae-5ba2873224b0', '54a42c4a-41e4-4d7d-bc0e-dc888a01d8a4', 'Admin', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-28 08:50:05'),
('ac374a99-4931-4f9f-8965-dcd7efdb82e9', '54a42c4a-41e4-4d7d-bc0e-dc888a01d8a4', 'Admin', 'Hapus Modul Pengawasan', 'Modul: Test (ID: mod-3369a41a)', '::1', '2026-10-27 11:48:44'),
('ad588d56-560b-41f1-8169-6c8cc3740a21', 'usr-dewi', 'PIC', 'Upload eviden baru', '2024-07-16_-_Internship_Handbook_SY_24_25 -Indonesia Version.pdf', '::1', '2026-11-04 16:37:31'),
('aeb274cf-6233-4235-8af9-76771ce91f85', 'usr-pim', 'Pimpinan', 'Login', 'Sistem Monev SKI', '::1', '2026-11-04 16:40:13'),
('aee06d14-0fcf-410c-bcc1-3f5aa5080e13', 'usr-dewi', 'PIC', 'Login', 'Sistem Monev SKI', '::1', '2026-10-29 12:21:22'),
('b086a05f-ca29-46e4-9597-fc5962f7f03b', 'usr-dewi', 'PIC', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-29 06:18:12'),
('b1ed1f99-4509-4baa-b370-a80378e15d35', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-29 08:44:11'),
('b2d24f9c-4feb-4e16-a6da-7926f0a45f35', '54a42c4a-41e4-4d7d-bc0e-dc888a01d8a4', 'Admin', 'Perbarui Akun Pegawai', 'Anggota SKI (anggota) - Peran: Anggota SKI, Unit: Internal SKI / Pimpinan, Status: Aktif', '::1', '2026-11-02 10:23:25'),
('b408f867-25d0-47fc-b16c-6cc051e2fcc7', 'usr-dewi', 'PIC', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-11-02 11:35:19'),
('b513aad2-b7b4-4027-943a-b6404f86aa3a', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Terbitkan Jadwal Pengawasan', 'Oktober 2026 (3 modul)', '::1', '2026-10-29 06:40:22'),
('b5e17396-21a0-4cef-b62b-d082e1dffe30', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Ekspor Paket Eviden ZIP', 'Modul: Test', '::1', '2026-11-02 08:58:28'),
('b73b9109-4d0f-4891-9f4e-b89093203a89', '54a42c4a-41e4-4d7d-bc0e-dc888a01d8a4', 'Admin', 'Perubahan RBAC Granular', 'Role: adm, Menu: dash, Aksi: t -> 1', '::1', '2026-11-02 10:25:03'),
('b76d6992-8197-498b-bdae-414b3b5b1c8a', 'usr-rina', 'Anggota SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-28 09:01:08'),
('b7fe28c7-8f6c-4f33-ad02-7d3c0ae7c695', 'usr-dewi', 'PIC', 'Login', 'Sistem Monev SKI', '::1', '2026-11-04 16:36:23'),
('b94eb54b-de5a-40b3-930b-4b3aba6efe7c', '54a42c4a-41e4-4d7d-bc0e-dc888a01d8a4', 'Admin', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-29 12:43:44'),
('bb9e6746-a644-4b02-a129-7085694445a2', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-29 12:28:03'),
('bc1db44c-7042-470b-9b63-66799b6fba99', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-11-02 11:35:22'),
('bcda08ba-61eb-4f55-9191-c28fa138440e', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-27 12:09:56'),
('bd429bb2-64f6-46e5-bc74-37f90bcc58cd', 'usr-dewi', 'PIC', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-11-04 16:37:39'),
('bdcddfbf-d1ed-48e8-bb40-e1223f616b5f', 'usr-dewi', 'PIC', 'Upload perbaikan eviden', 'SRS.pdf (v2)', '::1', '2026-10-29 06:18:07'),
('bef6be9e-f4b2-49c7-8310-6ed6ca22901c', 'usr-budi', 'PIC', 'Perbarui Profil Akun', 'Pengguna \'Budi Santoso, S.E., M.Ak.\' (budi.keu) memperbarui profil akun mandiri', '::1', '2026-10-29 07:52:16'),
('befb5826-8b7f-4848-bc1e-f8ff9a52f616', 'usr-dewi', 'PIC', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-27 12:10:18'),
('bf139b36-b9df-4574-b58d-486334b17b98', 'usr-rina', 'Anggota SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-28 09:02:31'),
('c01442c5-1e0f-4dff-b219-6203ce5c5bea', 'usr-rina', 'Anggota SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-11-04 14:58:44'),
('c1aa3b17-0daa-482d-880f-2cb6c47487c5', 'usr-rina', 'Anggota SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-27 14:50:14'),
('c2a72aff-d05e-47a7-b5fc-ca340f6ecd10', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-29 11:45:34'),
('c3694810-1b24-435e-8b77-5e711f0eff74', 'usr-agus', 'PIC', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-11-02 11:14:18'),
('c5949e57-21c8-4e93-839a-043922523af4', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-29 10:27:40'),
('c6d40d78-b54d-4263-a1f2-fed4eb681abe', 'usr-budi', 'PIC', 'Login', 'Sistem Monev SKI', '::1', '2026-10-29 08:43:03'),
('c7bbc335-0d8b-4fde-b4f4-fffb85b06a90', '54a42c4a-41e4-4d7d-bc0e-dc888a01d8a4', 'Admin', 'Terbitkan Jadwal Pengawasan', 'Oktober 2026 (3 modul)', '::1', '2026-11-02 10:40:15'),
('ca090e31-2c67-491b-aa78-ef0d65dfb144', 'usr-rina', 'Anggota SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-11-04 16:37:41'),
('cbeae67e-73fb-46f7-a916-c195586e84ec', 'usr-rina', 'Anggota SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-11-02 10:22:42'),
('ced55485-378f-456a-b9e7-f8a71263f501', 'usr-dewi', 'PIC', 'Perbarui Profil Akun', 'Pengguna \'PIC Kepegawaian\' (dewi.peg) memperbarui profil akun mandiri', '::1', '2026-10-29 12:43:04'),
('cf47fd9a-ab0f-409e-a2ce-c35659531a6f', 'usr-rina', 'Anggota SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-29 12:08:14'),
('cf54e2cd-2683-4593-9c77-19dcae265682', '54a42c4a-41e4-4d7d-bc0e-dc888a01d8a4', 'Admin', 'Login', 'Sistem Monev SKI', '::1', '2026-11-02 10:22:59'),
('cf934232-d356-4196-b8e1-2e56477d66f7', 'usr-dewi', 'PIC', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-11-04 16:39:07'),
('d23aaac7-7a4b-4b44-9d3d-e59594a05b29', 'usr-rina', 'Anggota SKI', 'Perbarui Profil Akun', 'Pengguna \'Anggota SKI\' (rina.ski) memperbarui profil akun mandiri', '::1', '2026-11-02 10:22:51'),
('d634a5e1-87bf-4360-ae17-5ffe3ca3dd2c', 'usr-itjen', 'Itjen', 'Login', 'Sistem Monev SKI', '::1', '2026-10-27 14:50:55'),
('d6c2f178-ea3d-4122-8486-9cfb87ae76e9', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-29 10:02:09'),
('d6df66ed-59a5-4934-b254-34281da1e204', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-11-04 16:31:38'),
('d721c129-a84b-475f-8630-be172ed9d6a6', 'usr-dewi', 'PIC', 'Login', 'Sistem Monev SKI', '::1', '2026-11-04 16:38:22'),
('d7a82356-82a4-4c8c-807d-9d3c6d8e219c', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-11-02 08:55:16'),
('d81b7e28-1db5-4540-9d58-93c645cf7f48', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-11-04 15:00:04'),
('d8a812ca-86f7-4445-a5ef-87f942f45fea', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-28 09:03:25'),
('da583b4e-2263-43fc-9f73-65269cb4ca28', 'usr-dewi', 'PIC', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-29 06:50:26'),
('dce1a257-22d2-4400-ae4f-6b80c09af247', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Terbitkan Jadwal Pengawasan', 'Oktober 2026 (2 modul)', '::1', '2026-11-02 12:44:32'),
('dea5f3dd-bd5f-4cf0-bc95-9ecb987401e6', 'usr-rina', 'Anggota SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-11-06 17:02:35'),
('dede5dbe-3250-413b-87e9-228eafc24e98', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-11-04 16:39:23'),
('e0d74ff6-0987-40d4-8968-b09829ee1322', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-29 08:48:12'),
('e1d7cd0b-5814-4f4c-8111-fc03c3865e30', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-29 12:20:32'),
('e1d8023b-ccef-43f8-977a-5afcb9a289cb', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-29 12:20:48'),
('e303c967-776b-4afa-ab7e-230b61269341', 'usr-dewi', 'PIC', 'Login', 'Sistem Monev SKI', '::1', '2026-10-28 08:58:54'),
('e3ae677d-f75b-4a3c-a728-dab548a607b8', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-28 08:49:16'),
('e3b44808-78ce-4377-b67f-ff2958a93a08', 'usr-pim', 'Pimpinan', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-29 12:56:30'),
('e6534712-c538-4d10-aa6b-98ef3b16865e', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Approval berkas Ketua SKI', '1 berkas disetujui', '::1', '2026-10-29 12:55:54'),
('e65ac239-ba77-4842-998c-fcc7db86f7d7', 'usr-dewi', 'PIC', 'Login', 'Sistem Monev SKI', '::1', '2026-10-27 12:10:00'),
('e66d88c3-90fe-4161-b0da-c5f88ec151f8', 'usr-rina', 'Anggota SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-11-04 14:59:05'),
('e692675a-177e-45c7-9510-0183a44d75ea', 'usr-rina', 'Anggota SKI', 'Kirim hasil review SKI', '1 butir eviden dievaluasi', '::1', '2026-10-29 12:16:42'),
('e9db25c1-1068-43c4-a5b9-f20d03133929', '54a42c4a-41e4-4d7d-bc0e-dc888a01d8a4', 'Admin', 'Perubahan RBAC Granular', 'Role: adm, Menu: dash, Aksi: h -> 1', '::1', '2026-11-02 10:25:05'),
('ea192127-9da5-4b3d-b222-952c961a5e24', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-27 12:09:13'),
('ec3fadd5-bc67-48f1-95ef-a2c17fa3f9fe', '54a42c4a-41e4-4d7d-bc0e-dc888a01d8a4', 'Admin', 'Login', 'Sistem Monev SKI', '::1', '2026-10-28 08:49:20'),
('eccc3ecf-df8f-4d25-8682-9f9ed3e072f1', '54a42c4a-41e4-4d7d-bc0e-dc888a01d8a4', 'Admin', 'Login', 'Sistem Monev SKI', '::1', '2026-10-29 07:52:15'),
('ecd0a80a-5599-4782-8274-417e2350f85c', 'usr-dewi', 'PIC', 'Upload perbaikan eviden', '2024-07-16_-_Internship_Handbook_SY_24_25 -Indonesia Version.pdf (v2)', '::1', '2026-11-04 16:39:04'),
('ede80f94-1bc6-487e-bf67-fa16b1a6d006', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Tambah Modul Pengawasan', 'Test UI', '::1', '2026-10-29 06:40:13'),
('ef593025-f314-4b5b-afdc-52b1f5ff21f2', 'usr-rina', 'Anggota SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-29 12:54:52'),
('f0c49b4d-028a-475a-a576-a75f26c82038', '54a42c4a-41e4-4d7d-bc0e-dc888a01d8a4', 'Admin', 'Perbarui Akun Pegawai', 'Agus Prayitno (perencanaan) - Peran: PIC, Unit: Perencanaan, Status: Aktif', '::1', '2026-11-02 10:24:15'),
('f2355ec4-2a1e-43a5-b44e-78c8a2110763', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Perbarui Profil Akun', 'Pengguna \'Ketua SKI\' (6969) memperbarui profil akun mandiri', '::1', '2026-11-02 10:22:32'),
('f3f19c24-5d03-4744-ad1a-2ad3f33f2f9d', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-28 08:54:06'),
('f5aa58d2-436c-4ac2-840c-07fa131aa1ea', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Terbitkan Jadwal Pengawasan', 'Oktober 2026 (2 modul)', '::1', '2026-11-02 12:31:16'),
('f5cd3350-7a15-458f-9741-039b9b594e15', 'usr-dewi', 'PIC', 'Upload perbaikan tautan eviden', 'Tautan Google Drive (v3)', '::1', '2026-10-29 12:45:03'),
('f67ee752-d37c-4f2c-9efe-f2b887a1610e', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Terbitkan Jadwal Pengawasan', 'Oktober 2026 (2 modul aktif diterbitkan)', '::1', '2026-11-02 12:54:13'),
('f6fa0f18-b1d5-4801-a753-a464eb6789a9', 'usr-pim', 'Pimpinan', 'Login', 'Sistem Monev SKI', '::1', '2026-11-02 12:49:37'),
('f7e611ab-a4f1-4c50-b6be-939acabcde58', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-11-04 16:40:45'),
('f7f3db9d-58fe-4734-bf4c-6ed080a25fcb', 'usr-dewi', 'PIC', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-29 12:21:36'),
('f821e052-97bc-414f-9ac3-306b3322d584', 'usr-budi', 'PIC', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-29 08:44:07'),
('f8655c2d-cc39-448f-ab2b-705b4cec405e', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Ekspor Modul Akhir GForm Itjen', 'Modul: Test', '::1', '2026-10-29 13:56:34'),
('faa8b87e-6b93-456f-9d36-334d8b5f07ce', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-29 12:55:38'),
('fbb37f7a-db4e-45eb-b053-2756a4c7a2a7', 'usr-pim', 'Pimpinan', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-11-04 16:40:41'),
('fc439bfa-9e94-44a2-8631-e5e07c5c23c5', '54a42c4a-41e4-4d7d-bc0e-dc888a01d8a4', 'Admin', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-27 12:08:47'),
('fc5f86f9-970c-4186-9847-80c2ae801c8a', '54a42c4a-41e4-4d7d-bc0e-dc888a01d8a4', 'Admin', 'Hapus Modul Pengawasan', 'Modul: Modul Uji Coba Hapus (ID: mod-test-ca61f0)', '::1', '2026-10-27 11:48:40'),
('fda0ab6f-b179-4868-b919-e49b3a26e610', 'usr-dewi', 'PIC', 'Login', 'Sistem Monev SKI', '::1', '2026-10-29 12:20:35'),
('fdf0129e-cbd2-4650-98dc-e2f4ac996413', '54a42c4a-41e4-4d7d-bc0e-dc888a01d8a4', 'Admin', 'Login', 'Sistem Monev SKI', '::1', '2026-10-29 12:43:09'),
('fe602ce2-7595-4d72-b4e3-64404f3d6407', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Terbitkan Jadwal Pengawasan', 'Oktober 2026 (3 modul)', '::1', '2026-10-29 12:20:27'),
('fe885615-5fde-4b4d-943b-5b9fc206a326', 'usr-rina', 'Anggota SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-11-04 16:38:17'),
('fec91550-1918-40dd-ae47-b1300db196a2', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-27 12:11:15');

-- --------------------------------------------------------

--
-- Table structure for table `evidens`
--

CREATE TABLE `evidens` (
  `id_eviden` varchar(36) NOT NULL,
  `id_jadwal` varchar(36) NOT NULL,
  `id_indikator` varchar(36) NOT NULL,
  `id_user_pic` varchar(36) NOT NULL,
  `nama_file` varchar(255) NOT NULL,
  `path_file` text NOT NULL,
  `ukuran_file_mb` decimal(6,2) NOT NULL,
  `format_file` varchar(30) NOT NULL,
  `versi` int(11) NOT NULL DEFAULT 1,
  `status_eviden` varchar(30) NOT NULL DEFAULT 'u',
  `waktu_unggah` datetime NOT NULL DEFAULT current_timestamp(),
  `nilai_isian` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `evidens`
--

INSERT INTO `evidens` (`id_eviden`, `id_jadwal`, `id_indikator`, `id_user_pic`, `nama_file`, `path_file`, `ukuran_file_mb`, `format_file`, `versi`, `status_eviden`, `waktu_unggah`, `nilai_isian`) VALUES
('52c10bcc-40da-4ee6-bff8-9b0c3815733d', 'jdw-35f4e8694259', 'e574a9aa-bc6d-4070-bd05-92d6e0a9d6ee', 'usr-dewi', 'Rama Kaki Patah', 'https://drive.google.com/drive/folders/17UYNZCjRei1T9VerFf1R5TQ0osCHeNVt', 0.00, 'gdrive', 4, 'f', '2026-10-29 12:45:21', NULL),
('ebdb2e6d-258b-4586-abea-91d24f93441f', 'jdw-0f19017146db', 'a6c3746d-664a-472d-92bf-6d602ec1a7dc', 'usr-dewi', '2024-07-16_-_Internship_Handbook_SY_24_25 -Indonesia Version.pdf', 'uploads/evidens/1793785144_2024-07-16_-_Internship_Handbook_SY_24_25_-Indonesia_Version.pdf', 0.89, 'pdf', 2, 'f', '2026-11-04 16:39:04', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `indicators`
--

CREATE TABLE `indicators` (
  `id` varchar(36) NOT NULL,
  `module_id` varchar(36) NOT NULL,
  `indicator_text` text NOT NULL,
  `input_type` enum('file','binary_score','numeric','risk_scale','pbj_matrix') DEFAULT 'file',
  `guide_notes` varchar(255) DEFAULT NULL,
  `is_mandatory` tinyint(1) DEFAULT 1,
  `nomor_urut` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `indicators`
--

INSERT INTO `indicators` (`id`, `module_id`, `indicator_text`, `input_type`, `guide_notes`, `is_mandatory`, `nomor_urut`) VALUES
('488eaa20-aa5e-4a0b-9e71-895b0455b8bf', 'mod-da0e35e4', 'test 2', 'file', 'Unggah berkas eviden yang sah sesuai format juknis.', 1, 2),
('5b931095-2165-48d8-a3aa-a12bec78b124', 'mod-f268e5a9', 'Pembelian Inventaris Bulan Oktober', 'file', 'Unggah berkas eviden yang sah sesuai format juknis.', 1, 2),
('a2e4d1c1-8546-4e68-9f67-774067c633f7', 'mod-da0e35e4', 'test 1', 'file', 'Unggah berkas eviden yang sah sesuai format juknis.', 1, 1),
('a6c3746d-664a-472d-92bf-6d602ec1a7dc', 'mod-73956774', 'Test', 'file', NULL, 1, 1),
('e574a9aa-bc6d-4070-bd05-92d6e0a9d6ee', 'mod-c3f6991a', 'Test', 'file', NULL, 1, 1),
('e7113d79-4c55-4720-8b13-081da1dff88d', 'mod-f268e5a9', 'Kerusakan Barang Bulan Oktober', 'file', 'Unggah berkas eviden yang sah sesuai format juknis.', 1, 1),
('f6ccfc0b-3342-42d1-9cf5-ff27e118c63e', 'mod-da0e35e4', 'test 3', 'file', 'Unggah berkas eviden yang sah sesuai format juknis.', 1, 3),
('ind-anggaran-1', 'mod-anggaran', 'Kertas Kerja Penelaahan (KPL) Usulan Pagu RKAKL', 'file', 'Masukkan angka kuantitatif / nominal rekapitulasi.', 1, 1),
('ind-anggaran-2', 'mod-anggaran', 'Keselarasan Alokasi Anggaran DIPA terhadap Output Prioritas', 'file', 'Masukkan angka kuantitatif / nominal rekapitulasi.', 1, 2),
('ind-draf-01', 'mod-draf-uji', 'Contoh butir indikator pengujian draf', 'file', 'Panduan draf internal', 1, 1),
('ind-itjen-1', 'mod-itjen', 'Dokumen Surat Atensi (SA) Tindak Lanjut Temuan Itjen', 'file', 'Unggah berkas PDF Surat Auditor (SA) / Evaluasi Hasil Reviu (EHR).', 1, 1),
('ind-itjen-2', 'mod-itjen', 'Dokumen Evaluasi Hasil Review (EHR) Kepatuhan Standar Itjen', 'file', 'Unggah berkas PDF Surat Auditor (SA) / Evaluasi Hasil Reviu (EHR).', 1, 2),
('ind-kkr-1', 'mod-kkr', 'Rekonsiliasi & Kelengkapan Laporan Realisasi Anggaran (LRA)', 'file', 'Beri nilai 1 jika butir pengujian terpenuhi, atau 0 jika tidak.', 1, 1),
('ind-kkr-2', 'mod-kkr', 'Rekonsiliasi & Kelengkapan Laporan Operasional (LO)', 'file', 'Beri nilai 1 jika butir pengujian terpenuhi, atau 0 jika tidak.', 1, 2),
('ind-kkr-3', 'mod-kkr', 'Rekonsiliasi & Kelengkapan Laporan Perubahan Ekuitas (LPE)', 'file', 'Beri nilai 1 jika butir pengujian terpenuhi, atau 0 jika tidak.', 1, 3),
('ind-kkr-4', 'mod-kkr', 'Rekonsiliasi Kas, Persediaan, dan Aset Tetap pada Neraca', 'file', 'Beri nilai 1 jika butir pengujian terpenuhi, atau 0 jika tidak.', 1, 4),
('ind-kkr-5', 'mod-kkr', 'Catatan atas Laporan Keuangan (CaLK) & Pengungkapan Transaksi Material', 'file', 'Beri nilai 1 jika butir pengujian terpenuhi, atau 0 jika tidak.', 1, 5),
('ind-lhkpn-1', 'mod-lhkpn', 'Bukti Tanda Terima Pelaporan LHKPN Wajib Lapor BBPK Jakarta', 'file', 'Masukkan angka kuantitatif / nominal rekapitulasi.', 1, 1),
('ind-lhkpn-2', 'mod-lhkpn', 'Bukti Penerimaan Elektronik (BPE) SPT Tahunan Pegawai', 'file', 'Masukkan angka kuantitatif / nominal rekapitulasi.', 1, 2),
('ind-pbj-1', 'mod-pbj', 'Tepat Kualitas (Spesifikasi Teknis & KAK Paket Pengadaan)', 'file', 'Verifikasi 4 aspek kepatuhan: Kualitas, Kuantitas, Harga, dan Waktu.', 1, 1),
('ind-pbj-2', 'mod-pbj', 'Tepat Jumlah (Kesesuaian Volume & BAST Serah Terima)', 'file', 'Verifikasi 4 aspek kepatuhan: Kualitas, Kuantitas, Harga, dan Waktu.', 1, 2),
('ind-pbj-3', 'mod-pbj', 'Tepat Harga (HPS Wajar & Nilai Kontrak Pengadaan)', 'file', 'Verifikasi 4 aspek kepatuhan: Kualitas, Kuantitas, Harga, dan Waktu.', 1, 3),
('ind-pbj-4', 'mod-pbj', 'Tepat Penyedia & Waktu (Kualifikasi Rekanan & Ketepatan Jadwal SPK)', 'file', 'Verifikasi 4 aspek kepatuhan: Kualitas, Kuantitas, Harga, dan Waktu.', 1, 4),
('ind-pipk-1', 'mod-pipk', 'Catatan Hasil Reviu (CHR) Pengendalian Tingkat Entitas', 'file', 'Unggah berkas eviden yang sah sesuai format juknis.', 1, 1),
('ind-pipk-2', 'mod-pipk', 'Catatan Hasil Reviu (CHR) Pengendalian Tingkat Transaksi', 'file', 'Unggah berkas eviden yang sah sesuai format juknis.', 1, 2),
('ind-risiko-1', 'mod-risiko', 'Identifikasi & Profil Risiko Unit Kerja BBPK Jakarta', 'file', 'Unggah berkas eviden yang sah sesuai format juknis.', 1, 1),
('ind-risiko-2', 'mod-risiko', 'Register Risiko & Matriks Laporan Pemantauan Risiko', 'file', 'Unggah berkas eviden yang sah sesuai format juknis.', 1, 2),
('ind-risiko-3', 'mod-risiko', 'Rencana Tindak Pengendalian (RTP) Mitigasi Risiko', 'file', 'Unggah berkas eviden yang sah sesuai format juknis.', 1, 3),
('ind-sakip-1', 'mod-sakip', 'Dokumen Perencanaan Kinerja (Renstra, RKT & Perjanjian Kinerja)', 'file', 'Unggah berkas eviden yang sah sesuai format juknis.', 1, 1),
('ind-sakip-2', 'mod-sakip', 'Pengukuran Capaian Indikator Kinerja Utama (IKU)', 'file', 'Unggah berkas eviden yang sah sesuai format juknis.', 1, 2),
('ind-sakip-3', 'mod-sakip', 'Laporan Kinerja Instansi Pemerintah (LAKIP)', 'file', 'Unggah berkas eviden yang sah sesuai format juknis.', 1, 3),
('ind-sakip-4', 'mod-sakip', 'Evaluasi Akuntabilitas Kinerja Internal BBPK Jakarta', 'file', 'Unggah berkas eviden yang sah sesuai format juknis.', 1, 4),
('ind-upg-1', 'mod-upg', '1A. Regulasi, SK Pembentukan & SOP Unit Pengendali Gratifikasi', 'file', 'Unggah berkas eviden yang sah sesuai format juknis.', 1, 1),
('ind-upg-2', 'mod-upg', '1B. Sosialisasi, Kampanye & Edukasi Budaya Anti Gratifikasi', 'file', 'Unggah berkas eviden yang sah sesuai format juknis.', 1, 2),
('ind-upg-3', 'mod-upg', '1C. Penyampaian Laporan Triwulanan Pengendalian Gratifikasi', 'file', 'Unggah berkas eviden yang sah sesuai format juknis.', 1, 3),
('ind-upg-4', 'mod-upg', '1D. Monitoring, Tindak Lanjut & Rekomendasi KPK / Itjen', 'file', 'Unggah berkas eviden yang sah sesuai format juknis.', 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `indikators`
--

CREATE TABLE `indikators` (
  `id_indikator` varchar(36) NOT NULL,
  `id_modul` varchar(36) NOT NULL,
  `deskripsi_indikator` text NOT NULL,
  `nomor_urut` int(11) NOT NULL DEFAULT 1,
  `input_type` enum('file','binary_score','numeric','risk_scale','pbj_matrix') DEFAULT 'file',
  `guide_notes` varchar(255) DEFAULT NULL,
  `is_mandatory` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `indikators`
--

INSERT INTO `indikators` (`id_indikator`, `id_modul`, `deskripsi_indikator`, `nomor_urut`, `input_type`, `guide_notes`, `is_mandatory`) VALUES
('a6c3746d-664a-472d-92bf-6d602ec1a7dc', 'mod-73956774', 'Test', 1, 'file', NULL, 1),
('e574a9aa-bc6d-4070-bd05-92d6e0a9d6ee', 'mod-c3f6991a', 'Test', 1, 'file', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_moduls`
--

CREATE TABLE `jadwal_moduls` (
  `id_jadwal` varchar(36) NOT NULL,
  `id_periode` varchar(36) NOT NULL,
  `id_modul` varchar(36) NOT NULL,
  `tenggat_unggah` datetime NOT NULL,
  `mulai_penilaian` datetime NOT NULL,
  `is_locked` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jadwal_moduls`
--

INSERT INTO `jadwal_moduls` (`id_jadwal`, `id_periode`, `id_modul`, `tenggat_unggah`, `mulai_penilaian`, `is_locked`) VALUES
('jdw-0a42020824e7', 'per-12e3a1168e', 'mod-184a99b0', '2026-11-10 23:59:59', '2026-11-02 08:00:00', 0),
('jdw-0f19017146db', 'per-12e3a1168e', 'mod-73956774', '2026-11-10 23:59:59', '2026-11-02 08:00:00', 0),
('jdw-35f4e8694259', 'per-12e3a1168e', 'mod-c3f6991a', '2026-11-10 23:59:59', '2026-11-02 08:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `id` varchar(36) NOT NULL,
  `name` varchar(150) NOT NULL,
  `unit_pic` varchar(36) NOT NULL,
  `reference_file` varchar(255) DEFAULT NULL,
  `module_type` enum('checklist','metrics_data','document_verification') DEFAULT 'checklist',
  `status` enum('draf','terbit') DEFAULT 'terbit',
  `scoring_threshold` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `name`, `unit_pic`, `reference_file`, `module_type`, `status`, `scoring_threshold`) VALUES
('mod-anggaran', 'Review Anggaran (RKAKL / DIPA)', 'u-keu', 'Tabel_KPL_Review_Anggaran.xlsx', 'metrics_data', 'draf', NULL),
('mod-da0e35e4', 'Keuangan Bulan Oktober', 'u-ren', '1792037005_Intership_Agreement_-_Ginartriadi_Affandi_Draft.docx', 'checklist', 'draf', NULL),
('mod-draf-uji', 'Modul Uji Coba Internal (Draf SKI)', 'u-keu', 'Draf_Panduan_Uji_Coba.pdf', 'checklist', 'draf', 5.00),
('mod-f268e5a9', 'Keuangan Bulan Oktober', 'u-keu', '1792036991_Intership_Agreement_-_Ginartriadi_Affandi_Draft.docx', 'checklist', 'draf', NULL),
('mod-itjen', 'Format Inspektorat (SA / EHR)', 'u-ren', 'Format_Baku_SA_EHR_Itjen.pdf', 'document_verification', 'draf', NULL),
('mod-kkr', 'KKR Laporan Keuangan (LRA, LO, LPE, Neraca, CaLK)', 'u-keu', 'Form_Bantu_KKR_1_3_LKE.xlsx', 'checklist', 'draf', 8.00),
('mod-lhkpn', 'Kepatuhan LHKPN & SPT', 'u-peg', 'Form_Tanda_Terima_LHKPN_SPT.pdf', 'metrics_data', 'draf', NULL),
('mod-pbj', 'PBJ (Pengadaan Barang & Jasa)', 'u-keu', 'Panduan_4_Aspek_Kepatuhan_PBJ.pdf', 'checklist', 'draf', NULL),
('mod-pipk', 'Pengendalian Intern Pelaporan Keuangan (PIPK)', 'u-keu', 'Format_CHR_PIPK_Kemenkes.pdf', 'document_verification', 'draf', NULL),
('mod-risiko', 'Mitigasi & Manajemen Risiko', 'u-ren', 'Matriks_Pemantauan_Risiko.xlsx', 'checklist', 'draf', NULL),
('mod-sakip', 'SAKIP / Laporan Kinerja', 'u-ren', 'KKE_AKIP_Evaluasi_Kinerja.xlsx', 'checklist', 'draf', NULL),
('mod-upg', 'Unit Pengendali Gratifikasi (UPG)', 'u-peg', 'Instrumen_Checklist_UPG.pdf', 'checklist', 'draf', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `moduls`
--

CREATE TABLE `moduls` (
  `id_modul` varchar(36) NOT NULL,
  `nama_modul` varchar(150) NOT NULL,
  `jenis_template` varchar(30) NOT NULL DEFAULT 'ind',
  `file_referensi` varchar(255) DEFAULT NULL,
  `status_template` varchar(20) NOT NULL DEFAULT 'draf',
  `id_unit_pic` varchar(36) NOT NULL,
  `module_type` enum('checklist','metrics_data','document_verification') DEFAULT 'checklist',
  `status` enum('draf','terbit') DEFAULT 'terbit',
  `scoring_threshold` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `moduls`
--

INSERT INTO `moduls` (`id_modul`, `nama_modul`, `jenis_template`, `file_referensi`, `status_template`, `id_unit_pic`, `module_type`, `status`, `scoring_threshold`) VALUES
('mod-184a99b0', 'Test UI', 'ind', NULL, 'terbit', 'u-peg', 'document_verification', 'terbit', 80.00),
('mod-73956774', 'Test 2', 'ind', NULL, 'terbit', 'u-peg', 'document_verification', 'terbit', 80.00),
('mod-c3f6991a', 'Test', 'ind', '1793244164_SRS.pdf', 'terbit', 'u-peg', 'document_verification', 'terbit', 80.00);

-- --------------------------------------------------------

--
-- Table structure for table `periodes`
--

CREATE TABLE `periodes` (
  `id_periode` varchar(36) NOT NULL,
  `nama_periode` varchar(100) NOT NULL,
  `siklus` varchar(30) NOT NULL,
  `tahun` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `periodes`
--

INSERT INTO `periodes` (`id_periode`, `nama_periode`, `siklus`, `tahun`) VALUES
('per-12e3a1168e', 'Oktober 2026', 'Bulanan', 2026),
('per-2026-10', 'Oktober 2026', 'Bulanan', 2026);

-- --------------------------------------------------------

--
-- Table structure for table `rekomendasi_approvals`
--

CREATE TABLE `rekomendasi_approvals` (
  `id_rekomendasi` varchar(36) NOT NULL,
  `id_jadwal` varchar(36) NOT NULL,
  `id_modul` varchar(36) NOT NULL,
  `id_ketua_ski` varchar(36) NOT NULL,
  `id_pimpinan` varchar(36) DEFAULT NULL,
  `poin_rekomendasi` text NOT NULL,
  `status_approval_ketua` varchar(30) NOT NULL DEFAULT 'Disetujui',
  `is_dilihat_pimpinan` tinyint(1) DEFAULT 0,
  `waktu_dilihat_pimpinan` datetime DEFAULT NULL,
  `keputusan_pimpinan` varchar(30) DEFAULT 'Menunggu',
  `catatan_disposisi` text DEFAULT NULL,
  `waktu_keputusan` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id_review` varchar(36) NOT NULL,
  `id_eviden` varchar(36) NOT NULL,
  `id_user_reviewer` varchar(36) NOT NULL,
  `status_kesesuaian` varchar(20) NOT NULL,
  `catatan_temuan` text DEFAULT NULL,
  `waktu_review` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id_review`, `id_eviden`, `id_user_reviewer`, `status_kesesuaian`, `catatan_temuan`, `waktu_review`) VALUES
('9f36c529-900e-40b2-9095-bf49f4bbf0ce', 'ebdb2e6d-258b-4586-abea-91d24f93441f', 'usr-rina', 'sesuai', 'nmnmnmnm', '2026-11-04 16:39:45'),
('f19c9c4d-82ca-4036-b43e-1958346e6feb', '52c10bcc-40da-4ee6-bff8-9b0c3815733d', 'usr-rina', 'sesuai', 'Kureng Lengkap Mas', '2026-10-29 12:55:12');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id_role` varchar(36) NOT NULL,
  `nama_role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id_role`, `nama_role`) VALUES
('adm', 'Admin'),
('ang', 'Anggota SKI'),
('itj', 'Itjen'),
('ket', 'Ketua SKI'),
('pic', 'PIC'),
('pim', 'Pimpinan');

-- --------------------------------------------------------

--
-- Table structure for table `role_permissions`
--

CREATE TABLE `role_permissions` (
  `id_permission` varchar(36) NOT NULL,
  `id_role` varchar(36) NOT NULL,
  `menu_fitur` varchar(50) NOT NULL,
  `can_view` tinyint(1) DEFAULT 0,
  `can_create` tinyint(1) DEFAULT 0,
  `can_edit` tinyint(1) DEFAULT 0,
  `can_delete` tinyint(1) DEFAULT 0,
  `can_download` tinyint(1) DEFAULT 0,
  `can_approve` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role_permissions`
--

INSERT INTO `role_permissions` (`id_permission`, `id_role`, `menu_fitur`, `can_view`, `can_create`, `can_edit`, `can_delete`, `can_download`, `can_approve`) VALUES
('d566d271-c771-11f1-bc62-a02919692648', 'pic', 'dash', 1, 0, 0, 0, 0, 0),
('d566ec1d-c771-11f1-bc62-a02919692648', 'pic', 'upl', 1, 1, 1, 1, 1, 0),
('d566ecd7-c771-11f1-bc62-a02919692648', 'ang', 'dash', 1, 0, 0, 0, 0, 0),
('d566ed16-c771-11f1-bc62-a02919692648', 'ang', 'mod', 1, 1, 1, 1, 0, 0),
('d566ed4c-c771-11f1-bc62-a02919692648', 'ang', 'rev', 1, 0, 1, 0, 0, 0),
('d566ed87-c771-11f1-bc62-a02919692648', 'ang', 'aud', 1, 0, 0, 0, 0, 0),
('d566ee63-c771-11f1-bc62-a02919692648', 'ket', 'dash', 1, 0, 0, 0, 0, 0),
('d566ee98-c771-11f1-bc62-a02919692648', 'ket', 'mod', 1, 1, 1, 1, 0, 0),
('d566eed0-c771-11f1-bc62-a02919692648', 'ket', 'jdw', 1, 1, 1, 1, 0, 0),
('d566ef03-c771-11f1-bc62-a02919692648', 'ket', 'mon', 1, 0, 0, 0, 1, 0),
('d566ef37-c771-11f1-bc62-a02919692648', 'ket', 'rev', 1, 0, 1, 0, 1, 1),
('d566ef6b-c771-11f1-bc62-a02919692648', 'ket', 'exp', 1, 0, 0, 0, 1, 0),
('d566efa3-c771-11f1-bc62-a02919692648', 'ket', 'aud', 1, 0, 0, 0, 0, 0),
('d566efd3-c771-11f1-bc62-a02919692648', 'pim', 'dash', 1, 0, 0, 0, 0, 0),
('d566f014-c771-11f1-bc62-a02919692648', 'pim', 'apm', 1, 0, 0, 0, 0, 1),
('d566f04d-c771-11f1-bc62-a02919692648', 'pim', 'exp', 1, 0, 0, 0, 1, 0),
('d566f086-c771-11f1-bc62-a02919692648', 'pim', 'aud', 1, 0, 0, 0, 0, 0),
('d566f0c1-c771-11f1-bc62-a02919692648', 'itj', 'dash', 1, 0, 0, 0, 0, 0),
('d566f0f7-c771-11f1-bc62-a02919692648', 'itj', 'rep', 1, 0, 0, 0, 1, 0),
('d566f12a-c771-11f1-bc62-a02919692648', 'itj', 'aud', 1, 0, 0, 0, 0, 0),
('d566f171-c771-11f1-bc62-a02919692648', 'adm', 'jdw', 1, 1, 1, 0, 0, 0),
('d566f1b1-c771-11f1-bc62-a02919692648', 'adm', 'usr', 1, 1, 1, 1, 0, 0),
('d566f1e9-c771-11f1-bc62-a02919692648', 'adm', 'hak', 1, 0, 1, 0, 0, 0),
('d566f21d-c771-11f1-bc62-a02919692648', 'adm', 'aud', 1, 0, 0, 0, 0, 0),
('ee43bb8e-ba7d-46a6-a8ed-62c3da3c3d0d', 'adm', 'dash', 1, 1, 1, 1, 1, 0),
('perm-adm-mod-636ea985', 'adm', 'mod', 1, 1, 1, 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `submissions`
--

CREATE TABLE `submissions` (
  `id` varchar(36) NOT NULL,
  `module_id` varchar(36) NOT NULL,
  `pic_id` varchar(36) DEFAULT NULL,
  `status` varchar(30) DEFAULT 'submitted',
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `submission_items`
--

CREATE TABLE `submission_items` (
  `id` varchar(36) NOT NULL,
  `submission_id` varchar(36) NOT NULL,
  `indicator_id` varchar(36) NOT NULL,
  `value` text DEFAULT NULL,
  `file_path` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id_unit` varchar(36) NOT NULL,
  `nama_unit` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id_unit`, `nama_unit`) VALUES
('u-keu', 'Keuangan'),
('u-peg', 'Kepegawaian'),
('u-ren', 'Perencanaan');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` varchar(36) NOT NULL,
  `nip_username` varchar(50) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `nama_lengkap` varchar(150) NOT NULL,
  `id_role` varchar(36) NOT NULL,
  `id_unit` varchar(36) DEFAULT NULL,
  `status_aktif` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `nip_username`, `password_hash`, `nama_lengkap`, `id_role`, `id_unit`, `status_aktif`) VALUES
('54a42c4a-41e4-4d7d-bc0e-dc888a01d8a4', 'sijempol', '$2y$10$Y5h6yFO.zoA6rNqIO85lUuSv9YT7xGtycg5QPLX1v/k400PvSJX.G', 'sijempol', 'adm', NULL, 1),
('5b7c2010-86a6-44c3-986a-ac0809c0d535', '6969', '$2y$10$SCrXrXkagSMmtpXwKc5AjuO9KmpCCd5rtU8P5lw6QpRwaRGVl.C5q', 'Ketua SKI', 'ket', NULL, 1),
('usr-admin', 'admin', '$2y$10$SCrXrXkagSMmtpXwKc5AjuO9KmpCCd5rtU8P5lw6QpRwaRGVl.C5q', 'Administrator Sistem', 'adm', NULL, 1),
('usr-agus', 'perencanaan', '$2y$10$SCrXrXkagSMmtpXwKc5AjuO9KmpCCd5rtU8P5lw6QpRwaRGVl.C5q', 'Perencanaan', 'pic', 'u-ren', 1),
('usr-budi', 'keuangan', '$2y$10$9H0LSuXsss7BkmLgM8VDOes2cVrHRUS6ntRWqfr9xES6Fjprs11uG', 'Keuangan', 'pic', 'u-keu', 1),
('usr-dewi', 'kepegawaian', '$2y$10$SCrXrXkagSMmtpXwKc5AjuO9KmpCCd5rtU8P5lw6QpRwaRGVl.C5q', 'PIC Kepegawaian', 'pic', 'u-peg', 1),
('usr-itjen', 'itjen.01', '$2y$10$SCrXrXkagSMmtpXwKc5AjuO9KmpCCd5rtU8P5lw6QpRwaRGVl.C5q', 'Auditor Itjen Kemenkes', 'itj', NULL, 1),
('usr-ketua', 'ketua.ski', '$2y$10$SCrXrXkagSMmtpXwKc5AjuO9KmpCCd5rtU8P5lw6QpRwaRGVl.C5q', 'Ketua SKI BBPK', 'ket', NULL, 1),
('usr-pim', 'pimpinan', '$2y$10$SCrXrXkagSMmtpXwKc5AjuO9KmpCCd5rtU8P5lw6QpRwaRGVl.C5q', 'Kepala BBPK Jakarta', 'pim', NULL, 1),
('usr-rina', 'anggota', '$2y$10$SCrXrXkagSMmtpXwKc5AjuO9KmpCCd5rtU8P5lw6QpRwaRGVl.C5q', 'Anggota SKI', 'ang', NULL, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `audit_logs`
--
ALTER TABLE `audit_logs`
  ADD PRIMARY KEY (`id_log`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `evidens`
--
ALTER TABLE `evidens`
  ADD PRIMARY KEY (`id_eviden`),
  ADD KEY `id_jadwal` (`id_jadwal`),
  ADD KEY `id_indikator` (`id_indikator`),
  ADD KEY `id_user_pic` (`id_user_pic`);

--
-- Indexes for table `indicators`
--
ALTER TABLE `indicators`
  ADD PRIMARY KEY (`id`),
  ADD KEY `module_id` (`module_id`);

--
-- Indexes for table `indikators`
--
ALTER TABLE `indikators`
  ADD PRIMARY KEY (`id_indikator`),
  ADD KEY `id_modul` (`id_modul`);

--
-- Indexes for table `jadwal_moduls`
--
ALTER TABLE `jadwal_moduls`
  ADD PRIMARY KEY (`id_jadwal`),
  ADD KEY `id_periode` (`id_periode`),
  ADD KEY `id_modul` (`id_modul`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `moduls`
--
ALTER TABLE `moduls`
  ADD PRIMARY KEY (`id_modul`),
  ADD KEY `id_unit_pic` (`id_unit_pic`);

--
-- Indexes for table `periodes`
--
ALTER TABLE `periodes`
  ADD PRIMARY KEY (`id_periode`);

--
-- Indexes for table `rekomendasi_approvals`
--
ALTER TABLE `rekomendasi_approvals`
  ADD PRIMARY KEY (`id_rekomendasi`),
  ADD KEY `id_jadwal` (`id_jadwal`),
  ADD KEY `id_modul` (`id_modul`),
  ADD KEY `id_ketua_ski` (`id_ketua_ski`),
  ADD KEY `id_pimpinan` (`id_pimpinan`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id_review`),
  ADD KEY `id_eviden` (`id_eviden`),
  ADD KEY `id_user_reviewer` (`id_user_reviewer`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_role`);

--
-- Indexes for table `role_permissions`
--
ALTER TABLE `role_permissions`
  ADD PRIMARY KEY (`id_permission`),
  ADD KEY `id_role` (`id_role`);

--
-- Indexes for table `submissions`
--
ALTER TABLE `submissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `submission_items`
--
ALTER TABLE `submission_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id_unit`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `nip_username` (`nip_username`),
  ADD KEY `id_role` (`id_role`),
  ADD KEY `id_unit` (`id_unit`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `audit_logs`
--
ALTER TABLE `audit_logs`
  ADD CONSTRAINT `audit_logs_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);

--
-- Constraints for table `evidens`
--
ALTER TABLE `evidens`
  ADD CONSTRAINT `evidens_ibfk_1` FOREIGN KEY (`id_jadwal`) REFERENCES `jadwal_moduls` (`id_jadwal`),
  ADD CONSTRAINT `evidens_ibfk_2` FOREIGN KEY (`id_indikator`) REFERENCES `indikators` (`id_indikator`),
  ADD CONSTRAINT `evidens_ibfk_3` FOREIGN KEY (`id_user_pic`) REFERENCES `users` (`id_user`);

--
-- Constraints for table `indikators`
--
ALTER TABLE `indikators`
  ADD CONSTRAINT `indikators_ibfk_1` FOREIGN KEY (`id_modul`) REFERENCES `moduls` (`id_modul`) ON DELETE CASCADE;

--
-- Constraints for table `jadwal_moduls`
--
ALTER TABLE `jadwal_moduls`
  ADD CONSTRAINT `jadwal_moduls_ibfk_1` FOREIGN KEY (`id_periode`) REFERENCES `periodes` (`id_periode`),
  ADD CONSTRAINT `jadwal_moduls_ibfk_2` FOREIGN KEY (`id_modul`) REFERENCES `moduls` (`id_modul`);

--
-- Constraints for table `moduls`
--
ALTER TABLE `moduls`
  ADD CONSTRAINT `moduls_ibfk_1` FOREIGN KEY (`id_unit_pic`) REFERENCES `units` (`id_unit`);

--
-- Constraints for table `rekomendasi_approvals`
--
ALTER TABLE `rekomendasi_approvals`
  ADD CONSTRAINT `rekomendasi_approvals_ibfk_1` FOREIGN KEY (`id_jadwal`) REFERENCES `jadwal_moduls` (`id_jadwal`),
  ADD CONSTRAINT `rekomendasi_approvals_ibfk_2` FOREIGN KEY (`id_modul`) REFERENCES `moduls` (`id_modul`),
  ADD CONSTRAINT `rekomendasi_approvals_ibfk_3` FOREIGN KEY (`id_ketua_ski`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `rekomendasi_approvals_ibfk_4` FOREIGN KEY (`id_pimpinan`) REFERENCES `users` (`id_user`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`id_eviden`) REFERENCES `evidens` (`id_eviden`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`id_user_reviewer`) REFERENCES `users` (`id_user`);

--
-- Constraints for table `role_permissions`
--
ALTER TABLE `role_permissions`
  ADD CONSTRAINT `role_permissions_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `roles` (`id_role`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `roles` (`id_role`),
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`id_unit`) REFERENCES `units` (`id_unit`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
