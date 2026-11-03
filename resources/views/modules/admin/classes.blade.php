@extends('layouts.app')

@section('title', 'Kelas & Rombongan Belajar')

@section('breadcrumb')
<nav class="flex text-xs text-slate-500 font-medium mb-1">
    <ol class="inline-flex items-center space-x-1">
        <li class="inline-flex items-center"><a href="/dashboard" class="text-primary-600 hover:underline">SIM-Pesantren</a></li>
        <li><i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-400"></i></li>
        <li class="inline-flex items-center text-slate-500">Administrasi</li>
        <li><i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-400"></i></li>
        <li class="text-slate-800 font-bold">Kelas & Rombel</li>
    </ol>
</nav>
@endsection

@section('page-title')
Manajemen Kelas & Rombongan Belajar
@endsection

@section('page-subtitle')
Struktur 8 rombongan belajar tingkat SMP dan SMA beserta wali kelas penanggung jawab.
@endsection

@section('content')
<div class="space-y-6">

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <template x-for="c in $store.sim.classes" :key="c.id">
            <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-2xs flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <span class="px-2 py-0.5 rounded text-[10px] font-bold"
                              :class="c.level === 'SMA' ? 'bg-indigo-50 text-indigo-700' : 'bg-blue-50 text-blue-700'"
                              x-text="'Tingkat ' + c.level"></span>
                        <span class="font-mono text-xs text-slate-400" x-text="c.id"></span>
                    </div>
                    <h3 class="text-base font-extrabold text-slate-900" x-text="c.name"></h3>
                    <p class="text-xs text-slate-500 mt-1" x-text="'Wali: ' + c.homeroom"></p>
                </div>
                
                <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs font-semibold text-slate-600">
                    <span>Kapasitas Santri:</span>
                    <strong class="text-primary-800" x-text="c.students_count + ' Santri'"></strong>
                </div>
            </div>
        </template>
    </div>

</div>
@endsection
