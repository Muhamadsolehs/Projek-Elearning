@extends('layouts.app')

@section('title', 'Pos Tarif Pembayaran')

@section('breadcrumb')
<nav class="flex text-xs text-slate-500 font-medium mb-1">
    <ol class="inline-flex items-center space-x-1">
        <li class="inline-flex items-center"><a href="/dashboard" class="text-primary-600 hover:underline">SIM-Pesantren</a></li>
        <li><i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-400"></i></li>
        <li class="inline-flex items-center"><a href="/dashboard/keuangan" class="text-primary-600 hover:underline">Keuangan</a></li>
        <li><i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-400"></i></li>
        <li class="text-slate-800 font-bold">Pos Tarif</li>
    </ol>
</nav>
@endsection

@section('page-title')
Master Pos Tarif & Biaya Pendidikan
@endsection

@section('page-subtitle')
Pengaturan jenis tagihan, nominal tarif baku, dan jadwal siklus tagihan santri.
@endsection

@section('content')
<div class="space-y-6">

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        
        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-2xs">
            <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-blue-50 text-blue-800">Bulanan (SPP)</span>
            <h3 class="text-base font-extrabold text-slate-900 mt-2">SPP & Uang Makan Santri</h3>
            <p class="text-xs text-slate-500 mt-1">Biaya operasional pendidikan dan 3x makan santri setiap hari.</p>
            <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between">
                <span class="text-xs text-slate-500">Nominal:</span>
                <span class="font-extrabold text-primary-900 text-base">Rp 1.250.000 / bln</span>
            </div>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-2xs">
            <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-emerald-50 text-emerald-800">Tahunan</span>
            <h3 class="text-base font-extrabold text-slate-900 mt-2">Uang Masuk & Pangkal Santri</h3>
            <p class="text-xs text-slate-500 mt-1">Biaya sarana prasarana asrama, ranjang, kasur, dan seragam.</p>
            <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between">
                <span class="text-xs text-slate-500">Nominal:</span>
                <span class="font-extrabold text-primary-900 text-base">Rp 4.500.000</span>
            </div>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-2xs">
            <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-amber-50 text-amber-800">Per Semester</span>
            <h3 class="text-base font-extrabold text-slate-900 mt-2">Biaya Ujian & Kegiatan Santri</h3>
            <p class="text-xs text-slate-500 mt-1">Biaya naskah ujian PTS/PAS, munaqosyah tahfidz, dan ekstrakurikuler.</p>
            <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between">
                <span class="text-xs text-slate-500">Nominal:</span>
                <span class="font-extrabold text-primary-900 text-base">Rp 350.000</span>
            </div>
        </div>

    </div>

</div>
@endsection
