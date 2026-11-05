import React from 'react';
import { WelcomeBanner } from '../../components/dashboard/WelcomeBanner';
import { StatCards } from '../../components/dashboard/StatCards';
import { KelasSayaSection } from '../../components/dashboard/KelasSayaSection';
import { UjianCbtCard } from '../../components/dashboard/UjianCbtCard';
import { CalendarWidget } from '../../components/dashboard/CalendarWidget';
import { TugasMendatangWidget } from '../../components/dashboard/TugasMendatangWidget';
import { ProgresBelajarWidget } from '../../components/dashboard/ProgresBelajarWidget';
import { PengumumanWidget } from '../../components/dashboard/PengumumanWidget';
import { useAuth } from '../../context/AuthContext';
import { 
  studentStatsMock, 
  coursesMock, 
  upcomingAssignmentsMock, 
  announcementsMock 
} from '../../data/mockData';

export const StudentDashboard: React.FC = () => {
  const { user } = useAuth();

  return (
    <div className="grid grid-cols-1 xl:grid-cols-12 gap-4 lg:gap-4.5">
      {/* Middle Column (65% width on large screens) */}
      <div className="xl:col-span-8 space-y-4">
        {/* 1. Welcome Banner */}
        <WelcomeBanner name={user.name.split(' ')[0]} />

        {/* 2. 4 Stat Cards */}
        <StatCards stats={studentStatsMock} />

        {/* 3. Kelas Saya */}
        <KelasSayaSection courses={coursesMock} />

        {/* 4. Ujian CBT */}
        <UjianCbtCard />
      </div>

      {/* Right Column (35% width on large screens) */}
      <div className="xl:col-span-4 space-y-4">
        {/* 1. Jadwal Saya (Calendar) */}
        <CalendarWidget />

        {/* 2. Tugas Mendatang */}
        <TugasMendatangWidget assignments={upcomingAssignmentsMock} />

        {/* 3. Progres Belajar & Pengumuman side-by-side */}
        <div className="grid grid-cols-1 sm:grid-cols-2 gap-3">
          <ProgresBelajarWidget percentage={78} />
          <PengumumanWidget announcements={announcementsMock} />
        </div>
      </div>
    </div>
  );
};

