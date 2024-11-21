<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
        <div class="nav">
            <div class="sb-sidenav-menu-heading">Essencial</div>

            <a class="nav-link" href="{{url('dashboard-admin')}}">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Dashboard
            </a>
            <div class="sb-sidenav-menu-heading">Administrar</div>
            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                Produtos
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link" href="{{url('softwares')}}">Softwares</a>
                    <a class="nav-link" href="{{url('produtos')}}">Hardwares</a>
                </nav>
            </div>
            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                Usuários
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                    <a class="nav-link" href="{{url('create-admin')}}">Administradores</a>
                    <a class="nav-link" href="{{url('usuario-premium')}}">Usuários Premium</a>
                    <a class="nav-link" href="{{url('avaliar')}}">Avaliações</a>
                </nav>
            </div>
            <div class="sb-sidenav-menu-heading">Logs e Tabelas</div>
            <a class="nav-link" href="{{url('charts')}}">
                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                Gráficos
            </a>
            <a class="nav-link" href="{{url('tables')}}">
                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                Tabelas
            </a>
            <a class="nav-link" href="{{url('logRobo')}}">
                <div class="sb-nav-link-icon"><i class="fas fa-robot"></i></div>
                Robô
            </a>
        </div>
    </div>
    <div class="sb-sidenav-footer">
        <div class="small">Logado como:</div>
        {{ Auth::guard('admin')->user()->name }}

    </div>
</nav>
