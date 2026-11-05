import React, { useState } from 'react';
import { User, Lock, Bell, Shield, Save } from 'lucide-react';
import { useAuth } from '../../context/AuthContext';

export const PengaturanPage: React.FC = () => {
  const { user } = useAuth();
  const [name, setName] = useState(user.name);
  const [email, setEmail] = useState(user.email);

  const handleSave = (e: React.FormEvent) => {
    e.preventDefault();
    alert('Profil dan preferensi akun berhasil diperbarui!');
  };

  return (
    <div className="space-y-4 max-w-3xl mx-auto">
      {/* Header */}
      <div className="bg-white p-4 rounded-[18px] border border-[#E6ECF5] shadow-sm">
        <h1 className="text-[18px] font-bold text-[#17233F]">Pengaturan Akun & Profil</h1>
        <p className="text-[12px] text-[#78849A]">Kelola informasi identitas, kata sandi, dan notifikasi sistem.</p>
      </div>

      <form onSubmit={handleSave} className="space-y-4">
        <div className="bg-white rounded-[22px] p-5 border border-[#E6ECF5] shadow-sm space-y-4">
          <h3 className="text-[14px] font-bold text-[#17233F] flex items-center gap-2 border-b border-[#F0F4FA] pb-3">
            <User className="w-4 h-4 text-[#1769FF]" />
            <span>Informasi Pribadi</span>
          </h3>

          <div className="flex items-center gap-4">
            <div className="w-16 h-16 rounded-full overflow-hidden border-2 border-[#1769FF] flex-shrink-0 bg-slate-100">
              <img src={user.avatar} alt={user.name} className="w-full h-full object-cover" />
            </div>
            <div>
              <button
                type="button"
                className="px-3.5 py-1.5 rounded-xl border border-[#E6ECF5] text-[11.5px] font-bold text-[#5A6A85] hover:bg-[#F8FAFD]"
              >
                Ganti Foto Profil
              </button>
              <p className="text-[10.5px] text-[#8C98A9] mt-1">Maks. 2MB (JPG atau PNG)</p>
            </div>
          </div>

          <div className="grid grid-cols-1 sm:grid-cols-2 gap-3">
            <div>
              <label className="text-[11.5px] font-bold text-[#17233F] block mb-1">Nama Lengkap</label>
              <input
                type="text"
                value={name}
                onChange={(e) => setName(e.target.value)}
                className="w-full p-2.5 text-[12.5px] bg-[#F5F8FF] border border-[#E6ECF5] rounded-xl font-medium"
              />
            </div>
            <div>
              <label className="text-[11.5px] font-bold text-[#17233F] block mb-1">Alamat Email</label>
              <input
                type="email"
                value={email}
                onChange={(e) => setEmail(e.target.value)}
                className="w-full p-2.5 text-[12.5px] bg-[#F5F8FF] border border-[#E6ECF5] rounded-xl font-medium"
              />
            </div>
          </div>
        </div>

        <div className="bg-white rounded-[22px] p-5 border border-[#E6ECF5] shadow-sm space-y-4">
          <h3 className="text-[14px] font-bold text-[#17233F] flex items-center gap-2 border-b border-[#F0F4FA] pb-3">
            <Lock className="w-4 h-4 text-[#1769FF]" />
            <span>Ganti Kata Sandi</span>
          </h3>

          <div className="grid grid-cols-1 sm:grid-cols-2 gap-3">
            <div>
              <label className="text-[11.5px] font-bold text-[#17233F] block mb-1">Kata Sandi Baru</label>
              <input
                type="password"
                placeholder="Minimal 8 karakter..."
                className="w-full p-2.5 text-[12px] bg-[#F5F8FF] border border-[#E6ECF5] rounded-xl"
              />
            </div>
            <div>
              <label className="text-[11.5px] font-bold text-[#17233F] block mb-1">Konfirmasi Kata Sandi</label>
              <input
                type="password"
                placeholder="Ulangi kata sandi baru..."
                className="w-full p-2.5 text-[12px] bg-[#F5F8FF] border border-[#E6ECF5] rounded-xl"
              />
            </div>
          </div>
        </div>

        <div className="flex justify-end pt-1">
          <button
            type="submit"
            className="px-6 py-2.5 rounded-xl bg-[#1769FF] text-white text-[12.5px] font-bold shadow-md hover:bg-[#1248D8] flex items-center gap-2"
          >
            <Save className="w-4 h-4" />
            <span>Simpan Perubahan</span>
          </button>
        </div>
      </form>
    </div>
  );
};

