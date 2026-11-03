@extends('layouts.app')

@section('title', 'Perizinan Santri Asrama')

@section('breadcrumb')
<nav aria-label="breadcrumb" class="breadcrumb-header">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.super-admin') }}">SIM Pesantren</a></li>
        <li class="breadcrumb-item"><a href="{{ route('dashboard.keasramaan') }}">Keasramaan</a></li>
        <li class="breadcrumb-item active" aria-current="page">Perizinan Keluar</li>
    </ol>
</nav>
@endsection

@section('page-title')
Manajemen Perizinan Keluar & Pulang Santri
@endsection

@section('page-subtitle')
Pantau pengajuan izin, persetujuan pengasuh, dan verifikasi kepulangan santri ke asrama.
@endsection

@section('page-actions')
<div class="d-flex align-items-center gap-2">
    <a href="{{ route('dormitory.gate-check') }}" class="btn btn-sm btn-outline-primary d-flex align-items-center gap-1">
        <i data-feather="camera" style="width: 14px; height: 14px;"></i> Pos Satpam (Gate Check QR)
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
                    <small class="text-muted text-uppercase fw-bold" style="font-size: 11px;">TOTAL IZIN</small>
                    <h4 class="fw-bold text-dark mb-0 mt-1">{{ count($permissions) }} Pengajuan</h4>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card card-statistic mb-0">
                <div class="card-body p-3">
                    <small class="text-warning text-uppercase fw-bold" style="font-size: 11px;">MENUNGGU PERSETUJUAN</small>
                    <h4 class="fw-bold text-warning mb-0 mt-1">{{ count(array_filter($permissions, fn($p) => $p['status'] === 'Menunggu Persetujuan')) }}</h4>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card card-statistic mb-0">
                <div class="card-body p-3">
                    <small class="text-info text-uppercase fw-bold" style="font-size: 11px;">DISETUJUI / DI LUAR</small>
                    <h4 class="fw-bold text-info mb-0 mt-1">{{ count(array_filter($permissions, fn($p) => $p['status'] === 'Disetujui')) }}</h4>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card card-statistic mb-0">
                <div class="card-body p-3">
                    <small class="text-success text-uppercase fw-bold" style="font-size: 11px;">SUDAH KEMBALI</small>
                    <h4 class="fw-bold text-success mb-0 mt-1">{{ count(array_filter($permissions, fn($p) => $p['status'] === 'Selesai Kembali')) }}</h4>
                </div>
            </div>
        </div>
    </div>

    <!-- Voler Datatable Card -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title mb-0">Daftar Surat Perizinan Santri</h4>
            <span class="badge bg-light-primary text-primary">{{ count($permissions) }} Data Izin</span>
        </div>
        <div class="card-body">
            <table class="table table-striped" id="tablePermissions">
                <thead>
                    <tr>
                        <th>NO. IZIN</th>
                        <th>NAMA SANTRI & ASRAMA</th>
                        <th>JENIS IZIN</th>
                        <th>ALASAN & JADWAL KEMBALI</th>
                        <th>PENGASUH PENYETUJU</th>
                        <th>STATUS</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($permissions as $p)
                    <tr>
                        <td><span class="badge bg-light text-dark font-monospace fw-bold">{{ $p['id'] }}</span></td>
                        <td>
                            <div class="fw-bold text-dark">{{ $p['student_name'] }}</div>
                            <small class="text-muted">{{ $p['dorm'] }}</small>
                        </td>
                        <td>
                            <span class="badge bg-light-info text-info">{{ $p['type'] }}</span>
                        </td>
                        <td>
                            <div class="text-dark">{{ $p['reason'] }}</div>
                            <small class="text-muted">Kembali: {{ $p['return_plan'] }}</small>
                        </td>
                        <td>{{ $p['approver'] ?? '-' }}</td>
                        <td>
                            @php
                                $statusBadge = match($p['status']) {
                                    'Disetujui' => 'bg-info',
                                    'Selesai Kembali' => 'bg-success',
                                    'Menunggu Persetujuan' => 'bg-warning',
                                    'Ditolak' => 'bg-danger',
                                    default => 'bg-secondary'
                                };
                            @endphp
                            <span class="badge {{ $statusBadge }}">{{ $p['status'] }}</span>
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
        let table = document.querySelector('#tablePermissions');
        if (table && typeof simpleDatatables !== 'undefined') {
            new simpleDatatables.DataTable(table, {
                searchable: true,
                fixedHeight: false,
                perPage: 10,
                perPageSelect: [5, 10, 20, 50],
                labels: {
                    placeholder: "Cari izin, nama santri, asrama...",
                    perPage: "{select} entri per halaman",
                    noRows: "Tidak ada data perizinan ditemukan",
                    info: "Menampilkan {start} sampai {end} dari {rows} perizinan"
                }
            });
            if (typeof feather !== 'undefined') {
                feather.replace();
            }
        }
    });
</script>
@endpush
