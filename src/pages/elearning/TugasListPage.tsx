import React, { useState } from 'react';
import { 
  CheckSquare, 
  FileText, 
  Table, 
  Code, 
  Calendar, 
  Clock, 
  Upload, 
  CheckCircle2, 
  AlertCircle,
  X
} from 'lucide-react';
import { upcomingAssignmentsMock } from '../../data/mockData';
import { Assignment } from '../../types';

export const TugasListPage: React.FC = () => {
  const [assignments, setAssignments] = useState<Assignment[]>([
    ...upcomingAssignmentsMock,
    {
      id: 'asg_04',
      courseId: 'crs_math_12',
      subjectName: 'Matematika',
      kelas: 'XII IPA',
      title: 'Kuis Matriks & Transformasi Geometri',
      deadline: '2025-11-01T23:59:00',
      deadlineFormatted: '01 Nov 2025',
      daysLeft: 0,
      urgency: 'normal',
      badgeColor: 'blue',
      status: 'selesai',
      grade: 95,
      feedback: 'Pengerjaan sangat rapi dan metode determinan tepat.',
      iconType: 'document',
    },
    {
      id: 'asg_05',
      courseId: 'crs_indo_12',
      subjectName: 'Bahasa Indonesia',
      kelas: 'XII IPS',
      title: 'Esai Kritik Sastra Angkatan 45',
      deadline: '2025-11-04T23:59:00',
      deadlineFormatted: '04 Nov 2025',
      daysLeft: 0,
      urgency: 'normal',
      badgeColor: 'purple',
      status: 'menunggu_penilaian',
      iconType: 'document',
    },
  ]);

  const [filterStatus, setFilterStatus] = useState<string>('semua');
  const [selectedTask, setSelectedTask] = useState<Assignment | null>(null);
  const [uploadedFile, setUploadedFile] = useState<string | null>(null);

  const filteredTasks = assignments.filter((t) => {
    if (filterStatus === 'semua') return true;
    return t.status === filterStatus;
  });

  const handleSubmitTask = () => {
    if (!selectedTask) return;
    setAssignments((prev) =>
      prev.map((t) =>
        t.id === selectedTask.id
          ? { ...t, status: 'menunggu_penilaian' }
          : t
      )
    );
    setSelectedTask(null);
    setUploadedFile(null);
    alert('Tugas Anda berhasil diunggah dan disimpan ke sistem!');
  };

  return (
    <div className="space-y-4">
      {/* Header */}
      <div className="bg-white p-4 rounded-[18px] border border-[#E6ECF5] shadow-sm flex flex-col sm:flex-row sm:items-center justify-between gap-3">
        <div>
          <h1 className="text-[18px] font-bold text-[#17233F]">Manajemen & Pengumpulan Tugas</h1>
          <p className="text-[12px] text-[#78849A]">Pantau deadline tugas aktif, kirimkan berkas, dan lihat nilai feedback.</p>
        </div>

        {/* Status Filters */}
        <div className="flex items-center gap-1.5 overflow-x-auto pb-1 sm:pb-0">
          {[
            { key: 'semua', label: 'Semua Tugas' },
            { key: 'belum_dikumpulkan', label: 'Belum Selesai' },
            { key: 'menunggu_penilaian', label: 'Menunggu Nilai' },
            { key: 'selesai', label: 'Dinilai' },
          ].map((tab) => (
            <button
              key={tab.key}
              type="button"
              onClick={() => setFilterStatus(tab.key)}
              className={`
                px-3 py-1.5 rounded-xl text-[11.5px] font-bold transition-all whitespace-nowrap
                ${filterStatus === tab.key
                  ? 'bg-[#1769FF] text-white shadow-sm'
                  : 'bg-[#F5F8FF] text-[#5A6A85] hover:bg-[#EEF4FF]'
                }
              `}
            >
              {tab.label}
            </button>
          ))}
        </div>
      </div>

      {/* Task Cards Grid */}
      <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3.5">
        {filteredTasks.map((task) => (
          <div
            key={task.id}
            className="bg-white rounded-[18px] p-4 border border-[#E6ECF5] shadow-sm hover:shadow-md transition-all flex flex-col justify-between"
          >
            <div>
              <div className="flex items-start justify-between gap-2">
                <span className="px-2.5 py-0.5 rounded-full bg-[#EAF2FF] text-[#1769FF] font-bold text-[10.5px]">
                  {task.subjectName} ({task.kelas})
                </span>

                {task.status === 'selesai' && (
                  <span className="px-2 py-0.5 rounded-full bg-emerald-100 text-emerald-700 text-[10px] font-bold flex items-center gap-1">
                    <CheckCircle2 className="w-3 h-3" /> Nilai: {task.grade}
                  </span>
                )}
                {task.status === 'menunggu_penilaian' && (
                  <span className="px-2 py-0.5 rounded-full bg-amber-100 text-amber-700 text-[10px] font-bold">
                    Menunggu Koreksi
                  </span>
                )}
                {task.status === 'belum_dikumpulkan' && (
                  <span className="px-2 py-0.5 rounded-full bg-rose-100 text-rose-600 text-[10px] font-bold flex items-center gap-1">
                    <Clock className="w-3 h-3" /> {task.daysLeft} hari lagi
                  </span>
                )}
              </div>

              <h3 className="text-[14px] font-bold text-[#17233F] mt-2.5 leading-snug">
                {task.title}
              </h3>
              <p className="text-[11.5px] text-[#78849A] mt-1 flex items-center gap-1">
                <Calendar className="w-3 h-3" /> Tenggat: {task.deadlineFormatted}
              </p>

              {task.feedback && (
                <div className="mt-2.5 p-2 rounded-xl bg-emerald-50 border border-emerald-100 text-[11px] text-emerald-800">
                  <span className="font-bold">Catatan Guru:</span> {task.feedback}
                </div>
              )}
            </div>

            <div className="mt-4 pt-3 border-t border-[#F0F4FA] flex items-center justify-between">
              <span className="text-[11px] text-[#78849A]">
                Format: PDF / ZIP / Dokumen
              </span>

              {task.status === 'belum_dikumpulkan' ? (
                <button
                  type="button"
                  onClick={() => setSelectedTask(task)}
                  className="px-3 py-1.5 rounded-xl bg-[#1769FF] text-white text-[11.5px] font-bold hover:bg-[#1248D8] transition-all flex items-center gap-1 shadow-sm"
                >
                  <Upload className="w-3 h-3" />
                  <span>Kirim Jawaban</span>
                </button>
              ) : (
                <button
                  type="button"
                  onClick={() => alert(`Detail pengumpulan: ${task.title}`)}
                  className="px-3 py-1.5 rounded-xl bg-[#F5F8FF] text-[#1769FF] text-[11.5px] font-bold hover:bg-[#EAF2FF] transition-all"
                >
                  Lihat Berkas
                </button>
              )}
            </div>
          </div>
        ))}
      </div>

      {/* Submission Modal */}
      {selectedTask && (
        <div className="fixed inset-0 bg-slate-900/40 backdrop-blur-sm z-50 flex items-center justify-center p-4">
          <div className="bg-white rounded-[24px] max-w-md w-full p-5 shadow-2xl border border-[#E6ECF5] space-y-4 animate-in fade-in zoom-in-95 duration-150">
            <div className="flex items-center justify-between border-b border-[#F0F4FA] pb-3">
              <div>
                <h3 className="text-[15px] font-bold text-[#17233F]">Pengumpulan Tugas Siswa</h3>
                <p className="text-[11px] text-[#78849A]">{selectedTask.subjectName} • {selectedTask.title}</p>
              </div>
              <button
                type="button"
                onClick={() => setSelectedTask(null)}
                className="p-1 rounded-lg hover:bg-slate-100 text-[#78849A]"
              >
                <X className="w-4 h-4" />
              </button>
            </div>

            <div className="space-y-3">
              <div>
                <label className="text-[11.5px] font-bold text-[#17233F] block mb-1">
                  Catatan atau Tautan Tambahan (Opsional)
                </label>
                <textarea
                  rows={2}
                  placeholder="Tuliskan catatan untuk guru pengampu..."
                  className="w-full p-2.5 text-[12px] bg-[#F5F8FF] border border-[#E6ECF5] rounded-xl focus:outline-none focus:ring-2 focus:ring-[#1769FF]/20"
                />
              </div>

              <div>
                <label className="text-[11.5px] font-bold text-[#17233F] block mb-1">
                  Unggah Berkas Tugas (Maks. 25MB)
                </label>
                <div
                  onClick={() => setUploadedFile('Tugas_Analisis_Muhamad_Soleh.pdf')}
                  className="border-2 border-dashed border-[#CBD5E1] rounded-2xl p-5 text-center cursor-pointer hover:border-[#1769FF] hover:bg-blue-50/50 transition-all"
                >
                  <Upload className="w-8 h-8 mx-auto text-[#1769FF] stroke-[2]" />
                  <p className="text-[12px] font-bold text-[#17233F] mt-2">
                    {uploadedFile || 'Klik atau geser file ke sini'}
                  </p>
                  <p className="text-[10.5px] text-[#8C98A9]">Mendukung PDF, DOCX, XLSX, ZIP</p>
                </div>
              </div>
            </div>

            <div className="flex items-center justify-end gap-2 pt-2 border-t border-[#F0F4FA]">
              <button
                type="button"
                onClick={() => setSelectedTask(null)}
                className="px-4 py-2 rounded-xl text-[12px] font-semibold text-[#5A6A85] hover:bg-slate-100"
              >
                Batal
              </button>
              <button
                type="button"
                onClick={handleSubmitTask}
                className="px-5 py-2 rounded-xl bg-[#1769FF] text-white text-[12px] font-bold shadow-sm hover:bg-[#1248D8]"
              >
                Kirim Sekarang
              </button>
            </div>
          </div>
        </div>
      )}
    </div>
  );
};

