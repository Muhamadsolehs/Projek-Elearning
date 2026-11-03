@extends('layouts.app')

@section('title', 'Audit Log Aktivitas Sistem')

@section('breadcrumb')
<nav aria-label="breadcrumb" class="breadcrumb-header">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.super-admin') }}">SIM Pesantren</a></li>
        <li class="breadcrumb-item"><a href="{{ route('dashboard.super-admin') }}">Pengaturan</a></li>
        <li class="breadcrumb-item active" aria-current="page">Audit Log</li>
    </ol>
</nav>
@endsection

@section('page-title')
Audit Log & Jejak Rekam Sistem
@endsection

@section('page-subtitle')
Rekam jejak setiap aksi krusial pengguna pada modul santri, nilai, keuangan, perpustakaan, dan perizinan.
@endsection

@section('content')
<section class="section">
    <!-- Voler Datatable Card -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title mb-0">Catatan Aktivitas Pengguna</h4>
            <span class="badge bg-light-primary text-primary">{{ count($audit_logs) }} Log Tercatat</span>
        </div>
        <div class="card-body">
            <table class="table table-striped" id="tableLogs">
                <thead>
                    <tr>
                        <th>WAKTU</th>
                        <th>PENGGUNA</th>
                        <th>PERAN (ROLE)</th>
                        <th>MODUL</th>
                        <th>AKTIVITAS / OPERASI</th>
                        <th>ALAMAT IP</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($audit_logs as $log)
                    <tr>
                        <td class="text-muted"><small>{{ $log['time'] }}</small></td>
                        <td>
                            <div class="fw-bold text-dark">{{ $log['user'] }}</div>
                        </td>
                        <td>
                            <span class="badge bg-light text-dark">{{ $log['role'] }}</span>
                        </td>
                        <td>
                            <span class="badge bg-light-info text-info">{{ $log['module'] }}</span>
                        </td>
                        <td class="text-dark">{{ $log['action'] }}</td>
                        <td><small class="font-monospace text-muted">{{ $log['ip'] }}</small></td>
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
        let table = document.querySelector('#tableLogs');
        if (table && typeof simpleDatatables !== 'undefined') {
            new simpleDatatables.DataTable(table, {
                searchable: true,
                fixedHeight: false,
                perPage: 10,
                perPageSelect: [10, 20, 50],
                labels: {
                    placeholder: "Cari pengguna, modul, aksi...",
                    perPage: "{select} entri per halaman",
                    noRows: "Tidak ada log aktivitas ditemukan",
                    info: "Menampilkan {start} sampai {end} dari {rows} log"
                }
            });
            if (typeof feather !== 'undefined') {
                feather.replace();
            }
        }
    });
</script>
@endpush
