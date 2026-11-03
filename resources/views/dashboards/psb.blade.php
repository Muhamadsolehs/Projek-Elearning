@extends('layouts.app')

@section('title', 'Dashboard PSB')

@section('breadcrumb')
<nav aria-label="breadcrumb" class="breadcrumb-header">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.super-admin') }}">SIM Pesantren</a></li>
        <li class="breadcrumb-item active" aria-current="page">Penerimaan Santri Baru (PSB)</li>
    </ol>
</nav>
@endsection

@section('page-title')
Dashboard Penerimaan Santri Baru (PSB)
@endsection

@section('page-subtitle')
Selamat datang, Ustadz Zainal Abidin, Lc. Pantau alur pendaftaran, verifikasi berkas, seleksi, hingga aktivasi santri baru T.A 2026/2027.
@endsection

@section('page-actions')
<a href="{{ route('admissions.applicants') }}" class="btn btn-sm btn-success d-flex align-items-center gap-1">
    <i data-feather="user-plus" style="width: 14px; height: 14px;"></i> Daftar Calon Santri
</a>
@endsection

@section('content')
<section class="section">
    <!-- Voler Pipeline Alur Seleksi PSB Card -->
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title mb-0">Pipeline Alur Seleksi PSB T.A. 2026/2027</h4>
            <span class="badge bg-success">Gelombang 1 Dibuka</span>
        </div>
        <div class="card-body">
            <div class="row g-2">
                <div class="col-6 col-md-2">
                    <div class="card bg-light-primary text-center p-2 mb-0">
                        <small class="fw-bold text-muted" style="font-size: 11px;">1. Pendaftaran</small>
                        <h3 class="fw-bold text-primary mb-0 mt-1">20</h3>
                        <small class="text-muted" style="font-size: 10px;">Total Masuk</small>
                    </div>
                </div>
                <div class="col-6 col-md-2">
                    <div class="card bg-light-warning text-center p-2 mb-0">
                        <small class="fw-bold text-muted" style="font-size: 11px;">2. Verifikasi</small>
                        <h3 class="fw-bold text-warning mb-0 mt-1">6</h3>
                        <small class="text-muted" style="font-size: 10px;">Perlu Verifikasi</small>
                    </div>
                </div>
                <div class="col-6 col-md-2">
                    <div class="card bg-light-info text-center p-2 mb-0">
                        <small class="fw-bold text-muted" style="font-size: 11px;">3. Jadwal Tes</small>
                        <h3 class="fw-bold text-info mb-0 mt-1">8</h3>
                        <small class="text-muted" style="font-size: 10px;">Siap Ujian</small>
                    </div>
                </div>
                <div class="col-6 col-md-2">
                    <div class="card bg-light-secondary text-center p-2 mb-0">
                        <small class="fw-bold text-muted" style="font-size: 11px;">4. Input Nilai</small>
                        <h3 class="fw-bold text-secondary mb-0 mt-1">6</h3>
                        <small class="text-muted" style="font-size: 10px;">Dinilai Penguji</small>
                    </div>
                </div>
                <div class="col-6 col-md-2">
                    <div class="card bg-light-success text-center p-2 mb-0">
                        <small class="fw-bold text-muted" style="font-size: 11px;">5. Kelulusan</small>
                        <h3 class="fw-bold text-success mb-0 mt-1">12</h3>
                        <small class="text-muted" style="font-size: 10px;">Lulus Seleksi</small>
                    </div>
                </div>
                <div class="col-6 col-md-2">
                    <div class="card bg-light-primary text-center p-2 mb-0">
                        <small class="fw-bold text-muted" style="font-size: 11px;">6. Santri Aktif</small>
                        <h3 class="fw-bold text-primary mb-0 mt-1">10</h3>
                        <small class="text-muted" style="font-size: 10px;">Diaktivasi</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pendaftar Menunggu Verifikasi & Kuota Card -->
    <div class="row mb-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Pendaftar Membutuhkan Verifikasi Berkas Segera</h4>
                    <a href="{{ route('admissions.applicants') }}" class="btn btn-sm btn-outline-primary">Buka Semua Pendaftar</a>
                </div>
                <div class="card-body px-0 pb-0">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>NO DAFTAR</th>
                                    <th>NAMA CALON SANTRI</th>
                                    <th>JENJANG</th>
                                    <th>ASAL SEKOLAH</th>
                                    <th>STATUS</th>
                                    <th class="text-center">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(array_slice($admissions, 0, 5) as $adm)
                                <tr>
                                    <td><span class="font-monospace fw-bold text-primary">{{ $adm['code'] }}</span></td>
                                    <td>
                                        <div class="fw-bold text-dark">{{ $adm['name'] }}</div>
                                        <small class="text-muted">Wali: {{ $adm['parent_name'] }}</small>
                                    </td>
                                    <td><span class="badge {{ $adm['level'] === 'SMA' ? 'bg-primary' : 'bg-info' }}">{{ $adm['level'] }}</span></td>
                                    <td class="text-muted">{{ $adm['origin_school'] ?? 'SDIT Al-Hikmah' }}</td>
                                    <td>
                                        <span class="badge {{ $adm['status'] === 'Terverifikasi' ? 'bg-success' : ($adm['status'] === 'Lulus' ? 'bg-primary' : 'bg-warning') }}">
                                            {{ $adm['status'] }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('admissions.verify', $adm['id']) }}" class="btn btn-sm btn-light-primary py-1 px-2 text-xs">
                                            Verifikasi
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <!-- Kuota Pendaftaran Card -->
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Keterisian Kuota Gelombang 1</h4>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <div class="d-flex justify-content-between text-xs mb-1">
                            <span>SMP Putra (Ikhwan)</span>
                            <span class="fw-bold">18 / 30 Kursi</span>
                        </div>
                        <div class="progress progress-primary progress-sm">
                            <div class="progress-bar" style="width: 60%"></div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between text-xs mb-1">
                            <span>SMP Putri (Akhwat)</span>
                            <span class="fw-bold">22 / 30 Kursi</span>
                        </div>
                        <div class="progress progress-info progress-sm">
                            <div class="progress-bar" style="width: 73%"></div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between text-xs mb-1">
                            <span>SMA Putra (Ikhwan)</span>
                            <span class="fw-bold">14 / 25 Kursi</span>
                        </div>
                        <div class="progress progress-success progress-sm">
                            <div class="progress-bar" style="width: 56%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="d-flex justify-content-between text-xs mb-1">
                            <span>SMA Putri (Akhwat)</span>
                            <span class="fw-bold">16 / 25 Kursi</span>
                        </div>
                        <div class="progress progress-warning progress-sm">
                            <div class="progress-bar" style="width: 64%"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Jadwal Ujian Masuk Card -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Jadwal Ujian Terdekat</h4>
                    <span class="badge bg-light-primary text-primary">Tes Masuk</span>
                </div>
                <div class="card-body">
                    <div class="border-start border-3 border-primary ps-3 mb-3">
                        <div class="fw-bold text-xs">Tes Baca Al-Qur'an & Tahfidz</div>
                        <small class="text-muted">Ahad, 15 Maret 2026 • 08:00 - 11:30 WIB</small>
                    </div>
                    <div class="border-start border-3 border-info ps-3">
                        <div class="fw-bold text-xs">Tes Akademik & Psikotes Santri</div>
                        <small class="text-muted">Ahad, 22 Maret 2026 • 08:30 - 12:00 WIB</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
