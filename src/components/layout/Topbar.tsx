import React, { useState } from 'react';
import { 
  Search, 
  Bell, 
  Mail, 
  ChevronDown, 
  UserCheck, 
  Shield, 
  GraduationCap, 
  Building,
  LogOut
} from 'lucide-react';
import { useAuth } from '../../context/AuthContext';
import { UserRole } from '../../types';

export const Topbar: React.FC = () => {
  const { user, switchRole, logout } = useAuth();
  const [showRoleDropdown, setShowRoleDropdown] = useState(false);
  const [showNotifDropdown, setShowNotifDropdown] = useState(false);
  const [searchQuery, setSearchQuery] = useState('');

  const rolesList: { role: UserRole; title: string; subtitle: string; icon: any }[] = [
    { role: 'siswa', title: 'Siswa (Muhamad Soleh)', subtitle: 'XII IPA 1 • NISN: 0054238910', icon: GraduationCap },
    { role: 'guru', title: 'Guru (Drs. Budi Santoso)', subtitle: 'Guru Matematika • NIP: 19780512', icon: UserCheck },
    { role: 'admin_institusi', title: 'Admin Institusi', subtitle: 'SMA Negeri 1 EduCore', icon: Building },
    { role: 'super_admin', title: 'Super Admin', subtitle: 'Platform Administrator', icon: Shield },
  ];

  return (
    <header className="h-[72px] px-6 bg-white border-b border-[#F0F4FA] flex items-center justify-between gap-4 select-none rounded-tr-[24px]">
      {/* Search Bar (Capsule shaped with search icon) */}
      <div className="relative w-full max-w-[420px]">
        <div className="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
          <Search className="w-4 h-4 text-[#8C98A9]" />
        </div>
        <input
          type="text"
          value={searchQuery}
          onChange={(e) => setSearchQuery(e.target.value)}
          placeholder="Cari materi, tugas, atau ujian..."
          className="w-full pl-10 pr-4 py-2.5 text-[12.5px] bg-[#F5F8FF] border border-[#E6ECF5] rounded-full text-[#17233F] placeholder-[#8C98A9] focus:outline-none focus:ring-2 focus:ring-[#1769FF]/20 focus:border-[#1769FF] transition-all"
        />
      </div>

      {/* Right controls: Notifications, Messages, User Profile */}
      <div className="flex items-center gap-3">
        {/* Notification Bell */}
        <div className="relative">
          <button
            type="button"
            onClick={() => setShowNotifDropdown(!showNotifDropdown)}
            className="w-9 h-9 rounded-full flex items-center justify-center text-[#5A6A85] hover:text-[#1769FF] hover:bg-[#F5F8FF] transition-all relative"
            title="Notifikasi"
          >
            <Bell className="w-4.5 h-4.5 stroke-[2]" />
            <span className="absolute top-1 right-1 w-4 h-4 rounded-full bg-[#EF5B65] text-white text-[9.5px] font-bold flex items-center justify-center border-2 border-white">
              3
            </span>
          </button>

          {/* Notif Dropdown */}
          {showNotifDropdown && (
            <div className="absolute right-0 mt-2 w-80 bg-white rounded-2xl shadow-xl border border-[#E6ECF5] py-2 z-50 animate-in fade-in slide-in-from-top-2 duration-150">
              <div className="px-4 py-2 border-b border-[#F0F4FA] flex items-center justify-between">
                <span className="text-[13px] font-bold text-[#17233F]">Notifikasi (3 Baru)</span>
                <button type="button" className="text-[11px] text-[#1769FF] font-semibold hover:underline">
                  Tandai Dibaca
                </button>
              </div>
              <div className="divide-y divide-[#F0F4FA] max-h-72 overflow-y-auto">
                <div className="px-4 py-2.5 hover:bg-[#F8FAFD] transition-colors cursor-pointer">
                  <p className="text-[12px] font-semibold text-[#17233F]">Tugas Matematika Mendekati Deadline</p>
                  <p className="text-[11px] text-[#78849A]">Analisis Data harus dikumpulkan 2 hari lagi.</p>
                  <span className="text-[10px] text-[#8C98A9]">10 menit lalu</span>
                </div>
                <div className="px-4 py-2.5 hover:bg-[#F8FAFD] transition-colors cursor-pointer">
                  <p className="text-[12px] font-semibold text-[#17233F]">Nilai Ujian Kimia Telah Dipublikasikan</p>
                  <p className="text-[11px] text-[#78849A]">Hasil kuis bab redoks telah dinilai oleh guru.</p>
                  <span className="text-[10px] text-[#8C98A9]">2 jam lalu</span>
                </div>
                <div className="px-4 py-2.5 hover:bg-[#F8FAFD] transition-colors cursor-pointer">
                  <p className="text-[12px] font-semibold text-[#17233F]">Jadwal CBT Telah Ditambahkan</p>
                  <p className="text-[11px] text-[#78849A]">Ujian Tengah Semester: Matematika XII IPA.</p>
                  <span className="text-[10px] text-[#8C98A9]">Kemarin</span>
                </div>
              </div>
            </div>
          )}
        </div>

        {/* Message / Mail icon */}
        <button
          type="button"
          className="w-9 h-9 rounded-full flex items-center justify-center text-[#5A6A85] hover:text-[#1769FF] hover:bg-[#F5F8FF] transition-all"
          title="Pesan Masuk"
        >
          <Mail className="w-4.5 h-4.5 stroke-[2]" />
        </button>

        {/* User Profile Pill & Dropdown */}
        <div className="relative">
          <button
            type="button"
            onClick={() => setShowRoleDropdown(!showRoleDropdown)}
            className="flex items-center gap-2.5 pl-1.5 pr-2 py-1 rounded-full hover:bg-[#F5F8FF] border border-transparent hover:border-[#E6ECF5] transition-all"
          >
            <div className="w-9 h-9 rounded-full overflow-hidden border border-[#E2E8F0] shadow-sm flex-shrink-0 bg-[#E2E8F0]">
              <img
                src={user.avatar || '/assets/images/avatar-muhamad.jpg'}
                alt={user.name}
                className="w-full h-full object-cover"
              />
            </div>
            <div className="text-left hidden sm:block">
              <div className="text-[13px] font-bold text-[#17233F] leading-tight">
                {user.name}
              </div>
              <div className="text-[11px] text-[#78849A] font-medium capitalize">
                {user.role === 'siswa' ? 'Siswa' : user.role === 'guru' ? 'Guru' : user.role === 'admin_institusi' ? 'Admin Institusi' : 'Super Admin'}
              </div>
            </div>
            <ChevronDown className="w-3.5 h-3.5 text-[#8C98A9] ml-0.5" />
          </button>

          {/* Role Switcher & Account Dropdown */}
          {showRoleDropdown && (
            <div className="absolute right-0 mt-2 w-72 bg-white rounded-2xl shadow-xl border border-[#E6ECF5] py-2.5 z-50 animate-in fade-in slide-in-from-top-2 duration-150">
              <div className="px-4 pb-2 border-b border-[#F0F4FA]">
                <p className="text-[10px] uppercase font-bold tracking-wider text-[#8C98A9]">Role & Akun Aktif</p>
                <p className="text-[13px] font-bold text-[#17233F] mt-0.5">{user.name}</p>
                <p className="text-[11px] text-[#78849A]">{user.institutionName || 'EduCore Platform'}</p>
              </div>

              {/* Role switch options */}
              <div className="px-2 py-1.5">
                <p className="px-2 text-[10px] font-bold text-[#8C98A9] uppercase mb-1">Ganti Tampilan Role:</p>
                {rolesList.map((item) => {
                  const RoleIcon = item.icon;
                  const isCurrent = user.role === item.role;
                  return (
                    <button
                      key={item.role}
                      type="button"
                      onClick={() => {
                        switchRole(item.role);
                        setShowRoleDropdown(false);
                      }}
                      className={`
                        w-full flex items-center gap-2.5 px-2.5 py-2 rounded-xl text-left transition-all
                        ${isCurrent ? 'bg-[#EEF4FF] text-[#1769FF] font-semibold' : 'text-[#4A5568] hover:bg-[#F8FAFD]'}
                      `}
                    >
                      <RoleIcon className={`w-4 h-4 ${isCurrent ? 'text-[#1769FF]' : 'text-[#78849A]'}`} />
                      <div className="flex-1 overflow-hidden">
                        <p className="text-[12px] truncate leading-tight">{item.title}</p>
                        <p className="text-[10px] text-[#8C98A9] truncate">{item.subtitle}</p>
                      </div>
                      {isCurrent && <div className="w-1.5 h-1.5 rounded-full bg-[#1769FF]" />}
                    </button>
                  );
                })}
              </div>

              <div className="pt-2 border-t border-[#F0F4FA] px-2 space-y-0.5">
                <button
                  type="button"
                  onClick={logout}
                  className="w-full flex items-center gap-2 px-2.5 py-1.5 rounded-lg text-[12px] font-medium text-rose-600 hover:bg-rose-50 transition-colors"
                >
                  <LogOut className="w-3.5 h-3.5" />
                  <span>Keluar Akun</span>
                </button>
              </div>
            </div>
          )}
        </div>
      </div>
    </header>
  );
};
