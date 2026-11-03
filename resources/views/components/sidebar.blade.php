<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <!-- Sidebar Brand Header -->
        <div class="sidebar-header" style="padding: 1.5rem 1.25rem 1rem;">
            <div class="d-flex justify-content-between align-items-center">
                <a href="{{ route('dashboard.super-admin') }}" class="d-flex align-items-center gap-3 text-decoration-none">
                    <img src="{{ asset('assets/images/favicon.svg') }}" alt="Logo SIM Pesantren" style="height: 36px; width: 36px; flex-shrink: 0;">
                    <div class="d-flex flex-column justify-content-center" style="line-height: 1.25;">
                        <span class="fw-bold text-nowrap" style="color: #1E3A5F; font-size: 15px; letter-spacing: -0.2px;">SIM PESANTREN</span>
                        <small class="text-muted text-nowrap" style="font-size: 11px;">Al-Hikmah Terpadu</small>
                    </div>
                </a>
                <a href="#" class="sidebar-toggler btn x"><i data-feather="x"></i></a>
            </div>
        </div>

        <!-- Role Indicator Badge -->
        <div class="px-4 py-2 bg-light border-top border-bottom d-flex align-items-center justify-content-between">
            <small class="text-muted text-xs fw-semibold">Akses Aktif:</small>
            <span class="badge bg-primary text-uppercase" style="font-size: 10px;">{{ $activeRole['name'] ?? 'Super Admin' }}</span>
        </div>

        <!-- Sidebar Navigation Menu -->
        <div class="sidebar-menu">
            <ul class="menu mt-2">
                <li class="sidebar-title">Menu Utama</li>

                <!-- Dynamic Dashboard Link per Role -->
                @php
                    $roleKey = $activeRole['key'] ?? 'super-admin';
                    $dashRoute = match($roleKey) {
                        'super-admin' => route('dashboard.super-admin'),
                        'administrator' => route('dashboard.administrator'),
                        'psb' => route('dashboard.psb'),
                        'akademik' => route('dashboard.akademik'),
                        'guru' => route('dashboard.guru'),
                        'wali-kelas' => route('dashboard.wali-kelas'),
                        'keasramaan' => route('dashboard.keasramaan'),
                        'keuangan' => route('dashboard.keuangan'),
                        'perpustakaan' => route('dashboard.perpustakaan'),
                        'santri' => route('dashboard.santri'),
                        'wali-santri' => route('dashboard.wali-santri'),
                        default => route('dashboard.super-admin'),
                    };
                @endphp

                <li class="sidebar-item {{ request()->is('dashboard/*') ? 'active' : '' }}">
                    <a href="{{ $dashRoute }}" class="sidebar-link">
                        <i data-feather="grid" width="18"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <!-- 1. DATA SANTRI (Super Admin, Administrator Pesantren, Wali Kelas) -->
                @if(in_array($roleKey, ['super-admin', 'administrator', 'wali-kelas']))
                    <li class="sidebar-item {{ request()->is('admin/students*') ? 'active' : '' }}">
                        <a href="{{ route('students.index') }}" class="sidebar-link">
                            <i data-feather="users" width="18"></i>
                            <span>Data Santri</span>
                        </a>
                    </li>
                @endif

                <!-- 2. PENERIMAAN SANTRI BARU (Super Admin, Administrator, Admin PSB) -->
                @if(in_array($roleKey, ['super-admin', 'administrator', 'psb']))
                    <li class="sidebar-item has-sub {{ request()->is('admissions*') ? 'active' : '' }}">
                        <a href="#" class="sidebar-link">
                            <i data-feather="user-plus" width="18"></i>
                            <span>Penerimaan (PSB)</span>
                        </a>
                        <ul class="submenu {{ request()->is('admissions*') ? 'active' : '' }}">
                            <li class="{{ request()->routeIs('admissions.applicants') ? 'active' : '' }}">
                                <a href="{{ route('admissions.applicants') }}">Pendaftar Baru</a>
                            </li>
                            <li class="{{ request()->routeIs('admissions.tests') ? 'active' : '' }}">
                                <a href="{{ route('admissions.tests') }}">Jadwal & Nilai Tes</a>
                            </li>
                            <li class="{{ request()->routeIs('admissions.selection-results') ? 'active' : '' }}">
                                <a href="{{ route('admissions.selection-results') }}">Hasil & Aktivasi</a>
                            </li>
                        </ul>
                    </li>
                @endif

                <!-- 3. AKADEMIK FORMAL (Super Admin, Administrator, Admin Akademik, Guru, Wali Kelas) -->
                @if(in_array($roleKey, ['super-admin', 'administrator', 'akademik', 'guru', 'wali-kelas']))
                    <li class="sidebar-item has-sub {{ request()->is('academic*') ? 'active' : '' }}">
                        <a href="#" class="sidebar-link">
                            <i data-feather="book-open" width="18"></i>
                            <span>Akademik</span>
                        </a>
                        <ul class="submenu {{ request()->is('academic*') ? 'active' : '' }}">
                            <li class="{{ request()->routeIs('academic.schedules') ? 'active' : '' }}">
                                <a href="{{ route('academic.schedules') }}">Jadwal Pelajaran</a>
                            </li>
                            <li class="{{ request()->routeIs('academic.attendance') ? 'active' : '' }}">
                                <a href="{{ route('academic.attendance') }}">Presensi Kelas</a>
                            </li>
                            <li class="{{ request()->routeIs('academic.grades') ? 'active' : '' }}">
                                <a href="{{ route('academic.grades') }}">Rekap Nilai Rapor</a>
                            </li>
                        </ul>
                    </li>
                @endif

                <!-- 4. KEASRAMAAN & PENGASUHAN (Super Admin, Administrator, Admin Keasramaan) -->
                @if(in_array($roleKey, ['super-admin', 'administrator', 'keasramaan']))
                    <li class="sidebar-item has-sub {{ request()->is('dormitory*') ? 'active' : '' }}">
                        <a href="#" class="sidebar-link">
                            <i data-feather="home" width="18"></i>
                            <span>Keasramaan</span>
                        </a>
                        <ul class="submenu {{ request()->is('dormitory*') ? 'active' : '' }}">
                            <li class="{{ request()->routeIs('dormitory.activities') ? 'active' : '' }}">
                                <a href="{{ route('dormitory.activities') }}">Kegiatan & Halaqah</a>
                            </li>
                            <li class="{{ request()->routeIs('dormitory.permissions') ? 'active' : '' }}">
                                <a href="{{ route('dormitory.permissions') }}">Izin Keluar Santri</a>
                            </li>
                            <li class="{{ request()->routeIs('dormitory.gate-check') ? 'active' : '' }}">
                                <a href="{{ route('dormitory.gate-check') }}">Gate Check Satpam (QR)</a>
                            </li>
                        </ul>
                    </li>
                @endif

                <!-- 5. KEUANGAN & PEMBAYARAN (Super Admin, Bendahara / Keuangan) -->
                @if(in_array($roleKey, ['super-admin', 'keuangan']))
                    <li class="sidebar-item has-sub {{ request()->is('finance*') ? 'active' : '' }}">
                        <a href="#" class="sidebar-link">
                            <i data-feather="dollar-sign" width="18"></i>
                            <span>Keuangan</span>
                        </a>
                        <ul class="submenu {{ request()->is('finance*') ? 'active' : '' }}">
                            <li class="{{ request()->routeIs('finance.bills') ? 'active' : '' }}">
                                <a href="{{ route('finance.bills') }}">Tagihan Santri</a>
                            </li>
                            <li class="{{ request()->routeIs('finance.transactions') ? 'active' : '' }}">
                                <a href="{{ route('finance.transactions') }}">Input Pembayaran</a>
                            </li>
                            <li class="{{ request()->routeIs('finance.tariffs') ? 'active' : '' }}">
                                <a href="{{ route('finance.tariffs') }}">Tarif & Biaya</a>
                            </li>
                            <li class="{{ request()->routeIs('finance.reports') ? 'active' : '' }}">
                                <a href="{{ route('finance.reports') }}">Laporan Keuangan</a>
                            </li>
                        </ul>
                    </li>
                @endif

                <!-- 6. PERPUSTAKAAN (Super Admin, Perpustakaan) -->
                @if(in_array($roleKey, ['super-admin', 'perpustakaan']))
                    <li class="sidebar-item has-sub {{ request()->is('library*') ? 'active' : '' }}">
                        <a href="#" class="sidebar-link">
                            <i data-feather="bookmark" width="18"></i>
                            <span>Perpustakaan</span>
                        </a>
                        <ul class="submenu {{ request()->is('library*') ? 'active' : '' }}">
                            <li class="{{ request()->routeIs('library.books') ? 'active' : '' }}">
                                <a href="{{ route('library.books') }}">Katalog Buku</a>
                            </li>
                            <li class="{{ request()->routeIs('library.copies') ? 'active' : '' }}">
                                <a href="{{ route('library.copies') }}">Data Eksemplar</a>
                            </li>
                            <li class="{{ request()->routeIs('library.qr-generator') ? 'active' : '' }}">
                                <a href="{{ route('library.qr-generator') }}">Cetak Label QR (A4)</a>
                            </li>
                            <li class="{{ request()->routeIs('library.borrow') ? 'active' : '' }}">
                                <a href="{{ route('library.borrow') }}">Sirkulasi Peminjaman</a>
                            </li>
                            <li class="{{ request()->routeIs('library.return') ? 'active' : '' }}">
                                <a href="{{ route('library.return') }}">Pengembalian & Denda</a>
                            </li>
                            <li class="{{ request()->routeIs('library.history') ? 'active' : '' }}">
                                <a href="{{ route('library.history') }}">Riwayat Sirkulasi</a>
                            </li>
                        </ul>
                    </li>
                @endif

                <!-- 7. PORTAL SANTRI (Santri Role) -->
                @if($roleKey === 'santri')
                    <li class="sidebar-item {{ request()->routeIs('dashboard.santri') ? 'active' : '' }}">
                        <a href="{{ route('dashboard.santri') }}" class="sidebar-link">
                            <i data-feather="user" width="18"></i>
                            <span>Kartu Santri Digital</span>
                        </a>
                    </li>
                    <li class="sidebar-item {{ request()->routeIs('academic.schedules') ? 'active' : '' }}">
                        <a href="{{ route('academic.schedules') }}" class="sidebar-link">
                            <i data-feather="calendar" width="18"></i>
                            <span>Jadwal Harian</span>
                        </a>
                    </li>
                    <li class="sidebar-item {{ request()->routeIs('academic.grades') ? 'active' : '' }}">
                        <a href="{{ route('academic.grades') }}" class="sidebar-link">
                            <i data-feather="file-text" width="18"></i>
                            <span>Raport & Nilai</span>
                        </a>
                    </li>
                    <li class="sidebar-item {{ request()->routeIs('finance.bills') ? 'active' : '' }}">
                        <a href="{{ route('finance.bills') }}" class="sidebar-link">
                            <i data-feather="credit-card" width="18"></i>
                            <span>Tagihan SPP</span>
                        </a>
                    </li>
                @endif

                <!-- 8. PORTAL WALI SANTRI (Wali Santri Role) -->
                @if($roleKey === 'wali-santri')
                    <li class="sidebar-item {{ request()->routeIs('dashboard.wali-santri') ? 'active' : '' }}">
                        <a href="{{ route('dashboard.wali-santri') }}" class="sidebar-link">
                            <i data-feather="heart" width="18"></i>
                            <span>Pantau Perkembangan Anak</span>
                        </a>
                    </li>
                    <li class="sidebar-item {{ request()->routeIs('academic.attendance') ? 'active' : '' }}">
                        <a href="{{ route('academic.attendance') }}" class="sidebar-link">
                            <i data-feather="clock" width="18"></i>
                            <span>Presensi Kehadiran</span>
                        </a>
                    </li>
                    <li class="sidebar-item {{ request()->routeIs('finance.bills') ? 'active' : '' }}">
                        <a href="{{ route('finance.bills') }}" class="sidebar-link">
                            <i data-feather="credit-card" width="18"></i>
                            <span>Riwayat Tagihan & SPP</span>
                        </a>
                    </li>
                    <li class="sidebar-item {{ request()->routeIs('dormitory.permissions') ? 'active' : '' }}">
                        <a href="{{ route('dormitory.permissions') }}" class="sidebar-link">
                            <i data-feather="navigation" width="18"></i>
                            <span>Izin Keluar / Pulang</span>
                        </a>
                    </li>
                @endif

                <!-- SECTION: PENGATURAN & SISTEM -->
                <li class="sidebar-title">Sistem & Pengaturan</li>

                <!-- Pengaturan Sistem (Super Admin only) -->
                @if($roleKey === 'super-admin')
                    <li class="sidebar-item has-sub {{ request()->is('settings*') ? 'active' : '' }}">
                        <a href="#" class="sidebar-link">
                            <i data-feather="settings" width="18"></i>
                            <span>Pengaturan Sistem</span>
                        </a>
                        <ul class="submenu {{ request()->is('settings*') ? 'active' : '' }}">
                            <li class="{{ request()->routeIs('settings.users') ? 'active' : '' }}">
                                <a href="{{ route('settings.users') }}">Manajemen Pengguna</a>
                            </li>
                            <li class="{{ request()->routeIs('settings.roles-permissions') ? 'active' : '' }}">
                                <a href="{{ route('settings.roles-permissions') }}">Hak Akses (RBAC)</a>
                            </li>
                            <li class="{{ request()->routeIs('settings.audit-logs') ? 'active' : '' }}">
                                <a href="{{ route('settings.audit-logs') }}">Audit Log</a>
                            </li>
                            <li class="{{ request()->routeIs('settings.notifications') ? 'active' : '' }}">
                                <a href="{{ route('settings.notifications') }}">Pusat Notifikasi</a>
                            </li>
                        </ul>
                    </li>
                @endif

                <!-- Switch Role Quick Access -->
                <li class="sidebar-item has-sub">
                    <a href="#" class="sidebar-link">
                        <i data-feather="shuffle" width="18"></i>
                        <span>Simulasi Role</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="{{ route('dashboard.super-admin') }}">Super Admin</a></li>
                        <li><a href="{{ route('dashboard.administrator') }}">Administrator</a></li>
                        <li><a href="{{ route('dashboard.psb') }}">Admin PSB</a></li>
                        <li><a href="{{ route('dashboard.akademik') }}">Admin Akademik</a></li>
                        <li><a href="{{ route('dashboard.guru') }}">Guru / Ustadz</a></li>
                        <li><a href="{{ route('dashboard.wali-kelas') }}">Wali Kelas</a></li>
                        <li><a href="{{ route('dashboard.keasramaan') }}">Keasramaan</a></li>
                        <li><a href="{{ route('dashboard.keuangan') }}">Bendahara</a></li>
                        <li><a href="{{ route('dashboard.perpustakaan') }}">Perpustakaan</a></li>
                        <li><a href="{{ route('dashboard.santri') }}">Portal Santri</a></li>
                        <li><a href="{{ route('dashboard.wali-santri') }}">Wali Santri</a></li>
                    </ul>
                </li>

                <!-- Logout -->
                <li class="sidebar-item">
                    <a href="{{ route('login') }}" class="sidebar-link text-danger">
                        <i data-feather="log-out" width="18" class="text-danger"></i>
                        <span class="text-danger">Keluar</span>
                    </a>
                </li>
            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>
