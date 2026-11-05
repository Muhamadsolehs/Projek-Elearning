import React from 'react';
import { 
  ShieldCheck, 
  Building2, 
  Users, 
  Activity, 
  CheckCircle2, 
  Clock, 
  ArrowRight,
  ShieldAlert
} from 'lucide-react';
import { useNavigate } from 'react-router-dom';
import { useAuth } from '../../context/AuthContext';

export const SuperAdminDashboard: React.FC = () => {
  const { user } = useAuth();
  const navigate = useNavigate();

  return (
    <div className="space-y-4">
      {/* Super Admin Banner */}
      <div className="rounded-[20px] bg-gradient-to-r from-[#17233F] via-[#1248D8] to-[#1769FF] text-white p-5 lg:p-6 shadow-md flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
          <span className="px-2.5 py-0.5 rounded-full bg-white/20 text-[11px] font-bold tracking-wide uppercase">
            EduCore Multi-Tenant Master Hub
          </span>
          <h1 className="text-[20px] lg:text-[22px] font-bold mt-1 tracking-tight">
            Dashboard Super Administrator
          </h1>
          <p className="text-[12.5px] text-white/90 mt-0.5">
            Monitoring performa platform, aktivasi lisensi institusi, dan tata kelola sistem.
          </p>
        </div>

        <div className="flex items-center gap-2">
          <span className="px-3 py-1 rounded-xl bg-emerald-500/20 text-emerald-300 border border-emerald-400/30 text-[11.5px] font-bold flex items-center gap-1.5">
            <span className="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
            Semua Node Layanan Aktif (99.98%)
          </span>
        </div>
      </div>

      {/* 4 Stats Cards */}
      <div className="grid grid-cols-2 lg:grid-cols-4 gap-3">
        <div className="bg-white rounded-[18px] p-3.5 border border-[#E6ECF5] shadow-sm">
          <div className="flex items-center justify-between">
            <div className="w-8 h-8 rounded-xl bg-[#EAF2FF] flex items-center justify-center text-[#1769FF]">
              <Building2 className="w-4 h-4 stroke-[2.2]" />
            </div>
            <span className="text-[10px] font-semibold text-emerald-500">+4 Bulan Ini</span>
          </div>
          <div className="mt-2.5">
            <div className="text-[20px] font-bold text-[#17233F]">42</div>
            <div className="text-[11px] text-[#78849A] font-medium">Institusi Pendidikan Aktif</div>
          </div>
        </div>

        <div className="bg-white rounded-[18px] p-3.5 border border-[#E6ECF5] shadow-sm">
          <div className="flex items-center justify-between">
            <div className="w-8 h-8 rounded-xl bg-[#FEF5E7] flex items-center justify-center text-[#F5A623]">
              <Clock className="w-4 h-4 stroke-[2.2]" />
            </div>
            <span className="text-[10px] font-semibold text-amber-500">Perlu Review</span>
          </div>
          <div className="mt-2.5">
            <div className="text-[20px] font-bold text-[#17233F]">5</div>
            <div className="text-[11px] text-[#78849A] font-medium">Institusi Menunggu Verifikasi</div>
          </div>
        </div>

        <div className="bg-white rounded-[18px] p-3.5 border border-[#E6ECF5] shadow-sm">
          <div className="flex items-center justify-between">
            <div className="w-8 h-8 rounded-xl bg-[#E6F8F0] flex items-center justify-center text-[#20B981]">
              <Users className="w-4 h-4 stroke-[2.2]" />
            </div>
            <span className="text-[10px] font-semibold text-emerald-500">Total Akun</span>
          </div>
          <div className="mt-2.5">
            <div className="text-[20px] font-bold text-[#17233F]">28,450</div>
            <div className="text-[11px] text-[#78849A] font-medium">Pengguna Terdaftar</div>
          </div>
        </div>

        <div className="bg-white rounded-[18px] p-3.5 border border-[#E6ECF5] shadow-sm">
          <div className="flex items-center justify-between">
            <div className="w-8 h-8 rounded-xl bg-[#F2ECFE] flex items-center justify-center text-[#9565F5]">
              <Activity className="w-4 h-4 stroke-[2.2]" />
            </div>
            <span className="text-[10px] font-semibold text-purple-500">CBT Cluster</span>
          </div>
          <div className="mt-2.5">
            <div className="text-[20px] font-bold text-[#17233F]">124</div>
            <div className="text-[11px] text-[#78849A] font-medium">Sesi Ujian Selesai Hari Ini</div>
          </div>
        </div>
      </div>

      {/* Institusi Menunggu Verifikasi Table */}
      <div className="bg-white rounded-[18px] p-4 border border-[#E6ECF5] shadow-sm space-y-3">
        <div className="flex items-center justify-between">
          <div className="flex items-center gap-2">
            <ShieldAlert className="w-4 h-4 text-[#F5A623] stroke-[2.5]" />
            <h2 className="text-[14px] font-bold text-[#17233F]">Pengajuan Pendaftaran Institusi Baru</h2>
          </div>
          <button
            type="button"
            onClick={() => navigate('/institusi/verifikasi')}
            className="text-[11px] font-semibold text-[#1769FF] hover:underline flex items-center gap-1"
          >
            <span>Kelola Semua</span>
            <ArrowRight className="w-3 h-3" />
          </button>
        </div>

        <div className="overflow-x-auto">
          <table className="w-full text-left text-[12px]">
            <thead>
              <tr className="border-b border-[#F0F4FA] text-[#78849A] font-semibold">
                <th className="pb-2.5">Nama Sekolah / Kampus</th>
                <th className="pb-2.5">Jenis</th>
                <th className="pb-2.5">Kota / Wilayah</th>
                <th className="pb-2.5">Tanggal Daftar</th>
                <th className="pb-2.5 text-right">Aksi Verifikasi</th>
              </tr>
            </thead>
            <tbody className="divide-y divide-[#F0F4FA]">
              {[
                { name: 'SMA Negeri 2 Bandung', type: 'SMA', city: 'Kota Bandung', date: '04 Nov 2026' },
                { name: 'SMK Telkom Malang', type: 'SMK', city: 'Kota Malang', date: '03 Nov 2026' },
                { name: 'MA Husnul Khotimah Kuningan', type: 'MA', city: 'Kab. Kuningan', date: '02 Nov 2026' },
              ].map((row, idx) => (
                <tr key={idx} className="hover:bg-[#F8FAFD]">
                  <td className="py-2.5 font-bold text-[#17233F]">{row.name}</td>
                  <td className="py-2.5">
                    <span className="px-2 py-0.5 rounded-full bg-blue-50 text-[#1769FF] font-semibold text-[10.5px]">
                      {row.type}
                    </span>
                  </td>
                  <td className="py-2.5 text-[#5A6A85]">{row.city}</td>
                  <td className="py-2.5 text-[#78849A]">{row.date}</td>
                  <td className="py-2.5 text-right space-x-1.5">
                    <button
                      type="button"
                      className="px-2.5 py-1 rounded-lg bg-emerald-50 text-emerald-600 font-bold hover:bg-emerald-600 hover:text-white transition-all text-[11px]"
                    >
                      Setujui
                    </button>
                    <button
                      type="button"
                      className="px-2.5 py-1 rounded-lg bg-rose-50 text-rose-600 font-bold hover:bg-rose-600 hover:text-white transition-all text-[11px]"
                    >
                      Tolak
                    </button>
                  </td>
                </tr>
              ))}
            </tbody>
          </table>
        </div>
      </div>
    </div>
  );
};

