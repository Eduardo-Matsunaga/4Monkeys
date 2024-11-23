<div id="wrapper">

    <ul class="h-full bg-purple-600 navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar">
         <!-- Sidebar - Brand -->

        <div class="sidebar-brand-icon p-1">
            <a href="/">
                <img src="http://127.0.0.1:8000/images/logoNav.jpg" class="w-80 h-45 mr-8" alt="Logo Login">
            </a>
        </div>
         <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{url('/')}}">
            <div class="sidebar-brand-text mx-3">Free Version</div>
        </a>

        <hr class="sidebar-divider my-0 bg-white">

        <div class="sidebar-card d-none d-lg-flex mt-5">
            <img class="sidebar-card-illustration mb-2" src="{{ asset('img/undraw_rocket.svg') }}" alt="foguete-avaliar">
            <p class="mb-2 text-center"><strong>Seha um Assiante Premium</strong> aproveite todas as funcionalidades</p>
            <a class="btn btn-success btn-sm" href="{{url('register')}}">Registrar-se</a>
        </div>

    </ul>

</div>


