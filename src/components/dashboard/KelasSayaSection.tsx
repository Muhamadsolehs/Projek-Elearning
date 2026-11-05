import React from 'react';
import { GraduationCap, ArrowRight } from 'lucide-react';
import { useNavigate } from 'react-router-dom';
import { Course } from '../../types';

interface KelasSayaSectionProps {
  courses: Course[];
}

export const KelasSayaSection: React.FC<KelasSayaSectionProps> = ({ courses }) => {
  const navigate = useNavigate();

  return (
    <div className="space-y-3">
      {/* Section Header */}
      <div className="flex items-center justify-between">
        <div className="flex items-center gap-2">
          <GraduationCap className="w-4.5 h-4.5 text-[#1769FF] stroke-[2.5]" />
          <h2 className="text-[14.5px] font-bold text-[#17233F]">Kelas Saya</h2>
        </div>
        <button
          type="button"
          onClick={() => navigate('/pembelajaran/materi')}
          className="text-[11.5px] font-semibold text-[#1769FF] hover:underline flex items-center gap-1"
        >
          <span>Lihat Semua</span>
          <ArrowRight className="w-3.5 h-3.5" />
        </button>
      </div>

      {/* 4 Cards Grid */}
      <div className="grid grid-cols-2 md:grid-cols-4 gap-3.5">
        {courses.map((course) => {
          return (
            <div
              key={course.id}
              onClick={() => navigate(`/pembelajaran/course/${course.id}`)}
              className="bg-white rounded-[18px] p-3 border border-[#E6ECF5] shadow-[0_4px_16px_rgba(23,72,150,0.04)] hover:shadow-[0_8px_24px_rgba(23,72,150,0.08)] transition-all cursor-pointer flex flex-col justify-between group"
            >
              {/* Illustration Thumbnail Box */}
              <div className="w-full h-[98px] rounded-[14px] overflow-hidden bg-[#F0F5FD] flex items-center justify-center p-1 relative group-hover:scale-[1.02] transition-transform">
                <img
                  src={course.thumbnail}
                  alt={course.subjectName}
                  className="w-full h-full object-cover rounded-[12px]"
                />
              </div>

              {/* Subject Title and Class */}
              <div className="mt-2.5 px-0.5">
                <h3 className="text-[13px] font-bold text-[#17233F] truncate group-hover:text-[#1769FF] transition-colors">
                  {course.subjectName}
                </h3>
                <p className="text-[10.5px] text-[#78849A] font-medium mt-0.5">
                  {course.kelas}
                </p>
              </div>

              {/* Progress Bar and Percentage */}
              <div className="mt-2.5 px-0.5 flex items-center gap-2">
                <div className="flex-1 h-1.5 bg-[#EEF2F6] rounded-full overflow-hidden">
                  <div
                    className="h-full rounded-full transition-all duration-500"
                    style={{
                      width: `${course.progress}%`,
                      backgroundColor: course.id === 'crs_indo_12' ? '#1769FF' : course.accentColor || '#1769FF',
                    }}
                  />
                </div>
                <span className="text-[10.5px] font-bold text-[#5A6A85] min-w-[26px] text-right">
                  {course.progress}%
                </span>
              </div>
            </div>
          );
        })}
      </div>
    </div>
  );
};
