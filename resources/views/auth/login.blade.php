@extends('layouts.auth')

@section('title', 'Sign In — SIM Pesantren Terintegrasi')

@section('content')
<div class="card pt-4 shadow-sm border-0">
    <div class="card-body px-4 py-3">
        <div class="text-center mb-4">
            <img src="{{ asset('assets/images/logo.svg') }}" height="52" class="mb-3" alt="Logo Pesantren">
            <h4 class="fw-bold text-dark mb-1">SIM PESANTREN</h4>
            <p class="text-muted text-sm mb-0">Platform Manajemen Terpadu Pesantren & Pendidikan</p>
        </div>

        <form id="loginForm" onsubmit="handleLogin(event)">
            <div class="form-group position-relative has-icon-left mb-3">
                <label for="username" class="text-sm fw-bold mb-1">Username / NIP / NIS</label>
                <div class="position-relative">
                    <input type="text" class="form-control" id="username" value="admin@pesantren.sch.id" placeholder="Masukkan ID pengguna" required>
                    <div class="form-control-icon">
                        <i data-feather="user"></i>
                    </div>
                </div>
            </div>

            <div class="form-group position-relative has-icon-left mb-3">
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <label for="password" class="text-sm fw-bold mb-0">Kata Sandi</label>
                    <a href="javascript:void(0)" class="text-sm text-primary">Lupa Sandi?</a>
                </div>
                <div class="position-relative">
                    <input type="password" class="form-control" id="password" value="password123" placeholder="••••••••" required>
                    <div class="form-control-icon">
                        <i data-feather="lock"></i>
                    </div>
                </div>
            </div>

            <div class="form-check clearfix my-3">
                <div class="checkbox float-start">
                    <input type="checkbox" id="rememberMe" class="form-check-input" checked>
                    <label for="rememberMe" class="text-muted text-sm">Ingat sesi ini</label>
                </div>
                <div class="float-end">
                    <span class="badge bg-light-primary text-primary">v2.5 Terintegrasi</span>
                </div>
            </div>

            <div class="d-grid gap-2 mb-3">
                <button type="submit" id="btnSubmit" class="btn btn-primary btn-block fw-bold py-2 d-flex align-items-center justify-content-center gap-2">
                    <i data-feather="log-in" style="width: 16px; height: 16px;"></i> Masuk ke Dashboard
                </button>
            </div>
        </form>

        <div class="divider my-4">
            <div class="divider-text text-muted text-xs text-uppercase fw-bold">AKSES CEPAT DEMO 11 ROLE</div>
        </div>

        <div class="row g-2">
            <div class="col-6">
                <a href="{{ route('dashboard.super-admin') }}" class="btn btn-outline-primary btn-sm w-100 text-start py-1 px-2 text-xs text-truncate">
                    👑 <strong>Super Admin</strong>
                </a>
            </div>
            <div class="col-6">
                <a href="{{ route('dashboard.administrator') }}" class="btn btn-outline-secondary btn-sm w-100 text-start py-1 px-2 text-xs text-truncate">
                    🏛️ <strong>Administrator</strong>
                </a>
            </div>
            <div class="col-6">
                <a href="{{ route('dashboard.psb') }}" class="btn btn-outline-success btn-sm w-100 text-start py-1 px-2 text-xs text-truncate">
                    📝 <strong>Admin PSB</strong>
                </a>
            </div>
            <div class="col-6">
                <a href="{{ route('dashboard.akademik') }}" class="btn btn-outline-info btn-sm w-100 text-start py-1 px-2 text-xs text-truncate">
                    📚 <strong>Admin Akademik</strong>
                </a>
            </div>
            <div class="col-6">
                <a href="{{ route('dashboard.guru') }}" class="btn btn-outline-warning btn-sm w-100 text-start py-1 px-2 text-xs text-truncate">
                    👨‍🏫 <strong>Guru / Ustadz</strong>
                </a>
            </div>
            <div class="col-6">
                <a href="{{ route('dashboard.wali-kelas') }}" class="btn btn-outline-dark btn-sm w-100 text-start py-1 px-2 text-xs text-truncate">
                    📋 <strong>Wali Kelas</strong>
                </a>
            </div>
            <div class="col-6">
                <a href="{{ route('dashboard.keasramaan') }}" class="btn btn-outline-primary btn-sm w-100 text-start py-1 px-2 text-xs text-truncate">
                    🏠 <strong>Keasramaan</strong>
                </a>
            </div>
            <div class="col-6">
                <a href="{{ route('dashboard.keuangan') }}" class="btn btn-outline-success btn-sm w-100 text-start py-1 px-2 text-xs text-truncate">
                    💰 <strong>Bendahara</strong>
                </a>
            </div>
            <div class="col-6">
                <a href="{{ route('dashboard.perpustakaan') }}" class="btn btn-outline-secondary btn-sm w-100 text-start py-1 px-2 text-xs text-truncate">
                    📖 <strong>Perpustakaan</strong>
                </a>
            </div>
            <div class="col-6">
                <a href="{{ route('dashboard.santri') }}" class="btn btn-outline-primary btn-sm w-100 text-start py-1 px-2 text-xs text-truncate">
                    🎓 <strong>Santri</strong>
                </a>
            </div>
            <div class="col-12">
                <a href="{{ route('dashboard.wali-santri') }}" class="btn btn-outline-info btn-sm w-100 text-start py-1 px-2 text-xs text-truncate">
                    👨‍👩‍👦 <strong>Wali Santri (Orang Tua)</strong>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function handleLogin(e) {
        e.preventDefault();
        const btn = document.getElementById('btnSubmit');
        btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status"></span> Memproses Masuk...';
        btn.disabled = true;
        setTimeout(() => {
            window.location.href = "{{ route('dashboard.super-admin') }}";
        }, 400);
    }
</script>
@endpush
