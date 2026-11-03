@extends('layouts.app')

@section('title', 'Generator & Cetak QR Code Eksemplar')

@section('breadcrumb')
<nav class="flex text-xs text-slate-500 font-medium mb-1">
    <ol class="inline-flex items-center space-x-1">
        <li class="inline-flex items-center"><a href="/dashboard" class="text-primary-600 hover:underline">SIM-Pesantren</a></li>
        <li><i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-400"></i></li>
        <li class="inline-flex items-center"><a href="/library/books" class="text-primary-600 hover:underline">Perpustakaan</a></li>
        <li><i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-400"></i></li>
        <li class="text-slate-800 font-bold">Cetak Label QR</li>
    </ol>
</nav>
@endsection

@section('page-title')
Generator & Percetakan Label QR Code Buku
@endsection

@section('page-subtitle')
Cetak label stiker inventaris buku. Tersedia mode cetak satuan dan cetak massal lembar stiker A4 (Grid 3x8).
@endsection

@section('page-actions')
<div class="flex items-center gap-2">
    <a href="/library/copies" class="px-3 py-2 bg-white border border-slate-200 text-slate-700 hover:bg-slate-50 text-xs font-semibold rounded-lg shadow-2xs flex items-center gap-1.5">
        <i data-lucide="copy" class="w-4 h-4 text-slate-500"></i>
        <span>Data Eksemplar</span>
    </a>
    <button onclick="window.print()" type="button" class="px-4 py-2 bg-primary-800 hover:bg-primary-900 text-white text-xs font-bold rounded-lg shadow-sm flex items-center gap-1.5 transition-all">
        <i data-lucide="printer" class="w-4 h-4 text-accent"></i>
        <span>Cetak Lembar Label Sekarang</span>
    </button>
</div>
@endsection

@section('content')
<div class="space-y-6" x-data="{
    printMode: 'massal', // 'satuan' atau 'massal'
    selectedCode: 'INV-BK-0001-01',
    selectedBookTitle: 'Matan Taqrib (Ghayah wa Taqrib)',
    batchCount: 18, // 18 label = 1 lembar A4 penuh (grid 3 x 6)
    
    get activeCopies() {
        if (this.printMode === 'satuan') {
            return $store.sim.copies.filter(c => c.inventory_code === this.selectedCode);
        } else {
            return $store.sim.copies.slice(0, this.batchCount);
        }
    },

    selectSingleCopy(code, title) {
        this.selectedCode = code;
        this.selectedBookTitle = title;
        this.printMode = 'satuan';
        $store.sim.addToast('Eksemplar Dipilih', `Label untuk ${code} siap dicetak.`, 'info');
    }
}">

    <!-- MODE CONTROLLER & SETTINGS (Disembunyikan saat cetak) -->
    <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-2xs no-print">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            
            <!-- Tab Mode Cetak -->
            <div class="inline-flex p-1 bg-slate-100 rounded-xl border border-slate-200">
                <button type="button" 
                        @click="printMode = 'massal'"
                        class="px-4 py-2 rounded-lg text-xs font-bold transition-all flex items-center gap-1.5"
                        :class="printMode === 'massal' ? 'bg-white text-primary-900 shadow-2xs' : 'text-slate-600 hover:text-slate-900'">
                    <i data-lucide="grid" class="w-3.5 h-3.5"></i>
                    <span>Cetak Massal (Format Kertas A4)</span>
                </button>
                <button type="button" 
                        @click="printMode = 'satuan'"
                        class="px-4 py-2 rounded-lg text-xs font-bold transition-all flex items-center gap-1.5"
                        :class="printMode === 'satuan' ? 'bg-white text-primary-900 shadow-2xs' : 'text-slate-600 hover:text-slate-900'">
                    <i data-lucide="tag" class="w-3.5 h-3.5"></i>
                    <span>Cetak Satuan (Label Tunggal)</span>
                </button>
            </div>

            <!-- Controls Setting -->
            <div class="flex items-center gap-3">
                <template x-if="printMode === 'massal'">
                    <div class="flex items-center gap-2 text-xs">
                        <span class="text-slate-500 font-medium">Jumlah Label A4:</span>
                        <select x-model.number="batchCount" class="py-1.5 px-3 bg-slate-50 border border-slate-200 rounded-lg text-xs font-bold">
                            <option value="6">6 Label (2 Baris)</option>
                            <option value="12">12 Label (4 Baris)</option>
                            <option value="18">18 Label (1 Lembar A4 Penuh)</option>
                            <option value="24">24 Label (Grid Rapat)</option>
                        </select>
                    </div>
                </template>

                <template x-if="printMode === 'satuan'">
                    <div class="flex items-center gap-2 text-xs">
                        <span class="text-slate-500 font-medium">Pilih Eksemplar:</span>
                        <select x-model="selectedCode" class="py-1.5 px-3 bg-slate-50 border border-slate-200 rounded-lg text-xs font-bold max-w-xs truncate">
                            <template x-for="c in $store.sim.copies.slice(0, 30)" :key="c.id">
                                <option :value="c.inventory_code" x-text="c.inventory_code + ' - ' + c.book_title"></option>
                            </template>
                        </select>
                    </div>
                </template>

                <button onclick="window.print()" type="button" class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs rounded-xl shadow-xs flex items-center gap-1.5 transition-colors">
                    <i data-lucide="printer" class="w-4 h-4"></i>
                    <span>Cetak Sekarang (Ctrl+P)</span>
                </button>
            </div>

        </div>
    </div>

    <!-- AREA CETAK LABEL RESMI (PRINT AREA) -->
    <div class="print-area">
        
        <!-- Sheet Header (Only in preview or top) -->
        <div class="mb-4 text-center border-b border-slate-200 pb-3 no-print">
            <span class="text-xs font-bold uppercase tracking-wider text-slate-400 block">Preview Layout Kertas A4 (Siap Cetak Stiker)</span>
            <span class="text-sm font-extrabold text-slate-800">PERPUSTAKAAN PONDOK PESANTREN DARUL ILMI TERPADU</span>
        </div>

        <!-- GRID LABEL STIKER (3 Kolom per Baris - Standar Kertas Label Stiker A4) -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 qr-label-grid gap-4">
            
            <template x-for="item in activeCopies" :key="item.id">
                <div class="bg-white p-3.5 rounded-2xl border-2 border-dashed border-slate-300 shadow-2xs text-center qr-label-card flex flex-col items-center justify-between">
                    
                    <!-- Header Label -->
                    <div class="w-full border-b border-slate-200 pb-1.5 mb-2">
                        <span class="text-[9px] font-extrabold text-primary-900 tracking-wider uppercase block">PERPUSTAKAAN PESANTREN</span>
                        <span class="text-[10px] font-bold text-slate-800 truncate block max-w-full" x-text="item.book_title"></span>
                    </div>

                    <!-- QR Code Image & Inventaris -->
                    <div class="my-1 flex items-center justify-center p-1 bg-white">
                        <img src="{{ asset('assets/images/qr-sample.svg') }}" 
                             class="w-24 h-24 object-contain" 
                             alt="QR Code">
                    </div>

                    <!-- Footer Label: Kode Inventaris & Call Number -->
                    <div class="w-full border-t border-slate-200 pt-1.5 mt-1">
                        <span class="font-mono font-black text-xs text-slate-900 tracking-wider block" x-text="item.inventory_code"></span>
                        <div class="flex items-center justify-between text-[9px] font-semibold text-slate-500 mt-0.5 px-2">
                            <span x-text="item.call_number"></span>
                            <span class="text-emerald-700">TERDAFTAR</span>
                        </div>
                    </div>

                </div>
            </template>

        </div>

    </div>

</div>
@endsection
