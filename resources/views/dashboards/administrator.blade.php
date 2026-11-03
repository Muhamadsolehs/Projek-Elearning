@extends('layouts.app')

@section('title', 'Dashboard Administrator')

@section('breadcrumb')
<nav aria-label="breadcrumb" class="breadcrumb-header">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.super-admin') }}">SIM Pesantren</a></li>
        <li class="breadcrumb-item active" aria-current="page">Dashboard Administrator</li>
    </ol>
</nav>
@endsection

@section('page-title')
Dashboard Administrasi & Data Induk
@endsection

@section('page-subtitle')
Selamat datang, Ustadz H. Syarif Hidayatullah, S.T. Ikhtisar data induk santri, wali santri, pendidik, dan fasilitas asrama.
@endsection

@section('page-actions')
<a href="{{ route('students.create') }}" class="btn btn-sm btn-primary d-flex align-items-center gap-1">
    <i data-feather="plus" style="width: 14px; height: 14px;"></i> Tambah Santri
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
                            <h3 class="card-title text-uppercase mb-0 text-muted" style="font-size: 0.85rem;">SANTRI TERDATA</h3>
                            <div class="card-right d-flex align-items-center">
                                <p class="fs-4 fw-bold mb-0 text-primary">150</p>
                            </div>
                        </div>
                        <div class="px-3 pb-3 text-xs text-muted">
                            148 Aktif • 1 Alumni • 1 Mutasi
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
                            <h3 class="card-title text-uppercase mb-0 text-muted" style="font-size: 0.85rem;">WALI SANTRI</h3>
                            <div class="card-right d-flex align-items-center">
                                <p class="fs-4 fw-bold mb-0 text-success">138</p>
                            </div>
                        </div>
                        <div class="px-3 pb-3 text-xs text-muted">
                            100% Memiliki Kontak Aktif
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
                        <div class="px-3 pb-3 text-xs text-muted">
                            100% Terdistribusi Mengajar
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
                            <h3 class="card-title text-uppercase mb-0 text-muted" style="font-size: 0.85rem;">KAMAR ASRAMA</h3>
                            <div class="card-right d-flex align-items-center">
                                <p class="fs-4 fw-bold mb-0 text-warning">18</p>
                            </div>
                        </div>
                        <div class="px-3 pb-3 text-xs text-muted">
                            3 Gedung • Okupansi 92.5%
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Master Data Management Tables & Cards -->
    <div class="row mb-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Daftar Santri Terbaru (Administrasi Master)</h4>
                    <a href="{{ route('students.index') }}" class="btn btn-sm btn-outline-primary">Lihat 150 Santri</a>
                </div>
                <div class="card-body px-0 pb-0">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>NAMA SANTRI</th>
                                    <th>NIS</th>
                                    <th>ROMBEL</th>
                                    <th>ASRAMA</th>
                                    <th>STATUS</th>
                                    <th class="text-center">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(array_slice($students, 0, 5) as $s)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <img src="{{ $s['avatar'] }}" class="rounded-circle border" style="width: 28px; height: 28px;">
                                            <span class="fw-bold text-dark">{{ $s['name'] }}</span>
                                        </div>
                                    </td>
                                    <td><span class="badge bg-light text-dark fw-bold font-monospace">{{ $s['nis'] }}</span></td>
                                    <td><span class="badge bg-primary">{{ $s['class'] }}</span></td>
                                    <td class="text-muted">{{ $s['dorm'] }}</td>
                                    <td><span class="badge bg-success">{{ $s['status'] }}</span></td>
                                    <td class="text-center">
                                        <a href="{{ route('students.show', $s['id']) }}" class="btn btn-sm btn-light-primary py-1 px-2 text-xs">Detail 360°</a>
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
            <!-- Rombongan Belajar Card -->
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Rombongan Belajar (Rombel)</h4>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush text-xs">
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-2">
                            <span>SMP Kelas VII-A</span>
                            <span class="badge bg-primary">28 Santri</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-2">
                            <span>SMP Kelas VII-B</span>
                            <span class="badge bg-primary">27 Santri</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-2">
                            <span>SMP Kelas VIII-A</span>
                            <span class="badge bg-info">27 Santri</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-2">
                            <span>SMA Kelas X-IPA</span>
                            <span class="badge bg-success">32 Santri</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-2">
                            <span>SMA Kelas XI-IPA</span>
                            <span class="badge bg-success">34 Santri</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Ringkasan Dokumen Santri -->
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Kelengkapan Berkas Santri</h4>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <div class="d-flex justify-content-between text-xs mb-1">
                            <span>Kartu Keluarga (KK)</span>
                            <span class="fw-bold">148 / 150</span>
                        </div>
                        <div class="progress progress-primary progress-sm">
                            <div class="progress-bar" style="width: 98%"></div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between text-xs mb-1">
                            <span>Akta Kelahiran</span>
                            <span class="fw-bold">145 / 150</span>
                        </div>
                        <div class="progress progress-success progress-sm">
                            <div class="progress-bar" style="width: 96%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="d-flex justify-content-between text-xs mb-1">
                            <span>Ijazah / SKL Terakhir</span>
                            <span class="fw-bold">140 / 150</span>
                        </div>
                        <div class="progress progress-warning progress-sm">
                            <div class="progress-bar" style="width: 93%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
