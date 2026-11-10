-- Seed Data Monev SKI BBPK Jakarta
-- Generated 2026-10-14 04:12:36

SET FOREIGN_KEY_CHECKS=0;

-- Data for `units`
INSERT INTO `units` (`id_unit`, `nama_unit`) VALUES ('u-keu', 'Keuangan');
INSERT INTO `units` (`id_unit`, `nama_unit`) VALUES ('u-peg', 'Kepegawaian');
INSERT INTO `units` (`id_unit`, `nama_unit`) VALUES ('u-ren', 'Perencanaan');

-- Data for `roles`
INSERT INTO `roles` (`id_role`, `nama_role`) VALUES ('adm', 'Admin');
INSERT INTO `roles` (`id_role`, `nama_role`) VALUES ('ang', 'Anggota SKI');
INSERT INTO `roles` (`id_role`, `nama_role`) VALUES ('itj', 'Itjen');
INSERT INTO `roles` (`id_role`, `nama_role`) VALUES ('ket', 'Ketua SKI');
INSERT INTO `roles` (`id_role`, `nama_role`) VALUES ('pic', 'PIC');
INSERT INTO `roles` (`id_role`, `nama_role`) VALUES ('pim', 'Pimpinan');

-- Data for `users`
INSERT INTO `users` (`id_user`, `nip_username`, `password_hash`, `nama_lengkap`, `id_role`, `id_unit`, `status_aktif`) VALUES ('usr-admin', 'admin', '$2y$10$SCrXrXkagSMmtpXwKc5AjuO9KmpCCd5rtU8P5lw6QpRwaRGVl.C5q', 'Administrator Sistem', 'adm', NULL, '1');
INSERT INTO `users` (`id_user`, `nip_username`, `password_hash`, `nama_lengkap`, `id_role`, `id_unit`, `status_aktif`) VALUES ('usr-agus', 'agus.ren', '$2y$10$SCrXrXkagSMmtpXwKc5AjuO9KmpCCd5rtU8P5lw6QpRwaRGVl.C5q', 'Agus Prayitno', 'pic', 'u-ren', '1');
INSERT INTO `users` (`id_user`, `nip_username`, `password_hash`, `nama_lengkap`, `id_role`, `id_unit`, `status_aktif`) VALUES ('usr-budi', 'budi.keu', '$2y$10$SCrXrXkagSMmtpXwKc5AjuO9KmpCCd5rtU8P5lw6QpRwaRGVl.C5q', 'Budi Santoso', 'pic', 'u-keu', '1');
INSERT INTO `users` (`id_user`, `nip_username`, `password_hash`, `nama_lengkap`, `id_role`, `id_unit`, `status_aktif`) VALUES ('usr-dewi', 'dewi.peg', '$2y$10$SCrXrXkagSMmtpXwKc5AjuO9KmpCCd5rtU8P5lw6QpRwaRGVl.C5q', 'Dewi Lestari', 'pic', 'u-peg', '1');
INSERT INTO `users` (`id_user`, `nip_username`, `password_hash`, `nama_lengkap`, `id_role`, `id_unit`, `status_aktif`) VALUES ('usr-itjen', 'itjen.01', '$2y$10$SCrXrXkagSMmtpXwKc5AjuO9KmpCCd5rtU8P5lw6QpRwaRGVl.C5q', 'Auditor Itjen Kemenkes', 'itj', NULL, '1');
INSERT INTO `users` (`id_user`, `nip_username`, `password_hash`, `nama_lengkap`, `id_role`, `id_unit`, `status_aktif`) VALUES ('usr-ketua', 'ketua.ski', '$2y$10$SCrXrXkagSMmtpXwKc5AjuO9KmpCCd5rtU8P5lw6QpRwaRGVl.C5q', 'Ketua SKI BBPK', 'ket', NULL, '1');
INSERT INTO `users` (`id_user`, `nip_username`, `password_hash`, `nama_lengkap`, `id_role`, `id_unit`, `status_aktif`) VALUES ('usr-pim', 'pimpinan', '$2y$10$SCrXrXkagSMmtpXwKc5AjuO9KmpCCd5rtU8P5lw6QpRwaRGVl.C5q', 'Kepala BBPK Jakarta', 'pim', NULL, '1');
INSERT INTO `users` (`id_user`, `nip_username`, `password_hash`, `nama_lengkap`, `id_role`, `id_unit`, `status_aktif`) VALUES ('usr-rina', 'rina.ski', '$2y$10$SCrXrXkagSMmtpXwKc5AjuO9KmpCCd5rtU8P5lw6QpRwaRGVl.C5q', 'Rina Marlina', 'ang', NULL, '1');

-- Data for `role_permissions`
INSERT INTO `role_permissions` (`id_permission`, `id_role`, `menu_fitur`, `can_view`, `can_create`, `can_edit`, `can_delete`, `can_download`, `can_approve`) VALUES ('d566d271-c771-11f1-bc62-a02919692648', 'pic', 'dash', '1', '0', '0', '0', '0', '0');
INSERT INTO `role_permissions` (`id_permission`, `id_role`, `menu_fitur`, `can_view`, `can_create`, `can_edit`, `can_delete`, `can_download`, `can_approve`) VALUES ('d566ec1d-c771-11f1-bc62-a02919692648', 'pic', 'upl', '1', '1', '1', '1', '1', '0');
INSERT INTO `role_permissions` (`id_permission`, `id_role`, `menu_fitur`, `can_view`, `can_create`, `can_edit`, `can_delete`, `can_download`, `can_approve`) VALUES ('d566ecd7-c771-11f1-bc62-a02919692648', 'ang', 'dash', '1', '0', '0', '0', '0', '0');
INSERT INTO `role_permissions` (`id_permission`, `id_role`, `menu_fitur`, `can_view`, `can_create`, `can_edit`, `can_delete`, `can_download`, `can_approve`) VALUES ('d566ed16-c771-11f1-bc62-a02919692648', 'ang', 'mod', '1', '1', '1', '0', '0', '0');
INSERT INTO `role_permissions` (`id_permission`, `id_role`, `menu_fitur`, `can_view`, `can_create`, `can_edit`, `can_delete`, `can_download`, `can_approve`) VALUES ('d566ed4c-c771-11f1-bc62-a02919692648', 'ang', 'rev', '1', '0', '1', '0', '0', '0');
INSERT INTO `role_permissions` (`id_permission`, `id_role`, `menu_fitur`, `can_view`, `can_create`, `can_edit`, `can_delete`, `can_download`, `can_approve`) VALUES ('d566ed87-c771-11f1-bc62-a02919692648', 'ang', 'aud', '1', '0', '0', '0', '0', '0');
INSERT INTO `role_permissions` (`id_permission`, `id_role`, `menu_fitur`, `can_view`, `can_create`, `can_edit`, `can_delete`, `can_download`, `can_approve`) VALUES ('d566ee63-c771-11f1-bc62-a02919692648', 'ket', 'dash', '1', '0', '0', '0', '0', '0');
INSERT INTO `role_permissions` (`id_permission`, `id_role`, `menu_fitur`, `can_view`, `can_create`, `can_edit`, `can_delete`, `can_download`, `can_approve`) VALUES ('d566ee98-c771-11f1-bc62-a02919692648', 'ket', 'mod', '1', '1', '1', '1', '0', '0');
INSERT INTO `role_permissions` (`id_permission`, `id_role`, `menu_fitur`, `can_view`, `can_create`, `can_edit`, `can_delete`, `can_download`, `can_approve`) VALUES ('d566eed0-c771-11f1-bc62-a02919692648', 'ket', 'jdw', '1', '1', '1', '1', '0', '0');
INSERT INTO `role_permissions` (`id_permission`, `id_role`, `menu_fitur`, `can_view`, `can_create`, `can_edit`, `can_delete`, `can_download`, `can_approve`) VALUES ('d566ef03-c771-11f1-bc62-a02919692648', 'ket', 'mon', '1', '0', '0', '0', '1', '0');
INSERT INTO `role_permissions` (`id_permission`, `id_role`, `menu_fitur`, `can_view`, `can_create`, `can_edit`, `can_delete`, `can_download`, `can_approve`) VALUES ('d566ef37-c771-11f1-bc62-a02919692648', 'ket', 'apr', '1', '0', '0', '0', '0', '1');
INSERT INTO `role_permissions` (`id_permission`, `id_role`, `menu_fitur`, `can_view`, `can_create`, `can_edit`, `can_delete`, `can_download`, `can_approve`) VALUES ('d566ef6b-c771-11f1-bc62-a02919692648', 'ket', 'exp', '1', '0', '0', '0', '1', '0');
INSERT INTO `role_permissions` (`id_permission`, `id_role`, `menu_fitur`, `can_view`, `can_create`, `can_edit`, `can_delete`, `can_download`, `can_approve`) VALUES ('d566efa3-c771-11f1-bc62-a02919692648', 'ket', 'aud', '1', '0', '0', '0', '0', '0');
INSERT INTO `role_permissions` (`id_permission`, `id_role`, `menu_fitur`, `can_view`, `can_create`, `can_edit`, `can_delete`, `can_download`, `can_approve`) VALUES ('d566efd3-c771-11f1-bc62-a02919692648', 'pim', 'dash', '1', '0', '0', '0', '0', '0');
INSERT INTO `role_permissions` (`id_permission`, `id_role`, `menu_fitur`, `can_view`, `can_create`, `can_edit`, `can_delete`, `can_download`, `can_approve`) VALUES ('d566f014-c771-11f1-bc62-a02919692648', 'pim', 'apm', '1', '0', '0', '0', '0', '1');
INSERT INTO `role_permissions` (`id_permission`, `id_role`, `menu_fitur`, `can_view`, `can_create`, `can_edit`, `can_delete`, `can_download`, `can_approve`) VALUES ('d566f04d-c771-11f1-bc62-a02919692648', 'pim', 'exp', '1', '0', '0', '0', '1', '0');
INSERT INTO `role_permissions` (`id_permission`, `id_role`, `menu_fitur`, `can_view`, `can_create`, `can_edit`, `can_delete`, `can_download`, `can_approve`) VALUES ('d566f086-c771-11f1-bc62-a02919692648', 'pim', 'aud', '1', '0', '0', '0', '0', '0');
INSERT INTO `role_permissions` (`id_permission`, `id_role`, `menu_fitur`, `can_view`, `can_create`, `can_edit`, `can_delete`, `can_download`, `can_approve`) VALUES ('d566f0c1-c771-11f1-bc62-a02919692648', 'itj', 'dash', '1', '0', '0', '0', '0', '0');
INSERT INTO `role_permissions` (`id_permission`, `id_role`, `menu_fitur`, `can_view`, `can_create`, `can_edit`, `can_delete`, `can_download`, `can_approve`) VALUES ('d566f0f7-c771-11f1-bc62-a02919692648', 'itj', 'rep', '1', '0', '0', '0', '1', '0');
INSERT INTO `role_permissions` (`id_permission`, `id_role`, `menu_fitur`, `can_view`, `can_create`, `can_edit`, `can_delete`, `can_download`, `can_approve`) VALUES ('d566f12a-c771-11f1-bc62-a02919692648', 'itj', 'aud', '1', '0', '0', '0', '0', '0');
INSERT INTO `role_permissions` (`id_permission`, `id_role`, `menu_fitur`, `can_view`, `can_create`, `can_edit`, `can_delete`, `can_download`, `can_approve`) VALUES ('d566f171-c771-11f1-bc62-a02919692648', 'adm', 'jdw', '1', '1', '1', '0', '0', '0');
INSERT INTO `role_permissions` (`id_permission`, `id_role`, `menu_fitur`, `can_view`, `can_create`, `can_edit`, `can_delete`, `can_download`, `can_approve`) VALUES ('d566f1b1-c771-11f1-bc62-a02919692648', 'adm', 'usr', '1', '1', '1', '1', '0', '0');
INSERT INTO `role_permissions` (`id_permission`, `id_role`, `menu_fitur`, `can_view`, `can_create`, `can_edit`, `can_delete`, `can_download`, `can_approve`) VALUES ('d566f1e9-c771-11f1-bc62-a02919692648', 'adm', 'hak', '1', '0', '1', '0', '0', '0');
INSERT INTO `role_permissions` (`id_permission`, `id_role`, `menu_fitur`, `can_view`, `can_create`, `can_edit`, `can_delete`, `can_download`, `can_approve`) VALUES ('d566f21d-c771-11f1-bc62-a02919692648', 'adm', 'aud', '1', '0', '0', '0', '0', '0');

-- Data for `periodes`
INSERT INTO `periodes` (`id_periode`, `nama_periode`, `siklus`, `tahun`) VALUES ('per-2026-10', 'Oktober 2026', 'Bulanan', '2026');

-- Data for `moduls`
INSERT INTO `moduls` (`id_modul`, `nama_modul`, `jenis_template`, `file_referensi`, `status_template`, `id_unit_pic`) VALUES ('mod-kk', 'Konflik Kepentingan', 'ind', 'Panduan_Konflik_Kepentingan.pdf', 'terbit', 'u-peg');
INSERT INTO `moduls` (`id_modul`, `nama_modul`, `jenis_template`, `file_referensi`, `status_template`, `id_unit_pic`) VALUES ('mod-lk', 'Laporan Keuangan (LKE)', 'xls', 'Form_bantu_LRA_LO_LPE_Neraca.xlsx', 'terbit', 'u-keu');
INSERT INTO `moduls` (`id_modul`, `nama_modul`, `jenis_template`, `file_referensi`, `status_template`, `id_unit_pic`) VALUES ('mod-mr', 'Manajemen Risiko', 'ind', 'Panduan_Manajemen_Risiko.pdf', 'terbit', 'u-ren');
INSERT INTO `moduls` (`id_modul`, `nama_modul`, `jenis_template`, `file_referensi`, `status_template`, `id_unit_pic`) VALUES ('mod-pbj', 'PBJ (Pengadaan Barang & Jasa)', 'ind', 'Panduan_6_Aspek_PBJ.pdf', 'terbit', 'u-keu');

-- Data for `jadwal_moduls`
INSERT INTO `jadwal_moduls` (`id_jadwal`, `id_periode`, `id_modul`, `tenggat_unggah`, `mulai_penilaian`, `is_locked`) VALUES ('jdw-kk', 'per-2026-10', 'mod-kk', '2026-10-30 23:59:59', '2026-11-02 08:00:00', '0');
INSERT INTO `jadwal_moduls` (`id_jadwal`, `id_periode`, `id_modul`, `tenggat_unggah`, `mulai_penilaian`, `is_locked`) VALUES ('jdw-lk', 'per-2026-10', 'mod-lk', '2026-10-30 23:59:59', '2026-11-02 08:00:00', '0');
INSERT INTO `jadwal_moduls` (`id_jadwal`, `id_periode`, `id_modul`, `tenggat_unggah`, `mulai_penilaian`, `is_locked`) VALUES ('jdw-mr', 'per-2026-10', 'mod-mr', '2026-10-30 23:59:59', '2026-11-02 08:00:00', '0');
INSERT INTO `jadwal_moduls` (`id_jadwal`, `id_periode`, `id_modul`, `tenggat_unggah`, `mulai_penilaian`, `is_locked`) VALUES ('jdw-pbj', 'per-2026-10', 'mod-pbj', '2026-10-30 23:59:59', '2026-11-02 08:00:00', '0');

-- Data for `indikators`
INSERT INTO `indikators` (`id_indikator`, `id_modul`, `deskripsi_indikator`, `nomor_urut`) VALUES ('ind-kk-1', 'mod-kk', 'Penetapan pengelola konflik kepentingan', '1');
INSERT INTO `indikators` (`id_indikator`, `id_modul`, `deskripsi_indikator`, `nomor_urut`) VALUES ('ind-kk-2', 'mod-kk', 'Pemetaan potensi konflik kepentingan', '2');
INSERT INTO `indikators` (`id_indikator`, `id_modul`, `deskripsi_indikator`, `nomor_urut`) VALUES ('ind-kk-3', 'mod-kk', 'Deklarasi konflik kepentingan pegawai', '3');
INSERT INTO `indikators` (`id_indikator`, `id_modul`, `deskripsi_indikator`, `nomor_urut`) VALUES ('ind-lk-1', 'mod-lk', 'Laporan Realisasi Anggaran (LRA)', '1');
INSERT INTO `indikators` (`id_indikator`, `id_modul`, `deskripsi_indikator`, `nomor_urut`) VALUES ('ind-lk-2', 'mod-lk', 'Laporan Operasional (LO)', '2');
INSERT INTO `indikators` (`id_indikator`, `id_modul`, `deskripsi_indikator`, `nomor_urut`) VALUES ('ind-lk-3', 'mod-lk', 'Laporan Perubahan Ekuitas (LPE)', '3');
INSERT INTO `indikators` (`id_indikator`, `id_modul`, `deskripsi_indikator`, `nomor_urut`) VALUES ('ind-lk-4', 'mod-lk', 'Neraca', '4');
INSERT INTO `indikators` (`id_indikator`, `id_modul`, `deskripsi_indikator`, `nomor_urut`) VALUES ('ind-mr-1', 'mod-mr', 'Profil risiko unit kerja', '1');
INSERT INTO `indikators` (`id_indikator`, `id_modul`, `deskripsi_indikator`, `nomor_urut`) VALUES ('ind-mr-2', 'mod-mr', 'Register risiko', '2');
INSERT INTO `indikators` (`id_indikator`, `id_modul`, `deskripsi_indikator`, `nomor_urut`) VALUES ('ind-mr-3', 'mod-mr', 'Rencana tindak pengendalian', '3');
INSERT INTO `indikators` (`id_indikator`, `id_modul`, `deskripsi_indikator`, `nomor_urut`) VALUES ('ind-pbj-1', 'mod-pbj', 'Tepat kualitas', '1');
INSERT INTO `indikators` (`id_indikator`, `id_modul`, `deskripsi_indikator`, `nomor_urut`) VALUES ('ind-pbj-2', 'mod-pbj', 'Tepat jumlah', '2');
INSERT INTO `indikators` (`id_indikator`, `id_modul`, `deskripsi_indikator`, `nomor_urut`) VALUES ('ind-pbj-3', 'mod-pbj', 'Tepat harga', '3');

-- Data for `audit_logs`
INSERT INTO `audit_logs` (`id_log`, `id_user`, `role_saat_aksi`, `jenis_aksi`, `objek_target`, `ip_address`, `timestamp_aktivitas`) VALUES ('01df27b7-5b4d-4ec7-bf5f-96dd9003d7de', 'usr-ketua', 'Ketua SKI', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-14 08:55:45');
INSERT INTO `audit_logs` (`id_log`, `id_user`, `role_saat_aksi`, `jenis_aksi`, `objek_target`, `ip_address`, `timestamp_aktivitas`) VALUES ('15ebef70-67ec-458f-8c7c-4b37dd1f4161', 'usr-pim', 'Pimpinan', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-14 09:02:15');
INSERT INTO `audit_logs` (`id_log`, `id_user`, `role_saat_aksi`, `jenis_aksi`, `objek_target`, `ip_address`, `timestamp_aktivitas`) VALUES ('46511e2e-462e-4cef-aa89-4e9ce9f137e5', 'usr-agus', 'PIC', 'Login', 'Sistem Monev SKI', '::1', '2026-10-14 08:55:48');
INSERT INTO `audit_logs` (`id_log`, `id_user`, `role_saat_aksi`, `jenis_aksi`, `objek_target`, `ip_address`, `timestamp_aktivitas`) VALUES ('609b7c2c-4854-4d88-9177-3ce78625d28a', 'usr-agus', 'PIC', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-14 08:55:50');
INSERT INTO `audit_logs` (`id_log`, `id_user`, `role_saat_aksi`, `jenis_aksi`, `objek_target`, `ip_address`, `timestamp_aktivitas`) VALUES ('bdbc486c-caa5-4c1a-86b1-8a022b3236a1', 'usr-ketua', 'Ketua SKI', 'Login', 'Sistem Monev SKI', '::1', '2026-10-14 08:55:32');
INSERT INTO `audit_logs` (`id_log`, `id_user`, `role_saat_aksi`, `jenis_aksi`, `objek_target`, `ip_address`, `timestamp_aktivitas`) VALUES ('c4b4dbec-8ddf-49db-9868-a0a9866f1e79', 'usr-admin', 'Admin', 'Login', 'Sistem Monev SKI', '::1', '2026-10-14 08:55:53');
INSERT INTO `audit_logs` (`id_log`, `id_user`, `role_saat_aksi`, `jenis_aksi`, `objek_target`, `ip_address`, `timestamp_aktivitas`) VALUES ('dd573a68-34ed-4e34-af59-480b1a376b69', 'usr-admin', 'Admin', 'Logout', 'Sesi diakhiri oleh pengguna', '::1', '2026-10-14 08:56:09');
INSERT INTO `audit_logs` (`id_log`, `id_user`, `role_saat_aksi`, `jenis_aksi`, `objek_target`, `ip_address`, `timestamp_aktivitas`) VALUES ('f0e8ec75-f5c6-4bf6-a392-0f0522ea7b34', 'usr-pim', 'Pimpinan', 'Login', 'Sistem Monev SKI', '::1', '2026-10-14 08:56:12');

SET FOREIGN_KEY_CHECKS=1;
