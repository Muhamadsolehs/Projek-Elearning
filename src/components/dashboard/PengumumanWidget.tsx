import React from 'react';
import { Megaphone, ArrowRight } from 'lucide-react';
import { useNavigate } from 'react-router-dom';
import { Announcement } from '../../types';

interface PengumumanWidgetProps {
  announcements: Announcement[];
}

export const PengumumanWidget: React.FC<PengumumanWidgetProps> = ({ announcements }) => {
  const navigate = useNavigate();

  const getDotColor = (dotColor: string) => {
    switch (dotColor) {
      case 'orange':
        return 'bg-[#F5A623]';
      case 'blue':
        return 'bg-[#1769FF]';
      case 'purple':
        return 'bg-[#9565F5]';
      case 'green':
        return 'bg-[#20B981]';
      default:
        return 'bg-[#78849A]';
    }
  };

  return (
    <div className="bg-white rounded-[20px] p-3.5 border border-[#E6ECF5] shadow-[0_4px_16px_rgba(23,72,150,0.04)] flex flex-col justify-between">
      {/* Header */}
      <div className="flex items-center justify-between gap-1 pb-1">
        <div className="flex items-center gap-1.5 min-w-0">
          <Megaphone className="w-4 h-4 text-[#1769FF] stroke-[2.5] flex-shrink-0" />
          <h2 className="text-[12.5px] font-bold text-[#17233F] truncate">Pengumuman</h2>
        </div>
        <button
          type="button"
          onClick={() => navigate('/pengumuman')}
          className="text-[10px] font-semibold text-[#1769FF] hover:underline flex items-center gap-0.5 flex-shrink-0"
        >
          <span>Lihat Semua</span>
          <ArrowRight className="w-2.5 h-2.5" />
        </button>
      </div>

      {/* List items */}
      <div className="space-y-1.5 py-0.5">
        {announcements.map((item) => (
          <div
            key={item.id}
            onClick={() => navigate('/pengumuman')}
            className="flex items-start gap-2 hover:bg-[#F8FAFD] p-1 rounded-lg transition-colors cursor-pointer group"
          >
            <span
              className={`w-2 h-2 rounded-full mt-1 flex-shrink-0 ${getDotColor(
                item.dotColor
              )}`}
            />
            <div className="min-w-0 flex-1">
              <h4 className="text-[11px] font-bold text-[#17233F] truncate group-hover:text-[#1769FF] transition-colors leading-tight">
                {item.title}
              </h4>
              <p className="text-[9.5px] text-[#8C98A9] font-medium leading-none mt-0.5">
                {item.date}
              </p>
            </div>
          </div>
        ))}
      </div>
    </div>
  );
};
