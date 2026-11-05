import React from 'react';
import { CheckSquare, FileText, Table, ArrowRight } from 'lucide-react';
import { useNavigate } from 'react-router-dom';
import { Assignment } from '../../types';

interface TugasMendatangWidgetProps {
  assignments: Assignment[];
}

export const TugasMendatangWidget: React.FC<TugasMendatangWidgetProps> = ({ assignments }) => {
  const navigate = useNavigate();

  const getIcon = (type: string) => {
    switch (type) {
      case 'document':
        return {
          icon: FileText,
          bg: 'bg-[#FEF5E7]',
          color: 'text-[#F5A623]',
        };
      case 'spreadsheet':
        return {
          icon: Table,
          bg: 'bg-[#E6F8F0]',
          color: 'text-[#20B981]',
        };
      case 'code':
        return {
          icon: FileText,
          bg: 'bg-[#F2ECFE]',
          color: 'text-[#9565F5]',
        };
      default:
        return {
          icon: FileText,
          bg: 'bg-[#EAF2FF]',
          color: 'text-[#1769FF]',
        };
    }
  };

  const getBadgeStyle = (badgeColor: string) => {
    switch (badgeColor) {
      case 'red':
        return 'bg-[#FDECEE] text-[#EF5B65]';
      case 'blue':
        return 'bg-[#EAF2FF] text-[#1769FF]';
      case 'purple':
        return 'bg-[#F2ECFE] text-[#9565F5]';
      default:
        return 'bg-[#F5F8FF] text-[#78849A]';
    }
  };

  return (
    <div className="bg-white rounded-[20px] p-4 border border-[#E6ECF5] shadow-[0_4px_16px_rgba(23,72,150,0.04)] space-y-3">
      {/* Header */}
      <div className="flex items-center justify-between">
        <div className="flex items-center gap-2">
          <CheckSquare className="w-4.5 h-4.5 text-[#1769FF] stroke-[2.5]" />
          <h2 className="text-[14px] font-bold text-[#17233F]">Tugas Mendatang</h2>
        </div>
        <button
          type="button"
          onClick={() => navigate('/pembelajaran/tugas')}
          className="text-[11.5px] font-semibold text-[#1769FF] hover:underline flex items-center gap-1"
        >
          <span>Lihat Semua</span>
          <ArrowRight className="w-3.5 h-3.5" />
        </button>
      </div>

      {/* List items */}
      <div className="space-y-2">
        {assignments.map((item) => {
          const iconConfig = getIcon(item.iconType);
          const Icon = iconConfig.icon;
          const badgeClass = getBadgeStyle(item.badgeColor);

          return (
            <div
              key={item.id}
              onClick={() => navigate(`/pembelajaran/tugas`)}
              className="flex items-center justify-between p-2.5 rounded-xl hover:bg-[#F8FAFD] border border-transparent hover:border-[#EBF2FE] transition-all cursor-pointer group"
            >
              <div className="flex items-center gap-3 min-w-0">
                <div
                  className={`w-8 h-8 rounded-lg ${iconConfig.bg} flex items-center justify-center ${iconConfig.color} flex-shrink-0`}
                >
                  <Icon className="w-4 h-4 stroke-[2.2]" />
                </div>
                <div className="min-w-0">
                  <h4 className="text-[12.5px] font-bold text-[#17233F] truncate group-hover:text-[#1769FF] transition-colors">
                    {item.title}
                  </h4>
                  <p className="text-[10.5px] text-[#78849A] font-medium truncate">
                    {item.subjectName} • {item.kelas}
                  </p>
                </div>
              </div>

              {/* Deadline Badge */}
              <div
                className={`text-[10px] font-bold px-2.5 py-0.5 rounded-full flex-shrink-0 ml-2 ${badgeClass}`}
              >
                {item.daysLeft} hari lagi
              </div>
            </div>
          );
        })}
      </div>
    </div>
  );
};
