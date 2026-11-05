import React, { useState } from 'react';
import { 
  ArrowLeft, 
  Save, 
  Plus, 
  Trash2, 
  Image as ImageIcon, 
  HelpCircle, 
  CheckCircle, 
  AlertCircle 
} from 'lucide-react';
import { useNavigate } from 'react-router-dom';

export const QuestionBuilderPage: React.FC = () => {
  const navigate = useNavigate();

  const [questionType, setQuestionType] = useState<string>('single_choice');
  const [questionText, setQuestionText] = useState('');
  const [scoreWeight, setScoreWeight] = useState(2.5);
  const [difficulty, setDifficulty] = useState('Sedang');
  const [explanation, setExplanation] = useState('');

  const [options, setOptions] = useState([
    { key: 'A', text: '', isCorrect: true },
    { key: 'B', text: '', isCorrect: false },
    { key: 'C', text: '', isCorrect: false },
    { key: 'D', text: '', isCorrect: false },
    { key: 'E', text: '', isCorrect: false },
  ]);

  const handleOptionChange = (index: number, text: string) => {
    const updated = [...options];
    updated[index].text = text;
    setOptions(updated);
  };

  const handleSetCorrect = (index: number) => {
    if (questionType === 'single_choice' || questionType === 'true_false') {
      const updated = options.map((opt, i) => ({
        ...opt,
        isCorrect: i === index,
      }));
      setOptions(updated);
    } else {
      const updated = [...options];
      updated[index].isCorrect = !updated[index].isCorrect;
      setOptions(updated);
    }
  };

  const handleSave = (e: React.FormEvent) => {
    e.preventDefault();
    alert('Butir soal berhasil disimpan ke Bank Soal terverifikasi!');
    navigate('/cbt/bank-soal');
  };

  return (
    <div className="space-y-4 max-w-4xl mx-auto">
      {/* Header */}
      <div className="flex items-center justify-between bg-white p-4 rounded-[18px] border border-[#E6ECF5] shadow-sm">
        <div className="flex items-center gap-3">
          <button
            type="button"
            onClick={() => navigate('/cbt/bank-soal')}
            className="p-1.5 rounded-xl border border-[#E6ECF5] hover:bg-[#F8FAFD] text-[#5A6A85]"
          >
            <ArrowLeft className="w-4 h-4" />
          </button>
          <div>
            <h1 className="text-[17px] font-bold text-[#17233F]">Question Builder — CBT EduCore</h1>
            <p className="text-[11.5px] text-[#78849A]">Penyusun butir soal interaktif dengan berbagai tipe evaluasi.</p>
          </div>
        </div>

        <button
          type="button"
          onClick={handleSave}
          className="px-4 py-2 rounded-xl bg-[#1769FF] text-white text-[12px] font-bold flex items-center gap-1.5 shadow-sm hover:bg-[#1248D8] transition-all"
        >
          <Save className="w-4 h-4" />
          <span>Simpan Soal</span>
        </button>
      </div>

      {/* Main Builder Form */}
      <form onSubmit={handleSave} className="space-y-4">
        {/* Settings Card */}
        <div className="bg-white rounded-[20px] p-5 border border-[#E6ECF5] shadow-sm grid grid-cols-1 md:grid-cols-3 gap-4">
          <div>
            <label className="text-[11.5px] font-bold text-[#17233F] block mb-1">
              Bentuk / Tipe Soal
            </label>
            <select
              value={questionType}
              onChange={(e) => setQuestionType(e.target.value)}
              className="w-full p-2.5 text-[12px] bg-[#F5F8FF] border border-[#E6ECF5] rounded-xl font-semibold text-[#17233F]"
            >
              <option value="single_choice">Pilihan Tunggal (PG Standar)</option>
              <option value="multiple_choice">Pilihan Ganda Kompleks (Centang Banyak)</option>
              <option value="true_false">Benar / Salah</option>
              <option value="short_answer">Isian Singkat</option>
              <option value="matching">Menjodohkan (Matching)</option>
              <option value="essay">Uraian / Esai</option>
            </select>
          </div>

          <div>
            <label className="text-[11.5px] font-bold text-[#17233F] block mb-1">
              Bobot Skor Butir
            </label>
            <input
              type="number"
              step="0.5"
              value={scoreWeight}
              onChange={(e) => setScoreWeight(parseFloat(e.target.value))}
              className="w-full p-2 text-[12px] bg-[#F5F8FF] border border-[#E6ECF5] rounded-xl"
            />
          </div>

          <div>
            <label className="text-[11.5px] font-bold text-[#17233F] block mb-1">
              Tingkat Kesulitan
            </label>
            <select
              value={difficulty}
              onChange={(e) => setDifficulty(e.target.value)}
              className="w-full p-2 text-[12px] bg-[#F5F8FF] border border-[#E6ECF5] rounded-xl text-[#17233F]"
            >
              <option value="Mudah">Mudah (LOTS)</option>
              <option value="Sedang">Sedang (MOTS)</option>
              <option value="Tinggi">Tinggi (HOTS)</option>
            </select>
          </div>
        </div>

        {/* Question Text Area */}
        <div className="bg-white rounded-[20px] p-5 border border-[#E6ECF5] shadow-sm space-y-3">
          <div className="flex items-center justify-between">
            <label className="text-[13px] font-bold text-[#17233F]">
              Isi Pertanyaan / Narasi Soal
            </label>
            <button
              type="button"
              className="text-[11px] font-semibold text-[#1769FF] flex items-center gap-1 hover:underline"
            >
              <ImageIcon className="w-3.5 h-3.5" />
              <span>Sisipkan Gambar / Diagram</span>
            </button>
          </div>

          <textarea
            rows={5}
            required
            placeholder="Tuliskan teks pertanyaan soal di sini (mendukung LaTeX KaTeX rumus matematika)..."
            value={questionText}
            onChange={(e) => setQuestionText(e.target.value)}
            className="w-full p-3.5 text-[13px] bg-[#F8FAFD] border border-[#E6ECF5] rounded-xl focus:outline-none focus:ring-2 focus:ring-[#1769FF]/20"
          />
        </div>

        {/* Answer Options for Choice Types */}
        {(questionType === 'single_choice' || questionType === 'multiple_choice' || questionType === 'true_false') && (
          <div className="bg-white rounded-[20px] p-5 border border-[#E6ECF5] shadow-sm space-y-3">
            <div className="flex items-center justify-between">
              <label className="text-[13px] font-bold text-[#17233F]">
                Opsi Pilihan Jawaban & Kunci
              </label>
              <span className="text-[11px] text-[#78849A]">
                {questionType === 'single_choice'
                  ? 'Pilih 1 tombol radio sebagai kunci jawaban benar'
                  : 'Centang semua opsi yang merupakan jawaban benar'}
              </span>
            </div>

            <div className="space-y-2.5">
              {options.map((opt, idx) => (
                <div
                  key={opt.key}
                  className={`flex items-center gap-3 p-2.5 rounded-xl border transition-all ${
                    opt.isCorrect
                      ? 'border-emerald-300 bg-emerald-50/30'
                      : 'border-[#E6ECF5] bg-white'
                  }`}
                >
                  <button
                    type="button"
                    onClick={() => handleSetCorrect(idx)}
                    className={`w-7 h-7 rounded-lg flex items-center justify-center font-bold text-[12px] transition-all ${
                      opt.isCorrect
                        ? 'bg-emerald-500 text-white shadow-sm'
                        : 'bg-[#F0F4FA] text-[#78849A] hover:bg-slate-200'
                    }`}
                  >
                    {opt.key}
                  </button>

                  <input
                    type="text"
                    required
                    placeholder={`Teks opsi jawaban ${opt.key}...`}
                    value={opt.text}
                    onChange={(e) => handleOptionChange(idx, e.target.value)}
                    className="flex-1 p-2 text-[12.5px] bg-transparent focus:outline-none"
                  />

                  {opt.isCorrect && (
                    <span className="px-2.5 py-0.5 rounded-full bg-emerald-100 text-emerald-700 text-[10px] font-bold flex items-center gap-1">
                      <CheckCircle className="w-3 h-3" /> Kunci Jawaban
                    </span>
                  )}
                </div>
              ))}
            </div>
          </div>
        )}

        {/* Essay Rubric */}
        {questionType === 'essay' && (
          <div className="bg-white rounded-[20px] p-5 border border-[#E6ECF5] shadow-sm space-y-2">
            <label className="text-[13px] font-bold text-[#17233F]">
              Pedoman Penskoran & Rubrik Penilaian Esai
            </label>
            <p className="text-[11px] text-[#78849A]">
              Tuliskan kata kunci wajib dan kriteria penilaian agar guru pengoreksi memiliki acuan seragam.
            </p>
            <textarea
              rows={3}
              placeholder="Contoh: Siswa wajib menyebutkan konsep limit tak hingga dan sifat kontinuitas (masing-masing 5 poin)..."
              className="w-full p-3 text-[12px] bg-[#F8FAFD] border border-[#E6ECF5] rounded-xl"
            />
          </div>
        )}

        {/* Pembahasan Soal */}
        <div className="bg-white rounded-[20px] p-5 border border-[#E6ECF5] shadow-sm space-y-2">
          <label className="text-[13px] font-bold text-[#17233F]">
            Pembahasan & Solusi Langkah Pengerjaan
          </label>
          <p className="text-[11px] text-[#78849A]">
            Hanya ditampilkan kepada siswa setelah periode ujian dinyatakan selesai dan dipublikasikan.
          </p>
          <textarea
            rows={3}
            placeholder="Tuliskan pembahasan lengkap langkah penyelesaian..."
            value={explanation}
            onChange={(e) => setExplanation(e.target.value)}
            className="w-full p-3 text-[12px] bg-[#F8FAFD] border border-[#E6ECF5] rounded-xl"
          />
        </div>
      </form>
    </div>
  );
};

