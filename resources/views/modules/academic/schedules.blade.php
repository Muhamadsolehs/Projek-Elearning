@extends('layouts.app')

@section('title', 'Jadwal Pelajaran Formal')

@section('breadcrumb')
<nav class="flex text-xs text-slate-500 font-medium mb-1">
    <ol class="inline-flex items-center space-x-1">
        <li class="inline-flex items-center"><a href="/dashboard" class="text-primary-600 hover:underline">SIM-Pesantren</a></li>
        <li><i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-400"></i></li>
        <li class="inline-flex items-center"><a href="/dashboard/akademik" class="text-primary-600 hover:underline">Akademik</a></li>
        <li><i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-400"></i></li>
        <li class="text-slate-800 font-bold">Jadwal Pelajaran</li>
    </ol>
</nav>
@endsection

@section('page-title')
Matriks Jadwal Pelajaran Mingguan
@endsection

@section('page-subtitle')
Jadwal kegiatan belajar mengajar (KBM) pendidikan formal pesantren semester ganjil T.A 2026/2027.
@endsection

@section('content')
<div class="space-y-6" x-data="{ selectedDay: 'Senin', selectedClass: 'Kelas VII-A (Putra)' }">

    <!-- SELECTOR KELAS & HARI -->
    <div class="bg-white p-4 rounded-2xl border border-slate-200 shadow-2xs flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
        <div class="flex items-center gap-2">
            <span class="text-xs font-bold text-slate-600">Pilih Kelas:</span>
            <select x-model="selectedClass" class="py-1.5 px-3 border border-slate-200 rounded-lg text-xs font-bold bg-slate-50">
                <option value="Kelas VII-A (Putra)">Kelas VII-A (Putra)</option>
                <option value="Kelas VII-B (Putri)">Kelas VII-B (Putri)</option>
                <option value="Kelas VIII-A (Putra)">Kelas VIII-A (Putra)</option>
                <option value="Kelas X-MIPA (Putra)">Kelas X-MIPA (Putra)</option>
            </select>
        </div>

        <div class="inline-flex p-1 bg-slate-100 rounded-xl gap-1 text-xs font-bold overflow-x-auto">
            <template x-for="day in ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Sabtu', 'Ahad']" :key="day">
                <button type="button" 
                        @click="selectedDay = day"
                        class="px-3 py-1.5 rounded-lg transition-all"
                        :class="selectedDay === day ? 'bg-white text-primary-900 shadow-2xs' : 'text-slate-600 hover:text-slate-900'"
                        x-text="day">
                </button>
            </template>
        </div>
    </div>

    <!-- JADWAL SESI MATRIKS CARD -->
    <div class="bg-white rounded-3xl border border-slate-200 shadow-2xs p-6 space-y-4">
        <div class="flex items-center justify-between pb-3 border-b border-slate-100">
            <h3 class="text-sm font-bold text-slate-900" x-text="'Jadwal Hari ' + selectedDay + ' • ' + selectedClass"></h3>
            <span class="text-xs font-semibold bg-emerald-50 text-emerald-800 px-2.5 py-0.5 rounded-full">Aktif Berjalan</span>
        </div>

        <div class="space-y-3">
            <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200 flex flex-col sm:flex-row sm:items-center justify-between gap-3 text-xs">
                <div class="flex items-center gap-3">
                    <div class="p-2.5 rounded-xl bg-primary-800 text-accent font-bold font-mono text-center min-w-[90px]">
                        07:30 - 09:00
                    </div>
                    <div>
                        <span class="text-sm font-extrabold text-slate-900 block">Fiqih & Ushul Fiqih</span>
                        <span class="text-slate-500">Pengampu: Ust. Ahmad Fauzi, S.Pd.I • Ruang Kls 101</span>
                    </div>
                </div>
                <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800 self-start sm:self-center">
                    Sesi 1 (2 JP)
                </span>
            </div>

            <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200 flex flex-col sm:flex-row sm:items-center justify-between gap-3 text-xs">
                <div class="flex items-center gap-3">
                    <div class="p-2.5 rounded-xl bg-primary-800 text-accent font-bold font-mono text-center min-w-[90px]">
                        09:15 - 10:45
                    </div>
                    <div>
                        <span class="text-sm font-extrabold text-slate-900 block">Bahasa Arab & Nahwu</span>
                        <span class="text-slate-500">Pengampu: Usth. Siti Maryam, S.Pd • Ruang Kls 101</span>
                    </div>
                </div>
                <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-blue-100 text-blue-800 self-start sm:self-center">
                    Sesi 2 (2 JP)
                </span>
            </div>

            <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200 flex flex-col sm:flex-row sm:items-center justify-between gap-3 text-xs">
                <div class="flex items-center gap-3">
                    <div class="p-2.5 rounded-xl bg-primary-800 text-accent font-bold font-mono text-center min-w-[90px]">
                        11:00 - 12:15
                    </div>
                    <div>
                        <span class="text-sm font-extrabold text-slate-900 block">Matematika Umum</span>
                        <span class="text-slate-500">Pengampu: Ust. Drs. H. Mulyadi • Ruang Kls 101</span>
                    </div>
                </div>
                <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-purple-100 text-purple-800 self-start sm:self-center">
                    Sesi 3 (2 JP)
                </span>
            </div>
        </div>
    </div>

</div>
@endsection
