import React from 'react';
import { ShieldCheck, Calendar, Clock, ArrowRight } from 'lucide-react';
import { useNavigate } from 'react-router-dom';

export const UjianCbtCard: React.FC = () => {
  const navigate = useNavigate();

  return (
    <div className="space-y-3">
      {/* Section Header */}
      <div className="flex items-center justify-between">
        <div className="flex items-center gap-2">
          <ShieldCheck className="w-4 h-4 text-[#1769FF] stroke-[2.5]" />
          <h2 className="text-[14.5px] font-bold text-[#17233F]">Ujian CBT</h2>
        </div>
        <button
          type="button"
          onClick={() => navigate('/cbt/jadwal')}
          className="text-[11.5px] font-semibold text-[#1769FF] hover:underline flex items-center gap-1"
        >
          <span>Lihat Semua</span>
          <ArrowRight className="w-3.5 h-3.5" />
        </button>
      </div>

      {/* Main Card Container */}
      <div className="bg-white rounded-[20px] p-4 border border-[#E6ECF5] shadow-[0_4px_16px_rgba(23,72,150,0.04)] flex flex-col sm:flex-row items-center justify-between gap-4">
        {/* Left side with 3D Illustration and Exam Details */}
        <div className="flex items-center gap-4 flex-1 min-w-0">
          {/* 3D Clipboard & Clock Illustration */}
          <div className="w-[78px] h-[78px] rounded-[18px] bg-[#F5F2FE] flex items-center justify-center p-1.5 flex-shrink-0">
            <img
              src="/assets/images/cbt-clock.png"
              alt="CBT Clock"
              className="w-full h-full object-contain"
            />
          </div>

          {/* Exam Info */}
          <div className="space-y-1 min-w-0">
            <h3 className="text-[14px] font-bold text-[#17233F] truncate">
              Ujian Tengah Semester
            </h3>
            <p className="text-[11.5px] text-[#78849A] font-medium">
              Matematika • XII IPA
            </p>

            <div className="flex flex-wrap items-center gap-x-3.5 gap-y-1 pt-0.5 text-[11px] text-[#5A6A85]">
              <div className="flex items-center gap-1.5">
                <Calendar className="w-3.5 h-3.5 text-[#1769FF]" />
                <span>20 Nov 2025, 08:00 - 10:00</span>
              </div>
              <div className="flex items-center gap-1.5">
                <Clock className="w-3.5 h-3.5 text-[#9565F5]" />
                <span>Durasi: 90 Menit</span>
              </div>
            </div>

            <div className="pt-1.5">
              <button
                type="button"
                onClick={() => navigate('/cbt/ujian/exm_uts_math')}
                className="inline-flex items-center gap-1 px-4 py-1.5 rounded-full bg-[#1769FF] text-white text-[11.5px] font-bold shadow-sm hover:bg-[#1248D8] active:scale-95 transition-all"
              >
                <span>Lihat Detail</span>
                <ArrowRight className="w-3 h-3" />
              </button>
            </div>
          </div>
        </div>

        {/* Right side: Countdown Highlight Box */}
        <div className="w-full sm:w-auto bg-[#EEF4FF] rounded-[18px] px-7 py-4.5 flex flex-col items-center justify-center min-w-[145px] border border-[#DCEBFF] flex-shrink-0">
          <div className="text-[20px] font-extrabold text-[#17233F] tracking-tight">
            -3 Hari Lagi
          </div>
          <div className="text-[11.5px] text-[#78849A] font-medium mt-0.5">
            Menuju Ujian
          </div>
        </div>
      </div>
    </div>
  );
};
