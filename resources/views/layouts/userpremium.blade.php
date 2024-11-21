<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>
    <!-- Tailwind CSS -->

    <!-- Scripts do Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">

    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/favicon.ico') }}" />
    <link href="{{ asset('premium/sb-admin-2.min.css') }}" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('premium/filled-card.css') }}" rel="stylesheet" />
    <script src="{{ asset('vendor/tailwind/tailwind.min.js') }}"></script>

</head>
<body id="page-top" class="bg-slate-100 min-h-screen flex flex-col">

    <div id="selectionAlert" class="hidden fixed top-10 left-1/2 transform -translate-x-1/2 p-4 bg-purple-600 text-white rounded-md shadow-lg z-50 w-80 text-center">
        <p>Você pode selecionar no máximo 3 softwares.</p>
    </div>


    <div id="layoutSidenav" class="d-flex flex-grow-1">
        @include('layouts.main.sidebar')

        <div id="layoutSidenav_content" class="flex-grow-1">
            @include('layouts.main.navbar')
            <main>
                <div class="container-fluid px-4 flex-grow-1">
                    @yield('content premium')
                </div>
            </main>
            @include('layouts.main.footer')
        </div>
    </div>

    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}" defer></script>
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('premium/sb-admin-2.min.js') }}"></script>
    <script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('premium/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('premium/demo/chart-pie-demo.js') }}"></script>
    <script src="{{ asset('premium/scripts.js') }}"></script>
    <script src="{{ asset('premium/jstelainicial.js') }}"></script>

    <script src="{{ asset('premium/avaliacao.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            @if(session('json_error'))
            // Abre o modal de erro JSON
            new bootstrap.Modal(document.getElementById('jsonErrorModal')).show();
            @endif

            @if(session('format_error'))
            // Abre o modal de erro de formato de resposta
            new bootstrap.Modal(document.getElementById('formatErrorModal')).show();
            @endif
        });
    </script>
</body>
</html>
