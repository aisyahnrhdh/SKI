# AGENTS.MD - System Prompt & Guidelines Utuh (Monev SKI Prototype)

## 1. Konteks Proyek & Arsitektur Sistem
Proyek ini adalah **Prototipe Sistem Monitoring & Evaluasi Satuan Kepatuhan Internal (MONEV SKI) BBPK Jakarta**[cite: 2].
- **Root Directory:** `monev-ski/`
- **Tech Stack Utama:** Native PHP (Procedural/Modular), HTML5, Tailwind CSS, JavaScript (Vanilla/Fetch API), MySQL / MariaDB[cite: 1].
- **Database Reference:** File `database/monev_ski.sql` dan ERD resmi pada dokumen SRS[cite: 1, 22].
- **Peran Pengguna (RBAC - 6 Roles):** `PIC`, `Anggota SKI`, `Ketua SKI`, `Pimpinan`, `Itjen`, `Admin`[cite: 7].

### Struktur & Fungsi Berkas Internal (Wajib Diikuti)
1. `config/database.php`: Mengoperasikan koneksi database (gunakan PDO / MySQLi Prepared Statement)[cite: 1].
2. `includes/auth.php`: Skrip otentikasi sesi dan pemeriksaan hak akses peran (RBAC). Harus dipanggil di baris paling atas setiap halaman terproteksi[cite: 1, 12].
3. `includes/functions.php`: Berisi fungsi-fungsi pembantu (*helper functions*) umum, query reutilisasi, sanitasi input, dan penanganan format[cite: 1].
4. `ajax.php`: Menangani semua request asinkronus (Fetch / AJAX) dari frontend untuk pembaruan data tanpa reload halaman[cite: 1].
5. `index.php`: Halaman antarmuka utama yang menyajikan dashboard dan navigasi fitur[cite: 1].
6. `uploads/`: Direktori penyimpanan berkas eviden dan template dokumen (`uploads/evidens/`, `uploads/templates/`)[cite: 1].

---

## 2. Aturan Tampilan & Design System (Kemenkes Corporate Style)

AI Agent WAJIB menyusun UI/UX yang 100% identik dengan tangkapan layar dashboard Monev SKI BBPK Jakarta[cite: 26]:

### A. Skema Warna & Latar Belakang
- **Header Topbar & Primary Button:** Teal Kemenkes `#006a55` (`bg-[#006a55]` atau `bg-teal-800`)[cite: 26].
- **Main Canvas Background:** Soft Mint / Light Teal Gradient (`bg-[#eef7f5]`)[cite: 26].
- **Sidebar Navigasi:** Light Mint Pucat (`bg-[#e2f1ed]`) dengan logo Kemenkes BBPK Jakarta di bagian paling atas[cite: 1, 26].
- **Kartu & Kontainer:** White Solid (`bg-white`), *border-radius* melengkung halus (`rounded-2xl` atau `rounded-3xl`), dengan bayangan sangat lembut (`shadow-sm border border-teal-100/50`)[cite: 26].

### B. Komponen Visual & Indikator
- **Kartu Statistik (Summary Cards):** Menampilkan ikon dalam kotak berwarna *rounded square* (Biru, Hijau, Amber, Ungu) di posisi kiri judul & nilai statistik[cite: 26].
- **Progress Bar:** Garis indikator ramping dengan kelengkungan penuh (`rounded-full bg-emerald-500` untuk selesai, `bg-amber-500` untuk proses)[cite: 26].
- **Badge Status (Wajib Format Ini):**
  - `Belum Diunggah`: `bg-amber-100 text-amber-800 border border-amber-200/60 rounded-lg px-2.5 py-1 text-xs font-semibold`[cite: 26]
  - `Menunggu Review`: `bg-blue-100 text-blue-800 border border-blue-200/60 rounded-lg px-2.5 py-1 text-xs font-semibold`[cite: 26]
  - `Perlu Tindak Lanjut / Revisi`: `bg-rose-100 text-rose-800 border border-rose-200/60 rounded-lg px-2.5 py-1 text-xs font-semibold`[cite: 26]
  - `Selesai / Approved`: `bg-emerald-100 text-emerald-800 border border-emerald-200/60 rounded-lg px-2.5 py-1 text-xs font-semibold`[cite: 26]
- **Toast Notification:** Floating alert di bagian bawah tengah layar (`bg-[#006a55] text-white px-5 py-3 rounded-xl shadow-xl font-medium flex items-center gap-2`)[cite: 26].

---

## 3. Aturan Kodingan Ketat (Strict Coding Rules)

### A. Larangan Merombak Codebase (No Reverse Engineering)
- DILARANG MERUBAH arsitektur proyek menjadi OOP kompleks, Next.js, Laravel, atau CodeIgniter. Tetap gunakan Native PHP secara konsisten[cite: 1].
- DILARANG MEMBUAT FILE/FOLDER BARU di luar struktur yang sudah ada tanpa izin eksplisit dari pengguna[cite: 1].

### B. Single Source of Truth (Database Lock)
- Semua kueri `SELECT`, `INSERT`, `UPDATE`, `DELETE` WAJIB mengacu pada tabel dan nama kolom asli di `database/monev_ski.sql`[cite: 1].
- DILARANG KERAS merancang tabel baru, mengubah tipe data kolom, atau menambah relasi baru di luar skema SQL dan ERD SRS[cite: 1, 22].

### C. Wajib Full Code (Dilarang Memotong Kode)
- Setiap kali memberikan atau mengedit file, AI WAJIB menuliskan SELURUH isi kodenya secara utuh dari baris `<?php` pertama hingga akhir dokumen.
- DILARANG KERAS menyisipkan komentar pemotong seperti `// ... kode lainnya tetap sama`, `// TODO: tambahkan logic disini`, atau `/* potongan kode sebelumnya */`.

### D. Standar Keamanan & Kode PHP
- Wajib menggunakan `Prepared Statements` (PDO atau MySQLi) untuk mencegah SQL Injection pada semua input pengguna.
- Wajib menggunakan `htmlspecialchars()` untuk memfilter data string yang ditampilkan ke HTML (mencegah XSS).
- Selalu periksa `session_status()` dan panggil otorisasi peran dari `includes/auth.php` di awal baris[cite: 1, 12].

---

## 4. Protocols & Step-by-Step Workflow

### Protokol 1: Pengerjaan Atomik (One-Task-at-a-Time)
- Kerjakan tepat satu file, satu fungsi, atau satu kueri dalam satu kali perintah agar programmer pemula dapat mengikuti perubahannya dengan mudah.

### Protokol 2: Verifikasi Fungsi Internal
- Sebelum membuat fungsi utilitas baru, AI WAJIB mereferensikan atau menggunakan fungsi yang sudah didefinisikan di `includes/functions.php`[cite: 1].

### Protokol 3: Penjelasan Rencana Singkat (Plan-First)
- Untuk logika multi-step (seperti *auto-lock deadline*, *bulk approval*, atau *disposisi pimpinan*), AI WAJIB menyajikan 2-3 poin rencana logikanya terlebih dahulu sebelum menyajikan kodenya[cite: 8, 9].

### Protokol 4: Format Penanganan Error
- Jika pengguna melaporkan bug/error, AI harus:
  1. Menjelaskan penyebab masalah dalam 1-2 kalimat sederhana.
  2. Memberikan file perbaikan kodenya secara lengkap utuh (*full code*).