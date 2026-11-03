@extends('layouts.app')

@section('title', 'Presensi Kelas Formal')

@section('breadcrumb')
<nav class="flex text-xs text-slate-500 font-medium mb-1">
    <ol class="inline-flex items-center space-x-1">
        <li class="inline-flex items-center"><a href="/dashboard" class="text-primary-600 hover:underline">SIM-Pesantren</a></li>
        <li><i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-400"></i></li>
        <li class="inline-flex items-center"><a href="/dashboard/akademik" class="text-primary-600 hover:underline">Akademik</a></li>
        <li><i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-400"></i></li>
        <li class="text-slate-800 font-bold">Presensi Formal</li>
    </ol>
</nav>
@endsection

@section('page-title')
Input & Rekapitulasi Presensi Santri Formal
@endsection

@section('page-subtitle')
Presensi harian pendidikan formal per jam pelajaran dan rombongan belajar.
@endsection

@section('page-actions')
<div class="flex items-center gap-2">
    <button type="button" 
            @click="markAll('Hadir')"
            class="px-3 py-2 bg-emerald-50 hover:bg-emerald-100 text-emerald-800 border border-emerald-200 text-xs font-bold rounded-lg shadow-2xs">
        Tandai Semua Hadir
    </button>
    <button type="button" 
            @click="saveAttendance()"
            class="px-4 py-2 bg-primary-800 hover:bg-primary-900 text-white text-xs font-bold rounded-lg shadow-sm flex items-center gap-1.5 transition-all">
        <i data-lucide="save" class="w-4 h-4"></i>
        <span>Simpan Presensi</span>
    </button>
</div>
@endsection

@section('content')
<div class="space-y-6" x-data="{
    selectedClass: 'Kelas VII-A (Putra)',
    attendanceDate: '2026-11-02',
    subject: 'Fiqih & Ushul Fiqih',
    
    get classStudents() {
        return $store.sim.students.filter(s => s.class.includes(this.selectedClass) || s.class.includes('VII-A')).slice(0, 20);
    },

    markAll(status) {
        this.classStudents.forEach(s => s.attendanceStatus = status);
        $store.sim.addToast('Presensi Diperbarui', `Seluruh santri kelas ditandai: ${status}`, 'info');
    },

    saveAttendance() {
        $store.sim.addToast('Presensi Berhasil Disimpan', `Presensi kelas ${this.selectedClass} mapel ${this.subject} tanggal ${this.attendanceDate} berhasil disimpan.`, 'success');
    }
}">

    <!-- SELECTOR BAR -->
    <div class="bg-white p-4 rounded-2xl border border-slate-200 shadow-2xs">
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 text-xs">
            <div>
                <label class="block font-semibold text-slate-700 mb-1">Pilih Kelas / Rombel</label>
                <select x-model="selectedClass" class="w-full py-2 px-3 border border-slate-200 rounded-xl bg-slate-50 font-bold">
                    <option value="Kelas VII-A (Putra)">Kelas VII-A (Putra)</option>
                    <option value="Kelas VII-B (Putri)">Kelas VII-B (Putri)</option>
                    <option value="Kelas VIII-A (Putra)">Kelas VIII-A (Putra)</option>
                    <option value="Kelas VIII-B (Putri)">Kelas VIII-B (Putri)</option>
                    <option value="Kelas IX-A (Putra)">Kelas IX-A (Putra)</option>
                    <option value="Kelas X-MIPA (Putra)">Kelas X-MIPA (Putra)</option>
                </select>
            </div>

            <div>
                <label class="block font-semibold text-slate-700 mb-1">Mata Pelajaran</label>
                <select x-model="subject" class="w-full py-2 px-3 border border-slate-200 rounded-xl bg-slate-50 font-bold">
                    <option value="Fiqih & Ushul Fiqih">Fiqih & Ushul Fiqih</option>
                    <option value="Bahasa Arab & Nahwu">Bahasa Arab & Nahwu</option>
                    <option value="Tahfidz Al-Quran">Tahfidz Al-Quran</option>
                    <option value="Matematika Umum">Matematika Umum</option>
                </select>
            </div>

            <div>
                <label class="block font-semibold text-slate-700 mb-1">Tanggal Pertemuan</label>
                <input type="date" x-model="attendanceDate" class="w-full py-2 px-3 border border-slate-200 rounded-xl bg-slate-50 font-bold">
            </div>
        </div>
    </div>

    <!-- TABLE INPUT PRESENSI -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-2xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-xs">
                <thead>
                    <tr class="bg-slate-50 text-slate-500 font-semibold border-b border-slate-100 uppercase tracking-wider">
                        <th class="py-3 px-4">No.</th>
                        <th class="py-3 px-4">Santri</th>
                        <th class="py-3 px-4">NIS</th>
                        <th class="py-3 px-4 text-center">Status Kehadiran</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    <template x-for="(st, index) in classStudents" :key="st.id">
                        <tr class="hover:bg-slate-50/60 transition-colors">
                            <td class="py-3 px-4 text-slate-400 font-mono" x-text="index + 1"></td>
                            <td class="py-3 px-4">
                                <div class="flex items-center gap-2.5">
                                    <img :src="st.avatar" class="w-7 h-7 rounded-full bg-slate-100 border" alt="">
                                    <span class="font-bold text-slate-900" x-text="st.name"></span>
                                </div>
                            </td>
                            <td class="py-3 px-4 font-mono font-medium text-slate-600" x-text="st.nis"></td>
                            <td class="py-3 px-4 text-center">
                                <div class="inline-flex rounded-xl p-1 bg-slate-100 gap-1 text-[11px] font-bold">
                                    <button type="button" 
                                            @click="st.attendanceStatus = 'Hadir'"
                                            class="px-3 py-1 rounded-lg transition-all"
                                            :class="(!st.attendanceStatus || st.attendanceStatus === 'Hadir') ? 'bg-emerald-600 text-white shadow-2xs' : 'text-slate-600 hover:text-slate-900'">
                                        Hadir
                                    </button>
                                    <button type="button" 
                                            @click="st.attendanceStatus = 'Izin'"
                                            class="px-3 py-1 rounded-lg transition-all"
                                            :class="st.attendanceStatus === 'Izin' ? 'bg-blue-600 text-white shadow-2xs' : 'text-slate-600 hover:text-slate-900'">
                                        Izin
                                    </button>
                                    <button type="button" 
                                            @click="st.attendanceStatus = 'Sakit'"
                                            class="px-3 py-1 rounded-lg transition-all"
                                            :class="st.attendanceStatus === 'Sakit' ? 'bg-amber-500 text-white shadow-2xs' : 'text-slate-600 hover:text-slate-900'">
                                        Sakit
                                    </button>
                                    <button type="button" 
                                            @click="st.attendanceStatus = 'Alfa'"
                                            class="px-3 py-1 rounded-lg transition-all"
                                            :class="st.attendanceStatus === 'Alfa' ? 'bg-red-600 text-white shadow-2xs' : 'text-slate-600 hover:text-slate-900'">
                                        Alfa
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
