@extends('layouts.app')

@section('title', 'Data Guru & Asatidz')

@section('breadcrumb')
<nav class="flex text-xs text-slate-500 font-medium mb-1">
    <ol class="inline-flex items-center space-x-1">
        <li class="inline-flex items-center"><a href="/dashboard" class="text-primary-600 hover:underline">SIM-Pesantren</a></li>
        <li><i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-400"></i></li>
        <li class="inline-flex items-center text-slate-500">Administrasi</li>
        <li><i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-400"></i></li>
        <li class="text-slate-800 font-bold">Guru & Asatidz</li>
    </ol>
</nav>
@endsection

@section('page-title')
Manajemen Data Pendidik & Asatidz
@endsection

@section('page-subtitle')
Data 10 tenaga pendidik formal dan ustadz pengampu diniyah pesantren.
@endsection

@section('content')
<div class="space-y-6">

    <div class="bg-white rounded-3xl border border-slate-200 shadow-2xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-xs">
                <thead>
                    <tr class="bg-slate-50 text-slate-500 font-semibold border-b border-slate-100 uppercase tracking-wider">
                        <th class="py-3 px-4">Nama Ustadz / Guru</th>
                        <th class="py-3 px-4">NIP / NIY</th>
                        <th class="py-3 px-4">Mata Pelajaran Utama</th>
                        <th class="py-3 px-4">Tugas Tambahan</th>
                        <th class="py-3 px-4">No. WhatsApp</th>
                        <th class="py-3 px-4 text-center">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    <template x-for="t in $store.sim.teachers" :key="t.id">
                        <tr class="hover:bg-slate-50/60 transition-colors">
                            <td class="py-3 px-4 font-bold text-slate-900" x-text="t.name"></td>
                            <td class="py-3 px-4 font-mono text-slate-600" x-text="t.nip"></td>
                            <td class="py-3 px-4 font-semibold text-primary-800" x-text="t.subject"></td>
                            <td class="py-3 px-4">
                                <span class="px-2 py-0.5 rounded text-[11px] font-semibold bg-purple-50 text-purple-700" x-text="t.role"></span>
                            </td>
                            <td class="py-3 px-4 font-mono text-slate-600" x-text="t.phone"></td>
                            <td class="py-3 px-4 text-center">
                                <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800" x-text="t.status"></span>
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
