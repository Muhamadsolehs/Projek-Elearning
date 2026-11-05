import React from 'react';
import { 
  Users, 
  BookOpen, 
  FileCheck2, 
  Award, 
  PlusCircle, 
  ArrowRight, 
  Activity, 
  Calendar,
  Clock,
  Sparkles
} from 'lucide-react';
import { useNavigate } from 'react-router-dom';
import { useAuth } from '../../context/AuthContext';

export const TeacherDashboard: React.FC = () => {
  const { user } = useAuth();
  const navigate = useNavigate();

  return (
    <div className="space-y-4">
      {/* Teacher Welcome Header */}
      <div className="rounded-[20px] bg-gradient-to-r from-[#1769FF] to-[#2575FC] text-white p-5 lg:p-6 shadow-md flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
          <div className="flex items-center gap-2">
            <span className="px-2.5 py-0.5 rounded-full bg-white/20 text-[11px] font-bold tracking-wide uppercase">
              Dashboard Pendidik
            </span>
          </div>
          <h1 className="text-[20px] lg:text-[22px] font-bold mt-1 tracking-tight">
            Selamat Datang, {user.name} 👋
          </h1>
          <p className="text-[12.5px] text-white/90 mt-0.5 max-w-xl">
            Kelola kegiatan belajar mengajar, penilaian tugas, dan pengawasan CBT secara efisien.
          </p>
        </div>

        {/* Quick Actions */}
        <div className="flex flex-wrap items-center gap-2">
          <button
            type="button"
            onClick={() => navigate('/cbt/soal/builder')}
            className="px-3.5 py-2 rounded-xl bg-white text-[#1769FF] text-[12px] font-bold shadow-sm hover:bg-blue-50 active:scale-95 transition-all flex items-center gap-1.5"
          >
            <PlusCircle className="w-3.5 h-3.5" />
            <span>Buat Soal CBT</span>
          </button>
          <button
            type="button"
            onClick={() => navigate('/pembelajaran/materi')}
            className="px-3.5 py-2 rounded-xl bg-white/15 hover:bg-white/25 text-white text-[12px] font-bold border border-white/20 transition-all flex items-center gap-1.5"
          >
            <BookOpen className="w-3.5 h-3.5" />
            <span>Tambah Materi</span>
          </button>
        </div>
      </div>

      {/* 4 Stats Cards for Teacher */}
      <div className="grid grid-cols-2 lg:grid-cols-4 gap-3">
        <div className="bg-white rounded-[18px] p-3.5 border border-[#E6ECF5] shadow-sm">
          <div className="flex items-center justify-between">
            <div className="w-8 h-8 rounded-xl bg-[#EAF2FF] flex items-center justify-center text-[#1769FF]">
              <Users className="w-4 h-4 stroke-[2.2]" />
            </div>
            <span className="text-[10px] font-semibold text-emerald-500">5 Rombel</span>
          </div>
          <div className="mt-2.5">
            <div className="text-[20px] font-bold text-[#17233F]">180</div>
            <div className="text-[11px] text-[#78849A] font-medium">Total Siswa Binaan</div>
          </div>
        </div>

        <div className="bg-white rounded-[18px] p-3.5 border border-[#E6ECF5] shadow-sm">
          <div className="flex items-center justify-between">
            <div className="w-8 h-8 rounded-xl bg-[#FEF5E7] flex items-center justify-center text-[#F5A623]">
              <FileCheck2 className="w-4 h-4 stroke-[2.2]" />
            </div>
            <span className="text-[10px] font-semibold text-amber-500">Perlu Dinilai</span>
          </div>
          <div className="mt-2.5">
            <div className="text-[20px] font-bold text-[#17233F]">14</div>
            <div className="text-[11px] text-[#78849A] font-medium">Tugas Masuk</div>
          </div>
        </div>

        <div className="bg-white rounded-[18px] p-3.5 border border-[#E6ECF5] shadow-sm">
          <div className="flex items-center justify-between">
            <div className="w-8 h-8 rounded-xl bg-[#F2ECFE] flex items-center justify-center text-[#9565F5]">
              <Activity className="w-4 h-4 stroke-[2.2]" />
            </div>
            <span className="text-[10px] font-semibold text-purple-500">Terjadwal</span>
          </div>
          <div className="mt-2.5">
            <div className="text-[20px] font-bold text-[#17233F]">3</div>
            <div className="text-[11px] text-[#78849A] font-medium">Ujian CBT Aktif</div>
          </div>
        </div>

        <div className="bg-white rounded-[18px] p-3.5 border border-[#E6ECF5] shadow-sm">
          <div className="flex items-center justify-between">
            <div className="w-8 h-8 rounded-xl bg-[#E6F8F0] flex items-center justify-center text-[#20B981]">
              <Award className="w-4 h-4 stroke-[2.2]" />
            </div>
            <span className="text-[10px] font-semibold text-emerald-500">KKM 75</span>
          </div>
          <div className="mt-2.5">
            <div className="text-[20px] font-bold text-[#17233F]">84.2</div>
            <div className="text-[11px] text-[#78849A] font-medium">Rata-rata Nilai Kelas</div>
          </div>
        </div>
      </div>

      {/* Main Grid: Pending Grading & Active CBT Monitoring */}
      <div className="grid grid-cols-1 lg:grid-cols-12 gap-4">
        {/* Antrean Tugas Perlu Dinilai (7 cols) */}
        <div className="lg:col-span-7 bg-white rounded-[18px] p-4 border border-[#E6ECF5] shadow-sm space-y-3">
          <div className="flex items-center justify-between">
            <div className="flex items-center gap-2">
              <FileCheck2 className="w-4 h-4 text-[#1769FF] stroke-[2.5]" />
              <h2 className="text-[14px] font-bold text-[#17233F]">Antrean Penilaian Tugas</h2>
            </div>
            <button
              type="button"
              onClick={() => navigate('/pembelajaran/penilaian')}
              className="text-[11px] font-semibold text-[#1769FF] hover:underline flex items-center gap-1"
            >
              <span>Lihat Semua</span>
              <ArrowRight className="w-3 h-3" />
            </button>
          </div>

          <div className="divide-y divide-[#F0F4FA]">
            {[
              {
                title: 'Analisis Data & Kalkulus Integral',
                kelas: 'XII IPA 1',
                submitted: 34,
                total: 36,
                date: 'Hari ini, 09:30',
              },
              {
                title: 'Laporan Tugas Mandiri Vektor',
                kelas: 'XII IPA 2',
                submitted: 32,
                total: 35,
                date: 'Kemarin',
              },
              {
                title: 'Kuis Eksponen & Logaritma',
                kelas: 'XII RPL',
                submitted: 28,
                total: 34,
                date: '2 hari lalu',
              },
            ].map((task, idx) => (
              <div key={idx} className="py-2.5 flex items-center justify-between gap-3">
                <div>
                  <h4 className="text-[12.5px] font-bold text-[#17233F]">{task.title}</h4>
                  <p className="text-[11px] text-[#78849A]">
                    {task.kelas} • Terkumpul: <span className="font-semibold text-[#1769FF]">{task.submitted}/{task.total}</span> Siswa ({task.date})
                  </p>
                </div>
                <button
                  type="button"
                  onClick={() => navigate('/pembelajaran/penilaian')}
                  className="px-3 py-1 rounded-lg bg-[#EAF2FF] text-[#1769FF] text-[11px] font-bold hover:bg-[#1769FF] hover:text-white transition-all flex-shrink-0"
                >
                  Nilai Sekarang
                </button>
              </div>
            ))}
          </div>
        </div>

        {/* Status Monitoring CBT & Ujian Terdekat (5 cols) */}
        <div className="lg:col-span-5 bg-white rounded-[18px] p-4 border border-[#E6ECF5] shadow-sm space-y-3">
          <div className="flex items-center justify-between">
            <div className="flex items-center gap-2">
              <Activity className="w-4 h-4 text-[#1769FF] stroke-[2.5]" />
              <h2 className="text-[14px] font-bold text-[#17233F]">Ujian CBT Terjadwal</h2>
            </div>
            <button
              type="button"
              onClick={() => navigate('/cbt/monitoring')}
              className="text-[11px] font-semibold text-[#1769FF] hover:underline flex items-center gap-1"
            >
              <span>Monitoring</span>
              <ArrowRight className="w-3 h-3" />
            </button>
          </div>

          <div className="space-y-2.5">
            <div className="p-3 rounded-xl bg-[#F8FAFD] border border-[#E6ECF5] space-y-1.5">
              <div className="flex items-center justify-between">
                <span className="text-[12px] font-bold text-[#17233F]">UTS Matematika Wajib</span>
                <span className="px-2 py-0.5 rounded-full bg-blue-100 text-[#1769FF] text-[9.5px] font-bold">
                  20 Nov 2025
                </span>
              </div>
              <p className="text-[11px] text-[#78849A]">Target: XII IPA 1, XII IPA 2 (72 Peserta)</p>
              <div className="flex items-center justify-between pt-1 text-[11px] text-[#5A6A85]">
                <span>Durasi: 90 Menit</span>
                <button
                  type="button"
                  onClick={() => navigate('/cbt/monitoring')}
                  className="text-[#1769FF] font-semibold hover:underline"
                >
                  Buka Monitoring →
                </button>
              </div>
            </div>

            <div className="p-3 rounded-xl bg-[#F8FAFD] border border-[#E6ECF5] space-y-1.5">
              <div className="flex items-center justify-between">
                <span className="text-[12px] font-bold text-[#17233F]">Koreksi Esai CBT Pending</span>
                <span className="px-2 py-0.5 rounded-full bg-amber-100 text-amber-700 text-[9.5px] font-bold">
                  12 Berkas
                </span>
              </div>
              <p className="text-[11px] text-[#78849A]">Ujian Harian Matriks: Perlu penilaian esai manual.</p>
              <div className="flex items-center justify-between pt-1 text-[11px]">
                <span className="text-[#8C98A9]">Batas koreksi: 3 hari</span>
                <button
                  type="button"
                  onClick={() => navigate('/cbt/koreksi-esai')}
                  className="text-amber-600 font-semibold hover:underline"
                >
                  Koreksi Sekarang →
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

