@extends('layouts.app')

@section('title', 'Data Santri')

@section('breadcrumb')
<nav aria-label="breadcrumb" class="breadcrumb-header">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.super-admin') }}">SIM Pesantren</a></li>
        <li class="breadcrumb-item">Administrasi</li>
        <li class="breadcrumb-item active" aria-current="page">Data Santri</li>
    </ol>
</nav>
@endsection

@section('page-title')
Master Data Santri (360° Profile)
@endsection

@section('page-subtitle')
Kelola 150 data santri terpadu dengan relasi lengkap ke data akademik, keasramaan, perizinan, dan keuangan.
@endsection

@section('page-actions')
<div class="d-flex align-items-center gap-2">
    <a href="{{ route('students.create') }}" class="btn btn-sm btn-primary d-flex align-items-center gap-1">
        <i data-feather="user-plus" style="width: 14px; height: 14px;"></i> Tambah Santri Baru
    </a>
</div>
@endsection

@section('content')
<section class="section">
    <!-- Voler Datatable Card -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title mb-0">Daftar Santri Terdaftar</h4>
            <span class="badge bg-light-primary text-primary">{{ count($students) }} Total Santri</span>
        </div>
        <div class="card-body">
            <table class="table table-striped" id="table1">
                <thead>
                    <tr>
                        <th>FOTO & NAMA SANTRI</th>
                        <th>NIS</th>
                        <th>KELAS / ROMBEL</th>
                        <th>ASRAMA</th>
                        <th>WALI SANTRI</th>
                        <th>STATUS</th>
                        <th class="text-center">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($students as $s)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <div class="avatar me-2">
                                    <img src="{{ asset($s['avatar']) }}" alt="Avatar" class="rounded-circle border" style="width: 34px; height: 34px; object-fit: cover;">
                                </div>
                                <div>
                                    <div class="fw-bold text-dark">{{ $s['name'] }}</div>
                                    <small class="text-muted">{{ $s['gender'] === 'L' ? 'Putra (Ikhwan)' : 'Putri (Akhwat)' }}</small>
                                </div>
                            </div>
                        </td>
                        <td><span class="badge bg-light text-dark fw-bold font-monospace">{{ $s['nis'] }}</span></td>
                        <td>
                            <span class="badge {{ $s['level'] === 'SMA' ? 'bg-primary' : 'bg-info' }}">
                                {{ $s['class'] }}
                            </span>
                        </td>
                        <td>{{ $s['dorm'] }}</td>
                        <td>
                            <div class="fw-semibold text-dark">{{ $s['parent_name'] }}</div>
                            <small class="text-muted font-monospace">{{ $s['parent_phone'] }}</small>
                        </td>
                        <td>
                            <span class="badge {{ $s['status'] === 'Aktif' ? 'bg-success' : ($s['status'] === 'Alumni' ? 'bg-secondary' : 'bg-warning') }}">
                                {{ $s['status'] }}
                            </span>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('students.show', $s['id']) }}" class="btn btn-sm btn-outline-primary d-inline-flex align-items-center gap-1 py-1 px-2">
                                <i data-feather="eye" style="width: 14px; height: 14px;"></i> Profil 360°
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
        let table1 = document.querySelector('#table1');
        if (table1 && typeof simpleDatatables !== 'undefined') {
            new simpleDatatables.DataTable(table1, {
                searchable: true,
                fixedHeight: false,
                perPage: 10,
                perPageSelect: [5, 10, 20, 50, 100],
                labels: {
                    placeholder: "Cari data santri...",
                    perPage: "{select} entri per halaman",
                    noRows: "Tidak ada data santri ditemukan",
                    info: "Menampilkan {start} sampai {end} dari {rows} data santri"
                }
            });
            if (typeof feather !== 'undefined') {
                feather.replace();
            }
        }
    });
</script>
@endpush
