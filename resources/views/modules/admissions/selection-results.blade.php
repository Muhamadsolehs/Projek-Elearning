@extends('layouts.app')

@section('title', 'Penetapan Kelulusan & Aktivasi Santri')

@section('breadcrumb')
<nav aria-label="breadcrumb" class="breadcrumb-header">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.super-admin') }}">SIM Pesantren</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admissions.applicants') }}">PSB</a></li>
        <li class="breadcrumb-item active" aria-current="page">Penetapan Hasil & Aktivasi</li>
    </ol>
</nav>
@endsection

@section('page-title')
Penetapan Kelulusan & Konversi Santri Aktif
@endsection

@section('page-subtitle')
Calon santri yang dinyatakan lulus dapat dikonversi menjadi santri resmi dengan penerbitan NIS, akun pengguna, dan KTS digital.
@endsection

@section('page-actions')
<div class="d-flex align-items-center gap-2">
    <button type="button" onclick="alert('Seluruh calon santri yang lulus berhasil diaktivasi secara massal menjadi santri aktif!')" class="btn btn-sm btn-success d-flex align-items-center gap-1">
        <i data-feather="check-circle" style="width: 14px; height: 14px;"></i> Aktivasi Semua yang Lulus
    </button>
</div>
@endsection

@section('content')
<section class="section">
    <!-- Voler Datatable Card -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title mb-0">Daftar Hasil Seleksi Masuk</h4>
            <span class="badge bg-light-primary text-primary">{{ count($admissions) }} Calon Santri</span>
        </div>
        <div class="card-body">
            <table class="table table-striped" id="tableResults">
                <thead>
                    <tr>
                        <th>NO. REGISTRASI</th>
                        <th>NAMA CALON SANTRI</th>
                        <th>JENJANG TARGET</th>
                        <th class="text-center">NILAI RATA-RATA</th>
                        <th class="text-center">KEPUTUSAN</th>
                        <th class="text-center">AKSI ADMINISTRASI</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($admissions as $adm)
                    <tr>
                        <td><span class="badge bg-light text-dark font-monospace fw-bold">{{ $adm['registration_number'] }}</span></td>
                        <td>
                            <div class="fw-bold text-dark">{{ $adm['name'] }}</div>
                            <small class="text-muted">{{ $adm['origin_school'] }}</small>
                        </td>
                        <td>
                            <span class="badge {{ $adm['level_target'] === 'SMA' ? 'bg-primary' : 'bg-info' }}">
                                {{ $adm['level_target'] }}
                            </span>
                        </td>
                        <td class="text-center fw-bold text-primary">
                            {{ $adm['test_score']['average'] ?? 82 }}
                        </td>
                        <td class="text-center">
                            @if(in_array($adm['status'], ['Lulus', 'Diterima']))
                                <span class="badge bg-success">LULUS SELEKSI</span>
                            @elseif($adm['status'] === 'Tidak Lulus')
                                <span class="badge bg-danger">TIDAK LULUS</span>
                            @else
                                <span class="badge bg-warning">PROSES SELEKSI</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="{{ route('admissions.verify', $adm['id']) }}" class="btn btn-sm btn-outline-primary py-1 px-2">
                                Verifikasi & Aktivasi
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
        let table = document.querySelector('#tableResults');
        if (table && typeof simpleDatatables !== 'undefined') {
            new simpleDatatables.DataTable(table, {
                searchable: true,
                fixedHeight: false,
                perPage: 10,
                perPageSelect: [10, 20, 50],
                labels: {
                    placeholder: "Cari calon santri...",
                    perPage: "{select} entri per halaman",
                    noRows: "Tidak ada data hasil seleksi ditemukan",
                    info: "Menampilkan {start} sampai {end} dari {rows} data"
                }
            });
            if (typeof feather !== 'undefined') {
                feather.replace();
            }
        }
    });
</script>
@endpush
