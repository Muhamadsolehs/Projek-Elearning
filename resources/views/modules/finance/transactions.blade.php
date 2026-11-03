@extends('layouts.app')

@section('title', 'Kasir Pembayaran (POS)')

@section('breadcrumb')
<nav class="flex text-xs text-slate-500 font-medium mb-1">
    <ol class="inline-flex items-center space-x-1">
        <li class="inline-flex items-center"><a href="/dashboard" class="text-primary-600 hover:underline">SIM-Pesantren</a></li>
        <li><i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-400"></i></li>
        <li class="inline-flex items-center"><a href="/finance/bills" class="text-primary-600 hover:underline">Keuangan</a></li>
        <li><i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-400"></i></li>
        <li class="text-slate-800 font-bold">Kasir Pembayaran</li>
    </ol>
</nav>
@endsection

@section('page-title')
Kasir Pembayaran Tunai & Loket Keuangan
@endsection

@section('page-subtitle')
Terima pembayaran langsung dari wali santri di loket bendahara dan terbitkan kuitansi resmi.
@endsection

@section('content')
<div class="max-w-4xl mx-auto space-y-6" x-data="{
    searchStudent: '',
    selectedStudent: null,
    selectedBill: null,
    payMethod: 'Tunai di Loket Bendahara',
    cashReceived: 1500000,

    get changeAmount() {
        if (!this.selectedBill) return 0;
        return Math.max(0, this.cashReceived - this.selectedBill.amount);
    },

    chooseStudent(st) {
        this.selectedStudent = st;
        this.selectedBill = $store.sim.bills.find(b => b.student_nis === st.nis && b.status !== 'Lunas') || {
            id: 'INV-2026-MANUAL',
            title: 'SPP & Uang Makan (November 2026)',
            amount: 1250000,
            formatted_amount: 'Rp 1.250.000',
            due_date: '10 November 2026',
            status: 'Belum Dibayar'
        };
        this.cashReceived = this.selectedBill.amount;
        $store.sim.addToast('Santri Terpilih', `Tagihan untuk ${st.name} siap diproses.`, 'info');
    },

    submitPayment() {
        if (!this.selectedStudent || !this.selectedBill) return;

        this.selectedBill.status = 'Lunas';
        this.selectedBill.paid_date = '02 November 2026';
        this.selectedBill.payment_method = this.payMethod;

        $store.sim.addToast('Pembayaran Berhasil Diterima!', `Pembayaran Rp ${this.selectedBill.amount.toLocaleString('id-ID')} untuk ${this.selectedStudent.name} lunas.`, 'success');
        
        // Buka kuitansi print
        window.open('/finance/invoices/' + this.selectedBill.id + '/print', '_blank');
        
        this.selectedStudent = null;
        this.selectedBill = null;
    }
}">

    <!-- PENCARIAN SANTRI CARD -->
    <div class="bg-white p-6 rounded-3xl border border-slate-200 shadow-2xs space-y-4">
        <h3 class="text-sm font-bold text-slate-900 pb-2 border-b border-slate-100 flex items-center gap-2">
            <i data-lucide="user-search" class="w-4 h-4 text-emerald-600"></i>
            <span>1. Cari Santri yang Melakukan Pembayaran</span>
        </h3>

        <div class="relative">
            <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                <i data-lucide="search" class="w-4 h-4"></i>
            </span>
            <input type="text" 
                   x-model="searchStudent" 
                   placeholder="Ketik nama santri atau NIS (misal: 20240001)..." 
                   class="w-full pl-9 pr-4 py-2.5 text-xs border border-slate-300 rounded-xl focus:ring-2 focus:ring-emerald-500">
        </div>

        <!-- Sample Quick Selector -->
        <div class="flex flex-wrap gap-2 text-xs">
            <span class="text-slate-400 font-semibold text-[11px] self-center">Pilih Santri Contoh:</span>
            <template x-for="st in $store.sim.students.slice(0, 4)" :key="st.id">
                <button type="button" 
                        @click="chooseStudent(st)"
                        class="px-2.5 py-1 rounded-lg border text-[11px] font-bold transition-all"
                        :class="selectedStudent && selectedStudent.id === st.id ? 'bg-emerald-600 text-white border-emerald-600' : 'bg-slate-50 text-slate-700 hover:bg-slate-100 border-slate-200'"
                        x-text="st.name + ' (' + st.nis + ')'">
                </button>
            </template>
        </div>
    </div>

    <!-- FORM TRANSAKSI KASIR -->
    <template x-if="selectedStudent && selectedBill">
        <div class="bg-white p-6 rounded-3xl border border-slate-200 shadow-2xs space-y-5">
            <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                <div>
                    <h3 class="text-sm font-bold text-slate-900" x-text="'Tagihan: ' + selectedBill.title"></h3>
                    <span class="text-xs text-slate-500" x-text="selectedStudent.name + ' • ' + selectedStudent.class"></span>
                </div>
                <span class="font-mono font-bold text-xs text-primary-900" x-text="selectedBill.id"></span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs">
                <div class="p-4 bg-slate-50 rounded-2xl border border-slate-200">
                    <span class="text-slate-400 block font-medium">Total Tagihan Harus Dibayar</span>
                    <span class="text-2xl font-black text-slate-900 mt-1 block" x-text="'Rp ' + selectedBill.amount.toLocaleString('id-ID')"></span>
                </div>

                <div class="p-4 bg-emerald-50/60 rounded-2xl border border-emerald-200">
                    <span class="text-emerald-700 block font-medium">Uang Kembalian</span>
                    <span class="text-2xl font-black text-emerald-800 mt-1 block" x-text="'Rp ' + changeAmount.toLocaleString('id-ID')"></span>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs">
                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Metode Pembayaran</label>
                    <select x-model="payMethod" class="w-full px-3 py-2 border border-slate-300 rounded-xl font-bold">
                        <option value="Tunai di Loket Bendahara">Tunai di Loket Bendahara</option>
                        <option value="Transfer Bank Syariah Indonesia (BSI)">Transfer Bank Syariah Indonesia (BSI)</option>
                        <option value="Debit Card EDC">Kartu Debit / EDC</option>
                    </select>
                </div>

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Uang Diterima dari Wali (Rp)</label>
                    <input type="number" x-model.number="cashReceived" class="w-full px-3 py-2 border border-slate-300 rounded-xl font-black text-base text-slate-900">
                </div>
            </div>

            <div class="pt-4 border-t border-slate-100 flex justify-end gap-3">
                <button type="button" @click="selectedStudent = null" class="px-4 py-2 border border-slate-200 text-slate-600 text-xs font-bold rounded-xl">
                    Batal
                </button>
                <button type="button" @click="submitPayment()" class="px-6 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs rounded-xl shadow-md flex items-center gap-2">
                    <i data-lucide="check" class="w-4 h-4"></i>
                    <span>Terima Pembayaran & Cetak Kuitansi</span>
                </button>
            </div>
        </div>
    </template>

</div>
@endsection
