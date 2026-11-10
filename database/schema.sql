-- DDL Schema & Data Monev SKI BBPK Jakarta
-- Generated 2026-10-14 04:11:59

SET FOREIGN_KEY_CHECKS=0;

-- Table structure for `audit_logs`
DROP TABLE IF EXISTS `audit_logs`;
CREATE TABLE `audit_logs` (
  `id_log` varchar(36) NOT NULL,
  `id_user` varchar(36) NOT NULL,
  `role_saat_aksi` varchar(50) NOT NULL,
  `jenis_aksi` varchar(80) NOT NULL,
  `objek_target` varchar(200) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp_aktivitas` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_log`),
  KEY `id_user` (`id_user`),
  KEY `idx_timestamp` (`timestamp_aktivitas`),
  CONSTRAINT `audit_logs_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Table structure for `evidens`
DROP TABLE IF EXISTS `evidens`;
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
  `nilai_isian` text DEFAULT NULL,
  PRIMARY KEY (`id_eviden`),
  KEY `id_jadwal` (`id_jadwal`),
  KEY `id_indikator` (`id_indikator`),
  KEY `id_user_pic` (`id_user_pic`),
  KEY `idx_status_eviden` (`status_eviden`),
  KEY `idx_jadwal_indikator` (`id_jadwal`, `id_indikator`),
  CONSTRAINT `evidens_ibfk_1` FOREIGN KEY (`id_jadwal`) REFERENCES `jadwal_moduls` (`id_jadwal`),
  CONSTRAINT `evidens_ibfk_2` FOREIGN KEY (`id_indikator`) REFERENCES `indikators` (`id_indikator`) ON DELETE CASCADE,
  CONSTRAINT `evidens_ibfk_3` FOREIGN KEY (`id_user_pic`) REFERENCES `users` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Table structure for `indikators`
DROP TABLE IF EXISTS `indikators`;
CREATE TABLE `indikators` (
  `id_indikator` varchar(36) NOT NULL,
  `id_modul` varchar(36) NOT NULL,
  `deskripsi_indikator` text NOT NULL,
  `nomor_urut` int(11) NOT NULL DEFAULT 1,
  `input_type` enum('file','binary_score','numeric','risk_scale','pbj_matrix') NOT NULL DEFAULT 'file',
  `guide_notes` varchar(255) DEFAULT NULL,
  `is_mandatory` tinyint(1) DEFAULT 1,
  PRIMARY KEY (`id_indikator`),
  KEY `id_modul` (`id_modul`),
  CONSTRAINT `indikators_ibfk_1` FOREIGN KEY (`id_modul`) REFERENCES `moduls` (`id_modul`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Table structure for `jadwal_moduls`
DROP TABLE IF EXISTS `jadwal_moduls`;
CREATE TABLE `jadwal_moduls` (
  `id_jadwal` varchar(36) NOT NULL,
  `id_periode` varchar(36) NOT NULL,
  `id_modul` varchar(36) NOT NULL,
  `tenggat_unggah` datetime NOT NULL,
  `mulai_penilaian` datetime NOT NULL,
  `is_locked` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`id_jadwal`),
  KEY `id_periode` (`id_periode`),
  KEY `id_modul` (`id_modul`),
  CONSTRAINT `jadwal_moduls_ibfk_1` FOREIGN KEY (`id_periode`) REFERENCES `periodes` (`id_periode`),
  CONSTRAINT `jadwal_moduls_ibfk_2` FOREIGN KEY (`id_modul`) REFERENCES `moduls` (`id_modul`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Table structure for `moduls`
DROP TABLE IF EXISTS `moduls`;
CREATE TABLE `moduls` (
  `id_modul` varchar(36) NOT NULL,
  `nama_modul` varchar(150) NOT NULL,
  `jenis_template` enum('ind','xls') NOT NULL DEFAULT 'ind',
  `file_referensi` varchar(255) DEFAULT NULL,
  `status_template` enum('draf','terbit') NOT NULL DEFAULT 'draf',
  `id_unit_pic` varchar(36) NOT NULL,
  `module_type` enum('checklist','metrics_data','document_verification') DEFAULT 'checklist',
  `status` enum('draf','terbit') DEFAULT 'terbit',
  `scoring_threshold` decimal(5,2) DEFAULT NULL,
  PRIMARY KEY (`id_modul`),
  KEY `id_unit_pic` (`id_unit_pic`),
  KEY `idx_status_template` (`status_template`),
  CONSTRAINT `moduls_ibfk_1` FOREIGN KEY (`id_unit_pic`) REFERENCES `units` (`id_unit`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Table structure for `periodes`
DROP TABLE IF EXISTS `periodes`;
CREATE TABLE `periodes` (
  `id_periode` varchar(36) NOT NULL,
  `nama_periode` varchar(100) NOT NULL,
  `siklus` varchar(30) NOT NULL,
  `tahun` int(11) NOT NULL,
  PRIMARY KEY (`id_periode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Table structure for `rekomendasi_approvals`
DROP TABLE IF EXISTS `rekomendasi_approvals`;
CREATE TABLE `rekomendasi_approvals` (
  `id_rekomendasi` varchar(36) NOT NULL,
  `id_jadwal` varchar(36) NOT NULL,
  `id_modul` varchar(36) NOT NULL,
  `id_ketua_ski` varchar(36) NOT NULL,
  `id_pimpinan` varchar(36) DEFAULT NULL,
  `poin_rekomendasi` text NOT NULL,
  `status_approval_ketua` enum('Disetujui') NOT NULL DEFAULT 'Disetujui',
  `is_dilihat_pimpinan` tinyint(1) DEFAULT 0,
  `waktu_dilihat_pimpinan` datetime DEFAULT NULL,
  `keputusan_pimpinan` enum('Menunggu','Disetujui','Disposisi') DEFAULT 'Menunggu',
  `catatan_disposisi` text DEFAULT NULL,
  `waktu_keputusan` datetime DEFAULT NULL,
  PRIMARY KEY (`id_rekomendasi`),
  KEY `id_jadwal` (`id_jadwal`),
  KEY `id_modul` (`id_modul`),
  KEY `id_ketua_ski` (`id_ketua_ski`),
  KEY `id_pimpinan` (`id_pimpinan`),
  CONSTRAINT `rekomendasi_approvals_ibfk_1` FOREIGN KEY (`id_jadwal`) REFERENCES `jadwal_moduls` (`id_jadwal`),
  CONSTRAINT `rekomendasi_approvals_ibfk_2` FOREIGN KEY (`id_modul`) REFERENCES `moduls` (`id_modul`) ON DELETE CASCADE,
  CONSTRAINT `rekomendasi_approvals_ibfk_3` FOREIGN KEY (`id_ketua_ski`) REFERENCES `users` (`id_user`),
  CONSTRAINT `rekomendasi_approvals_ibfk_4` FOREIGN KEY (`id_pimpinan`) REFERENCES `users` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Table structure for `reviews`
DROP TABLE IF EXISTS `reviews`;
CREATE TABLE `reviews` (
  `id_review` varchar(36) NOT NULL,
  `id_eviden` varchar(36) NOT NULL,
  `id_user_reviewer` varchar(36) NOT NULL,
  `status_kesesuaian` varchar(20) NOT NULL,
  `catatan_temuan` text DEFAULT NULL,
  `waktu_review` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_review`),
  KEY `id_eviden` (`id_eviden`),
  KEY `id_user_reviewer` (`id_user_reviewer`),
  CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`id_eviden`) REFERENCES `evidens` (`id_eviden`) ON DELETE CASCADE,
  CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`id_user_reviewer`) REFERENCES `users` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Table structure for `role_permissions`
DROP TABLE IF EXISTS `role_permissions`;
CREATE TABLE `role_permissions` (
  `id_permission` varchar(36) NOT NULL,
  `id_role` varchar(36) NOT NULL,
  `menu_fitur` varchar(50) NOT NULL,
  `can_view` tinyint(1) DEFAULT 0,
  `can_create` tinyint(1) DEFAULT 0,
  `can_edit` tinyint(1) DEFAULT 0,
  `can_delete` tinyint(1) DEFAULT 0,
  `can_download` tinyint(1) DEFAULT 0,
  `can_approve` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`id_permission`),
  KEY `id_role` (`id_role`),
  CONSTRAINT `role_permissions_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `roles` (`id_role`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Table structure for `roles`
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id_role` varchar(36) NOT NULL,
  `nama_role` varchar(50) NOT NULL,
  PRIMARY KEY (`id_role`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Table structure for `units`
DROP TABLE IF EXISTS `units`;
CREATE TABLE `units` (
  `id_unit` varchar(36) NOT NULL,
  `nama_unit` varchar(100) NOT NULL,
  PRIMARY KEY (`id_unit`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Table structure for `users`
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id_user` varchar(36) NOT NULL,
  `nip_username` varchar(50) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `nama_lengkap` varchar(150) NOT NULL,
  `id_role` varchar(36) NOT NULL,
  `id_unit` varchar(36) DEFAULT NULL,
  `status_aktif` tinyint(1) DEFAULT 1,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `nip_username` (`nip_username`),
  KEY `id_role` (`id_role`),
  KEY `id_unit` (`id_unit`),
  CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `roles` (`id_role`),
  CONSTRAINT `users_ibfk_2` FOREIGN KEY (`id_unit`) REFERENCES `units` (`id_unit`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

SET FOREIGN_KEY_CHECKS=1;
