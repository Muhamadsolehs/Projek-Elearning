import React from 'react';
import { useAuth } from '../../context/AuthContext';
import { StudentDashboard } from './StudentDashboard';
import { TeacherDashboard } from './TeacherDashboard';
import { InstitutionAdminDashboard } from './InstitutionAdminDashboard';
import { SuperAdminDashboard } from './SuperAdminDashboard';

export const DashboardRouter: React.FC = () => {
  const { user } = useAuth();

  switch (user.role) {
    case 'siswa':
      return <StudentDashboard />;
    case 'guru':
      return <TeacherDashboard />;
    case 'admin_institusi':
      return <InstitutionAdminDashboard />;
    case 'super_admin':
      return <SuperAdminDashboard />;
    default:
      return <StudentDashboard />;
  }
};

