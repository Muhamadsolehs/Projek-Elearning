import React, { useState } from 'react';
import { 
  FileText, 
  Download, 
  Search, 
  Filter, 
  Award, 
  TrendingUp, 
  Printer 
} from 'lucide-react';
import { useAuth } from '../../context/AuthContext';

export const LaporanAkademikPage: React.FC = () => {
  const { user } = useAuth();
  const [selectedSemester, setSelectedSemester] = useState('Ganjil 2025/2026');

  const reportData = [
    { subject: 'Matematika Wajib', tugas: 88, uts: 88.5, uas: 90, akhir: 88.8, status: 'Tuntas' },
    { subject: 'Kimia Peminatan', tugas: 85, uts: 82.0, uas: 86, akhir: 84.5, status: 'Tuntas' },
    { subject: 'Pemrograman Web', tugas: 94, uts: 92.0, uas: 95, akhir: 93.8, status: 'Tuntas' },
    { subject: 'Bahasa Indonesia', tugas: 90, uts: 86.0, uas: 88, akhir: 88.0, status: 'Tuntas' },
    { subject: 'Fisika Terapan', tugas: 80, uts: 78.0, uas: 82, akhir: 80.0, status: 'Tuntas' },
    { subject: 'Bahasa Inggris', tugas: 85, uts: 84.0, uas: 85, akhir: 84.7, status: 'Tuntas' },
  ];

  const averageScore = (reportData.reduce((acc, curr) => acc + curr.akhir, 0) / reportData.length).toFixed(1);

  return (
    <div className="space-y-4">
      {/* Header */}
      <div className="bg-white p-4 rounded-[18px] border border-[#E6ECF5] shadow-sm flex flex-col sm:flex-row sm:items-center justify-between gap-3">
        <div>
          <h1 className="text-[18px] font-bold text-[#17233F]">Laporan Capaian Akademik Siswa</h1>
          <p className="text-[12px] text-[#78849A]">Rekapitulasi nilai harian, nilai tugas, dan hasil ujian CBT per semester.</p>
        </div>

        <div className="flex items-center gap-2">
          <button
            type="button"
            onClick={() => window.print()}
            className="px-3.5 py-2 rounded-xl bg-[#F5F8FF] text-[#5A6A85] text-[12px] font-bold border border-[#E6ECF5] hover:bg-[#EEF4FF] flex items-center gap-1.5"
          >
            <Printer className="w-3.5 h-3.5" />
            <span>Cetak Rapor</span>
          </button>
          <button
            type="button"
            onClick={() => alert('Mengekspor laporan akademik ke PDF resmi...')}
            className="px-3.5 py-2 rounded-xl bg-[#1769FF] text-white text-[12px] font-bold flex items-center gap-1.5 shadow-sm hover:bg-[#1248D8]"
          >
            <Download className="w-3.5 h-3.5" />
            <span>Unduh Rapor PDF</span>
          </button>
        </div>
      </div>

      {/* Summary Student Banner */}
      <div className="bg-white rounded-[22px] p-5 border border-[#E6ECF5] shadow-sm flex flex-col sm:flex-row items-center justify-between gap-4">
        <div className="space-y-1">
          <span className="text-[11px] font-bold uppercase tracking-wider text-[#1769FF]">
            Data Peserta Didik
          </span>
          <h2 className="text-[18px] font-bold text-[#17233F]">{user.name}</h2>
          <p className="text-[12px] text-[#78849A]">
            NISN: {user.nisn || '0054238910'} • Kelas: {user.kelas || 'XII IPA 1'} • Semester: {selectedSemester}
          </p>
        </div>

        <div className="bg-[#EEF4FF] rounded-2xl p-4 text-center border border-[#DCEBFF] min-w-[150px]">
          <span className="text-[11px] text-[#78849A] font-semibold">Indeks Prestasi Rerata</span>
          <div className="text-[28px] font-extrabold text-[#1769FF] my-0.5">{averageScore}</div>
          <span className="text-[10.5px] font-bold text-emerald-600">Predikat: Sangat Baik (A)</span>
        </div>
      </div>

      {/* Table */}
      <div className="bg-white rounded-[20px] border border-[#E6ECF5] shadow-sm overflow-hidden">
        <div className="overflow-x-auto">
          <table className="w-full text-left text-[12.5px]">
            <thead>
              <tr className="bg-[#F8FAFD] border-b border-[#E6ECF5] text-[#78849A] font-semibold">
                <th className="py-3 px-4">Mata Pelajaran</th>
                <th className="py-3 px-4">Nilai Tugas (30%)</th>
                <th className="py-3 px-4">Nilai UTS (30%)</th>
                <th className="py-3 px-4">Nilai UAS (40%)</th>
                <th className="py-3 px-4 font-bold text-[#17233F]">Nilai Akhir</th>
                <th className="py-3 px-4 text-right">Keterangan</th>
              </tr>
            </thead>
            <tbody className="divide-y divide-[#F0F4FA]">
              {reportData.map((row, idx) => (
                <tr key={idx} className="hover:bg-[#F8FAFD]">
                  <td className="py-3 px-4 font-bold text-[#17233F]">{row.subject}</td>
                  <td className="py-3 px-4 text-[#5A6A85]">{row.tugas}</td>
                  <td className="py-3 px-4 text-[#5A6A85]">{row.uts}</td>
                  <td className="py-3 px-4 text-[#5A6A85]">{row.uas}</td>
                  <td className="py-3 px-4 font-extrabold text-[#1769FF]">{row.akhir}</td>
                  <td className="py-3 px-4 text-right">
                    <span className="px-2.5 py-0.5 rounded-full bg-emerald-100 text-emerald-700 text-[10.5px] font-bold">
                      {row.status}
                    </span>
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

