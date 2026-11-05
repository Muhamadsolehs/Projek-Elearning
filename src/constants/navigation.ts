import { 
  LayoutDashboard, 
  BookOpen, 
  FileText, 
  MessagesSquare, 
  CheckSquare, 
  Calendar, 
  Award, 
  GraduationCap, 
  BookMarked, 
  BarChart3, 
  FileCheck2, 
  Settings, 
  LogOut,
  Users,
  Building2,
  ShieldCheck,
  Activity,
  Layers,
  HelpCircle,
  Clock,
  Edit3
} from 'lucide-react';
import { UserRole } from '../types';

export interface NavItem {
  label: string;
  path: string;
  icon: any;
  children?: { label: string; path: string; icon?: any }[];
}

export const getNavItemsForRole = (role: UserRole): NavItem[] => {
  switch (role) {
    case 'siswa':
      return [
        {
          label: 'Dashboard',
          path: '/dashboard',
          icon: LayoutDashboard,
        },
        {
          label: 'Pembelajaran',
          path: '/pembelajaran',
          icon: BookOpen,
          children: [
            { label: 'Materi', path: '/pembelajaran/materi', icon: FileText },
            { label: 'Tugas', path: '/pembelajaran/tugas', icon: CheckSquare },
            { label: 'Forum Diskusi', path: '/pembelajaran/diskusi', icon: MessagesSquare },
          ],
        },
        {
          label: 'Ujian (CBT)',
          path: '/cbt',
          icon: CheckSquare,
          children: [
            { label: 'Bank Soal', path: '/cbt/bank-soal', icon: Layers },
            { label: 'Jadwal Ujian', path: '/cbt/jadwal', icon: Calendar },
            { label: 'Hasil Ujian', path: '/cbt/hasil', icon: Award },
          ],
        },
        {
          label: 'Akademik',
          path: '/akademik',
          icon: GraduationCap,
          children: [
            { label: 'Kelas', path: '/akademik/kelas', icon: Users },
            { label: 'Mata Pelajaran', path: '/akademik/mata-pelajaran', icon: BookMarked },
            { label: 'Nilai', path: '/akademik/nilai', icon: Award },
          ],
        },
        {
          label: 'Laporan',
          path: '/laporan',
          icon: BarChart3,
          children: [
            { label: 'Laporan Akademik', path: '/laporan/akademik', icon: FileText },
            { label: 'Statistik', path: '/laporan/statistik', icon: BarChart3 },
          ],
        },
      ];

    case 'guru':
      return [
        {
          label: 'Dashboard Guru',
          path: '/dashboard',
          icon: LayoutDashboard,
        },
        {
          label: 'Kelas & Mapel',
          path: '/akademik/kelas',
          icon: GraduationCap,
          children: [
            { label: 'Kelas yang Diajar', path: '/akademik/kelas', icon: Users },
            { label: 'Mata Pelajaran', path: '/akademik/mata-pelajaran', icon: BookMarked },
          ],
        },
        {
          label: 'Pembelajaran',
          path: '/pembelajaran',
          icon: BookOpen,
          children: [
            { label: 'Materi Pembelajaran', path: '/pembelajaran/materi', icon: FileText },
            { label: 'Manajemen Tugas', path: '/pembelajaran/tugas', icon: CheckSquare },
            { label: 'Penilaian Tugas', path: '/pembelajaran/penilaian', icon: Award },
            { label: 'Forum Diskusi', path: '/pembelajaran/diskusi', icon: MessagesSquare },
          ],
        },
        {
          label: 'CBT (Ujian)',
          path: '/cbt',
          icon: CheckSquare,
          children: [
            { label: 'Bank Soal', path: '/cbt/bank-soal', icon: Layers },
            { label: 'Buat Soal Baru', path: '/cbt/soal/builder', icon: Edit3 },
            { label: 'Daftar & Buat Ujian', path: '/cbt/ujian', icon: Calendar },
            { label: 'Monitoring Live', path: '/cbt/monitoring', icon: Activity },
            { label: 'Koreksi Esai', path: '/cbt/koreksi-esai', icon: FileCheck2 },
            { label: 'Hasil & Nilai', path: '/cbt/hasil', icon: Award },
          ],
        },
        {
          label: 'Laporan & Rekap',
          path: '/laporan/akademik',
          icon: BarChart3,
          children: [
            { label: 'Laporan Kelas', path: '/laporan/akademik', icon: FileText },
            { label: 'Statistik Belajar', path: '/laporan/statistik', icon: BarChart3 },
          ],
        },
      ];

    case 'admin_institusi':
      return [
        {
          label: 'Dashboard Admin',
          path: '/dashboard',
          icon: LayoutDashboard,
        },
        {
          label: 'Data Akademik',
          path: '/akademik',
          icon: GraduationCap,
          children: [
            { label: 'Tahun Akademik', path: '/akademik/tahun', icon: Calendar },
            { label: 'Data Kelas', path: '/akademik/kelas', icon: Users },
            { label: 'Mata Pelajaran', path: '/akademik/mata-pelajaran', icon: BookMarked },
            { label: 'Jadwal Pelajaran', path: '/akademik/jadwal', icon: Clock },
          ],
        },
        {
          label: 'Manajemen Pengguna',
          path: '/pengguna',
          icon: Users,
          children: [
            { label: 'Data Guru', path: '/pengguna/guru', icon: Users },
            { label: 'Data Siswa', path: '/pengguna/siswa', icon: Users },
            { label: 'Import Pengguna', path: '/pengguna/import', icon: FileText },
          ],
        },
        {
          label: 'Manajemen CBT',
          path: '/cbt',
          icon: CheckSquare,
          children: [
            { label: 'Bank Soal Institusi', path: '/cbt/bank-soal', icon: Layers },
            { label: 'Jadwal Ujian', path: '/cbt/jadwal', icon: Calendar },
            { label: 'Monitoring Ujian', path: '/cbt/monitoring', icon: Activity },
            { label: 'Hasil Ujian', path: '/cbt/hasil', icon: Award },
          ],
        },
        {
          label: 'Laporan & Pengumuman',
          path: '/laporan',
          icon: BarChart3,
          children: [
            { label: 'Rekap Nilai Siswa', path: '/laporan/akademik', icon: Award },
            { label: 'Statistik Pembelajaran', path: '/laporan/statistik', icon: BarChart3 },
            { label: 'Kelola Pengumuman', path: '/pengumuman', icon: MessagesSquare },
          ],
        },
      ];

    case 'super_admin':
      return [
        {
          label: 'Dashboard Platform',
          path: '/dashboard',
          icon: LayoutDashboard,
        },
        {
          label: 'Manajemen Institusi',
          path: '/institusi',
          icon: Building2,
          children: [
            { label: 'Daftar Sekolah/Kampus', path: '/institusi/daftar', icon: Building2 },
            { label: 'Verifikasi Menunggu', path: '/institusi/verifikasi', icon: ShieldCheck },
            { label: 'Tambah Institusi', path: '/institusi/tambah', icon: Building2 },
          ],
        },
        {
          label: 'Platform Pengguna',
          path: '/pengguna/platform',
          icon: Users,
        },
        {
          label: 'Monitoring & Audit',
          path: '/monitoring',
          icon: Activity,
          children: [
            { label: 'Audit Log', path: '/monitoring/audit', icon: FileText },
            { label: 'Status Layanan', path: '/monitoring/status', icon: Activity },
          ],
        },
      ];
  }
};

