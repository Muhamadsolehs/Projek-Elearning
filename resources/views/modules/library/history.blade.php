@extends('layouts.app')

@section('title', 'Riwayat Sirkulasi Perpustakaan')

@section('breadcrumb')
<nav class="flex text-xs text-slate-500 font-medium mb-1">
    <ol class="inline-flex items-center space-x-1">
        <li class="inline-flex items-center"><a href="/dashboard" class="text-primary-600 hover:underline">SIM-Pesantren</a></li>
        <li><i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-400"></i></li>
        <li class="inline-flex items-center"><a href="/dashboard/perpustakaan" class="text-primary-600 hover:underline">Perpustakaan</a></li>
        <li><i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-400"></i></li>
        <li class="text-slate-800 font-bold">Riwayat & Laporan</li>
    </ol>
</nav>
@endsection

@section('page-title')
Riwayat Sirkulasi & Laporan Perpustakaan
@endsection

@section('page-subtitle')
Catatan riwayat transaksi peminjaman, pengembalian, dan monitoring denda keterlambatan buku.
@endsection

@section('page-actions')
<button type="button" 
        @click="$store.sim.addToast('Laporan Diekspor', 'Laporan sirkulasi perpustakaan berhasil diunduh.', 'success')" 
        class="px-3.5 py-2 bg-white border border-slate-200 text-slate-700 hover:bg-slate-50 text-xs font-semibold rounded-lg shadow-2xs flex items-center gap-1.5">
    <i data-lucide="download" class="w-4 h-4 text-slate-500"></i>
    <span>Ekspor Laporan PDF</span>
</button>
@endsection

@section('content')
<div class="space-y-6" x-data="{
    filterStatus: '',
    search: '',
    currentPage: 1,
    perPage: 12,

    get filteredCirculations() {
        return $store.sim.circulations.filter(c => {
            const matchSearch = !this.search || 
                c.student_name.toLowerCase().includes(this.search.toLowerCase()) ||
                c.book_title.toLowerCase().includes(this.search.toLowerCase()) ||
                c.copy_code.toLowerCase().includes(this.search.toLowerCase());
            
            const matchStatus = !this.filterStatus || c.status === this.filterStatus;
            return matchSearch && matchStatus;
        });
    },

    get paginatedCirculations() {
        const start = (this.currentPage - 1) * this.perPage;
        return this.filteredCirculations.slice(start, start + this.perPage);
    },

    get totalPages() {
        return Math.ceil(this.filteredCirculations.length / this.perPage) || 1;
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
                       placeholder="Cari Nama Santri, Judul Buku, atau Kode Inventaris..." 
                       class="w-full pl-9 pr-4 py-2 text-xs bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary-500">
            </div>

            <div>
                <select x-model="filterStatus" @change="currentPage = 1" class="w-full py-2 px-3 text-xs bg-slate-50 border border-slate-200 rounded-xl">
                    <option value="">Semua Status Transaksi</option>
                    <option value="Sedang Dipinjam">Sedang Dipinjam</option>
                    <option value="Terlambat">Terlambat</option>
                    <option value="Selesai Dikembalikan">Selesai Dikembalikan</option>
                </select>
            </div>
        </div>
    </div>

    <!-- TABLE RIWAYAT -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-2xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-xs">
                <thead>
                    <tr class="bg-slate-50 text-slate-500 font-semibold border-b border-slate-100 uppercase tracking-wider">
                        <th class="py-3 px-4">No. Transaksi</th>
                        <th class="py-3 px-4">Santri Peminjam</th>
                        <th class="py-3 px-4">Kode & Judul Buku</th>
                        <th class="py-3 px-4">Tgl Pinjam</th>
                        <th class="py-3 px-4">Batas Pengembalian</th>
                        <th class="py-3 px-4">Tgl Kembali</th>
                        <th class="py-3 px-4 text-center">Status</th>
                        <th class="py-3 px-4 text-center">Denda</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    <template x-for="c in paginatedCirculations" :key="c.id">
                        <tr class="hover:bg-slate-50/60 transition-colors">
                            <td class="py-3 px-4 font-mono font-bold text-primary-900" x-text="c.id"></td>
                            <td class="py-3 px-4">
                                <span class="font-bold text-slate-800 block" x-text="c.student_name"></span>
                                <span class="text-[10px] text-slate-400" x-text="c.student_class + ' • ' + c.student_nis"></span>
                            </td>
                            <td class="py-3 px-4">
                                <span class="font-mono text-accent-dark font-bold text-[11px] block" x-text="c.copy_code"></span>
                                <span class="text-slate-800 font-medium truncate max-w-xs block" x-text="c.book_title"></span>
                            </td>
                            <td class="py-3 px-4 text-slate-600" x-text="c.borrow_date"></td>
                            <td class="py-3 px-4 font-semibold" :class="c.status === 'Terlambat' ? 'text-red-600' : 'text-slate-700'" x-text="c.due_date"></td>
                            <td class="py-3 px-4 text-slate-600" x-text="c.return_date || '-'"></td>
                            <td class="py-3 px-4 text-center">
                                <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold"
                                      :class="{
                                          'bg-emerald-100 text-emerald-800': c.status === 'Selesai Dikembalikan',
                                          'bg-blue-100 text-blue-800': c.status === 'Sedang Dipinjam',
                                          'bg-red-100 text-red-800': c.status === 'Terlambat'
                                      }"
                                      x-text="c.status"></span>
                            </td>
                            <td class="py-3 px-4 text-center font-mono font-bold text-red-600" x-text="c.fine > 0 ? 'Rp ' + c.fine.toLocaleString('id-ID') : '-'"></td>
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
