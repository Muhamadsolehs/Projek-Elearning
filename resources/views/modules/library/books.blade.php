@extends('layouts.app')

@section('title', 'Katalog Data Buku')

@section('breadcrumb')
<nav class="flex text-xs text-slate-500 font-medium mb-1">
    <ol class="inline-flex items-center space-x-1">
        <li class="inline-flex items-center"><a href="/dashboard" class="text-primary-600 hover:underline">SIM-Pesantren</a></li>
        <li><i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-400"></i></li>
        <li class="inline-flex items-center"><a href="/dashboard/perpustakaan" class="text-primary-600 hover:underline">Perpustakaan</a></li>
        <li><i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-400"></i></li>
        <li class="text-slate-800 font-bold">Katalog Buku</li>
    </ol>
</nav>
@endsection

@section('page-title')
Katalog Judul Buku & Kitab Kuning
@endsection

@section('page-subtitle')
Koleksi 250 judul literatur keislaman, kitab turots pesantren, dan buku kurikulum nasional terpadu.
@endsection

@section('page-actions')
<div class="flex items-center gap-2">
    <a href="/library/copies" class="px-3 py-2 bg-white border border-slate-200 text-slate-700 hover:bg-slate-50 text-xs font-semibold rounded-lg shadow-2xs flex items-center gap-1.5">
        <i data-lucide="copy" class="w-4 h-4 text-slate-500"></i>
        <span>Kelola Eksemplar Fisik</span>
    </a>
    <a href="/library/qr-generator" class="px-3.5 py-2 bg-slate-900 hover:bg-slate-800 text-white text-xs font-bold rounded-lg shadow-sm flex items-center gap-1.5 transition-all">
        <i data-lucide="printer" class="w-4 h-4 text-accent"></i>
        <span>Cetak QR Label A4</span>
    </a>
</div>
@endsection

@section('content')
<div class="space-y-6" x-data="{
    search: '',
    category: '',
    currentPage: 1,
    perPage: 10,

    get filteredBooks() {
        return $store.sim.books.filter(b => {
            const matchSearch = !this.search || 
                b.title.toLowerCase().includes(this.search.toLowerCase()) ||
                b.author.toLowerCase().includes(this.search.toLowerCase()) ||
                b.isbn.toLowerCase().includes(this.search.toLowerCase());
            
            const matchCategory = !this.category || b.category === this.category;
            return matchSearch && matchCategory;
        });
    },

    get paginatedBooks() {
        const start = (this.currentPage - 1) * this.perPage;
        return this.filteredBooks.slice(start, start + this.perPage);
    },

    get totalPages() {
        return Math.ceil(this.filteredBooks.length / this.perPage) || 1;
    }
}">

    <!-- SEARCH & CATEGORY FILTER -->
    <div class="bg-white p-4 rounded-2xl border border-slate-200 shadow-2xs">
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
            <div class="sm:col-span-2 relative">
                <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                    <i data-lucide="search" class="w-4 h-4"></i>
                </span>
                <input type="text" 
                       x-model="search" 
                       @input="currentPage = 1"
                       placeholder="Cari Judul Kitab, Pengarang / Mushannif, atau ISBN..." 
                       class="w-full pl-9 pr-4 py-2 text-xs bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary-500">
            </div>

            <div>
                <select x-model="category" @change="currentPage = 1" class="w-full py-2 px-3 text-xs bg-slate-50 border border-slate-200 rounded-xl">
                    <option value="">Semua Kategori & Fan Ilmu</option>
                    <option value="Fiqih & Ibadah">Fiqih & Ibadah</option>
                    <option value="Bahasa Arab">Bahasa Arab & Nahwu</option>
                    <option value="Hadits">Hadits Nabawi</option>
                    <option value="Akhlak & Tasawuf">Akhlak & Tasawuf</option>
                    <option value="Tafsir Al-Quran">Tafsir Al-Quran</option>
                    <option value="Sains & Matematika">Sains & Matematika</option>
                    <option value="Bahasa & Sastra">Bahasa & Sastra</option>
                </select>
            </div>
        </div>
    </div>

    <!-- TABLE BUKU -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-2xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-xs">
                <thead>
                    <tr class="bg-slate-50/80 text-slate-500 uppercase tracking-wider font-semibold border-b border-slate-100">
                        <th class="py-3 px-4">Judul Buku / Kitab</th>
                        <th class="py-3 px-4">Kategori & Fan</th>
                        <th class="py-3 px-4">Pengarang (Author)</th>
                        <th class="py-3 px-4">Penerbit & Tahun</th>
                        <th class="py-3 px-4">ISBN</th>
                        <th class="py-3 px-4 text-center">Stok Eksemplar</th>
                        <th class="py-3 px-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    <template x-for="b in paginatedBooks" :key="b.id">
                        <tr class="hover:bg-slate-50/60 transition-colors">
                            <td class="py-3 px-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-11 rounded bg-slate-100 border border-slate-200 flex items-center justify-center shrink-0 overflow-hidden text-slate-400">
                                        <i data-lucide="book" class="w-5 h-5 text-primary-700"></i>
                                    </div>
                                    <div>
                                        <div class="font-bold text-slate-900 leading-tight" x-text="b.title"></div>
                                        <div class="text-[10px] text-slate-400 font-mono" x-text="b.id"></div>
                                    </div>
                                </div>
                            </td>
                            <td class="py-3 px-4">
                                <span class="px-2 py-0.5 rounded text-[10px] font-semibold bg-primary-50 text-primary-800" x-text="b.category"></span>
                            </td>
                            <td class="py-3 px-4 font-medium text-slate-800" x-text="b.author"></td>
                            <td class="py-3 px-4 text-slate-600" x-text="b.publisher + ' (' + b.year + ')'"></td>
                            <td class="py-3 px-4 font-mono text-slate-500" x-text="b.isbn"></td>
                            <td class="py-3 px-4 text-center">
                                <span class="font-bold text-emerald-700" x-text="b.available_copies"></span>
                                <span class="text-slate-400" x-text="' / ' + b.total_copies"></span>
                            </td>
                            <td class="py-3 px-4 text-center">
                                <a :href="'/library/qr-generator?book=' + b.id" class="px-2 py-1 bg-white hover:bg-slate-100 border border-slate-200 rounded font-bold text-slate-700 text-[11px] inline-flex items-center gap-1">
                                    <i data-lucide="qr-code" class="w-3 h-3 text-accent"></i>
                                    <span>QR</span>
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
