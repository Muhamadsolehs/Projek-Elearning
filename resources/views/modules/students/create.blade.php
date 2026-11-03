@extends('layouts.app')

@section('title', 'Tambah Santri Baru')

@section('breadcrumb')
<nav class="flex text-xs text-slate-500 font-medium mb-1">
    <ol class="inline-flex items-center space-x-1">
        <li class="inline-flex items-center"><a href="/dashboard" class="text-primary-600 hover:underline">SIM-Pesantren</a></li>
        <li><i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-400"></i></li>
        <li class="inline-flex items-center"><a href="/admin/students" class="text-primary-600 hover:underline">Data Santri</a></li>
        <li><i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-400"></i></li>
        <li class="text-slate-800 font-bold">Tambah Santri Baru</li>
    </ol>
</nav>
@endsection

@section('page-title')
Formulir Pendaftaran & Tambah Santri Baru
@endsection

@section('page-subtitle')
Entri data induk santri baru terintegrasi langsung dengan nomor induk, penempatan kelas, dan asrama.
@endsection

@section('content')
<div class="max-w-4xl mx-auto space-y-6" x-data="{
    currentStep: 1,
    formData: {
        name: '',
        gender: 'L',
        nis: '20240151',
        nisn: '0089823412',
        birth_place: 'Bandung',
        birth_date: '2012-05-14',
        level: 'SMP',
        class: 'Kelas VII-A (Putra)',
        dorm: 'Gedung Al-Fatih (Putra)',
        room: 'Kamar 101',
        parent_name: '',
        parent_phone: '',
        parent_job: 'Wiraswasta',
        address: ''
    },
    saveStudent() {
        if (!this.formData.name || !this.formData.parent_name) {
            $store.sim.addToast('Data Belum Lengkap', 'Mohon lengkapi nama santri dan nama wali santri.', 'warning');
            return;
        }
        
        $store.sim.students.unshift({
            id: 'STU-' + ($store.sim.students.length + 1),
            nis: this.formData.nis,
            nisn: this.formData.nisn,
            name: this.formData.name,
            gender: this.formData.gender,
            level: this.formData.level,
            class: this.formData.class,
            dorm: this.formData.dorm + ' / ' + this.formData.room,
            parent_name: this.formData.parent_name,
            parent_phone: this.formData.parent_phone || '081234567890',
            parent_job: this.formData.parent_job,
            birth_place: this.formData.birth_place,
            birth_date: this.formData.birth_date,
            join_year: '2024/2025',
            status: 'Aktif',
            avatar: '{{ asset('assets/images/avatar/avatar-s-14.png') }}',
            qr_token: 'KTS-PESANTREN-' + this.formData.nis,
            attendance_summary: { hadir: 100, izin: 0, sakit: 0, alfa: 0 },
            violations_count: 0,
            achievements_count: 1
        });

        $store.sim.addToast('Santri Berhasil Ditambahkan', `Santri ${this.formData.name} berhasil terdaftar dengan NIS ${this.formData.nis}`, 'success');
        
        setTimeout(() => {
            window.location.href = '/admin/students';
        }, 800);
    }
}">

    <!-- STEPPER HEADER -->
    <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-2xs">
        <div class="grid grid-cols-4 gap-2 text-center text-xs font-bold">
            <button type="button" @click="currentStep = 1" 
                    class="p-2 rounded-xl border transition-all"
                    :class="currentStep === 1 ? 'border-primary-600 bg-primary-50 text-primary-900' : (currentStep > 1 ? 'border-emerald-300 bg-emerald-50 text-emerald-800' : 'border-slate-200 text-slate-400')">
                <span>1. Data Diri</span>
            </button>

            <button type="button" @click="currentStep = 2" 
                    class="p-2 rounded-xl border transition-all"
                    :class="currentStep === 2 ? 'border-primary-600 bg-primary-50 text-primary-900' : (currentStep > 2 ? 'border-emerald-300 bg-emerald-50 text-emerald-800' : 'border-slate-200 text-slate-400')">
                <span>2. Kelas & Asrama</span>
            </button>

            <button type="button" @click="currentStep = 3" 
                    class="p-2 rounded-xl border transition-all"
                    :class="currentStep === 3 ? 'border-primary-600 bg-primary-50 text-primary-900' : (currentStep > 3 ? 'border-emerald-300 bg-emerald-50 text-emerald-800' : 'border-slate-200 text-slate-400')">
                <span>3. Orang Tua / Wali</span>
            </button>

            <button type="button" @click="currentStep = 4" 
                    class="p-2 rounded-xl border transition-all"
                    :class="currentStep === 4 ? 'border-primary-600 bg-primary-50 text-primary-900' : 'border-slate-200 text-slate-400'">
                <span>4. Berkas & Simpan</span>
            </button>
        </div>
    </div>

    <!-- FORM CARD -->
    <div class="bg-white p-6 sm:p-8 rounded-3xl border border-slate-200 shadow-2xs">
        
        <!-- STEP 1: DATA DIRI -->
        <div x-show="currentStep === 1" class="space-y-4">
            <h3 class="text-sm font-bold text-slate-900 pb-2 border-b border-slate-100">Tahap 1: Data Identitas Diri Santri</h3>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs">
                <div class="sm:col-span-2">
                    <label class="block font-semibold text-slate-700 mb-1">Nama Lengkap Santri *</label>
                    <input type="text" x-model="formData.name" placeholder="Misal: Muhammad Rayhan Al-Fatih" required class="w-full px-3 py-2 border border-slate-300 rounded-xl focus:ring-2 focus:ring-primary-500">
                </div>

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Jenis Kelamin *</label>
                    <select x-model="formData.gender" class="w-full px-3 py-2 border border-slate-300 rounded-xl focus:ring-2 focus:ring-primary-500">
                        <option value="L">Laki-laki (Putra / Ikhwan)</option>
                        <option value="P">Perempuan (Putri / Akhwat)</option>
                    </select>
                </div>

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Nomor Induk Santri (NIS)</label>
                    <input type="text" x-model="formData.nis" class="w-full px-3 py-2 border border-slate-300 rounded-xl font-mono bg-slate-50">
                </div>

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Tempat Lahir</label>
                    <input type="text" x-model="formData.birth_place" class="w-full px-3 py-2 border border-slate-300 rounded-xl">
                </div>

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Tanggal Lahir</label>
                    <input type="date" x-model="formData.birth_date" class="w-full px-3 py-2 border border-slate-300 rounded-xl">
                </div>
            </div>

            <div class="pt-4 flex justify-end">
                <button type="button" @click="currentStep = 2" class="px-5 py-2.5 bg-primary-800 hover:bg-primary-900 text-white font-bold text-xs rounded-xl shadow-xs">
                    Lanjut: Kelas & Asrama &rarr;
                </button>
            </div>
        </div>

        <!-- STEP 2: KELAS & ASRAMA -->
        <div x-show="currentStep === 2" class="space-y-4" style="display: none;">
            <h3 class="text-sm font-bold text-slate-900 pb-2 border-b border-slate-100">Tahap 2: Penempatan Pendidikan & Gedung Asrama</h3>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs">
                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Jenjang Pendidikan</label>
                    <select x-model="formData.level" class="w-full px-3 py-2 border border-slate-300 rounded-xl">
                        <option value="SMP">Tingkat SMP (Tsanawiyah)</option>
                        <option value="SMA">Tingkat SMA (Aliyah)</option>
                    </select>
                </div>

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Pilihan Rombel / Kelas</label>
                    <select x-model="formData.class" class="w-full px-3 py-2 border border-slate-300 rounded-xl">
                        <option value="Kelas VII-A (Putra)">Kelas VII-A (Putra)</option>
                        <option value="Kelas VII-B (Putri)">Kelas VII-B (Putri)</option>
                        <option value="Kelas VIII-A (Putra)">Kelas VIII-A (Putra)</option>
                        <option value="Kelas X-MIPA (Putra)">Kelas X-MIPA (Putra)</option>
                    </select>
                </div>

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Gedung Asrama</label>
                    <select x-model="formData.dorm" class="w-full px-3 py-2 border border-slate-300 rounded-xl">
                        <option value="Gedung Al-Fatih (Putra)">Gedung Al-Fatih (Putra)</option>
                        <option value="Gedung Al-Faruq (Putra)">Gedung Al-Faruq (Putra)</option>
                        <option value="Gedung Khadijah (Putri)">Gedung Khadijah (Putri)</option>
                    </select>
                </div>

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Nomor Kamar</label>
                    <select x-model="formData.room" class="w-full px-3 py-2 border border-slate-300 rounded-xl">
                        <option value="Kamar 101">Kamar 101 (Lantai 1)</option>
                        <option value="Kamar 102">Kamar 102 (Lantai 1)</option>
                        <option value="Kamar 201">Kamar 201 (Lantai 2)</option>
                    </select>
                </div>
            </div>

            <div class="pt-4 flex justify-between">
                <button type="button" @click="currentStep = 1" class="px-4 py-2 border border-slate-200 text-slate-700 font-semibold text-xs rounded-xl">
                    &larr; Kembali
                </button>
                <button type="button" @click="currentStep = 3" class="px-5 py-2.5 bg-primary-800 hover:bg-primary-900 text-white font-bold text-xs rounded-xl shadow-xs">
                    Lanjut: Data Wali &rarr;
                </button>
            </div>
        </div>

        <!-- STEP 3: ORANG TUA / WALI -->
        <div x-show="currentStep === 3" class="space-y-4" style="display: none;">
            <h3 class="text-sm font-bold text-slate-900 pb-2 border-b border-slate-100">Tahap 3: Informasi Kontak Orang Tua / Wali</h3>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs">
                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Nama Orang Tua / Wali *</label>
                    <input type="text" x-model="formData.parent_name" placeholder="Misal: H. Abdullah Pratama, S.E." required class="w-full px-3 py-2 border border-slate-300 rounded-xl">
                </div>

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Nomor WhatsApp Aktif *</label>
                    <input type="text" x-model="formData.parent_phone" placeholder="081234567890" class="w-full px-3 py-2 border border-slate-300 rounded-xl font-mono">
                </div>

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Pekerjaan Wali</label>
                    <input type="text" x-model="formData.parent_job" class="w-full px-3 py-2 border border-slate-300 rounded-xl">
                </div>

                <div class="sm:col-span-2">
                    <label class="block font-semibold text-slate-700 mb-1">Alamat Lengkap Domisili</label>
                    <textarea x-model="formData.address" rows="2" placeholder="Nama Jalan, RT/RW, Kelurahan, Kecamatan, Kota/Kabupaten" class="w-full px-3 py-2 border border-slate-300 rounded-xl"></textarea>
                </div>
            </div>

            <div class="pt-4 flex justify-between">
                <button type="button" @click="currentStep = 2" class="px-4 py-2 border border-slate-200 text-slate-700 font-semibold text-xs rounded-xl">
                    &larr; Kembali
                </button>
                <button type="button" @click="currentStep = 4" class="px-5 py-2.5 bg-primary-800 hover:bg-primary-900 text-white font-bold text-xs rounded-xl shadow-xs">
                    Lanjut: Konfirmasi & Berkas &rarr;
                </button>
            </div>
        </div>

        <!-- STEP 4: BERKAS & SIMPAN -->
        <div x-show="currentStep === 4" class="space-y-4" style="display: none;">
            <h3 class="text-sm font-bold text-slate-900 pb-2 border-b border-slate-100">Tahap 4: Ringkasan & Unggah Dokumen</h3>

            <div class="p-4 bg-slate-50 rounded-2xl border border-slate-200 text-xs space-y-2">
                <div class="font-bold text-slate-900">Periksa Kembali Data Calon Santri:</div>
                <div class="grid grid-cols-2 gap-2 text-slate-600">
                    <div>Nama: <strong class="text-slate-800" x-text="formData.name || '-'"></strong></div>
                    <div>NIS Baru: <strong class="font-mono text-primary-800" x-text="formData.nis"></strong></div>
                    <div>Kelas: <strong class="text-slate-800" x-text="formData.class"></strong></div>
                    <div>Asrama: <strong class="text-slate-800" x-text="formData.dorm + ' / ' + formData.room"></strong></div>
                    <div>Wali: <strong class="text-slate-800" x-text="formData.parent_name || '-'"></strong></div>
                    <div>Kontak: <strong class="font-mono text-slate-800" x-text="formData.parent_phone || '-'"></strong></div>
                </div>
            </div>

            <div class="space-y-2 pt-2">
                <label class="block font-semibold text-xs text-slate-700">Lampiran Dokumen Santri (Scan KK & Akta):</label>
                <div class="border-2 border-dashed border-slate-300 rounded-2xl p-6 text-center text-xs text-slate-500 hover:border-primary-500 transition-colors cursor-pointer bg-slate-50/50">
                    <i data-lucide="upload-cloud" class="w-8 h-8 mx-auto text-slate-400 mb-1"></i>
                    <span class="font-bold text-slate-700">Klik untuk mengunggah dokumen</span> atau drag and drop berkas PDF/JPG di sini
                    <span class="block text-[10px] text-slate-400 mt-0.5">Maksimal 5MB per dokumen (KK, Akta, Pas Foto)</span>
                </div>
            </div>

            <div class="pt-4 flex justify-between">
                <button type="button" @click="currentStep = 3" class="px-4 py-2 border border-slate-200 text-slate-700 font-semibold text-xs rounded-xl">
                    &larr; Kembali
                </button>
                <button type="button" @click="saveStudent()" class="px-6 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs rounded-xl shadow-md flex items-center gap-2">
                    <i data-lucide="check" class="w-4 h-4"></i>
                    <span>Simpan & Daftarkan Santri</span>
                </button>
            </div>
        </div>

    </div>

</div>
@endsection
