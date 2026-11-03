@extends('layouts.app')

@section('title', 'Dashboard Wali Kelas')

@section('breadcrumb')
<nav aria-label="breadcrumb" class="breadcrumb-header">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.wali-kelas') }}">Portal Wali Kelas</a></li>
        <li class="breadcrumb-item active" aria-current="page">Pembinaan Kelas VII-B</li>
    </ol>
</nav>
@endsection

@section('page-title')
Dashboard Pembinaan Kelas VII-B (Putri)
@endsection

@section('page-subtitle')
Selamat datang, Ustadzah Siti Maryam, S.Pd. Pantau kehadiran, nilai rapor, dan catatan pembinaan 26 santriwati binaan Anda.
@endsection

@section('page-actions')
<a href="{{ route('academic.grades') }}" class="btn btn-sm btn-primary d-flex align-items-center gap-1">
    <i data-feather="award" style="width: 14px; height: 14px;"></i> Rekap Rapor Kelas VII-B
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
                            <h3 class="card-title text-uppercase mb-0 text-muted" style="font-size: 0.85rem;">SANTRI BINAAN</h3>
                            <div class="card-right d-flex align-items-center">
                                <p class="fs-4 fw-bold mb-0 text-primary">26</p>
                            </div>
                        </div>
                        <div class="px-3 pb-3 text-xs text-muted">100% Santriwati Aktif</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-3">
            <div class="card card-statistic">
                <div class="card-body p-0">
                    <div class="d-flex flex-column">
                        <div class="px-3 py-3 d-flex justify-content-between align-items-center">
                            <h3 class="card-title text-uppercase mb-0 text-muted" style="font-size: 0.85rem;">KEHADIRAN KELAS</h3>
                            <div class="card-right d-flex align-items-center">
                                <p class="fs-4 fw-bold mb-0 text-success">97.4%</p>
                            </div>
                        </div>
                        <div class="px-3 pb-3 text-xs text-muted">Peringkat 1 Tingkat SMP</div>
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
                                <p class="fs-4 fw-bold mb-0 text-info">86.8</p>
                            </div>
                        </div>
                        <div class="px-3 pb-3 text-xs text-muted">Leger Semester Genap</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-3">
            <div class="card card-statistic">
                <div class="card-body p-0">
                    <div class="d-flex flex-column">
                        <div class="px-3 py-3 d-flex justify-content-between align-items-center">
                            <h3 class="card-title text-uppercase mb-0 text-muted" style="font-size: 0.85rem;">CATATAN KHUSUS</h3>
                            <div class="card-right d-flex align-items-center">
                                <p class="fs-4 fw-bold mb-0 text-warning">2</p>
                            </div>
                        </div>
                        <div class="px-3 pb-3 text-xs text-muted">Perlu Konsultasi Wali</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Data Santri Kelas & Catatan Binaan -->
    <div class="row mb-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Daftar Santriwati Kelas VII-B</h5>
                    <a href="{{ route('academic.attendance') }}" class="btn btn-sm btn-outline-primary">Presensi Harian</a>
                </div>
                <div class="card-body px-0 pb-0">
                    <table class="table table-striped table-hover mb-0">
                        <thead>
                            <tr>
                                <th>NAMA SANTRIWATI</th>
                                <th>NIS</th>
                                <th>KEHADIRAN</th>
                                <th>RATA-RATA</th>
                                <th>STATUS</th>
                                <th class="text-center">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="fw-bold">Aisyah Pratama</div>
                                    <small class="text-muted">Kamar: Aisyah 02</small>
                                </td>
                                <td><span class="badge bg-light text-dark font-monospace">2026002</span></td>
                                <td class="text-success fw-bold">99.2%</td>
                                <td class="fw-bold">89.4</td>
                                <td><span class="badge bg-success">Sangat Baik</span></td>
                                <td class="text-center">
                                    <a href="{{ route('students.show', 'STU-2') }}" class="btn btn-sm btn-light-primary py-1 px-2 text-xs">Rapor</a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="fw-bold">Fatimah Az-Zahra</div>
                                    <small class="text-muted">Kamar: Aisyah 03</small>
                                </td>
                                <td><span class="badge bg-light text-dark font-monospace">2026003</span></td>
                                <td class="text-success fw-bold">98.0%</td>
                                <td class="fw-bold">87.5</td>
                                <td><span class="badge bg-success">Sangat Baik</span></td>
                                <td class="text-center">
                                    <a href="{{ route('students.show', 'STU-3') }}" class="btn btn-sm btn-light-primary py-1 px-2 text-xs">Rapor</a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="fw-bold">Khadijah Al-Kubro</div>
                                    <small class="text-muted">Kamar: Aisyah 01</small>
                                </td>
                                <td><span class="badge bg-light text-dark font-monospace">2026005</span></td>
                                <td class="text-warning fw-bold">95.0%</td>
                                <td class="fw-bold">83.5</td>
                                <td><span class="badge bg-primary">Baik</span></td>
                                <td class="text-center">
                                    <a href="{{ route('students.show', 'STU-5') }}" class="btn btn-sm btn-light-primary py-1 px-2 text-xs">Rapor</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Komunikasi Orang Tua / Wali</h5>
                </div>
                <div class="card-body">
                    <p class="text-xs text-muted">Konsultasi perkembangan santriwati dengan orang tua terjadwal pekan ini:</p>
                    <div class="border-start border-3 border-primary ps-3 mb-3">
                        <div class="fw-bold text-xs">Wali Santri Khadijah</div>
                        <small class="text-muted">Rabu, 11 Feb 2026 • 13:30 WIB (Via WhatsApp Call)</small>
                    </div>
                    <div class="border-start border-3 border-success ps-3">
                        <div class="fw-bold text-xs">Wali Santri Fatimah</div>
                        <small class="text-muted">Jumat, 13 Feb 2026 • 14:00 WIB (Pertemuan di Kantor)</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
