@extends('layouts.app')

@section('title', 'Jadwal & Penilaian Tes PSB')

@section('breadcrumb')
<nav aria-label="breadcrumb" class="breadcrumb-header">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.super-admin') }}">SIM Pesantren</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admissions.applicants') }}">PSB</a></li>
        <li class="breadcrumb-item active" aria-current="page">Jadwal & Nilai Tes</li>
    </ol>
</nav>
@endsection

@section('page-title')
Jadwal & Rekapitulasi Nilai Tes Seleksi Masuk
@endsection

@section('page-subtitle')
Input dan pantau hasil tes BTQ (Baca Tulis Qur'an), Bahasa Arab, Potensi Akademik, dan Wawancara calon santri.
@endsection

@section('content')
<section class="section">
    <!-- Voler Datatable Card -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title mb-0">Rekapitulasi Nilai Peserta Seleksi</h4>
            <span class="badge bg-light-primary text-primary">Gelombang 1</span>
        </div>
        <div class="card-body">
            <table class="table table-striped" id="tableTests">
                <thead>
                    <tr>
                        <th>NO. REGISTRASI</th>
                        <th>CALON SANTRI</th>
                        <th class="text-center">BTQ & TAHFIDZ</th>
                        <th class="text-center">B. ARAB</th>
                        <th class="text-center">AKADEMIK</th>
                        <th class="text-center">WAWANCARA</th>
                        <th class="text-center">RATA-RATA</th>
                        <th class="text-center">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($admissions as $adm)
                    <tr>
                        <td><span class="badge bg-light text-dark font-monospace fw-bold">{{ $adm['registration_number'] }}</span></td>
                        <td>
                            <div class="fw-bold text-dark">{{ $adm['name'] }}</div>
                            <small class="text-muted">{{ $adm['level_target'] }} • {{ $adm['origin_school'] }}</small>
                        </td>
                        <td class="text-center fw-bold text-success">{{ $adm['test_score']['quran'] ?? 85 }}</td>
                        <td class="text-center fw-bold">{{ $adm['test_score']['arabic'] ?? 78 }}</td>
                        <td class="text-center fw-bold">{{ $adm['test_score']['academic'] ?? 80 }}</td>
                        <td class="text-center fw-bold">{{ $adm['test_score']['interview'] ?? 88 }}</td>
                        <td class="text-center fw-bold text-primary">
                            {{ $adm['test_score']['average'] ?? 83 }}
                        </td>
                        <td class="text-center">
                            <a href="{{ route('admissions.verify', $adm['id']) }}" class="btn btn-sm btn-outline-primary py-1 px-2">
                                Detail Nilai
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
        let table = document.querySelector('#tableTests');
        if (table && typeof simpleDatatables !== 'undefined') {
            new simpleDatatables.DataTable(table, {
                searchable: true,
                fixedHeight: false,
                perPage: 10,
                perPageSelect: [10, 20, 50],
                labels: {
                    placeholder: "Cari nomor registrasi, nama calon santri...",
                    perPage: "{select} entri per halaman",
                    noRows: "Tidak ada data nilai tes ditemukan",
                    info: "Menampilkan {start} sampai {end} dari {rows} peserta"
                }
            });
            if (typeof feather !== 'undefined') {
                feather.replace();
            }
        }
    });
</script>
@endpush
