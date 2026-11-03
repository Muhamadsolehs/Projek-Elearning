@extends('layouts.app')

@section('title', 'Katalog Koleksi Buku')

@section('breadcrumb')
<nav aria-label="breadcrumb" class="breadcrumb-header">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.super-admin') }}">SIM Pesantren</a></li>
        <li class="breadcrumb-item"><a href="{{ route('dashboard.perpustakaan') }}">Perpustakaan</a></li>
        <li class="breadcrumb-item active" aria-current="page">Katalog Buku</li>
    </ol>
</nav>
@endsection

@section('page-title')
Katalog Koleksi Buku & Kitab Kuning
@endsection

@section('page-subtitle')
Kelola perbendaharaan buku perpustakaan, fan keilmuan, dan ketersediaan stok eksemplar.
@endsection

@section('page-actions')
<div class="d-flex align-items-center gap-2">
    <a href="{{ route('library.copies') }}" class="btn btn-sm btn-outline-secondary d-flex align-items-center gap-1">
        <i data-feather="layers" style="width: 14px; height: 14px;"></i> Data Eksemplar
    </a>
    <a href="{{ route('library.qr-generator') }}" class="btn btn-sm btn-primary d-flex align-items-center gap-1">
        <i data-feather="printer" style="width: 14px; height: 14px;"></i> Cetak Label QR (A4)
    </a>
</div>
@endsection

@section('content')
<section class="section">
    <!-- Voler Datatable Card -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title mb-0">Daftar Buku & Kitab</h4>
            <span class="badge bg-light-primary text-primary">{{ count($books) }} Judul Buku</span>
        </div>
        <div class="card-body">
            <table class="table table-striped" id="tableBooks">
                <thead>
                    <tr>
                        <th>KODE & JUDUL BUKU</th>
                        <th>KATEGORI / FAN</th>
                        <th>PENGARANG (AUTHOR)</th>
                        <th>PENERBIT & TAHUN</th>
                        <th>ISBN</th>
                        <th class="text-center">KETERSEDIAAN</th>
                        <th class="text-center">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($books as $b)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <div class="p-2 bg-light-primary text-primary rounded d-flex align-items-center justify-content-center" style="width: 34px; height: 34px;">
                                    <i data-feather="book" style="width: 16px; height: 16px;"></i>
                                </div>
                                <div>
                                    <div class="fw-bold text-dark">{{ $b['title'] }}</div>
                                    <small class="text-muted font-monospace">{{ $b['id'] }}</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="badge bg-light-info text-info">{{ $b['category'] }}</span>
                        </td>
                        <td class="text-dark fw-semibold">{{ $b['author'] }}</td>
                        <td class="text-muted">{{ $b['publisher'] }} ({{ $b['year'] }})</td>
                        <td><small class="font-monospace text-muted">{{ $b['isbn'] }}</small></td>
                        <td class="text-center">
                            <span class="fw-bold text-success">{{ $b['available_copies'] }}</span>
                            <span class="text-muted">/ {{ $b['total_copies'] }}</span>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('library.qr-generator') }}?book={{ $b['id'] }}" class="btn btn-sm btn-outline-primary d-inline-flex align-items-center gap-1 py-1 px-2">
                                <i data-feather="maximize" style="width: 14px; height: 14px;"></i> Label QR
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
        let table = document.querySelector('#tableBooks');
        if (table && typeof simpleDatatables !== 'undefined') {
            new simpleDatatables.DataTable(table, {
                searchable: true,
                fixedHeight: false,
                perPage: 10,
                perPageSelect: [5, 10, 20, 50],
                labels: {
                    placeholder: "Cari judul buku, pengarang, penerbit...",
                    perPage: "{select} entri per halaman",
                    noRows: "Tidak ada data buku ditemukan",
                    info: "Menampilkan {start} sampai {end} dari {rows} buku"
                }
            });
            if (typeof feather !== 'undefined') {
                feather.replace();
            }
        }
    });
</script>
@endpush
