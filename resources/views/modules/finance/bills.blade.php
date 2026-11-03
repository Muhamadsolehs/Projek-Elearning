@extends('layouts.app')

@section('title', 'Tagihan & Pembayaran Santri')

@section('breadcrumb')
<nav aria-label="breadcrumb" class="breadcrumb-header">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.super-admin') }}">SIM Pesantren</a></li>
        <li class="breadcrumb-item"><a href="{{ route('dashboard.keuangan') }}">Keuangan</a></li>
        <li class="breadcrumb-item active" aria-current="page">Tagihan Santri</li>
    </ol>
</nav>
@endsection

@section('page-title')
Manajemen Tagihan & Iuran Santri
@endsection

@section('page-subtitle')
Kelola tagihan SPP, daftar ulang, uang makan, dan cetak kuitansi resmi pembayaran.
@endsection

@section('page-actions')
<div class="d-flex align-items-center gap-2">
    <a href="{{ route('finance.transactions') }}" class="btn btn-sm btn-outline-secondary d-flex align-items-center gap-1">
        <i data-feather="check-circle" style="width: 14px; height: 14px;"></i> Verifikasi Bayar
    </a>
    <a href="{{ route('finance.tariffs') }}" class="btn btn-sm btn-primary d-flex align-items-center gap-1">
        <i data-feather="dollar-sign" style="width: 14px; height: 14px;"></i> Atur Tarif Iuran
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
                    <small class="text-muted text-uppercase fw-bold" style="font-size: 11px;">TOTAL TAGIHAN</small>
                    <h4 class="fw-bold text-dark mb-0 mt-1">{{ count($bills) }} Tagihan</h4>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card card-statistic mb-0">
                <div class="card-body p-3">
                    <small class="text-success text-uppercase fw-bold" style="font-size: 11px;">LUNAS TERVERIFIKASI</small>
                    <h4 class="fw-bold text-success mb-0 mt-1">{{ count(array_filter($bills, fn($b) => $b['status'] === 'Lunas')) }}</h4>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card card-statistic mb-0">
                <div class="card-body p-3">
                    <small class="text-warning text-uppercase fw-bold" style="font-size: 11px;">MENUNGGU CEK BANK</small>
                    <h4 class="fw-bold text-warning mb-0 mt-1">{{ count(array_filter($bills, fn($b) => $b['status'] === 'Menunggu Verifikasi')) }}</h4>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card card-statistic mb-0">
                <div class="card-body p-3">
                    <small class="text-danger text-uppercase fw-bold" style="font-size: 11px;">BELUM LUNAS / TUNGGAKAN</small>
                    <h4 class="fw-bold text-danger mb-0 mt-1">{{ count(array_filter($bills, fn($b) => in_array($b['status'], ['Belum Dibayar', 'Terlambat']))) }}</h4>
                </div>
            </div>
        </div>
    </div>

    <!-- Voler Datatable Card -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title mb-0">Daftar Tagihan Santri</h4>
            <span class="badge bg-light-primary text-primary">{{ count($bills) }} Data Tagihan</span>
        </div>
        <div class="card-body">
            <table class="table table-striped" id="tableBills">
                <thead>
                    <tr>
                        <th>NO. INVOICE</th>
                        <th>NAMA SANTRI & KELAS</th>
                        <th>POS TAGIHAN</th>
                        <th>NOMINAL</th>
                        <th>JATUH TEMPO</th>
                        <th>STATUS</th>
                        <th class="text-center">AKSI / KUITANSI</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bills as $b)
                    <tr>
                        <td><span class="badge bg-light text-dark font-monospace fw-bold">{{ $b['id'] }}</span></td>
                        <td>
                            <div class="fw-bold text-dark">{{ $b['student_name'] }}</div>
                            <small class="text-muted">NIS: {{ $b['student_nis'] }} • {{ $b['student_class'] }}</small>
                        </td>
                        <td>
                            <div class="fw-semibold text-dark">{{ $b['title'] }}</div>
                            <small class="text-muted">{{ $b['payment_method'] ?? 'Reguler Santri' }}</small>
                        </td>
                        <td>
                            <span class="fw-bold text-primary">{{ $b['formatted_amount'] }}</span>
                        </td>
                        <td>{{ $b['due_date'] }}</td>
                        <td>
                            @php
                                $statusBadge = match($b['status']) {
                                    'Lunas' => 'bg-success',
                                    'Menunggu Verifikasi' => 'bg-warning',
                                    'Terlambat' => 'bg-danger',
                                    default => 'bg-secondary'
                                };
                            @endphp
                            <span class="badge {{ $statusBadge }}">{{ $b['status'] }}</span>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('finance.invoices.print', $b['id']) }}" target="_blank" class="btn btn-sm btn-outline-success d-inline-flex align-items-center gap-1 py-1 px-2">
                                <i data-feather="printer" style="width: 14px; height: 14px;"></i> Kuitansi
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
        let table = document.querySelector('#tableBills');
        if (table && typeof simpleDatatables !== 'undefined') {
            new simpleDatatables.DataTable(table, {
                searchable: true,
                fixedHeight: false,
                perPage: 10,
                perPageSelect: [5, 10, 20, 50],
                labels: {
                    placeholder: "Cari invoice, nama santri, NIS...",
                    perPage: "{select} entri per halaman",
                    noRows: "Tidak ada data tagihan ditemukan",
                    info: "Menampilkan {start} sampai {end} dari {rows} tagihan"
                }
            });
            if (typeof feather !== 'undefined') {
                feather.replace();
            }
        }
    });
</script>
@endpush
