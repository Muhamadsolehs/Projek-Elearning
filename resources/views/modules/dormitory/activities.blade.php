@extends('layouts.app')

@section('title', 'Jadwal Kegiatan Pesantren')

@section('breadcrumb')
<nav class="flex text-xs text-slate-500 font-medium mb-1">
    <ol class="inline-flex items-center space-x-1">
        <li class="inline-flex items-center"><a href="/dashboard" class="text-primary-600 hover:underline">SIM-Pesantren</a></li>
        <li><i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-400"></i></li>
        <li class="inline-flex items-center"><a href="/dashboard/keasramaan" class="text-primary-600 hover:underline">Keasramaan</a></li>
        <li><i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-400"></i></li>
        <li class="text-slate-800 font-bold">Kegiatan Pesantren</li>
    </ol>
</nav>
@endsection

@section('page-title')
Jadwal Kegiatan Diniyah & Halaqah Pesantren
@endsection

@section('page-subtitle')
Jadwal shalat berjamaah, setoran tahfidz Al-Qur'an, dan kajian kitab kuning asrama harian.
@endsection

@section('content')
<div class="space-y-6">

    <div class="bg-white rounded-3xl border border-slate-200 shadow-2xs p-6 space-y-4">
        <div class="flex items-center justify-between pb-3 border-b border-slate-100">
            <h3 class="text-sm font-bold text-slate-900">Rutinitas Harian Kehidupan Santri</h3>
            <span class="text-xs font-semibold bg-emerald-50 text-emerald-800 px-3 py-1 rounded-full">T.A 2026/2027</span>
        </div>

        <div class="space-y-3">
            <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200 flex items-center justify-between text-xs">
                <div class="flex items-center gap-3">
                    <div class="p-2.5 rounded-xl bg-primary-800 text-accent font-bold font-mono text-center min-w-[90px]">
                        04:00 - 05:30
                    </div>
                    <div>
                        <span class="font-bold text-slate-900 text-sm block">Qiyamul Lail, Shalat Subuh & Halaqah Tahfidz Pagi</span>
                        <span class="text-slate-500">Seluruh Santri • Masjid Jami' Pesantren • Wajib Hadir</span>
                    </div>
                </div>
                <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800">Diniyah Wajib</span>
            </div>

            <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200 flex items-center justify-between text-xs">
                <div class="flex items-center gap-3">
                    <div class="p-2.5 rounded-xl bg-primary-800 text-accent font-bold font-mono text-center min-w-[90px]">
                        07:15 - 12:15
                    </div>
                    <div>
                        <span class="font-bold text-slate-900 text-sm block">Pendidikan Formal Madrasah (KBM)</span>
                        <span class="text-slate-500">Gedung Pembelajaran Formal • Kurikulum Terpadu</span>
                    </div>
                </div>
                <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-blue-100 text-blue-800">Formal</span>
            </div>

            <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200 flex items-center justify-between text-xs">
                <div class="flex items-center gap-3">
                    <div class="p-2.5 rounded-xl bg-primary-800 text-accent font-bold font-mono text-center min-w-[90px]">
                        18:30 - 19:45
                    </div>
                    <div>
                        <span class="font-bold text-slate-900 text-sm block">Kajian Kitab Kuning & Halaqah Ba'da Maghrib</span>
                        <span class="text-slate-500">Kitab Fathul Qorib & Riyadush Shalihin • Asatidz Pengasuh</span>
                    </div>
                </div>
                <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-purple-100 text-purple-800">Sorogan & Bandongan</span>
            </div>
        </div>
    </div>

</div>
@endsection
