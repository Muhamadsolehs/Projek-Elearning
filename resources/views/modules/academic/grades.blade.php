@extends('layouts.app')

@section('title', 'Rekap Nilai Siswa')

@section('breadcrumb')
<nav aria-label="breadcrumb" class="breadcrumb-header">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.super-admin') }}">SIM Pesantren</a></li>
        <li class="breadcrumb-item"><a href="{{ route('dashboard.akademik') }}">Akademik</a></li>
        <li class="breadcrumb-item active" aria-current="page">Rekap Nilai Siswa</li>
    </ol>
</nav>
@endsection

@section('page-title')
Leger & Rekap Nilai Akademik
@endsection

@section('page-subtitle')
Kelola nilai formatif harian, tugas, PTS, dan PAS santri per rombel dan mata pelajaran.
@endsection

@section('page-actions')
<div class="d-flex align-items-center gap-2">
    <button type="button" onclick="alert('Data nilai berhasil disimpan ke rapor!')" class="btn btn-sm btn-primary d-flex align-items-center gap-1">
        <i data-feather="save" style="width: 14px; height: 14px;"></i> Simpan Nilai
    </button>
</div>
@endsection

@section('content')
<section class="section">
    <!-- Filter Card -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="row g-3 align-items-center">
                <div class="col-12 col-md-6">
                    <label class="form-label text-xs fw-bold text-muted text-uppercase mb-1">Rombel Kelas</label>
                    <select class="form-select form-select-sm" id="selectClassGrades" onchange="filterClass(this.value)">
                        <option value="">Semua Kelas</option>
                        @foreach($classes as $c)
                            <option value="{{ $c['name'] }}">{{ $c['name'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12 col-md-6">
                    <label class="form-label text-xs fw-bold text-muted text-uppercase mb-1">Mata Pelajaran (KKM)</label>
                    <select class="form-select form-select-sm">
                        <option value="Fiqih">Fiqih & Ushul Fiqih (KKM: 75)</option>
                        <option value="Arab">Bahasa Arab & Nahwu (KKM: 75)</option>
                        <option value="Matematika">Matematika Umum (KKM: 70)</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <!-- Voler Datatable Card -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title mb-0">Leger Nilai Santri</h4>
            <span class="badge bg-light-primary text-primary">{{ count($students) }} Santri</span>
        </div>
        <div class="card-body">
            <table class="table table-striped" id="tableGrades">
                <thead>
                    <tr>
                        <th>NAMA SANTRI</th>
                        <th>NIS & KELAS</th>
                        <th class="text-center">TUGAS (20%)</th>
                        <th class="text-center">UH (20%)</th>
                        <th class="text-center">PTS (30%)</th>
                        <th class="text-center">PAS (30%)</th>
                        <th class="text-center">NILAI AKHIR</th>
                        <th class="text-center">PREDIKAT</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($students as $index => $st)
                    @php
                        $tugas = 80 + ($index % 15);
                        $uh = 78 + ($index % 18);
                        $pts = 82 + ($index % 14);
                        $pas = 85 + ($index % 12);
                        $na = round(($tugas * 0.2) + ($uh * 0.2) + ($pts * 0.3) + ($pas * 0.3), 1);
                        $predikat = $na >= 85 ? 'A (Sangat Baik)' : ($na >= 75 ? 'B (Baik)' : 'C (Cukup)');
                        $badgeClass = $na >= 85 ? 'bg-success' : ($na >= 75 ? 'bg-info' : 'bg-warning');
                    @endphp
                    <tr>
                        <td>
                            <div class="fw-bold text-dark">{{ $st['name'] }}</div>
                            <small class="text-muted">{{ $st['gender'] === 'L' ? 'Putra' : 'Putri' }}</small>
                        </td>
                        <td>
                            <span class="badge bg-light text-dark font-monospace fw-bold">{{ $st['nis'] }}</span>
                            <small class="text-muted d-block">{{ $st['class'] }}</small>
                        </td>
                        <td class="text-center fw-bold">{{ $tugas }}</td>
                        <td class="text-center fw-bold">{{ $uh }}</td>
                        <td class="text-center fw-bold">{{ $pts }}</td>
                        <td class="text-center fw-bold">{{ $pas }}</td>
                        <td class="text-center fw-bold text-primary">{{ $na }}</td>
                        <td class="text-center">
                            <span class="badge {{ $badgeClass }}">{{ $predikat }}</span>
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
    let dtGrades;
    document.addEventListener('DOMContentLoaded', function () {
        let table = document.querySelector('#tableGrades');
        if (table && typeof simpleDatatables !== 'undefined') {
            dtGrades = new simpleDatatables.DataTable(table, {
                searchable: true,
                fixedHeight: false,
                perPage: 10,
                perPageSelect: [10, 20, 50],
                labels: {
                    placeholder: "Cari nama santri, NIS, kelas...",
                    perPage: "{select} entri per halaman",
                    noRows: "Tidak ada data nilai ditemukan",
                    info: "Menampilkan {start} sampai {end} dari {rows} santri"
                }
            });
            if (typeof feather !== 'undefined') {
                feather.replace();
            }
        }
    });

    function filterClass(val) {
        if (dtGrades) {
            dtGrades.search(val);
        }
    }
</script>
@endpush
