@extends('layouts.app')

@section('title', 'Pusat Notifikasi')

@section('breadcrumb')
<nav class="flex text-xs text-slate-500 font-medium mb-1">
    <ol class="inline-flex items-center space-x-1">
        <li class="inline-flex items-center"><a href="/dashboard" class="text-primary-600 hover:underline">SIM-Pesantren</a></li>
        <li><i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-400"></i></li>
        <li class="inline-flex items-center text-slate-500">Pengaturan</li>
        <li><i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-400"></i></li>
        <li class="text-slate-800 font-bold">Notifikasi</li>
    </ol>
</nav>
@endsection

@section('page-title')
Pusat Notifikasi & Informasi Terpadu
@endsection

@section('page-subtitle')
Pemberitahuan terkini seputar pendaftaran santri baru, verifikasi keuangan, izin keluar asrama, dan perpustakaan.
@endsection

@section('content')
<div class="max-w-4xl mx-auto space-y-4">

    <div class="p-4 bg-white rounded-2xl border border-slate-200 shadow-2xs flex items-start gap-4">
        <div class="w-10 h-10 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center shrink-0">
            <i data-lucide="user-plus" class="w-5 h-5"></i>
        </div>
        <div class="flex-1">
            <div class="flex items-center justify-between">
                <h4 class="text-xs font-bold text-slate-900">Pendaftar Calon Santri Baru (PSB)</h4>
                <span class="text-[10px] text-slate-400">15 menit yang lalu</span>
            </div>
            <p class="text-xs text-slate-600 mt-0.5">Farhan Hakim telah menyelesaikan pendaftaran online Gelombang 1 untuk tingkat SMP. Berkas siap diverifikasi oleh panitia PSB.</p>
            <div class="mt-2">
                <a href="/admissions/applicants" class="text-xs font-bold text-emerald-700 hover:underline">Buka Berkas Pendaftar &rarr;</a>
            </div>
        </div>
    </div>

    <div class="p-4 bg-white rounded-2xl border border-slate-200 shadow-2xs flex items-start gap-4">
        <div class="w-10 h-10 rounded-xl bg-blue-100 text-blue-600 flex items-center justify-center shrink-0">
            <i data-lucide="receipt" class="w-5 h-5"></i>
        </div>
        <div class="flex-1">
            <div class="flex items-center justify-between">
                <h4 class="text-xs font-bold text-slate-900">Bukti Pembayaran Bank Menunggu Verifikasi</h4>
                <span class="text-[10px] text-slate-400">32 menit yang lalu</span>
            </div>
            <p class="text-xs text-slate-600 mt-0.5">Wali santri Muhammad Pratama mengunggah bukti transfer BSI senilai Rp 1.250.000 untuk pelunasan SPP & Uang Makan November 2026.</p>
            <div class="mt-2">
                <a href="/finance/bills" class="text-xs font-bold text-blue-700 hover:underline">Verifikasi Pembayaran &rarr;</a>
            </div>
        </div>
    </div>

    <div class="p-4 bg-white rounded-2xl border border-slate-200 shadow-2xs flex items-start gap-4">
        <div class="w-10 h-10 rounded-xl bg-amber-100 text-amber-600 flex items-center justify-center shrink-0">
            <i data-lucide="clock" class="w-5 h-5"></i>
        </div>
        <div class="flex-1">
            <div class="flex items-center justify-between">
                <h4 class="text-xs font-bold text-slate-900">Permohonan Izin Keluar Asrama</h4>
                <span class="text-[10px] text-slate-400">1 jam yang lalu</span>
            </div>
            <p class="text-xs text-slate-600 mt-0.5">Santri Wildan Al-Ghifari (Gedung Al-Faruq) mengajukan izin kontrol medis gigi ke RSUD pada tanggal 02 November sore.</p>
            <div class="mt-2">
                <a href="/dormitory/permissions" class="text-xs font-bold text-amber-700 hover:underline">Periksa Permohonan Izin &rarr;</a>
            </div>
        </div>
    </div>

    <div class="p-4 bg-white rounded-2xl border border-slate-200 shadow-2xs flex items-start gap-4">
        <div class="w-10 h-10 rounded-xl bg-red-100 text-red-600 flex items-center justify-center shrink-0">
            <i data-lucide="book-open" class="w-5 h-5"></i>
        </div>
        <div class="flex-1">
            <div class="flex items-center justify-between">
                <h4 class="text-xs font-bold text-slate-900">Peringatan Keterlambatan Sirkulasi Kitab</h4>
                <span class="text-[10px] text-slate-400">2 jam yang lalu</span>
            </div>
            <p class="text-xs text-slate-600 mt-0.5">Terdapat 8 eksemplar kitab yang melewati batas pengembalian lebih dari 3 hari. Notifikasi tagihan denda telah dikirimkan ke akun santri bersangkutan.</p>
            <div class="mt-2">
                <a href="/library/history" class="text-xs font-bold text-red-700 hover:underline">Buka Daftar Keterlambatan &rarr;</a>
            </div>
        </div>
    </div>

</div>
@endsection
