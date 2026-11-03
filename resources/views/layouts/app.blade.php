<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') — SIM Pesantren Terintegrasi</title>

    <!-- Template Voler CSS Assets (Pure Local Assets) -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/chartjs/Chart.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/simple-datatables/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.svg') }}" type="image/x-icon">

    <!-- Custom SIM Pesantren Overrides & Print Styles -->
    <link rel="stylesheet" href="{{ asset('css/app-custom.css') }}">

    @stack('styles')
</head>
<body>
    <div id="app">
        <!-- Voler Sidebar (Local Assets) -->
        @include('components.sidebar')

        <!-- Voler Main Content Wrapper -->
        <div id="main">
            <!-- Voler Navbar Header (Local Assets) -->
            @include('components.topbar')

            <!-- Main Content Container -->
            <div class="main-content container-fluid">
                <!-- Voler Page Title & Actions -->
                <div class="page-title mb-4">
                    <div class="row align-items-center">
                        <div class="col-12 col-md-7">
                            <h3 class="mb-1 fw-bold text-dark">@yield('page-title', 'Dashboard')</h3>
                            <p class="text-subtitle text-muted mb-0">@yield('page-subtitle', 'Sistem Informasi Manajemen Pesantren Terintegrasi')</p>
                        </div>
                        <div class="col-12 col-md-5 d-flex justify-content-md-end align-items-center mt-3 mt-md-0 gap-2">
                            @yield('page-actions')
                        </div>
                    </div>
                    @hasSection('breadcrumb')
                        <div class="mt-2">
                            @yield('breadcrumb')
                        </div>
                    @endif
                </div>

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show d-flex align-items-center mb-4" role="alert">
                        <i data-feather="check-circle" class="me-2"></i>
                        <div>{{ session('success') }}</div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center mb-4" role="alert">
                        <i data-feather="alert-triangle" class="me-2"></i>
                        <div>{{ session('error') }}</div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                {{ $slot ?? '' }}
                @yield('content')
            </div>

            <!-- Voler Footer -->
            <footer>
                <div class="footer clearfix mb-0 text-muted px-4 py-3">
                    <div class="float-start">
                        <p class="mb-0 text-sm">2026 &copy; <strong>SIM-PESANTREN TERPADU AL-HIKMAH</strong> — Template: Voler</p>
                    </div>
                    <div class="float-end d-flex align-items-center gap-2">
                        <span class="text-xs text-muted">Role Aktif:</span>
                        <span class="badge bg-primary text-uppercase">{{ $activeRole['name'] ?? 'Super Admin' }}</span>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- Template Voler JS Assets (Pure Local Assets) -->
    <script src="{{ asset('assets/js/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script src="{{ asset('assets/vendors/chartjs/Chart.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/simple-datatables/simple-datatables.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            if (typeof feather !== 'undefined') {
                feather.replace();
            }
        });
    </script>
    @stack('scripts')
</body>
</html>
