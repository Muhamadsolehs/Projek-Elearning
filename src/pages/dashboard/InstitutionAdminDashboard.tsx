import React from 'react';
import { 
  Building2, 
  Users, 
  GraduationCap, 
  BookMarked, 
  Calendar, 
  PlusCircle, 
  FileUp, 
  Activity, 
  CheckCircle2,
  ArrowRight
} from 'lucide-react';
import { useNavigate } from 'react-router-dom';
import { useAuth } from '../../context/AuthContext';

export const InstitutionAdminDashboard: React.FC = () => {
  const { user } = useAuth();
  const navigate = useNavigate();

  return (
    <div className="space-y-4">
      {/* Institution Banner */}
      <div className="rounded-[20px] bg-gradient-to-r from-[#1769FF] to-[#1248D8] text-white p-5 lg:p-6 shadow-md flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
          <span className="px-2.5 py-0.5 rounded-full bg-white/20 text-[11px] font-bold tracking-wide uppercase">
            Admin Institusi
          </span>
          <h1 className="text-[20px] lg:text-[22px] font-bold mt-1 tracking-tight">
            {user.institutionName}
          </h1>
          <p className="text-[12.5px] text-white/90 mt-0.5">
            Tahun Ajaran 2025/2026 • Semester Ganjil (Status: Aktif)
          </p>
        </div>

        {/* Quick Actions */}
        <div className="flex flex-wrap items-center gap-2">
          <button
            type="button"
            onClick={() => navigate('/pengguna/import')}
            className="px-3.5 py-2 rounded-xl bg-white text-[#1769FF] text-[12px] font-bold shadow-sm hover:bg-blue-50 active:scale-95 transition-all flex items-center gap-1.5"
          >
            <FileUp className="w-3.5 h-3.5" />
            <span>Import Siswa (Excel)</span>
          </button>
          <button
            type="button"
            onClick={() => navigate('/akademik/kelas')}
            className="px-3.5 py-2 rounded-xl bg-white/15 hover:bg-white/25 text-white text-[12px] font-bold border border-white/20 transition-all flex items-center gap-1.5"
          >
            <PlusCircle className="w-3.5 h-3.5" />
            <span>Tambah Kelas</span>
          </button>
        </div>
      </div>

      {/* 4 Stats Cards */}
      <div className="grid grid-cols-2 lg:grid-cols-4 gap-3">
        <div className="bg-white rounded-[18px] p-3.5 border border-[#E6ECF5] shadow-sm">
          <div className="flex items-center justify-between">
            <div className="w-8 h-8 rounded-xl bg-[#EAF2FF] flex items-center justify-center text-[#1769FF]">
              <Users className="w-4 h-4 stroke-[2.2]" />
            </div>
            <span className="text-[10px] font-semibold text-emerald-500">100% Aktif</span>
          </div>
          <div className="mt-2.5">
            <div className="text-[20px] font-bold text-[#17233F]">864</div>
            <div className="text-[11px] text-[#78849A] font-medium">Total Siswa Terdaftar</div>
          </div>
        </div>

        <div className="bg-white rounded-[18px] p-3.5 border border-[#E6ECF5] shadow-sm">
          <div className="flex items-center justify-between">
            <div className="w-8 h-8 rounded-xl bg-[#E6F8F0] flex items-center justify-center text-[#20B981]">
              <GraduationCap className="w-4 h-4 stroke-[2.2]" />
            </div>
            <span className="text-[10px] font-semibold text-emerald-500">48 Pendidik</span>
          </div>
          <div className="mt-2.5">
            <div className="text-[20px] font-bold text-[#17233F]">48</div>
            <div className="text-[11px] text-[#78849A] font-medium">Guru & Tenaga Pengajar</div>
          </div>
        </div>

        <div className="bg-white rounded-[18px] p-3.5 border border-[#E6ECF5] shadow-sm">
          <div className="flex items-center justify-between">
            <div className="w-8 h-8 rounded-xl bg-[#FEF5E7] flex items-center justify-center text-[#F5A623]">
              <Building2 className="w-4 h-4 stroke-[2.2]" />
            </div>
            <span className="text-[10px] font-semibold text-amber-500">Kelas X - XII</span>
          </div>
          <div className="mt-2.5">
            <div className="text-[20px] font-bold text-[#17233F]">24</div>
            <div className="text-[11px] text-[#78849A] font-medium">Rombongan Belajar (Rombel)</div>
          </div>
        </div>

        <div className="bg-white rounded-[18px] p-3.5 border border-[#E6ECF5] shadow-sm">
          <div className="flex items-center justify-between">
            <div className="w-8 h-8 rounded-xl bg-[#F2ECFE] flex items-center justify-center text-[#9565F5]">
              <BookMarked className="w-4 h-4 stroke-[2.2]" />
            </div>
            <span className="text-[10px] font-semibold text-purple-500">Kurikulum Merdeka</span>
          </div>
          <div className="mt-2.5">
            <div className="text-[20px] font-bold text-[#17233F]">18</div>
            <div className="text-[11px] text-[#78849A] font-medium">Mata Pelajaran Aktif</div>
          </div>
        </div>
      </div>

      {/* 2 Columns: CBT Infrastructure Status & User Activity */}
      <div className="grid grid-cols-1 lg:grid-cols-12 gap-4">
        <div className="lg:col-span-7 bg-white rounded-[18px] p-4 border border-[#E6ECF5] shadow-sm space-y-3">
          <div className="flex items-center justify-between">
            <div className="flex items-center gap-2">
              <Activity className="w-4 h-4 text-[#1769FF] stroke-[2.5]" />
              <h2 className="text-[14px] font-bold text-[#17233F]">Status CBT & Server Ujian</h2>
            </div>
            <span className="px-2 py-0.5 rounded-full bg-emerald-100 text-emerald-700 text-[10px] font-bold flex items-center gap-1">
              <span className="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
              Server Normal
            </span>
          </div>

          <div className="grid grid-cols-3 gap-2.5 pt-1">
            <div className="p-3 rounded-xl bg-[#F8FAFD] border border-[#E6ECF5] text-center">
              <p className="text-[10.5px] text-[#78849A]">Ujian Terjadwal</p>
              <p className="text-[18px] font-bold text-[#17233F] mt-0.5">8 Ujian</p>
              <span className="text-[9.5px] text-blue-600">Bulan November</span>
            </div>
            <div className="p-3 rounded-xl bg-[#F8FAFD] border border-[#E6ECF5] text-center">
              <p className="text-[10.5px] text-[#78849A]">Bank Soal Terbit</p>
              <p className="text-[18px] font-bold text-[#17233F] mt-0.5">1,420</p>
              <span className="text-[9.5px] text-emerald-600">Terverifikasi</span>
            </div>
            <div className="p-3 rounded-xl bg-[#F8FAFD] border border-[#E6ECF5] text-center">
              <p className="text-[10.5px] text-[#78849A]">Rerata Kelulusan</p>
              <p className="text-[18px] font-bold text-[#17233F] mt-0.5">92.4%</p>
              <span className="text-[9.5px] text-purple-600">Diatas KKM</span>
            </div>
          </div>
        </div>

        <div className="lg:col-span-5 bg-white rounded-[18px] p-4 border border-[#E6ECF5] shadow-sm space-y-3">
          <div className="flex items-center justify-between">
            <div className="flex items-center gap-2">
              <Calendar className="w-4 h-4 text-[#1769FF] stroke-[2.5]" />
              <h2 className="text-[14px] font-bold text-[#17233F]">Agenda Mendatang</h2>
            </div>
            <button
              type="button"
              onClick={() => navigate('/kalender')}
              className="text-[11px] font-semibold text-[#1769FF] hover:underline"
            >
              Lihat Kalender →
            </button>
          </div>

          <div className="space-y-2">
            <div className="p-2.5 rounded-xl bg-[#F8FAFD] flex items-center justify-between">
              <div>
                <p className="text-[12px] font-bold text-[#17233F]">Pekan Ujian Tengah Semester (UTS)</p>
                <p className="text-[10px] text-[#78849A]">20 - 27 November 2025 • Serentak CBT</p>
              </div>
              <span className="text-[10px] font-bold text-[#1769FF]">15 Hari Lagi</span>
            </div>
            <div className="p-2.5 rounded-xl bg-[#F8FAFD] flex items-center justify-between">
              <div>
                <p className="text-[12px] font-bold text-[#17233F]">Batas Input Nilai Harian Guru</p>
                <p className="text-[10px] text-[#78849A]">15 November 2025 • Portal Akademik</p>
              </div>
              <span className="text-[10px] font-bold text-amber-600">10 Hari Lagi</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

