@extends('layouts.app')

@section('title', 'Jadwal Pelajaran Formal')

@section('page-title')
Matriks Jadwal Pelajaran Mingguan
@endsection

@section('page-subtitle')
Jadwal kegiatan belajar mengajar (KBM) pendidikan formal pesantren semester ganjil T.A 2026/2027.
@endsection

@section('page-actions')
<button type="button" class="btn btn-primary d-inline-flex align-items-center gap-2">
    <i data-feather="plus" style="width: 16px; height: 16px;"></i>
    <span>Tambah Jadwal Sesi</span>
</button>
@endsection

@section('content')
<section class="section">
    <!-- SELECTOR KELAS & HARI -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-md-4 mb-3 mb-md-0">
                    <label class="form-label fw-bold text-muted small">PILIH KELAS / ROMBEL</label>
                    <select class="form-select" id="selectClass">
                        @foreach($classes as $c)
                        <option value="{{ $c['id'] }}">{{ $c['name'] }} (Wali: {{ $c['homeroom'] ?? '-' }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-8">
                    <label class="form-label fw-bold text-muted small">PILIH HARI PEMBELAJARAN</label>
                    <div class="btn-group w-100 flex-wrap" role="group">
                        <input type="radio" class="btn-check" name="dayRadio" id="daySenin" checked>
                        <label class="btn btn-outline-primary" for="daySenin">Senin</label>

                        <input type="radio" class="btn-check" name="dayRadio" id="daySelasa">
                        <label class="btn btn-outline-primary" for="daySelasa">Selasa</label>

                        <input type="radio" class="btn-check" name="dayRadio" id="dayRabu">
                        <label class="btn btn-outline-primary" for="dayRabu">Rabu</label>

                        <input type="radio" class="btn-check" name="dayRadio" id="dayKamis">
                        <label class="btn btn-outline-primary" for="dayKamis">Kamis</label>

                        <input type="radio" class="btn-check" name="dayRadio" id="daySabtu">
                        <label class="btn btn-outline-primary" for="daySabtu">Sabtu</label>

                        <input type="radio" class="btn-check" name="dayRadio" id="dayAhad">
                        <label class="btn btn-outline-primary" for="dayAhad">Ahad</label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- TABEL JADWAL SESI MATRIKS CARD -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>
                <h4 class="card-title mb-0">Jadwal Sesi Pembelajaran Aktif</h4>
                <small class="text-muted">Jadwal harian berdasarkan jam pelajaran formal di madrasah.</small>
            </div>
            <span class="badge bg-light-success text-success">Semester Ganjil 2026/2027</span>
        </div>
        <div class="card-body">
            <table class="table table-striped" id="tableSchedules">
                <thead>
                    <tr>
                        <th>JAM / WAKTU</th>
                        <th>SESI</th>
                        <th>MATA PELAJARAN</th>
                        <th>USTADZ / GURU PENGAMPU</th>
                        <th>RUANG KELAS</th>
                        <th>STATUS</th>
                        <th class="text-center">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><span class="badge bg-primary font-monospace py-2 px-3">07:30 - 09:00</span></td>
                        <td><span class="badge bg-light-primary text-primary">Sesi 1 (2 JP)</span></td>
                        <td>
                            <div class="fw-bold text-dark">Fiqih & Ushul Fiqih</div>
                            <small class="text-muted">Kurikulum Diniyah Terpadu</small>
                        </td>
                        <td>
                            <div class="text-dark fw-semibold">Ust. Ahmad Fauzi, S.Pd.I</div>
                            <small class="text-muted">NIP: 198504122010011002</small>
                        </td>
                        <td><span class="badge bg-light text-dark">Gedung A • R.101</span></td>
                        <td><span class="badge bg-success">Berjalan</span></td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-outline-secondary py-1 px-2">Edit</button>
                        </td>
                    </tr>
                    <tr>
                        <td><span class="badge bg-primary font-monospace py-2 px-3">09:15 - 10:45</span></td>
                        <td><span class="badge bg-light-info text-info">Sesi 2 (2 JP)</span></td>
                        <td>
                            <div class="fw-bold text-dark">Bahasa Arab & Nahwu Sharaf</div>
                            <small class="text-muted">Kurikulum Pesantren</small>
                        </td>
                        <td>
                            <div class="text-dark fw-semibold">Usth. Siti Maryam, S.Pd</div>
                            <small class="text-muted">NIP: 199008252014022001</small>
                        </td>
                        <td><span class="badge bg-light text-dark">Gedung A • R.101</span></td>
                        <td><span class="badge bg-success">Berjalan</span></td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-outline-secondary py-1 px-2">Edit</button>
                        </td>
                    </tr>
                    <tr>
                        <td><span class="badge bg-primary font-monospace py-2 px-3">11:00 - 12:15</span></td>
                        <td><span class="badge bg-light-purple text-purple" style="color: #6f42c1; background-color: #f3e8ff;">Sesi 3 (2 JP)</span></td>
                        <td>
                            <div class="fw-bold text-dark">Matematika Umum</div>
                            <small class="text-muted">Kurikulum Nasional (Kemendikbud)</small>
                        </td>
                        <td>
                            <div class="text-dark fw-semibold">Ust. Drs. H. Mulyadi</div>
                            <small class="text-muted">NIP: 197802142005011003</small>
                        </td>
                        <td><span class="badge bg-light text-dark">Gedung A • R.101</span></td>
                        <td><span class="badge bg-success">Berjalan</span></td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-outline-secondary py-1 px-2">Edit</button>
                        </td>
                    </tr>
                    <tr>
                        <td><span class="badge bg-secondary font-monospace py-2 px-3">12:15 - 13:30</span></td>
                        <td><span class="badge bg-light-warning text-warning">Istirahat</span></td>
                        <td>
                            <div class="fw-bold text-dark">Shalat Zhuhur Berjamaah & Makan Siang</div>
                            <small class="text-muted">Masjid & Ruang Makan Asrama</small>
                        </td>
                        <td>
                            <div class="text-muted">Tim Pembina Asrama</div>
                        </td>
                        <td><span class="badge bg-light text-dark">Masjid Jami'</span></td>
                        <td><span class="badge bg-secondary">Jeda</span></td>
                        <td class="text-center">-</td>
                    </tr>
                    <tr>
                        <td><span class="badge bg-primary font-monospace py-2 px-3">13:30 - 15:00</span></td>
                        <td><span class="badge bg-light-success text-success">Sesi 4 (2 JP)</span></td>
                        <td>
                            <div class="fw-bold text-dark">Al-Qur'an & Tajwid Praktis</div>
                            <small class="text-muted">Tahsin & Qira'ah</small>
                        </td>
                        <td>
                            <div class="text-dark fw-semibold">Ust. Ridwan Hakim, M.Pd</div>
                            <small class="text-muted">NIP: 198811032012011005</small>
                        </td>
                        <td><span class="badge bg-light text-dark">Gedung A • R.101</span></td>
                        <td><span class="badge bg-success">Berjalan</span></td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-outline-secondary py-1 px-2">Edit</button>
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
        let table = document.querySelector('#tableSchedules');
        if (table && typeof simpleDatatables !== 'undefined') {
            new simpleDatatables.DataTable(table, {
                searchable: true,
                fixedHeight: false,
                perPage: 10,
                labels: {
                    placeholder: "Cari jadwal, mapel, guru...",
                    perPage: "{select} entri per halaman",
                    noRows: "Tidak ada jadwal ditemukan",
                    info: "Menampilkan {start} sampai {end} dari {rows} jadwal"
                }
            });
        }
    });
</script>
@endpush
