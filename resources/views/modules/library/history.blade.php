@extends('layouts.app')

@section('title', 'Riwayat Sirkulasi Perpustakaan')

@section('breadcrumb')
<nav aria-label="breadcrumb" class="breadcrumb-header">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.super-admin') }}">SIM Pesantren</a></li>
        <li class="breadcrumb-item"><a href="{{ route('dashboard.perpustakaan') }}">Perpustakaan</a></li>
        <li class="breadcrumb-item active" aria-current="page">Riwayat Sirkulasi</li>
    </ol>
</nav>
@endsection

@section('page-title')
Log Riwayat Peminjaman & Pengembalian Buku
@endsection

@section('page-subtitle')
Pantau seluruh transaksi sirkulasi buku santri, batas waktu peminjaman, dan riwayat denda.
@endsection

@section('page-actions')
<div class="d-flex align-items-center gap-2">
    <a href="{{ route('library.borrow') }}" class="btn btn-sm btn-outline-secondary d-flex align-items-center gap-1">
        <i data-feather="plus" style="width: 14px; height: 14px;"></i> Peminjaman Baru
    </a>
    <a href="{{ route('library.return') }}" class="btn btn-sm btn-primary d-flex align-items-center gap-1">
        <i data-feather="corner-down-left" style="width: 14px; height: 14px;"></i> Pengembalian
    </a>
</div>
@endsection

@section('content')
<section class="section">
    <!-- Voler Datatable Card -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title mb-0">Riwayat Transaksi Peminjaman</h4>
            <span class="badge bg-light-primary text-primary">{{ count($circulations) }} Transaksi</span>
        </div>
        <div class="card-body">
            <table class="table table-striped" id="tableHistory">
                <thead>
                    <tr>
                        <th>NO. TRANSAKSI</th>
                        <th>SANTRI PEMINJAM</th>
                        <th>KODE & JUDUL BUKU</th>
                        <th>TGL PINJAM</th>
                        <th>BATAS WAKTU</th>
                        <th>TGL KEMBALI</th>
                        <th>STATUS</th>
                        <th class="text-center">DENDA</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($circulations as $c)
                    <tr>
                        <td><span class="badge bg-light text-dark font-monospace fw-bold">{{ $c['id'] }}</span></td>
                        <td>
                            <div class="fw-bold text-dark">{{ $c['student_name'] }}</div>
                            <small class="text-muted">{{ $c['student_class'] }} • {{ $c['student_nis'] }}</small>
                        </td>
                        <td>
                            <span class="badge bg-light-primary text-primary font-monospace">{{ $c['copy_code'] }}</span>
                            <div class="text-dark fw-semibold">{{ $c['book_title'] }}</div>
                        </td>
                        <td>{{ $c['borrow_date'] }}</td>
                        <td>
                            <span class="{{ $c['status'] === 'Terlambat' ? 'text-danger fw-bold' : 'text-dark' }}">
                                {{ $c['due_date'] }}
                            </span>
                        </td>
                        <td>{{ $c['return_date'] ?? '-' }}</td>
                        <td>
                            @php
                                $statusBadge = match($c['status']) {
                                    'Selesai Dikembalikan' => 'bg-success',
                                    'Sedang Dipinjam' => 'bg-info',
                                    default => 'bg-danger'
                                };
                            @endphp
                            <span class="badge {{ $statusBadge }}">{{ $c['status'] }}</span>
                        </td>
                        <td class="text-center">
                            @if(isset($c['fine']) && $c['fine'] > 0)
                                <span class="badge bg-light-danger text-danger font-monospace fw-bold">Rp {{ number_format($c['fine'], 0, ',', '.') }}</span>
                            @else
                                <span class="text-muted">-</span>
                            @endif
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
        let table = document.querySelector('#tableHistory');
        if (table && typeof simpleDatatables !== 'undefined') {
            new simpleDatatables.DataTable(table, {
                searchable: true,
                fixedHeight: false,
                perPage: 10,
                perPageSelect: [10, 20, 50],
                labels: {
                    placeholder: "Cari santri, judul, transaksi...",
                    perPage: "{select} entri per halaman",
                    noRows: "Tidak ada riwayat ditemukan",
                    info: "Menampilkan {start} sampai {end} dari {rows} transaksi"
                }
            });
            if (typeof feather !== 'undefined') {
                feather.replace();
            }
        }
    });
</script>
@endpush
