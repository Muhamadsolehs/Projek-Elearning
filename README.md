# Smartren — Sistem Informasi Manajemen Pesantren Terintegrasi

Aplikasi Enterprise Resource Planning (ERP) dan School Management System modern berbasis web untuk mengelola seluruh ekosistem administrasi, akademik, perizinan asrama, keuangan, perpustakaan, dan kesiswaan pesantren dalam satu platform terintegrasi.

---

## 🚀 Fitur Utama & 11 Hak Akses Pengguna (RBAC)

Aplikasi dilengkapi dengan kontrol akses berbasis peran (*Role-Based Access Control*) dengan navigasi dan dasbor terpisah untuk **11 Role**:

1. **Super Admin**: Monitoring eksekutif, manajemen akun pengguna, konfigurasi hak akses, dan audit trail log.
2. **Administrator Pesantren**: Master data santri 360°, wali santri, pendidik, rombel kelas, dan kamar asrama.
3. **Admin Penerimaan Santri Baru (PSB)**: Pipeline seleksi (Pendaftaran → Berkas → Tes → Kelulusan → Aktivasi NIS & Akun).
4. **Admin Akademik**: Tahun ajaran, semester, kurikulum mapel, jadwal KBM, dan kalender pendidikan.
5. **Guru / Ustadz**: Jadwal mengajar mingguan, presensi harian kelas (*Tandai Semua Hadir*), dan input nilai formatif/sumatif.
6. **Wali Kelas**: Rekap absensi santri kelas, rekap capaian nilai rapor, dan pantauan catatan pembinaan santri.
7. **Admin Keasramaan / Pengasuh**: Jadwal halaqah/tahfidz, presensi asrama, pos satpam/gate check keluar-masuk dengan scanner QR Code.
8. **Bendahara / Keuangan**: Pos tarif biaya, generate tagihan massal, verifikasi pembayaran, dan cetak kuitansi resmi (A5).
9. **Petugas Perpustakaan**: Katalog buku, inventaris eksemplar, generator cetak label barcode & QR Code lembar A4 (Grid 3x7), serta sirkulasi pinjam-kembali.
10. **Portal Santri**: Kartu Tanda Santri (KTS) digital QR, cek jadwal pelajaran, presensi, dan histori nilai.
11. **Portal Wali Santri**: Pantauan perkembangan anak, izin keluar santri, status pembayaran SPP, dan mutasi tabungan santri.

---

## 🛠️ Arsitektur & Teknologi

- **Backend**: Laravel 11 (PHP 8.2+)
- **UI Framework & Template**: Bootstrap 5.2 (Voler Admin Dashboard)
- **Local Template Assets**:
  - CSS: `assets/css/bootstrap.css`, `assets/css/app.css`
  - Ikon: Feather Icons (`assets/js/feather-icons/feather.min.js`)
  - Grafik: Chart.js & ApexCharts (`assets/vendors/`)
  - Datatables: Simple DataTables (`assets/vendors/simple-datatables/`)
  - Scrollbar: Perfect Scrollbar (`assets/vendors/perfect-scrollbar/`)
- **Database**: SQLite (dapat dialihkan ke MySQL / PostgreSQL via `.env`)
- **Standar Bahasa & Format**: Bahasa Indonesia, format tanggal `DD MMMM YYYY`

---

## 📦 Panduan Instalasi Lokal

### 1. Klon Repositori
```bash
git clone https://github.com/Muhamadsolehs/Projek-SmartrenWebsite.git
cd Projek-SmartrenWebsite
```

### 2. Pasang Ketergantungan Composer
```bash
composer install
```

### 3. Konfigurasi Lingkungan (`.env`)
Salin berkas contoh konfigurasi:
```bash
cp .env.example .env
php artisan key:generate
```

Pastikan konfigurasi database di `.env` telah sesuai (secara bawaan menggunakan SQLite):
```env
DB_CONNECTION=sqlite
```
*Jika menggunakan SQLite, pastikan berkas `database/database.sqlite` telah dibuat:*
```bash
touch database/database.sqlite
```

### 4. Menjalankan Aplikasi

- **Opsi A — Menggunakan Laragon (Direkomendasikan):**
  1. Letakkan folder proyek di `C:\laragon\www\TA` atau `D:\laragon\www\TA`.
  2. Klik tombol **Start All** pada aplikasi Laragon.
  3. Buka browser: `http://localhost/TA/` atau `http://TA.test`.

- **Opsi B — Menggunakan Laravel Built-in Server:**
  ```bash
  php artisan serve
  ```
  Buka browser pada alamat `http://127.0.0.1:8000`.

---

## 🔑 Akun & Akses Cepat Demo

Pada halaman masuk (`/login`), tersedia tombol **Akses Cepat Demo** untuk beralih instan ke 11 role tanpa perlu mengetik kredensial satu per satu:
- **Username Default**: `admin@pesantren.sch.id`
- **Password Default**: `password123`

---

## 📄 Lisensi
Hak Cipta © 2026 SIM-Pesantren Terintegrasi (Smartren). Dilindungi undang-undang.

