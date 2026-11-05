import React, { useState } from 'react';
import { 
  Users, 
  GraduationCap, 
  Search, 
  Plus, 
  BookOpen, 
  ArrowRight,
  MoreVertical
} from 'lucide-react';
import { useNavigate } from 'react-router-dom';

export const KelasListPage: React.FC = () => {
  const navigate = useNavigate();
  const [searchTerm, setSearchTerm] = useState('');

  const classes = [
    {
      id: 'cls_1',
      name: 'XII IPA 1',
      tingkat: 'Kelas XII',
      jurusan: 'MIPA',
      waliKelas: 'Drs. Budi Santoso',
      totalSiswa: 36,
      ruang: 'R. 301',
    },
    {
      id: 'cls_2',
      name: 'XII IPA 2',
      tingkat: 'Kelas XII',
      jurusan: 'MIPA',
      waliKelas: 'Dra. Endang Lestari',
      totalSiswa: 35,
      ruang: 'R. 302',
    },
    {
      id: 'cls_3',
      name: 'XII RPL',
      tingkat: 'Kelas XII',
      jurusan: 'Rekayasa Perangkat Lunak',
      waliKelas: 'Ahmad Fauzi, S.Kom.',
      totalSiswa: 34,
      ruang: 'Lab Komputer 1',
    },
    {
      id: 'cls_4',
      name: 'XII IPS 1',
      tingkat: 'Kelas XII',
      jurusan: 'IPS',
      waliKelas: 'Siti Nurhaliza, M.Pd.',
      totalSiswa: 35,
      ruang: 'R. 204',
    },
  ];

  return (
    <div className="space-y-4">
      {/* Header */}
      <div className="bg-white p-4 rounded-[18px] border border-[#E6ECF5] shadow-sm flex flex-col sm:flex-row sm:items-center justify-between gap-3">
        <div>
          <h1 className="text-[18px] font-bold text-[#17233F]">Data Rombongan Belajar (Kelas)</h1>
          <p className="text-[12px] text-[#78849A]">Informasi kelas binaan, wali kelas, dan pembagian ruang pembelajaran.</p>
        </div>

        <button
          type="button"
          onClick={() => alert('Modal Tambah Kelas Baru')}
          className="px-4 py-2 rounded-xl bg-[#1769FF] text-white text-[12px] font-bold flex items-center gap-1.5 shadow-sm hover:bg-[#1248D8] transition-all"
        >
          <Plus className="w-4 h-4" />
          <span>Tambah Kelas Baru</span>
        </button>
      </div>

      {/* Grid */}
      <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        {classes.map((cls) => (
          <div
            key={cls.id}
            className="bg-white rounded-[20px] p-4 border border-[#E6ECF5] shadow-sm hover:shadow-md transition-all space-y-3 flex flex-col justify-between"
          >
            <div>
              <div className="flex items-center justify-between">
                <span className="px-2.5 py-0.5 rounded-full bg-[#EAF2FF] text-[#1769FF] font-bold text-[10.5px]">
                  {cls.tingkat} • {cls.jurusan}
                </span>
                <span className="text-[11px] text-[#78849A] font-semibold">{cls.ruang}</span>
              </div>

              <h3 className="text-[16px] font-bold text-[#17233F] mt-2">{cls.name}</h3>
              <p className="text-[11.5px] text-[#78849A] mt-0.5">Wali: {cls.waliKelas}</p>
            </div>

            <div className="pt-3 border-t border-[#F0F4FA] flex items-center justify-between">
              <span className="text-[11.5px] font-bold text-[#1769FF] flex items-center gap-1">
                <Users className="w-3.5 h-3.5" />
                <span>{cls.totalSiswa} Siswa</span>
              </span>

              <button
                type="button"
                onClick={() => alert(`Membuka daftar siswa kelas ${cls.name}`)}
                className="text-[11.5px] font-semibold text-[#1769FF] hover:underline"
              >
                Detail Kelas →
              </button>
            </div>
          </div>
        ))}
      </div>
    </div>
  );
};

