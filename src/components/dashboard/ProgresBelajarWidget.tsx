import React from 'react';
import { BarChart3, TrendingUp } from 'lucide-react';

interface ProgresBelajarWidgetProps {
  percentage: number;
}

export const ProgresBelajarWidget: React.FC<ProgresBelajarWidgetProps> = ({ percentage }) => {
  const radius = 26;
  const circumference = 2 * Math.PI * radius;
  const strokeDashoffset = circumference - (percentage / 100) * circumference;

  return (
    <div className="bg-white rounded-[20px] p-3.5 border border-[#E6ECF5] shadow-[0_4px_16px_rgba(23,72,150,0.04)] flex flex-col justify-between">
      {/* Header */}
      <div className="flex items-center gap-1.5 pb-1">
        <BarChart3 className="w-4 h-4 text-[#1769FF] stroke-[2.5]" />
        <h2 className="text-[13px] font-bold text-[#17233F]">Progres Belajar</h2>
      </div>

      <div className="flex items-center gap-2.5 py-1">
        {/* SVG Circular Progress Ring */}
        <div className="relative w-16 h-16 flex items-center justify-center flex-shrink-0">
          <svg className="w-16 h-16 transform -rotate-90">
            <circle
              cx="32"
              cy="32"
              r={radius}
              stroke="#EEF4FF"
              strokeWidth="5"
              fill="transparent"
            />
            <circle
              cx="32"
              cy="32"
              r={radius}
              stroke="#1769FF"
              strokeWidth="5.5"
              strokeDasharray={circumference}
              strokeDashoffset={strokeDashoffset}
              strokeLinecap="round"
              fill="transparent"
              className="transition-all duration-1000 ease-out"
            />
          </svg>
          <span className="absolute text-[13px] font-extrabold text-[#17233F]">
            {percentage}%
          </span>
        </div>

        {/* Motivational Info & Mini Trend */}
        <div className="space-y-0.5 min-w-0 flex-1">
          <div className="flex items-center gap-1">
            <span className="text-[11.5px] font-bold text-[#17233F]">Bagus sekali!</span>
            <TrendingUp className="w-3.5 h-3.5 text-emerald-500 stroke-[2.5]" />
          </div>
          <p className="text-[10px] text-[#78849A] leading-tight">
            Terus tingkatkan progres belajarmu.
          </p>

          {/* Mini vertical bar indicator decoration */}
          <div className="flex items-end gap-1 pt-1.5 h-6">
            <div className="w-1.5 h-2 bg-[#E2E8F0] rounded-t-sm"></div>
            <div className="w-1.5 h-3.5 bg-[#CBD5E1] rounded-t-sm"></div>
            <div className="w-1.5 h-5 bg-[#93C5FD] rounded-t-sm"></div>
            <div className="w-1.5 h-6 bg-[#1769FF] rounded-t-sm"></div>
          </div>
        </div>
      </div>
    </div>
  );
};
