@extends('layouts.app')

@section('title', 'Pos Gerbang Keamanan Santri')

@section('breadcrumb')
<nav class="flex text-xs text-slate-500 font-medium mb-1">
    <ol class="inline-flex items-center space-x-1">
        <li class="inline-flex items-center"><a href="/dashboard" class="text-primary-600 hover:underline">SIM-Pesantren</a></li>
        <li><i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-400"></i></li>
        <li class="inline-flex items-center"><a href="/dashboard/keasramaan" class="text-primary-600 hover:underline">Keasramaan</a></li>
        <li><i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-400"></i></li>
        <li class="text-slate-800 font-bold">Pos Gerbang</li>
    </ol>
</nav>
@endsection

@section('page-title')
Monitoring Gerbang Keluar & Masuk Santri
@endsection

@section('page-subtitle')
Validasi barcode izin keluar santri, verifikasi penjemput resmi, dan catat kepulangan kembali ke asrama.
@endsection

@section('content')
<div class="max-w-4xl mx-auto space-y-6" x-data="{
    scanCode: '',
    detectedPerm: null,

    checkGate(code) {
        $store.sim.playBeep(true);
        const perm = $store.sim.permissions.find(p => p.id === code || p.student_nis === code);
        if (!perm) {
            $store.sim.playBeep(false);
            $store.sim.addToast('Data Tidak Ditemukan', 'Kode perizinan atau NIS tidak memiliki izin aktif.', 'warning');
            return;
        }

        if (perm.status === 'Menunggu Persetujuan') {
            $store.sim.playBeep(false);
            $store.sim.addToast('Izin Belum Disetujui!', `Pengajuan izin ${perm.student_name} belum disetujui oleh pengasuh. Santri dilarang meninggalkan gerbang.`, 'danger');
            return;
        }

        this.detectedPerm = perm;
        $store.sim.addToast('Izin Tervalidasi', `Santri ${perm.student_name} memiliki izin resmi: ${perm.type}`, 'success');
    },

    markDeparture() {
        this.detectedPerm.gate_checked_out = true;
        $store.sim.addToast('Keberangkatan Tercatat', `Santri ${this.detectedPerm.student_name} telah meninggalkan pos gerbang. Waktu tercatat di sistem.`, 'info');
    },

    markReturn() {
        this.detectedPerm.gate_checked_in = true;
        this.detectedPerm.status = 'Selesai Kembali';
        $store.sim.addToast('Kepulangan Tercatat', `Santri ${this.detectedPerm.student_name} telah kembali ke asrama dengan selamat.`, 'success');
        this.detectedPerm = null;
        this.scanCode = '';
    }
}">

    <!-- SCANNER SEARCH -->
    <div class="bg-white p-6 rounded-3xl border border-slate-200 shadow-2xs space-y-4">
        <h3 class="text-sm font-bold text-slate-900 pb-2 border-b border-slate-100 flex items-center gap-2">
            <i data-lucide="shield" class="w-4 h-4 text-primary-700"></i>
            <span>Pindai Barcode Surat Izin / KTS Santri di Pos Gerbang</span>
        </h3>

        <div class="flex gap-2">
            <input type="text" 
                   x-model="scanCode" 
                   @keyup.enter="checkGate(scanCode)"
                   placeholder="Scan barcode kartu santri atau ketik NIS (misal: 20240001)..." 
                   class="flex-1 px-4 py-2.5 text-xs border border-slate-300 rounded-xl font-mono focus:ring-2 focus:ring-primary-500">
            <button type="button" @click="checkGate(scanCode)" class="px-5 py-2.5 bg-primary-800 hover:bg-primary-900 text-white font-bold text-xs rounded-xl shadow-xs">
                Periksa Izin
            </button>
        </div>

        <div class="flex items-center gap-2 text-[11px] text-slate-500">
            <span class="font-bold">Contoh Cepat:</span>
            <button type="button" @click="scanCode = '20240001'; checkGate('20240001')" class="px-2 py-1 bg-slate-100 hover:bg-slate-200 text-slate-700 font-mono rounded">
                NIS 20240001 (Izin Pulang)
            </button>
            <button type="button" @click="scanCode = 'PRM-2026-0001'; checkGate('PRM-2026-0001')" class="px-2 py-1 bg-slate-100 hover:bg-slate-200 text-slate-700 font-mono rounded">
                No. Izin PRM-0001
            </button>
        </div>
    </div>

    <!-- HASIL VERIFIKASI GERBANG -->
    <template x-if="detectedPerm">
        <div class="bg-white p-6 rounded-3xl border border-slate-200 shadow-2xs space-y-5">
            <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                <div>
                    <span class="font-mono font-bold text-xs text-primary-900" x-text="detectedPerm.id"></span>
                    <h3 class="text-base font-extrabold text-slate-900" x-text="detectedPerm.student_name"></h3>
                    <span class="text-xs text-slate-500" x-text="detectedPerm.student_class + ' • ' + detectedPerm.dorm"></span>
                </div>
                <span class="px-3 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800" x-text="detectedPerm.status"></span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs">
                <div class="p-3.5 bg-slate-50 rounded-2xl border border-slate-100">
                    <span class="text-slate-400 block font-medium">Jenis & Alasan Perizinan</span>
                    <span class="font-bold text-slate-900 text-xs mt-0.5 block" x-text="detectedPerm.type"></span>
                    <span class="text-slate-600 mt-1 block" x-text="detectedPerm.reason"></span>
                </div>

                <div class="p-3.5 bg-slate-50 rounded-2xl border border-slate-100">
                    <span class="text-slate-400 block font-medium">Jadwal Keberangkatan & Batas Kembali</span>
                    <span class="font-bold text-slate-800 block mt-0.5" x-text="'Berangkat: ' + detectedPerm.departure_date"></span>
                    <span class="font-bold text-primary-800 block mt-0.5" x-text="'Wajib Kembali: ' + detectedPerm.return_plan"></span>
                    <span class="text-[10px] text-slate-400 mt-1 block" x-text="'Disetujui: ' + detectedPerm.approver"></span>
                </div>
            </div>

            <!-- AKSI POS GERBANG -->
            <div class="pt-4 border-t border-slate-100 flex justify-end gap-3">
                <button type="button" 
                        @click="markDeparture()"
                        class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs rounded-xl shadow-xs transition-colors flex items-center gap-1.5">
                    <i data-lucide="log-out" class="w-4 h-4"></i>
                    <span>Catat Keluar Gerbang (Berangkat)</span>
                </button>

                <button type="button" 
                        @click="markReturn()"
                        class="px-5 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs rounded-xl shadow-xs transition-colors flex items-center gap-1.5">
                    <i data-lucide="log-in" class="w-4 h-4"></i>
                    <span>Catat Kembali ke Asrama (Selesai)</span>
                </button>
            </div>
        </div>
    </template>

</div>
@endsection
