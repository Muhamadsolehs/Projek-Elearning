import React, { useState } from 'react';
import { 
  ArrowLeft, 
  Calendar, 
  Clock, 
  ShieldCheck, 
  AlertTriangle, 
  CheckCircle, 
  Play, 
  FileText,
  Lock
} from 'lucide-react';
import { useParams, useNavigate } from 'react-router-dom';
import { upcomingExamsMock } from '../../data/mockData';
import { useAuth } from '../../context/AuthContext';

export const ExamDetailPage: React.FC = () => {
  const { id } = useParams();
  const navigate = useNavigate();
  const { user } = useAuth();
  const exam = upcomingExamsMock.find(e => e.id === id) || upcomingExamsMock[0];

  const [hasAgreed, setHasAgreed] = useState(false);
  const [tokenInput, setTokenInput] = useState('');

  const handleStartExam = () => {
    if (!hasAgreed) {
      alert('Harap centang persetujuan tata tertib ujian terlebih dahulu.');
      return;
    }
    navigate(`/cbt/pengerjaan/${exam.id}`);
  };

  return (
    <div className="space-y-4 max-w-4xl mx-auto">
      {/* Top Bar */}
      <div className="flex items-center gap-3">
        <button
          type="button"
          onClick={() => navigate('/cbt/jadwal')}
          className="p-1.5 rounded-xl bg-white border border-[#E6ECF5] text-[#5A6A85] hover:text-[#1769FF]"
        >
          <ArrowLeft className="w-4 h-4" />
        </button>
        <span className="text-[12px] text-[#78849A]">Ujian (CBT)</span>
        <span className="text-[12px] text-[#78849A]">/</span>
        <span className="text-[12px] text-[#17233F] font-bold">Detail & Petunjuk Ujian</span>
      </div>

      {/* Main Info Card */}
      <div className="bg-white rounded-[24px] p-6 border border-[#E6ECF5] shadow-sm space-y-6">
        <div className="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-[#F0F4FA] pb-5">
          <div>
            <span className="px-2.5 py-0.5 rounded-full bg-[#EAF2FF] text-[#1769FF] font-bold text-[11px]">
              {exam.subjectName} • {exam.kelas}
            </span>
            <h1 className="text-[22px] font-bold text-[#17233F] mt-2">
              {exam.title}
            </h1>
            <p className="text-[12.5px] text-[#78849A]">
              Guru Penguji: {exam.teacherName} • Tahun Ajaran 2025/2026
            </p>
          </div>

          <div className="bg-[#EEF4FF] rounded-2xl p-4 text-center border border-[#DCEBFF] min-w-[140px]">
            <span className="text-[11px] text-[#78849A] font-semibold">Status Pengerjaan</span>
            <div className="text-[15px] font-bold text-[#1769FF] mt-0.5">Siap Dimulai</div>
          </div>
        </div>

        {/* Exam Specifications */}
        <div className="grid grid-cols-2 sm:grid-cols-4 gap-3">
          <div className="p-3.5 rounded-2xl bg-[#F8FAFD] border border-[#E6ECF5]">
            <Calendar className="w-4 h-4 text-[#1769FF]" />
            <div className="text-[11px] text-[#78849A] mt-2">Tanggal & Jam</div>
            <div className="text-[13px] font-bold text-[#17233F]">{exam.startDate}</div>
            <div className="text-[11px] text-[#5A6A85]">{exam.startTime} - {exam.endTime}</div>
          </div>

          <div className="p-3.5 rounded-2xl bg-[#F8FAFD] border border-[#E6ECF5]">
            <Clock className="w-4 h-4 text-[#9565F5]" />
            <div className="text-[11px] text-[#78849A] mt-2">Alokasi Waktu</div>
            <div className="text-[13px] font-bold text-[#17233F]">{exam.durationMinutes} Menit</div>
            <div className="text-[11px] text-[#5A6A85]">Otomatis submit</div>
          </div>

          <div className="p-3.5 rounded-2xl bg-[#F8FAFD] border border-[#E6ECF5]">
            <FileText className="w-4 h-4 text-emerald-600" />
            <div className="text-[11px] text-[#78849A] mt-2">Jumlah Soal</div>
            <div className="text-[13px] font-bold text-[#17233F]">{exam.totalQuestions} Butir</div>
            <div className="text-[11px] text-[#5A6A85]">PG & Esai Campuran</div>
          </div>

          <div className="p-3.5 rounded-2xl bg-[#F8FAFD] border border-[#E6ECF5]">
            <ShieldCheck className="w-4 h-4 text-[#F5A623]" />
            <div className="text-[11px] text-[#78849A] mt-2">Batas Kelulusan (KKM)</div>
            <div className="text-[13px] font-bold text-[#17233F]">{exam.passingScore} Poin</div>
            <div className="text-[11px] text-[#5A6A85]">Skor Maksimal 100</div>
          </div>
        </div>

        {/* Exam Rules and Instructions */}
        <div className="space-y-3">
          <h3 className="text-[14px] font-bold text-[#17233F] flex items-center gap-2">
            <AlertTriangle className="w-4 h-4 text-[#F5A623]" />
            <span>Tata Tertib & Petunjuk Teknis CBT</span>
          </h3>

          <div className="p-4 rounded-2xl bg-amber-50/50 border border-amber-200/60 space-y-2 text-[12px] text-amber-900">
            {exam.instructions.map((inst, idx) => (
              <div key={idx} className="flex items-start gap-2">
                <span className="font-bold">•</span>
                <span>{inst}</span>
              </div>
            ))}
          </div>
        </div>

        {/* Agreement and Action */}
        <div className="p-4 rounded-2xl bg-[#F8FAFD] border border-[#E6ECF5] space-y-4">
          <label className="flex items-center gap-3 cursor-pointer">
            <input
              type="checkbox"
              checked={hasAgreed}
              onChange={(e) => setHasAgreed(e.target.checked)}
              className="w-4 h-4 text-[#1769FF] rounded focus:ring-[#1769FF]"
            />
            <span className="text-[12.5px] font-semibold text-[#17233F]">
              Saya telah membaca, memahami, dan menyetujui seluruh tata tertib pelaksanaan ujian CBT ini secara jujur.
            </span>
          </label>

          <div className="flex flex-col sm:flex-row items-center justify-between gap-3 pt-2">
            <div className="text-[11.5px] text-[#78849A]">
              Peserta: <span className="font-bold text-[#17233F]">{user.name}</span> ({user.kelas || 'Siswa Terdaftar'})
            </div>

            <button
              type="button"
              disabled={!hasAgreed}
              onClick={handleStartExam}
              className={`
                px-6 py-2.5 rounded-full text-[13px] font-bold flex items-center gap-2 shadow-md transition-all
                ${hasAgreed 
                  ? 'bg-[#1769FF] text-white hover:bg-[#1248D8] active:scale-95' 
                  : 'bg-slate-200 text-slate-400 cursor-not-allowed'
                }
              `}
            >
              <Play className="w-4 h-4 fill-current" />
              <span>Mulai Pengerjaan Ujian Sekarang</span>
            </button>
          </div>
        </div>
      </div>
    </div>
  );
};

