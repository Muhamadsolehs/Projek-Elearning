@extends('layouts.app')

@section('title', 'Rekapitulasi Nilai & Rapor')

@section('breadcrumb')
<nav class="flex text-xs text-slate-500 font-medium mb-1">
    <ol class="inline-flex items-center space-x-1">
        <li class="inline-flex items-center"><a href="/dashboard" class="text-primary-600 hover:underline">SIM-Pesantren</a></li>
        <li><i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-400"></i></li>
        <li class="inline-flex items-center"><a href="/dashboard/akademik" class="text-primary-600 hover:underline">Akademik</a></li>
        <li><i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-400"></i></li>
        <li class="text-slate-800 font-bold">Nilai & Rapor</li>
    </ol>
</nav>
@endsection

@section('page-title')
Leger Nilai & Penilaian Rapor Santri
@endsection

@section('page-subtitle')
Input dan rekap nilai Tugas, Ulangan Harian (UH), Penilaian Tengah Semester (PTS), dan Akhir Semester (PAS).
@endsection

@section('page-actions')
<button type="button" 
        @click="$store.sim.addToast('Cetak Leger Sukses', 'Leger nilai kelas berhasil digenerate dalam format PDF siap cetak.', 'success')" 
        class="px-3.5 py-2 bg-primary-800 hover:bg-primary-900 text-white text-xs font-bold rounded-lg shadow-sm flex items-center gap-1.5 transition-all">
    <i data-lucide="printer" class="w-4 h-4 text-accent"></i>
    <span>Cetak Leger Nilai</span>
</button>
@endsection

@section('content')
<div class="space-y-6" x-data="{
    selectedClass: 'Kelas VII-A (Putra)',
    selectedSubject: 'Fiqih & Ushul Fiqih',

    saveGrades() {
        $store.sim.addToast('Nilai Disimpan', 'Seluruh entri nilai tugas dan ujian berhasil diperbarui.', 'success');
    }
}">

    <!-- SELECTOR -->
    <div class="bg-white p-4 rounded-2xl border border-slate-200 shadow-2xs flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 text-xs">
        <div class="flex flex-wrap items-center gap-3">
            <div>
                <span class="text-slate-500 font-semibold mr-1">Rombel:</span>
                <select x-model="selectedClass" class="py-1 px-3 border border-slate-200 rounded-lg bg-slate-50 font-bold">
                    <option value="Kelas VII-A (Putra)">Kelas VII-A (Putra)</option>
                    <option value="Kelas VII-B (Putri)">Kelas VII-B (Putri)</option>
                    <option value="Kelas VIII-A (Putra)">Kelas VIII-A (Putra)</option>
                </select>
            </div>
            <div>
                <span class="text-slate-500 font-semibold mr-1">Mata Pelajaran:</span>
                <select x-model="selectedSubject" class="py-1 px-3 border border-slate-200 rounded-lg bg-slate-50 font-bold">
                    <option value="Fiqih & Ushul Fiqih">Fiqih & Ushul Fiqih (KKM: 75)</option>
                    <option value="Bahasa Arab & Nahwu">Bahasa Arab & Nahwu (KKM: 75)</option>
                    <option value="Matematika Umum">Matematika Umum (KKM: 70)</option>
                </select>
            </div>
        </div>

        <button type="button" @click="saveGrades()" class="px-3.5 py-1.5 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-lg shadow-2xs">
            Simpan Perubahan Nilai
        </button>
    </div>

    <!-- TABLE LEGER -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-2xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-xs">
                <thead>
                    <tr class="bg-slate-50 text-slate-500 font-semibold border-b border-slate-100 uppercase tracking-wider">
                        <th class="py-3 px-4">Santri</th>
                        <th class="py-3 px-4">NIS</th>
                        <th class="py-3 px-4 text-center">Tugas & Kuis (20%)</th>
                        <th class="py-3 px-4 text-center">Ulangan Harian (20%)</th>
                        <th class="py-3 px-4 text-center">PTS (30%)</th>
                        <th class="py-3 px-4 text-center">PAS (30%)</th>
                        <th class="py-3 px-4 text-center">Nilai Akhir</th>
                        <th class="py-3 px-4 text-center">Predikat</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    <template x-for="st in $store.sim.students.slice(0, 10)" :key="st.id">
                        <tr class="hover:bg-slate-50/60 transition-colors">
                            <td class="py-3 px-4 font-bold text-slate-800" x-text="st.name"></td>
                            <td class="py-3 px-4 font-mono text-slate-500" x-text="st.nis"></td>
                            <td class="py-3 px-4 text-center font-bold text-slate-700">88</td>
                            <td class="py-3 px-4 text-center font-bold text-slate-700">85</td>
                            <td class="py-3 px-4 text-center font-bold text-slate-700">86</td>
                            <td class="py-3 px-4 text-center font-bold text-slate-700">90</td>
                            <td class="py-3 px-4 text-center font-black text-primary-900 bg-primary-50/40">87.5</td>
                            <td class="py-3 px-4 text-center">
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800">A (Sangat Baik)</span>
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
