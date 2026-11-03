@extends('layouts.app')

@section('title', 'Data Eksemplar Buku')

@section('breadcrumb')
<nav aria-label="breadcrumb" class="breadcrumb-header">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.super-admin') }}">SIM Pesantren</a></li>
        <li class="breadcrumb-item"><a href="{{ route('dashboard.perpustakaan') }}">Perpustakaan</a></li>
        <li class="breadcrumb-item active" aria-current="page">Eksemplar Buku</li>
    </ol>
</nav>
@endsection

@section('page-title')
Inventaris Eksemplar & Barcode Buku
@endsection

@section('page-subtitle')
Kelola kode unik eksemplar fisik buku, nomor panggil, kondisi buku, dan status peminjaman.
@endsection

@section('page-actions')
<div class="d-flex align-items-center gap-2">
    <a href="{{ route('library.books') }}" class="btn btn-sm btn-outline-secondary d-flex align-items-center gap-1">
        <i data-feather="book" style="width: 14px; height: 14px;"></i> Katalog Judul
    </a>
    <a href="{{ route('library.qr-generator') }}" class="btn btn-sm btn-primary d-flex align-items-center gap-1">
        <i data-feather="printer" style="width: 14px; height: 14px;"></i> Cetak Lembar Label QR
    </a>
</div>
@endsection

@section('content')
<section class="section">
    <!-- Voler Datatable Card -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title mb-0">Daftar Seluruh Eksemplar</h4>
            <span class="badge bg-light-primary text-primary">{{ count($copies) }} Eksemplar</span>
        </div>
        <div class="card-body">
            <table class="table table-striped" id="tableCopies">
                <thead>
                    <tr>
                        <th>KODE INVENTARIS</th>
                        <th>JUDUL BUKU</th>
                        <th>NOMOR PANGGIL</th>
                        <th>KONDISI</th>
                        <th>STATUS</th>
                        <th>PEMINJAM SAAT INI</th>
                        <th class="text-center">LABEL</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($copies as $c)
                    <tr>
                        <td>
                            <span class="badge bg-light text-dark font-monospace fw-bold">{{ $c['inventory_code'] }}</span>
                        </td>
                        <td>
                            <div class="fw-bold text-dark">{{ $c['book_title'] }}</div>
                            <small class="text-muted">{{ $c['category'] }}</small>
                        </td>
                        <td><small class="font-monospace text-muted">{{ $c['call_number'] }}</small></td>
                        <td>
                            <span class="badge {{ $c['condition'] === 'Baik' ? 'bg-light-success text-success' : 'bg-light-warning text-warning' }}">
                                {{ $c['condition'] }}
                            </span>
                        </td>
                        <td>
                            @php
                                $statusBadge = match($c['status']) {
                                    'Tersedia' => 'bg-success',
                                    'Dipinjam' => 'bg-info',
                                    default => 'bg-danger'
                                };
                            @endphp
                            <span class="badge {{ $statusBadge }}">{{ $c['status'] }}</span>
                        </td>
                        <td>
                            @if(isset($c['borrower']) && $c['borrower'])
                                <div class="fw-semibold text-dark">{{ $c['borrower']['student_name'] }}</div>
                                <small class="text-muted">Batas: {{ $c['borrower']['due_date'] }}</small>
                            @else
                                <span class="text-muted fst-italic">-</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="{{ route('library.qr-generator') }}?code={{ $c['inventory_code'] }}" class="btn btn-sm btn-outline-primary d-inline-flex align-items-center gap-1 py-1 px-2">
                                <i data-feather="maximize" style="width: 14px; height: 14px;"></i> QR
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
        let table = document.querySelector('#tableCopies');
        if (table && typeof simpleDatatables !== 'undefined') {
            new simpleDatatables.DataTable(table, {
                searchable: true,
                fixedHeight: false,
                perPage: 10,
                perPageSelect: [10, 20, 50, 100],
                labels: {
                    placeholder: "Cari inventaris, judul, call number...",
                    perPage: "{select} entri per halaman",
                    noRows: "Tidak ada data eksemplar ditemukan",
                    info: "Menampilkan {start} sampai {end} dari {rows} eksemplar"
                }
            });
            if (typeof feather !== 'undefined') {
                feather.replace();
            }
        }
    });
</script>
@endpush
