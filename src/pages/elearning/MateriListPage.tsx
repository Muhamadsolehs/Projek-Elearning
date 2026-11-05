import React, { useState } from 'react';
import { BookOpen, Search, Filter, Plus, ArrowRight } from 'lucide-react';
import { useNavigate } from 'react-router-dom';
import { coursesMock } from '../../data/mockData';
import { useAuth } from '../../context/AuthContext';

export const MateriListPage: React.FC = () => {
  const navigate = useNavigate();
  const { user } = useAuth();
  const [filterKelas, setFilterKelas] = useState('Semua');
  const [searchTerm, setSearchTerm] = useState('');

  const filteredCourses = coursesMock.filter((c) => {
    const matchesKelas = filterKelas === 'Semua' || c.kelas.includes(filterKelas);
    const matchesSearch = c.subjectName.toLowerCase().includes(searchTerm.toLowerCase()) ||
                          c.description.toLowerCase().includes(searchTerm.toLowerCase());
    return matchesKelas && matchesSearch;
  });

  return (
    <div className="space-y-4">
      {/* Header and Controls */}
      <div className="flex flex-col sm:flex-row sm:items-center justify-between gap-3 bg-white p-4 rounded-[18px] border border-[#E6ECF5] shadow-sm">
        <div>
          <h1 className="text-[18px] font-bold text-[#17233F]">Materi & Modul Pembelajaran</h1>
          <p className="text-[12px] text-[#78849A]">Daftar mata pelajaran aktif dan silabus terstruktur.</p>
        </div>

        {/* Filter and Search */}
        <div className="flex items-center gap-2">
          <div className="relative">
            <Search className="w-3.5 h-3.5 absolute left-3 top-2.5 text-[#8C98A9]" />
            <input
              type="text"
              placeholder="Cari mata pelajaran..."
              value={searchTerm}
              onChange={(e) => setSearchTerm(e.target.value)}
              className="pl-8 pr-3 py-1.5 text-[12px] bg-[#F5F8FF] border border-[#E6ECF5] rounded-xl focus:outline-none focus:ring-2 focus:ring-[#1769FF]/20"
            />
          </div>

          <select
            value={filterKelas}
            onChange={(e) => setFilterKelas(e.target.value)}
            className="px-3 py-1.5 text-[12px] bg-[#F5F8FF] border border-[#E6ECF5] rounded-xl text-[#5A6A85] focus:outline-none"
          >
            <option value="Semua">Semua Kelas</option>
            <option value="XII IPA">XII IPA</option>
            <option value="XII RPL">XII RPL</option>
            <option value="XII IPS">XII IPS</option>
          </select>

          {user.role === 'guru' && (
            <button
              type="button"
              className="px-3 py-1.5 rounded-xl bg-[#1769FF] text-white text-[12px] font-bold flex items-center gap-1.5 shadow-sm hover:bg-[#1248D8]"
            >
              <Plus className="w-3.5 h-3.5" />
              <span>Tambah Modul</span>
            </button>
          )}
        </div>
      </div>

      {/* Courses Grid */}
      <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        {filteredCourses.map((course) => (
          <div
            key={course.id}
            onClick={() => navigate(`/pembelajaran/course/${course.id}`)}
            className="bg-white rounded-[20px] p-3.5 border border-[#E6ECF5] shadow-sm hover:shadow-md transition-all cursor-pointer flex flex-col justify-between group"
          >
            <div>
              {/* Thumbnail */}
              <div className="w-full h-32 rounded-[14px] overflow-hidden bg-[#F0F5FD] flex items-center justify-center p-2 relative group-hover:scale-[1.02] transition-transform">
                <img
                  src={course.thumbnail}
                  alt={course.subjectName}
                  className="w-full h-full object-cover rounded-[10px]"
                />
                <span className="absolute top-3 left-3 px-2 py-0.5 rounded-full bg-white/90 backdrop-blur-md text-[10px] font-bold text-[#17233F] shadow-sm">
                  {course.kelas}
                </span>
              </div>

              {/* Title & Teacher */}
              <div className="mt-3">
                <h3 className="text-[14px] font-bold text-[#17233F] group-hover:text-[#1769FF] transition-colors truncate">
                  {course.subjectName}
                </h3>
                <p className="text-[11px] text-[#78849A] mt-0.5">Pengampu: {course.teacherName}</p>
                <p className="text-[11.5px] text-[#5A6A85] mt-1.5 line-clamp-2 leading-snug">
                  {course.description}
                </p>
              </div>
            </div>

            {/* Bottom Progress */}
            <div className="mt-4 pt-3 border-t border-[#F0F4FA]">
              <div className="flex items-center justify-between text-[11px] mb-1">
                <span className="text-[#78849A] font-medium">Progres Belajar</span>
                <span className="font-bold text-[#1769FF]">{course.progress}%</span>
              </div>
              <div className="h-1.5 bg-[#EEF2F6] rounded-full overflow-hidden">
                <div
                  className="h-full rounded-full"
                  style={{ width: `${course.progress}%`, backgroundColor: course.accentColor }}
                />
              </div>
            </div>
          </div>
        ))}
      </div>
    </div>
  );
};

