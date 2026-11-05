import React, { useState } from 'react';
import { 
  BookOpen, 
  FileText, 
  CheckCircle2, 
  PlayCircle, 
  ArrowLeft, 
  Download, 
  Clock, 
  Award,
  ChevronRight,
  Share2
} from 'lucide-react';
import { useParams, useNavigate } from 'react-router-dom';
import { coursesMock } from '../../data/mockData';

export const CourseDetailPage: React.FC = () => {
  const { id } = useParams();
  const navigate = useNavigate();
  const course = coursesMock.find(c => c.id === id) || coursesMock[0];

  const [activeTab, setActiveTab] = useState<'materi' | 'tugas' | 'diskusi' | 'informasi'>('materi');

  const chapters = [
    {
      title: 'Bab 1: Pengantar dan Konsep Dasar',
      lessons: [
        { id: 'les_01', title: '1.1 Definisi dan Teorema Fundamental', duration: '25 Menit', completed: true },
        { id: 'les_02', title: '1.2 Contoh Kasus dan Pemodelan Matematika', duration: '40 Menit', completed: true },
        { id: 'les_03', title: '1.3 Lembar Kerja Siswa & Diskusi Kelompok', duration: '30 Menit', completed: true },
      ],
    },
    {
      title: 'Bab 2: Pendalaman Materi dan Aplikasi Nyata',
      lessons: [
        { id: 'les_04', title: '2.1 Turunan Fungsi dan Sifat Kritis', duration: '45 Menit', completed: true },
        { id: 'les_05', title: '2.2 Optimasi Maksimum dan Minimum', duration: '50 Menit', completed: false },
        { id: 'les_06', title: '2.3 Studi Kasus Fisika & Teknik', duration: '35 Menit', completed: false },
      ],
    },
    {
      title: 'Bab 3: Evaluasi dan Persiapan Ujian',
      lessons: [
        { id: 'les_07', title: '3.1 Pembahasan Latihan Soal Mandiri', duration: '40 Menit', completed: false },
        { id: 'les_08', title: '3.2 Tryout Singkat dan Penilaian Formatif', duration: '45 Menit', completed: false },
      ],
    },
  ];

  return (
    <div className="space-y-4">
      {/* Back button & Breadcrumb */}
      <div className="flex items-center gap-2">
        <button
          type="button"
          onClick={() => navigate('/pembelajaran/materi')}
          className="p-1.5 rounded-xl bg-white border border-[#E6ECF5] text-[#5A6A85] hover:text-[#1769FF] transition-colors"
        >
          <ArrowLeft className="w-4 h-4" />
        </button>
        <span className="text-[12px] text-[#78849A]">Pembelajaran</span>
        <ChevronRight className="w-3 h-3 text-[#78849A]" />
        <span className="text-[12px] text-[#17233F] font-bold">{course.subjectName} ({course.kelas})</span>
      </div>

      {/* Course Banner */}
      <div className="rounded-[20px] bg-gradient-to-r from-[#1769FF] via-[#1E70FF] to-[#3B82F6] text-white p-5 lg:p-6 shadow-md flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div className="space-y-1.5 max-w-xl">
          <span className="px-2.5 py-0.5 rounded-full bg-white/20 text-[10.5px] font-bold uppercase tracking-wider">
            {course.kelas} • Kurikulum Merdeka
          </span>
          <h1 className="text-[22px] font-bold tracking-tight">{course.subjectName}</h1>
          <p className="text-[12.5px] text-white/90 leading-relaxed">
            {course.description}
          </p>
          <div className="flex items-center gap-3 pt-1 text-[11.5px] text-white/90">
            <span className="font-semibold">Pengampu: {course.teacherName}</span>
            <span>•</span>
            <span>36 Siswa Terdaftar</span>
          </div>
        </div>

        {/* Progress badge */}
        <div className="bg-white/10 backdrop-blur-md rounded-2xl p-4 border border-white/20 text-center min-w-[150px]">
          <span className="text-[11px] text-white/80 font-medium">Capaian Anda</span>
          <div className="text-[28px] font-extrabold text-white my-0.5">{course.progress}%</div>
          <div className="w-full h-1.5 bg-white/20 rounded-full overflow-hidden mt-1">
            <div className="h-full bg-white rounded-full" style={{ width: `${course.progress}%` }} />
          </div>
        </div>
      </div>

      {/* Tabs */}
      <div className="flex items-center gap-2 border-b border-[#E6ECF5] pb-1">
        {[
          { key: 'materi', label: 'Materi Pembelajaran' },
          { key: 'tugas', label: 'Tugas & Praktikum' },
          { key: 'diskusi', label: 'Forum Diskusi Kelas' },
          { key: 'informasi', label: 'Silabus & Informasi' },
        ].map((tab) => (
          <button
            key={tab.key}
            type="button"
            onClick={() => setActiveTab(tab.key as any)}
            className={`
              px-4 py-2 text-[12.5px] font-bold rounded-xl transition-all
              ${activeTab === tab.key 
                ? 'bg-[#EAF2FF] text-[#1769FF]' 
                : 'text-[#78849A] hover:text-[#17233F]'
              }
            `}
          >
            {tab.label}
          </button>
        ))}
      </div>

      {/* Chapter & Lesson List */}
      <div className="space-y-3">
        {chapters.map((chapter, cIdx) => (
          <div key={cIdx} className="bg-white rounded-[18px] border border-[#E6ECF5] overflow-hidden shadow-sm">
            <div className="bg-[#F8FAFD] px-4 py-3 border-b border-[#E6ECF5] flex items-center justify-between">
              <h3 className="text-[13px] font-bold text-[#17233F]">{chapter.title}</h3>
              <span className="text-[11px] text-[#78849A] font-semibold">{chapter.lessons.length} Topik</span>
            </div>

            <div className="divide-y divide-[#F0F4FA]">
              {chapter.lessons.map((lesson) => (
                <div
                  key={lesson.id}
                  className="px-4 py-3 flex items-center justify-between hover:bg-[#F8FAFD] transition-colors cursor-pointer group"
                  onClick={() => alert(`Membuka modul: ${lesson.title}`)}
                >
                  <div className="flex items-center gap-3">
                    <div className={`w-8 h-8 rounded-xl flex items-center justify-center ${lesson.completed ? 'bg-emerald-50 text-emerald-600' : 'bg-blue-50 text-[#1769FF]'}`}>
                      {lesson.completed ? (
                        <CheckCircle2 className="w-4 h-4 stroke-[2.5]" />
                      ) : (
                        <PlayCircle className="w-4 h-4 stroke-[2.2]" />
                      )}
                    </div>
                    <div>
                      <h4 className="text-[12.5px] font-bold text-[#17233F] group-hover:text-[#1769FF] transition-colors">
                        {lesson.title}
                      </h4>
                      <p className="text-[10.5px] text-[#78849A] flex items-center gap-1.5 mt-0.5">
                        <Clock className="w-3 h-3" />
                        <span>Estimasi: {lesson.duration}</span>
                        {lesson.completed && (
                          <span className="text-emerald-600 font-semibold">• Selesai Dipelajari</span>
                        )}
                      </p>
                    </div>
                  </div>

                  <button
                    type="button"
                    className="px-3 py-1 rounded-lg bg-[#EAF2FF] text-[#1769FF] text-[11px] font-bold hover:bg-[#1769FF] hover:text-white transition-all"
                  >
                    Buka Modul
                  </button>
                </div>
              ))}
            </div>
          </div>
        ))}
      </div>
    </div>
  );
};

