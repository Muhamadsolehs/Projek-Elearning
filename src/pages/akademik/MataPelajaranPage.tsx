import React, { useState } from 'react';
import { BookMarked, Search, Plus, BookOpen, Clock } from 'lucide-react';

export const MataPelajaranPage: React.FC = () => {
  const [searchTerm, setSearchTerm] = useState('');

  const subjects = [
    { code: 'MAT-W12', name: 'Matematika Wajib', category: 'Wajib', kkm: 75, jamMinggu: 4, guru: 'Drs. Budi Santoso' },
    { code: 'KIM-P12', name: 'Kimia Peminatan', category: 'Peminatan', kkm: 75, jamMinggu: 4, guru: 'Dra. Endang Lestari' },
    { code: 'WEB-K12', name: 'Pemrograman Web', category: 'Peminatan Kejuruan', kkm: 78, jamMinggu: 6, guru: 'Ahmad Fauzi, S.Kom.' },
    { code: 'IND-W12', name: 'Bahasa Indonesia', category: 'Wajib', kkm: 75, jamMinggu: 4, guru: 'Siti Nurhaliza, M.Pd.' },
    { code: 'FIS-P12', name: 'Fisika Terapan', category: 'Peminatan', kkm: 75, jamMinggu: 4, guru: 'Ir. Hendra Kusuma' },
    { code: 'ENG-W12', name: 'Bahasa Inggris Lanjutan', category: 'Wajib', kkm: 76, jamMinggu: 3, guru: 'Sarah Johnson, M.A.' },
  ];

  return (
    <div className="space-y-4">
      {/* Header */}
      <div className="bg-white p-4 rounded-[18px] border border-[#E6ECF5] shadow-sm flex flex-col sm:flex-row sm:items-center justify-between gap-3">
        <div>
          <h1 className="text-[18px] font-bold text-[#17233F]">Kurikulum & Mata Pelajaran</h1>
          <p className="text-[12px] text-[#78849A]">Daftar mata pelajaran aktif, alokasi jam pembelajaran, dan standar KKM.</p>
        </div>

        <button
          type="button"
          onClick={() => alert('Modal Tambah Mapel')}
          className="px-4 py-2 rounded-xl bg-[#1769FF] text-white text-[12px] font-bold flex items-center gap-1.5 shadow-sm hover:bg-[#1248D8] transition-all"
        >
          <Plus className="w-4 h-4" />
          <span>Tambah Mata Pelajaran</span>
        </button>
      </div>

      {/* Table */}
      <div className="bg-white rounded-[20px] border border-[#E6ECF5] shadow-sm overflow-hidden">
        <div className="overflow-x-auto">
          <table className="w-full text-left text-[12.5px]">
            <thead>
              <tr className="bg-[#F8FAFD] border-b border-[#E6ECF5] text-[#78849A] font-semibold">
                <th className="py-3 px-4">Kode & Mata Pelajaran</th>
                <th className="py-3 px-4">Kategori</th>
                <th className="py-3 px-4">Guru Koordinator</th>
                <th className="py-3 px-4">Beban Jam</th>
                <th className="py-3 px-4">Standar KKM</th>
                <th className="py-3 px-4 text-right">Aksi</th>
              </tr>
            </thead>
            <tbody className="divide-y divide-[#F0F4FA]">
              {subjects.map((s, idx) => (
                <tr key={idx} className="hover:bg-[#F8FAFD]">
                  <td className="py-3 px-4 font-bold text-[#17233F]">
                    {s.name}
                    <div className="text-[10.5px] font-normal text-[#8C98A9]">Kode: {s.code}</div>
                  </td>
                  <td className="py-3 px-4">
                    <span className="px-2 py-0.5 rounded-full bg-[#EAF2FF] text-[#1769FF] font-semibold text-[10.5px]">
                      {s.category}
                    </span>
                  </td>
                  <td className="py-3 px-4 text-[#5A6A85]">{s.guru}</td>
                  <td className="py-3 px-4 text-[#17233F] font-semibold">{s.jamMinggu} Jam/Minggu</td>
                  <td className="py-3 px-4 font-bold text-emerald-600">{s.kkm}</td>
                  <td className="py-3 px-4 text-right">
                    <button
                      type="button"
                      className="text-[#1769FF] font-semibold hover:underline text-[11.5px]"
                    >
                      Kelola Silabus
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

