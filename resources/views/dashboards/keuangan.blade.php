@extends('layouts.app')

@section('title', 'Dashboard Keuangan & SPP')

@section('breadcrumb')
<nav aria-label="breadcrumb" class="breadcrumb-header">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.super-admin') }}">SIM Pesantren</a></li>
        <li class="breadcrumb-item active" aria-current="page">Keuangan & Pembayaran</li>
    </ol>
</nav>
@endsection

@section('page-title')
Dashboard Administrasi Keuangan & SPP
@endsection

@section('page-subtitle')
Selamat datang, Ibu Hj. Wahyuni Rahayu, S.E., M.Ak. Kelola pos penerimaan kas santri, verifikasi pembayaran bank, dan cetak kuitansi resmi.
@endsection

@section('page-actions')
<div class="d-flex align-items-center gap-2">
    <a href="{{ route('finance.transactions') }}" class="btn btn-sm btn-success d-flex align-items-center gap-1">
        <i data-feather="plus-circle" style="width: 14px; height: 14px;"></i> Input Pembayaran (Kasir)
    </a>
    <a href="{{ route('finance.bills') }}" class="btn btn-sm btn-outline-secondary d-flex align-items-center gap-1">
        <i data-feather="file-text" style="width: 14px; height: 14px;"></i> Tagihan Santri
    </a>
</div>
@endsection

@section('content')
<section class="section">
    <!-- Voler 4 Stat Cards -->
    <div class="row mb-2">
        <div class="col-12 col-md-3">
            <div class="card card-statistic">
                <div class="card-body p-0">
                    <div class="d-flex flex-column">
                        <div class="px-3 py-3 d-flex justify-content-between align-items-center">
                            <h3 class="card-title text-uppercase mb-0 text-muted" style="font-size: 0.85rem;">PEMASUKAN BULAN INI</h3>
                            <div class="card-right d-flex align-items-center">
                                <p class="fs-4 fw-bold mb-0 text-success">Rp 84,5jt</p>
                            </div>
                        </div>
                        <div class="px-3 pb-3 text-xs text-muted">124 Transaksi Terverifikasi</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-3">
            <div class="card card-statistic">
                <div class="card-body p-0">
                    <div class="d-flex flex-column">
                        <div class="px-3 py-3 d-flex justify-content-between align-items-center">
                            <h3 class="card-title text-uppercase mb-0 text-muted" style="font-size: 0.85rem;">TUNGGAKAN SPP</h3>
                            <div class="card-right d-flex align-items-center">
                                <p class="fs-4 fw-bold mb-0 text-danger">Rp 12,8jt</p>
                            </div>
                        </div>
                        <div class="px-3 pb-3 text-xs text-muted">18 Santri Belum Lunas</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-3">
            <div class="card card-statistic">
                <div class="card-body p-0">
                    <div class="d-flex flex-column">
                        <div class="px-3 py-3 d-flex justify-content-between align-items-center">
                            <h3 class="card-title text-uppercase mb-0 text-muted" style="font-size: 0.85rem;">VERIFIKASI PENDING</h3>
                            <div class="card-right d-flex align-items-center">
                                <p class="fs-4 fw-bold mb-0 text-warning">5</p>
                            </div>
                        </div>
                        <div class="px-3 pb-3 text-xs text-muted">Bukti Transfer Masuk</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-3">
            <div class="card card-statistic">
                <div class="card-body p-0">
                    <div class="d-flex flex-column">
                        <div class="px-3 py-3 d-flex justify-content-between align-items-center">
                            <h3 class="card-title text-uppercase mb-0 text-muted" style="font-size: 0.85rem;">TAGIHAN AKTIF</h3>
                            <div class="card-right d-flex align-items-center">
                                <p class="fs-4 fw-bold mb-0 text-primary">148</p>
                            </div>
                        </div>
                        <div class="px-3 pb-3 text-xs text-muted">SPP Periode Februari 2026</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Transaksi & Pos Tarif Cards -->
    <div class="row mb-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Transaksi Pembayaran Terbaru</h4>
                    <a href="{{ route('finance.transactions') }}" class="btn btn-sm btn-outline-primary">Semua Transaksi</a>
                </div>
                <div class="card-body px-0 pb-0">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>NO KUITANSI</th>
                                    <th>NAMA SANTRI</th>
                                    <th>JENIS BIAYA</th>
                                    <th>NOMINAL</th>
                                    <th>STATUS</th>
                                    <th class="text-center">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(array_slice($transactions, 0, 5) as $trx)
                                <tr>
                                    <td><span class="font-monospace fw-bold text-primary">{{ $trx['invoice_no'] }}</span></td>
                                    <td>
                                        <div class="fw-bold text-dark">{{ $trx['student_name'] }}</div>
                                        <small class="text-muted">{{ $trx['class'] }}</small>
                                    </td>
                                    <td><span class="badge bg-light text-dark">{{ $trx['type'] }}</span></td>
                                    <td class="fw-bold text-dark">Rp {{ number_format($trx['amount'], 0, ',', '.') }}</td>
                                    <td>
                                        <span class="badge {{ $trx['status'] === 'Lunas' ? 'bg-success' : 'bg-warning' }}">
                                            {{ $trx['status'] }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('finance.invoices.print', $trx['invoice_no']) }}" target="_blank" class="btn btn-sm btn-light-primary py-1 px-2 text-xs">
                                            <i data-feather="printer" style="width: 12px; height: 12px;"></i> Kuitansi
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <!-- Komposisi Pemasukan Card -->
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Komponen Tarif Biaya</h4>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush text-xs">
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-2">
                            <span>SPP Bulanan SMP</span>
                            <span class="fw-bold">Rp 750.000 / bln</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-2">
                            <span>SPP Bulanan SMA</span>
                            <span class="fw-bold">Rp 850.000 / bln</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-2">
                            <span>Uang Pangkal PSB SMP</span>
                            <span class="fw-bold">Rp 6.500.000 (1x)</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-2">
                            <span>Uang Pangkal PSB SMA</span>
                            <span class="fw-bold">Rp 7.500.000 (1x)</span>
                        </li>
                    </ul>
                    <a href="{{ route('finance.tariffs') }}" class="btn btn-sm btn-outline-primary w-100 mt-3">Kelola Master Tarif</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
