@extends('layouts.app')

@section('title', 'Portal Santri')

@section('breadcrumb')
<nav aria-label="breadcrumb" class="breadcrumb-header">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.santri') }}">Portal Santri</a></li>
        <li class="breadcrumb-item active" aria-current="page">Kartu & Profil Digital</li>
    </ol>
</nav>
@endsection

@section('page-title')
Portal Santri: Muhammad Pratama
@endsection

@section('page-subtitle')
Assalamu'alaikum, Muhammad Pratama. Berikut kartu digital, agenda belajar, dan status perizinan aktif Anda.
@endsection

@section('page-actions')
<a href="{{ route('dormitory.permissions') }}" class="btn btn-sm btn-primary d-flex align-items-center gap-1">
    <i data-feather="send" style="width: 14px; height: 14px;"></i> Pengajuan Izin Keluar
</a>
@endsection

@section('content')
<section class="section">
    <div class="row mb-4">
        <!-- Digital KTS Card -->
        <div class="col-md-5">
            <div class="card text-white shadow-lg border-0" style="background: linear-gradient(135deg, #1E3A5F 0%, #142842 100%); border-radius: 16px;">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center pb-3 border-bottom border-light border-opacity-25">
                        <div class="d-flex align-items-center gap-2">
                            <div class="p-2 rounded bg-warning text-dark"><i data-feather="shield" style="width: 18px; height: 18px;"></i></div>
                            <div>
                                <small class="text-uppercase fw-bold text-warning d-block" style="font-size: 10px; letter-spacing: 1px;">KARTU SANTRI DIGITAL</small>
                                <span class="text-white-50" style="font-size: 11px;">Al-Hikmah Terpadu</span>
                            </div>
                        </div>
                        <span class="badge bg-success">AKTIF</span>
                    </div>

                    <div class="row align-items-center my-4">
                        <div class="col-4 text-center">
                            <img src="{{ asset('assets/images/avatar/avatar-s-10.png') }}" class="rounded-circle border border-2 border-warning" style="width: 72px; height: 72px; object-fit: cover;" alt="Foto Santri">
                        </div>
                        <div class="col-8">
                            <h5 class="fw-bold mb-1 text-white">Muhammad Pratama</h5>
                            <div class="text-white-50 text-xs">NIS: <strong class="text-white font-monospace">2026001</strong></div>
                            <div class="text-white-50 text-xs">Jenjang: <strong class="text-white">SMA Kelas X-IPA</strong></div>
                            <div class="text-white-50 text-xs">Kamar: <strong class="text-white">Ali bin Abi Thalib - No. 04</strong></div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center pt-3 border-top border-light border-opacity-25">
                        <div>
                            <small class="text-white-50 d-block" style="font-size: 10px;">BERLAKU HINGGA</small>
                            <span class="fw-bold text-white text-xs">30 JUNI 2027</span>
                        </div>
                        <img src="{{ asset('assets/images/qr-sample.svg') }}" class="bg-white p-1 rounded" style="width: 44px; height: 44px;" alt="QR KTS">
                    </div>
                </div>
            </div>
        </div>

        <!-- Status Cepat Santri -->
        <div class="col-md-7">
            <div class="row g-2 mb-3">
                <div class="col-6">
                    <div class="card card-statistic mb-0">
                        <div class="card-body p-3">
                            <small class="text-muted text-uppercase fw-bold" style="font-size: 11px;">TAGIHAN SPP BULAN INI</small>
                            <h4 class="fw-bold text-success mb-0 mt-1">LUNAS</h4>
                            <small class="text-muted" style="font-size: 11px;">Periode Februari 2026</small>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card card-statistic mb-0">
                        <div class="card-body p-3">
                            <small class="text-muted text-uppercase fw-bold" style="font-size: 11px;">BUKU SEDANG DIPINJAM</small>
                            <h4 class="fw-bold text-primary mb-0 mt-1">1 Buku</h4>
                            <small class="text-muted" style="font-size: 11px;">Jatuh tempo: 15 Feb 2026</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Jadwal Pembelajaran Hari Ini -->
            <div class="card mb-0">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Jadwal Pelajaran Hari Ini</h5>
                    <a href="{{ route('academic.schedules') }}" class="text-xs text-primary text-decoration-none">Jadwal Lengkap</a>
                </div>
                <div class="card-body px-0 pb-0">
                    <table class="table table-striped mb-0">
                        <thead>
                            <tr>
                                <th>JAM</th>
                                <th>MATA PELAJARAN</th>
                                <th>USTADZ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-muted text-xs">07:30 - 09:00</td>
                                <td class="fw-bold">Fikih Ibadah</td>
                                <td>Ust. Abdurrahman</td>
                            </tr>
                            <tr>
                                <td class="text-muted text-xs">09:15 - 10:45</td>
                                <td class="fw-bold">Bahasa Arab & Sharaf</td>
                                <td>Ust. Salman Al-Farisi</td>
                            </tr>
                            <tr>
                                <td class="text-muted text-xs">11:00 - 12:00</td>
                                <td class="fw-bold">Matematika Wajib</td>
                                <td>Ustdzh. Nurul Hidayah</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
