import React from 'react';
import { Megaphone, Calendar, Tag } from 'lucide-react';
import { announcementsMock } from '../../data/mockData';

export const PengumumanPage: React.FC = () => {
  return (
    <div className="space-y-4 max-w-4xl mx-auto">
      {/* Header */}
      <div className="bg-white p-4 rounded-[18px] border border-[#E6ECF5] shadow-sm">
        <h1 className="text-[18px] font-bold text-[#17233F]">Pusat Informasi & Pengumuman</h1>
        <p className="text-[12px] text-[#78849A]">Warta resmi dari pihak sekolah, guru pengampu, dan admin sistem.</p>
      </div>

      <div className="space-y-3">
        {announcementsMock.map((item) => (
          <div
            key={item.id}
            className="bg-white rounded-[20px] p-5 border border-[#E6ECF5] shadow-sm space-y-2 hover:shadow-md transition-all"
          >
            <div className="flex items-center justify-between">
              <span className="px-2.5 py-0.5 rounded-full bg-[#EAF2FF] text-[#1769FF] font-bold text-[10.5px]">
                {item.category}
              </span>
              <span className="text-[11px] text-[#8C98A9] flex items-center gap-1">
                <Calendar className="w-3.5 h-3.5" />
                {item.date}
              </span>
            </div>

            <h3 className="text-[15px] font-bold text-[#17233F] pt-1">{item.title}</h3>
            <p className="text-[12.5px] text-[#5A6A85] leading-relaxed">{item.content}</p>
          </div>
        ))}
      </div>
    </div>
  );
};

