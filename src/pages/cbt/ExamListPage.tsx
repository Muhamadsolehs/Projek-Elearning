import React, { useState } from 'react';
import { 
  Calendar, 
  Clock, 
  ShieldCheck, 
  Plus, 
  Search, 
  ArrowRight, 
  Filter, 
  CheckCircle2, 
  AlertTriangle 
} from 'lucide-react';
import { useNavigate } from 'react-router-dom';
import { upcomingExamsMock } from '../../data/mockData';
import { useAuth } from '../../context/AuthContext';

export const ExamListPage: React.FC = () => {
  const navigate = useNavigate();
  const { user } = useAuth();
  const [filterTab, setFilterTab] = useState<'mendatang' | 'riwayat'>('mendatang');

  return (
    <div className="space-y-4">
      {/* Header */}
      <div className="bg-white p-4 rounded-[18px] border border-[#E6ECF5] shadow-sm flex flex-col sm:flex-row sm:items-center justify-between gap-3">
        <div>
          <h1 className="text-[18px] font-bold text-[#17233F]">Jadwal & Evaluasi Ujian CBT</h1>
          <p className="text-[12px] text-[#78849A]">Daftar ujian resmi berbasis komputer, simulasi, dan arsip nilai.</p>
        </div>

        {user.role === 'guru' || user.role === 'admin_institusi' ? (
          <button
            type="button"
            onClick={() => navigate('/cbt/ujian/buat')}
            className="px-4 py-2 rounded-xl bg-[#1769FF] text-white text-[12px] font-bold flex items-center gap-1.5 shadow-sm hover:bg-[#1248D8] transition-all"
          >
            <Plus className="w-4 h-4" />
            <span>Jadwalkan Ujian Baru</span>
          </button>
        ) : null}
      </div>

      {/* Tabs */}
      <div className="flex items-center gap-2 border-b border-[#E6ECF5] pb-1">
        <button
          type="button"
          onClick={() => setFilterTab('mendatang')}
          className={`px-4 py-2 text-[12.5px] font-bold rounded-xl transition-all ${
            filterTab === 'mendatang' ? 'bg-[#EAF2FF] text-[#1769FF]' : 'text-[#78849A]'
          }`}
        >
          Ujian Mendatang & Aktif
        </button>
        <button
          type="button"
          onClick={() => setFilterTab('riwayat')}
          className={`px-4 py-2 text-[12.5px] font-bold rounded-xl transition-all ${
            filterTab === 'riwayat' ? 'bg-[#EAF2FF] text-[#1769FF]' : 'text-[#78849A]'
          }`}
        >
          Riwayat Ujian Selesai
        </button>
      </div>

      {/* Exam Cards */}
      <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
        {upcomingExamsMock.map((exam) => (
          <div
            key={exam.id}
            className="bg-white rounded-[20px] p-5 border border-[#E6ECF5] shadow-sm hover:shadow-md transition-all flex flex-col justify-between"
          >
            <div className="space-y-3">
              <div className="flex items-center justify-between">
                <span className="px-2.5 py-0.5 rounded-full bg-[#EAF2FF] text-[#1769FF] font-bold text-[11px]">
                  {exam.subjectName} ({exam.kelas})
                </span>
                <span className="px-2.5 py-0.5 rounded-full bg-blue-100 text-[#1769FF] font-extrabold text-[11px]">
                  -{exam.daysLeft} Hari Lagi
                </span>
              </div>

              <div>
                <h3 className="text-[16px] font-bold text-[#17233F]">{exam.title}</h3>
                <p className="text-[11.5px] text-[#78849A] mt-0.5">Pengampu: {exam.teacherName}</p>
              </div>

              <div className="grid grid-cols-2 gap-2 text-[11.5px] text-[#5A6A85] bg-[#F8FAFD] p-3 rounded-xl border border-[#E6ECF5]">
                <div className="flex items-center gap-1.5">
                  <Calendar className="w-3.5 h-3.5 text-[#1769FF]" />
                  <span>{exam.startDate}, {exam.startTime}</span>
                </div>
                <div className="flex items-center gap-1.5">
                  <Clock className="w-3.5 h-3.5 text-[#9565F5]" />
                  <span>Durasi: {exam.durationMinutes} Menit</span>
                </div>
                <div className="flex items-center gap-1.5">
                  <ShieldCheck className="w-3.5 h-3.5 text-emerald-600" />
                  <span>{exam.totalQuestions} Soal Campuran</span>
                </div>
                <div className="flex items-center gap-1.5">
                  <span className="font-semibold">KKM: {exam.passingScore}</span>
                </div>
              </div>
            </div>

            <div className="mt-4 pt-3 border-t border-[#F0F4FA] flex items-center justify-between">
              <span className="text-[11px] text-[#78849A]">Token otomatis aktif saat jam mulai</span>
              <button
                type="button"
                onClick={() => navigate(`/cbt/ujian/${exam.id}`)}
                className="px-4 py-2 rounded-xl bg-[#1769FF] text-white text-[12px] font-bold shadow-sm hover:bg-[#1248D8] transition-all flex items-center gap-1.5"
              >
                <span>Lihat Detail & Petunjuk</span>
                <ArrowRight className="w-3.5 h-3.5" />
              </button>
            </div>
          </div>
        ))}
      </div>
    </div>
  );
};

