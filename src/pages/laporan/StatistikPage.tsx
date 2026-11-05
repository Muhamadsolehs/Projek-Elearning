import React from 'react';
import { BarChart3, TrendingUp, Users, Award, Clock } from 'lucide-react';

export const StatistikPage: React.FC = () => {
  return (
    <div className="space-y-4">
      {/* Header */}
      <div className="bg-white p-4 rounded-[18px] border border-[#E6ECF5] shadow-sm">
        <h1 className="text-[18px] font-bold text-[#17233F]">Statistik & Analisis Pembelajaran</h1>
        <p className="text-[12px] text-[#78849A]">Visualisasi kurva ketercapaian kompetensi belajar dan tren penyelesaian tugas.</p>
      </div>

      {/* Grid of Metric Cards */}
      <div className="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div className="bg-white rounded-[20px] p-5 border border-[#E6ECF5] shadow-sm space-y-3">
          <div className="flex items-center justify-between">
            <span className="text-[12px] font-bold text-[#17233F]">Distribusi Nilai Siswa</span>
            <Award className="w-4 h-4 text-[#1769FF]" />
          </div>
          <div className="space-y-2 pt-2">
            {[
              { label: 'Sangat Baik (A: 85 - 100)', pct: 65, color: 'bg-emerald-500' },
              { label: 'Baik (B: 75 - 84)', pct: 28, color: 'bg-blue-500' },
              { label: 'Cukup (C: 65 - 74)', pct: 5, color: 'bg-amber-500' },
              { label: 'Perlu Bimbingan (< 65)', pct: 2, color: 'bg-rose-500' },
            ].map((item, idx) => (
              <div key={idx} className="space-y-1">
                <div className="flex items-center justify-between text-[11px]">
                  <span className="text-[#5A6A85]">{item.label}</span>
                  <span className="font-bold text-[#17233F]">{item.pct}%</span>
                </div>
                <div className="h-2 bg-[#EEF2F6] rounded-full overflow-hidden">
                  <div className={`h-full rounded-full ${item.color}`} style={{ width: `${item.pct}%` }} />
                </div>
              </div>
            ))}
          </div>
        </div>

        <div className="bg-white rounded-[20px] p-5 border border-[#E6ECF5] shadow-sm space-y-3">
          <div className="flex items-center justify-between">
            <span className="text-[12px] font-bold text-[#17233F]">Ketepatan Waktu Tugas</span>
            <Clock className="w-4 h-4 text-[#9565F5]" />
          </div>
          <div className="flex flex-col items-center justify-center pt-4">
            <div className="w-24 h-24 rounded-full border-8 border-emerald-500 flex items-center justify-center">
              <span className="text-[20px] font-extrabold text-[#17233F]">92%</span>
            </div>
            <p className="text-[11.5px] text-[#78849A] mt-3 text-center">
              Sebagian besar tugas dikumpulkan tepat sebelum tenggat waktu berakhir.
            </p>
          </div>
        </div>

        <div className="bg-white rounded-[20px] p-5 border border-[#E6ECF5] shadow-sm space-y-3">
          <div className="flex items-center justify-between">
            <span className="text-[12px] font-bold text-[#17233F]">Aktivitas Sesi CBT</span>
            <TrendingUp className="w-4 h-4 text-emerald-600" />
          </div>
          <div className="space-y-3 pt-2">
            <div className="p-3 rounded-xl bg-[#F8FAFD] border border-[#E6ECF5]">
              <span className="text-[11px] text-[#78849A]">Rerata Waktu Selesai</span>
              <p className="text-[16px] font-bold text-[#17233F]">68.5 Menit (dari 90)</p>
            </div>
            <div className="p-3 rounded-xl bg-[#F8FAFD] border border-[#E6ECF5]">
              <span className="text-[11px] text-[#78849A]">Tingkat Penyelesaian Soal</span>
              <p className="text-[16px] font-bold text-emerald-600">99.2% Butir Terisi</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

