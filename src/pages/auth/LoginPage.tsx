import React, { useState } from 'react';
import { GraduationCap, Lock, Mail, ArrowRight, ShieldCheck, UserCheck } from 'lucide-react';
import { useNavigate } from 'react-router-dom';
import { useAuth } from '../../context/AuthContext';
import { UserRole } from '../../types';

export const LoginPage: React.FC = () => {
  const navigate = useNavigate();
  const { loginAs } = useAuth();

  const [selectedRole, setSelectedRole] = useState<UserRole>('siswa');
  const [email, setEmail] = useState('muhamad.soleh@educore.sch.id');
  const [password, setPassword] = useState('password123');

  const handleRoleQuickSelect = (role: UserRole) => {
    setSelectedRole(role);
    if (role === 'siswa') setEmail('muhamad.soleh@educore.sch.id');
    else if (role === 'guru') setEmail('budi.santoso@educore.sch.id');
    else if (role === 'admin_institusi') setEmail('admin@educore.sch.id');
    else if (role === 'super_admin') setEmail('superadmin@educore.id');
  };

  const handleLogin = (e: React.FormEvent) => {
    e.preventDefault();
    loginAs(selectedRole);
    navigate('/dashboard');
  };

  return (
    <div className="min-h-screen bg-[#EAF2FF] flex items-center justify-center p-4">
      <div className="w-full max-w-md bg-white rounded-[28px] p-7 shadow-[0_16px_48px_rgba(23,72,150,0.08)] border border-[#E6ECF5] space-y-6">
        {/* Brand */}
        <div className="text-center space-y-2">
          <div className="w-12 h-12 rounded-2xl bg-gradient-to-br from-[#1769FF] to-[#2575FC] text-white flex items-center justify-center mx-auto shadow-md shadow-blue-500/20">
            <GraduationCap className="w-7 h-7 stroke-[2.2]" />
          </div>
          <h1 className="text-[22px] font-extrabold text-[#17233F]">Masuk ke EduCore</h1>
          <p className="text-[12px] text-[#78849A]">
            Integrated E-Learning & Computer Based Test Platform
          </p>
        </div>

        {/* Quick Demo Role Selector */}
        <div className="space-y-1.5">
          <label className="text-[11px] font-bold text-[#78849A] uppercase tracking-wider block">
            Pilih Role Akun Uji Coba:
          </label>
          <div className="grid grid-cols-2 gap-2">
            {[
              { role: 'siswa', label: 'Siswa' },
              { role: 'guru', label: 'Guru' },
              { role: 'admin_institusi', label: 'Admin Sekolah' },
              { role: 'super_admin', label: 'Super Admin' },
            ].map((item) => (
              <button
                key={item.role}
                type="button"
                onClick={() => handleRoleQuickSelect(item.role as UserRole)}
                className={`py-2 px-3 rounded-xl text-[12px] font-bold transition-all text-center border ${
                  selectedRole === item.role
                    ? 'bg-[#EEF4FF] text-[#1769FF] border-[#1769FF] shadow-sm'
                    : 'bg-white text-[#5A6A85] border-[#E6ECF5] hover:bg-[#F8FAFD]'
                }`}
              >
                {item.label}
              </button>
            ))}
          </div>
        </div>

        {/* Form */}
        <form onSubmit={handleLogin} className="space-y-3.5">
          <div>
            <label className="text-[11.5px] font-bold text-[#17233F] block mb-1">
              Email Pengguna / NISN / NIP
            </label>
            <div className="relative">
              <Mail className="w-4 h-4 text-[#8C98A9] absolute left-3.5 top-3" />
              <input
                type="text"
                required
                value={email}
                onChange={(e) => setEmail(e.target.value)}
                className="w-full pl-10 pr-3 py-2.5 text-[12.5px] bg-[#F5F8FF] border border-[#E6ECF5] rounded-xl focus:outline-none focus:ring-2 focus:ring-[#1769FF]/20"
              />
            </div>
          </div>

          <div>
            <label className="text-[11.5px] font-bold text-[#17233F] block mb-1">
              Kata Sandi
            </label>
            <div className="relative">
              <Lock className="w-4 h-4 text-[#8C98A9] absolute left-3.5 top-3" />
              <input
                type="password"
                required
                value={password}
                onChange={(e) => setPassword(e.target.value)}
                className="w-full pl-10 pr-3 py-2.5 text-[12.5px] bg-[#F5F8FF] border border-[#E6ECF5] rounded-xl focus:outline-none focus:ring-2 focus:ring-[#1769FF]/20"
              />
            </div>
          </div>

          <button
            type="submit"
            className="w-full py-3 rounded-xl bg-[#1769FF] text-white text-[13px] font-bold shadow-md hover:bg-[#1248D8] active:scale-95 transition-all flex items-center justify-center gap-2 mt-4"
          >
            <span>Masuk ke Dashboard</span>
            <ArrowRight className="w-4 h-4" />
          </button>
        </form>

        <div className="text-center pt-2 border-t border-[#F0F4FA]">
          <p className="text-[11.5px] text-[#78849A]">
            Institusi baru?{' '}
            <button
              type="button"
              onClick={() => navigate('/register-institusi')}
              className="text-[#1769FF] font-bold hover:underline"
            >
              Daftarkan Sekolah
            </button>
          </p>
        </div>
      </div>
    </div>
  );
};

