@extends('layouts.app')

@section('title', 'Dashboard Super Admin')

@section('breadcrumb')
<nav aria-label="breadcrumb" class="breadcrumb-header">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.super-admin') }}">SIM Pesantren</a></li>
        <li class="breadcrumb-item active" aria-current="page">Dashboard Super Admin</li>
    </ol>
</nav>
@endsection

@section('page-title')
Dashboard Utama Super Admin
@endsection

@section('page-subtitle')
Selamat datang, Ustadz H. Abdurrahman, M.Pd.I. Berikut ikhtisar operasional seluruh cabang pesantren hari ini.
@endsection

@section('page-actions')
<div class="d-flex align-items-center gap-2">
    <button onclick="window.print()" class="btn btn-sm btn-outline-secondary d-flex align-items-center gap-1">
        <i data-feather="printer" style="width: 14px; height: 14px;"></i> Cetak Ringkasan
    </button>
    <a href="{{ route('students.create') }}" class="btn btn-sm btn-primary d-flex align-items-center gap-1">
        <i data-feather="user-plus" style="width: 14px; height: 14px;"></i> Tambah Santri Baru
    </a>
</div>
@endsection

@section('content')
<section class="section">
    <!-- Voler 4 Stat Cards with Sparklines -->
    <div class="row mb-2">
        <div class="col-12 col-md-3">
            <div class="card card-statistic">
                <div class="card-body p-0">
                    <div class="d-flex flex-column">
                        <div class="px-3 py-3 d-flex justify-content-between align-items-center">
                            <h3 class="card-title text-uppercase mb-0 text-muted" style="font-size: 0.85rem;">SANTRI AKTIF</h3>
                            <div class="card-right d-flex align-items-center">
                                <p class="fs-4 fw-bold mb-0 text-primary">148</p>
                            </div>
                        </div>
                        <div class="chart-wrapper">
                            <canvas id="canvas1" style="height:80px !important"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-3">
            <div class="card card-statistic">
                <div class="card-body p-0">
                    <div class="d-flex flex-column">
                        <div class="px-3 py-3 d-flex justify-content-between align-items-center">
                            <h3 class="card-title text-uppercase mb-0 text-muted" style="font-size: 0.85rem;">PENDAFTAR PSB</h3>
                            <div class="card-right d-flex align-items-center">
                                <p class="fs-4 fw-bold mb-0 text-success">20</p>
                            </div>
                        </div>
                        <div class="chart-wrapper">
                            <canvas id="canvas2" style="height:80px !important"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-3">
            <div class="card card-statistic">
                <div class="card-body p-0">
                    <div class="d-flex flex-column">
                        <div class="px-3 py-3 d-flex justify-content-between align-items-center">
                            <h3 class="card-title text-uppercase mb-0 text-muted" style="font-size: 0.85rem;">GURU & ASATIDZ</h3>
                            <div class="card-right d-flex align-items-center">
                                <p class="fs-4 fw-bold mb-0 text-info">10</p>
                            </div>
                        </div>
                        <div class="chart-wrapper">
                            <canvas id="canvas3" style="height:80px !important"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-3">
            <div class="card card-statistic">
                <div class="card-body p-0">
                    <div class="d-flex flex-column">
                        <div class="px-3 py-3 d-flex justify-content-between align-items-center">
                            <h3 class="card-title text-uppercase mb-0 text-muted" style="font-size: 0.85rem;">KAS BULAN INI</h3>
                            <div class="card-right d-flex align-items-center">
                                <p class="fs-4 fw-bold mb-0 text-warning">Rp 84,5jt</p>
                            </div>
                        </div>
                        <div class="chart-wrapper">
                            <canvas id="canvas4" style="height:80px !important"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Voler Main Analytics & Radial Section -->
    <div class="row mb-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-heading p-1 pl-3 mb-0">Statistik Kehadiran & Akademik Santri</h4>
                    <span class="badge bg-light-primary text-primary">T.A. 2025/2026</span>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 col-12">
                            <div class="pl-3">
                                <h1 class="mt-4 fw-bold text-dark">97.4%</h1>
                                <p class="text-xs text-muted mb-3"><span class="text-success fw-bold"><i data-feather="trending-up" style="width: 14px; height: 14px;"></i> +2.3%</span> dibanding bulan lalu</p>
                                <div class="legends">
                                    <div class="legend d-flex flex-row align-items-center mb-2">
                                        <div class="me-2 rounded-circle bg-info" style="width: 12px; height: 12px;"></div>
                                        <span class="text-xs text-muted">Hadir Formal (SMP/SMA)</span>
                                    </div>
                                    <div class="legend d-flex flex-row align-items-center mb-2">
                                        <div class="me-2 rounded-circle bg-primary" style="width: 12px; height: 12px;"></div>
                                        <span class="text-xs text-muted">Hadir Pengajian Asrama</span>
                                    </div>
                                    <div class="legend d-flex flex-row align-items-center">
                                        <div class="me-2 rounded-circle bg-warning" style="width: 12px; height: 12px;"></div>
                                        <span class="text-xs text-muted">Izin Resmi / Sakit</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8 col-12">
                            <canvas id="attendanceBarChart" style="height: 240px;"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Access Modules Card -->
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Pintasan Modul Utama</h4>
                </div>
                <div class="card-body">
                    <div class="row g-2">
                        <div class="col-6 col-md-3">
                            <a href="{{ route('students.index') }}" class="btn btn-outline-primary w-100 p-3 text-center d-block text-decoration-none">
                                <i data-feather="users" class="mb-2 d-block mx-auto" style="width: 24px; height: 24px;"></i>
                                <span class="fw-semibold text-xs d-block">Data Santri</span>
                                <small class="text-muted" style="font-size: 11px;">148 Santri</small>
                            </a>
                        </div>
                        <div class="col-6 col-md-3">
                            <a href="{{ route('admissions.applicants') }}" class="btn btn-outline-success w-100 p-3 text-center d-block text-decoration-none">
                                <i data-feather="user-plus" class="mb-2 d-block mx-auto" style="width: 24px; height: 24px;"></i>
                                <span class="fw-semibold text-xs d-block">Modul PSB</span>
                                <small class="text-muted" style="font-size: 11px;">20 Calon</small>
                            </a>
                        </div>
                        <div class="col-6 col-md-3">
                            <a href="{{ route('dormitory.gate-check') }}" class="btn btn-outline-warning w-100 p-3 text-center d-block text-decoration-none">
                                <i data-feather="shield" class="mb-2 d-block mx-auto" style="width: 24px; height: 24px;"></i>
                                <span class="fw-semibold text-xs d-block">Gate Check QR</span>
                                <small class="text-muted" style="font-size: 11px;">Pos Satpam</small>
                            </a>
                        </div>
                        <div class="col-6 col-md-3">
                            <a href="{{ route('library.borrow') }}" class="btn btn-outline-info w-100 p-3 text-center d-block text-decoration-none">
                                <i data-feather="bookmark" class="mb-2 d-block mx-auto" style="width: 24px; height: 24px;"></i>
                                <span class="fw-semibold text-xs d-block">Perpustakaan</span>
                                <small class="text-muted" style="font-size: 11px;">QR Sirkulasi</small>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <!-- Sebaran Santri Card -->
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Komposisi Santri</h4>
                </div>
                <div class="card-body">
                    <div id="chart-santri-distribution"></div>
                    <div class="mt-3">
                        <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                            <div class="d-flex align-items-center gap-2">
                                <span class="badge bg-primary">SMP</span>
                                <span class="text-xs fw-semibold">Jenjang SMP Terpadu</span>
                            </div>
                            <span class="text-xs fw-bold">82 Santri</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                            <div class="d-flex align-items-center gap-2">
                                <span class="badge bg-info">SMA</span>
                                <span class="text-xs fw-semibold">Jenjang SMA Terpadu</span>
                            </div>
                            <span class="text-xs fw-bold">66 Santri</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center py-2">
                            <div class="d-flex align-items-center gap-2">
                                <span class="badge bg-success">Asrama</span>
                                <span class="text-xs fw-semibold">Santri Mukim (100%)</span>
                            </div>
                            <span class="text-xs fw-bold">148 Santri</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Asrama & Kamar Monitoring Card -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Kapasitas Asrama</h4>
                    <a href="{{ route('dormitory.activities') }}" class="text-xs text-primary text-decoration-none">Detail</a>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <div class="d-flex justify-content-between text-xs mb-1">
                            <span>Gedung Umar bin Khattab (Putra)</span>
                            <span class="fw-bold">45 / 50</span>
                        </div>
                        <div class="progress progress-primary progress-sm">
                            <div class="progress-bar" role="progressbar" style="width: 90%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between text-xs mb-1">
                            <span>Gedung Ali bin Abi Thalib (Putra)</span>
                            <span class="fw-bold">37 / 40</span>
                        </div>
                        <div class="progress progress-info progress-sm">
                            <div class="progress-bar" role="progressbar" style="width: 92%" aria-valuenow="92" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <div>
                        <div class="d-flex justify-content-between text-xs mb-1">
                            <span>Gedung Aisyah binti Abu Bakar (Putri)</span>
                            <span class="fw-bold">66 / 70</span>
                        </div>
                        <div class="progress progress-success progress-sm">
                            <div class="progress-bar" role="progressbar" style="width: 94%" aria-valuenow="94" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Voler Recent Activity Table Section -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Aktivitas & Log Transaksi Pesantren Terbaru</h4>
                    <a href="{{ route('settings.audit-logs') }}" class="btn btn-sm btn-outline-primary">Lihat Seluruh Log</a>
                </div>
                <div class="card-body px-0 pb-0">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>WAKTU</th>
                                    <th>SANTRI / PENGGUNA</th>
                                    <th>MODUL</th>
                                    <th>KETERANGAN AKTIVITAS</th>
                                    <th>STATUS</th>
                                    <th class="text-center">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-muted text-xs">10:45 WIB</td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <img src="/assets/images/avatar/avatar-s-1.png" class="rounded-circle" style="width: 28px; height: 28px;">
                                            <div>
                                                <div class="fw-bold">Ahmad Rayhan Al-Fatih</div>
                                                <small class="text-muted">NIS: 2026001 • Kelas VIII-A</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td><span class="badge bg-light-success text-success">Keuangan</span></td>
                                    <td>Pembayaran SPP Bulan Februari 2026 telah diverifikasi Bendahara (Rp 750.000)</td>
                                    <td><span class="badge bg-success">Lunas</span></td>
                                    <td class="text-center">
                                        <a href="{{ route('students.show', 'STU-1') }}" class="btn btn-sm btn-light-primary py-1 px-2 text-xs">Lihat</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-muted text-xs">10:15 WIB</td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <img src="/assets/images/avatar/avatar-s-2.png" class="rounded-circle" style="width: 28px; height: 28px;">
                                            <div>
                                                <div class="fw-bold">Muhammad Farhan</div>
                                                <small class="text-muted">NIS: 2026002 • Kelas IX-B</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td><span class="badge bg-light-warning text-warning">Keasramaan</span></td>
                                    <td>Verifikasi QR Izin Keluar di Pos Satpam (Tujuan: Berobat ke RSUD)</td>
                                    <td><span class="badge bg-warning text-dark">Di Luar</span></td>
                                    <td class="text-center">
                                        <a href="{{ route('dormitory.gate-check') }}" class="btn btn-sm btn-light-primary py-1 px-2 text-xs">Gate Check</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-muted text-xs">09:30 WIB</td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <img src="/assets/images/avatar/avatar-s-3.png" class="rounded-circle" style="width: 28px; height: 28px;">
                                            <div>
                                                <div class="fw-bold">Fatimah Az-Zahra</div>
                                                <small class="text-muted">NIS: 2026003 • Kelas VII-A</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td><span class="badge bg-light-info text-info">Perpustakaan</span></td>
                                    <td>Peminjaman Buku: <em>Tafsir Al-Qur'an Tematik</em> via Scan Barcode</td>
                                    <td><span class="badge bg-info">Dipinjam</span></td>
                                    <td class="text-center">
                                        <a href="{{ route('library.borrow') }}" class="btn btn-sm btn-light-primary py-1 px-2 text-xs">Sirkulasi</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-muted text-xs">08:10 WIB</td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <img src="/assets/images/avatar/avatar-s-4.png" class="rounded-circle" style="width: 28px; height: 28px;">
                                            <div>
                                                <div class="fw-bold">Zaid bin Haritsah</div>
                                                <small class="text-muted">Calon Santri • PSB-2026-004</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td><span class="badge bg-light-primary text-primary">PSB</span></td>
                                    <td>Kelulusan ditetapkan dan santri berhasil diaktivasi menjadi santri aktif</td>
                                    <td><span class="badge bg-primary">Aktif</span></td>
                                    <td class="text-center">
                                        <a href="{{ route('admissions.selection-results') }}" class="btn btn-sm btn-light-primary py-1 px-2 text-xs">Verifikasi</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    // 1. Sparkline chart configurations in Voler Stat Cards
    const sparklineOptions = {
        responsive: true,
        maintainAspectRatio: false,
        layout: { padding: { left: -10, top: 10, bottom: -5, right: -5 } },
        plugins: { legend: { display: false }, tooltip: { enabled: false } },
        scales: {
            x: { display: false },
            y: { display: false }
        },
        elements: { point: { radius: 0 } }
    };

    // Canvas 1 (Santri)
    const ctx1 = document.getElementById("canvas1");
    if (ctx1) {
        new Chart(ctx1, {
            type: "line",
            data: {
                labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul"],
                datasets: [{
                    data: [120, 130, 138, 142, 145, 147, 148],
                    borderColor: "#3245D1",
                    backgroundColor: "rgba(50, 69, 209, 0.1)",
                    fill: true,
                    tension: 0.4
                }]
            },
            options: sparklineOptions
        });
    }

    // Canvas 2 (PSB)
    const ctx2 = document.getElementById("canvas2");
    if (ctx2) {
        new Chart(ctx2, {
            type: "line",
            data: {
                labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul"],
                datasets: [{
                    data: [5, 8, 12, 15, 18, 19, 20],
                    borderColor: "#39DA8A",
                    backgroundColor: "rgba(57, 218, 138, 0.1)",
                    fill: true,
                    tension: 0.4
                }]
            },
            options: sparklineOptions
        });
    }

    // Canvas 3 (Guru)
    const ctx3 = document.getElementById("canvas3");
    if (ctx3) {
        new Chart(ctx3, {
            type: "line",
            data: {
                labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul"],
                datasets: [{
                    data: [9, 9, 10, 10, 10, 10, 10],
                    borderColor: "#00CFDD",
                    backgroundColor: "rgba(0, 207, 221, 0.1)",
                    fill: true,
                    tension: 0.4
                }]
            },
            options: sparklineOptions
        });
    }

    // Canvas 4 (Keuangan)
    const ctx4 = document.getElementById("canvas4");
    if (ctx4) {
        new Chart(ctx4, {
            type: "line",
            data: {
                labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul"],
                datasets: [{
                    data: [45, 55, 62, 70, 78, 81, 84.5],
                    borderColor: "#FDAC41",
                    backgroundColor: "rgba(253, 172, 65, 0.1)",
                    fill: true,
                    tension: 0.4
                }]
            },
            options: sparklineOptions
        });
    }

    // 2. Bar Chart Kehadiran Santri (Chart.js)
    const barCtx = document.getElementById("attendanceBarChart");
    if (barCtx) {
        new Chart(barCtx, {
            type: "bar",
            data: {
                labels: ["Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Ahad"],
                datasets: [
                    {
                        label: "Formal SMP/SMA",
                        backgroundColor: "#00CFDD",
                        borderRadius: 4,
                        data: [98, 97, 99, 96, 95, 98, 0]
                    },
                    {
                        label: "Pengajian Asrama",
                        backgroundColor: "#3245D1",
                        borderRadius: 4,
                        data: [97, 98, 96, 97, 99, 98, 96]
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'top', align: 'end' }
                },
                scales: {
                    y: { min: 80, max: 100 }
                }
            }
        });
    }

    // 3. ApexCharts Donut Distribution
    const distEl = document.querySelector("#chart-santri-distribution");
    if (distEl && typeof ApexCharts !== 'undefined') {
        const distOptions = {
            series: [82, 66],
            labels: ["SMP Terpadu", "SMA Terpadu"],
            chart: {
                type: 'donut',
                height: 220
            },
            colors: ['#1E3A5F', '#00CFDD'],
            legend: { position: 'bottom' },
            dataLabels: { enabled: true }
        };
        const chart = new ApexCharts(distEl, distOptions);
        chart.render();
    }
});
</script>
@endpush
