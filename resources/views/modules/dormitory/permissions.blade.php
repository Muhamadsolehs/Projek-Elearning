@extends('layouts.app')

@section('title', 'Perizinan Santri Keluar / Pulang')

@section('breadcrumb')
<nav class="flex text-xs text-slate-500 font-medium mb-1">
    <ol class="inline-flex items-center space-x-1">
        <li class="inline-flex items-center"><a href="/dashboard" class="text-primary-600 hover:underline">SIM-Pesantren</a></li>
        <li><i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-400"></i></li>
        <li class="inline-flex items-center"><a href="/dashboard/keasramaan" class="text-primary-600 hover:underline">Keasramaan</a></li>
        <li><i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-400"></i></li>
        <li class="text-slate-800 font-bold">Perizinan Santri</li>
    </ol>
</nav>
@endsection

@section('page-title')
Manajemen Perizinan Santri Keluar & Pulang
@endsection

@section('page-subtitle')
Pengajuan izin santri, persetujuan pengasuh asrama, dan penerbitan surat izin gerbang keamanan.
@endsection

@section('page-actions')
<button type="button" 
        @click="showCreateModal = true"
        class="px-3.5 py-2 bg-primary-800 hover:bg-primary-900 text-white text-xs font-bold rounded-lg shadow-sm flex items-center gap-1.5 transition-all">
    <i data-lucide="plus-circle" class="w-4 h-4"></i>
    <span>Ajukan Izin Baru</span>
</button>
@endsection

@section('content')
<div class="space-y-6" x-data="{
    search: '',
    statusFilter: '',
    showCreateModal: false,
    newPerm: {
        student_name: 'Muhammad Pratama',
        nis: '20240001',
        type: 'Izin Pulang (Keluarga)',
        reason: '',
        departure: '2026-11-03',
        return: '2026-11-06'
    },
    
    get filteredPerms() {
        return $store.sim.permissions.filter(p => {
            const matchSearch = !this.search || 
                p.student_name.toLowerCase().includes(this.search.toLowerCase()) ||
                p.student_nis.toLowerCase().includes(this.search.toLowerCase()) ||
                p.id.toLowerCase().includes(this.search.toLowerCase());
            
            const matchStatus = !this.statusFilter || p.status === this.statusFilter;
            return matchSearch && matchStatus;
        });
    },

    submitPerm() {
        if (!this.newPerm.reason) {
            $store.sim.addToast('Alasan Belum Diisi', 'Mohon isi alasan pengajuan izin santri.', 'warning');
            return;
        }

        $store.sim.permissions.unshift({
            id: 'PRM-2026-' + String($store.sim.permissions.length + 1).padStart(4, '0'),
            student_id: 'STU-1',
            student_name: this.newPerm.student_name,
            student_nis: this.newPerm.nis,
            student_class: 'Kelas VII-A',
            dorm: 'Gedung Al-Fatih / Kmr 101',
            type: this.newPerm.type,
            reason: this.newPerm.reason,
            departure_date: this.newPerm.departure,
            return_plan: this.newPerm.return,
            status: 'Menunggu Persetujuan',
            approver: '-',
            gate_checked_out: false,
            gate_checked_in: false
        });

        $store.sim.addToast('Pengajuan Izin Dikirim', 'Pengajuan izin berhasil diajukan dan menunggu persetujuan ustadz pengasuh.', 'success');
        this.showCreateModal = false;
        this.newPerm.reason = '';
    }
}">

    <!-- FILTER BAR -->
    <div class="bg-white p-4 rounded-2xl border border-slate-200 shadow-2xs">
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
            <div class="sm:col-span-2 relative">
                <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                    <i data-lucide="search" class="w-4 h-4"></i>
                </span>
                <input type="text" 
                       x-model="search" 
                       placeholder="Cari Santri, NIS, atau No. Surat Izin..." 
                       class="w-full pl-9 pr-4 py-2 text-xs bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary-500">
            </div>

            <div>
                <select x-model="statusFilter" class="w-full py-2 px-3 text-xs bg-slate-50 border border-slate-200 rounded-xl">
                    <option value="">Semua Status Izin</option>
                    <option value="Menunggu Persetujuan">Menunggu Persetujuan</option>
                    <option value="Disetujui">Disetujui</option>
                    <option value="Selesai Kembali">Selesai Kembali</option>
                    <option value="Ditolak">Ditolak</option>
                </select>
            </div>
        </div>
    </div>

    <!-- TABLE PERMISSIONS -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-2xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-xs">
                <thead>
                    <tr class="bg-slate-50 text-slate-500 font-semibold border-b border-slate-100 uppercase tracking-wider">
                        <th class="py-3 px-4">No. Izin</th>
                        <th class="py-3 px-4">Santri & Kamar</th>
                        <th class="py-3 px-4">Kategori Izin</th>
                        <th class="py-3 px-4">Alasan & Rencana Waktu</th>
                        <th class="py-3 px-4">Pengasuh Penyetuju</th>
                        <th class="py-3 px-4 text-center">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    <template x-for="p in filteredPerms" :key="p.id">
                        <tr class="hover:bg-slate-50/60 transition-colors">
                            <td class="py-3 px-4 font-mono font-bold text-primary-900" x-text="p.id"></td>
                            <td class="py-3 px-4">
                                <span class="font-bold text-slate-800 block" x-text="p.student_name"></span>
                                <span class="text-[10px] text-slate-400" x-text="p.student_class + ' • ' + p.dorm"></span>
                            </td>
                            <td class="py-3 px-4">
                                <span class="px-2 py-0.5 rounded text-[11px] font-semibold bg-teal-50 text-teal-800" x-text="p.type"></span>
                            </td>
                            <td class="py-3 px-4 max-w-xs">
                                <span class="text-slate-800 block truncate" x-text="p.reason"></span>
                                <span class="text-[10px] text-teal-700 font-bold" x-text="p.departure_date + ' s/d ' + p.return_plan"></span>
                            </td>
                            <td class="py-3 px-4 text-slate-600" x-text="p.approver"></td>
                            <td class="py-3 px-4 text-center">
                                <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold"
                                      :class="{
                                          'bg-amber-100 text-amber-800': p.status === 'Menunggu Persetujuan',
                                          'bg-emerald-100 text-emerald-800': p.status === 'Disetujui',
                                          'bg-blue-100 text-blue-800': p.status === 'Selesai Kembali',
                                          'bg-red-100 text-red-800': p.status === 'Ditolak'
                                      }"
                                      x-text="p.status"></span>
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>
        </div>
    </div>

    <!-- MODAL PENGAJUAN IZIN BARU -->
    <div x-show="showCreateModal" class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs z-50 flex items-center justify-center p-4" style="display: none;">
        <div @click.away="showCreateModal = false" class="bg-white rounded-3xl max-w-lg w-full p-6 shadow-2xl border border-slate-200 space-y-4">
            <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                <h3 class="text-sm font-bold text-slate-900">Pengajuan Izin Keluar Santri</h3>
                <button type="button" @click="showCreateModal = false" class="text-slate-400 hover:text-slate-600">
                    <i data-lucide="x" class="w-4 h-4"></i>
                </button>
            </div>

            <div class="space-y-3 text-xs">
                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Nama Santri</label>
                    <input type="text" x-model="newPerm.student_name" class="w-full px-3 py-2 border border-slate-300 rounded-xl bg-slate-50 font-bold">
                </div>

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Jenis Perizinan</label>
                    <select x-model="newPerm.type" class="w-full px-3 py-2 border border-slate-300 rounded-xl">
                        <option value="Izin Pulang (Keluarga)">Izin Pulang (Keluarga)</option>
                        <option value="Izin Berobat ke RS">Izin Berobat ke RS</option>
                        <option value="Izin Lomba / Ekstrakurikuler">Izin Lomba / Ekstrakurikuler</option>
                        <option value="Izin Belanja Perlengkapan">Izin Belanja Perlengkapan</option>
                    </select>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Rencana Berangkat</label>
                        <input type="date" x-model="newPerm.departure" class="w-full px-3 py-2 border border-slate-300 rounded-xl">
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Rencana Kembali</label>
                        <input type="date" x-model="newPerm.return" class="w-full px-3 py-2 border border-slate-300 rounded-xl">
                    </div>
                </div>

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Alasan Izin Lengkap</label>
                    <textarea x-model="newPerm.reason" rows="3" placeholder="Sebutkan keperluan mendesak..." class="w-full px-3 py-2 border border-slate-300 rounded-xl"></textarea>
                </div>
            </div>

            <div class="pt-3 border-t border-slate-100 flex justify-end gap-2">
                <button type="button" @click="showCreateModal = false" class="px-4 py-2 border border-slate-200 text-slate-600 text-xs font-bold rounded-xl hover:bg-slate-50">
                    Batal
                </button>
                <button type="button" @click="submitPerm()" class="px-5 py-2 bg-primary-800 hover:bg-primary-900 text-white text-xs font-bold rounded-xl shadow-xs">
                    Kirim Permohonan
                </button>
            </div>
        </div>
    </div>

</div>
@endsection
