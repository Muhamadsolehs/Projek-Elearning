@extends('layouts.app')

@section('title', 'Matriks Role & Hak Akses (RBAC)')

@section('breadcrumb')
<nav class="flex text-xs text-slate-500 font-medium mb-1">
    <ol class="inline-flex items-center space-x-1">
        <li class="inline-flex items-center"><a href="/dashboard" class="text-primary-600 hover:underline">SIM-Pesantren</a></li>
        <li><i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-400"></i></li>
        <li class="inline-flex items-center text-slate-500">Pengaturan</li>
        <li><i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-400"></i></li>
        <li class="text-slate-800 font-bold">Matriks Hak Akses</li>
    </ol>
</nav>
@endsection

@section('page-title')
Matriks Hak Akses & Role-Based Access Control (RBAC)
@endsection

@section('page-subtitle')
Aturan hak akses granular untuk 11 peran pengguna sesuai dengan prinsip pemisahan tanggung jawab institusi.
@endsection

@section('page-actions')
<button type="button" 
        @click="$store.sim.addToast('Konfigurasi RBAC Disimpan', 'Aturan hak akses peran berhasil diperbarui ke sistem keamanan.', 'success')"
        class="px-3.5 py-2 bg-primary-800 hover:bg-primary-900 text-white text-xs font-bold rounded-lg shadow-sm flex items-center gap-1.5 transition-all">
    <i data-lucide="save" class="w-4 h-4"></i>
    <span>Simpan Hak Akses</span>
</button>
@endsection

@section('content')
<div class="space-y-6">

    <div class="bg-white rounded-3xl border border-slate-200 shadow-2xs overflow-hidden">
        <div class="px-5 py-4 border-b border-slate-100 flex items-center justify-between">
            <h3 class="text-sm font-bold text-slate-900">Matriks Hak Akses Modul</h3>
            <span class="text-xs font-bold bg-accent/20 text-accent-dark px-2.5 py-0.5 rounded-full">11 Role Sistem</span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-xs">
                <thead>
                    <tr class="bg-slate-50 text-slate-600 font-bold border-b border-slate-200">
                        <th class="py-3.5 px-4 sticky left-0 bg-slate-50 z-10">Modul Aplikasi</th>
                        <th class="py-3.5 px-3 text-center">Super Admin</th>
                        <th class="py-3.5 px-3 text-center">Admin Pesantren</th>
                        <th class="py-3.5 px-3 text-center">Admin PSB</th>
                        <th class="py-3.5 px-3 text-center">Admin Akad</th>
                        <th class="py-3.5 px-3 text-center">Guru</th>
                        <th class="py-3.5 px-3 text-center">Wali Kelas</th>
                        <th class="py-3.5 px-3 text-center">Keasramaan</th>
                        <th class="py-3.5 px-3 text-center">Keuangan</th>
                        <th class="py-3.5 px-3 text-center">Perpus</th>
                        <th class="py-3.5 px-3 text-center">Santri</th>
                        <th class="py-3.5 px-3 text-center">Wali</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    
                    <tr class="hover:bg-slate-50/60">
                        <td class="py-3 px-4 font-bold text-slate-900 sticky left-0 bg-white">1. Master Santri & Detail 360°</td>
                        <td class="text-center font-bold text-emerald-700">CRUD</td>
                        <td class="text-center font-bold text-emerald-700">CRUD</td>
                        <td class="text-center text-slate-400">R (Calon)</td>
                        <td class="text-center font-semibold text-blue-700">R</td>
                        <td class="text-center text-slate-400">R (Binaan)</td>
                        <td class="text-center text-slate-400">R (Kelas)</td>
                        <td class="text-center text-slate-400">R (Asrama)</td>
                        <td class="text-center font-semibold text-blue-700">R</td>
                        <td class="text-center font-semibold text-blue-700">R (KTS)</td>
                        <td class="text-center text-slate-400">R (Pribadi)</td>
                        <td class="text-center text-slate-400">R (Anak)</td>
                    </tr>

                    <tr class="hover:bg-slate-50/60">
                        <td class="py-3 px-4 font-bold text-slate-900 sticky left-0 bg-white">2. Penerimaan Santri (PSB)</td>
                        <td class="text-center font-bold text-emerald-700">CRUD</td>
                        <td class="text-center font-semibold text-blue-700">R</td>
                        <td class="text-center font-bold text-emerald-700">CRUD + Aktif</td>
                        <td class="text-center text-slate-300">-</td>
                        <td class="text-center text-slate-300">-</td>
                        <td class="text-center text-slate-300">-</td>
                        <td class="text-center text-slate-300">-</td>
                        <td class="text-center text-slate-400">R (Biaya)</td>
                        <td class="text-center text-slate-300">-</td>
                        <td class="text-center text-slate-300">-</td>
                        <td class="text-center text-slate-300">-</td>
                    </tr>

                    <tr class="hover:bg-slate-50/60">
                        <td class="py-3 px-4 font-bold text-slate-900 sticky left-0 bg-white">3. Jadwal & Presensi Formal</td>
                        <td class="text-center font-bold text-emerald-700">CRUD</td>
                        <td class="text-center font-semibold text-blue-700">R</td>
                        <td class="text-center text-slate-300">-</td>
                        <td class="text-center font-bold text-emerald-700">CRUD</td>
                        <td class="text-center font-bold text-emerald-700">CRU</td>
                        <td class="text-center font-semibold text-blue-700">R (Rekap)</td>
                        <td class="text-center text-slate-300">-</td>
                        <td class="text-center text-slate-300">-</td>
                        <td class="text-center text-slate-300">-</td>
                        <td class="text-center text-slate-400">R (Pribadi)</td>
                        <td class="text-center text-slate-400">R (Anak)</td>
                    </tr>

                    <tr class="hover:bg-slate-50/60">
                        <td class="py-3 px-4 font-bold text-slate-900 sticky left-0 bg-white">4. Keasramaan & Perizinan</td>
                        <td class="text-center font-bold text-emerald-700">CRUD</td>
                        <td class="text-center font-semibold text-blue-700">R</td>
                        <td class="text-center text-slate-300">-</td>
                        <td class="text-center text-slate-300">-</td>
                        <td class="text-center text-slate-300">-</td>
                        <td class="text-center font-semibold text-blue-700">R</td>
                        <td class="text-center font-bold text-emerald-700">CRUD + Approval</td>
                        <td class="text-center text-slate-300">-</td>
                        <td class="text-center text-slate-300">-</td>
                        <td class="text-center font-bold text-amber-700">C (Ajukan)</td>
                        <td class="text-center font-bold text-amber-700">C (Ajukan)</td>
                    </tr>

                    <tr class="hover:bg-slate-50/60">
                        <td class="py-3 px-4 font-bold text-slate-900 sticky left-0 bg-white">5. Keuangan & Tagihan SPP</td>
                        <td class="text-center font-bold text-emerald-700">CRUD</td>
                        <td class="text-center font-semibold text-blue-700">R</td>
                        <td class="text-center text-slate-300">-</td>
                        <td class="text-center text-slate-300">-</td>
                        <td class="text-center text-slate-300">-</td>
                        <td class="text-center text-slate-300">-</td>
                        <td class="text-center text-slate-300">-</td>
                        <td class="text-center font-bold text-emerald-700">CRUD + Kuitansi</td>
                        <td class="text-center text-slate-300">-</td>
                        <td class="text-center font-semibold text-blue-700">R</td>
                        <td class="text-center font-semibold text-blue-700">R + Konfirmasi</td>
                    </tr>

                    <tr class="hover:bg-slate-50/60">
                        <td class="py-3 px-4 font-bold text-slate-900 sticky left-0 bg-white">6. Perpustakaan & Sirkulasi QR</td>
                        <td class="text-center font-bold text-emerald-700">CRUD</td>
                        <td class="text-center font-semibold text-blue-700">R</td>
                        <td class="text-center text-slate-300">-</td>
                        <td class="text-center text-slate-300">-</td>
                        <td class="text-center text-slate-300">-</td>
                        <td class="text-center text-slate-300">-</td>
                        <td class="text-center text-slate-300">-</td>
                        <td class="text-center text-slate-300">-</td>
                        <td class="text-center font-bold text-emerald-700">CRUD + Scanner</td>
                        <td class="text-center font-semibold text-blue-700">R (Pinjaman)</td>
                        <td class="text-center font-semibold text-blue-700">R</td>
                    </tr>

                    <tr class="hover:bg-slate-50/60">
                        <td class="py-3 px-4 font-bold text-slate-900 sticky left-0 bg-white">7. Manajemen Pengguna & Audit</td>
                        <td class="text-center font-bold text-emerald-700">CRUD</td>
                        <td class="text-center font-semibold text-blue-700">R</td>
                        <td class="text-center text-slate-300">-</td>
                        <td class="text-center text-slate-300">-</td>
                        <td class="text-center text-slate-300">-</td>
                        <td class="text-center text-slate-300">-</td>
                        <td class="text-center text-slate-300">-</td>
                        <td class="text-center text-slate-300">-</td>
                        <td class="text-center text-slate-300">-</td>
                        <td class="text-center text-slate-300">-</td>
                        <td class="text-center text-slate-300">-</td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
