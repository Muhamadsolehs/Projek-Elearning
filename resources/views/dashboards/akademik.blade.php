@extends('layouts.app')

@section('title', 'Dashboard Akademik')

@section('breadcrumb')
<nav aria-label="breadcrumb" class="breadcrumb-header">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.super-admin') }}">SIM Pesantren</a></li>
        <li class="breadcrumb-item active" aria-current="page">Akademik Formal</li>
    </ol>
</nav>
@endsection

@section('page-title')
Dashboard Akademik Formal
@endsection

@section('page-subtitle')
Selamat datang, Ustadz Drs. H. Mulyadi. Kelola kurikulum, jadwal pelajaran formal, presensi kelas harian, dan leger nilai santri.
@endsection

@section('page-actions')
<a href="{{ route('academic.attendance') }}" class="btn btn-sm btn-primary d-flex align-items-center gap-1">
    <i data-feather="check-square" style="width: 14px; height: 14px;"></i> Presensi Harian Formal
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
                            <h3 class="card-title text-uppercase mb-0 text-muted" style="font-size: 0.85rem;">MAPEL AKTIF</h3>
                            <div class="card-right d-flex align-items-center">
                                <p class="fs-4 fw-bold mb-0 text-primary">16</p>
                            </div>
                        </div>
                        <div class="px-3 pb-3 text-xs text-muted">10 Diniyah • 6 Umum Nasional</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-3">
            <div class="card card-statistic">
                <div class="card-body p-0">
                    <div class="d-flex flex-column">
                        <div class="px-3 py-3 d-flex justify-content-between align-items-center">
                            <h3 class="card-title text-uppercase mb-0 text-muted" style="font-size: 0.85rem;">ROMBEL KELAS</h3>
                            <div class="card-right d-flex align-items-center">
                                <p class="fs-4 fw-bold mb-0 text-success">8</p>
                            </div>
                        </div>
                        <div class="px-3 pb-3 text-xs text-muted">6 Kelas SMP • 2 Kelas SMA</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-3">
            <div class="card card-statistic">
                <div class="card-body p-0">
                    <div class="d-flex flex-column">
                        <div class="px-3 py-3 d-flex justify-content-between align-items-center">
                            <h3 class="card-title text-uppercase mb-0 text-muted" style="font-size: 0.85rem;">RATA-RATA NILAI</h3>
                            <div class="card-right d-flex align-items-center">
                                <p class="fs-4 fw-bold mb-0 text-info">84.2</p>
                            </div>
                        </div>
                        <div class="px-3 pb-3 text-xs text-muted">+1.8 Poin dari Semester Ganjil</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-3">
            <div class="card card-statistic">
                <div class="card-body p-0">
                    <div class="d-flex flex-column">
                        <div class="px-3 py-3 d-flex justify-content-between align-items-center">
                            <h3 class="card-title text-uppercase mb-0 text-muted" style="font-size: 0.85rem;">KEHADIRAN FORMAL</h3>
                            <div class="card-right d-flex align-items-center">
                                <p class="fs-4 fw-bold mb-0 text-warning">98.1%</p>
                            </div>
                        </div>
                        <div class="px-3 pb-3 text-xs text-muted">Hadir Pagi s.d Siang</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Jadwal & Rekap Nilai Cards -->
    <div class="row mb-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Jadwal Pembelajaran Formal Hari Ini (Senin)</h4>
                    <a href="{{ route('academic.schedules') }}" class="btn btn-sm btn-outline-primary">Lihat Jadwal Lengkap</a>
                </div>
                <div class="card-body px-0 pb-0">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>JAM KE</th>
                                    <th>WAKTU</th>
                                    <th>MATA PELAJARAN</th>
                                    <th>KELAS</th>
                                    <th>GURU / USTADZ</th>
                                    <th>STATUS</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><span class="badge bg-light text-dark fw-bold">1 - 2</span></td>
                                    <td class="text-muted text-xs">07:30 - 08:50</td>
                                    <td class="fw-bold text-dark">Tahsin & Tahfidz Al-Qur'an</td>
                                    <td><span class="badge bg-primary">VII-A</span></td>
                                    <td>Ust. Ahmad Syarif</td>
                                    <td><span class="badge bg-success">Selesai</span></td>
                                </tr>
                                <tr>
                                    <td><span class="badge bg-light text-dark fw-bold">3 - 4</span></td>
                                    <td class="text-muted text-xs">09:00 - 10:20</td>
                                    <td class="fw-bold text-dark">Bahasa Arab & Nahwu</td>
                                    <td><span class="badge bg-info">VIII-A</span></td>
                                    <td>Ust. Zaid bin Tsabit</td>
                                    <td><span class="badge bg-primary">Berlangsung</span></td>
                                </tr>
                                <tr>
                                    <td><span class="badge bg-light text-dark fw-bold">5 - 6</span></td>
                                    <td class="text-muted text-xs">10:40 - 12:00</td>
                                    <td class="fw-bold text-dark">Matematika Wajib</td>
                                    <td><span class="badge bg-success">X-IPA</span></td>
                                    <td>Ustdzh. Nurul Hidayah, S.Pd.</td>
                                    <td><span class="badge bg-secondary">Akan Datang</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <!-- Agenda Kalender Akademik -->
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Agenda Kalender Akademik</h4>
                </div>
                <div class="card-body">
                    <div class="border-start border-3 border-primary ps-3 mb-3">
                        <div class="fw-bold text-xs">Penilaian Tengah Semester (PTS)</div>
                        <small class="text-muted">16 - 21 Maret 2026</small>
                    </div>
                    <div class="border-start border-3 border-info ps-3 mb-3">
                        <div class="fw-bold text-xs">Ujian Akhir Semester (UAS)</div>
                        <small class="text-muted">18 - 25 Mei 2026</small>
                    </div>
                    <div class="border-start border-3 border-success ps-3">
                        <div class="fw-bold text-xs">Pembagian Raport Genap</div>
                        <small class="text-muted">20 Juni 2026</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
