@extends('layouts.app')

@section('title', 'Manajemen Eksemplar Buku')

@section('breadcrumb')
<nav class="flex text-xs text-slate-500 font-medium mb-1">
    <ol class="inline-flex items-center space-x-1">
        <li class="inline-flex items-center"><a href="/dashboard" class="text-primary-600 hover:underline">SIM-Pesantren</a></li>
        <li><i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-400"></i></li>
        <li class="inline-flex items-center"><a href="/library/books" class="text-primary-600 hover:underline">Perpustakaan</a></li>
        <li><i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-400"></i></li>
        <li class="text-slate-800 font-bold">Eksemplar Fisik</li>
    </ol>
</nav>
@endsection

@section('page-title')
Manajemen Eksemplar Fisik & Barcode QR
@endsection

@section('page-subtitle')
Kelola 500 eksemplar fisik buku. Setiap buku memiliki kode inventaris unik dan token QR acak aman.
@endsection

@section('page-actions')
<div class="flex items-center gap-2">
    <a href="/library/qr-generator" class="px-3.5 py-2 bg-slate-900 hover:bg-slate-800 text-white text-xs font-bold rounded-lg shadow-sm flex items-center gap-1.5 transition-all">
        <i data-lucide="printer" class="w-4 h-4 text-accent"></i>
        <span>Cetak Label QR (Format Kertas A4)</span>
    </a>
</div>
@endsection

@section('content')
<div class="space-y-6" x-data="{
    search: '',
    statusFilter: '',
    currentPage: 1,
    perPage: 12,

    get filteredCopies() {
        return $store.sim.copies.filter(c => {
            const matchSearch = !this.search || 
                c.inventory_code.toLowerCase().includes(this.search.toLowerCase()) ||
                c.book_title.toLowerCase().includes(this.search.toLowerCase());
            
            const matchStatus = !this.statusFilter || c.status === this.statusFilter;
            return matchSearch && matchStatus;
        });
    },

    get paginatedCopies() {
        const start = (this.currentPage - 1) * this.perPage;
        return this.filteredCopies.slice(start, start + this.perPage);
    },

    get totalPages() {
        return Math.ceil(this.filteredCopies.length / this.perPage) || 1;
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
                       @input="currentPage = 1"
                       placeholder="Cari Kode Inventaris (misal: INV-BK-0001-01) atau Judul..." 
                       class="w-full pl-9 pr-4 py-2 text-xs bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary-500">
            </div>

            <div>
                <select x-model="statusFilter" @change="currentPage = 1" class="w-full py-2 px-3 text-xs bg-slate-50 border border-slate-200 rounded-xl">
                    <option value="">Semua Status Fisik</option>
                    <option value="Tersedia">Tersedia di Rak</option>
                    <option value="Dipinjam">Sedang Dipinjam</option>
                    <option value="Rusak">Rusak / Perlu Perbaikan</option>
                </select>
            </div>
        </div>
    </div>

    <!-- TABLE EKSEMPLAR -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-2xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-xs">
                <thead>
                    <tr class="bg-slate-50/80 text-slate-500 uppercase tracking-wider font-semibold border-b border-slate-100">
                        <th class="py-3 px-4">Kode Inventaris</th>
                        <th class="py-3 px-4">Judul Buku / Kitab</th>
                        <th class="py-3 px-4">Nomor Panggil (Call No)</th>
                        <th class="py-3 px-4">Kondisi Fisik</th>
                        <th class="py-3 px-4 text-center">Status</th>
                        <th class="py-3 px-4">Peminjam Saat Ini</th>
                        <th class="py-3 px-4 text-center">Aksi Label</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    <template x-for="c in paginatedCopies" :key="c.id">
                        <tr class="hover:bg-slate-50/60 transition-colors">
                            <td class="py-3 px-4">
                                <span class="font-mono font-bold text-primary-900 block" x-text="c.inventory_code"></span>
                                <span class="text-[9px] text-slate-400 font-mono" x-text="'ID: ' + c.id"></span>
                            </td>
                            <td class="py-3 px-4">
                                <span class="font-bold text-slate-800 block" x-text="c.book_title"></span>
                                <span class="text-[10px] text-slate-400" x-text="c.category"></span>
                            </td>
                            <td class="py-3 px-4 font-mono font-semibold text-slate-600" x-text="c.call_number"></td>
                            <td class="py-3 px-4">
                                <span class="px-2 py-0.5 rounded text-[10px] font-bold"
                                      :class="c.condition === 'Baik' ? 'bg-emerald-50 text-emerald-700' : 'bg-amber-50 text-amber-700'"
                                      x-text="c.condition"></span>
                            </td>
                            <td class="py-3 px-4 text-center">
                                <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold"
                                      :class="{
                                          'bg-emerald-100 text-emerald-800': c.status === 'Tersedia',
                                          'bg-blue-100 text-blue-800': c.status === 'Dipinjam',
                                          'bg-red-100 text-red-800': c.status === 'Rusak'
                                      }"
                                      x-text="c.status"></span>
                            </td>
                            <td class="py-3 px-4">
                                <template x-if="c.borrower">
                                    <div>
                                        <span class="font-bold text-slate-800 block" x-text="c.borrower.student_name"></span>
                                        <span class="text-[10px] text-slate-400 font-mono" x-text="'Batas: ' + c.borrower.due_date"></span>
                                    </div>
                                </template>
                                <template x-if="!c.borrower">
                                    <span class="text-slate-400 italic text-[11px]">-</span>
                                </template>
                            </td>
                            <td class="py-3 px-4 text-center">
                                <a :href="'/library/qr-generator?code=' + c.inventory_code" class="px-2.5 py-1 bg-white hover:bg-slate-100 border border-slate-200 rounded font-bold text-slate-700 text-[11px] inline-flex items-center gap-1 shadow-2xs">
                                    <i data-lucide="printer" class="w-3.5 h-3.5 text-accent"></i>
                                    <span>Cetak QR</span>
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

</div>
@endsection
