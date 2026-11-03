<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <!-- Sidebar Brand Header -->
        <div class="sidebar-header d-flex justify-content-between align-items-center">
            <a href="{{ route('dashboard.super-admin') }}" class="d-flex align-items-center gap-2 text-decoration-none">
                <img src="{{ asset('assets/images/logo.svg') }}" alt="Logo SIM Pesantren" style="height: 34px;">
                <div>
                    <h5 class="mb-0 fw-bold" style="color: #1E3A5F; font-size: 15px; letter-spacing: -0.3px;">SIM PESANTREN</h5>
                    <small class="text-muted" style="font-size: 11px;">Al-Hikmah Terpadu</small>
                </div>
            </a>
            <a href="#" class="sidebar-toggler btn x"><i data-feather="x"></i></a>
        </div>

        <!-- Role Indicator Pill -->
        <div class="px-3 py-2 bg-light border-top border-bottom d-flex align-items-center justify-content-between">
            <span class="text-muted text-xs">Role Akses:</span>
            <span class="badge bg-primary text-uppercase" style="font-size: 10px;">{{ $activeRole['name'] ?? 'Super Admin' }}</span>
        </div>

        <!-- Sidebar Navigation Menu -->
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">Dashboard & Navigasi</li>

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
                        <i data-feather="grid" width="20"></i>
                        <span>Dashboard Utama</span>
                    </a>
                </li>

                <!-- 1. KESISWAAN (Super Admin, Administrator Pesantren, Wali Kelas) -->
                @if(in_array($roleKey, ['super-admin', 'administrator', 'wali-kelas']))
                    <li class="sidebar-title">Administrasi Santri</li>
                    <li class="sidebar-item {{ request()->is('admin/students*') ? 'active' : '' }}">
                        <a href="{{ route('students.index') }}" class="sidebar-link">
                            <i data-feather="users" width="20"></i>
                            <span>Data Santri</span>
                        </a>
                    </li>
                @endif

                <!-- 2. PENERIMAAN SANTRI BARU (Super Admin, Administrator, Admin PSB) -->
                @if(in_array($roleKey, ['super-admin', 'administrator', 'psb']))
                    <li class="sidebar-title">Penerimaan Santri (PSB)</li>
                    <li class="sidebar-item has-sub {{ request()->is('admissions*') ? 'active' : '' }}">
                        <a href="#" class="sidebar-link">
                            <i data-feather="user-plus" width="20"></i>
                            <span>Modul PSB</span>
                        </a>
                        <ul class="submenu {{ request()->is('admissions*') ? 'active' : '' }}">
                            <li class="{{ request()->routeIs('admissions.applicants') ? 'active' : '' }}">
                                <a href="{{ route('admissions.applicants') }}">Daftar Pendaftar</a>
                            </li>
                            <li class="{{ request()->routeIs('admissions.tests') ? 'active' : '' }}">
                                <a href="{{ route('admissions.tests') }}">Penjadwalan & Nilai Tes</a>
                            </li>
                            <li class="{{ request()->routeIs('admissions.selection-results') ? 'active' : '' }}">
                                <a href="{{ route('admissions.selection-results') }}">Hasil & Aktivasi Santri</a>
                            </li>
                        </ul>
                    </li>
                @endif

                <!-- 3. AKADEMIK FORMAL (Super Admin, Administrator, Admin Akademik, Guru, Wali Kelas) -->
                @if(in_array($roleKey, ['super-admin', 'administrator', 'akademik', 'guru', 'wali-kelas']))
                    <li class="sidebar-title">Pendidikan Formal</li>
                    <li class="sidebar-item has-sub {{ request()->is('academic*') ? 'active' : '' }}">
                        <a href="#" class="sidebar-link">
                            <i data-feather="book" width="20"></i>
                            <span>Modul Akademik</span>
                        </a>
                        <ul class="submenu {{ request()->is('academic*') ? 'active' : '' }}">
                            <li class="{{ request()->routeIs('academic.schedules') ? 'active' : '' }}">
                                <a href="{{ route('academic.schedules') }}">Jadwal Pembelajaran</a>
                            </li>
                            <li class="{{ request()->routeIs('academic.attendance') ? 'active' : '' }}">
                                <a href="{{ route('academic.attendance') }}">Presensi / Absensi Kelas</a>
                            </li>
                            <li class="{{ request()->routeIs('academic.grades') ? 'active' : '' }}">
                                <a href="{{ route('academic.grades') }}">Rekap Nilai Siswa</a>
                            </li>
                        </ul>
                    </li>
                @endif

                <!-- 4. KEASRAMAAN & PENGASUHAN (Super Admin, Administrator, Admin Keasramaan) -->
                @if(in_array($roleKey, ['super-admin', 'administrator', 'keasramaan']))
                    <li class="sidebar-title">Keasramaan & Satpam</li>
                    <li class="sidebar-item has-sub {{ request()->is('dormitory*') ? 'active' : '' }}">
                        <a href="#" class="sidebar-link">
                            <i data-feather="home" width="20"></i>
                            <span>Modul Keasramaan</span>
                        </a>
                        <ul class="submenu {{ request()->is('dormitory*') ? 'active' : '' }}">
                            <li class="{{ request()->routeIs('dormitory.activities') ? 'active' : '' }}">
                                <a href="{{ route('dormitory.activities') }}">Kegiatan & Presensi Asrama</a>
                            </li>
                            <li class="{{ request()->routeIs('dormitory.permissions') ? 'active' : '' }}">
                                <a href="{{ route('dormitory.permissions') }}">Izin Keluar Santri</a>
                            </li>
                            <li class="{{ request()->routeIs('dormitory.gate-check') ? 'active' : '' }}">
                                <a href="{{ route('dormitory.gate-check') }}">Pos Satpam (Gate Check QR)</a>
                            </li>
                        </ul>
                    </li>
                @endif

                <!-- 5. KEUANGAN & PEMBAYARAN (Super Admin, Bendahara / Keuangan) -->
                @if(in_array($roleKey, ['super-admin', 'keuangan']))
                    <li class="sidebar-title">Administrasi Keuangan</li>
                    <li class="sidebar-item has-sub {{ request()->is('finance*') ? 'active' : '' }}">
                        <a href="#" class="sidebar-link">
                            <i data-feather="dollar-sign" width="20"></i>
                            <span>Modul Keuangan</span>
                        </a>
                        <ul class="submenu {{ request()->is('finance*') ? 'active' : '' }}">
                            <li class="{{ request()->routeIs('finance.bills') ? 'active' : '' }}">
                                <a href="{{ route('finance.bills') }}">Tagihan Santri</a>
                            </li>
                            <li class="{{ request()->routeIs('finance.transactions') ? 'active' : '' }}">
                                <a href="{{ route('finance.transactions') }}">Input & Verifikasi Pembayaran</a>
                            </li>
                            <li class="{{ request()->routeIs('finance.tariffs') ? 'active' : '' }}">
                                <a href="{{ route('finance.tariffs') }}">Master Tarif & Komponen Biaya</a>
                            </li>
                            <li class="{{ request()->routeIs('finance.reports') ? 'active' : '' }}">
                                <a href="{{ route('finance.reports') }}">Laporan Keuangan</a>
                            </li>
                        </ul>
                    </li>
                @endif

                <!-- 6. PERPUSTAKAAN (Super Admin, Perpustakaan) -->
                @if(in_array($roleKey, ['super-admin', 'perpustakaan']))
                    <li class="sidebar-title">Perpustakaan & QR</li>
                    <li class="sidebar-item has-sub {{ request()->is('library*') ? 'active' : '' }}">
                        <a href="#" class="sidebar-link">
                            <i data-feather="bookmark" width="20"></i>
                            <span>Modul Perpustakaan</span>
                        </a>
                        <ul class="submenu {{ request()->is('library*') ? 'active' : '' }}">
                            <li class="{{ request()->routeIs('library.books') ? 'active' : '' }}">
                                <a href="{{ route('library.books') }}">Katalog Koleksi Buku</a>
                            </li>
                            <li class="{{ request()->routeIs('library.copies') ? 'active' : '' }}">
                                <a href="{{ route('library.copies') }}">Data Eksemplar Buku</a>
                            </li>
                            <li class="{{ request()->routeIs('library.qr-generator') ? 'active' : '' }}">
                                <a href="{{ route('library.qr-generator') }}">Generate QR Code Eksemplar</a>
                            </li>
                            <li class="{{ request()->routeIs('library.borrow') ? 'active' : '' }}">
                                <a href="{{ route('library.borrow') }}">Sirkulasi Peminjaman (QR Scan)</a>
                            </li>
                            <li class="{{ request()->routeIs('library.return') ? 'active' : '' }}">
                                <a href="{{ route('library.return') }}">Sirkulasi Pengembalian & Denda</a>
                            </li>
                            <li class="{{ request()->routeIs('library.history') ? 'active' : '' }}">
                                <a href="{{ route('library.history') }}">Riwayat Sirkulasi Buku</a>
                            </li>
                        </ul>
                    </li>
                @endif

                <!-- 7. PORTAL SANTRI & WALI SANTRI (Santri / Wali Santri Role) -->
                @if($roleKey === 'santri')
                    <li class="sidebar-title">Menu Santri</li>
                    <li class="sidebar-item {{ request()->routeIs('dashboard.santri') ? 'active' : '' }}">
                        <a href="{{ route('dashboard.santri') }}" class="sidebar-link">
                            <i data-feather="user" width="20"></i>
                            <span>Profil & Kartu Santri Digital</span>
                        </a>
                    </li>
                    <li class="sidebar-item {{ request()->routeIs('academic.schedules') ? 'active' : '' }}">
                        <a href="{{ route('academic.schedules') }}" class="sidebar-link">
                            <i data-feather="calendar" width="20"></i>
                            <span>Jadwal Harian & Pelajaran</span>
                        </a>
                    </li>
                    <li class="sidebar-item {{ request()->routeIs('academic.grades') ? 'active' : '' }}">
                        <a href="{{ route('academic.grades') }}" class="sidebar-link">
                            <i data-feather="file-text" width="20"></i>
                            <span>Raport & Nilai</span>
                        </a>
                    </li>
                    <li class="sidebar-item {{ request()->routeIs('finance.bills') ? 'active' : '' }}">
                        <a href="{{ route('finance.bills') }}" class="sidebar-link">
                            <i data-feather="credit-card" width="20"></i>
                            <span>Tagihan SPP & Pembayaran</span>
                        </a>
                    </li>
                @endif

                @if($roleKey === 'wali-santri')
                    <li class="sidebar-title">Menu Wali Santri</li>
                    <li class="sidebar-item {{ request()->routeIs('dashboard.wali-santri') ? 'active' : '' }}">
                        <a href="{{ route('dashboard.wali-santri') }}" class="sidebar-link">
                            <i data-feather="heart" width="20"></i>
                            <span>Monitoring Santri (Anak)</span>
                        </a>
                    </li>
                    <li class="sidebar-item {{ request()->routeIs('academic.attendance') ? 'active' : '' }}">
                        <a href="{{ route('academic.attendance') }}" class="sidebar-link">
                            <i data-feather="clock" width="20"></i>
                            <span>Presensi Kehadiran Formal & Asrama</span>
                        </a>
                    </li>
                    <li class="sidebar-item {{ request()->routeIs('finance.bills') ? 'active' : '' }}">
                        <a href="{{ route('finance.bills') }}" class="sidebar-link">
                            <i data-feather="credit-card" width="20"></i>
                            <span>Status Tagihan & Riwayat Bayar</span>
                        </a>
                    </li>
                    <li class="sidebar-item {{ request()->routeIs('dormitory.permissions') ? 'active' : '' }}">
                        <a href="{{ route('dormitory.permissions') }}" class="sidebar-link">
                            <i data-feather="navigation" width="20"></i>
                            <span>Izin Keluar / Kepulangan</span>
                        </a>
                    </li>
                @endif

                <!-- 8. PENGATURAN SISTEM (Super Admin only) -->
                @if($roleKey === 'super-admin')
                    <li class="sidebar-title">Pengaturan Sistem</li>
                    <li class="sidebar-item has-sub {{ request()->is('settings*') ? 'active' : '' }}">
                        <a href="#" class="sidebar-link">
                            <i data-feather="settings" width="20"></i>
                            <span>Konfigurasi & Log</span>
                        </a>
                        <ul class="submenu {{ request()->is('settings*') ? 'active' : '' }}">
                            <li class="{{ request()->routeIs('settings.users') ? 'active' : '' }}">
                                <a href="{{ route('settings.users') }}">Manajemen Pengguna</a>
                            </li>
                            <li class="{{ request()->routeIs('settings.roles-permissions') ? 'active' : '' }}">
                                <a href="{{ route('settings.roles-permissions') }}">Roles & Permissions Matrix</a>
                            </li>
                            <li class="{{ request()->routeIs('settings.audit-logs') ? 'active' : '' }}">
                                <a href="{{ route('settings.audit-logs') }}">Audit Log Aktivitas</a>
                            </li>
                            <li class="{{ request()->routeIs('settings.notifications') ? 'active' : '' }}">
                                <a href="{{ route('settings.notifications') }}">Pusat Notifikasi</a>
                            </li>
                        </ul>
                    </li>
                @endif

                <!-- Switch Role Quick Access -->
                <li class="sidebar-title">Simulasi Role (11 Role)</li>
                <li class="sidebar-item has-sub">
                    <a href="#" class="sidebar-link">
                        <i data-feather="shuffle" width="20"></i>
                        <span>Beralih Hak Akses</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="{{ route('dashboard.super-admin') }}">1. Super Admin</a></li>
                        <li><a href="{{ route('dashboard.administrator') }}">2. Administrator</a></li>
                        <li><a href="{{ route('dashboard.psb') }}">3. Admin PSB</a></li>
                        <li><a href="{{ route('dashboard.akademik') }}">4. Admin Akademik</a></li>
                        <li><a href="{{ route('dashboard.guru') }}">5. Guru / Ustadz</a></li>
                        <li><a href="{{ route('dashboard.wali-kelas') }}">6. Wali Kelas</a></li>
                        <li><a href="{{ route('dashboard.keasramaan') }}">7. Admin Keasramaan</a></li>
                        <li><a href="{{ route('dashboard.keuangan') }}">8. Bendahara</a></li>
                        <li><a href="{{ route('dashboard.perpustakaan') }}">9. Pustakawan</a></li>
                        <li><a href="{{ route('dashboard.santri') }}">10. Portal Santri</a></li>
                        <li><a href="{{ route('dashboard.wali-santri') }}">11. Wali Santri</a></li>
                    </ul>
                </li>

                <!-- Logout -->
                <li class="sidebar-item">
                    <a href="{{ route('login') }}" class="sidebar-link text-danger">
                        <i data-feather="log-out" width="20" class="text-danger"></i>
                        <span class="text-danger">Keluar (Logout)</span>
                    </a>
                </li>
            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>
