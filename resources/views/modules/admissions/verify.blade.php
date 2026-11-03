@extends('layouts.app')

@section('title', 'Verifikasi Berkas PSB — ' . $applicant['name'])

@section('breadcrumb')
<nav class="flex text-xs text-slate-500 font-medium mb-1">
    <ol class="inline-flex items-center space-x-1">
        <li class="inline-flex items-center"><a href="/dashboard" class="text-primary-600 hover:underline">SIM-Pesantren</a></li>
        <li><i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-400"></i></li>
        <li class="inline-flex items-center"><a href="/admissions/applicants" class="text-primary-600 hover:underline">PSB</a></li>
        <li><i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-400"></i></li>
        <li class="text-slate-800 font-bold">Verifikasi & Nilai Seleksi</li>
    </ol>
</nav>
@endsection

@section('page-title')
Lembar Verifikasi Calon: {{ $applicant['name'] }}
@endsection

@section('page-subtitle')
Nomor Pendaftaran: {{ $applicant['registration_number'] }} • Gelombang 1 • Pilihan: Tingkat {{ $applicant['level_target'] }}
@endsection

@section('page-actions')
<a href="/admissions/applicants" class="px-3 py-2 bg-white border border-slate-200 text-slate-700 hover:bg-slate-50 text-xs font-semibold rounded-lg shadow-2xs flex items-center gap-1.5">
    <i data-lucide="arrow-left" class="w-4 h-4"></i>
    <span>Kembali ke Daftar</span>
</a>
@endsection

@section('content')
<div class="max-w-4xl mx-auto space-y-6" x-data="{
    applicantStatus: '{{ $applicant['status'] }}',
    scoreQuran: {{ $applicant['test_score']['quran'] ?? 85 }},
    scoreArabic: {{ $applicant['test_score']['arabic'] ?? 80 }},
    scoreAcademic: {{ $applicant['test_score']['academic'] ?? 78 }},
    scoreInterview: {{ $applicant['test_score']['interview'] ?? 88 }},

    get averageScore() {
        return Math.round((Number(this.scoreQuran) + Number(this.scoreArabic) + Number(this.scoreAcademic) + Number(this.scoreInterview)) / 4);
    },

    setDecision(decision) {
        this.applicantStatus = decision;
        $store.sim.addToast('Keputusan Disimpan', `Status calon santri {{ $applicant['name'] }} ditetapkan: ${decision}`, decision === 'Lulus' ? 'success' : 'info');
    },

    activateStudent() {
        const newNis = '2024' + String($store.sim.students.length + 1).padStart(4, '0');
        $store.sim.students.unshift({
            id: 'STU-' + ($store.sim.students.length + 1),
            nis: newNis,
            nisn: '008' + Math.floor(1000000 + Math.random() * 8999999),
            name: '{{ $applicant['name'] }}',
            gender: '{{ $applicant['gender'] }}',
            level: '{{ $applicant['level_target'] }}',
            class: '{{ $applicant['level_target'] === 'SMA' ? 'Kelas X-MIPA (Putra)' : 'Kelas VII-A (Putra)' }}',
            dorm: 'Gedung Al-Fatih / Kmr 101',
            parent_name: '{{ $applicant['parent_name'] }}',
            parent_phone: '{{ $applicant['parent_phone'] }}',
            parent_job: 'Wiraswasta',
            birth_place: 'Surabaya',
            birth_date: '12 Agustus 2012',
            join_year: '2024/2025',
            status: 'Aktif',
            avatar: '{{ asset('assets/images/avatar/avatar-s-12.png') }}',
            qr_token: 'KTS-PESANTREN-' + newNis,
            attendance_summary: { hadir: 100, izin: 0, sakit: 0, alfa: 0 },
            violations_count: 0,
            achievements_count: 0
        });

        this.applicantStatus = 'Diterima';
        $store.sim.addToast('Santri Berhasil Diaktifkan!', `{{ $applicant['name'] }} resmi menjadi santri aktif dengan NIS ${newNis}. KTS digital dan akun telah dibuat.`, 'success');
        
        setTimeout(() => {
            window.location.href = '/admin/students';
        }, 1200);
    }
}">

    <!-- STATUS BANNER -->
    <div class="p-4 rounded-2xl border flex items-center justify-between"
         :class="{
             'bg-emerald-50 border-emerald-200 text-emerald-900': ['Lulus', 'Diterima'].includes(applicantStatus),
             'bg-amber-50 border-amber-200 text-amber-900': ['Menunggu Verifikasi', 'Draft'].includes(applicantStatus),
             'bg-blue-50 border-blue-200 text-blue-900': applicantStatus === 'Terverifikasi',
             'bg-purple-50 border-purple-200 text-purple-900': ['Menunggu Tes', 'Sudah Mengikuti Tes'].includes(applicantStatus),
             'bg-red-50 border-red-200 text-red-900': ['Tidak Lulus', 'Perlu Perbaikan Berkas'].includes(applicantStatus)
         }">
        <div class="flex items-center gap-3">
            <i data-lucide="info" class="w-5 h-5 shrink-0"></i>
            <div>
                <span class="text-xs font-bold uppercase tracking-wider block">Status Saat Ini:</span>
                <span class="text-sm font-extrabold" x-text="applicantStatus"></span>
            </div>
        </div>

        <template x-if="applicantStatus === 'Lulus'">
            <button type="button" 
                    @click="activateStudent()" 
                    class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs rounded-xl shadow-md flex items-center gap-1.5 transition-all">
                <i data-lucide="user-check" class="w-4 h-4"></i>
                <span>Aktivasi Santri Baru Sekarang</span>
            </button>
        </template>
    </div>

    <!-- 1. VERIFIKASI KELENGKAPAN BERKAS -->
    <div class="bg-white p-6 rounded-3xl border border-slate-200 shadow-2xs space-y-4">
        <h3 class="text-sm font-bold text-slate-900 pb-2 border-b border-slate-100 flex items-center gap-2">
            <i data-lucide="folder-check" class="w-4 h-4 text-emerald-600"></i>
            <span>1. Verifikasi Kelengkapan Dokumen Fisik / Digital</span>
        </h3>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-xs">
            <div class="p-3.5 rounded-xl border border-slate-200 bg-slate-50 flex items-center justify-between">
                <div>
                    <span class="font-bold text-slate-800 block">Kartu Keluarga (KK)</span>
                    <span class="text-[10px] text-slate-400">PDF Terlampir (Scan Asli)</span>
                </div>
                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800">Valid</span>
            </div>

            <div class="p-3.5 rounded-xl border border-slate-200 bg-slate-50 flex items-center justify-between">
                <div>
                    <span class="font-bold text-slate-800 block">Akta Kelahiran</span>
                    <span class="text-[10px] text-slate-400">PDF Terlampir (Scan Asli)</span>
                </div>
                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800">Valid</span>
            </div>

            <div class="p-3.5 rounded-xl border border-slate-200 bg-slate-50 flex items-center justify-between">
                <div>
                    <span class="font-bold text-slate-800 block">Rapor 2 Semester Terakhir</span>
                    <span class="text-[10px] text-slate-400">PDF Terlampir (Legalisir)</span>
                </div>
                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800">Valid</span>
            </div>

            <div class="p-3.5 rounded-xl border border-slate-200 bg-slate-50 flex items-center justify-between">
                <div>
                    <span class="font-bold text-slate-800 block">Surat Keterangan Sehat & Bebas TBC/Hepatitis</span>
                    <span class="text-[10px] text-slate-400">PDF Terlampir dari Dokter</span>
                </div>
                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800">Valid</span>
            </div>
        </div>
    </div>

    <!-- 2. INPUT & MONITORING NILAI SELEKSI -->
    <div class="bg-white p-6 rounded-3xl border border-slate-200 shadow-2xs space-y-4">
        <div class="flex items-center justify-between pb-2 border-b border-slate-100">
            <h3 class="text-sm font-bold text-slate-900 flex items-center gap-2">
                <i data-lucide="edit-3" class="w-4 h-4 text-primary-700"></i>
                <span>2. Penilaian Ujian Seleksi Masuk</span>
            </h3>
            <span class="text-xs font-bold bg-primary-50 text-primary-900 px-3 py-1 rounded-xl">
                Rata-Rata Nilai: <strong class="text-secondary text-sm" x-text="averageScore"></strong>
            </span>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 text-xs">
            <div>
                <label class="block font-semibold text-slate-700 mb-1">Tes BTQ & Tahfidz</label>
                <input type="number" x-model="scoreQuran" min="0" max="100" class="w-full px-3 py-2 border border-slate-300 rounded-xl font-bold text-center text-sm">
            </div>

            <div>
                <label class="block font-semibold text-slate-700 mb-1">Tes Bahasa Arab Dasar</label>
                <input type="number" x-model="scoreArabic" min="0" max="100" class="w-full px-3 py-2 border border-slate-300 rounded-xl font-bold text-center text-sm">
            </div>

            <div>
                <label class="block font-semibold text-slate-700 mb-1">Tes Potensi Akademik</label>
                <input type="number" x-model="scoreAcademic" min="0" max="100" class="w-full px-3 py-2 border border-slate-300 rounded-xl font-bold text-center text-sm">
            </div>

            <div>
                <label class="block font-semibold text-slate-700 mb-1">Wawancara & Komitmen Wali</label>
                <input type="number" x-model="scoreInterview" min="0" max="100" class="w-full px-3 py-2 border border-slate-300 rounded-xl font-bold text-center text-sm">
            </div>
        </div>
    </div>

    <!-- 3. PENETAPAN KEPUTUSAN PANITIA PSB -->
    <div class="bg-white p-6 rounded-3xl border border-slate-200 shadow-2xs space-y-4">
        <h3 class="text-sm font-bold text-slate-900 pb-2 border-b border-slate-100 flex items-center gap-2">
            <i data-lucide="check-square" class="w-4 h-4 text-emerald-600"></i>
            <span>3. Keputusan Resmi Panitia PSB</span>
        </h3>

        <p class="text-xs text-slate-500">
            Pilih status penetapan hasil seleksi. Santri yang dinyatakan lulus dapat langsung diaktivasi menjadi santri aktif pesantren.
        </p>

        <div class="flex flex-wrap items-center gap-3 pt-2">
            <button type="button" @click="setDecision('Lulus')" class="px-5 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs rounded-xl shadow-xs transition-colors flex items-center gap-1.5">
                <i data-lucide="check-circle" class="w-4 h-4"></i>
                <span>Tetapkan Lulus Seleksi</span>
            </button>

            <button type="button" @click="setDecision('Tidak Lulus')" class="px-4 py-2.5 bg-red-100 hover:bg-red-200 text-red-700 font-bold text-xs rounded-xl transition-colors">
                Tetapkan Tidak Lulus
            </button>

            <button type="button" @click="setDecision('Perlu Perbaikan Berkas')" class="px-4 py-2.5 bg-amber-100 hover:bg-amber-200 text-amber-800 font-bold text-xs rounded-xl transition-colors">
                Minta Perbaikan Berkas
            </button>
        </div>
    </div>

</div>
@endsection
