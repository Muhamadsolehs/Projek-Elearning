@extends('layouts.app')

@section('title', 'Presensi / Absensi Kelas')

@section('breadcrumb')
<nav aria-label="breadcrumb" class="breadcrumb-header">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.super-admin') }}">SIM Pesantren</a></li>
        <li class="breadcrumb-item"><a href="{{ route('dashboard.akademik') }}">Akademik</a></li>
        <li class="breadcrumb-item active" aria-current="page">Presensi Kelas</li>
    </ol>
</nav>
@endsection

@section('page-title')
Input & Rekap Presensi Kelas
@endsection

@section('page-subtitle')
Catat kehadiran santri per mata pelajaran dengan status Hadir, Izin, Sakit, atau Alfa.
@endsection

@section('page-actions')
<div class="d-flex align-items-center gap-2">
    <button type="button" onclick="markAllPresent()" class="btn btn-sm btn-outline-success d-flex align-items-center gap-1">
        <i data-feather="check-all" style="width: 14px; height: 14px;"></i> Tandai Semua Hadir
    </button>
    <button type="button" onclick="saveAttendance()" class="btn btn-sm btn-primary d-flex align-items-center gap-1">
        <i data-feather="save" style="width: 14px; height: 14px;"></i> Simpan Presensi
    </button>
</div>
@endsection

@section('content')
<section class="section">
    <!-- Filter Bar Card -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="row g-3 align-items-center">
                <div class="col-12 col-md-4">
                    <label class="form-label text-xs fw-bold text-muted text-uppercase mb-1">Pilih Kelas</label>
                    <select id="selectClass" class="form-select form-select-sm" onchange="filterClass(this.value)">
                        <option value="">Semua Kelas</option>
                        @foreach($classes as $c)
                            <option value="{{ $c['name'] }}">{{ $c['name'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12 col-md-4">
                    <label class="form-label text-xs fw-bold text-muted text-uppercase mb-1">Mata Pelajaran</label>
                    <select class="form-select form-select-sm">
                        <option value="Fiqih & Ushul Fiqih">Fiqih & Ushul Fiqih</option>
                        <option value="Bahasa Arab & Nahwu">Bahasa Arab & Nahwu</option>
                        <option value="Tahfidz Al-Quran">Tahfidz Al-Quran</option>
                        <option value="Matematika Umum">Matematika Umum</option>
                    </select>
                </div>
                <div class="col-12 col-md-4">
                    <label class="form-label text-xs fw-bold text-muted text-uppercase mb-1">Tanggal KBM</label>
                    <input type="date" class="form-control form-control-sm" value="{{ date('Y-m-d') }}">
                </div>
            </div>
        </div>
    </div>

    <!-- Voler Table Card -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title mb-0">Daftar Kehadiran Santri</h4>
            <span class="badge bg-light-primary text-primary">{{ count($students) }} Total Santri</span>
        </div>
        <div class="card-body">
            <table class="table table-striped" id="tableAttendance">
                <thead>
                    <tr>
                        <th style="width: 50px;">NO</th>
                        <th>FOTO & NAMA SANTRI</th>
                        <th>NIS</th>
                        <th>KELAS</th>
                        <th class="text-center" style="width: 280px;">STATUS KEHADIRAN</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($students as $index => $s)
                    <tr class="attendance-row" data-class="{{ $s['class'] }}">
                        <td class="text-muted font-monospace">{{ $index + 1 }}</td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <div class="avatar me-2">
                                    <img src="{{ asset($s['avatar']) }}" alt="Avatar" class="rounded-circle border" style="width: 32px; height: 32px; object-fit: cover;">
                                </div>
                                <div>
                                    <span class="fw-bold text-dark d-block">{{ $s['name'] }}</span>
                                    <small class="text-muted">{{ $s['gender'] === 'L' ? 'Putra' : 'Putri' }}</small>
                                </div>
                            </div>
                        </td>
                        <td><span class="badge bg-light text-dark font-monospace">{{ $s['nis'] }}</span></td>
                        <td><span class="badge bg-light-info text-info">{{ $s['class'] }}</span></td>
                        <td class="text-center">
                            <div class="btn-group btn-group-sm" role="group" aria-label="Status Kehadiran">
                                <input type="radio" class="btn-check status-btn status-hadir" name="status_{{ $s['id'] }}" id="h_{{ $s['id'] }}" value="Hadir" checked>
                                <label class="btn btn-outline-success" for="h_{{ $s['id'] }}">Hadir</label>

                                <input type="radio" class="btn-check status-btn" name="status_{{ $s['id'] }}" id="i_{{ $s['id'] }}" value="Izin">
                                <label class="btn btn-outline-info" for="i_{{ $s['id'] }}">Izin</label>

                                <input type="radio" class="btn-check status-btn" name="status_{{ $s['id'] }}" id="s_{{ $s['id'] }}" value="Sakit">
                                <label class="btn btn-outline-warning" for="s_{{ $s['id'] }}">Sakit</label>

                                <input type="radio" class="btn-check status-btn" name="status_{{ $s['id'] }}" id="a_{{ $s['id'] }}" value="Alfa">
                                <label class="btn btn-outline-danger" for="a_{{ $s['id'] }}">Alfa</label>
                            </div>
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
    let dataTable;
    document.addEventListener('DOMContentLoaded', function () {
        let table = document.querySelector('#tableAttendance');
        if (table && typeof simpleDatatables !== 'undefined') {
            dataTable = new simpleDatatables.DataTable(table, {
                searchable: true,
                fixedHeight: false,
                perPage: 15,
                perPageSelect: [10, 15, 25, 50, 100],
                labels: {
                    placeholder: "Cari nama santri, NIS, kelas...",
                    perPage: "{select} entri per halaman",
                    noRows: "Tidak ada data santri ditemukan",
                    info: "Menampilkan {start} sampai {end} dari {rows} santri"
                }
            });
            if (typeof feather !== 'undefined') {
                feather.replace();
            }
        }
    });

    function markAllPresent() {
        document.querySelectorAll('.status-hadir').forEach(el => el.checked = true);
        alert('Seluruh santri berhasil ditandai HADIR.');
    }

    function saveAttendance() {
        alert('Data presensi KBM berhasil disimpan ke sistem.');
    }

    function filterClass(val) {
        if (dataTable) {
            dataTable.search(val);
        }
    }
</script>
@endpush
