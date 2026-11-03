@extends('layouts.app')

@section('title', 'Matriks Role & Hak Akses (RBAC)')

@section('page-title')
Matriks Hak Akses & Role-Based Access Control (RBAC)
@endsection

@section('page-subtitle')
Aturan hak akses granular untuk 11 peran pengguna sesuai dengan prinsip pemisahan tanggung jawab institusi.
@endsection

@section('page-actions')
<button type="button" 
        class="btn btn-primary d-inline-flex align-items-center gap-2">
    <i data-feather="save" style="width: 16px; height: 16px;"></i>
    <span>Simpan Perubahan RBAC</span>
</button>
@endsection

@section('content')
<section class="section">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>
                <h4 class="card-title mb-0">Matriks Hak Akses Modul Aplikasi SIM-Pesantren</h4>
                <p class="text-muted text-sm mb-0">Keterangan: <strong>CRUD</strong> = Buat, Baca, Ubah, Hapus | <strong>R</strong> = Hanya Lihat (Read-Only) | <strong>-</strong> = Tidak Ada Akses</p>
            </div>
            <span class="badge bg-light-primary text-primary">11 Peran Pengguna</span>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle mb-0" style="font-size: 0.82rem;">
                    <thead class="table-light">
                        <tr class="text-center text-uppercase font-semibold">
                            <th class="text-start" style="min-width: 200px;">Modul Aplikasi</th>
                            <th>Super Admin</th>
                            <th>Admin Pesantren</th>
                            <th>Admin PSB</th>
                            <th>Admin Akad</th>
                            <th>Guru</th>
                            <th>Wali Kelas</th>
                            <th>Keasramaan</th>
                            <th>Keuangan</th>
                            <th>Perpus</th>
                            <th>Santri</th>
                            <th>Wali Santri</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="fw-bold text-dark">1. Master Santri & Profil 360°</td>
                            <td class="text-center"><span class="badge bg-success">CRUD</span></td>
                            <td class="text-center"><span class="badge bg-success">CRUD</span></td>
                            <td class="text-center text-muted">R (Calon)</td>
                            <td class="text-center"><span class="badge bg-light-info text-info">R</span></td>
                            <td class="text-center text-muted">R (Binaan)</td>
                            <td class="text-center text-muted">R (Kelas)</td>
                            <td class="text-center text-muted">R (Asrama)</td>
                            <td class="text-center"><span class="badge bg-light-info text-info">R</span></td>
                            <td class="text-center"><span class="badge bg-light-info text-info">R (KTS)</span></td>
                            <td class="text-center text-muted">R (Pribadi)</td>
                            <td class="text-center text-muted">R (Anak)</td>
                        </tr>

                        <tr>
                            <td class="fw-bold text-dark">2. Penerimaan Santri Baru (PSB)</td>
                            <td class="text-center"><span class="badge bg-success">CRUD</span></td>
                            <td class="text-center"><span class="badge bg-light-info text-info">R</span></td>
                            <td class="text-center"><span class="badge bg-success">CRUD + Aktif</span></td>
                            <td class="text-center text-muted">-</td>
                            <td class="text-center text-muted">-</td>
                            <td class="text-center text-muted">-</td>
                            <td class="text-center text-muted">-</td>
                            <td class="text-center text-muted">R (Biaya)</td>
                            <td class="text-center text-muted">-</td>
                            <td class="text-center text-muted">-</td>
                            <td class="text-center text-muted">-</td>
                        </tr>

                        <tr>
                            <td class="fw-bold text-dark">3. Jadwal & Presensi Formal</td>
                            <td class="text-center"><span class="badge bg-success">CRUD</span></td>
                            <td class="text-center"><span class="badge bg-light-info text-info">R</span></td>
                            <td class="text-center text-muted">-</td>
                            <td class="text-center"><span class="badge bg-success">CRUD</span></td>
                            <td class="text-center"><span class="badge bg-primary">CRU</span></td>
                            <td class="text-center"><span class="badge bg-light-info text-info">R (Rekap)</span></td>
                            <td class="text-center text-muted">-</td>
                            <td class="text-center text-muted">-</td>
                            <td class="text-center text-muted">-</td>
                            <td class="text-center text-muted">R (Pribadi)</td>
                            <td class="text-center text-muted">R (Anak)</td>
                        </tr>

                        <tr>
                            <td class="fw-bold text-dark">4. Keasramaan & Perizinan Keluar</td>
                            <td class="text-center"><span class="badge bg-success">CRUD</span></td>
                            <td class="text-center"><span class="badge bg-light-info text-info">R</span></td>
                            <td class="text-center text-muted">-</td>
                            <td class="text-center text-muted">-</td>
                            <td class="text-center text-muted">-</td>
                            <td class="text-center"><span class="badge bg-light-info text-info">R</span></td>
                            <td class="text-center"><span class="badge bg-success">CRUD + Approval</span></td>
                            <td class="text-center text-muted">-</td>
                            <td class="text-center text-muted">-</td>
                            <td class="text-center text-warning fw-bold">C (Ajukan)</td>
                            <td class="text-center text-warning fw-bold">C (Ajukan)</td>
                        </tr>

                        <tr>
                            <td class="fw-bold text-dark">5. Keuangan, SPP & Kasir POS</td>
                            <td class="text-center"><span class="badge bg-success">CRUD</span></td>
                            <td class="text-center"><span class="badge bg-light-info text-info">R</span></td>
                            <td class="text-center text-muted">-</td>
                            <td class="text-center text-muted">-</td>
                            <td class="text-center text-muted">-</td>
                            <td class="text-center text-muted">-</td>
                            <td class="text-center text-muted">-</td>
                            <td class="text-center"><span class="badge bg-success">CRUD + Kuitansi</span></td>
                            <td class="text-center text-muted">-</td>
                            <td class="text-center"><span class="badge bg-light-info text-info">R</span></td>
                            <td class="text-center text-primary fw-bold">R + Bayar</td>
                        </tr>

                        <tr>
                            <td class="fw-bold text-dark">6. Perpustakaan & Sirkulasi QR</td>
                            <td class="text-center"><span class="badge bg-success">CRUD</span></td>
                            <td class="text-center"><span class="badge bg-light-info text-info">R</span></td>
                            <td class="text-center text-muted">-</td>
                            <td class="text-center text-muted">-</td>
                            <td class="text-center text-muted">-</td>
                            <td class="text-center text-muted">-</td>
                            <td class="text-center text-muted">-</td>
                            <td class="text-center text-muted">-</td>
                            <td class="text-center"><span class="badge bg-success">CRUD + Scanner</span></td>
                            <td class="text-center text-muted">R (Pinjaman)</td>
                            <td class="text-center text-muted">R</td>
                        </tr>

                        <tr>
                            <td class="fw-bold text-dark">7. Manajemen Pengguna & Audit Trail</td>
                            <td class="text-center"><span class="badge bg-success">CRUD</span></td>
                            <td class="text-center"><span class="badge bg-light-info text-info">R</span></td>
                            <td class="text-center text-muted">-</td>
                            <td class="text-center text-muted">-</td>
                            <td class="text-center text-muted">-</td>
                            <td class="text-center text-muted">-</td>
                            <td class="text-center text-muted">-</td>
                            <td class="text-center text-muted">-</td>
                            <td class="text-center text-muted">-</td>
                            <td class="text-center text-muted">-</td>
                            <td class="text-center text-muted">-</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection
