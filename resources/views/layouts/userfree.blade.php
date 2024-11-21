<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }}</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <link href="{{ asset('premium/sb-admin-2.min.css') }}" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('premium/filled-card.css') }}" rel="stylesheet" />
    <style>
        html, body {
    height: 100%;
    margin: 0;
}
    </style>
</head>
<body id="page-top" class="bg-slate-100">
    <div id="selectionAlert" class="fixed z-50 hidden p-4 text-center text-white transform -translate-x-1/2 bg-purple-600 rounded-md shadow-lg top-10 left-1/2 w-80">
        <p>Você pode selecionar no máximo 3 softwares.</p>
    </div>

    

    <div id="layoutSidenav" class="d-flex">
        @include('layouts.free.sidebar')
        <div id="layoutSidenav_content" class="flex-grow-1">
            @include('layouts.free.navbar')
            <main>
                <div class="px-4 container-fluid">
                    @yield('content free')
                </div>
            </main>
            {{--@include('layouts.free.footer')--}}
        </div>
        
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="premium/sb-admin-2.min.js"></script>
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="premium/demo/chart-area-demo.js"></script>
    <script src="premium/demo/chart-pie-demo.js"></script>
    <script src="{{ asset('premium/scripts.js') }}"></script>
    <script src="{{ asset('premium/jstelainicial.js') }}"></script>
</body>
</html>
