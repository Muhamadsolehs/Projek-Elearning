import React from 'react';
import { BookOpen, CheckCircle2, ClipboardList, Trophy } from 'lucide-react';

interface StatCardsProps {
  stats: {
    mataPelajaran: number;
    mataPelajaranDelta: string;
    tugasAktif: number;
    tugasAktifDelta: string;
    ujianMendatang: number;
    ujianMendatangDelta: string;
    rataRataNilai: number;
    rataRataNilaiDelta: string;
  };
}

export const StatCards: React.FC<StatCardsProps> = ({ stats }) => {
  const cards = [
    {
      title: 'Mata Pelajaran',
      value: stats.mataPelajaran.toString(),
      delta: stats.mataPelajaranDelta,
      icon: BookOpen,
      iconColor: 'text-[#1769FF]',
      iconBg: 'bg-[#EAF2FF]',
      waveColor: '#1769FF',
    },
    {
      title: 'Tugas Aktif',
      value: stats.tugasAktif.toString(),
      delta: stats.tugasAktifDelta,
      icon: CheckCircle2,
      iconColor: 'text-[#20B981]',
      iconBg: 'bg-[#E6F8F0]',
      waveColor: '#20B981',
    },
    {
      title: 'Ujian Mendatang',
      value: stats.ujianMendatang.toString(),
      delta: stats.ujianMendatangDelta,
      icon: ClipboardList,
      iconColor: 'text-[#9565F5]',
      iconBg: 'bg-[#F2ECFE]',
      waveColor: '#9565F5',
    },
    {
      title: 'Rata-rata Nilai',
      value: stats.rataRataNilai.toFixed(1),
      delta: stats.rataRataNilaiDelta,
      icon: Trophy,
      iconColor: 'text-[#F5A623]',
      iconBg: 'bg-[#FEF5E7]',
      waveColor: '#F5A623',
    },
  ];

  return (
    <div className="grid grid-cols-2 lg:grid-cols-4 gap-3.5">
      {cards.map((card, idx) => {
        const Icon = card.icon;
        return (
          <div
            key={idx}
            className="bg-white rounded-[20px] p-4 border border-[#E6ECF5] shadow-[0_4px_16px_rgba(23,72,150,0.04)] relative overflow-hidden flex flex-col justify-between hover:shadow-[0_8px_24px_rgba(23,72,150,0.08)] transition-all min-h-[125px]"
          >
            {/* Top row: Icon */}
            <div className="flex items-center justify-between">
              <div className={`w-9 h-9 rounded-xl ${card.iconBg} flex items-center justify-center ${card.iconColor}`}>
                <Icon className="w-4.5 h-4.5 stroke-[2.2]" />
              </div>
            </div>

            {/* Middle: Number and Label */}
            <div className="mt-2.5">
              <div className="text-[22px] font-extrabold text-[#17233F] leading-tight tracking-tight">
                {card.value}
              </div>
              <div className="text-[11.5px] text-[#78849A] font-medium mt-0.5 truncate">
                {card.title}
              </div>
            </div>

            {/* Bottom: Delta Indicator and Mini Sparkline */}
            <div className="mt-2 flex items-center justify-between">
              <div className="flex items-center gap-0.5 text-[10.5px] font-bold text-emerald-500">
                <span>{card.delta}</span>
              </div>

              {/* Mini Sparkline SVG wave */}
              <div className="w-16 h-4 opacity-80">
                <svg viewBox="0 0 60 16" fill="none" className="w-full h-full">
                  <path
                    d={
                      idx === 0
                        ? "M0 12 C 15 14, 25 3, 40 8 C 50 11, 55 4, 60 5"
                        : idx === 1
                        ? "M0 13 C 12 11, 22 14, 35 6 C 45 2, 52 10, 60 7"
                        : idx === 2
                        ? "M0 11 C 14 13, 26 4, 38 9 C 48 12, 54 5, 60 6"
                        : "M0 12 C 12 10, 24 13, 36 5 C 46 2, 53 9, 60 6"
                    }
                    stroke={card.waveColor}
                    strokeWidth="1.8"
                    strokeLinecap="round"
                    fill="none"
                  />
                </svg>
              </div>
            </div>
          </div>
        );
      })}
    </div>
  );
};
