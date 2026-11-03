@extends('layouts.app')

@section('title', 'Pendaftar Calon Santri (PSB)')

@section('breadcrumb')
<nav aria-label="breadcrumb" class="breadcrumb-header">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.super-admin') }}">SIM Pesantren</a></li>
        <li class="breadcrumb-item"><a href="{{ route('dashboard.psb') }}">PSB</a></li>
        <li class="breadcrumb-item active" aria-current="page">Pendaftar & Pipeline</li>
    </ol>
</nav>
@endsection

@section('page-title')
Pipeline Pendaftaran Calon Santri Baru
@endsection

@section('page-subtitle')
Pantau dan kelola seluruh calon santri baru sepanjang siklus seleksi penerimaan T.A 2026/2027.
@endsection

@section('page-actions')
<div class="d-flex align-items-center gap-2">
    <a href="{{ route('admissions.tests') }}" class="btn btn-sm btn-outline-secondary d-flex align-items-center gap-1">
        <i data-feather="check-square" style="width: 14px; height: 14px;"></i> Jadwal & Nilai Tes
    </a>
    <a href="{{ route('admissions.selection-results') }}" class="btn btn-sm btn-primary d-flex align-items-center gap-1">
        <i data-feather="award" style="width: 14px; height: 14px;"></i> Penetapan Kelulusan
    </a>
</div>
@endsection

@section('content')
<section class="section">
    <!-- Stat Counter Summary Cards (Voler Style) -->
    <div class="row g-2 mb-4">
        <div class="col-6 col-md-3">
            <div class="card card-statistic mb-0">
                <div class="card-body p-3">
                    <small class="text-muted text-uppercase fw-bold" style="font-size: 11px;">TOTAL PENDAFTAR</small>
                    <h4 class="fw-bold text-dark mb-0 mt-1">{{ count($admissions) }}</h4>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card card-statistic mb-0">
                <div class="card-body p-3">
                    <small class="text-warning text-uppercase fw-bold" style="font-size: 11px;">MENUNGGU VERIFIKASI</small>
                    <h4 class="fw-bold text-warning mb-0 mt-1">{{ count(array_filter($admissions, fn($a) => in_array($a['status'], ['Menunggu Verifikasi', 'Draft']))) }}</h4>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card card-statistic mb-0">
                <div class="card-body p-3">
                    <small class="text-info text-uppercase fw-bold" style="font-size: 11px;">SIAP / SUDAH TES</small>
                    <h4 class="fw-bold text-info mb-0 mt-1">{{ count(array_filter($admissions, fn($a) => in_array($a['status'], ['Terverifikasi', 'Menunggu Tes', 'Sudah Mengikuti Tes']))) }}</h4>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card card-statistic mb-0">
                <div class="card-body p-3">
                    <small class="text-success text-uppercase fw-bold" style="font-size: 11px;">LULUS / DITERIMA</small>
                    <h4 class="fw-bold text-success mb-0 mt-1">{{ count(array_filter($admissions, fn($a) => in_array($a['status'], ['Lulus', 'Diterima']))) }}</h4>
                </div>
            </div>
        </div>
    </div>

    <!-- Voler Datatable Card -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title mb-0">Daftar Calon Santri Baru</h4>
            <span class="badge bg-light-primary text-primary">{{ count($admissions) }} Calon Santri</span>
        </div>
        <div class="card-body">
            <table class="table table-striped" id="tableAdmissions">
                <thead>
                    <tr>
                        <th>NO. REGISTRASI</th>
                        <th>NAMA CALON SANTRI</th>
                        <th>JENJANG</th>
                        <th>ASAL SEKOLAH</th>
                        <th>WALI & KONTAK</th>
                        <th>STATUS SELEKSI</th>
                        <th class="text-center">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($admissions as $a)
                    <tr>
                        <td><span class="badge bg-light text-dark font-monospace fw-bold">{{ $a['registration_number'] }}</span></td>
                        <td>
                            <div class="fw-bold text-dark">{{ $a['name'] }}</div>
                            <small class="text-muted">Daftar: {{ $a['register_date'] }}</small>
                        </td>
                        <td>
                            <span class="badge {{ $a['level_target'] === 'SMA' ? 'bg-primary' : 'bg-info' }}">
                                {{ $a['level_target'] }}
                            </span>
                        </td>
                        <td class="text-muted">{{ $a['origin_school'] }}</td>
                        <td>
                            <div class="fw-semibold text-dark">{{ $a['parent_name'] }}</div>
                            <small class="text-muted font-monospace">{{ $a['parent_phone'] }}</small>
                        </td>
                        <td>
                            @php
                                $statusBadge = match($a['status']) {
                                    'Diterima', 'Lulus' => 'bg-success',
                                    'Terverifikasi', 'Sudah Mengikuti Tes' => 'bg-info',
                                    'Menunggu Verifikasi', 'Menunggu Tes' => 'bg-warning',
                                    'Tidak Lulus' => 'bg-danger',
                                    default => 'bg-secondary'
                                };
                            @endphp
                            <span class="badge {{ $statusBadge }}">{{ $a['status'] }}</span>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('admissions.verify', $a['id']) }}" class="btn btn-sm btn-outline-primary d-inline-flex align-items-center gap-1 py-1 px-2">
                                <i data-feather="check-circle" style="width: 14px; height: 14px;"></i> Verifikasi
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        let table = document.querySelector('#tableAdmissions');
        if (table && typeof simpleDatatables !== 'undefined') {
            new simpleDatatables.DataTable(table, {
                searchable: true,
                fixedHeight: false,
                perPage: 10,
                perPageSelect: [5, 10, 20, 50],
                labels: {
                    placeholder: "Cari nomor registrasi, nama, sekolah...",
                    perPage: "{select} entri per halaman",
                    noRows: "Tidak ada data pendaftar ditemukan",
                    info: "Menampilkan {start} sampai {end} dari {rows} pendaftar"
                }
            });
            if (typeof feather !== 'undefined') {
                feather.replace();
            }
        }
    });
</script>
@endpush
