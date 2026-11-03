@extends('layouts.app')

@section('title', 'Jadwal Kegiatan Pesantren')

@section('page-title')
Jadwal Kegiatan Diniyah & Halaqah Pesantren
@endsection

@section('page-subtitle')
Jadwal shalat berjamaah, setoran tahfidz Al-Qur'an, dan kajian kitab kuning asrama harian.
@endsection

@section('page-actions')
<button type="button" class="btn btn-primary d-inline-flex align-items-center gap-2">
    <i data-feather="plus" style="width: 16px; height: 16px;"></i>
    <span>Tambah Agenda Asrama</span>
</button>
@endsection

@section('content')
<section class="section">
    <!-- JADWAL KEGIATAN HARIAN ASRAMA -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>
                <h4 class="card-title mb-0">Rutinitas Harian Kehidupan Santri di Asrama</h4>
                <p class="text-muted text-sm mb-0">Jadwal baku kegiatan harian dari bangun tidur hingga istirahat malam santri.</p>
            </div>
            <span class="badge bg-light-success text-success">T.A 2026/2027 Aktif</span>
        </div>
        <div class="card-body">
            <table class="table table-striped" id="tableActivities">
                <thead>
                    <tr>
                        <th>WAKTU</th>
                        <th>NAMA KEGIATAN</th>
                        <th>LOKASI / TEMPAT</th>
                        <th>KATEGORI</th>
                        <th>PENGASUH / PEMBINA</th>
                        <th>SIFAT KEGIATAN</th>
                        <th class="text-center">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><span class="badge bg-primary font-monospace py-2 px-3">04:00 - 05:30</span></td>
                        <td>
                            <div class="fw-bold text-dark">Qiyamul Lail, Shalat Subuh & Halaqah Tahfidz Pagi</div>
                            <small class="text-muted">Setoran hafalan baru (Ziyadah) & Muraja'ah bersama musyrif</small>
                        </td>
                        <td><span class="badge bg-light text-dark">Masjid Jami' Pesantren</span></td>
                        <td><span class="badge bg-light-primary text-primary">Diniyah & Tahfidz</span></td>
                        <td>Musyrif Halaqah & Asatidz</td>
                        <td><span class="badge bg-danger">Wajib Mutlak</span></td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-outline-secondary py-1 px-2">Edit</button>
                        </td>
                    </tr>
                    <tr>
                        <td><span class="badge bg-secondary font-monospace py-2 px-3">05:30 - 06:45</span></td>
                        <td>
                            <div class="fw-bold text-dark">Makan Pagi, Piket Kebersihan & Mandi</div>
                            <small class="text-muted">Sarapan sehat di ruang makan asrama dan persiapan sekolah</small>
                        </td>
                        <td><span class="badge bg-light text-dark">Kantin & Asrama Santri</span></td>
                        <td><span class="badge bg-light-secondary text-secondary">Kedisiplinan</span></td>
                        <td>Ketua Kamar & Tim Keamanan</td>
                        <td><span class="badge bg-info">Rutin</span></td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-outline-secondary py-1 px-2">Edit</button>
                        </td>
                    </tr>
                    <tr>
                        <td><span class="badge bg-primary font-monospace py-2 px-3">07:15 - 12:15</span></td>
                        <td>
                            <div class="fw-bold text-dark">Pendidikan Formal Madrasah (KBM)</div>
                            <small class="text-muted">Kurikulum terpadu Kemendikbud & Kemenag</small>
                        </td>
                        <td><span class="badge bg-light text-dark">Gedung Pembelajaran Formal</span></td>
                        <td><span class="badge bg-light-info text-info">Akademik Formal</span></td>
                        <td>Dewan Guru Madrasah</td>
                        <td><span class="badge bg-danger">Wajib Mutlak</span></td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-outline-secondary py-1 px-2">Edit</button>
                        </td>
                    </tr>
                    <tr>
                        <td><span class="badge bg-primary font-monospace py-2 px-3">12:15 - 13:30</span></td>
                        <td>
                            <div class="fw-bold text-dark">Shalat Zhuhur Berjamaah & Qailulah</div>
                            <small class="text-muted">Tidur siang sunnah (15-30 menit) dan makan siang santri</small>
                        </td>
                        <td><span class="badge bg-light text-dark">Masjid Jami' & Kamar</span></td>
                        <td><span class="badge bg-light-primary text-primary">Ibadah & Rehat</span></td>
                        <td>Pengasuh Piket Asrama</td>
                        <td><span class="badge bg-danger">Wajib Shalat</span></td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-outline-secondary py-1 px-2">Edit</button>
                        </td>
                    </tr>
                    <tr>
                        <td><span class="badge bg-primary font-monospace py-2 px-3">15:30 - 17:00</span></td>
                        <td>
                            <div class="fw-bold text-dark">Shalat Ashar & Olahraga Sore / Ekstrakurikuler</div>
                            <small class="text-muted">Futsal, panahan, bela diri Tapak Suci, dan pramuka santri</small>
                        </td>
                        <td><span class="badge bg-light text-dark">Lapangan Olahraga Utama</span></td>
                        <td><span class="badge bg-light-success text-success">Pengembangan Diri</span></td>
                        <td>Pembina Ekstrakurikuler</td>
                        <td><span class="badge bg-warning">Pilihan Wajib</span></td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-outline-secondary py-1 px-2">Edit</button>
                        </td>
                    </tr>
                    <tr>
                        <td><span class="badge bg-primary font-monospace py-2 px-3">18:00 - 19:45</span></td>
                        <td>
                            <div class="fw-bold text-dark">Kajian Kitab Kuning & Halaqah Ba'da Maghrib</div>
                            <small class="text-muted">Kajian Kitab Fathul Qorib, Ta'lim Muta'allim, dan Riyadush Shalihin</small>
                        </td>
                        <td><span class="badge bg-light text-dark">Serambi Masjid Jami'</span></td>
                        <td><span class="badge bg-light-purple text-purple" style="color: #6f42c1; background-color: #f3e8ff;">Tafaqquh Fiddin</span></td>
                        <td>K.H. Mustofa & Ustadz Senior</td>
                        <td><span class="badge bg-danger">Wajib Mutlak</span></td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-outline-secondary py-1 px-2">Edit</button>
                        </td>
                    </tr>
                    <tr>
                        <td><span class="badge bg-primary font-monospace py-2 px-3">20:00 - 21:30</span></td>
                        <td>
                            <div class="fw-bold text-dark">Belajar Mandiri Malam (Muajjah) & Muraja'ah</div>
                            <small class="text-muted">Mengulang pelajaran sekolah dan menghafal mufrodat / kosa kata</small>
                        </td>
                        <td><span class="badge bg-light text-dark">Ruang Belajar Asrama</span></td>
                        <td><span class="badge bg-light-info text-info">Belajar Terbimbing</span></td>
                        <td>Tutor Sebaya & Pembina Asrama</td>
                        <td><span class="badge bg-danger">Wajib</span></td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-outline-secondary py-1 px-2">Edit</button>
                        </td>
                    </tr>
                    <tr>
                        <td><span class="badge bg-secondary font-monospace py-2 px-3">22:00 - 03:45</span></td>
                        <td>
                            <div class="fw-bold text-dark">Jam Malam, Pintu Gerbang Ditutup & Istirahat</div>
                            <small class="text-muted">Pemadaman lampu kamar asrama untuk istirahat malam teratur</small>
                        </td>
                        <td><span class="badge bg-light text-dark">Seluruh Kamar Asrama</span></td>
                        <td><span class="badge bg-light-secondary text-secondary">Kedisiplinan & Keamanan</span></td>
                        <td>Satpam & Pembina Piket</td>
                        <td><span class="badge bg-dark">Tertib Malam</span></td>
                        <td class="text-center">-</td>
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
        let table = document.querySelector('#tableActivities');
        if (table && typeof simpleDatatables !== 'undefined') {
            new simpleDatatables.DataTable(table, {
                searchable: true,
                fixedHeight: false,
                perPage: 10,
                labels: {
                    placeholder: "Cari jadwal kegiatan, waktu, ustadz...",
                    perPage: "{select} entri per halaman",
                    noRows: "Tidak ada jadwal kegiatan ditemukan",
                    info: "Menampilkan {start} sampai {end} dari {rows} kegiatan"
                }
            });
        }
    });
</script>
@endpush
