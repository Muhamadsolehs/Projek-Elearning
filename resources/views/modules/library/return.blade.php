@extends('layouts.app')

@section('title', 'Sirkulasi Pengembalian Buku')

@section('breadcrumb')
<nav class="flex text-xs text-slate-500 font-medium mb-1">
    <ol class="inline-flex items-center space-x-1">
        <li class="inline-flex items-center"><a href="/dashboard" class="text-primary-600 hover:underline">SIM-Pesantren</a></li>
        <li><i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-400"></i></li>
        <li class="inline-flex items-center"><a href="/dashboard/perpustakaan" class="text-primary-600 hover:underline">Perpustakaan</a></li>
        <li><i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-400"></i></li>
        <li class="text-slate-800 font-bold">Pengembalian Buku</li>
    </ol>
</nav>
@endsection

@section('page-title')
Sirkulasi Pengembalian & Asesmen Kondisi Buku
@endsection

@section('page-subtitle')
Pindai QR buku yang dikembalikan, verifikasi santri peminjam, periksa kondisi fisik, dan hitung denda jika terlambat.
@endsection

@section('page-actions')
<a href="/library/circulation/borrow" class="px-3.5 py-2 bg-secondary hover:bg-blue-700 text-white text-xs font-bold rounded-lg shadow-sm flex items-center gap-1.5 transition-all">
    <i data-lucide="scan" class="w-4 h-4"></i>
    <span>Ke Menu Peminjaman</span>
</a>
@endsection

@section('content')
<div class="max-w-4xl mx-auto space-y-6" x-data="{
    cameraActive: false,
    manualCode: '',
    detectedLoan: null,
    returnCondition: 'Baik', // 'Baik', 'Rusak', 'Hilang'
    notes: '',

    findLoan(code) {
        $store.sim.playBeep(true);
        // Cari transaksi peminjaman aktif berdasarkan copy_code
        const found = $store.sim.circulations.find(c => 
            (c.copy_code === code || code.includes(c.copy_code)) && 
            ['Sedang Dipinjam', 'Terlambat'].includes(c.status)
        );

        if (!found) {
            $store.sim.playBeep(false);
            $store.sim.addToast('Tidak Ada Peminjaman Aktif', `Buku [${code}] saat ini tidak sedang dalam status dipinjam.`, 'warning');
            return;
        }

        this.detectedLoan = found;
        $store.sim.addToast('Buku Teridentifikasi', `Peminjam: ${found.student_name} (${found.student_class})`, 'success');
    },

    confirmReturn() {
        if (!this.detectedLoan) return;

        // Update status transaksi
        this.detectedLoan.status = 'Selesai Dikembalikan';
        this.detectedLoan.return_date = '02 November 2026';
        this.detectedLoan.condition = this.returnCondition;

        // Update status buku di master copy
        const copy = $store.sim.copies.find(c => c.inventory_code === this.detectedLoan.copy_code);
        if (copy) {
            copy.status = (this.returnCondition === 'Rusak') ? 'Rusak' : 'Tersedia';
            copy.condition = this.returnCondition;
            copy.borrower = null;
        }

        $store.sim.addToast('Pengembalian Sukses!', `Buku [${this.detectedLoan.copy_code}] berhasil dikembalikan dalam kondisi ${this.returnCondition}.`, 'success');

        this.detectedLoan = null;
        this.manualCode = '';
    }
}">

    <!-- SCANNER & SEARCH FORM -->
    <div class="bg-white p-6 rounded-3xl border border-slate-200 shadow-2xs space-y-4">
        <h3 class="text-sm font-bold text-slate-900 pb-2 border-b border-slate-100 flex items-center gap-2">
            <i data-lucide="scan-line" class="w-4 h-4 text-emerald-600"></i>
            <span>Pindai QR Buku / Ketik Kode Inventaris</span>
        </h3>

        <div class="flex flex-col sm:flex-row gap-3">
            <input type="text" 
                   x-model="manualCode" 
                   @keyup.enter="findLoan(manualCode)"
                   placeholder="Scan QR buku atau ketik kode inventaris (misal: INV-BK-0005-01)..." 
                   class="flex-1 px-4 py-2.5 text-xs border border-slate-300 rounded-xl font-mono focus:ring-2 focus:ring-emerald-500">
            <button type="button" 
                    @click="findLoan(manualCode)" 
                    class="px-5 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs rounded-xl shadow-xs transition-colors flex items-center justify-center gap-2">
                <i data-lucide="search" class="w-4 h-4"></i>
                <span>Cari Transaksi</span>
            </button>
        </div>

        <!-- SIMULASI SAMPLE BUTTON -->
        <div class="pt-2 flex flex-wrap items-center gap-2 text-[11px]">
            <span class="text-slate-400 font-semibold">Simulasi Buku Dipinjam:</span>
            <button type="button" @click="manualCode = 'INV-BK-0005-01'; findLoan('INV-BK-0005-01')" class="px-2.5 py-1 bg-slate-100 hover:bg-emerald-50 hover:text-emerald-800 text-slate-700 rounded-lg font-mono border">
                INV-BK-0005-01 (Taqrib)
            </button>
            <button type="button" @click="manualCode = 'INV-BK-0010-01'; findLoan('INV-BK-0010-01')" class="px-2.5 py-1 bg-slate-100 hover:bg-emerald-50 hover:text-emerald-800 text-slate-700 rounded-lg font-mono border">
                INV-BK-0010-01 (Bidayatul Hidayah)
            </button>
        </div>
    </div>

    <!-- HASIL TEMUAN TRANSAKSI AKTIF (DETAIL & ASESMEN) -->
    <template x-if="detectedLoan">
        <div class="bg-white p-6 rounded-3xl border border-slate-200 shadow-2xs space-y-6">
            
            <div class="flex flex-col sm:flex-row sm:items-center justify-between pb-4 border-b border-slate-100 gap-3">
                <div>
                    <span class="text-xs font-mono font-bold text-primary-900 block" x-text="'No. Transaksi: ' + detectedLoan.id"></span>
                    <h3 class="text-lg font-extrabold text-slate-900 mt-0.5" x-text="detectedLoan.book_title"></h3>
                    <span class="text-xs font-mono text-accent-dark font-bold" x-text="'Kode Buku: ' + detectedLoan.copy_code"></span>
                </div>
                <span class="px-3 py-1 rounded-full text-xs font-bold"
                      :class="detectedLoan.status === 'Terlambat' ? 'bg-red-100 text-red-800' : 'bg-blue-100 text-blue-800'"
                      x-text="detectedLoan.status"></span>
            </div>

            <!-- Detail Peminjam & Jadwal -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 text-xs">
                <div class="p-3.5 bg-slate-50 rounded-2xl border border-slate-100">
                    <span class="text-slate-400 font-medium block">Santri Peminjam</span>
                    <span class="font-bold text-slate-900 text-sm mt-0.5 block" x-text="detectedLoan.student_name"></span>
                    <span class="text-[11px] text-slate-500" x-text="detectedLoan.student_class + ' • ' + detectedLoan.student_nis"></span>
                </div>

                <div class="p-3.5 bg-slate-50 rounded-2xl border border-slate-100">
                    <span class="text-slate-400 font-medium block">Tanggal Pinjam & Tenggat</span>
                    <span class="font-bold text-slate-800 text-xs mt-0.5 block" x-text="'Pinjam: ' + detectedLoan.borrow_date"></span>
                    <span class="font-bold text-xs block mt-0.5" 
                          :class="detectedLoan.status === 'Terlambat' ? 'text-red-600' : 'text-slate-700'" 
                          x-text="'Batas: ' + detectedLoan.due_date"></span>
                </div>

                <div class="p-3.5 rounded-2xl border"
                     :class="detectedLoan.fine > 0 ? 'bg-red-50 border-red-200 text-red-900' : 'bg-emerald-50 border-emerald-200 text-emerald-900'">
                    <span class="font-medium block text-xs">Denda Keterlambatan</span>
                    <span class="text-xl font-extrabold mt-0.5 block" x-text="detectedLoan.fine > 0 ? 'Rp ' + detectedLoan.fine.toLocaleString('id-ID') : 'Rp 0 (Tepat Waktu)'"></span>
                    <span class="text-[10px] block mt-0.5" x-text="detectedLoan.fine > 0 ? 'Tarif Rp 2.000 / hari' : 'Tidak ada denda'"></span>
                </div>
            </div>

            <!-- ASESMEN KONDISI BUKU PENGEMBALIAN -->
            <div class="pt-2">
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                    Kondisi Fisik Buku Saat Dikembalikan:
                </label>
                <div class="grid grid-cols-3 gap-3">
                    <button type="button" 
                            @click="returnCondition = 'Baik'"
                            class="p-3 rounded-2xl border-2 text-center transition-all"
                            :class="returnCondition === 'Baik' ? 'border-emerald-600 bg-emerald-50/50 text-emerald-900 font-bold' : 'border-slate-200 text-slate-600'">
                        <i data-lucide="check" class="w-5 h-5 mx-auto mb-1 text-emerald-600"></i>
                        <span>Baik / Utuh</span>
                    </button>

                    <button type="button" 
                            @click="returnCondition = 'Rusak'"
                            class="p-3 rounded-2xl border-2 text-center transition-all"
                            :class="returnCondition === 'Rusak' ? 'border-amber-600 bg-amber-50/50 text-amber-900 font-bold' : 'border-slate-200 text-slate-600'">
                        <i data-lucide="alert-triangle" class="w-5 h-5 mx-auto mb-1 text-amber-600"></i>
                        <span>Rusak / Halaman Robek</span>
                    </button>

                    <button type="button" 
                            @click="returnCondition = 'Hilang'"
                            class="p-3 rounded-2xl border-2 text-center transition-all"
                            :class="returnCondition === 'Hilang' ? 'border-red-600 bg-red-50/50 text-red-900 font-bold' : 'border-slate-200 text-slate-600'">
                        <i data-lucide="x-circle" class="w-5 h-5 mx-auto mb-1 text-red-600"></i>
                        <span>Buku Hilang</span>
                    </button>
                </div>
            </div>

            <!-- TOMBOL KONFIRMASI -->
            <div class="pt-4 border-t border-slate-100 flex justify-end gap-3">
                <button type="button" @click="detectedLoan = null" class="px-4 py-2 border border-slate-200 text-slate-600 text-xs font-bold rounded-xl hover:bg-slate-50">
                    Batal
                </button>
                <button type="button" @click="confirmReturn()" class="px-6 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs rounded-xl shadow-md transition-colors flex items-center gap-2">
                    <i data-lucide="check-circle" class="w-4 h-4"></i>
                    <span>Konfirmasi Pengembalian Buku</span>
                </button>
            </div>

        </div>
    </template>

</div>
@endsection
