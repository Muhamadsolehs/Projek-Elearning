@extends('layouts.app')

@section('title', 'Penetapan Kelulusan & Aktivasi Santri')

@section('breadcrumb')
<nav class="flex text-xs text-slate-500 font-medium mb-1">
    <ol class="inline-flex items-center space-x-1">
        <li class="inline-flex items-center"><a href="/dashboard" class="text-primary-600 hover:underline">SIM-Pesantren</a></li>
        <li><i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-400"></i></li>
        <li class="inline-flex items-center"><a href="/admissions/applicants" class="text-primary-600 hover:underline">PSB</a></li>
        <li><i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-400"></i></li>
        <li class="text-slate-800 font-bold">Penetapan Hasil & Aktivasi</li>
    </ol>
</nav>
@endsection

@section('page-title')
Penetapan Kelulusan & Konversi Santri Aktif
@endsection

@section('page-subtitle')
Calon santri yang dinyatakan lulus dapat dikonversi menjadi santri resmi. Sistem akan menerbitkan NIS, akun pengguna, dan KTS digital.
@endsection

@section('content')
<div class="space-y-6" x-data="{
    activateAll() {
        $store.sim.addToast('Aktivasi Massal Berhasil', 'Seluruh calon santri yang lulus seleksi telah berhasil dikonversi menjadi santri aktif dengan NIS baru.', 'success');
    }
}">

    <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-2xs flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h3 class="text-sm font-bold text-slate-900">Konfirmasi Penetapan SK Kelulusan Santri Baru</h3>
            <p class="text-xs text-slate-500 mt-0.5">Aktivasi dilakukan berdasarkan SK Panitia PSB resmi pesantren.</p>
        </div>
        <button type="button" @click="activateAll()" class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs rounded-xl shadow-xs flex items-center gap-1.5 transition-colors">
            <i data-lucide="check-check" class="w-4 h-4"></i>
            <span>Aktivasi Semua Calon Lulus</span>
        </button>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 shadow-2xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-xs">
                <thead>
                    <tr class="bg-slate-50 text-slate-500 font-semibold border-b border-slate-100 uppercase tracking-wider">
                        <th class="py-3 px-4">No. Registrasi</th>
                        <th class="py-3 px-4">Nama Calon Santri</th>
                        <th class="py-3 px-4">Jenjang Target</th>
                        <th class="py-3 px-4 text-center">Nilai Rata-rata</th>
                        <th class="py-3 px-4 text-center">Keputusan</th>
                        <th class="py-3 px-4 text-center">Aksi Administrasi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    <template x-for="adm in $store.sim.admissions.filter(a => ['Lulus', 'Diterima', 'Sudah Mengikuti Tes'].includes(a.status))" :key="adm.id">
                        <tr class="hover:bg-slate-50/60 transition-colors">
                            <td class="py-3 px-4 font-mono font-bold text-primary-900" x-text="adm.registration_number"></td>
                            <td class="py-3 px-4 font-bold text-slate-800" x-text="adm.name"></td>
                            <td class="py-3 px-4" x-text="adm.level_target"></td>
                            <td class="py-3 px-4 text-center font-extrabold text-emerald-700" x-text="adm.test_score ? adm.test_score.average : 85"></td>
                            <td class="py-3 px-4 text-center">
                                <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold"
                                      :class="adm.status === 'Diterima' ? 'bg-teal-100 text-teal-800' : 'bg-emerald-100 text-emerald-800'"
                                      x-text="adm.status"></span>
                            </td>
                            <td class="py-3 px-4 text-center">
                                <template x-if="adm.status === 'Lulus'">
                                    <a :href="'/admissions/applicants/' + adm.id + '/verify'" class="px-3 py-1 bg-emerald-600 hover:bg-emerald-700 text-white rounded font-bold text-[11px] transition-colors">
                                        Aktivasi & Terbitkan NIS
                                    </a>
                                </template>
                                <template x-if="adm.status === 'Diterima'">
                                    <span class="text-emerald-700 font-bold flex items-center justify-center gap-1">
                                        <i data-lucide="check" class="w-3.5 h-3.5"></i> Santri Aktif
                                    </span>
                                </template>
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
