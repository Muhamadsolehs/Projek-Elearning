import React, { useState } from 'react';
import { 
  MessagesSquare, 
  Search, 
  Plus, 
  Pin, 
  MessageCircle, 
  Clock, 
  User, 
  Send 
} from 'lucide-react';
import { useAuth } from '../../context/AuthContext';

interface Post {
  id: string;
  course: string;
  title: string;
  author: string;
  authorRole: string;
  date: string;
  replies: number;
  isPinned: boolean;
  content: string;
}

export const ForumDiskusiPage: React.FC = () => {
  const { user } = useAuth();
  const [posts, setPosts] = useState<Post[]>([
    {
      id: 'p_1',
      course: 'Matematika XII IPA',
      title: 'Klarifikasi Rumus Turunan Implisit Soal Latihan No 4',
      author: 'Drs. Budi Santoso',
      authorRole: 'Guru',
      date: '2 jam lalu',
      replies: 8,
      isPinned: true,
      content: 'Bagi seluruh siswa XII IPA, perhatikan kembali aturan rantai pada turunan variabel y terhadap x.',
    },
    {
      id: 'p_2',
      course: 'Kimia XII IPA',
      title: 'Diskusi Praktikum Titrasi Asam Basa dan Indikator Alami',
      author: 'Muhamad Soleh',
      authorRole: 'Siswa',
      date: 'Kemarin',
      replies: 5,
      isPinned: false,
      content: 'Apakah ekstrak bunga telang bisa dipakai sebagai pengganti PP pada titrasi basa lemah?',
    },
    {
      id: 'p_3',
      course: 'Pemrograman Web XII RPL',
      title: 'Error CORS saat Fetch API Laravel dari React Vite',
      author: 'Rian Pratama',
      authorRole: 'Siswa',
      date: '3 hari lalu',
      replies: 12,
      isPinned: false,
      content: 'Bagaimana konfigurasi config/cors.php di backend agar origin localhost:3000 diizinkan?',
    },
  ]);

  const [newTitle, setNewTitle] = useState('');
  const [newContent, setNewContent] = useState('');
  const [selectedCourse, setSelectedCourse] = useState('Matematika XII IPA');
  const [showModal, setShowModal] = useState(false);

  const handleCreatePost = (e: React.FormEvent) => {
    e.preventDefault();
    if (!newTitle.trim()) return;

    const newEntry: Post = {
      id: `p_${Date.now()}`,
      course: selectedCourse,
      title: newTitle,
      author: user.name,
      authorRole: user.role === 'guru' ? 'Guru' : 'Siswa',
      date: 'Baru saja',
      replies: 0,
      isPinned: false,
      content: newContent,
    };

    setPosts([newEntry, ...posts]);
    setNewTitle('');
    setNewContent('');
    setShowModal(false);
  };

  return (
    <div className="space-y-4">
      {/* Header */}
      <div className="bg-white p-4 rounded-[18px] border border-[#E6ECF5] shadow-sm flex flex-col sm:flex-row sm:items-center justify-between gap-3">
        <div>
          <h1 className="text-[18px] font-bold text-[#17233F]">Forum Diskusi & Kolaborasi</h1>
          <p className="text-[12px] text-[#78849A]">Ruang tanya jawab interaktif antara guru dan peserta didik.</p>
        </div>

        <button
          type="button"
          onClick={() => setShowModal(true)}
          className="px-4 py-2 rounded-xl bg-[#1769FF] text-white text-[12px] font-bold flex items-center gap-1.5 shadow-sm hover:bg-[#1248D8] transition-all self-start sm:self-auto"
        >
          <Plus className="w-4 h-4" />
          <span>Buat Diskusi Baru</span>
        </button>
      </div>

      {/* Discussion List */}
      <div className="space-y-3">
        {posts.map((post) => (
          <div
            key={post.id}
            className={`bg-white rounded-[18px] p-4 border transition-all hover:shadow-md cursor-pointer ${
              post.isPinned ? 'border-blue-200 bg-blue-50/20' : 'border-[#E6ECF5]'
            }`}
          >
            <div className="flex items-start justify-between gap-3">
              <div className="space-y-1">
                <div className="flex items-center gap-2">
                  <span className="px-2.5 py-0.5 rounded-full bg-[#EAF2FF] text-[#1769FF] font-bold text-[10.5px]">
                    {post.course}
                  </span>
                  {post.isPinned && (
                    <span className="px-2 py-0.5 rounded-full bg-blue-100 text-[#1769FF] font-bold text-[10px] flex items-center gap-1">
                      <Pin className="w-3 h-3" /> Disematkan Guru
                    </span>
                  )}
                </div>

                <h3 className="text-[14px] font-bold text-[#17233F] hover:text-[#1769FF] transition-colors pt-1">
                  {post.title}
                </h3>
                <p className="text-[12px] text-[#5A6A85] line-clamp-2">{post.content}</p>
              </div>

              <div className="flex items-center gap-1 text-[#1769FF] font-bold text-[12px] bg-[#EEF4FF] px-3 py-1.5 rounded-xl flex-shrink-0">
                <MessageCircle className="w-4 h-4" />
                <span>{post.replies}</span>
              </div>
            </div>

            <div className="mt-3 pt-2.5 border-t border-[#F0F4FA] flex items-center justify-between text-[11px] text-[#78849A]">
              <div className="flex items-center gap-1.5">
                <span className="font-semibold text-[#17233F]">{post.author}</span>
                <span>({post.authorRole})</span>
              </div>
              <div className="flex items-center gap-1">
                <Clock className="w-3 h-3" />
                <span>{post.date}</span>
              </div>
            </div>
          </div>
        ))}
      </div>

      {/* New Post Modal */}
      {showModal && (
        <div className="fixed inset-0 bg-slate-900/40 backdrop-blur-sm z-50 flex items-center justify-center p-4">
          <form
            onSubmit={handleCreatePost}
            className="bg-white rounded-[24px] max-w-lg w-full p-5 shadow-2xl border border-[#E6ECF5] space-y-4"
          >
            <h3 className="text-[16px] font-bold text-[#17233F]">Mulai Topik Diskusi Baru</h3>

            <div>
              <label className="text-[11.5px] font-bold text-[#17233F] block mb-1">Mata Pelajaran</label>
              <select
                value={selectedCourse}
                onChange={(e) => setSelectedCourse(e.target.value)}
                className="w-full p-2 text-[12px] bg-[#F5F8FF] border border-[#E6ECF5] rounded-xl"
              >
                <option value="Matematika XII IPA">Matematika XII IPA</option>
                <option value="Kimia XII IPA">Kimia XII IPA</option>
                <option value="Pemrograman Web XII RPL">Pemrograman Web XII RPL</option>
                <option value="Bahasa Indonesia XII IPS">Bahasa Indonesia XII IPS</option>
              </select>
            </div>

            <div>
              <label className="text-[11.5px] font-bold text-[#17233F] block mb-1">Judul Topik / Pertanyaan</label>
              <input
                type="text"
                required
                placeholder="Contoh: Pertanyaan mengenai latihan soal bab 2..."
                value={newTitle}
                onChange={(e) => setNewTitle(e.target.value)}
                className="w-full p-2.5 text-[12px] bg-[#F5F8FF] border border-[#E6ECF5] rounded-xl"
              />
            </div>

            <div>
              <label className="text-[11.5px] font-bold text-[#17233F] block mb-1">Isi Pertanyaan / Penjelasan</label>
              <textarea
                rows={4}
                required
                placeholder="Tuliskan uraian lengkap pertanyaan..."
                value={newContent}
                onChange={(e) => setNewContent(e.target.value)}
                className="w-full p-2.5 text-[12px] bg-[#F5F8FF] border border-[#E6ECF5] rounded-xl"
              />
            </div>

            <div className="flex items-center justify-end gap-2 pt-2 border-t border-[#F0F4FA]">
              <button
                type="button"
                onClick={() => setShowModal(false)}
                className="px-4 py-2 rounded-xl text-[12px] font-semibold text-[#5A6A85] hover:bg-slate-100"
              >
                Batal
              </button>
              <button
                type="submit"
                className="px-5 py-2 rounded-xl bg-[#1769FF] text-white text-[12px] font-bold hover:bg-[#1248D8] flex items-center gap-1.5 shadow-sm"
              >
                <Send className="w-3.5 h-3.5" />
                <span>Publikasikan</span>
              </button>
            </div>
          </form>
        </div>
      )}
    </div>
  );
};

