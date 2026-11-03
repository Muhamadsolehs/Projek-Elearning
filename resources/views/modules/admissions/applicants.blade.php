@extends('layouts.app')

@section('title', 'Pendaftar Calon Santri (PSB)')

@section('breadcrumb')
<nav class="flex text-xs text-slate-500 font-medium mb-1">
    <ol class="inline-flex items-center space-x-1">
        <li class="inline-flex items-center"><a href="/dashboard" class="text-primary-600 hover:underline">SIM-Pesantren</a></li>
        <li><i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-400"></i></li>
        <li class="inline-flex items-center"><a href="/dashboard/psb" class="text-primary-600 hover:underline">PSB</a></li>
        <li><i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-400"></i></li>
        <li class="text-slate-800 font-bold">Pendaftar & Pipeline</li>
    </ol>
</nav>
@endsection

@section('page-title')
Pipeline Pendaftaran Calon Santri Baru
@endsection

@section('page-subtitle')
Pantau dan kelola 20 calon santri baru sepanjang siklus seleksi penerimaan T.A 2026/2027.
@endsection

@section('page-actions')
<div class="flex items-center gap-2">
    <a href="/admissions/tests" class="px-3 py-2 bg-white border border-slate-200 text-slate-700 hover:bg-slate-50 text-xs font-semibold rounded-lg shadow-2xs flex items-center gap-1.5">
        <i data-lucide="clipboard-check" class="w-4 h-4 text-slate-500"></i>
        <span>Jadwal & Nilai Tes</span>
    </a>
    <a href="/admissions/selection-results" class="px-3.5 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold rounded-lg shadow-sm flex items-center gap-1.5 transition-all">
        <i data-lucide="award" class="w-4 h-4"></i>
        <span>Penetapan Kelulusan & Aktivasi</span>
    </a>
</div>
@endsection

@section('content')
<div class="space-y-6" x-data="{
    searchQuery: '',
    statusFilter: '',
    levelFilter: '',

    get filteredAdmissions() {
        return $store.sim.admissions.filter(a => {
            const matchSearch = !this.searchQuery || 
                a.name.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                a.registration_number.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                a.origin_school.toLowerCase().includes(this.searchQuery.toLowerCase());
            
            const matchStatus = !this.statusFilter || a.status === this.statusFilter;
            const matchLevel = !this.levelFilter || a.level_target === this.levelFilter;

            return matchSearch && matchStatus && matchLevel;
        });
    }
}">

    <!-- PIPELINE STATUS COUNTER -->
    <div class="grid grid-cols-2 sm:grid-cols-4 lg:grid-cols-6 gap-3">
        <button type="button" @click="statusFilter = ''" class="p-3 bg-white rounded-xl border text-center transition-all" :class="statusFilter === '' ? 'border-primary-600 shadow-2xs' : 'border-slate-200'">
            <span class="text-[10px] font-bold text-slate-500 uppercase block">Semua Pendaftar</span>
            <span class="text-xl font-extrabold text-slate-900 mt-0.5 block" x-text="$store.sim.admissions.length"></span>
        </button>

        <button type="button" @click="statusFilter = 'Menunggu Verifikasi'" class="p-3 bg-white rounded-xl border text-center transition-all" :class="statusFilter === 'Menunggu Verifikasi' ? 'border-amber-600 shadow-2xs' : 'border-slate-200'">
            <span class="text-[10px] font-bold text-amber-600 uppercase block">Menunggu Verif</span>
            <span class="text-xl font-extrabold text-amber-700 mt-0.5 block" x-text="$store.sim.admissions.filter(a => a.status === 'Menunggu Verifikasi').length"></span>
        </button>

        <button type="button" @click="statusFilter = 'Terverifikasi'" class="p-3 bg-white rounded-xl border text-center transition-all" :class="statusFilter === 'Terverifikasi' ? 'border-blue-600 shadow-2xs' : 'border-slate-200'">
            <span class="text-[10px] font-bold text-blue-600 uppercase block">Berkas Valid</span>
            <span class="text-xl font-extrabold text-blue-700 mt-0.5 block" x-text="$store.sim.admissions.filter(a => a.status === 'Terverifikasi').length"></span>
        </button>

        <button type="button" @click="statusFilter = 'Menunggu Tes'" class="p-3 bg-white rounded-xl border text-center transition-all" :class="statusFilter === 'Menunggu Tes' ? 'border-purple-600 shadow-2xs' : 'border-slate-200'">
            <span class="text-[10px] font-bold text-purple-600 uppercase block">Menunggu Tes</span>
            <span class="text-xl font-extrabold text-purple-700 mt-0.5 block" x-text="$store.sim.admissions.filter(a => a.status === 'Menunggu Tes').length"></span>
        </button>

        <button type="button" @click="statusFilter = 'Lulus'" class="p-3 bg-white rounded-xl border text-center transition-all" :class="statusFilter === 'Lulus' ? 'border-emerald-600 shadow-2xs' : 'border-slate-200'">
            <span class="text-[10px] font-bold text-emerald-600 uppercase block">Lulus Seleksi</span>
            <span class="text-xl font-extrabold text-emerald-700 mt-0.5 block" x-text="$store.sim.admissions.filter(a => a.status === 'Lulus').length"></span>
        </button>

        <button type="button" @click="statusFilter = 'Diterima'" class="p-3 bg-white rounded-xl border text-center transition-all" :class="statusFilter === 'Diterima' ? 'border-teal-600 shadow-2xs' : 'border-slate-200'">
            <span class="text-[10px] font-bold text-teal-600 uppercase block">Santri Aktif</span>
            <span class="text-xl font-extrabold text-teal-700 mt-0.5 block" x-text="$store.sim.admissions.filter(a => a.status === 'Diterima').length"></span>
        </button>
    </div>

    <!-- FILTER BAR -->
    <div class="bg-white p-4 rounded-2xl border border-slate-200 shadow-2xs">
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
            <div class="sm:col-span-2 relative">
                <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                    <i data-lucide="search" class="w-4 h-4"></i>
                </span>
                <input type="text" 
                       x-model="searchQuery" 
                       placeholder="Cari Nomor Registrasi, Nama Calon Santri, atau Asal Sekolah..." 
                       class="w-full pl-9 pr-4 py-2 text-xs bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary-500">
            </div>

            <div>
                <select x-model="levelFilter" class="w-full py-2 px-3 text-xs bg-slate-50 border border-slate-200 rounded-xl">
                    <option value="">Semua Target Jenjang</option>
                    <option value="SMP">Tingkat SMP (Tsanawiyah)</option>
                    <option value="SMA">Tingkat SMA (Aliyah)</option>
                </select>
            </div>
        </div>
    </div>

    <!-- TABEL PENDAFTAR -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-2xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-xs">
                <thead>
                    <tr class="bg-slate-50/80 text-slate-500 uppercase tracking-wider font-semibold border-b border-slate-100">
                        <th class="py-3 px-4">No. Registrasi</th>
                        <th class="py-3 px-4">Nama Calon Santri</th>
                        <th class="py-3 px-4">Target Jenjang</th>
                        <th class="py-3 px-4">Asal Sekolah</th>
                        <th class="py-3 px-4">Wali & Kontak</th>
                        <th class="py-3 px-4">Nilai Rata-rata Tes</th>
                        <th class="py-3 px-4 text-center">Status Pipeline</th>
                        <th class="py-3 px-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    <template x-for="a in filteredAdmissions" :key="a.id">
                        <tr class="hover:bg-slate-50/60 transition-colors">
                            <td class="py-3 px-4 font-mono font-bold text-primary-900" x-text="a.registration_number"></td>
                            <td class="py-3 px-4">
                                <span class="font-bold text-slate-800 block" x-text="a.name"></span>
                                <span class="text-[10px] text-slate-400" x-text="'Daftar: ' + a.register_date"></span>
                            </td>
                            <td class="py-3 px-4">
                                <span class="px-2 py-0.5 rounded text-[11px] font-semibold"
                                      :class="a.level_target === 'SMA' ? 'bg-indigo-50 text-indigo-700' : 'bg-blue-50 text-blue-700'"
                                      x-text="a.level_target"></span>
                            </td>
                            <td class="py-3 px-4 text-slate-600" x-text="a.origin_school"></td>
                            <td class="py-3 px-4">
                                <div class="font-semibold text-slate-800" x-text="a.parent_name"></div>
                                <div class="text-[10px] text-slate-400 font-mono" x-text="a.parent_phone"></div>
                            </td>
                            <td class="py-3 px-4">
                                <template x-if="a.test_score">
                                    <div>
                                        <span class="font-bold text-slate-900" x-text="a.test_score.average"></span>
                                        <span class="text-[10px] text-slate-400 font-medium block">BTQ, Arab, Akad</span>
                                    </div>
                                </template>
                                <template x-if="!a.test_score">
                                    <span class="text-slate-400 italic text-[11px]">Belum Tes</span>
                                </template>
                            </td>
                            <td class="py-3 px-4 text-center">
                                <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold"
                                      :class="{
                                          'bg-emerald-100 text-emerald-800': ['Lulus', 'Diterima'].includes(a.status),
                                          'bg-amber-100 text-amber-800': ['Menunggu Verifikasi', 'Draft'].includes(a.status),
                                          'bg-blue-100 text-blue-800': a.status === 'Terverifikasi',
                                          'bg-purple-100 text-purple-800': a.status === 'Menunggu Tes',
                                          'bg-indigo-100 text-indigo-800': a.status === 'Sudah Mengikuti Tes',
                                          'bg-red-100 text-red-800': ['Tidak Lulus', 'Perlu Perbaikan Berkas'].includes(a.status)
                                      }"
                                      x-text="a.status"></span>
                            </td>
                            <td class="py-3 px-4 text-center">
                                <a :href="'/admissions/applicants/' + a.id + '/verify'" class="px-2.5 py-1 bg-white hover:bg-slate-100 border border-slate-200 rounded font-bold text-slate-700 text-[11px] transition-colors">
                                    Verifikasi &rarr;
                                </a>
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
