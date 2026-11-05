import React, { useState } from 'react';
import { 
  Activity, 
  Search, 
  Users, 
  Clock, 
  CheckCircle2, 
  AlertCircle, 
  RefreshCw,
  Lock,
  Eye
} from 'lucide-react';
import { useNavigate } from 'react-router-dom';

export const ExamMonitoringPage: React.FC = () => {
  const navigate = useNavigate();

  const [students, setStudents] = useState([
    {
      id: 's_01',
      name: 'Muhamad Soleh',
      nisn: '0054238910',
      kelas: 'XII IPA 1',
      status: 'mengerjakan',
      progress: '32/40 Soal',
      timeSpent: '54 Menit',
      ipAddress: '192.168.1.45',
      violationCount: 0,
    },
    {
      id: 's_02',
      name: 'Aisyah Putri Nuraini',
      nisn: '0054238911',
      kelas: 'XII IPA 1',
      status: 'selesai',
      progress: '40/40 Soal',
      timeSpent: '72 Menit',
      ipAddress: '192.168.1.46',
      violationCount: 0,
    },
    {
      id: 's_03',
      name: 'Bagas Aditya Pratama',
      nisn: '0054238912',
      kelas: 'XII IPA 1',
      status: 'mengerjakan',
      progress: '28/40 Soal',
      timeSpent: '51 Menit',
      ipAddress: '192.168.1.47',
      violationCount: 1,
    },
    {
      id: 's_04',
      name: 'Dinda Kirana Safitri',
      nisn: '0054238913',
      kelas: 'XII IPA 1',
      status: 'belum_mulai',
      progress: '0/40 Soal',
      timeSpent: '-',
      ipAddress: '-',
      violationCount: 0,
    },
  ]);

  return (
    <div className="space-y-4">
      {/* Header */}
      <div className="bg-white p-4 rounded-[18px] border border-[#E6ECF5] shadow-sm flex flex-col sm:flex-row sm:items-center justify-between gap-3">
        <div>
          <div className="flex items-center gap-2">
            <span className="w-2.5 h-2.5 rounded-full bg-emerald-500 animate-ping"></span>
            <span className="text-[11px] font-bold text-emerald-600 uppercase tracking-wider">
              Live Proctoring Aktif
            </span>
          </div>
          <h1 className="text-[18px] font-bold text-[#17233F] mt-1">
            Monitoring Ujian CBT — UTS Matematika XII IPA
          </h1>
          <p className="text-[12px] text-[#78849A]">
            Pantau status login, progres pengerjaan, dan catatan integritas peserta secara real-time.
          </p>
        </div>

        <div className="flex items-center gap-2">
          <button
            type="button"
            onClick={() => alert('Sinkronisasi data real-time peserta diperbarui!')}
            className="px-3.5 py-2 rounded-xl bg-[#F5F8FF] text-[#1769FF] text-[12px] font-bold border border-[#E6ECF5] hover:bg-[#EEF4FF] flex items-center gap-1.5"
          >
            <RefreshCw className="w-3.5 h-3.5" />
            <span>Segarkan Data</span>
          </button>
        </div>
      </div>

      {/* Quick Monitor Cards */}
      <div className="grid grid-cols-2 sm:grid-cols-4 gap-3">
        <div className="bg-white p-3.5 rounded-2xl border border-[#E6ECF5] shadow-sm">
          <span className="text-[11px] text-[#78849A]">Total Peserta Terdaftar</span>
          <div className="text-[20px] font-bold text-[#17233F] mt-0.5">36 Siswa</div>
          <span className="text-[10px] text-blue-600 font-semibold">XII IPA 1</span>
        </div>
        <div className="bg-white p-3.5 rounded-2xl border border-[#E6ECF5] shadow-sm">
          <span className="text-[11px] text-[#78849A]">Sedang Mengerjakan</span>
          <div className="text-[20px] font-bold text-blue-600 mt-0.5">32 Siswa</div>
          <span className="text-[10px] text-emerald-600 font-semibold">Aktif menjawab</span>
        </div>
        <div className="bg-white p-3.5 rounded-2xl border border-[#E6ECF5] shadow-sm">
          <span className="text-[11px] text-[#78849A]">Selesai Submit</span>
          <div className="text-[20px] font-bold text-emerald-600 mt-0.5">3 Siswa</div>
          <span className="text-[10px] text-[#78849A]">Jawaban terkunci</span>
        </div>
        <div className="bg-white p-3.5 rounded-2xl border border-[#E6ECF5] shadow-sm">
          <span className="text-[11px] text-[#78849A]">Belum Mulai</span>
          <div className="text-[20px] font-bold text-amber-600 mt-0.5">1 Siswa</div>
          <span className="text-[10px] text-amber-600 font-semibold">Perlu dicek</span>
        </div>
      </div>

      {/* Live Table */}
      <div className="bg-white rounded-[20px] border border-[#E6ECF5] shadow-sm overflow-hidden">
        <div className="overflow-x-auto">
          <table className="w-full text-left text-[12.5px]">
            <thead>
              <tr className="bg-[#F8FAFD] border-b border-[#E6ECF5] text-[#78849A] font-semibold">
                <th className="py-3 px-4">Nama Siswa / NISN</th>
                <th className="py-3 px-4">Kelas</th>
                <th className="py-3 px-4">Status</th>
                <th className="py-3 px-4">Progres Jawaban</th>
                <th className="py-3 px-4">Durasi Terpakai</th>
                <th className="py-3 px-4">Catatan Integritas</th>
                <th className="py-3 px-4 text-right">Tindakan Pengawas</th>
              </tr>
            </thead>
            <tbody className="divide-y divide-[#F0F4FA]">
              {students.map((st) => (
                <tr key={st.id} className="hover:bg-[#F8FAFD]">
                  <td className="py-3 px-4 font-bold text-[#17233F]">
                    {st.name}
                    <div className="text-[10.5px] font-normal text-[#8C98A9]">NISN: {st.nisn}</div>
                  </td>
                  <td className="py-3 px-4 text-[#5A6A85]">{st.kelas}</td>
                  <td className="py-3 px-4">
                    {st.status === 'mengerjakan' && (
                      <span className="px-2.5 py-0.5 rounded-full bg-blue-100 text-[#1769FF] font-bold text-[10.5px]">
                        Mengerjakan
                      </span>
                    )}
                    {st.status === 'selesai' && (
                      <span className="px-2.5 py-0.5 rounded-full bg-emerald-100 text-emerald-700 font-bold text-[10.5px]">
                        Selesai
                      </span>
                    )}
                    {st.status === 'belum_mulai' && (
                      <span className="px-2.5 py-0.5 rounded-full bg-slate-100 text-slate-600 font-bold text-[10.5px]">
                        Belum Login
                      </span>
                    )}
                  </td>
                  <td className="py-3 px-4 font-semibold text-[#17233F]">{st.progress}</td>
                  <td className="py-3 px-4 text-[#5A6A85]">{st.timeSpent}</td>
                  <td className="py-3 px-4">
                    {st.violationCount > 0 ? (
                      <span className="px-2 py-0.5 rounded-full bg-rose-50 text-rose-600 text-[10px] font-bold">
                        Pernah Pindah Tab ({st.violationCount}x)
                      </span>
                    ) : (
                      <span className="text-emerald-600 text-[11px] font-semibold">Bersih (0 Log)</span>
                    )}
                  </td>
                  <td className="py-3 px-4 text-right space-x-1.5">
                    <button
                      type="button"
                      onClick={() => alert(`Reset login token untuk siswa: ${st.name}`)}
                      className="px-2.5 py-1 rounded-lg bg-amber-50 text-amber-700 text-[11px] font-bold hover:bg-amber-100"
                    >
                      Buka Kunci
                    </button>
                    <button
                      type="button"
                      onClick={() => alert(`Submit paksa sesi ujian untuk siswa: ${st.name}`)}
                      className="px-2.5 py-1 rounded-lg bg-rose-50 text-rose-600 text-[11px] font-bold hover:bg-rose-100"
                    >
                      Submit Paksa
                    </button>
                  </td>
                </tr>
              ))}
            </tbody>
          </table>
        </div>
      </div>
    </div>
  );
};

