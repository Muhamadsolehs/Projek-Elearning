@extends('layouts.app')

@section('title', 'Dashboard Guru / Ustadz')

@section('breadcrumb')
<nav aria-label="breadcrumb" class="breadcrumb-header">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.guru') }}">Portal Guru</a></li>
        <li class="breadcrumb-item active" aria-current="page">Jadwal & Pembelajaran</li>
    </ol>
</nav>
@endsection

@section('page-title')
Dashboard Pembelajaran Guru
@endsection

@section('page-subtitle')
Ahlan wa Sahlan, Ustadz Ahmad Fauzi, S.Pd.I (Pengampu Mapel Fiqih & Ushul Fiqih).
@endsection

@section('page-actions')
<a href="{{ route('academic.attendance') }}" class="btn btn-sm btn-primary d-flex align-items-center gap-1">
    <i data-feather="check-square" style="width: 14px; height: 14px;"></i> Input Presensi Kelas Hari Ini
</a>
@endsection

@section('content')
<section class="section">
    <!-- Voler 3 Stat Cards -->
    <div class="row mb-2">
        <div class="col-12 col-md-4">
            <div class="card card-statistic">
                <div class="card-body p-0">
                    <div class="d-flex flex-column">
                        <div class="px-3 py-3 d-flex justify-content-between align-items-center">
                            <h3 class="card-title text-uppercase mb-0 text-muted" style="font-size: 0.85rem;">KELAS DIAMPU</h3>
                            <div class="card-right d-flex align-items-center">
                                <p class="fs-4 fw-bold mb-0 text-primary">3 Kelas</p>
                            </div>
                        </div>
                        <div class="px-3 pb-3 text-xs text-muted">Kelas VII-A, VIII-A, dan IX-A (82 Santri)</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="card card-statistic">
                <div class="card-body p-0">
                    <div class="d-flex flex-column">
                        <div class="px-3 py-3 d-flex justify-content-between align-items-center">
                            <h3 class="card-title text-uppercase mb-0 text-muted" style="font-size: 0.85rem;">JAM MENGAJAR</h3>
                            <div class="card-right d-flex align-items-center">
                                <p class="fs-4 fw-bold mb-0 text-success">18 JP / Pekan</p>
                            </div>
                        </div>
                        <div class="px-3 pb-3 text-xs text-muted">Sisa 6 JP untuk pekan ini</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="card card-statistic">
                <div class="card-body p-0">
                    <div class="d-flex flex-column">
                        <div class="px-3 py-3 d-flex justify-content-between align-items-center">
                            <h3 class="card-title text-uppercase mb-0 text-muted" style="font-size: 0.85rem;">INPUT NILAI</h3>
                            <div class="card-right d-flex align-items-center">
                                <p class="fs-4 fw-bold mb-0 text-warning">PTS Selesai</p>
                            </div>
                        </div>
                        <div class="px-3 pb-3 text-xs text-muted">Leger nilai sudah diverifikasi</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Jadwal Mengajar & Input Nilai Cepat -->
    <div class="row mb-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Jadwal Mengajar Ustadz Pekan Ini</h5>
                    <a href="{{ route('academic.attendance') }}" class="btn btn-sm btn-outline-primary">Mulai Presensi Kelas</a>
                </div>
                <div class="card-body px-0 pb-0">
                    <table class="table table-striped table-hover mb-0">
                        <thead>
                            <tr>
                                <th>HARI</th>
                                <th>JAM KE</th>
                                <th>KELAS</th>
                                <th>MATERI PEMBELAJARAN</th>
                                <th>AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><span class="badge bg-primary">Senin</span></td>
                                <td class="text-muted text-xs">07:30 - 09:00 (1-2)</td>
                                <td><span class="badge bg-light text-dark">VII-A</span></td>
                                <td class="fw-bold">Fikih Thaharah (Bersuci)</td>
                                <td>
                                    <a href="{{ route('academic.attendance') }}" class="btn btn-sm btn-light-primary py-1 px-2 text-xs">Presensi</a>
                                </td>
                            </tr>
                            <tr>
                                <td><span class="badge bg-info">Selasa</span></td>
                                <td class="text-muted text-xs">09:15 - 10:45 (3-4)</td>
                                <td><span class="badge bg-light text-dark">VIII-A</span></td>
                                <td class="fw-bold">Fikih Muamalah & Jual Beli</td>
                                <td>
                                    <a href="{{ route('academic.attendance') }}" class="btn btn-sm btn-light-primary py-1 px-2 text-xs">Presensi</a>
                                </td>
                            </tr>
                            <tr>
                                <td><span class="badge bg-success">Kamis</span></td>
                                <td class="text-muted text-xs">10:40 - 12:00 (5-6)</td>
                                <td><span class="badge bg-light text-dark">IX-A</span></td>
                                <td class="fw-bold">Ushul Fiqih: Al-Amru wan Nahyu</td>
                                <td>
                                    <a href="{{ route('academic.attendance') }}" class="btn btn-sm btn-light-primary py-1 px-2 text-xs">Presensi</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <!-- Catatan Kelas Bimbingan -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Catatan Perkembangan Santri</h5>
                </div>
                <div class="card-body">
                    <p class="text-xs text-muted mb-3">Santri dengan nilai atau kedisiplinan yang memerlukan perhatian khusus:</p>
                    <div class="alert alert-light-warning mb-2 py-2 px-3 text-xs">
                        <strong>Zaidan Al-Ghifari (VIII-A)</strong>
                        <div class="text-muted">Perlu bimbingan hafalan matan Al-Ghayah wat Taqrib</div>
                    </div>
                    <div class="alert alert-light-info mb-0 py-2 px-3 text-xs">
                        <strong>Fahri Ramadhan (VII-A)</strong>
                        <div class="text-muted">Kemajuan pesat pada ujian lisan bab shalat sunnah</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
