export type UserRole = 'siswa' | 'guru' | 'admin_institusi' | 'super_admin';

export interface User {
  id: string;
  name: string;
  email: string;
  role: UserRole;
  avatar: string;
  institutionId?: string;
  institutionName?: string;
  kelas?: string;
  nisn?: string;
  nip?: string;
}

export interface Institution {
  id: string;
  name: string;
  code: string;
  logo?: string;
  address: string;
  city: string;
  type: 'SMA' | 'SMK' | 'MA' | 'SMP' | 'Universitas';
  status: 'active' | 'pending' | 'suspended';
  totalStudents: number;
  totalTeachers: number;
  createdAt: string;
}

export interface Subject {
  id: string;
  name: string;
  code: string;
  category: 'Wajib' | 'Peminatan' | 'Muatan Lokal';
  teacherName: string;
  kelas: string;
  totalMateri: number;
  totalTugas: number;
  iconBg: string;
  iconType: 'math' | 'chem' | 'web' | 'indo' | 'generic';
}

export interface Course {
  id: string;
  subjectName: string;
  kelas: string;
  teacherName: string;
  teacherAvatar: string;
  thumbnail: string;
  progress: number;
  totalSiswa: number;
  description: string;
  bannerColor: string;
  themeGradient: string;
  accentColor: string;
}

export interface Materi {
  id: string;
  courseId: string;
  subjectName: string;
  title: string;
  description: string;
  bab: string;
  order: number;
  durationMinutes: number;
  completed: boolean;
  content: string;
  attachments?: { name: string; size: string; type: string; url: string }[];
}

export interface Assignment {
  id: string;
  courseId: string;
  subjectName: string;
  kelas: string;
  title: string;
  deadline: string;
  deadlineFormatted: string;
  daysLeft: number;
  urgency: 'critical' | 'soon' | 'normal';
  badgeColor: 'red' | 'blue' | 'purple';
  status: 'belum_dikumpulkan' | 'menunggu_penilaian' | 'selesai' | 'terlambat';
  grade?: number;
  feedback?: string;
  iconType: 'document' | 'spreadsheet' | 'code' | 'presentation';
}

export interface Exam {
  id: string;
  title: string;
  subjectName: string;
  kelas: string;
  teacherName: string;
  startDate: string;
  startTime: string;
  endTime: string;
  durationMinutes: number;
  totalQuestions: number;
  daysLeft: number;
  status: 'mendatang' | 'berlangsung' | 'selesai';
  passingScore: number;
  token?: string;
  instructions: string[];
}

export interface Question {
  id: number;
  number: number;
  type: 'single_choice' | 'multiple_choice' | 'true_false' | 'short_answer' | 'matching' | 'essay';
  text: string;
  imageUrl?: string;
  options?: { key: string; text: string }[];
  scoreWeight: number;
  userAnswer?: string | string[];
  isMarkedReview?: boolean;
}

export interface ExamAttempt {
  examId: string;
  studentId: string;
  startedAt: string;
  timeRemainingSeconds: number;
  answers: Record<number, string | string[]>;
  markedReview: Record<number, boolean>;
  isSubmitted: boolean;
}

export interface Announcement {
  id: string;
  title: string;
  date: string;
  dotColor: 'orange' | 'blue' | 'purple' | 'green';
  category: string;
  content?: string;
}

