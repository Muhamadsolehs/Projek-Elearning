import React, { useState } from 'react';
import { Building2, ArrowLeft, Send } from 'lucide-react';
import { useNavigate } from 'react-router-dom';

export const RegisterInstitutionPage: React.FC = () => {
  const navigate = useNavigate();

  const [form, setForm] = useState({
    name: '',
    type: 'SMA',
    npsn: '',
    address: '',
    city: '',
    adminName: '',
    adminEmail: '',
    adminPhone: '',
  });

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    alert('Pengajuan pendaftaran institusi berhasil dikirimkan! Tim EduCore akan memverifikasi dalam 1x24 jam.');
    navigate('/login');
  };

  return (
    <div className="min-h-screen bg-[#EAF2FF] flex items-center justify-center p-4">
      <div className="w-full max-w-lg bg-white rounded-[28px] p-7 shadow-xl border border-[#E6ECF5] space-y-5">
        <div className="flex items-center gap-3">
          <button
            type="button"
            onClick={() => navigate('/login')}
            className="p-1.5 rounded-xl border border-[#E6ECF5] hover:bg-[#F8FAFD]"
          >
            <ArrowLeft className="w-4 h-4 text-[#5A6A85]" />
          </button>
          <div>
            <h1 className="text-[18px] font-bold text-[#17233F]">Pendaftaran Institusi Pendidikan</h1>
            <p className="text-[11.5px] text-[#78849A]">Bergabung bersama jaringan pembelajaran digital EduCore.</p>
          </div>
        </div>

        <form onSubmit={handleSubmit} className="space-y-3.5">
          <div className="grid grid-cols-1 sm:grid-cols-2 gap-3">
            <div>
              <label className="text-[11.5px] font-bold text-[#17233F] block mb-1">Nama Institusi / Sekolah</label>
              <input
                type="text"
                required
                placeholder="Contoh: SMA Negeri 1..."
                value={form.name}
                onChange={(e) => setForm({ ...form, name: e.target.value })}
                className="w-full p-2.5 text-[12px] bg-[#F5F8FF] border border-[#E6ECF5] rounded-xl"
              />
            </div>
            <div>
              <label className="text-[11.5px] font-bold text-[#17233F] block mb-1">Jenjang Pendidikan</label>
              <select
                value={form.type}
                onChange={(e) => setForm({ ...form, type: e.target.value })}
                className="w-full p-2.5 text-[12px] bg-[#F5F8FF] border border-[#E6ECF5] rounded-xl"
              >
                <option value="SMA">SMA</option>
                <option value="SMK">SMK</option>
                <option value="MA">Madrasah Aliyah (MA)</option>
                <option value="SMP">SMP / MTs</option>
                <option value="Universitas">Perguruan Tinggi</option>
              </select>
            </div>
          </div>

          <div className="grid grid-cols-1 sm:grid-cols-2 gap-3">
            <div>
              <label className="text-[11.5px] font-bold text-[#17233F] block mb-1">NPSN (Nomor Pokok Sekolah)</label>
              <input
                type="text"
                required
                placeholder="8 digit NPSN..."
                value={form.npsn}
                onChange={(e) => setForm({ ...form, npsn: e.target.value })}
                className="w-full p-2.5 text-[12px] bg-[#F5F8FF] border border-[#E6ECF5] rounded-xl"
              />
            </div>
            <div>
              <label className="text-[11.5px] font-bold text-[#17233F] block mb-1">Kota / Kabupaten</label>
              <input
                type="text"
                required
                placeholder="Kota domisili..."
                value={form.city}
                onChange={(e) => setForm({ ...form, city: e.target.value })}
                className="w-full p-2.5 text-[12px] bg-[#F5F8FF] border border-[#E6ECF5] rounded-xl"
              />
            </div>
          </div>

          <div>
            <label className="text-[11.5px] font-bold text-[#17233F] block mb-1">Nama Penanggung Jawab / Admin</label>
            <input
              type="text"
              required
              placeholder="Nama lengkap admin institusi..."
              value={form.adminName}
              onChange={(e) => setForm({ ...form, adminName: e.target.value })}
              className="w-full p-2.5 text-[12px] bg-[#F5F8FF] border border-[#E6ECF5] rounded-xl"
            />
          </div>

          <div className="grid grid-cols-1 sm:grid-cols-2 gap-3">
            <div>
              <label className="text-[11.5px] font-bold text-[#17233F] block mb-1">Email Resmi Admin</label>
              <input
                type="email"
                required
                placeholder="admin@sekolah.sch.id"
                value={form.adminEmail}
                onChange={(e) => setForm({ ...form, adminEmail: e.target.value })}
                className="w-full p-2.5 text-[12px] bg-[#F5F8FF] border border-[#E6ECF5] rounded-xl"
              />
            </div>
            <div>
              <label className="text-[11.5px] font-bold text-[#17233F] block mb-1">Nomor WhatsApp / Kontak</label>
              <input
                type="text"
                required
                placeholder="08123456789"
                value={form.adminPhone}
                onChange={(e) => setForm({ ...form, adminPhone: e.target.value })}
                className="w-full p-2.5 text-[12px] bg-[#F5F8FF] border border-[#E6ECF5] rounded-xl"
              />
            </div>
          </div>

          <div className="pt-2">
            <button
              type="submit"
              className="w-full py-3 rounded-xl bg-[#1769FF] text-white text-[13px] font-bold shadow-md hover:bg-[#1248D8] flex items-center justify-center gap-2"
            >
              <Send className="w-4 h-4" />
              <span>Kirimkan Permohonan Pendaftaran</span>
            </button>
          </div>
        </form>
      </div>
    </div>
  );
};

