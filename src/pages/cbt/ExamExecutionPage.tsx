import React, { useState, useEffect } from 'react';
import { 
  Clock, 
  CheckCircle2, 
  HelpCircle, 
  ChevronLeft, 
  ChevronRight, 
  AlertTriangle, 
  Flag, 
  Check, 
  Lock, 
  Send,
  X
} from 'lucide-react';
import { useNavigate, useParams } from 'react-router-dom';
import { useAuth } from '../../context/AuthContext';
import { cbtQuestionsMock } from '../../data/mockData';
import { Question } from '../../types';

export const ExamExecutionPage: React.FC = () => {
  const navigate = useNavigate();
  const { user } = useAuth();
  const { id } = useParams();

  // 90 minutes countdown timer (5400 seconds)
  const [secondsLeft, setSecondsLeft] = useState(5384);
  const [currentIdx, setCurrentIdx] = useState(0);

  // Student's answer state: questionId -> answer
  const [answers, setAnswers] = useState<Record<number, string>>({
    1: 'B', // sample pre-filled answer
  });

  // Marked for review (ragu-ragu) state: questionId -> boolean
  const [markedReview, setMarkedReview] = useState<Record<number, boolean>>({});

  // Auto-save feedback state
  const [saveStatus, setSaveStatus] = useState<'saved' | 'saving'>('saved');

  // Confirmation modal
  const [showSubmitModal, setShowSubmitModal] = useState(false);

  // Timer countdown hook
  useEffect(() => {
    const timer = setInterval(() => {
      setSecondsLeft((prev) => {
        if (prev <= 1) {
          clearInterval(timer);
          handleSubmitExam();
          return 0;
        }
        return prev - 1;
      });
    }, 1000);
    return () => clearInterval(timer);
  }, []);

  const formatTime = (secs: number) => {
    const h = Math.floor(secs / 3600);
    const m = Math.floor((secs % 3600) / 60);
    const s = secs % 60;
    return `${h.toString().padStart(2, '0')}:${m.toString().padStart(2, '0')}:${s.toString().padStart(2, '0')}`;
  };

  const currentQuestion: Question = cbtQuestionsMock[currentIdx];

  const handleSelectAnswer = (optionKey: string) => {
    setSaveStatus('saving');
    setAnswers((prev) => ({
      ...prev,
      [currentQuestion.id]: optionKey,
    }));
    setTimeout(() => {
      setSaveStatus('saved');
    }, 400);
  };

  const handleToggleReview = () => {
    setMarkedReview((prev) => ({
      ...prev,
      [currentQuestion.id]: !prev[currentQuestion.id],
    }));
  };

  const handleSubmitExam = () => {
    setShowSubmitModal(false);
    alert('Ujian CBT berhasil diselesaikan! Hasil Anda akan diproses oleh sistem.');
    navigate('/cbt/hasil');
  };

  // Summary counts
  const totalQuestions = cbtQuestionsMock.length;
  const answeredCount = Object.keys(answers).length;
  const reviewCount = Object.values(markedReview).filter(Boolean).length;
  const unansweredCount = totalQuestions - answeredCount;

  return (
    <div className="min-h-screen bg-[#EAF2FF] flex flex-col justify-between p-3 sm:p-4 select-none">
      {/* CBT Dedicated Distraction-Free Header */}
      <header className="bg-white rounded-[20px] px-5 py-3.5 border border-[#E6ECF5] shadow-sm flex items-center justify-between mb-3">
        <div className="flex items-center gap-3">
          <div className="w-9 h-9 rounded-xl bg-[#1769FF] text-white flex items-center justify-center font-bold text-[15px]">
            CBT
          </div>
          <div>
            <h1 className="text-[14px] font-bold text-[#17233F]">
              Ujian Tengah Semester — Matematika XII IPA
            </h1>
            <p className="text-[11px] text-[#78849A]">
              Peserta: <span className="font-semibold text-[#17233F]">{user.name}</span> ({user.nisn || 'NISN: 0054238910'})
            </p>
          </div>
        </div>

        {/* Live Timer and Auto-save indicator */}
        <div className="flex items-center gap-4">
          {/* Auto-save status */}
          <div className="hidden sm:flex items-center gap-1.5 text-[11px]">
            {saveStatus === 'saving' ? (
              <span className="text-amber-600 flex items-center gap-1 animate-pulse">
                <span className="w-2 h-2 rounded-full bg-amber-500"></span>
                Menyimpan...
              </span>
            ) : (
              <span className="text-emerald-600 flex items-center gap-1 font-semibold">
                <Check className="w-3.5 h-3.5 stroke-[2.5]" />
                Tersimpan di server
              </span>
            )}
          </div>

          {/* Countdown Clock */}
          <div className={`flex items-center gap-2 px-4 py-2 rounded-2xl border font-bold text-[14px] ${
            secondsLeft < 300 
              ? 'bg-rose-50 text-rose-600 border-rose-200 animate-pulse' 
              : 'bg-[#EEF4FF] text-[#1769FF] border-[#DCEBFF]'
          }`}>
            <Clock className="w-4 h-4" />
            <span>{formatTime(secondsLeft)}</span>
          </div>

          {/* Submit Test Button */}
          <button
            type="button"
            onClick={() => setShowSubmitModal(true)}
            className="px-4 py-2 rounded-xl bg-emerald-600 text-white text-[12px] font-bold shadow-sm hover:bg-emerald-700 transition-all flex items-center gap-1.5"
          >
            <Lock className="w-3.5 h-3.5" />
            <span>Akhiri Ujian</span>
          </button>
        </div>
      </header>

      {/* Main CBT Workspace: Question on Left, Question Palette on Right */}
      <div className="grid grid-cols-1 lg:grid-cols-12 gap-3.5 flex-1 items-start">
        {/* Left: Active Question Card (8 cols) */}
        <div className="lg:col-span-8 bg-white rounded-[22px] p-5 sm:p-6 border border-[#E6ECF5] shadow-sm flex flex-col justify-between min-h-[500px]">
          <div className="space-y-4">
            {/* Question Header & Weight */}
            <div className="flex items-center justify-between border-b border-[#F0F4FA] pb-3">
              <div className="flex items-center gap-2">
                <span className="px-3 py-1 rounded-xl bg-[#1769FF] text-white font-bold text-[13px]">
                  Soal No. {currentQuestion.number}
                </span>
                <span className="text-[11.5px] text-[#78849A] font-semibold">
                  Tipe: {currentQuestion.type === 'single_choice' ? 'Pilihan Ganda' : 'Uraian'}
                </span>
              </div>
              <span className="text-[11.5px] font-bold text-[#1769FF] bg-[#EAF2FF] px-2.5 py-0.5 rounded-full">
                Bobot: {currentQuestion.scoreWeight} Poin
              </span>
            </div>

            {/* Question Text */}
            <div className="text-[14px] sm:text-[15px] font-medium text-[#17233F] leading-relaxed pt-1">
              {currentQuestion.text}
            </div>

            {/* Options List */}
            {currentQuestion.options && (
              <div className="space-y-2.5 pt-3">
                {currentQuestion.options.map((opt) => {
                  const isSelected = answers[currentQuestion.id] === opt.key;
                  return (
                    <div
                      key={opt.key}
                      onClick={() => handleSelectAnswer(opt.key)}
                      className={`
                        flex items-center gap-3.5 p-3.5 rounded-2xl border transition-all cursor-pointer
                        ${
                          isSelected
                            ? 'border-[#1769FF] bg-[#EEF4FF] shadow-sm'
                            : 'border-[#E6ECF5] bg-white hover:bg-[#F8FAFD] hover:border-[#CBD5E1]'
                        }
                      `}
                    >
                      <div
                        className={`w-8 h-8 rounded-xl flex items-center justify-center font-bold text-[13px] transition-all ${
                          isSelected
                            ? 'bg-[#1769FF] text-white'
                            : 'bg-[#F0F4FA] text-[#5A6A85]'
                        }`}
                      >
                        {opt.key}
                      </div>
                      <span className="text-[13.5px] text-[#17233F] font-medium">
                        {opt.text}
                      </span>
                    </div>
                  );
                })}
              </div>
            )}

            {/* Essay Input */}
            {currentQuestion.type === 'essay' && (
              <div className="pt-2">
                <textarea
                  rows={6}
                  placeholder="Ketikkan uraian jawaban Anda secara terstruktur di sini..."
                  value={answers[currentQuestion.id] || ''}
                  onChange={(e) => {
                    setSaveStatus('saving');
                    setAnswers((prev) => ({
                      ...prev,
                      [currentQuestion.id]: e.target.value,
                    }));
                    setTimeout(() => setSaveStatus('saved'), 400);
                  }}
                  className="w-full p-4 text-[13px] bg-[#F8FAFD] border border-[#E6ECF5] rounded-2xl focus:outline-none focus:ring-2 focus:ring-[#1769FF]/20"
                />
              </div>
            )}
          </div>

          {/* Bottom Question Controls */}
          <div className="mt-8 pt-4 border-t border-[#F0F4FA] flex flex-wrap items-center justify-between gap-3">
            <button
              type="button"
              disabled={currentIdx === 0}
              onClick={() => setCurrentIdx((prev) => Math.max(0, prev - 1))}
              className={`px-4 py-2 rounded-xl text-[12px] font-bold flex items-center gap-1.5 transition-all ${
                currentIdx === 0
                  ? 'bg-slate-100 text-slate-400 cursor-not-allowed'
                  : 'bg-white border border-[#E6ECF5] text-[#5A6A85] hover:bg-[#F5F8FF]'
              }`}
            >
              <ChevronLeft className="w-4 h-4" />
              <span>Sebelumnya</span>
            </button>

            {/* Mark Review Toggle */}
            <button
              type="button"
              onClick={handleToggleReview}
              className={`px-4 py-2 rounded-xl text-[12px] font-bold flex items-center gap-1.5 transition-all ${
                markedReview[currentQuestion.id]
                  ? 'bg-amber-400 text-amber-950 shadow-sm'
                  : 'bg-amber-50 text-amber-700 hover:bg-amber-100'
              }`}
            >
              <Flag className="w-3.5 h-3.5" />
              <span>
                {markedReview[currentQuestion.id] ? 'Tandai Ragu-ragu (Aktif)' : 'Ragu-ragu'}
              </span>
            </button>

            <button
              type="button"
              disabled={currentIdx === cbtQuestionsMock.length - 1}
              onClick={() => setCurrentIdx((prev) => Math.min(cbtQuestionsMock.length - 1, prev + 1))}
              className={`px-4 py-2 rounded-xl text-[12px] font-bold flex items-center gap-1.5 transition-all ${
                currentIdx === cbtQuestionsMock.length - 1
                  ? 'bg-slate-100 text-slate-400 cursor-not-allowed'
                  : 'bg-[#1769FF] text-white hover:bg-[#1248D8] shadow-sm'
              }`}
            >
              <span>Selanjutnya</span>
              <ChevronRight className="w-4 h-4" />
            </button>
          </div>
        </div>

        {/* Right: Question Navigation Palette (4 cols) */}
        <div className="lg:col-span-4 bg-white rounded-[22px] p-5 border border-[#E6ECF5] shadow-sm space-y-4">
          <div className="flex items-center justify-between border-b border-[#F0F4FA] pb-3">
            <h3 className="text-[13.5px] font-bold text-[#17233F]">Nomor Soal Ujian</h3>
            <span className="text-[11.5px] font-semibold text-[#1769FF]">
              {answeredCount}/{totalQuestions} Terjawab
            </span>
          </div>

          {/* Color Legend */}
          <div className="grid grid-cols-2 gap-2 text-[10.5px] text-[#5A6A85] bg-[#F8FAFD] p-2.5 rounded-xl">
            <div className="flex items-center gap-1.5">
              <span className="w-3.5 h-3.5 rounded-md bg-emerald-500"></span>
              <span>Sudah Dijawab ({answeredCount})</span>
            </div>
            <div className="flex items-center gap-1.5">
              <span className="w-3.5 h-3.5 rounded-md bg-amber-400"></span>
              <span>Ragu-ragu ({reviewCount})</span>
            </div>
            <div className="flex items-center gap-1.5">
              <span className="w-3.5 h-3.5 rounded-md bg-slate-100 border border-slate-300"></span>
              <span>Belum Dijawab ({unansweredCount})</span>
            </div>
            <div className="flex items-center gap-1.5">
              <span className="w-3.5 h-3.5 rounded-md ring-2 ring-[#1769FF] bg-blue-100"></span>
              <span>Sedang Dibuka</span>
            </div>
          </div>

          {/* Question Grid Buttons */}
          <div className="grid grid-cols-5 gap-2 pt-1">
            {cbtQuestionsMock.map((q, idx) => {
              const isCurrent = idx === currentIdx;
              const hasAnswer = answers[q.id] !== undefined && answers[q.id] !== '';
              const isReview = markedReview[q.id] === true;

              let btnStyle = 'bg-slate-100 text-slate-700 hover:bg-slate-200';
              if (isReview) {
                btnStyle = 'bg-amber-400 text-amber-950 font-bold';
              } else if (hasAnswer) {
                btnStyle = 'bg-emerald-500 text-white font-bold shadow-sm';
              }

              return (
                <button
                  key={q.id}
                  type="button"
                  onClick={() => setCurrentIdx(idx)}
                  className={`
                    h-10 rounded-xl flex items-center justify-center text-[13px] transition-all relative
                    ${btnStyle}
                    ${isCurrent ? 'ring-2 ring-[#1769FF] ring-offset-2 scale-105 z-10' : ''}
                  `}
                >
                  {q.number}
                </button>
              );
            })}
          </div>

          {/* Final Submit shortcut */}
          <div className="pt-4 border-t border-[#F0F4FA]">
            <button
              type="button"
              onClick={() => setShowSubmitModal(true)}
              className="w-full py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-[12.5px] font-bold shadow-sm flex items-center justify-center gap-2 transition-all"
            >
              <Send className="w-4 h-4" />
              <span>Selesaikan & Kirim Ujian</span>
            </button>
          </div>
        </div>
      </div>

      {/* Confirmation Submit Dialog Modal */}
      {showSubmitModal && (
        <div className="fixed inset-0 bg-slate-900/50 backdrop-blur-sm z-50 flex items-center justify-center p-4">
          <div className="bg-white rounded-[24px] max-w-md w-full p-6 shadow-2xl border border-[#E6ECF5] space-y-4 animate-in fade-in zoom-in-95 duration-150">
            <div className="w-12 h-12 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center mx-auto">
              <AlertTriangle className="w-6 h-6 stroke-[2.2]" />
            </div>

            <div className="text-center">
              <h3 className="text-[17px] font-bold text-[#17233F]">
                Konfirmasi Penyelesaian Ujian
              </h3>
              <p className="text-[12px] text-[#78849A] mt-1">
                Apakah Anda yakin ingin mengakhiri sesi pengerjaan ujian ini? Jawaban Anda akan dikunci permanen di server.
              </p>
            </div>

            {/* Summary statistics inside modal */}
            <div className="bg-[#F8FAFD] rounded-2xl p-3.5 border border-[#E6ECF5] grid grid-cols-3 gap-2 text-center text-[12px]">
              <div>
                <span className="text-[#78849A] block text-[10.5px]">Terjawab</span>
                <span className="font-extrabold text-emerald-600 text-[16px]">{answeredCount}</span>
              </div>
              <div>
                <span className="text-[#78849A] block text-[10.5px]">Ragu-ragu</span>
                <span className="font-extrabold text-amber-600 text-[16px]">{reviewCount}</span>
              </div>
              <div>
                <span className="text-[#78849A] block text-[10.5px]">Belum Dijawab</span>
                <span className="font-extrabold text-rose-600 text-[16px]">{unansweredCount}</span>
              </div>
            </div>

            {unansweredCount > 0 && (
              <p className="text-[11px] text-rose-500 font-semibold text-center">
                Peringatan: Masih terdapat {unansweredCount} butir soal yang belum Anda isi!
              </p>
            )}

            <div className="flex items-center gap-2 pt-2">
              <button
                type="button"
                onClick={() => setShowSubmitModal(false)}
                className="flex-1 py-2.5 rounded-xl text-[12px] font-bold text-[#5A6A85] bg-slate-100 hover:bg-slate-200 transition-colors"
              >
                Kembali Mengerjakan
              </button>
              <button
                type="button"
                onClick={handleSubmitExam}
                className="flex-1 py-2.5 rounded-xl text-[12px] font-bold text-white bg-emerald-600 hover:bg-emerald-700 shadow-md transition-all"
              >
                Ya, Kumpulkan Jawaban
              </button>
            </div>
          </div>
        </div>
      )}
    </div>
  );
};

