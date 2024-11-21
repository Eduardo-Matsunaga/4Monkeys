<meta http-equiv="X-UA-Compatible" content="IE=edge" charset="UTF8"/>

<title>CRUD - @yield('titulo')</title>

<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport'/>

<!-- Ícone -->
<link rel="icon" href="{{ asset('assets/img/icon.ico') }}" type="image/x-icon"/>

<!-- Fontes -->
<script src="{{ asset('assets/js/plugin/webfont/webfont.min.js') }}"></script>
<script>
    WebFont.load({
        google: {"families": ["Lato:300,400,700,900"]},
        custom: {
            "families": ["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"],
            urls: ['{{ asset('assets/css/fonts.min.css') }}']
        },
        active: function () {
            sessionStorage.fonts = true;
        }
    });
</script>

<!-- Folha de Estilos CSS -->
<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/atlantis.min.css') }}">
