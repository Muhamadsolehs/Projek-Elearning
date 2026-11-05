import React from 'react';
import { Calendar as CalendarIcon, Clock, ChevronLeft, ChevronRight, Bookmark } from 'lucide-react';

export const KalenderAkademikPage: React.FC = () => {
  const events = [
    { date: '10 Nov 2025', title: 'Pemeliharaan Server CBT Terjadwal', type: 'Sistem', color: 'bg-amber-100 text-amber-800' },
    { date: '15 Nov 2025', title: 'Batas Akhir Penilaian Tugas Harian Modul 2', type: 'Akademik', color: 'bg-blue-100 text-blue-800' },
    { date: '20 Nov 2025', title: 'Pekan Ujian Tengah Semester (UTS) Dimulai', type: 'Ujian', color: 'bg-emerald-100 text-emerald-800' },
    { date: '27 Nov 2025', title: 'Ujian Praktikum Mandiri Kimia & Fisika', type: 'Praktikum', color: 'bg-purple-100 text-purple-800' },
    { date: '05 Des 2025', title: 'Publikasi Nilai dan Rapor Tengah Semester', type: 'Rapor', color: 'bg-indigo-100 text-indigo-800' },
  ];

  return (
    <div className="space-y-4">
      {/* Header */}
      <div className="bg-white p-4 rounded-[18px] border border-[#E6ECF5] shadow-sm flex items-center justify-between">
        <div>
          <h1 className="text-[18px] font-bold text-[#17233F]">Kalender Akademik & Agenda Kegiatan</h1>
          <p className="text-[12px] text-[#78849A]">Jadwal ujian, pengumpulan tugas, dan agenda resmi semester ini.</p>
        </div>

        <div className="flex items-center gap-2">
          <button type="button" className="p-1.5 rounded-lg border border-[#E6ECF5] hover:bg-[#F8FAFD]">
            <ChevronLeft className="w-4 h-4 text-[#5A6A85]" />
          </button>
          <span className="text-[13px] font-bold text-[#17233F]">Semester Ganjil 2025/2026</span>
          <button type="button" className="p-1.5 rounded-lg border border-[#E6ECF5] hover:bg-[#F8FAFD]">
            <ChevronRight className="w-4 h-4 text-[#5A6A85]" />
          </button>
        </div>
      </div>

      {/* Events Timeline */}
      <div className="bg-white rounded-[22px] p-5 border border-[#E6ECF5] shadow-sm space-y-3">
        <h2 className="text-[14px] font-bold text-[#17233F] mb-3">Agenda Terdekat (Bulan November - Desember)</h2>
        <div className="space-y-3">
          {events.map((evt, idx) => (
            <div
              key={idx}
              className="flex items-center justify-between p-3.5 rounded-2xl bg-[#F8FAFD] border border-[#E6ECF5] hover:border-[#1769FF]/40 transition-colors"
            >
              <div className="flex items-center gap-3">
                <div className="w-10 h-10 rounded-xl bg-white border border-[#E6ECF5] flex flex-col items-center justify-center text-[#1769FF] font-bold flex-shrink-0 shadow-sm">
                  <span className="text-[14px] leading-tight">{evt.date.split(' ')[0]}</span>
                  <span className="text-[9px] uppercase tracking-wider text-[#78849A] leading-tight">{evt.date.split(' ')[1]}</span>
                </div>
                <div>
                  <h4 className="text-[13px] font-bold text-[#17233F]">{evt.title}</h4>
                  <p className="text-[11px] text-[#78849A]">{evt.date}</p>
                </div>
              </div>

              <span className={`px-3 py-1 rounded-full text-[11px] font-bold ${evt.color}`}>
                {evt.type}
              </span>
            </div>
          ))}
        </div>
      </div>
    </div>
  );
};

