@extends('layouts.app')

@section('title', 'Manajemen Pengguna')

@section('breadcrumb')
<nav class="flex text-xs text-slate-500 font-medium mb-1">
    <ol class="inline-flex items-center space-x-1">
        <li class="inline-flex items-center"><a href="/dashboard" class="text-primary-600 hover:underline">SIM-Pesantren</a></li>
        <li><i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-400"></i></li>
        <li class="inline-flex items-center text-slate-500">Pengaturan</li>
        <li><i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-400"></i></li>
        <li class="text-slate-800 font-bold">Pengguna Sistem</li>
    </ol>
</nav>
@endsection

@section('page-title')
Manajemen Akun & Hak Akses Pengguna
@endsection

@section('page-subtitle')
Kelola kredensial akun asatidz, staf administrasi, bendahara, santri, dan wali murid.
@endsection

@section('content')
<div class="space-y-6" x-data="{
    search: '',
    users: [
        { id: 1, name: 'Ust. H. Abdurrahman, M.Pd.I', email: 'abdurrahman@pesantren.sch.id', role: 'Super Admin', status: 'Aktif', lastLogin: '10 menit yang lalu' },
        { id: 2, name: 'Ust. H. Syarif Hidayatullah, S.T.', email: 'syarif@pesantren.sch.id', role: 'Administrator Pesantren', status: 'Aktif', lastLogin: '1 jam yang lalu' },
        { id: 3, name: 'Ust. Zainal Abidin, Lc', email: 'zainal@pesantren.sch.id', role: 'Admin Penerimaan (PSB)', status: 'Aktif', lastLogin: '2 jam yang lalu' },
        { id: 4, name: 'Ust. Drs. H. Mulyadi', email: 'mulyadi@pesantren.sch.id', role: 'Admin Akademik', status: 'Aktif', lastLogin: '3 jam yang lalu' },
        { id: 5, name: 'Ust. Ahmad Fauzi, S.Pd.I', email: 'fauzi@pesantren.sch.id', role: 'Guru / Ustadz', status: 'Aktif', lastLogin: '25 menit yang lalu' },
        { id: 6, name: 'Usth. Siti Maryam, S.Pd', email: 'maryam@pesantren.sch.id', role: 'Wali Kelas VII-B', status: 'Aktif', lastLogin: '45 menit yang lalu' },
        { id: 7, name: 'Ust. Ridwan Hakim, M.Pd', email: 'ridwan@pesantren.sch.id', role: 'Admin Keasramaan', status: 'Aktif', lastLogin: '1 jam yang lalu' },
        { id: 8, name: 'Hj. Wahyuni Rahayu, S.E.', email: 'wahyuni@pesantren.sch.id', role: 'Bendahara / Keuangan', status: 'Aktif', lastLogin: '30 menit yang lalu' },
        { id: 9, name: 'Usth. Fatimah Zahra, S.I.Pust', email: 'fatimah@pesantren.sch.id', role: 'Petugas Perpustakaan', status: 'Aktif', lastLogin: '15 menit yang lalu' },
        { id: 10, name: 'Muhammad Pratama (Santri)', email: '20240001@santri.pesantren.sch.id', role: 'Santri', status: 'Aktif', lastLogin: 'Kemarin' },
        { id: 11, name: 'H. Bambang Pratama, S.E. (Wali)', email: 'bambang@wali.pesantren.sch.id', role: 'Wali Santri', status: 'Aktif', lastLogin: '2 hari lalu' }
    ],

    toggleStatus(u) {
        u.status = (u.status === 'Aktif') ? 'Terkunci' : 'Aktif';
        $store.sim.addToast('Status Diperbarui', `Akun ${u.name} diubah menjadi: ${u.status}`, u.status === 'Aktif' ? 'success' : 'warning');
    },

    resetPassword(u) {
        $store.sim.addToast('Password Direset', `Tautan reset sandi telah dikirimkan ke email ${u.email}`, 'info');
    }
}">

    <div class="bg-white rounded-3xl border border-slate-200 shadow-2xs overflow-hidden">
        <div class="px-5 py-4 border-b border-slate-100 flex items-center justify-between">
            <h3 class="text-sm font-bold text-slate-900">Daftar Akun Pengguna Terdaftar (11 Akun Role)</h3>
            <span class="text-xs font-semibold bg-emerald-50 text-emerald-800 px-2.5 py-0.5 rounded-full">100% Aktif</span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-xs">
                <thead>
                    <tr class="bg-slate-50 text-slate-500 font-semibold border-b border-slate-100 uppercase tracking-wider">
                        <th class="py-3 px-4">Nama Pengguna</th>
                        <th class="py-3 px-4">Email / Login ID</th>
                        <th class="py-3 px-4">Peran (Role)</th>
                        <th class="py-3 px-4">Login Terakhir</th>
                        <th class="py-3 px-4 text-center">Status</th>
                        <th class="py-3 px-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    <template x-for="u in users" :key="u.id">
                        <tr class="hover:bg-slate-50/60 transition-colors">
                            <td class="py-3 px-4 font-bold text-slate-900" x-text="u.name"></td>
                            <td class="py-3 px-4 font-mono text-slate-600" x-text="u.email"></td>
                            <td class="py-3 px-4">
                                <span class="px-2 py-0.5 rounded text-[11px] font-semibold bg-primary-50 text-primary-900 border border-primary-200" x-text="u.role"></span>
                            </td>
                            <td class="py-3 px-4 text-slate-500" x-text="u.lastLogin"></td>
                            <td class="py-3 px-4 text-center">
                                <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold"
                                      :class="u.status === 'Aktif' ? 'bg-emerald-100 text-emerald-800' : 'bg-red-100 text-red-800'"
                                      x-text="u.status"></span>
                            </td>
                            <td class="py-3 px-4 text-center">
                                <div class="inline-flex gap-1.5">
                                    <button type="button" @click="resetPassword(u)" class="px-2 py-1 bg-white hover:bg-slate-100 border border-slate-200 rounded text-slate-700 text-[11px] font-semibold">
                                        Reset Sandi
                                    </button>
                                    <button type="button" @click="toggleStatus(u)" class="px-2 py-1 rounded text-[11px] font-bold border transition-colors"
                                            :class="u.status === 'Aktif' ? 'border-red-200 text-red-700 hover:bg-red-50' : 'border-emerald-200 text-emerald-700 hover:bg-emerald-50'">
                                        <span x-text="u.status === 'Aktif' ? 'Kunci' : 'Aktifkan'"></span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
