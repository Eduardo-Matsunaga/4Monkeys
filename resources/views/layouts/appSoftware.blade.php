<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Título da Página -->
    <title>@yield('title', 'Aplicação')</title>

    <!-- Estilos -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    
    <!-- Scripts opcionais -->
    @stack('head-scripts')
</head>
<body class="font-sans antialiased bg-gray-200 flex flex-col min-h-screen"> <!-- Flexbox e min-h-screen aplicados -->
    
    <!-- Inclui o Cabeçalho -->
    @include('includes.header')
    
    <!-- Conteúdo Principal -->
    <div class="container mx-auto p-4 flex-grow"> <!-- Adicionado flex-grow para ocupar o espaço disponível -->
        @yield('content')
    </div>

    <!-- Inclui o Rodapé -->
    @include('includes.footer')

    <!-- Scripts Globais -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    @stack('scripts')
</body>
</html>
