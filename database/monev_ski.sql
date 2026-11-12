-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 22, 2026 at 04:54 AM
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
('00ee064d-768c-4bbe-af14-8c2a76f6b32c', 'usr-agus', 'PIC', 'Login', 'Sistem Monev SKI', '::1', '2026-10-14 09:14:42'),
('014e07bc-0945-4403-b418-063e216b8b92', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Hapus Modul Pengawasan', 'ID: mod-f268e5a9', '::1', '2026-10-22 08:59:39'),
('0197bbcd-0414-4f9f-8508-af928ff3ef7d', 'usr-admin', 'Admin', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-15 08:53:36'),
('01df27b7-5b4d-4ec7-bf5f-96dd9003d7de', 'usr-ketua', 'Ketua SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-14 08:55:45'),
('02ec647b-cb92-46c6-adc8-9522365dfb2e', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Approval berkas Ketua SKI', '1 berkas disetujui', '::1', '2026-10-19 13:09:24'),
('0301582e-f758-476c-9f5b-8ab018f0e419', 'usr-agus', 'PIC', 'Upload tautan eviden baru', 'Ini Gdrive', '::1', '2026-10-19 13:05:36'),
('031bbd89-997f-423b-89ff-8460007cf5e1', 'usr-rina', 'Anggota SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-15 08:48:23'),
('040f6274-3314-44a0-9af2-263da01a28c2', 'usr-agus', 'PIC', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-15 08:45:56'),
('041ddb2d-1fbd-4454-a37c-b7840ee413c9', 'usr-itjen', 'Itjen', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-14 09:25:26'),
('0579e1a4-1028-4dd2-b0d9-80c1ba367309', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Tambah Indikator Modul', 'Modul: mod-9f3f7fd1 - KOL', '::1', '2026-10-15 08:10:32'),
('05e01ef9-b278-49d0-9c2c-6fad08c27a08', 'usr-agus', 'PIC', 'Login', 'Sistem Monev SKI', '::1', '2026-10-19 13:33:12'),
('0610eb39-0793-4882-a5d5-dfc9c8542b78', 'usr-agus', 'PIC', 'Login', 'Sistem Monev SKI', '::1', '2026-10-14 10:50:23'),
('0767c0f4-4037-40fe-9d96-f7b8af30a355', 'usr-rina', 'Anggota SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-19 13:09:09'),
('077e435c-e642-4304-b84d-279aa95e3081', 'usr-rina', 'Anggota SKI', 'Ubah Modul Pengawasan', 'Sempol Balap (Status: draf)', '::1', '2026-10-14 09:23:43'),
('07c7fc75-51ee-45f8-bc2d-91e97d64a6c1', 'usr-rina', 'Anggota SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-15 09:56:03'),
('092e0425-6607-481e-a911-09d2155a00b7', 'usr-pim', 'Pimpinan', 'Login', 'Sistem Monev SKI', '::1', '2026-10-14 10:06:55'),
('096732bc-9e3d-4a15-acc2-eeb51b5c7aae', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Hapus Modul Pengawasan', 'ID: mod-upg', '::1', '2026-10-22 09:00:09'),
('09b96f12-fde3-4ed4-8d36-008fe0465b8b', 'usr-rina', 'Anggota SKI', 'Update Status Modul', 'Modul mod-lhkpn status: terbit', '::1', '2026-10-20 10:26:13'),
('0a65800f-0976-4bda-a239-70619d10457d', 'usr-rina', 'Anggota SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-19 14:33:47'),
('0aa526c7-d045-4f45-bfb8-ea26667884fb', 'usr-agus', 'PIC', 'Upload tautan eviden baru', 'Berkas Eviden GDrive SPJ Keuangan', '127.0.0.1', '2026-10-19 13:02:31'),
('0b3a9589-c2f1-4787-b881-ce5dcaaa4a0c', 'usr-rina', 'Anggota SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-20 14:24:17'),
('0b3f9ec3-1929-4a3f-868d-61be441f7d4e', 'usr-pim', 'Pimpinan', 'Login', 'Sistem Monev SKI', '::1', '2026-10-14 10:08:35'),
('0b48eeac-e7ca-42bb-929e-8e7499a336ba', 'usr-pim', 'Pimpinan', 'Pimpinan menyetujui evaluasi modul', 'Modul ID: mod-lk', '::1', '2026-10-14 10:25:56'),
('0b8400d4-9e4b-497a-96f3-e49b0da9f73b', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-14 10:08:32'),
('0bb2caca-e321-49fa-8121-6fa1dafd544c', 'usr-rina', 'Anggota SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-14 09:52:54'),
('0c756914-a060-4e36-83f6-c729db8ccf0a', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Terbitkan Jadwal Pengawasan', 'Oktober 2026 (1 modul)', '::1', '2026-10-15 08:59:17'),
('0cbf1159-88a9-4574-af7f-9496d2913a16', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-14 10:48:22'),
('0cc0380f-df92-4390-8788-151d010b22e6', 'usr-pim', 'Pimpinan', 'Login', 'Sistem Monev SKI', '::1', '2026-10-14 09:55:13'),
('0cc59c07-6daa-46a4-9bbb-6ec037eed445', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Ubah Modul Pengawasan', 'Laporan Keuangan (LKE) (Status: terbit)', '::1', '2026-10-15 08:12:45'),
('0ce329bd-fb7d-410f-8722-7f018c05798c', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-15 08:11:51'),
('0d732eb5-03ff-4fa0-b06e-98de21dd437e', 'usr-admin', 'Admin', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-19 13:57:32'),
('0d984494-af11-41ea-a17d-7e2bb9d3eb04', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-15 09:55:17'),
('0e3a303e-22f9-4e11-8d0a-49d9dabd9898', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Terbitkan Jadwal Pengawasan', 'Oktober 2026 (5 modul)', '::1', '2026-10-19 14:35:15'),
('0e814532-f0bc-4c11-a8b9-51d031cbf495', 'usr-pim', 'Pimpinan', 'Pimpinan melihat rekomendasi', 'ID Rek: ba10f168-c918-4413-bb72-874f37e483bd', '::1', '2026-10-14 10:25:48'),
('0ec4baa5-913e-4155-9dea-3a618ebb96b4', 'usr-agus', 'PIC', 'Login', 'Sistem Monev SKI', '::1', '2026-10-15 08:43:24'),
('0ed0d755-9785-4269-ae65-13a705aca435', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-15 10:18:47'),
('0ee6207a-bf9a-4459-8d2a-8d160d89ac69', 'usr-agus', 'PIC', 'Login', 'Sistem Monev SKI', '::1', '2026-10-15 10:37:57'),
('0f425a3a-e4ae-47de-bad7-75efd2501353', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-14 11:01:02'),
('0f47e8d6-3607-41ac-8bf8-9fc20e83cb14', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Ubah Modul Pengawasan', 'Nobal GP America (Status: terbit)', '::1', '2026-10-14 10:50:17'),
('0f9f2335-be31-4c63-9e13-3a313ab3095e', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Tambah Indikator Modul', 'Modul: mod-a34bf986 - Volunteer', '::1', '2026-10-14 10:50:13'),
('0ff24e05-c9dc-4850-8fdd-b9d01963b37b', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Terbitkan Jadwal Pengawasan', 'Oktober 2026 (5 modul)', '::1', '2026-10-14 09:51:12'),
('11014e3f-0d55-4f09-9900-7cc987fa3dd1', 'usr-agus', 'PIC', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-15 10:19:44'),
('1149b2ad-06a0-4f0a-9312-0102414acf8e', 'usr-agus', 'PIC', 'Login', 'Sistem Monev SKI', '::1', '2026-10-19 13:10:13'),
('116476a2-c20f-4615-93ed-a28e64b9f447', 'usr-dewi', 'PIC', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-19 14:35:36'),
('1193c7a2-cb83-4b04-a285-551d8da59ff0', 'usr-rina', 'Anggota SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-15 10:13:00'),
('11dd526d-e0b9-412c-b3ce-d4111689fac3', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-15 09:56:12'),
('12a0fad4-8e62-45b8-af3a-b4e68bed28dd', 'usr-rina', 'Anggota SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-19 13:34:47'),
('12a3d216-8621-4669-a5dc-f99a4e9b5e9b', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Hapus Modul Pengawasan', 'ID: mod-risiko', '::1', '2026-10-22 08:59:43'),
('149f2660-5af5-4ef2-8551-13c1d3438d95', 'usr-pim', 'Pimpinan', 'Login', 'Sistem Monev SKI', '::1', '2026-10-14 09:16:56'),
('14cdb7d8-25e3-46d2-907e-4cca4a022984', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-15 10:13:37'),
('14dae5f5-8b14-418d-aee8-d522e4387bef', 'usr-pim', 'Pimpinan', 'Pimpinan memberikan disposisi perbaikan modul', 'ss', '::1', '2026-10-14 10:25:52'),
('151273dc-3a07-42ed-825a-1840aa881ea4', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Approval berkas Ketua SKI', '1 berkas disetujui', '::1', '2026-10-15 08:48:32'),
('158ec25a-b54d-460d-a4f8-0ae232b81257', 'usr-ketua', 'Ketua SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-14 09:20:27'),
('159926f4-255b-454a-82e7-5223787d5627', 'usr-rina', 'Anggota SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-15 09:58:21'),
('15ebef70-67ec-458f-8c7c-4b37dd1f4161', 'usr-pim', 'Pimpinan', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-14 09:02:15'),
('1622a732-e8ba-448e-a8af-7e11219a709f', 'usr-agus', 'PIC', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-15 10:58:05'),
('166b2af5-a9c6-43f2-b37b-c4bca018c1ee', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-15 08:48:35'),
('170ed070-500f-4a20-ad48-fee9561c81ae', 'usr-rina', 'Anggota SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-21 09:27:05'),
('18496c86-a1fd-4d43-b2d9-1640765cc9b4', 'usr-rina', 'Anggota SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-22 08:45:09'),
('19a0b6a1-f705-46fe-a531-575df33d9a05', 'usr-agus', 'PIC', 'Login', 'Sistem Monev SKI', '::1', '2026-10-15 08:57:16'),
('19ae4812-773d-4efa-8e7d-8357072d162c', 'usr-dewi', 'PIC', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-20 08:49:22'),
('19fe784b-f53a-4b79-b58a-2c0978f87238', 'usr-agus', 'PIC', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-20 09:06:46'),
('1af81fd8-38bb-4927-a4c6-e9e27abf2bfa', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-15 08:45:00'),
('1be34e3a-1f84-4802-8836-24158e2f9fe6', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-15 07:44:22'),
('1c713272-c0ae-4cf1-b5ea-3062655f6215', 'usr-dewi', 'PIC', 'Login', 'Sistem Monev SKI', '::1', '2026-10-22 08:57:53'),
('1d086fb5-fb97-4f7f-aeb7-6d55ca6081f5', 'usr-pim', 'Pimpinan', 'Pimpinan menyetujui berkas eviden', 'lampiran.pdf (Nobal Gp Abu Dhabi) - Versi 1', '::1', '2026-10-15 10:14:06'),
('1d5810a7-a5d5-451f-a53e-3a8fa04a9a71', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Hapus Indikator Modul', 'ID: ind-lk-2', '::1', '2026-10-15 08:11:08'),
('1db04708-0789-4c7a-b4ed-690b6ab77938', 'usr-budi', 'PIC', 'Login', 'Sistem Monev SKI', '127.0.0.1', '2026-10-19 13:32:45'),
('1e473231-078a-4226-bec9-29e539509790', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-15 09:57:55'),
('1ea61d10-079b-4360-b345-f55c99db9adc', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-14 09:45:54'),
('2075a207-6156-4bf6-b80a-6055392615ef', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-15 09:45:07'),
('20ba0b5f-f34f-47d4-b244-b3c9d8ef5f1c', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-15 09:38:12'),
('21589288-e988-40ae-ae4b-e22a7f35725d', 'usr-pim', 'Pimpinan', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-19 13:08:54'),
('22c48e6a-1153-435c-9556-b2350920280c', 'usr-rina', 'Anggota SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-14 11:15:01'),
('23169161-b556-4f1c-9ffa-16537989c64d', 'usr-agus', 'PIC', 'Login', 'Sistem Monev SKI', '::1', '2026-10-15 09:27:13'),
('231e740e-b760-4e63-ba68-cb0d61c50a36', 'usr-agus', 'PIC', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-15 11:04:05'),
('2397f153-103f-4b7e-8ed4-66f083ebdac4', 'usr-rina', 'Anggota SKI', 'Ubah Modul Pengawasan', 'Keuangan Bulan Oktober (Status: draf)', '::1', '2026-10-22 08:34:02'),
('252019a4-a65b-4ded-bdfb-f063b2bca567', 'usr-rina', 'Anggota SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-14 09:14:42'),
('264b6404-8613-4871-a087-cdecdf8f1be7', 'usr-agus', 'PIC', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-19 13:34:57'),
('2687026b-a2a1-45ac-82fd-1073421a6564', 'usr-rina', 'Anggota SKI', 'Kirim hasil review SKI', '1 butir eviden dievaluasi', '::1', '2026-10-19 13:08:03'),
('268c4e0f-228c-4c24-abd8-4884eff9ec66', 'usr-budi', 'PIC', 'Login', 'Sistem Monev SKI', '::1', '2026-10-19 13:33:57'),
('26dbcbfd-16d8-4419-9029-e7a1b9d8e2a6', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-19 12:46:20'),
('280f2bb0-e8b6-4cfd-b924-5f75cbd2bd2d', 'usr-agus', 'PIC', 'Login', 'Sistem Monev SKI', '::1', '2026-10-15 08:53:38'),
('287b39e9-c812-4056-beb9-a1e38418981a', 'usr-agus', 'PIC', 'Upload perbaikan tautan eviden', 'Ini Gdrive (v3)', '::1', '2026-10-19 13:09:04'),
('289da540-237e-41e8-b3d8-f5f7591885e3', 'usr-itjen', 'Itjen', 'Login', 'Sistem Monev SKI', '::1', '2026-10-14 09:14:42'),
('292898a9-8b13-44e9-af04-e5c6def125a6', 'usr-agus', 'PIC', 'Login', 'Sistem Monev SKI', '::1', '2026-10-14 09:19:26'),
('299b002d-74aa-4013-b8a1-ce635bcfd512', 'usr-agus', 'PIC', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-15 08:47:27'),
('29a7861e-92a2-4dc7-89df-179db175fe81', 'usr-rina', 'Anggota SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-14 11:16:02'),
('2b5cd0ee-91c5-4af1-a576-166d40b27c9a', 'usr-pim', 'Pimpinan', 'Pimpinan menyetujui berkas eviden', 'Tecno Spark - Ginartriadi Affandi.pdf (Sempol Balap) - Versi 2', '127.0.0.1', '2026-10-14 10:29:58'),
('2c8a3276-6762-4daf-960b-c638be1c1238', 'usr-rina', 'Anggota SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-14 10:08:01'),
('2ca46194-5376-4341-8a1f-9636cb99873a', 'usr-pim', 'Pimpinan', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-14 10:40:31'),
('2cf01747-3ad4-4945-badd-ebcc711fea1b', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-19 13:08:08'),
('2cf048c5-669b-41ac-97dd-e636ac5aadd0', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Hapus Modul Pengawasan', 'ID: mod-pbj', '::1', '2026-10-15 08:11:35'),
('2d179158-5852-41d3-b414-42b6fa6e50d3', 'usr-agus', 'PIC', 'Upload eviden baru', 'SRS 2.pdf', '::1', '2026-10-15 10:38:24'),
('2e06de35-869e-4047-99b3-19e47a15d6d1', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Tambah Indikator Modul', 'Modul: mod-791a2adb - fdsfsd', '::1', '2026-10-20 08:48:03'),
('2e6460b1-5160-4972-9592-3e9427fdc60a', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-15 10:17:49'),
('2ee7f7e3-7c20-4fa1-b075-c5147fa5dc74', 'usr-agus', 'PIC', 'Upload eviden baru', 'SRS.pdf', '::1', '2026-10-15 09:55:41'),
('2eef4332-b831-4d9c-9b43-b660f87dd668', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-15 11:01:30'),
('2f141b9f-9651-4c8b-a34c-b6a9f151835a', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Terbitkan Jadwal Pengawasan', 'Oktober 2026 (1 modul)', '::1', '2026-10-15 08:59:09'),
('2f2eec29-9882-403a-b729-71521f771d76', 'usr-pim', 'Pimpinan', 'Pimpinan melihat rekomendasi', 'ID Rek: ba10f168-c918-4413-bb72-874f37e483bd', '::1', '2026-10-14 10:07:32'),
('2f64fffd-8092-4be9-9b73-783f02a19941', 'usr-rina', 'Anggota SKI', 'Update Status Modul', 'Modul mod-lhkpn status: draf', '::1', '2026-10-20 10:26:12'),
('2f9bbe42-2323-47fb-8d60-182157df6ab7', 'usr-pim', 'Pimpinan', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-14 10:47:36'),
('2fa8e04a-2fe8-44e4-96f5-e7bd73b88a6f', 'usr-agus', 'PIC', 'Login', 'Sistem Monev SKI', '::1', '2026-10-14 10:07:45'),
('30019411-bfeb-4922-9bde-bf5d0aaf47ae', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-15 08:46:24'),
('30c81f71-8cf3-4d95-bac7-c6d83cee6474', 'usr-rina', 'Anggota SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-15 08:39:58'),
('31fa92a8-3ba7-40c6-a329-550d84ad7813', 'usr-dewi', 'PIC', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-22 08:58:11'),
('32023226-3bf0-45db-a854-be6770429f45', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Ubah Modul Pengawasan', 'Keuangan Bulan Oktober (Status: terbit)', '::1', '2026-10-15 11:03:26'),
('320c27d0-3eb0-4e5c-b568-6f19763ad2a1', 'usr-agus', 'PIC', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-14 09:50:21'),
('33888711-0939-4c87-a9ca-38696ea97ed4', 'usr-admin', 'Admin', 'Login', 'Sistem Monev SKI', '::1', '2026-10-20 14:24:04'),
('33923fe3-1cc3-4012-988e-357f96fcc500', 'usr-agus', 'PIC', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-19 13:09:07'),
('33ad75b4-7cf9-4753-9a3e-a529e40e0253', 'usr-budi', 'PIC', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-19 14:33:43'),
('33afc56e-684d-4f7d-aabe-7cc275603ce4', 'usr-rina', 'Anggota SKI', 'Ubah Modul Pengawasan', 'tes bulet (Status: terbit)', '::1', '2026-10-22 08:33:41'),
('33e8c84a-a769-4645-9ae3-a6a00eccdc4e', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Approval berkas Ketua SKI', '1 berkas disetujui', '::1', '2026-10-15 08:48:33'),
('3437b127-abda-4998-80c4-407b48550186', 'usr-rina', 'Anggota SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-15 11:05:44'),
('34fb29e1-59ad-4145-b366-d3a3227e7aa7', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Hapus Template Modul', 'Nobal Gp Abu Dhabi', '::1', '2026-10-22 09:05:02'),
('351e402a-5322-471e-bb0a-b1eea2dc77e9', 'usr-agus', 'PIC', 'Login', 'Sistem Monev SKI', '::1', '2026-10-15 10:19:50'),
('3548e75a-f6ee-4a5d-ba2b-68868bb7bd75', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Ubah Indikator Modul', 'ID: e72540b2-f194-471e-9267-8ebc9b0c2784 - Minim Drag', '::1', '2026-10-14 09:56:30'),
('35605752-665f-4d48-a419-3d4a4f084587', 'usr-pim', 'Pimpinan', 'Pimpinan melihat rekomendasi', 'ID Rek: ba10f168-c918-4413-bb72-874f37e483bd', '::1', '2026-10-14 10:25:55'),
('360dc6f3-d88d-4cc7-a462-6c4fdcb9569b', 'usr-agus', 'PIC', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-14 10:25:23'),
('36834a2a-1b4a-4bd8-910c-6f36e410adf0', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-14 09:48:28'),
('36a106cf-1187-43d9-9666-0db74d2e09a6', 'usr-budi', 'PIC', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-19 13:34:04'),
('36f49d26-6d71-4d27-8a2b-846cba4c2838', 'usr-agus', 'PIC', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-14 10:58:25'),
('37253e55-4a5d-47de-98e0-4df638605266', 'usr-rina', 'Anggota SKI', 'Kirim hasil review SKI', '1 butir eviden dievaluasi', '::1', '2026-10-15 10:11:35'),
('3790e643-ed75-4e9f-99cc-b65b42e444ca', 'usr-rina', 'Anggota SKI', 'Kirim hasil review SKI', '1 butir eviden dievaluasi', '::1', '2026-10-19 13:06:47'),
('37c64f93-01c3-4ed7-a248-74e087282f60', 'usr-agus', 'PIC', 'Login', 'Sistem Monev SKI', '::1', '2026-10-19 13:06:59'),
('37da6c52-a16e-41d7-8515-86903fe76dc5', 'usr-budi', 'PIC', 'Login', 'Sistem Monev SKI', '::1', '2026-10-20 08:56:40'),
('37e622ac-643e-48ec-a0b9-03dcfe1b72d0', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-14 09:52:57'),
('37f422fa-13cf-4eb8-992f-54d80349e34a', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Upload Template Modul', 'Keuangan Bulan Oktober (Intership Agreement - Ginartriadi Affandi Draft.docx)', '::1', '2026-10-15 11:03:11'),
('383f7aa4-a98d-4bf3-a40e-420ef510ae9c', 'usr-agus', 'PIC', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-15 08:54:08'),
('38c3ddf0-bf49-4212-8ab6-ee92e6d8633b', 'usr-admin', 'Admin', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-20 10:07:04'),
('38ce349c-4e7a-4c51-82d1-faabb7fbd87d', 'usr-admin', 'Admin', 'Login', 'Sistem Monev SKI', '::1', '2026-10-15 07:46:17'),
('3920aa88-f79c-47c4-83a7-ac184022e019', 'usr-agus', 'PIC', 'Login', 'Sistem Monev SKI', '::1', '2026-10-15 10:17:28'),
('39468b40-5ced-43b7-bf52-2c387d1a2d34', 'usr-agus', 'PIC', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-14 09:52:34'),
('3956c80d-4606-49d2-b8f9-d9cc369f3122', 'usr-rina', 'Anggota SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-19 13:35:48'),
('3960341e-718d-46b2-b9ab-6e44d5a1b87c', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Kembalikan berkas ke PIC', '1 berkas', '::1', '2026-10-19 13:08:32'),
('3969fe16-30e8-4006-bcb0-e29e5425d813', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Ubah Modul Pengawasan', 'Nobal GP America (Status: terbit)', '::1', '2026-10-14 10:50:18'),
('397ab99b-2aa9-411c-8700-40c4a6214709', 'usr-itjen', 'Itjen', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-14 10:47:01'),
('3aa44639-4f90-4883-9f50-456a5dd3a4a9', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-15 11:09:18'),
('3ab4e91e-6dea-432b-a3cf-784727e596a3', 'usr-admin', 'Admin', 'Ubah Peran Pengguna', 'User: usr-rina -> Role: adm', '::1', '2026-10-15 07:46:08'),
('3acc4f2d-f64b-4612-b562-c5bf5c8071cc', 'usr-rina', 'Anggota SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-15 09:58:06'),
('3b0f1270-5ae7-4cf4-b396-e128217b5d3a', 'usr-agus', 'PIC', 'Login', 'Sistem Monev SKI', '::1', '2026-10-15 10:19:22'),
('3b1f4d40-c66e-4b82-88fe-b6ea43196952', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Terbitkan Jadwal Pengawasan', 'Oktober 2026 (1 modul)', '::1', '2026-10-15 08:59:23'),
('3b7569bd-7ce4-4a0f-b9c3-038728ac254c', 'usr-pim', 'Pimpinan', 'Pimpinan melihat rekomendasi', 'ID Rek: ba10f168-c918-4413-bb72-874f37e483bd', '::1', '2026-10-14 09:24:59'),
('3bae4262-0050-4a8d-8c74-f9b0826da327', 'usr-budi', 'PIC', 'Login', 'Sistem Monev SKI', '::1', '2026-10-20 08:30:22'),
('3bb4548b-940e-4ccd-8d51-6918dafcfa93', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-19 14:35:18'),
('3c382d77-2037-4bc5-9b32-faf2e5bc2dcf', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-14 09:43:35'),
('3ca36cff-ab90-494d-9b03-e4698d745156', 'usr-budi', 'PIC', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-19 13:35:31'),
('3d729916-7430-4e26-850a-3842f8c5ab77', 'usr-agus', 'PIC', 'Hapus berkas eviden', 'Berkas Eviden GDrive SPJ Keuangan', '127.0.0.1', '2026-10-19 13:03:09'),
('3d88d93b-fb4d-4021-a7d2-3f19be1eeb1d', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-15 08:48:25'),
('3dffb843-a164-4d75-89e3-7247799338b2', 'usr-dewi', 'PIC', 'Login', 'Sistem Monev SKI', '::1', '2026-10-20 08:48:28'),
('3ebe9812-092f-43ac-87dd-bc8f439f428a', 'usr-agus', 'PIC', 'Upload eviden baru', 'Senin 28 Oktober 2026 - Logbook Kegiatan Harian.pdf', '::1', '2026-10-19 13:05:59'),
('3f952400-c08d-4a83-aec7-3b9989c66d11', 'usr-admin', 'Admin', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-20 08:56:34'),
('3fab8c4b-5ddd-417f-acc7-5027fb69e710', 'usr-pim', 'Pimpinan', 'Pimpinan menyetujui berkas eviden', '2024-07-16_-_Internship_Handbook_SY_24_25 -Indonesia Version.pdf (Nobal GP America) - Versi 1', '::1', '2026-10-15 08:48:47'),
('3fd93da9-1a41-4697-bb00-4f1367f73ba5', 'usr-agus', 'PIC', 'Login', 'Sistem Monev SKI', '::1', '2026-10-14 09:23:55'),
('3ffd8da4-5dc0-444c-b323-786425bcad39', 'usr-agus', 'PIC', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-14 09:54:34'),
('40a93b4c-d8eb-48f5-aa22-16cf0154fc64', 'usr-agus', 'PIC', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-14 11:14:59'),
('40ae4b7f-618f-4538-84bf-d017d16dfd91', 'usr-rina', 'Anggota SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-15 10:29:53'),
('40fcfb31-8aee-46bd-893f-e7157da20db6', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-15 10:18:16'),
('4154750a-e5c3-4b57-9d9f-a5b9b0f0f3fa', 'usr-pim', 'Pimpinan', 'Pimpinan menyetujui evaluasi modul', 'Tugas modul selesai', '::1', '2026-10-14 10:07:35'),
('419f8524-07b0-4b42-bc7c-79f4e328a2dc', 'usr-admin', 'Admin', 'Perubahan RBAC Granular', 'Role: adm, Menu: dash, Aksi: t -> 1', '::1', '2026-10-15 07:47:08'),
('4229fa98-7e39-450f-9b0e-6ea056ebe4e0', 'usr-pim', 'Pimpinan', 'Login', 'Sistem Monev SKI', '::1', '2026-10-14 10:47:22'),
('424daa11-6795-4117-8adc-b16d115cfed2', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Hapus Modul Pengawasan', 'ID: mod-lhkpn', '::1', '2026-10-22 08:59:35'),
('425e9cf2-c7c0-4090-a6a2-60a080285399', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-15 09:46:26'),
('428b5dc5-cb99-45a7-b89c-5b7025a9f316', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-15 09:58:04'),
('4299b326-d0fd-4742-84b6-b918a257b056', 'usr-rina', 'Anggota SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-15 09:26:07'),
('43158da0-6d34-411b-934c-3ecb9cc9a942', 'usr-rina', 'Anggota SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-14 09:52:36'),
('4334d681-0347-4cf2-a8c7-4e62fb2cdfb8', 'usr-pim', 'Pimpinan', 'Pimpinan memberikan disposisi perbaikan modul', 'ss', '::1', '2026-10-15 08:12:03'),
('43df2afb-057e-44ec-8a06-f02fe1086ccd', 'usr-budi', 'PIC', 'Login', 'Sistem Monev SKI', '::1', '2026-10-19 13:35:20'),
('43ede03e-a52e-4348-8702-1b3551cfa334', 'usr-rina', 'Anggota SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-15 09:57:46'),
('44b8e046-a7ed-4725-9197-67d05ef9777a', 'usr-rina', 'Anggota SKI', 'Ubah Modul Pengawasan', 'Test Draft (Status: terbit)', '::1', '2026-10-19 14:34:04'),
('456dca75-d377-4b39-aec7-d18d93120dde', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Hapus Modul Pengawasan', 'ID: mod-kkr', '::1', '2026-10-22 08:59:40'),
('45d21199-f2e6-44f0-8810-59d5585a9615', 'usr-rina', 'Anggota SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-14 09:16:56'),
('46511e2e-462e-4cef-aa89-4e9ce9f137e5', 'usr-agus', 'PIC', 'Login', 'Sistem Monev SKI', '::1', '2026-10-14 08:55:48'),
('4718d4e9-06db-4465-a222-28042e8d528d', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-14 09:54:36'),
('4736d7b4-5b76-40b7-b4d3-525080ddfc17', 'usr-pim', 'Pimpinan', 'Login', 'Sistem Monev SKI', '::1', '2026-10-14 10:11:48'),
('474165dc-02bd-4a67-8726-723a2dc6d7de', 'usr-agus', 'PIC', 'Login', 'Sistem Monev SKI', '::1', '2026-10-14 09:54:22'),
('47959fb3-da16-4ec6-a63d-95dfc492a107', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Terbitkan Jadwal Pengawasan', 'Oktober 2026 (3 modul)', '::1', '2026-10-15 10:18:01'),
('485e9a41-7f91-4a92-b116-5779f6db7bc4', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Approval berkas Ketua SKI', '1 berkas disetujui', '::1', '2026-10-15 08:48:32'),
('48fecab0-5caf-449e-92a2-310d9707373c', 'usr-pim', 'Pimpinan', 'Login', 'Sistem Monev SKI', '::1', '2026-10-19 13:08:41'),
('4922cb11-7276-4229-b042-9f01d38b37ec', 'usr-rina', 'Anggota SKI', 'Tambah Indikator Modul', 'Modul: mod-f268e5a9 - Pembelian Inventaris Bulan Oktober', '::1', '2026-10-15 10:16:16'),
('4a0460c8-ba38-49b2-a34c-bf2a2b80cc32', 'usr-agus', 'PIC', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-15 10:37:31'),
('4a3722c0-d0c2-40a7-aaed-f714c4abdb39', 'usr-rina', 'Anggota SKI', 'Ubah Modul Pengawasan', 'Nobal Gp Abu Dhabi (Status: terbit)', '::1', '2026-10-22 09:22:29'),
('4a6f4e6c-5039-4e5c-845a-94629c3e4047', 'usr-rina', 'Anggota SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-15 10:16:26'),
('4a7b3cd0-5747-489c-81c1-7718bead4340', 'usr-agus', 'PIC', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-15 10:17:41'),
('4c242682-8765-4003-a163-9966449cdafb', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Hapus Indikator Modul', 'ID: ind-lk-3', '::1', '2026-10-15 08:11:16'),
('4c6976f8-25d9-4a0a-a3ed-e08374c56190', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Ubah Modul Pengawasan', 'Laporan Keuangan (LKE) (Status: draf)', '::1', '2026-10-15 08:08:37'),
('4d2c22bc-74eb-478e-a982-1650f59a23df', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Approval berkas Ketua SKI', '1 berkas disetujui', '::1', '2026-10-15 10:13:27'),
('4d36c33f-09fd-472f-bb5f-b732cf8739e9', 'usr-rina', 'Anggota SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-19 13:34:13'),
('4d4f4865-55f9-4351-89f0-7e52b3927cd5', 'usr-rina', 'Anggota SKI', 'Ubah Modul Pengawasan', 'Test Draft (Status: draf)', '::1', '2026-10-19 13:34:45'),
('4d6f8b86-fa56-4f83-8230-3940c98ef3c9', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-15 08:06:58'),
('4df34218-4e4f-4890-84d0-564bf4b14c2d', 'usr-rina', 'Anggota SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-15 09:26:01'),
('4e525ea2-bb11-48ff-9a11-29075abf2c85', 'usr-rina', 'Anggota SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-14 09:18:05'),
('4e56c405-6d3a-4182-b8d3-983f16ae7650', 'usr-agus', 'PIC', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-15 10:21:34'),
('4e5a161a-b438-4256-a7f3-77956fb4c242', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-19 13:08:39'),
('4e684e9d-e38d-4470-8ae9-bc5fda769c06', 'usr-agus', 'PIC', 'Upload eviden baru', 'lampiran.pdf', '::1', '2026-10-15 08:46:56'),
('4ec6c293-b2a9-4300-955a-3abc2bd19189', 'usr-rina', 'Anggota SKI', 'Ubah Modul Pengawasan', 'Sempol Balap (Status: terbit)', '::1', '2026-10-14 09:23:42'),
('4ed1d674-2ebb-44b0-bceb-c23be6b4f5d1', 'usr-agus', 'PIC', 'Login', 'Sistem Monev SKI', '::1', '2026-10-14 10:58:21'),
('4f361498-58b5-4fde-b6da-1451632e9502', 'usr-agus', 'PIC', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-19 12:37:22'),
('4f3db7cb-ec36-49fc-bdf8-072504c61db7', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-14 10:47:18'),
('4ff07526-c5e7-4341-aa1f-0b16e0f01a9b', 'usr-budi', 'PIC', 'Login', 'Sistem Monev SKI', '::1', '2026-10-21 11:12:24'),
('504c73c3-c10d-4a80-aece-c3d9ba7c86ee', 'usr-rina', 'Anggota SKI', 'Kirim hasil review SKI', '1 butir eviden dievaluasi', '::1', '2026-10-15 08:48:11'),
('507ab4e9-7f6f-487e-ab23-63c0abdd1ef6', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Terbitkan Jadwal Pengawasan', 'Oktober 2026 (15 modul)', '::1', '2026-10-20 08:48:22'),
('508d4c35-653d-4aff-b126-f55c88bdfb59', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-22 09:16:01'),
('51429823-a933-427f-adf3-e89f0fb4aa36', 'usr-agus', 'PIC', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-15 10:33:42'),
('51729e44-b9c3-4995-ba37-a72076a7ea55', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Hapus Modul Pengawasan', 'ID: mod-lk', '::1', '2026-10-15 08:16:01'),
('522ecfc6-9e78-4207-a5ee-de34765a4a2c', 'usr-rina', 'Anggota SKI', 'Ubah Modul Pengawasan', 'Keuangan Bulan Oktober (Status: terbit)', '::1', '2026-10-15 10:16:24'),
('52b1bf9b-362e-47fb-af6e-c56d15ae8e71', 'usr-agus', 'PIC', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-14 09:43:32'),
('53452a59-2717-4a93-843e-8e12da59132d', 'usr-pim', 'Pimpinan', 'Pimpinan menyetujui berkas eviden', '2026 08 27 - SP.99 FTIK - Surat Magang Ginar.pdf (Konflik Kepentingan) - Versi 2', '::1', '2026-10-14 10:47:34'),
('53a62de6-5c1f-4f9d-ba3f-f628fce1fd11', 'usr-agus', 'PIC', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-15 10:12:21'),
('53add8c1-8629-4b7e-97b7-f1a85b6387dc', 'usr-budi', 'PIC', 'Login', 'Sistem Monev SKI', '::1', '2026-10-19 14:34:12'),
('53d8ce85-d45a-43cd-8d6e-7052314ac7e6', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-14 09:53:43'),
('53da6800-cdf3-4f6d-b8ae-561b5f5d3c60', 'usr-agus', 'PIC', 'Login', 'Sistem Monev SKI', '::1', '2026-10-15 10:33:55'),
('54998f5a-9b19-480c-b867-ac374d1e4597', 'usr-agus', 'PIC', 'Login', 'Sistem Monev SKI', '::1', '2026-10-15 09:56:05'),
('54a1fc0e-cf8e-4716-adea-53fd1b081e54', 'usr-rina', 'Anggota SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-15 10:17:17'),
('55979f07-b50f-472b-b3f6-a545250dc648', 'usr-admin', 'Admin', 'Login', 'Sistem Monev SKI', '::1', '2026-10-15 08:50:10'),
('56089925-4bef-49c6-aa68-846b2cbf2023', 'usr-agus', 'PIC', 'Upload perbaikan eviden', '2026 08 27 - SP.99 FTIK - Surat Magang Ginar.pdf (v2)', '::1', '2026-10-14 09:24:10'),
('560e3d2c-204b-4737-a6c9-c92330d6f04e', 'usr-rina', 'Anggota SKI', 'Kirim hasil review SKI', '1 butir eviden dievaluasi', '::1', '2026-10-14 10:08:11'),
('566a08cd-44b6-4d85-8e61-7d03dea0f73d', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-14 09:55:10'),
('567d816a-e84a-47e4-a892-bdb40a99a2df', 'usr-agus', 'PIC', 'Login', 'Sistem Monev SKI', '::1', '2026-10-15 07:44:07'),
('56c84bc0-9f5b-4ab8-83cc-1d8b37549c0e', 'usr-rina', 'Anggota SKI', 'Ubah Modul Pengawasan', 'Nobal Gp Abu Dhabi (Status: draf)', '::1', '2026-10-22 08:33:53'),
('56fb1cea-6bda-4d1d-be9f-8085ab10e2a6', 'usr-pim', 'Pimpinan', 'Login', 'Sistem Monev SKI', '::1', '2026-10-14 09:24:18'),
('571dbd9a-4582-46da-9103-02e89817b4d6', 'usr-rina', 'Anggota SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-15 07:52:09'),
('5766635a-7cbc-4d20-88d3-a1298f51c73a', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Ubah Modul Pengawasan', 'Laporan Keuangan (LKE) (Status: draf)', '::1', '2026-10-15 08:12:45'),
('578da7b3-3467-499a-bc87-c3c79d0fb75d', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-19 13:09:25'),
('584c7aae-aec7-47d5-ad73-fbbd414ee0dc', 'usr-pim', 'Pimpinan', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-14 10:12:51'),
('585aa578-b4c0-41b4-b3af-fce96fe99ebd', 'usr-rina', 'Anggota SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-15 10:17:46'),
('58b6c969-7163-435c-b4d1-6cf39d9b7c3e', 'usr-rina', 'Anggota SKI', 'Ubah Modul Pengawasan', 'Sempol Balap (Status: terbit)', '::1', '2026-10-14 09:23:44'),
('593fea4a-727e-4d90-ae12-aa69d312ad60', 'usr-rina', 'Anggota SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-15 15:10:39'),
('596e7750-c400-4fd3-9c73-034ecca8addd', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-15 09:26:53'),
('598e1f03-8256-42e2-a226-86cf58d2ece7', 'usr-agus', 'PIC', 'Hapus berkas eviden', 'PBJ_Tepat_kualitas.pdf', '::1', '2026-10-15 08:57:16'),
('5a1d5333-5d3c-42c3-aa26-8ebb9c608bc9', 'usr-agus', 'PIC', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-19 13:06:15'),
('5a2340c2-27e0-4d44-8f0f-788a83704f7b', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Hapus Indikator Modul', 'ID: ind-lk-4', '::1', '2026-10-15 08:11:10'),
('5a2efaab-1682-43dd-a047-b11e48b8fe5c', 'usr-agus', 'PIC', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-14 10:58:18'),
('5a80ba3c-498a-4cd8-99cd-0d9d76b20027', 'usr-agus', 'PIC', 'Login', 'Sistem Monev SKI', '::1', '2026-10-19 12:37:00'),
('5ae50b89-92b7-4f8c-a7f2-0ca6ed84a231', 'usr-rina', 'Anggota SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-15 08:06:56'),
('5c918722-e813-498f-abfe-0913ad9e7982', 'usr-pim', 'Pimpinan', 'Login', 'Sistem Monev SKI', '::1', '2026-10-14 10:25:26'),
('5cb257f9-2973-4e7b-86f7-d6c91a873d37', 'usr-agus', 'PIC', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-15 09:56:10'),
('5cbf4d1a-72cc-455a-ab45-2a45c7cbf278', 'usr-agus', 'PIC', 'Login', 'Sistem Monev SKI', '::1', '2026-10-15 11:07:24'),
('5d3ed068-9280-4ccb-8162-90d2376c76df', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-19 12:57:32'),
('5d65b625-646d-4030-99df-ca44fb13656e', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Approval berkas Ketua SKI', '1 berkas disetujui', '::1', '2026-10-19 13:08:38'),
('5d672153-df48-476a-b2cf-2a3149ab5fd5', 'usr-agus', 'PIC', 'Login', 'Sistem Monev SKI', '::1', '2026-10-15 09:55:29'),
('5d7e9352-dc3a-470c-b76e-03268d309644', 'usr-ketua', 'Ketua SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-14 09:19:22'),
('5da0738e-8b8e-4252-b7c0-09e2d00758d3', 'usr-pim', 'Pimpinan', 'Login', 'Sistem Monev SKI', '::1', '2026-10-15 10:13:39'),
('5dccf202-ca0c-4583-bb3a-52d6c900411d', 'usr-agus', 'PIC', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-14 10:11:43'),
('5de74294-7251-4945-b699-1487cff92e40', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Hapus Modul Pengawasan', 'ID: mod-4c360b37', '::1', '2026-10-15 08:11:37'),
('5f21c6cd-111d-4f30-a2c3-19e88340bc4b', 'usr-admin', 'Admin', 'Login', 'Sistem Monev SKI', '::1', '2026-10-20 10:06:17'),
('5f3aa73b-3a0b-451d-8892-6c157cb5410a', 'usr-pim', 'Pimpinan', 'Pimpinan menyetujui berkas eviden', 'SRS.pdf (Nobal Gp Abu Dhabi) - Versi 1', '::1', '2026-10-15 10:14:12'),
('5f5690ea-3260-4070-8eec-77e08a0a5288', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Ubah Modul Pengawasan', 'tes bulet (Status: terbit)', '::1', '2026-10-20 08:48:19'),
('6029710a-cf09-46e7-9a59-fa13bdbdfe4e', 'usr-agus', 'PIC', 'Login', 'Sistem Monev SKI', '::1', '2026-10-14 11:03:17'),
('609b7c2c-4854-4d88-9177-3ce78625d28a', 'usr-agus', 'PIC', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-14 08:55:50'),
('61142768-1240-4068-b73b-a1c80f21183c', 'usr-agus', 'PIC', 'Login', 'Sistem Monev SKI', '::1', '2026-10-15 10:31:16'),
('627bb17c-897b-4a2f-a28c-8ee0ac14e1bc', 'usr-agus', 'PIC', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-15 11:08:06'),
('6328d9bc-9be4-40af-a317-1a167b2c76dc', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-14 10:06:52'),
('636a1d45-6906-437a-8066-05c65c06da37', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Hapus Modul Pengawasan', 'ID: mod-mr', '::1', '2026-10-15 08:11:42'),
('6479eabf-736e-4dc2-9bfd-6849c1a98083', 'usr-dewi', 'PIC', 'Login', 'Sistem Monev SKI', '::1', '2026-10-19 13:33:12'),
('649e6883-74dd-41dc-b5c4-84499507e928', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-15 10:31:14'),
('64b62de7-2849-4082-b853-89aa05c88086', 'usr-admin', 'Admin', 'Login', 'Sistem Monev SKI', '::1', '2026-10-14 09:20:30'),
('64dd19a5-c127-4d64-982c-eb1c5d9300ee', 'usr-agus', 'PIC', 'Login', 'Sistem Monev SKI', '::1', '2026-10-14 09:51:23'),
('651c9571-104c-4a57-85f3-b1bc39575818', 'usr-agus', 'PIC', 'Login', 'Sistem Monev SKI', '::1', '2026-10-14 09:16:55'),
('6537cc64-5dba-4050-bb59-e452a3b82d15', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-19 14:35:07'),
('6644d4fa-6df0-4c4e-85d8-125468ec849e', 'usr-pim', 'Pimpinan', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-14 09:54:19'),
('6691895b-fa0b-4082-8c3e-0643d1804bce', 'usr-rina', 'Anggota SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-15 10:17:45'),
('671905d1-29fc-438d-8c02-58e4c607f724', 'usr-admin', 'Admin', 'Tambah Pengguna Baru', 'Jajang Mulyana (6969) - Role: ket', '::1', '2026-10-14 09:21:37'),
('678c123c-e3c7-4120-b4f3-192e3353b593', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-15 10:33:52'),
('67e73bda-91c1-4269-a11a-b9bf5e91a353', 'usr-rina', 'Anggota SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-15 09:58:50'),
('67f16017-3f81-4393-8125-c449afd2eba9', 'usr-admin', 'Admin', 'Login', 'Sistem Monev SKI', '::1', '2026-10-14 09:14:26'),
('68205308-6467-43d1-9ac9-c46cd44dbd73', 'usr-rina', 'Anggota SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-15 09:26:31'),
('6873d578-c951-4079-bac0-7d49a3c5a47e', 'usr-agus', 'PIC', 'Login', 'Sistem Monev SKI', '::1', '2026-10-15 08:43:10'),
('6967aad0-9e89-462a-9c0e-84885fd5e03c', 'usr-admin', 'Admin', 'Ubah Status Akun Pengguna', 'User ID: usr-admin', '::1', '2026-10-14 09:20:39'),
('69ddce7f-abe4-434d-9f0f-9f0d2348a267', 'usr-itjen', 'Itjen', 'Login', 'Sistem Monev SKI', '::1', '2026-10-19 13:09:28'),
('6a361152-f228-424a-b042-8d5638233495', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Upload Template Modul', 'Keuangan Bulan Oktober (Intership Agreement - Ginartriadi Affandi Draft.docx)', '::1', '2026-10-15 11:03:25'),
('6afec633-6fff-4642-86cb-31b501b030b9', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Tambah Modul Pengawasan', 'Nobal Gp Abu Dhabi', '::1', '2026-10-15 08:10:12'),
('6b381058-0796-4941-8d5a-3e112f0a0490', 'usr-budi', 'PIC', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-22 08:57:50'),
('6bcf4816-9f5e-461e-8ae1-95164d83e035', 'usr-rina', 'Anggota SKI', 'Kirim hasil review SKI', '1 butir eviden dievaluasi', '::1', '2026-10-15 09:57:51'),
('6c0c1c73-8f82-4276-bfc7-244e8b565e04', 'usr-budi', 'PIC', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-20 10:05:00'),
('6ce7d47f-e8bc-4303-8f36-cc3cadf960ce', 'usr-agus', 'PIC', 'Upload eviden baru', 'lampiran.pdf', '::1', '2026-10-15 10:11:59'),
('6d056a4d-8eb8-43a8-b1fb-a1a28c201c1d', 'usr-rina', 'Anggota SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-19 14:34:09'),
('6d5e1715-e098-4a84-8648-bda8c28e93a7', 'usr-rina', 'Anggota SKI', 'Ubah Modul Pengawasan', 'Sempol Balap (Status: terbit)', '::1', '2026-10-14 09:23:15'),
('7037a4a0-d65c-40dd-ac92-a836bc171df9', 'usr-agus', 'PIC', 'Login', 'Sistem Monev SKI', '::1', '2026-10-15 10:11:39'),
('712e6edd-11e4-4a40-bf14-89323ab21523', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Tambah Modul Pengawasan', 'Keuangan Bulan Oktober', '::1', '2026-10-15 10:18:57'),
('728c2190-93e4-4f3c-b4ba-644890d76639', 'usr-rina', 'Anggota SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-14 09:52:14'),
('729d2912-f4e5-4dbe-abf1-003cf2089624', 'usr-rina', 'Anggota SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-15 10:15:07'),
('736eaa98-e743-4bb4-bedf-e0a2e5f7281b', 'usr-agus', 'PIC', 'Upload eviden baru', 'lampiran.docx', '::1', '2026-10-15 09:58:34'),
('736f2427-779d-464c-bf17-2f2378f2d3a0', 'usr-agus', 'PIC', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-14 09:19:51'),
('7387112b-0322-4201-a9d6-1e3adb125203', 'usr-rina', 'Anggota SKI', 'Tambah Indikator Modul', 'Modul: mod-4c360b37 - Kenceng Tikungan', '::1', '2026-10-14 09:23:35'),
('74257b8e-acc5-48be-a84e-872c916ee1d1', 'usr-rina', 'Anggota SKI', 'Ubah Modul Pengawasan', 'KKR Laporan Keuangan (LRA, LO, LPE, Neraca, CaLK) (Status: draf)', '::1', '2026-10-22 08:33:57'),
('74cebdff-4e76-491d-9c37-c1943da59906', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Terbitkan Jadwal Pengawasan', 'Oktober 2026 (9 modul)', '::1', '2026-10-14 09:51:13'),
('758e6bb1-9b4a-4566-93fa-5d9fcfb0f8a6', 'usr-agus', 'PIC', 'Upload eviden baru', 'LRA_Triwulan_III_2026.pdf', '::1', '2026-10-14 09:16:56'),
('75a5f3c2-6b8f-41e3-aef3-1605bd63806c', 'usr-agus', 'PIC', 'Login', 'Sistem Monev SKI', '::1', '2026-10-15 09:26:23'),
('7637cb2c-493d-43b7-bffb-3164b913f390', 'usr-budi', 'PIC', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-19 14:34:18'),
('76ea9934-23f5-44a9-8ac6-790cc7214b84', 'usr-rina', 'Anggota SKI', 'Kirim hasil review SKI', '1 butir eviden dievaluasi', '::1', '2026-10-14 09:16:56'),
('77b6bcd9-1e56-4352-b450-8393d8c7d92e', 'usr-ketua', 'Ketua SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-14 09:18:13'),
('788e5c4c-d812-4e16-a125-5fb0576e78f3', 'usr-agus', 'PIC', 'Login', 'Sistem Monev SKI', '::1', '2026-10-19 12:57:34'),
('79e6be3d-7342-43c4-9685-a3ccc09c955d', 'usr-agus', 'PIC', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-14 10:48:20'),
('7a3a07ac-2cea-4c51-9efc-72b97c096e0a', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Ubah Modul Pengawasan', 'Nobal GP America (Status: draf)', '::1', '2026-10-15 08:19:17'),
('7a5bdb6b-cbfe-4dc2-a537-6f25389b328b', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-15 10:58:07'),
('7ab39c7b-bc7e-4497-a904-f13e9dfa08d5', 'usr-admin', 'Admin', 'Login', 'Sistem Monev SKI', '::1', '2026-10-14 09:45:54'),
('7b569f7b-4f53-457b-83ff-8aaece49f349', 'usr-agus', 'PIC', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-14 10:57:09'),
('7ba9994c-1347-4d6e-a704-600c0952e8c3', 'usr-dewi', 'PIC', 'Login', 'Sistem Monev SKI', '::1', '2026-10-19 14:35:23'),
('7bf9a74d-28bf-4db7-8c86-105cb803fabf', 'usr-rina', 'Anggota SKI', 'Kirim hasil review SKI', '1 butir eviden dievaluasi', '::1', '2026-10-14 09:52:51'),
('7c405964-3b1d-403b-bedc-abb9cbb3ade3', 'usr-dewi', 'PIC', 'Login', 'Sistem Monev SKI', '::1', '2026-10-19 13:33:12'),
('7c7b749c-8c32-4a5f-bb75-b80a59c7caae', 'usr-rina', 'Anggota SKI', 'Tambah Indikator Modul', 'Modul: mod-15a2e87e - ppk', '::1', '2026-10-19 14:34:55'),
('7ca676b0-1717-46d5-b8c7-57d6677a54ae', 'usr-pim', 'Pimpinan', 'Login', 'Sistem Monev SKI', '::1', '2026-10-14 09:14:42'),
('7cb71ff7-6aab-473a-8904-889e9590ae47', 'usr-admin', 'Admin', 'Login', 'Sistem Monev SKI', '::1', '2026-10-22 08:56:42'),
('7cc69280-5aaa-4faf-bc5a-2e10bf681125', 'usr-pim', 'Pimpinan', 'Pimpinan melihat rekomendasi', 'ID Rek: ba10f168-c918-4413-bb72-874f37e483bd', '::1', '2026-10-14 10:25:52'),
('7d654008-3bbb-4c83-acc8-599ed39fea92', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Tambah Indikator Modul', 'Modul: mod-9f3f7fd1 - Sponsor', '::1', '2026-10-15 08:10:38'),
('7dae58a7-1b75-445b-9cc9-9d9d2402f3a0', 'usr-rina', 'Anggota SKI', 'Ubah Modul Pengawasan', 'Keuangan Bulan Oktober (Status: draf)', '::1', '2026-10-22 08:34:00'),
('7df06547-b57f-44c1-ab1f-47ca32777117', 'usr-agus', 'PIC', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-15 11:03:48'),
('7e11ac66-d12e-4f1e-873a-03171294f5e9', 'usr-rina', 'Anggota SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-15 11:05:17'),
('7f5ef623-1be6-4739-8bd2-5ba629fe5fe0', 'usr-rina', 'Anggota SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-14 09:51:42'),
('7fb9a8f1-f21b-4f4e-b753-0e271e5b9b4d', 'usr-agus', 'PIC', 'Upload perbaikan eviden', 'Tecno Spark - Ginartriadi Affandi.pdf (v2)', '::1', '2026-10-14 09:52:30'),
('81525181-7121-4ced-ae74-86b20f6ff2c2', 'usr-rina', 'Anggota SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-20 14:25:52'),
('81c6b991-37ed-49ee-8c3f-8b38c9920677', 'usr-rina', 'Anggota SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-19 13:06:57'),
('825d982b-fc9d-41fc-a0f8-b95ed77dca75', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Ubah Modul Pengawasan', 'Info Loke Redesign (Status: terbit)', '::1', '2026-10-14 10:48:59'),
('826f9f6f-fa7d-4875-bc5e-42784639db50', 'usr-admin', 'Admin', 'Login', 'Sistem Monev SKI', '::1', '2026-10-15 07:45:48'),
('827b39ea-476e-4b44-b901-474d323b8392', 'usr-agus', 'PIC', 'Login', 'Sistem Monev SKI', '::1', '2026-10-14 10:57:12'),
('843a778d-f062-4d91-b1b3-00cb036962c5', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-20 14:25:58'),
('846a5fb0-c3d3-48c2-a7f4-2943efc8d69b', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Upload Template Modul', 'Nobal Gp Abu Dhabi (Form_Format_Standar_Monev.xlsx)', '::1', '2026-10-15 11:01:30'),
('846da6ef-393d-4e54-83c1-186a1887df54', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-15 10:17:19'),
('84c8ec08-39a8-436a-9e77-b9b4ba70a624', 'usr-admin', 'Admin', 'Ubah Peran Pengguna', 'User: usr-rina -> Role: ang', '::1', '2026-10-15 07:46:28'),
('8515fe64-9e0a-4377-8647-59ca2005044b', 'usr-dewi', 'PIC', 'Login', 'Sistem Monev SKI', '::1', '2026-10-19 13:35:06'),
('85683ff1-9e85-4337-b29c-ef47b2da8093', 'usr-agus', 'PIC', 'Upload eviden baru', 'Intership Agreement - Ginartriadi Affandi Draft.docx', '::1', '2026-10-14 09:51:35'),
('861750c6-ec53-4000-86e4-e5f094cda051', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-15 10:17:26'),
('866a61d8-90c3-49d8-be19-6ef987ac3dce', 'usr-agus', 'PIC', 'Login', 'Sistem Monev SKI', '::1', '2026-10-19 13:33:12'),
('86a85351-343c-4244-9d7a-0db73d3feb15', 'usr-pim', 'Pimpinan', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-14 09:56:11'),
('86b1c457-945a-4de5-8278-f378c7ff64de', 'usr-rina', 'Anggota SKI', 'Ubah Modul Pengawasan', 'Nobal Gp Abu Dhabi (Status: draf)', '::1', '2026-10-22 09:22:28'),
('871be2e1-ea8a-4c97-811a-05379aef6d09', 'usr-agus', 'PIC', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-14 10:40:40'),
('87462646-9363-45fa-8c55-5b1ac6420926', 'usr-admin', 'Admin', 'Perubahan RBAC Granular', 'Role: adm, Menu: dash, Aksi: l -> 0', '::1', '2026-10-15 07:47:07'),
('876dec10-8fa9-4ba8-8214-4dd5bda325de', 'usr-rina', 'Anggota SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-15 08:47:29'),
('8854ecc9-455a-4fa5-90e4-b23e5d086350', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-14 10:40:43'),
('8a3e3dae-cb35-43ae-bb26-0558ef0db508', 'usr-rina', 'Anggota SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-15 09:26:51'),
('8af2f2ed-9bee-4b8b-b1a3-6c1d90af07d1', 'usr-budi', 'PIC', 'Login', 'Sistem Monev SKI', '::1', '2026-10-19 13:33:12'),
('8af617fb-9d02-4cfa-8967-ffaa9dc9e9ef', 'usr-agus', 'PIC', 'Login', 'Sistem Monev SKI', '::1', '2026-10-15 08:45:03'),
('8b6676ad-b966-45d8-977f-3f38002d5d46', 'usr-rina', 'Anggota SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-19 13:06:17'),
('8b7294cf-3ad2-4a23-ac93-03fa0a8e04b6', 'usr-admin', 'Admin', 'Perubahan RBAC Granular', 'Role: adm, Menu: dash, Aksi: l -> 1', '::1', '2026-10-15 07:47:02'),
('8c3fe2aa-8986-4e30-aa39-56d4b501cfcf', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Ubah Modul Pengawasan', 'Info Loker Redesign (Status: terbit)', '::1', '2026-10-14 10:49:12'),
('8c42c0a1-b1a6-4463-a643-8a5a1d58c990', 'usr-rina', 'Anggota SKI', 'Hapus Template Modul', 'Mitigasi & Manajemen Risiko', '::1', '2026-10-22 08:32:54'),
('8c43d749-761c-4883-a8d8-dd95bd7f9037', 'usr-rina', 'Anggota SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-15 10:12:24'),
('8c64f8a4-8db5-4c70-8657-55e7201de0b4', 'usr-rina', 'Anggota SKI', 'Ubah Modul Pengawasan', 'PBJ (Pengadaan Barang & Jasa) (Status: draf)', '::1', '2026-10-22 08:33:51'),
('8d826ae2-e801-4318-90cf-1eca7a88fb91', 'usr-agus', 'PIC', 'Login', 'Sistem Monev SKI', '::1', '2026-10-15 10:33:31'),
('8e388dcf-943f-4b8b-a1d8-733d9a4b3c63', 'usr-agus', 'PIC', 'Login', 'Sistem Monev SKI', '::1', '2026-10-14 09:45:54'),
('8f52861c-a290-4c8b-ba18-ac0f352796d5', 'usr-rina', 'Anggota SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-19 13:35:03'),
('8f8f0ed9-00f8-4b25-9220-5cb8697157ef', 'usr-budi', 'PIC', 'Login', 'Sistem Monev SKI', '::1', '2026-10-19 14:33:36'),
('90380b5c-85fb-4490-8c56-a9825f5a1a97', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Hapus Modul Pengawasan', 'ID: mod-sakip', '::1', '2026-10-22 09:00:05'),
('90580b82-8f29-4d88-9ce4-ad0b3d86f1d8', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Approval berkas Ketua SKI', '1 berkas disetujui', '::1', '2026-10-15 10:13:29');
INSERT INTO `audit_logs` (`id_log`, `id_user`, `role_saat_aksi`, `jenis_aksi`, `objek_target`, `ip_address`, `timestamp_aktivitas`) VALUES
('90deba8f-d9ab-4ccc-9f7f-806d328cb055', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-15 08:12:10'),
('914a28c3-4bb7-4187-a6bc-c9dba740493d', 'usr-admin', 'Admin', 'Login', 'Sistem Monev SKI', '::1', '2026-10-14 09:14:42'),
('91532454-a7d6-4610-afbc-bdb87a080124', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-15 08:54:11'),
('9192b36f-e77c-4b2f-82af-69318c320806', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Tambah Indikator Modul', 'Modul: mod-da0e35e4 - test 1', '::1', '2026-10-15 10:19:06'),
('924876c9-c81a-44ab-acd1-c2942454ac60', 'usr-agus', 'PIC', 'Login', 'Sistem Monev SKI', '::1', '2026-10-19 14:35:42'),
('92cae731-21d4-4cd4-bf56-2a1528c45d44', 'usr-rina', 'Anggota SKI', 'Kirim hasil review SKI', '1 butir eviden dievaluasi', '::1', '2026-10-14 09:52:11'),
('93102ff3-81d1-48e5-a7d9-c4bf7acdd924', 'usr-agus', 'PIC', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-22 08:58:27'),
('94134e3e-70cb-422b-a8d4-a64ca3ca25a7', 'usr-rina', 'Anggota SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-15 10:16:53'),
('9440ae7a-715a-4be5-8352-850ba6c38465', 'usr-rina', 'Anggota SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-15 10:11:37'),
('94a3a88a-78ac-41d0-b4c5-6e0f2bf84f47', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-20 10:06:14'),
('954a1fce-e26f-4288-8d92-0a0750037364', 'usr-rina', 'Anggota SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-14 10:08:15'),
('963cd773-4875-48cc-9ca7-30597c24cf67', 'usr-rina', 'Anggota SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-19 14:34:31'),
('968f065e-1173-40a1-a96d-d240b9bc55bb', 'usr-agus', 'PIC', 'Login', 'Sistem Monev SKI', '::1', '2026-10-15 11:03:53'),
('97364216-2f5f-4437-ba57-32073feee413', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-19 13:22:47'),
('97a0bdac-4c7c-44cc-9b40-59bfdd1dec87', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-14 10:42:21'),
('98016bf7-2c9e-45bb-b8a9-0a132cf8c264', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-15 10:19:20'),
('986baa44-e373-4361-b553-e0c3b9dc5314', 'usr-agus', 'PIC', 'Upload eviden baru', 'INTERNSHIP AGREEMENT FORM (1).pdf', '::1', '2026-10-19 13:06:12'),
('98d749d8-1644-4509-97e2-fd5ca37901a1', 'usr-rina', 'Anggota SKI', 'Ubah Modul Pengawasan', 'tes bulet (Status: draf)', '::1', '2026-10-22 08:33:39'),
('99071f0d-fc55-4458-b972-df14b518798c', 'usr-rina', 'Anggota SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-14 09:45:54'),
('996a3370-f941-4d58-92e4-cbad825e4bb0', 'usr-agus', 'PIC', 'Login', 'Sistem Monev SKI', '::1', '2026-10-19 13:34:52'),
('99b63638-8cec-4abd-82d1-db008f3bb587', 'usr-dewi', 'PIC', 'Login', 'Sistem Monev SKI', '::1', '2026-10-19 14:35:00'),
('9a71326f-5115-4653-95a9-115e86f43bdd', 'usr-pim', 'Pimpinan', 'Pimpinan menyetujui evaluasi modul', 'Tugas modul selesai', '::1', '2026-10-14 09:25:03'),
('9acf8d5a-fe43-428d-9829-90895a41a4a0', 'usr-agus', 'PIC', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-19 13:20:17'),
('9ad89d6a-80f2-4104-b401-1d2914c27f22', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-15 10:37:54'),
('9b0a33a9-f74c-4f05-8c46-0c26379a68d9', 'usr-rina', 'Anggota SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-15 09:55:19'),
('9baef8e0-7b91-4cb5-9faf-53fe12e61676', 'usr-rina', 'Anggota SKI', 'Ubah Modul Pengawasan', 'Sempol Balap (Status: terbit)', '::1', '2026-10-14 09:23:09'),
('9bcfe575-2657-4928-b021-a5bef1b3c17e', 'usr-admin', 'Admin', 'Perubahan RBAC Granular', 'Role: adm, Menu: dash, Aksi: l -> 1', '::1', '2026-10-15 07:47:00'),
('9be261ff-6a4e-4c94-8ec3-5dd63a245387', 'usr-rina', 'Anggota SKI', 'Ubah Modul Pengawasan', 'Konflik Kepentingan (Status: terbit)', '::1', '2026-10-14 09:23:01'),
('9c257fb1-a7d8-416e-9d0d-238b5123e3eb', 'usr-rina', 'Anggota SKI', 'Kirim hasil review SKI', '1 butir eviden dievaluasi', '::1', '2026-10-15 08:48:18'),
('9cc0bb15-5cb8-4376-8c8f-7dd99a28d524', 'usr-rina', 'Anggota SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-19 13:34:59'),
('9cc509bf-0735-4cf5-854b-9cd47a30e0a6', 'usr-pim', 'Pimpinan', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-15 10:15:04'),
('9cd5a5c4-4b90-4953-937e-eada499d3123', 'usr-ketua', 'Ketua SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-14 09:16:56'),
('9dc7b938-ce24-4f38-97f1-42ce91a969a0', 'usr-agus', 'PIC', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-15 10:16:51'),
('9dd4267a-f97c-47d6-a243-7d6ebe699afa', 'usr-rina', 'Anggota SKI', 'Tambah Modul Pengawasan', 'Keuangan Bulan Oktober', '::1', '2026-10-15 10:15:33'),
('9defacb0-10a9-4c89-8301-98f5f0cc013c', 'usr-budi', 'PIC', 'Login', 'Sistem Monev SKI', '::1', '2026-10-20 14:24:38'),
('9df4099c-64c5-4dba-aaa5-f694a30c0b50', 'usr-agus', 'PIC', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-19 13:07:45'),
('9ed8171b-c04b-46c7-9421-cb7d225800e6', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-14 09:56:14'),
('9ef1c525-7a5a-42c6-9760-964d582766c0', 'usr-dewi', 'PIC', 'Login', 'Sistem Monev SKI', '::1', '2026-10-19 14:34:23'),
('9ffbf50a-195b-47b7-91b6-72e0fc743f8c', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-14 10:47:04'),
('a03ea826-82f7-46bc-b29b-49ecdf7c6a21', 'usr-pim', 'Pimpinan', 'Pimpinan melihat rekomendasi', 'ID Rek: ba10f168-c918-4413-bb72-874f37e483bd', '::1', '2026-10-15 08:12:01'),
('a06c90b1-dd05-4309-aacf-1e0b2a45c703', 'usr-budi', 'PIC', 'Login', 'Sistem Monev SKI', '::1', '2026-10-19 13:33:12'),
('a111c986-2418-453e-b4c2-688d14dcda08', 'usr-agus', 'PIC', 'Login', 'Sistem Monev SKI', '::1', '2026-10-14 09:52:16'),
('a157d82b-a41b-4c6f-b2be-fa4d10538f0d', 'usr-pim', 'Pimpinan', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-14 10:07:42'),
('a183fa11-6adb-482e-95da-3328e711d2ea', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Tambah Indikator Modul', 'Modul: mod-da0e35e4 - test 3', '::1', '2026-10-19 12:37:46'),
('a200c1aa-7dd4-4760-9969-b8e32fcc6ae1', 'usr-rina', 'Anggota SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-20 14:25:55'),
('a32f2890-1ef7-4905-9072-e613a02f4501', 'usr-budi', 'PIC', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-20 08:56:53'),
('a34bbd25-fd44-46ea-b10a-4afbbe342de2', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Tambah Indikator Modul', 'Modul: mod-9f3f7fd1 - Venue', '::1', '2026-10-15 08:10:43'),
('a3584839-f976-412e-8c61-a2dd5420985b', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-20 14:24:26'),
('a3f6e564-e157-4306-99e4-00c6bfeb09a4', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-15 07:45:42'),
('a42fb3b4-73ce-4c76-adaa-4ce8ca47d2a3', 'usr-ketua', 'Ketua SKI', 'Approval berkas Ketua SKI', '1 berkas disetujui', '::1', '2026-10-14 09:16:56'),
('a43754c1-01f9-42df-96e7-54e2bbcb52b5', 'usr-agus', 'PIC', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-15 11:09:15'),
('a4a9cb62-8683-44aa-a77f-6b0a96633f3d', 'usr-budi', 'PIC', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-20 08:33:39'),
('a6323d41-f2fc-4930-a088-55e51cbfac75', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Terbitkan Jadwal Pengawasan', 'Oktober 2026 (3 modul)', '::1', '2026-10-15 10:17:24'),
('a6650beb-2f1d-45ec-8714-3bad936d5767', 'usr-rina', 'Anggota SKI', 'Ubah Modul Pengawasan', 'Pengendalian Intern Pelaporan Keuangan (PIPK) (Status: draf)', '::1', '2026-10-22 08:33:48'),
('a6a6ffb2-0062-46ca-a3df-49f01acc3151', 'usr-admin', 'Admin', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-15 07:52:06'),
('a6f00b8f-2aba-4e48-bdab-f373fe7b5726', 'usr-agus', 'PIC', 'Login', 'Sistem Monev SKI', '::1', '2026-10-14 10:40:33'),
('a7bb9040-5262-4fdb-accb-ea2edf080acd', 'usr-agus', 'PIC', 'Login', 'Sistem Monev SKI', '::1', '2026-10-15 08:46:26'),
('a85e6432-d920-4adf-b67d-51f3960e6071', 'usr-rina', 'Anggota SKI', 'Kirim hasil review SKI', '1 butir eviden dievaluasi', '::1', '2026-10-19 13:09:16'),
('a9ea5fe8-2b98-40c0-9a00-67ca6cc06459', 'usr-pim', 'Pimpinan', 'Pimpinan menyetujui berkas eviden', 'Senin 28 Oktober 2026 - Logbook Kegiatan Harian.pdf (Keuangan Bulan Oktober) - Versi 1', '::1', '2026-10-19 13:08:50'),
('aa387708-46ce-414f-8d6e-20fe1485430a', 'usr-pim', 'Pimpinan', 'Pimpinan menyetujui berkas eviden', 'lampiran.pdf (Nobal GP America) - Versi 1', '::1', '2026-10-15 08:48:46'),
('ab145e24-88e1-4896-8f21-e818379a0732', 'usr-agus', 'PIC', 'Login', 'Sistem Monev SKI', '::1', '2026-10-15 11:03:30'),
('ab23ba15-e1a2-4403-b02a-6c4791d1276f', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Ubah Modul Pengawasan', 'Nobal GP America (Status: terbit)', '::1', '2026-10-15 08:19:19'),
('ab479ebd-0bc4-44c4-baf7-0a31af91c904', 'usr-agus', 'PIC', 'Upload eviden baru', '2024-07-16_-_Internship_Handbook_SY_24_25 -Indonesia Version.pdf', '::1', '2026-10-15 08:46:43'),
('ab627b60-9d97-43f4-8c0d-c755db616ff6', 'usr-rina', 'Anggota SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-15 09:55:46'),
('ac00b8e8-1b56-48f3-9510-7f4732aa021a', 'usr-agus', 'PIC', 'Login', 'Sistem Monev SKI', '::1', '2026-10-14 10:47:38'),
('ac0d1ac7-b8a2-4dbd-ad03-a4a5a36c36e4', 'usr-admin', 'Admin', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-15 07:46:10'),
('ad06a3ad-b9f0-4097-8cd8-a72afb61de1d', 'usr-pim', 'Pimpinan', 'Pimpinan melihat rekomendasi', 'ID Rek: ba10f168-c918-4413-bb72-874f37e483bd', '::1', '2026-10-14 09:54:08'),
('ad1fc961-1579-4087-9d37-321bc9870c4b', 'usr-rina', 'Anggota SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-19 12:36:59'),
('ae7fd5c1-0279-4972-9b8d-1c9c7007787d', 'usr-ketua', 'Ketua SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-19 13:33:12'),
('ae875322-e2f8-4bf5-a2e2-31a9bbc31212', 'usr-agus', 'PIC', 'Login', 'Sistem Monev SKI', '::1', '2026-10-14 09:25:32'),
('aef90c3e-cfb8-4a75-a01c-37b48aa32f6d', 'usr-agus', 'PIC', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-15 09:38:07'),
('af0ae567-eaf3-47ca-9269-0065e39c9a4c', 'usr-rina', 'Anggota SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-19 13:33:12'),
('af318072-a049-4cd4-bf48-53c0af19b0af', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-19 13:20:23'),
('af385821-342c-41e5-80b3-2d5df18661ec', 'usr-pim', 'Pimpinan', 'Pimpinan menyetujui evaluasi modul', 'Tugas modul selesai', '::1', '2026-10-14 10:07:29'),
('af46440e-734c-40df-83f8-c45d051e850e', 'usr-rina', 'Anggota SKI', 'Ubah Modul Pengawasan', 'SAKIP / Laporan Kinerja (Status: draf)', '::1', '2026-10-22 08:33:43'),
('afb0889b-4c27-4de4-9755-27d142dea095', 'usr-rina', 'Anggota SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-14 09:18:11'),
('aff600de-dccc-49c0-9d8e-4d6f3b7390d4', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-15 10:37:35'),
('b005070e-6fd4-4a5b-8bd3-5c11f3db6495', 'usr-pim', 'Pimpinan', 'Pimpinan menyetujui berkas eviden', 'PROPOSAL MAGANG - PERDI PRATAMA.pdf (Nobal GP America) - Versi 1', '::1', '2026-10-15 08:48:44'),
('b0544efc-d59b-4bfe-ab07-48bfa8adbf72', 'usr-rina', 'Anggota SKI', 'Ubah Modul Pengawasan', 'Nobal Gp Abu Dhabi (Status: draf)', '::1', '2026-10-22 09:22:29'),
('b06c0668-0932-496e-a7ba-c0bd2f77652b', 'usr-rina', 'Anggota SKI', 'Ubah Modul Pengawasan', 'Kepatuhan LHKPN & SPT (Status: draf)', '::1', '2026-10-22 08:34:10'),
('b0a5be49-7285-417c-8daa-e853bf0883ab', 'usr-pim', 'Pimpinan', 'Pimpinan melihat rekomendasi', 'ID Rek: ba10f168-c918-4413-bb72-874f37e483bd', '::1', '2026-10-14 10:07:26'),
('b0a755db-c400-41bd-a9b8-997cfef8bdc6', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Tambah Indikator Modul', 'Modul: mod-a34bf986 - Inventaris', '::1', '2026-10-14 10:49:59'),
('b0bbfff9-95b1-4780-a613-242031b021f6', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Approval berkas Ketua SKI', '1 berkas disetujui', '::1', '2026-10-14 10:08:29'),
('b0bf52bf-eeca-447d-ac55-f52ad3b92e45', 'usr-agus', 'PIC', 'Login', 'Sistem Monev SKI', '::1', '2026-10-15 08:48:59'),
('b0dfa0ce-88fe-4e35-b3d6-d762279f0bee', 'usr-rina', 'Anggota SKI', 'Tambah Indikator Modul', 'Modul: mod-f268e5a9 - Kerusakan Barang Bulan Oktober', '::1', '2026-10-15 10:16:01'),
('b0fda5cc-e676-48e8-bc76-59bfaccabcaa', 'usr-agus', 'PIC', 'Login', 'Sistem Monev SKI', '::1', '2026-10-14 10:13:12'),
('b132349c-56c2-4087-801d-7377efab6825', 'usr-pim', 'Pimpinan', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-15 08:50:07'),
('b2702176-eec8-4b86-ab48-347bad9d901c', 'usr-admin', 'Admin', 'Perubahan RBAC Granular', 'Role: adm, Menu: dash, Aksi: t -> 0', '::1', '2026-10-15 07:47:09'),
('b37409e1-bedc-436b-a73e-02f2b11f8f18', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-20 08:48:24'),
('b4ca710f-faf2-446f-a595-ddebfcd96562', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-19 13:09:19'),
('b5300ee7-d13a-4fc0-95ba-237a09e5cf84', 'usr-rina', 'Anggota SKI', 'Kirim hasil review SKI', '1 butir eviden dievaluasi', '::1', '2026-10-15 10:12:59'),
('b5515785-a00a-4de3-b618-50518a8db005', 'usr-dewi', 'PIC', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-19 14:35:03'),
('b71aafe7-50ab-4e85-ade4-2457f9148323', 'usr-admin', 'Admin', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-14 10:13:09'),
('b76f2dea-2e4e-43cc-aded-fa3534e203be', 'usr-rina', 'Anggota SKI', 'Ubah Modul Pengawasan', 'Sempol Balap (Status: draf)', '::1', '2026-10-14 09:23:12'),
('b791345d-d301-4f8f-8f23-a78ceec8260a', 'usr-pim', 'Pimpinan', 'Pimpinan melihat rekomendasi', 'ID Rek: ba10f168-c918-4413-bb72-874f37e483bd', '::1', '2026-10-14 09:53:55'),
('b7a47532-35e3-4cff-b0a3-3554e0d0d651', 'usr-pim', 'Pimpinan', 'Login', 'Sistem Monev SKI', '::1', '2026-10-15 08:11:54'),
('b88cb356-c62b-4487-9857-78c498e5ab49', 'usr-ketua', 'Ketua SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-14 09:19:55'),
('b88d5d00-046a-40db-b869-297f3d720b7e', 'usr-agus', 'PIC', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-15 10:18:44'),
('b8b56132-f330-4e9a-9863-8b45406c493e', 'usr-pim', 'Pimpinan', 'Pimpinan memberikan disposisi perbaikan', 'ss', '::1', '2026-10-14 09:54:13'),
('b9accc7c-350c-41e9-99e6-78ebdf15c755', 'usr-itjen', 'Itjen', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-15 09:26:20'),
('ba7b8a8d-b928-459f-9fdf-009ce88ef3ab', 'usr-agus', 'PIC', 'Login', 'Sistem Monev SKI', '::1', '2026-10-22 08:58:15'),
('baa08af9-aef4-43b9-9174-6ad4f4ca439c', 'usr-rina', 'Anggota SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-21 10:54:23'),
('baca1d0a-8a75-48a0-b865-6b5113314414', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Hapus Modul Pengawasan', 'ID: mod-pipk', '::1', '2026-10-22 09:00:01'),
('baf38d82-5b10-448b-a438-a7d46d71d050', 'usr-rina', 'Anggota SKI', 'Ubah Modul Pengawasan', 'Kepatuhan LHKPN & SPT (Status: draf)', '::1', '2026-10-22 08:34:07'),
('bb37e9fc-c5d5-4e1a-8e33-153086c5f878', 'usr-rina', 'Anggota SKI', 'Ubah Modul Pengawasan', 'Nobal Gp Abu Dhabi (Status: terbit)', '::1', '2026-10-19 14:33:56'),
('bc1119cb-6b93-47d1-a205-ef9e911178c6', 'usr-pim', 'Pimpinan', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-14 10:09:00'),
('bc430616-108d-4aad-aa76-477ffe9cd707', 'usr-pim', 'Pimpinan', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-14 09:25:10'),
('bc48bd20-a0e0-4e6f-987d-798a344b6359', 'usr-pim', 'Pimpinan', 'Login', 'Sistem Monev SKI', '::1', '2026-10-14 09:53:46'),
('bc9ddb74-809d-4c5b-b471-b495f81d2a45', 'usr-agus', 'PIC', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-15 09:46:22'),
('bdb286ae-2350-44b5-a0be-f917fd457671', 'usr-rina', 'Anggota SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-19 13:09:17'),
('bdb529ba-d131-499f-8649-7ca8b7ae38b7', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-15 10:29:57'),
('bdbc486c-caa5-4c1a-86b1-8a022b3236a1', 'usr-ketua', 'Ketua SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-14 08:55:32'),
('bdf63fc3-bb5a-4e71-b134-f15242abf0a5', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Ubah Indikator Modul', 'ID: ind-itjen-1 - Dokumen Surat Atensi (SA) Tindak Lanjut Temuan Itjen', '::1', '2026-10-20 08:47:07'),
('be72f1d8-3e97-4143-8a57-d138ecb35593', 'usr-rina', 'Anggota SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-19 13:08:06'),
('be77f2e5-3c72-4c18-94fa-0a8912491fdd', 'usr-rina', 'Anggota SKI', 'Ubah Modul Pengawasan', 'Kepatuhan LHKPN & SPT (Status: terbit)', '::1', '2026-10-22 08:34:09'),
('befacc73-207d-4de2-8086-3598b2b5807e', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-14 10:58:28'),
('bf09b1c1-af2d-4d84-8601-716c986a54ca', 'usr-agus', 'PIC', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-15 09:55:44'),
('bf30e6a5-9348-45f3-afd7-4f1960836ce6', 'usr-admin', 'Admin', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-14 10:43:01'),
('c012c692-0bcf-4f85-94fc-01557df2fb1d', 'usr-itjen', 'Itjen', 'Login', 'Sistem Monev SKI', '::1', '2026-10-14 10:43:04'),
('c01d9612-d015-4025-89f9-78e716e54718', 'usr-admin', 'Admin', 'Login', 'Sistem Monev SKI', '::1', '2026-10-20 08:49:25'),
('c0211879-96f7-464a-b56f-9b0f4175e06f', 'usr-rina', 'Anggota SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-15 09:55:27'),
('c157e5ed-c96f-4484-9783-c2b6f3dae66f', 'usr-rina', 'Anggota SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-22 08:57:36'),
('c16ca999-1333-485d-bf73-1a9c5ad874ef', 'usr-rina', 'Anggota SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-20 14:23:18'),
('c207cb28-8082-4fd4-85c0-885c79765efb', 'usr-rina', 'Anggota SKI', 'Kirim hasil review SKI', '1 butir eviden dievaluasi', '::1', '2026-10-15 08:48:15'),
('c2251d7b-bb45-474e-85a4-4e5789985f55', 'usr-agus', 'PIC', 'Login', 'Sistem Monev SKI', '::1', '2026-10-15 08:19:41'),
('c27c9668-8030-4401-91fd-7965aedcc965', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-15 08:45:58'),
('c2885b36-5a5a-4e48-8679-f26716d82d45', 'usr-itjen', 'Itjen', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-19 13:10:11'),
('c2c12c16-afae-44fe-b8dd-ab70097f8cb3', 'usr-rina', 'Anggota SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-14 09:21:59'),
('c2e5ffe3-7fe5-44b7-9b7d-7d43ab6abe81', 'usr-agus', 'PIC', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-15 09:58:48'),
('c4b4dbec-8ddf-49db-9868-a0a9866f1e79', 'usr-admin', 'Admin', 'Login', 'Sistem Monev SKI', '::1', '2026-10-14 08:55:53'),
('c50bb23f-1f7e-47a5-ae06-3329554de36f', 'usr-admin', 'Admin', 'Login', 'Sistem Monev SKI', '::1', '2026-10-14 10:12:54'),
('c5138b1f-8575-4caf-bdab-17c88c726f84', 'usr-pim', 'Pimpinan', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-15 08:12:08'),
('c5760422-56b0-4316-a720-44f6c42b0214', 'usr-agus', 'PIC', 'Login', 'Sistem Monev SKI', '::1', '2026-10-20 08:56:56'),
('c5d1eace-7c2c-40af-bda5-1cbcb2697982', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-19 12:37:48'),
('c6300c22-0e49-4211-864b-4a7b2706a984', 'usr-rina', 'Anggota SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-20 14:25:50'),
('c66ebae9-4308-44b8-bac4-f57a8d58732e', 'usr-pim', 'Pimpinan', 'Pimpinan menyetujui berkas eviden', 'Tecno Spark - Ginartriadi Affandi.pdf (Sempol Balap) - Versi 2', '::1', '2026-10-14 10:47:32'),
('c67d49a0-82c9-465c-a9d1-52121ab71467', 'usr-ketua', 'Ketua SKI', 'Kirim rekomendasi ke Pimpinan', 'Modul ID: mod-lk', '::1', '2026-10-14 09:16:56'),
('c680a4c4-2a1b-4c49-bd23-43ad4b804cdd', 'usr-agus', 'PIC', 'Upload eviden baru', 'Ginartriadi Affandi_ATS.pdf', '::1', '2026-10-14 09:19:48'),
('c6a229f3-4569-4290-ba3d-02668696630d', 'usr-rina', 'Anggota SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-22 08:38:50'),
('c6d9dfcc-cf3b-43ed-98a1-d9e73a61e754', 'usr-budi', 'PIC', 'Login', 'Sistem Monev SKI', '::1', '2026-10-20 09:16:23'),
('c74e83b6-8196-472b-b76d-b50f38143835', 'usr-agus', 'PIC', 'Login', 'Sistem Monev SKI', '::1', '2026-10-14 10:09:02'),
('c79a04dd-5248-48b9-8861-a494b235a1b6', 'usr-pim', 'Pimpinan', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-15 08:48:57'),
('c815bb31-abe9-40ad-b858-cfa3fc2c3455', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Approval berkas Ketua SKI', '1 berkas disetujui', '::1', '2026-10-19 13:08:36'),
('c81b515f-e902-4fde-ace4-83d629936c5a', 'usr-rina', 'Anggota SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-19 13:35:40'),
('c88c8f1a-d732-4619-8777-a1bde5a41934', 'usr-ketua', 'Ketua SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-14 09:14:42'),
('c8ad6178-0c2d-4f7d-bb96-2484005f8695', 'usr-rina', 'Anggota SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-14 11:16:07'),
('c8f26df9-ae0e-469c-8c11-e32a781d7aef', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-15 08:19:39'),
('c93633aa-e6ce-4502-bebe-a105c218df61', 'usr-agus', 'PIC', 'Login', 'Sistem Monev SKI', '::1', '2026-10-19 12:37:51'),
('ca6d2e44-4bd8-4a42-91c8-0a3288f6cae9', 'usr-rina', 'Anggota SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-14 09:23:52'),
('ca77d0e5-e130-4022-9005-23863f924c9d', 'usr-agus', 'PIC', 'Login', 'Sistem Monev SKI', '::1', '2026-10-14 11:01:06'),
('caad5e4c-1644-4172-ac10-3ba1fa1511cd', 'usr-admin', 'Admin', 'Login', 'Sistem Monev SKI', '::1', '2026-10-14 10:42:24'),
('cb5705c4-dfff-4acf-829a-401be9e9049c', 'usr-rina', 'Anggota SKI', 'Tambah Indikator Modul', 'Modul: mod-4c360b37 - Minim Drag', '::1', '2026-10-14 09:23:40'),
('cb91c61b-a23f-4f23-9a3c-d38fe8854846', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-20 10:05:04'),
('cc9952e2-3b48-45c8-ae7b-a186e3a51604', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Hapus Modul Pengawasan', 'ID: mod-itjen', '::1', '2026-10-22 08:59:34'),
('cd57fd5b-50fb-471d-8be6-9b95334fc156', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-15 08:40:00'),
('cdd4e307-31de-40bd-aaf9-57b56e1c4bb6', 'usr-rina', 'Anggota SKI', 'Ubah Modul Pengawasan', 'Nobal Gp Abu Dhabi (Status: draf)', '::1', '2026-10-22 09:22:31'),
('cec02d2b-566e-401f-a39e-3abc0d3ee49b', 'usr-dewi', 'PIC', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-19 14:34:27'),
('cf080b1e-39e7-4a28-ba96-8300c2d940fc', 'usr-admin', 'Admin', 'Login', 'Sistem Monev SKI', '::1', '2026-10-19 13:35:52'),
('cfb61023-b6b1-446d-b0a8-a41a5dba453d', 'usr-rina', 'Anggota SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-22 08:39:03'),
('cfe1059b-07c1-4c31-a2f6-0168cd4e030a', 'usr-pim', 'Pimpinan', 'Pimpinan menyetujui berkas eviden', 'lampiran.docx (Nobal Gp Abu Dhabi) - Versi 2', '::1', '2026-10-15 10:13:58'),
('d04a4281-e4b4-4ecc-9416-afa92a9cfac6', 'usr-rina', 'Anggota SKI', 'Update Status Modul', 'Modul mod-kkr status: terbit', '::1', '2026-10-20 10:26:09'),
('d07feee9-cf83-409b-b628-ec292c538b12', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Tambah Modul Pengawasan', 'tes bulet', '::1', '2026-10-20 08:47:38'),
('d0da78df-7668-466f-8eb2-e29729a1a8ea', 'usr-itjen', 'Itjen', 'Login', 'Sistem Monev SKI', '::1', '2026-10-14 09:45:54'),
('d11aeea8-9043-43a3-92b7-bd85228d2b17', 'usr-admin', 'Admin', 'Login', 'Sistem Monev SKI', '::1', '2026-10-20 14:23:11'),
('d18d653a-907f-4697-a6c0-0f70ac292e9c', 'usr-agus', 'PIC', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-15 08:49:57'),
('d297c8e8-3c99-4b7f-a10a-a10a4d4c1b38', 'usr-pim', 'Pimpinan', 'Login', 'Sistem Monev SKI', '::1', '2026-10-15 08:50:02'),
('d3e0a8c0-e987-4737-8a64-a4497579f7e2', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-15 11:03:28'),
('d505ed02-3e69-4956-ac8d-f4722bfdecd3', 'usr-rina', 'Anggota SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-19 14:34:57'),
('d51d3e7a-b41d-46f2-aa4f-942290347cd3', 'usr-rina', 'Anggota SKI', 'Ubah Modul Pengawasan', 'Format Inspektorat (SA / EHR) (Status: draf)', '::1', '2026-10-22 08:34:12'),
('d5e28f07-b176-4e25-8d88-57b7cf961a85', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-15 09:25:59'),
('d602a47e-bd7b-4c50-b0a3-b274f3521db4', 'usr-agus', 'PIC', 'Login', 'Sistem Monev SKI', '::1', '2026-10-15 10:18:18'),
('d75c51a9-6b50-4cf0-ba5f-418f6aa86d75', 'usr-itjen', 'Itjen', 'Login', 'Sistem Monev SKI', '::1', '2026-10-15 09:26:10'),
('d7f4e713-395d-42da-a7b4-c768563c010e', 'usr-rina', 'Anggota SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-22 09:16:02'),
('d89d292f-6b8b-4bb2-b145-2190768e82c8', 'usr-admin', 'Admin', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-14 09:21:45'),
('d8e76dab-f03e-430c-a715-c998f9b294c1', 'usr-pim', 'Pimpinan', 'Login', 'Sistem Monev SKI', '::1', '2026-10-14 09:45:54'),
('d92ac2da-5666-4a06-a4b1-5eaa82b02fbe', 'usr-rina', 'Anggota SKI', 'Ubah Modul Pengawasan', 'Mitigasi & Manajemen Risiko (Status: draf)', '::1', '2026-10-22 08:33:05'),
('d980183f-0065-46fb-a4fe-ec3f08f3e241', 'usr-pim', 'Pimpinan', 'Pimpinan melihat rekomendasi', 'ID Rek: ba10f168-c918-4413-bb72-874f37e483bd', '::1', '2026-10-14 09:16:56'),
('d9e53ffd-2e55-4b9b-a233-fc5f1c57e2fb', 'usr-rina', 'Anggota SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-21 10:50:19'),
('dac6edaa-a213-4a22-80dd-7c1cb2cfa471', 'usr-rina', 'Anggota SKI', 'Ubah Modul Pengawasan', 'Unit Pengendali Gratifikasi (UPG) (Status: draf)', '::1', '2026-10-22 08:33:35'),
('dbf657ba-8da9-4b72-b1c4-318b8ea78a27', 'usr-rina', 'Anggota SKI', 'Ubah Modul Pengawasan', 'Nobal Gp Abu Dhabi (Status: terbit)', '::1', '2026-10-22 09:22:30'),
('dcfb6991-86ce-4b06-855d-249366902386', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Hapus Modul Pengawasan', 'ID: mod-kk', '::1', '2026-10-15 08:12:29'),
('dd573a68-34ed-4e34-af59-480b1a376b69', 'usr-admin', 'Admin', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-14 08:56:09'),
('dd6ca544-4543-47bb-8655-8d8a527670bd', 'usr-agus', 'PIC', 'Upload perbaikan tautan eviden', 'Ini Gdrive (v2)', '::1', '2026-10-19 13:07:39'),
('de358b12-fda8-4195-95c8-007bfabe22eb', 'usr-agus', 'PIC', 'Login', 'Sistem Monev SKI', '::1', '2026-10-15 09:58:23'),
('de9c60e4-5dec-4466-b793-fc59a0def44c', 'usr-ketua', 'Ketua SKI', 'Tambah Indikator Modul', 'Modul: mod-kk - Sempol BALAP', '::1', '2026-10-14 09:18:29'),
('df1269d0-c703-4cfb-a483-25a039bd6a41', 'usr-rina', 'Anggota SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-15 10:21:36'),
('df536f36-450b-4464-a977-f55b2f4f81d8', 'usr-agus', 'PIC', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-14 09:24:15'),
('dfb8482f-daec-4a2c-a5ef-9850bc07df5f', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Terbitkan Jadwal Pengawasan', 'Oktober 2026 (2 modul)', '::1', '2026-10-15 08:46:15'),
('e085ca7a-9962-465f-a0bc-34b8491efacc', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-14 09:50:24'),
('e10d19ab-d2ff-4360-9a77-4bb09074e875', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-14 10:08:17'),
('e1a448bf-f095-42df-8923-9b85cfea1313', 'usr-rina', 'Anggota SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-20 10:08:12'),
('e1b4b1a2-8a4c-4afe-822f-a3f3267ab7e5', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Hapus Modul Pengawasan', 'ID: mod-pbj', '::1', '2026-10-22 08:59:59'),
('e1eec4eb-97ca-4467-b426-aca66a1da57e', 'usr-admin', 'Admin', 'Ubah Status Akun Pengguna', 'User ID: usr-admin', '::1', '2026-10-14 09:20:38'),
('e2662b77-054b-4c24-9c8f-63edb21e22de', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Approval berkas Ketua SKI', '1 berkas disetujui', '::1', '2026-10-15 10:13:28'),
('e2a77ca2-698a-4ec4-adc2-c1bcadb0602a', 'usr-agus', 'PIC', 'Login', 'Sistem Monev SKI', '::1', '2026-10-15 08:44:24'),
('e2b8beac-a03e-45ce-95ae-bba586bc52bd', 'usr-pim', 'Pimpinan', 'Pimpinan menyetujui evaluasi modul', 'Tugas modul selesai', '::1', '2026-10-14 09:16:56'),
('e327bfcf-9a4e-4efc-85cc-9022ab9a5aaf', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-15 09:27:11'),
('e355a6d8-0ec5-4390-9daf-0c02b90ae49b', 'usr-rina', 'Anggota SKI', 'Kirim hasil review SKI', '1 butir eviden dievaluasi', '::1', '2026-10-15 10:12:53'),
('e41a0286-0233-4c2e-b31a-20dbe445a3f3', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-20 08:33:44'),
('e429defb-cff5-4f0d-b6a4-1fb56dc1c0c8', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-19 12:37:24'),
('e474fbf9-4b71-49c4-ab7a-b1f9cf0df0c1', 'usr-budi', 'PIC', 'Login', 'Sistem Monev SKI', '::1', '2026-10-22 08:57:38'),
('e4a94d95-7e16-407d-bba1-dfe779325133', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-15 09:57:44'),
('e4ec1a41-58c6-4a4e-9a2c-f69c6d02878a', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Hapus Modul Pengawasan', 'ID: mod-anggaran', '::1', '2026-10-22 09:00:03'),
('e5ee3e49-9620-4f34-acc2-e397ae86dfb1', 'usr-rina', 'Anggota SKI', 'Update Status Modul', 'Modul mod-kkr status: draf', '::1', '2026-10-20 10:26:08'),
('e6b287cd-3e09-4f4b-b9ad-a966faada6a0', 'usr-pim', 'Pimpinan', 'Login', 'Sistem Monev SKI', '::1', '2026-10-15 08:48:37'),
('e71beb90-3e7a-4033-8cef-f69d076a767d', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Tambah Indikator Modul', 'Modul: mod-791a2adb - sfsdfsd', '::1', '2026-10-20 08:48:06'),
('e75e56b7-54c1-4c8a-b5ad-fc5f1d0fdb36', 'usr-agus', 'PIC', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-15 08:39:05'),
('e795fee8-28b6-4803-b61c-34c91a1905fd', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-20 09:06:49'),
('e7e610a3-d8a8-4243-bf96-c7f75ac75ac7', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Ubah Modul Pengawasan', 'Laporan Keuangan (LKE) (Status: draf)', '::1', '2026-10-15 08:12:44'),
('e87e0f3e-6f69-422b-8ce1-0ac2d71f8632', 'usr-itjen', 'Itjen', 'Login', 'Sistem Monev SKI', '::1', '2026-10-14 09:25:13'),
('e88354c0-681f-4795-baba-7081b8f76494', 'usr-agus', 'PIC', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-19 12:46:17'),
('e891d226-d95f-4f98-890d-2a0d4c4b2d8d', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Terbitkan Jadwal Pengawasan', 'Oktober 2026 (4 modul)', '::1', '2026-10-15 10:19:13'),
('e89299b8-0a18-4718-bf7a-aa65a97b24ce', 'usr-pim', 'Pimpinan', 'Pimpinan menyetujui evaluasi modul', 'Tugas modul selesai', '::1', '2026-10-14 10:11:59'),
('e8b443e8-fef8-4836-95be-90de23220822', 'usr-agus', 'PIC', 'Login', 'Sistem Monev SKI', '::1', '2026-10-15 10:16:28'),
('e95b90d8-8587-4a3f-b495-6ca776f2462c', 'usr-agus', 'PIC', 'Login', 'Sistem Monev SKI', '::1', '2026-10-14 09:48:30'),
('ea3d5565-1aa9-49af-9986-b419b66f67f3', 'usr-rina', 'Anggota SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-21 11:12:21'),
('eb1a20d0-03bd-4c50-909a-4447bb6a5da1', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Ubah Modul Pengawasan', 'Laporan Keuangan (LKE) (Status: terbit)', '::1', '2026-10-15 08:12:40'),
('eb785e82-dc72-45b6-bb16-28ada9b5a987', 'usr-rina', 'Anggota SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-22 08:30:26'),
('ebcc901e-1088-43f1-af58-2d20c145433c', 'usr-rina', 'Anggota SKI', 'Konfigurasi Indikator Modul', 'Indikator ind-pbj-3 pada modul mod-pbj', '::1', '2026-10-20 10:25:10'),
('ec0c580f-a350-4615-96a9-50556df39c66', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Tambah Indikator Modul', 'Modul: mod-da0e35e4 - test 2', '::1', '2026-10-19 12:37:38'),
('ec2cf815-a435-4baa-9928-e68ed161bd80', 'usr-rina', 'Anggota SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-15 08:39:07'),
('ed39bb26-b911-4a87-ae23-f4cf81c443a0', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Tambah Indikator Modul', 'Modul: mod-a34bf986 - Venue', '::1', '2026-10-14 10:49:48'),
('ed5876d1-935b-4be4-9d8b-43f3e4b245dd', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-14 09:51:20'),
('edd1afb5-f306-4dfc-8bcf-edec54df421a', 'usr-agus', 'PIC', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-14 09:51:39'),
('ee2d2ce5-82ad-441b-9df0-aab536ed326f', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-15 10:13:02'),
('ee71bf07-64ff-4775-b327-d05d7ee071db', 'usr-agus', 'PIC', 'Upload eviden baru', 'PROPOSAL MAGANG - PERDI PRATAMA.pdf', '::1', '2026-10-15 08:47:15'),
('ee7709e4-314d-47ce-9618-53688a9bce2e', 'usr-agus', 'PIC', 'Upload eviden baru', 'PBJ_Tepat_kualitas.pdf', '::1', '2026-10-15 08:57:16'),
('ef579ec6-a830-4fb4-af07-de2d5dc8f256', 'usr-rina', 'Anggota SKI', 'Kirim hasil review SKI', '1 butir eviden dievaluasi', '::1', '2026-10-19 13:06:51'),
('efc31c81-5601-414a-8f5f-b1995bcacff0', 'usr-rina', 'Anggota SKI', 'Kirim hasil review SKI', '1 butir eviden dievaluasi', '::1', '2026-10-19 13:06:55'),
('f0a5bbf6-f4ce-433b-9749-f395905f8182', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Approval berkas Ketua SKI', '1 berkas disetujui', '::1', '2026-10-14 09:55:04'),
('f0e8ec75-f5c6-4bf6-a392-0f0522ea7b34', 'usr-pim', 'Pimpinan', 'Login', 'Sistem Monev SKI', '::1', '2026-10-14 08:56:12'),
('f0ed3ce7-90a8-4724-b89d-68fbe0490166', 'usr-pim', 'Pimpinan', 'Pimpinan menyetujui berkas eviden', 'Ini Gdrive (Keuangan Bulan Oktober) - Versi 1', '::1', '2026-10-19 13:08:52'),
('f14b2538-d71d-49b8-a9cc-e34349153410', 'usr-agus', 'PIC', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-15 07:44:19'),
('f15724ad-6c87-4108-8a08-73c09380a8f0', 'usr-agus', 'PIC', 'Login', 'Sistem Monev SKI', '::1', '2026-10-19 13:08:56'),
('f1708075-8d12-4a78-bcc3-6dbd403d975e', 'usr-agus', 'PIC', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-15 09:26:29'),
('f19d7b53-dec7-47c6-8471-80d5520c60b7', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-22 08:58:30'),
('f21d5b11-756c-4027-8c50-f2063bde4c02', 'usr-agus', 'PIC', 'Login', 'Sistem Monev SKI', '::1', '2026-10-15 09:45:09'),
('f25a99ff-287b-41dd-9f75-16e8e96cbc02', 'usr-admin', 'Admin', 'Perubahan RBAC Granular', 'Role: adm, Menu: dash, Aksi: l -> 0', '::1', '2026-10-15 07:47:01'),
('f2aea7ba-c7ac-4118-811d-ae3a0793b037', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-20 09:16:21'),
('f2cfe511-cdfa-41aa-b329-3889634319eb', 'usr-dewi', 'PIC', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-19 13:35:16'),
('f2eff7d4-25fd-400a-97d6-02c5025b9569', 'usr-rina', 'Anggota SKI', 'Tambah Modul Pengawasan', 'Test Drafr (Template: 1792391676_Jumat_02_Oktober_2026_-_SRS.pdf)', '::1', '2026-10-19 13:34:36'),
('f338ba74-4aa6-4f30-ac07-6b2767e88ee9', 'usr-rina', 'Anggota SKI', 'Ubah Indikator Modul', 'ID: 488eaa20-aa5e-4a0b-9e71-895b0455b8bf - test 2', '::1', '2026-10-20 14:25:37'),
('f4a8d7e3-a925-483d-8d07-9676b480e7b6', 'usr-agus', 'PIC', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-14 10:07:56'),
('f58ef228-d79a-42a5-a021-57dbf824e149', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-15 10:33:44'),
('f5a2e7bd-9604-4eaf-ac6a-85d74c8cc135', 'usr-rina', 'Anggota SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-22 08:38:49'),
('f5a34bb8-4dfa-4788-a293-0d5ffaad051b', 'usr-agus', 'PIC', 'Login', 'Sistem Monev SKI', '::1', '2026-10-15 11:08:08'),
('f665f14a-3c6e-4634-9266-4ab35304dc12', 'usr-agus', 'PIC', 'Upload perbaikan eviden', 'lampiran.docx (v2)', '::1', '2026-10-15 10:12:19'),
('f67c99a2-2ece-4a07-82ed-bef62ef645c0', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-14 10:50:21'),
('f72be3b3-f9f0-482d-9958-75cdf1e09622', 'usr-agus', 'PIC', 'Hapus berkas eviden', 'SRS 2.pdf', '::1', '2026-10-15 11:03:45'),
('f7363237-2778-4fc1-a9df-aeffafb53046', 'usr-pim', 'Pimpinan', 'Pimpinan melihat rekomendasi', 'ID Rek: ba10f168-c918-4413-bb72-874f37e483bd', '::1', '2026-10-14 10:11:55'),
('f73bbdc1-4852-46d2-8044-fb8f13269994', 'usr-rina', 'Anggota SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-15 09:57:53'),
('f77f1d06-b4a1-48af-a5d5-1ace83450c95', 'usr-ketua', 'Ketua SKI', 'Tambah Modul Pengawasan', 'Sempol Balap', '::1', '2026-10-14 09:19:19'),
('f79076f6-b7f5-4059-9574-c70960739c6f', 'usr-rina', 'Anggota SKI', 'Ubah Modul Pengawasan', 'Nobal Gp Abu Dhabi (Status: terbit)', '::1', '2026-10-22 09:22:32'),
('f8b5c4d4-5658-4611-9e13-d4b7ac993668', 'usr-agus', 'PIC', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-14 11:03:15'),
('f99bdc7c-85b0-4995-9ac6-3bae8e55161c', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Hapus Modul Pengawasan', 'ID: mod-da0e35e4', '::1', '2026-10-22 08:59:37'),
('f9e6667d-522e-476d-92be-39514fd1fdce', 'usr-rina', 'Anggota SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-19 13:07:47'),
('fa1f0038-bcc6-4e73-a360-6f8a0fb7fd58', 'usr-admin', 'Admin (Superadmin)', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-20 10:08:09'),
('fa28dbef-2b53-4b93-bbb1-db0251a16c18', 'usr-rina', 'Anggota SKI', 'Ubah Modul Pengawasan', 'Review Anggaran (RKAKL / DIPA) (Status: draf)', '::1', '2026-10-22 08:33:47'),
('fa37acbb-092f-4091-b15a-3557c6308ec8', 'usr-rina', 'Anggota SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-19 12:36:32'),
('fcfcd58b-f596-4982-bd33-853cb4f621f2', 'usr-rina', 'Anggota SKI', 'Ubah Modul Pengawasan', 'Nobal Gp Abu Dhabi (Status: terbit)', '::1', '2026-10-22 08:33:54'),
('fd9db2c8-b22a-47b3-a38f-635102aac059', 'usr-rina', 'Anggota SKI', 'Ubah Modul Pengawasan', 'Keuangan Bulan Oktober (Status: terbit)', '::1', '2026-10-15 10:17:09'),
('fe4c2eef-c5d6-4e1a-b18f-c6e71c5fd700', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Ubah Indikator Modul', 'ID: 0937c270-4e92-427d-bb9e-f6c82e5f4c52 - Kenceng Tikungan', '::1', '2026-10-14 09:56:31'),
('ff2b77e1-f79c-4186-b064-04d56541514e', 'usr-agus', 'PIC', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-15 10:33:26'),
('ffa7ff39-468d-4a0a-8a83-9a9cc8f936b0', '5b7c2010-86a6-44c3-986a-ac0809c0d535', 'Ketua SKI', 'Tambah Modul Pengawasan', 'Nobal GP America', '::1', '2026-10-14 10:49:36');

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
('0c27c761-f76a-4635-9fae-c0b557e60aa8', 'jdw-a3413b574da6', '7b735af1-13b8-4738-a167-5d20798356e6', 'usr-agus', 'lampiran.pdf', 'uploads/evidens/1792028816_lampiran.pdf', 0.23, 'pdf', 1, 'f', '2026-10-15 08:46:56', NULL),
('120a915d-0016-4357-b4b8-a6e95a09171a', 'jdw-a3413b574da6', 'f9224229-17e5-48de-9e42-ae77aa082b75', 'usr-agus', '2024-07-16_-_Internship_Handbook_SY_24_25 -Indonesia Version.pdf', 'uploads/evidens/1792028803_2024-07-16_-_Internship_Handbook_SY_24_25_-Indonesia_Version.pdf', 0.89, 'pdf', 1, 'f', '2026-10-15 08:46:43', NULL),
('32b273de-fca9-4f69-a9d5-b9ffe749e823', 'jdw-f6bd36173110', '5618c6f8-4e0b-4e84-bbe9-1a5ccd837e59', 'usr-agus', 'lampiran.docx', 'uploads/evidens/1792033939_lampiran.docx', 0.10, 'docx', 2, 'f', '2026-10-15 10:12:19', NULL),
('8af7f7b5-833f-4d46-8c58-7cc7e6a66827', 'jdw-a3413b574da6', '9092886f-f7c5-4177-ba13-3fca31425b7e', 'usr-agus', 'PROPOSAL MAGANG - PERDI PRATAMA.pdf', 'uploads/evidens/1792028835_PROPOSAL_MAGANG_-_PERDI_PRATAMA.pdf', 0.07, 'pdf', 1, 'f', '2026-10-15 08:47:15', NULL),
('8e6efa08-c2f5-49ee-af25-99396744ce53', 'jdw-f6bd36173110', '56485b3b-b06e-45d4-af2c-efce46f1e103', 'usr-agus', 'lampiran.pdf', 'uploads/evidens/1792033919_lampiran.pdf', 0.23, 'pdf', 1, 'f', '2026-10-15 10:11:59', NULL),
('fc1b9990-d5a3-4a54-be21-309ebd395139', 'jdw-f6bd36173110', '0df7245c-2eba-4bf5-86fd-4ea50f96a3a0', 'usr-agus', 'SRS.pdf', 'uploads/evidens/1792032941_SRS.pdf', 0.37, 'pdf', 1, 'f', '2026-10-15 09:55:41', NULL);

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
('014680d8-3ebf-4ac5-8a68-de8598dfd749', 'mod-15a2e87e', 'ppk', 'file', 'Unggah berkas eviden yang sah sesuai format juknis.', 1, 1),
('06a1c368-167e-498c-8903-7e2d10af1921', 'mod-791a2adb', 'fdsfsd', 'file', 'Unggah berkas eviden yang sah sesuai format juknis.', 1, 1),
('0df7245c-2eba-4bf5-86fd-4ea50f96a3a0', 'mod-9f3f7fd1', 'KOL', 'file', 'Unggah berkas eviden yang sah sesuai format juknis.', 1, 1),
('488eaa20-aa5e-4a0b-9e71-895b0455b8bf', 'mod-da0e35e4', 'test 2', 'file', 'Unggah berkas eviden yang sah sesuai format juknis.', 1, 2),
('5618c6f8-4e0b-4e84-bbe9-1a5ccd837e59', 'mod-9f3f7fd1', 'Sponsor', 'file', 'Unggah berkas eviden yang sah sesuai format juknis.', 1, 2),
('56485b3b-b06e-45d4-af2c-efce46f1e103', 'mod-9f3f7fd1', 'Venue', 'file', 'Unggah berkas eviden yang sah sesuai format juknis.', 1, 3),
('5b931095-2165-48d8-a3aa-a12bec78b124', 'mod-f268e5a9', 'Pembelian Inventaris Bulan Oktober', 'file', 'Unggah berkas eviden yang sah sesuai format juknis.', 1, 2),
('71e91685-3927-4cda-94c4-6bb5bcb362f2', 'mod-791a2adb', 'sfsdfsd', 'file', 'Unggah berkas eviden yang sah sesuai format juknis.', 1, 2),
('7b735af1-13b8-4738-a167-5d20798356e6', 'mod-a34bf986', 'Inventaris', 'file', 'Unggah berkas eviden yang sah sesuai format juknis.', 1, 2),
('9092886f-f7c5-4177-ba13-3fca31425b7e', 'mod-a34bf986', 'Volunteer', 'file', 'Unggah berkas eviden yang sah sesuai format juknis.', 1, 3),
('a2e4d1c1-8546-4e68-9f67-774067c633f7', 'mod-da0e35e4', 'test 1', 'file', 'Unggah berkas eviden yang sah sesuai format juknis.', 1, 1),
('e7113d79-4c55-4720-8b13-081da1dff88d', 'mod-f268e5a9', 'Kerusakan Barang Bulan Oktober', 'file', 'Unggah berkas eviden yang sah sesuai format juknis.', 1, 1),
('f6ccfc0b-3342-42d1-9cf5-ff27e118c63e', 'mod-da0e35e4', 'test 3', 'file', 'Unggah berkas eviden yang sah sesuai format juknis.', 1, 3),
('f9224229-17e5-48de-9e42-ae77aa082b75', 'mod-a34bf986', 'Venue', 'file', 'Unggah berkas eviden yang sah sesuai format juknis.', 1, 1),
('ind-anggaran-1', 'mod-anggaran', 'Kertas Kerja Penelaahan (KPL) Usulan Pagu RKAKL', 'numeric', 'Masukkan angka kuantitatif / nominal rekapitulasi.', 1, 1),
('ind-anggaran-2', 'mod-anggaran', 'Keselarasan Alokasi Anggaran DIPA terhadap Output Prioritas', 'numeric', 'Masukkan angka kuantitatif / nominal rekapitulasi.', 1, 2),
('ind-draf-01', 'mod-draf-uji', 'Contoh butir indikator pengujian draf', 'file', 'Panduan draf internal', 1, 1),
('ind-itjen-1', 'mod-itjen', 'Dokumen Surat Atensi (SA) Tindak Lanjut Temuan Itjen', 'file', 'Unggah berkas PDF Surat Auditor (SA) / Evaluasi Hasil Reviu (EHR).', 1, 1),
('ind-itjen-2', 'mod-itjen', 'Dokumen Evaluasi Hasil Review (EHR) Kepatuhan Standar Itjen', 'file', 'Unggah berkas PDF Surat Auditor (SA) / Evaluasi Hasil Reviu (EHR).', 1, 2),
('ind-kkr-1', 'mod-kkr', 'Rekonsiliasi & Kelengkapan Laporan Realisasi Anggaran (LRA)', 'binary_score', 'Beri nilai 1 jika butir pengujian terpenuhi, atau 0 jika tidak.', 1, 1),
('ind-kkr-2', 'mod-kkr', 'Rekonsiliasi & Kelengkapan Laporan Operasional (LO)', 'binary_score', 'Beri nilai 1 jika butir pengujian terpenuhi, atau 0 jika tidak.', 1, 2),
('ind-kkr-3', 'mod-kkr', 'Rekonsiliasi & Kelengkapan Laporan Perubahan Ekuitas (LPE)', 'binary_score', 'Beri nilai 1 jika butir pengujian terpenuhi, atau 0 jika tidak.', 1, 3),
('ind-kkr-4', 'mod-kkr', 'Rekonsiliasi Kas, Persediaan, dan Aset Tetap pada Neraca', 'binary_score', 'Beri nilai 1 jika butir pengujian terpenuhi, atau 0 jika tidak.', 1, 4),
('ind-kkr-5', 'mod-kkr', 'Catatan atas Laporan Keuangan (CaLK) & Pengungkapan Transaksi Material', 'binary_score', 'Beri nilai 1 jika butir pengujian terpenuhi, atau 0 jika tidak.', 1, 5),
('ind-lhkpn-1', 'mod-lhkpn', 'Bukti Tanda Terima Pelaporan LHKPN Wajib Lapor BBPK Jakarta', 'numeric', 'Masukkan angka kuantitatif / nominal rekapitulasi.', 1, 1),
('ind-lhkpn-2', 'mod-lhkpn', 'Bukti Penerimaan Elektronik (BPE) SPT Tahunan Pegawai', 'numeric', 'Masukkan angka kuantitatif / nominal rekapitulasi.', 1, 2),
('ind-pbj-1', 'mod-pbj', 'Tepat Kualitas (Spesifikasi Teknis & KAK Paket Pengadaan)', 'pbj_matrix', 'Verifikasi 4 aspek kepatuhan: Kualitas, Kuantitas, Harga, dan Waktu.', 1, 1),
('ind-pbj-2', 'mod-pbj', 'Tepat Jumlah (Kesesuaian Volume & BAST Serah Terima)', 'pbj_matrix', 'Verifikasi 4 aspek kepatuhan: Kualitas, Kuantitas, Harga, dan Waktu.', 1, 2),
('ind-pbj-3', 'mod-pbj', 'Tepat Harga (HPS Wajar & Nilai Kontrak Pengadaan)', 'pbj_matrix', 'Verifikasi 4 aspek kepatuhan: Kualitas, Kuantitas, Harga, dan Waktu.', 1, 3),
('ind-pbj-4', 'mod-pbj', 'Tepat Penyedia & Waktu (Kualifikasi Rekanan & Ketepatan Jadwal SPK)', 'pbj_matrix', 'Verifikasi 4 aspek kepatuhan: Kualitas, Kuantitas, Harga, dan Waktu.', 1, 4),
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
('014680d8-3ebf-4ac5-8a68-de8598dfd749', 'mod-15a2e87e', 'ppk', 1, 'file', NULL, 1),
('06a1c368-167e-498c-8903-7e2d10af1921', 'mod-791a2adb', 'fdsfsd', 1, 'file', NULL, 1),
('0df7245c-2eba-4bf5-86fd-4ea50f96a3a0', 'mod-9f3f7fd1', 'KOL', 1, 'file', NULL, 1),
('5618c6f8-4e0b-4e84-bbe9-1a5ccd837e59', 'mod-9f3f7fd1', 'Sponsor', 2, 'file', NULL, 1),
('56485b3b-b06e-45d4-af2c-efce46f1e103', 'mod-9f3f7fd1', 'Venue', 3, 'file', NULL, 1),
('71e91685-3927-4cda-94c4-6bb5bcb362f2', 'mod-791a2adb', 'sfsdfsd', 2, 'file', NULL, 1),
('7b735af1-13b8-4738-a167-5d20798356e6', 'mod-a34bf986', 'Inventaris', 2, 'file', NULL, 1),
('9092886f-f7c5-4177-ba13-3fca31425b7e', 'mod-a34bf986', 'Volunteer', 3, 'file', NULL, 1),
('f9224229-17e5-48de-9e42-ae77aa082b75', 'mod-a34bf986', 'Venue', 1, 'file', NULL, 1);

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
('jdw-744de1bb48ca', 'per-12e3a1168e', 'mod-791a2adb', '2026-10-30 23:59:59', '2026-11-02 08:00:00', 0),
('jdw-a3413b574da6', 'per-12e3a1168e', 'mod-a34bf986', '2026-10-30 23:59:59', '2026-11-02 08:00:00', 0),
('jdw-c623ebc32d7e', 'per-12e3a1168e', 'mod-15a2e87e', '2026-10-30 23:59:59', '2026-11-02 08:00:00', 0),
('jdw-f6bd36173110', 'per-12e3a1168e', 'mod-9f3f7fd1', '2026-10-30 23:59:59', '2026-11-02 08:00:00', 0);

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
('mod-15a2e87e', 'Test Draft', 'u-peg', '1792391676_Jumat_02_Oktober_2026_-_SRS.pdf', 'checklist', 'terbit', NULL),
('mod-791a2adb', 'tes bulet', 'u-keu', 'mod-791a2adb_panduan.pdf', 'checklist', 'terbit', NULL),
('mod-9f3f7fd1', 'Nobal Gp Abu Dhabi', 'u-ren', '1792036890_Form_Format_Standar_Monev.xlsx', 'checklist', 'terbit', NULL),
('mod-a34bf986', 'Nobal GP America', 'u-ren', 'mod-a34bf986_panduan.pdf', 'checklist', 'terbit', NULL),
('mod-anggaran', 'Review Anggaran (RKAKL / DIPA)', 'u-keu', 'Tabel_KPL_Review_Anggaran.xlsx', 'metrics_data', 'terbit', NULL),
('mod-da0e35e4', 'Keuangan Bulan Oktober', 'u-ren', '1792037005_Intership_Agreement_-_Ginartriadi_Affandi_Draft.docx', 'checklist', 'terbit', NULL),
('mod-draf-uji', 'Modul Uji Coba Internal (Draf SKI)', 'u-keu', 'Draf_Panduan_Uji_Coba.pdf', 'checklist', 'draf', 5.00),
('mod-f268e5a9', 'Keuangan Bulan Oktober', 'u-keu', '1792036991_Intership_Agreement_-_Ginartriadi_Affandi_Draft.docx', 'checklist', 'terbit', NULL),
('mod-itjen', 'Format Inspektorat (SA / EHR)', 'u-ren', 'Format_Baku_SA_EHR_Itjen.pdf', 'document_verification', 'terbit', NULL),
('mod-kkr', 'KKR Laporan Keuangan (LRA, LO, LPE, Neraca, CaLK)', 'u-keu', 'Form_Bantu_KKR_1_3_LKE.xlsx', 'checklist', 'terbit', 8.00),
('mod-lhkpn', 'Kepatuhan LHKPN & SPT', 'u-peg', 'Form_Tanda_Terima_LHKPN_SPT.pdf', 'metrics_data', 'terbit', NULL),
('mod-pbj', 'PBJ (Pengadaan Barang & Jasa)', 'u-keu', 'Panduan_4_Aspek_Kepatuhan_PBJ.pdf', 'checklist', 'terbit', NULL),
('mod-pipk', 'Pengendalian Intern Pelaporan Keuangan (PIPK)', 'u-keu', 'Format_CHR_PIPK_Kemenkes.pdf', 'document_verification', 'terbit', NULL),
('mod-risiko', 'Mitigasi & Manajemen Risiko', 'u-ren', 'Matriks_Pemantauan_Risiko.xlsx', 'checklist', 'terbit', NULL),
('mod-sakip', 'SAKIP / Laporan Kinerja', 'u-ren', 'KKE_AKIP_Evaluasi_Kinerja.xlsx', 'checklist', 'terbit', NULL),
('mod-upg', 'Unit Pengendali Gratifikasi (UPG)', 'u-peg', 'Instrumen_Checklist_UPG.pdf', 'checklist', 'terbit', NULL);

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
('mod-15a2e87e', 'Test Draft', 'ind', '1792391676_Jumat_02_Oktober_2026_-_SRS.pdf', 'terbit', 'u-peg', 'checklist', 'terbit', NULL),
('mod-791a2adb', 'tes bulet', 'ind', NULL, 'terbit', 'u-keu', 'checklist', 'terbit', NULL),
('mod-9f3f7fd1', 'Nobal Gp Abu Dhabi', 'ind', NULL, 'terbit', 'u-ren', 'checklist', 'terbit', NULL),
('mod-a34bf986', 'Nobal GP America', 'ind', NULL, 'terbit', 'u-ren', 'checklist', 'terbit', NULL);

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
('5b7b4129-177c-4267-b982-0baef1d19b92', '32b273de-fca9-4f69-a9d5-b9ffe749e823', 'usr-rina', 'sesuai', 'oke mas mantapp', '2026-10-15 10:12:53'),
('844360ce-3a63-4f7b-8556-c3a7486d3e01', '120a915d-0016-4357-b4b8-a6e95a09171a', 'usr-rina', 'sesuai', '', '2026-10-15 08:48:18'),
('98117cdf-5fd2-458c-b44d-2db2bbf51c75', '0c27c761-f76a-4635-9fae-c0b557e60aa8', 'usr-rina', 'sesuai', '', '2026-10-15 08:48:14'),
('a5216475-12cf-48fc-b32c-8f29f764c75c', '8af7f7b5-833f-4d46-8c58-7cc7e6a66827', 'usr-rina', 'sesuai', '', '2026-10-15 08:48:11'),
('c721be8a-494a-471c-97e5-b100916d03aa', '8e6efa08-c2f5-49ee-af25-99396744ce53', 'usr-rina', 'sesuai', 'Sesuai indikator.', '2026-10-15 10:12:59'),
('cb57284e-98cc-457e-93e7-e4f85cac936c', 'fc1b9990-d5a3-4a54-be21-309ebd395139', 'usr-rina', 'sesuai', '', '2026-10-15 09:57:51');

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
('d566ed16-c771-11f1-bc62-a02919692648', 'ang', 'mod', 1, 1, 1, 0, 0, 0),
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
('ee43bb8e-ba7d-46a6-a8ed-62c3da3c3d0d', 'adm', 'dash', 0, 0, 0, 0, 0, 0);

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
('5b7c2010-86a6-44c3-986a-ac0809c0d535', '6969', '$2y$10$SCrXrXkagSMmtpXwKc5AjuO9KmpCCd5rtU8P5lw6QpRwaRGVl.C5q', 'Jajang Mulyana', 'ket', 'u-peg', 1),
('usr-admin', 'admin', '$2y$10$SCrXrXkagSMmtpXwKc5AjuO9KmpCCd5rtU8P5lw6QpRwaRGVl.C5q', 'Administrator Sistem', 'adm', NULL, 1),
('usr-agus', 'agus.ren', '$2y$10$SCrXrXkagSMmtpXwKc5AjuO9KmpCCd5rtU8P5lw6QpRwaRGVl.C5q', 'Agus Prayitno', 'pic', 'u-ren', 1),
('usr-budi', 'budi.keu', '$2y$10$SCrXrXkagSMmtpXwKc5AjuO9KmpCCd5rtU8P5lw6QpRwaRGVl.C5q', 'Budi Santoso', 'pic', 'u-keu', 1),
('usr-dewi', 'dewi.peg', '$2y$10$SCrXrXkagSMmtpXwKc5AjuO9KmpCCd5rtU8P5lw6QpRwaRGVl.C5q', 'Dewi Lestari', 'pic', 'u-peg', 1),
('usr-itjen', 'itjen.01', '$2y$10$SCrXrXkagSMmtpXwKc5AjuO9KmpCCd5rtU8P5lw6QpRwaRGVl.C5q', 'Auditor Itjen Kemenkes', 'itj', NULL, 1),
('usr-ketua', 'ketua.ski', '$2y$10$SCrXrXkagSMmtpXwKc5AjuO9KmpCCd5rtU8P5lw6QpRwaRGVl.C5q', 'Ketua SKI BBPK', 'ket', NULL, 1),
('usr-pim', 'pimpinan', '$2y$10$SCrXrXkagSMmtpXwKc5AjuO9KmpCCd5rtU8P5lw6QpRwaRGVl.C5q', 'Kepala BBPK Jakarta', 'pim', NULL, 1),
('usr-rina', 'rina.ski', '$2y$10$SCrXrXkagSMmtpXwKc5AjuO9KmpCCd5rtU8P5lw6QpRwaRGVl.C5q', 'Rina Marlina', 'ang', NULL, 1);

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
