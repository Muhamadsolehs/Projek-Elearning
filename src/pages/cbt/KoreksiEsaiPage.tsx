import React, { useState } from 'react';
import { 
  FileCheck2, 
  Search, 
  Check, 
  Save, 
  ArrowLeft, 
  User, 
  Award,
  ChevronRight
} from 'lucide-react';
import { useNavigate } from 'react-router-dom';

export const KoreksiEsaiPage: React.FC = () => {
  const navigate = useNavigate();

  const [scores, setScores] = useState<Record<string, number>>({
    sub_1: 8.5,
    sub_2: 9.0,
  });

  const [feedbacks, setFeedbacks] = useState<Record<string, string>>({
    sub_1: 'Penjelasan langkah turunan fungsi sudah tepat, tambahkan kesimpulan kurva stasioner.',
    sub_2: 'Argumen sangat sistematis dan lengkap.',
  });

  const essaySubmissions = [
    {
      id: 'sub_1',
      studentName: 'Muhamad Soleh',
      nisn: '0054238910',
      kelas: 'XII IPA 1',
      questionNumber: 5,
      questionText: 'Jelaskan konsep aplikasi turunan fungsi dalam menentukan titik stasioner serta nilai maksimum dan minimum pada suatu kurva!',
      maxScore: 10,
      answer: 'Untuk menentukan titik stasioner kurva y = f(x), syarat utamanya adalah turunan pertama bernilai nol, yaitu f\'(x) = 0. Titik x = c yang memenuhi f\'(c) = 0 disebut titik kritis/stasioner. Nilai maksimum atau minimum lokal kemudian dapat diuji menggunakan uji turunan kedua: jika f\'\'(c) < 0 maka kurva cekung ke bawah dan x = c adalah titik balik maksimum relatif; jika f\'\'(c) > 0 maka x = c adalah titik balik minimum relatif.',
    },
    {
      id: 'sub_2',
      studentName: 'Aisyah Putri Nuraini',
      nisn: '0054238911',
      kelas: 'XII IPA 1',
      questionNumber: 5,
      questionText: 'Jelaskan konsep aplikasi turunan fungsi dalam menentukan titik stasioner serta nilai maksimum dan minimum pada suatu kurva!',
      maxScore: 10,
      answer: 'Aplikasi turunan pertama f\'(x) = 0 menghasilkan titik stasioner. Jika kita uji turunan kedua f\'\'(x): f\'\'(x) > 0 memberikan nilai minimum, sedangkan f\'\'(x) < 0 memberikan nilai maksimum. Contoh penerapannya adalah optimasi biaya produksi pada industri manufaktur.',
    },
  ];

  const handleSaveScore = (subId: string) => {
    alert(`Nilai esai untuk ${subId} berhasil disimpan dan diperbarui di rekap nilai!`);
  };

  return (
    <div className="space-y-4 max-w-4xl mx-auto">
      {/* Header */}
      <div className="flex items-center justify-between bg-white p-4 rounded-[18px] border border-[#E6ECF5] shadow-sm">
        <div className="flex items-center gap-3">
          <button
            type="button"
            onClick={() => navigate('/cbt')}
            className="p-1.5 rounded-xl border border-[#E6ECF5] hover:bg-[#F8FAFD]"
          >
            <ArrowLeft className="w-4 h-4 text-[#5A6A85]" />
          </button>
          <div>
            <h1 className="text-[17px] font-bold text-[#17233F]">
              Koreksi Jawaban Esai — UTS Matematika XII IPA
            </h1>
            <p className="text-[11.5px] text-[#78849A]">
              Penilaian subjektif butir soal esai dengan rubrik terstandar.
            </p>
          </div>
        </div>

        <span className="px-3 py-1 rounded-full bg-amber-100 text-amber-800 text-[11px] font-bold">
          2 Berkas Menunggu Koreksi
        </span>
      </div>

      {/* Submissions */}
      <div className="space-y-4">
        {essaySubmissions.map((item) => (
          <div
            key={item.id}
            className="bg-white rounded-[22px] p-5 border border-[#E6ECF5] shadow-sm space-y-4"
          >
            <div className="flex items-center justify-between border-b border-[#F0F4FA] pb-3">
              <div className="flex items-center gap-2.5">
                <div className="w-8 h-8 rounded-full bg-[#EAF2FF] text-[#1769FF] font-bold text-[12px] flex items-center justify-center">
                  <User className="w-4 h-4" />
                </div>
                <div>
                  <h3 className="text-[13.5px] font-bold text-[#17233F]">{item.studentName}</h3>
                  <p className="text-[11px] text-[#78849A]">{item.kelas} • NISN: {item.nisn}</p>
                </div>
              </div>

              <span className="text-[12px] font-bold text-[#1769FF] bg-[#EEF4FF] px-3 py-1 rounded-xl">
                Soal No. {item.questionNumber} (Maks. {item.maxScore} Poin)
              </span>
            </div>

            {/* Question Text */}
            <div className="p-3 rounded-xl bg-[#F8FAFD] border border-[#E6ECF5] text-[12.5px] text-[#17233F]">
              <span className="font-bold block mb-1">Pertanyaan:</span>
              {item.questionText}
            </div>

            {/* Student Answer */}
            <div className="space-y-1.5">
              <span className="text-[12px] font-bold text-[#17233F]">Jawaban Siswa:</span>
              <div className="p-4 rounded-xl bg-white border border-[#CBD5E1] text-[13px] text-[#17233F] leading-relaxed shadow-inner">
                {item.answer}
              </div>
            </div>

            {/* Scoring & Feedback */}
            <div className="grid grid-cols-1 sm:grid-cols-12 gap-3 pt-2">
              <div className="sm:col-span-3">
                <label className="text-[11.5px] font-bold text-[#17233F] block mb-1">
                  Input Nilai Skor (0 - {item.maxScore})
                </label>
                <input
                  type="number"
                  step="0.5"
                  min="0"
                  max={item.maxScore}
                  value={scores[item.id] || 0}
                  onChange={(e) =>
                    setScores({ ...scores, [item.id]: parseFloat(e.target.value) })
                  }
                  className="w-full p-2.5 text-[14px] font-bold text-[#1769FF] bg-[#F5F8FF] border border-[#E6ECF5] rounded-xl text-center"
                />
              </div>

              <div className="sm:col-span-7">
                <label className="text-[11.5px] font-bold text-[#17233F] block mb-1">
                  Catatan / Feedback untuk Siswa
                </label>
                <input
                  type="text"
                  value={feedbacks[item.id] || ''}
                  onChange={(e) =>
                    setFeedbacks({ ...feedbacks, [item.id]: e.target.value })
                  }
                  placeholder="Beri komentar konstruktif..."
                  className="w-full p-2.5 text-[12px] bg-[#F5F8FF] border border-[#E6ECF5] rounded-xl"
                />
              </div>

              <div className="sm:col-span-2 flex items-end">
                <button
                  type="button"
                  onClick={() => handleSaveScore(item.id)}
                  className="w-full py-2.5 rounded-xl bg-[#1769FF] text-white text-[12px] font-bold hover:bg-[#1248D8] transition-all flex items-center justify-center gap-1 shadow-sm"
                >
                  <Save className="w-3.5 h-3.5" />
                  <span>Simpan</span>
                </button>
              </div>
            </div>
          </div>
        ))}
      </div>
    </div>
  );
};

