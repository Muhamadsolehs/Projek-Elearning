@extends('layouts.app')

@section('title', 'Manajemen Pengguna')

@section('breadcrumb')
<nav aria-label="breadcrumb" class="breadcrumb-header">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.super-admin') }}">SIM Pesantren</a></li>
        <li class="breadcrumb-item"><a href="{{ route('dashboard.super-admin') }}">Pengaturan</a></li>
        <li class="breadcrumb-item active" aria-current="page">Pengguna</li>
    </ol>
</nav>
@endsection

@section('page-title')
Manajemen Akun Pengguna (RBAC)
@endsection

@section('page-subtitle')
Kelola kredensial akun, penugasan peran hak akses, dan status aktif akun pengguna sistem.
@endsection

@section('page-actions')
<div class="d-flex align-items-center gap-2">
    <a href="{{ route('settings.roles-permissions') }}" class="btn btn-sm btn-outline-secondary d-flex align-items-center gap-1">
        <i data-feather="shield" style="width: 14px; height: 14px;"></i> Matriks Hak Akses
    </a>
    <button type="button" onclick="alert('Form tambah pengguna baru dibuka.')" class="btn btn-sm btn-primary d-flex align-items-center gap-1">
        <i data-feather="user-plus" style="width: 14px; height: 14px;"></i> Tambah Pengguna
    </button>
</div>
@endsection

@section('content')
@php
    $users = [
        ['name' => 'Ust. H. Abdurrahman, M.Pd.I', 'email' => 'admin@pesantren.sch.id', 'role' => 'Super Admin', 'lastLogin' => 'Hari ini, 08:30 WIB', 'status' => 'Aktif'],
        ['name' => 'Ust. H. Syarif Hidayatullah, S.T.', 'email' => 'syarif@pesantren.sch.id', 'role' => 'Administrator Pesantren', 'lastLogin' => 'Hari ini, 07:45 WIB', 'status' => 'Aktif'],
        ['name' => 'Ust. Zainal Abidin, Lc', 'email' => 'psb@pesantren.sch.id', 'role' => 'Admin Penerimaan (PSB)', 'lastLogin' => 'Kemarin, 16:20 WIB', 'status' => 'Aktif'],
        ['name' => 'Ust. Drs. H. Mulyadi', 'email' => 'akademik@pesantren.sch.id', 'role' => 'Admin Akademik', 'lastLogin' => 'Hari ini, 08:15 WIB', 'status' => 'Aktif'],
        ['name' => 'Ust. Ahmad Fauzi, S.Pd.I', 'email' => 'fauzi@pesantren.sch.id', 'role' => 'Guru / Ustadz', 'lastLogin' => 'Hari ini, 07:10 WIB', 'status' => 'Aktif'],
        ['name' => 'Usth. Siti Maryam, S.Pd', 'email' => 'maryam@pesantren.sch.id', 'role' => 'Wali Kelas VII-B', 'lastLogin' => 'Hari ini, 08:00 WIB', 'status' => 'Aktif'],
        ['name' => 'Ust. Ridwan Hakim, M.Pd', 'email' => 'asrama@pesantren.sch.id', 'role' => 'Admin Keasramaan', 'lastLogin' => 'Hari ini, 06:30 WIB', 'status' => 'Aktif'],
        ['name' => 'Hj. Wahyuni Rahayu, S.E.', 'email' => 'keuangan@pesantren.sch.id', 'role' => 'Bendahara / Keuangan', 'lastLogin' => 'Hari ini, 08:40 WIB', 'status' => 'Aktif'],
        ['name' => 'Usth. Fatimah Zahra, S.I.Pust', 'email' => 'perpus@pesantren.sch.id', 'role' => 'Petugas Perpustakaan', 'lastLogin' => 'Kemarin, 15:00 WIB', 'status' => 'Aktif'],
        ['name' => 'Muhammad Pratama (20240001)', 'email' => 'santri@pesantren.sch.id', 'role' => 'Santri (Siswa)', 'lastLogin' => 'Hari ini, 06:15 WIB', 'status' => 'Aktif'],
        ['name' => 'H. Bambang Pratama, S.E.', 'email' => 'wali@pesantren.sch.id', 'role' => 'Wali Santri (Orang Tua)', 'lastLogin' => 'Kemarin, 20:10 WIB', 'status' => 'Aktif'],
    ];
@endphp
<section class="section">
    <!-- Voler Datatable Card -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title mb-0">Daftar Akun Pengguna Terdaftar</h4>
            <span class="badge bg-light-primary text-primary">{{ count($users) }} Akun Terdaftar</span>
        </div>
        <div class="card-body">
            <table class="table table-striped" id="tableUsers">
                <thead>
                    <tr>
                        <th>NAMA PENGGUNA</th>
                        <th>LOGIN ID / EMAIL</th>
                        <th>PERAN (ROLE)</th>
                        <th>LOGIN TERAKHIR</th>
                        <th>STATUS</th>
                        <th class="text-center">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $u)
                    <tr>
                        <td>
                            <div class="fw-bold text-dark">{{ $u['name'] }}</div>
                        </td>
                        <td><small class="font-monospace text-muted">{{ $u['email'] }}</small></td>
                        <td>
                            <span class="badge bg-light-primary text-primary">{{ $u['role'] }}</span>
                        </td>
                        <td class="text-muted">{{ $u['lastLogin'] }}</td>
                        <td>
                            <span class="badge {{ $u['status'] === 'Aktif' ? 'bg-success' : 'bg-danger' }}">{{ $u['status'] }}</span>
                        </td>
                        <td class="text-center">
                            <button type="button" onclick="alert('Tautan reset kata sandi telah dikirim ke {{ $u['email'] }}')" class="btn btn-sm btn-outline-secondary py-1 px-2">
                                Reset Sandi
                            </button>
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
        let table = document.querySelector('#tableUsers');
        if (table && typeof simpleDatatables !== 'undefined') {
            new simpleDatatables.DataTable(table, {
                searchable: true,
                fixedHeight: false,
                perPage: 10,
                perPageSelect: [10, 20],
                labels: {
                    placeholder: "Cari nama, email, peran...",
                    perPage: "{select} entri per halaman",
                    noRows: "Tidak ada data pengguna ditemukan",
                    info: "Menampilkan {start} sampai {end} dari {rows} pengguna"
                }
            });
            if (typeof feather !== 'undefined') {
                feather.replace();
            }
        }
    });
</script>
@endpush
