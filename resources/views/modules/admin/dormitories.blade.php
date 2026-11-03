@extends('layouts.app')

@section('title', 'Gedung Asrama & Kamar')

@section('breadcrumb')
<nav class="flex text-xs text-slate-500 font-medium mb-1">
    <ol class="inline-flex items-center space-x-1">
        <li class="inline-flex items-center"><a href="/dashboard" class="text-primary-600 hover:underline">SIM-Pesantren</a></li>
        <li><i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-400"></i></li>
        <li class="inline-flex items-center text-slate-500">Administrasi</li>
        <li><i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-400"></i></li>
        <li class="text-slate-800 font-bold">Asrama & Kamar</li>
    </ol>
</nav>
@endsection

@section('page-title')
Manajemen Gedung Asrama & Kapasitas Kamar
@endsection

@section('page-subtitle')
Kapasitas daya tampung 5 kompleks gedung asrama santri putra dan santri putri.
@endsection

@section('content')
<div class="space-y-6">

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
        <template x-for="d in $store.sim.dorms" :key="d.id">
            <div class="bg-white p-6 rounded-3xl border border-slate-200 shadow-2xs flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between mb-3">
                        <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold"
                              :class="d.gender === 'L' ? 'bg-blue-100 text-blue-800' : 'bg-pink-100 text-pink-800'"
                              x-text="d.gender === 'L' ? 'Asrama Putra' : 'Asrama Putri'"></span>
                        <span class="font-mono text-xs text-slate-400 font-bold" x-text="d.id"></span>
                    </div>

                    <h3 class="text-base font-extrabold text-slate-900" x-text="d.name"></h3>
                    <p class="text-xs text-slate-500 mt-1" x-text="d.rooms_count + ' Kamar Hunian Santri'"></p>

                    <div class="mt-4 space-y-1.5 text-xs">
                        <div class="flex justify-between font-semibold">
                            <span class="text-slate-600">Okupansi Bed</span>
                            <span class="text-slate-900" x-text="d.occupied + ' / ' + d.capacity + ' Bed'"></span>
                        </div>
                        <div class="w-full bg-slate-100 rounded-full h-2">
                            <div class="bg-primary-700 h-2 rounded-full" :style="'width: ' + Math.round((d.occupied / d.capacity) * 100) + '%'"></div>
                        </div>
                    </div>
                </div>

                <div class="mt-5 pt-3 border-t border-slate-100 flex items-center justify-between text-xs">
                    <span class="text-slate-500">Tersedia Kosong:</span>
                    <strong class="text-emerald-700" x-text="(d.capacity - d.occupied) + ' Bed'"></strong>
                </div>
            </div>
        </template>
    </div>

</div>
@endsection
