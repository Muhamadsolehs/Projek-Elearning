@extends('layouts.app')

@section('title', 'Audit Log Aktivitas Sistem')

@section('breadcrumb')
<nav class="flex text-xs text-slate-500 font-medium mb-1">
    <ol class="inline-flex items-center space-x-1">
        <li class="inline-flex items-center"><a href="/dashboard" class="text-primary-600 hover:underline">SIM-Pesantren</a></li>
        <li><i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-400"></i></li>
        <li class="inline-flex items-center text-slate-500">Pengaturan</li>
        <li><i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-400"></i></li>
        <li class="text-slate-800 font-bold">Audit Log</li>
    </ol>
</nav>
@endsection

@section('page-title')
Audit Log & Jejak Rekam Aktivitas Sistem
@endsection

@section('page-subtitle')
Rekam jejak setiap aksi krusial pengguna pada modul santri, nilai, keuangan, perpustakaan, dan perizinan.
@endsection

@section('content')
<div class="space-y-6">

    <div class="bg-white rounded-3xl border border-slate-200 shadow-2xs overflow-hidden">
        <div class="px-5 py-4 border-b border-slate-100 flex items-center justify-between">
            <h3 class="text-sm font-bold text-slate-900">Catatan Aktivitas Terbaru</h3>
            <span class="text-xs font-semibold bg-slate-100 text-slate-700 px-2.5 py-0.5 rounded-full">Real-time Stream</span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-xs">
                <thead>
                    <tr class="bg-slate-50 text-slate-500 font-semibold border-b border-slate-100 uppercase tracking-wider">
                        <th class="py-3 px-4">Waktu</th>
                        <th class="py-3 px-4">Pengguna (User)</th>
                        <th class="py-3 px-4">Peran (Role)</th>
                        <th class="py-3 px-4">Modul</th>
                        <th class="py-3 px-4">Aktivitas / Operasi</th>
                        <th class="py-3 px-4">Alamat IP</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($audit_logs as $log)
                    <tr class="hover:bg-slate-50/60 transition-colors">
                        <td class="py-3 px-4 text-slate-500 font-medium">{{ $log['time'] }}</td>
                        <td class="py-3 px-4 font-bold text-slate-900">{{ $log['user'] }}</td>
                        <td class="py-3 px-4">
                            <span class="px-2 py-0.5 rounded text-[10px] font-semibold bg-slate-100 text-slate-800">
                                {{ $log['role'] }}
                            </span>
                        </td>
                        <td class="py-3 px-4">
                            <span class="font-semibold text-primary-700">{{ $log['module'] }}</span>
                        </td>
                        <td class="py-3 px-4 font-medium text-slate-800">{{ $log['action'] }}</td>
                        <td class="py-3 px-4 font-mono text-slate-400">{{ $log['ip'] }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
