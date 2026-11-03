@extends('layouts.app')

@section('title', 'Laporan Keuangan & Arus Kas')

@section('page-title')
Laporan Arus Kas & Rekapitulasi SPP
@endsection

@section('page-subtitle')
Ringkasan penerimaan kas pesantren, realisasi target pendapatan, dan rekap mutasi pembayaran santri.
@endsection

@section('page-actions')
<button type="button" 
        onclick="window.print()" 
        class="btn btn-outline-success d-inline-flex align-items-center gap-2">
    <i data-feather="printer" style="width: 16px; height: 16px;"></i>
    <span>Cetak Laporan / PDF</span>
</button>
@endsection

@section('content')
<section class="section">
    <!-- STATISTIK KAS -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h6 class="text-muted text-uppercase mb-2 font-semibold" style="font-size: 0.75rem; letter-spacing: 0.5px;">Total Penerimaan Kas</h6>
                    <h3 class="fw-bold text-success mb-1">Rp 184.500.000</h3>
                    <small class="text-muted">Semester Ganjil T.A 2026/2027</small>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h6 class="text-muted text-uppercase mb-2 font-semibold" style="font-size: 0.75rem; letter-spacing: 0.5px;">Penerimaan Tunai Loket</h6>
                    <h3 class="fw-bold text-primary mb-1">Rp 48.250.000</h3>
                    <small class="text-muted">Kasir Loket Bendahara Langsung</small>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h6 class="text-muted text-uppercase mb-2 font-semibold" style="font-size: 0.75rem; letter-spacing: 0.5px;">Penerimaan Transfer Bank</h6>
                    <h3 class="fw-bold text-info mb-1">Rp 136.250.000</h3>
                    <small class="text-muted">Bank Syariah Indonesia (BSI) & Muamalat</small>
                </div>
            </div>
        </div>
    </div>

    <!-- TABEL REKAPITULASI BUKU KAS -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>
                <h4 class="card-title mb-0">Buku Kas & Jurnal Mutasi Penerimaan</h4>
                <p class="text-muted text-sm mb-0">Rekapitulasi seluruh riwayat transaksi pembayaran dan tagihan santri.</p>
            </div>
            <span class="badge bg-light-primary text-primary">{{ count($bills) }} Transaksi</span>
        </div>
        <div class="card-body">
            <table class="table table-striped" id="tableReports">
                <thead>
                    <tr>
                        <th>NO. TRANSAKSI</th>
                        <th>NAMA SANTRI & KELAS</th>
                        <th>POS PEMBAYARAN</th>
                        <th>METODE BAYAR</th>
                        <th>TANGGAL BAYAR</th>
                        <th>NOMINAL</th>
                        <th>STATUS</th>
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
                        <td>{{ $b['title'] }}</td>
                        <td>
                            <span class="text-dark">{{ $b['payment_method'] ?? 'Menunggu Pembayaran' }}</span>
                        </td>
                        <td>
                            {{ $b['paid_date'] ?? 'Belum Lunas' }}
                        </td>
                        <td>
                            <span class="fw-bold text-success">{{ $b['formatted_amount'] }}</span>
                        </td>
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
        let table = document.querySelector('#tableReports');
        if (table && typeof simpleDatatables !== 'undefined') {
            new simpleDatatables.DataTable(table, {
                searchable: true,
                fixedHeight: false,
                perPage: 10,
                perPageSelect: [5, 10, 20, 50],
                labels: {
                    placeholder: "Cari transaksi, santri, metode bayar...",
                    perPage: "{select} entri per halaman",
                    noRows: "Tidak ada riwayat kas ditemukan",
                    info: "Menampilkan {start} sampai {end} dari {rows} data kas"
                }
            });
        }
    });
</script>
@endpush
