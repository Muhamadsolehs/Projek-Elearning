import React, { useState } from 'react';
import { Calendar as CalendarIcon, ChevronLeft, ChevronRight, ArrowRight } from 'lucide-react';
import { useNavigate } from 'react-router-dom';

export const CalendarWidget: React.FC = () => {
  const navigate = useNavigate();
  const [selectedDay, setSelectedDay] = useState(12);

  // November 2025 Calendar representation matching reference
  const daysHeader = ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'];
  
  // Previous month trailing days
  const prevDays = [27, 28, 29, 30, 31];
  
  // November days 1 - 30
  const currentMonthDays = Array.from({ length: 30 }, (_, i) => i + 1);

  return (
    <div className="bg-white rounded-[20px] p-4 border border-[#E6ECF5] shadow-[0_4px_16px_rgba(23,72,150,0.04)]">
      {/* Header */}
      <div className="flex items-center justify-between pb-2">
        <div className="flex items-center gap-2">
          <CalendarIcon className="w-4.5 h-4.5 text-[#1769FF] stroke-[2.5]" />
          <h2 className="text-[14px] font-bold text-[#17233F]">Jadwal Saya</h2>
        </div>
        <button
          type="button"
          onClick={() => navigate('/kalender')}
          className="text-[11.5px] font-semibold text-[#1769FF] hover:underline flex items-center gap-1"
        >
          <span>Lihat Semua</span>
          <ArrowRight className="w-3.5 h-3.5" />
        </button>
      </div>

      {/* Month Navigator */}
      <div className="flex items-center justify-between py-1.5 px-2">
        <button
          type="button"
          className="p-1 rounded-md text-[#78849A] hover:bg-[#F5F8FF] hover:text-[#1769FF] transition-colors"
        >
          <ChevronLeft className="w-3.5 h-3.5" />
        </button>
        <span className="text-[13px] font-bold text-[#17233F]">November 2025</span>
        <button
          type="button"
          className="p-1 rounded-md text-[#78849A] hover:bg-[#F5F8FF] hover:text-[#1769FF] transition-colors"
        >
          <ChevronRight className="w-3.5 h-3.5" />
        </button>
      </div>

      {/* Days of week header */}
      <div className="grid grid-cols-7 gap-1 text-center py-1">
        {daysHeader.map((day) => (
          <span key={day} className="text-[10.5px] font-semibold text-[#8C98A9]">
            {day}
          </span>
        ))}
      </div>

      {/* Calendar Grid */}
      <div className="grid grid-cols-7 gap-y-1 gap-x-1 text-center text-[11.5px]">
        {/* Previous month days */}
        {prevDays.map((d) => (
          <div key={`prev-${d}`} className="h-6 flex items-center justify-center text-[#CBD5E1]">
            {d}
          </div>
        ))}

        {/* Current month days */}
        {currentMonthDays.map((day) => {
          const isSelected = day === selectedDay;
          const hasExam = day === 20;

          return (
            <div
              key={`day-${day}`}
              onClick={() => setSelectedDay(day)}
              className="h-6 flex flex-col items-center justify-center relative cursor-pointer group"
            >
              <span
                className={`
                  w-6 h-6 rounded-full flex items-center justify-center font-medium transition-all
                  ${
                    isSelected
                      ? 'bg-[#1769FF] text-white font-bold shadow-sm'
                      : 'text-[#334155] group-hover:bg-[#EEF4FF] group-hover:text-[#1769FF]'
                  }
                `}
              >
                {day}
              </span>
              {/* Dot indicator for day 20 (Exam) */}
              {hasExam && !isSelected && (
                <span className="w-1 h-1 rounded-full bg-[#1769FF] absolute -bottom-0.5" />
              )}
            </div>
          );
        })}
      </div>
    </div>
  );
};
