import React, { useState } from 'react';
import { 
  Layers, 
  Search, 
  Plus, 
  Edit3, 
  Trash2, 
  Eye, 
  FileSpreadsheet, 
  Download,
  Filter
} from 'lucide-react';
import { useNavigate } from 'react-router-dom';

export const BankSoalPage: React.FC = () => {
  const navigate = useNavigate();
  const [searchTerm, setSearchTerm] = useState('');
  const [subjectFilter, setSubjectFilter] = useState('Semua');

  const questionBanks = [
    {
      id: 'qb_1',
      title: 'Kumpulan Soal Kalkulus & Turunan Fungsi',
      subject: 'Matematika',
      kelas: 'XII IPA',
      totalQuestions: 50,
      difficulty: 'Sedang',
      author: 'Drs. Budi Santoso',
      updatedAt: '03 Nov 2026',
    },
    {
      id: 'qb_2',
      title: 'Bank Soal Kimia Organik & Hidrokarbon',
      subject: 'Kimia',
      kelas: 'XII IPA',
      totalQuestions: 40,
      difficulty: 'Tinggi',
      author: 'Dra. Endang Lestari',
      updatedAt: '01 Nov 2026',
    },
    {
      id: 'qb_3',
      title: 'Soal Dasar RESTful API & Frontend React',
      subject: 'Pemrograman Web',
      kelas: 'XII RPL',
      totalQuestions: 35,
      difficulty: 'Sedang',
      author: 'Ahmad Fauzi, S.Kom.',
      updatedAt: '28 Okt 2026',
    },
    {
      id: 'qb_4',
      title: 'Pemahaman Wacana & Resensi Sastra',
      subject: 'Bahasa Indonesia',
      kelas: 'XII IPS',
      totalQuestions: 45,
      difficulty: 'Mudah',
      author: 'Siti Nurhaliza, M.Pd.',
      updatedAt: '25 Okt 2026',
    },
  ];

  return (
    <div className="space-y-4">
      {/* Header */}
      <div className="bg-white p-4 rounded-[18px] border border-[#E6ECF5] shadow-sm flex flex-col sm:flex-row sm:items-center justify-between gap-3">
        <div>
          <h1 className="text-[18px] font-bold text-[#17233F]">Bank Soal CBT</h1>
          <p className="text-[12px] text-[#78849A]">Kelola repositori bank soal, butir evaluasi, dan impor kisi-kisi.</p>
        </div>

        <div className="flex items-center gap-2">
          <button
            type="button"
            onClick={() => navigate('/cbt/soal/builder')}
            className="px-4 py-2 rounded-xl bg-[#1769FF] text-white text-[12px] font-bold flex items-center gap-1.5 shadow-sm hover:bg-[#1248D8] transition-all"
          >
            <Plus className="w-4 h-4" />
            <span>Buat Soal Baru</span>
          </button>
        </div>
      </div>

      {/* Filters and Search */}
      <div className="flex flex-col sm:flex-row items-center justify-between gap-3 bg-white p-3 rounded-2xl border border-[#E6ECF5]">
        <div className="relative w-full sm:w-72">
          <Search className="w-3.5 h-3.5 absolute left-3 top-2.5 text-[#8C98A9]" />
          <input
            type="text"
            placeholder="Cari bank soal..."
            value={searchTerm}
            onChange={(e) => setSearchTerm(e.target.value)}
            className="w-full pl-8 pr-3 py-1.5 text-[12px] bg-[#F5F8FF] border border-[#E6ECF5] rounded-xl focus:outline-none"
          />
        </div>

        <div className="flex items-center gap-2 w-full sm:w-auto">
          <select
            value={subjectFilter}
            onChange={(e) => setSubjectFilter(e.target.value)}
            className="px-3 py-1.5 text-[12px] bg-[#F5F8FF] border border-[#E6ECF5] rounded-xl text-[#5A6A85]"
          >
            <option value="Semua">Semua Mata Pelajaran</option>
            <option value="Matematika">Matematika</option>
            <option value="Kimia">Kimia</option>
            <option value="Pemrograman Web">Pemrograman Web</option>
            <option value="Bahasa Indonesia">Bahasa Indonesia</option>
          </select>

          <button
            type="button"
            className="px-3 py-1.5 rounded-xl border border-[#E6ECF5] bg-[#F8FAFD] text-[#5A6A85] text-[12px] font-semibold flex items-center gap-1 hover:bg-[#EEF4FF]"
          >
            <FileSpreadsheet className="w-3.5 h-3.5 text-emerald-600" />
            <span>Import Excel</span>
          </button>
        </div>
      </div>

      {/* Question Banks Table */}
      <div className="bg-white rounded-[20px] border border-[#E6ECF5] shadow-sm overflow-hidden">
        <div className="overflow-x-auto">
          <table className="w-full text-left text-[12.5px]">
            <thead>
              <tr className="bg-[#F8FAFD] border-b border-[#E6ECF5] text-[#78849A] font-semibold">
                <th className="py-3 px-4">Nama Bank Soal</th>
                <th className="py-3 px-4">Mata Pelajaran</th>
                <th className="py-3 px-4">Tingkat Kesulitan</th>
                <th className="py-3 px-4">Jumlah Butir</th>
                <th className="py-3 px-4">Penyusun</th>
                <th className="py-3 px-4 text-right">Aksi</th>
              </tr>
            </thead>
            <tbody className="divide-y divide-[#F0F4FA]">
              {questionBanks.map((item) => (
                <tr key={item.id} className="hover:bg-[#F8FAFD] transition-colors">
                  <td className="py-3 px-4 font-bold text-[#17233F]">
                    {item.title}
                    <div className="text-[10.5px] font-normal text-[#8C98A9]">Diperbarui: {item.updatedAt}</div>
                  </td>
                  <td className="py-3 px-4">
                    <span className="px-2 py-0.5 rounded-full bg-[#EAF2FF] text-[#1769FF] font-semibold text-[11px]">
                      {item.subject} • {item.kelas}
                    </span>
                  </td>
                  <td className="py-3 px-4">
                    <span
                      className={`px-2 py-0.5 rounded-full text-[10.5px] font-bold ${
                        item.difficulty === 'Tinggi'
                          ? 'bg-rose-50 text-rose-600'
                          : item.difficulty === 'Sedang'
                          ? 'bg-amber-50 text-amber-600'
                          : 'bg-emerald-50 text-emerald-600'
                      }`}
                    >
                      {item.difficulty}
                    </span>
                  </td>
                  <td className="py-3 px-4 font-semibold text-[#17233F]">
                    {item.totalQuestions} Butir Soal
                  </td>
                  <td className="py-3 px-4 text-[#5A6A85]">{item.author}</td>
                  <td className="py-3 px-4 text-right space-x-1">
                    <button
                      type="button"
                      onClick={() => navigate('/cbt/soal/builder')}
                      className="p-1.5 rounded-lg text-[#1769FF] hover:bg-[#EEF4FF]"
                      title="Edit Butir Soal"
                    >
                      <Edit3 className="w-4 h-4" />
                    </button>
                    <button
                      type="button"
                      className="p-1.5 rounded-lg text-emerald-600 hover:bg-emerald-50"
                      title="Pratinjau Ujian"
                    >
                      <Eye className="w-4 h-4" />
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

