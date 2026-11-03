@extends('layouts.app')

@section('title', 'Portal Wali Santri')

@section('breadcrumb')
<nav aria-label="breadcrumb" class="breadcrumb-header">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.wali-santri') }}">Portal Wali</a></li>
        <li class="breadcrumb-item active" aria-current="page">Monitoring Perkembangan Ananda</li>
    </ol>
</nav>
@endsection

@section('page-title')
Portal Wali: H. Bambang Pratama, S.E.
@endsection

@section('page-subtitle')
Assalamu'alaikum Warahmatullahi Wabarakatuh. Pantau seluruh proses pendidikan, kehadiran, kesehatan, dan tagihan ananda tercinta.
@endsection

@section('page-actions')
<a href="{{ route('finance.bills') }}" class="btn btn-sm btn-success d-flex align-items-center gap-1">
    <i data-feather="credit-card" style="width: 14px; height: 14px;"></i> Bayar SPP Ananda
</a>
@endsection

@section('content')
<section class="section" x-data="{
    selectedChild: 'Muhammad Pratama',
    children: [
        { name: 'Muhammad Pratama', nis: '2026001', level: 'SMA', class: 'Kelas X-IPA', dorm: 'Gedung Ali bin Abi Thalib / Kmr 04', attendance: '98.5%', quranProgress: 'Juz 30 (Selesai Ujian)', billStatus: 'Lunas (Februari 2026)' },
        { name: 'Aisyah Pratama', nis: '2026002', level: 'SMP', class: 'Kelas VII-B', dorm: 'Gedung Aisyah / Kmr 02', attendance: '99.2%', quranProgress: 'Juz 29 (Sedang Ziyadah)', billStatus: 'Lunas (Februari 2026)' }
    ]
}">
    <!-- Multi-child Switcher Card -->
    <div class="card mb-4">
        <div class="card-body d-flex flex-column flex-sm-row justify-content-between align-items-center gap-3">
            <div class="d-flex align-items-center gap-3">
                <div class="p-2 rounded bg-light-primary text-primary"><i data-feather="heart" style="width: 24px; height: 24px;"></i></div>
                <div>
                    <small class="text-uppercase fw-bold text-muted" style="font-size: 11px;">PILIH ANANDA YANG DIPANTAU:</small>
                    <h5 class="mb-0 fw-bold text-dark" x-text="selectedChild"></h5>
                </div>
            </div>
            <div class="btn-group">
                <template x-for="child in children" :key="child.name">
                    <button type="button" 
                            @click="selectedChild = child.name" 
                            class="btn btn-sm" 
                            :class="selectedChild === child.name ? 'btn-primary' : 'btn-outline-primary'"
                            x-text="child.name">
                    </button>
                </template>
            </div>
        </div>
    </div>

    <!-- 4 Quick Stats -->
    <div class="row mb-2">
        <div class="col-12 col-md-3">
            <div class="card card-statistic">
                <div class="card-body p-0">
                    <div class="d-flex flex-column">
                        <div class="px-3 py-3 d-flex justify-content-between align-items-center">
                            <h3 class="card-title text-uppercase mb-0 text-muted" style="font-size: 0.85rem;">KEHADIRAN BULANAN</h3>
                            <div class="card-right d-flex align-items-center">
                                <p class="fs-4 fw-bold mb-0 text-success">98.5%</p>
                            </div>
                        </div>
                        <div class="px-3 pb-3 text-xs text-muted">Hadir Penuh Shalat & Kelas</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-3">
            <div class="card card-statistic">
                <div class="card-body p-0">
                    <div class="d-flex flex-column">
                        <div class="px-3 py-3 d-flex justify-content-between align-items-center">
                            <h3 class="card-title text-uppercase mb-0 text-muted" style="font-size: 0.85rem;">PROGRESS TAHFIDZ</h3>
                            <div class="card-right d-flex align-items-center">
                                <p class="fs-4 fw-bold mb-0 text-primary">Juz 30</p>
                            </div>
                        </div>
                        <div class="px-3 pb-3 text-xs text-muted">Predikat Mumtaz (Lulus Ujian)</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-3">
            <div class="card card-statistic">
                <div class="card-body p-0">
                    <div class="d-flex flex-column">
                        <div class="px-3 py-3 d-flex justify-content-between align-items-center">
                            <h3 class="card-title text-uppercase mb-0 text-muted" style="font-size: 0.85rem;">STATUS SPP</h3>
                            <div class="card-right d-flex align-items-center">
                                <p class="fs-4 fw-bold mb-0 text-success">LUNAS</p>
                            </div>
                        </div>
                        <div class="px-3 pb-3 text-xs text-muted">Bulan Februari 2026</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-3">
            <div class="card card-statistic">
                <div class="card-body p-0">
                    <div class="d-flex flex-column">
                        <div class="px-3 py-3 d-flex justify-content-between align-items-center">
                            <h3 class="card-title text-uppercase mb-0 text-muted" style="font-size: 0.85rem;">KESEHATAN ANANDA</h3>
                            <div class="card-right d-flex align-items-center">
                                <p class="fs-4 fw-bold mb-0 text-info">SEHAT</p>
                            </div>
                        </div>
                        <div class="px-3 pb-3 text-xs text-muted">Pemeriksaan Poskestren Rutin</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Aktivitas Terakhir & Riwayat Izin -->
    <div class="row mb-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Riwayat Perizinan & Kehadiran Ananda</h5>
                    <a href="{{ route('dormitory.permissions') }}" class="btn btn-sm btn-outline-primary">Ajukan Izin Penjemputan</a>
                </div>
                <div class="card-body px-0 pb-0">
                    <table class="table table-striped mb-0">
                        <thead>
                            <tr>
                                <th>TANGGAL</th>
                                <th>JENIS IZIN</th>
                                <th>KEPERLUAN</th>
                                <th>STATUS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-muted text-xs">28 Jan 2026</td>
                                <td><span class="badge bg-light text-dark">Izin Sambangan</span></td>
                                <td>Kunjungan keluarga di saung pesantren</td>
                                <td><span class="badge bg-success">Selesai</span></td>
                            </tr>
                            <tr>
                                <td class="text-muted text-xs">15 Jan 2026</td>
                                <td><span class="badge bg-light text-dark">Izin Berobat</span></td>
                                <td>Pemeriksaan dokter gigi didampingi wali</td>
                                <td><span class="badge bg-success">Kembali Tepat Waktu</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <!-- Informasi Wali Kelas Card -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Kontak Wali Kelas & Pengasuh</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <img src="/assets/images/avatar/avatar-s-1.png" class="rounded-circle" style="width: 44px; height: 44px;">
                        <div>
                            <div class="fw-bold">Ust. Ahmad Syarif, M.Pd</div>
                            <small class="text-muted d-block">Wali Kelas X-IPA</small>
                            <small class="text-primary font-monospace">+62 812-3456-7890</small>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-3">
                        <img src="/assets/images/avatar/avatar-s-2.png" class="rounded-circle" style="width: 44px; height: 44px;">
                        <div>
                            <div class="fw-bold">Ust. Ridwan Hakim</div>
                            <small class="text-muted d-block">Kepala Asrama Putra</small>
                            <small class="text-primary font-monospace">+62 813-9876-5432</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
