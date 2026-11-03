@extends('layouts.app')

@section('title', 'Dashboard Keasramaan & Pengasuhan')

@section('breadcrumb')
<nav aria-label="breadcrumb" class="breadcrumb-header">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.super-admin') }}">SIM Pesantren</a></li>
        <li class="breadcrumb-item active" aria-current="page">Keasramaan & Pengasuhan</li>
    </ol>
</nav>
@endsection

@section('page-title')
Dashboard Pengasuhan & Keasramaan
@endsection

@section('page-subtitle')
Selamat datang, Ustadz Ridwan Hakim, M.Pd (Kepala Pengasuhan Santri Putra). Pantau kedisiplinan, kegiatan diniyah, dan izin santri.
@endsection

@section('page-actions')
<a href="{{ route('dormitory.gate-check') }}" class="btn btn-sm btn-primary d-flex align-items-center gap-1">
    <i data-feather="shield" style="width: 14px; height: 14px;"></i> Monitoring Pos Gerbang Santri
</a>
@endsection

@section('content')
<section class="section">
    <!-- Voler 4 Stat Cards -->
    <div class="row mb-2">
        <div class="col-12 col-md-3">
            <div class="card card-statistic">
                <div class="card-body p-0">
                    <div class="d-flex flex-column">
                        <div class="px-3 py-3 d-flex justify-content-between align-items-center">
                            <h3 class="card-title text-uppercase mb-0 text-muted" style="font-size: 0.85rem;">SANTRI DI ASRAMA</h3>
                            <div class="card-right d-flex align-items-center">
                                <p class="fs-4 fw-bold mb-0 text-primary">143</p>
                            </div>
                        </div>
                        <div class="px-3 pb-3 text-xs text-muted">5 Izin Pulang • 2 Izin Berobat</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-3">
            <div class="card card-statistic">
                <div class="card-body p-0">
                    <div class="d-flex flex-column">
                        <div class="px-3 py-3 d-flex justify-content-between align-items-center">
                            <h3 class="card-title text-uppercase mb-0 text-muted" style="font-size: 0.85rem;">IZIN APPROVAL</h3>
                            <div class="card-right d-flex align-items-center">
                                <p class="fs-4 fw-bold mb-0 text-warning">4</p>
                            </div>
                        </div>
                        <div class="px-3 pb-3 text-xs text-muted">Perlu Persetujuan Pengasuh</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-3">
            <div class="card card-statistic">
                <div class="card-body p-0">
                    <div class="d-flex flex-column">
                        <div class="px-3 py-3 d-flex justify-content-between align-items-center">
                            <h3 class="card-title text-uppercase mb-0 text-muted" style="font-size: 0.85rem;">PRESENSI SHALAT</h3>
                            <div class="card-right d-flex align-items-center">
                                <p class="fs-4 fw-bold mb-0 text-success">98.6%</p>
                            </div>
                        </div>
                        <div class="px-3 pb-3 text-xs text-muted">Jamaah Shubuh & Isya</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-3">
            <div class="card card-statistic">
                <div class="card-body p-0">
                    <div class="d-flex flex-column">
                        <div class="px-3 py-3 d-flex justify-content-between align-items-center">
                            <h3 class="card-title text-uppercase mb-0 text-muted" style="font-size: 0.85rem;">PELANGGARAN</h3>
                            <div class="card-right d-flex align-items-center">
                                <p class="fs-4 fw-bold mb-0 text-danger">2</p>
                            </div>
                        </div>
                        <div class="px-3 pb-3 text-xs text-muted">Kategori Ringan (Terlambat)</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Perizinan & Kegiatan Asrama -->
    <div class="row mb-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Pengajuan Izin Keluar / Pulang Santri</h4>
                    <a href="{{ route('dormitory.permissions') }}" class="btn btn-sm btn-outline-primary">Buka Semua Izin</a>
                </div>
                <div class="card-body px-0 pb-0">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>NAMA SANTRI</th>
                                    <th>ALASAN IZIN</th>
                                    <th>WAKTU KELUAR</th>
                                    <th>BATAS KEMBALI</th>
                                    <th>STATUS</th>
                                    <th class="text-center">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(array_slice($permissions, 0, 5) as $p)
                                <tr>
                                    <td>
                                        <div class="fw-bold text-dark">{{ $p['student_name'] }}</div>
                                        <small class="text-muted">Kelas: {{ $p['class'] }} • {{ $p['dorm'] }}</small>
                                    </td>
                                    <td><span class="badge bg-light text-dark">{{ $p['reason'] }}</span></td>
                                    <td class="text-muted text-xs">{{ $p['out_time'] }}</td>
                                    <td class="text-muted text-xs">{{ $p['return_limit'] }}</td>
                                    <td>
                                        <span class="badge {{ $p['status'] === 'Disetujui' ? 'bg-success' : ($p['status'] === 'Di Luar' ? 'bg-warning text-dark' : 'bg-primary') }}">
                                            {{ $p['status'] }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('dormitory.permissions') }}" class="btn btn-sm btn-light-primary py-1 px-2 text-xs">Review</a>
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
            <!-- Kegiatan Harian Asrama Card -->
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Jadwal Rutin Asrama Hari Ini</h4>
                </div>
                <div class="card-body">
                    <div class="border-start border-3 border-success ps-3 mb-3">
                        <div class="fw-bold text-xs">04:00 - 05:30 WIB</div>
                        <div class="text-xs">Qiyamul Lail & Shalat Shubuh Berjamaah</div>
                    </div>
                    <div class="border-start border-3 border-primary ps-3 mb-3">
                        <div class="fw-bold text-xs">05:30 - 06:30 WIB</div>
                        <div class="text-xs">Halaqah Tahfidz & Muroja'ah Pagi</div>
                    </div>
                    <div class="border-start border-3 border-info ps-3 mb-3">
                        <div class="fw-bold text-xs">18:00 - 19:30 WIB</div>
                        <div class="text-xs">Kajian Kitab Kuning (Riyadhus Shalihin)</div>
                    </div>
                    <div class="border-start border-3 border-warning ps-3">
                        <div class="fw-bold text-xs">22:00 WIB</div>
                        <div class="text-xs">Absensi Malam Kamar & Jam Istirahat</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
