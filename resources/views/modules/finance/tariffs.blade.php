@extends('layouts.app')

@section('title', 'Pos Tarif Pembayaran')

@section('page-title')
Master Pos Tarif & Biaya Pendidikan
@endsection

@section('page-subtitle')
Pengaturan jenis tagihan, nominal tarif baku, dan jadwal siklus tagihan santri.
@endsection

@section('page-actions')
<button type="button" 
        class="btn btn-primary d-inline-flex align-items-center gap-2">
    <i data-feather="plus" style="width: 16px; height: 16px;"></i>
    <span>Tambah Pos Tarif Baru</span>
</button>
@endsection

@section('content')
<section class="section">
    <!-- CARDS RINGKASAN TARIF -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <span class="badge bg-light-primary text-primary mb-2">Bulanan (SPP)</span>
                    <h5 class="fw-bold text-dark mb-1">SPP & Uang Makan Santri</h5>
                    <p class="text-muted text-sm mb-3">Biaya operasional pendidikan dan 3x makan santri setiap hari.</p>
                    <div class="pt-2 border-top d-flex justify-content-between align-items-center">
                        <small class="text-muted">Nominal Standar:</small>
                        <span class="fw-bold text-primary fs-6">Rp 1.250.000 / bln</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <span class="badge bg-light-success text-success mb-2">Tahunan (Pangkal)</span>
                    <h5 class="fw-bold text-dark mb-1">Uang Masuk & Sarana Asrama</h5>
                    <p class="text-muted text-sm mb-3">Biaya sarana prasarana asrama, ranjang, kasur, dan seragam awal masuk.</p>
                    <div class="pt-2 border-top d-flex justify-content-between align-items-center">
                        <small class="text-muted">Nominal Standar:</small>
                        <span class="fw-bold text-success fs-6">Rp 4.500.000</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <span class="badge bg-light-warning text-warning mb-2">Per Semester</span>
                    <h5 class="fw-bold text-dark mb-1">Biaya Ujian & Kegiatan Santri</h5>
                    <p class="text-muted text-sm mb-3">Biaya naskah ujian PTS/PAS, munaqosyah tahfidz, dan ekstrakurikuler.</p>
                    <div class="pt-2 border-top d-flex justify-content-between align-items-center">
                        <small class="text-muted">Nominal Standar:</small>
                        <span class="fw-bold text-warning fs-6">Rp 350.000 / smt</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- TABEL MASTER POS TARIF -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title mb-0">Tabel Konfigurasi Master Pos Tarif</h4>
            <span class="badge bg-light-primary text-primary">5 Pos Tarif Aktif</span>
        </div>
        <div class="card-body">
            <table class="table table-striped" id="tableTariffs">
                <thead>
                    <tr>
                        <th>KODE TARIF</th>
                        <th>NAMA POS TARIF</th>
                        <th>SIKLUS TAGIHAN</th>
                        <th>JENIS PESANTREN</th>
                        <th>NOMINAL BAKU</th>
                        <th>STATUS</th>
                        <th class="text-center">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><span class="badge bg-light text-dark font-monospace fw-bold">TRF-SPP-01</span></td>
                        <td>
                            <div class="fw-bold text-dark">SPP & Uang Makan Reguler</div>
                            <small class="text-muted">Biaya makan 3x sehari + SPP KBM</small>
                        </td>
                        <td><span class="badge bg-light-info text-info">Bulanan (Tiap Tgl 10)</span></td>
                        <td>Semua Jenjang (SMP/SMA)</td>
                        <td><span class="fw-bold text-primary">Rp 1.250.000</span></td>
                        <td><span class="badge bg-success">Aktif</span></td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-outline-secondary py-1 px-2">Edit Tarif</button>
                        </td>
                    </tr>
                    <tr>
                        <td><span class="badge bg-light text-dark font-monospace fw-bold">TRF-PNG-01</span></td>
                        <td>
                            <div class="fw-bold text-dark">Uang Pangkal & Sarana Masuk</div>
                            <small class="text-muted">Fasilitas ranjang, lemari, seragam 3 stel</small>
                        </td>
                        <td><span class="badge bg-light-success text-success">Satu Kali di Awal</span></td>
                        <td>Santri Baru (PSB)</td>
                        <td><span class="fw-bold text-primary">Rp 4.500.000</span></td>
                        <td><span class="badge bg-success">Aktif</span></td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-outline-secondary py-1 px-2">Edit Tarif</button>
                        </td>
                    </tr>
                    <tr>
                        <td><span class="badge bg-light text-dark font-monospace fw-bold">TRF-UJN-01</span></td>
                        <td>
                            <div class="fw-bold text-dark">Biaya Ujian & Evaluasi Akademik</div>
                            <small class="text-muted">Penggandaan soal CBT/kertas & sertifikat</small>
                        </td>
                        <td><span class="badge bg-light-warning text-warning">Per Semester</span></td>
                        <td>Semua Jenjang</td>
                        <td><span class="fw-bold text-primary">Rp 350.000</span></td>
                        <td><span class="badge bg-success">Aktif</span></td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-outline-secondary py-1 px-2">Edit Tarif</button>
                        </td>
                    </tr>
                    <tr>
                        <td><span class="badge bg-light text-dark font-monospace fw-bold">TRF-THF-01</span></td>
                        <td>
                            <div class="fw-bold text-dark">Munaqosyah & Sertifikasi Tahfidz</div>
                            <small class="text-muted">Ujian tahfidz 5/10/30 juz bersanad</small>
                        </td>
                        <td><span class="badge bg-light-secondary text-secondary">Insidental</span></td>
                        <td>Program Khusus Tahfidz</td>
                        <td><span class="fw-bold text-primary">Rp 200.000</span></td>
                        <td><span class="badge bg-success">Aktif</span></td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-outline-secondary py-1 px-2">Edit Tarif</button>
                        </td>
                    </tr>
                    <tr>
                        <td><span class="badge bg-light text-dark font-monospace fw-bold">TRF-EKS-01</span></td>
                        <td>
                            <div class="fw-bold text-dark">Iuran Ekstrakurikuler Wajib</div>
                            <small class="text-muted">Pramuka, Tapak Suci, & Panahan</small>
                        </td>
                        <td><span class="badge bg-light-info text-info">Bulanan</span></td>
                        <td>Santri Kelas VII & X</td>
                        <td><span class="fw-bold text-primary">Rp 50.000</span></td>
                        <td><span class="badge bg-success">Aktif</span></td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-outline-secondary py-1 px-2">Edit Tarif</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        let table = document.querySelector('#tableTariffs');
        if (table && typeof simpleDatatables !== 'undefined') {
            new simpleDatatables.DataTable(table, {
                searchable: true,
                fixedHeight: false,
                perPage: 10,
                perPageSelect: [5, 10, 20],
                labels: {
                    placeholder: "Cari tarif, kode, siklus...",
                    perPage: "{select} entri per halaman",
                    noRows: "Tidak ada pos tarif ditemukan",
                    info: "Menampilkan {start} sampai {end} dari {rows} tarif"
                }
            });
        }
    });
</script>
@endpush
