import React, { createContext, useContext, useState } from 'react';
import { User, UserRole } from '../types';
import { currentUserMock, teacherUserMock, adminUserMock, superAdminUserMock } from '../data/mockData';

interface AuthContextType {
  user: User;
  switchRole: (role: UserRole) => void;
  logout: () => void;
  loginAs: (role: UserRole) => void;
}

const AuthContext = createContext<AuthContextType | undefined>(undefined);

export const AuthProvider: React.FC<{ children: React.ReactNode }> = ({ children }) => {
  const [user, setUser] = useState<User>(currentUserMock);

  const switchRole = (role: UserRole) => {
    switch (role) {
      case 'siswa':
        setUser(currentUserMock);
        break;
      case 'guru':
        setUser(teacherUserMock);
        break;
      case 'admin_institusi':
        setUser(adminUserMock);
        break;
      case 'super_admin':
        setUser(superAdminUserMock);
        break;
    }
  };

  const loginAs = (role: UserRole) => {
    switchRole(role);
  };

  const logout = () => {
    // defaults back to student or login
    setUser(currentUserMock);
  };

  return (
    <AuthContext.Provider value={{ user, switchRole, logout, loginAs }}>
      {children}
    </AuthContext.Provider>
  );
};

export const useAuth = () => {
  const context = useContext(AuthContext);
  if (!context) {
    throw new Error('useAuth must be used within an AuthProvider');
  }
  return context;
};

