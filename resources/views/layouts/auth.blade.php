<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sign In') — SIM-Pesantren Terintegrasi</title>

    <!-- Template Voler CSS Assets (Pure Local Assets) -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.svg') }}" type="image/x-icon">

    <!-- Custom SIM Pesantren Overrides -->
    <link rel="stylesheet" href="{{ asset('css/app-custom.css') }}">

    @stack('styles')
</head>
<body>
    <div id="auth">
        <div class="container">
            <div class="row">
                <div class="col-md-7 col-lg-5 col-sm-12 mx-auto">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    <!-- Template Voler JS Assets (Pure Local Assets) -->
    <script src="{{ asset('assets/js/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            if (typeof feather !== 'undefined') feather.replace();
        });
    </script>
    @stack('scripts')
</body>
</html>
