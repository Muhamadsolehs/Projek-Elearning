<nav class="navbar navbar-header navbar-expand navbar-light">
    <!-- Sidebar mobile toggler -->
    <a class="sidebar-toggler" href="#"><span class="navbar-toggler-icon"></span></a>
    <button class="btn navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Date & Semester Badge -->
        <div class="d-none d-md-flex align-items-center ms-3">
            <span class="badge bg-light text-dark border px-3 py-2 d-flex align-items-center gap-2">
                <span class="rounded-circle bg-success" style="width: 8px; height: 8px; display: inline-block;"></span>
                <span>T.A. 2025/2026</span>
                <span class="text-muted">•</span>
                <span class="fw-bold text-primary">Semester Genap</span>
            </span>
        </div>

        <ul class="navbar-nav d-flex align-items-center navbar-light ms-auto">
            <!-- 11 Role Switcher Dropdown (Primary interactive requirement) -->
            <li class="dropdown me-2">
                <a href="#" data-bs-toggle="dropdown" class="btn btn-sm btn-outline-primary d-flex align-items-center gap-2 px-3 py-2 text-decoration-none">
                    <i data-feather="users" style="width: 15px; height: 15px;"></i>
                    <span class="d-none d-sm-inline">Role: <strong>{{ $activeRole['name'] ?? 'Super Admin' }}</strong></span>
                    <i data-feather="chevron-down" style="width: 14px; height: 14px;"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-end shadow border-0" style="min-width: 290px; max-height: 80vh; overflow-y: auto;">
                    <div class="px-3 py-2 bg-light border-bottom">
                        <small class="fw-bold text-uppercase text-muted" style="font-size: 11px;">Pilih Hak Akses (11 Role)</small>
                    </div>
                    <a class="dropdown-item py-2 d-flex align-items-center gap-2 {{ ($activeRole['key'] ?? '') === 'super-admin' ? 'active' : '' }}" href="{{ route('dashboard.super-admin') }}">
                        <i data-feather="shield" style="width:15px;"></i> <div><div class="fw-bold">1. Super Admin</div><small class="text-muted" style="font-size:11px;">Akses Penuh Seluruh Sistem</small></div>
                    </a>
                    <a class="dropdown-item py-2 d-flex align-items-center gap-2 {{ ($activeRole['key'] ?? '') === 'administrator' ? 'active' : '' }}" href="{{ route('dashboard.administrator') }}">
                        <i data-feather="briefcase" style="width:15px;"></i> <div><div class="fw-bold">2. Administrator Pesantren</div><small class="text-muted" style="font-size:11px;">Administrasi & Data Induk</small></div>
                    </a>
                    <a class="dropdown-item py-2 d-flex align-items-center gap-2 {{ ($activeRole['key'] ?? '') === 'psb' ? 'active' : '' }}" href="{{ route('dashboard.psb') }}">
                        <i data-feather="user-plus" style="width:15px;"></i> <div><div class="fw-bold">3. Admin PSB</div><small class="text-muted" style="font-size:11px;">Pendaftaran & Seleksi Baru</small></div>
                    </a>
                    <a class="dropdown-item py-2 d-flex align-items-center gap-2 {{ ($activeRole['key'] ?? '') === 'akademik' ? 'active' : '' }}" href="{{ route('dashboard.akademik') }}">
                        <i data-feather="book" style="width:15px;"></i> <div><div class="fw-bold">4. Admin Akademik</div><small class="text-muted" style="font-size:11px;">Pendidikan Formal & Raport</small></div>
                    </a>
                    <a class="dropdown-item py-2 d-flex align-items-center gap-2 {{ ($activeRole['key'] ?? '') === 'guru' ? 'active' : '' }}" href="{{ route('dashboard.guru') }}">
                        <i data-feather="award" style="width:15px;"></i> <div><div class="fw-bold">5. Guru / Ustadz</div><small class="text-muted" style="font-size:11px;">Jadwal, Presensi, Input Nilai</small></div>
                    </a>
                    <a class="dropdown-item py-2 d-flex align-items-center gap-2 {{ ($activeRole['key'] ?? '') === 'wali-kelas' ? 'active' : '' }}" href="{{ route('dashboard.wali-kelas') }}">
                        <i data-feather="check-square" style="width:15px;"></i> <div><div class="fw-bold">6. Wali Kelas</div><small class="text-muted" style="font-size:11px;">Monitoring Santri Kelas</small></div>
                    </a>
                    <a class="dropdown-item py-2 d-flex align-items-center gap-2 {{ ($activeRole['key'] ?? '') === 'keasramaan' ? 'active' : '' }}" href="{{ route('dashboard.keasramaan') }}">
                        <i data-feather="home" style="width:15px;"></i> <div><div class="fw-bold">7. Admin Keasramaan</div><small class="text-muted" style="font-size:11px;">Asrama, Izin Keluar, Satpam</small></div>
                    </a>
                    <a class="dropdown-item py-2 d-flex align-items-center gap-2 {{ ($activeRole['key'] ?? '') === 'keuangan' ? 'active' : '' }}" href="{{ route('dashboard.keuangan') }}">
                        <i data-feather="dollar-sign" style="width:15px;"></i> <div><div class="fw-bold">8. Bendahara / Keuangan</div><small class="text-muted" style="font-size:11px;">Tagihan, Kuitansi, Laporan</small></div>
                    </a>
                    <a class="dropdown-item py-2 d-flex align-items-center gap-2 {{ ($activeRole['key'] ?? '') === 'perpustakaan' ? 'active' : '' }}" href="{{ route('dashboard.perpustakaan') }}">
                        <i data-feather="bookmark" style="width:15px;"></i> <div><div class="fw-bold">9. Pustakawan</div><small class="text-muted" style="font-size:11px;">Katalog, QR Code, Pinjam/Kembali</small></div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item py-2 d-flex align-items-center gap-2 {{ ($activeRole['key'] ?? '') === 'santri' ? 'active' : '' }}" href="{{ route('dashboard.santri') }}">
                        <i data-feather="user" style="width:15px;"></i> <div><div class="fw-bold">10. Portal Santri</div><small class="text-muted" style="font-size:11px;">Kartu Digital, Jadwal, Tagihan</small></div>
                    </a>
                    <a class="dropdown-item py-2 d-flex align-items-center gap-2 {{ ($activeRole['key'] ?? '') === 'wali-santri' ? 'active' : '' }}" href="{{ route('dashboard.wali-santri') }}">
                        <i data-feather="heart" style="width:15px;"></i> <div><div class="fw-bold">11. Portal Wali Santri</div><small class="text-muted" style="font-size:11px;">Pantau Anak, Presensi, SPP</small></div>
                    </a>
                </div>
            </li>

            <!-- Notifications Dropdown -->
            <li class="dropdown nav-icon me-2">
                <a href="#" data-bs-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user position-relative">
                    <i data-feather="bell"></i>
                    <span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle" style="width: 8px; height: 8px;"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-end shadow border-0" style="width: 320px;">
                    <div class="p-3 border-bottom d-flex justify-content-between align-items-center">
                        <h6 class="mb-0 fw-bold">Notifikasi Sistem</h6>
                        <span class="badge bg-primary">3 Baru</span>
                    </div>
                    <ul class="list-group list-group-flush text-xs">
                        <li class="list-group-item list-group-item-action d-flex align-items-start gap-2 p-3">
                            <div class="p-2 bg-success text-white rounded-circle d-flex align-items-center justify-content-center" style="width:28px; height:28px;"><i data-feather="check" style="width:14px; height:14px;"></i></div>
                            <div>
                                <div class="fw-bold">Pembayaran SPP Diverifikasi</div>
                                <div class="text-muted">Ahmad Rayhan (VIII-A) - Rp 750.000</div>
                                <small class="text-muted">10 menit yang lalu</small>
                            </div>
                        </li>
                        <li class="list-group-item list-group-item-action d-flex align-items-start gap-2 p-3">
                            <div class="p-2 bg-warning text-white rounded-circle d-flex align-items-center justify-content-center" style="width:28px; height:28px;"><i data-feather="clock" style="width:14px; height:14px;"></i></div>
                            <div>
                                <div class="fw-bold">Pengajuan Izin Keluar Baru</div>
                                <div class="text-muted">Muhammad Farhan meminta izin berobat</div>
                                <small class="text-muted">25 menit yang lalu</small>
                            </div>
                        </li>
                        <li class="list-group-item list-group-item-action d-flex align-items-start gap-2 p-3">
                            <div class="p-2 bg-info text-white rounded-circle d-flex align-items-center justify-content-center" style="width:28px; height:28px;"><i data-feather="book-open" style="width:14px; height:14px;"></i></div>
                            <div>
                                <div class="fw-bold">Buku Melewati Batas Pinjam</div>
                                <div class="text-muted">3 eksemplar terlambat dikembalikan</div>
                                <small class="text-muted">1 jam yang lalu</small>
                            </div>
                        </li>
                    </ul>
                    <div class="p-2 text-center border-top">
                        <a href="{{ route('settings.notifications') }}" class="text-xs text-primary fw-bold text-decoration-none">Lihat Semua Notifikasi</a>
                    </div>
                </div>
            </li>

            <!-- User Profile Dropdown -->
            <li class="dropdown">
                <a href="#" data-bs-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user d-flex align-items-center gap-2">
                    <div class="avatar me-1">
                        <img src="{{ asset('assets/images/avatar/avatar-s-1.png') }}" alt="Avatar" class="rounded-circle border" style="width: 36px; height: 36px;">
                    </div>
                    <div class="d-none d-md-block text-start">
                        <div class="fw-bold text-dark" style="font-size: 13px;">{{ $activeUser['name'] ?? 'Ustadz Ahmad Farhan' }}</div>
                        <div class="text-muted text-xs" style="font-size: 11px;">{{ $activeRole['name'] ?? 'Super Admin' }}</div>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end shadow border-0" style="min-width: 200px;">
                    <a class="dropdown-item py-2" href="{{ route('auth.profile') }}"><i data-feather="user" class="me-2" style="width:15px;"></i> Profil Akun</a>
                    <a class="dropdown-item py-2" href="{{ route('settings.audit-logs') }}"><i data-feather="activity" class="me-2" style="width:15px;"></i> Log Aktivitas</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item py-2 text-danger" href="{{ route('login') }}"><i data-feather="log-out" class="me-2 text-danger" style="width:15px;"></i> Keluar (Logout)</a>
                </div>
            </li>
        </ul>
    </div>
</nav>
