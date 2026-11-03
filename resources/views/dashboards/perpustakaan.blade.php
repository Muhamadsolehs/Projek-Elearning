@extends('layouts.app')

@section('title', 'Dashboard Perpustakaan')

@section('breadcrumb')
<nav aria-label="breadcrumb" class="breadcrumb-header">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.super-admin') }}">SIM Pesantren</a></li>
        <li class="breadcrumb-item active" aria-current="page">Perpustakaan & QR Code</li>
    </ol>
</nav>
@endsection

@section('page-title')
Dashboard Sirkulasi & Pustaka Pesantren
@endsection

@section('page-subtitle')
Selamat datang, Ustadzah Fatimah Zahra, S.I.Pust. Modul sirkulasi modern dengan QR Scanner kamera & generator label cetak A4.
@endsection

@section('page-actions')
<div class="d-flex align-items-center gap-2">
    <a href="{{ route('library.qr-generator') }}" class="btn btn-sm btn-outline-secondary d-flex align-items-center gap-1">
        <i data-feather="printer" style="width: 14px; height: 14px;"></i> Cetak Label QR (A4)
    </a>
    <a href="{{ route('library.borrow') }}" class="btn btn-sm btn-primary d-flex align-items-center gap-1">
        <i data-feather="camera" style="width: 14px; height: 14px;"></i> Scan Kamera Peminjaman
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
                            <h3 class="card-title text-uppercase mb-0 text-muted" style="font-size: 0.85rem;">TOTAL JUDUL</h3>
                            <div class="card-right d-flex align-items-center">
                                <p class="fs-4 fw-bold mb-0 text-primary">250</p>
                            </div>
                        </div>
                        <div class="px-3 pb-3 text-xs text-muted">Katalog Kitab & Umum</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-3">
            <div class="card card-statistic">
                <div class="card-body p-0">
                    <div class="d-flex flex-column">
                        <div class="px-3 py-3 d-flex justify-content-between align-items-center">
                            <h3 class="card-title text-uppercase mb-0 text-muted" style="font-size: 0.85rem;">TOTAL EKSEMPLAR</h3>
                            <div class="card-right d-flex align-items-center">
                                <p class="fs-4 fw-bold mb-0 text-success">500</p>
                            </div>
                        </div>
                        <div class="px-3 pb-3 text-xs text-muted">100% Memiliki QR Code</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-3">
            <div class="card card-statistic">
                <div class="card-body p-0">
                    <div class="d-flex flex-column">
                        <div class="px-3 py-3 d-flex justify-content-between align-items-center">
                            <h3 class="card-title text-uppercase mb-0 text-muted" style="font-size: 0.85rem;">SEDANG DIPINJAM</h3>
                            <div class="card-right d-flex align-items-center">
                                <p class="fs-4 fw-bold mb-0 text-warning">42</p>
                            </div>
                        </div>
                        <div class="px-3 pb-3 text-xs text-muted">Masa Pinjam 7 Hari</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-3">
            <div class="card card-statistic">
                <div class="card-body p-0">
                    <div class="d-flex flex-column">
                        <div class="px-3 py-3 d-flex justify-content-between align-items-center">
                            <h3 class="card-title text-uppercase mb-0 text-muted" style="font-size: 0.85rem;">LEWAT JATUH TEMPO</h3>
                            <div class="card-right d-flex align-items-center">
                                <p class="fs-4 fw-bold mb-0 text-danger">3</p>
                            </div>
                        </div>
                        <div class="px-3 pb-3 text-xs text-muted">Perlu Notifikasi Pengembalian</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Peminjaman Terkini & Buku Terpopuler -->
    <div class="row mb-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Sirkulasi Peminjaman Buku Terkini</h4>
                    <div class="d-flex gap-2">
                        <a href="{{ route('library.borrow') }}" class="btn btn-sm btn-primary">Scan Pinjam</a>
                        <a href="{{ route('library.return') }}" class="btn btn-sm btn-outline-secondary">Scan Kembali</a>
                    </div>
                </div>
                <div class="card-body px-0 pb-0">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>KODE BUKU (BARCODE)</th>
                                    <th>JUDUL BUKU</th>
                                    <th>PEMINJAM</th>
                                    <th>BATAS KEMBALI</th>
                                    <th>STATUS</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(array_slice($circulations, 0, 5) as $c)
                                <tr>
                                    <td><span class="font-monospace fw-bold text-primary">{{ $c['barcode'] }}</span></td>
                                    <td><div class="fw-bold text-dark">{{ $c['title'] }}</div></td>
                                    <td>
                                        <div class="fw-semibold text-dark">{{ $c['student_name'] }}</div>
                                        <small class="text-muted">{{ $c['class'] }}</small>
                                    </td>
                                    <td class="text-muted text-xs">{{ $c['due_date'] }}</td>
                                    <td>
                                        <span class="badge {{ $c['status'] === 'Dipinjam' ? 'bg-info' : ($c['status'] === 'Terlambat' ? 'bg-danger' : 'bg-success') }}">
                                            {{ $c['status'] }}
                                        </span>
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
            <!-- Cetak Label QR Eksemplar Card -->
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Cetak Label QR Buku (A4)</h4>
                </div>
                <div class="card-body text-center">
                    <img src="{{ asset('assets/images/qr-sample.svg') }}" class="border p-2 rounded mb-3" style="width: 100px; height: 100px;" alt="Sample QR Code">
                    <p class="text-xs text-muted">Generate dan cetak lembar label barcode & QR Code eksemplar buku format standar kertas A4 (Grid 3x7 label).</p>
                    <a href="{{ route('library.qr-generator') }}" class="btn btn-primary btn-sm w-100">Buka Generator Cetak A4</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
