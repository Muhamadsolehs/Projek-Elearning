@extends('layouts.app')

@section('title', 'Tagihan Pembayaran Santri')

@section('breadcrumb')
<nav class="flex text-xs text-slate-500 font-medium mb-1">
    <ol class="inline-flex items-center space-x-1">
        <li class="inline-flex items-center"><a href="/dashboard" class="text-primary-600 hover:underline">SIM-Pesantren</a></li>
        <li><i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-400"></i></li>
        <li class="inline-flex items-center"><a href="/dashboard/keuangan" class="text-primary-600 hover:underline">Keuangan</a></li>
        <li><i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-400"></i></li>
        <li class="text-slate-800 font-bold">Tagihan Santri</li>
    </ol>
</nav>
@endsection

@section('page-title')
Manajemen Tagihan Santri & SPP
@endsection

@section('page-subtitle')
Kelola tagihan SPP bulanan, uang masuk, dan biaya kegiatan santri per rombel maupun perorangan.
@endsection

@section('page-actions')
<div class="flex items-center gap-2">
    <a href="/finance/transactions" class="px-3 py-2 bg-white border border-slate-200 text-slate-700 hover:bg-slate-50 text-xs font-semibold rounded-lg shadow-2xs flex items-center gap-1.5">
        <i data-lucide="credit-card" class="w-4 h-4 text-emerald-600"></i>
        <span>Kasir Pembayaran</span>
    </a>
    <button type="button" 
            @click="showGenerateModal = true"
            class="px-3.5 py-2 bg-primary-800 hover:bg-primary-900 text-white text-xs font-bold rounded-lg shadow-sm flex items-center gap-1.5 transition-all">
        <i data-lucide="plus-circle" class="w-4 h-4"></i>
        <span>Generate Tagihan Massal</span>
    </button>
</div>
@endsection

@section('content')
<div class="space-y-6" x-data="{
    search: '',
    statusFilter: '',
    showGenerateModal: false,
    generateTariff: 'SPP & Uang Makan (November 2026)',
    generateAmount: 1250000,
    generateTarget: 'Semua Kelas (150 Santri)',
    currentPage: 1,
    perPage: 12,

    get filteredBills() {
        return $store.sim.bills.filter(b => {
            const matchSearch = !this.search || 
                b.student_name.toLowerCase().includes(this.search.toLowerCase()) ||
                b.student_nis.toLowerCase().includes(this.search.toLowerCase()) ||
                b.id.toLowerCase().includes(this.search.toLowerCase());
            
            const matchStatus = !this.statusFilter || b.status === this.statusFilter;
            return matchSearch && matchStatus;
        });
    },

    get paginatedBills() {
        const start = (this.currentPage - 1) * this.perPage;
        return this.filteredBills.slice(start, start + this.perPage);
    },

    get totalPages() {
        return Math.ceil(this.filteredBills.length / this.perPage) || 1;
    },

    runGenerate() {
        $store.sim.addToast('Tagihan Massal Diterbitkan!', `Tagihan ${this.generateTariff} senilai Rp ${this.generateAmount.toLocaleString('id-ID')} berhasil diterbitkan untuk ${this.generateTarget}.`, 'success');
        this.showGenerateModal = false;
    }
}">

    <!-- KPI STATS SUMMARY -->
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
        <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-2xs">
            <span class="text-xs font-bold text-slate-500 uppercase block">Total Tagihan</span>
            <span class="text-xl font-extrabold text-slate-900 mt-1 block" x-text="$store.sim.bills.length + ' Tagihan'"></span>
        </div>
        <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-2xs">
            <span class="text-xs font-bold text-emerald-600 uppercase block">Lunas Terverifikasi</span>
            <span class="text-xl font-extrabold text-emerald-700 mt-1 block" x-text="$store.sim.bills.filter(b => b.status === 'Lunas').length"></span>
        </div>
        <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-2xs">
            <span class="text-xs font-bold text-amber-600 uppercase block">Menunggu Cek Bank</span>
            <span class="text-xl font-extrabold text-amber-700 mt-1 block" x-text="$store.sim.bills.filter(b => b.status === 'Menunggu Verifikasi').length"></span>
        </div>
        <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-2xs">
            <span class="text-xs font-bold text-red-600 uppercase block">Belum Dibayar</span>
            <span class="text-xl font-extrabold text-red-700 mt-1 block" x-text="$store.sim.bills.filter(b => ['Belum Dibayar', 'Terlambat'].includes(b.status)).length"></span>
        </div>
    </div>

    <!-- FILTER BAR -->
    <div class="bg-white p-4 rounded-2xl border border-slate-200 shadow-2xs">
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
            <div class="sm:col-span-2 relative">
                <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                    <i data-lucide="search" class="w-4 h-4"></i>
                </span>
                <input type="text" 
                       x-model="search" 
                       @input="currentPage = 1"
                       placeholder="Cari No Invoice, Nama Santri, atau NIS..." 
                       class="w-full pl-9 pr-4 py-2 text-xs bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary-500">
            </div>

            <div>
                <select x-model="statusFilter" @change="currentPage = 1" class="w-full py-2 px-3 text-xs bg-slate-50 border border-slate-200 rounded-xl">
                    <option value="">Semua Status Pembayaran</option>
                    <option value="Lunas">Lunas</option>
                    <option value="Menunggu Verifikasi">Menunggu Verifikasi</option>
                    <option value="Belum Dibayar">Belum Dibayar</option>
                    <option value="Terlambat">Terlambat</option>
                </select>
            </div>
        </div>
    </div>

    <!-- TABLE TAGIHAN -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-2xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-xs">
                <thead>
                    <tr class="bg-slate-50 text-slate-500 font-semibold border-b border-slate-100 uppercase tracking-wider">
                        <th class="py-3 px-4">No. Invoice</th>
                        <th class="py-3 px-4">Santri & Kelas</th>
                        <th class="py-3 px-4">Pos Pembayaran</th>
                        <th class="py-3 px-4">Nominal</th>
                        <th class="py-3 px-4">Jatuh Tempo</th>
                        <th class="py-3 px-4 text-center">Status</th>
                        <th class="py-3 px-4 text-center">Aksi Kuitansi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    <template x-for="b in paginatedBills" :key="b.id">
                        <tr class="hover:bg-slate-50/60 transition-colors">
                            <td class="py-3 px-4 font-mono font-bold text-primary-900" x-text="b.id"></td>
                            <td class="py-3 px-4">
                                <span class="font-bold text-slate-800 block" x-text="b.student_name"></span>
                                <span class="text-[10px] text-slate-400 font-mono" x-text="b.student_class + ' • ' + b.student_nis"></span>
                            </td>
                            <td class="py-3 px-4 text-slate-700 font-medium" x-text="b.title"></td>
                            <td class="py-3 px-4 font-extrabold text-slate-900" x-text="b.formatted_amount"></td>
                            <td class="py-3 px-4 text-slate-600" x-text="b.due_date"></td>
                            <td class="py-3 px-4 text-center">
                                <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold"
                                      :class="{
                                          'bg-emerald-100 text-emerald-800': b.status === 'Lunas',
                                          'bg-amber-100 text-amber-800': b.status === 'Menunggu Verifikasi',
                                          'bg-slate-100 text-slate-700': b.status === 'Belum Dibayar',
                                          'bg-red-100 text-red-800': b.status === 'Terlambat'
                                      }"
                                      x-text="b.status"></span>
                            </td>
                            <td class="py-3 px-4 text-center">
                                <a :href="'/finance/invoices/' + b.id + '/print'" target="_blank" class="px-2.5 py-1 bg-white hover:bg-slate-100 border border-slate-200 rounded font-bold text-slate-700 text-[11px] inline-flex items-center gap-1 shadow-2xs">
                                    <i data-lucide="printer" class="w-3.5 h-3.5 text-accent"></i>
                                    <span>Kuitansi</span>
                                </a>
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="px-5 py-3 border-t border-slate-100 flex items-center justify-between text-xs bg-slate-50/50">
            <button type="button" @click="if (currentPage > 1) currentPage--" :disabled="currentPage === 1" class="px-3 py-1.5 rounded-lg border border-slate-200 bg-white text-slate-700 font-semibold disabled:opacity-40 hover:bg-slate-50">
                &larr; Sebelumnya
            </button>
            <span class="text-slate-500 font-medium">
                Halaman <span class="font-bold text-slate-800" x-text="currentPage"></span> dari <span class="font-bold text-slate-800" x-text="totalPages"></span>
            </span>
            <button type="button" @click="if (currentPage < totalPages) currentPage++" :disabled="currentPage >= totalPages" class="px-3 py-1.5 rounded-lg border border-slate-200 bg-white text-slate-700 font-semibold disabled:opacity-40 hover:bg-slate-50">
                Selanjutnya &rarr;
            </button>
        </div>
    </div>

    <!-- MODAL GENERATE TAGIHAN MASSAL -->
    <div x-show="showGenerateModal" 
         class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs z-50 flex items-center justify-center p-4" 
         style="display: none;">
        <div @click.away="showGenerateModal = false" class="bg-white rounded-3xl max-w-lg w-full p-6 shadow-2xl border border-slate-200 space-y-4">
            <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                <h3 class="text-sm font-bold text-slate-900">Generate Tagihan Massal</h3>
                <button type="button" @click="showGenerateModal = false" class="text-slate-400 hover:text-slate-600">
                    <i data-lucide="x" class="w-4 h-4"></i>
                </button>
            </div>

            <div class="space-y-3 text-xs">
                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Pilih Pos Tarif Pembayaran</label>
                    <select x-model="generateTariff" class="w-full px-3 py-2 border border-slate-300 rounded-xl">
                        <option value="SPP & Uang Makan (November 2026)">SPP & Uang Makan (November 2026)</option>
                        <option value="Uang Masuk & Pangkal">Uang Masuk & Pangkal</option>
                        <option value="Biaya Ujian & Kegiatan Santri">Biaya Ujian & Kegiatan Santri</option>
                    </select>
                </div>

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Target Santri / Rombel</label>
                    <select x-model="generateTarget" class="w-full px-3 py-2 border border-slate-300 rounded-xl">
                        <option value="Semua Kelas (150 Santri)">Semua Kelas (150 Santri Aktif)</option>
                        <option value="Tingkat SMP Saja (102 Santri)">Tingkat SMP Saja (102 Santri)</option>
                        <option value="Tingkat SMA Saja (48 Santri)">Tingkat SMA Saja (48 Santri)</option>
                    </select>
                </div>

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Nominal per Santri (Rp)</label>
                    <input type="number" x-model.number="generateAmount" class="w-full px-3 py-2 border border-slate-300 rounded-xl font-bold">
                </div>
            </div>

            <div class="pt-3 border-t border-slate-100 flex justify-end gap-2">
                <button type="button" @click="showGenerateModal = false" class="px-4 py-2 border border-slate-200 text-slate-600 text-xs font-bold rounded-xl hover:bg-slate-50">
                    Batal
                </button>
                <button type="button" @click="runGenerate()" class="px-5 py-2 bg-primary-800 hover:bg-primary-900 text-white text-xs font-bold rounded-xl shadow-xs">
                    Terbitkan Tagihan
                </button>
            </div>
        </div>
    </div>

</div>
@endsection
