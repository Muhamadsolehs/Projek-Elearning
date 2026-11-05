import React, { useState } from 'react';
import { NavLink, useLocation, useNavigate } from 'react-router-dom';
import { 
  ChevronDown, 
  ChevronRight, 
  Settings, 
  LogOut, 
  GraduationCap
} from 'lucide-react';
import { useAuth } from '../../context/AuthContext';
import { getNavItemsForRole, NavItem } from '../../constants/navigation';

export const Sidebar: React.FC = () => {
  const { user, logout } = useAuth();
  const location = useLocation();
  const navigate = useNavigate();
  const navItems = getNavItemsForRole(user.role);

  // All groups expanded by default to reproduce reference image exactly
  const [openGroups, setOpenGroups] = useState<Record<string, boolean>>({
    'Pembelajaran': true,
    'Ujian (CBT)': true,
    'Akademik': true,
    'Laporan': true,
    'Data Akademik': true,
    'Manajemen CBT': true,
    'Manajemen Institusi': true,
  });

  const toggleGroup = (label: string) => {
    setOpenGroups(prev => ({ ...prev, [label]: !prev[label] }));
  };

  const handleLogout = () => {
    logout();
    navigate('/login');
  };

  return (
    <aside className="w-[225px] flex-shrink-0 bg-white border-r border-[#F0F4FA] flex flex-col justify-between py-5 px-3.5 select-none rounded-l-[24px]">
      <div>
        {/* Brand / Logo */}
        <div className="flex items-center gap-3 px-2 mb-6 cursor-pointer" onClick={() => navigate('/dashboard')}>
          <div className="w-10 h-10 rounded-xl bg-gradient-to-br from-[#1769FF] to-[#2575FC] flex items-center justify-center text-white shadow-md shadow-blue-500/20 flex-shrink-0">
            <GraduationCap className="w-6 h-6 stroke-[2.2]" />
          </div>
          <div className="flex flex-col">
            <span className="text-[20px] font-bold text-[#17233F] tracking-tight leading-none">EduCore</span>
            <span className="text-[10px] text-[#8C98A9] font-medium tracking-wide mt-1">Learn • Practice • Excel</span>
          </div>
        </div>

        {/* Navigation Items */}
        <nav className="space-y-1 overflow-y-auto max-h-[calc(100vh-210px)] pr-1">
          {navItems.map((item: NavItem) => {
            const hasChildren = item.children && item.children.length > 0;
            const isGroupOpen = openGroups[item.label] ?? true;
            const isExactActive = location.pathname === item.path;
            const isChildActive = hasChildren && item.children?.some(child => location.pathname === child.path);
            const isActive = isExactActive || isChildActive;

            const Icon = item.icon;

            if (!hasChildren) {
              return (
                <NavLink
                  key={item.label}
                  to={item.path}
                  className={({ isActive: active }) => `
                    flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-[13px] font-semibold transition-all duration-150
                    ${active 
                      ? 'bg-[#DCEBFF] text-[#1769FF] shadow-sm' 
                      : 'text-[#5A6A85] hover:bg-[#F5F8FF] hover:text-[#1769FF]'
                    }
                  `}
                >
                  <Icon className={`w-4 h-4 ${isActive ? 'text-[#1769FF] stroke-[2.5]' : 'text-[#78849A] stroke-[2]'}`} />
                  <span>{item.label}</span>
                </NavLink>
              );
            }

            return (
              <div key={item.label} className="pt-1">
                <button
                  type="button"
                  onClick={() => toggleGroup(item.label)}
                  className={`
                    w-full flex items-center justify-between px-3.5 py-2 rounded-xl text-[13px] font-semibold transition-all duration-150
                    ${isActive ? 'text-[#1769FF]' : 'text-[#5A6A85] hover:text-[#1769FF] hover:bg-[#F5F8FF]'}
                  `}
                >
                  <div className="flex items-center gap-3">
                    <Icon className={`w-4 h-4 ${isActive ? 'text-[#1769FF]' : 'text-[#78849A]'}`} />
                    <span>{item.label}</span>
                  </div>
                  {isGroupOpen ? (
                    <ChevronDown className="w-3.5 h-3.5 text-[#8C98A9]" />
                  ) : (
                    <ChevronRight className="w-3.5 h-3.5 text-[#8C98A9]" />
                  )}
                </button>

                {/* Submenu */}
                {isGroupOpen && (
                  <div className="ml-5 pl-2.5 my-1 space-y-0.5 border-l-2 border-[#EBF2FE]">
                    {item.children?.map(sub => {
                      const isSubActive = location.pathname === sub.path;
                      const SubIcon = sub.icon;
                      return (
                        <NavLink
                          key={sub.path}
                          to={sub.path}
                          className={`
                            flex items-center gap-2.5 px-3 py-1.5 rounded-lg text-[12px] font-medium transition-colors
                            ${isSubActive 
                              ? 'text-[#1769FF] font-semibold bg-[#EEF4FF]' 
                              : 'text-[#64748B] hover:text-[#1769FF] hover:bg-[#F8FAFC]'
                            }
                          `}
                        >
                          {SubIcon && <SubIcon className="w-3.5 h-3.5 opacity-70" />}
                          <span>{sub.label}</span>
                        </NavLink>
                      );
                    })}
                  </div>
                )}
              </div>
            );
          })}
        </nav>
      </div>

      {/* Bottom Settings & Logout */}
      <div className="pt-4 border-t border-[#F0F4FA] space-y-1">
        <NavLink
          to="/pengaturan"
          className={({ isActive }) => `
            flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-[13px] font-semibold transition-all
            ${isActive 
              ? 'bg-[#DCEBFF] text-[#1769FF]' 
              : 'text-[#5A6A85] hover:bg-[#F5F8FF] hover:text-[#1769FF]'
            }
          `}
        >
          <Settings className="w-4 h-4 text-[#78849A]" />
          <span>Pengaturan</span>
        </NavLink>

        <button
          type="button"
          onClick={handleLogout}
          className="w-full flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-[13px] font-semibold text-[#5A6A85] hover:bg-rose-50 hover:text-rose-600 transition-all text-left"
        >
          <LogOut className="w-4 h-4 text-[#78849A] hover:text-rose-600" />
          <span>Keluar</span>
        </button>
      </div>
    </aside>
  );
};
