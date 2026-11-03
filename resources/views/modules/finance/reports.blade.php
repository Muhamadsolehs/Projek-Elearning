@extends('layouts.app')

@section('title', 'Laporan Keuangan & Arus Kas')

@section('breadcrumb')
<nav class="flex text-xs text-slate-500 font-medium mb-1">
    <ol class="inline-flex items-center space-x-1">
        <li class="inline-flex items-center"><a href="/dashboard" class="text-primary-600 hover:underline">SIM-Pesantren</a></li>
        <li><i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-400"></i></li>
        <li class="inline-flex items-center"><a href="/dashboard/keuangan" class="text-primary-600 hover:underline">Keuangan</a></li>
        <li><i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-400"></i></li>
        <li class="text-slate-800 font-bold">Laporan Kas</li>
    </ol>
</nav>
@endsection

@section('page-title')
Laporan Arus Kas & Rekapitulasi SPP
@endsection

@section('page-subtitle')
Ringkasan penerimaan kas pesantren, realisasi target pendapatan, dan rekap tunggakan santri.
@endsection

@section('page-actions')
<button type="button" 
        @click="$store.sim.addToast('Laporan Diekspor', 'Laporan keuangan berhasil diekspor ke PDF.', 'success')" 
        class="px-3.5 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold rounded-lg shadow-sm flex items-center gap-1.5 transition-all">
    <i data-lucide="download" class="w-4 h-4"></i>
    <span>Unduh Laporan Keuangan (PDF)</span>
</button>
@endsection

@section('content')
<div class="space-y-6">

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-2xs">
            <span class="text-xs font-bold text-slate-500 uppercase block">Total Penerimaan Kas</span>
            <span class="text-2xl font-black text-emerald-700 mt-1 block">Rp 184.500.000</span>
            <span class="text-[11px] text-slate-400">Semester Ganjil 2026/2027</span>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-2xs">
            <span class="text-xs font-bold text-slate-500 uppercase block">Penerimaan Tunai Loket</span>
            <span class="text-2xl font-black text-primary-900 mt-1 block">Rp 48.250.000</span>
            <span class="text-[11px] text-slate-400">Pembayaran Langsung</span>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-2xs">
            <span class="text-xs font-bold text-slate-500 uppercase block">Penerimaan Transfer Bank</span>
            <span class="text-2xl font-black text-blue-700 mt-1 block">Rp 136.250.000</span>
            <span class="text-[11px] text-slate-400">BSI & Bank Muamalat</span>
        </div>
    </div>

</div>
@endsection
