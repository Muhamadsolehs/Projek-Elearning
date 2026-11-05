import React from 'react';
import { BrowserRouter as Router, Routes, Route, Navigate } from 'react-router-dom';
import { AuthProvider } from './context/AuthContext';
import { AppLayout } from './components/layout/AppLayout';

import { DashboardRouter } from './pages/dashboard/DashboardRouter';
import { MateriListPage } from './pages/elearning/MateriListPage';
import { CourseDetailPage } from './pages/elearning/CourseDetailPage';
import { TugasListPage } from './pages/elearning/TugasListPage';
import { ForumDiskusiPage } from './pages/elearning/ForumDiskusiPage';

import { ExamListPage } from './pages/cbt/ExamListPage';
import { ExamDetailPage } from './pages/cbt/ExamDetailPage';
import { ExamExecutionPage } from './pages/cbt/ExamExecutionPage';
import { BankSoalPage } from './pages/cbt/BankSoalPage';
import { QuestionBuilderPage } from './pages/cbt/QuestionBuilderPage';
import { ExamMonitoringPage } from './pages/cbt/ExamMonitoringPage';
import { KoreksiEsaiPage } from './pages/cbt/KoreksiEsaiPage';
import { ExamResultPage } from './pages/cbt/ExamResultPage';

import { KelasListPage } from './pages/akademik/KelasListPage';
import { MataPelajaranPage } from './pages/akademik/MataPelajaranPage';
import { LaporanAkademikPage } from './pages/laporan/LaporanAkademikPage';
import { StatistikPage } from './pages/laporan/StatistikPage';

import { KalenderAkademikPage } from './pages/shared/KalenderAkademikPage';
import { PengumumanPage } from './pages/shared/PengumumanPage';
import { PengaturanPage } from './pages/shared/PengaturanPage';

import { LoginPage } from './pages/auth/LoginPage';
import { RegisterInstitutionPage } from './pages/auth/RegisterInstitutionPage';

export const App: React.FC = () => {
  return (
    <AuthProvider>
      <Router>
        <Routes>
          {/* Public Auth Routes */}
          <Route path="/login" element={<LoginPage />} />
          <Route path="/register-institusi" element={<RegisterInstitutionPage />} />

          {/* Dedicated Fullscreen CBT Execution Route */}
          <Route path="/cbt/pengerjaan/:id" element={<ExamExecutionPage />} />

          {/* Standard Authenticated Layout with Sidebar & Header */}
          <Route path="/" element={<AppLayout />}>
            <Route index element={<Navigate to="/dashboard" replace />} />
            <Route path="dashboard" element={<DashboardRouter />} />

            {/* E-Learning */}
            <Route path="pembelajaran" element={<MateriListPage />} />
            <Route path="pembelajaran/materi" element={<MateriListPage />} />
            <Route path="pembelajaran/course/:id" element={<CourseDetailPage />} />
            <Route path="pembelajaran/tugas" element={<TugasListPage />} />
            <Route path="pembelajaran/tugas/:id" element={<TugasListPage />} />
            <Route path="pembelajaran/penilaian" element={<TugasListPage />} />
            <Route path="pembelajaran/diskusi" element={<ForumDiskusiPage />} />

            {/* CBT */}
            <Route path="cbt" element={<ExamListPage />} />
            <Route path="cbt/jadwal" element={<ExamListPage />} />
            <Route path="cbt/ujian" element={<ExamListPage />} />
            <Route path="cbt/ujian/buat" element={<ExamListPage />} />
            <Route path="cbt/ujian/:id" element={<ExamDetailPage />} />
            <Route path="cbt/bank-soal" element={<BankSoalPage />} />
            <Route path="cbt/soal/builder" element={<QuestionBuilderPage />} />
            <Route path="cbt/monitoring" element={<ExamMonitoringPage />} />
            <Route path="cbt/koreksi-esai" element={<KoreksiEsaiPage />} />
            <Route path="cbt/hasil" element={<ExamResultPage />} />

            {/* Akademik */}
            <Route path="akademik" element={<KelasListPage />} />
            <Route path="akademik/kelas" element={<KelasListPage />} />
            <Route path="akademik/mata-pelajaran" element={<MataPelajaranPage />} />
            <Route path="akademik/nilai" element={<LaporanAkademikPage />} />

            {/* Laporan */}
            <Route path="laporan" element={<LaporanAkademikPage />} />
            <Route path="laporan/akademik" element={<LaporanAkademikPage />} />
            <Route path="laporan/statistik" element={<StatistikPage />} />

            {/* Shared */}
            <Route path="kalender" element={<KalenderAkademikPage />} />
            <Route path="pengumuman" element={<PengumumanPage />} />
            <Route path="pengaturan" element={<PengaturanPage />} />
          </Route>

          {/* Catch-all */}
          <Route path="*" element={<Navigate to="/dashboard" replace />} />
        </Routes>
      </Router>
    </AuthProvider>
  );
};

export default App;

