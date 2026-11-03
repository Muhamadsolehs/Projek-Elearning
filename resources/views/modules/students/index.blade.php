@extends('layouts.app')

@section('title', 'Data Santri')

@section('breadcrumb')
<nav aria-label="breadcrumb" class="breadcrumb-header">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.super-admin') }}">SIM Pesantren</a></li>
        <li class="breadcrumb-item">Administrasi</li>
        <li class="breadcrumb-item active" aria-current="page">Data Santri</li>
    </ol>
</nav>
@endsection

@section('page-title')
Master Data Santri (360° Profile)
@endsection

@section('page-subtitle')
Kelola 150 data santri terpadu dengan relasi lengkap ke data akademik, keasramaan, perizinan, dan keuangan.
@endsection

@section('page-actions')
<div class="d-flex align-items-center gap-2">
    <button type="button" 
            @click="$store.sim.addToast('Ekspor Berhasil', 'Data santri berhasil diekspor ke format Excel (XLSX).', 'success')" 
            class="btn btn-sm btn-outline-secondary d-flex align-items-center gap-1">
        <i data-feather="download" style="width: 14px; height: 14px;"></i> Ekspor Excel
    </button>
    <a href="{{ route('students.create') }}" class="btn btn-sm btn-primary d-flex align-items-center gap-1">
        <i data-feather="user-plus" style="width: 14px; height: 14px;"></i> Tambah Santri Baru
    </a>
</div>
@endsection

@section('content')
<section class="section" x-data="{
    searchQuery: '',
    selectedLevel: '',
    selectedClass: '',
    selectedStatus: '',
    currentPage: 1,
    perPage: 12,

    get filteredStudents() {
        return $store.sim.students.filter(s => {
            const matchSearch = !this.searchQuery || 
                s.name.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                s.nis.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                s.parent_name.toLowerCase().includes(this.searchQuery.toLowerCase());
            
            const matchLevel = !this.selectedLevel || s.level === this.selectedLevel;
            const matchClass = !this.selectedClass || s.class.includes(this.selectedClass);
            const matchStatus = !this.selectedStatus || s.status === this.selectedStatus;

            return matchSearch && matchLevel && matchClass && matchStatus;
        });
    },

    get totalPages() {
        return Math.ceil(this.filteredStudents.length / this.perPage) || 1;
    },

    get paginatedStudents() {
        const start = (this.currentPage - 1) * this.perPage;
        return this.filteredStudents.slice(start, start + this.perPage);
    },

    resetFilters() {
        this.searchQuery = '';
        this.selectedLevel = '';
        this.selectedClass = '';
        this.selectedStatus = '';
        this.currentPage = 1;
    }
}">

    <!-- Voler Filter Bar Card -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="row g-2 align-items-center">
                <!-- Search Input -->
                <div class="col-12 col-md-4">
                    <div class="input-group">
                        <span class="input-group-text bg-light"><i data-feather="search" style="width: 14px; height: 14px;"></i></span>
                        <input type="text" 
                               x-model="searchQuery" 
                               @input="currentPage = 1"
                               class="form-control" 
                               placeholder="Cari Nama Santri, NIS, atau Wali...">
                    </div>
                </div>

                <!-- Filter Jenjang -->
                <div class="col-6 col-md-3">
                    <select x-model="selectedLevel" @change="currentPage = 1" class="form-select">
                        <option value="">Semua Jenjang (SMP & SMA)</option>
                        <option value="SMP">Tingkat SMP</option>
                        <option value="SMA">Tingkat SMA</option>
                    </select>
                </div>

                <!-- Filter Status -->
                <div class="col-6 col-md-3">
                    <select x-model="selectedStatus" @change="currentPage = 1" class="form-select">
                        <option value="">Semua Status Santri</option>
                        <option value="Aktif">Santri Aktif</option>
                        <option value="Alumni">Alumni</option>
                        <option value="Mutasi">Mutasi / Pindah</option>
                    </select>
                </div>

                <!-- Reset Button -->
                <div class="col-12 col-md-2">
                    <button type="button" @click="resetFilters()" class="btn btn-outline-secondary w-100 d-flex align-items-center justify-content-center gap-1">
                        <i data-feather="rotate-ccw" style="width: 14px; height: 14px;"></i> Reset
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Voler Table Card -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title mb-0">Daftar Santri Terdaftar</h4>
            <span class="badge bg-light-primary text-primary" x-text="'Total: ' + filteredStudents.length + ' Santri'"></span>
        </div>
        <div class="card-body px-0 pb-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover mb-0">
                    <thead>
                        <tr>
                            <th>FOTO & NAMA SANTRI</th>
                            <th>NIS</th>
                            <th>ROMBEL / KELAS</th>
                            <th>ASRAMA & KAMAR</th>
                            <th>WALI SANTRI & NO HP</th>
                            <th class="text-center">STATUS</th>
                            <th class="text-center">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <template x-for="s in paginatedStudents" :key="s.id">
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <img :src="s.avatar" class="rounded-circle border" style="width: 32px; height: 32px; object-fit: cover;">
                                        <div>
                                            <div class="fw-bold text-dark" x-text="s.name"></div>
                                            <small class="text-muted" x-text="s.gender === 'L' ? 'Putra (Ikhwan)' : 'Putri (Akhwat)'"></small>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="badge bg-light text-dark fw-bold font-monospace" x-text="s.nis"></span></td>
                                <td>
                                    <span class="badge" 
                                          :class="s.level === 'SMA' ? 'bg-primary' : 'bg-info'" 
                                          x-text="s.class">
                                    </span>
                                </td>
                                <td class="text-muted" x-text="s.dorm"></td>
                                <td>
                                    <div class="fw-semibold text-dark" x-text="s.parent_name"></div>
                                    <small class="text-muted font-monospace" x-text="s.parent_phone"></small>
                                </td>
                                <td class="text-center">
                                    <span class="badge" 
                                          :class="s.status === 'Aktif' ? 'bg-success' : 'bg-secondary'" 
                                          x-text="s.status">
                                    </span>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group btn-group-sm">
                                        <a :href="'/admin/students/' + s.id" class="btn btn-sm btn-outline-primary py-1 px-2" title="Detail 360°">
                                            <i data-feather="eye" style="width: 14px; height: 14px;"></i> Profil
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        </template>
                        <tr x-show="filteredStudents.length === 0">
                            <td colspan="7" class="text-center py-5 text-muted">
                                <i data-feather="inbox" style="width: 48px; height: 48px;" class="mb-2 d-block mx-auto text-muted"></i>
                                Tidak ada santri yang sesuai kriteria pencarian.
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Voler Pagination Footer -->
        <div class="card-footer d-flex justify-content-between align-items-center py-3">
            <small class="text-muted" x-text="'Halaman ' + currentPage + ' dari ' + totalPages"></small>
            <nav>
                <ul class="pagination pagination-primary mb-0">
                    <li class="page-item" :class="{'disabled': currentPage === 1}">
                        <button class="page-link" @click="currentPage > 1 ? currentPage-- : null">&laquo; Sebelumnya</button>
                    </li>
                    <li class="page-item active">
                        <span class="page-link" x-text="currentPage"></span>
                    </li>
                    <li class="page-item" :class="{'disabled': currentPage === totalPages}">
                        <button class="page-link" @click="currentPage < totalPages ? currentPage++ : null">Selanjutnya &raquo;</button>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</section>
@endsection
