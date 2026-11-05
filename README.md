# EduCore — Integrated E-Learning & Computer Based Test Platform

Platform terintegrasi Pembelajaran Daring (*E-Learning*) dan Ujian Berbasis Komputer (*Computer Based Test* / CBT) modern dengan antarmuka presisi (*pixel-perfect*), sistem multi-tenant, dan otorisasi berbasis peran (Role-Based Access Control / RBAC).

---

## 🚀 Fitur Utama

### 1. Dashboard Interaktif (4 Role RBAC)
- **Siswa**: Dashboard responsif dengan reproduksi visual presisi (*pixel-perfect*), kartu statistik capaian, banner sambutan, daftar kelas aktif, hitung mundur ujian CBT, widget jadwal & kalender bulanan, widget tugas mendesak, serta pemantau progres belajar lingkaran (*circular ring*).
- **Guru**: Manajemen kelas, antrean koreksi tugas siswa, penjadwalan butir CBT, monitoring pengawasan ujian *real-time*, dan koreksi esai dengan rubrik terstandar.
- **Admin Institusi**: Manajemen data akademik (Tahun Ajaran, Rombel/Kelas, Mata Pelajaran), statistik siswa & guru, import data massal via Excel, serta pemantau infrastruktur server CBT.
- **Super Admin**: Hub multi-tenant platform, verifikasi pendaftaran sekolah/kampus baru, pemantau kesehatan cluster server (*uptime 99.98%*), dan audit log aktivitas sistem.

### 2. Modul E-Learning Komprehensif
- **Materi & Silabus**: Struktur bab dan topik terorganisir dengan estimasi waktu belajar, materi teks/multimedia, dan pelacakan status selesai.
- **Tugas & Praktikum**: Filter status pengumpulan (Belum Selesai, Menunggu Nilai, Dinilai), modal pengunggahan berkas tugas (PDF/DOCX/ZIP), dan catatan feedback dari guru.
- **Forum Diskusi**: Ruang kolaborasi tanya-jawab interaktif antar siswa dan guru dengan penanda topik disematkan (*pinned topic*).

### 3. Modul CBT (Computer Based Test) Terstandar
- **Question Builder Multi-format**: Mendukung Pilihan Ganda Tunggal, Pilihan Ganda Kompleks, Benar/Salah, Isian Singkat, Menjodohkan, dan Uraian/Esai lengkap dengan bobot skor dan pembahasan.
- **Ruang Pengerjaan Ujian (*Distraction-Free*)**:
  - Timer hitung mundur berbasis server dengan penanda visual.
  - Palet navigasi nomor soal dengan 4 status warna: Belum Dijawab (abu-abu), Sudah Dijawab (hijau), Ragu-ragu (kuning), dan Sedang Dibuka (ring biru).
  - Indikator penyimpanan otomatis (*autosave status*) *real-time*.
  - Dialog konfirmasi submit dengan rekapitulasi butir terisi.
- **Live Monitoring & Proctoring**: Tabel pengawasan peserta ujian aktif (*real-time status*, durasi, indikator pelanggaran pindah tab, buka kunci, dan submit paksa).
- **Koreksi Esai & Rekap Nilai**: Penilaian esai manual guru dengan skor parsial dan umpan balik personal.

---

## 🛠️ Teknologi yang Digunakan

- **Framework**: [React 18](https://react.dev/) + [TypeScript](https://www.typescriptlang.org/)
- **Build Tool**: [Vite 5](https://vitejs.dev/)
- **Styling**: [Tailwind CSS 3](https://tailwindcss.com/)
- **Ikon Antarmuka**: [Lucide Icons](https://lucide.dev/)
- **Routing**: [React Router v6](https://reactrouter.com/)
- **Typography**: Plus Jakarta Sans & Inter

---

## 📦 Panduan Instalasi & Menjalankan Aplikasi

Pastikan Node.js (versi 18+) telah terpasang di perangkat Anda.

```bash
# 1. Clone repositori
git clone https://github.com/Muhamadsolehs/Projek-Elearning.git
cd Projek-Elearning

# 2. Pasang dependensi
npm install

# 3. Jalankan development server
npm run dev

# 4. Bangun versi produksi teroptimasi
npm run build
npm run preview
```

Buka URL **`http://localhost:3000`** di browser Anda. Gunakan menu dropdown profil di pojok kanan atas untuk mengganti tampilan peran (*role switcher*) secara langsung.

---

## 📄 Lisensi

Hak Cipta © 2026 EduCore Platform. Seluruh hak cipta dilindungi undang-undang.
