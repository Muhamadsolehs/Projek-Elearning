import React from 'react';
import { Play } from 'lucide-react';
import { useNavigate } from 'react-router-dom';

interface WelcomeBannerProps {
  name: string;
}

export const WelcomeBanner: React.FC<WelcomeBannerProps> = ({ name }) => {
  const navigate = useNavigate();

  return (
    <div className="relative overflow-hidden rounded-[22px] bg-gradient-to-r from-[#1769FF] via-[#1A6EF6] to-[#3B82F6] text-white p-6 lg:p-7 shadow-[0_10px_28px_rgba(23,105,255,0.22)] flex items-center justify-between min-h-[160px]">
      {/* Background glow and highlights */}
      <div className="absolute -top-10 -right-10 w-64 h-64 bg-white/10 rounded-full blur-2xl pointer-events-none" />
      <div className="absolute -bottom-10 right-44 w-44 h-44 bg-sky-300/15 rounded-full blur-xl pointer-events-none" />

      {/* Decorative dot matrix in background */}
      <div className="absolute bottom-4 left-56 opacity-30 pointer-events-none flex gap-2">
        <div className="flex flex-col gap-1.5">
          <span className="w-1 h-1 bg-white rounded-full"></span>
          <span className="w-1 h-1 bg-white rounded-full"></span>
          <span className="w-1 h-1 bg-white rounded-full"></span>
        </div>
        <div className="flex flex-col gap-1.5">
          <span className="w-1 h-1 bg-white rounded-full"></span>
          <span className="w-1 h-1 bg-white rounded-full"></span>
          <span className="w-1 h-1 bg-white rounded-full"></span>
        </div>
        <div className="flex flex-col gap-1.5">
          <span className="w-1 h-1 bg-white rounded-full"></span>
          <span className="w-1 h-1 bg-white rounded-full"></span>
          <span className="w-1 h-1 bg-white rounded-full"></span>
        </div>
      </div>

      {/* Left Content */}
      <div className="relative z-10 max-w-[360px]">
        <h1 className="text-[21px] lg:text-[23px] font-bold text-white tracking-tight flex items-center gap-2">
          Selamat Datang, {name}! <span className="text-[22px]">👋</span>
        </h1>
        <p className="text-[12.5px] text-white/95 font-normal mt-1 leading-normal">
          Terus belajar dan raih prestasi terbaikmu bersama EduCore.
        </p>

        <button
          type="button"
          onClick={() => navigate('/pembelajaran/materi')}
          className="mt-4 inline-flex items-center gap-2 px-5 py-2 rounded-full bg-white text-[#1769FF] text-[12.5px] font-bold shadow-md hover:bg-[#F0F6FF] active:scale-95 transition-all"
        >
          <Play className="w-3.5 h-3.5 fill-[#1769FF] text-[#1769FF]" />
          <span>Mulai Belajar</span>
        </button>
      </div>

      {/* Right Educational 3D Illustration - Seamlessly aligned to top-right corner */}
      <div className="absolute top-0 right-0 h-full w-[260px] hidden sm:block pointer-events-none">
        <img
          src="/assets/images/banner-illustration.png"
          alt="Belajar EduCore"
          className="w-full h-full object-cover object-left rounded-r-[22px]"
        />
      </div>
    </div>
  );
};
