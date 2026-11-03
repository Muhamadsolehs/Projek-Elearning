@extends('layouts.app')

@section('title', 'Jadwal & Penilaian Tes PSB')

@section('breadcrumb')
<nav class="flex text-xs text-slate-500 font-medium mb-1">
    <ol class="inline-flex items-center space-x-1">
        <li class="inline-flex items-center"><a href="/dashboard" class="text-primary-600 hover:underline">SIM-Pesantren</a></li>
        <li><i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-400"></i></li>
        <li class="inline-flex items-center"><a href="/admissions/applicants" class="text-primary-600 hover:underline">PSB</a></li>
        <li><i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-400"></i></li>
        <li class="text-slate-800 font-bold">Jadwal & Nilai Tes</li>
    </ol>
</nav>
@endsection

@section('page-title')
Jadwal & Rekapitulasi Nilai Tes Seleksi Masuk
@endsection

@section('page-subtitle')
Input dan pantau hasil tes BTQ (Baca Tulis Qur'an), Bahasa Arab, Potensi Akademik, dan Wawancara calon santri.
@endsection

@section('content')
<div class="space-y-6">

    <div class="bg-white rounded-2xl border border-slate-200 shadow-2xs overflow-hidden">
        <div class="px-5 py-4 border-b border-slate-100 flex items-center justify-between">
            <h3 class="text-sm font-bold text-slate-900">Rekapitulasi Nilai Peserta Seleksi</h3>
            <span class="text-xs font-semibold bg-primary-50 text-primary-800 px-3 py-1 rounded-full">Gelombang 1</span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-xs">
                <thead>
                    <tr class="bg-slate-50 text-slate-500 font-semibold border-b border-slate-100 uppercase tracking-wider">
                        <th class="py-3 px-4">No. Registrasi</th>
                        <th class="py-3 px-4">Calon Santri</th>
                        <th class="py-3 px-4 text-center">BTQ & Tahfidz</th>
                        <th class="py-3 px-4 text-center">B. Arab</th>
                        <th class="py-3 px-4 text-center">Akademik</th>
                        <th class="py-3 px-4 text-center">Wawancara</th>
                        <th class="py-3 px-4 text-center">Rata-Rata</th>
                        <th class="py-3 px-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($admissions as $adm)
                    <tr class="hover:bg-slate-50/60 transition-colors">
                        <td class="py-3 px-4 font-mono font-bold text-primary-900">{{ $adm['registration_number'] }}</td>
                        <td class="py-3 px-4 font-bold text-slate-800">{{ $adm['name'] }}</td>
                        <td class="py-3 px-4 text-center font-bold text-emerald-700">{{ $adm['test_score']['quran'] ?? 85 }}</td>
                        <td class="py-3 px-4 text-center font-bold text-slate-700">{{ $adm['test_score']['arabic'] ?? 78 }}</td>
                        <td class="py-3 px-4 text-center font-bold text-slate-700">{{ $adm['test_score']['academic'] ?? 80 }}</td>
                        <td class="py-3 px-4 text-center font-bold text-slate-700">{{ $adm['test_score']['interview'] ?? 88 }}</td>
                        <td class="py-3 px-4 text-center font-extrabold text-primary-900 bg-primary-50/30">
                            {{ $adm['test_score']['average'] ?? 83 }}
                        </td>
                        <td class="py-3 px-4 text-center">
                            <a href="/admissions/applicants/{{ $adm['id'] }}/verify" class="text-secondary font-bold hover:underline">
                                Edit Nilai &rarr;
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
