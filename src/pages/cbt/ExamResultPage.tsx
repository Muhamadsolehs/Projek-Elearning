import React from 'react';
import { 
  Award, 
  CheckCircle2, 
  XCircle, 
  HelpCircle, 
  Download, 
  ArrowLeft, 
  BarChart2, 
  FileSpreadsheet,
  RotateCcw
} from 'lucide-react';
import { useNavigate } from 'react-router-dom';
import { useAuth } from '../../context/AuthContext';

export const ExamResultPage: React.FC = () => {
  const navigate = useNavigate();
  const { user } = useAuth();

  const isTeacher = user.role === 'guru' || user.role === 'admin_institusi';

  return (
    <div className="space-y-4 max-w-4xl mx-auto">
      {/* Header */}
      <div className="flex items-center justify-between bg-white p-4 rounded-[18px] border border-[#E6ECF5] shadow-sm">
        <div className="flex items-center gap-3">
          <button
            type="button"
            onClick={() => navigate('/dashboard')}
            className="p-1.5 rounded-xl border border-[#E6ECF5] hover:bg-[#F8FAFD]"
          >
            <ArrowLeft className="w-4 h-4 text-[#5A6A85]" />
          </button>
          <div>
            <h1 className="text-[17px] font-bold text-[#17233F]">
              Hasil & Evaluasi Nilai CBT
            </h1>
            <p className="text-[11.5px] text-[#78849A]">
              Ujian Tengah Semester: Matematika XII IPA
            </p>
          </div>
        </div>

        <button
          type="button"
          onClick={() => alert('Mengunduh rekap hasil ujian dalam format PDF/Excel...')}
          className="px-3.5 py-1.5 rounded-xl bg-[#F5F8FF] text-[#1769FF] text-[12px] font-bold border border-[#E6ECF5] hover:bg-[#EEF4FF] flex items-center gap-1.5"
        >
          <Download className="w-3.5 h-3.5" />
          <span>Ekspor Hasil</span>
        </button>
      </div>

      {/* Student Result Card */}
      {!isTeacher ? (
        <div className="bg-white rounded-[24px] p-6 border border-[#E6ECF5] shadow-sm space-y-6">
          <div className="flex flex-col sm:flex-row items-center justify-between gap-4 p-5 rounded-2xl bg-gradient-to-r from-blue-500 to-indigo-600 text-white">
            <div>
              <span className="px-2.5 py-0.5 rounded-full bg-white/20 text-[11px] font-bold">
                Status Kelulusan: LULUS
              </span>
              <h2 className="text-[24px] font-extrabold mt-1">Selamat, {user.name}!</h2>
              <p className="text-[12.5px] text-white/90">
                Nilai Anda telah melampaui batas Kriteria Ketuntasan Minimal (KKM 75).
              </p>
            </div>

            <div className="bg-white/20 backdrop-blur-md rounded-2xl p-4 text-center min-w-[130px] border border-white/30">
              <span className="text-[11px] text-white/80">Skor Akhir</span>
              <div className="text-[34px] font-black leading-tight my-0.5">88.5</div>
              <span className="text-[10.5px] text-emerald-200 font-bold">Grade A</span>
            </div>
          </div>

          {/* Breakdown Stats */}
          <div className="grid grid-cols-2 sm:grid-cols-4 gap-3">
            <div className="p-3.5 rounded-2xl bg-[#E6F8F0] border border-emerald-100 text-center">
              <CheckCircle2 className="w-5 h-5 text-[#20B981] mx-auto" />
              <div className="text-[20px] font-bold text-emerald-800 mt-1">35</div>
              <span className="text-[11px] text-emerald-600 font-medium">Jawaban Benar</span>
            </div>

            <div className="p-3.5 rounded-2xl bg-[#FDECEE] border border-rose-100 text-center">
              <XCircle className="w-5 h-5 text-[#EF5B65] mx-auto" />
              <div className="text-[20px] font-bold text-rose-800 mt-1">5</div>
              <span className="text-[11px] text-rose-600 font-medium">Jawaban Salah</span>
            </div>

            <div className="p-3.5 rounded-2xl bg-[#F8FAFD] border border-[#E6ECF5] text-center">
              <HelpCircle className="w-5 h-5 text-[#78849A] mx-auto" />
              <div className="text-[20px] font-bold text-[#17233F] mt-1">0</div>
              <span className="text-[11px] text-[#78849A] font-medium">Kosong</span>
            </div>

            <div className="p-3.5 rounded-2xl bg-[#EEF4FF] border border-[#DCEBFF] text-center">
              <Award className="w-5 h-5 text-[#1769FF] mx-auto" />
              <div className="text-[20px] font-bold text-[#17233F] mt-1">9.0/10</div>
              <span className="text-[11px] text-[#1769FF] font-medium">Nilai Esai</span>
            </div>
          </div>

          <div className="p-4 rounded-2xl bg-[#F8FAFD] border border-[#E6ECF5] text-[12px] text-[#5A6A85] flex items-center justify-between">
            <span>Kunci jawaban dan analisis per butir dapat dibuka setelah seluruh sesi kelas selesai.</span>
            <button
              type="button"
              onClick={() => navigate('/dashboard')}
              className="text-[#1769FF] font-bold hover:underline"
            >
              Kembali ke Beranda →
            </button>
          </div>
        </div>
      ) : (
        /* Teacher / Admin Class Summary */
        <div className="bg-white rounded-[24px] p-6 border border-[#E6ECF5] shadow-sm space-y-4">
          <div className="grid grid-cols-4 gap-3">
            <div className="p-4 rounded-2xl bg-[#F8FAFD] border border-[#E6ECF5] text-center">
              <span className="text-[11px] text-[#78849A]">Total Peserta Selesai</span>
              <div className="text-[22px] font-bold text-[#17233F] mt-1">36 Siswa</div>
            </div>
            <div className="p-4 rounded-2xl bg-[#E6F8F0] border border-emerald-100 text-center">
              <span className="text-[11px] text-emerald-700">Rata-rata Kelas</span>
              <div className="text-[22px] font-bold text-emerald-800 mt-1">84.2</div>
            </div>
            <div className="p-4 rounded-2xl bg-[#EEF4FF] border border-[#DCEBFF] text-center">
              <span className="text-[11px] text-blue-700">Nilai Tertinggi</span>
              <div className="text-[22px] font-bold text-blue-800 mt-1">98.0</div>
            </div>
            <div className="p-4 rounded-2xl bg-[#FEF5E7] border border-amber-100 text-center">
              <span className="text-[11px] text-amber-700">Ketuntasan (≥75)</span>
              <div className="text-[22px] font-bold text-amber-800 mt-1">94.4%</div>
            </div>
          </div>

          <div className="pt-2">
            <h3 className="text-[14px] font-bold text-[#17233F] mb-2">Daftar Nilai Siswa (XII IPA 1)</h3>
            <div className="border border-[#E6ECF5] rounded-2xl overflow-hidden">
              <table className="w-full text-left text-[12px]">
                <thead className="bg-[#F8FAFD] border-b border-[#E6ECF5] text-[#78849A] font-semibold">
                  <tr>
                    <th className="py-2.5 px-3">Nama Siswa</th>
                    <th className="py-2.5 px-3">NISN</th>
                    <th className="py-2.5 px-3">Skor PG</th>
                    <th className="py-2.5 px-3">Skor Esai</th>
                    <th className="py-2.5 px-3">Nilai Akhir</th>
                    <th className="py-2.5 px-3 text-right">Status</th>
                  </tr>
                </thead>
                <tbody className="divide-y divide-[#F0F4FA]">
                  {[
                    { name: 'Muhamad Soleh', nisn: '0054238910', pg: 79.5, esai: 9.0, final: 88.5, status: 'LULUS' },
                    { name: 'Aisyah Putri Nuraini', nisn: '0054238911', pg: 86.0, esai: 9.5, final: 95.5, status: 'LULUS' },
                    { name: 'Bagas Aditya Pratama', nisn: '0054238912', pg: 72.0, esai: 8.0, final: 80.0, status: 'LULUS' },
                    { name: 'Dinda Kirana Safitri', nisn: '0054238913', pg: 64.0, esai: 7.0, final: 71.0, status: 'REMEDIAL' },
                  ].map((row, idx) => (
                    <tr key={idx} className="hover:bg-[#F8FAFD]">
                      <td className="py-2.5 px-3 font-bold text-[#17233F]">{row.name}</td>
                      <td className="py-2.5 px-3 text-[#78849A]">{row.nisn}</td>
                      <td className="py-2.5 px-3 text-[#5A6A85]">{row.pg}</td>
                      <td className="py-2.5 px-3 text-[#5A6A85]">{row.esai}</td>
                      <td className="py-2.5 px-3 font-extrabold text-[#1769FF]">{row.final}</td>
                      <td className="py-2.5 px-3 text-right">
                        <span
                          className={`px-2 py-0.5 rounded-full text-[10px] font-bold ${
                            row.status === 'LULUS'
                              ? 'bg-emerald-100 text-emerald-700'
                              : 'bg-rose-100 text-rose-700'
                          }`}
                        >
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
      )}
    </div>
  );
};

