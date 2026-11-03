@extends('layouts.app')

@section('title', 'Sirkulasi Peminjaman Buku (QR Kamera)')

@section('breadcrumb')
<nav class="flex text-xs text-slate-500 font-medium mb-1">
    <ol class="inline-flex items-center space-x-1">
        <li class="inline-flex items-center"><a href="/dashboard" class="text-primary-600 hover:underline">SIM-Pesantren</a></li>
        <li><i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-400"></i></li>
        <li class="inline-flex items-center"><a href="/dashboard/perpustakaan" class="text-primary-600 hover:underline">Perpustakaan</a></li>
        <li><i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-400"></i></li>
        <li class="text-slate-800 font-bold">Peminjaman Kamera</li>
    </ol>
</nav>
@endsection

@section('page-title')
Sirkulasi Peminjaman Buku Menggunakan Kamera
@endsection

@section('page-subtitle')
Arahkan kamera ke QR Code buku (dapat beberapa buku), lalu pindai QR Kartu Santri (KTS) untuk konfirmasi peminjaman.
@endsection

@section('page-actions')
<a href="/library/circulation/return" class="px-3.5 py-2 bg-emerald-700 hover:bg-emerald-800 text-white text-xs font-bold rounded-lg shadow-sm flex items-center gap-1.5 transition-all">
    <i data-lucide="corner-down-left" class="w-4 h-4"></i>
    <span>Ke Menu Pengembalian</span>
</a>
@endsection

@section('content')
<div class="space-y-6" x-data="{
    // Scanner State
    cameraActive: false,
    html5QrScanner: null,
    scanMode: 'book', // 'book' atau 'student'
    manualInput: '',
    cameraStatusText: 'Kamera Siaga (Tekan Mulai Kamera)',

    // Transaction State
    scannedBooks: [],
    scannedStudent: null,
    maxBooksAllowed: 3,

    // Start Camera using html5-qrcode
    startCamera() {
        this.cameraActive = true;
        this.cameraStatusText = 'Mengakses Kamera Perangkat...';
        
        this.$nextTick(() => {
            const qrRegion = document.getElementById('qr-reader');
            if (!qrRegion) return;

            try {
                if (typeof Html5Qrcode !== 'undefined') {
                    this.html5QrScanner = new Html5Qrcode('qr-reader');
                    this.html5QrScanner.start(
                        { facingMode: 'environment' },
                        { fps: 10, qrbox: { width: 240, height: 240 } },
                        (decodedText) => {
                            this.handleScannedToken(decodedText);
                        },
                        (errorMessage) => {
                            // parse error, ignore while searching frame
                        }
                    ).then(() => {
                        this.cameraStatusText = 'Kamera Aktif • Arahkan ke QR Code';
                        $store.sim.addToast('Kamera Aktif', 'Kamera scanner berhasil diaktifkan.', 'info');
                    }).catch(err => {
                        this.cameraStatusText = 'Akses Kamera Terkendala: Gunakan Input Manual / Simulasi Scan';
                        $store.sim.addToast('Kamera Ditolak / Offline', 'Izin kamera tidak diberikan atau perangkat tidak memiliki webcam. Gunakan simulasi scan atau input manual di bawah.', 'warning');
                    });
                }
            } catch (err) {
                this.cameraStatusText = 'Mode Simulasi Aktif';
            }
        });
    },

    stopCamera() {
        if (this.html5QrScanner) {
            this.html5QrScanner.stop().then(() => {
                this.cameraActive = false;
                this.cameraStatusText = 'Kamera Dimatikan';
                $store.sim.addToast('Kamera Nonaktif', 'Scanner kamera telah dihentikan.', 'info');
            }).catch(err => {
                this.cameraActive = false;
            });
        } else {
            this.cameraActive = false;
        }
    },

    // Process Token from Camera or Manual
    handleScannedToken(token) {
        $store.sim.playBeep(true);

        // Jika mode scan kartu santri atau token KTS
        if (token.includes('KTS-') || this.scanMode === 'student') {
            this.processStudentToken(token);
            return;
        }

        // Mode scan buku
        this.processBookToken(token);
    },

    processBookToken(token) {
        // Cari eksemplar yang cocok di database
        const copy = $store.sim.copies.find(c => 
            c.qr_token === token || 
            c.inventory_code === token ||
            token.includes(c.inventory_code)
        );

        if (!copy) {
            $store.sim.playBeep(false);
            $store.sim.addToast('QR Tidak Valid', 'Kode QR buku tidak dikenali dalam sistem inventaris perpustakaan.', 'danger');
            return;
        }

        // Cegah buku ganda dalam 1 transaksi
        if (this.scannedBooks.some(b => b.inventory_code === copy.inventory_code)) {
            $store.sim.playBeep(false);
            $store.sim.addToast('Buku Sudah Ditambahkan', `Buku [${copy.inventory_code}] ${copy.book_title} sudah ada dalam daftar peminjaman ini.`, 'warning');
            return;
        }

        // Cek status ketersediaan
        if (copy.status === 'Dipinjam') {
            $store.sim.playBeep(false);
            $store.sim.addToast('Buku Sedang Dipinjam', `Buku [${copy.inventory_code}] sedang dalam status dipinjam oleh santri lain.`, 'danger');
            return;
        }

        if (copy.status === 'Rusak') {
            $store.sim.playBeep(false);
            $store.sim.addToast('Buku Rusak', `Buku [${copy.inventory_code}] sedang dalam kondisi rusak/perbaikan dan tidak dapat dipinjam.`, 'danger');
            return;
        }

        // Cek kuota maksimal pinjam
        if (this.scannedBooks.length >= this.maxBooksAllowed) {
            $store.sim.playBeep(false);
            $store.sim.addToast('Batas Peminjaman Tercapai', `Maksimal peminjaman adalah ${this.maxBooksAllowed} buku per transaksi.`, 'warning');
            return;
        }

        // Berhasil tambahkan
        this.scannedBooks.push({
            id: copy.id,
            inventory_code: copy.inventory_code,
            title: copy.book_title,
            call_number: copy.call_number,
            condition: copy.condition
        });

        $store.sim.addToast('Buku Terdeteksi', `Buku [${copy.inventory_code}] berhasil ditambahkan ke keranjang pinjam.`, 'success');
        
        // Jika sudah scan buku, sarankan scan kartu santri
        if (this.scannedBooks.length >= 1 && !this.scannedStudent) {
            this.scanMode = 'student';
        }
    },

    processStudentToken(token) {
        // Cari santri berdasarkan qr_token atau NIS
        const student = $store.sim.students.find(s => 
            s.qr_token === token || 
            s.nis === token || 
            token.includes(s.nis)
        );

        if (!student) {
            $store.sim.playBeep(false);
            $store.sim.addToast('Kartu Tidak Valid', 'QR Code Kartu Santri (KTS) tidak terdaftar dalam pangkalan data.', 'danger');
            return;
        }

        if (student.status !== 'Aktif') {
            $store.sim.playBeep(false);
            $store.sim.addToast('Santri Tidak Aktif', `Santri ${student.name} berstatus ${student.status} dan tidak berhak meminjam buku.`, 'danger');
            return;
        }

        this.scannedStudent = {
            id: student.id,
            name: student.name,
            nis: student.nis,
            class: student.class,
            dorm: student.dorm,
            avatar: student.avatar
        };

        $store.sim.addToast('Identitas Santri Valid', `Santri terverifikasi: ${student.name} (${student.class})`, 'success');
        this.scanMode = 'book';
    },

    removeBook(index) {
        this.scannedBooks.splice(index, 1);
        $store.sim.addToast('Buku Dihapus', 'Buku telah dikeluarkan dari daftar peminjaman.', 'info');
    },

    confirmTransaction() {
        if (this.scannedBooks.length === 0) {
            $store.sim.addToast('Belum Ada Buku', 'Silakan pindai minimal 1 buku terlebih dahulu.', 'warning');
            return;
        }

        if (!this.scannedStudent) {
            $store.sim.addToast('Santri Belum Dipindai', 'Silakan pindai Kartu Santri (KTS) untuk menentukan peminjam.', 'warning');
            return;
        }

        // Update status buku di master store
        this.scannedBooks.forEach(b => {
            const foundCopy = $store.sim.copies.find(c => c.inventory_code === b.inventory_code);
            if (foundCopy) {
                foundCopy.status = 'Dipinjam';
                foundCopy.borrower = {
                    student_id: this.scannedStudent.id,
                    student_name: this.scannedStudent.name,
                    student_nis: this.scannedStudent.nis,
                    borrow_date: '02 November 2026',
                    due_date: '09 November 2026'
                };
            }

            // Tambahkan ke riwayat sirkulasi
            $store.sim.circulations.unshift({
                id: 'TRX-CIRC-' + String($store.sim.circulations.length + 1).padStart(4, '0'),
                student_id: this.scannedStudent.id,
                student_name: this.scannedStudent.name,
                student_nis: this.scannedStudent.nis,
                student_class: this.scannedStudent.class,
                copy_code: b.inventory_code,
                book_title: b.title,
                borrow_date: '02 November 2026',
                due_date: '09 November 2026',
                return_date: null,
                status: 'Sedang Dipinjam',
                condition: 'Baik',
                fine: 0
            });
        });

        $store.sim.addToast('Transaksi Peminjaman Berhasil!', `Sebanyak ${this.scannedBooks.length} buku berhasil dipinjamkan kepada ${this.scannedStudent.name}. Batas pengembalian: 09 November 2026.`, 'success');

        // Reset Form
        this.scannedBooks = [];
        this.scannedStudent = null;
        this.scanMode = 'book';
    },

    // Shortcut Simulasi Scanner untuk Pengujian Cepat
    simulateBookScan(code) {
        this.handleScannedToken(code);
    },

    simulateStudentScan(nis) {
        this.handleScannedToken('KTS-PESANTREN-' + nis);
    }
}">

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
        
        <!-- KOLOM KIRI: VIEWPORT KAMERA & KONTROL SCANNER (LG: 7 COLS) -->
        <div class="lg:col-span-7 space-y-4">
            
            <div class="bg-white p-5 rounded-3xl border border-slate-200 shadow-2xs">
                
                <!-- Scanner Mode Selector -->
                <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                    <div class="flex items-center gap-2">
                        <span class="text-xs font-bold text-slate-700">Target Pindai:</span>
                        <div class="inline-flex p-1 bg-slate-100 rounded-xl">
                            <button type="button" @click="scanMode = 'book'" 
                                    class="px-3 py-1 rounded-lg text-xs font-bold transition-all"
                                    :class="scanMode === 'book' ? 'bg-white text-primary-900 shadow-2xs' : 'text-slate-500'">
                                1. Pindai Buku
                            </button>
                            <button type="button" @click="scanMode = 'student'" 
                                    class="px-3 py-1 rounded-lg text-xs font-bold transition-all"
                                    :class="scanMode === 'student' ? 'bg-white text-secondary shadow-2xs' : 'text-slate-500'">
                                2. Pindai KTS Santri
                            </button>
                        </div>
                    </div>

                    <!-- Status Camera Badge -->
                    <div class="flex items-center gap-1.5 text-xs font-semibold"
                         :class="cameraActive ? 'text-emerald-600' : 'text-slate-400'">
                        <span class="w-2.5 h-2.5 rounded-full" :class="cameraActive ? 'bg-emerald-500 animate-ping' : 'bg-slate-300'"></span>
                        <span x-text="cameraActive ? 'Kamera Live' : 'Kamera Mati'"></span>
                    </div>
                </div>

                <!-- VIEWPORT KAMERA SCANNER FRAME -->
                <div class="relative mt-4 aspect-4/3 sm:aspect-16/9 bg-slate-950 rounded-2xl overflow-hidden flex flex-col items-center justify-center border border-slate-800 shadow-inner">
                    
                    <!-- HTML5-QRCode Target Element -->
                    <div id="qr-reader" class="w-full h-full object-cover"></div>

                    <!-- Overlay Scanner Frame (Target Box & Animated Laser) -->
                    <div class="absolute inset-0 pointer-events-none flex flex-col items-center justify-center p-6">
                        <div class="relative w-56 h-56 sm:w-64 sm:h-64 rounded-2xl border-2 border-dashed border-accent/60 bg-accent/5 flex items-center justify-center">
                            
                            <!-- Corner Accents -->
                            <div class="scanner-corner scanner-corner-tl"></div>
                            <div class="scanner-corner scanner-corner-tr"></div>
                            <div class="scanner-corner scanner-corner-bl"></div>
                            <div class="scanner-corner scanner-corner-br"></div>

                            <!-- Animated Laser Line -->
                            <div class="scanner-laser" x-show="cameraActive"></div>

                            <span class="text-[11px] font-bold text-accent px-3 py-1 bg-slate-900/80 rounded-full border border-accent/40 shadow-md">
                                <span x-text="scanMode === 'book' ? 'ARAHKAN KE QR BUKU' : 'ARAHKAN KE QR KARTU SANTRI'"></span>
                            </span>
                        </div>
                    </div>

                    <!-- Placeholder / Start Camera Prompt if Inactive -->
                    <div x-show="!cameraActive" class="absolute inset-0 bg-slate-900/90 flex flex-col items-center justify-center text-center p-6 text-white z-10">
                        <div class="w-14 h-14 rounded-2xl bg-slate-800 text-accent flex items-center justify-center mb-3 shadow-lg border border-slate-700">
                            <i data-lucide="camera" class="w-7 h-7"></i>
                        </div>
                        <h4 class="text-sm font-bold">Kamera Belum Diaktifkan</h4>
                        <p class="text-xs text-slate-400 mt-1 max-w-xs">
                            Tekan tombol di bawah untuk mengaktifkan pemindaian barcode/QR secara langsung melalui kamera browser.
                        </p>
                        <button type="button" 
                                @click="startCamera()" 
                                class="mt-4 px-5 py-2.5 bg-primary-700 hover:bg-primary-600 text-white font-bold text-xs rounded-xl shadow-lg transition-all flex items-center gap-2">
                            <i data-lucide="video" class="w-4 h-4 text-accent"></i>
                            <span>Nyalakan Kamera Scanner</span>
                        </button>
                    </div>

                </div>

                <!-- CAMERA CONTROLS BAR -->
                <div class="mt-4 flex flex-wrap items-center justify-between gap-3 text-xs">
                    <div class="text-slate-500 font-medium flex items-center gap-1.5">
                        <i data-lucide="info" class="w-4 h-4 text-primary-600"></i>
                        <span x-text="cameraStatusText"></span>
                    </div>

                    <div class="flex items-center gap-2">
                        <button x-show="cameraActive" 
                                type="button" 
                                @click="stopCamera()" 
                                class="px-3 py-1.5 bg-red-100 hover:bg-red-200 text-red-700 font-bold rounded-lg transition-colors flex items-center gap-1">
                            <i data-lucide="video-off" class="w-3.5 h-3.5"></i>
                            <span>Hentikan Kamera</span>
                        </button>
                    </div>
                </div>

                <!-- FALLBACK: INPUT MANUAL KODE INVENTARIS / TOKEN -->
                <div class="mt-5 pt-4 border-t border-slate-100">
                    <label class="block text-xs font-bold text-slate-700 mb-1">Input Manual Kode / Token (Alternatif Tanpa Kamera)</label>
                    <div class="flex gap-2">
                        <input type="text" 
                               x-model="manualInput" 
                               @keyup.enter="if (manualInput) { handleScannedToken(manualInput); manualInput = ''; }"
                               placeholder="Ketik kode (misal: INV-BK-0001-01 atau KTS-PESANTREN-20240001)..." 
                               class="flex-1 px-3 py-2 text-xs border border-slate-300 rounded-xl font-mono focus:ring-2 focus:ring-primary-500">
                        <button type="button" 
                                @click="if (manualInput) { handleScannedToken(manualInput); manualInput = ''; }"
                                class="px-4 py-2 bg-slate-800 hover:bg-slate-900 text-white font-bold text-xs rounded-xl transition-colors">
                            Cari & Tambah
                        </button>
                    </div>
                </div>

                <!-- SHORTCUT SIMULASI SCAN CEPAT (DEMO HELPER) -->
                <div class="mt-4 pt-3 border-t border-dashed border-slate-200">
                    <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400 block mb-2">Simulasi Scan Instan (Untuk Pengujian Demo):</span>
                    <div class="flex flex-wrap gap-1.5">
                        <button type="button" @click="simulateBookScan('INV-BK-0001-01')" class="px-2 py-1 bg-slate-100 hover:bg-primary-50 hover:text-primary-800 text-slate-700 text-[11px] rounded font-mono border">
                            + Fathul Qorib (INV-0001-01)
                        </button>
                        <button type="button" @click="simulateBookScan('INV-BK-0003-01')" class="px-2 py-1 bg-slate-100 hover:bg-primary-50 hover:text-primary-800 text-slate-700 text-[11px] rounded font-mono border">
                            + Al-Jurumiyah (INV-0003-01)
                        </button>
                        <button type="button" @click="simulateBookScan('INV-BK-0007-01')" class="px-2 py-1 bg-slate-100 hover:bg-primary-50 hover:text-primary-800 text-slate-700 text-[11px] rounded font-mono border">
                            + Riyadhus Shalihin (INV-0007-01)
                        </button>
                        <button type="button" @click="simulateStudentScan('20240001')" class="px-2 py-1 bg-emerald-100 hover:bg-emerald-200 text-emerald-800 text-[11px] rounded font-bold border border-emerald-300">
                            + Scan KTS: Muhammad Pratama
                        </button>
                    </div>
                </div>

            </div>

        </div>

        <!-- KOLOM KANAN: DAFTAR BUKU HASIL SCAN & IDENTITAS SANTRI (LG: 5 COLS) -->
        <div class="lg:col-span-5 space-y-4">
            
            <!-- IDENTITAS SANTRI PEMINJAM CARD -->
            <div class="bg-white p-5 rounded-3xl border border-slate-200 shadow-2xs">
                <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                    <h3 class="text-xs font-bold uppercase tracking-wider text-slate-500 flex items-center gap-1.5">
                        <i data-lucide="user-check" class="w-4 h-4 text-emerald-600"></i>
                        <span>Peminjam: Kartu Santri (KTS)</span>
                    </h3>
                    <template x-if="scannedStudent">
                        <button type="button" @click="scannedStudent = null" class="text-[11px] text-red-600 font-semibold hover:underline">Ganti</button>
                    </template>
                </div>

                <template x-if="scannedStudent">
                    <div class="mt-3 flex items-center gap-3.5 p-3 rounded-2xl bg-emerald-50/60 border border-emerald-200">
                        <img :src="scannedStudent.avatar" class="w-12 h-12 rounded-xl bg-white border border-emerald-300 object-cover" alt="">
                        <div>
                            <div class="font-extrabold text-sm text-slate-900" x-text="scannedStudent.name"></div>
                            <div class="text-xs font-mono font-bold text-emerald-800" x-text="'NIS: ' + scannedStudent.nis"></div>
                            <div class="text-[11px] text-slate-600 mt-0.5" x-text="scannedStudent.class + ' • ' + scannedStudent.dorm"></div>
                        </div>
                    </div>
                </template>

                <template x-if="!scannedStudent">
                    <div class="mt-3 p-5 rounded-2xl border-2 border-dashed border-slate-200 bg-slate-50/50 text-center text-xs text-slate-400">
                        <i data-lucide="qr-code" class="w-8 h-8 mx-auto text-slate-300 mb-1"></i>
                        <span class="font-semibold block text-slate-600">Belum ada KTS Santri dipindai</span>
                        <span class="text-[11px] block mt-0.5">Arahkan kamera ke QR Kartu Santri peminjam</span>
                    </div>
                </template>
            </div>

            <!-- DAFTAR BUKU HASIL PEMINDAIAN -->
            <div class="bg-white p-5 rounded-3xl border border-slate-200 shadow-2xs">
                <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                    <h3 class="text-xs font-bold uppercase tracking-wider text-slate-500 flex items-center gap-1.5">
                        <i data-lucide="book" class="w-4 h-4 text-primary-700"></i>
                        <span>Daftar Buku Terpindai</span>
                    </h3>
                    <span class="text-xs font-bold px-2 py-0.5 rounded-full"
                          :class="scannedBooks.length > 0 ? 'bg-primary-50 text-primary-800' : 'bg-slate-100 text-slate-500'"
                          x-text="scannedBooks.length + ' / ' + maxBooksAllowed + ' Buku'"></span>
                </div>

                <div class="mt-3 space-y-2.5 max-h-72 overflow-y-auto">
                    <template x-for="(book, idx) in scannedBooks" :key="book.inventory_code">
                        <div class="p-3 rounded-2xl bg-slate-50 border border-slate-200 flex items-center justify-between gap-3 text-xs">
                            <div class="min-w-0">
                                <span class="font-mono text-accent-dark font-black text-[11px] block" x-text="book.inventory_code"></span>
                                <span class="font-bold text-slate-900 block truncate" x-text="book.title"></span>
                                <span class="text-[10px] text-slate-400" x-text="book.call_number"></span>
                            </div>
                            <button type="button" @click="removeBook(idx)" class="p-1 text-slate-400 hover:text-red-600 rounded">
                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                            </button>
                        </div>
                    </template>

                    <div x-show="scannedBooks.length === 0" class="p-6 rounded-2xl border-2 border-dashed border-slate-200 text-center text-xs text-slate-400">
                        <i data-lucide="scan-line" class="w-7 h-7 mx-auto text-slate-300 mb-1"></i>
                        <span>Belum ada buku dipindai. Pindai QR pada punggung buku.</span>
                    </div>
                </div>

                <!-- RINGKASAN PINJAMAN & JATUH TEMPO -->
                <div class="mt-4 pt-3 border-t border-slate-100 space-y-2 text-xs">
                    <div class="flex justify-between text-slate-600">
                        <span>Tanggal Peminjaman:</span>
                        <strong class="text-slate-800">02 November 2026</strong>
                    </div>
                    <div class="flex justify-between text-slate-600">
                        <span>Batas Pengembalian (7 Hari):</span>
                        <strong class="text-primary-800 font-bold">09 November 2026</strong>
                    </div>
                </div>

                <!-- TOMBOL KONFIRMASI PEMINJAMAN -->
                <button type="button" 
                        @click="confirmTransaction()" 
                        :disabled="scannedBooks.length === 0 || !scannedStudent"
                        class="w-full mt-4 py-3 bg-secondary hover:bg-blue-700 disabled:opacity-40 disabled:cursor-not-allowed text-white font-bold text-xs rounded-xl shadow-md transition-all flex items-center justify-center gap-2">
                    <i data-lucide="check-circle" class="w-4 h-4"></i>
                    <span>Konfirmasi & Simpan Peminjaman</span>
                </button>
            </div>

        </div>

    </div>

</div>
@endsection
