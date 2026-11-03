@extends('layouts.app')

@section('title', 'Detail Santri 360° — ' . $student['name'])

@section('breadcrumb')
<nav class="flex text-xs text-slate-500 font-medium mb-1">
    <ol class="inline-flex items-center space-x-1">
        <li class="inline-flex items-center"><a href="/dashboard" class="text-primary-600 hover:underline">SIM-Pesantren</a></li>
        <li><i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-400"></i></li>
        <li class="inline-flex items-center"><a href="/admin/students" class="text-primary-600 hover:underline">Data Santri</a></li>
        <li><i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-400"></i></li>
        <li class="text-slate-800 font-bold">Detail 360°</li>
    </ol>
</nav>
@endsection

@section('page-title')
Detail Santri 360°: {{ $student['name'] }}
@endsection

@section('page-subtitle')
Profil komprehensif mencakup data induk, akademik, kepengasuhan asrama, keuangan, perpustakaan, dan berkas digital.
@endsection

@section('page-actions')
<div class="flex items-center gap-2">
    <a href="/admin/students" class="px-3 py-2 bg-white border border-slate-200 text-slate-700 hover:bg-slate-50 text-xs font-semibold rounded-lg shadow-2xs flex items-center gap-1.5">
        <i data-lucide="arrow-left" class="w-4 h-4"></i>
        <span>Kembali</span>
    </a>
    <a href="/admin/students/{{ $student['id'] }}/edit" class="px-3.5 py-2 bg-primary-800 hover:bg-primary-900 text-white text-xs font-bold rounded-lg shadow-sm flex items-center gap-1.5 transition-all">
        <i data-lucide="edit-3" class="w-4 h-4"></i>
        <span>Edit Data Santri</span>
    </a>
</div>
@endsection

@section('content')
<div class="space-y-6" x-data="{ activeTab: 'pribadi' }">

    <!-- HEADER PROFILE CARD -->
    <div class="bg-white p-6 rounded-3xl border border-slate-200 shadow-2xs flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div class="flex items-center gap-5">
            <img src="{{ $student['avatar'] }}" 
                 class="w-20 h-20 rounded-2xl bg-slate-100 border-2 border-primary-600 object-cover shadow-sm" 
                 alt="Foto Santri">
            <div>
                <div class="flex items-center gap-2.5">
                    <h2 class="text-xl font-extrabold text-slate-900">{{ $student['name'] }}</h2>
                    <span class="px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-emerald-100 text-emerald-800">
                        {{ $student['status'] }}
                    </span>
                </div>
                <div class="mt-1 flex flex-wrap items-center gap-3 text-xs text-slate-500 font-medium">
                    <span class="font-mono font-bold text-primary-800">NIS: {{ $student['nis'] }}</span>
                    <span>•</span>
                    <span class="font-mono">NISN: {{ $student['nisn'] }}</span>
                    <span>•</span>
                    <span class="text-slate-700 font-semibold">{{ $student['level'] }} - {{ $student['class'] }}</span>
                </div>
                <div class="mt-1 text-xs text-slate-500">
                    <span class="text-primary-700 font-semibold">{{ $student['dorm'] }}</span> • Wali: <span class="text-slate-800 font-medium">{{ $student['parent_name'] }}</span>
                </div>
            </div>
        </div>

        <!-- Mini QR Code & Card Generator -->
        <div class="flex items-center gap-4 bg-slate-50 p-3 rounded-2xl border border-slate-100 shrink-0">
            <img src="{{ asset('assets/images/qr-sample.svg') }}" 
                 class="w-16 h-16 rounded-lg bg-white p-1 border border-slate-200 shadow-2xs" 
                 alt="QR KTS">
            <div class="text-left text-xs">
                <span class="font-bold text-slate-800 block">KTS Digital QR</span>
                <span class="text-[10px] text-slate-400 font-mono block">Token Terverifikasi</span>
                <button type="button" 
                        @click="$store.sim.addToast('KTS Siap Diunduh', 'Kartu santri digital {{ $student['name'] }} berhasil digenerate dalam format PDF siap cetak.', 'success')"
                        class="mt-1 text-[11px] font-bold text-secondary hover:underline flex items-center gap-1">
                    <i data-lucide="download" class="w-3 h-3"></i> Unduh Kartu
                </button>
            </div>
        </div>
    </div>

    <!-- 9 TABS NAVIGATION (LENGKAP SESUAI SPESIFIKASI) -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-2xs overflow-hidden">
        
        <!-- Tab Bar (Horizontal Scrollable for Mobile) -->
        <div class="flex border-b border-slate-200 overflow-x-auto text-xs font-bold text-slate-500 bg-slate-50/50">
            <button type="button" @click="activeTab = 'pribadi'" 
                    class="py-3.5 px-4 sm:px-5 shrink-0 transition-colors border-b-2 flex items-center gap-2"
                    :class="activeTab === 'pribadi' ? 'border-primary-600 text-primary-900 bg-white' : 'border-transparent hover:text-slate-800'">
                <i data-lucide="user" class="w-4 h-4"></i>
                <span>1. Info Pribadi</span>
            </button>

            <button type="button" @click="activeTab = 'pendidikan'" 
                    class="py-3.5 px-4 sm:px-5 shrink-0 transition-colors border-b-2 flex items-center gap-2"
                    :class="activeTab === 'pendidikan' ? 'border-primary-600 text-primary-900 bg-white' : 'border-transparent hover:text-slate-800'">
                <i data-lucide="graduation-cap" class="w-4 h-4"></i>
                <span>2. Pendidikan</span>
            </button>

            <button type="button" @click="activeTab = 'wali'" 
                    class="py-3.5 px-4 sm:px-5 shrink-0 transition-colors border-b-2 flex items-center gap-2"
                    :class="activeTab === 'wali' ? 'border-primary-600 text-primary-900 bg-white' : 'border-transparent hover:text-slate-800'">
                <i data-lucide="users" class="w-4 h-4"></i>
                <span>3. Wali Santri</span>
            </button>

            <button type="button" @click="activeTab = 'asrama'" 
                    class="py-3.5 px-4 sm:px-5 shrink-0 transition-colors border-b-2 flex items-center gap-2"
                    :class="activeTab === 'asrama' ? 'border-primary-600 text-primary-900 bg-white' : 'border-transparent hover:text-slate-800'">
                <i data-lucide="home" class="w-4 h-4"></i>
                <span>4. Asrama</span>
            </button>

            <button type="button" @click="activeTab = 'kehadiran'" 
                    class="py-3.5 px-4 sm:px-5 shrink-0 transition-colors border-b-2 flex items-center gap-2"
                    :class="activeTab === 'kehadiran' ? 'border-primary-600 text-primary-900 bg-white' : 'border-transparent hover:text-slate-800'">
                <i data-lucide="check-square" class="w-4 h-4"></i>
                <span>5. Presensi</span>
            </button>

            <button type="button" @click="activeTab = 'perizinan'" 
                    class="py-3.5 px-4 sm:px-5 shrink-0 transition-colors border-b-2 flex items-center gap-2"
                    :class="activeTab === 'perizinan' ? 'border-primary-600 text-primary-900 bg-white' : 'border-transparent hover:text-slate-800'">
                <i data-lucide="log-out" class="w-4 h-4"></i>
                <span>6. Perizinan</span>
            </button>

            <button type="button" @click="activeTab = 'pembayaran'" 
                    class="py-3.5 px-4 sm:px-5 shrink-0 transition-colors border-b-2 flex items-center gap-2"
                    :class="activeTab === 'pembayaran' ? 'border-primary-600 text-primary-900 bg-white' : 'border-transparent hover:text-slate-800'">
                <i data-lucide="wallet" class="w-4 h-4"></i>
                <span>7. Pembayaran SPP</span>
            </button>

            <button type="button" @click="activeTab = 'perpus'" 
                    class="py-3.5 px-4 sm:px-5 shrink-0 transition-colors border-b-2 flex items-center gap-2"
                    :class="activeTab === 'perpus' ? 'border-primary-600 text-primary-900 bg-white' : 'border-transparent hover:text-slate-800'">
                <i data-lucide="book-open" class="w-4 h-4"></i>
                <span>8. Perpustakaan</span>
            </button>

            <button type="button" @click="activeTab = 'dokumen'" 
                    class="py-3.5 px-4 sm:px-5 shrink-0 transition-colors border-b-2 flex items-center gap-2"
                    :class="activeTab === 'dokumen' ? 'border-primary-600 text-primary-900 bg-white' : 'border-transparent hover:text-slate-800'">
                <i data-lucide="file-text" class="w-4 h-4"></i>
                <span>9. Dokumen Digital</span>
            </button>
        </div>

        <!-- Tab Contents Area -->
        <div class="p-6">
            
            <!-- TAB 1: INFORMASI PRIBADI -->
            <div x-show="activeTab === 'pribadi'" class="space-y-4">
                <h4 class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-3">Biodata Lengkap Santri</h4>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 text-xs">
                    <div class="p-3 bg-slate-50 rounded-xl border border-slate-100">
                        <span class="text-slate-400 block font-medium">Nama Lengkap</span>
                        <span class="font-bold text-slate-900 text-sm mt-0.5 block">{{ $student['name'] }}</span>
                    </div>
                    <div class="p-3 bg-slate-50 rounded-xl border border-slate-100">
                        <span class="text-slate-400 block font-medium">Nomor Induk Santri (NIS)</span>
                        <span class="font-mono font-bold text-primary-800 text-sm mt-0.5 block">{{ $student['nis'] }}</span>
                    </div>
                    <div class="p-3 bg-slate-50 rounded-xl border border-slate-100">
                        <span class="text-slate-400 block font-medium">NISN Nasional</span>
                        <span class="font-mono font-bold text-slate-800 text-sm mt-0.5 block">{{ $student['nisn'] }}</span>
                    </div>
                    <div class="p-3 bg-slate-50 rounded-xl border border-slate-100">
                        <span class="text-slate-400 block font-medium">Jenis Kelamin</span>
                        <span class="font-bold text-slate-800 text-sm mt-0.5 block">{{ $student['gender'] === 'L' ? 'Laki-laki (Putra)' : 'Perempuan (Putri)' }}</span>
                    </div>
                    <div class="p-3 bg-slate-50 rounded-xl border border-slate-100">
                        <span class="text-slate-400 block font-medium">Tempat, Tanggal Lahir</span>
                        <span class="font-bold text-slate-800 text-sm mt-0.5 block">{{ $student['birth_place'] }}, {{ $student['birth_date'] }}</span>
                    </div>
                    <div class="p-3 bg-slate-50 rounded-xl border border-slate-100">
                        <span class="text-slate-400 block font-medium">Tahun Masuk</span>
                        <span class="font-bold text-slate-800 text-sm mt-0.5 block">{{ $student['join_year'] }}</span>
                    </div>
                </div>
            </div>

            <!-- TAB 2: INFORMASI PENDIDIKAN -->
            <div x-show="activeTab === 'pendidikan'" class="space-y-4" style="display: none;">
                <h4 class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-3">Struktur Akademik Formal & Diniyah</h4>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 text-xs">
                    <div class="p-3 bg-slate-50 rounded-xl border border-slate-100">
                        <span class="text-slate-400 block font-medium">Jenjang Satuan Pendidikan</span>
                        <span class="font-bold text-slate-900 text-sm mt-0.5 block">Tingkat {{ $student['level'] }}</span>
                    </div>
                    <div class="p-3 bg-slate-50 rounded-xl border border-slate-100">
                        <span class="text-slate-400 block font-medium">Rombongan Belajar (Kelas)</span>
                        <span class="font-bold text-primary-800 text-sm mt-0.5 block">{{ $student['class'] }}</span>
                    </div>
                    <div class="p-3 bg-slate-50 rounded-xl border border-slate-100">
                        <span class="text-slate-400 block font-medium">Wali Kelas</span>
                        <span class="font-bold text-slate-800 text-sm mt-0.5 block">Ust. Ahmad Fauzi, S.Pd.I</span>
                    </div>
                    <div class="p-3 bg-slate-50 rounded-xl border border-slate-100">
                        <span class="text-slate-400 block font-medium">Kurikulum</span>
                        <span class="font-bold text-slate-800 text-sm mt-0.5 block">Kurikulum Terpadu Pesantren & Nasional</span>
                    </div>
                    <div class="p-3 bg-slate-50 rounded-xl border border-slate-100">
                        <span class="text-slate-400 block font-medium">Halaqah Tahfidz</span>
                        <span class="font-bold text-emerald-700 text-sm mt-0.5 block">Kelompok 3 (Pengampu: Ust. Ridwan Hakim)</span>
                    </div>
                </div>
            </div>

            <!-- TAB 3: INFORMASI WALI SANTRI -->
            <div x-show="activeTab === 'wali'" class="space-y-4" style="display: none;">
                <h4 class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-3">Kontak & Data Orang Tua / Wali</h4>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 text-xs">
                    <div class="p-3 bg-slate-50 rounded-xl border border-slate-100">
                        <span class="text-slate-400 block font-medium">Nama Wali Santri</span>
                        <span class="font-bold text-slate-900 text-sm mt-0.5 block">{{ $student['parent_name'] }}</span>
                    </div>
                    <div class="p-3 bg-slate-50 rounded-xl border border-slate-100">
                        <span class="text-slate-400 block font-medium">Nomor WhatsApp / Telepon</span>
                        <span class="font-mono font-bold text-emerald-700 text-sm mt-0.5 block">{{ $student['parent_phone'] }}</span>
                    </div>
                    <div class="p-3 bg-slate-50 rounded-xl border border-slate-100">
                        <span class="text-slate-400 block font-medium">Pekerjaan Wali</span>
                        <span class="font-bold text-slate-800 text-sm mt-0.5 block">{{ $student['parent_job'] }}</span>
                    </div>
                    <div class="p-3 bg-slate-50 rounded-xl border border-slate-100 sm:col-span-2">
                        <span class="text-slate-400 block font-medium">Alamat Domisili Keluarga</span>
                        <span class="font-medium text-slate-800 text-xs mt-0.5 block">Jl. Pesantren As-Salam No. 42, {{ $student['birth_place'] }}, Jawa</span>
                    </div>
                </div>
            </div>

            <!-- TAB 4: INFORMASI ASRAMA -->
            <div x-show="activeTab === 'asrama'" class="space-y-4" style="display: none;">
                <h4 class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-3">Lokasi & Pengasuhan Asrama</h4>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-xs">
                    <div class="p-3 bg-slate-50 rounded-xl border border-slate-100">
                        <span class="text-slate-400 block font-medium">Gedung & Nomor Kamar</span>
                        <span class="font-bold text-primary-800 text-sm mt-0.5 block">{{ $student['dorm'] }}</span>
                    </div>
                    <div class="p-3 bg-slate-50 rounded-xl border border-slate-100">
                        <span class="text-slate-400 block font-medium">Musyrif / Pembina Kamar</span>
                        <span class="font-bold text-slate-800 text-sm mt-0.5 block">Ust. Zainal Abidin, Lc</span>
                    </div>
                    <div class="p-3 bg-slate-50 rounded-xl border border-slate-100">
                        <span class="text-slate-400 block font-medium">Kondisi Fasilitas Kamar</span>
                        <span class="font-bold text-emerald-600 text-sm mt-0.5 block">Lengkap & Terawat</span>
                    </div>
                </div>
            </div>

            <!-- TAB 5: RIWAYAT KEHADIRAN -->
            <div x-show="activeTab === 'kehadiran'" class="space-y-4" style="display: none;">
                <h4 class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-3">Statistik Kehadiran Semester Ini</h4>
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 text-center">
                    <div class="p-3.5 bg-emerald-50 rounded-xl border border-emerald-100">
                        <span class="text-2xl font-extrabold text-emerald-700 block">{{ $student['attendance_summary']['hadir'] }}</span>
                        <span class="text-[11px] font-bold text-emerald-900">Hadir (Sesi)</span>
                    </div>
                    <div class="p-3.5 bg-blue-50 rounded-xl border border-blue-100">
                        <span class="text-2xl font-extrabold text-blue-700 block">{{ $student['attendance_summary']['izin'] }}</span>
                        <span class="text-[11px] font-bold text-blue-900">Izin</span>
                    </div>
                    <div class="p-3.5 bg-amber-50 rounded-xl border border-amber-100">
                        <span class="text-2xl font-extrabold text-amber-700 block">{{ $student['attendance_summary']['sakit'] }}</span>
                        <span class="text-[11px] font-bold text-amber-900">Sakit</span>
                    </div>
                    <div class="p-3.5 bg-red-50 rounded-xl border border-red-100">
                        <span class="text-2xl font-extrabold text-red-700 block">{{ $student['attendance_summary']['alfa'] }}</span>
                        <span class="text-[11px] font-bold text-red-900">Alfa</span>
                    </div>
                </div>
            </div>

            <!-- TAB 6: RIWAYAT PERIZINAN -->
            <div x-show="activeTab === 'perizinan'" class="space-y-4" style="display: none;">
                <h4 class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-3">Daftar Pengajuan Izin Keluar & Pulang</h4>
                <div class="space-y-2.5">
                    @forelse($permissions as $perm)
                    <div class="p-3 rounded-xl bg-slate-50 border border-slate-200 flex items-center justify-between text-xs">
                        <div>
                            <span class="font-bold text-slate-900">{{ $perm['type'] }}</span>
                            <span class="text-slate-500 block text-[11px] mt-0.5">{{ $perm['reason'] }}</span>
                            <span class="text-primary-700 font-semibold text-[10px] mt-1 block">{{ $perm['departure_date'] }} s/d {{ $perm['return_plan'] }}</span>
                        </div>
                        <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800">
                            {{ $perm['status'] }}
                        </span>
                    </div>
                    @empty
                    <div class="p-4 text-center text-slate-400 text-xs italic">
                        Belum ada riwayat perizinan keluar untuk santri ini.
                    </div>
                    @endforelse
                </div>
            </div>

            <!-- TAB 7: RIWAYAT PEMBAYARAN -->
            <div x-show="activeTab === 'pembayaran'" class="space-y-4" style="display: none;">
                <h4 class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-3">Rincian Tagihan & Pembayaran SPP</h4>
                <div class="space-y-2.5">
                    @forelse($bills as $bill)
                    <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-200 flex items-center justify-between text-xs">
                        <div>
                            <div class="flex items-center gap-2">
                                <span class="font-mono font-bold text-primary-900">{{ $bill['id'] }}</span>
                                <span class="font-bold text-slate-800">{{ $bill['title'] }}</span>
                            </div>
                            <span class="text-slate-400 text-[10px]">Jatuh Tempo: {{ $bill['due_date'] }}</span>
                        </div>
                        <div class="text-right">
                            <span class="font-extrabold text-slate-900 text-sm block">{{ $bill['formatted_amount'] }}</span>
                            <span class="px-2 py-0.5 rounded-full text-[10px] font-bold {{ $bill['status'] === 'Lunas' ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800' }}">
                                {{ $bill['status'] }}
                            </span>
                        </div>
                    </div>
                    @empty
                    <div class="p-4 text-center text-slate-400 text-xs italic">
                        Semua tagihan lunas atau belum ada tagihan aktif.
                    </div>
                    @endforelse
                </div>
            </div>

            <!-- TAB 8: RIWAYAT PEMINJAMAN BUKU PERPUSTAKAAN -->
            <div x-show="activeTab === 'perpus'" class="space-y-4" style="display: none;">
                <h4 class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-3">Riwayat Sirkulasi Peminjaman Kitab & Buku</h4>
                <div class="space-y-2.5">
                    @forelse($circulations as $circ)
                    <div class="p-3 rounded-xl bg-slate-50 border border-slate-200 flex items-center justify-between text-xs">
                        <div>
                            <span class="font-mono text-accent-dark font-bold text-[11px] block">{{ $circ['copy_code'] }}</span>
                            <span class="font-bold text-slate-900 text-xs">{{ $circ['book_title'] }}</span>
                            <span class="text-slate-400 text-[10px] block mt-0.5">Pinjam: {{ $circ['borrow_date'] }} • Tenggat: {{ $circ['due_date'] }}</span>
                        </div>
                        <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold {{ $circ['status'] === 'Terlambat' ? 'bg-red-100 text-red-800' : 'bg-blue-100 text-blue-800' }}">
                            {{ $circ['status'] }}
                        </span>
                    </div>
                    @empty
                    <div class="p-4 text-center text-slate-400 text-xs italic">
                        Tidak ada riwayat peminjaman buku aktif.
                    </div>
                    @endforelse
                </div>
            </div>

            <!-- TAB 9: DOKUMEN DIGITAL -->
            <div x-show="activeTab === 'dokumen'" class="space-y-4" style="display: none;">
                <h4 class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-3">Arsip Berkas Digital Santri</h4>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-xs">
                    <div class="p-3.5 rounded-xl border border-slate-200 bg-slate-50 flex items-center justify-between">
                        <div class="flex items-center gap-2.5">
                            <i data-lucide="file-check" class="w-5 h-5 text-emerald-600"></i>
                            <div>
                                <span class="font-bold text-slate-800 block">Kartu Keluarga (KK)</span>
                                <span class="text-[10px] text-slate-400">PDF • 1.2 MB</span>
                            </div>
                        </div>
                        <button type="button" @click="$store.sim.addToast('Membuka Berkas', 'Membuka preview arsip KK', 'info')" class="text-primary-700 font-bold hover:underline">Lihat</button>
                    </div>

                    <div class="p-3.5 rounded-xl border border-slate-200 bg-slate-50 flex items-center justify-between">
                        <div class="flex items-center gap-2.5">
                            <i data-lucide="file-check" class="w-5 h-5 text-emerald-600"></i>
                            <div>
                                <span class="font-bold text-slate-800 block">Akta Kelahiran</span>
                                <span class="text-[10px] text-slate-400">PDF • 850 KB</span>
                            </div>
                        </div>
                        <button type="button" @click="$store.sim.addToast('Membuka Berkas', 'Membuka preview arsip Akta', 'info')" class="text-primary-700 font-bold hover:underline">Lihat</button>
                    </div>

                    <div class="p-3.5 rounded-xl border border-slate-200 bg-slate-50 flex items-center justify-between">
                        <div class="flex items-center gap-2.5">
                            <i data-lucide="file-check" class="w-5 h-5 text-emerald-600"></i>
                            <div>
                                <span class="font-bold text-slate-800 block">Ijazah / SKL Asal</span>
                                <span class="text-[10px] text-slate-400">PDF • 1.8 MB</span>
                            </div>
                        </div>
                        <button type="button" @click="$store.sim.addToast('Membuka Berkas', 'Membuka preview arsip Ijazah', 'info')" class="text-primary-700 font-bold hover:underline">Lihat</button>
                    </div>

                    <div class="p-3.5 rounded-xl border border-slate-200 bg-slate-50 flex items-center justify-between">
                        <div class="flex items-center gap-2.5">
                            <i data-lucide="file-check" class="w-5 h-5 text-emerald-600"></i>
                            <div>
                                <span class="font-bold text-slate-800 block">Surat Keterangan Sehat UKS</span>
                                <span class="text-[10px] text-slate-400">PDF • 600 KB</span>
                            </div>
                        </div>
                        <button type="button" @click="$store.sim.addToast('Membuka Berkas', 'Membuka preview arsip Surat Sehat', 'info')" class="text-primary-700 font-bold hover:underline">Lihat</button>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>
@endsection
